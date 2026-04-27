<?php
// include 'php/conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produto</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <?php
    include 'cabecalho.php';
    ?>
    <main id="main-cadastro">
        <h1 class="text-center">Cadastre o seu Produto</h1>
        <form action="../api/cadastrar_produto.php" method="POST" id="form-cadastro">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required>

            <label for="marca">Marca:</label>
            <input type="text" name="marca" id="marca" required>
            <div id="preco-quantidade">
                <label for="preco">Preço:</label>
                <input type="number" name="preco" id="preco" step="0.01" min="0" required>
                <label for="quantidade">Quantidade:</label>
                <input type="number" name="quantidade" id="quantidade" step="1" min="0" required>
            </div>

            <label for="descricao">Descrição:</label>
            <textarea name="descricao" id="descricao" cols="30" rows="10"></textarea>
            <button type="submit">Cadastrar</button>
        </form>
    </main>
    <?php
    include 'rodape.php';
    ?>
</body>

</html>