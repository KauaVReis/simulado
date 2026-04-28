<?php
// Inicia a sessão e inclui a conexão
session_start();
include("../api/conexao.php");

// Proteção: apenas usuários logados podem acessar
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
    <title>Resetar Senha</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <main class="main-form-container espacado">
        <h1 class="text-center">Mude a sua senha</h1>
        <!-- Formulário para troca obrigatória de senha no primeiro acesso -->
        <form action="../api/reset_senha.php" method="POST" class="form-padrao">
            <label for="senha_nova">Nova Senha:</label>
            <input type="password" name="senha_nova" id="senha_nova" required placeholder="Digite sua nova senha">
            
            <button type="submit">Atualizar Senha</button>
        </form>
    </main>
    <?php
    include 'rodape.php';
    ?>
</body>

</html>