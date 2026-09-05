<?php
require_once 'Database.php';

class Produtos{
    private $db;

    public function __construct(){
    $this->db = (new Database())-> connect();
    }

    public function addProduto($nome, $marca, $quantidade, $valor_unitario){
        $sql = "INSERT INTO produtos (nome, marca, quantidade, valor_unitario) VALUES (:nome,:marca,:quantidade,:valor_unitario)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'nome' => $nome,
            'marca' => $marca,
            'quantidade' => $quantidade,
            'valor_unitario' => $valor_unitario
        ]);
    }

    public function listProduto(){
        $sql = "SELECT id, nome, marca, quantidade, valor_unitario FROM produtos";
        $stmt = $this->db->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProduto($id, $nome, $marca, $quantidade, $valor_unitario){
        $sql = "UPDATE produtos SET nome = :nome, marca = :marca, quantidade = :quantidade, valor_unitario = :valor_unitario WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'nome' => $nome,
            'marca' => $marca,
            'quantidade' => $quantidade,
            'valor_unitario' => $valor_unitario
        ]);
    }

    public function deleteProduto($id){
        $sql = "DELETE FROM produtos WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);
    }
}


?>