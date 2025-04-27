#!/usr/bin/env bash

# composer command autocompletion script
_composer_autocomplete() {
    local cur prev opts
    COMPREPLY=()
    cur="${COMP_WORDS[COMP_CWORD]}"
    prev="${COMP_WORDS[COMP_CWORD-1]}"
    opts="install update why phpunit phpstan transfer-generate definition-generate captainhook phpcs phpcbf list"

    if [[ ${prev} == "composer" ]]; then
        COMPREPLY=( $(compgen -W "${opts}" -- ${cur}) )
        return 0
    fi
}

complete -F _composer_autocomplete composer
