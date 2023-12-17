-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 17, 2023 at 04:03 AM
-- Server version: 5.7.39
-- PHP Version: 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `createdat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`, `createdat`, `updatedat`) VALUES
(15, 'vardhan', 'emimall_dev', 'ed20f70c33170c862380e166bb2111d9', '2023-09-09 03:53:38', '2023-09-09 03:53:38'),
(16, 'Bhopathi Vardhan Kumar Reddy', 'Bhopathi Reddy', 'd12256251b39db44d0fa94cb97b278d3', '2023-09-09 03:56:10', '2023-09-18 06:33:03'),
(18, 'Bhopathi Vardhan Kumar Reddy', 'vardhanreddy', '7488e331b8b64e5794da3fa4eb10ad5d', '2023-09-23 16:15:02', '2023-09-23 16:15:18'),
(19, 'Adminstrator', 'admin', '0192023a7bbd73250516f069df18b500', '2023-09-24 04:28:23', '2023-09-24 04:28:23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` text,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  `createdat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`, `createdat`, `updatedat`) VALUES
(18, 'Pizza', 'Food_Category_4054.jpg', 'Yes', 'Yes', '2023-11-14 10:06:07', '2023-11-14 10:06:07'),
(19, 'Burger', 'Food_Category_4564.jpg', 'Yes', 'Yes', '2023-11-14 10:06:22', '2023-11-14 10:06:22'),
(20, 'Momos', 'Food_Category_4544.jpg', 'Yes', 'Yes', '2023-11-14 10:06:38', '2023-11-14 10:06:38'),
(21, 'Non-Veg Starters', 'Food_Category_5993.jpeg', 'Yes', 'Yes', '2023-11-14 10:10:56', '2023-11-14 11:58:11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`, `created_at`, `updated_at`) VALUES
(7, 'Veg Momos', 'Best snack for the veggies to eat.', '100.00', 'Food-Name-5362.jpeg', 20, 'Yes', 'Yes', '2023-11-25 16:37:29', '2023-11-25 16:37:29'),
(8, 'Tandoori Veg Momos', 'Best the item to eat during evening times.', '150.00', 'Food-Name-8741.webp', 20, 'Yes', 'Yes', '2023-11-25 16:38:44', '2023-11-25 16:38:44'),
(10, 'Fried Non Veg Momos', 'Best Item', '130.00', 'Food-Name-945.jpeg', 20, 'Yes', 'Yes', '2023-11-25 16:44:54', '2023-11-25 16:44:54'),
(11, 'Veg Burger', 'Best veg item to eat', '80.00', 'Food-Name-2598.webp', 19, 'Yes', 'Yes', '2023-11-25 16:47:56', '2023-11-25 16:47:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`, `created_at`, `updated_at`) VALUES
(1, 'Tandoori Veg Momos', '100.00', 5, '500.00', '2023-12-02 03:10:52', 'Ordered', '', '', '', '', '2023-12-02 15:19:22', '2023-12-16 11:06:42'),
(2, 'Tandoori Veg Momos', '100.00', 5, '500.00', '2023-12-02 03:26:45', 'Cancelled', '', '', '', '', '2023-12-02 15:26:45', '2023-12-16 11:09:23'),
(3, 'Veg Burger', '100.00', 5, '500.00', '2023-12-02 04:20:32', 'Delivered', '', '', '', '', '2023-12-02 16:20:32', '2023-12-16 11:08:02'),
(4, 'Veg Momos', '100.00', 5, '500.00', '2023-12-16 10:16:13', 'On Delivery', '', '', '', '', '2023-12-16 10:16:13', '2023-12-16 11:07:51'),
(5, 'Tandoori Veg Momos', '150.00', 89, '13350.00', '2023-12-16 11:32:35', 'Delivered', 'Slade Rush', '+1 (359) 844-6374', 'nuhyru@mailinator.com', 'Voluptatem Quaerat ', '2023-12-16 11:32:35', '2023-12-16 11:34:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
