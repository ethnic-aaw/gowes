FROM php:8.2-apache
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libwebp-dev libfreetype6-dev \
  && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
  && docker-php-ext-install pdo_mysql gd \
  && a2enmod rewrite \
  && rm -rf /var/lib/apt/lists/*
COPY . /var/www/html/
# Apache: allow .htaccess, DocumentRoot tetap /var/www/html
RUN chown -R www-data:www-data /var/www/html/uploads 2>/dev/null || mkdir -p /var/www/html/uploads && chown -R www-data:www-data /var/www/html/uploads \
  && echo '<Directory /var/www/html>\nAllowOverride All\nRequire all granted\n</Directory>' > /etc/apache2/conf-available/gowes.conf \
  && a2enconf gowes
EXPOSE 80
