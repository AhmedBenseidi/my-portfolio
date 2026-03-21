FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    nginx libpng-dev libjpeg-dev libfreetype6-dev libzip-dev libicu-dev zip unzip git curl \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql gd zip intl

WORKDIR /var/www/html
COPY . .

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

RUN npm install && npm run build

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

RUN sed -i 's|listen = /run/php/php8.2-fpm.sock|listen = 9000|g' /usr/local/etc/php-fpm.d/www.conf

COPY nginx.conf /etc/nginx/sites-enabled/default

CMD ["sh", "-c", "php artisan optimize:clear && php artisan storage:link && php-fpm -D && nginx -g 'daemon off;'"]
