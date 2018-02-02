-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 30 jan. 2018 à 14:28
-- Version du serveur :  10.1.28-MariaDB
-- Version de PHP :  7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `viennamoi`
--

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `img_id` int(11) NOT NULL,
  `img_content` varchar(255) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prov_id` int(11) NOT NULL,
  `img_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`img_id`, `img_content`, `prod_id`, `prov_id`, `img_name`) VALUES
(1, 'files/images/providers/petiteboulangeriefacade.jpg', 0, 1, 'petiteboulangerie'),
(2, 'files/images/providers/butillonfacade.jpeg', 0, 2, 'butillon'),
(3, 'files/images/providers/rochefacade.jpeg', 0, 3, 'roche'),
(4, 'files/images/providers/petitfournil.jpg', 0, 4, 'petitfournil'),
(5, 'files/images/providers/nicolasfacade.jpg', 0, 5, 'nicolas'),
(6, 'files/images/providers/cholletfacade.jpeg', 0, 6, 'chollet'),
(7, 'files/images/products/P-viennoiserie.png', 1, 0, 'viennoiserie_duo'),
(8, 'files/images/products/P-viennoiserie.png', 2, 0, 'viennoiserie_famille'),
(9, 'files/images/products/P-mignardise.png', 3, 0, 'mignardise_duo'),
(10, 'files/images/products/P-mignardise.png', 4, 0, 'mignardise_famille'),
(11, 'files/images/products/P-patisserie.png', 5, 0, 'patisserie');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_content` text NOT NULL,
  `prod_price` float NOT NULL,
  `prod_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`prod_id`, `prod_name`, `prod_content`, `prod_price`, `prod_stock`) VALUES
(1, 'viennoiserie_duo', 'quatre viennoiseries suivant les disponibilités. les mini-viennoiseries sont doublées.', 5, 10),
(2, 'viennoiserie_famille', 'dix viennoiseries suivant les disponibilités. les mini-viennoiseries sont doublées.', 10, 10),
(3, 'mignardise_duo', 'deux pâtisseries suivant les disponibilités.', 4, 10),
(4, 'mignardise_famille', 'cinq pâtisseries suivant les disponibilités.', 8, 10),
(5, 'pâtisserie', 'un gâteau, une tarte, ou autre au format 6/8 parts.', 10, 10);

-- --------------------------------------------------------

--
-- Structure de la table `providers`
--

CREATE TABLE `providers` (
  `prov_id` int(11) NOT NULL,
  `prov_name` varchar(255) NOT NULL,
  `prov_content` varchar(255) NOT NULL,
  `prov_adress` varchar(255) NOT NULL,
  `prov_zip` int(5) NOT NULL,
  `prov_city` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `providers`
--

INSERT INTO `providers` (`prov_id`, `prov_name`, `prov_content`, `prov_adress`, `prov_zip`, `prov_city`) VALUES
(1, 'La Petite Boulangerie', '<p>la Boulangerie La Petite Boulangerie située rue d\'Anse depuis 5 ans maintenant.\r\n								Elle s\'est vue décerné le prix de la BANETTE d’OR 2016/2017.\r\n								</p>\r\n								<p>ouvert  du Lundi au Samedi de 6h->20h\r\n								</p>\r\n								<br>', '333 Rue d\'Anse', 69400, 'Villefranche-sur-Saône'),
(2, 'Boulangerie Butillon', '<p>MONSIEUR CHRISTIAN BUTILLON, artisan commerçant est actif depuis 29 ans.</p>\r\n								<p>ouvert du mardi au samedi de 5h à 20h30</p>\r\n								<br>', '366 Rue Nationale', 69400, 'Villefranche-sur-Saône'),
(3, 'Boulangerie Roche', '<p>Ouverts depuis plus de vingt ans, la Boulangerie Roche propose une large gamme de produits renouvellés régulièrement en fonction des saisons.</p>\r\n								<p>ouvert du lundi au samedi de 5h à 19h30</p>\r\n								<br>', '174 Rue de la Gare', 69400, 'Villefranche-sur-Saône'),
(4, 'Boulangerie Au Petit Fournil', '<p>Nous utilisons des matières premières authentiques et de qualité, que nous avons sélectionnées et qui entrent à 70 % dans l\'élaboration de la recette. Ce processus de fabrication, mis au point par La Petite Boulangerie, permet de vous servir des produi', '333 rue d\'Anse', 69400, 'Villefranche-sur-Saône'),
(5, 'Patisserie Nicolas', '<p>Chez NICOLAS tout est fabriqué sur place avec de bons produits,toute la pâtisserie,la viennoiserie, le pain évidemment,les glaces et sorbets,les chocolats de pâques et de noël,sandwichs et autres mets salés, enfin tout ce que vous trouverez dans la bou', '99 rue d\'Anse', 69400, 'Villefranche-sur-Saône'),
(6, 'Patissier-chocolatier Chollet', '<p>La Pâtisserie Chollet est une véritable institution caladoise depuis 1962, reprise en 1998 par Catherine et Thierry. La saison des mariages, baptêmes, communions est arrivée. Vous pouvez découvrir nos pièces montées, weedings cakes et autres gâteaux. N', '1050 Rue nationale', 69400, 'Villefranche-sur-Saône');

-- --------------------------------------------------------

--
-- Structure de la table `purchase`
--

CREATE TABLE `purchase` (
  `user_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `hour` datetime NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_salt` varchar(255) NOT NULL,
  `user_adress` varchar(255) NOT NULL,
  `user_zipcode` int(10) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_prenom` varchar(255) NOT NULL,
  `fact_adress` varchar(255) NOT NULL,
  `fact_zipcode` int(10) NOT NULL,
  `fact_city` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`img_id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prod_id`);

--
-- Index pour la table `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`prov_id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `providers`
--
ALTER TABLE `providers`
  MODIFY `prov_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
