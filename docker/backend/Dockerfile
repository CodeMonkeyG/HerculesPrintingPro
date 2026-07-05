FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    libzip-dev \
    libicu-dev \
    libjpeg-dev \
    libfreetype6-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Configure and install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_pgsql pdo_mysql mbstring exif pcntl bcmath gd intl zip calendar

# Install Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing configuration
COPY php.ini /usr/local/etc/php/conf.d/custom.ini
COPY entrypoint.sh /usr/local/bin/hercules-entrypoint

RUN chmod +x /usr/local/bin/hercules-entrypoint

ENTRYPOINT ["/usr/local/bin/hercules-entrypoint"]

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
