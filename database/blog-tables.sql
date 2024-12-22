-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 22, 2024 at 03:02 PM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `Id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `Title` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`Id`, `Title`, `Description`) VALUES
(21, 'Strategy', 'Strategy games are a genre of video games that emphasize thoughtful planning, resource management, and decision-making to achieve victory. Players must use strategic thinking to outmaneuver opponents, manage resources effectively, and adapt to dynamic scenarios. These games often challenge players&#039; foresight, tactical skills, and problem-solving abilities.'),
(20, 'Battle Royale', 'Battle Royale games are a subgenre of multiplayer online video games that combine elements of survival, exploration, and scavenging with a shrinking play area, creating intense and competitive gameplay. Inspired by the &quot;last person standing&quot; concept, these games draw players into high-stakes matches where strategy, skill, and quick thinking are essential.'),
(22, 'Basket', 'Basketball games simulate the fast-paced and strategic sport of basketball, allowing players to experience the excitement of competing on the court. These games can range from realistic simulations with professional teams and players to arcade-style titles focusing on high-energy gameplay and exaggerated moves. They are popular in both video game formats and traditional, casual settings.');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `Id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `Title` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `Thumbnail` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Category_id` int NOT NULL,
  `Author_id` int NOT NULL,
  `Is_featured` int NOT NULL,
  `Date_time` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`Id`, `Title`, `Description`, `Thumbnail`, `Category_id`, `Author_id`, `Is_featured`, `Date_time`) VALUES
(49, 'Brawl stars', 'Brawl Stars is a fast-paced, multiplayer online battle game developed by Supercell. It features vibrant characters, known as &quot;Brawlers,&quot; and a variety of game modes that emphasize teamwork, strategy, and quick reflexes. Players engage in short, action-packed matches in diverse maps and scenarios, ranging from team-based objectives to solo survival challenges.', '1734878884brawl_stars.jpg', 21, 29, 0, '2024-12-22 14:48:04'),
(50, 'Kuroko Basket', 'Basketball games simulate the fast-paced and strategic sport of basketball, allowing players to experience the excitement of competing on the court. These games can range from realistic simulations with professional teams and players to arcade-style titles focusing on high-energy gameplay and exaggerated moves. They are popular in both video game formats and traditional, casual settings.', '1734878964kuroko_basket.jpg', 21, 29, 1, '2024-12-22 14:49:24'),
(47, 'Clash of clans', 'Clash of Clans is a highly popular mobile strategy game developed by Supercell. It combines base-building, resource management, and tactical combat in a vibrant, fantasy-themed world. Players create and defend their villages, raid others for resources, and collaborate in clans to engage in epic battles and wars.', '1734878518clash_of_clans.jpg', 21, 22, 0, '2024-12-22 14:41:58'),
(48, 'Fornite', 'Fortnite is a wildly popular multiplayer online game developed by Epic Games. It gained fame for its unique blend of battle royale gameplay, creative building mechanics, and vibrant art style. Fortnite offers various modes, including the iconic Battle Royale, where players compete to be the last person or team standing on an ever-shrinking island.', '1734878606fortnite.jpg', 20, 22, 0, '2024-12-22 14:43:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `Id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Avatar` varchar(255) NOT NULL,
  `Admin` int NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `FirstName`, `LastName`, `UserName`, `Email`, `Password`, `Avatar`, `Admin`) VALUES
(22, 'Gaspard', 'VIEUJEAN', 'Sweety', 'gaspard@gamil.com', '$2y$10$uu/2AvVLy5PHkx1UbFqX2.vbpiYKUd/czaEpK.ZMQngtn7ffZITga', '1733198428avatar13.jpg', 1),
(29, 'Boris', 'GANGUE', 'Boris', 'borisgangue@azerty.fr', '$2y$10$h8aGYHOsS/L38tpiCP/1ve6JDn4.gynlGm4MbKqPnzkseXd6ZAa7G', '1734878776deathNote_L.jpg', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
