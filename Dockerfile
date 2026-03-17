FROM php:8.2-fpm

# تثبيت الاعتمادات و Node.js مع إضافة libicu-dev الضرورية لـ intl
RUN apt-get update && apt-get install -y \
    nginx \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libicu-dev \
    zip \
    unzip \
    git \
    curl \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    # تفعيل الإضافات المطلوبة بما فيها intl و zip و gd و pdo_mysql
    && docker-php-ext-install pdo_mysql gd zip intl

WORKDIR /var/www/html
COPY . .

# تثبيت مكتبات Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# بناء ملفات Vite
RUN npm install && npm run build

# --- ضبط الإعدادات الداخلية ---
# 1. ضبط PHP-FPM للاستماع على المنفذ 9000
RUN sed -i 's|listen = /run/php/php8.2-fpm.sock|listen = 127.0.0.1:9000|g' /usr/local/etc/php-fpm.d/www.conf || \
    sed -i 's|listen = 127.0.0.1:9000|listen = 9000|g' /usr/local/etc/php-fpm.d/www.conf

# 2. إنشاء مجلدات التخزين المؤقت ومنح الصلاحيات الكاملة لـ www-data
RUN mkdir -p /var/www/html/storage/app/livewire-tmp \
    && mkdir -p /var/www/html/storage/framework/sessions \
    && mkdir -p /var/www/html/storage/framework/views \
    && mkdir -p /var/www/html/storage/framework/cache \
    && chown -R www-data:www-data /var/www/html/storage \
    && chmod -R 775 /var/www/html/storage

# إعداد Nginx
COPY nginx.conf /etc/nginx/sites-enabled/default

# تشغيل السيرفرين
CMD ["sh", "-c", " php-fpm -D && nginx -g 'daemon off;'"]
