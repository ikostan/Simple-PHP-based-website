-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2017 at 01:17 AM
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
-- Table structure for table `ordertbl`
--

CREATE TABLE `ordertbl` (
  `ord_id` int(5) NOT NULL,
  `ord_in_cart_ordered` enum('n','y') NOT NULL,
  `ord_price` decimal(8,2) NOT NULL,
  `ord_cust_id` int(5) NOT NULL,
  `ord_ch_id` int(7) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ordertbl`
--

INSERT INTO `ordertbl` (`ord_id`, `ord_in_cart_ordered`, `ord_price`, `ord_cust_id`, `ord_ch_id`) VALUES
(31, 'y', '9.99', 8, 13),
(30, 'n', '3.00', 8, 8),
(29, 'n', '9.99', 8, 4),
(28, 'y', '19.99', 9, 3),
(27, 'n', '1.99', 9, 6),
(26, 'y', '9.99', 9, 4),
(25, 'n', '3.99', 9, 5),
(24, 'n', '9.99', 9, 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ordertbl`
--
ALTER TABLE `ordertbl`
  ADD PRIMARY KEY (`ord_id`),
  ADD KEY `fk_ordertbl_customertbl_idx` (`ord_cust_id`),
  ADD KEY `fk_ordertbl_channeltbl1_idx` (`ord_ch_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
