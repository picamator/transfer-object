# source the composer autocompletion script
if [ -f /home/transfer/composer-autocomplete.sh ]; then
  source /home/transfer/composer-autocomplete.sh
fi

# function to wrap text in green
function wrap_in_green() {
  echo -e "\e[32m$1\e[0m"
}

# function to wrap text in blue
function color_blue() {
  echo -e "\[\e[1;34m\]$1\[\e[0m\]"
}

# function to wrap text in yellow
function wrap_in_yellow() {
  echo -e "\e[33m$1\e[0m"
}

# greetings
wrap_in_green "======================================"
wrap_in_green "    Transfer Object (PHP Container)   "
wrap_in_green "======================================"
wrap_in_yellow "XDEBUG: $XDEBUG_MODE, PHP: $PHP_VERSION"

# style prompt
PS1="$(color_blue "\w")$ "

# function to display "Bay" when the shell is terminated
function say_goodbye() {
    echo -e "$(wrap_in_green "👋 Bay!")"
}

# trap the EXIT signal to call the say_goodbye function on shell termination
trap say_goodbye EXIT
