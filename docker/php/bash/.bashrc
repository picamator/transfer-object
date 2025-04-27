# source the composer autocompletion script
if [ -f /home/transfer/composer-autocomplete.sh ]; then
  source /home/transfer/composer-autocomplete.sh
fi

# function to wrap text in green
function wrap_in_green() {
  echo -e "\e[32m$1\e[0m"
}

echo -e "$(wrap_in_green "\nWelcome to the Transfer Object PHP Container!\n")"
PS1="\[\e[1;34m\]\w\[\e[0m\]$ "
