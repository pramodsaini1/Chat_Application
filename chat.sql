-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2024 at 04:40 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `sn` int(11) NOT NULL,
  `userId` varchar(255) NOT NULL,
  `sender_email` varchar(255) NOT NULL,
  `sender_userid` varchar(255) NOT NULL,
  `receiver_email` varchar(255) NOT NULL,
  `receiver_userid` varchar(255) NOT NULL,
  `message` blob NOT NULL,
  `chat_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`sn`, `userId`, `sender_email`, `sender_userid`, `receiver_email`, `receiver_userid`, `message`, `chat_time`) VALUES
(1, 'BEJerv_1', 'pooja@gmail.com', 'AHKy89_2', 'divya@gmail.com', 'Jfjlp8_1', 0x48656c6c6f206469767961, 'Wednesday 21st of February 2024 11:17:48 AM');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `sn` int(11) NOT NULL,
  `userId` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `login_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`sn`, `userId`, `first_name`, `last_name`, `email`, `password`, `status`, `login_time`) VALUES
(1, 'Jfjlp8_1', 'divya', 'sharma', 'divya@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, '19 Feb,2024'),
(2, 'AHKy89_2', 'pooja', 'saini', 'pooja@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, '19 Feb,2024'),
(3, 'ghj127_3', 'suman', 'kumari', 'suman@gmail.com', '202cb962ac59075b964b07152d234b70', 1, '20 Feb,2024');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
