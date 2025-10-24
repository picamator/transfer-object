FROM php:8.4-cli

ARG GROUP_ID=1000
ARG USER_ID=1000

RUN apt-get --allow-unauthenticated --allow-insecure-repositories update && \
    apt-get -y install git zip libzip-dev curl libcurl4-openssl-dev && \
    docker-php-ext-configure zip && \
    docker-php-ext-install zip curl bcmath && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug

# php
COPY ./config.d/99-php.ini  /usr/local/etc/php/conf.d/99-php.ini

# Xdebug https://xdebug.org/docs/all_settings
COPY ./config.d/99-xdebug.ini  /usr/local/etc/php/conf.d/99-xdebug.ini

# composer https://getcomposer.org/doc/00-intro.md#docker-image
COPY --from=composer/composer:2-bin /composer /usr/local/bin/composer

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
