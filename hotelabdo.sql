-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2023 at 09:11 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotelabdo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_panel`
--

CREATE TABLE `admin_panel` (
  `id_admin` int(11) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `admin_password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_panel`
--

INSERT INTO `admin_panel` (`id_admin`, `admin_name`, `admin_password`) VALUES
(1, 'abdelghafour', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `sr_no` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_name` varchar(150) NOT NULL,
  `price` int(11) NOT NULL,
  `total_pay` int(11) NOT NULL,
  `room_no` int(11) DEFAULT NULL,
  `user_name` varchar(150) NOT NULL,
  `phonenum` varchar(150) NOT NULL,
  `adresse` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`sr_no`, `booking_id`, `room_name`, `price`, `total_pay`, `room_no`, `user_name`, `phonenum`, `adresse`) VALUES
(6, 7, 'simple room', 400, 6400, 2, 'Abdelghafour Elouakkassi', '0707893210', 'casablanca tit mellil'),
(9, 10, 'simple room', 400, 5200, 4, 'Abdelghafour Elouakkassi', '0707893210', 'casablanca tit mellil'),
(10, 11, 'deluxe', 5555, 11110, NULL, 'hamid Elouakkassi', '0707893222', 'casablanca tit mellil'),
(11, 12, 'wakasi', 222, 1110, NULL, 'aziz', '0707893210', 'rabat'),
(12, 13, 'simple room', 400, 400, NULL, 'eden hazard', '564892145', 'agdal rabat'),
(13, 14, 'simple room', 400, 400, NULL, 'amal', '564892145', 'agdal rabat'),
(14, 15, 'simple room', 400, 400, 4, 'Abdelghafour', '0707893210', 'tit mellil'),
(15, 16, 'simple room', 500, 500, 2, 'Abdelghafour', '0707893210', 'tit mellil'),
(16, 17, 'deluxe', 1000, 1000, 4, 'Abdelghafour', '0707893210', 'tit mellil');

-- --------------------------------------------------------

--
-- Table structure for table `booking_order`
--

CREATE TABLE `booking_order` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `arrival` int(11) NOT NULL DEFAULT 0,
  `refund` int(11) DEFAULT NULL,
  `booking_status` varchar(150) NOT NULL DEFAULT 'pending',
  `order_id` varchar(150) NOT NULL,
  `trans_id` varchar(200) DEFAULT NULL,
  `trans_amount` int(11) NOT NULL,
  `trans_status` varchar(150) NOT NULL DEFAULT 'pending',
  `trans_resp_msg` varchar(200) DEFAULT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_order`
--

INSERT INTO `booking_order` (`booking_id`, `user_id`, `room_id`, `check_in`, `check_out`, `arrival`, `refund`, `booking_status`, `order_id`, `trans_id`, `trans_amount`, `trans_status`, `trans_resp_msg`, `datentime`) VALUES
(7, 7, 8, '2023-04-12', '2023-04-28', 0, 1, 'cancelled', 'ORD_77231208', NULL, 0, 'pending', NULL, '2023-04-03 09:26:29'),
(10, 7, 8, '2023-04-11', '2023-04-24', 1, NULL, 'pending', 'ORD_72365001', NULL, 0, 'pending', NULL, '2023-04-11 18:41:45'),
(11, 7, 14, '2023-04-13', '2023-04-15', 0, 1, 'cancelled', 'ORD_77141278', NULL, 0, 'pending', NULL, '2023-04-12 12:32:32'),
(12, 7, 15, '2023-04-14', '2023-04-19', 0, 1, 'cancelled', 'ORD_75123825', NULL, 0, 'pending', NULL, '2023-04-14 00:18:56'),
(13, 7, 8, '2023-04-15', '2023-04-16', 0, 1, 'cancelled', 'ORD_76666144', NULL, 0, 'pending', NULL, '2023-04-14 12:38:46'),
(14, 7, 8, '2023-04-16', '2023-04-17', 0, 1, 'cancelled', 'ORD_74801981', NULL, 0, 'pending', NULL, '2023-04-14 12:40:37'),
(15, 7, 8, '2023-04-23', '2023-04-24', 1, NULL, 'pending', 'ORD_71622051', NULL, 0, 'pending', NULL, '2023-04-15 16:34:31'),
(16, 7, 17, '2023-04-15', '2023-04-16', 1, NULL, 'pending', 'ORD_74316054', NULL, 0, 'pending', NULL, '2023-04-15 17:00:55'),
(17, 7, 18, '2023-04-15', '2023-04-16', 1, NULL, 'pending', 'ORD_78019236', NULL, 0, 'pending', NULL, '2023-04-15 17:04:45');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `icon` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `icon`, `name`, `description`) VALUES
(8, 'IMG85180.svg', 'WIFI', 'wifi abdo is the best wifi in the world'),
(10, 'IMG39468.svg', 'tv', 'aeeerrrr'),
(11, 'IMG78142.svg', 'aazaza', 'jjjjj');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`) VALUES
(7, 'hhhhhhh'),
(12, 'abc'),
(13, 'abc'),
(14, 'ok'),
(17, 'lll');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `area` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `adult` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `description` varchar(150) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `removed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `area`, `price`, `quantity`, `adult`, `children`, `description`, `status`, `removed`) VALUES
(1, 'az', 2, 555, 2, 8, 8, 'new room fo childre', 1, 1),
(2, 'lexury', 125, 1000, 222, 2, 2, 'azaezezeaeazea', 1, 1),
(3, 'bad room', 111, 111, 111, 1, 1, 'aaaaa', 1, 1),
(4, 'room', 123, 12, 123, 2, 4, 'kkkkkkkkkkkkkkkkkkkkkkkkkkkkk', 1, 1),
(5, 'er', 123, 888, 45, 5, 4, 'abdo you are the best', 1, 1),
(6, 'MMM', 5656, 12, 45, 66, 99, 'LLLLLLLLLLLLLLLL', 1, 1),
(7, 'simple', 12, 11, 22, 9, 2, ',,,,,,,,,,,,nnnnnnnnnnnnnn', 1, 1),
(8, 'simple room', 123, 400, 50, 3, 2, 'qsdfgtreza', 1, 1),
(9, 'Suprem deluxe room', 120, 1000, 555, 2, 5, 'best room ever', 1, 1),
(10, 'super deluxe', 150, 1000, 400, 4, 5, 'jsjskqskqksqkskqskq', 1, 1),
(11, 'super deluxe', 120, 1522, 889, 2, 6, 'fdfdddddddddddddddddddddddddd', 1, 1),
(12, 'hasani', 12121, 1235, 8888, 22, 22, 'sdsdsdsdzdsdsdsds', 1, 1),
(13, 'aaa', 112, 2, 1, 2, 2, 'hhhfh', 1, 1),
(14, 'deluxe', 123, 5555, 8888, 444, 555, 'fffffffffffffffffffffffffff', 1, 1),
(15, 'wakasi', 1, 222, 12, 2, 2, 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', 1, 0),
(16, 'solid', 22, 1234, 55, 1, 1, 'mmmmmmmmmmmmmmm', 1, 1),
(17, 'simple room', 44, 500, 10, 2, 3, 'best room ever', 1, 0),
(18, 'deluxe', 0, 1000, 1, 2, 3, 'the best room', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `room_facilities`
--

CREATE TABLE `room_facilities` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `facilities_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_facilities`
--

INSERT INTO `room_facilities` (`sr_no`, `room_id`, `facilities_id`) VALUES
(26, 15, 8),
(28, 17, 8),
(29, 17, 10),
(30, 18, 8),
(31, 18, 10);

-- --------------------------------------------------------

--
-- Table structure for table `room_features`
--

CREATE TABLE `room_features` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `features_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_features`
--

INSERT INTO `room_features` (`sr_no`, `room_id`, `features_id`) VALUES
(30, 15, 12),
(31, 15, 13),
(34, 17, 13),
(35, 17, 14),
(36, 17, 17),
(37, 18, 17);

-- --------------------------------------------------------

--
-- Table structure for table `room_images`
--

CREATE TABLE `room_images` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_images`
--

INSERT INTO `room_images` (`sr_no`, `room_id`, `image`, `thumb`) VALUES
(38, 15, 'IMG60541.png', 1),
(40, 17, 'IMG23223.png', 1),
(41, 18, 'IMG55853.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id_settings` int(11) NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id_settings`, `shutdown`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `adresse` varchar(150) NOT NULL,
  `phonenum` varchar(150) NOT NULL,
  `pincode` int(11) NOT NULL,
  `datebirth` date NOT NULL,
  `picture` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `token` varchar(200) DEFAULT NULL,
  `token_expire` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `name`, `email`, `adresse`, `phonenum`, `pincode`, `datebirth`, `picture`, `password`, `is_verified`, `token`, `token_expire`, `status`, `datentime`) VALUES
(7, 'Abdelghafour', 'eastabdowakassi@gmail.com', 'tit mellil', '0707893210', 5555, '2000-06-26', 'IMG_72346.jpeg', '$2y$10$PPF/QPD2JC9wosFW4UM7muV1YZ8ggLFJ36TrFGn3uCGVr2UY1/qCG', 1, NULL, NULL, 1, '2023-03-24 12:01:20');

-- --------------------------------------------------------

--
-- Table structure for table `user_queries`
--

CREATE TABLE `user_queries` (
  `id_user` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_panel`
--
ALTER TABLE `admin_panel`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `booking_details_ibfk_1` (`booking_id`);

--
-- Indexes for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `booking_order_ibfk_1` (`user_id`),
  ADD KEY `booking_order_ibfk_2` (`room_id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `facilities id` (`facilities_id`),
  ADD KEY `room id` (`room_id`);

--
-- Indexes for table `room_features`
--
ALTER TABLE `room_features`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `features id` (`features_id`),
  ADD KEY `rm id` (`room_id`);

--
-- Indexes for table `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id_settings`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_queries`
--
ALTER TABLE `user_queries`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_panel`
--
ALTER TABLE `admin_panel`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `booking_order`
--
ALTER TABLE `booking_order`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `room_facilities`
--
ALTER TABLE `room_facilities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `room_features`
--
ALTER TABLE `room_features`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `room_images`
--
ALTER TABLE `room_images`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id_settings` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `id_user` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD CONSTRAINT `booking_details_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD CONSTRAINT `booking_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_order_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD CONSTRAINT `facilities id` FOREIGN KEY (`facilities_id`) REFERENCES `facilities` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `room id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_features`
--
ALTER TABLE `room_features`
  ADD CONSTRAINT `features id` FOREIGN KEY (`features_id`) REFERENCES `features` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `rm id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_images`
--
ALTER TABLE `room_images`
  ADD CONSTRAINT `room_images_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
