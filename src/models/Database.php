<?php

class Database{
    private $host = 'db';
    private $port = '3306';
    private $db = 'crudFernando';
    private $user = 'superUsuario';
    private $pass = 'simplicidade1';
    private $pdo;

    public function connect(){
        if(!$this->pdo){
            try{
                $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->db}";
                $this->pdo = new PDO($dsn, $this->user, $this->pass);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                die("Erro ao conectar-se ao Banco de Dados: " . $e->getMessage());
            }
        }
        return $this->pdo;
    }
}

?>