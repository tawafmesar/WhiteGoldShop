-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2024 at 03:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `cart_usersid` int(11) NOT NULL,
  `cart_itemsid` int(11) NOT NULL,
  `cart_status` int(11) NOT NULL DEFAULT 1,
  `cart_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `cart_usersid`, `cart_itemsid`, `cart_status`, `cart_date`) VALUES
(17, 26, 17, 2, '2024-02-23 01:11:00'),
(18, 26, 17, 2, '2024-02-23 01:12:04'),
(19, 26, 18, 2, '2024-02-23 01:12:09'),
(21, 26, 16, 2, '2024-02-23 19:07:13'),
(22, 26, 12, 2, '2024-02-23 19:07:18'),
(23, 26, 5, 2, '2024-02-23 19:07:23'),
(24, 26, 17, 2, '2024-02-23 20:28:49'),
(25, 26, 10, 2, '2024-02-27 23:40:53'),
(26, 26, 21, 2, '2024-02-27 23:41:01'),
(27, 26, 20, 2, '2024-02-28 00:03:11'),
(28, 26, 12, 2, '2024-02-28 00:08:42'),
(29, 26, 20, 2, '2024-02-28 00:08:45'),
(30, 26, 20, 2, '2024-02-28 01:32:08'),
(31, 26, 7, 2, '2024-02-28 01:32:12'),
(32, 26, 9, 2, '2024-02-28 01:36:14'),
(33, 26, 20, 2, '2024-02-28 01:36:20'),
(34, 26, 15, 2, '2024-02-28 01:37:35'),
(35, 26, 21, 1, '2024-02-28 01:37:50');

-- --------------------------------------------------------

--
-- Table structure for table `confirmorder`
--

CREATE TABLE `confirmorder` (
  `order_id` int(11) NOT NULL,
  `order_userid` int(11) NOT NULL,
  `order_total` float NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT 1,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `confirmorder`
--

INSERT INTO `confirmorder` (`order_id`, `order_userid`, `order_total`, `order_status`, `order_date`) VALUES
(1, 26, 200, 1, '2024-02-23 00:58:06'),
(2, 26, 200, 1, '2024-02-23 01:06:12'),
(3, 26, 200, 1, '2024-02-23 01:07:31'),
(4, 26, 200, 1, '2024-02-23 01:07:58'),
(5, 26, 200, 1, '2024-02-23 01:08:18'),
(6, 26, 200, 1, '2024-02-23 01:08:58'),
(7, 26, 200, 1, '2024-02-23 01:10:15'),
(8, 26, 200, 1, '2024-02-23 01:11:11'),
(9, 26, 410, 1, '2024-02-23 01:12:18'),
(10, 26, 560, 1, '2024-02-23 19:07:46'),
(11, 26, 1763, 1, '2024-02-28 00:03:25'),
(13, 26, 1763, 1, '2024-02-28 00:05:23'),
(14, 26, 1763, 2, '2024-02-28 00:06:14'),
(17, 26, 1521, 1, '2024-02-28 01:32:21'),
(18, 26, 1541, 1, '2024-02-28 01:36:26'),
(19, 26, 230, 1, '2024-02-28 01:37:41');

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `favorite_id` int(11) NOT NULL,
  `favorite_usersid` int(11) NOT NULL,
  `favorite_itemsid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `favorite`
--

INSERT INTO `favorite` (`favorite_id`, `favorite_usersid`, `favorite_itemsid`) VALUES
(66, 26, 17);

-- --------------------------------------------------------

--
-- Table structure for table `homepage`
--

CREATE TABLE `homepage` (
  `homepage_id` int(11) NOT NULL,
  `homepage_title` varchar(255) NOT NULL,
  `homepage_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `homepage`
--

INSERT INTO `homepage` (`homepage_id`, `homepage_title`, `homepage_text`) VALUES
(1, 'وايت جولد.\r\n', 'متجر وايت جولد لأجمل الاكسسوارات النسائية سلاسل ناعمة واكسسوارات بنات على الموضة بجودة عالية وبأقل الأسعار مع توصيل سريع لجميع مدن المملك.'),
(2, 'مجموعة أطقم نسائية فاخرة.', 'مجموعة أطقم نسائية متنوعة ملكية وفاخرة باللون الفضي ويتكون كل طقم من سلسال وخاتم واسوارة وحلق.\r\n\r\n'),
(3, 'عليكِ اختيار وايت جولد لكي\r\n', 'تتألقي بأناقة مع مجموعة الأطقم النسائية الفاخرة من متجر وايت جولد. اختري من بين مجموعة متنوعة من الأطقم الفاخرة باللون الفضي، واحصلي على إطلالة ملكية تليق بك\r\n\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `items_id` int(11) NOT NULL,
  `items_name` varchar(100) NOT NULL,
  `items_desc` varchar(255) NOT NULL,
  `items_image` varchar(255) NOT NULL,
  `items_count` int(11) NOT NULL,
  `items_active` tinyint(4) NOT NULL DEFAULT 1,
  `items_price` float NOT NULL,
  `items_old_price` float NOT NULL,
  `items_homeorder` int(11) NOT NULL DEFAULT 0,
  `items_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`items_id`, `items_name`, `items_desc`, `items_image`, `items_count`, `items_active`, `items_price`, `items_old_price`, `items_homeorder`, `items_date`) VALUES
(5, 'طقم نسائي ملكي باللون الفضي', 'طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي', 'items01.jpg', 22, 1, 170, 240, 10, '2024-02-21 18:55:35'),
(7, 'طقم نسائي ملكي باللون الفضي', 'طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي', 'items02.jpg', 140, 1, 200, 350, 9, '2024-02-21 19:04:04'),
(8, 'طقم نسائي ملكي باللون الفضي', 'طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي', 'items03.jpg', 160, 1, 210, 370, 8, '2024-02-21 19:04:04'),
(9, 'طقم نسائي ملكي باللون الفضي', 'طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي', 'items04.jpeg', 170, 1, 220, 390, 7, '2024-02-21 19:04:04'),
(10, 'طقم نسائي ملكي باللون الفضي', 'طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي', 'items05.jpg', 180, 1, 230, 410, 11, '2024-02-21 19:04:04'),
(11, 'طقم نسائي ملكي باللون الفضي', 'طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي', 'items06.jpg', 130, 1, 190, 330, 4, '2024-02-21 19:04:04'),
(12, 'طقم نسائي ملكي باللون الفضي', 'طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي', 'items07.jpg', 140, 1, 200, 350, 3, '2024-02-21 19:04:04'),
(13, 'طقم نسائيrwr ملكي باللون الفضي', 'طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي', 'items08.jpg', 160, 1, 210, 370, 5, '2024-02-21 19:04:04'),
(15, 'طقم نسائي ملكي باللون الفضي', 'طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي', 'items09.jpg', 180, 1, 230, 410, 0, '2024-02-21 19:04:04'),
(17, 'طقم نسائي ملكي باللون الفضي', 'طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي', 'items10.jpg', 140, 1, 300, 350, 2, '2024-02-21 19:21:23'),
(20, 'طقم نسائي ملكي باللون الفضي', 'طقم نسائي ملكي باللون الفضيطقم نسائي ملكي باللون الفضي', 'items11.jpg', 0, 1, 1321, 12, 1, '2024-02-26 21:40:22'),
(21, 'طقم نسائي ملكي باللون الفضي', 'طقم نسائي ملكي باللون الفضيطقم نسائي ملكي باللون الفضي', 'items12.jpg', 0, 1, 12, 1221, 0, '2024-02-26 21:40:47'),
(24, 'طقم نسائي ملكي باللون الفضي', 'طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي', 'items13.jpg', 0, 1, 121, 1212, 6, '2024-03-03 22:25:51'),
(25, 'طقم نسائي ملكي باللون الفضي', 'طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي', 'items13.jpg', 22, 1, 170, 240, 10, '2024-02-21 15:55:35'),
(26, 'طقم نسائي ملكي باللون الفضي', 'طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي', 'items14.jpg', 140, 1, 200, 350, 9, '2024-02-21 16:04:04'),
(27, 'طقم نسائي ملكي باللون الفضي', 'طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي', 'items15.jpg', 160, 1, 210, 370, 8, '2024-02-21 16:04:04'),
(28, 'طقم نسائي ملكي باللون الفضي', 'طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي', 'items16.jpg', 170, 1, 220, 390, 7, '2024-02-21 16:04:04'),
(30, 'طقم نسائي ملكي باللون الفضي', 'طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي', 'items18.jpg', 0, 1, 121, 1212, 6, '2024-03-03 19:25:51'),
(31, 'طقم نسائي ملكي باللون الفضي', 'طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي', 'items19.jpg', 22, 1, 170, 240, 10, '2024-02-21 15:55:35'),
(32, 'طقم نسائي ملكي باللون الفضي', 'طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي', 'items20.jpg', 140, 1, 200, 350, 9, '2024-02-21 16:04:04'),
(33, 'طقم نسائي ملكي باللون الفضي', 'طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي', 'items21.jpg', 160, 1, 210, 370, 8, '2024-02-21 16:04:04'),
(34, 'طقم نسائي ملكي باللون الفضي', 'طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي', 'items22.jpg', 170, 1, 220, 390, 7, '2024-02-21 16:04:04'),
(35, 'طقم نسائي ملكي باللون الفضي', 'طقم نسائي ملكي باللون الفضيطقم نسائي ملكي باللون الفضي', 'items23.jpg', 0, 1, 12, 1221, 0, '2024-02-26 18:40:47'),
(36, 'طقم نسائي ملكي باللون الفضي', 'طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي', 'items24.jpg', 22, 1, 170, 240, 10, '2024-02-21 15:55:35'),
(37, 'طقم نسائي ملكي باللون الفضي', 'طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي', 'items25.jpg', 140, 1, 200, 350, 9, '2024-02-21 16:04:04'),
(38, 'طقم نسائي ملكي باللون الفضي', 'طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي', 'items26.jpg', 160, 1, 210, 370, 8, '2024-02-21 16:04:04'),
(39, 'طقم نسائي ملكي باللون الفضي', 'طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي طقم نسائي ملكي باللون الفضي', 'march-birthstone_a0981c88-4f0a-4a2b-821c-c985626685d8.jpg', 170, 1, 220, 390, 7, '2024-02-21 16:04:04');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_items_id` int(11) NOT NULL,
  `confirmorder_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_items_id`, `confirmorder_id`, `item_id`, `quantity`, `price`) VALUES
(13, 17, 7, 3, 200),
(14, 17, 7, 3, 200),
(15, 17, 20, 2, 1321),
(16, 17, 20, 2, 1321),
(17, 18, 20, 1, 1321),
(18, 18, 20, 1, 1321),
(19, 18, 9, 1, 220),
(20, 18, 9, 1, 220),
(21, 19, 15, 1, 230),
(22, 19, 15, 1, 230);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_phone` varchar(100) NOT NULL,
  `user_city` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_verifycode` int(11) NOT NULL,
  `user_approve` tinyint(4) NOT NULL DEFAULT 1,
  `user_groupID` int(11) NOT NULL DEFAULT 0,
  `user_create` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_phone`, `user_city`, `user_password`, `user_email`, `user_verifycode`, `user_approve`, `user_groupID`, `user_create`) VALUES
(26, 'arwa', '211212', 'الرياض', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'test@gmail.com', 48051, 2, 0, '2023-07-26 23:45:46'),
(27, 'test@gmail.com', '73737', '', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'testsignup@gmail.com', 70577, 1, 0, '2023-07-28 00:35:06'),
(32, 'tawaf', '77444', '', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'tawafmesar@gmail.com', 42175, 2, 1, '2023-12-25 20:34:17'),
(33, 'nawaf', '1221211', '', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'nawafmesar@gmail.com', 43999, 2, 0, '2024-02-23 22:22:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `confirmorder`
--
ALTER TABLE `confirmorder`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_userid` (`order_userid`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`favorite_id`),
  ADD KEY `fk_favorite_items` (`favorite_itemsid`),
  ADD KEY `fk_favorite_users` (`favorite_usersid`);

--
-- Indexes for table `homepage`
--
ALTER TABLE `homepage`
  ADD PRIMARY KEY (`homepage_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`items_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_items_id`),
  ADD KEY `confirmorder_id` (`confirmorder_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `confirmorder`
--
ALTER TABLE `confirmorder`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `favorite_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `homepage`
--
ALTER TABLE `homepage`
  MODIFY `homepage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `confirmorder`
--
ALTER TABLE `confirmorder`
  ADD CONSTRAINT `confirmorder_ibfk_1` FOREIGN KEY (`order_userid`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`favorite_itemsid`) REFERENCES `items` (`items_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`favorite_usersid`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`confirmorder_id`) REFERENCES `confirmorder` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`items_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
