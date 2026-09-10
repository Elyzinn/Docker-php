# TEMA - CRUD (PHP):
 Lista de Produtos

## Descrição do Projeto:

# Oque faz:
O projeto tem como finalidade o desenvolvimento de um CRUD em PHP, com todo o projeto sendo rodado dentro de containers do Docker.
# Entidade:
A Entidade escolhida ...

## Pré-Requisitos p/ o Projeto:
 - DockerHub ou Docker CLI
 - Docker Compose

## Passo a Passo - Inicialização do Projeto
 1. Clonar o Repositório.
 2. Builde as Imagens com 'docker-compose up --build'
 3. Suba os Containers com 'docker-compose up -d'
    - Ao iniciar os containers, vai haver sempre uma verificação se a tabela 'produtos' foi inserida dentro do banco, caso ela não esteja inserida, o docker irá espelhar e rodar os comandos SQL do 'db.sql' e criará uma tabela. Caso ja exista ele apenas vai ignorar a criação e vai seguir.
 4. Acesse a aplicação via '127.0.0.1:8080'

 ## Documentação docker-compose
   Para a criação do nosso arquivo docker-compose.yml, usamos 3 serviços, sendo eles:
   1. Serviço do php-apache
   2. Serviço do MySQL
   3. Serviço do phpMyAdmin

   - Para o serviço de php-apache, construimos um arquivo de Dockerfile que ficou responsavel por direcionar a versão da imagem para o compose, tambem utilizamos o comando COPY para copiar todo o nosso diretóorio para  a raiz do projeto no caminho de pastas desejado, o comando RUN foi usado para fazer a instalação do drive para as dependências de conexão com o banco de dados(PDO).Esse Container faz a interpretação dos arquivos PHP para o nosso acesso WEB.

   - O container de MySQL foi contruido com uam imagem direta do Docker Hub, e é responsável por armazenar todos os nossos dados de cadastro de produtos. Nossos volumes ficam responsaveis por salvar todas as informações fundamentais para o funcionamento do nosso DB.

   - O container de phpMyAdmin é uma imagem tirada do Docker Hub que nos fornece o acesso ao Painel Administrador do banco de dados.


 ## Aprendizados/Decisões do Projeto

 ...

 ## Desenvolvedores

 - Elienay Henrique da Silva Souza - R.A: 250283
 - Lucas Mateus Galdino - R.A: 250272

