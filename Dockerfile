FROM php:8.2-apache

# 1. Installation des dépendances système (y compris libicu pour intl)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    libzip-dev \
    unzip \
    git \
    libicu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip intl \
    && docker-php-ext-enable intl

# 2. Installation de Node.js (nécessaire pour Vite)
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# 3. Activation de mod_rewrite
RUN a2enmod rewrite

# 4. Configuration Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

COPY . /var/www/html
WORKDIR /var/www/html

# 5. Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# 6. Compilation des assets (Vite) - C'EST CETTE ÉTAPE QUI MANQUAIT
RUN npm install
RUN npm run build

# 7. Préparation des dossiers et permissions
RUN mkdir -p storage/framework/views storage/framework/cache storage/framework/sessions
RUN touch database/database.sqlite
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# 8. Démarrage (Migrations + Apache)
CMD php artisan migrate --force && apache2-foreground