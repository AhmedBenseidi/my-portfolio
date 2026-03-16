FROM php:8.2-fpm

# تثبيت الاعتمادات وتثبيت Node.js
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
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql gd intl zip

WORKDIR /var/www/html
COPY . .

# تثبيت مكتبات Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# بناء ملفات Vite (لحل مشكلة الـ Manifest)
RUN npm install && npm run build

# إنشاء المجلدات المؤقتة ومنح الصلاحيات (حل مشكلة الرفع)
RUN mkdir -p /var/www/html/storage/app/public \
    && mkdir -p /var/www/html/storage/app/livewire-tmp \
    && mkdir -p /var/www/html/storage/framework/views \
    && mkdir -p /var/www/html/storage/framework/cache \
    && mkdir -p /var/www/html/storage/framework/sessions \
    && mkdir -p /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public

# إعداد Nginx
COPY nginx.conf /etc/nginx/sites-enabled/default

RUN sed -i 's|listen = /run/php/php8.2-fpm.sock|listen = 127.0.0.1:8080|g' /usr/local/etc/php-fpm.d/www.conf

# تشغيل السيرفر
CMD ["sh", "-c", "service nginx start && php-fpm"]
