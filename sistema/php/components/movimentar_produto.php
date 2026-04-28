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

// Recupera o ID do produto via GET e busca os dados atuais
$id_produto = $_GET["id_produto"];
$sql = "SELECT * FROM produtos WHERE id_produto = $id_produto";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Armazena dados do produto
$nome_produto = $row["nome_produto"];
$marca_produto = $row["marca_produto"];
$quantidade_produto = $row["qtd_produto"];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movimentar o produto</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <?php
    include 'cabecalho.php';
    ?>
    <main class="main-form-container">
        <h1 class="text-center">Movimente o seu Produto</h1>
        <!-- Formulário para registrar entrada ou saída de estoque -->
        <form action="../api/movimentar_produto.php" method="POST" class="form-padrao">
            <input type="hidden" name="id_produto" id="id_produto" value="<?php echo $id_produto; ?>">
            
            <label for="nome_mov">Produto:</label>
            <input type="text" name="nome_mov" id="nome_mov" required value="<?php echo $nome_produto; ?>" disabled>

            <label for="marca_mov">Marca:</label>
            <input type="text" name="marca_mov" id="marca_mov" required value="<?php echo $marca_produto; ?>" disabled>
            
            <label for="tipo_mov">Tipo da Movimentação:</label>
            <select name="tipo_mov" id="tipo_mov" required>
                <option value="entrada">Entrada (Adicionar ao estoque)</option>
                <option value="saida">Saída (Remover do estoque)</option>
            </select>
            
            <label for="quantidade_mov">Quantidade a movimentar:</label>
            <input type="number" name="quantidade_mov" id="quantidade_mov" step="1" min="1" required placeholder="Ex: 10">
            
            <label for="motivo_movimentacao">Motivo / Descrição da Movimentação:</label>
            <textarea name="motivo_movimentacao" id="motivo_movimentacao" cols="30" rows="5" required placeholder="Ex: Compra de mercadoria, Venda, Perda..."></textarea>

            <div class="container-botoes-form">
                <button type="submit"
                    style="background-color: green; color: white; cursor: pointer; width: 49.5%;">Confirmar Movimentação</button>
                <button type="button" onclick="window.location.href='listar_produtos.php'"
                    style="background-color: red; color: white; cursor: pointer; width: 49.5%;">Cancelar</button>
            </div>
        </form>
    </main>
</body>

</html>