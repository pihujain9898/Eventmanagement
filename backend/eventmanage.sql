-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2023 at 06:15 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eventmanage`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) NOT NULL,
  `user` bigint(20) NOT NULL,
  `ticket` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `individual_price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `introduction` varchar(255) NOT NULL,
  `information` varchar(255) NOT NULL,
  `notices` varchar(255) NOT NULL,
  `policies` varchar(255) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL CHECK (`end_time` > `start_time`),
  `category` int(11) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `image`, `introduction`, `information`, `notices`, `policies`, `start_time`, `end_time`, `category`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Dandiya Night', NULL, 'Saepe veritatis voluptatem Temporibus dolorum magna ullamco aliquid accusantium ducimus dolorem', 'Quis consequatur Sint et est architecto ipsam provident adipisicing ipsa ut iste aperiam itaque enim', 'Qui ipsa aliquam ut cupiditate pariatur ', 'Voluptas amet aute quas suscipit voluptate eu dignissimos id consequuntur rerum', '2024-04-23 14:46:00', '2025-08-13 20:40:00', 5, 4, '2023-09-20 07:37:40', '2023-09-21 21:50:16'),
(2, 'Lacy Carey', NULL, 'Totam sit quia veniam veniam consequat Cumque rerum excepteur consectetur ut aut', 'Qui recusandae Quo tempora eius dolor qui sit corrupti ad', 'Aliqua Obcaecati laboris dolores quia', 'Corporis et debitis itaque dolorem accusantium ea culpa quam ut sed minim sequi sit fugiat sed qui', '2024-04-10 18:49:00', '2024-12-05 19:34:00', 5, 4, '2023-09-20 07:46:51', '2023-09-20 07:46:51'),
(3, 'Jamming', NULL, 'Eius voluptatem Sunt officia et molestiae ad fugiat dolore enim sed eu nesciunt voluptates', 'In incididunt et irure recusandae', 'Exercitationem aliquip rerum dolore culpa consectetur minus velit soluta saepe quis', 'Dolore sit pariatur Temporibus numquam amet dolorum repudiandae', '2024-03-16 14:44:00', '2025-11-15 02:42:00', 5, 14, '2023-09-21 21:51:52', '2023-09-21 22:15:14');

--
-- Triggers `events`
--
DELIMITER $$
CREATE TRIGGER `check_start_time` BEFORE INSERT ON `events` FOR EACH ROW BEGIN
    IF NEW.start_time <= NOW() THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Invalid start_time';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `event_category`
--

CREATE TABLE `event_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'Event Category Name',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_category`
--

INSERT INTO `event_category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Buisness', '2023-09-20 05:50:56', '2023-09-20 05:50:56'),
(3, 'Technology', '2023-09-20 05:51:04', '2023-09-20 05:51:04'),
(4, 'Healthcare', '2023-09-20 05:51:12', '2023-09-20 05:51:12'),
(5, 'Humanity', '2023-09-20 06:10:27', '2023-09-20 06:10:27'),
(7, 'Enviorment', '2023-09-20 06:21:39', '2023-09-20 06:21:39'),
(8, 'Education', '2023-09-20 13:02:58', '2023-09-20 13:02:58');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `category` int(11) NOT NULL,
  `event` bigint(20) NOT NULL,
  `total_quantity` int(11) NOT NULL,
  `avilable_quantity` int(11) NOT NULL CHECK (`avilable_quantity` <= `total_quantity`),
  `max_purchase_value` int(11) NOT NULL CHECK (`max_purchase_value` <= `total_quantity`),
  `expiry` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `name`, `description`, `price`, `category`, `event`, `total_quantity`, `avilable_quantity`, `max_purchase_value`, `expiry`, `created_at`, `updated_at`) VALUES
(1, 'Hakeem Fitzpatrick', 'Ipsam rerum exercitationem velit ipsa ut aliquam consectetur vel', 45, 4, 1, 2000, 1999, 5, '2023-09-20 11:21:11', '2023-09-20 09:58:41', '2023-09-20 11:21:11'),
(2, 'Shellie Huff', 'Perspiciatis ea id ex quo in assumenda est Nam magna quo', 472, 3, 1, 135, 100, 4, '2025-08-12 20:40:00', '2023-09-20 10:45:33', '2023-09-20 10:52:33'),
(3, 'Julian Macias', 'Dolore qui mollitia cupidatat ut est ratione vel corporis amet aute dolores qui at tempor sunt quisquam modi quos', 672, 2, 2, 779, 49, 7, '2026-03-18 09:59:00', '2023-09-20 10:47:15', '2023-09-20 10:47:15');

--
-- Triggers `tickets`
--
DELIMITER $$
CREATE TRIGGER `check_expiry` BEFORE INSERT ON `tickets` FOR EACH ROW BEGIN
    DECLARE event_end_time TIMESTAMP;
    SELECT end_time INTO event_end_time FROM events WHERE id = NEW.event;
    IF NEW.expiry <= event_end_time THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Invalid expiry time';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_category`
--

CREATE TABLE `ticket_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'Ticket Category Name',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket_category`
--

INSERT INTO `ticket_category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Adult Premium', '2023-09-20 05:19:39', '2023-09-20 05:20:12'),
(2, 'Adult Basic', '2023-09-20 05:20:29', '2023-09-20 05:20:29'),
(3, 'Child Premium', '2023-09-20 06:11:07', '2023-09-20 06:11:07'),
(4, 'Child Basic', '2023-09-20 06:15:32', '2023-09-20 06:15:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0=User, 1=organiser, 2=admin',
  `is_verified` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=Not Verified, 1=Verified',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `user_role`, `is_verified`, `created_at`, `updated_at`) VALUES
(3, 'Faith', 'Deacon', 'pogygys@mailinator.com', 'Pa$$w0rd!', '2', '1', '2023-09-20 05:08:05', '2023-09-21 21:20:06'),
(4, 'Manmohan', 'Ulla', 'wuwyvutocy@mailinator.com', 'Pa$$w0rd!', '1', '1', '2023-09-20 05:30:32', '2023-09-21 21:24:59'),
(14, 'Andrew', 'Viera', 'pulibese@mailinator.com', 'Pa$$w0rd!', '1', '1', '2023-09-20 06:23:36', '2023-09-21 21:33:37'),
(15, 'clark', 'SyDney', 'woxev@mailinator.com', 'Pa$$w0rd!', '0', '1', '2023-09-20 12:15:10', '2023-09-20 12:15:10'),
(16, 'Nora', 'Nicholson', 'tefudogiwe@mailinator.com', 'Pa$$w0rd!', '0', '1', '2023-09-20 12:16:18', '2023-09-20 12:16:18'),
(17, 'Ruth', 'Alma', 'jigysil@mailinator.com', 'Pa$$w0rd!', '0', '1', '2023-09-20 12:17:41', '2023-09-20 12:17:41'),
(19, 'Hari', 'Bonner', 'mulur@mailinator.com', 'Pa$$w0rd!', '0', '1', '2023-09-21 10:11:11', '2023-09-21 19:28:45'),
(20, 'Allen', 'Shields', 'buvawinery@mailinator.com', 'Pa$$w0rd!', '0', '1', '2023-09-21 11:12:35', '2023-09-21 19:28:47'),
(21, 'Vivian', 'Mcdonald', 'vawinery@mailinator.com', 'Pa$$w0rd!', '0', '1', '2023-09-21 11:14:29', '2023-09-21 19:28:49'),
(22, 'Pascale', 'Zeph', 'byzaripyt@mailinator.com', 'Pa$$w0rd!', '0', '1', '2023-09-21 11:16:37', '2023-09-21 21:20:01'),
(23, 'Felicia', 'Hicks', 'losa@mailinator.com', '$2y$10$lcxDHJObPmgJQjR2eGjZzehcCHveQtww7aCZuqAljfNAXHsqxbCl.', '0', '1', '2023-09-21 19:37:28', '2023-09-21 19:37:28'),
(24, 'Carlos', 'Noel', 'kanolaqar@mailinator.com', '$2y$10$j/Rk5ELHwUD0KDge.gT5muSvEF8E496FJOMuD5RWhbZKdXmx0AF2y', '0', '1', '2023-09-21 19:49:51', '2023-09-21 19:49:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `ticket` (`ticket`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `event_category`
--
ALTER TABLE `event_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`),
  ADD KEY `event` (`event`);

--
-- Indexes for table `ticket_category`
--
ALTER TABLE `ticket_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `event_category`
--
ALTER TABLE `event_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ticket_category`
--
ALTER TABLE `ticket_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`ticket`) REFERENCES `tickets` (`id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`category`) REFERENCES `event_category` (`id`),
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`category`) REFERENCES `ticket_category` (`id`),
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`event`) REFERENCES `events` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
