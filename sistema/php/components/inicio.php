<?php
// Inicia a sessão para controle de acesso
session_start();
// Inclui a conexão com o banco de dados
include("../api/conexao.php");

// Verifica se o usuário está autenticado
if (isset($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
    $nivel_usuario = $_SESSION["nivel_usuario"];
} else {
    // Redireciona para o login caso não esteja autenticado
    header("Location: ../../index.php");
    exit();
}

// Verifica se o usuário ainda está usando a senha padrão (força a troca)
if ($_SESSION["senha_padrao"] == 0) {
    header("Location: ../components/reset_senha.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <?php
    include 'cabecalho.php';
    ?>
    <main>
        <section id="container-inicio">
            <h1 class="titulo-secao">Gerenciamento Estoque</h1>
            <p class="descricao-secao">Esse sistema foi desenvolvido para auxiliar no gerenciamento de produtos em estoque
                entrada, saida, e
                histórico de movimentações</p>
            <div class="container-botoes-acao">
                <a href="cadastro_produto.php"><button type="button" class="btn-acao btn-novo">Novo
                        Produto</button></a>
                <a href="listar_produtos.php"><button type="button" class="btn-acao btn-ver">Ver Produtos Cadastrados</button></a>
                <a href="historico_mov.php"><button type="button" class="btn-acao btn-historico">Ver Histórico de
                        Movimentações</button></a>
            </div>
            <?php
            // Consulta a quantidade de produtos com estoque abaixo do mínimo
            $sqlMin = "SELECT COUNT(*) FROM produtos WHERE qtd_produto <= min_qtd_produto";

            $resultadoMinimo = $conn->query($sqlMin);
            $linha = $resultadoMinimo->fetch_assoc();
            $quantidadeBaixa = $linha["COUNT(*)"];

            // Exibe alerta se houver produtos com estoque baixo
            if ($quantidadeBaixa > 0) { ?>
                <p class="descricao-secao">Confira os produtos com estoque baixo, existem
                    <?php echo $quantidadeBaixa; ?> produtos com o estoque baixo
                    atualmente
                </p>
                <div id="notificacao-estoque-baixo">
                    <a href="listar_produtos.php?produto='minimo'" id="btn-estoque-baixo">
                        ⚠️ Estoque Baixo (<?php echo $quantidadeBaixa; ?>)
                    </a>
                </div>
            <?php } ?>

            <?php 
            // Seção exclusiva para administradores (nível 1)
            if ($nivel_usuario == 1) { ?>
                <p class="descricao-secao">Como você é administrador, você pode gerenciar outros usuarios</p>
                <div class="container-botoes-acao">
                    <a href="cadastro_usuario.php"><button type="button" class="btn-acao btn-novo">Novo
                            Usuário</button></a>
                    <a href="listar_usuarios.php"><button type="button" class="btn-acao btn-ver">Ver
                            Usuários</button></a>
                </div>
            <?php } ?>
        </section>
    </main>
    <?php
    include 'rodape.php';
    ?>
</body>

</html>