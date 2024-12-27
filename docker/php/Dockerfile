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

# composer
COPY --from=composer/composer:latest-bin /composer /usr/local/bin/composer

# php extensions
RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip
RUN docker-php-ext-install curl

# xdebug
ARG ENABLE_XDEBUG=0

RUN pecl install xdebug
RUN if [ "$ENABLE_XDEBUG" = "1" ]; then \
    docker-php-ext-enable xdebug && \
    echo "xdebug.max_nesting_level=1000" >> /usr/local/etc/php/conf.d/99-xdebug.ini && \
    echo "xdebug.mode=debug,coverage" >> /usr/local/etc/php/conf.d/99-xdebug.ini && \
    echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/99-xdebug.ini && \
    echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/99-xdebug.ini && \
    echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/99-xdebug.ini && \
    echo "xdebug.output_dir=/tmp/xdebug" >> /usr/local/etc/php/conf.d/99-xdebug.ini; \
    fi

# switch user
USER transfer

# environemnt
ENV PROJECT_ROOT="/home/transfer/transfer-object"

# workaround to keep container running
CMD ["tail", "-f", "/dev/null"]
