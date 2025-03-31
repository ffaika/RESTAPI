-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : dim. 13 août 2023 à 13:32
-- Version du serveur : 8.0.32
-- Version de PHP : 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `app`
--

-- --------------------------------------------------------

--
-- Structure de la table `Album`
--

DROP TABLE IF EXISTS `Album`;
CREATE TABLE `Album` (
  `id` int NOT NULL COMMENT 'Identifiant unique de l''album.',
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Titre de l''album.',
  `artist` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Nom de l''artiste qui a créé l''album.',
  `release_date` date DEFAULT NULL COMMENT 'Date de sortie de l''album.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Album`
--

INSERT INTO `Album` (`id`, `title`, `artist`, `release_date`) VALUES
(1, 'A Night at the Opera', 'Queen', '1975-07-16'),
(2, 'Led Zeppelin IV', 'Led Zeppelin', '1982-07-14'),
(3, 'Thriller', 'Michael Jackson', '1984-07-11');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2023_03_18_151656_create_Album_table', 1),
(2, '2023_03_18_151656_create_Playlist_table', 1),
(3, '2023_03_18_151656_create_SignupRequest_table', 1),
(4, '2023_03_18_151656_create_Song_table', 1),
(5, '2023_03_18_151656_create_User_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Playing`
--

DROP TABLE IF EXISTS `Playing`;
CREATE TABLE `Playing` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `song_id` int NOT NULL,
  `time` int NOT NULL,
  `playing_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Playing`
--

INSERT INTO `Playing` (`id`, `user_id`, `song_id`, `time`, `playing_at`) VALUES
(1, 1, 4, 455, DATE_SUB(now(), INTERVAL 2 HOUR)),
(2, 1, 4, 455, DATE_SUB(now(), INTERVAL 1 HOUR)),
(3, 1, 4, 455, DATE_SUB(now(), INTERVAL 30 MINUTE)),
(4, 1, 4, 455, DATE_SUB(now(), INTERVAL 15 MINUTE)),
(5, 1, 6, 455, DATE_SUB(now(), INTERVAL 10 MINUTE)),
(6, 1, 5, 455, DATE_SUB(now(), INTERVAL 5 MINUTE)),
(7, 2, 4, 455, DATE_SUB(now(), INTERVAL 2 HOUR)),
(8, 2, 7, 234, DATE_SUB(now(), INTERVAL 1 HOUR)),
(9, 3, 2, 567, DATE_SUB(now(), INTERVAL 30 MINUTE)),
(10, 3, 1, 567, DATE_SUB(now(), INTERVAL 2 MONTH)),
(11, 1, 1, 455, DATE_SUB(now(), INTERVAL 4 MONTH));

-- --------------------------------------------------------

--
-- Structure de la table `Playlist`
--

DROP TABLE IF EXISTS `Playlist`;
CREATE TABLE `Playlist` (
  `id` int NOT NULL COMMENT 'Identifiant unique de la playlist',
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Titre de la playlist',
  `author` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Auteur de la playlist',
  `songs` json NOT NULL COMMENT 'Liste des chansons de la playlist'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `Playlist`
--

INSERT INTO `Playlist` (`id`, `title`, `author`, `songs`) VALUES
(1, 'Rock Classics', 'John Doe', '[3, 6, 4]'),
(2, '80s Pop', 'John Doe', '[2, 9, 3]');

-- --------------------------------------------------------

--
-- Structure de la table `SignupRequest`
--

DROP TABLE IF EXISTS `SignupRequest`;
CREATE TABLE `SignupRequest` (
  `id` int NOT NULL COMMENT 'Identifiant unique de la demande d''inscription',
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Adresse email de l''utilisateur',
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Mot de passe de l''utilisateur',
  `first_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Prénom de l''utilisateur',
  `last_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Nom de famille de l''utilisateur',
  `status` enum('pending','accepted','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'pending' COMMENT 'Statut de la demande d''inscription'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `SignupRequest`
--

INSERT INTO `SignupRequest` (`id`, `email`, `password`, `first_name`, `last_name`, `status`) VALUES
(1, 'john.doe@email.com', 'password', 'John', 'Doe', 'pending'),
(2, 'john.doe2@email.com', 'password', 'John', 'Doe', 'pending');

-- --------------------------------------------------------

--
-- Structure de la table `Song`
--

DROP TABLE IF EXISTS `Song`;
CREATE TABLE `Song` (
  `id` int NOT NULL COMMENT 'Identifiant unique de la chanson',
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Titre de la chanson',
  `artist` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Artiste de la chanson',
  `album_id` int NOT NULL COMMENT 'Album de la chanson'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `Song`
--

INSERT INTO `Song` (`id`, `title`, `artist`, `album_id`) VALUES
(1, 'Bohemian Rhapsody', 'Queen', 1),
(2, 'You\'re My Best Friend', 'Queen', 1),
(3, 'Love of My Life', 'Queen', 1),
(4, 'Black Dog', 'Led Zeppelin', 2),
(5, 'Rock and Roll', 'Led Zeppelin', 2),
(6, 'Stairway to Heaven', 'Led Zeppelin', 2),
(7, 'Thriller', 'Michael Jackson', 3),
(8, 'Beat It', 'Michael Jackson', 3),
(9, 'Billie Jean', 'Michael Jackson', 3);

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

DROP TABLE IF EXISTS `User`;
CREATE TABLE `User` (
  `id` int NOT NULL COMMENT 'Identifiant unique de l''utilisateur',
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Adresse email de l''utilisateur',
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Mot de passe de l''utilisateur',
  `first_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Prénom de l''utilisateur',
  `last_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Nom de famille de l''utilisateur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `User`
--

INSERT INTO `User` (`id`, `email`, `password`, `first_name`, `last_name`) VALUES
(1, 'admin@email.com', 'password', 'Admin', 'Admin'),
(2, 'user1@email.com', 'password', 'User1', 'User1'),
(3, 'user2@email.com', 'password', 'User2', 'User2');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Album`
--
ALTER TABLE `Album`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Playing`
--
ALTER TABLE `Playing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_USER_ID` (`user_id`),
  ADD KEY `FK_SONG_ID` (`song_id`);

--
-- Index pour la table `Playlist`
--
ALTER TABLE `Playlist`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `SignupRequest`
--
ALTER TABLE `SignupRequest`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Song`
--
ALTER TABLE `Song`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Album`
--
ALTER TABLE `Album`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique de l''album.', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `Playing`
--
ALTER TABLE `Playing`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `Playlist`
--
ALTER TABLE `Playlist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique de la playlist', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `SignupRequest`
--
ALTER TABLE `SignupRequest`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique de la demande d''inscription', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Song`
--
ALTER TABLE `Song`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique de la chanson', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `User`
--
ALTER TABLE `User`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique de l''utilisateur', AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Playing`
--
ALTER TABLE `Playing`
  ADD CONSTRAINT `FK_SONG_ID` FOREIGN KEY (`song_id`) REFERENCES `Song` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_USER_ID` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
