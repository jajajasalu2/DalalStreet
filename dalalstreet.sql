-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 10, 2019 at 08:07 AM
-- Server version: 5.7.24-0ubuntu0.16.04.1
-- PHP Version: 7.2.13-1+ubuntu16.04.1+deb.sury.org+1

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `value`, `no_of_shares`, `rate`, `updated_at`, `type`) VALUES
(1, 'ball', 1000000, 20000, 150.536, '2019-01-09 07:49:30', 'FOREX'),
(2, 'NIGGER', 30000, 4997, 201.464, '2018-12-27 07:34:08', 'FOREX');

-- --------------------------------------------------------

--
-- Table structure for table `company_bonuses`
--

CREATE TABLE `company_bonuses` (
  `company_id` int(11) NOT NULL,
  `bonus` float NOT NULL,
  `shares_per_bonus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_bonuses`
--

INSERT INTO `company_bonuses` (`company_id`, `bonus`, `shares_per_bonus`) VALUES
(1, 5000, 3),
(2, 4000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `company_dividends`
--

CREATE TABLE `company_dividends` (
  `company_id` int(11) NOT NULL,
  `dividend` float NOT NULL,
  `shares_per_dividend` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_dividends`
--

INSERT INTO `company_dividends` (`company_id`, `dividend`, `shares_per_dividend`) VALUES
(1, 4000, 2),
(2, 1000, 2);

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
(4, 1, 2, '2018-12-27', '2018-12-27', 2),
(3, 2, 1, '2018-12-27', '2018-12-27', 3);

-- --------------------------------------------------------

--
-- Table structure for table `shortsold_shares`
--

CREATE TABLE `shortsold_shares` (
  `share_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 23347.1, '2019-01-09 02:40:31'),
(2, 18000, '2018-12-27 07:59:04');

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
(1, 1, '2018-12-27 13:03:32', 1, 1, '2018-12-27 07:33:32', '2018-12-27 07:33:32'),
(1, 1, '2018-12-27 13:03:37', 1, 1, '2018-12-27 07:33:37', '2018-12-27 07:33:37'),
(1, 1, '2018-12-27 13:03:40', 1, 1, '2018-12-27 07:33:40', '2018-12-27 07:33:40'),
(1, 1, '2018-12-27 13:03:44', 1, 2, '2018-12-27 07:33:44', '2018-12-27 07:33:44'),
(1, 1, '2018-12-27 13:03:50', 1, 2, '2018-12-27 07:33:50', '2018-12-27 07:33:50'),
(1, 1, '2018-12-27 13:03:53', 1, 2, '2018-12-27 07:33:53', '2018-12-27 07:33:53'),
(1, 1, '2018-12-27 13:03:56', 1, 2, '2018-12-27 07:33:56', '2018-12-27 07:33:56'),
(1, 1, '2018-12-27 13:04:01', 2, 1, '2018-12-27 07:34:01', '2018-12-27 07:34:01'),
(1, 1, '2018-12-27 13:04:04', 2, 1, '2018-12-27 07:34:04', '2018-12-27 07:34:04'),
(1, 1, '2018-12-27 13:04:08', 2, 1, '2018-12-27 07:34:08', '2018-12-27 07:34:08'),
(1, 1, '2019-01-09 08:08:18', 1, 1, '2019-01-09 02:38:18', '2019-01-09 02:38:18'),
(2, 2, '2019-01-09 08:10:32', 1, 1, '2019-01-09 02:40:32', '2019-01-09 02:40:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_bonuses`
--
ALTER TABLE `company_bonuses`
  ADD PRIMARY KEY (`company_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `company_dividends`
--
ALTER TABLE `company_dividends`
  ADD PRIMARY KEY (`company_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `shares`
--
ALTER TABLE `shares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `shortsold_shares`
--
ALTER TABLE `shortsold_shares`
  ADD KEY `share_id` (`share_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `company_bonuses`
--
ALTER TABLE `company_bonuses`
  ADD CONSTRAINT `company_id_foreign_key` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`);

--
-- Constraints for table `company_dividends`
--
ALTER TABLE `company_dividends`
  ADD CONSTRAINT `dividend_foreign_key` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`);

--
-- Constraints for table `shares`
--
ALTER TABLE `shares`
  ADD CONSTRAINT `shares_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `shares_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`);

--
-- Constraints for table `shortsold_shares`
--
ALTER TABLE `shortsold_shares`
  ADD CONSTRAINT `shortsellforeignkey` FOREIGN KEY (`share_id`) REFERENCES `shares` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
