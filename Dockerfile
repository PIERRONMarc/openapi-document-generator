FROM php:8.1-apache as base
RUN apt-get update && \
    apt-get install -y --no-install-recommends git unzip libzip-dev && \
    docker-php-ext-install mysqli pdo pdo_mysql zip && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
    a2enmod rewrite && a2enmod headers
COPY . .


FROM base as dev
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
CMD composer install; php bin/console messenger:consume sqs -vv


FROM base as prod
CMD php bin/console messenger:consume sqs