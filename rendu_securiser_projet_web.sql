-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 02, 2024 at 08:46 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rendu_securiser_projet_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `article_id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `slug` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`article_id`, `title`, `content`, `slug`) VALUES
(11, 'pdoqjoimdzbmquzdbzqd', 'fqzfqzfobmqbfzoihzqfzqf', 487),
(12, 'merci ilyan', 'gg', 6874);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `pseudo` varchar(45) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `slug` int NOT NULL,
  `admin` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `mail`, `password`, `slug`, `admin`) VALUES
(1, 'fefsf', 'ilyanjude@gmail.com', '$2y$10$CTkehiUQOARGPZwGPus72O9yxJTZi4doWikOJvlO5izF/YQWIuOJS', 1, 0),
(2, 'Thisma', 'dardemathis@gmail.com', '$2y$10$xMDhjGw0RQzI4DHNOLnS..dU4BpIZGOfmJGcChThtGn9Og6UforGK', 148, 1),
(3, 'Chrissou', 'chris@yahoo.fr', '$2y$10$9sJcW1qbjg2TYAIBozUUlexNPksmr.9fIyUmaUTWC1YmRofuJ72KO', 95, 0),
(5, 'Chrissou', 'gg@gmail.com', '$2y$10$wOzoJtxLI/2n.dwTlvTdTOIj6hKyijr/mMEamVcYw64pIk58WouIe', 95, 0),
(6, 'ugo', 'ugo@gmail.com', '$2y$10$U0N.Gx5J9Vs7hlAxti/Tn.sYlJSEOyYvtEUNbaLvHpYKfCdBjCC.i', 89, 0),
(7, 'Ilyan-Juif', 'dbzqiudbzudq@gmail.com', '$2y$10$ymNVYPqoyi.SKVHFCmN.bOZUER5MOBAdKi6UFfe5iqCylvYmQ1VY2', 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`article_id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `article_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
