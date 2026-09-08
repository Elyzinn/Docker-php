<?php 
require_once 'models/Database.php';
require_once 'models/Produtos.php';

$mensagem = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nome       = $_POST['nome'] ?? '';
    $marca      = $_POST['marca'] ?? '';
    $quantidade = (int) ($_POST['quantidade'] ?? 0);
    $valorUnitario = (float) ($_POST['valor_unitario'] ?? 0);

    $produto = new Produtos();
    $produto->addProduto($nome, $marca, $quantidade, $valorUnitario);
    $mensagem = 'Produto adicionado com sucesso';
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAGINÁ ADD</title>
</head>
<body>

    <?php if($mensagem): ?>
        <script>alert(<?=json_encode($mensagem);?>)</script>
    <?php endif;?>

    <form action="" method="POST">
        <label>Nome:</label>
        <input type="text" name="nome" required><br>

        <label>Marca:</label>
        <input type="text" name="marca" required><br>

        <label>Quantidade:</label>
        <input type="number" name="quantidade" required><br>

        <label>Valor Unitário</label>
        <input type="number" step="0.01" name="valor_unitario" required><br>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>