-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 09/07/2025 às 13:11
-- Versão do servidor: 10.11.10-MariaDB-log
-- Versão do PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = 'America/Sao_Paulo';

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `u841971040_ndfinancas`
--
CREATE DATABASE IF NOT EXISTS `nffinancas` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `nffinancas`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `sobrenome` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `socio` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `cpf` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `rg` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `tel` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `tel2` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `atividade` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `endereco` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `cep` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `cnpj` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `numero` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `bairro` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `municipio` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `uf` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `complemento` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `referencia` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `cep_emp` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `lougadouro_emp` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `number_emp` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `municipio_emp` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `uf_emp` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `bairro_emp` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `complemento_emp` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `referencia_emp` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `status_cliente` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `user_created` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `data_hora_cliente` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `comprovantes`
--

DROP TABLE IF EXISTS `comprovantes`;
CREATE TABLE `comprovantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_solicitacao` int(11) NOT NULL,
  `comprovante` char(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `usuario` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `dt_pgto` date NOT NULL,
  `data_comprovante` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `fotos_clientes`
--

DROP TABLE IF EXISTS `fotos_clientes`;
CREATE TABLE `fotos_clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `ftcliente` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ftrg` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ftcpf` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ftcompres` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ftcompcomer` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `fttermo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ftcertificado` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ftlocal` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ftlocal2` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ftlocal3` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ftlocal4` varchar(255) NOT NULL,
  `usuario` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `data_fotos_clientes` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT AUTO_INCREMENT,
  `menu_folder` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `menu` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `menu_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `menus`
--

INSERT INTO `menus` (`id`, `menu_folder`, `menu`, `menu_name`, `status`) VALUES
(1, 'solicitacao', 'Solicitação', 'Menu', 1),
(2, 'diaria', 'Diária', 'Menu VS', 1),
(3, 'mes', 'Mês', 'Menu Guerra', 1),
(4, 'cdclientes', 'Cadastrar Cliente', 'Menu', 1),
(5, 'clientes', 'Ver Cliente', 'Menu', 1),
(6, 'criar_login', 'Criar Login', 'Menu Login', 1),
(7, 'acessos', 'Acessos', 'Menu Login', 1),
(8, 'detalhes', 'Detalhes', 'Menu VS', 0),
(9, 'ver_comprovante', 'Ver comprovante', 'Menu VS', 0),
(10, 'salvar_login', 'Salvar Login', 'Menu Login', 0),
(11, 'starter', 'Inicio', 'Inicio', 0),
(12, 'salvar_acesso', 'Salvar Acesso', 'Menu Login', 0),
(13, 'salvar_cliente', 'Salvar Cliente', 'Menu', 0),
(14, 'salvar_solicitacao', 'Salvar SolicitaÇão', 'Menu', 0),
(15, 'salvar_detalhes', 'Salvar Detalhes', 'Menu Login', 0),
(16, 'profile', 'Ver Detalhes Cliente', 'Menu Login', 0),
(17, 'detalhes_guerra', 'Ver Detalhes Cliente Guerra', 'Menu Guerra', 0),
(18, 'chat', 'Chat', 'Menu Chat', 1),
(20, 'cdclienteeditar', 'Editar Clientes', 'Menu', 0),
(21, 'salvar_edicao', 'Salvar Edição', 'Menu', 0),
(22, 'liberar_login', 'Liberar login ao sistema', 'Menu Login', 1),
(23, 'mudar_senha', 'Mudar Senha', 'Menu Login', 1),
(24, 'alterar_senha', 'Alterar Senha', 'Menu Login', 0),
(25, 'clientes_adm', 'Clientes VS | Guerra', 'Menu Adm', 1),
(26, 'profile_adm', 'Ver Clientes VS | Guerra', 'Menu Adm', 0),
(27, 'cdclienteeditar_adm', 'Editar Clientes VS | Guerra', 'Menu Adm', 0),
(28, 'solicitacoes', 'Solicitações Geral', 'Menu Adm', 1),
(29, 'tipo_cliente', 'Cadastrar Tipos de Clientes', 'Menu', 1),
(30, 'parcelar', 'Parcelamento', 'Menu', 0),
(31, 'finalizar_cliente', 'Finalizar Cliente', 'Menu', 0),
(32, 'salvar_parcelamento', 'Salvar Parcelamento', 'Menu', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `nome_cliente`
--

DROP TABLE IF EXISTS `nome_cliente`;
CREATE TABLE `nome_cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_servico` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `data_hora_cliente` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `nome_cliente`
--

INSERT INTO `nome_cliente` (`id`, `nome_servico`, `user`, `data_hora_cliente`) VALUES
(1, 'VS', 'phelipe', '2022-10-05 12:07:33'),
(2, 'Guerra', 'phelipe', '2022-10-05 12:07:33'),
(3, 'Guerra 2', 'phelipe', '2022-10-05 12:07:33');

-- --------------------------------------------------------

--
-- Estrutura para tabela `solicitacao`
--

DROP TABLE IF EXISTS `solicitacao`;
CREATE TABLE `solicitacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `id_servico` int(11) NOT NULL,
  `valor` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `valor_parcela` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `status_solicitacao` int(11) NOT NULL,
  `juros` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `valor_bruto` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `dt_solicitacao` date NOT NULL,
  `dt_pgto` date NOT NULL,
  `usuario` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `data_hora_solicitacao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `solicitacao_bk_07-07`
--

DROP TABLE IF EXISTS `solicitacao_bk_07-07`;
CREATE TABLE `solicitacao_bk_07-07` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `id_servico` int(11) NOT NULL,
  `valor` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `valor_parcela` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `status_solicitacao` int(11) NOT NULL,
  `juros` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `valor_bruto` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `dt_solicitacao` date NOT NULL,
  `dt_pgto` date NOT NULL,
  `usuario` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `data_hora_solicitacao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `class` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `status`
--

INSERT INTO `status` (`id`, `descricao`, `class`, `status`) VALUES
(1, 'Em Andamento', 'badge badge-info', 1),
(2, 'Atrasado', 'badge badge-danger', 1),
(3, 'Parcelado', 'badge badge-warning', 1),
(4, 'Quitado', 'badge badge-success', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbchat`
--

DROP TABLE IF EXISTS `tbchat`;
CREATE TABLE `tbchat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `left_user` int(11) NOT NULL,
  `right_user` int(11) NOT NULL,
  `nome` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `mensagem` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `data_hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` int(255) NOT NULL,
  `usuario` char(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `senha` char(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `status` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `status_login` int(11) NOT NULL DEFAULT 0,
  `session` char(255) NOT NULL,
  `pass` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `user`
--

INSERT INTO `user` (`id`, `unique_id`, `usuario`, `senha`, `status`, `status_login`, `session`, `pass`) VALUES
(1, 197592445, 'phelipe', '3804a9d7d718887fd9422cdc320a3b76', 'Off-line agora', 1, '', NULL),

-- --------------------------------------------------------

--
-- Estrutura para tabela `user_accesses`
--

DROP TABLE IF EXISTS `user_accesses`;
CREATE TABLE `user_accesses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `menu_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `menu_folder` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `menu` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` int(11) NOT NULL,
    `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_user_accesses_user`
    FOREIGN KEY (`id_usuario`) REFERENCES `user`(`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `user_accesses`
--

INSERT INTO `user_accesses` (`id_usuario`, `id_menu`, `menu_name`, `menu_folder`, `menu`, `status`) VALUES
(1, 15, 'Menu VS', 'salvar_detalhes', 'Salvar Detalhes', 0),
(1, 16, 'Menu VS', 'profile', 'Ver Detalhes Cliente', 0),
(1, 18, 'Menu Chat', 'chat', 'Chat', 1),
(1, 4, 'Menu', 'cdclientes', 'Cadastrar Cliente', 1),
(1, 13, 'Menu', 'salvar_cliente', 'Salvar Cliente', 0),
(1, 3, 'Menu Guerra', 'mes', 'Mês', 1),
(1, 17, 'Menu Guerra', 'detalhes_guerra', 'Ver Detalhes Cliente Guerra', 0),
(1, 6, 'Menu Login', 'criar_login', 'Criar Login', 1),
(1, 7, 'Menu Login', 'acessos', 'Acessos', 1),
(1, 10, 'Menu Login', 'salvar_login', 'Salvar Login', 0),
(1, 12, 'Menu Login', 'salvar_acesso', 'Salvar Acesso', 0),
(1, 11, 'Inicio', 'starter', 'Inicio', 0),
(1, 20, 'Menu', 'cdclienteeditar', 'Editar Clientes', 0),
(1, 19, 'Menu', 'salvar_edicao', 'Salvar Edição', 0),
(1, 22, 'Menu Login', 'liberar_login', 'Liberar login ao sistema', 1),
( 1, 24, 'Menu Login', 'alterar_senha', 'Alterar Senha', 0),
( 1, 25, 'Menu Adm', 'clientes_adm', 'Clientes VS | Guerra', 1),
( 1, 27, 'Menu Adm', 'cdclienteeditar_adm', 'Editar Clientes VS | Guerra', 0),
( 1, 1, 'Menu', 'solicitacao', 'Solicitação', 1),
( 1, 14, 'Menu', 'salvar_solicitacao', 'Salvar SolicitaÇão', 0),
( 1, 30, 'Menu', 'parcelar', 'Parcelamento', 0),
( 1, 29, 'Menu', 'tipo_cliente', 'Cadastrar Tipos de Clientes', 1),
( 1, 32, 'Menu', 'salvar_parcelamento', 'Salvar Parcelamento', 0),
( 1, 2, 'Menu VS', 'diaria', 'Diária', 1),
( 1, 23, 'Menu Login', 'mudar_senha', 'Mudar Senha', 1),
( 1, 5, 'Menu', 'clientes', 'Ver Cliente', 1),
( 1, 31, 'Menu', 'finalizar_cliente', 'Finalizar Cliente', 0),
( 1, 8, 'Menu VS', 'detalhes', 'Detalhes', 0),
( 1, 9, 'Menu VS', 'ver_comprovante', 'Ver comprovante', 0),
( 1, 26, 'Menu Adm', 'profile_adm', 'Ver Clientes VS | Guerra', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `valor_pago`
--

DROP TABLE IF EXISTS `valor_pago`;
CREATE TABLE `valor_pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_solicitacao` int(11) NOT NULL,
  `valor_pago` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `atraso_diaria` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `atraso_parcela` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `total_atraso` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `em_aberto` varchar(15) NOT NULL,
  `usuario` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `data_valor_pago` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `comprovantes`
--
ALTER TABLE `comprovantes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `fotos_clientes`
--
ALTER TABLE `fotos_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Índices de tabela `nome_cliente`
--
ALTER TABLE `nome_cliente`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `solicitacao`
--
ALTER TABLE `solicitacao`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `solicitacao_bk_07-07`
--
ALTER TABLE `solicitacao_bk_07-07`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tbchat`
--
ALTER TABLE `tbchat`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `user_accesses`
--
ALTER TABLE `user_accesses`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `valor_pago`
--
ALTER TABLE `valor_pago`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `comprovantes`
--
ALTER TABLE `comprovantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `fotos_clientes`
--
ALTER TABLE `fotos_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de tabela `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `nome_cliente`
--
ALTER TABLE `nome_cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `solicitacao`
--
ALTER TABLE `solicitacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `solicitacao_bk_07-07`
--
ALTER TABLE `solicitacao_bk_07-07`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tbchat`
--
ALTER TABLE `tbchat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `user_accesses`
--
ALTER TABLE `user_accesses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT AUTO_INCREMENT, AUTO_INCREMENT=296;

--
-- AUTO_INCREMENT de tabela `valor_pago`
--
ALTER TABLE `valor_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT AUTO_INCREMENT;
COMMIT;

ALTER TABLE `clientes`
ADD CONSTRAINT fk_clientes_user
FOREIGN KEY (`id_cliente`) REFERENCES `user`(`id`)
ON DELETE CASCADE
ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
