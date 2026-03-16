FROM php:8.4-fpm

# تثبيت الاعتمادات والامتدادات
RUN apt-get update && apt-get install -y nginx git unzip libzip-dev libpng-dev libonig-dev libxml2-dev libicu-dev curl
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip intl

# composer
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . /var/www/html

RUN composer install --no-dev --optimize-autoloader --no-interaction

# صلاحيات
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache || true

# انسخ إعداد nginx
COPY deploy/nginx.conf /etc/nginx/sites-available/default

EXPOSE 8080
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
