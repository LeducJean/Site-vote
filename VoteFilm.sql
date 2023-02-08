-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 08 fév. 2023 à 09:48
-- Version du serveur : 10.5.18-MariaDB-0+deb11u1
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `VoteFilm`
--

-- --------------------------------------------------------

--
-- Structure de la table `Film`
--

CREATE TABLE `Film` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `lienImg` text NOT NULL,
  `annee` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Film`
--

INSERT INTO `Film` (`id`, `nom`, `lienImg`, `annee`) VALUES
(1, 'AVATAR', 'https://fr.web.img2.acsta.net/c_310_420/pictures/22/08/25/09/04/2146702.jpg', '2009'),
(2, 'JOHN WICK PARABELLUM', 'https://fr.web.img3.acsta.net/c_310_420/pictures/19/05/21/15/23/4992794.jpg', '2019'),
(3, 'FAST & FURIOUS 6', 'https://fr.web.img6.acsta.net/c_310_420/pictures/210/038/21003859_20130507110423451.jpg', '2013');

-- --------------------------------------------------------

--
-- Structure de la table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `dddd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(30) NOT NULL,
  `mdp` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `User`
--

INSERT INTO `User` (`id`, `pseudo`, `mdp`) VALUES
(67, '', ''),
(3, 'admin', 'admin'),
(70, 'theo', 'jean');

-- --------------------------------------------------------

--
-- Structure de la table `Vote`
--

CREATE TABLE `Vote` (
  `id` int(11) NOT NULL,
  `idFilm` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Film`
--
ALTER TABLE `Film`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo` (`pseudo`,`mdp`);

--
-- Index pour la table `Vote`
--
ALTER TABLE `Vote`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idFilm` (`idFilm`,`idUser`,`DATE`),
  ADD UNIQUE KEY `idUser` (`idUser`,`DATE`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Film`
--
ALTER TABLE `Film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT pour la table `Vote`
--
ALTER TABLE `Vote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Vote`
--
ALTER TABLE `Vote`
  ADD CONSTRAINT `Vote_ibfk_1` FOREIGN KEY (`idFilm`) REFERENCES `Film` (`id`),
  ADD CONSTRAINT `Vote_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `User` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
