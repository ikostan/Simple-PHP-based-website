-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2017 at 01:00 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `channelwatchdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `channeltbl`
--

CREATE TABLE `channeltbl` (
  `ch_id` int(7) NOT NULL,
  `ch_title` varchar(50) NOT NULL,
  `ch_genere` enum('e','f','i','m','n','o','s','t') NOT NULL,
  `ch_price` decimal(8,2) NOT NULL,
  `cha_logo` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `channeltbl`
--

INSERT INTO `channeltbl` (`ch_id`, `ch_title`, `ch_genere`, `ch_price`, `cha_logo`) VALUES
(1, 'Disney XD', 'f', '2.99', 'dis.jpg'),
(2, 'Teletoon', 'f', '2.99', 'tele.jpg'),
(3, 'HBO Canada', 'e', '19.99', 'hbo.jpg'),
(4, 'DejaView', 'o', '9.99', 'dj.jpg'),
(5, 'CNN', 'n', '3.99', 'cnn.jpg'),
(6, 'Bloomberg Television', 'n', '1.99', 'bloom.jpg'),
(7, 'MSNBC', 'n', '1.99', 'msn.jpg'),
(8, 'Memorable Entertainment Television (Me-TV)', 'o', '3.00', 'metv.jpg'),
(9, 'Space', 's', '5.99', 'space.jpg'),
(10, 'Syfy', 's', '9.99', 'syfy.jpg'),
(11, 'National Geographic Channel', 'i', '2.99', 'ng.jpg'),
(12, 'Discovery Channel', 'i', '2.99', 'disc.jpg'),
(13, 'BBC Canada', 'e', '9.99', 'bbcCan.jpg'),
(14, 'Turner Classic Movies (TCM)', 'm', '5.99', 'tcm.jpg'),
(15, 'The Movie Network', 'm', '11.99', 'tmn.jpg'),
(16, 'Super Channel', 'm', '14.99', 'sc.jpg'),
(17, 'Encore Avenue', 'm', '9.99', 'ea.jpg'),
(18, 'Silver Screen Classics', 'm', '8.99', 'sil.jpg'),
(19, 'MovieTime', 'm', '11.99', 'mt.jpg'),
(20, 'The Golf Channel', 't', '1.99', 'gc.jpg'),
(21, 'Rewind', 'm', '9.99', 'rew.jpg'),
(22, 'The Sports Network (TSN)', 't', '5.99', 'tsn.jpg'),
(23, 'Sportsnet World', 't', '14.99', 'sw.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `channeltbl`
--
ALTER TABLE `channeltbl`
  ADD PRIMARY KEY (`ch_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `channeltbl`
--
ALTER TABLE `channeltbl`
  MODIFY `ch_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
