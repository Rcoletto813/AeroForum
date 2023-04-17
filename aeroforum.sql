-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17-Abr-2023 às 03:50
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `aeroforum`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario_grupo`
--

CREATE TABLE `comentario_grupo` (
  `id_Comentario_Grupo` int(11) NOT NULL,
  `id_Grupo` int(11) NOT NULL,
  `Id_User` varchar(140) NOT NULL,
  `Conteúdo` varchar(340) NOT NULL,
  `Data_Criação` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario_post`
--

CREATE TABLE `comentario_post` (
  `id_Comentario_Post` int(11) NOT NULL,
  `Id_User` varchar(140) NOT NULL COMMENT 'Usuário que fez o comentário\n',
  `id_Post` int(11) NOT NULL,
  `Conteúdo` varchar(340) NOT NULL,
  `Data_Criação` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo`
--

CREATE TABLE `grupo` (
  `id_Grupo` int(11) NOT NULL,
  `Nome` varchar(45) NOT NULL,
  `Categoria` varchar(60) NOT NULL,
  `Descrição` varchar(60) NOT NULL,
  `Membros` int(11) NOT NULL DEFAULT 0,
  `Foto` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `grupo`
--

INSERT INTO `grupo` (`id_Grupo`, `Nome`, `Categoria`, `Descrição`, `Membros`, `Foto`) VALUES
(1, 'Grupo de teste', '#aviões', 'Um grupo sobre aviões', 100, '../imagens/grupos/logoGrupoDefault.png'),
(2, 'Grupos de teste 2', '#foguete', 'grupo de teste de foguete', 15, '../imagens/grupos/logoGrupoDefault.png'),
(3, 'Roberto', '#atlas', 'grupo muuuuito legal', 0, '../imagens/grupos/logoGrupoDefault.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `post`
--

CREATE TABLE `post` (
  `id_Post` int(11) NOT NULL,
  `Id_User` varchar(140) NOT NULL,
  `Título` varchar(45) NOT NULL,
  `Conteúdo` longtext NOT NULL,
  `Categoria(s)` varchar(60) DEFAULT NULL,
  `Avaliação` int(11) NOT NULL DEFAULT 0,
  `Resumo` varchar(100) DEFAULT NULL,
  `Data_Criação` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `post`
--

INSERT INTO `post` (`id_Post`, `Id_User`, `Título`, `Conteúdo`, `Categoria(s)`, `Avaliação`, `Resumo`, `Data_Criação`) VALUES
(1, 'zKoqvekeyaRDjHXWhiLdsc7zOns1', 'Como fazer um foguete caseiro', 'cbwdch3wdbwhwdbwdhwsdbwhwsbwschwcbhwdchbwefbh3efhb3fhb3ew', 'foguete; foguetemodelismo', 3, 'Como montar um foguete caseiro', '0000-00-00 00:00:00'),
(2, 'kdoAhTMGtOMLp59zqxmPOgKazb82', 'Motores a jato... Por que são tão importantes', 'hbwhwdbwdwh', '#foguete #caças', 1, 'Entenda o porque motores a jat', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuariogrupo`
--

CREATE TABLE `usuariogrupo` (
  `Usuário_Id_User` varchar(140) NOT NULL,
  `Grupo_id_Grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuariogrupo`
--

INSERT INTO `usuariogrupo` (`Usuário_Id_User`, `Grupo_id_Grupo`) VALUES
('4s9vCefoPTWwyyv9EKFAqFy4RIH2', 1),
('4s9vCefoPTWwyyv9EKFAqFy4RIH2', 2),
('4s9vCefoPTWwyyv9EKFAqFy4RIH2', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuário`
--

CREATE TABLE `usuário` (
  `Id_User` varchar(140) NOT NULL,
  `Username` varchar(45) NOT NULL,
  `Email` varchar(120) NOT NULL,
  `Patente` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuário`
--

INSERT INTO `usuário` (`Id_User`, `Username`, `Email`, `Patente`) VALUES
('4s9vCefoPTWwyyv9EKFAqFy4RIH2', 'teste', 'teste2@gmail.com', 0),
('JzH9gQzHavcgIQ2s0zoNao4LlM42', 'Rc Coletto', 'rodrigofamilia1.rc@gmail.com', 0),
('kdoAhTMGtOMLp59zqxmPOgKazb82', 'dmwdnss', 'wdwsdws@gmail.com', 0),
('O01qEF4I8eWmlitX6It9tiEMq8G3', 'Mamae', 'marcia.iumatti@gmail.com', 0),
('zKoqvekeyaRDjHXWhiLdsc7zOns1', 'teste', 'dddddd@gmail.com', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `comentario_grupo`
--
ALTER TABLE `comentario_grupo`
  ADD PRIMARY KEY (`id_Comentario_Grupo`),
  ADD KEY `fk_Comentario_Grupo_Grupo1_idx` (`id_Grupo`),
  ADD KEY `fk_Comentario_Grupo_Usuário1_idx` (`Id_User`);

--
-- Índices para tabela `comentario_post`
--
ALTER TABLE `comentario_post`
  ADD PRIMARY KEY (`id_Comentario_Post`),
  ADD KEY `fk_Comentario_Post_Usuário1_idx` (`Id_User`),
  ADD KEY `fk_Comentario_Post_Post1_idx` (`id_Post`);

--
-- Índices para tabela `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id_Grupo`),
  ADD UNIQUE KEY `id_Grupo_UNIQUE` (`id_Grupo`);

--
-- Índices para tabela `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_Post`),
  ADD UNIQUE KEY `id_Post_UNIQUE` (`id_Post`),
  ADD KEY `fk_Post_Usuário_idx` (`Id_User`);

--
-- Índices para tabela `usuariogrupo`
--
ALTER TABLE `usuariogrupo`
  ADD KEY `fk_UsuarioGrupo_Usuário1_idx` (`Usuário_Id_User`),
  ADD KEY `fk_UsuarioGrupo_Grupo1_idx` (`Grupo_id_Grupo`);

--
-- Índices para tabela `usuário`
--
ALTER TABLE `usuário`
  ADD PRIMARY KEY (`Id_User`),
  ADD UNIQUE KEY `Email_UNIQUE` (`Email`),
  ADD UNIQUE KEY `Id_User_UNIQUE` (`Id_User`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comentario_grupo`
--
ALTER TABLE `comentario_grupo`
  MODIFY `id_Comentario_Grupo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `comentario_post`
--
ALTER TABLE `comentario_post`
  MODIFY `id_Comentario_Post` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id_Grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `post`
--
ALTER TABLE `post`
  MODIFY `id_Post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `comentario_grupo`
--
ALTER TABLE `comentario_grupo`
  ADD CONSTRAINT `fk_Comentario_Grupo_Grupo1` FOREIGN KEY (`id_Grupo`) REFERENCES `grupo` (`id_Grupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Comentario_Grupo_Usuário1` FOREIGN KEY (`Id_User`) REFERENCES `usuário` (`Id_User`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `comentario_post`
--
ALTER TABLE `comentario_post`
  ADD CONSTRAINT `fk_Comentario_Post_Post1` FOREIGN KEY (`id_Post`) REFERENCES `post` (`id_Post`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Comentario_Post_Usuário1` FOREIGN KEY (`Id_User`) REFERENCES `usuário` (`Id_User`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_Post_Usuário` FOREIGN KEY (`Id_User`) REFERENCES `usuário` (`Id_User`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuariogrupo`
--
ALTER TABLE `usuariogrupo`
  ADD CONSTRAINT `fk_UsuarioGrupo_Grupo1` FOREIGN KEY (`Grupo_id_Grupo`) REFERENCES `grupo` (`id_Grupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_UsuarioGrupo_Usuário1` FOREIGN KEY (`Usuário_Id_User`) REFERENCES `usuário` (`Id_User`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
