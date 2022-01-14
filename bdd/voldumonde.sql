-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 14 jan. 2022 à 14:43
-- Version du serveur : 5.7.34
-- Version de PHP : 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `voldumonde`
--

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user_vol`
--

CREATE TABLE `user_vol` (
  `user_vol_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user_vol`
--

INSERT INTO `user_vol` (`user_vol_id`, `user_id`, `vol_id`) VALUES
(3, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `vol`
--

CREATE TABLE `vol` (
  `vol_id` int(11) NOT NULL,
  `depart` varchar(255) NOT NULL,
  `arrivée` varchar(255) NOT NULL,
  `heure_depart` datetime NOT NULL,
  `heure_arrivée` datetime NOT NULL,
  `compagnie` varchar(255) NOT NULL,
  `temps_vol` time NOT NULL,
  `aller_retour` tinyint(1) DEFAULT NULL,
  `escale` int(11) NOT NULL,
  `place` int(11) NOT NULL,
  `place_dispo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `vol`
--

INSERT INTO `vol` (`vol_id`, `depart`, `arrivée`, `heure_depart`, `heure_arrivée`, `compagnie`, `temps_vol`, `aller_retour`, `escale`, `place`, `place_dispo`) VALUES
(1, 'France', 'Italie', '2022-01-01 12:28:00', '2022-01-31 12:28:00', 'Ryanair', '24:00:00', 1, 0, 500, 0),
(3, 'France', 'Espagne', '2022-01-01 12:50:00', '2022-01-07 12:50:00', 'Ryanair', '24:00:00', 0, 0, 100, 99),
(4, 'France', 'Los Angeles', '2022-01-02 12:51:00', '2022-01-08 12:51:00', 'Ryanair', '24:00:00', 1, 0, 100, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Index pour la table `user_vol`
--
ALTER TABLE `user_vol`
  ADD PRIMARY KEY (`user_vol_id`);

--
-- Index pour la table `vol`
--
ALTER TABLE `vol`
  ADD PRIMARY KEY (`vol_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user_vol`
--
ALTER TABLE `user_vol`
  MODIFY `user_vol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `vol`
--
ALTER TABLE `vol`
  MODIFY `vol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
