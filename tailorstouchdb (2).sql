-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2025 at 04:34 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tailorstouchdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `customize`
--

CREATE TABLE `customize` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `delivery_option` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customize`
--

INSERT INTO `customize` (`id`, `user_id`, `order_id`, `description`, `image_path`, `delivery_option`, `created_at`) VALUES
(1, 5, NULL, 'no buttons', '', 'delivery', '2025-06-18 15:13:13'),
(2, 1, NULL, 'asfgfjhkjlkl;', 'uploads/1750259829_s1.png', 'pickup', '2025-06-18 15:17:09'),
(3, 1, NULL, 'no buttons', 'uploads/1750309756_blouse_blue.png', 'pickup', '2025-06-19 05:09:16'),
(4, 1, NULL, 'dfrbgxtfh', 'uploads/1750310412_ChatGPT Image Jun 18, 2025, 12_39_41 PM.png', 'pickup', '2025-06-19 05:20:12'),
(5, 1, NULL, 'affv', 'uploads/1750313335_kurtha_pink.png', 'pickup', '2025-06-19 06:08:55'),
(6, 1, NULL, 'ascsc', '', 'delivery', '2025-06-19 06:28:07');

-- --------------------------------------------------------

--
-- Table structure for table `homevisits`
--

CREATE TABLE `homevisits` (
  `visit_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `time_slot` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `visit_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `homevisits`
--

INSERT INTO `homevisits` (`visit_id`, `user_id`, `gender`, `time_slot`, `address`, `visit_date`) VALUES
(1, 5, 'Female', 'Afternoon (12PM-4PM)', 'kodikere', '2025-06-15 20:23:15'),
(2, 5, 'Female', 'Evening (4PM-8PM)', 'kulai', '2025-06-18 20:41:33'),
(3, 5, 'Female', 'Evening (4PM-8PM)', 'kulai', '2025-06-18 20:42:47'),
(4, 1, 'Female', 'Afternoon (12PM-4PM)', 'kulai', '2025-06-18 20:46:51'),
(5, 1, 'Male', 'Morning (8AM-12PM)', 'kulai', '2025-06-19 10:27:30'),
(6, 1, 'Female', 'Evening (4PM-8PM)', 'kulai', '2025-06-19 10:39:00'),
(7, 1, 'Female', 'Evening (4PM-8PM)', 'kulai', '2025-06-19 10:47:30'),
(8, 1, 'Female', 'Afternoon (12PM-4PM)', 'kulai', '2025-06-19 11:57:38');

-- --------------------------------------------------------

--
-- Table structure for table `measurements`
--

CREATE TABLE `measurements` (
  `measurement_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `waist` decimal(10,2) DEFAULT NULL,
  `bust` decimal(10,2) DEFAULT NULL,
  `chest` decimal(10,2) DEFAULT NULL,
  `hip` decimal(10,2) DEFAULT NULL,
  `shoulder` decimal(10,2) DEFAULT NULL,
  `blouse_length` decimal(10,2) DEFAULT NULL,
  `sleeve_fit` decimal(10,2) DEFAULT NULL,
  `sleeve_length` decimal(10,2) DEFAULT NULL,
  `front_deep` decimal(10,2) DEFAULT NULL,
  `back_deep` decimal(10,2) DEFAULT NULL,
  `up_tucks` decimal(10,2) DEFAULT NULL,
  `down_tucks` decimal(10,2) DEFAULT NULL,
  `armhole` decimal(10,2) DEFAULT NULL,
  `flayer` decimal(10,2) DEFAULT NULL,
  `pant_length` decimal(10,2) DEFAULT NULL,
  `kurtha_length` decimal(10,2) DEFAULT NULL,
  `gown_length` decimal(10,2) DEFAULT NULL,
  `frock_length` decimal(10,2) DEFAULT NULL,
  `hip_length_slit` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `measurements`
--

INSERT INTO `measurements` (`measurement_id`, `order_id`, `waist`, `bust`, `chest`, `hip`, `shoulder`, `blouse_length`, `sleeve_fit`, `sleeve_length`, `front_deep`, `back_deep`, `up_tucks`, `down_tucks`, `armhole`, `flayer`, `pant_length`, `kurtha_length`, `gown_length`, `frock_length`, `hip_length_slit`) VALUES
(92, 5, 7.00, 0.00, 25.00, 12.00, 35.00, NULL, 21.00, 17.00, 31.00, 21.00, NULL, NULL, 10.00, NULL, NULL, NULL, 0.00, NULL, NULL),
(93, 5, 12.00, 13.00, 10.00, 12.00, 12.00, NULL, 8.00, 9.00, 0.00, 0.00, NULL, NULL, 7.00, NULL, NULL, NULL, 0.00, NULL, NULL),
(94, 16, 7.00, 0.00, 25.00, 12.00, 35.00, NULL, 21.00, 17.00, 31.00, 21.00, NULL, NULL, 10.00, NULL, NULL, NULL, 0.00, NULL, NULL),
(95, 16, 7.00, 0.00, 25.00, 12.00, 35.00, NULL, 21.00, 17.00, 31.00, 21.00, NULL, NULL, 10.00, NULL, NULL, NULL, 0.00, NULL, NULL),
(96, 17, 12.00, 13.00, 10.00, 12.00, 12.00, NULL, 8.00, 9.00, 0.00, 0.00, NULL, NULL, 7.00, NULL, NULL, NULL, 0.00, NULL, NULL),
(109, 30, 12.00, 1.00, 1.00, 1.00, 1.00, NULL, 1.00, 1.00, NULL, NULL, NULL, NULL, 1.00, NULL, NULL, NULL, NULL, 1.00, NULL),
(110, 75, 2.00, 13.00, 12.00, NULL, 2.00, 2.00, 2.00, 2.00, 2.00, 2.00, 2.00, 2.00, 2.00, NULL, NULL, NULL, NULL, NULL, NULL),
(111, 77, 12.00, NULL, 23.00, 12.00, 23.00, NULL, 13.00, 31.00, 31.00, 31.00, NULL, NULL, 13.00, 34.00, 14.00, NULL, NULL, NULL, 22.00),
(112, 81, 12.00, NULL, 23.00, 12.00, 23.00, NULL, 13.00, 31.00, 31.00, 31.00, NULL, NULL, 13.00, 34.00, 14.00, NULL, NULL, NULL, 22.00),
(113, 93, 32.00, NULL, 4.00, 4.00, 4.00, NULL, 4.00, 4.00, 4.00, 4.00, NULL, NULL, 4.00, 4.00, NULL, 444.00, NULL, NULL, 4.00),
(114, 103, 12.00, 2.00, 2.00, 2.00, 2.00, NULL, 2.00, 2.00, 2.00, 2.00, NULL, NULL, 2.00, NULL, NULL, NULL, 2.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `trend` varchar(50) NOT NULL,
  `material` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `measurement_option` enum('provide','homeVisit') NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `category`, `trend`, `material`, `color`, `measurement_option`, `order_date`, `user_id`) VALUES
(2, 'ladies', 'Salwar', 'Georgette', '', 'provide', '2025-03-27 17:09:31', NULL),
(3, 'kids', 'Frock', 'Denim', '', 'homeVisit', '2025-03-27 17:10:38', NULL),
(4, 'ladies', 'Kurtha', 'Rayon', '', 'provide', '2025-03-27 17:14:20', NULL),
(5, 'kids', 'Gown', 'Satin', '', 'provide', '2025-03-27 17:19:16', NULL),
(6, 'ladies', 'Kurtha', 'Linen', '', 'provide', '2025-04-06 09:31:31', NULL),
(7, 'ladies', 'Kurtha', 'Linen', '', 'provide', '2025-04-06 09:35:57', NULL),
(8, 'ladies', 'Kurtha', 'Linen', '', 'provide', '2025-04-06 09:39:17', NULL),
(9, 'ladies', 'Kurtha', 'Linen', '', 'provide', '2025-04-06 09:42:09', NULL),
(10, 'ladies', 'Salwar', 'Chiffon', '', 'provide', '2025-04-06 09:44:14', NULL),
(11, 'ladies', 'Kurtha', 'Linen', '', 'provide', '2025-04-06 09:47:17', NULL),
(12, 'ladies', 'Kurtha', 'Linen', '', 'provide', '2025-04-06 09:47:44', NULL),
(13, 'ladies', 'Kurtha', 'Linen', '', 'provide', '2025-04-07 17:22:47', NULL),
(14, 'ladies', 'Kurtha', 'Linen', '', 'provide', '2025-04-07 17:30:55', NULL),
(15, 'ladies', 'Kurtha', 'Linen', '', 'provide', '2025-04-09 14:18:57', NULL),
(16, 'ladies', 'Kurtha', 'Linen', '', 'provide', '2025-04-09 14:28:05', NULL),
(17, 'kids', 'Frock', 'Net', '', 'provide', '2025-04-09 14:49:59', NULL),
(18, 'ladies', 'Kurtha', 'Cotton', '', 'provide', '2025-04-09 14:57:10', NULL),
(27, 'ladies', 'Kurtha', 'Cotton', '', 'homeVisit', '2025-04-17 14:04:12', 5),
(30, 'kids', 'Frock', 'Denim', '', 'provide', '2025-04-19 14:26:08', 1),
(31, 'ladies', 'Blouse', 'Cotton', '', 'provide', '2025-04-21 15:46:41', 1),
(32, 'ladies', 'Blouse', 'Cotton', '', 'provide', '2025-04-21 17:02:26', 1),
(33, 'ladies', 'Blouse', 'Cotton', '', 'provide', '2025-04-22 06:59:05', 1),
(34, 'ladies', 'Blouse', 'Cotton', '', 'homeVisit', '2025-04-22 08:15:11', 1),
(35, 'ladies', 'Blouse', 'Cotton', '', 'provide', '2025-04-22 13:03:49', 1),
(36, 'ladies', 'Blouse', 'Cotton', '', 'provide', '2025-04-25 13:33:37', 1),
(37, 'ladies', 'Blouse', 'Cotton', '', 'provide', '2025-04-26 06:09:41', 1),
(38, 'ladies', 'Salwar', 'Georgette', '', 'provide', '2025-04-26 06:26:26', 1),
(39, 'ladies', 'Blouse', 'Cotton', '', 'provide', '2025-04-26 06:38:53', 5),
(40, 'ladies', 'Salwar', 'Georgette', '', 'provide', '2025-04-26 07:13:19', 5),
(41, 'ladies', 'Blouse', 'Cotton', '', 'provide', '2025-04-26 07:13:43', 5),
(42, 'ladies', 'Blouse', 'Cotton', '', 'provide', '2025-04-26 07:15:16', 5),
(43, 'ladies', 'Blouse', 'Cotton', '', 'provide', '2025-04-26 07:23:05', 5),
(44, 'ladies', 'Blouse', 'Cotton', '', 'provide', '2025-04-26 15:14:28', 5),
(45, 'ladies', 'Blouse', 'Cotton', '', 'provide', '2025-04-27 13:54:25', 5),
(46, 'ladies', 'Blouse', 'Cotton', '', 'provide', '2025-04-27 14:14:30', 5),
(47, 'ladies', 'Blouse', 'Cotton', '', 'provide', '2025-04-29 04:34:07', 5),
(48, 'ladies', 'Kurtha', 'Linen', '', 'homeVisit', '2025-04-29 05:24:21', 5),
(49, 'ladies', 'Kurtha', 'Linen', '', 'homeVisit', '2025-04-29 06:48:48', 5),
(50, 'ladies', 'Kurtha', 'Linen', '', 'provide', '2025-04-29 06:53:59', 5),
(51, 'ladies', 'Blouse', 'Cotton', '', 'provide', '2025-05-08 13:09:46', 5),
(52, 'ladies', 'Blouse', 'Cotton', '', 'provide', '2025-05-08 13:14:52', 5),
(53, 'ladies', 'Gown', 'Silk', '', 'provide', '2025-05-08 15:21:15', 5),
(54, 'ladies', 'Blouse', 'Cotton', '', 'provide', '2025-05-08 15:29:02', 5),
(55, 'ladies', 'Blouse', 'Cotton', '', 'provide', '2025-05-09 05:09:01', 5),
(56, 'ladies', 'Blouse', 'Cotton', '', 'provide', '2025-05-09 09:28:30', 5),
(57, 'ladies', 'Blouse', 'Cotton', '', 'provide', '2025-05-09 15:00:31', 1),
(58, 'ladies', 'Blouse', 'Cotton', '', 'provide', '2025-05-10 13:06:39', 1),
(59, 'ladies', 'Salwar', 'Georgette', '', 'homeVisit', '2025-05-11 06:51:04', 1),
(60, 'ladies', 'Salwar', 'Georgette', '', 'homeVisit', '2025-05-11 06:51:47', 1),
(61, 'ladies', 'Blouse', 'Cotton', '', 'provide', '2025-05-11 07:17:12', 1),
(62, 'ladies', 'Blouse', 'Cotton', '', 'homeVisit', '2025-05-11 07:17:15', 1),
(64, 'ladies', 'Kurtha', 'Linen', '', 'provide', '2025-05-11 16:48:31', 1),
(65, 'ladies', 'Kurtha', 'Rayon', '', 'provide', '2025-05-11 17:20:50', 1),
(66, 'ladies', 'Kurtha', 'Rayon', '', 'provide', '2025-05-11 17:29:37', 1),
(67, 'ladies', 'Kurtha', 'Linen', '', 'provide', '2025-05-11 17:32:18', 1),
(68, 'ladies', 'Blouse', 'Cotton', '', 'provide', '2025-05-12 07:31:41', 1),
(69, 'ladies', 'Blouse', 'Cotton', '', 'provide', '2025-05-12 08:13:08', 1),
(70, 'kids', 'Frock', 'Denim', '', 'provide', '2025-05-27 14:16:23', 1),
(71, 'ladies', 'Blouse', 'Cotton', '', 'provide', '2025-06-12 14:52:28', 1),
(72, 'ladies', 'Blouse', 'Cotton', '', 'homeVisit', '2025-06-15 14:01:49', 1),
(73, 'ladies', 'Salwar', 'Chiffon', '', 'homeVisit', '2025-06-15 14:40:24', 5),
(74, 'ladies', 'Blouse', 'Cotton', '', 'homeVisit', '2025-06-15 14:47:08', 5),
(75, 'ladies', 'Blouse', 'Cotton', '', 'provide', '2025-06-15 14:58:05', 5),
(76, 'ladies', 'Blouse', 'Cotton', '', 'provide', '2025-06-15 15:03:20', 5),
(77, 'ladies', 'Salwar', 'Chiffon', '', 'provide', '2025-06-18 10:02:59', 5),
(78, 'ladies', 'Salwar', 'Chiffon', '', 'provide', '2025-06-18 10:03:51', 5),
(79, 'ladies', 'Salwar', 'Chiffon', '', 'homeVisit', '2025-06-18 10:03:57', 5),
(80, 'ladies', 'Salwar', 'Chiffon', '', 'homeVisit', '2025-06-18 10:04:08', 5),
(81, 'ladies', 'Salwar', 'Chiffon', '', 'provide', '2025-06-18 10:05:02', 5),
(82, 'ladies', 'Blouse', 'Cotton', 'Blue', 'provide', '2025-06-18 14:54:28', 5),
(83, 'ladies', 'Blouse', 'Silk', 'Cream', 'provide', '2025-06-18 14:59:54', 5),
(84, 'ladies', 'Blouse', 'Cotton', 'Red', 'provide', '2025-06-18 15:11:07', 5),
(85, 'ladies', 'Blouse', 'Cotton', 'Red', 'homeVisit', '2025-06-18 15:11:14', 5),
(86, 'ladies', 'Blouse', 'Cotton', 'Cream', 'provide', '2025-06-18 15:16:18', 1),
(87, 'kids', 'Frock', 'Cotton', 'Blue', 'homeVisit', '2025-06-18 15:16:40', 1),
(88, 'ladies', 'Blouse', 'Cotton', 'Cream', 'homeVisit', '2025-06-19 04:57:20', 1),
(89, 'ladies', 'Blouse', 'Cotton', 'Blue', 'homeVisit', '2025-06-19 05:08:50', 1),
(90, 'kids', 'Frock', 'Cotton', 'White', 'homeVisit', '2025-06-19 05:17:22', 1),
(91, 'ladies', 'Blouse', 'Cotton', 'Blue', 'homeVisit', '2025-06-19 05:50:28', 1),
(92, 'ladies', 'Kurtha', 'Silk', 'Pink', 'homeVisit', '2025-06-19 06:06:07', 1),
(93, 'ladies', 'Kurtha', 'Silk', 'Pink', 'provide', '2025-06-19 06:06:13', 1),
(94, 'kids', 'Frock', 'Cotton', 'White', 'provide', '2025-06-19 06:11:19', 1),
(95, 'kids', 'Skirt', 'Georgette', 'Black', 'provide', '2025-06-19 06:13:10', 1),
(96, 'kids', 'Skirt', 'Georgette', 'Red', 'provide', '2025-06-19 06:14:15', 1),
(97, 'kids', 'Skirt', 'Georgette', 'Black', 'provide', '2025-06-19 06:15:36', 1),
(98, 'kids', 'Frock', 'Silk', 'Peach', 'homeVisit', '2025-06-19 06:16:30', 1),
(99, 'kids', 'Frock', 'Silk', 'Peach', 'provide', '2025-06-19 06:16:37', 1),
(100, 'kids', 'Skirt', 'Georgette', 'Blue', 'provide', '2025-06-19 06:21:21', 1),
(101, 'kids', 'Skirt', 'Georgette', 'Blue', 'homeVisit', '2025-06-19 06:22:05', 1),
(102, 'kids', 'Skirt', 'Georgette', 'Blue', 'provide', '2025-06-19 06:25:29', 1),
(103, 'kids', 'Gown', 'Georgette', 'Blue', 'provide', '2025-06-19 06:26:15', 1),
(104, 'kids', 'Gown', 'Georgette', 'Blue', 'homeVisit', '2025-06-19 06:27:05', 1),
(105, 'kids', 'Gown', 'Georgette', 'Blue', 'homeVisit', '2025-06-19 06:27:27', 1),
(106, 'kids', 'Skirt', 'Georgette', 'Blue', 'provide', '2025-06-19 06:29:11', 1),
(107, 'kids', 'Skirt', 'Georgette', 'Pink', 'provide', '2025-06-19 06:32:21', 1),
(108, 'kids', 'Skirt', 'Georgette', 'Blue', 'provide', '2025-06-19 06:35:06', 1),
(109, 'ladies', 'Frock', 'Georgette', 'Purple', 'provide', '2025-06-19 06:36:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`full_name`, `email`, `password`, `address`, `phone`, `user_id`) VALUES
('nisha', 'nisha@gmail.com', '1718', 'kulai', '2147483647', 1),
('tanisha', 'tani123@gmail.com', '2210', 'shivaji circle', '8945671234', 3),
('hrithik', 'hrithik@gmail.com', '1122', 'kodikere', '9108850771', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customize`
--
ALTER TABLE `customize`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_customize_order` (`order_id`);

--
-- Indexes for table `homevisits`
--
ALTER TABLE `homevisits`
  ADD PRIMARY KEY (`visit_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `measurements`
--
ALTER TABLE `measurements`
  ADD PRIMARY KEY (`measurement_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_orders_user` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customize`
--
ALTER TABLE `customize`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `homevisits`
--
ALTER TABLE `homevisits`
  MODIFY `visit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `measurements`
--
ALTER TABLE `measurements`
  MODIFY `measurement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customize`
--
ALTER TABLE `customize`
  ADD CONSTRAINT `customize_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_customize_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;

--
-- Constraints for table `homevisits`
--
ALTER TABLE `homevisits`
  ADD CONSTRAINT `homevisits_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `measurements`
--
ALTER TABLE `measurements`
  ADD CONSTRAINT `measurements_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
