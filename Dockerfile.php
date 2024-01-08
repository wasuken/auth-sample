FROM php:latest

RUN apt-get update && apt-get install -y \
    libicu-dev \
    libonig-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl mbstring pdo_mysql zip mysqli

COPY --from=composer /usr/bin/composer /usr/bin/composer

USER 1000

RUN mkdir /app

WORKDIR /app

COPY ./php/composer.* ./

RUN composer install

CMD ["php", "spark", "serve", "--host", "0.0.0.0"]
