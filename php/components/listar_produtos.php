<?php
// include 'php/conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Produtos</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <?php
    include 'cabecalho.php';
    ?>
    <main id="listar-produtos">
        <div id="div-produto">
            <h1 class="text-center">Listagem de Produtos</h1>
            <a href="cadastro_produto.php"><button id="btn-novo" style="padding: 10px; font-size: 1rem;">Novo
                    Produto</button></a>
        </div>
        <table id="tabela">
            <thead>
                <tr>
                    <th style="width: 25%;">Ações</th>
                    <th style="width: 25%;">Nome</th>
                    <th style="width: 20%;">Marca</th>
                    <th style="width: 10%;">Preço</th>
                    <th style="width: 10%;">Quantidade</th>
                    <th style="width: 20%;">Descrição</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><button id="btn-editar">Editar</button>
                        <button id="btn-excluir">Excluir</button>
                        <button id="btn-movimentar">Movimentar</button>
                    </td>
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