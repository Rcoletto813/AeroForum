-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Maio-2023 às 19:42
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
-- Estrutura da tabela `avaliacao_post`
--

CREATE TABLE `avaliacao_post` (
  `Id_Post` int(11) NOT NULL,
  `Id_User` varchar(140) NOT NULL,
  `nota` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `avaliacao_post`
--

INSERT INTO `avaliacao_post` (`Id_Post`, `Id_User`, `nota`) VALUES
(16, '3TXoCRHEy9TZJ4w5IPNCDizw91y2', 1),
(12, 'MTYcpX0FIkQ38TmMpwsLMSAg4Rt1', 1);

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

--
-- Extraindo dados da tabela `comentario_post`
--

INSERT INTO `comentario_post` (`id_Comentario_Post`, `Id_User`, `id_Post`, `Conteúdo`, `Data_Criação`) VALUES
(21, 'MTYcpX0FIkQ38TmMpwsLMSAg4Rt1', 16, 'Estou extremamente ansioso para isso! Eu e minha equipe estaremos lá...', '2023-05-12 19:33:16');

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
  `Foto` varchar(140) NOT NULL,
  `data_criação` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `grupo`
--

INSERT INTO `grupo` (`id_Grupo`, `Nome`, `Categoria`, `Descrição`, `Membros`, `Foto`, `data_criação`) VALUES
(80, 'War Thunder', '#jogo #avião', 'Grupo dedicado a jogadores de War Thunder', 2, '../imagens/grupos/logoGrupoDefault.png', '2023-05-12 19:25:40'),
(81, 'Jatos militares', '#jato #militar #caça #supersônico', '', 1, '../imagens/grupos/logoGrupoDefault.png', '2023-05-12 19:39:16');

-- --------------------------------------------------------

--
-- Estrutura da tabela `post`
--

CREATE TABLE `post` (
  `id_Post` int(11) NOT NULL,
  `Id_User` varchar(140) NOT NULL,
  `Título` varchar(60) NOT NULL,
  `Conteúdo` longtext NOT NULL,
  `Categoria` varchar(60) DEFAULT NULL,
  `Avaliação` int(11) NOT NULL DEFAULT 0,
  `Resumo` varchar(115) DEFAULT NULL,
  `Data_Criação` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `post`
--

INSERT INTO `post` (`id_Post`, `Id_User`, `Título`, `Conteúdo`, `Categoria`, `Avaliação`, `Resumo`, `Data_Criação`) VALUES
(12, '3TXoCRHEy9TZJ4w5IPNCDizw91y2', 'Fim da ISS', '<h1 style=\"font-size: 28px; font-weight: bold; margin-bottom: 30px; text-align: center; text-transform: uppercase;\">O fim da Estação Espacial Internacional: reflexões sobre o futuro da exploração espacial</h1>\r\n<p style=\"font-size: 16px; line-height: 1.5; margin-bottom: 20px;\">Olá, pessoal! Quem aí já ouviu falar sobre o fim da Estação Espacial Internacional (ISS)? Pois é, essa notícia tem gerado muita discussão nos últimos tempos. Afinal, a ISS é um dos maiores projetos de cooperação internacional da história e tem sido um símbolo da nossa capacidade de explorar o espaço.</p>\r\n<p style=\"font-size: 16px; line-height: 1.5; margin-bottom: 20px;\">Mas, como toda estrutura, a ISS tem um prazo de validade e, infelizmente, está chegando ao seu fim. Isso pode ser triste para muitas pessoas, principalmente para aqueles que acompanharam de perto todas as conquistas e descobertas realizadas na estação.</p>\r\n<p style=\"font-size: 16px; line-height: 1.5; margin-bottom: 20px;\">Porém, ao mesmo tempo, é importante lembrar que o fim da ISS não significa o fim da exploração espacial. Na verdade, isso pode ser uma oportunidade para novos projetos e descobertas. A NASA e outras agências espaciais já estão trabalhando em novas missões e projetos ambiciosos, como a volta do homem à Lua em 2024.</p>\r\n<p style=\"font-size: 16px; line-height: 1.5; margin-bottom: 20px;\">Além disso, o fim da ISS pode abrir espaço para novas formas de cooperação internacional e parcerias entre empresas privadas e governos, que podem trazer novos avanços na exploração espacial.</p>\r\n<p style=\"font-size: 16px; line-height: 1.5; margin-bottom: 20px;\">Mas, acima de tudo, a notícia do fim da ISS nos faz refletir sobre a importância da cooperação internacional e da ciência em nossas vidas. A ISS é um símbolo da nossa capacidade de trabalhar juntos em prol de um objetivo maior. E, nesse momento, mais do que nunca, precisamos de união e cooperação para enfrentar os desafios que o futuro nos reserva.</p>\r\n<p style=\"font-size: 16px; line-height: 1.5; margin-bottom: 20px;\">Portanto, o fim da ISS pode ser triste, mas também pode ser uma oportunidade para nos inspirarmos a continuar avançando e explorando novos horizontes. Vamos juntos continuar acompanhando e apoiando a exploração espacial, e nunca deixar de valorizar a ciência e a cooperação internacional como pilares fundamentais do nosso desenvolvimento.</p>', '#espaço #foguete', 5, 'Entenda como a ISS chegará ao fim e o que substituirá ela', '2023-05-06 07:40:31'),
(16, '3TXoCRHEy9TZJ4w5IPNCDizw91y2', 'Evento de desenvolvimento aéreo -  Oficial Em', '<div style=\"max-width: 800px; margin: 0 auto; padding: 20px; background-color: #fff; box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.2);\">\r\n		<h1 style=\"font-size: 36px; margin-top: 0;\">Evento de Inovação - Empresa Aeroespacial</h1>\r\n		<p style=\"font-size: 18px; line-height: 1.5;\">A Empresa Aeroespacial, líder no mercado aeroespacial, está orgulhosa em anunciar o seu próximo evento de inovação. O evento irá reunir os principais nomes da indústria aeroespacial para discutir as últimas tendências e desenvolvimentos no campo.</p>\r\n\r\n		<p style=\"font-size: 18px; line-height: 1.5;\">Nos últimos anos, temos visto um crescimento exponencial no setor aeroespacial, impulsionado pelo desenvolvimento de novas tecnologias e avanços significativos em áreas como a inteligência artificial, robótica e engenharia de materiais. A Empresa Aeroespacial tem sido líder nesse movimento, investindo em pesquisas inovadoras e desenvolvendo soluções avançadas para nossos clientes.</p>\r\n\r\n		<p style=\"font-size: 18px; line-height: 1.5;\">O nosso evento de inovação será uma oportunidade única para que as empresas líderes possam se reunir e discutir como a inovação pode impulsionar ainda mais a indústria aeroespacial. Esperamos que o evento reúna líderes de empresas de todo o mundo para discutir os últimos avanços em tecnologia e como eles podem ser aplicados no mercado aeroespacial.</p>\r\n\r\n		<p style=\"font-size: 18px; line-height: 1.5;\">O evento contará com palestras de renomados especialistas da indústria aeroespacial, bem como apresentações de empresas que estão liderando a inovação na indústria. Além disso, os participantes terão a oportunidade de se conectar com outros líderes do setor e trocar ideias e conhecimentos.</p>\r\n\r\n		<p style=\"font-size: 18px; line-height: 1.5;\">Estamos animados em sediar este evento de inovação e estamos ansiosos para receber empresas de todo o mundo em nosso campus. Esperamos que este evento ajude a impulsionar ainda mais a indústria aeroespacial, levando a avanços significativos que beneficiem a todos.</p>\r\n\r\n		<p style=\"font-size: 18px; line-height: 1.5;\">O evento será realizado no dia <strong>dd/mm/aaaa</strong> e estamos ansiosos para receber todos os participantes. Para se inscrever, visite o nosso site ou entre em contato conosco diretamente. Juntos, podemos liderar a indústria aeroespacial em direção ao futuro.</p>\r\n</div>', '#evento #embraer #inovação', 5, 'Junte-se a líderes da indústria aeroespacial em nosso evento de inovação para discutir as últimas tendências e avan', '2023-05-12 19:28:57'),
(17, 'MTYcpX0FIkQ38TmMpwsLMSAg4Rt1', 'Primeiros passos no foguetemodelismo - Projeto', '<div style=\"background-color: #f0f0f0; padding: 20px; border: 1px solid #ccc;\">\r\n<h2 style=\"color: #333;\">Criar um foguete caseiro com segurança</h2>\r\n<p>Criar um foguete caseiro pode ser um projeto empolgante e desafiador, mas também pode ser perigoso se não for feito corretamente. Neste guia passo a passo, vamos explicar como criar um foguete caseiro com segurança.</p>\r\n<h3 style=\"color: #333;\">Componentes necessários:</h3>\r\n<ul>\r\n  <li>Motor de foguete</li>\r\n  <li>Tubo de corpo</li>\r\n  <li>Nariz de ogiva</li>\r\n  <li>Barbatanas</li>\r\n  <li>Paraquedas</li>\r\n</ul>\r\n<p>Perigos:</p>\r\n<ul>\r\n  <li>Explosões</li>\r\n  <li>Queimaduras</li>\r\n  <li>Quedas</li>\r\n</ul>\r\n<p>Dicas de segurança:</p>\r\n<ul>\r\n  <li>Nunca lance um foguete em um local público ou perto de pessoas, animais ou propriedades.</li>\r\n  <li>Use equipamentos de proteção, como óculos de proteção e luvas, para se proteger do combustível do motor de foguete.</li>\r\n  <li>Instale o motor de foguete cuidadosamente, seguindo as instruções do fabricante.</li>\r\n  <li>Teste o foguete em uma escala menor antes de fazer o lançamento final.</li>\r\n  <li>Verifique as condições meteorológicas antes do lançamento para garantir que o vento esteja favorável.</li>\r\n  <li>Mantenha uma distância segura do local de lançamento e use um controle remoto para acionar o motor de foguete.</li>\r\n</ul>\r\n<p>Conclusão:</p>\r\n<p>Criar um foguete caseiro pode ser uma experiência emocionante e educativa. No entanto, é importante lembrar que isso pode ser perigoso e requer conhecimento técnico e práticas de segurança adequadas. Certifique-se de seguir as orientações deste guia e sempre consulte um profissional qualificado antes de iniciar um projeto como este.</p>\r\n</div>', '#foguete #tutorial #foguetemodelismo', 0, 'Um guia passo a passo para a criação de um foguete caseiro com segurança, abordando os componentes necessários', '2023-05-12 19:37:42');

-- --------------------------------------------------------

--
-- Estrutura da tabela `subcanais`
--

CREATE TABLE `subcanais` (
  `Id_Subcanal` int(11) NOT NULL,
  `Id_Grupo` int(11) NOT NULL,
  `nome` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `subcanais`
--

INSERT INTO `subcanais` (`Id_Subcanal`, `Id_Grupo`, `nome`) VALUES
(0, 80, 'Principal'),
(1, 80, 'Dicas'),
(2, 80, ' Torneios'),
(3, 80, ' Off-topic'),
(0, 81, 'Principal'),
(1, 81, 'Jatos americanos'),
(2, 81, ' Jatos chineses'),
(3, 81, ' Jatos russos'),
(4, 81, ' Jatos europeus'),
(5, 81, ' Dúvidas');

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
('3TXoCRHEy9TZJ4w5IPNCDizw91y2', 80),
('MTYcpX0FIkQ38TmMpwsLMSAg4Rt1', 81),
('MTYcpX0FIkQ38TmMpwsLMSAg4Rt1', 80);

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
('3TXoCRHEy9TZJ4w5IPNCDizw91y2', 'Rcoletto', 'rodrigofamilia1.rc@gmail.com', 0),
('BcORtUVHOndy0klSefwHyaST8gy1', 'Mauricio', 'mscoletto@gmail.com', 0),
('d2wD99X5rTPa0wnG4sn2bYqe5Eh2', 'Ahtemus', 'ahtemus21@gmail.com', 0),
('MTYcpX0FIkQ38TmMpwsLMSAg4Rt1', 'dino', 'teste2@gmail.com', 0),
('OmBdeo2HuXhI6PvCYROpkvO5Dzy2', 'prof', 'prof@gmail.com', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `avaliacao_post`
--
ALTER TABLE `avaliacao_post`
  ADD KEY `fk_avaliacao_post_Post1` (`Id_Post`),
  ADD KEY `fk_avaliacao_post_Usuário1` (`Id_User`);

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
-- Índices para tabela `subcanais`
--
ALTER TABLE `subcanais`
  ADD KEY `idSubcanal_IdGrupo_Estrangeira` (`Id_Grupo`);

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
  MODIFY `id_Comentario_Post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id_Grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de tabela `post`
--
ALTER TABLE `post`
  MODIFY `id_Post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `avaliacao_post`
--
ALTER TABLE `avaliacao_post`
  ADD CONSTRAINT `fk_avaliacao_post_Post1` FOREIGN KEY (`Id_Post`) REFERENCES `post` (`id_Post`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_avaliacao_post_Usuário1` FOREIGN KEY (`Id_User`) REFERENCES `usuário` (`Id_User`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Limitadores para a tabela `subcanais`
--
ALTER TABLE `subcanais`
  ADD CONSTRAINT `idSubcanal_IdGrupo_Estrangeira` FOREIGN KEY (`Id_Grupo`) REFERENCES `grupo` (`id_Grupo`);

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
