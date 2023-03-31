-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 31 mars 2023 à 15:00
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
  `prenom_compte` varchar(50) NOT NULL,
  `login_compte` varchar(50) NOT NULL,
  `email_compte` varchar(100) NOT NULL,
  `pass_compte` blob,
  `img_compte` varchar(100) DEFAULT NULL,
  `statut_compte` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comptes`
--

INSERT INTO `comptes` (`id_compte`, `nom_compte`, `prenom_compte`, `login_compte`, `email_compte`, `pass_compte`, `img_compte`, `statut_compte`) VALUES
(1, 'jeremy', 'souda', 'admin', 'jeremy.souda@orange.fr', 0x30623963323632356463323165663035663661643464646634376335663230333833376161333263, NULL, 'super_admin'),
(5, 'jeremy', 'dasou', 'ergzrg', 'efazef@zrga.com', 0x30393363623836373862393734316532323035653761373632633734356330363663363464373131, NULL, 'admin'),
(6, 'zrefzefz', 'zefzefzf', 'zefzezf', 'zefezfzefe@ergrzg.com', 0x35323134383862386562663962633561393738373930633732356566656431353766663432613066, NULL, 'abonnée');

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

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

CREATE TABLE `pages` (
  `id_page` int(3) NOT NULL,
  `titre_page` varchar(100) NOT NULL,
  `contenu_page` text NOT NULL,
  `img_page` varchar(100) DEFAULT NULL,
  `date_page` datetime NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pages`
--

INSERT INTO `pages` (`id_page`, `titre_page`, `contenu_page`, `img_page`, `date_page`, `visible`) VALUES
(21, 'salut a tous', '<p>Voluptates pellentesque corporis accusamus veritatis voluptatibus platea eiusmod, quasi ridiculus viverra, ab, sociosqu dictum laboris sed beatae magni orci optio, eos pellentesque ullamcorper voluptate beatae fermentum neque similique blanditiis ratione, nec bibendum! Eveniet, blandit, repudiandae volutpat orci pariatur.</p>', NULL, '2023-03-31 14:31:44', 1);

-- --------------------------------------------------------

--
-- Structure de la table `rubriques`
--

CREATE TABLE `rubriques` (
  `id_rubrique` int(2) NOT NULL,
  `nom_rubrique` varchar(30) NOT NULL,
  `titre_rubrique` varchar(200) NOT NULL,
  `lien_rubrique` varchar(50) NOT NULL,
  `date_rubrique` datetime NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `slider` tinyint(1) NOT NULL DEFAULT '0',
  `rang` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `slider`
--

CREATE TABLE `slider` (
  `id_slider` int(2) NOT NULL,
  `alt_slider` varchar(50) NOT NULL,
  `legende_slider` varchar(50) NOT NULL,
  `img_slider` varchar(100) DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comptes`
--
ALTER TABLE `comptes`
  ADD PRIMARY KEY (`id_compte`),
  ADD UNIQUE KEY `email_compte` (`email_compte`);

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id_contact`);

--
-- Index pour la table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id_page`);

--
-- Index pour la table `rubriques`
--
ALTER TABLE `rubriques`
  ADD PRIMARY KEY (`id_rubrique`);

--
-- Index pour la table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id_slider`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comptes`
--
ALTER TABLE `comptes`
  MODIFY `id_compte` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id_contact` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pages`
--
ALTER TABLE `pages`
  MODIFY `id_page` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `rubriques`
--
ALTER TABLE `rubriques`
  MODIFY `id_rubrique` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `slider`
--
ALTER TABLE `slider`
  MODIFY `id_slider` int(2) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
