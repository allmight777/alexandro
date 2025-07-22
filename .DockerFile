FROM php:8.2-fpm

WORKDIR /var/www

# Installer les dépendances système nécessaires
RUN apt-get update && apt-get install -y \
    zip unzip curl git libxml2-dev libzip-dev libpng-dev libjpeg-dev libonig-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier les fichiers du projet et assigner les bons droits
COPY . /var/www
COPY --chown=www-data:www-data . /var/www

RUN chmod -R 755 /var/www

# Installer les dépendances PHP via Composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Générer la clé d'application
COPY .env.example .env
RUN php artisan key:generate

# Exposer le port 8000
EXPOSE 8000

# Commande de démarrage du conteneur
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
