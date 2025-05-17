#!/usr/bin/env bash

# docker sdk autocompletion script
_docker_sdk_autocomplete() {
    local cur prev opts
    COMPREPLY=()
    cur="${COMP_WORDS[COMP_CWORD]}"
    prev="${COMP_WORDS[COMP_CWORD-1]}"

    # define the main commands for docker/sdk
    opts="build start stop cli composer phpstan phpunit phpcs phpcbf hook-install hook to-generate to-generate-bulk df-generate"

    case "${prev}" in
        composer)
            # define subcommands for 'composer'
            COMPREPLY=( $(compgen -W "install update why phpunit phpstan transfer-generate transfer-generate-bulk definition-generate captainhook phpcs phpcbf list" -- "${cur}") )
            return 0
            ;;
        hook)
            # define subcommands for 'hook'
            COMPREPLY=( $(compgen -W "install enable disable run list" -- "${cur}") )
            return 0
            ;;
        *)
            # provide all top-level options if no specific context
            COMPREPLY=( $(compgen -W "${opts}" -- "${cur}") )
            return 0
            ;;
    esac
}

complete -F _docker_sdk_autocomplete docker/sdk
complete -F _docker_sdk_autocomplete ds
