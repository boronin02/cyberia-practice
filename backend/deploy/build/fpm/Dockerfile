FROM php:8.4-fpm AS base

USER root

RUN apt-get update && apt-get install -y nginx

RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | bash -

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    zip \
    unzip \
    sudo

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip opcache sockets intl > /dev/null

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install imagick extension
RUN apt-get update  \
    && apt-get install -y libmagickwand-dev --no-install-recommends  \
    && rm -rf /var/lib/apt/lists/* \
    && pecl install imagick  \
    && docker-php-ext-enable imagick

COPY --chmod=755 --chown=www-data:www-data "./deploy/build/fpm/conf.d/php.ini" "$PHP_INI_DIR/php.ini"
COPY --chmod=755 --chown=www-data:www-data "./deploy/build/fpm/conf.d/www.conf" "/usr/local/etc/php-fpm.d/www.conf"
COPY --chmod=755 --chown=www-data:www-data "./deploy/build/fpm/nginx/default.conf" "/etc/nginx/conf.d/default.conf"
COPY --chmod=755 --chown=www-data:www-data "./deploy/build/fpm/nginx/nginx.conf" "/etc/nginx/nginx.conf"
COPY --chmod=755 --chown=www-data:www-data "./deploy/build/fpm/entrypoint.sh" "/entrypoint.sh"
COPY --chmod=755 --chown=www-data:www-data "./deploy/build/fpm/docker-entrypoint.d/*" "/docker-entrypoint.d/"

RUN touch /var/run/nginx.pid  \
    && mkdir -p /var/cache/nginx  \
    && chown -R www-data:www-data /var/lib/nginx  \
    /etc/nginx/nginx.conf  \
    /var/cache/nginx \
    /var/run/nginx.pid \
    /entrypoint.sh \
    /docker-entrypoint.d

WORKDIR /var/www

FROM base AS deploy

COPY --chmod=755 --chown=www-data:www-data composer.* package*.json ./

RUN composer install --no-interaction --no-scripts --no-autoloader

COPY --chmod=755 --chown=www-data:www-data . .

RUN composer dump-autoload --optimize && composer run-script post-autoload-dump

RUN chown -R www-data:www-data /var/www && \
    chmod -R 755 /var/www && \
    chmod -R 777 /var/www/bootstrap/cache /var/www/storage

VOLUME ["/var/www/storage"]

EXPOSE 80

USER www-data

ENTRYPOINT ["/entrypoint.sh"]

FROM base AS local

ARG xdebug_enabled

# Install XDebug only in local development mode
COPY --chmod=755 --chown=www-data:www-data "./deploy/build/fpm/conf.d/xdebug.ini" "/tmp/conf.d/xdebug.ini"
RUN if [ "$xdebug_enabled" = "true" ]; then \
        cp /tmp/conf.d/xdebug.ini $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini && \
        pecl install xdebug && \
        docker-php-ext-enable xdebug; \
    fi

EXPOSE 80

VOLUME ["/var/www"]

USER www-data

ENTRYPOINT ["/entrypoint.sh"]
