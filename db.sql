-- -----------------------------------------------------
-- Esquema do Banco de Dados: saep_db
-- Projeto: Sistema de Gestão de Estoque - Loja de Eletrônicos
-- -----------------------------------------------------

CREATE DATABASE IF NOT EXISTS saep_db;
USE saep_db;

-- -----------------------------------------------------
-- Tabela: usuarios
-- Armazena os dados de autenticação e cargos dos colaboradores
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    cargo ENUM('admin', 'vendedor', 'gerente') DEFAULT 'vendedor'
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabela: produtos
-- Armazena o inventário de eletrônicos e limites de estoque
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS produtos (
    id_produto INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10, 2) NOT NULL,
    estoque_minimo INT NOT NULL DEFAULT 5,
    saldo_atual INT NOT NULL DEFAULT 0,
    produto_tipo VARCHAR(50) NOT NULL
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabela: movimentacoes
-- Histórico de entradas e saídas de mercadorias
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS movimentacoes (
    id_movimentacao INT AUTO_INCREMENT PRIMARY KEY,
    id_produto INT NOT NULL,
    id_usuario INT NOT NULL,
    tipo ENUM('entrada', 'saida') NOT NULL,
    quantidade INT NOT NULL,
    data_movimentacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_movimentacao_produto FOREIGN KEY (id_produto) 
        REFERENCES produtos(id_produto) ON DELETE CASCADE,
    CONSTRAINT fk_movimentacao_usuario FOREIGN KEY (id_usuario) 
        REFERENCES usuarios(id_usuario) ON DELETE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Carga Inicial de Dados (Seeds)
-- -----------------------------------------------------

-- Inserção de Usuários
INSERT INTO usuarios (nome, email, senha, cargo) VALUES 
('Administrador Master', 'admin@loja.com', '123456', 'admin'),
('Vendedor Silva', 'silva@loja.com', '654321', 'vendedor'),
('Gerente Ana', 'ana@loja.com', 'admin123', 'gerente');

-- Inserção de Produtos Iniciais
INSERT INTO produtos (nome, descricao, preco, estoque_minimo, saldo_atual, produto_tipo) VALUES 
('Smartphone Galaxy S23', 'Samsung Galaxy S23 256GB Black', 4500.00, 10, 20, 'Celular'),
('Notebook Dell Inspiron', 'Dell Inspiron 15 Intel Core i5 8GB 512GB SSD', 3800.00, 5, 8, 'Computador'),
('Monitor LG 29 Ultrawide', 'Monitor LG 29 Polegadas Full HD IPS', 1200.00, 3, 15, 'Monitor');

-- Inserção de Movimentações de Exemplo
INSERT INTO movimentacoes (id_produto, id_usuario, tipo, quantidade) VALUES 
(1, 1, 'entrada', 20),
(2, 3, 'entrada', 8),
(3, 1, 'entrada', 15);