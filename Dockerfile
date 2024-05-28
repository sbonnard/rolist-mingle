FROM php:8.2-apache

# Activer l'extension PDO MySQL
RUN docker-php-ext-install pdo_mysql

# Installer Xdebug
RUN pecl install xdebug

# Copier le fichier de configuration Xdebug dans le conteneur
COPY xdebug.ini /usr/local/etc/php/conf.d/

# Activer le module Xdebug dans la configuration PHP
RUN echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini