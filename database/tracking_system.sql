-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 05, 2019 at 10:26 PM
-- Server version: 10.0.28-MariaDB-2+b1
-- PHP Version: 7.3.9-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tracking_system`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `dashboard`
-- (See below for the actual view)
--
CREATE TABLE `dashboard` (
`userID` int(11)
,`firstName` varchar(32)
,`lastName` varchar(32)
,`status` int(1)
,`role` int(11)
,`mac` varchar(50)
,`pi1` int(11)
,`pi2` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `tracking`
--

CREATE TABLE `tracking` (
  `id` int(11) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `mac` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `pi1` int(11) NOT NULL DEFAULT '100',
  `pi2` int(11) NOT NULL DEFAULT '100'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tracking`
--

INSERT INTO `tracking` (`id`, `ip`, `mac`, `status`, `pi1`, `pi2`) VALUES
(36, '192.168.4.6', 'f0:98:9d:c6:ce:dd', 1, 100, 100),
(37, '192.168.4.10', 'd0:13:fd:52:c3:d5', 1, 48, 100),
(38, '192.168.4.11', 'a4:d1:8c:d0:7e:6c', 1, 100, 100),
(39, '192.168.4.7', '34:12:f9:76:e8:df', 1, 100, 100),
(40, '192.168.4.18', 'b0:e1:7e:33:19:1f', 1, 100, 100),
(41, '192.168.4.20', 'bc:98:df:ae:62:56', 1, 100, 100),
(42, '192.168.4.5', '36:49:50:e2:88:d2', 1, 100, 100),
(43, '192.168.4.4', '64:a2:f9:3d:91:10', 1, 48, 100);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(32) NOT NULL,
  `lastName` varchar(32) NOT NULL,
  `userIP` varchar(64) NOT NULL,
  `mac` varchar(50) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `userIP`, `mac`, `role`) VALUES
(1, 'Logan', 'Jones', '192.168.4.10', 'd0:13:fd:52:c3:d5', 1),
(2, 'Hemanth', 'Anil', '192.168.4.6', 'f0:98:9d:c6:ce:dd', 0),
(3, 'John', 'Smith', '192.168.4.11', 'a4:d1:8c:d0:7e:6c', 1),
(4, 'Fahad', 'M', '192.168.4.7', '34:12:f9:76:e8:df', 0),
(5, '何か', '凄いぞ', '192.168.4.18', 'b0:e1:7e:33:19:1f', 0),
(6, 'SANS', 'UNDERTALE', '192.168.4.20', 'bc:98:df:ae:62:56', 1),
(7, 'Henry', 'Albuquerque', '192.168.4.4', '64:a2:f9:3d:91:10', 0);

-- --------------------------------------------------------

--
-- Structure for view `dashboard`
--
DROP TABLE IF EXISTS `dashboard`;

CREATE ALGORITHM=UNDEFINED DEFINER=`piDB`@`%` SQL SECURITY DEFINER VIEW `dashboard`  AS  select `users`.`id` AS `userID`,`users`.`firstName` AS `firstName`,`users`.`lastName` AS `lastName`,`tracking`.`status` AS `status`,`users`.`role` AS `role`,`users`.`mac` AS `mac`,`tracking`.`pi1` AS `pi1`,`tracking`.`pi2` AS `pi2` from (`users` join `tracking` on((`users`.`mac` = `tracking`.`mac`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tracking`
--
ALTER TABLE `tracking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mac` (`mac`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userIPIndex` (`userIP`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tracking`
--
ALTER TABLE `tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
