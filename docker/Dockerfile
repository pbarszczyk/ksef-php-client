FROM php:8.4-cli

# Instalacja pakietów
RUN apt-get update && apt-get install -y --force-yes \
    libzip-dev \
    libgmp-dev \
   && rm -rf /var/lib/apt/lists/* \
   && rm -fr /var/cache/apt/archives/*

# Instalacja Composera
RUN set -xe \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalacja modułów PHP
RUN pecl install xdebug && docker-php-ext-install -j$(nproc) bcmath gmp zip

# Dodanie użytkownika wykorzystywanego do budowania aplikacji
# Utworzenie folderów wykorzystywanych jako cache npm i composer oraz nadanie im praw dla użytkownika
RUN useradd ksef \
    && mkdir -p /home/ksef/.composer
