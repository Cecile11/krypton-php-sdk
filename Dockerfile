FROM php:7.1.1-apache

# install unzip
RUN apt-get update && apt-get install -y \
    unzip

# install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');"