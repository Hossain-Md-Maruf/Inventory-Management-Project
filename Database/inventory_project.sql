-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2021 at 01:55 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `bought` int(11) NOT NULL DEFAULT 0,
  `sold` int(11) NOT NULL DEFAULT 0,
  `price` int(11) NOT NULL,
  `image` varchar(300) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `bought`, `sold`, `price`, `image`, `created_at`, `updated_at`) VALUES
(15, 'chair', 200, 0, 0, 'Uploads/chair.jpg', '2021-08-15 02:42:56', '2021-08-15 02:42:56'),
(16, 'Table', 150, 0, 0, 'Uploads/table.jpg', '2021-08-15 02:43:55', '2021-08-15 02:43:55'),
(17, 'Sofa', 100, 0, 0, 'Uploads/sofa.jpg', '2021-08-15 02:44:20', '2021-08-15 02:44:20');

-- --------------------------------------------------------

--
-- Table structure for table `shooppinginfo`
--

CREATE TABLE `shooppinginfo` (
  `userID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shooppinginfo`
--

INSERT INTO `shooppinginfo` (`userID`, `productID`, `productName`, `quantity`, `price`, `status`) VALUES
(3, 9, 'chair', 3, 300, 'Purchased'),
(3, 11, 'sofa', 5, 2500, 'Purchased'),
(3, 12, 'chair', 4, 400, 'Purchased'),
(3, 13, 'table', 4, 800, 'Purchased'),
(3, 11, 'sofa', 0, 0, 'Purchased'),
(3, 12, 'chair', 2, 200, 'Purchased'),
(3, 12, 'chair', 2, 200, 'Purchased'),
(3, 12, 'chair', 2, 200, 'Purchased'),
(3, 13, 'table', 2, 400, 'Purchased'),
(3, 11, 'sofa', 2, 1000, 'Purchased'),
(3, 13, 'table', 2, 400, 'Purchased'),
(3, 11, 'sofa', 1, 500, 'Purchased'),
(3, 12, 'chair', 1, 100, 'Purchased'),
(3, 13, 'table', 1, 200, 'Purchased'),
(3, 11, 'sofa', 1, 500, 'Purchased'),
(3, 12, 'chair', 1, 100, 'Purchased'),
(3, 13, 'table', 1, 200, 'Purchased');

-- --------------------------------------------------------

--
-- Table structure for table `users_info`
--

CREATE TABLE `users_info` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `u_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `avatar` varchar(100) NOT NULL,
  `last_login_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `gender` varchar(50) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_info`
--

INSERT INTO `users_info` (`id`, `name`, `u_name`, `email`, `password`, `is_active`, `is_admin`, `avatar`, `last_login_time`, `gender`, `dob`, `created_at`) VALUES
(8, 'maruf', 'maruf1221', 'maruf@gmail.com', '$2y$10$ROoIe8sCRGsDuH5O6vWzzu/GSx7JxZRfaF6MZd2LxHB0kN6rdqblu', 1, 0, '', '2021-08-15 06:16:24', 'male', '1998-07-15', '2021-08-15 11:19:30'),
(10, 'Maruf Hossain', 'maruf121', 'marufhossain220195@gmail.com', '#1234567', 1, 1, 'Users/maruf_profile.jpg', '2021-08-15 06:18:27', 'male', '1995-01-22', '2021-08-15 12:17:35'),
(11, 'Amit Mitra', 'amit121', 'amit@gmail.com', '#1234567', 1, 2, 'Users/amit_profile_pic.jpg', '2021-08-15 06:20:17', 'male', '1996-11-26', '2021-08-15 12:19:31'),
(12, 'Tofael Ahmed', 'tofael121', 'tofael@gmail.com', '#1234567', 1, 0, 'Users/tofael_profile_pic.jpg', '2021-08-15 06:22:14', 'male', '1996-11-18', '2021-08-15 12:21:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_info`
--
ALTER TABLE `users_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_name` (`u_name`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users_info`
--
ALTER TABLE `users_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
