FROM php:8.1.7-fpm-alpine
RUN apk add --update linux-headers
RUN apk add $PHPIZE_DEPS --no-cache build-base curl git libpq libpq-dev openssl pcre-dev \
&& pecl install xdebug redis \
&& docker-php-ext-enable xdebug redis.so \
&& docker-php-ext-install pdo pdo_pgsql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
CMD ["php-fpm"]
EXPOSE 9000
