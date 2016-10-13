-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2016 at 03:28 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `facebook_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` text COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `comment`, `created_at`) VALUES
(1, 1, '6', 'hi muna', '2016-10-10 12:15:22'),
(2, 2, '6', 'hello', '2016-10-12 07:18:32'),
(3, 1, '4', 'good morning', '2016-10-12 08:39:32'),
(4, 1, '2', 'ppppppp', '2016-10-12 11:05:30'),
(5, 1, '2', 'nice', '2016-10-12 11:09:20');

-- --------------------------------------------------------

--
-- Table structure for table `friend_ships`
--

CREATE TABLE IF NOT EXISTS `friend_ships` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `is_friend` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `friend_ships`
--

INSERT INTO `friend_ships` (`id`, `user_id`, `friend_id`, `is_friend`, `created_at`, `updated_at`) VALUES
(11, 3, 1, 1, '2016-10-09 11:46:29', '2016-10-09 08:47:06'),
(12, 1, 3, 1, '2016-10-09 11:47:06', '2016-10-09 11:47:06'),
(13, 4, 2, 1, '2016-10-09 12:04:38', '2016-10-09 09:08:54'),
(14, 2, 4, 1, '2016-10-09 12:08:54', '2016-10-09 12:08:54');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_10_06_075244_create_posts_table', 1),
('2016_10_09_063604_create_friend_ships_table', 2),
('2016_10_10_075412_create_comments_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `check_image` int(11) NOT NULL DEFAULT '0',
  `privacy` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post`, `user_id`, `image`, `check_image`, `privacy`, `created_at`) VALUES
(1, 'hello', 4, '', 0, 0, '2016-10-09 08:14:56'),
(2, '111111111111111111111111111111111111111111', 3, '1476000911-Desert.jpg', 1, 1, '2016-10-09 08:15:12'),
(3, 'good morning', 3, '', 0, 0, '2016-10-09 08:25:40'),
(4, 'good evening', 4, '', 0, 1, '2016-10-09 08:25:54'),
(5, '00000000', 1, '', 0, 0, '2016-10-09 09:43:29'),
(6, 'hi', 2, '', 0, 1, '2016-10-09 13:37:39'),
(7, 'hi fiernds', 2, '', 0, 0, '2016-10-09 13:37:55'),
(8, '9999', 2, '', 0, 0, '2016-10-09 14:49:18'),
(10, ':)', 2, '1476024959-Penguins.jpg', 1, 0, '2016-10-09 14:55:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'soad', 's@h.com', '$2y$10$nKg6hdpcl22GKm38/t097O09HbUGybB0Ur1.PcY25YGVrAyJfM2Ua', '0BagIchXXTNUFXQJiX1azCPRDi2cUDECqErzTovO6VkdxgnqcgLGNGwsndxG', NULL, '2016-10-12 08:15:16'),
(2, 'muna', 'm@h.com', '$2y$10$DaKwpKdS94.Cg.DAz4q4wupgGmpoStUjr6Hf9sJUMMWBN7d4BOJgm', 'H2waGB2FsMgrArlZcNkRjSbrV2KGg0qhBM9w9LXPTwhLLa3vSUJJZRDLqleo', '0000-00-00 00:00:00', '2016-10-09 10:50:38'),
(3, 's', 'r@h.com', '$2y$10$uuV/Pk8dxBKWtYvpJtVTIu16fIfJ2yFDwMO/tCf3TWNPZomuFhXNG', 'ZWpeeOFGBxlnU3n05Yrx4eTEo9KRrHcX6okwQp74ee9hYgXB6POELQyxao7w', '0000-00-00 00:00:00', '2016-10-09 08:46:39'),
(4, 'a', 'a@h.com', '$2y$10$b83D74TIk2Wg3TTosFe6R.xMuW16Whw8baDXlIKnhyK4jLJICnY2u', '9XV0UzVrJBkD43YnNcIvy3hjpyZ4dJKzTR3xLsrXcyTrCP7yUWPBnuRsz5AX', '0000-00-00 00:00:00', '2016-10-09 09:05:43');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
