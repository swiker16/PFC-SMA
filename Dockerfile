# Usa una imagen base de PHP con Apache
FROM php:8.2-apache

# Instala extensiones PHP necesarias para phpMyAdmin
RUN docker-php-ext-install mysqli pdo_mysql

# Exponer el puerto 80 para Apache
EXPOSE 80
