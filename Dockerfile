FROM php:8.2-apache

# تثبيت الحزم المطلوبة للنظام
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip unzip git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# نسخ ملفات التثبيت فقط أولاً (هذا يسرع العملية ويقلل الأخطاء)
COPY composer.json composer.lock ./

# محاولة تثبيت المكتبات بدون تنفيذ السكريبتات التي قد تفشل (مثل post-install)
RUN composer update --no-dev --no-scripts --no-interaction
# الآن انسخ بقية المشروع
COPY . .

# تنفيذ السكريبتات وتوليد الـ autoload
RUN composer dump-autoload --optimize

# ضبط الصلاحيات والمسارات
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite
