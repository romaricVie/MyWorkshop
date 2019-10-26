-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 25 oct. 2019 à 18:44
-- Version du serveur :  10.1.37-MariaDB
-- Version de PHP :  7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `workshop`
--

-- --------------------------------------------------------

--
-- Structure de la table `billets`
--

CREATE TABLE `billets` (
  `id_billet` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `contenu` text NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `billets`
--

INSERT INTO `billets` (`id_billet`, `titre`, `contenu`, `date_creation`) VALUES
(9, 'salutation', 'Bonjour chers utilisateurs, je suis très heureux de développer cette plateforme.\r\nVous êtres les bienvenues, Bonne utilisation de la plateforme à toute et à tous!\r\n\r\n#Jésus-Christ notre Modèle.  :-)\r\n #Amen!!!', '2019-10-17 10:53:57'),
(10, 'Bonjour', 'les projets seront sur Github demain grâce a Dieu.\r\nJe vais passé a une autre étape de la programmation web.', '2019-10-24 11:59:15');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id_commentaire` int(11) NOT NULL,
  `id_billet` int(11) NOT NULL,
  `auteur` varchar(50) NOT NULL,
  `commentaire` text NOT NULL,
  `date_commentaire` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `phone` int(50) NOT NULL,
  `file` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `firstname`, `email`, `message`, `phone`, `file`, `date`) VALUES
(1, 'Toto', 'Aya', 'toto@gmail.com', 'Salut j\'ai besoin de vos services au sein de mon entreprise\r\nMerci!', 2222221, 'Administration.pdf', '2019-10-17 10:58:51'),
(2, 'N\'dri', 'roma', 'roma.ndrk@gmail.com', 'salut', 49250893, '', '2019-10-24 11:52:28');

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `id` int(11) NOT NULL,
  `psuedo` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenoms` varchar(30) NOT NULL,
  `sexe` char(1) NOT NULL,
  `jour` int(31) NOT NULL,
  `mois` int(12) NOT NULL,
  `annee` year(4) NOT NULL,
  `dat_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pays` varchar(30) NOT NULL,
  `avatar` varchar(100) NOT NULL DEFAULT 'default.png',
  `motdepasse` text NOT NULL,
  `time` int(11) NOT NULL,
  `ip_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id`, `psuedo`, `email`, `nom`, `prenoms`, `sexe`, `jour`, `mois`, `annee`, `dat_creation`, `pays`, `avatar`, `motdepasse`, `time`, `ip_user`) VALUES
(1, 'roma', 'romaric.ndrk@gmail.com', 'N\'DRI', 'KOUAME ROMARIC', 'H', 24, 11, 1996, '2019-10-17 10:39:33', 'Cote d\'ivoire', '1.jpg', '9a900f538965a426994e1e90600920aff0b4e8d2', 0, ''),
(2, 'tototo', 'toto@gmail.com', 'toto', 'tata', 'F', 11, 10, 2000, '2019-10-24 12:09:04', 'Etats_Unis', '2.png', '8c1017982b2032cc059203e3d83dd0ee2e7a86b3', 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `online`
--

CREATE TABLE `online` (
  `id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `ip_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `online`
--

INSERT INTO `online` (`id`, `time`, `ip_user`) VALUES
(1, 1572021776, '::1');

-- --------------------------------------------------------

--
-- Structure de la table `tchat`
--

CREATE TABLE `tchat` (
  `id` int(11) NOT NULL,
  `psuedo` varchar(30) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tchat`
--

INSERT INTO `tchat` (`id`, `psuedo`, `message`, `date`) VALUES
(1, 'roma', 'salut', '2019-10-17 13:41:07'),
(2, 'roma', 'comment tu vas?', '2019-10-17 13:41:40'),
(3, 'roma', 'salut', '2019-10-24 10:37:55'),
(4, 'roma', 'salut', '2019-10-24 11:53:46'),
(5, 'tototo', 'salut frere', '2019-10-24 12:10:46');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `billets`
--
ALTER TABLE `billets`
  ADD PRIMARY KEY (`id_billet`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id_commentaire`),
  ADD KEY `commentaires_ibfk_1` (`id_billet`);

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `online`
--
ALTER TABLE `online`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tchat`
--
ALTER TABLE `tchat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `billets`
--
ALTER TABLE `billets`
  MODIFY `id_billet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id_commentaire` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `online`
--
ALTER TABLE `online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `tchat`
--
ALTER TABLE `tchat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`id_billet`) REFERENCES `billets` (`id_billet`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
