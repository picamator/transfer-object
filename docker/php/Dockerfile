FROM php:8.4

# create a user and group
RUN groupadd -g 1000 generator && \
    useradd -m -u 1000 -g generator transfer

# switch to the new user
USER transfer

# create and set volume and workdir
RUN mkdir /home/transfer/transfer-object
VOLUME /home/transfer/transfer-object
WORKDIR /home/transfer/transfer-object

# set environment variable
ENV PROJECT_ROOT=/home/transfer/transfer-object

# switch back to root for system installations
USER root

# update apt cache and install system requirements in a single RUN command
RUN apt-get --allow-unauthenticated --allow-insecure-repositories update && \
    apt-get -y install git zip libzip-dev curl libcurl4-openssl-dev

# copy composer from composer/composer:latest-bin
COPY --from=composer/composer:latest-bin /composer /usr/local/bin/composer

# install PHP extensions and PECL packages in a single RUN command
RUN docker-php-ext-configure zip && \
    docker-php-ext-install zip curl bcmath && \
    pecl install xdebug

# configure Xdebug
RUN docker-php-ext-enable xdebug
COPY ./config.d/99-xdebug.ini  /usr/local/etc/php/conf.d/99-xdebug.ini

# switch back to the new user
USER transfer

# bash
COPY ./bash/composer-autocomplete.sh /home/transfer/composer-autocomplete.sh
COPY ./bash/.bashrc /home/transfer/.bashrc

# workaround to keep container running
CMD ["tail", "-f", "/dev/null"]
