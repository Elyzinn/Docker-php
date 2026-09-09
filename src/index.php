<?php 
require_once 'models/Database.php';
require_once 'models/Produtos.php';

$mensagem = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nome       = $_POST['nome'] ?? '';
    $marca      = $_POST['marca'] ?? '';
    $quantidade = (int) ($_POST['quantidade'] ?? 0);
    $valorUnitario = (float) ($_POST['valor_unitario'] ?? 0);

    if ($valorUnitario <= 0) {
        $mensagem = 'O valor unitário deve ser maior que zero.';
    } else {
        $produto = new Produtos();
        $produto->addProduto($nome, $marca, $quantidade, $valorUnitario);
        $mensagem = 'Produto adicionado com sucesso';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAGINÁ ADD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body class="bg-light" style="background-color: #F5F5F5;" >

    <?php if($mensagem): ?>
        <script>alert(<?=json_encode($mensagem);?>)</script>
    <?php endif;?>

    <div class="container mt-5"
        style="height: 600px; display: flex; justify-content: center; align-items: center; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color: #fff; padding: 20px;">
        <form action="" method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>

            <div class="mb-3">
                <label for="marca" class="form-label">Marca:</label>
                <input type="text" class="form-control" id="marca" name="marca" required>
            </div>

            <div class="mb-3">
                <label for="quantidade" class="form-label">Quantidade:</label>
                <input type="number" class="form-control" id="quantidade" name="quantidade" min="1" required>
            </div>

            <div class="mb-3">
                <label for="valor_unitario" class="form-label">Valor Unitário:</label>
                <input type="number" class="form-control" id="valor_unitario" name="valor_unitario" min="0.01" step="0.01" required>
            </div>

            <button type="submit" class="btn btn-primary">Enviar</button>
            <button onclick="window.location.href='lista.php'" type="button" class="btn btn-secondary">Lista de Produtos</button>
        </form>
    </div>
</body>
</html>