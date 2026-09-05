<?php
require_once 'models/Database.php';
$database = new Database();
$conexao = $database->connect();

if($conexao){
    echo("DEU BOM");
}
?>