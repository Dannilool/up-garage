-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26/05/2026 às 22:47
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `up_garage`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `admins`
--

INSERT INTO `admins` (`id`, `email`, `senha`) VALUES
(1, 'admin@upgarage.com', '123456');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`) VALUES
(1, 'Lâmpadas'),
(2, 'Alto-Falantes'),
(3, 'Rádios'),
(4, 'Baterias');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagens_produto`
--

CREATE TABLE `imagens_produto` (
  `id` int(11) NOT NULL,
  `produto_id` int(11) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `imagens_produto`
--

INSERT INTO `imagens_produto` (`id`, `produto_id`, `imagem`) VALUES
(8, 1, 'D_NQ_NP_2X_796940-MLA99348910974_112025-F.webp'),
(17, 3, 'D_NQ_NP_2X_892341-MLB82201189375_012025-F.webp'),
(18, 3, 'D_NQ_NP_2X_609507-MLB81920408786_012025-F.webp'),
(19, 3, 'D_NQ_NP_2X_920020-MLB76807188606_062024-F.webp'),
(20, 1, 'D_NQ_NP_2X_675392-MLA99349314794_112025-F.webp'),
(21, 1, 'D_NQ_NP_2X_770310-MLA99831873647_112025-F.webp'),
(22, 1, 'D_NQ_NP_2X_824307-MLA99348911008_112025-F.webp'),
(23, 1, 'D_NQ_NP_2X_820510-MLA99348980424_112025-F.webp'),
(26, 2, 'D_NQ_NP_2X_679879-MLA93271597922_092025-F.webp'),
(27, 2, 'D_NQ_NP_2X_951477-MLA93688703789_092025-F.webp'),
(28, 2, 'D_NQ_NP_2X_819900-MLA93271637122_092025-F.webp'),
(29, 2, 'D_NQ_NP_2X_801956-MLA93689245481_092025-F.webp'),
(30, 2, 'D_NQ_NP_2X_903779-MLA99904674175_112025-F.webp'),
(31, 2, 'D_NQ_NP_2X_948213-MLA93688743501_092025-F (1).webp'),
(32, 2, 'D_NQ_NP_2X_763093-MLA93688733627_092025-F.webp'),
(37, 3, 'D_NQ_NP_2X_860706-MLB79890247000_102024-F.webp'),
(46, 6, 'D_NQ_NP_2X_875197-MLB89556587562_082025-F.webp'),
(47, 6, 'D_NQ_NP_2X_662600-MLB85691641861_062025-F.webp'),
(48, 6, 'D_NQ_NP_2X_853071-MLB85691780285_062025-F.webp');

-- --------------------------------------------------------

--
-- Estrutura para tabela `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `data_pedido` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido_produtos`
--

CREATE TABLE `pedido_produtos` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) DEFAULT NULL,
  `produto_id` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `preco`, `imagem`, `categoria_id`) VALUES
(1, 'Kit alto falantes Bravox', 'A Bravox possui uma longa trajetória e tradição na criação de produtos para veículos. A empresa se mantém como a principal fabricante de alto-falantes, pesquisando e desenvolvendo novos produtos com a mais alta tecnologia do mercado.\r\n\r\nSeu design moderno e acabamento sofisticado, com cone injetado em polipropileno e borda em Santoprene, melhora a durabilidade e a resposta sonora. Além disso, o tweeter Mylar e Midrange integrados proporcionam um som mais limpo e envolvente com tecnologia avançada e materiais duráveis, garante um desempenho excepcional, entregando graves impactantes, médios equilibrados e agudos cristalinos.', 86.00, '', 2),
(2, 'Radio Pioneer Bluetooth Automotivo Mvh-145br Usb Mp3 Fm', 'RÁDIO PIONEER MVH-145BR\r\n\r\n\r\nTecnologia, conectividade e potência para transformar o som do seu carro. O Rádio Pioneer MVH-145BR foi projetado para quem busca qualidade de áudio, praticidade e estilo no dia a dia. Com design moderno e interface intuitiva, ele traz recursos essenciais para deixar o sistema de som do seu carro mais completo e conectado.\r\n\r\n\r\nAlém de Bluetooth integrado para chamadas viva-voz e streaming de músicas, o MVH-145BR conta com entrada USB frontal, entrada auxiliar P2 e sintonizador FM/AM de alta precisão, garantindo versatilidade para ouvir suas músicas preferidas em qualquer formato.\r\n\r\n\r\nCompacto e robusto, é compatível com a maioria dos painéis 1DIN e oferece saída RCA para expansão do sistema com amplificadores e subwoofers, permitindo evoluir o seu projeto de som automotivo com total liberdade.\r\n\r\n\r\nENTRADA WR e SWC\r\n- Aceita comandos de volante (alguns carros precisam de interface de volante a ser adquirida separadamente)\r\n- Aceita controle de longa distância com compatibilidade WR e SWC (por exemplo: JFA Redline)\r\n\r\n\r\nDestaques Técnicos\r\n- Potência de saída: 4 x 23W RMS\r\n- Bluetooth integrado para chamadas e reprodução de áudio sem fio\r\n- Entrada USB frontal e entrada auxiliar P2\r\n- Compatibilidade com arquivos MP3 / WMA / WAV / FLAC\r\n- Sintonizador FM/AM com memória para estações\r\n- Saída RCA traseira para amplificadores externos\r\n- Equalizador gráfico de 5 bandas para ajuste fino do som\r\n- Display iluminado e teclas ergonômicas de fácil acesso\r\n- Função MIXTRAX (efeitos de DJ para transições de músicas)\r\n\r\n\r\nBenefícios para o Seu Som Automotivo\r\n- Som limpo, potente e de alta fidelidade\r\n- Facilidade de conexão com smartphones e pen drives\r\n- Design moderno que valoriza o interior do carro\r\n- Permite evolução do sistema com outros módulos e caixas\r\n- Marca Pioneer — sinônimo de qualidade e confiabilidade no mercado\r\n\r\n\r\nConteúdo da Embalagem\r\n- 1x Rádio Pioneer MVH-145BR\r\n- 1x Chicote de instalação\r\n- 1x Suporte e moldura de acabamento\r\n- 1x Manual do usuário', 325.00, '', 3),
(3, 'Bateria Moura 60ah M60gd 12v', 'A linha Moura foi projetada com uma nova tecnologia que garante maior durabilidade e melhor desempenho. Sua recarga mais rápida, retenção superior de energia e inovação em cada detalhe é o que fazem dela um exemplo de resistência e sustentabilidade.\r\nCom uma vida útil maior, essa bateria tem um excelente custo-benefício e a qualidade Moura que você confia. É a nossa energia para seu carro ir mais longe.\r\n\r\nEspecificações Técnicas:\r\nCódigo Produto: M60GD\r\nTensão: 12V\r\nAmperagem: 60Ah\r\nCCA: 460A\r\nTecnologia: Convencional\r\nPeso: 14,1Kg\r\nDimensões (Comp x Larg x Alt): 24,6cm x 17,5cm x 17,5cm\r\n\r\nConteúdo da Embalagem:\r\n01 x Bateria Moura 60Ah\r\n01 x Certificado de Garantia\r\n\r\n***Revendedor Autorizado Moura***\r\n\r\nImportante:\r\nRecomendamos que o produto seja instalado por um profissional especializado. Não nos responsabilizamos pelo mau uso do produto.\r\n\r\nNosso compromisso com o cliente:\r\n1 - Envio no máximo em 24 horas úteis.\r\n2 - Em caso de devoluções, o reembolso é feito no ato da postagem ou no máximo 24 horas após o produto chegar em nosso centro de distribuição.\r\n3 - Embalagens seguras contra quebras.\r\n4 - Qualidade e Entrega excelente.\r\n\r\nAPLICAÇÕES:\r\n\r\nAudi A3 1.6/1.8/2.0 (1997 a 2013)\r\nAudi S2/S4/S6 (1994 a 2012)\r\nChery Celer 1.5 16V Flex (2013 a 2018)\r\nChrysler 300M (1998 a 2001)\r\nCitroën Air Cross (2010 a 2018)\r\nCitroën C4 motor 1.6 e 2.0 (2006 a 2018)\r\nCitroën C5 (2001 a 2012)\r\nCitroën C8 (2003 a 2005)\r\nCitroën Grand C4 1.6 (2016 a 2018)\r\nFiat Argo (2018 a 2019)\r\nFiat Brava (1999 a 2003)\r\nFiat Bravo (2011 a 2016)\r\nFiat Cronos 1.3 e 1.8 (2018)\r\nDoblo E-Torq 1.6 ou 1.8 com ar-condicionado (2011 a 2018)\r\nFiat 500 (2015 a 2018)\r\nFiat Coupé (1995 a 1997)\r\nFiorino EVO 1.4 Flex com ar-condicionado (2010 a 2018)\r\nGrand Siena 1.6/1.8 (2012 a 2018)\r\nIdea E-Torq 1.6/1.8 com ar-condicionado (2011 a 2016)\r\nLinea 1.8/1.9 (2009 a 2016)\r\nMarea Sedan/Weekend (1998 a 2007)\r\nFiat Mobi (2016 a 2018)\r\nPalio 1.5/1.6/1.8 (1996 a 2018)\r\nPalio Weekend 1.5/1.6/1.8 (1996 a 2018)\r\nPunto 1.6/1.8 com ar-condicionado (2007 a 2018)\r\nStilo (2002 a 2011)\r\nUno Fire 1.0/1.4/1.6/1.8 com ar-condicionado (2010 a 2018)\r\nEcosport 2.0 (2018)\r\nFord Edge (2008 a 2012)\r\nCruze (2011 a 2018)\r\nS10/Blazer gasolina/diesel (2001 a 2011)\r\nSonic (2012 a 2015)\r\nTracker LT/LTZ (2014 a 2016)\r\nHonda Accord EX/SW/LX/Sedan (1998 a 2002)\r\nCivic 1.8/2.0 (2012 a 2018)\r\nCR-V 2.0 (2013 a 2018)\r\nHR-V (2014 a 2018)\r\nHonda Odyssey (1995 a 1998)\r\nElantra 1.8/2.0 (2012 a 2018)\r\nHB20 1.6 (2013 a 2018)\r\nI30 (2010 a 2018)\r\nHyundai Matrix (2002 a 2004)\r\nMazda 626 (1993 a 2000)\r\nMercedes-Benz Smart (2010 a 2018)\r\nMitsubishi Airtrek (2003 a 2008)\r\nMitsubishi ASX (2011 a 2018)\r\nMitsubishi Lancer (2010 a 2018)\r\nPajero TR4 (2004 a 2015)\r\nNissan Frontier (2002 a 2018)\r\nNissan Kicks (2016 a 2018)\r\nNissan Pathfinder 2.7/3.0/3.3/3.5 (2006 a 2010)\r\nNissan Sentra (2016 a 2018)\r\nNissan Xterra (2003 a 2009)\r\nPeugeot 206 com opcionais elétricos (1999 a 2012)\r\nPeugeot 207 com opcionais elétricos (2008 a 2015)\r\nPeugeot 2008 (2015 a 2018)\r\nPeugeot 306 (1994 a 2004)\r\nPeugeot 307 (2002 a 2012)\r\nPeugeot 308 (2012 a 2018)\r\nPeugeot 3008 (2010 a 2018)\r\nPeugeot 405 (1993 a 2000)\r\nPeugeot 406 2.0 (1997 a 2005)\r\nPeugeot 408 (2011 a 2016)\r\nPeugeot 508 (2012 a 2013)\r\nPeugeot Hoggar (2010 a 2013)\r\nPeugeot RCZ (2012 a 2015)\r\nClio (1996 a 2016)\r\nDuster aut (2012 a 2016)\r\nDuster Oroch (2016)\r\nLogan com opcionais elétricos (2007 a 2016)\r\nMegane 2.0 MEC (2005 a 2010)\r\nScenic (1999 a 2010)\r\nSymbol 1.6 (2009 a 2013)\r\nSubaru Forester (2009 a 2018)\r\nHilux CD flex/SW 4 flex (2017 a 2018)\r\nToyota RAV 4 (2006 a 2018)\r\nBora (1999 a 2011)\r\nCrossfox (2005 a 2018)\r\nFox (2003 a 2018)\r\nGol 1.6/1.8 (2007 a 2018)\r\nGolf 1.4 (2014 a 2018)\r\nGolf Highline 1.4 TSI autom (2014 a 2018)\r\nGolf GTi 2.0 TSI autom (2014 a 2018)\r\nGolf Variant Highline 1.4 TSI autom (2015 a 2018)\r\nJetta 1.4 (2014 a 2018)\r\nNew Beetle (1999 a 2010)\r\nParati 1.6 Mi/1.8Mi/2.0Mi (1997 a 2013)\r\nPassat 1.8 (1990 a 2005)\r\nPolo 1.6/1.8/2.0 (2003 a 2015)\r\nSaveiro Mi 1.8/2.0 (1997 a 2009)\r\nSpacecross (2011 a 2017)\r\nSpacefox (2006 a 2018)\r\nVoyage 1.6 (2009 a 2018)\r\nVolvo 440-1.8/460-1.8/850-2.3/850-2.5/940-2.3/960 Sedan (1991 a 1997)\r\nVolvo C30/C70 (1998 a 2012)\r\nVolvo S40/S60/S70/S80-2.9 (1996 a 2010)\r\nVolvo V40 (1997 a 2018)\r\nVolvo V70 (1997 a 2007)\r\n\r\n***Principais aplicações***\r\n\r\nAlfa Romeo 145/147/155 (1984 a 1999)\r\nBMW 318 (1991 a 1999)\r\nChery Cielo (2010 a 2013)\r\nChery Face (2010 a 2015)\r\nCitroën Berlingo (1998 a 2007)\r\nCitroën BX (1992 a 1999)\r\nCitroën Xantia (1994 a 2002)\r\nCitroën XM (1991 a 2000)\r\nCitroën ZX (1991 a 1998)\r\nDaewoo Espero (1994 a 1997)\r\nDaewoo Leganza (1997 a 1999)\r\nDaewoo Nubira (1998 a 2002)\r\nFiat Tipo álcool e gasolina (1994 a 1997)\r\nEcosport 1.6 aut/2.0 (2003 a 2017)\r\nEscort álcool e gasolina (1993 a 2003)\r\nFord Focus (2014 a 2018)\r\nFord Fusion gasolina 2.0/2.5 (2006 a 2018)\r\nFord KA 1.0/1.5 16V (2014 a 2018)\r\nNew Fiesta 1.6 L 16V flex (2010 a 2018)\r\nFord Transit (2009 a 2014)\r\nVerona álcool e gasolina (1989 a 1997)\r\nVersailles gasolina (1991 a 1997)\r\nAstra (1995 a 2013)\r\nClassic (2010 a 2016)\r\nCorsa/Pick Up com opcionais elétricos (1994 a 2018)\r\nCorvette (2011 a 2016)\r\nIpanema (1991 a 1998)\r\nKadett (1989 a 1998)\r\nMalibu (2010 a 2013)\r\nMeriva (2002 a 2013)\r\nMontana (2003 a 2018)\r\nMonza (1982 a 1998)\r\nOmega/Suprema 2.0/2.2 (1992 a 2002)\r\nPrisma 1.4 Joy/Maxx (2007 a 2012)\r\nTigra (1998 a 1999)\r\nTracker gasolina (2006 a 2013)\r\nVectra (1993 a 2011)\r\nZafira (2001 a 2013)\r\nHyundai Accent (1992 a 2001)\r\nJAC J3 (2010 a 2015)\r\nJAC J5 (2010 a 2016)\r\nJAC J6 (2010 a 2016)\r\nJeep MJS V12 (1995 a 2018)\r\nKIA Sephia (1993 a 2001)\r\nKIA Shuma (1999 a 2001)\r\nMazda MPV (1992 a 2000)\r\nMazda MX-3 (1993 a 2009)\r\nMazda MX-5 (1992 a 2006)\r\nMazda Protegé (1992 a 2018)\r\nMercedes Classe A-160/A-190 (1999 a 2005)\r\nRenault Express (1998 a 2003)\r\nLaguna (1996 a 2006)\r\nMégane (1997 a 2004)\r\nTrafic (1997 a 2005)\r\nSeat Cordoba (1995 a 2004)\r\nSeat Ibiza (1995 a 2004)\r\nSeat Inca (1999 a 2002)\r\nSubaru Forester (1998 a 2008)\r\nSubaru Impreza (1993 a 2001)\r\nSubaru Legacy (1992 a 2001)\r\nTroller T4 gasolina (2001 a 2018)\r\nGol 1.6/1.8/2.0 (1987 a 2006)\r\nGolf (1994 a 2013)\r\nKombi (2005 a 2014)\r\nParati L/LS/C/CL/GL/GLS (1987 a 1999)\r\nPolo Classic (1997 a 2002)\r\nSaveiro L/LS/C/CL/GL/Summer (1994 a 2002)\r\nVoyage L/LS/Plus/GLS/S/Sport/Super (1987 a 1995)\r\n\r\nGarantia de fábrica: 24 meses', 551.08, '', 4),
(6, 'Kit Lâmpada Led Philips Ultinon Classic Nano 1:1 3500k', 'Atualize a iluminação dos seus faróis sem comprometer seu estilo! As lâmpadas Led Philips Ultinon Classic projetam uma luz suave e elegante. Comparável as lâmpadas halógenas, oferece um ganho de 80% na luminosidade. Além disso, seu formato compacto e tecnologia plug and play possibilita a instalação na maioria dos carros sem precisar de adaptações.\r\n\r\nEspecificações técnicas\r\n\r\nModelo: Philips Ultinon Classic\r\nTecnologia: LED\r\nTemperatura de Cor: 3500K (amarela)\r\nTensão: 12V\r\nPotência: 20W\r\nFluxo Luminoso: 1500 lúmens\r\nVida Útil: Até 1500 horas\r\nCompatibilidade: Encaixe H4/H19\r\nResistência: IP65 (à prova d\'água e poeira)', 450.00, NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos_marcas`
--

CREATE TABLE `produtos_marcas` (
  `produto_id` int(11) NOT NULL,
  `marca_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `imagens_produto`
--
ALTER TABLE `imagens_produto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices de tabela `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Índices de tabela `pedido_produtos`
--
ALTER TABLE `pedido_produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Índices de tabela `produtos_marcas`
--
ALTER TABLE `produtos_marcas`
  ADD PRIMARY KEY (`produto_id`,`marca_id`),
  ADD KEY `marca_id` (`marca_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `imagens_produto`
--
ALTER TABLE `imagens_produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de tabela `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedido_produtos`
--
ALTER TABLE `pedido_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `imagens_produto`
--
ALTER TABLE `imagens_produto`
  ADD CONSTRAINT `imagens_produto_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`);

--
-- Restrições para tabelas `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`);

--
-- Restrições para tabelas `pedido_produtos`
--
ALTER TABLE `pedido_produtos`
  ADD CONSTRAINT `pedido_produtos_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `pedido_produtos_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`);

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Restrições para tabelas `produtos_marcas`
--
ALTER TABLE `produtos_marcas`
  ADD CONSTRAINT `produtos_marcas_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`),
  ADD CONSTRAINT `produtos_marcas_ibfk_2` FOREIGN KEY (`marca_id`) REFERENCES `marcas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
