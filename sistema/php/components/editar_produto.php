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

// Recupera o ID do produto via GET e busca os dados atuais no banco
$id_produto = $_GET["id_produto"];
$sql = "SELECT * FROM produtos WHERE id_produto = $id_produto";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Armazena os dados em variáveis para preencher o formulário
$nome_produto = $row["nome_produto"];
$marca_produto = $row["marca_produto"];
$preco_produto = $row["preco_produto"];
$quantidade_produto = $row["qtd_produto"];
$min_qtd_produto = $row["min_qtd_produto"];
$descricao_produto = $row["descricao_produto"];
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
        <h1 class="text-center">Edite o seu Produto</h1>
        <!-- Formulário para editar dados do produto existente -->
        <form action="../api/editar_produto.php" method="POST" class="form-padrao">
            <input type="hidden" name="id_produto" id="id_produto" value="<?php echo $id_produto; ?>">
            
            <label for="nome_edit">Nome:</label>
            <input type="text" name="nome_edit" id="nome_edit" required value="<?php echo $nome_produto; ?>">

            <label for="marca_edit">Marca:</label>
            <input type="text" name="marca_edit" id="marca_edit" required value="<?php echo $marca_produto; ?>">
            
            <div class="container-preco-quantidade">
                <div>
                    <label for="preco_edit">Preço:</label>
                    <input type="number" name="preco_edit" id="preco_edit" step="0.01" min="0" required
                        value="<?php echo $preco_produto; ?>">
                </div>
                <div>
                    <label for="quantidade_edit">Quantidade em Estoque:</label>
                    <input type="number" name="quantidade_edit" id="quantidade_edit" step="1" min="0" required
                        value="<?php echo $quantidade_produto; ?>">
                </div>
            </div>
            
            <label for="min_qtd_edit">Quantidade Mínima para Alerta:</label>
            <input type="number" name="min_qtd_edit" id="min_qtd_edit" step="1" min="0" required
                value="<?php echo $min_qtd_produto; ?>">
            
            <label for="descricao_edit">Descrição do Produto:</label>
            <textarea name="descricao_edit" id="descricao_edit" cols="30"
                rows="5"><?php echo $descricao_produto; ?></textarea>

            <div class="container-botoes-form">
                <button type="submit"
                    style="background-color: green; color: white; cursor: pointer; width: 49.5%;">Salvar Alterações</button>
                <button type="button" onclick="window.location.href='listar_produtos.php'"
                    style="background-color: red; color: white; cursor: pointer; width: 49.5%;">Cancelar</button>
            </div>
        </form>
    </main>
</body>

</html>