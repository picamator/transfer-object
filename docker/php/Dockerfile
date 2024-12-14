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

# isntall system requirements
RUN apt-get -y install git
RUN apt-get install -y zip libzip-dev
RUN apt-get -y install curl
RUN apt-get -y install libcurl4-openssl-dev
RUN apt-get -y install libonig-dev

# composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

# php extentions
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

CMD ["composer", "install"]
