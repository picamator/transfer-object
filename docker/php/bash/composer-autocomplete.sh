#!/usr/bin/env bash

# composer command autocompletion script
_composer_autocomplete() {
    local cur prev opts
    COMPREPLY=()
    cur="${COMP_WORDS[COMP_CWORD]}"
    prev="${COMP_WORDS[COMP_CWORD-1]}"
    opts="install update why test phpunit phpunit-group phpstan transfer-generate transfer-generate-bulk definition-generate captainhook phpcs phpcbf list"

    if [[ ${prev} == "composer" ]]; then
        COMPREPLY=( $(compgen -W "${opts}" -- ${cur}) )
        return 0
    fi
}

complete -F _composer_autocomplete composer
