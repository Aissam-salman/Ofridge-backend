# Utiliser une image Symfony officielle basée sur PHP
FROM php:8.2-fpm

# Installer les dépendances nécessaires pour Symfony
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libicu-dev

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql zip intl opcache

# Installer Composer globalement
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Créer un répertoire de travail pour l'application
WORKDIR /app

# Copier les fichiers nécessaires
COPY . /app

# Installer les dépendances Symfony
RUN composer install --no-scripts --no-autoloader --no-suggest && \
    composer clear-cache

# Exposer le port 9000 (par défaut pour PHP-FPM)
EXPOSE 9000

# Commande par défaut pour le conteneur
CMD ["php-fpm"]
