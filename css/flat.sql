-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 17 mars 2023 à 11:10
-- Version du serveur : 5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `flat`
--

-- --------------------------------------------------------

--
-- Structure de la table `comptes`
--

CREATE TABLE `comptes` (
  `id_compte` int(2) NOT NULL,
  `nom_compte` varchar(50) NOT NULL,
  `premon_compte` varchar(50) NOT NULL,
  `login_compte` varchar(50) NOT NULL,
  `email_compte` varchar(100) NOT NULL,
  `pass_compte` blob,
  `img_compte` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comptes`
--

INSERT INTO `comptes` (`id_compte`, `nom_compte`, `premon_compte`, `login_compte`, `email_compte`, `pass_compte`, `img_compte`) VALUES
(1, 'jeremy', 'souda', 'admin', 'jeremy.souda@orange.fr', 0x30623963323632356463323165663035663661643464646634376335663230333833376161333263, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE `contacts` (
  `id_contact` int(5) NOT NULL,
  `nom_contact` varchar(100) NOT NULL,
  `prenom_contact` varchar(100) NOT NULL,
  `email_contact` varchar(100) NOT NULL,
  `message_contact` text NOT NULL,
  `date_contact` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contacts`
--

INSERT INTO `contacts` (`id_contact`, `nom_contact`, `prenom_contact`, `email_contact`, `message_contact`, `date_contact`) VALUES
(1, 'edzdz', 'zdeéze', 'zefzef@fefea.com', 'zefazfe', '2023-03-16 15:34:07'),
(2, 'jeremy', 'sousa', 'jeremy.souda@orange.fr', 'blabla', '2023-03-16 16:20:54'),
(3, 'dzv', 'zefz', 'efze@dvdf.com', 'efzef', '2023-03-16 16:21:48'),
(4, 'dzv', 'zefz', 'efze@dvdf.com', 'efzef', '2023-03-16 16:22:03');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comptes`
--
ALTER TABLE `comptes`
  ADD PRIMARY KEY (`id_compte`);

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id_contact`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comptes`
--
ALTER TABLE `comptes`
  MODIFY `id_compte` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id_contact` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
