FROM php:8.2-fpm

# تثبيت الاعتمادات و Node.js
RUN apt-get update && apt-get install -y \
    nginx \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql gd zip

WORKDIR /var/www/html
COPY . .

# تثبيت مكتبات Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# بناء ملفات Vite
RUN npm install && npm run build

# --- الجزء الحاسم للإصلاح ---
# 1. ضبط PHP-FPM للاستماع على المنفذ 9000 بدلاً من الـ Socket
RUN sed -i 's|listen = /run/php/php8.2-fpm.sock|listen = 127.0.0.1:9000|g' /usr/local/etc/php-fpm.d/www.conf || \
    sed -i 's|listen = 127.0.0.1:9000|listen = 9000|g' /usr/local/etc/php-fpm.d/www.conf

# 2. إنشاء مجلدات الرفع ومنح الصلاحيات
RUN mkdir -p /var/www/html/storage/app/public/livewire-tmp \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public

# إعداد Nginx
COPY nginx.conf /etc/nginx/sites-enabled/default

# تشغيل السيرفرين معاً
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
