<?php
// Inclui o arquivo de conexão
include("../api/conexao.php");

// Verifica se a sessão está ativa
if (isset($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
    $nivel_usuario = $_SESSION["nivel_usuario"];
} else {
    // Redireciona para o login caso tente acessar sem estar logado
    header("Location: ../../index.php");
    exit();
}
?>
<header id="cabecalho">
    <nav>
        <ul>
            <li><a href="inicio.php">Home</a></li>
            <li><a href="cadastro_produto.php">Cadastrar Produto</a></li>
            <li><a href="listar_produtos.php">Listar Estoque</a></li>
            <li><a href="historico_mov.php">Histórico de Movimentações</a></li>
        </ul>
        <?php
        // Verifica se existem produtos com estoque baixo para exibir notificação no menu
        $sqlMin = "SELECT COUNT(*) FROM produtos WHERE qtd_produto <= min_qtd_produto";

        $resultadoMinimo = $conn->query($sqlMin);
        $linha = $resultadoMinimo->fetch_assoc();
        $quantidadeBaixa = $linha["COUNT(*)"];

        // Se houver produtos em falta, exibe o alerta
        if ($quantidadeBaixa > 0): ?>
            <div id="notificacao-estoque-baixo">
                <a href="listar_produtos.php?produto='minimo'" id="btn-estoque-baixo">
                    ⚠️ Estoque Baixo (<?php echo $quantidadeBaixa; ?>)
                </a>
            </div>
        <?php endif; ?>

        <!-- Informações do usuário logado e botão de sair -->
        <div id="info-user">
            <h3 id="user">Bem-vindo,
                <?php echo $usuario; ?>!
            </h3>
            <a href="../api/logout.php" id="btn-sair">Sair</a>
        </div>
    </nav>
</header>