FROM php:8.1.6-fpm

RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip \
    libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
    libonig-dev libxml2-dev \
    autoconf gcc make pkg-config libssl-dev libc-dev bash

# Extract the PHP source
RUN docker-php-source extract

# Install PHP extensions (tokenizer)
RUN docker-php-ext-install zip pdo_mysql mbstring xml

# Clean up
RUN docker-php-source delete \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Copy Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh
WORKDIR /var/www/html
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]