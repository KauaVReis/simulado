<?php
// Inicia a sessão e inclui a conexão
session_start();
include("../api/conexao.php");

// Proteção da página: redireciona se não houver usuário logado
if (isset($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
    $nivel_usuario = $_SESSION["nivel_usuario"];
} else {
    header("Location: ../../index.php");
    exit();
}
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
    <main class="main-form-container">
        <h1 class="text-center">Cadastre o seu Produto</h1>
        <!-- Formulário de cadastro de novo produto -->
        <form action="../api/cadastrar_produto.php" method="POST" class="form-padrao">
            <label for="nome">Nome:</label>
            <input type="text" name="nome_produto" id="nome" required placeholder="Nome do produto">

            <label for="marca">Marca:</label>
            <input type="text" name="marca_produto" id="marca" required placeholder="Marca do fabricante">
            
            <div class="container-preco-quantidade">
                <div>
                    <label for="preco">Preço:</label>
                    <input type="number" name="preco_produto" id="preco" step="0.01" min="0" required>
                </div>
                <div>
                    <label for="quantidade">Quantidade:</label>
                    <input type="number" name="quantidade_produto" id="quantidade" step="1" min="0" required>
                </div>
            </div>
            
            <label for="min_qtd_produto">Quantidade Mínima (para alertas):</label>
            <input type="number" name="min_qtd_produto" id="min_qtd_produto" step="1" min="0" required>
            
            <label for="descricao">Descrição Detalhada:</label>
            <textarea name="descricao_produto" id="descricao" cols="30" rows="5" placeholder="Detalhes opcionais sobre o produto"></textarea>

            <button type="submit">Cadastrar Produto</button>
        </form>
    </main>
    <?php
    include 'rodape.php';
    ?>
</body>

</html>