FROM php:8.2-fpm

# تثبيت الاعتمادات وتثبيت Node.js لعمل بناء لملفات Vite
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

# تثبيت مكتبات NPM وبناء ملفات Vite (هذا الجزء هو الذي سيحل المشكلة)
RUN npm install
RUN npm run build

# إعداد الصلاحيات و Nginx
COPY nginx.conf /etc/nginx/sites-enabled/default
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# إنشاء مجلدات التخزين المؤقتة وضمان وجودها
RUN mkdir -p /var/www/html/storage/app/public/livewire-tmp \
    && mkdir -p /var/www/html/public/uploads \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/public /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/public /var/www/html/bootstrap/cache

CMD ["sh", "-c", "service nginx start && php-fpm"]
