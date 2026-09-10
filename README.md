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
 ...

 ## Aprendizados/Decisões do Projeto

 ...

 ## Desenvolvedores

 - Elienay Henrique da Silva Souza - R.A: 250283
 - Lucas Galdino - R.A: ...

