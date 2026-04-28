    -- -----------------------------------------------------
    -- Schema saep_db
    -- -----------------------------------------------------
    CREATE SCHEMA IF NOT EXISTS `saep_db` DEFAULT CHARACTER SET utf8 ;
    USE `saep_db` ;

    -- -----------------------------------------------------
    -- Table `saep_db`.`usuario`
    -- -----------------------------------------------------
    CREATE TABLE IF NOT EXISTS `saep_db`.`usuario` (
    `id_usuario` INT(11) NOT NULL AUTO_INCREMENT,
    `nome_usuario` VARCHAR(150) NOT NULL,
    `senha_usuario` VARCHAR(255) NOT NULL,
    `nivel_usuario` TINYINT(1) NULL DEFAULT NULL,
    `senha_padrao` TINYINT(1) NULL DEFAULT 0,
    `email_usuario` VARCHAR(101) NOT NULL,
    PRIMARY KEY (`id_usuario`))
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8;

    -- -----------------------------------------------------
    -- Table `saep_db`.`produtos`
    -- -----------------------------------------------------
    CREATE TABLE IF NOT EXISTS `saep_db`.`produtos` (
    `id_produto` INT(11) NOT NULL AUTO_INCREMENT,
    `nome_produto` VARCHAR(100) NOT NULL,
    `marca_produto` VARCHAR(50) NOT NULL,
    `qtd_produto` INT(11) NOT NULL,
    `min_qtd_produto` INT(11) NOT NULL,
    `fk_responsavel_cadastro` INT(11) NOT NULL,
    `data_cadastro` DATETIME NOT NULL,
    `descricao_produto` TEXT NULL DEFAULT NULL,
    `preco_produto` DECIMAL(10,2) NULL DEFAULT NULL,
    PRIMARY KEY (`id_produto`),
    INDEX `fk_produtos_usuario_idx` (`fk_responsavel_cadastro` ASC),
    CONSTRAINT `fk_produtos_usuario`
        FOREIGN KEY (`fk_responsavel_cadastro`)
        REFERENCES `saep_db`.`usuario` (`id_usuario`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8;

    -- -----------------------------------------------------
    -- Table `saep_db`.`mov_produto`
    -- -----------------------------------------------------
    CREATE TABLE IF NOT EXISTS `saep_db`.`mov_produto` (
    `id_movimentacao` INT(11) NOT NULL AUTO_INCREMENT,
    `fk_produto` INT(11) NOT NULL,
    `fk_responsavel` INT(11) NOT NULL,
    `tipo_movimentacao` VARCHAR(100) NOT NULL,
    `data_movimentacao` DATETIME NOT NULL,
    `desc_movimentacao` VARCHAR(255) NULL DEFAULT NULL,
    `quantidade_mov` INT(11) NOT NULL,
    PRIMARY KEY (`id_movimentacao`),
    INDEX `fk_mov_produto_produtos1_idx` (`fk_produto` ASC),
    INDEX `fk_mov_produto_usuario1_idx` (`fk_responsavel` ASC),
    CONSTRAINT `fk_mov_produto_produtos1`
        FOREIGN KEY (`fk_produto`)
        REFERENCES `saep_db`.`produtos` (`id_produto`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
    CONSTRAINT `fk_mov_produto_usuario1`
        FOREIGN KEY (`fk_responsavel`)
        REFERENCES `saep_db`.`usuario` (`id_usuario`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8;

    -- -----------------------------------------------------
    -- População inicial do banco (Mínimo 3 registros por tabela)
    -- -----------------------------------------------------

    -- Usuários (Senha padrão: senaisp)
    INSERT INTO `saep_db`.`usuario` (nome_usuario, email_usuario, senha_usuario, nivel_usuario, senha_padrao) VALUES 
    ('Administrador', 'admin@estoque.com', '$2y$10$.UH0mal4L3XnAmKxlLTsEOja7722c2DrudEbZ3DFogwo2/f.786.e', 1, 0),
    ('Almoxarife João', 'joao@estoque.com', '$2y$10$.UH0mal4L3XnAmKxlLTsEOja7722c2DrudEbZ3DFogwo2/f.786.e', 2, 0),
    ('Maria Silva', 'maria@estoque.com', '$2y$10$.UH0mal4L3XnAmKxlLTsEOja7722c2DrudEbZ3DFogwo2/f.786.e', 2, 0);

    -- Produtos
    INSERT INTO `saep_db`.`produtos` (nome_produto, marca_produto, qtd_produto, min_qtd_produto, fk_responsavel_cadastro, data_cadastro, descricao_produto, preco_produto) VALUES 
    ('Smartphone Galaxy S23', 'Samsung', 15, 5, 1, NOW(), 'Smartphone Android com 256GB', 4500.00),
    ('Notebook Dell Vostro', 'Dell', 8, 3, 1, NOW(), 'Notebook i7 16GB RAM', 5200.00),
    ('Smart TV 55 pol', 'LG', 4, 2, 1, NOW(), 'Smart TV 4K OLED', 3800.00);

    -- Movimentações
    INSERT INTO `saep_db`.`mov_produto` (fk_produto, fk_responsavel, tipo_movimentacao, data_movimentacao, desc_movimentacao, quantidade_mov) VALUES 
    (1, 1, 'entrada', NOW(), 'Compra de estoque inicial', 15),
    (2, 2, 'entrada', NOW(), 'Entrada via nota fiscal 123', 8),
    (3, 3, 'entrada', NOW(), 'Saldo inicial almoxarifado', 4);