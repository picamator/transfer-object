FROM php:8.4-cli

# build arguments for UID/GID flexibility
ARG GROUP_ID=1000
ARG USER_ID=1000

# update apt cache and install system requirements in a single RUN command
RUN apt-get --allow-unauthenticated --allow-insecure-repositories update && \
    apt-get -y install git zip libzip-dev curl libcurl4-openssl-dev && \
    docker-php-ext-configure zip && \
    docker-php-ext-install zip curl bcmath && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug

# copy Xdebug configuration
COPY ./config.d/99-xdebug.ini  /usr/local/etc/php/conf.d/99-xdebug.ini

# copy composer from official image
COPY --from=composer/composer:2-bin /composer /usr/local/bin/composer

# create group and user
RUN groupadd -g ${GROUP_ID} generator && \
    useradd -m -u ${USER_ID} -g generator transfer

# create working directory
RUN mkdir /home/transfer/transfer-object
WORKDIR /home/transfer/transfer-object

# bash
COPY ./bash/composer-autocomplete.sh /home/transfer/composer-autocomplete.sh
COPY ./bash/.bashrc /home/transfer/.bashrc

# change permissions
RUN chown -R transfer:generator /home/transfer

# switch to the new user
USER transfer

# create volume
VOLUME /home/transfer/transfer-object

# workaround to keep container running
CMD ["tail", "-f", "/dev/null"]
