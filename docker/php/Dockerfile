FROM php:7.2-fpm

RUN apt-get update && apt-get install -y \
    openssl \
    wget \
    git \
    sudo \
    zip \
    unzip \
    zlib1g-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql zip

RUN pecl install apcu-5.1.8
RUN docker-php-ext-enable apcu

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('SHA384', 'composer-setup.php') === '48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php --filename=composer \
    && php -r "unlink('composer-setup.php');" \
    && mv composer /usr/local/bin/composer

WORKDIR /usr/src/app

COPY docker/php/php.ini /usr/local/etc/php
COPY apps/bracelet /usr/src/app

RUN PATH=$PATH:/usr/src/apps/vendor/bin:bin

ENTRYPOINT ["chown", "-R", "www-data:www-data", "/usr/src/app/var"]
