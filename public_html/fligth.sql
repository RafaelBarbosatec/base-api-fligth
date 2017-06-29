-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 29/06/2017 às 18:20
-- Versão do servidor: 5.5.55-0ubuntu0.14.04.1
-- Versão do PHP: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `fligth`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `token_s`
--

CREATE TABLE IF NOT EXISTS `token_s` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_token` datetime NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Fazendo dump de dados para tabela `token_s`
--

INSERT INTO `token_s` (`cod`, `token`, `data_token`) VALUES
(1, '79063e8037fff16d297a1fe65136f1251126cddb2cc9870ecf8d653835538e85', '2017-06-29 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `Usuarios`
--

CREATE TABLE IF NOT EXISTS `Usuarios` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) NOT NULL,
  `sexo` enum('M','F') NOT NULL,
  `data` datetime NOT NULL,
  `token` text NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Fazendo dump de dados para tabela `Usuarios`
--

INSERT INTO `Usuarios` (`cod`, `nome`, `sexo`, `data`, `token`) VALUES
(1, 'Rafael', 'M', '2017-06-29 00:00:00', '123456'),
(2, 'Thais', 'F', '2017-06-08 00:00:00', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
