#!/usr/bin/env bash

set -eu

# ----------------------------------------------------------------------------------------------------------------------
# You can include verbosity.inc.bash before this script to create $VERBOSITY_LEVEL or create it by yourself.
# ----------------------------------------------------------------------------------------------------------------------

function theme-block() {
    local titleLength="${#2}"
    printf "\n\e[${1}m\e[1;37m    "
    for x in $(seq 1 ${titleLength}); do printf " "; done;
    printf "\e[0m\n"

    printf "\e[${1}m\e[1;37m  ${2}  \e[0m\n"
    printf "\e[${1}m\e[1;37m    "
    for x in $(seq 1 ${titleLength}); do printf " "; done;
    printf "\e[0m\n\n"
}

function theme-title() {
      theme-block 46 "${1}."
}


function theme-ok() {
    theme-block 42 "Ok"
}
