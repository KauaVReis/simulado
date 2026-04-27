<?php
// include 'php/conexao.php';
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
            <h1 id="titulo">Gerenciamento Estoque</h1>
            <p id="descricao">Esse sistema foi desenvolvido para auxiliar no gerenciamento de produtos em estoque
                entrada, saida, e
                histórico de movimentações</p>
            <div id="botoes-acao">
                <a href="cadastro_produto.php"><button type="button" class="btn-acao" id="btn-novo">Novo
                        Produto</button></a>
                <a href="#"><button type="button" class="btn-acao" id="btn-ver">Ver Produtos Cadastrados</button></a>
                <a href="#"><button type="button" class="btn-acao" id="btn-historico">Ver Histórico de
                        Movimentações</button></a>
            </div>
            <?php
            // Exemplo de lógica para buscar a quantidade
            // $quantidadeBaixa = query("SELECT COUNT(*) FROM produtos WHERE estoque <= minimo");
            
            $quantidadeBaixa = 2;
            if ($quantidadeBaixa > 0): ?>
                <p id="descricao">Confira os produtos com estoque baixo, existem
                    <?php echo $quantidadeBaixa; ?> produtos com o estoque baixo
                    atualmente
                </p>
                <div id="notificacao-estoque-baixo">
                    <a href="listar_produtos.php" id="btn-estoque-baixo">
                        ⚠️ Estoque Baixo (<?php echo $quantidadeBaixa; ?>)
                    </a>
                </div>
            <?php endif; ?>
        </section>
    </main>
    <?php
    include 'rodape.php';
    ?>
</body>

</html>