FROM php:7.4-apache

RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git zip unzip zlib1g-dev libzip-dev

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
