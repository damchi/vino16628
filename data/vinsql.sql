-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 12, 2019 at 07:25 PM
-- Server version: 5.7.21
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `vinotest`
--

-- --------------------------------------------------------

--
-- Table structure for table `vino__bouteille`
--

CREATE TABLE `vino__bouteille` (
  `id_bouteille` int(11) NOT NULL,
  `id_cellier` int(11) NOT NULL,
  `nom` varchar(200) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `code_saq` varchar(50) DEFAULT NULL,
  `pays` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `url_saq` varchar(200) DEFAULT NULL,
  `url_img` varchar(200) DEFAULT NULL,
  `format` varchar(20) DEFAULT NULL,
  `date_achat` date DEFAULT NULL,
  `garde_jusqua` varchar(200) DEFAULT NULL,
  `notes` varchar(200) DEFAULT NULL,
  `prix` float DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `millesime` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vino__bouteille`
--

INSERT INTO `vino__bouteille` (`id_bouteille`, `id_cellier`, `nom`, `image`, `code_saq`, `pays`, `description`, `url_saq`, `url_img`, `format`, `date_achat`, `garde_jusqua`, `notes`, `prix`, `quantite`, `millesime`, `type`) VALUES
(1, 1, 'Bouteille damien 1', '//s7d9.scene7.com/is/image/SAQ/13774945_is?$saq%2Dprod%2Dtra$', NULL, 'france', 'bouteille de rouge', NULL, '', '75ml', '2019-03-05', '3ans', 'Bon', 230, 12, 2005, 1),
(2, 1, 'bouteille damien 2', '//s7d9.scene7.com/is/image/SAQ/13774945_is?$saq%2Dprod%2Dtra$', NULL, 'france', 'Vin blance test', NULL, '', '1l', '2018-12-10', '5ans', 'poisson', 30, 15, 2015, 2),
(5, 6, 'Bouteille julien 1', '//s7d9.scene7.com/is/image/SAQ/13774945_is?$saq%2Dprod%2Dtra$', NULL, 'France', 'Vin rouge julien', NULL, '', '75ml', '2019-03-05', '4ans', 'fromage', 20, 2, 2010, 1),
(6, 7, 'Bouteille julien 2', '//s7d9.scene7.com/is/image/SAQ/13774945_is?$saq%2Dprod%2Dtra$', NULL, 'France', 'vin blanc ', NULL, '', '75ml', '2019-03-11', '5ans', 'poisson', 34, 20, 2000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `vino__bouteille__saq`
--

CREATE TABLE `vino__bouteille__saq` (
  `id_bouteille_saq` int(11) NOT NULL,
  `nom` varchar(200) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `code_saq` varchar(50) DEFAULT NULL,
  `pays` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `prix_saq` float DEFAULT NULL,
  `url_saq` varchar(200) DEFAULT NULL,
  `url_img` varchar(200) DEFAULT NULL,
  `format` varchar(20) DEFAULT NULL,
  `type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vino__bouteille__saq`
--

INSERT INTO `vino__bouteille__saq` (`id_bouteille_saq`, `nom`, `image`, `code_saq`, `pays`, `description`, `prix_saq`, `url_saq`, `url_img`, `format`, `type`) VALUES
(1, 'Borsao Seleccion', '//s7d9.scene7.com/is/image/SAQ/10324623_is?$saq-rech-prod-gril$', '10324623', 'Espagne', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 10324623', 11, 'https://www.saq.com/page/fr/saqcom/vin-rouge/borsao-seleccion/10324623', '//s7d9.scene7.com/is/image/SAQ/10324623_is?$saq-rech-prod-gril$', ' 750 ml', 1),
(2, 'Monasterio de Las Vinas Gran Reserva', '//s7d9.scene7.com/is/image/SAQ/10359156_is?$saq-rech-prod-gril$', '10359156', 'Espagne', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 10359156', 19, 'https://www.saq.com/page/fr/saqcom/vin-rouge/monasterio-de-las-vinas-gran-reserva/10359156', '//s7d9.scene7.com/is/image/SAQ/10359156_is?$saq-rech-prod-gril$', ' 750 ml', 1),
(3, 'Castano Hecula', '//s7d9.scene7.com/is/image/SAQ/11676671_is?$saq-rech-prod-gril$', '11676671', 'Espagne', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 11676671', 12, 'https://www.saq.com/page/fr/saqcom/vin-rouge/castano-hecula/11676671', '//s7d9.scene7.com/is/image/SAQ/11676671_is?$saq-rech-prod-gril$', ' 750 ml', 1),
(4, 'Campo Viejo Tempranillo Rioja', '//s7d9.scene7.com/is/image/SAQ/11462446_is?$saq-rech-prod-gril$', '11462446', 'Espagne', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 11462446', 14, 'https://www.saq.com/page/fr/saqcom/vin-rouge/campo-viejo-tempranillo-rioja/11462446', '//s7d9.scene7.com/is/image/SAQ/11462446_is?$saq-rech-prod-gril$', ' 750 ml', 1),
(5, 'Bodegas Atalaya Laya 2017', '//s7d9.scene7.com/is/image/SAQ/12375942_is?$saq-rech-prod-gril$', '12375942', 'Espagne', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 12375942', 17, 'https://www.saq.com/page/fr/saqcom/vin-rouge/bodegas-atalaya-laya-2017/12375942', '//s7d9.scene7.com/is/image/SAQ/12375942_is?$saq-rech-prod-gril$', ' 750 ml', 1),
(6, 'Vin Vault Pinot Grigio', '//s7d9.scene7.com/is/image/SAQ/13467048_is?$saq-rech-prod-gril$', '13467048', 'États-Unis', 'Vin blanc\r\n         \r\n      \r\n      \r\n      États-Unis, 3 L\r\n      \r\n      \r\n      Code SAQ : 13467048', NULL, 'https://www.saq.com/page/fr/saqcom/vin-blanc/vin-vault-pinot-grigio/13467048', '//s7d9.scene7.com/is/image/SAQ/13467048_is?$saq-rech-prod-gril$', ' 3 L', 2),
(7, 'Huber Riesling Engelsberg 2017', '//s7d9.scene7.com/is/image/SAQ/13675841_is?$saq-rech-prod-gril$', '13675841', 'Autriche', 'Vin blanc\r\n         \r\n      \r\n      \r\n      Autriche, 750 ml\r\n      \r\n      \r\n      Code SAQ : 13675841', 22, 'https://www.saq.com/page/fr/saqcom/vin-blanc/huber-riesling-engelsberg-2017/13675841', '//s7d9.scene7.com/is/image/SAQ/13675841_is?$saq-rech-prod-gril$', ' 750 ml', 2),
(8, 'Dominio de Tares Estay Castilla y Léon 2015', '//s7d9.scene7.com/is/image/SAQ/13802571_is?$saq-rech-prod-gril$', '13802571', 'Espagne', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 13802571', 18, 'https://www.saq.com/page/fr/saqcom/vin-rouge/dominio-de-tares-estay-castilla-y-leon-2015/13802571', '//s7d9.scene7.com/is/image/SAQ/13802571_is?$saq-rech-prod-gril$', ' 750 ml', 1),
(9, 'Tessellae Old Vines Côtes du Roussillon 2016', '//s7d9.scene7.com/is/image/SAQ/12216562_is?$saq-rech-prod-gril$', '12216562', 'France', 'Vin rouge\r\n         \r\n      \r\n      \r\n      France, 750 ml\r\n      \r\n      \r\n      Code SAQ : 12216562', 21, 'https://www.saq.com/page/fr/saqcom/vin-rouge/tessellae-old-vines-cotes-du-roussillon-2016/12216562', '//s7d9.scene7.com/is/image/SAQ/12216562_is?$saq-rech-prod-gril$', ' 750 ml', 1),
(10, 'Tenuta Il Falchetto Bricco Paradiso -... 2015', '//s7d9.scene7.com/is/image/SAQ/13637422_is?$saq-rech-prod-gril$', '13637422', 'Italie', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Italie, 750 ml\r\n      \r\n      \r\n      Code SAQ : 13637422', 34, 'https://www.saq.com/page/fr/saqcom/vin-rouge/tenuta-il-falchetto-bricco-paradiso---barbera-dasti-superiore-docg-2015/13637422', '//s7d9.scene7.com/is/image/SAQ/13637422_is?$saq-rech-prod-gril$', ' 750 ml', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vino__cellier`
--

CREATE TABLE `vino__cellier` (
  `id_cellier` int(11) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `id_usager_cellier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vino__cellier`
--

INSERT INTO `vino__cellier` (`id_cellier`, `nom`, `id_usager_cellier`) VALUES
(1, 'Cellier.class damien 1', 1),
(3, 'Cellier.class Damien 2', 1),
(6, 'Cellier.class julien 1', 2),
(7, 'Cellier.class julien 2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `vino__type`
--

CREATE TABLE `vino__type` (
  `id_type` int(11) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vino__type`
--

INSERT INTO `vino__type` (`id_type`, `type`) VALUES
(1, 'Vin rouge'),
(2, 'Vin blanc');

-- --------------------------------------------------------

--
-- Table structure for table `vino__usager`
--

CREATE TABLE `vino__usager` (
  `id_usager` int(11) NOT NULL,
  `nom` varchar(55) NOT NULL,
  `prenom` varchar(55) NOT NULL,
  `mail` varchar(55) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `admin` tinyint(1) DEFAULT '0',
  `pseudo` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vino__usager`
--

INSERT INTO `vino__usager` (`id_usager`, `nom`, `prenom`, `mail`, `mdp`, `admin`, `pseudo`) VALUES
(1, 'Damien', 'Raffi', 'damien@test.com', '1234', 1, 'Damien'),
(2, 'Julien', 'Granero', 'julien@test.com', '1234', 1, 'julien');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vino__bouteille`
--
ALTER TABLE `vino__bouteille`
  ADD PRIMARY KEY (`id_bouteille`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `vino__bouteille__saq`
--
ALTER TABLE `vino__bouteille__saq`
  ADD PRIMARY KEY (`id_bouteille_saq`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `vino__cellier`
--
ALTER TABLE `vino__cellier`
  ADD PRIMARY KEY (`id_cellier`),
  ADD KEY `id_usager_cellier` (`id_usager_cellier`);

--
-- Indexes for table `vino__type`
--
ALTER TABLE `vino__type`
  ADD PRIMARY KEY (`id_type`);

--
-- Indexes for table `vino__usager`
--
ALTER TABLE `vino__usager`
  ADD PRIMARY KEY (`id_usager`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vino__bouteille`
--
ALTER TABLE `vino__bouteille`
  MODIFY `id_bouteille` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vino__bouteille__saq`
--
ALTER TABLE `vino__bouteille__saq`
  MODIFY `id_bouteille_saq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vino__cellier`
--
ALTER TABLE `vino__cellier`
  MODIFY `id_cellier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vino__usager`
--
ALTER TABLE `vino__usager`
  MODIFY `id_usager` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `vino__bouteille`
--
ALTER TABLE `vino__bouteille`
  ADD CONSTRAINT `vino__bouteille_ibfk_1` FOREIGN KEY (`type`) REFERENCES `vino__type` (`id_type`);

--
-- Constraints for table `vino__bouteille__saq`
--
ALTER TABLE `vino__bouteille__saq`
  ADD CONSTRAINT `vino__bouteille__saq_ibfk_1` FOREIGN KEY (`type`) REFERENCES `vino__type` (`id_type`);

--
-- Constraints for table `vino__cellier`
--
ALTER TABLE `vino__cellier`
  ADD CONSTRAINT `vino__cellier_ibfk_1` FOREIGN KEY (`id_usager_cellier`) REFERENCES `vino__usager` (`id_usager`);
