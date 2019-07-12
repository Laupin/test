-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 12 juil. 2019 à 17:30
-- Version du serveur :  10.1.38-MariaDB
-- Version de PHP :  7.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bibliotheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonne`
--

CREATE TABLE `abonne` (
  `id_abonne` int(3) NOT NULL,
  `prenom` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `abonne`
--

INSERT INTO `abonne` (`id_abonne`, `prenom`) VALUES
(5, 'aymeric'),
(2, 'Benoit'),
(3, 'Chloe'),
(1, 'Guillaume'),
(4, 'Laura');

-- --------------------------------------------------------

--
-- Structure de la table `emprunt`
--

CREATE TABLE `emprunt` (
  `id_emprunt` int(3) NOT NULL,
  `id_livre` int(3) DEFAULT NULL,
  `id_abonne` int(3) DEFAULT NULL,
  `date_sortie` date NOT NULL,
  `date_rendu` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `emprunt`
--

INSERT INTO `emprunt` (`id_emprunt`, `id_livre`, `id_abonne`, `date_sortie`, `date_rendu`) VALUES
(1, 100, 1, '2014-12-17', '2014-12-18'),
(2, 101, 2, '2014-12-18', '2014-12-20'),
(3, 100, 3, '2014-12-19', '2014-12-22'),
(4, 103, 4, '2014-12-19', '2014-12-22'),
(5, 104, 1, '2014-12-19', '2014-12-28'),
(6, 105, 2, '2015-03-20', '2015-03-26'),
(7, 105, 3, '2015-06-13', NULL),
(8, 100, 2, '2015-06-15', NULL),
(12, 100, 1, '2019-06-26', NULL),
(13, 100, 1, '2019-06-26', NULL),
(14, 104, 3, '2050-01-01', NULL);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `historique`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `historique` (
`id_emprunt` int(3)
,`abonne` varchar(15)
,`livre` varchar(30)
,`date_emprunt` date
);

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

CREATE TABLE `livre` (
  `id_livre` int(3) NOT NULL,
  `auteur` varchar(25) NOT NULL,
  `titre` varchar(30) NOT NULL,
  `photo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`id_livre`, `auteur`, `titre`, `photo`) VALUES
(100, 'GUY DE MAUPASSANT', 'Une vie', 'http://localhost/up-php/bibliotheque/photo/livre1.png'),
(101, 'GUY DE MAUPASSANT', 'Bel-Ami ', 'http://localhost/up-php/bibliotheque/photo/livre2.png'),
(102, 'HONORE DE BALZAC', 'Le père Goriot', ''),
(103, 'ALPHONSE DAUDET', 'Le Petit chose', ''),
(104, 'ALEXANDRE DUMAS', 'La Reine Margot', ''),
(105, 'ALEXANDRE DUMAS', 'Les Trois Mousquetaires', ''),
(107, 'HONORE DE BALZAC', 'Illusion perdues', '');

-- --------------------------------------------------------

--
-- Structure de la vue `historique`
--
DROP TABLE IF EXISTS `historique`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `historique`  AS  select `e`.`id_emprunt` AS `id_emprunt`,`a`.`prenom` AS `abonne`,`l`.`titre` AS `livre`,`e`.`date_sortie` AS `date_emprunt` from ((`emprunt` `e` join `abonne` `a` on((`e`.`id_abonne` = `a`.`id_abonne`))) join `livre` `l` on((`e`.`id_livre` = `l`.`id_livre`))) order by `e`.`date_sortie` ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `abonne`
--
ALTER TABLE `abonne`
  ADD PRIMARY KEY (`id_abonne`),
  ADD UNIQUE KEY `uq_abonne` (`prenom`);

--
-- Index pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD PRIMARY KEY (`id_emprunt`),
  ADD KEY `fk_emprunt_abonne` (`id_abonne`),
  ADD KEY `fk_emprunt_livre` (`id_livre`);

--
-- Index pour la table `livre`
--
ALTER TABLE `livre`
  ADD PRIMARY KEY (`id_livre`),
  ADD UNIQUE KEY `uq_livre` (`auteur`,`titre`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `abonne`
--
ALTER TABLE `abonne`
  MODIFY `id_abonne` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `emprunt`
--
ALTER TABLE `emprunt`
  MODIFY `id_emprunt` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `livre`
--
ALTER TABLE `livre`
  MODIFY `id_livre` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
