<?php
// Inicia a sessão para controle de acesso
session_start();
// Inclui o arquivo de conexão com o banco de dados
include("../api/conexao.php");

// Verifica se o usuário está logado
if (isset($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
    $nivel_usuario = $_SESSION["nivel_usuario"];
} else {
    // Caso não esteja logado, redireciona para a página de login
    header("Location: ../../index.php");
    exit();
}
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
    <main class="main-listagem">
        <!-- Barra de busca de produtos -->
        <div class="buscar-item">
            <input type="text" class="input-text" id="input_buscar_produto" placeholder="Buscar Produto">
            <button class="btn-buscar" onclick="buscarProduto()">Buscar</button>
        </div>
        <div class="header-listagem">
            <h1 class="text-center">Listagem de Produtos</h1>
            <a href="cadastro_produto.php"><button class="btn-novo" style="padding: 10px; font-size: 1rem;">Novo
                    Produto</button></a>
        </div>
        <table class="tabela-dados">
            <thead>
                <tr>
                    <th style="width: 25%;">Ações</th>
                    <th style="width: 20%;">Nome</th>
                    <th style="width: 10%;">Marca</th>
                    <th style="width: 10%;">Preço</th>
                    <th style="width: 20%;">Quantidade</th>
                    <th style="width: 20%;">Quantidade Minima</th>
                    <th style="width: 25%;">Descrição Produto</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php

                    // Filtro para produtos com estoque baixo
                    $condicao = "";
                    if (isset($_GET["produto"])) {
                        $condicao = "AND qtd_produto < min_qtd_produto";
                    }

                    // Filtro para busca por nome, marca ou descrição
                    $condicao2 = "";
                    if (isset($_GET["itemProduto"])) {
                        $condicao2 = "AND (nome_produto LIKE '%" . $_GET["itemProduto"] . "%' OR marca_produto LIKE '%" . $_GET["itemProduto"] . "%' OR descricao_produto LIKE '%" . $_GET["itemProduto"] . "%')";
                    }
                    
                    // Monta e executa a consulta SQL com os filtros aplicados
                    $sql = "SELECT * FROM produtos where 1=1 $condicao $condicao2 order by nome_produto asc";
                    $result = $conn->query($sql);

                    // Loop para exibir cada produto na tabela
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>";
                        // Botão de exclusão com confirmação via JavaScript
                        echo "<a class='' 
                            onclick=\"return confirm('Tem certeza que deseja excluir este produto?');\" 
                            href='../api/excluir_produto.php?id_produto=" . $row["id_produto"] . "'>
                            <button class='btn-excluir'>Excluir</button>
                        </a>";
                        // Botões de edição e movimentação de estoque
                        echo "<a href='editar_produto.php?id_produto=" . $row["id_produto"] . "'><button class='btn-editar'>Editar</button></a>
                        <a href='movimentar_produto.php?id_produto=" . $row["id_produto"] . "'><button class='btn-movimentar'>Movimentar</button></a></td>";
                        
                        // Exibição dos dados do produto
                        echo "<td>" . $row["nome_produto"] . "</td>";
                        echo "<td>" . $row["marca_produto"] . "</td>";
                        echo "<td>" . $row["preco_produto"] . "</td>";
                        echo "<td>" . $row["qtd_produto"] . "</td>";
                        echo "<td>" . $row["min_qtd_produto"] . "</td>";
                        echo "<td>" . $row["descricao_produto"] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tr>
            </tbody>
        </table>
    </main>
    <script src="../../js/script.js"></script>
    <?php include 'rodape.php'; ?>
</body>

</html>