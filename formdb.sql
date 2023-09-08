-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08-Set-2023 às 21:54
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
-- Banco de dados: `formdb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `formcampos`
--

CREATE TABLE `formcampos` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `formcampos`
--

INSERT INTO `formcampos` (`id`, `name`, `tipo`) VALUES
(13, 'lista', 'select'),
(14, 'lista2', 'select'),
(15, 'lista2', 'select'),
(16, 'sol', 'select'),
(17, 'teste3', 'select'),
(18, 'Finalidade', 'select'),
(19, 'Cidade', 'select');

-- --------------------------------------------------------

--
-- Estrutura da tabela `opcaocampo`
--

CREATE TABLE `opcaocampo` (
  `id` int(11) NOT NULL,
  `id_formcampo` int(11) DEFAULT NULL,
  `nome_opcao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `opcaocampo`
--

INSERT INTO `opcaocampo` (`id`, `id_formcampo`, `nome_opcao`) VALUES
(1, 13, '[\"teste\"'),
(2, 13, '\"teste2\"]'),
(3, 14, '[\"item1\"'),
(4, 14, '\"item2\"]'),
(5, 15, '[\"item1\"'),
(6, 15, '\"item2\"]'),
(7, 16, '[\"terra\"'),
(8, 16, '\"lua\"]'),
(9, 17, 'item5'),
(10, 17, 'item 8'),
(11, 18, 'aluguel'),
(12, 18, 'venda'),
(13, 19, 'Prudente '),
(14, 19, 'Colocado');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `formcampos`
--
ALTER TABLE `formcampos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `opcaocampo`
--
ALTER TABLE `opcaocampo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_formcampo` (`id_formcampo`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `formcampos`
--
ALTER TABLE `formcampos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `opcaocampo`
--
ALTER TABLE `opcaocampo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `opcaocampo`
--
ALTER TABLE `opcaocampo`
  ADD CONSTRAINT `opcaocampo_ibfk_1` FOREIGN KEY (`id_formcampo`) REFERENCES `formcampos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
