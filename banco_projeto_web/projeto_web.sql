-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 05/09/2013 às 16h09min
-- Versão do Servidor: 5.5.16
-- Versão do PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `projeto_web`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `publicacao`
--

CREATE TABLE IF NOT EXISTS `publicacao` (
  `id_publicacao` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` int(10) unsigned NOT NULL,
  `pub_data` datetime DEFAULT NULL,
  `pub_mensagem` varchar(200) DEFAULT NULL,
  `pub_url` varchar(200) DEFAULT NULL,
  `pub_tipo_midia` tinyint(3) unsigned DEFAULT NULL,
  `pub_n_acesso` int(10) unsigned DEFAULT NULL,
  `pub_autor` varchar(100) DEFAULT NULL,
  `pub_titulo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_publicacao`),
  KEY `FKusuario_publicacao` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usu_nome` varchar(100) DEFAULT NULL,
  `usu_sobrenome` varchar(100) DEFAULT NULL,
  `usu_login` varchar(20) DEFAULT NULL,
  `usu_data_nascimento` date DEFAULT NULL,
  `usu_email` varchar(200) DEFAULT NULL,
  `usu_senha` varchar(100) DEFAULT NULL,
  `usu_status_email` tinyint(3) unsigned DEFAULT '0',
  `usu_foto` varchar(100) DEFAULT 'padrao.jpg',
  `usu_descricao` text,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usu_nome`, `usu_sobrenome`, `usu_login`, `usu_data_nascimento`, `usu_email`, `usu_senha`, `usu_status_email`, `usu_foto`, `usu_descricao`) VALUES
(1, 'Anderson', NULL, NULL, NULL, 'andersonfelipe85@hotmail.com', NULL, NULL, 'padrao.png', NULL),
(2, 'Anderson', 'Cruz', 'andersonflipe', '0000-00-00', 'andersonlipe.f@gmail.com', '81dc9bdb52', 0, 'padrao.png', NULL),
(3, 'Anderson', 'Cruz', 'andersonflipe', '1969-12-31', 'andersonlipe.f@gmail.com', '81dc9bdb52', 0, 'padrao.png', NULL),
(4, 'Anderson', 'Souza', 'anderson', '0000-00-00', 'aninhacruz85@hotmail.com', '202cb962ac', 0, 'padrao.png', NULL),
(5, 'Felipe Anderson', 'Cruz', 'andersonn', '2011-01-02', 'andersonfelipe@cartago.net.br', '4829322d03', 0, 'padrao.png', NULL),
(6, 'Anderson', 'Cruz', 'kdjakdsa', '2009-05-03', 'alexlampada@gmail.com', '4829322d03', 0, 'padrao.png', NULL),
(7, 'Anderson', 'Felipe', 'daskdjsa', '2008-06-03', 'marcus.vinicius97@hotmail.com', '4829322d03', 0, 'padrao.png', NULL),
(8, 'Nome', 'Sobrenome', 'Escolha seu usuÃ¡rio', '0000-00-00', 'E-mail', 'ff64a1c434', 0, 'padrao.png', NULL),
(9, 'Nome', 'Sobrenome', 'Escolha seu usuÃ¡rio', '0000-00-00', 'E-mail', 'ff64a1c434', 0, 'padrao.png', NULL),
(10, 'Dasd', 'dads', 'dasdas', '2007-06-04', 'teste@teste.com.br', '4829322d03', 0, 'padrao.png', NULL),
(11, 'Dasd', 'dads', 'dasdas', '2007-06-04', 'teste@teste.com.br', '4829322d03', 0, 'padrao.png', NULL),
(12, 'fsafkja', 'jjaijdai', 'jdiaijdai', '2011-04-15', 'dsadsa@fasfas.com', '202cb962ac', 0, 'padrao.png', NULL),
(13, 'Daniela', 'Cruz', 'danicruz', '2013-06-12', 'dani@gmail.com', '202cb962ac', 0, 'padrao.png', NULL),
(14, 'ANderson', 'Feliep', 'jfkdsakdjas', '2011-02-01', 'kdjsakdsa@afak.com', '4829322d03', 0, 'padrao.png', NULL),
(15, 'Anderson', 'das', 'dasfas', '2010-03-03', 'dashjdhas@gmail.co', '5ca2aa845c', 0, 'padrao.png', NULL),
(16, 'felipe', 'Cruz', 'felipecruz', '0000-00-00', 'felipe@teste.com.br', '202cb962ac59075b964b07152d234b70', 0, 'padrao.png', NULL),
(17, 'Anderson', 'Cruz', 'daksldksa', '2010-04-02', 'email@teste.com', '4829322d03d1606fb09ae9af59a271d3', 0, 'padrao.jpg', NULL),
(18, 'Anderson', 'Cruz', 'daksldksa', '2008-04-03', 'email@teste.com', 'c20ad4d76fe97759aa27a0c99bff6710', 0, 'padrao.jpg', NULL),
(19, 'Anderson', 'gfdfgdsfds', 'gff', '2013-01-02', 'andersonlipef@gmail.com', '89ba023086e37a345839e0c6a0d272eb', 0, 'padrao.jpg', NULL);

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `publicacao`
--
ALTER TABLE `publicacao`
  ADD CONSTRAINT `publicacao_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
