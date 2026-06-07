# imagen de dockerhub que descargará
# initial example
# FROM php:7.3-fpm-alpine
FROM php:8.4-fpm

# algunas configuraciones para que funcione el contenedor
RUN docker-php-ext-install pdo pdo_mysql
RUN apt-get update && apt-get install -y curl zip unzip git nodejs npm

# instala composer en el contenedor original one
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# da permisos para editar los archivos en esta ruta del container
RUN chown -R www-data:www-data /var/www
RUN chmod 755 /var/www

