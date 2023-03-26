-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 26, 2023 at 11:44 PM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payment`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `payment_id` int(11) NOT NULL,
  `paper_id` varchar(25) NOT NULL,
  `paper_title` text NOT NULL,
  `paper_authors` text NOT NULL,
  `paper_firstname` varchar(500) NOT NULL,
  `paper_lastname` varchar(500) NOT NULL,
  `payment_email` varchar(500) NOT NULL,
  `payment_phone` varchar(25) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`payment_id`, `paper_id`, `paper_title`, `paper_authors`, `paper_firstname`, `paper_lastname`, `payment_email`, `payment_phone`, `payment_type`, `payment_status`, `date_created`, `date_modified`) VALUES
(1, 'test', 'test', 'test', 'test', 'test', 'test@gmail.com', '02177834328', 'earlyRegIEEE,SocialTour', 'Not Yet Paid', '2023-03-23 19:49:21', '2023-03-23 19:49:21'),
(3, 'test', 'test', 'test', 'test', 'test', 'test@gmail.com', '02177834328', 'earlyRegIEEE,SocialTour', 'Not Yet Paid', '2023-03-23 19:52:01', '2023-03-23 19:52:01'),
(4, 'testt', 'test', 'test', 'test', 'test', 'test@gmail.com', '02177834328', 'earlyRegNonIEEE,SocialTour', 'Not Yet Paid', '2023-03-23 19:59:57', '2023-03-23 19:59:57'),
(5, 'test', 'test', 'test', 'test', 'test', 'test@gmail.com', '02177834328', 'earlyRegNonIEEE,SocialTour', 'Not Yet Paid', '2023-03-23 20:01:23', '2023-03-23 20:01:23'),
(6, 'test', 'test', 'test', 'test', 'test', 'test@gmail.com', '02177834328', 'earlyRegNonIEEE,SocialTour', 'Not Yet Paid', '2023-03-23 20:03:26', '2023-03-23 20:03:26'),
(7, 'test', 'test', 'test', 'test', 'test', 'test@gmail.com', '02177834328', 'earlyRegNonIEEE,SocialTour', 'Success', '2023-03-23 20:04:44', '2023-03-24 09:57:47'),
(8, 'test', 'test', 'test', 'test', 'test', 'test@gmail.com', '02177834328', 'earlyRegIEEE,SocialTour', 'Success', '2023-03-23 20:09:43', '2023-03-24 09:57:47'),
(9, 'test', 'test', 'test', 'test', 'test', 'test@gmail.com', '02177834328', 'earlyRegIEEE,SocialTour', 'Success', '2023-03-23 20:11:27', '2023-03-24 09:57:47'),
(10, 'test', 'test', 'test', 'test', 'test', 'test@gmail.com', '02177834328', 'earlyRegNonIEEE,SocialTour', 'Success', '2023-03-23 20:14:59', '2023-03-24 09:57:47'),
(11, 'test', 'test', 'test', 'test', 'test', 'test@gmail.com', '02177834328', 'earlyRegNonIEEE,SocialTour', 'Success', '2023-03-23 20:25:59', '2023-03-24 09:57:47'),
(12, 'test', 'test', 'test', 'test', 'test', 'test@gmail.com', '02177834328', 'earlyRegIEEE,SocialTour', 'Success', '2023-03-23 21:06:09', '2023-03-24 09:57:47'),
(13, 'test', 'test', 'test', 'test', 'test', 'test@localhost.com', '02177834328', 'earlyStudentIEEE,SocialTour', 'Success', '2023-03-24 10:00:29', '2023-03-24 10:03:16'),
(14, 'coba', 'ajah', 'test', 'test', 'test', 'test@gmail.com', '02177834328', 'earlyStudentIEEE,SocialTour', 'Success', '2023-03-24 10:04:56', '2023-03-24 10:08:58'),
(15, 'test', 'lagi', 'test', 'test', 'test', 'test@gmail.com', '02177834328', 'earlyStudentNonIEEE,NonAuthor', 'Success', '2023-03-24 10:10:27', '2023-03-24 10:11:13'),
(16, 'test', 'test', 'test', 'test', 'test', 'gdebig@gmail.com', '02177834328', 'earlyRegNonIEEE,NonAuthor', 'Success', '2023-03-24 22:27:54', '2023-03-24 22:28:56'),
(17, 'test', 'test', 'test', 'test', 'test', 'gdebig@gmail.com', '02177834328', 'earlyRegNonIEEE,SocialTour', 'Transaction Fail', '2023-03-25 01:16:39', '2023-03-25 01:17:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `username`, `password`, `date_created`, `date_modified`) VALUES
(1, 'admin', '$2y$10$rterbruKvrh8G.Hw/JKHrebaDgB85CWKKTJrhMfIg3adBO/hOcPnC', '2023-03-24 09:46:14', '2023-03-24 09:46:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
