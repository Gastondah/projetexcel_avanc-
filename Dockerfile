FROM php:8.2-apache

# Installation des dépendances système nécessaires
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    libzip-dev \
    unzip \
    git \
    nodejs \
    npm \
    libicu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip intl \
    && docker-php-ext-enable intl

# Activation de mod_rewrite pour les URLs Laravel
RUN a2enmod rewrite

# Configuration du dossier public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

COPY . /var/www/html
WORKDIR /var/www/html

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# On installe les dépendances
RUN composer install --no-dev --optimize-autoloader

# On donne les droits aux dossiers de stockage
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

CMD ["apache2-foreground"]