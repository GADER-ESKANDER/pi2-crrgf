-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 06 Novembre 2014 à 16:31
-- Version du serveur: 5.5.40
-- Version de PHP: 5.4.34-0+deb7u1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "-05:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `e1395672`
--

-- --------------------------------------------------------

--
-- Structure de la table `pi2_commentaires`
--

CREATE TABLE IF NOT EXISTS `pi2_commentaires` (
  `idCommentaire` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `corpsCommentaire` text,
  `dateCommentaire` varchar(100) NOT NULL,
  `abus` varchar(20) DEFAULT NULL,
  `utilisateur_id` int(10) unsigned NOT NULL,
  `enchere_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idCommentaire`),
  KEY `fk_Commentaires_Utilisateurs1_idx` (`utilisateur_id`),
  KEY `fk_Commentaires_Encheres1_idx` (`enchere_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

-- --------------------------------------------------------

--
-- Structure de la table `pi2_contacts`
--

CREATE TABLE IF NOT EXISTS `pi2_contacts` (
  `idContact` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nomContact` varchar(100) NOT NULL,
  `prenomContact` varchar(100) NOT NULL,
  `courriel` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `dateContact` varchar(100) DEFAULT NULL,
  `statut` varchar(50) NOT NULL,
  PRIMARY KEY (`idContact`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `pi2_contacts`
--

INSERT INTO `pi2_contacts` (`idContact`, `nomContact`, `prenomContact`, `courriel`, `message`, `dateContact`, `statut`) VALUES
(1, 'Gader', 'ESKANDER', 'skandergader@yahoo.fr', 'Post quorum necem nihilo lenius ferociens Gallus u...', '23-Oct-2014, 0:29', 'Reponse'),
(2, 'TOTO', 'TATI', 'tototati@gmail.com', 'Quorum necem nihilo lenius ferociens Gallus ut leo...', '23-Oct-2014, 0:29', ''),
(5, 'adad', 'adfa', 'adfad@aaa', ' dbvbxcvbx', '28-Oct-2014 , 1:59', '');

-- --------------------------------------------------------

--
-- Structure de la table `pi2_encheres`
--

CREATE TABLE IF NOT EXISTS `pi2_encheres` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(70) NOT NULL,
  `prixDebut` decimal(9,2) unsigned NOT NULL,
  `prixFin` decimal(9,2) unsigned NOT NULL,
  `prixIncrement` decimal(9,2) unsigned NOT NULL,
  `prixDirecte` decimal(9,2) unsigned DEFAULT NULL,
  `dateDebut` datetime NOT NULL,
  `dateFin` datetime DEFAULT NULL,
  `etat` enum('fermée','ouverte','gelée') NOT NULL DEFAULT 'ouverte',
  `utilisateur_id` int(10) unsigned NOT NULL,
  `oeuvre_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Encheres_Utilisateurs1_idx` (`utilisateur_id`),
  KEY `fk_Encheres_Oeuvres1_idx` (`oeuvre_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `pi2_encheres`
--

INSERT INTO `pi2_encheres` (`id`, `titre`, `prixDebut`, `prixFin`, `prixIncrement`, `prixDirecte`, `dateDebut`, `dateFin`, `etat`, `utilisateur_id`, `oeuvre_id`) VALUES
(9, 'Faune Flore', 50.00, 150.00, 5.00, 1000.00, '2014-10-31 10:37:10', '2014-10-31 19:52:10', 'fermée', 2, 2),
(10, 'Rainbow', 20.00, 45.00, 5.00, 1000.00, '2014-10-31 20:19:34', '2014-10-31 20:35:34', 'fermée', 1, 1),
(11, 'Douceur', 50.00, 90.00, 5.00, 2000.00, '2014-11-01 17:47:43', '2014-11-07 11:47:43', 'ouverte', 3, 3),
(12, 'Phoseidon', 50.00, 65.00, 5.00, 1000.00, '2014-11-04 13:04:41', '2014-11-04 14:40:41', 'fermée', 4, 4),
(13, 'Teddington', 20.00, 20.00, 5.00, 500.00, '2014-11-05 17:35:02', '2014-11-08 17:35:02', 'ouverte', 1, 5),
(14, 'Homme et squelette', 50.00, 50.00, 5.00, 1500.00, '2014-11-05 23:12:47', '2014-11-08 23:12:47', 'ouverte', 7, 6),
(15, 'Je vais vous attraper!', 50.00, 50.00, 5.00, 1250.00, '2014-11-06 09:01:08', '2014-11-09 09:01:08', 'ouverte', 7, 7),
(16, 'SHHHH! Silence!', 50.00, 50.00, 5.00, 1300.00, '2014-11-06 09:02:17', '2014-11-06 09:05:00', 'fermée', 7, 8),
(17, 'toi', 40.00, 40.00, 10.00, 240.00, '2014-11-06 14:57:14', '2014-11-06 16:25:14', 'fermée', 1, 12);

-- --------------------------------------------------------

--
-- Structure de la table `pi2_encheresgagnees`
--

CREATE TABLE IF NOT EXISTS `pi2_encheresgagnees` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(10) unsigned NOT NULL,
  `enchere_id` int(10) unsigned NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_EncheresGagnees_Encheres1_idx` (`enchere_id`),
  KEY `fk_EncheresGagnees_Utilisateurs1_idx` (`utilisateur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `pi2_encheresgagnees`
--

INSERT INTO `pi2_encheresgagnees` (`id`, `utilisateur_id`, `enchere_id`, `date`) VALUES
(7, 3, 12, '2014-11-04 14:40:41'),
(8, 3, 12, '2014-11-04 14:47:16'),
(9, 3, 12, '2014-11-04 14:47:29'),
(10, 2, 10, '2014-11-04 16:50:43'),
(11, 3, 12, '2014-11-06 14:50:41');

-- --------------------------------------------------------

--
-- Structure de la table `pi2_oeuvres`
--

CREATE TABLE IF NOT EXISTS `pi2_oeuvres` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(60) NOT NULL,
  `description` varchar(255) NOT NULL,
  `dimension` varchar(32) NOT NULL,
  `poids` decimal(5,2) NOT NULL,
  `mediaUrl` varchar(70) NOT NULL,
  `etat` enum('disponible','en enchere','vendue','supprimé') NOT NULL DEFAULT 'disponible',
  `technique_id` int(10) unsigned NOT NULL,
  `theme_id` int(10) unsigned NOT NULL,
  `utilisateur_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Oeuvres_Techniques1_idx` (`technique_id`),
  KEY `fk_Oeuvres_Themes1_idx` (`theme_id`),
  KEY `fk_Oeuvres_Utilisateurs1_idx` (`utilisateur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `pi2_oeuvres`
--

INSERT INTO `pi2_oeuvres` (`id`, `titre`, `description`, `dimension`, `poids`, `mediaUrl`, `etat`, `technique_id`, `theme_id`, `utilisateur_id`) VALUES
(1, 'Rainbow', 'Quae et sororem cum existimabat maritus ad suam so...', '70x140', 250.00, '../medias/rainbow.jpg', 'vendue', 2, 1, 1),
(2, 'Faune et Flore', 'Se est cum verbum legant Latinas qui Latinas verbu...', '80x130', 300.00, '../medias/fauneFlore.jpg', 'vendue', 4, 2, 2),
(3, 'Douceur de la nuit', 'Conloquiis scriptis deliberanti conloquiis proximis pertinacius acciri antequam simulationem pertinacius convellere codicem auxilio eique destitutus.', '75x200', 150.00, '../medias/douceurNuit.jpg', 'en enchere', 3, 3, 3),
(4, 'Phoseidon', 'Quoddam definiunt tradunt humanarum etiam aliquotiens quaedam definiunt lunari potentia mentium quaedam filiam abdita vel.', '85x140', 175.00, '../medias/phoseidon.jpg', 'vendue', 3, 2, 4),
(5, 'Teddington', 'BLABLABLA BLABLABLA', '10 x 20', 5.00, '../medias/teddington.jpg', 'en enchere', 1, 2, 1),
(6, 'halloween1', 'Homme et squelette', '50x60', 10.00, '../medias/halloween1.jpg', 'en enchere', 1, 2, 7),
(7, 'halloween2', 'Fly Vampire Fly!', '50x60', 10.00, '../medias/halloween2.jpg', 'en enchere', 1, 3, 7),
(8, 'halloween3', 'Red Eyes!!!!!!', '50x60', 10.00, '../medias/halloween3.jpg', 'disponible', 2, 3, 7),
(9, 'halloween4', 'The death kiss! Kiss to death!', '50x60', 10.00, '../medias/halloween4.jpg', 'disponible', 2, 2, 7),
(10, 'halloween5', 'Amour Love! 爱 Love!', '50x60', 10.00, '../medias/halloween5.jpg', 'disponible', 2, 1, 7),
(12, 'bnghfg', 'hfghfghfgh', '45x140', 500.00, '../upload/maine_coon_642x553.jpg', 'disponible', 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `pi2_offres`
--

CREATE TABLE IF NOT EXISTS `pi2_offres` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `montant` decimal(9,2) unsigned NOT NULL,
  `date` datetime NOT NULL,
  `enchere_id` int(10) unsigned NOT NULL,
  `utilisateur_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Offres_Encheres1_idx` (`enchere_id`),
  KEY `fk_Offres_Utilisateurs1_idx` (`utilisateur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Contenu de la table `pi2_offres`
--

INSERT INTO `pi2_offres` (`id`, `montant`, `date`, `enchere_id`, `utilisateur_id`) VALUES
(14, 55.00, '2014-10-31 12:25:35', 9, 3),
(15, 60.00, '2014-10-31 13:58:19', 9, 3),
(16, 65.00, '2014-10-31 13:58:40', 9, 1),
(17, 70.00, '2014-10-31 13:58:52', 9, 1),
(18, 75.00, '2014-10-31 13:58:53', 9, 1),
(19, 80.00, '2014-10-31 13:58:54', 9, 1),
(20, 85.00, '2014-10-31 13:58:55', 9, 1),
(21, 90.00, '2014-10-31 13:58:56', 9, 1),
(22, 95.00, '2014-10-31 13:59:52', 9, 4),
(23, 95.00, '2014-10-31 13:59:53', 9, 4),
(24, 95.00, '2014-10-31 13:59:59', 9, 4),
(25, 95.00, '2014-10-31 14:00:04', 9, 4),
(26, 100.00, '2014-10-31 14:06:34', 9, 4),
(27, 105.00, '2014-10-31 14:31:24', 9, 4),
(28, 110.00, '2014-10-31 14:39:52', 9, 4),
(29, 115.00, '2014-10-31 14:44:44', 9, 4),
(30, 120.00, '2014-10-31 14:48:04', 9, 4),
(31, 125.00, '2014-10-31 14:50:55', 9, 4),
(32, 130.00, '2014-10-31 14:51:50', 9, 4),
(33, 135.00, '2014-10-31 14:57:55', 9, 4),
(34, 140.00, '2014-10-31 14:59:24', 9, 4),
(35, 145.00, '2014-10-31 15:11:36', 9, 4),
(36, 150.00, '2014-10-31 19:48:08', 9, 5),
(37, 25.00, '2014-10-31 20:22:19', 10, 2),
(38, 30.00, '2014-10-31 20:22:22', 10, 2),
(39, 35.00, '2014-10-31 20:33:55', 10, 2),
(40, 40.00, '2014-10-31 20:33:58', 10, 2),
(41, 45.00, '2014-10-31 20:34:00', 10, 2),
(42, 55.00, '2014-11-01 17:48:30', 11, 5),
(43, 60.00, '2014-11-03 12:09:33', 11, 1),
(44, 65.00, '2014-11-03 12:12:11', 11, 1),
(45, 70.00, '2014-11-04 12:56:01', 11, 1),
(46, 75.00, '2014-11-04 12:56:03', 11, 1),
(47, 80.00, '2014-11-04 13:06:13', 11, 4),
(48, 55.00, '2014-11-04 14:38:12', 12, 1),
(49, 60.00, '2014-11-04 14:38:35', 12, 1),
(50, 65.00, '2014-11-04 14:40:05', 12, 3),
(51, 85.00, '2014-11-06 13:22:29', 11, 7),
(52, 90.00, '2014-11-06 13:22:34', 11, 7);

-- --------------------------------------------------------

--
-- Structure de la table `pi2_techniques`
--

CREATE TABLE IF NOT EXISTS `pi2_techniques` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `pi2_techniques`
--

INSERT INTO `pi2_techniques` (`id`, `nom`) VALUES
(1, 'acrylique'),
(2, 'peinture a l''huile'),
(3, 'gouache'),
(4, 'aquarelle'),
(5, 'mixte');

-- --------------------------------------------------------

--
-- Structure de la table `pi2_themes`
--

CREATE TABLE IF NOT EXISTS `pi2_themes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `pi2_themes`
--

INSERT INTO `pi2_themes` (`id`, `nom`) VALUES
(1, 'classique'),
(2, 'moderne'),
(3, 'abstrait'),
(4, 'mixte');

-- --------------------------------------------------------

--
-- Structure de la table `pi2_utilisateurs`
--

CREATE TABLE IF NOT EXISTS `pi2_utilisateurs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `courriel` varchar(70) NOT NULL,
  `motDePasse` varchar(60) NOT NULL,
  `type` enum('membre','admin') NOT NULL DEFAULT 'membre',
  `etat` enum('inactif','actif') NOT NULL DEFAULT 'actif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `pi2_utilisateurs`
--

INSERT INTO `pi2_utilisateurs` (`id`, `nom`, `prenom`, `courriel`, `motDePasse`, `type`, `etat`) VALUES
(1, 'Max', 'William', 'aa@aa.com', '12341234', 'membre', 'actif'),
(2, 'Marceau', 'Sophie', 'bb@bb.com', '12341234', 'membre', 'actif'),
(3, 'Centrum', 'Homme', 'cc@cc.com', '12341234', 'membre', 'actif'),
(4, 'Slyvian', 'Canny', 'dd@dd.com', '12341234', 'membre', 'actif'),
(5, 'Revelle', 'Eric', 'ee@ee.com', '12341234', 'membre', 'actif'),
(7, 'Han', 'Xiang Feng', 'hxfwumei@hotmail.com', '123456789', 'membre', 'actif'),
(8, 'Raoelina', 'Canny', 'canny@canny.com', '12345678', 'membre', 'actif');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `pi2_commentaires`
--
ALTER TABLE `pi2_commentaires`
  ADD CONSTRAINT `fk_Commentaires_Encheres1` FOREIGN KEY (`enchere_id`) REFERENCES `pi2_encheres` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Commentaires_Utilisateurs1` FOREIGN KEY (`utilisateur_id`) REFERENCES `pi2_utilisateurs` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `pi2_encheres`
--
ALTER TABLE `pi2_encheres`
  ADD CONSTRAINT `fk_Encheres_Oeuvres1` FOREIGN KEY (`oeuvre_id`) REFERENCES `pi2_oeuvres` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Encheres_Utilisateurs1` FOREIGN KEY (`utilisateur_id`) REFERENCES `pi2_utilisateurs` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `pi2_encheresgagnees`
--
ALTER TABLE `pi2_encheresgagnees`
  ADD CONSTRAINT `fk_EncheresGagnees_Encheres1` FOREIGN KEY (`enchere_id`) REFERENCES `pi2_encheres` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_EncheresGagnees_Utilisateurs1` FOREIGN KEY (`utilisateur_id`) REFERENCES `pi2_utilisateurs` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `pi2_oeuvres`
--
ALTER TABLE `pi2_oeuvres`
  ADD CONSTRAINT `fk_Oeuvres_Techniques1` FOREIGN KEY (`technique_id`) REFERENCES `pi2_techniques` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Oeuvres_Themes1` FOREIGN KEY (`theme_id`) REFERENCES `pi2_themes` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Oeuvres_Utilisateurs1` FOREIGN KEY (`utilisateur_id`) REFERENCES `pi2_utilisateurs` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `pi2_offres`
--
ALTER TABLE `pi2_offres`
  ADD CONSTRAINT `fk_Offres_Encheres1` FOREIGN KEY (`enchere_id`) REFERENCES `pi2_encheres` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Offres_Utilisateurs1` FOREIGN KEY (`utilisateur_id`) REFERENCES `pi2_utilisateurs` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
