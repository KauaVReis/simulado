<?php
// Inicia a sessão e inclui a conexão
session_start();
include("conexao.php");

// Recebe os dados da movimentação via POST
$id_produto = $_POST["id_produto"];
$tipo_mov = $_POST["tipo_mov"]; // 'entrada' ou 'saida'
$quantidade_mov = $_POST["quantidade_mov"];
$motivo_movimentacao = $_POST["motivo_movimentacao"];

// Captura data atual e ID do usuário responsável
$data_hora = date("Y-m-d H:i:s");
$id_usuario = $_SESSION["id_usuario"];

// Busca o produto no banco para verificar a quantidade atual
$sql = "SELECT * FROM produtos WHERE id_produto = '$id_produto'";
$result = $conn->query($sql);

if ($result && $result->num_rows == 0) {
    // Caso o produto não seja encontrado
    echo "<script>alert('Produto Não Encontrado'); window.location.href = '../components/listar_produtos.php';</script>";
    exit();
} else {
    $row = $result->fetch_assoc();
    $qtd_atual = $row['qtd_produto'];
    $min_qtd_produto = $row['min_qtd_produto'];

    // Calcula a nova quantidade baseada no tipo de movimentação
    if ($tipo_mov == 'entrada') {
        $qtd_nova = $qtd_atual + $quantidade_mov;
    } else {
        $qtd_nova = $qtd_atual - $quantidade_mov;
    }

    // Validação: impede que o estoque fique negativo
    if ($qtd_nova < 0) {
        echo "<script>alert('Erro: Estoque insuficiente para realizar esta saída.'); window.location.href = '../components/listar_produtos.php';</script>";
        exit();
    } 
    // Alerta caso o estoque fique abaixo do mínimo definido
    else if ($qtd_nova < $min_qtd_produto) {
        echo "<script>alert('Atenção: O produto está com estoque abaixo do mínimo definido!')</script>";
    }

    // Atualiza a quantidade do produto na tabela 'produtos'
    $sql = "UPDATE produtos SET qtd_produto = '$qtd_nova' WHERE id_produto = $id_produto";
    $result = $conn->query($sql);

    // Registra a movimentação na tabela 'mov_produto' para fins de histórico
    $sqlMov = "INSERT INTO mov_produto (fk_produto, fk_responsavel, tipo_movimentacao, quantidade_mov, data_movimentacao, desc_movimentacao) 
    VALUES ('$id_produto', '$id_usuario', '$tipo_mov', '$quantidade_mov', '$data_hora', '$motivo_movimentacao')";
    $result = $conn->query($sqlMov);

    // Alerta de sucesso e redirecionamento para a listagem
    echo ("<script>alert('Movimentação realizada com sucesso!'); window.location.href = '../components/listar_produtos.php';</script>");
    exit();
}
?>