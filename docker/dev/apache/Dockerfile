FROM php:8.3-apache

# install php extensions mysqli PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libxpm-dev \
    zlib1g-dev && \
    docker-php-ext-configure gd --enable-gd --with-webp --with-jpeg \
    --with-xpm --with-freetype && \
    docker-php-ext-install -j$(nproc) gd && \
    rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite

COPY docker/dev/apache/vhost.conf /etc/apache2/sites-available/000-default.conf

# install wp-cli
RUN apt-get update && apt-get install less
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
RUN chmod +x wp-cli.phar
RUN mv wp-cli.phar /usr/local/bin/wp

# Set upload file size limit to 100MB
RUN echo "upload_max_filesize = 100M" > /usr/local/etc/php/conf.d/uploads.ini
RUN echo "post_max_size = 100M" >> /usr/local/etc/php/conf.d/uploads.ini

ENTRYPOINT [ "apache2-foreground" ]
