-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generated on: Sun August 13, 2023 at 1:32 p.m.
-- Server version: 8.0.32
-- PHP version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app`
--

-- --------------------------------------------------------

--
-- Structure of the `albums` table
--

DROP TABLE IF EXISTS `albums`;
CREATE TABLE `albums` (
  `id` int NOT NULL COMMENT 'Unique album identifier.',
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Album title.',
  `artist` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Name of the artist who created the album.',
  `release_date` date DEFAULT NULL COMMENT 'Album release date.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Inserting data into the `albums` table
--

INSERT INTO `albums` (`id`, `title`, `artist`, `release_date`) VALUES
(1, 'A Night at the Opera', 'Queen', '1975-07-16'),
(2, 'Led Zeppelin IV', 'Led Zeppelin', '1982-07-14'),
(3, 'Thriller', 'Michael Jackson', '1984-07-11');

-- --------------------------------------------------------

--
-- Structure of the `migrations` table
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Inserting data into the `migrations` table
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_02_21_151656_create_Album_table', 1),
(2, '2025_02_21_151656_create_Playlist_table', 1),
(3, '2025_02_21_151656_create_SignupRequest_table', 1),
(4, '2025_02_21_151656_create_Song_table', 1),
(5, '2025_02_21_151656_create_User_table', 1);

-- --------------------------------------------------------

--
-- Structure of the `playings` table
--

DROP TABLE IF EXISTS `playings`;
CREATE TABLE `playings` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `song_id` int NOT NULL,
  `time` int NOT NULL,
  `playing_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Inserting data into the `playings` table
--

INSERT INTO `playings` (`id`, `user_id`, `song_id`, `time`, `playing_at`) VALUES
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
-- Structure of the `playlists` table
--

DROP TABLE IF EXISTS `playlists`;
CREATE TABLE `playlists` (
  `id` int NOT NULL COMMENT 'Unique playlist identifier',
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Playlist title',
  `author` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Playlist author',
  `songs` json NOT NULL COMMENT 'List of songs in the playlist'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Inserting data into the `playlists` table
--

INSERT INTO `playlists` (`id`, `title`, `author`, `songs`) VALUES
(1, 'Rock Classics', 'John Doe', '[3, 6, 4]'),
(2, '80s Pop', 'John Doe', '[2, 9, 3]');

-- --------------------------------------------------------

--
-- Structure of the `signup_requests` table
--

DROP TABLE IF EXISTS `signup_requests`;
CREATE TABLE `signup_requests` (
  `id` int NOT NULL COMMENT 'Unique identifier of the registration request',
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'User email address',
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'User password',
  `first_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'User first name',
  `last_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'User last name',
  `status` enum('pending','accepted','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'pending' COMMENT 'Status of registration request'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Inserting data into the `signup_requests` table
--

INSERT INTO `signup_requests` (`id`, `email`, `password`, `first_name`, `last_name`, `status`) VALUES
(1, 'john.doe@email.com', 'password', 'John', 'Doe', 'pending'),
(2, 'john.doe2@email.com', 'password', 'John', 'Doe', 'pending');

-- --------------------------------------------------------

--
-- Structure of the `songs` table
--

DROP TABLE IF EXISTS `songs`;
CREATE TABLE `songs` (
  `id` int NOT NULL COMMENT 'Unique song identifier',
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Song title',
  `artist` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Song artist',
  `album_id` int NOT NULL COMMENT 'Song album'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Inserting data into the `songs` table
--

INSERT INTO `songs` (`id`, `title`, `artist`, `album_id`) VALUES
(1, 'Bohemian Rhapsody', 'Queen', 1),
(2, 'You''re My Best Friend', 'Queen', 1),
(3, 'Love of My Life', 'Queen', 1),
(4, 'Black Dog', 'Led Zeppelin', 2),
(5, 'Rock and Roll', 'Led Zeppelin', 2),
(6, 'Stairway to Heaven', 'Led Zeppelin', 2),
(7, 'Thriller', 'Michael Jackson', 3),
(8, 'Beat It', 'Michael Jackson', 3),
(9, 'Billie Jean', 'Michael Jackson', 3);

-- --------------------------------------------------------

--
-- Structure of the `users` table
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL COMMENT 'Unique user ID',
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'User email address',
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'User password',
  `first_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'User first name',
  `last_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'User last name'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Inserting data into the `users` table
--

INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`) VALUES
(1, 'admin@email.com', 'password', 'Admin', 'Admin'),
(2, 'user1@email.com', 'password', 'User1', 'User1'),
(3, 'user2@email.com', 'password', 'User2', 'User2');

--
-- Indexes for tables
--

--
-- Index for the `albums` table
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Index for the `migrations` table
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index for the `playings` table
--
ALTER TABLE `playings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_USER_ID` (`user_id`),
  ADD KEY `FK_SONG_ID` (`song_id`);

--
-- Index for the `playlists` table
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`);

--
-- Index for the `signup_requests` table
--
ALTER TABLE `signup_requests`
  ADD PRIMARY KEY (`id`);

--
-- Index for the `songs` table
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`);

--
-- Index for the `users` table
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Unique album identifier.', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `playings`
--
ALTER TABLE `playings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Unique playlist identifier', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `signup_requests`
--
ALTER TABLE `signup_requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier of the registration request', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Unique song identifier', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Unique user ID', AUTO_INCREMENT=5;

--
-- Constraints for tables
--

--
-- Constraints for table `playings`
--
ALTER TABLE `playings`
  ADD CONSTRAINT `FK_SONG_ID` FOREIGN KEY (`song_id`) REFERENCES `songs` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_USER_ID` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
