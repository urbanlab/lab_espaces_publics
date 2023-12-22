FROM composer:2.0 as vendor

WORKDIR /app

COPY ./bedrock ./bedrock

WORKDIR /app/bedrock

RUN composer update

WORKDIR /app/bedrock/web/app/themes/labeps-theme

RUN composer install

FROM node:lts as node 

WORKDIR /app

COPY --from=vendor /app/bedrock/ ./bedrock

WORKDIR /app/bedrock/web/app/themes/labeps-theme

RUN yarn install

RUN yarn build

RUN rm -r node_modules


FROM php:8.0-apache

# install php extensions mysqli PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN a2enmod rewrite

# copy vhost config apache/vhost.conf
COPY ./apache/vhost.conf /etc/apache2/sites-available/000-default.conf

# copy bedrock files from node
COPY --from=node /app/bedrock /var/www/html/bedrock

RUN chown -R www-data:www-data /var/www/html/

# install wp-cli
RUN apt-get update && apt-get install less
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
RUN chmod +x wp-cli.phar
RUN mv wp-cli.phar /usr/local/bin/wp

ENTRYPOINT [ "apache2-foreground" ]