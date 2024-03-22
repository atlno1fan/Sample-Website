-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2019 at 06:23 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `delivery_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `item_info`
--

CREATE TABLE `item_info` (
  `Item_ID` int(11) NOT NULL,
  `Item_name` varchar(40) NOT NULL,
  `Category` varchar(40) NOT NULL,
  `Item_price` decimal(5,2) NOT NULL,
  `Item_pic_dir` varchar(100) NOT NULL,
  `Item_quantity` int(5) NOT NULL,
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_info`
--

INSERT INTO `item_info` (`Item_ID`, `Item_name`, `Category`, `Item_price`, `Item_pic_dir`, `Item_quantity`, `last_modified`) VALUES
(1, 'Espresso', 'hot_beverages', '5.00', 'espresso.png', 10000, '2019-11-19 14:25:18'),
(2, 'Americano', 'hot_beverages', '5.00', 'americano.png', 10000, '2019-11-19 14:26:52'),
(3, 'Cappuccino', 'hot_beverages', '6.00', 'cappuccino.png', 10000, '2019-11-19 14:27:46'),
(4, 'Caffe Latte', 'hot_beverages', '6.00', 'milk coffee.png', 10000, '2019-11-19 14:28:45'),
(5, 'Caramello Latte', 'hot_beverages', '7.00', 'milk coffee.png', 10000, '2019-11-19 14:29:37'),
(6, 'Caffe Mochaccino', 'hot_beverages', '7.00', 'milk coffee.png', 10000, '2019-11-19 14:30:33'),
(7, 'Chocolate', 'hot_beverages', '6.00', 'hot-coco.png', 10000, '2019-11-19 14:31:16'),
(8, 'Hazelnut Chocolate', 'hot_beverages', '6.00', 'hot-coco.png', 10000, '2019-11-19 14:31:55'),
(9, 'Caffe Vanilla ', 'hot_beverages', '6.00', 'milk coffee.png', 10000, '2019-11-19 14:33:07'),
(10, 'Matcha (Green Tea)', 'hot_beverages', '5.00', 'matcha-hot.png', 10000, '2019-11-19 14:33:54'),
(11, 'English Breakfast Tea', 'hot_beverages', '3.00', 'earl grey.png', 10000, '2019-11-19 14:34:47'),
(12, 'Earl Grey', 'hot_beverages', '3.00', 'earl grey.png', 10000, '2019-11-19 14:35:17'),
(13, 'Cardamon Tea', 'hot_beverages', '3.00', 'earl grey.png', 10000, '2019-11-19 14:35:59'),
(14, 'Cappuccino', 'cold_beverages', '6.50', 'iced-coffee-png-12.png', 10000, '2019-11-19 14:36:44'),
(15, 'Hazelnut Cappuccino', 'cold_beverages', '7.50', 'iced-coffee-png-12.png', 10000, '2019-11-19 14:44:56'),
(16, 'Caramello Cappuccino', 'cold_beverages', '7.50', 'iced-coffee-png-12.png', 10000, '2019-11-19 14:45:52'),
(17, 'Caramello Latte', 'cold_beverages', '7.50', 'iced-coffee-png-12.png', 10000, '2019-11-19 14:46:23'),
(18, 'Mochaccino', 'cold_beverages', '7.50', 'iced-coffee-png-12.png', 10000, '2019-11-19 14:47:01'),
(19, 'Chocolate', 'cold_beverages', '7.50', 'hot-chocolate-cold.png', 10000, '2019-11-19 14:47:58'),
(20, 'Classy Dark Chocolate', 'cold_beverages', '7.50', 'hot-chocolate-cold.png', 10000, '2019-11-19 14:48:44'),
(21, 'Hazelnut Chocolate', 'cold_beverages', '7.50', 'hot-chocolate-cold.png', 10000, '2019-11-19 14:49:17'),
(22, 'Caramello Chocolate', 'cold_beverages', '7.50', 'hot-chocolate-cold.png', 10000, '2019-11-19 14:49:54'),
(23, 'Vanilla', 'cold_beverages', '7.50', 'hot-chocolate-cold.png', 10000, '2019-11-19 14:50:55'),
(24, 'Matcha (Green Tea)', 'cold_beverages', '6.00', 'matcha-cold.png', 10000, '2019-11-19 14:51:59'),
(25, 'Fresh Apple Tea', 'cold_beverages', '5.00', 'iced-tea-apple.png', 10000, '2019-11-19 14:52:53'),
(26, 'Fresh Lemon Tea', 'cold_beverages', '5.00', 'iced-tea-lemon.png', 10000, '2019-11-19 14:53:38'),
(27, 'Cappuccino', 'ice_blended', '7.00', 'iced-coffee-png-12.png', 10000, '2019-11-19 14:55:53'),
(28, 'Hazelnut Cappuccino', 'ice_blended', '8.00', 'iced-coffee-png-12.png', 10000, '2019-11-19 14:56:22'),
(29, 'Caramello Cappuccino', 'ice_blended', '8.00', 'iced-coffee-png-12.png', 10000, '2019-11-19 14:57:07'),
(30, 'Biscotti Cappuccino', 'ice_blended', '8.00', 'iced-coffee-png-12.png', 10000, '2019-11-19 14:57:57'),
(31, 'Mochaccino', 'ice_blended', '8.00', 'iced-coffee-png-12.png', 10000, '2019-11-19 14:58:31'),
(32, 'Chocolate', 'ice_blended', '8.00', 'hot-chocolate-cold.png', 10000, '2019-11-19 14:59:13'),
(33, 'Classy Dark Chocolate', 'ice_blended', '8.00', 'hot-chocolate-cold.png', 10000, '2019-11-19 14:59:44'),
(34, 'Double Choco Chip', 'ice_blended', '8.00', 'hot-chocolate-cold.png', 10000, '2019-11-19 15:00:16'),
(35, 'Hazelnut Chocolate', 'ice_blended', '8.00', 'hot-chocolate-cold.png', 10000, '2019-11-19 15:00:42'),
(36, 'Caramello Chocolate', 'ice_blended', '8.00', 'hot-chocolate-cold.png', 10000, '2019-11-19 15:01:22'),
(37, 'Biscotti Chocolate', 'ice_blended', '8.00', 'hot-chocolate-cold.png', 10000, '2019-11-19 15:01:55'),
(38, 'Vanilla', 'ice_blended', '8.00', 'hot-chocolate-cold.png', 10000, '2019-11-19 15:02:21'),
(39, 'Biscotti Vanilla', 'ice_blended', '8.00', 'hot-chocolate-cold.png', 10000, '2019-11-19 15:02:51'),
(40, 'Matcha (Green Tea)', 'ice_blended', '6.50', 'matcha-cold.png', 10000, '2019-11-19 15:03:29'),
(41, 'Matcha Choco Chip', 'ice_blended', '7.50', 'matcha-cold.png', 10000, '2019-11-19 15:04:13'),
(42, 'Fresh Apple Tea', 'ice_blended', '5.50', 'iced-tea-apple.png', 10000, '2019-11-19 15:05:12'),
(43, 'Fresh Lemon Tea', 'ice_blended', '5.50', 'iced-tea-lemon.png', 10000, '2019-11-19 15:05:40');

-- --------------------------------------------------------

--
-- Table structure for table `order_info`
--

CREATE TABLE `order_info` (
  `Order_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Item_ID` int(11) NOT NULL,
  `Category` varchar(20) NOT NULL,
  `Item_quantity_ordered` int(3) NOT NULL,
  `Total` decimal(5,0) NOT NULL,
  `Delivery_location` text NOT NULL,
  `Order_status` varchar(20) NOT NULL,
  `Order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `User_ID` int(11) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `User_email` varchar(50) NOT NULL,
  `User_password` varchar(20) NOT NULL,
  `User_phone_num` varchar(12) NOT NULL,
  `Admin_status` tinyint(1) NOT NULL,
  `Barista_status` tinyint(1) NOT NULL,
  `Date_joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item_info`
--
ALTER TABLE `item_info`
  ADD PRIMARY KEY (`Item_ID`);

--
-- Indexes for table `order_info`
--
ALTER TABLE `order_info`
  ADD PRIMARY KEY (`Order_ID`,`User_ID`,`Item_ID`),
  ADD KEY `Item_ID` (`Item_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item_info`
--
ALTER TABLE `item_info`
  MODIFY `Item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `order_info`
--
ALTER TABLE `order_info`
  MODIFY `Order_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_info`
--
ALTER TABLE `order_info`
  ADD CONSTRAINT `order_info_ibfk_1` FOREIGN KEY (`Item_ID`) REFERENCES `item_info` (`Item_ID`),
  ADD CONSTRAINT `order_info_ibfk_2` FOREIGN KEY (`User_ID`) REFERENCES `user_info` (`User_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
