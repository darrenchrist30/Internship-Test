-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 05, 2025 at 09:06 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `avianintern`
--

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `purchase_id` int NOT NULL,
  `customer_id` int DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `total_price` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`purchase_id`, `customer_id`, `purchase_date`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-01-15', 100, NULL, NULL),
(2, 1, '2022-02-20', 150, NULL, NULL),
(3, 2, '2022-03-05', 200, NULL, NULL),
(4, 2, '2022-04-10', 75, NULL, NULL),
(5, 2, '2022-06-15', 300, NULL, NULL),
(6, 3, '2022-01-30', 50, NULL, NULL),
(7, 3, '2022-05-01', 125, NULL, NULL),
(8, 5, '2022-01-14', 275, NULL, NULL),
(9, 2, '2022-01-07', 135, NULL, NULL),
(10, 5, '2022-01-24', 225, NULL, NULL),
(11, 5, '2025-06-08', 100, '2025-06-04 21:08:39', '2025-06-04 21:08:39'),
(12, 2, '2025-06-05', 200, '2025-06-04 21:16:28', '2025-06-04 21:16:28'),
(13, 1, '2025-06-01', 100, '2025-06-04 21:19:05', '2025-06-04 21:19:05'),
(14, 5, '2025-06-01', 100, '2025-06-04 21:24:51', '2025-06-04 21:24:51'),
(15, 1, '2025-06-05', 100, '2025-06-04 21:25:22', '2025-06-04 21:25:22'),
(16, 6, '2025-05-05', 300, NULL, NULL),
(17, 1, '2025-06-05', 100, '2025-06-05 01:03:54', '2025-06-05 01:03:54'),
(18, 3, '2025-06-05', 100, '2025-06-05 01:08:17', '2025-06-05 01:08:17'),
(19, 1, '2025-06-05', 100, '2025-06-05 01:47:51', '2025-06-05 01:47:51'),
(20, 1, '2025-06-05', 100, '2025-06-05 01:48:18', '2025-06-05 01:48:18'),
(21, 4, '2025-06-05', 100, '2025-06-05 01:50:51', '2025-06-05 01:50:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchase_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
