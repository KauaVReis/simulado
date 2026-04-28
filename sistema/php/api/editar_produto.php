<?php
// Inicia a sessão e inclui a conexão
session_start();
include("conexao.php");

// Captura a data/hora e o ID do usuário logado
$data_hora = date("Y-m-d H:i:s");
$id_usuario = $_SESSION["id_usuario"];

// Recebe os dados editados do formulário via POST
$id_produto = $_POST["id_produto"];
$nome_produto = $_POST["nome_edit"];
$marca_produto = $_POST["marca_edit"];
$preco_produto = $_POST["preco_edit"];
$quantidade_produto = $_POST["quantidade_edit"];
$descricao_produto = $_POST["descricao_edit"];
$min_qtd_produto = $_POST["min_qtd_edit"];

// Verifica se o produto realmente existe no banco antes de atualizar
$sql = "SELECT * FROM produtos WHERE id_produto = '$id_produto'";
$result = $conn->query($sql);

if ($result && $result->num_rows == 0) {
    // Alerta caso o produto não seja encontrado
    echo "<script>alert('Produto Não Encontrado'); window.location.href = '../components/listar_produtos.php';</script>";
    exit();
} else {
    // Executa o comando UPDATE para atualizar os dados do produto
    $sql = "UPDATE produtos SET 
        nome_produto = '$nome_produto',
        marca_produto = '$marca_produto',
        preco_produto = '$preco_produto',
        qtd_produto = '$quantidade_produto',
        descricao_produto = '$descricao_produto',
        min_qtd_produto = '$min_qtd_produto' 
    WHERE id_produto = $id_produto";
    $result = $conn->query($sql);
    
    // Alerta de sucesso e redirecionamento para a listagem
    echo "<script>alert('Produto Editado com Sucesso'); window.location.href = '../components/listar_produtos.php';</script>";
    exit();
}
?>