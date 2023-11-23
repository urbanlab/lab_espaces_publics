FROM php:8.0-apache

# install php extensions mysqli PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN a2enmod rewrite

# copy vhost config apache/vhost.conf
COPY ./apache/vhost.conf /etc/apache2/sites-available/000-default.conf

COPY ./bedrock /var/www/html/bedrock
RUN chown -R www-data:www-data /var/www/html/

ENTRYPOINT [ "apache2-foreground" ]