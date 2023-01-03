-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2023 at 08:09 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart_stock`
--

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `setting_value` varchar(255) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `description`, `setting_value`, `created`, `modified`) VALUES
(1, 'MultiStockTransactionLimit', 'This setting is used to set the max transaction limit per day. Default is 0, which means transaction for only one stock(any one) per day is allowed. For allowing more than one transaction of different stock on the same day set the value to 1. ', '1', '2022-12-31 17:41:40', '2022-12-31 17:41:40');

-- --------------------------------------------------------

--
-- Table structure for table `stock_details`
--

CREATE TABLE `stock_details` (
  `id` int(11) NOT NULL,
  `name` varchar(11) NOT NULL,
  `price` varchar(11) NOT NULL,
  `stock_date` date NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_details`
--

INSERT INTO `stock_details` (`id`, `name`, `price`, `stock_date`, `is_active`, `created`, `modified`) VALUES
(169, 'ACER', '71', '2023-01-01', 0, '2023-01-03 06:57:15', '2023-01-03 06:57:15'),
(170, 'BOSCH', '101', '2023-01-01', 0, '2023-01-03 06:57:15', '2023-01-03 06:57:15'),
(171, 'COCACOLA', '21', '2023-01-01', 0, '2023-01-03 06:57:15', '2023-01-03 06:57:15'),
(172, 'DELL', '61', '2023-01-01', 0, '2023-01-03 06:57:15', '2023-01-03 06:57:15'),
(173, 'HONDA', '81', '2023-01-01', 0, '2023-01-03 06:57:15', '2023-01-03 06:57:15'),
(174, 'HP', '51', '2023-01-01', 0, '2023-01-03 06:57:15', '2023-01-03 06:57:15'),
(175, 'PARLE', '31', '2023-01-01', 0, '2023-01-03 06:57:15', '2023-01-03 06:57:15'),
(176, 'PEPSI', '11', '2023-01-01', 0, '2023-01-03 06:57:15', '2023-01-03 06:57:15'),
(177, 'SIEMENS', '41', '2023-01-01', 0, '2023-01-03 06:57:15', '2023-01-03 06:57:15'),
(178, 'YAMAHA', '91', '2023-01-01', 0, '2023-01-03 06:57:16', '2023-01-03 06:57:16'),
(179, 'ACER', '72', '2023-01-02', 0, '2023-01-03 06:59:54', '2023-01-03 06:59:54'),
(180, 'BOSCH', '102', '2023-01-02', 0, '2023-01-03 06:59:54', '2023-01-03 06:59:54'),
(181, 'COCACOLA', '22', '2023-01-02', 0, '2023-01-03 06:59:54', '2023-01-03 06:59:54'),
(182, 'DELL', '62', '2023-01-02', 0, '2023-01-03 06:59:54', '2023-01-03 06:59:54'),
(183, 'HONDA', '82', '2023-01-02', 0, '2023-01-03 06:59:54', '2023-01-03 06:59:54'),
(184, 'HP', '52', '2023-01-02', 0, '2023-01-03 06:59:55', '2023-01-03 06:59:55'),
(185, 'PARLE', '32', '2023-01-02', 0, '2023-01-03 06:59:55', '2023-01-03 06:59:55'),
(186, 'PEPSI', '12', '2023-01-02', 0, '2023-01-03 06:59:55', '2023-01-03 06:59:55'),
(187, 'SIEMENS', '42', '2023-01-02', 0, '2023-01-03 06:59:55', '2023-01-03 06:59:55'),
(188, 'YAMAHA', '92', '2023-01-02', 0, '2023-01-03 06:59:55', '2023-01-03 06:59:55'),
(189, 'ACER', '75', '2023-01-03', 0, '2023-01-03 07:03:20', '2023-01-03 07:03:20'),
(190, 'BOSCH', '105', '2023-01-03', 0, '2023-01-03 07:03:20', '2023-01-03 07:03:20'),
(191, 'COCACOLA', '25', '2023-01-03', 0, '2023-01-03 07:03:20', '2023-01-03 07:03:20'),
(192, 'DELL', '65', '2023-01-03', 0, '2023-01-03 07:03:20', '2023-01-03 07:03:20'),
(193, 'HONDA', '85', '2023-01-03', 0, '2023-01-03 07:03:20', '2023-01-03 07:03:20'),
(194, 'HP', '55', '2023-01-03', 0, '2023-01-03 07:03:20', '2023-01-03 07:03:20'),
(195, 'PARLE', '35', '2023-01-03', 0, '2023-01-03 07:03:20', '2023-01-03 07:03:20'),
(196, 'PEPSI', '15', '2023-01-03', 0, '2023-01-03 07:03:20', '2023-01-03 07:03:20'),
(197, 'SIEMENS', '45', '2023-01-03', 0, '2023-01-03 07:03:20', '2023-01-03 07:03:20'),
(198, 'YAMAHA', '95', '2023-01-03', 0, '2023-01-03 07:03:20', '2023-01-03 07:03:20'),
(199, 'ACER', '73', '2023-01-04', 1, '2023-01-03 07:08:28', '2023-01-03 07:08:28'),
(200, 'BOSCH', '103', '2023-01-04', 1, '2023-01-03 07:08:29', '2023-01-03 07:08:29'),
(201, 'COCACOLA', '23', '2023-01-04', 1, '2023-01-03 07:08:29', '2023-01-03 07:08:29'),
(202, 'DELL', '63', '2023-01-04', 1, '2023-01-03 07:08:29', '2023-01-03 07:08:29'),
(203, 'HONDA', '83', '2023-01-04', 1, '2023-01-03 07:08:29', '2023-01-03 07:08:29'),
(204, 'HP', '53', '2023-01-04', 1, '2023-01-03 07:08:29', '2023-01-03 07:08:29'),
(205, 'PARLE', '33', '2023-01-04', 1, '2023-01-03 07:08:29', '2023-01-03 07:08:29'),
(206, 'PEPSI', '13', '2023-01-04', 1, '2023-01-03 07:08:29', '2023-01-03 07:08:29'),
(207, 'SIEMENS', '43', '2023-01-04', 1, '2023-01-03 07:08:29', '2023-01-03 07:08:29'),
(208, 'YAMAHA', '93', '2023-01-04', 1, '2023-01-03 07:08:29', '2023-01-03 07:08:29');

-- --------------------------------------------------------

--
-- Table structure for table `stock_transactions`
--

CREATE TABLE `stock_transactions` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `bought_price` varchar(20) NOT NULL,
  `sold_price` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `remaining_quantity` int(11) NOT NULL,
  `bought_id` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_transactions`
--

INSERT INTO `stock_transactions` (`id`, `type`, `name`, `bought_price`, `sold_price`, `quantity`, `remaining_quantity`, `bought_id`, `transaction_date`, `created`, `modified`) VALUES
(38, 'Bought', 'ACER', '71', '', 1, 1, 0, '2023-01-01', '2023-01-03 12:27:34', '2023-01-03 12:27:34'),
(39, 'Bought', 'BOSCH', '101', '', 1, 0, 0, '2023-01-01', '2023-01-03 12:27:38', '2023-01-03 12:27:38'),
(40, 'Bought', 'COCACOLA', '21', '', 1, 0, 0, '2023-01-01', '2023-01-03 12:27:40', '2023-01-03 12:27:40'),
(41, 'Bought', 'DELL', '61', '', 1, 1, 0, '2023-01-01', '2023-01-03 12:27:43', '2023-01-03 12:27:43'),
(42, 'Bought', 'PEPSI', '11', '', 1, 0, 0, '2023-01-01', '2023-01-03 12:27:50', '2023-01-03 12:27:50'),
(43, 'Bought', 'YAMAHA', '91', '', 1, 0, 0, '2023-01-01', '2023-01-03 12:28:11', '2023-01-03 12:28:11'),
(44, 'Sold', 'YAMAHA', '91', '92', 1, 0, 43, '2023-01-02', '2023-01-03 12:30:10', '2023-01-03 12:30:10'),
(45, 'Sold', 'COCACOLA', '21', '22', 1, 0, 40, '2023-01-02', '2023-01-03 12:30:14', '2023-01-03 12:30:14'),
(46, 'Sold', 'BOSCH', '101', '102', 1, 0, 39, '2023-01-02', '2023-01-03 12:30:18', '2023-01-03 12:30:18'),
(47, 'Bought', 'ACER', '72', '', 1, 1, 0, '2023-01-02', '2023-01-03 12:30:54', '2023-01-03 12:30:54'),
(48, 'Bought', 'DELL', '62', '', 4, 2, 0, '2023-01-02', '2023-01-03 12:31:43', '2023-01-03 12:31:43'),
(49, 'Bought', 'PARLE', '32', '', 1, 0, 0, '2023-01-02', '2023-01-03 12:31:46', '2023-01-03 12:31:46'),
(50, 'Bought', 'SIEMENS', '42', '', 5, 1, 0, '2023-01-02', '2023-01-03 12:31:50', '2023-01-03 12:31:50'),
(51, 'Sold', 'SIEMENS', '42', '45', 4, 0, 50, '2023-01-03', '2023-01-03 12:33:32', '2023-01-03 12:33:32'),
(52, 'Sold', 'DELL', '62', '65', 2, 0, 48, '2023-01-03', '2023-01-03 12:33:36', '2023-01-03 12:33:36'),
(53, 'Sold', 'PEPSI', '11', '15', 1, 0, 42, '2023-01-03', '2023-01-03 12:33:40', '2023-01-03 12:33:40'),
(54, 'Sold', 'PARLE', '32', '35', 1, 0, 49, '2023-01-03', '2023-01-03 12:33:44', '2023-01-03 12:33:44'),
(55, 'Bought', 'ACER', '75', '', 4, 4, 0, '2023-01-03', '2023-01-03 12:33:49', '2023-01-03 12:33:49'),
(56, 'Bought', 'BOSCH', '105', '', 2, 2, 0, '2023-01-03', '2023-01-03 12:33:52', '2023-01-03 12:33:52'),
(57, 'Bought', 'COCACOLA', '25', '', 10, 10, 0, '2023-01-03', '2023-01-03 12:33:55', '2023-01-03 12:33:55'),
(58, 'Bought', 'HONDA', '85', '', 12, 12, 0, '2023-01-03', '2023-01-03 12:34:05', '2023-01-03 12:34:05'),
(59, 'Bought', 'YAMAHA', '95', '', 12, 12, 0, '2023-01-03', '2023-01-03 12:34:08', '2023-01-03 12:34:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_details`
--
ALTER TABLE `stock_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_transactions`
--
ALTER TABLE `stock_transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock_details`
--
ALTER TABLE `stock_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `stock_transactions`
--
ALTER TABLE `stock_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
