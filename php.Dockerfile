# Stage 1 : Construire l'application
FROM php:8.2-fpm as builder

# Installer les dépendances nécessaires pour la construction
RUN apt-get update && \
    apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libzip-dev \
    libicu-dev

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql zip intl opcache
RUN docker-php-ext-configure intl
# Installer APCu
RUN pecl install apcu && docker-php-ext-enable apcu

# Installer Composer globalement
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sS https://get.symfony.com/cli/installer | bash \
    && export PATH="$HOME/.symfony5/bin:$PATH"

# Créer un répertoire de travail pour l'application
WORKDIR /app

# Copier le fichier composer.json et composer.lock pour installer les dépendances
COPY composer.json composer.lock /app/

# Installer les dépendances
RUN composer install --no-scripts --no-autoloader

# Copier le reste des fichiers de l'application
COPY . /app

# Stage 2 : Image finale
FROM php:8.2-fpm

# Copier les fichiers nécessaires à partir du stage 1
COPY --from=builder /usr/local/bin/composer /usr/local/bin/composer
COPY --from=builder /app /var/www/html
