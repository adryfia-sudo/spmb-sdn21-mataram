FROM php:835-apache

# 1. Optimasi Repositori & Install System Dependencies Dasar
RUN sed -i 's|deb.debian.org|cdn-fastly.deb.debian.org|g' /etc/apt/sources.list.d/debian.sources \
    && apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        unzip \
    && rm -rf /var/lib/apt/lists/*

# 2. Download script installer ekstensi biner (mencegah kompilasi berat)
ADD https://github.com /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions \
    && install-php-extensions \
        pdo_pgsql \
        pgsql \
        mbstring \
        bcmath \
        intl \
        zip \
        exif \
        pcntl \
        opcache \
        gd \
    && a2enmod rewrite

# Composer (Lanjutkan ke baris kode Anda berikutnya...)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Composer dependencies
COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader

# Laravel application
COPY . .

# Apache -> Laravel public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri \
    -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf

# Laravel directories and permissions
RUN mkdir -p \
        storage/framework/cache \
        storage/framework/sessions \
        storage/framework/views \
        storage/logs \
        bootstrap/cache \
    && chown -R www-data:www-data \
        storage \
        bootstrap/cache \
    && chmod -R 775 \
        storage \
        bootstrap/cache

# PHP configuration
RUN { \
        echo 'opcache.enable=1'; \
        echo 'opcache.validate_timestamps=1'; \
        echo 'opcache.revalidate_freq=2'; \
        echo 'upload_max_filesize=20M'; \
        echo 'post_max_size=25M'; \
        echo 'memory_limit=512M'; \
        echo 'max_execution_time=120'; \
    } > /usr/local/etc/php/conf.d/spmb.ini

EXPOSE 80

CMD ["apache2-foreground"]
