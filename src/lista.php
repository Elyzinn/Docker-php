<?php
require_once 'models/Database.php';
require_once 'models/Produtos.php';

$produtos = new Produtos();
$listaProdutos = $produtos->listProduto();


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAGINA DE LISTAGEM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body class="bg-light" style="background-color: #F5F5F5;" >

    <div class="container mt-5" style="justify-content: center; align-items: center; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color: #fff; padding: 20px;">
        <h1 style="text-align: center">Lista de Produtos</h1>
        <?php if (!empty($mensagem)): ?>
            <p><?= $mensagem ?></p>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Marca</th>
                        <th>Quantidade</th>
                        <th>Valor Unitário</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listaProdutos as $produto): ?>
                        <tr>
                            <td><?= $produto['id'] ?></td>
                            <td><?= $produto['nome'] ?></td>
                            <td><?= $produto['marca'] ?></td>
                            <td><?= $produto['quantidade'] ?></td>
                            <td><?= $produto['valor_unitario'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        <button onclick="window.location.href='index.php'" type="button" class="btn btn-secondary">Voltar</button>
        <button type="submit" class="btn btn-primary" style="background-color: orange;">Atualizar Produto</button>
        <button type="submit" class="btn btn-primary" style="background-color: red;">Deletar Produto</button>
    </div>
</body>
</html>