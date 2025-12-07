FROM php:8.5-cli

ARG GROUP_ID=1000
ARG USER_ID=1000

RUN apt-get update && \
    apt-get -y install git zip libzip-dev curl libcurl4-openssl-dev && \
    docker-php-ext-configure zip && \
    docker-php-ext-install zip curl bcmath

# pie https://github.com/php/pie/blob/main/docs/usage.md#docker-installation
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
RUN groupadd -g ${GROUP_ID} generator && \
    useradd -m -u ${USER_ID} -g generator transfer

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
