FROM php:8.2-fpm

# 1. تثبيت Node.js (نحتاجه لعمل Vite Build)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs
# تثبيت المكتبات النظامية المطلوبة للإضافات
RUN apt-get update && apt-get install -y \
    nginx \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libicu-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql gd intl zip

# بقية الملف كما هي...
COPY nginx.conf /etc/nginx/sites-enabled/default

WORKDIR /var/www/html
COPY . .

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# تأكد من تشغيل Nginx و PHP-FPM بشكل صحيح في النهاية
CMD service nginx start && php-fpm
CMD ["sh", "-c", "service nginx start && php-fpm"]
