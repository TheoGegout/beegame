FROM php:8.1-fpm

ENV TZ=Europe/Paris

RUN apt-get update && apt-get install -y git subversion  && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer