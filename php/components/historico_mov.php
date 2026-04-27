<?php
// include 'php/conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Movimentações</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <?php
    include 'cabecalho.php';
    ?>
    <main id="listar-produtos">
        <div id="div-produto">
            <h1 class="text-center">Histórico de Movimentações</h1>
        </div>
        <table id="tabela">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Nome</th>
                    <th>Tipo de Movimentação</th>
                    <th>Quantidade</th>
                    <th>Usuário</th>
                    <th>Descrição</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2026-04-27</td>
                    <td>Produto 1</td>
                    <td>Marca 1</td>
                    <td>10</td>
                    <td>10</td>
                    <td>Descrição 1</td>
                </tr>
            </tbody>
        </table>
    </main>
</body>

</html>