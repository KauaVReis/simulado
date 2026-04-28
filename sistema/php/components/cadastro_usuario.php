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
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<style>
    input[readonly] {
        cursor: not-allowed;
        opacity: 0.5;
    }
</style>

<body>
    <?php
    include 'cabecalho.php';
    ?>
    <main class="main-form-container espacado">
        <h1 class="text-center">Cadastro de Usuário</h1>
        <!-- Formulário para cadastrar novos usuários no sistema -->
        <form action="../api/cadastrar_usuario.php" method="POST" class="form-padrao">
            <label for="cad_usuario">Nome Completo:</label>
            <input type="text" name="cad_usuario" id="cad_usuario" required placeholder="Digite o nome do usuário">

            <label for="cad_email">Email:</label>
            <input type="email" name="cad_email" id="cad_email" required placeholder="Digite o e-mail para login">

            <label for="cad_senha">Senha Padrão (será alterada no primeiro acesso):</label>
            <input type="password" name="cad_senha" id="cad_senha" value="senaisp" readonly>

            <button type="submit">Cadastrar Usuário</button>
        </form>
    </main>
    <?php
    include 'rodape.php';
    ?>
</body>

</html>