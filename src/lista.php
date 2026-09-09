<?php
require_once 'models/Database.php';
require_once 'models/Produtos.php';

$produtos = new Produtos();
$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';
    $id = (int) ($_POST['id'] ?? 0);

    if ($id > 0 && $acao === 'excluir') {
        $produtos->deleteProduto($id);
        header('Location: lista.php');
        exit;
    }

    if ($id > 0 && $acao === 'atualizar') {
        $valorUnitario = (float) ($_POST['valor_unitario'] ?? 0);

        if ($valorUnitario <= 0) {
            $mensagem = 'O valor unitário deve ser maior que zero.';
        } else {
            $produtos->updateProduto(
                $id,
                $_POST['nome'] ?? '',
                $_POST['marca'] ?? '',
                (int) ($_POST['quantidade'] ?? 0),
                $valorUnitario 
            );
            header('Location: lista.php');
            exit;
        }
    }
}

$listaProdutos = $produtos->listProduto();
$produtoEmEdicao = null;

if (isset($_GET['editar'])) {
    $idEmEdicao = (int) $_GET['editar'];
    foreach ($listaProdutos as $produto) {
        if ((int) $produto['id'] === $idEmEdicao) {
            $produtoEmEdicao = $produto;
            break;
        }
    }
}


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
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listaProdutos as $produto): ?>
                        <tr>
                            <?php if ($produtoEmEdicao && $produtoEmEdicao['id'] == $produto['id']): ?>
                                <form method="POST">
                                    <input type="hidden" name="acao" value="atualizar">
                                    <input type="hidden" name="id" value="<?= (int) $produto['id'] ?>">
                                    <td><?= (int) $produto['id'] ?></td>
                                    <td><input class="form-control" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required></td>
                                    <td><input class="form-control" name="marca" value="<?= htmlspecialchars($produto['marca']) ?>" required></td>
                                    <td><input class="form-control" type="number" name="quantidade" value="<?= (int) $produto['quantidade'] ?>" required></td>
                                    <td><input class="form-control" type="number" min="0.01" step="0.01" name="valor_unitario" value="<?= htmlspecialchars($produto['valor_unitario']) ?>" required></td>
                                    <td>
                                        <button type="submit" class="btn btn-success">Salvar</button>
                                        <a href="lista.php" class="btn btn-secondary">Cancelar</a>
                                    </td>
                                </form>
                            <?php else: ?>
                            <td><?= (int) $produto['id'] ?></td>
                            <td><?= htmlspecialchars($produto['nome']) ?></td>
                            <td><?= htmlspecialchars($produto['marca']) ?></td>
                            <td><?= (int) $produto['quantidade'] ?></td>
                            <td><?= htmlspecialchars($produto['valor_unitario']) ?></td>
                            <td>
                                <a href="lista.php?editar=<?= (int) $produto['id'] ?>" class="btn btn-warning">Editar</a>
                                <form method="POST" style="display: inline;" onsubmit="return confirm('Deseja excluir este produto?');">
                                    <input type="hidden" name="acao" value="excluir">
                                    <input type="hidden" name="id" value="<?= (int) $produto['id'] ?>">
                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                </form>
                            </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        <button onclick="window.location.href='index.php'" type="button" class="btn btn-secondary">Voltar</button>

    </div>
</body>
</html>