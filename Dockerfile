# Imagem do DockerHub selecionada
FROM php:8.3-apache 

# Copia toda a raiz do projeto para este caminho de pastas
COPY . /var/www/html

#remover página inicial do apache
RUN a2enmod rewrite

#vai rodar o comando para instalar as depedencias de conexão com banco
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Define que o container vai trabalhar neste caminho de pastas
WORKDIR /var/www/html
