<?php
// Inicia a sessão e inclui a conexão
session_start();
include("conexao.php");

// Proteção da API: verifica se o usuário está logado
if (isset($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
    $nivel_usuario = $_SESSION["nivel_usuario"];
} else {
    header("Location: ../../index.php");
    exit();
}

// Recebe o ID do produto a ser excluído via GET
$id_produto = $_GET["id_produto"];

// Executa o comando DELETE no banco de dados
$sql = "DELETE FROM produtos WHERE id_produto = $id_produto";
$result = $conn->query($sql);

// Alerta de sucesso e redirecionamento de volta para a lista de produtos
echo "<script>alert('Produto excluído com sucesso'); window.location.href = '../components/listar_produtos.php';</script>";
?>