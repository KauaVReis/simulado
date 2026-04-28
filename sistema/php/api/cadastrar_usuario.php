<?php
// Inicia a sessão
session_start();
// Inclui o arquivo de conexão
include("conexao.php");

// Recebe os dados do formulário de cadastro
$usuario = $_POST["cad_usuario"];
$email = $_POST["cad_email"];
// Define uma senha padrão para novos usuários
$senha = "senaisp";

// Gera um hash seguro da senha
$hashsenha = password_hash($senha, PASSWORD_DEFAULT);

// Verifica se o e-mail informado já está cadastrado no banco
$sql = "SELECT * FROM usuario WHERE email_usuario = '$email'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    // Caso o e-mail já exista, exibe alerta e retorna para a página de cadastro
    echo "<script>alert('Email ja cadastrado'); window.location.href = '../components/cadastro_usuario.php';</script>";
    exit();
} else {
    // Insere o novo usuário no banco com o nível padrão 2 (usuário comum)
    $sql = "INSERT INTO usuario (nome_usuario, email_usuario, senha_usuario, nivel_usuario) 
        VALUES ('$usuario', '$email', '$hashsenha', '2')";
    $result = $conn->query($sql);
    
    // Confirma o sucesso do cadastro
    echo "<script>alert('Usuario Cadastrado com Sucesso'); window.location.href = '../components/cadastro_usuario.php';</script>";
    exit();
}
?>