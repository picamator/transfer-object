FROM php:8.5-cli

ARG GROUP_ID
ARG USER_ID

RUN echo "USER_ID=${USER_ID} GROUP_ID=${GROUP_ID}"

# -e (errexit): exit the shell immediately if a simple command returns non‑zero.
# -u (nounset): treat use of an unset variable as an error and exit.
# -x (xtrace): print each command (with arguments) to stderr as it is executed (a trace).
# -o pipefail: make a pipeline fail if any command in it fails.
RUN set -euxo pipefail; \
    apt-get update && \
    apt-get -y install git zip libzip-dev curl libcurl4-openssl-dev && \
    docker-php-ext-configure zip && \
    docker-php-ext-install zip curl bcmath && \
    rm -rf /var/lib/apt/lists/*

# pie https://github.com/php/pie/blob/1.4.x/docs/usage.md#docker-installation
COPY --from=ghcr.io/php/pie:bin /pie /usr/bin/pie

# xdebug
RUN pie install xdebug/xdebug:^3.5.0 && \
    docker-php-ext-enable xdebug

COPY ./config.d/99-xdebug.ini  /usr/local/etc/php/conf.d/99-xdebug.ini

# php
COPY ./config.d/99-php.ini  /usr/local/etc/php/conf.d/99-php.ini

# composer https://getcomposer.org/doc/00-intro.md#docker-image
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

# group and user
RUN set -euxo pipefail; \
  if getent group ${GROUP_ID}; then \
    GROUP_NAME=$(getent group ${GROUP_ID} | cut -d: -f1); \
    groupmod -n generator "$GROUP_NAME"; \
  else \
    groupadd -g ${GROUP_ID} generator; \
  fi && \
  if getent passwd ${USER_ID}; then \
    USER_NAME=$(getent passwd ${USER_ID} | cut -d: -f1); \
    usermod -l transfer -g generator -m -d /home/transfer "$USER_NAME"; \
  else \
    useradd -m -u ${USER_ID} -g generator transfer; \
  fi

# working directory
RUN mkdir /home/transfer/transfer-object
WORKDIR /home/transfer/transfer-object

# autocomplete and cli style
COPY ./bash/composer-autocomplete.sh /home/transfer/composer-autocomplete.sh
COPY ./bash/.bashrc /home/transfer/.bashrc

# permissions
RUN chown -R transfer:generator /home/transfer

# user switch
USER transfer

# volume
VOLUME /home/transfer/transfer-object

# workaround to keep container running
CMD ["tail", "-f", "/dev/null"]
