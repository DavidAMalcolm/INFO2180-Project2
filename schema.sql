-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2023 at 03:58 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dolphin_crm`
--
DROP DATABASE IF EXISTS `dolphin_crm`;
CREATE DATABASE IF NOT EXISTS `dolphin_crm` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dolphin_crm`;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `assigned_to` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `title`, `firstname`, `lastname`, `email`, `telephone`, `company`, `type`, `assigned_to`, `created_by`, `created_at`, `updated_at`) VALUES
(5, 'Mr', 'Egg', 'Sample1', 'example@something.com', '1234567890', 'Google', 'Sales Lead', 1, 1, '2023-12-10 02:12:50', '2023-12-10 20:49:04'),
(6, 'Mr', 'Andrew', 'Holness', 'example1@something.com', '3234567890', 'Jamaica', 'Support', 1, 1, '2023-12-10 02:13:55', '2023-12-10 02:13:55'),
(8, 'Mr', 'Senku', 'Ishigami', 'science@gmail.com', '1234567891', 'World', 'Support', 1, 1, '2023-12-10 02:22:13', '2023-12-10 21:25:07'),
(9, 'Mr', 'Tyler', 'Creator', 'baudeliere@hayley.com', '1231235', 'Wolfgang', 'Sales Lead', 5, 1, '2023-12-10 21:23:53', '2023-12-10 21:23:53');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `contact_id`, `comment`, `created_by`, `created_at`) VALUES
(1, 5, 'He\'s a decent employee with minimal downsides as a contact to have.', 1, '2023-12-10 18:07:03'),
(2, 8, 'He seems capable of creating this new world he&#039;s always speaking about.', 1, '2023-12-10 21:25:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `password`, `email`, `role`, `created_at`) VALUES
(1, 'David', 'Malcolm', '$2y$10$aZaw8vGgQ6e3HnsH6vcOiex0JxQwKPpdd86ZENSGonhc7hMAz5d7q', 'mafia@project2.com', 'Admin', '2023-12-10 20:07:01'),
(4, 'Charles', 'Correction', '$2y$10$SUpNPakAFD37Dg6ejMFjae8UT2izGOTEx9lo6Blzx2U.PcaIaDsma', 'admin@project2.com', 'Admin', '2023-12-10 20:04:47'),
(5, 'Hank', 'Green', '$2y$10$jiK1K2kd.LXUplmhb2SJWe0A0gk9QqVhPX3UG25AwviT7b/bZ6a9m', 'green@goop.com', 'Member', '2023-12-10 21:08:27'),
(6, 'Todd', 'Howard', '$2y$10$8eBJXgUwgMdOAqINBEHYJOWsaqxLOgg9ar7rdQHZ/Yhqdjzsn7xW6', 'todd@bethesda.com', 'Member', '2023-12-10 21:13:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
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
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
