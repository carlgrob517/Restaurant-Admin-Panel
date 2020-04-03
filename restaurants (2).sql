-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2020 at 09:32 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurants`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` blob NOT NULL,
  `image` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `title`, `description`, `image`, `updated_at`, `created_at`) VALUES
(1, 'about us page', 0x3c703e54686973206973207665727920676f6f642e3c2f703e0d0a0d0a3c703e49206c696b65207468697320666c6174666f726d2e3c2f703e0d0a0d0a3c703e6f6b733c2f703e, 'uploads/user/slideshow2.jpg', '2020-03-30 22:42:52', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sp_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'category.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `sp_name`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Mexicana', 'Mexicana', 'uploads/category/1.png', '2020-03-24 05:05:29', '2020-03-24 05:05:29'),
(3, 'Internacional', 'Internacional', 'uploads/category/2.png', '2020-03-24 05:08:10', '2020-03-24 05:08:10'),
(4, 'Comida rapida', 'Comida rapida', 'uploads/category/3.png', '2020-03-24 05:08:41', '2020-03-24 05:08:41'),
(5, 'Del mar', 'Del mar', 'uploads/category/4.png', '2020-03-24 05:08:51', '2020-03-24 05:08:51'),
(6, 'Bffetes', 'Bffetes', 'uploads/category/5.png', '2020-03-24 05:09:06', '2020-03-24 05:09:06'),
(7, 'De autor', 'De autor', 'uploads/category/6.png', '2020-03-24 05:09:19', '2020-03-24 05:09:19'),
(8, 'Colectivos', 'Colectivos', 'uploads/category/7.png', '2020-03-24 05:09:33', '2020-03-24 05:09:33'),
(9, 'Desayunos', 'Desayunos', 'uploads/category/8.png', '2020-03-24 05:09:48', '2020-03-24 05:09:48');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` bigint(20) NOT NULL,
  `state_id` int(11) DEFAULT NULL,
  `county_fips` int(11) DEFAULT NULL,
  `city_name` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `state_id`, `county_fips`, `city_name`, `updated_at`, `created_at`) VALUES
(1, 50, 0, 'San Die Go', '2020-03-28 13:13:11', '2020-03-28 05:09:34'),
(3, 50, 0, 'Lon Don', '2020-03-28 05:14:11', '2020-03-28 05:14:11'),
(4, 50, 0, 'NewYork', '2020-03-28 05:14:21', '2020-03-28 05:14:21'),
(5, 50, 0, 'Japan', '2020-03-30 01:02:41', '2020-03-30 01:02:41');

-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

CREATE TABLE `facility` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(155) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facility`
--

INSERT INTO `facility` (`id`, `title`, `image`, `updated_at`, `created_at`) VALUES
(8, 'wifi', 'uploads/facility/1.png', '2020-03-28 09:48:03', '2020-03-28 01:47:40'),
(9, 'Pet', 'uploads/facility/2.png', '2020-03-28 01:51:33', '2020-03-28 01:51:33'),
(10, 'Parking', 'uploads/facility/3.png', '2020-03-28 01:51:43', '2020-03-28 01:51:43'),
(11, 'Area', 'uploads/facility/4.png', '2020-03-28 01:51:53', '2020-03-28 01:51:53'),
(12, 'Access', 'uploads/facility/5.png', '2020-03-28 01:52:05', '2020-03-28 01:52:05');

-- --------------------------------------------------------

--
-- Table structure for table `hours`
--

CREATE TABLE `hours` (
  `id` int(10) UNSIGNED NOT NULL,
  `start_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `week_of_day` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hours`
--

INSERT INTO `hours` (`id`, `start_time`, `end_time`, `week_of_day`, `created_at`, `updated_at`) VALUES
(11, '00:13', '15:04', '3', '2018-11-16 08:31:20', '2018-11-16 08:31:20'),
(13, '08:00', '17:00', '2', '2018-11-16 08:39:52', '2018-11-16 08:39:52'),
(14, '09:00', '18:00', '3', '2018-11-16 08:40:11', '2018-11-16 08:40:11'),
(15, '08:00', '15:00', '4', '2018-11-16 08:40:30', '2018-11-16 08:40:30'),
(16, '02:00', '23:00', '7', '2018-11-16 08:41:00', '2018-11-16 08:41:00');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` blob NOT NULL,
  `url` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `title`, `description`, `url`, `updated_at`, `created_at`) VALUES
(1, 'Notification 1', 0x6e6f74696669636174696f6e2031206173646673, 'http://www.google.com', '2020-03-30 01:56:04', '2020-03-30 01:56:04'),
(3, 'Notification', 0x6e6f74696669636174696f6e2e202e2e, 'http://www.twillio.com', '2020-03-30 23:00:11', '2020-03-30 23:00:11');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` blob NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lng` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` int(255) NOT NULL DEFAULT '5',
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_price` double(10,2) NOT NULL,
  `max_price` double(10,2) NOT NULL,
  `category_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hour_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facility_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` int(11) NOT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL,
  `favorite` int(1) NOT NULL,
  `review` int(255) NOT NULL,
  `company_id` int(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`id`, `title`, `description`, `address`, `lat`, `lng`, `phone`, `email`, `fax`, `url`, `img`, `video`, `rate`, `facebook`, `twitter`, `instagram`, `min_price`, `max_price`, `category_id`, `hour_id`, `facility_id`, `city_id`, `time`, `status`, `favorite`, `review`, `company_id`, `created_at`, `updated_at`, `slug`) VALUES
(7, 'Res 1111', 0x3c703e5468697320726573206973207665727920676f6f6420696e2074686520776f726c643c2f703e, 'Sna Diego', '53.41524304907991', '-112.64272850123474', '23412312342', 'kingstarboy@outlook.com', 'fax', 'web link', 'uploads/restaurant/slideshow2.jpg', 'video', 5, 'facebook', 'facebook', 'facebook', 56.00, 100.00, ':6:4', ':13:14:15:16', ':8:9:10', 1, NULL, 1, 1, 0, 11, '2020-03-24 07:55:27', '2020-03-24 07:55:27', 'res-1'),
(8, 'Res2', 0x3c703e4465736372697074696f6e3c2f703e, 'San Diego USA', '50.33063713987774', '-108.26519959377568', '42342134', 'forwcj@gmail.com', 'fax', 'weblink', 'uploads/restaurant/slideshow3.jpg', 'video', 5, 'facebok', 'twitter', 'instagram', 0.00, 0.00, ':4:8', ':11:13:14', ':11:12', 1, NULL, 1, 0, 0, 11, '2020-03-24 08:05:51', '2020-03-24 08:05:51', 'res2'),
(9, 'Res3', 0x3c703e6173646661736466617364663c2f703e, 'Res3', '51.36397246354523', '-111.68096812055514', '3453452345', 'kingstarboy@outlook.com', 'fax', 'web link', 'uploads/restaurant/slideshow2.jpg', 'video', 5, 'facebooklink', 'twitter', 'instagram', 0.00, 0.00, ':6:7', ':11:13:14:15', '', 1, NULL, 1, 0, 0, 11, '2020-03-24 08:09:57', '2020-03-24 08:09:57', 'res3'),
(10, 'Res4', 0x3c703e33343233343233343c2f703e, 'Res4', '51.936726050442665', '-109.45494437831951', '5464356456', 'kingstarboy@outlook.com', 'fax', 'web link', 'uploads/restaurant/slideshow4.jpg', 'video', 5, 'facebooklink', 'twitter', 'instagram', 0.00, 0.00, ':6', ':11', ':9', 1, NULL, 1, 0, 0, 11, '2020-03-24 08:10:24', '2020-03-24 08:10:24', 'res4'),
(11, 'Mexican Res', 0x3c703e6d65786963616e20666f6f643c2f703e, 'Japan', '52.77421091210483', '-111.79263168756995', '4353453452345', 'kingstarboy@outlook.com', 'fax', 'web link', 'uploads/restaurant/slideshow2.jpg', 'video', 5, 'facebooklink', 'twitter', 'instagram', 23.00, 23453.00, ':2', ':11', '', 0, NULL, 1, 0, 0, 11, '2020-03-30 00:49:59', '2020-03-30 00:49:59', 'mexican-res');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_categories`
--

CREATE TABLE `restaurant_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant_categories`
--

INSERT INTO `restaurant_categories` (`id`, `restaurant_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 1, 8, '2020-03-24 07:16:32', '2020-03-24 07:16:32'),
(2, 1, 4, '2020-03-24 07:16:32', '2020-03-24 07:16:32'),
(3, 2, 8, '2020-03-24 07:32:23', '2020-03-24 07:32:23'),
(4, 2, 7, '2020-03-24 07:32:23', '2020-03-24 07:32:23'),
(5, 3, 8, '2020-03-24 07:41:38', '2020-03-24 07:41:38'),
(6, 3, 7, '2020-03-24 07:41:38', '2020-03-24 07:41:38'),
(7, 4, 8, '2020-03-24 07:42:36', '2020-03-24 07:42:36'),
(8, 4, 7, '2020-03-24 07:42:36', '2020-03-24 07:42:36'),
(9, 5, 8, '2020-03-24 07:42:48', '2020-03-24 07:42:48'),
(10, 5, 7, '2020-03-24 07:42:48', '2020-03-24 07:42:48'),
(11, 6, 8, '2020-03-24 07:43:26', '2020-03-24 07:43:26'),
(12, 6, 7, '2020-03-24 07:43:26', '2020-03-24 07:43:26'),
(81, 10, 6, '2020-03-28 06:18:42', '2020-03-28 06:18:42'),
(86, 9, 6, '2020-03-28 06:21:07', '2020-03-28 06:21:07'),
(87, 9, 7, '2020-03-28 06:21:07', '2020-03-28 06:21:07'),
(108, 8, 4, '2020-03-28 06:59:51', '2020-03-28 06:59:51'),
(109, 8, 8, '2020-03-28 06:59:51', '2020-03-28 06:59:51'),
(126, 7, 6, '2020-03-30 00:11:56', '2020-03-30 00:11:56'),
(127, 7, 4, '2020-03-30 00:11:56', '2020-03-30 00:11:56'),
(128, 11, 2, '2020-03-30 00:49:59', '2020-03-30 00:49:59');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_facility`
--

CREATE TABLE `restaurant_facility` (
  `id` int(255) NOT NULL,
  `restaurant_id` int(255) NOT NULL,
  `facility_id` int(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurant_facility`
--

INSERT INTO `restaurant_facility` (`id`, `restaurant_id`, `facility_id`, `updated_at`, `created_at`) VALUES
(79, 10, 9, '2020-03-28 06:18:42', '2020-03-28 06:18:42'),
(97, 8, 11, '2020-03-28 06:59:52', '2020-03-28 06:59:52'),
(98, 8, 12, '2020-03-28 06:59:52', '2020-03-28 06:59:52'),
(123, 7, 8, '2020-03-30 00:11:57', '2020-03-30 00:11:57'),
(124, 7, 9, '2020-03-30 00:11:57', '2020-03-30 00:11:57'),
(125, 7, 10, '2020-03-30 00:11:57', '2020-03-30 00:11:57'),
(126, 11, 8, '2020-03-30 00:49:59', '2020-03-30 00:49:59');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_hours`
--

CREATE TABLE `restaurant_hours` (
  `id` int(255) NOT NULL,
  `restaurant_id` int(255) NOT NULL,
  `hour_id` int(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurant_hours`
--

INSERT INTO `restaurant_hours` (`id`, `restaurant_id`, `hour_id`, `updated_at`, `created_at`) VALUES
(0, 1, 11, '2020-03-24 07:16:32', '2020-03-24 07:16:32'),
(0, 2, 11, '2020-03-24 07:32:23', '2020-03-24 07:32:23'),
(0, 3, 11, '2020-03-24 07:41:38', '2020-03-24 07:41:38'),
(0, 4, 11, '2020-03-24 07:42:36', '2020-03-24 07:42:36'),
(0, 5, 11, '2020-03-24 07:42:48', '2020-03-24 07:42:48'),
(0, 6, 11, '2020-03-24 07:43:26', '2020-03-24 07:43:26'),
(0, 10, 11, '2020-03-28 06:18:42', '2020-03-28 06:18:42'),
(0, 9, 11, '2020-03-28 06:21:08', '2020-03-28 06:21:08'),
(0, 9, 13, '2020-03-28 06:21:08', '2020-03-28 06:21:08'),
(0, 9, 14, '2020-03-28 06:21:08', '2020-03-28 06:21:08'),
(0, 9, 15, '2020-03-28 06:21:08', '2020-03-28 06:21:08'),
(0, 8, 11, '2020-03-28 06:59:52', '2020-03-28 06:59:52'),
(0, 8, 13, '2020-03-28 06:59:52', '2020-03-28 06:59:52'),
(0, 8, 14, '2020-03-28 06:59:52', '2020-03-28 06:59:52'),
(0, 7, 13, '2020-03-30 00:11:56', '2020-03-30 00:11:56'),
(0, 7, 14, '2020-03-30 00:11:57', '2020-03-30 00:11:57'),
(0, 7, 15, '2020-03-30 00:11:57', '2020-03-30 00:11:57'),
(0, 7, 16, '2020-03-30 00:11:57', '2020-03-30 00:11:57'),
(0, 11, 11, '2020-03-30 00:49:59', '2020-03-30 00:49:59');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_images`
--

CREATE TABLE `restaurant_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `restaurant_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant_images`
--

INSERT INTO `restaurant_images` (`id`, `restaurant_id`, `image`, `created_at`, `updated_at`) VALUES
(10, '1', 'uploads/business/slideshow1.jpg', '2020-03-24 07:16:32', '2020-03-24 07:16:32'),
(11, '2', 'uploads/restaurant/slideshow2.jpg', '2020-03-24 07:32:23', '2020-03-24 07:32:23'),
(12, '3', 'uploads/restaurant/slideshow2.jpg', '2020-03-24 07:41:38', '2020-03-24 07:41:38'),
(13, '4', 'uploads/restaurant/slideshow2.jpg', '2020-03-24 07:42:36', '2020-03-24 07:42:36'),
(14, '5', 'uploads/restaurant/slideshow2.jpg', '2020-03-24 07:42:48', '2020-03-24 07:42:48'),
(15, '6', 'uploads/restaurant/slideshow2.jpg', '2020-03-24 07:43:26', '2020-03-24 07:43:26'),
(16, '7', 'uploads/restaurant/slideshow1.jpg', '2020-03-24 07:55:27', '2020-03-24 07:55:27'),
(17, '7', 'uploads/restaurant/slideshow2.jpg', '2020-03-24 07:55:27', '2020-03-24 07:55:27'),
(18, '8', 'uploads/restaurant/slideshow3.jpg', '2020-03-24 08:05:51', '2020-03-24 08:05:51'),
(19, '9', 'uploads/restaurant/slideshow3.jpg', '2020-03-24 08:09:58', '2020-03-24 08:09:58'),
(20, '10', 'uploads/restaurant/slideshow3.jpg', '2020-03-24 08:10:24', '2020-03-24 08:10:24'),
(21, '11', 'uploads/restaurant/slideshow2.jpg', '2020-03-30 00:49:59', '2020-03-30 00:49:59');

-- --------------------------------------------------------

--
-- Table structure for table `slideshow`
--

CREATE TABLE `slideshow` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slideshow`
--

INSERT INTO `slideshow` (`id`, `title`, `image`, `url`, `status`, `updated_at`, `created_at`) VALUES
(1, 'First Slide', 'uploads/slideshow/slideshow1.jpg', 'http:34234234234234', 1, '2020-03-31 06:54:14', '2020-03-24 00:04:30'),
(3, 'Second Slide', 'uploads/slideshow/slideshow2.jpg', 'http://www.google.com', 1, '2020-04-03 06:39:02', '2020-03-24 00:05:52'),
(4, 'Third', 'uploads/slideshow/slideshow3.jpg', '', 1, '2020-03-31 06:54:31', '2020-03-24 00:08:11'),
(5, 'Fourth', 'uploads/slideshow/slideshow4.jpg', '', 1, '2020-03-31 06:54:32', '2020-03-24 00:08:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `image`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(11, 'Super Admin', 'admin@admin.com', '', '', NULL, 'admin', NULL, '2018-11-14 13:51:58', NULL, 0),
(13, 'Wang', 'Wang@wang.com', '', '', NULL, 'asd', NULL, '2018-11-14 13:51:58', NULL, 3),
(14, 'Sokerrererere', 'sss@sss.com', '', '', NULL, 'ass', NULL, '2018-11-14 06:00:05', '2018-11-14 06:00:05', 3),
(16, 'JinChongIl', 'chong@chong.com', '', '', NULL, 'aaa', NULL, '2018-11-14 06:01:53', '2018-11-14 06:01:53', 2),
(18, 'Mary Rose Barr', 'maryroseb@telus.net', '', '', NULL, 'wilbar5', NULL, '2019-01-01 05:21:40', '2019-01-01 05:21:40', 1),
(27, 'changping, fang', 'kingstarboy@outlook.com', '111111111', 'uploads/user/piggy.png', NULL, 'aaaaaa', NULL, '2020-03-30 04:35:35', '2020-03-30 04:51:19', 3),
(28, 'test', 'test@test.com', '123456', 'uploads/user/logo.png', NULL, 'test', 'ecggAR6eUn8:APA91bFSftbDr7s4MtUTYM7U37RygTBA8IZZRDVpyjd6MM2S6oLVPTONz_DkvZtzvTgJ0c__WH5R7MXwjt5CT3ta', '2020-03-30 04:46:11', '2020-03-30 04:46:11', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facility`
--
ALTER TABLE `facility`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hours`
--
ALTER TABLE `hours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant_categories`
--
ALTER TABLE `restaurant_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant_facility`
--
ALTER TABLE `restaurant_facility`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant_images`
--
ALTER TABLE `restaurant_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slideshow`
--
ALTER TABLE `slideshow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `facility`
--
ALTER TABLE `facility`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `hours`
--
ALTER TABLE `hours`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `restaurant_categories`
--
ALTER TABLE `restaurant_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `restaurant_facility`
--
ALTER TABLE `restaurant_facility`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `restaurant_images`
--
ALTER TABLE `restaurant_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `slideshow`
--
ALTER TABLE `slideshow`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
