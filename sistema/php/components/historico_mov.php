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
    <title>Histórico de Movimentações</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <?php
    include 'cabecalho.php';
    ?>
    <main class="main-listagem">
        <div class="header-listagem">
            <h1 class="text-center">Histórico de Movimentações</h1>
        </div>
        <table class="tabela-dados">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Nome Produto</th>
                    <th>Tipo de Movimentação</th>
                    <th>Quantidade</th>
                    <th>Usuário</th>
                    <th>Descrição</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Consulta SQL para buscar o histórico de movimentações unindo com as tabelas de produtos e usuários
                $sql = "SELECT 
                    mov_produto.data_movimentacao,
                    produtos.nome_produto,
                    mov_produto.tipo_movimentacao,
                    mov_produto.quantidade_mov,
                    usuario.nome_usuario,
                    mov_produto.desc_movimentacao
                FROM
                    mov_produto
                INNER JOIN produtos ON produtos.id_produto = mov_produto.fk_produto
                INNER JOIN usuario ON mov_produto.fk_responsavel = usuario.id_usuario
                ORDER BY mov_produto.data_movimentacao DESC"; // Ordena pelas mais recentes primeiro
                
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    // Formata a data para o padrão brasileiro
                    $dataFormatada = date('d/m/Y H:i', strtotime($row["data_movimentacao"]));
                    echo "<td>" . $dataFormatada . "</td>";
                    echo "<td>" . $row["nome_produto"] . "</td>";
                    echo "<td>" . $row["tipo_movimentacao"] . "</td>";
                    echo "<td>" . $row["quantidade_mov"] . "</td>";
                    echo "<td>" . $row["nome_usuario"] . "</td>";
                    echo "<td>" . $row["desc_movimentacao"] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
    <?php include 'rodape.php'; ?>
</body>

</html>