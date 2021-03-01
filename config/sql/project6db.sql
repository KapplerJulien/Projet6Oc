-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 01 mars 2021 à 14:10
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `project6db`
--

-- --------------------------------------------------------

--
-- Structure de la table `article_triks`
--

DROP TABLE IF EXISTS `article_triks`;
CREATE TABLE IF NOT EXISTS `article_triks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) NOT NULL,
  `groupe_id` int(11) NOT NULL,
  `nom_art_triks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu_art_triks` varchar(5000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_creation_art_triks` date NOT NULL,
  `date_derniere_modification_art_triks` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_74F2C951FB88E14F` (`utilisateur_id`),
  KEY `IDX_74F2C9517A45358C` (`groupe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `article_triks`
--

INSERT INTO `article_triks` (`id`, `utilisateur_id`, `groupe_id`, `nom_art_triks`, `contenu_art_triks`, `date_creation_art_triks`, `date_derniere_modification_art_triks`) VALUES
(87, 82, 77, 'Le mute', 'Un grab consiste à attraper la planche avec la main pendant le saut. Le verbe anglais to grab signifie « attraper. ». Le mute est le saisie de la carre frontside de la planche entre les deux pieds avec la main avant.', '2021-01-30', '2021-01-30'),
(88, 83, 78, 'Ride regular', 'Tout d\'abord, il faut savoir qu\'il y a deux positions sur sa planche: regular ou goofy. Un rider regular aura son pied gauche devant. Un rider regular qui descend en position goofy, dira qu\'il descend « switch ».', '2021-01-30', '2021-01-30'),
(89, 84, 79, 'Le 720', 'Pour entrer sur une barre de slide, le rideur peut se mettre perpendiculaire à l\'axe de la barre et fera donc un quart de tour en l\'air, modulo 360 degrés — il est possible de faire n tours complets plus un quart de tour. On a donc la dénomination suivante pour ce type de rotations : 450 pour un tour un quart.', '2021-01-30', '2021-01-30'),
(90, 85, 80, 'Le front flips', 'les front flips, rotations en avant. Il est possible de faire plusieurs flips à la suite, et d\'ajouter un grab à la rotation. Les flips agrémentés d\'une vrille existent aussi (Mac Twist, Hakon Flip, ...), mais de manière beaucoup plus rare, et se confondent souvent avec certaines rotations horizontales désaxées. ', '2021-01-30', '2021-01-30'),
(91, 86, 81, 'Le slide', 'Un slide consiste à glisser sur une barre de slide. Le slide se fait soit avec la planche dans l\'axe de la barre, soit perpendiculaire, soit plus ou moins désaxé. ', '2021-01-30', '2021-01-30'),
(92, 87, 82, 'Le misty', 'Une rotation désaxée est une rotation initialement horizontale mais lancée avec un mouvement des épaules particulier qui désaxe la rotation. Il existe différents types de rotations désaxées (corkscrew ou cork, rodeo, misty, etc.) en fonction de la manière dont est lancé le buste. Certaines de ces rotations, bien qu\'initialement horizontales, font passer la tête en bas.', '2021-01-30', '2021-01-30'),
(93, 88, 83, 'Old school', 'Le terme old school désigne un style de freestyle caractérisée par en ensemble de figure et une manière de réaliser des figures passée de mode, qui fait penser au freestyle des années 1980 - début 1990 (par opposition à new school) :\r\n                    figures désuètes : Japan air, rocket air, ...', '2021-01-30', '2021-01-30'),
(94, 89, 84, 'Le one foot triks', 'Figures réalisée avec un pied décroché de la fixation, afin de tendre la jambe correspondante pour mettre en évidence le fait que le pied n\'est pas fixé. Ce type de figure est extrêmement dangereuse pour les ligaments du genou en cas de mauvaise réception.', '2021-01-30', '2021-01-30');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `contenu_commentaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_commentaire` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_67F068BCFB88E14F` (`utilisateur_id`),
  KEY `IDX_67F068BC7294869C` (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `utilisateur_id`, `article_id`, `contenu_commentaire`, `date_commentaire`) VALUES
(60, 82, 87, 'ContenuCommentaire0', '2021-01-30'),
(61, 83, 88, 'ContenuCommentaire1', '2021-01-30'),
(62, 84, 89, 'ContenuCommentaire2', '2021-01-30'),
(63, 85, 90, 'ContenuCommentaire3', '2021-01-30'),
(64, 86, 91, 'ContenuCommentaire4', '2021-01-30'),
(65, 87, 92, 'ContenuCommentaire5', '2021-01-30'),
(66, 88, 93, 'ContenuCommentaire6', '2021-01-30'),
(67, 89, 94, 'ContenuCommentaire7', '2021-01-30'),
(68, 92, 88, 'Test commentaire', '2021-02-21'),
(69, 92, 88, 'test Commentaire 2', '2021-02-21');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20201130171516', '2020-11-30 17:15:25', 46),
('DoctrineMigrations\\Version20201130171625', '2020-11-30 17:16:30', 44),
('DoctrineMigrations\\Version20201130171700', '2020-11-30 17:17:04', 44),
('DoctrineMigrations\\Version20201130172110', '2020-11-30 17:21:18', 120),
('DoctrineMigrations\\Version20201130172515', '2020-11-30 17:25:59', 159),
('DoctrineMigrations\\Version20201130172807', '2020-11-30 17:28:10', 163),
('DoctrineMigrations\\Version20210130170817', '2021-01-30 17:10:23', 126);

-- --------------------------------------------------------

--
-- Structure de la table `groupe_triks`
--

DROP TABLE IF EXISTS `groupe_triks`;
CREATE TABLE IF NOT EXISTS `groupe_triks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_grp_triks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `groupe_triks`
--

INSERT INTO `groupe_triks` (`id`, `nom_grp_triks`) VALUES
(77, 'Grabs'),
(78, 'Ride'),
(79, 'Rotations'),
(80, 'Flips'),
(81, 'Slides'),
(82, 'Rotations desaxées'),
(83, 'Old school'),
(84, 'One foot triks');

-- --------------------------------------------------------

--
-- Structure de la table `image_triks`
--

DROP TABLE IF EXISTS `image_triks`;
CREATE TABLE IF NOT EXISTS `image_triks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `lien_img_triks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_14003FE97294869C` (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `image_triks`
--

INSERT INTO `image_triks` (`id`, `article_id`, `lien_img_triks`) VALUES
(86, 87, 'gre4gae4g56eg5rg5eg5rgreg85g8r4eg8.jpg'),
(87, 88, '47ef7ezfezfze7fez4faf4ze8fez5ds5f.jpg'),
(88, 89, 'r4g8rg4re8g48rg4e8r4g8eg4erg4.jpg'),
(89, 90, 'gg4r7g4eg87g4r8eg4g8erg4erg8.jpg'),
(90, 91, '59e5fz9f5ez9fez9f5ez9f5ez9f5ezez9f.jpg'),
(91, 92, 'NoPicture.jpg'),
(92, 93, 'NoPicture.jpg'),
(93, 94, '484gregr4egregregegergegeg.png'),
(94, 87, '898dc81c5b1ea36de55381ccfc0dc61c.png');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_utilisateur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_utilisateur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verif_mail_utilisateur` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1D1C63B3F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `username`, `roles`, `password`, `photo_utilisateur`, `mail_utilisateur`, `verif_mail_utilisateur`) VALUES
(82, 'test0', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$Rzl0UEgxcWpaTEZQOXBBUQ$akEBIU3KuH4NBRhNJpdaU7EQpEqypqVfjEfIlzNHiFI', 'NoPicture.jpg', 'test0@gmail.com', 0),
(83, 'test1', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$WFNiQkYuM1dDb3U1SEY5ag$ppC3XKP5jJLUCuCQlCcgDFJtdYfzUstkX2OZNbQqpAo', 'NoPicture.jpg', 'test1@gmail.com', 0),
(84, 'test2', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$Vk9NVlpWeGdvM2N5aE9PSw$k6YpD+KnXNtvozS4fwtgHZI1bkrx5Iqx1NiWJEadp1k', 'NoPicture.jpg', 'test2@gmail.com', 0),
(85, 'test3', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$d29rdngyVDJiZjZGNFMwVQ$nn3SlDwcfnrRbq665EpzGnXTqfGiSVJRbhWTwb4KDp0', 'NoPicture.jpg', 'test3@gmail.com', 0),
(86, 'test4', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$ZDEwS0FSY29HUkk4TzN4Lw$mL4b1kUUcOIne1D6WmCbTWZf4U/lX5bklPUo+zDxYAE', 'NoPicture.jpg', 'test4@gmail.com', 0),
(87, 'test5', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$UFFNNzVwaWRuYWR2UHlScg$XKnbbsxOXK66lFiB2v6EIsh9TxwK8Xzw8ixnuGVnHJY', 'NoPicture.jpg', 'test5@gmail.com', 1),
(88, 'test6', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$Y21rM1hKVkUuZnF6ZGc2bw$7TBd7yyk2TjnxuNgVG07CF+3ZZvgF+PzNirdwVBwzRQ', 'NoPicture.jpg', 'test6@gmail.com', 0),
(89, 'test7', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$WHU2N0JPelRXb3V5MTB5Sg$FYXrMHAQs597yVEd90ERZFTxXzE5GaYkFGnfDQhAIn8', 'NoPicture.jpg', 'test7@gmail.com', 0),
(92, 'xibougta', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$OUJOSm4uMVBPc3lVQ242Rw$PKaHtrgM/SLpx4JyBSZPsT9GdFCWjBe3DL+HNlLLXkY', 'NoPicture.jpg', 'lejujufoot05@gmail.com', 1),
(93, 'testPassword', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$QjhPZjkyYmt1clBXY0gvTw$X2n+LEbwl4ZBh0LI25mB7WA3UcrLyPSRss1IpGvQrOE', 'NoPicture.jpg', 'gg@gg.gg', 0),
(94, 'xibougta002', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$OHVheDRMZTV6WlMuNDk1dA$oDxLsTV2vNOdw2X6hQsp+dYzCQF5OBrUo+r1XrQbM9E', 'NoPicture.jpg', 'lejujufoot050@gmail.com', 0),
(95, 'tetetetet', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$d1lhR1FXbkNJbzZzbDgwZw$aIft6nCMu56pFX34caAmlvO+DE4PMhfizBH2a0eYPPA', 'NoPicture.jpg', 'positu@ggjg.gg', 1),
(96, 'xibougta2', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$SS94RnRhR1ZqNUNuTWN5eg$SoktYsr+GFVeQMDjYT6xetr4E/GsvrS0Dh8IrGA4V0U', 'NoPicture.jpg', 'lejujufoot0500@gmail.com', 1);

-- --------------------------------------------------------

--
-- Structure de la table `video_triks`
--

DROP TABLE IF EXISTS `video_triks`;
CREATE TABLE IF NOT EXISTS `video_triks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `lien_vid_triks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8C27B2E27294869C` (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `video_triks`
--

INSERT INTO `video_triks` (`id`, `article_id`, `lien_vid_triks`) VALUES
(69, 87, 'https://www.youtube.com/watch?v=CflYbNXZU3Q'),
(70, 88, 'https://www.youtube.com/watch?v=d-VSIhTmYAI'),
(71, 89, 'https://www.youtube.com/watch?v=S2tAZPF7PCk'),
(72, 90, 'https://www.youtube.com/watch?v=gMfmjr-kuOg'),
(73, 91, 'https://www.youtube.com/watch?v=WOgw5uBSLp0'),
(74, 92, 'https://www.youtube.com/watch?v=hPuVJkw1MmI'),
(75, 93, 'https://www.youtube.com/watch?v=mTFMakbP0xw'),
(76, 94, 'https://www.youtube.com/watch?v=4IVdWdvsrVA'),
(77, 88, 'test2');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article_triks`
--
ALTER TABLE `article_triks`
  ADD CONSTRAINT `FK_74F2C9517A45358C` FOREIGN KEY (`groupe_id`) REFERENCES `groupe_triks` (`id`),
  ADD CONSTRAINT `FK_74F2C951FB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `FK_67F068BC7294869C` FOREIGN KEY (`article_id`) REFERENCES `article_triks` (`id`),
  ADD CONSTRAINT `FK_67F068BCFB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `image_triks`
--
ALTER TABLE `image_triks`
  ADD CONSTRAINT `FK_14003FE97294869C` FOREIGN KEY (`article_id`) REFERENCES `article_triks` (`id`);

--
-- Contraintes pour la table `video_triks`
--
ALTER TABLE `video_triks`
  ADD CONSTRAINT `FK_8C27B2E27294869C` FOREIGN KEY (`article_id`) REFERENCES `article_triks` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
