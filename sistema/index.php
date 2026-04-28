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
            <!-- Formulário de Login -->
            <form action="php/api/login.php" method="post" id="form-login">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required placeholder="Digite seu e-mail">

                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" required placeholder="Digite sua senha">
                
                <div class="container-botoes-form">
                    <button type="submit" style="background-color:green; color:white">Entrar</button>
                    <button type="reset" style="background-color:red; color:white">Limpar</button>
                </div>
            </form>
        </section>
    </main>
    <script src="js/script.js"></script>
</body>

</html>