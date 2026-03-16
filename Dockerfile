FROM php:8.2-fpm

# تثبيت الإضافات اللازمة لـ Laravel و Nginx
RUN apt-get update && apt-get install -y \
    nginx \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl

# تثبيت إضافات PHP
RUN docker-php-ext-install pdo_mysql gd

# نسخ إعدادات Nginx التي أرسلتها أنت (تأكد من تسمية ملفك nginx.conf)
COPY nginx.conf /etc/nginx/sites-enabled/default
# نسخ ملفات المشروع
WORKDIR /var/www/html
COPY . .

# تثبيت مكتبات Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# إعطاء الصلاحيات لمجلدات Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# تشغيل PHP-FPM و Nginx معاً
CMD service nginx start && php-fpm
