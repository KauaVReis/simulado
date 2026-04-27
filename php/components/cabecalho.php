<header id="cabecalho">
    <nav>
        <ul>
            <li><a href="inicio.php">Home</a></li>
            <li><a href="cadastro_produto.php">Cadastrar Produto</a></li>
            <li><a href="listar_produtos.php">Listar Estoque</a></li>
            <li><a href="historico_mov.php">Histórico de Movimentações</a></li>
        </ul>
        <?php
        // Exemplo de lógica para buscar a quantidade
        // $quantidadeBaixa = query("SELECT COUNT(*) FROM produtos WHERE estoque <= minimo");
        
        $quantidadeBaixa = 2;
        if ($quantidadeBaixa > 0): ?>
            <div id="notificacao-estoque-baixo">
                <a href="listar_produtos.php" id="btn-estoque-baixo">
                    ⚠️ Estoque Baixo (<?php echo $quantidadeBaixa; ?>)
                </a>
            </div>
         <?php endif; ?>

        <div id="info-user">
            <h3 id="user">Bem-vindo, [Usuário]!</h3>
            <a href="../api/logout.php" id="btn-sair">Sair</a>
        </div>
    </nav>
</header>