-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Fev-2024 às 18:50
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gestao`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `categoria` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `categoria`) VALUES
(11, 'Periféricos'),
(13, 'Software'),
(15, 'Rotina'),
(17, 'Hardware'),
(19, 'Projeto'),
(20, 'Ocorrencia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `certificado`
--

CREATE TABLE `certificado` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `dataInicial` datetime NOT NULL,
  `dataFinal` datetime NOT NULL,
  `observacao` text NOT NULL,
  `valor` int(11) NOT NULL,
  `ativo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `certificado`
--

INSERT INTO `certificado` (`id`, `nome`, `dataInicial`, `dataFinal`, `observacao`, `valor`, `ativo`) VALUES
(1, 'Certificado Bag', '2022-09-12 00:00:00', '2023-09-12 00:00:00', '', 221, 1),
(2, 'Certificado Enge', '2022-11-24 00:00:00', '2023-11-24 00:00:00', '', 221, 1),
(3, 'Certificado Ira', '2022-05-31 00:00:00', '2023-05-31 00:00:00', '', 221, 1),
(4, 'Certificado Emilson', '2022-09-20 00:00:00', '2023-09-20 00:00:00', '', 221, 1),
(5, 'Certificado Amilton', '2022-08-04 00:00:00', '2023-08-04 00:00:00', '', 221, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `chamados`
--

CREATE TABLE `chamados` (
  `id` int(11) NOT NULL,
  `grupo` varchar(22) NOT NULL,
  `nome` varchar(22) NOT NULL,
  `data` date NOT NULL,
  `dataFinal` date NOT NULL,
  `setor` varchar(22) NOT NULL,
  `observacao` varchar(240) NOT NULL,
  `categoria` varchar(22) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `chamados`
--

INSERT INTO `chamados` (`id`, `grupo`, `nome`, `data`, `dataFinal`, `setor`, `observacao`, `categoria`, `status`) VALUES
(1, '1', 'Diego', '2023-04-03', '0000-00-00', '9', 'tela queimou', '20', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `dominio`
--

CREATE TABLE `dominio` (
  `id` int(11) NOT NULL,
  `nome` varchar(70) NOT NULL,
  `dominio` varchar(60) NOT NULL,
  `dataFinal` date NOT NULL,
  `ativo` int(11) NOT NULL,
  `observacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `dominio`
--

INSERT INTO `dominio` (`id`, `nome`, `dominio`, `dataFinal`, `ativo`, `observacao`) VALUES
(1, 'Engebag', 'engebag.com.br', '2024-01-19', 1, 0),
(2, 'Engebag', 'engebag.net.br', '2027-09-29', 1, 0),
(3, 'Bag Cleaner', 'bagcleaner.com.br', '2022-05-25', 1, 0),
(4, 'Bag Cleaner', 'bagcleaner.net.br', '2027-10-02', 1, 0),
(5, 'IraFlex', 'iraflex.com.br', '2024-09-13', 1, 0),
(6, 'Iraflex', 'bigbag.ind.br', '2023-09-29', 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo`
--

CREATE TABLE `grupo` (
  `id` int(11) NOT NULL,
  `empresa` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `grupo`
--

INSERT INTO `grupo` (`id`, `empresa`) VALUES
(1, 'Engebag'),
(2, 'Bag Cleaner');

-- --------------------------------------------------------

--
-- Estrutura da tabela `hd_departments`
--

CREATE TABLE `hd_departments` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `hd_departments`
--

INSERT INTO `hd_departments` (`id`, `name`, `status`) VALUES
(14, 'Diretoria', 1),
(16, 'Comercial', 1),
(17, 'Compras', 1),
(18, 'Expedição', 1),
(19, 'Financeiro', 1),
(20, 'Gerente Industrial', 1),
(21, 'Manutenção', 1),
(22, 'Operacional', 1),
(23, 'Pcp', 1),
(24, 'Processo', 1),
(25, 'Qualidade', 1),
(26, 'Rh', 1),
(27, 'Faturamento', 1),
(28, 'Logística', 1),
(29, 'Recepção', 1),
(30, 'T.I', 1),
(31, 'Desenvolvimento', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `hd_tickets`
--

CREATE TABLE `hd_tickets` (
  `id` int(11) NOT NULL,
  `uniqid` varchar(20) NOT NULL,
  `user` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `init_msg` text NOT NULL,
  `department` int(11) NOT NULL,
  `date` varchar(250) NOT NULL,
  `last_reply` int(11) NOT NULL,
  `user_read` int(11) NOT NULL,
  `admin_read` int(11) NOT NULL,
  `resolved` int(11) NOT NULL,
  `finalizados` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `hd_tickets`
--

INSERT INTO `hd_tickets` (`id`, `uniqid`, `user`, `title`, `init_msg`, `department`, `date`, `last_reply`, `user_read`, `admin_read`, `resolved`, `finalizados`) VALUES
(13, '65ce3c950c722', 5, 'mouse quebrado', 'teste', 16, '1708014741', 5, 0, 1, 1, 0),
(15, '65ce6f7729450', 5, 'teclado não funciona', 'ressss			', 24, '1708027767', 5, 0, 1, 1, 0),
(16, '65ce6f8098c35', 5, 'tela preta', 'qqqqq		', 18, '1708027776', 5, 0, 1, 0, 0),
(17, '65cf5dd060840', 10, 'mouse quebrado', 'meu mouse parou\r\n', 18, '1708088784', 5, 1, 1, 0, 0),
(18, '65d3312144519', 13, 'cameras', 'cameras paradas				', 24, '1708339489', 13, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `hd_ticket_replies`
--

CREATE TABLE `hd_ticket_replies` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `text` text NOT NULL,
  `ticket_id` text NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `hd_ticket_replies`
--

INSERT INTO `hd_ticket_replies` (`id`, `user`, `text`, `ticket_id`, `date`) VALUES
(109, 5, 'olaaa\r\n', '16', '1708088704'),
(110, 5, 'o que houve ?\r\n', '17', '1708088806'),
(111, 10, 'ele parou do nada\r\n', '17', '1708088837'),
(112, 10, 'vc tem um reserva ?\r\n', '17', '1708089074'),
(113, 5, 'tenho vou levar ai\r\n', '17', '1708089109'),
(114, 5, 'tenho vou levar ai\r\n', '17', '1708089109'),
(115, 5, 'tenho\r\n', '17', '1708089126'),
(116, 5, 'tenho\r\n', '17', '1708089126'),
(117, 10, 'tem ?\r\n', '17', '1708089134'),
(118, 10, 'tem ?\r\n', '17', '1708089134'),
(119, 5, 'vou levar ai\r\n', '17', '1708089261'),
(120, 5, 'vou levar ai\r\n', '17', '1708089261'),
(121, 10, 'ok', '17', '1708089371'),
(122, 10, 'ok', '17', '1708089371'),
(123, 5, 'oi\r\n', '17', '1708089474'),
(124, 5, 'oi\r\n', '17', '1708089474'),
(125, 5, 'ola\r\n', '17', '1708089498'),
(126, 10, 'blz\r\n', '17', '1708089528'),
(127, 5, '5555\r\n', '17', '1708091962'),
(128, 10, '555555\r\n\r\n\r\n', '17', '1708092294'),
(129, 5, 'tesedt\r\n', '17', '1708092366'),
(130, 5, 'ttttttt\r\n', '17', '1708092396'),
(131, 5, '553333\r\n', '17', '1708092446'),
(132, 5, 'ola\r\n', '17', '1708092725'),
(133, 5, '3\r\n', '17', '1708092762'),
(134, 10, 'olaa\r\n', '17', '1708093820'),
(135, 5, 'f\r\n', '17', '1708094185'),
(136, 5, 'a\r\n', '17', '1708094758'),
(137, 5, 'dd\r\n', '17', '1708094875'),
(138, 5, 'ss\r\n', '17', '1708094905'),
(139, 5, 'a\r\n', '17', '1708094960'),
(140, 5, 'aaa\r\n', '17', '1708094980'),
(141, 10, '585858555\r\n', '17', '1708095002'),
(142, 5, 'ola\r\n', '17', '1708110000'),
(143, 5, 'ola\r\n', '15', '1708110314'),
(144, 13, 'bom dia, pode me ajudar ?\r\n', '18', '1708339506'),
(145, 5, 'bom dia \r\n', '18', '1708339536'),
(146, 13, 'obrigado\r\n', '18', '1708341338'),
(147, 5, 'de nada\r\n', '18', '1708341347'),
(148, 0, 'ola\r\n', '18', '1708350298'),
(149, 13, 'oi52582852', '18', '1708350455'),
(150, 13, 'oi52582852', '18', '1708350455'),
(151, 13, 'oi52582852', '18', '1708350455'),
(152, 13, 'oi52582852', '18', '1708350455'),
(153, 13, 'oi52582852', '18', '1708350455'),
(154, 13, 'oi52582852', '18', '1708350455'),
(155, 13, 'oi52582852', '18', '1708350455'),
(156, 13, 'oi52582852', '18', '1708350455'),
(157, 13, 'oi52582852', '18', '1708350455'),
(158, 13, 'oi52582852', '18', '1708350455'),
(159, 13, 'oi52582852', '18', '1708350455'),
(160, 13, 'oi52582852', '18', '1708350455'),
(161, 13, 'oi52582852', '18', '1708350455'),
(162, 13, 'oi52582852', '18', '1708350455'),
(163, 13, 'oi52582852', '18', '1708350455'),
(164, 13, 'oi52582852', '18', '1708350455'),
(165, 13, 'oi52582852', '18', '1708350455'),
(166, 13, 'oi52582852', '18', '1708350455'),
(167, 13, 'oi52582852', '18', '1708350455'),
(168, 13, 'oi52582852', '18', '1708350455'),
(169, 13, 'oi52582852', '18', '1708350455'),
(170, 13, 'oi52582852', '18', '1708350455'),
(171, 13, 'oi52582852', '18', '1708350455'),
(172, 13, 'oi52582852', '18', '1708350455'),
(173, 13, 'oi52582852', '18', '1708350455'),
(174, 13, 'oi52582852', '18', '1708350455'),
(175, 13, 'oi52582852', '18', '1708350455'),
(176, 13, 'oi52582852', '18', '1708350455'),
(177, 13, 'oi52582852', '18', '1708350455'),
(178, 13, 'oi52582852', '18', '1708350455'),
(179, 13, 'oi52582852', '18', '1708350455'),
(180, 13, 'oi52582852', '18', '1708350455'),
(181, 13, 'oi52582852', '18', '1708350455'),
(182, 13, 'oi52582852', '18', '1708350455'),
(183, 13, 'oi52582852', '18', '1708350455'),
(184, 13, 'oi52582852', '18', '1708350455'),
(185, 13, 'oi52582852', '18', '1708350455'),
(186, 13, 'oi52582852', '18', '1708350455'),
(187, 13, 'oi52582852', '18', '1708350455'),
(188, 13, 'oi52582852', '18', '1708350455'),
(189, 13, 'oi52582852', '18', '1708350455');

-- --------------------------------------------------------

--
-- Estrutura da tabela `hd_users`
--

CREATE TABLE `hd_users` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `name` varchar(250) NOT NULL,
  `user_type` enum('admin','user') NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `hd_users`
--

INSERT INTO `hd_users` (`id`, `email`, `password`, `create_date`, `name`, `user_type`, `status`) VALUES
(5, 'info@bagcleaner.com.br', '026f987b88a45a00d56e3668a3bcd321', '2024-02-07 16:17:19', 'Diego', 'admin', 1),
(6, 'amilton@bagcleaner.com.br', 'b8ee9c54beec15dca507f6bd71c33d27', '2024-02-14 15:56:09', 'Amilton', 'user', 1),
(7, 'emilson@bagcleaner.com.br', '1b68322ad7beda922594f1103b2e520a', '2024-02-14 15:56:48', 'Emilson', 'user', 1),
(8, 'manutencao@bagcleaner.com.br', '175fae25deb51ba6a09e8ffc054cdeb6', '2024-02-14 15:57:33', 'Antonio', 'user', 1),
(9, 'descarregamento@bagcleaner.com.br', '1d3c5ec6bdf8cb1e1855acc037514ed5', '2024-02-14 15:58:32', 'Descarregamento', 'user', 1),
(10, 'carregamento@bagcleaner.com.br', '7d52a1c6a58d191a19e4c0cf9e082c2b', '2024-02-14 15:59:13', 'João', 'user', 1),
(11, 'operacional@bagcleaner.com.br', '94d1e286c34b841771c8411625c7b7da', '2024-02-14 15:59:41', 'Samuel', 'user', 1),
(12, 'expedicao@bagcleaner.com.br', 'bc6190552d535fe47b63588a3f14393a', '2024-02-14 16:00:12', 'Expedição', 'user', 1),
(13, 'processo@bagcleaner.com.br', '0035473aafc746c9f136aaaa226c918b', '2024-02-14 16:00:43', 'Clayton', 'user', 1),
(14, 'qualidade@bagcleaner.com.br', 'b73cbf88e95d82e88d17d884b3f2bd77', '2024-02-14 16:01:08', 'Debora', 'user', 1),
(15, 'qualidade4@bagcleaner.com.br', 'dca063f57a8c14edd01d00a94eac8019', '2024-02-14 16:01:39', 'Beatriz', 'user', 1),
(16, 'qualidade3@bagcleaner.com.br', '82166e298a63c53fa18078d7e6ae462e', '2024-02-14 16:02:06', 'Larissa', 'user', 1),
(17, 'qualidade1@bagcleaner.com.br', '617eebb98edab3ef2ad1c2b6a83736bf', '2024-02-14 16:02:43', 'Beatriz Justino', 'user', 1),
(18, 'recepcao@bagcleaner.com.br', '1d58c619571cac3a861b8b5927cdb49b', '2024-02-14 16:03:29', 'Maria Thereza', 'user', 1),
(19, 'faturamento@bagcleaner.com.br', '9557ca3cc7f94428ad91a18b97fe4467', '2024-02-14 16:03:59', 'Vitoria', 'user', 1),
(20, 'logistica3@bagcleaner.com.br', '7cc9ae19a73d3310959655bbed0254d3', '2024-02-14 16:04:36', 'Carine', 'user', 1),
(21, 'logistica@bagcleaner.com.br', '8d7d695b1e009ddf8c4b9f69cb1adf5e', '2024-02-14 16:06:15', 'Alynne', 'user', 1),
(22, 'renato@bagcleaner.com.br', 'fd390484fbd4fe843c2cbe2bdc255b68', '2024-02-14 16:06:34', 'Renato', 'user', 1),
(23, 'franciane@bagcleaner.com.br', '92bdeab93852d48245d87eccd90bd908', '2024-02-14 16:07:16', 'Franciane', 'user', 1),
(24, 'recrutamento@bagcleaner.com.br', '8157facd577cac329c59ad1c4eed75e5', '2024-02-14 16:07:53', 'Paulo Ricardo', 'user', 1),
(25, 'recrutamento01@bagcleaner.com.br', '4a08f0aff06ff3b1fffc98a0bc8a19fe', '2024-02-14 16:08:26', 'Paulo Henrique', 'user', 1),
(26, 'qualidade2@bagcleaner.com.br', '86a6a722ce3847fc10625e008b22b3b4', '2024-02-14 16:10:58', 'new', 'user', 0),
(27, 'logistica2@bagcleaner.com.br', '29d7bd759843997c8f5d426fe8aabeba', '2024-02-14 16:11:36', 'new', 'user', 0),
(28, 'logistica4@bagcleaner.com.br', '2571bb6729cd68db615d51f52a301ef5', '2024-02-14 16:12:08', 'new', 'user', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico`
--

CREATE TABLE `historico` (
  `id` int(11) NOT NULL,
  `grupo` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `modeloEquipamento` varchar(30) NOT NULL,
  `setor` int(11) NOT NULL,
  `host` varchar(30) NOT NULL,
  `HD` varchar(30) NOT NULL,
  `SO` varchar(30) NOT NULL,
  `processador` varchar(30) NOT NULL,
  `memoria` varchar(30) NOT NULL,
  `IP` varchar(20) NOT NULL,
  `substituir` int(11) NOT NULL,
  `motivo` varchar(200) NOT NULL,
  `anydesk` varchar(20) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `licença` int(11) NOT NULL,
  `Quantidade` int(11) NOT NULL,
  `metros` int(11) NOT NULL,
  `unidade` int(11) NOT NULL,
  `ok` int(11) NOT NULL,
  `prazo` int(11) NOT NULL,
  `data` date NOT NULL,
  `ativo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `historicodeprojeto`
--

CREATE TABLE `historicodeprojeto` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `execucao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `historicohardware`
--

CREATE TABLE `historicohardware` (
  `id` int(11) NOT NULL,
  `periferico` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `ativo` int(11) NOT NULL,
  `dataEntrada` date NOT NULL,
  `valor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `historicohardware`
--

INSERT INTO `historicohardware` (`id`, `periferico`, `quantidade`, `ativo`, `dataEntrada`, `valor`) VALUES
(1, 61, 2, 0, '2021-07-01', 0),
(2, 110, 20, 0, '2021-08-04', 0),
(3, 110, 16, 0, '2021-08-04', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `historicoocorrencia`
--

CREATE TABLE `historicoocorrencia` (
  `id` int(20) NOT NULL,
  `idOcorrencia` int(20) NOT NULL,
  `ti` varchar(30) NOT NULL,
  `problema` varchar(30) NOT NULL,
  `dataFinal` datetime NOT NULL,
  `acao` text NOT NULL,
  `setor` int(20) NOT NULL,
  `tempo` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `historicoocorrencia`
--

INSERT INTO `historicoocorrencia` (`id`, `idOcorrencia`, `ti`, `problema`, `dataFinal`, `acao`, `setor`, `tempo`) VALUES
(2, 165, 'Roger', 'Servidor', '2021-08-11 00:00:00', 'Liberado acesso a pasta Recepção', 7, '00:05:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `historicosoftware`
--

CREATE TABLE `historicosoftware` (
  `id` int(11) NOT NULL,
  `soft` int(11) NOT NULL,
  `host` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `prazo` int(11) NOT NULL,
  `observacao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `historicosoftware`
--

INSERT INTO `historicosoftware` (`id`, `soft`, `host`, `quantidade`, `prazo`, `observacao`) VALUES
(3, 45, 42, 1, 7, ''),
(9, 45, 5, 1, 7, ''),
(10, 45, 32, 1, 7, 'Suporta Linux'),
(11, 45, 58, 1, 7, ''),
(12, 95, 86, 1, 7, ''),
(13, 95, 85, 1, 7, ''),
(14, 95, 5, 1, 7, 'Com aplicação web dispensa a licença MS-Office'),
(15, 45, 56, 1, 7, ''),
(16, 45, 33, 1, 7, 'Suporta Linux'),
(17, 45, 40, 1, 7, ''),
(18, 45, 106, 1, 7, ''),
(19, 45, 31, 1, 7, 'Suporta Linux'),
(20, 45, 11, 1, 7, 'Suporta Linux'),
(21, 45, 22, 1, 7, ''),
(22, 45, 43, 1, 7, ''),
(23, 45, 57, 1, 7, ''),
(24, 45, 34, 1, 7, 'Suporta Linux'),
(25, 45, 37, 1, 7, ''),
(26, 45, 36, 1, 7, ''),
(27, 45, 82, 1, 7, ''),
(28, 45, 80, 1, 7, ''),
(29, 45, 23, 1, 7, ''),
(30, 45, 14, 1, 7, ''),
(31, 45, 30, 1, 7, ''),
(32, 45, 28, 1, 0, 'Suporta Linux'),
(33, 45, 4, 1, 7, ''),
(34, 45, 12, 1, 7, ''),
(35, 240, 27, 1, 7, 'Manutenção Enge'),
(36, 45, 3, 1, 7, ''),
(37, 45, 25, 1, 7, ''),
(38, 45, 24, 1, 7, 'Suporta Linux'),
(39, 45, 8, 1, 7, ''),
(40, 240, 10, 1, 7, 'Qualidade 01'),
(41, 45, 13, 1, 7, ''),
(42, 45, 9, 1, 7, ''),
(43, 45, 26, 1, 7, ''),
(44, 45, 18, 1, 7, 'Suporta Linux'),
(45, 45, 16, 1, 7, 'Suporta Linux'),
(46, 45, 6, 1, 7, ''),
(47, 45, 7, 1, 7, ''),
(48, 45, 67, 1, 7, ''),
(49, 45, 21, 1, 7, ''),
(50, 98, 23, 1, 3, 'US$ 9.990,00 valor do Programa. Foi removido da máquina local.'),
(51, 109, 13, 1, 7, ''),
(52, 109, 30, 1, 7, ''),
(53, 99, 42, 1, 7, ''),
(54, 99, 32, 1, 7, ''),
(55, 99, 58, 1, 7, ''),
(56, 99, 56, 1, 7, ''),
(57, 99, 40, 1, 7, ''),
(58, 99, 106, 1, 7, ''),
(59, 99, 31, 1, 7, ''),
(60, 99, 22, 1, 7, ''),
(61, 99, 43, 1, 7, ''),
(62, 99, 57, 1, 7, ''),
(63, 99, 34, 1, 7, ''),
(64, 99, 37, 1, 7, ''),
(65, 99, 36, 1, 7, ''),
(66, 99, 87, 1, 7, ''),
(67, 99, 12, 1, 7, ''),
(68, 93, 42, 1, 7, ''),
(69, 93, 5, 1, 7, ''),
(70, 93, 32, 1, 7, ''),
(71, 93, 58, 1, 7, ''),
(72, 93, 56, 1, 7, ''),
(73, 93, 33, 1, 7, ''),
(74, 93, 40, 1, 7, ''),
(75, 93, 106, 1, 7, ''),
(76, 93, 31, 1, 7, ''),
(77, 93, 11, 1, 7, ''),
(78, 93, 22, 1, 7, ''),
(79, 93, 43, 1, 7, ''),
(80, 93, 57, 1, 7, ''),
(81, 93, 34, 1, 7, ''),
(82, 93, 37, 1, 7, ''),
(83, 93, 36, 1, 7, ''),
(84, 93, 82, 1, 7, ''),
(85, 93, 23, 1, 7, ''),
(86, 93, 14, 1, 7, ''),
(87, 93, 30, 1, 7, ''),
(88, 93, 4, 1, 7, ''),
(89, 93, 12, 1, 7, ''),
(90, 93, 3, 1, 7, ''),
(91, 93, 25, 1, 7, ''),
(92, 93, 24, 1, 7, ''),
(93, 93, 8, 1, 7, ''),
(94, 93, 10, 1, 7, ''),
(95, 93, 13, 1, 7, ''),
(96, 93, 9, 1, 7, ''),
(97, 93, 26, 1, 7, ''),
(98, 93, 18, 1, 7, ''),
(99, 93, 16, 1, 7, ''),
(100, 93, 6, 1, 7, ''),
(101, 93, 67, 1, 7, ''),
(102, 93, 21, 1, 7, ''),
(103, 93, 122, 1, 7, ''),
(104, 93, 19, 1, 7, ''),
(105, 93, 15, 1, 7, ''),
(106, 93, 20, 1, 7, ''),
(107, 93, 17, 1, 7, ''),
(108, 45, 135, 1, 7, ''),
(109, 45, 136, 1, 7, ''),
(110, 45, 83, 1, 7, 'Suporta Linux'),
(111, 45, 78, 1, 7, 'Suporta Linux'),
(112, 45, 81, 1, 7, ''),
(113, 45, 2, 1, 7, ''),
(114, 45, 138, 1, 7, ''),
(115, 45, 139, 1, 7, ''),
(116, 45, 79, 1, 7, ''),
(117, 45, 88, 1, 7, ''),
(119, 45, 85, 1, 7, ''),
(120, 45, 86, 1, 7, ''),
(121, 45, 133, 1, 7, 'Suporta Linux'),
(122, 45, 137, 1, 7, ''),
(123, 45, 87, 1, 7, ''),
(124, 240, 17, 1, 7, ''),
(125, 45, 20, 1, 7, ''),
(126, 45, 15, 1, 7, ''),
(127, 45, 122, 1, 7, ''),
(128, 96, 135, 1, 7, ''),
(129, 96, 136, 1, 7, ''),
(130, 96, 5, 1, 7, ''),
(131, 96, 58, 1, 7, ''),
(132, 96, 56, 1, 7, ''),
(133, 96, 22, 1, 7, ''),
(134, 96, 43, 1, 7, ''),
(135, 96, 57, 1, 7, ''),
(136, 96, 4, 1, 7, ''),
(137, 96, 12, 1, 7, ''),
(138, 96, 3, 1, 7, ''),
(139, 96, 6, 1, 7, ''),
(140, 96, 13, 1, 7, ''),
(141, 96, 31, 1, 7, ''),
(142, 96, 10, 1, 7, ''),
(143, 96, 42, 1, 7, ''),
(144, 97, 23, 1, 3, ''),
(145, 97, 122, 1, 7, ''),
(146, 97, 20, 1, 3, ''),
(147, 97, 67, 1, 3, ''),
(148, 97, 8, 1, 3, ''),
(149, 100, 25, 1, 7, ''),
(150, 100, 21, 1, 7, ''),
(151, 100, 139, 1, 7, ''),
(152, 100, 138, 1, 7, ''),
(153, 109, 135, 1, 7, ''),
(154, 109, 136, 1, 7, ''),
(155, 93, 135, 1, 7, ''),
(156, 93, 136, 1, 7, ''),
(157, 89, 135, 1, 7, ''),
(158, 89, 42, 1, 7, ''),
(159, 89, 5, 1, 7, ''),
(160, 89, 32, 1, 7, ''),
(161, 89, 58, 1, 7, ''),
(162, 89, 56, 1, 7, ''),
(163, 89, 33, 1, 7, ''),
(164, 89, 40, 1, 7, ''),
(165, 89, 106, 1, 7, ''),
(166, 89, 31, 1, 7, ''),
(167, 89, 11, 1, 0, ''),
(168, 89, 22, 1, 7, ''),
(169, 89, 43, 1, 7, ''),
(170, 89, 57, 1, 7, ''),
(171, 89, 34, 1, 7, ''),
(172, 89, 37, 1, 7, ''),
(173, 89, 36, 1, 7, ''),
(174, 89, 82, 1, 7, ''),
(175, 89, 23, 1, 7, ''),
(176, 89, 14, 1, 7, ''),
(177, 89, 30, 1, 7, ''),
(178, 89, 4, 1, 7, ''),
(179, 89, 12, 1, 7, ''),
(180, 89, 3, 1, 7, ''),
(181, 89, 25, 1, 7, ''),
(182, 89, 24, 1, 7, ''),
(183, 89, 136, 1, 7, ''),
(184, 89, 8, 1, 7, ''),
(185, 89, 1, 1, 7, ''),
(186, 89, 10, 1, 7, ''),
(187, 89, 13, 1, 7, ''),
(188, 89, 9, 1, 7, ''),
(189, 89, 26, 1, 7, ''),
(190, 89, 18, 1, 7, ''),
(191, 89, 16, 1, 7, ''),
(192, 89, 6, 1, 7, ''),
(193, 89, 67, 1, 7, ''),
(194, 89, 21, 1, 7, ''),
(195, 89, 122, 1, 7, ''),
(196, 89, 15, 1, 7, ''),
(197, 89, 20, 1, 7, ''),
(198, 89, 17, 1, 7, ''),
(199, 89, 87, 1, 7, ''),
(200, 89, 137, 1, 7, ''),
(201, 89, 134, 1, 7, ''),
(202, 89, 88, 1, 7, ''),
(203, 89, 79, 1, 7, ''),
(204, 89, 2, 1, 7, ''),
(205, 89, 81, 1, 7, ''),
(206, 89, 139, 1, 7, ''),
(207, 89, 138, 1, 7, ''),
(208, 89, 83, 1, 7, ''),
(209, 89, 78, 1, 7, ''),
(210, 93, 137, 1, 7, ''),
(211, 90, 42, 1, 7, ''),
(212, 90, 5, 1, 7, ''),
(213, 90, 4, 1, 7, ''),
(214, 90, 3, 1, 7, ''),
(215, 90, 43, 1, 7, ''),
(216, 90, 58, 1, 7, ''),
(217, 96, 138, 1, 7, ''),
(218, 96, 139, 1, 7, ''),
(219, 48, 142, 1, 7, ''),
(220, 146, 5, 1, 3, ''),
(221, 146, 142, 1, 3, ''),
(222, 159, 42, 1, 7, '1. Solução comprar licença SQL CALL.\r\n2. Migrar app feito em Access para o ambiente web'),
(223, 159, 58, 1, 7, ''),
(224, 159, 56, 1, 7, ''),
(225, 159, 33, 1, 7, ''),
(226, 159, 40, 1, 7, '1. Solução comprar licença SQL CALL.\r\n2. Migrar app feito em Access para o ambiente web'),
(227, 159, 106, 1, 7, '1. Solução comprar licença SQL CALL.\r\n2. Migrar app feito em Access para o ambiente web'),
(228, 159, 31, 1, 7, ''),
(229, 159, 43, 1, 7, ''),
(230, 159, 57, 1, 7, ''),
(231, 159, 34, 1, 7, ''),
(232, 159, 32, 1, 7, '1. Solução comprar licença SQL CALL.\r\n2. Migrar app feito em Access para o ambiente web'),
(233, 159, 37, 1, 7, '1. Solução comprar licença SQL CALL.\r\n2. Migrar app feito em Access para o ambiente web'),
(234, 159, 36, 1, 7, '1. Solução comprar licença SQL CALL.\r\n2. Migrar app feito em Access para o ambiente web'),
(235, 159, 82, 1, 7, ''),
(236, 159, 3, 1, 7, '1. Solução comprar licença SQL CALL.\r\n2. Migrar app feito em Access para o ambiente web'),
(237, 159, 12, 1, 7, '1. Solução comprar licença SQL CALL.\r\n2. Migrar app feito em Access para o ambiente web'),
(238, 159, 86, 1, 7, ''),
(239, 159, 85, 1, 7, ''),
(240, 159, 139, 1, 7, '1. Solução comprar licença SQL CALL.\r\n2. Migrar app feito em Access para o ambiente web'),
(241, 159, 138, 1, 7, '1. Solução comprar licença SQL CALL.\r\n2. Migrar app feito em Access para o ambiente web'),
(242, 159, 142, 1, 7, '1. Solução comprar licença SQL CALL.\r\n2. Migrar app feito em Access para o ambiente web'),
(243, 159, 81, 1, 7, '1. Solução comprar licença SQL CALL.\r\n2. Migrar app feito em Access para o ambiente web'),
(244, 240, 134, 1, 7, 'Produção');

-- --------------------------------------------------------

--
-- Estrutura da tabela `infra`
--

CREATE TABLE `infra` (
  `id` int(11) NOT NULL,
  `grupo` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `modeloEquipamento` varchar(30) NOT NULL,
  `setor` int(11) NOT NULL,
  `host` varchar(30) NOT NULL,
  `HD` varchar(30) NOT NULL,
  `SO` varchar(30) NOT NULL,
  `processador` varchar(30) NOT NULL,
  `memoria` varchar(30) NOT NULL,
  `IP` varchar(20) NOT NULL,
  `substituir` int(11) NOT NULL,
  `motivo` text NOT NULL,
  `anydesk` varchar(20) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `licenca` int(11) NOT NULL,
  `Quantidade` int(11) NOT NULL,
  `metros` int(11) NOT NULL,
  `unidade` int(11) NOT NULL,
  `ok` int(11) NOT NULL,
  `prazo` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `dataFinal` datetime NOT NULL,
  `ativo` int(11) NOT NULL,
  `observacao` varchar(200) NOT NULL,
  `categoria` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `windows` int(11) NOT NULL,
  `linux` int(11) NOT NULL,
  `Office` int(11) NOT NULL,
  `SolidWorks` int(11) NOT NULL,
  `sqlcall` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `infra`
--

INSERT INTO `infra` (`id`, `grupo`, `usuario`, `modeloEquipamento`, `setor`, `host`, `HD`, `SO`, `processador`, `memoria`, `IP`, `substituir`, `motivo`, `anydesk`, `nome`, `email`, `senha`, `licenca`, `Quantidade`, `metros`, `unidade`, `ok`, `prazo`, `data`, `dataFinal`, `ativo`, `observacao`, `categoria`, `status`, `windows`, `linux`, `Office`, `SolidWorks`, `sqlcall`) VALUES
(252, 1, '', '', 11, '', '', '', '', '', '', 0, '', '', 'Teste T.I.', '', '', 0, 0, 0, 0, 0, 0, '2023-02-24 00:00:00', '0000-00-00 00:00:00', 0, 'teste', 20, '1', 0, 0, 0, 0, 0),
(253, 1, '', '', 3, '', '', '', '', '', '', 0, '', '', 'Teste T.I.', '', '', 0, 0, 0, 0, 0, 0, '2023-02-25 00:00:00', '0000-00-00 00:00:00', 0, 'teste4', 20, '1', 0, 0, 0, 0, 0),
(254, 1, '', '', 11, '', '', '', '', '', '', 0, '', '', 'Teste T.I.', '', '', 0, 0, 0, 0, 0, 0, '2023-02-24 00:00:00', '0000-00-00 00:00:00', 0, 'ewewew', 20, '1', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(1, 378148901, 933193792, 'bom dia'),
(2, 933193792, 378148901, 'bom dia blz'),
(3, 933193792, 378148901, 'hahahaha deu certo '),
(4, 378148901, 933193792, 'teste'),
(5, 378148901, 933193792, '55'),
(6, 378148901, 141624862, 'ola'),
(7, 378148901, 141624862, 'ola');

-- --------------------------------------------------------

--
-- Estrutura da tabela `prazo`
--

CREATE TABLE `prazo` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `prazo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `prazo`
--

INSERT INTO `prazo` (`id`, `nome`, `prazo`) VALUES
(1, 'Diária', 1),
(2, 'Semanal', 7),
(3, 'Anual', 360),
(4, 'Semestral', 182),
(5, 'Quinzenal', 15),
(6, 'Mensal', 30),
(7, 'Vitalício', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `problemas`
--

CREATE TABLE `problemas` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `problemas`
--

INSERT INTO `problemas` (`id`, `nome`) VALUES
(1, 'PABX'),
(2, 'Cameras'),
(3, 'Hardware'),
(4, 'Software'),
(5, 'Internet'),
(6, 'Gerais'),
(7, 'Servidor'),
(8, 'Impressora'),
(9, 'Infra'),
(10, 'Banco de Dados'),
(11, 'Desenvolvimento');

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto`
--

CREATE TABLE `projeto` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `dataInicial` datetime NOT NULL,
  `dataFinal` datetime NOT NULL,
  `descricao` text NOT NULL,
  `prorrogacao` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `projeto`
--

INSERT INTO `projeto` (`id`, `nome`, `dataInicial`, `dataFinal`, `descricao`, `prorrogacao`, `status`) VALUES
(1, 'Câmera de monitoramento', '2021-08-17 00:00:00', '2021-08-20 00:00:00', 'Organizar o DVR; instalar 3 novas câmeras; mudar de posição duas câmeras na produção.', '0000-00-00 00:00:00', 1),
(2, 'Manutenção', '2021-07-12 00:00:00', '2021-08-30 00:00:00', 'Sistema versão 2.0 da manutenção para acompanhar horas trabalhadas das máquinas no segundo turno.', '0000-00-00 00:00:00', 1),
(3, 'Movimento 1.1.70', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Movimento 1.1.70 precisa ser corrigido o segundo número: Análise de como foi realizado e parametrizado, se possível corrigir o problema de auto-increment e campo liberado para alteração.', '0000-00-00 00:00:00', 1),
(4, 'Projeto Logistica', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 1),
(5, 'Relatório 88.07', '2021-08-09 00:00:00', '2021-08-24 00:00:00', 'Criar novo relatório ou corrigir a falha no campo de previções.', '0000-00-00 00:00:00', 1),
(6, 'Troca de Switch', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Substituição dos equipamentos na Engebag', '0000-00-00 00:00:00', 1),
(7, 'VPN', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Estabelecer uma conexão segura e rápida entre as empresas Bag Cleaner e Engebag.', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `rotina`
--

CREATE TABLE `rotina` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `prazo` int(11) NOT NULL,
  `observacao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `rotina`
--

INSERT INTO `rotina` (`id`, `nome`, `prazo`, `observacao`) VALUES
(1, 'Atualização do Site', 1, '07:30 e 13:10'),
(2, 'Relatório 88.07', 1, 'Execução manual no RM'),
(3, 'Manutenção nobreak', 4, 'Manutenção precisa ser realizar Semestralmente. Levantar pedido de cotação de empresas que realizam manutenção em nobreak'),
(4, 'Relatório 88.05', 1, 'Execução manual no RM');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `user_type` enum('admin','user') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `fname`, `lname`, `email`, `password`, `img`, `status`, `user_type`) VALUES
(1, 933193792, 'diego', 'silva', 'info@bagcleaner.com.br', '026f987b88a45a00d56e3668a3bcd321', 'transferir.jpg', 'Offline now', 'admin'),
(2, 378148901, 'admin', 'adm', 'info2@bagcleaner.com.br', '026f987b88a45a00d56e3668a3bcd321', '1708430308transferir (1).jpg', 'Active now', 'admin'),
(3, 141624862, 'Carine', 'Garcia', 'logistica3@bagcleaner.com.br', '7cc9ae19a73d3310959655bbed0254d3', '1708450153transferir (2).jpg', 'Active now', 'user');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `certificado`
--
ALTER TABLE `certificado`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `chamados`
--
ALTER TABLE `chamados`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `dominio`
--
ALTER TABLE `dominio`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `hd_departments`
--
ALTER TABLE `hd_departments`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `hd_tickets`
--
ALTER TABLE `hd_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `hd_ticket_replies`
--
ALTER TABLE `hd_ticket_replies`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `hd_users`
--
ALTER TABLE `hd_users`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `historicodeprojeto`
--
ALTER TABLE `historicodeprojeto`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `historicohardware`
--
ALTER TABLE `historicohardware`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `historicoocorrencia`
--
ALTER TABLE `historicoocorrencia`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `historicosoftware`
--
ALTER TABLE `historicosoftware`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `infra`
--
ALTER TABLE `infra`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Índices para tabela `prazo`
--
ALTER TABLE `prazo`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `problemas`
--
ALTER TABLE `problemas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `projeto`
--
ALTER TABLE `projeto`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `rotina`
--
ALTER TABLE `rotina`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `certificado`
--
ALTER TABLE `certificado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `chamados`
--
ALTER TABLE `chamados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `dominio`
--
ALTER TABLE `dominio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `hd_departments`
--
ALTER TABLE `hd_departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `hd_tickets`
--
ALTER TABLE `hd_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `hd_ticket_replies`
--
ALTER TABLE `hd_ticket_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT de tabela `hd_users`
--
ALTER TABLE `hd_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `historico`
--
ALTER TABLE `historico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `historicodeprojeto`
--
ALTER TABLE `historicodeprojeto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `historicohardware`
--
ALTER TABLE `historicohardware`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `historicoocorrencia`
--
ALTER TABLE `historicoocorrencia`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de tabela `historicosoftware`
--
ALTER TABLE `historicosoftware`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT de tabela `infra`
--
ALTER TABLE `infra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;

--
-- AUTO_INCREMENT de tabela `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `prazo`
--
ALTER TABLE `prazo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `problemas`
--
ALTER TABLE `problemas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `projeto`
--
ALTER TABLE `projeto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `rotina`
--
ALTER TABLE `rotina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
