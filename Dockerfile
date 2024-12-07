FROM php:8.1-cli

# Instalar extensiones necesarias para PHP
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    npm \
    && docker-php-ext-install pdo_mysql

# Instalar Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar PHPUnit, PHPStan y HTMLHint
RUN composer global require phpunit/phpunit phpstan/phpstan
RUN npm install -g htmlhint

# Añadir Composer al PATH
ENV PATH="/root/.composer/vendor/bin:${PATH}"

# Establecer el directorio de trabajo en el contenedor
WORKDIR /app
