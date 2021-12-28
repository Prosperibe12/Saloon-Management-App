-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2021 at 12:25 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saloonapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `role_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(123) NOT NULL,
  `role_name` enum('admin','superadmin','','') NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` enum('active','inactive','','') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`role_id`, `fullname`, `email`, `role_name`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Prosper Ibe', 'Prosperibe12@gmail.com', 'superadmin', '25f9e794323b453885f5181f1b624d0b', 'active', '2021-12-03 01:28:24', '2021-12-03 04:28:24');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `saloon_id` int(11) NOT NULL,
  `service_type` varchar(100) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `booking_time` time NOT NULL,
  `booking_date` date NOT NULL,
  `booking_status` enum('pending','confirmed','','') NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `customer_id`, `saloon_id`, `service_type`, `customer_email`, `booking_time`, `booking_date`, `booking_status`, `created_at`, `updated_at`) VALUES
(1, NULL, 0, 'Make up', '2021-12-07', '14:09:00', '0000-00-00', 'pending', '2021-12-05 10:05:46', '2021-12-05 13:05:46'),
(2, NULL, 2, 'Nail services', 'vivian@gmail.com', '13:23:00', '2021-12-07', 'confirmed', '2021-12-05 10:20:09', '2021-12-05 21:03:09'),
(5, NULL, 1, 'Spa services', 'user1@gmail.com', '13:07:00', '2021-12-07', 'confirmed', '2021-12-05 11:05:50', '2021-12-05 20:58:58'),
(8, NULL, 1, 'Spa services', 'vivian@gmail.com', '09:02:00', '2021-12-08', 'confirmed', '2021-12-06 08:16:09', '2021-12-12 14:47:47'),
(9, NULL, 3, 'Hair Cut', 'vivian@gmail.com', '23:48:00', '2021-12-08', 'confirmed', '2021-12-07 09:46:19', '2021-12-07 13:53:59'),
(10, NULL, 3, 'Dreadlocks', 'vivian@gmail.com', '11:50:00', '2021-12-08', 'confirmed', '2021-12-07 09:48:07', '2021-12-13 13:12:06'),
(11, NULL, 1, 'Spa services', 'vivian@gmail.com', '12:00:00', '2021-12-09', 'confirmed', '2021-12-07 09:55:30', '2021-12-15 21:04:40'),
(12, NULL, 1, 'Hair Design', 'vivian@gmail.com', '00:29:00', '2021-12-09', 'pending', '2021-12-08 09:26:45', '2021-12-08 12:26:45'),
(13, NULL, 4, 'Hair Design', 'user1@gmail.com', '19:02:00', '2021-12-09', 'confirmed', '2021-12-08 16:59:22', '2021-12-16 05:45:45'),
(14, 1, 4, 'Hair Design', 'vivian@gmail.com', '12:24:00', '2021-12-11', 'confirmed', '2021-12-09 09:21:58', '2021-12-16 05:46:00'),
(15, 2, 3, 'Dreadlocks', 'user1@gmail.com', '17:46:00', '2021-12-10', 'confirmed', '2021-12-09 14:43:27', '2021-12-14 07:15:11'),
(16, 2, 3, 'Dreadlocks', 'user1@gmail.com', '18:50:00', '2021-12-11', 'confirmed', '2021-12-09 14:47:02', '2021-12-14 07:15:29'),
(17, 2, 2, 'Make up', 'user1@gmail.com', '09:11:00', '2021-12-12', 'pending', '2021-12-09 17:07:07', '2021-12-09 20:07:07'),
(18, 2, 4, 'Nail services', 'user1@gmail.com', '21:04:00', '2021-12-11', 'pending', '2021-12-10 07:02:17', '2021-12-10 10:02:17'),
(19, 2, 4, 'Nail services', 'user1@gmail.com', '21:07:00', '2021-12-16', 'pending', '2021-12-10 07:05:12', '2021-12-10 10:05:12'),
(20, 2, 4, 'Hair Design', 'user1@gmail.com', '13:40:00', '2021-12-13', 'pending', '2021-12-11 11:38:12', '2021-12-11 14:38:12'),
(21, 2, 2, 'Nail services', 'user1@gmail.com', '13:45:00', '2021-12-15', 'pending', '2021-12-11 11:43:18', '2021-12-11 14:43:18'),
(22, 1, 3, 'Hair Cut', 'vivian@gmail.com', '07:56:00', '2021-12-13', 'pending', '2021-12-11 15:52:31', '2021-12-11 18:52:31'),
(23, 2, 2, 'Spa services', 'user1@gmail.com', '09:10:00', '2021-12-13', 'pending', '2021-12-11 18:07:29', '2021-12-11 21:07:29'),
(24, 2, 2, 'Nail services', 'user1@gmail.com', '21:34:00', '2021-12-13', 'pending', '2021-12-11 18:31:19', '2021-12-11 21:31:19'),
(25, 2, 3, 'Hair Cut', 'user1@gmail.com', '09:15:00', '2021-12-14', 'pending', '2021-12-12 17:11:20', '2021-12-12 20:11:20'),
(26, 1, 4, 'Nail services', 'vivian@gmail.com', '10:15:00', '2021-12-14', 'pending', '2021-12-13 07:12:41', '2021-12-13 10:12:41'),
(27, 3, 2, 'Spa services', 'Ifeatuibe932@gmail.com', '02:51:00', '2021-12-14', 'pending', '2021-12-13 10:47:34', '2021-12-13 13:47:34'),
(28, 3, 4, 'Hair Design', 'Ifeatuibe932@gmail.com', '07:02:00', '2021-12-15', 'confirmed', '2021-12-14 03:58:21', '2021-12-16 06:53:06'),
(29, 3, 2, 'Nail services', 'Ifeatuibe932@gmail.com', '16:09:00', '2021-12-22', 'pending', '2021-12-14 04:09:51', '2021-12-14 07:09:51'),
(30, 3, 1, 'Make up', 'Ifeatuibe932@gmail.com', '18:16:00', '2021-12-16', 'pending', '2021-12-14 04:16:02', '2021-12-14 07:16:02'),
(31, 1, 3, 'Dreadlocks', 'vivian@gmail.com', '11:40:00', '2021-12-20', 'pending', '2021-12-18 17:22:48', '2021-12-18 20:22:48');

-- --------------------------------------------------------

--
-- Table structure for table `cashpayment`
--

CREATE TABLE `cashpayment` (
  `payment_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `saloon_id` int(11) NOT NULL,
  `service_type` varchar(100) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `customer_email` varchar(120) NOT NULL,
  `payment_mode` enum('paystack','cashpay','','') NOT NULL DEFAULT 'cashpay',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cashpayment`
--

INSERT INTO `cashpayment` (`payment_id`, `booking_id`, `saloon_id`, `service_type`, `price`, `customer_email`, `payment_mode`, `created_at`, `updated_at`) VALUES
(1, 25, 3, 'Hair Cut', '5.00', 'user1@gmail.com', 'cashpay', '2021-12-13 07:09:49', '2021-12-13 10:09:49'),
(2, 25, 3, 'Hair Cut', '5.00', 'user1@gmail.com', 'cashpay', '2021-12-13 07:11:31', '2021-12-13 10:11:31'),
(3, 26, 4, 'Nail services', '5.00', 'vivian@gmail.com', 'cashpay', '2021-12-13 07:12:51', '2021-12-13 10:12:51'),
(4, 29, 2, 'Nail services', '7.00', 'Ifeatuibe932@gmail.com', 'cashpay', '2021-12-14 04:10:14', '2021-12-14 07:10:14'),
(5, 30, 1, 'Make up', '5.00', 'Ifeatuibe932@gmail.com', 'cashpay', '2021-12-14 04:16:09', '2021-12-14 07:16:09');

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(123) NOT NULL,
  `customer_address` varchar(150) NOT NULL,
  `customer_tel` varchar(50) NOT NULL,
  `password` varchar(123) NOT NULL,
  `account_status` enum('active','inactive','','') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`customer_id`, `customer_name`, `customer_email`, `customer_address`, `customer_tel`, `password`, `account_status`, `created_at`, `updated_at`) VALUES
(1, 'Vivian Ibe', 'vivian@gmail.com', '21 Okwelle Street, diobu, Port Harcourt', '08084472796', '25f9e794323b453885f5181f1b624d0b', 'active', '2021-12-03 02:21:25', '2021-12-03 05:21:25'),
(2, 'Oyekunbi Adams', 'user1@gmail.com', 'Asokoro Drive, Abuja', '09383846382', '25f9e794323b453885f5181f1b624d0b', 'active', '2021-12-05 11:04:28', '2021-12-05 14:04:28'),
(3, 'Chibuike Okafor', 'Ifeatuibe932@gmail.com', '21 Jakende Estate, Isolo, Lagos', '07031465663', '25f9e794323b453885f5181f1b624d0b', 'active', '2021-12-13 10:45:54', '2021-12-13 13:45:54');

-- --------------------------------------------------------

--
-- Table structure for table `onlinpayment_ref`
--

CREATE TABLE `onlinpayment_ref` (
  `online_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `service_type` varchar(100) NOT NULL,
  `datepaid` datetime NOT NULL,
  `payment_mode` enum('paystack','flutter','','') NOT NULL,
  `transref` varchar(123) NOT NULL,
  `status` enum('pending','completed','','') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `onlinpayment_ref`
--

INSERT INTO `onlinpayment_ref` (`online_id`, `booking_id`, `customer_email`, `amount`, `service_type`, `datepaid`, `payment_mode`, `transref`, `status`, `created_at`, `updated_at`) VALUES
(1, 27, 'Ifeatuibe932@gmail.com', '7.00', 'Spa services', '2021-12-13 10:40:54', 'paystack', 'IPI16394316541638448491', 'pending', '2021-12-13 18:40:54', '2021-12-13 21:40:54'),
(2, 27, 'Ifeatuibe932@gmail.com', '7.00', 'Spa services', '2021-12-13 10:42:24', 'paystack', 'IPI16394317431889525938', 'pending', '2021-12-13 18:42:24', '2021-12-13 21:42:24'),
(3, 27, 'Ifeatuibe932@gmail.com', '7.00', 'Spa services', '2021-12-13 10:47:59', 'paystack', 'IPI16394320781456396516', 'pending', '2021-12-13 18:47:59', '2021-12-13 21:47:59'),
(4, 27, 'Ifeatuibe932@gmail.com', '7.00', 'Spa services', '2021-12-13 11:02:30', 'paystack', 'IPI1639432949577855613', 'completed', '2021-12-13 19:02:30', '2021-12-14 06:03:13'),
(5, 28, 'Ifeatuibe932@gmail.com', '5.00', 'Hair Design', '2021-12-14 08:00:45', 'paystack', 'IPI16394652441853460897', 'completed', '2021-12-14 04:00:45', '2021-12-14 07:00:56'),
(6, 31, 'vivian@gmail.com', '5.00', 'Dreadlocks', '2021-12-18 09:23:25', 'paystack', 'IPI1639859004355933291', 'completed', '2021-12-18 17:23:25', '2021-12-18 20:25:57');

-- --------------------------------------------------------

--
-- Table structure for table `saloon_payment`
--

CREATE TABLE `saloon_payment` (
  `payment_id` int(11) NOT NULL,
  `saloon_name` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_year` enum('2021','2022','','') NOT NULL,
  `datepaid` datetime NOT NULL,
  `paymentmode` enum('paystack','advcash','','') NOT NULL,
  `transref` varchar(100) NOT NULL,
  `status` enum('pending','completed','','') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saloon_payment`
--

INSERT INTO `saloon_payment` (`payment_id`, `saloon_name`, `amount`, `payment_year`, `datepaid`, `paymentmode`, `transref`, `status`, `created_at`, `updated_at`) VALUES
(1, 'MaeBae Beauty Lounge', 30000, '2021', '2021-12-07 01:05:03', 'paystack', 'SLN16388787011298333382', 'completed', '2021-12-07 09:05:03', '2021-12-07 12:05:13'),
(2, 'MaeBae Beauty Lounge', 30000, '2021', '2021-12-13 09:20:52', 'paystack', 'SLN16393836521953396233', 'pending', '2021-12-13 05:20:52', '2021-12-13 08:20:52'),
(3, 'First Class Cutz', 30000, '2021', '2021-12-13 02:11:14', 'paystack', 'SLN16394010731102149607', 'completed', '2021-12-13 10:11:14', '2021-12-13 13:11:28');

-- --------------------------------------------------------

--
-- Table structure for table `saloon_spa`
--

CREATE TABLE `saloon_spa` (
  `saloon_id` int(11) NOT NULL,
  `saloon_name` varchar(100) NOT NULL,
  `saloon_email` varchar(100) NOT NULL,
  `saloon_telephone` varchar(150) NOT NULL,
  `saloon_address` varchar(150) NOT NULL,
  `saloon_password` varchar(123) NOT NULL,
  `saloon_image` varchar(200) NOT NULL,
  `account_status` enum('active','inactive','','') NOT NULL DEFAULT 'active',
  `category` enum('men','women','','') DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saloon_spa`
--

INSERT INTO `saloon_spa` (`saloon_id`, `saloon_name`, `saloon_email`, `saloon_telephone`, `saloon_address`, `saloon_password`, `saloon_image`, `account_status`, `category`, `created_at`, `updated_at`) VALUES
(1, 'MaeBae Beauty Lounge', 'Pipejeezy@gmail.com', '07066835843', 'Uniport Junction, Choba, Port Harcourt.', '25f9e794323b453885f5181f1b624d0b', '16385065361148635391.jpg', 'active', 'women', '2021-12-03 01:24:18', '2021-12-20 08:34:51'),
(2, 'Unisex Saloon', 'unisex@gmail.com', '08067116843', 'Opebi, Ikeja, Lagos', '25f9e794323b453885f5181f1b624d0b', '16385068241428619947.png', 'active', 'women', '2021-12-03 01:46:24', '2021-12-20 08:35:03'),
(3, 'First Class Cutz', 'firstclasscut@gmail.com', '09124595730', 'Asokoro Drive, Abuja', '25f9e794323b453885f5181f1b624d0b', '16385079841410820852.jpg', 'active', 'men', '2021-12-03 02:04:39', '2021-12-20 08:35:10'),
(4, 'Oma Beauty Palace', 'oma@gmail.com', '09183374464', 'Victoria Island, Lagos', '25f9e794323b453885f5181f1b624d0b', '16385084641004983841.png', 'active', 'women', '2021-12-03 02:13:27', '2021-12-20 08:35:16');

-- --------------------------------------------------------

--
-- Table structure for table `servicetable`
--

CREATE TABLE `servicetable` (
  `no` int(11) NOT NULL,
  `service_id` varchar(100) NOT NULL,
  `service_type` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `servicetable`
--

INSERT INTO `servicetable` (`no`, `service_id`, `service_type`, `created_at`) VALUES
(1, '101', 'Hair Design', '2021-12-03 01:29:49'),
(2, '102', 'Spa services', '2021-12-03 01:30:27'),
(3, '103', 'Hair Cut', '2021-12-03 01:31:38'),
(4, '104', 'Nail services', '2021-12-03 01:32:06'),
(5, '105', 'Touch ups', '2021-12-03 01:34:25'),
(6, '106', 'Make up', '2021-12-03 01:34:45'),
(7, '107', 'Blade Shave', '2021-12-04 12:36:38'),
(8, '108', 'Dreadlocks', '2021-12-04 12:38:43'),
(9, '109', 'Hair Straightening', '2021-12-17 11:49:20'),
(10, '110', 'Hair Styling', '2021-12-17 11:51:12'),
(11, '111', 'Hair Dyeing', '2021-12-17 11:51:49');

-- --------------------------------------------------------

--
-- Table structure for table `spa_services`
--

CREATE TABLE `spa_services` (
  `service_no` int(11) NOT NULL,
  `saloon_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `service_desc` text NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `service_status` enum('active','inactive','','') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `spa_services`
--

INSERT INTO `spa_services` (`service_no`, `saloon_id`, `service_id`, `service_desc`, `price`, `service_status`, `created_at`, `updated_at`) VALUES
(1, 1, 101, 'Dream your hair design and we will make your dream come true. Hair design that brings the elegance, confidence in you, are offered in our service.', '5.00', 'active', '2021-12-03 01:38:47', '2021-12-03 04:38:47'),
(2, 1, 102, 'Get yourself relaxed with our spa service. Great spa manicures and pedicures, massages, facials body treatments like exfoliation are available for you.', '10.00', 'active', '2021-12-03 01:40:19', '2021-12-03 04:40:19'),
(3, 1, 104, 'Want to have you nails done! This service will provide you manicures, pedicures, and nail enhancements.', '4.00', 'active', '2021-12-03 01:41:16', '2021-12-03 04:41:16'),
(4, 1, 106, 'Get yourself an attractive make by professionals. Here presenting the service calendar. Book a date and get a make up service.', '6.00', 'active', '2021-12-03 01:44:43', '2021-12-03 04:44:43'),
(5, 2, 106, 'Makeup covers all the flaws of your skin and helps to boost your confidence. ... So, women who tend to complex about their acne or spots on the skin, feel very comfortable and confident by wearing makeup. Enhance Your Natural Beauty: Wearing makeup is the best way to enhance your natural beauty.', '7.00', 'active', '2021-12-03 01:53:41', '2021-12-03 04:53:41'),
(6, 2, 104, 'Pamper yourself at these ultimate salons & spas. Get nail extensions & nail art done from professionals with the help of this list of top places!', '4.00', 'active', '2021-12-03 01:54:52', '2021-12-03 04:54:52'),
(7, 2, 102, 'Reduced stress, anxiety and depression with massage and get complete Relaxation & Freshness & improve sleep.....we are providing all type of massage like 1) Head massage 2) Shoulder & both hand massage 3) Both legs & foot massage 4) Back & Front full body massage 5) Sensual massage.', '15.00', 'active', '2021-12-03 01:56:11', '2021-12-03 04:56:11'),
(8, 3, 103, 'Hair style plays a very important part in making our style statement.Nowadays, not only women even men are concerned about their looks and hair styles.They are becoming fashion conscious to look attractive.There are various hairstyles available for men so that they can look best depending on their hair texture and face shape.', '5.00', 'active', '2021-12-03 02:08:01', '2021-12-03 05:08:01'),
(9, 4, 104, 'Pamper yourself at these ultimate salons & spas. Get nail extensions & nail art done from professionals with the help of this list of top places!', '5.00', 'active', '2021-12-03 02:16:03', '2021-12-03 05:16:03'),
(10, 4, 101, 'We have a line of hair treatments designed exclusively for the benefit of your hair and give you your “dream hairstyle” and give your hair the “dream look”. From untangling your messy hair to mask, deep-condition, streak, dye, style to polish, flatten or curl your hair according to your hair’s need and your requirement.', '8.00', 'active', '2021-12-03 02:19:54', '2021-12-03 05:19:54'),
(11, 3, 108, 'The hair is dreadlocked into individual sections using one of several methods, usually either backcombing, braiding, hand rolling, or locking in the roots.', '10.00', 'active', '2021-12-04 12:41:48', '2021-12-04 15:41:48'),
(12, 2, 103, 'Hair cut plays a very important part in making our style statement. There are various hairstyles available for men so that they can look best depending on their hair texture and face shape.', '5.00', 'active', '2021-12-05 18:08:38', '2021-12-05 21:08:38'),
(13, 4, 111, 'Give your hair a nice color', '5.00', 'active', '2021-12-17 11:52:35', '2021-12-17 14:52:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `cashpayment`
--
ALTER TABLE `cashpayment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_email` (`customer_email`);

--
-- Indexes for table `onlinpayment_ref`
--
ALTER TABLE `onlinpayment_ref`
  ADD PRIMARY KEY (`online_id`);

--
-- Indexes for table `saloon_payment`
--
ALTER TABLE `saloon_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `saloon_spa`
--
ALTER TABLE `saloon_spa`
  ADD PRIMARY KEY (`saloon_id`);

--
-- Indexes for table `servicetable`
--
ALTER TABLE `servicetable`
  ADD PRIMARY KEY (`no`),
  ADD UNIQUE KEY `service_id` (`service_id`);

--
-- Indexes for table `spa_services`
--
ALTER TABLE `spa_services`
  ADD PRIMARY KEY (`service_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `cashpayment`
--
ALTER TABLE `cashpayment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer_details`
--
ALTER TABLE `customer_details`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `onlinpayment_ref`
--
ALTER TABLE `onlinpayment_ref`
  MODIFY `online_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `saloon_payment`
--
ALTER TABLE `saloon_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `saloon_spa`
--
ALTER TABLE `saloon_spa`
  MODIFY `saloon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `servicetable`
--
ALTER TABLE `servicetable`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `spa_services`
--
ALTER TABLE `spa_services`
  MODIFY `service_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer_details` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
