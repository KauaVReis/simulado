<?php
// Inicia a sessão e inclui a conexão
session_start();
include("conexao.php");

// Captura a data e hora atual e o ID do usuário logado
$data_hora = date("Y-m-d H:i:s");
$id_usuario = $_SESSION["id_usuario"];

// Recebe os dados enviados via POST pelo formulário
$nome_produto = $_POST["nome_produto"];
$marca_produto = $_POST["marca_produto"];
$preco_produto = $_POST["preco_produto"];
$quantidade_produto = $_POST["quantidade_produto"];
$descricao_produto = $_POST["descricao_produto"];
$min_qtd_produto = $_POST["min_qtd_produto"];

// Verifica se já existe um produto com o mesmo nome para evitar duplicidade
$sql = "SELECT * FROM produtos WHERE nome_produto = '$nome_produto'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    // Alerta caso o produto já esteja cadastrado
    echo "<script>alert('Produto ja cadastrado'); window.location.href = '../components/cadastro_produto.php';</script>";
    exit();
} else {
    // Insere os dados do novo produto no banco de dados
    $sql = "INSERT INTO produtos (nome_produto, marca_produto, preco_produto, qtd_produto, descricao_produto, fk_responsavel_cadastro, data_cadastro, min_qtd_produto) 
        VALUES ('$nome_produto', '$marca_produto', '$preco_produto', '$quantidade_produto', '$descricao_produto', '$id_usuario', '$data_hora', '$min_qtd_produto')";
    $result = $conn->query($sql);
    
    // Alerta de sucesso e redirecionamento para a lista de produtos
    echo "<script>alert('Produto Cadastrado com Sucesso'); window.location.href = '../components/listar_produtos.php';</script>";
    exit();
}
?>