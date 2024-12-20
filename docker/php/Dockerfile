FROM php:8.4

# user
RUN groupadd -g 1000 generator && \
    useradd -m -u 1000 -g generator transfer

# switch user
USER transfer

# volume
RUN mkdir /home/transfer/transfer-object
VOLUME /home/transfer/transfer-object

# workdir
WORKDIR /home/transfer/transfer-object

# switch user
USER root

# update apt cache
RUN apt-get --allow-unauthenticated --allow-insecure-repositories update

# install system requirements
RUN apt-get -y install git
RUN apt-get install -y zip libzip-dev
RUN apt-get -y install curl
RUN apt-get -y install libcurl4-openssl-dev
RUN apt-get -y install libonig-dev

# composer
COPY --from=composer/composer:latest-bin /composer /usr/local/bin/composer

# php extensions
RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip
RUN docker-php-ext-install curl
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install mbstring

# xdebug
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
ADD ./config/69-xdebug.ini /usr/local/etc/php/conf.d/

# switch user
USER transfer

# Workaround to keep container running
CMD ["tail", "-f", "/dev/null"]
