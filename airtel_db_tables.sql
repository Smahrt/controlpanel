-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2017 at 11:35 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `airtel`
--

-- --------------------------------------------------------

--
-- Table structure for table `aggregators`
--

CREATE TABLE IF NOT EXISTS `aggregators` (
`id` smallint(6) NOT NULL,
  `link_title` varchar(20) NOT NULL,
  `ip_address` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aggregators`
--

INSERT INTO `aggregators` (`id`, `link_title`, `ip_address`) VALUES
(2, 'Link 1', '192.168.2.2'),
(3, 'Link 2', '14.1.2.3'),
(5, 'Link y', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `role` varchar(25) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(300) NOT NULL,
  `gender` text NOT NULL,
  `location` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `firstname`, `lastname`, `username`, `password`, `gender`, `location`) VALUES
(15, 'Admin', 'Ene', 'Okon', 'admin', '$2y$10$bQMNJxy.T9s3D0BIgZGrOOFNS/qk.Z5oeE6RUPx0Aoa2MxhJ3MUqC', 'Male', 'Abuja FCT'),
(16, 'User', 'Kubiat', 'Morgan', 'kubiat.morgan', '$2y$10$bpdL2CLdy1IkNd2AMWJWa.VuAVFJjrliN9fBAVMHb3/BIvJSq0YOC', 'Male', 'Akwa Ibom'),
(17, 'User', 'hamidoke', 'oluwadara', 'hamidoke.oluwadara', '$2y$10$itFts3ZnHube.QJcuRnQgOctnPycKq0BfYLmO5npHqVRHsE/Jo/Ay', 'Female', 'Bayelsa'),
(18, 'Admin', 'Ayodeni', 'Sanya', 'ayodeni.sanya', '$2y$10$ebNNKJgm9Bk82jvR3fQrdOJEBgl6beCr03ukSuVlekD1quo3ZKjtG', 'Female', 'Ogun');

-- --------------------------------------------------------

--
-- Table structure for table `users_stats`
--

CREATE TABLE IF NOT EXISTS `users_stats` (
  `username` varchar(50) NOT NULL,
`id` int(20) NOT NULL,
  `date_logged_in` varchar(20) NOT NULL,
  `time_logged_in` varchar(20) NOT NULL,
  `aggregator` varchar(20) NOT NULL,
  `access_time` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_stats`
--

INSERT INTO `users_stats` (`username`, `id`, `date_logged_in`, `time_logged_in`, `aggregator`, `access_time`) VALUES
('kubiat.morgan', 1, '0000-00-00', '10:39:00', 'Link 1', '12:08 pm'),
('kubiat.morgan', 2, '02-02-2017', '10:42 am', 'Link 1', '12:08 pm'),
('admin', 3, '03-02-2017', '09:00 am', '', ''),
('kubiat.morgan', 4, '03-02-2017', '09:21 am', 'Link 1', '09:24 am'),
('kubiat.morgan', 5, '03-02-2017', '09:32 am', '', ''),
('kubiat.morgan', 6, '03-02-2017', '09:33 am', 'Link 2', '09:41 am'),
('kubiat.morgan', 7, '03-02-2017', '09:41 am', '', ''),
('kubiat.morgan', 8, '03-02-2017', '09:45 am', 'Link 3', '09:47 am'),
('kubiat.morgan', 9, '03-02-2017', '09:46 am', 'Link 1', '09:47 am'),
('admin', 10, '03-02-2017', '10:01 am', '', ''),
('admin', 11, '03-02-2017', '10:15 am', '', ''),
('kubiat.morgan', 12, '03-02-2017', '10:19 am', '', ''),
('admin', 13, '03-02-2017', '10:20 am', 'Link 1', '10:42 am'),
('admin', 14, '03-02-2017', '08:28 pm', '', ''),
('admin', 15, '04-02-2017', '07:19 am', '', ''),
('admin', 16, '04-02-2017', '08:47 am', '', '08:48 am'),
('admin', 17, '04-02-2017', '11:22 am', 'Link 3', '11:22 am'),
('admin', 18, '04-02-2017', '06:17 pm', 'Link 1', '01:32 am'),
('admin', 19, '05-02-2017', '06:18 pm', '', ''),
('admin', 20, '05-02-2017', '07:04 pm', '', '10:38 pm'),
('admin', 21, '05-02-2017', '10:39 pm', 'Link 1', '10:51 pm'),
('kubiat.morgan', 22, '06-02-2017', '01:25 am', 'Link 1', '02:01 am'),
('kubiat.morgan', 23, '06-02-2017', '09:07 am', 'Link 2', '10:45 am'),
('admin', 24, '06-02-2017', '09:44 am', 'Link y', '09:56 am'),
('admin', 25, '06-02-2017', '10:45 am', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aggregators`
--
ALTER TABLE `aggregators`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_stats`
--
ALTER TABLE `users_stats`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aggregators`
--
ALTER TABLE `aggregators`
MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `users_stats`
--
ALTER TABLE `users_stats`
MODIFY `id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
