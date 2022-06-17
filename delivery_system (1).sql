-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2019 at 11:29 PM
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
-- Table structure for table `addons`
--

CREATE TABLE `addons` (
  `Addon_ID` int(11) NOT NULL,
  `Addon_name` varchar(30) NOT NULL,
  `Addon_price` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addons`
--

INSERT INTO `addons` (`Addon_ID`, `Addon_name`, `Addon_price`) VALUES
(1, 'None', '0.00'),
(2, 'Extra Shot', '1.50'),
(3, 'Whipped Cream', '1.50');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_locations`
--

CREATE TABLE `delivery_locations` (
  `Location_ID` int(11) NOT NULL,
  `Location_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_locations`
--

INSERT INTO `delivery_locations` (`Location_ID`, `Location_name`) VALUES
(1, 'Alamanda Bus Stop'),
(2, 'Sakura Bus stop'),
(3, 'Dahlia Bus Stop'),
(4, 'Cempaka Bus Stop'),
(5, 'Bunga Raya Bus Stop'),
(6, 'Tun Ahmad Zaidi Adruce Bus Stop'),
(7, 'Kenanga Bus Stop'),
(8, 'Seroja Bus Stop'),
(9, 'Faculty of Resource Sciences & Technology'),
(10, 'Faculty of Engineering '),
(11, 'Faculty of Computer Science & Information Technology'),
(12, 'Faculty of Applied and Creative Art'),
(13, 'Faculty of Language Studies & Communication Studies'),
(14, 'Faculty of Cognitive Sciences & Human Development'),
(15, 'Faculty of Social Sciences '),
(16, 'Faculty of Economics & Business'),
(17, 'Faculty of Medicine & Health Sciences');

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
(1, 'Espresso', 'hot_beverages', '5.00', 'espresso.png', 5000, '2019-11-19 14:25:18'),
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
(43, 'Fresh Lemon Tea', 'ice_blended', '5.50', 'iced-tea-lemon.png', 10000, '2019-11-19 15:05:40'),
(44, 'Spaghetti Bolognese', 'meals', '11.90', 'Spaghetti.png', 5, '2019-12-18 19:06:26'),
(45, 'Spaghetti Carbonara', 'meals', '13.90', 'pasta.png', 5, '2019-12-18 19:09:25'),
(46, 'Chocolate Cake', 'desserts', '11.90', 'cake.png', 0, '2019-12-18 19:10:16'),
(47, 'Cheesecake', 'desserts', '11.90', 'Cheesecake.png', 5, '2019-12-18 19:11:04'),
(48, 'Mushroom Soup', 'meals', '6.50', 'mushroom_soup.png', 0, '2019-12-18 19:11:55'),
(49, 'Red Velvet Cake', 'desserts', '11.90', 'Red Velvet.png', 5, '2019-12-18 19:23:20');

-- --------------------------------------------------------

--
-- Table structure for table `order_info`
--

CREATE TABLE `order_info` (
  `Order_ID` int(11) NOT NULL,
  `Item_quantity_ordered` int(3) NOT NULL,
  `Total` decimal(5,2) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Phone_number` int(10) NOT NULL,
  `email` text NOT NULL,
  `Location_ID` int(11) NOT NULL,
  `Location_comment` mediumtext NOT NULL,
  `Order_status` varchar(20) NOT NULL,
  `Order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_info`
--

INSERT INTO `order_info` (`Order_ID`, `Item_quantity_ordered`, `Total`, `Name`, `Phone_number`, `email`, `Location_ID`, `Location_comment`, `Order_status`, `Order_date`) VALUES
(33, 5, '37.50', '', 0, '', 10, '', '', '2019-12-09 13:30:25'),
(34, 1, '5.00', 'Alice', 123456789, 'aaaaa@yahoo.com', 1, '1aaaaa', 'ready-for-delievry', '2019-12-09 14:56:57'),
(35, 4, '27.00', 'aaaaa', 123456789, 'aaaaa@yahoo.com', 8, 'aaaa', 'to-be-prepared', '2019-12-16 07:11:12'),
(36, 1, '5.00', '', 0, '', 1, '', 'Ongoing', '2019-12-16 09:30:10'),
(37, 0, '0.00', '', 0, '', 1, '', 'Ongoing', '2019-12-16 09:43:49'),
(38, 1, '5.00', '', 0, '', 4, '', 'Ongoing', '2019-12-17 17:43:58'),
(39, 0, '0.00', '', 0, '', 1, '', 'Ongoing', '2019-12-18 00:18:49'),
(40, 1, '5.00', '', 0, '', 1, '', 'Ongoing', '2019-12-18 00:19:54'),
(41, 2, '19.00', '', 0, '', 1, '', 'Ongoing', '2019-12-18 00:21:31'),
(42, 0, '0.00', '', 0, '', 1, '', 'Ongoing', '2019-12-18 01:12:05'),
(43, 0, '0.00', '', 0, '', 7, '', 'Ongoing', '2019-12-18 01:27:38'),
(44, 3, '17.50', 'Asma', 123456789, 'aaaaa@yahoo.com', 1, 'aaaaaa', 'to-be-prepared', '2019-12-18 14:46:09'),
(45, 0, '0.00', '', 0, '', 1, '', 'Ongoing', '2019-12-18 19:12:21'),
(46, 4, '47.60', 'Alice', 1234567890, 'aaaaa@yahoo.com', 1, 'vvvvvvvvvv', 'to-be-prepared', '2019-12-18 19:25:54'),
(47, 0, '0.00', '', 0, '', 1, '', 'Ongoing', '2019-12-18 19:30:05'),
(48, 5, '54.10', 'Customer', 123456789, 'customer@gmail.com', 9, 'Near Block A', 'to-be-prepared', '2019-12-18 20:13:37');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `Order_ID` int(11) NOT NULL,
  `Item_ID` int(11) NOT NULL,
  `Addon_ID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`Order_ID`, `Item_ID`, `Addon_ID`, `Quantity`) VALUES
(33, 8, 2, 2),
(33, 15, 1, 3),
(34, 1, 1, 1),
(35, 2, 2, 3),
(35, 15, 1, 1),
(36, 2, 1, 1),
(37, 2, 2, 2),
(38, 2, 1, 1),
(40, 26, 1, 1),
(41, 28, 2, 2),
(44, 2, 1, 1),
(44, 3, 1, 1),
(44, 14, 1, 1),
(46, 49, 1, 4),
(48, 2, 2, 1),
(48, 44, 1, 3),
(48, 47, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `User_ID` int(11) NOT NULL,
  `Username` tinytext NOT NULL,
  `User_email` tinytext NOT NULL,
  `User_password` longtext NOT NULL,
  `User_phone_num` tinytext NOT NULL,
  `Admin_status` tinyint(1) NOT NULL,
  `Barista_status` tinyint(1) NOT NULL,
  `Date_joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`User_ID`, `Username`, `User_email`, `User_password`, `User_phone_num`, `Admin_status`, `Barista_status`, `Date_joined`) VALUES
(1, 'atlno1fan', 'aaaaa@yahoo.com', '$2y$10$WrIP0oz5B7OeUF84DT8Zj.FzAMYoqhz56z0B08ulJTvX4QWO5ui8O', '1234567890', 0, 0, '2019-11-19 19:33:25'),
(2, 'aaaa', 'asdasd@yahoo.com', '$2y$10$L23lgtvhIPpUyHbfw7T7veAtvYcfmqhnIialWnAyujAPOSQJLDR7G', '0000000000', 0, 0, '2019-11-20 13:50:56'),
(3, 'Admin', 'Admin@gmail.com', '$2y$10$2D9ohI.hwPVuSiqDyXH/I.tqxzeT4hWasQNmO/4xaco60zfpllS9O', '0123456789', 1, 0, '2019-12-17 17:25:37'),
(4, 'Barista', 'Barista@gmail.com', '$2y$10$W8x37tMIipsgJO/6zr/hyOqeAFg60tj2PW9zRauMTzCxVQybTYPW.', '1234567890', 0, 1, '2019-12-18 14:45:18'),
(5, 'customer', 'customer@gmail.com', '$2y$10$VHBolZCbpwVEvpUXz6t2NObUq/DPTFKSju2yOrJiB3XN3lZnRyZ8.', '0123456789', 0, 0, '2019-12-18 20:10:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addons`
--
ALTER TABLE `addons`
  ADD PRIMARY KEY (`Addon_ID`);

--
-- Indexes for table `delivery_locations`
--
ALTER TABLE `delivery_locations`
  ADD PRIMARY KEY (`Location_ID`);

--
-- Indexes for table `item_info`
--
ALTER TABLE `item_info`
  ADD PRIMARY KEY (`Item_ID`);

--
-- Indexes for table `order_info`
--
ALTER TABLE `order_info`
  ADD PRIMARY KEY (`Order_ID`),
  ADD KEY `Location_ID` (`Location_ID`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`Order_ID`,`Item_ID`,`Addon_ID`),
  ADD KEY `Order_ID` (`Order_ID`,`Item_ID`),
  ADD KEY `Item_ID` (`Item_ID`),
  ADD KEY `Addon_ID` (`Addon_ID`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addons`
--
ALTER TABLE `addons`
  MODIFY `Addon_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `delivery_locations`
--
ALTER TABLE `delivery_locations`
  MODIFY `Location_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `item_info`
--
ALTER TABLE `item_info`
  MODIFY `Item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `order_info`
--
ALTER TABLE `order_info`
  MODIFY `Order_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
