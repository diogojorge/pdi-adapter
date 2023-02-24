FROM php:8.1.7-fpm-alpine
RUN apk add --no-cache build-base curl libpq libpq-dev openssl \
&& docker-php-ext-install pdo pdo_pgsql 
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
CMD ["php-fpm"]
EXPOSE 9000
