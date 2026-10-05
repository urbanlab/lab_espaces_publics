#!/usr/bin/env bash

set -euo pipefail
shopt -s nullglob

readonly REFERENCE_ROOT="/opt/labeps"
readonly BEDROCK_ROOT="/var/www/html/bedrock"
readonly PLUGINS_DIRECTORY="${BEDROCK_ROOT}/web/app/plugins"
readonly CORE_DIRECTORY="${BEDROCK_ROOT}/web/wp"
readonly LANGUAGES_DIRECTORY="${BEDROCK_ROOT}/web/app/languages"
readonly LOCK_FILE="${PLUGINS_DIRECTORY}/.labeps-sync.lock"
readonly MANIFEST_FILE="${PLUGINS_DIRECTORY}/.labeps-image-plugins"
readonly SYNC_HELPER="/usr/local/lib/labeps/sync-helper.php"
readonly LOCK_TIMEOUT_SECONDS="${LABEPS_SYNC_LOCK_TIMEOUT:-600}"
readonly UPDATE_DATABASE_TIMEOUT_SECONDS="${LABEPS_UPDATE_DB_TIMEOUT:-120}"

log() {
    printf '[labeps-sync] %s\n' "$*"
}

plugin_version() {
    php "${SYNC_HELPER}" plugin-version "${1}" 2>/dev/null || true
}

core_version() {
    php "${SYNC_HELPER}" core-version "${1}" 2>/dev/null || true
}

is_newer() {
    php "${SYNC_HELPER}" is-newer "${1}" "${2}"
}

assert_helper_present() {
    if [ ! -f "${SYNC_HELPER}" ]; then
        log "ERREUR : ${SYNC_HELPER} est introuvable"
        exit 1
    fi
}

assert_writable() {
    local directory

    for directory in "${PLUGINS_DIRECTORY}" "${CORE_DIRECTORY}" "${LANGUAGES_DIRECTORY}"; do
        if ! touch "${directory}/.labeps-write-test" 2>/dev/null; then
            log "ERREUR : ${directory} n'est pas inscriptible par l'uid $(id -u) (gid $(id -g)). Le volume doit appartenir à l'uid/gid 33 (www-data), par exemple fsGroup: 33."
            exit 1
        fi
        rm -f "${directory}/.labeps-write-test"
    done
}

replace_plugin() {
    local plugin_name="${1}"
    local temporary_directory="${PLUGINS_DIRECTORY}/.${plugin_name}.labeps-tmp"

    rm -rf "${temporary_directory}"
    cp -a "${REFERENCE_ROOT}/plugins/${plugin_name}" "${temporary_directory}"
    rm -rf "${PLUGINS_DIRECTORY:?}/${plugin_name}"
    mv "${temporary_directory}" "${PLUGINS_DIRECTORY}/${plugin_name}"
}

remove_dropped_plugins() {
    local plugin_name

    if [ ! -f "${MANIFEST_FILE}" ]; then
        return 0
    fi

    while IFS= read -r plugin_name; do
        case "${plugin_name}" in
            '' | . | .. | */*) continue ;;
        esac

        if grep -qxF -- "${plugin_name}" "${MANIFEST_FILE}.new"; then
            continue
        fi

        if [ -d "${PLUGINS_DIRECTORY}/${plugin_name}" ]; then
            rm -rf "${PLUGINS_DIRECTORY:?}/${plugin_name}"
            log "${plugin_name} : supprimée (retirée de l'image)"
        fi
    done < "${MANIFEST_FILE}"
}

sync_plugins() {
    local reference_plugin plugin_name reference_version target_version

    find "${PLUGINS_DIRECTORY}" -mindepth 1 -maxdepth 1 -name '.*.labeps-tmp' -exec rm -rf {} +
    : > "${MANIFEST_FILE}.new"

    for reference_plugin in "${REFERENCE_ROOT}"/plugins/*/; do
        plugin_name="$(basename "${reference_plugin}")"
        printf '%s\n' "${plugin_name}" >> "${MANIFEST_FILE}.new"
        reference_version="$(plugin_version "${reference_plugin}")"

        if [ ! -d "${PLUGINS_DIRECTORY}/${plugin_name}" ]; then
            replace_plugin "${plugin_name}"
            log "${plugin_name} : installée (${reference_version:-version inconnue})"
            continue
        fi

        target_version="$(plugin_version "${PLUGINS_DIRECTORY}/${plugin_name}")"

        if [ -z "${target_version}" ]; then
            replace_plugin "${plugin_name}"
            log "${plugin_name} : remplacée (version illisible dans le volume)"
            continue
        fi

        if [ -n "${reference_version}" ] && is_newer "${reference_version}" "${target_version}"; then
            replace_plugin "${plugin_name}"
            log "${plugin_name} : mise à jour ${target_version} -> ${reference_version}"
            continue
        fi

        if [ "${reference_version}" != "${target_version}" ]; then
            log "${plugin_name} : ${target_version} conservée (image : ${reference_version:-version inconnue})"
        fi
    done

    remove_dropped_plugins
    mv "${MANIFEST_FILE}.new" "${MANIFEST_FILE}"
}

sync_core() {
    local reference_version target_version

    reference_version="$(core_version "${REFERENCE_ROOT}/wp")"
    target_version="$(core_version "${CORE_DIRECTORY}")"

    if [ -n "${target_version}" ] && ! is_newer "${reference_version}" "${target_version}"; then
        if [ "${reference_version}" != "${target_version}" ]; then
            log "cœur : ${target_version} conservé (image : ${reference_version:-version inconnue})"
        fi
        return 0
    fi

    rsync -a --delete --exclude=/wp-includes/version.php "${REFERENCE_ROOT}/wp/" "${CORE_DIRECTORY}/"
    cp -a "${REFERENCE_ROOT}/wp/wp-includes/version.php" "${CORE_DIRECTORY}/wp-includes/version.php"
    log "cœur : ${target_version:-absent} -> ${reference_version}"
    update_database
}

update_database() {
    if (cd "${BEDROCK_ROOT}" && HOME=/tmp timeout "${UPDATE_DATABASE_TIMEOUT_SECONDS}" wp core update-db --skip-plugins --skip-themes); then
        log "base : à jour"
    else
        log "base : migration impossible maintenant, WordPress la proposera à la prochaine connexion à l'admin"
    fi
}

sync_languages() {
    local transferred_files copied_files

    transferred_files="$(rsync -a --ignore-existing --out-format='%n' "${REFERENCE_ROOT}/languages/" "${LANGUAGES_DIRECTORY}/")"
    copied_files="$(printf '%s\n' "${transferred_files}" | grep -v '^$' | grep -vc '/$' || true)"

    if [ "${copied_files}" != "0" ]; then
        log "traductions : ${copied_files} fichier(s) ajouté(s)"
    fi
}

assert_helper_present
assert_writable

(
    if ! flock -w "${LOCK_TIMEOUT_SECONDS}" 9; then
        log "ERREUR : verrou de synchronisation non obtenu après ${LOCK_TIMEOUT_SECONDS} s"
        exit 1
    fi

    sync_plugins
    sync_core
    sync_languages
) 9>"${LOCK_FILE}"

exec "$@"
