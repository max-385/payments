-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2020 at 12:57 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payments`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `export_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `sum` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id`, `export_id`, `payment_id`, `sum`) VALUES
(1, 1, 9, 1),
(2, 1, 10, 0.5),
(3, 1, 10, 1),
(4, 2, 11, 1),
(5, 2, 12, 0.5),
(6, 2, 13, 1),
(7, 3, 14, 1),
(8, 3, 15, 0.5),
(9, 3, 15, 1),
(10, 3, 15, 1),
(11, 3, 15, 0.5),
(12, 3, 15, 1),
(13, 3, 16, 1),
(14, 3, 17, 0.5),
(15, 4, 18, 1),
(16, 4, 19, 1),
(17, 4, 20, 1),
(18, 4, 21, 0.5),
(19, 4, 22, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `export_id` (`export_id`),
  ADD KEY `payment_id` (`payment_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
