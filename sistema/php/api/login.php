<?php
// Inicia a sessão
session_start();
// Inclui o arquivo de conexão
include("conexao.php");

// Recebe os dados do formulário de login (agora usando e-mail)
$email = $_POST["email"];
$senha = $_POST["senha"];

// Consulta o usuário pelo e-mail informado
$sql = "SELECT * FROM usuario WHERE email_usuario = '$email'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    // Se o usuário existe, verifica a senha
    $row = $result->fetch_assoc();

    // Compara a senha informada com o hash salvo no banco
    if (password_verify($senha, $row["senha_usuario"])) {

        // Armazena dados do usuário na sessão
        $_SESSION["usuario"] = $row["nome_usuario"];
        $_SESSION["id_usuario"] = $row["id_usuario"];
        $_SESSION["nivel_usuario"] = $row["nivel_usuario"];
        $_SESSION["senha_padrao"] = $row["senha_padrao"];

        // Redireciona para a página inicial
        header("Location: ../components/inicio.php");
        exit();

    } else {
        echo "<script>alert('Senha ou Email Invalido'); window.location.href = '../../index.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('Senha ou Email Invalido'); window.location.href = '../../index.php';</script>";
    exit();
}