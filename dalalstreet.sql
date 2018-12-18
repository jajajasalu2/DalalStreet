-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 18, 2018 at 08:18 AM
-- Server version: 5.7.24-0ubuntu0.16.04.1
-- PHP Version: 7.2.12-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dalalstreet`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `value` float DEFAULT NULL,
  `no_of_shares` int(11) DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `value`, `no_of_shares`, `rate`, `updated_at`) VALUES
(1, 'apple', 50000, 205, 110.624, '2018-12-15 12:46:56'),
(2, 'flipkart', 40000, 200, 50, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shares`
--

CREATE TABLE `shares` (
  `amount` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shares`
--

INSERT INTO `shares` (`amount`, `company_id`, `team_id`, `updated_at`, `created_at`, `id`) VALUES
(1, 1, 1, '2018-12-15', '2018-12-15', 5),
(5, 1, 2, '2018-12-15', '2018-12-15', 6);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `balance` float DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `balance`, `updated_at`) VALUES
(1, 9830.91, '2018-12-15 12:46:45'),
(2, 9493.94, '2018-12-15 12:46:56');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `amount` int(11) DEFAULT NULL,
  `buy_sell` tinyint(1) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `company_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`amount`, `buy_sell`, `date`, `company_id`, `team_id`, `updated_at`, `created_at`) VALUES
(1, 1, '2018-12-15 18:08:17', 1, 1, '2018-12-15 12:38:17', '2018-12-15 12:38:17'),
(1, 1, '2018-12-15 18:08:21', 1, 2, '2018-12-15 12:38:21', '2018-12-15 12:38:21'),
(1, 1, '2018-12-15 18:08:34', 1, 1, '2018-12-15 12:38:34', '2018-12-15 12:38:34'),
(1, 1, '2018-12-15 18:08:39', 1, 2, '2018-12-15 12:38:39', '2018-12-15 12:38:39'),
(1, 1, '2018-12-15 18:08:46', 1, 2, '2018-12-15 12:38:46', '2018-12-15 12:38:46'),
(1, 1, '2018-12-15 18:08:49', 1, 2, '2018-12-15 12:38:49', '2018-12-15 12:38:49'),
(1, 1, '2018-12-15 18:08:52', 1, 1, '2018-12-15 12:38:52', '2018-12-15 12:38:52'),
(1, 1, '2018-12-15 18:08:55', 1, 1, '2018-12-15 12:38:55', '2018-12-15 12:38:55'),
(1, 1, '2018-12-15 18:14:51', 1, 1, '2018-12-15 12:44:51', '2018-12-15 12:44:51'),
(1, 1, '2018-12-15 18:15:02', 1, 1, '2018-12-15 12:45:02', '2018-12-15 12:45:02'),
(1, 0, '2018-12-15 18:16:10', 1, 1, '2018-12-15 12:46:10', '2018-12-15 12:46:10'),
(1, 0, '2018-12-15 18:16:28', 1, 1, '2018-12-15 12:46:28', '2018-12-15 12:46:28'),
(1, 0, '2018-12-15 18:16:37', 1, 1, '2018-12-15 12:46:37', '2018-12-15 12:46:37'),
(1, 0, '2018-12-15 18:16:45', 1, 1, '2018-12-15 12:46:45', '2018-12-15 12:46:45'),
(1, 1, '2018-12-15 18:16:56', 1, 2, '2018-12-15 12:46:56', '2018-12-15 12:46:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shares`
--
ALTER TABLE `shares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD KEY `company_id` (`company_id`),
  ADD KEY `team_id` (`team_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shares`
--
ALTER TABLE `shares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `shares`
--
ALTER TABLE `shares`
  ADD CONSTRAINT `shares_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `shares_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
