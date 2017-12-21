-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 21, 2017 at 05:27 AM
-- Server version: 5.6.38
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simulado_simulador`
--

-- --------------------------------------------------------

--
-- Table structure for table `autenticacao_grupo`
--

CREATE TABLE `autenticacao_grupo` (
  `id` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(300) NOT NULL DEFAULT '',
  `redirecionar` varchar(300) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `autenticacao_grupo_autenticacao_permissao`
--

CREATE TABLE `autenticacao_grupo_autenticacao_permissao` (
  `autenticacao_grupo_id` int(10) UNSIGNED NOT NULL,
  `autenticacao_permissao_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `autenticacao_permissao`
--

CREATE TABLE `autenticacao_permissao` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `autenticacao_usuario`
--

CREATE TABLE `autenticacao_usuario` (
  `id` int(10) UNSIGNED NOT NULL,
  `autenticacao_grupo_id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(40) NOT NULL,
  `ultima_visita` datetime DEFAULT NULL,
  `ativo` tinyint(1) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `banco`
--

CREATE TABLE `banco` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(10) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `coeficiente`
--

CREATE TABLE `coeficiente` (
  `id` int(10) UNSIGNED NOT NULL,
  `tabela_id` int(10) UNSIGNED NOT NULL,
  `prazo` int(11) NOT NULL,
  `coeficiente` decimal(10,5) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `estado_civil`
--

CREATE TABLE `estado_civil` (
  `id` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orgao`
--

CREATE TABLE `orgao` (
  `id` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `solicitacao`
--

CREATE TABLE `solicitacao` (
  `id` int(10) UNSIGNED NOT NULL,
  `coeficiente_id` int(10) UNSIGNED NOT NULL,
  `estado_civil_id` int(11) UNSIGNED DEFAULT NULL,
  `banco_id` int(11) UNSIGNED DEFAULT NULL,
  `tipo_conta_id` int(11) UNSIGNED DEFAULT NULL,
  `uuid` char(36) NOT NULL,
  `valor` decimal(10,2) UNSIGNED NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `telefone_fixo` varchar(15) DEFAULT NULL,
  `telefone_celular` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `nome_mae` varchar(100) DEFAULT NULL,
  `nome_pai` varchar(100) DEFAULT NULL,
  `cep` char(9) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `complemento` varchar(20) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` char(2) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `rg` varchar(50) DEFAULT NULL,
  `rg_emissao_estado` char(2) DEFAULT NULL,
  `rg_emissao_data` date DEFAULT NULL,
  `matricula_beneficio` varchar(50) DEFAULT NULL,
  `agencia` varchar(10) DEFAULT NULL,
  `conta` varchar(20) DEFAULT NULL,
  `conta_dv` varchar(10) DEFAULT NULL,
  `aceite_termos` tinyint(1) DEFAULT NULL,
  `utm_source` varchar(255) DEFAULT NULL,
  `utm_campaign` varchar(255) DEFAULT NULL,
  `ip` varchar(16) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `solicitacao_documento`
--

CREATE TABLE `solicitacao_documento` (
  `id` int(10) UNSIGNED NOT NULL,
  `solicitacao_id` int(10) UNSIGNED NOT NULL,
  `solicitacao_tipo_documento_id` int(10) UNSIGNED NOT NULL,
  `arquivo` varchar(200) NOT NULL,
  `confirmado` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `solicitacao_tipo_documento`
--

CREATE TABLE `solicitacao_tipo_documento` (
  `id` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `instrucoes` text NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tabela`
--

CREATE TABLE `tabela` (
  `id` int(10) UNSIGNED NOT NULL,
  `orgao_id` int(10) UNSIGNED NOT NULL,
  `vigencia_inicio` date NOT NULL,
  `vigencia_fim` date DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_conta`
--

CREATE TABLE `tipo_conta` (
  `id` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(10) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autenticacao_grupo`
--
ALTER TABLE `autenticacao_grupo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autenticacao_grupo_autenticacao_permissao`
--
ALTER TABLE `autenticacao_grupo_autenticacao_permissao`
  ADD KEY `fk_auth_groups_auth_permissions_auth_groups1` (`autenticacao_grupo_id`),
  ADD KEY `fk_auth_groups_auth_permissions_auth_permissions1` (`autenticacao_permissao_id`);

--
-- Indexes for table `autenticacao_permissao`
--
ALTER TABLE `autenticacao_permissao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autenticacao_usuario`
--
ALTER TABLE `autenticacao_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_auth_users_auth_groups` (`autenticacao_grupo_id`);

--
-- Indexes for table `banco`
--
ALTER TABLE `banco`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indexes for table `coeficiente`
--
ALTER TABLE `coeficiente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tabela_id_prazo` (`tabela_id`,`prazo`);

--
-- Indexes for table `estado_civil`
--
ALTER TABLE `estado_civil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orgao`
--
ALTER TABLE `orgao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `solicitacao`
--
ALTER TABLE `solicitacao`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `FK_solicitacao_coeficiente` (`coeficiente_id`),
  ADD KEY `FK_solicitacao_estado_civil` (`estado_civil_id`),
  ADD KEY `FK_solicitacao_banco` (`banco_id`),
  ADD KEY `FK_solicitacao_tipo_conta` (`tipo_conta_id`);

--
-- Indexes for table `solicitacao_documento`
--
ALTER TABLE `solicitacao_documento`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `solicitacao_id_solicitacao_tipo_documento_id` (`solicitacao_id`,`solicitacao_tipo_documento_id`),
  ADD KEY `FK_solicitacao_documento_solicitacao_tipo_documento` (`solicitacao_tipo_documento_id`);

--
-- Indexes for table `solicitacao_tipo_documento`
--
ALTER TABLE `solicitacao_tipo_documento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabela`
--
ALTER TABLE `tabela`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orgao_id_vigencia_inicio` (`orgao_id`,`vigencia_inicio`);

--
-- Indexes for table `tipo_conta`
--
ALTER TABLE `tipo_conta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `descricao` (`descricao`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `autenticacao_grupo`
--
ALTER TABLE `autenticacao_grupo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `autenticacao_permissao`
--
ALTER TABLE `autenticacao_permissao`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `autenticacao_usuario`
--
ALTER TABLE `autenticacao_usuario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;
--
-- AUTO_INCREMENT for table `banco`
--
ALTER TABLE `banco`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;
--
-- AUTO_INCREMENT for table `coeficiente`
--
ALTER TABLE `coeficiente`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `estado_civil`
--
ALTER TABLE `estado_civil`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `orgao`
--
ALTER TABLE `orgao`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `solicitacao`
--
ALTER TABLE `solicitacao`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=421;
--
-- AUTO_INCREMENT for table `solicitacao_documento`
--
ALTER TABLE `solicitacao_documento`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;
--
-- AUTO_INCREMENT for table `solicitacao_tipo_documento`
--
ALTER TABLE `solicitacao_tipo_documento`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tabela`
--
ALTER TABLE `tabela`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tipo_conta`
--
ALTER TABLE `tipo_conta`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `autenticacao_grupo_autenticacao_permissao`
--
ALTER TABLE `autenticacao_grupo_autenticacao_permissao`
  ADD CONSTRAINT `fk_auth_groups_auth_permissions_auth_groups1` FOREIGN KEY (`autenticacao_grupo_id`) REFERENCES `autenticacao_grupo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_auth_groups_auth_permissions_auth_permissions1` FOREIGN KEY (`autenticacao_permissao_id`) REFERENCES `autenticacao_permissao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `autenticacao_usuario`
--
ALTER TABLE `autenticacao_usuario`
  ADD CONSTRAINT `fk_auth_users_auth_groups` FOREIGN KEY (`autenticacao_grupo_id`) REFERENCES `autenticacao_grupo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `coeficiente`
--
ALTER TABLE `coeficiente`
  ADD CONSTRAINT `FK_coeficiente_tabela` FOREIGN KEY (`tabela_id`) REFERENCES `tabela` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `solicitacao`
--
ALTER TABLE `solicitacao`
  ADD CONSTRAINT `FK_solicitacao_banco` FOREIGN KEY (`banco_id`) REFERENCES `banco` (`id`),
  ADD CONSTRAINT `FK_solicitacao_coeficiente` FOREIGN KEY (`coeficiente_id`) REFERENCES `coeficiente` (`id`),
  ADD CONSTRAINT `FK_solicitacao_estado_civil` FOREIGN KEY (`estado_civil_id`) REFERENCES `estado_civil` (`id`),
  ADD CONSTRAINT `FK_solicitacao_tipo_conta` FOREIGN KEY (`tipo_conta_id`) REFERENCES `tipo_conta` (`id`);

--
-- Constraints for table `solicitacao_documento`
--
ALTER TABLE `solicitacao_documento`
  ADD CONSTRAINT `FK_imagem_documento_solicitacao` FOREIGN KEY (`solicitacao_id`) REFERENCES `solicitacao` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_solicitacao_documento_solicitacao_tipo_documento` FOREIGN KEY (`solicitacao_tipo_documento_id`) REFERENCES `solicitacao_tipo_documento` (`id`);

--
-- Constraints for table `tabela`
--
ALTER TABLE `tabela`
  ADD CONSTRAINT `FK__orgao` FOREIGN KEY (`orgao_id`) REFERENCES `orgao` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
