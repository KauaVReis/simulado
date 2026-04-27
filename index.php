<?php
// include 'php/conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento - Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <main id="main-login">
        <section id="login">
            <form action="php/api/login.php" method="post" id="form-login">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" required>

                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" required>
                <div id="botoes">
                    <button type="submit" style="background-color:green; color:white">Entrar</button>
                    <button type="reset" style="background-color:red; color:white">Limpar</button>
                </div>
            </form>
        </section>
    </main>
    <script src="js/script.js"></script>
</body>

</html>