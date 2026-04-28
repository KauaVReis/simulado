<?php
// Inicia a sessão e inclui a conexão
session_start();
include("conexao.php");

// Recebe a nova senha via POST
$senha_nova = $_POST["senha_nova"];
// Identifica o usuário logado pela sessão
$usuario = $_SESSION["usuario"];

// Gera um hash seguro da nova senha
$hashsenha = password_hash($senha_nova, PASSWORD_DEFAULT);

// Atualiza a senha no banco e marca 'senha_padrao' como 1 (senha alterada)
$sql = "UPDATE usuario SET senha_usuario = '$hashsenha', senha_padrao = 1 WHERE nome_usuario = '$usuario'";
$result = $conn->query($sql);

if ($result) {
    // Caso o update funcione, força o logout para o usuário logar com a nova senha
    echo "<script>alert('Senha alterada com sucesso! Faça login novamente.'); window.location.href = 'logout.php';</script>";
    exit();
} else {
    // Alerta de erro
    echo "<script>alert('Erro ao alterar senha'); window.location.href = '../components/reset_senha.php';</script>";
    exit();
}
?>