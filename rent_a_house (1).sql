-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2017 at 02:03 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rent_a_house`
--

-- --------------------------------------------------------

--
-- Table structure for table `ad_comment`
--

CREATE TABLE `ad_comment` (
  `com_id` int(8) NOT NULL,
  `post_id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `comment` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ad_comment`
--

INSERT INTO `ad_comment` (`com_id`, `post_id`, `user_id`, `comment`) VALUES
(1, 38, 5, 'dfsadfasdf'),
(2, 38, 5, 'wfasdff'),
(3, 38, 5, 'wfasdff'),
(4, 38, 2, 'scsafasdfads'),
(5, 36, 5, 'dsfasf');

-- --------------------------------------------------------

--
-- Table structure for table `post_ad`
--

CREATE TABLE `post_ad` (
  `post_id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `title` varchar(100) NOT NULL,
  `district` varchar(20) NOT NULL,
  `area` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `rent_type` varchar(20) NOT NULL,
  `no_of_room` int(8) NOT NULL,
  `flat_type` varchar(20) NOT NULL,
  `no_of_wash` int(8) NOT NULL,
  `belcony` int(8) NOT NULL,
  `vac_mon` varchar(20) NOT NULL,
  `rent` int(8) NOT NULL,
  `lat` double NOT NULL,
  `lag` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_ad`
--

INSERT INTO `post_ad` (`post_id`, `user_id`, `title`, `district`, `area`, `address`, `rent_type`, `no_of_room`, `flat_type`, `no_of_wash`, `belcony`, `vac_mon`, `rent`, `lat`, `lag`) VALUES
(28, 2, '3 bed', 'Dhaka', 'Dhanmondi', 'house-10,road,15', 'Appartment', 3, 'Family', 2, 2, '', 20000, 2.021231, 3.0122312),
(36, 5, 'roommate wanted', 'Dhaka', 'Dhanmondi', 'house-32', 'Room', 1, 'Bechalor', 1, 1, 'January', 8000, 2.021231, 3.0122312);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(8) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`) VALUES
(1, 'maruf ahamed', 'm@gmial.com', 'sayon1234'),
(2, 'piash', 'pi@mail.com', '25f9e794323b453885f5181f1b624d0b'),
(3, 'maruf', 'maruf@gmail.com', 'bb4cc3648046f8ac81ec907ce8fed291'),
(4, 'maruf aham', 'mar@gmail.com', '25f9e794323b453885f5181f1b624d0b'),
(5, 'sayon', 'sayon@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(8) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `phone` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `gender`, `date_of_birth`, `phone`) VALUES
(2, 'Male', '0000-00-00', 1234567891),
(4, 'Male', '0000-00-00', 1749454911),
(5, 'Male', '0000-00-00', 1749454911);

-- --------------------------------------------------------

--
-- Table structure for table `user_message`
--

CREATE TABLE `user_message` (
  `text_id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `from_user_id` int(8) NOT NULL,
  `message` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_message`
--

INSERT INTO `user_message` (`text_id`, `user_id`, `from_user_id`, `message`) VALUES
(1, 5, 2, 'cczcxc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ad_comment`
--
ALTER TABLE `ad_comment`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `post_ad`
--
ALTER TABLE `post_ad`
  ADD PRIMARY KEY (`user_id`,`post_id`),
  ADD UNIQUE KEY `post_id` (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_message`
--
ALTER TABLE `user_message`
  ADD PRIMARY KEY (`text_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ad_comment`
--
ALTER TABLE `ad_comment`
  MODIFY `com_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `post_ad`
--
ALTER TABLE `post_ad`
  MODIFY `post_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_message`
--
ALTER TABLE `user_message`
  MODIFY `text_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
