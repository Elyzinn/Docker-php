# TEMA - CRUD (PHP):
 Lista de Produtos - (Simulando Lista de Compras)

# Oque faz o Projeto:
O projeto tem como finalidade o desenvolvimento de um CRUD em PHP, com todo o projeto sendo rodado dentro de containers do Docker.

# Entidade:
A entidade manipulada pela aplicação é **produtos**, representando os itens cadastrados no sistema. Ela é composta pelos seguintes campos no banco de dados:

- **`id`**: Identificador único do produto (Chave Primária, Auto Incremento).
- **`nome`**: Nome do produto (VARCHAR).
- **`quantidade`**: Quantidade disponível do produto em estoque (INT).
- **`marca`**: Marca ou fabricante do produto (VARCHAR).
- **`valor_unitario`**: Preço de venda por unidade do produto (DECIMAL).

## Pré-Requisitos p/ o Projeto:
 - DockerHub ou Docker CLI
 - Docker Compose

## Passo a Passo - Inicialização do Projeto
 1. Clonar o Repositório.
 2. Builde as Imagens com 'docker-compose up -d --build' ou 'docker-compose up -d'
    - Ao iniciar os containers, vai haver sempre uma verificação se a tabela 'produtos' foi inserida dentro do banco, caso ela não esteja inserida, o docker irá espelhar e rodar os comandos SQL do 'db.sql' e criará uma tabela. Caso ja exista ele apenas vai ignorar a criação e vai seguir.
 3. Acesse a aplicação via '127.0.0.1:8080'

## Documentação docker-compose

A orquestração do ambiente utiliza três serviços (`app`, `db` e `phpmyadmin`) conectados por uma rede interna e com persistência de dados.

### 1. Serviços
- **`app` (php)**: Serviço construído a partir do `Dockerfile` local. Ele copia o código fonte da pasta `./src` para `/var/www/html` no container, instala as extensões PDO necessárias para o PHP e expõe a porta `8080` do host para acesso via navegador web.
- **`db` (mysql)**: Utiliza a imagem oficial `mysql:8.4`. Armazena os dados no volume `mysql_data` e executa o script `./db.sql` automaticamente na primeira inicialização para criar a estrutura da tabela `produtos`.
- **`phpmyadmin`**: Interface gráfica web rodando na porta `8081` para gerenciamento visual do banco de dados MySQL.

---

### 2. Variáveis de Ambiente de Conexão
As variáveis de ambiente configuradas no serviço `app` garantem a comunicação direta com o banco de dados sem a necessidade de um arquivo `.env`:

- **`DB_HOST: db`**: Define o hostname do banco de dados utilizando o nome do serviço (`db`), que é resolvido automaticamente pelo DNS interno do Docker.
- **`DB_USER: superUsuario`**: Define o nome de usuário utilizado pela aplicação PHP para se autenticar no banco MySQL.
- **`DB_PASSWORD: simplicidade1`**: Define a senha de acesso utilizada pela aplicação para conectar ao MySQL.
- **`DB_NAME: crudFernando`**: Define o nome do banco de dados que será acessado e manipulado pelas operações do CRUD.

*(Observação: O container `db` possui variáveis correspondentes `MYSQL_USER`, `MYSQL_PASSWORD` e `MYSQL_DATABASE` com esses mesmos valores para garantir o provisionamento correto do banco).*

---

### 3. Rede Personalizada (`bridge_communication`)
- **Rede (`bridge_communication`)**: Foi criada uma rede privada virtual do tipo **`bridge`**. Todos os três containers (`app`, `db` e `phpmyadmin`) estão conectados a essa mesma rede. 
- **Função**: A rede isola o tráfego de dados do ambiente externo e permite a comunicação entre os containers pelo nome do serviço (por exemplo, permitindo que o PHP alcance o MySQL chamando apenas `db` em vez de utilizar endereços IP locais).


 ## Aprendizados/Decisões do Projeto

  Sobre o PHP - Usamos nossas experiências e arquivos de trabalhos feitos anteriormente em PHP, então a estrutura foi bem tranquila e não tivemos problemas quanto a composição do CRUD.

  Sobre o Docker - Tivemos algumas dificuldades em entender como funciona a configuração do docker-compose e como ela se relacionaria com o Dockerfile, mas após algumas pesquisas seja em Documentação oficial, Video-Aulas, ou Lendo e Relendo os códigos Docker passados.
  
  - Uma decisão tomada foi tirar a imagem do PHP do docker-compose e trabalhar ela separadamente com o Dockerfile, com ele deixamos configurações e ações pré-estabelecidas que ao **`Buildar`** as imagens, essas ações ja rodam automaticamente. Entendemos que o Dockerfile, funciona quando você quer fazer uma personalização em uma Imagem.
    - Como por exemplo deixar o comando para instalar as dependencias 'docker-php-ext-install mysqli pdo pdo_mysql' ser gerenciado pelo Dockerfile.
  
  - No serviço `db` (MySQL):
    - **Criação Automática**: Mapeamos o arquivo `./db.sql` local para o diretório interno `/docker-entrypoint-initdb.d/db.sql` do container. O MySQL executa automaticamente todos os scripts dessa pasta durante a primeira inicialização, criando o banco `crudFernando` e a tabela `produtos` sem intervenção manual.
    - **Persistência**: Utilizamos o volume nomeado `mysql_data:/var/lib/mysql` para garantir que os registros cadastrados, alterados ou excluídos no CRUD não fossem perdidos ao derrubar ou reiniciar os containers (`docker-compose down`).
  
  - Mapeamos o diretório local `./src` para o diretório web do container `/var/www/html` (`./src:/var/www/html`). Isso permitiu atualizar e testar o código PHP em tempo real no navegador sem a necessidade de rebuiltar a imagem do Docker a cada modificação feita no projeto

 ## Desenvolvedores

 - Elienay Henrique da Silva Souza - R.A: 250283
 - Lucas Mateus Galdino - R.A: 250272

