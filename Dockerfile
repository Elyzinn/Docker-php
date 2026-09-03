FROM php:8.3-apache

COPY . /var/www/html

#remover página inicial do apache
RUN a2enmod rewrite

#vai rodar o comando para instalar as depedencias de conexão com banco
RUN docker-php-ext-install mysqli pdo pdo_mysql

WORKDIR /var/www/html
