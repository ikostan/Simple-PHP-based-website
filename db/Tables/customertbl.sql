-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2017 at 01:09 AM
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
-- Table structure for table `customertbl`
--

CREATE TABLE `customertbl` (
  `cust_id` int(5) NOT NULL,
  `cust_fname` varchar(20) NOT NULL,
  `cust_lname` varchar(20) NOT NULL,
  `cust_email` varchar(20) NOT NULL,
  `cust_passw` varchar(7) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customertbl`
--

INSERT INTO `customertbl` (`cust_id`, `cust_fname`, `cust_lname`, `cust_email`, `cust_passw`) VALUES
(1, 'Kate', 'Austin', 'kaustin@lost.com', 'a123456'),
(2, 'Jack', 'Shepherd', 'jshepherd@lost.com', 'jwed312'),
(3, 'Saheed', 'Sahid', 'sas@lost.com', 's222222'),
(4, 'asdad', 'Sahid', 's@d.com', 's23123e'),
(5, 's', 'Sahid', 's@s.com', 's2222ee'),
(6, 'James', 'Bond', 'jb@bond.com', 'g123456'),
(7, 'James', 'Bond', 'jb@bond.com', 'j123456'),
(8, 'Mick', 'Smith', 'msmith@fake.com', 's12345a'),
(9, 'Simon', 'Templar', 'saint@tv.com', 'saint12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customertbl`
--
ALTER TABLE `customertbl`
  ADD PRIMARY KEY (`cust_id`),
  ADD UNIQUE KEY `cust_id_UNIQUE` (`cust_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customertbl`
--
ALTER TABLE `customertbl`
  MODIFY `cust_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
