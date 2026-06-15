FROM php:8.2-apache

# تثبيت الحزم المطلوبة
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip unzip git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# تحديد المجلد الرئيسي للعمل
WORKDIR /var/www/html

# نسخ ملفات المشروع
COPY . .

# تثبيت مكتبات لارافيل
RUN composer install --no-dev --optimize-autoloader

# ضبط الصلاحيات والمسارات
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite
