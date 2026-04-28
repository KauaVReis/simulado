<?php
// Inicia a sessão e inclui a conexão
session_start();
include("../api/conexao.php");

// Proteção da página: apenas usuários logados podem acessar
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
    <title>Listagem de Usuários</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <?php
    include 'cabecalho.php';
    ?>
    <main class="main-listagem">
        <div class="header-listagem">
            <h1 class="text-center">Listagem de Usuários</h1>
            <a href="cadastro_usuario.php"><button class="btn-novo" style="padding: 10px; font-size: 1rem;">Novo
                    Usuário</button></a>
        </div>
        <table class="tabela-dados">
            <thead>
                <tr>
                    <th>Nome Usuário</th>
                    <th>Email</th>
                    <th>Nível Usuário</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Consulta todos os usuários cadastrados
                $sql = "SELECT nome_usuario, email_usuario, nivel_usuario from usuario";
                $result = $conn->query($sql);
                
                // Exibe cada usuário na tabela
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["nome_usuario"] . "</td>";
                    echo "<td>" . $row["email_usuario"] . "</td>";
                    // Exibe o nível (1 para admin, 2 para usuário)
                    $nivelTxt = ($row["nivel_usuario"] == 1) ? "Administrador" : "Usuário Comum";
                    echo "<td>" . $nivelTxt . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
    <?php include 'rodape.php'; ?>
</body>

</html>