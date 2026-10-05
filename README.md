# Wordpress
This wordpress stack uses bedrock for easy wordpress development.

## Requirements
- You need to have docker installed on your machine.
- Copy .env.example to .env and fill in the required variables.

## Getting started

### Dev

Install the stack (first start only):
```
bin/dev/install
```

Next time you only have to start the stack using the following command:
```
bin/dev/start
```

By default the stack will start with the following services:
- wordpress : http://localhost:8080
- phpmyadmin : http://localhost:8081
- mysql
- node

### Production

Start the stack:
`docker-compose --profile prod up -d`

The production image is built from `main` and pushed as `erasme/labeps-wordpress:latest`.

#### Persistent paths

Plugins, WordPress core and translations can be updated from the admin in production. To keep those updates across deployments, the following paths must be persistent, writable by `www-data` (uid/gid 33, e.g. `fsGroup: 33`):

| Path | Content |
|---|---|
| `/var/www/html/bedrock/web/app/uploads` | media |
| `/var/www/html/bedrock/web/app/plugins` | plugins |
| `/var/www/html/bedrock/web/wp` | WordPress core |
| `/var/www/html/bedrock/web/app/languages` | translations |

`web/app/mu-plugins`, `web/app/themes`, `web/app/upgrade` and `web/app/cache` must not be persisted.

Only mount these volumes on an image that ships `labeps-entrypoint`: a volume mounted on an older image hides the plugins and core shipped by the image.

#### Startup synchronisation

On startup, `labeps-entrypoint` (`docker/prod/entrypoint.sh`) synchronises the volumes with the copy of plugins, core and translations shipped in the image (`/opt/labeps`), then starts Apache:

- a plugin shipped by the image is installed if missing, and replaced only if the image version is newer; a newer version installed from the admin is kept
- a plugin installed from the admin and not shipped by the image is left untouched
- a plugin removed from `composer.json` is deleted from the volume on the next deployment; removing a shipped plugin from the admin is undone on the next deployment
- the core is replaced only if the image version is newer, then `wp core update-db` runs; if the database is unreachable, WordPress asks for the database update on the next admin visit
- translation files are copied only when missing

Every action is logged with the `[labeps-sync]` prefix. The first startup on empty volumes copies about 175 MB: allow for it in startup probes.

The container exits with code 1, before Apache starts, when a persistent path is not writable or when the synchronisation lock is not acquired: a restart loop at startup is explained in the `[labeps-sync]` logs.

| Variable | Default | Role |
|---|---|---|
| `LABEPS_SYNC_LOCK_TIMEOUT` | `600` | seconds to wait for another container to finish its synchronisation |
| `LABEPS_UPDATE_DB_TIMEOUT` | `120` | seconds allowed to `wp core update-db` |

#### Known limits

- Run a single replica, or deploy with a `Recreate` strategy: while a container replaces the core or a plugin, another container serving the same volumes reads an incomplete tree
- Rolling the core back to an older version requires a manual intervention: the startup synchronisation never downgrades it
- A translation file already present in the volume is no longer updated by the image

## Notes

**Create a bedrock project**
`docker run --rm -v $(pwd):/app -u $(id -u):$(id -g) composer create-project roots/bedrock`

`docker run --rm -v $(pwd):/app -u $(id -u):$(id -g) lab_espaces_publics-apache-dev-1 wp acorn vendor:publish`
