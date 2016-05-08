-- phpMyAdmin SQL Dump
-- version 4.6.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 08, 2016 at 04:40 AM
-- Server version: 10.0.23-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `dbcodeigniter`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_fullname` varchar(100) NOT NULL,
  `user_email` varchar(40) NOT NULL,
  `user_password` varchar(45) NOT NULL,
  `user_dni` varchar(10) NOT NULL,
  `user_phone` varchar(10) NOT NULL,
  `user_registered` datetime NOT NULL,
  `user_updated` datetime DEFAULT NULL,
  `user_state` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_fullname`, `user_email`, `user_password`, `user_dni`, `user_phone`, `user_registered`, `user_updated`, `user_state`) VALUES
(1, 'Captain Anonymous', 'anonymous@enterprise.com', '202cb962ac59075b964b07152d234b70', '45450378', '45321120', '2016-03-18 21:07:08', NULL, 1),
(2, 'John Doe', 'jonh.doe@enterprise.com', '202cb962ac59075b964b07152d234b70', '45210378', '45321120', '2016-03-18 21:07:08', NULL, 1),
(3, 'Albert Einstein', 'albert.einstein@enterprise.com', '827ccb0eea8a706c4c34a16891f84e7b', '45210340', '45535202', '2016-03-18 16:11:56', NULL, 1),
(4, 'Nikola Tesla', 'tesla@enterprise.com', 'eb62f6b9306db575c2d596b1279627a4', '47210041', '41135211', '2016-03-18 16:14:45', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD UNIQUE KEY `user_dni` (`user_dni`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;