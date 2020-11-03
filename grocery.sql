-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 26, 2020 at 06:09 PM
-- Server version: 10.2.31-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_time` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `date_time`, `status`) VALUES
(1, 17, '2020-03-25 13:20:03', 1),
(2, 17, '2020-03-25 00:00:00', 1),
(3, 17, '2020-03-25 00:00:00', 1),
(4, 17, '2020-03-25 00:00:00', 1),
(5, 17, '2020-03-25 00:00:00', 1),
(6, 17, '2020-03-25 00:00:00', 1),
(7, 17, '2020-03-25 00:00:00', 1),
(8, 17, '2020-03-25 00:00:00', 1),
(9, 17, '2020-03-25 00:00:00', 1),
(10, 17, '2020-03-25 00:00:00', 1),
(11, 17, '2020-03-26 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `qty`, `status`) VALUES
(1, 1, 10, 3, 1),
(3, 1, 13, 2, 1),
(4, 1, 9, 5, 1),
(5, 2, 10, 3, 1),
(6, 10, 9, 6, 1),
(7, 11, 14, 3, 1),
(8, 11, 10, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `desc`, `image`, `status`) VALUES
(1, 'Fresh Food', 'Fresh foods are available in our website', 'image-7971584713403.jpg', 1),
(13, 'Bakery And Bread', 'Bakery and Bread Products are available in our website', 'image-6281584713100.jpg', 1),
(15, 'Juice', 'Juice', 'image-5391584817778.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `region_id`, `name`, `status`) VALUES
(1, 1, 'karachi', 1),
(2, 2, 'lahore', 1),
(3, 0, 'karahi', 1),
(4, 0, 'karachi old town', 1),
(5, 0, 'undefined', 1);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `phone_code` int(11) NOT NULL,
  `iso_code` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `phone_code`, `iso_code`, `status`) VALUES
(1, 'pakistan', 92, 'pk', 1);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `no_of_usage` int(11) NOT NULL,
  `discount_type` enum('percentage','amount') COLLATE utf8_unicode_ci NOT NULL,
  `discount_value` decimal(10,0) NOT NULL,
  `minimum_amount` decimal(10,0) NOT NULL,
  `expiry_time` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `name`, `code`, `no_of_usage`, `discount_type`, `discount_value`, `minimum_amount`, `expiry_time`, `status`) VALUES
(1, 'coupon 1', 'XZY1235', 10, 'percentage', 20, 20, '2020-03-29 12:12:00', 1),
(5, 'coupon 2', 'xyz1234', 10, 'percentage', 10, 50, '2020-03-25 17:27:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE `deals` (
  `id` int(11) NOT NULL,
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `orders` int(11) NOT NULL,
  `duration` enum('month') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'month',
  `discount_type` enum('percentage','amount') COLLATE utf8_unicode_ci NOT NULL,
  `discount_value` decimal(10,0) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `deals`
--

INSERT INTO `deals` (`id`, `name`, `orders`, `duration`, `discount_type`, `discount_value`, `status`) VALUES
(1, 'coupon', 6, 'month', 'amount', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `forgot_password`
--

CREATE TABLE `forgot_password` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(6) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forgot_password`
--

INSERT INTO `forgot_password` (`id`, `user_id`, `token`, `status`, `date_time`) VALUES
(1, 11, '438307', 1, '2020-03-20 14:29:39'),
(2, 17, '692381', 1, '2020-03-20 14:29:59'),
(3, 17, '939995', 1, '2020-03-20 14:33:52'),
(4, 17, '104614', 1, '2020-03-20 14:35:43'),
(5, 17, '345635', 1, '2020-03-20 14:36:44'),
(6, 17, '731685', 1, '2020-03-20 14:39:00'),
(7, 17, '357327', 1, '2020-03-20 14:42:36'),
(8, 17, '969762', 1, '2020-03-20 14:50:58'),
(9, 17, '867589', 1, '2020-03-20 14:52:24'),
(10, 17, '403514', 1, '2020-03-20 14:52:48'),
(11, 17, '723601', 1, '2020-03-20 14:53:13'),
(12, 17, '796039', 1, '2020-03-20 14:54:29'),
(13, 17, '260396', 1, '2020-03-20 15:02:14'),
(14, 17, '572578', 1, '2020-03-20 15:02:46'),
(15, 17, '117082', 1, '2020-03-20 15:37:14'),
(16, 17, '637686', 1, '2020-03-20 15:38:12'),
(17, 17, '997925', 1, '2020-03-20 18:56:27'),
(18, 17, '721855', 1, '2020-03-20 18:57:45'),
(19, 17, '172915', 1, '2020-03-20 18:59:47'),
(20, 17, '506654', 1, '2020-03-20 19:00:26'),
(21, 17, '435090', 1, '2020-03-20 19:02:20'),
(22, 17, '417178', 1, '2020-03-20 19:05:04'),
(23, 17, '259482', 1, '2020-03-20 19:06:24'),
(24, 17, '320864', 1, '2020-03-20 19:06:47'),
(25, 17, '286061', 1, '2020-03-20 19:09:25'),
(26, 17, '982357', 1, '2020-03-20 19:20:28');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `post_code` varchar(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `user_id`, `city_id`, `address`, `post_code`, `status`) VALUES
(1, 11, 1, 'near al-fared street ', '72400', 1),
(2, 12, 1, 'near al-fared street ', '72400', 1),
(3, 11, 3, 'done', '0987', 1),
(4, 18, 0, 'garden', '09099', 1),
(5, 18, 4, 'garden', '09099', 1),
(6, 20, 1, 'Al-fared Street, Jamshed Town, Karachi', '72400', 1),
(7, 17, 1, 'Al-fared Street, Jamshed Town, Karachi', '72400', 1),
(8, 17, 1, 'Al-fared Street, Jamshed Town, Karachi', '72400', 1),
(9, 17, 1, 'Al-fared Street, Jamshed Town, Karachi', '72400', 1),
(10, 17, 1, 'Al-fared Street, Jamshed Town, Karachi', '72400', 1),
(11, 17, 1, 'Al-fared Street, Jamshed Town, Karachi', '72400', 1),
(12, 17, 1, 'Al-fared Street, Jamshed Town, Karachi', '72400', 1),
(13, 17, 1, 'Al-fared Street, Jamshed Town, Karachi', '72400', 1),
(14, 17, 1, 'Al-fared Street, Jamshed Town, Karachi', '72400', 1),
(15, 17, 1, 'Al-fared Street, Jamshed Town, Karachi', '72400', 1),
(16, 17, 1, 'Al-fared Street, Jamshed Town, Karachi', '72400', 1),
(17, 17, 1, 'Al-fared Street, Jamshed Town, Karachi', '72400', 1),
(18, 17, 1, 'Al-fared Street, Jamshed Town, Karachi', '72400', 1),
(19, 17, 1, 'Al-fared Street, Jamshed Town, Karachi', '72400', 1),
(20, 17, 1, 'Al-fared Street, Jamshed Town, Karachi', '72400', 1),
(21, 17, 1, 'Al-fared Street, Jamshed Town, Karachi', '72400', 1),
(22, 0, 0, 'undefined', 'undefined', 1),
(23, 17, 1, 'Al-fared', '72400', 1),
(24, 17, 1, 'Al-fared', '72400', 1),
(25, 17, 1, 'street 1', '742000', 1),
(26, 17, 1, 'street 1', '742000', 1),
(27, 17, 1, 'street 1', '742000', 1),
(28, 17, 1, 'Al-fared Street, Jamshed Town, Karachi', '72400', 1),
(29, 17, 1, 'Al-fared Street, Jamshed Town, Karachi', '72400', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `charge_id` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `cart_id`, `user_id`, `location_id`, `coupon_id`, `charge_id`, `date_time`, `status`) VALUES
(1, 1, 11, 1, NULL, 'charge_id', '0000-00-00 00:00:00', 1),
(2, 7, 17, 14, NULL, '', '2020-03-24 00:00:00', 0),
(3, 9, 17, 17, NULL, '', '2020-03-24 00:00:00', 0),
(4, 11, 17, 29, 1, 'cs_test_TfV4WzKVKJXbozmoI8UseyanhXG1rIyHAancpVjBbWSxvbrtsu5Bwl08', '2020-03-26 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `price` decimal(10,0) NOT NULL,
  `stock` tinyint(11) NOT NULL,
  `um` varchar(40) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `delivery_charges` decimal(10,0) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sub_category_id`, `sku`, `name`, `desc`, `price`, `stock`, `um`, `image`, `delivery_charges`, `status`) VALUES
(9, 8, '1', 'Tomato ', 'Fresh Tomato are available in our website', 9, 127, 'Kg', 'image-5971584713894.jpg', 10, 1),
(10, 8, '2', 'Potato', 'Fresh Potato', 10, 127, 'Kg', 'image-9711584712158.jpg', 10, 1),
(11, 8, '3', 'Onions', 'Fresh Onions are available ', 12, 100, 'Kg', 'image-8331584712508.jpg', 10, 1),
(12, 8, '4', 'Capsicum', 'Fresh Capsicums are available ', 13, 127, 'Kg', 'image-2081584712606.jpg', 10, 1),
(13, 8, '5', 'Ginger ', 'Fresh Gingers are available', 70, 127, 'Kg', 'image-3211584712692.jpg', 10, 1),
(14, 8, '6', 'Garlic ', 'Fresh Garlic are available ', 13, 100, 'Kg', 'image-5751584712820.jpg', 10, 1),
(15, 8, '7', 'Carrots', 'Fresh carrots are available in our website', 5, 100, 'Kg', 'image-6421584715422.jpg', 10, 1),
(16, 9, '8', 'Jelly Jams ', 'Fresh Jelly Jams are available in our website', 50, 127, 'Kg', 'image-2651584714397.jpg', 10, 1),
(17, 9, '9', 'Breads', 'Fresh Breads are available in our website', 10, 127, 'Kg', 'image-5231584714543.jpg', 10, 1),
(18, 9, '10', 'Biscuits ', 'Fresh Biscuits are available in our website', 5, 127, 'Kg', 'image-6271584714687.jpeg', 10, 1),
(19, 10, '11', 'Apple', 'Fresh Apple are available', 70, 127, 'Kg', 'image-4521584715868.jpg', 10, 1),
(20, 10, '12', 'Mango ', 'Fresh Products are available ', 12, 127, 'Kg', 'image-4731584716099.jpg', 10, 1),
(21, 10, '13', 'Watermelon ', 'Fresh Watermelon are available ', 9, 100, 'Kg', 'image-8421584716243.jpg', 10, 1),
(22, 10, '14', 'Oranges', 'Fresh Oranges are available ', 10, 127, 'Kg', 'image-7381584716363.png', 10, 1),
(24, 10, '15', 'Guava', 'Fresh Guava are available ', 8, 127, 'Kg', 'image-9831584716712.jpg', 10, 1),
(25, 10, '16', 'Banana', 'Fresh Bananas are available ....', 5, 100, 'Kg', 'image-6961584717107.png', 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_additional_images`
--

CREATE TABLE `product_additional_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_additional_images`
--

INSERT INTO `product_additional_images` (`id`, `product_id`, `image`, `status`) VALUES
(1, 1, 'image-2951584102658.png', 1),
(2, 1, 'image-8231584102658.png', 1),
(4, 2, 'image-2281584102688.png', 1),
(5, 2, 'image-5511584102688.png', 1),
(6, 4, 'image-2771584197606.png', 1),
(7, 4, 'image-4551584197606.png', 1),
(8, 4, 'image-3341584197606.png', 1),
(9, 4, 'image-6971584197606.png', 1),
(10, 5, 'image-9851584197606.png', 1),
(11, 5, 'image-8941584197606.png', 1),
(12, 5, 'image-7801584197606.png', 1),
(13, 5, 'image-2431584197606.png', 1),
(19, 1, 'image-7721584335815.jpg', 1),
(20, 6, 'image-6821584382006.png', 1),
(21, 6, 'image-9941584382006.png', 1),
(22, 6, 'image-2351584382006.png', 1),
(23, 6, 'image-9551584382006.png', 1),
(24, 7, 'image-8611584382006.png', 1),
(25, 7, 'image-8931584382006.png', 1),
(26, 7, 'image-2591584382006.png', 1),
(27, 7, 'image-9961584382006.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `country_id`, `name`, `status`) VALUES
(1, 1, 'sindh', 1),
(2, 1, 'punjab', 1),
(3, 1, 'undefined', 1),
(4, 1, '7667846464876', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `rating` tinyint(1) NOT NULL DEFAULT 1,
  `review` varchar(255) DEFAULT NULL,
  `reply` varchar(255) DEFAULT NULL,
  `status` tinyint(11) NOT NULL DEFAULT 1,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `order_id`, `rating`, `review`, `reply`, `status`, `date_time`) VALUES
(1, 11, 1, 1, 1, 'worst experiance ', 'asda ds', 1, '0000-00-00 00:00:00'),
(2, 11, 2, 1, 2, 'vegetables are not fresh', 'asdasd 123', 1, '0000-00-00 00:00:00'),
(3, 11, 4, 1, 4, 'Fruits are fresh when delivered', NULL, 1, '0000-00-00 00:00:00'),
(4, 17, 10, 4, 4, 'asdda', NULL, 1, '0000-00-00 00:00:00'),
(8, 17, 14, 4, 5, 'fdfsdf', NULL, 1, '2020-03-26 16:23:00');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `desc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `desc`) VALUES
(1, 'super_admin', NULL),
(2, 'users', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `discount_type` enum('percentage','amount') COLLATE utf8_unicode_ci NOT NULL,
  `discount_amount` decimal(10,0) NOT NULL,
  `expiry_time` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `name`, `desc`, `image`, `status`) VALUES
(8, 1, 'Vegetable', 'Fresh Products are available in our website', NULL, 1),
(9, 13, 'Bakery Products', 'Bakery ', 'image-7791584713674.jpg', 1),
(10, 1, 'Fruits ', 'Fresh Fruits are available in our website', 'image-8671584715651.jpg', 1),
(11, 15, 'Unknown', 'Unnamed', 'image-8301584817827.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 2,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` bigint(15) NOT NULL,
  `password` varchar(40) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `token` varchar(40) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `first_name`, `last_name`, `email`, `phone`, `password`, `gender`, `image`, `token`, `date`, `status`) VALUES
(1, 1, 'admin', 'grossary', 'admin@ecommerce.com', 0, 'e10adc3949ba59abbe56e057f20f883e', 'male', NULL, NULL, NULL, 1),
(11, 2, 'raheel', 'khan', 'hassanqazi146@gmail.com', 545645645646, '827ccb0eea8a706c4c34a16891f84e7b', 'male', NULL, NULL, '2020-03-16 15:11:23', 1),
(12, 2, 'raheel 1', '3121231212', 'hassanqazi1416@gmail.com', 5456456456461, '827ccb0eea8a706c4c34a16891f84e7b', 'male', NULL, NULL, '2020-03-16 15:13:15', 1),
(13, 2, 'maesam', 'raza', 'maesamraza6@gmail.com', 3322901615, '0fed8fa4c578fa759dab3084bd16e14c', 'male', NULL, NULL, '2020-03-16 15:47:30', 1),
(14, 2, 'subhan', 'shah', 'emailforhnh@gmail.com', 90078601, '83340bcdf7b3d326b3c4dff72b096a90', 'male', NULL, NULL, '2020-03-16 15:49:35', 1),
(15, 2, 'raheel 1', 'khan 1', 'raheel.khan@gmail.com', 31212312, '325a2cc052914ceeb8c19016c091d2ac', 'male', 'image-8341584356629.png', NULL, '2020-03-16 16:03:49', 1),
(16, 2, 'raheel', 'khan', 'raheel.khan1@gmail.com', 312123121, '325a2cc052914ceeb8c19016c091d2ac', 'male', 'image-1551584356688.png', NULL, '2020-03-16 16:04:48', 1),
(17, 2, 'raheel', 'khan', 'raheelqazi326@gmail.com', 923122196246, '325a2cc052914ceeb8c19016c091d2ac', 'male', 'image-7661584686347.png', NULL, '2020-03-20 11:39:07', 1),
(18, 2, 'muhammad', 'mudasir', 'mudasir11@gmail.com', 9987654, 'b2614e8ef4ae3e38c2ff86344556ee5a', 'male', 'image-8091584819406.png', NULL, '2020-03-20 14:31:51', 1),
(20, 2, 'raheel', 'khan', 'raheelkhan123@ecommerce.com', 3122196231, '325a2cc052914ceeb8c19016c091d2ac', 'male', NULL, NULL, '2020-03-22 00:43:09', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE` (`name`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deals`
--
ALTER TABLE `deals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forgot_password`
--
ALTER TABLE `forgot_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_additional_images`
--
ALTER TABLE `product_additional_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE_EMAIL` (`email`),
  ADD UNIQUE KEY `UNIQUE_PHONE` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `deals`
--
ALTER TABLE `deals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `forgot_password`
--
ALTER TABLE `forgot_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `product_additional_images`
--
ALTER TABLE `product_additional_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
