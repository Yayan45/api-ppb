FROM php:8.2-apache

# Install mysqli
RUN docker-php-ext-install mysqli

# Enable Apache rewrite
RUN a2enmod rewrite

# Copy API files (isi folder api)
COPY api/ /var/www/html/

# Permission
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 777 /var/www/html/bukti \
    && chmod -R 777 /var/www/html/gambar

WORKDIR /var/www/html
