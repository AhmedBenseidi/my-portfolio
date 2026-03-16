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

# بناء ملفات Vite (لضمان ظهور التصميم)
RUN npm install && npm run build

# --- الجزء الحاسم للإصلاح ---
# 1. ضبط PHP-FPM للاستماع على المنفذ 9000 بدلاً من الـ Socket ليتوافق مع Nginx
RUN sed -i 's|listen = /run/php/php8.2-fpm.sock|listen = 127.0.0.1:9000|g' /usr/local/etc/php-fpm.d/www.conf || \
    sed -i 's|listen = 127.0.0.1:9000|listen = 9000|g' /usr/local/etc/php-fpm.d/www.conf

# 2. إنشاء مجلدات الرفع ومنح الصلاحيات الكاملة (حل مشكلة الرفع في Filament)
RUN mkdir -p /var/www/html/storage/app/public/livewire-tmp \
    && mkdir -p /var/www/html/storage/framework/views \
    && mkdir -p /var/www/html/storage/framework/cache \
    && mkdir -p /var/www/html/storage/framework/sessions \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public

# إعداد Nginx
COPY nginx.conf /etc/nginx/sites-enabled/default

# تشغيل السيرفرين معاً لضمان عدم توقف الحاوية
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
