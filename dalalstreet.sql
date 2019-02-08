-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 08, 2019 at 11:49 PM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.2.14-1+ubuntu18.04.1+deb.sury.org+1

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
  `rate` float DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `rate`, `updated_at`, `type`, `created_at`) VALUES
(1, 'company', 8908.2, '2019-02-08 12:45:53', 'COMPANY', '2019-02-07 00:08:06'),
(2, 'ibm', 2020, NULL, 'COMPANY', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_bonuses`
--

CREATE TABLE `company_bonuses` (
  `company_id` int(11) NOT NULL,
  `bonus` float NOT NULL,
  `shares_per_bonus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company_dividends`
--

CREATE TABLE `company_dividends` (
  `company_id` int(11) NOT NULL,
  `dividend` float NOT NULL,
  `shares_per_dividend` int(11) NOT NULL,
  `profit_or_loss` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `time`) VALUES
(1, '2019-02-07 17:18:09'),
(2, '2019-02-08 17:17:38');

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
(1072, 1, 1, '2019-02-08', '2019-02-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shortsold_shares`
--

CREATE TABLE `shortsold_shares` (
  `team_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rate` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shortsold_shares`
--

INSERT INTO `shortsold_shares` (`team_id`, `company_id`, `amount`, `created_at`, `updated_at`, `rate`) VALUES
(50, 1, 50, '2019-02-08 17:41:17', '2019-02-08 17:41:17', 8902.98);

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
(1, 90755600, '2019-02-08 12:45:53'),
(2, 10000000000, NULL),
(5, 10000, NULL),
(10, 10000, NULL),
(40, 10000, NULL),
(50, 1000000, NULL),
(100, 10000, NULL),
(1000, 10000, NULL),
(1234567, 10000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `amount` int(11) DEFAULT NULL,
  `buy_sell` int(255) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `session_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`amount`, `buy_sell`, `company_id`, `team_id`, `updated_at`, `created_at`, `session_id`) VALUES
(123, 4, 1, 1, '2019-02-07 11:48:09', '2019-02-07 11:48:09', 1),
(123, 4, 1, 1, '2019-02-07 11:48:40', '2019-02-07 11:48:40', 1),
(123, 4, 1, 1, '2019-02-07 11:48:46', '2019-02-07 11:48:46', 1),
(123, 4, 1, 1, '2019-02-07 11:50:21', '2019-02-07 11:50:21', 1),
(123, 4, 1, 1, '2019-02-07 11:50:45', '2019-02-07 11:50:45', 1),
(123, 4, 1, 1, '2019-02-07 11:50:47', '2019-02-07 11:50:47', 1),
(123, 4, 1, 1, '2019-02-07 11:50:50', '2019-02-07 11:50:50', 1),
(1, 1, 1, 1, '2019-02-07 11:54:39', '2019-02-07 11:54:39', 1),
(1, 1, 1, 1, '2019-02-07 11:55:15', '2019-02-07 11:55:15', 1),
(12, 1, 1, 1, '2019-02-07 11:55:21', '2019-02-07 11:55:21', 1),
(1, 1, 1, 1, '2019-02-07 11:55:50', '2019-02-07 11:55:50', 1),
(1, 1, 1, 1, '2019-02-07 11:56:16', '2019-02-07 11:56:16', 1),
(1, 1, 1, 1, '2019-02-07 11:57:16', '2019-02-07 11:57:16', 1),
(12, 1, 1, 1, '2019-02-07 11:57:23', '2019-02-07 11:57:23', 1),
(20, 1, 1, 1, '2019-02-07 11:57:31', '2019-02-07 11:57:31', 1),
(1, 1, 1, 1, '2019-02-07 11:57:37', '2019-02-07 11:57:37', 1),
(1, 1, 1, 1, '2019-02-07 11:57:44', '2019-02-07 11:57:44', 1),
(1, 2, 1, 1, '2019-02-07 11:57:54', '2019-02-07 11:57:54', 1),
(10, 2, 1, 1, '2019-02-07 11:58:01', '2019-02-07 11:58:01', 1),
(10, 2, 1, 1, '2019-02-07 11:58:15', '2019-02-07 11:58:15', 1),
(1, 1, 1, 1, '2019-02-07 12:00:00', '2019-02-07 12:00:00', 1),
(1, 1, 1, 1, '2019-02-07 12:00:05', '2019-02-07 12:00:05', 1),
(10, 1, 1, 1, '2019-02-07 12:00:11', '2019-02-07 12:00:11', 1),
(10, 2, 1, 1, '2019-02-07 12:00:16', '2019-02-07 12:00:16', 1),
(1000, 1, 1, 1, '2019-02-07 12:01:50', '2019-02-07 12:01:50', 1),
(100, 1, 1, 1, '2019-02-07 12:02:03', '2019-02-07 12:02:03', 1),
(100, 1, 1, 1, '2019-02-07 12:02:13', '2019-02-07 12:02:13', 1),
(1, 1, 1, 1, '2019-02-07 12:07:35', '2019-02-07 12:07:35', 1),
(12, 1, 1, 1, '2019-02-07 12:17:06', '2019-02-07 12:17:06', 1),
(1, 1, 1, 1, '2019-02-07 12:17:14', '2019-02-07 12:17:14', 1),
(1, 2, 1, 1, '2019-02-07 12:17:22', '2019-02-07 12:17:22', 1),
(100, 2, 1, 1, '2019-02-07 12:17:29', '2019-02-07 12:17:29', 1),
(100, 2, 1, 1, '2019-02-07 12:17:37', '2019-02-07 12:17:37', 1),
(1, 2, 1, 1, '2019-02-07 12:17:43', '2019-02-07 12:17:43', 1),
(1, 2, 1, 1, '2019-02-07 12:17:49', '2019-02-07 12:17:49', 1),
(1, 2, 1, 1, '2019-02-07 12:17:54', '2019-02-07 12:17:54', 1),
(100, 2, 1, 1, '2019-02-07 12:17:59', '2019-02-07 12:17:59', 1),
(100, 2, 1, 1, '2019-02-07 12:18:07', '2019-02-07 12:18:07', 1),
(1, 2, 1, 1, '2019-02-07 12:18:16', '2019-02-07 12:18:16', 1),
(1, 2, 1, 1, '2019-02-07 12:18:29', '2019-02-07 12:18:29', 1),
(1, 2, 1, 1, '2019-02-07 12:18:35', '2019-02-07 12:18:35', 1),
(12, 1, 1, 1, '2019-02-07 13:06:20', '2019-02-07 13:06:20', 1),
(1, 1, 1, 1, '2019-02-08 10:32:28', '2019-02-08 10:32:28', 1),
(50, 4, 1, 50, '2019-02-08 12:11:17', '2019-02-08 12:11:17', 2),
(200, 1, 1, 1, '2019-02-08 12:45:37', '2019-02-08 12:45:37', 2),
(1, 1, 1, 1, '2019-02-08 12:45:48', '2019-02-08 12:45:48', 2),
(1, 2, 1, 1, '2019-02-08 12:45:53', '2019-02-08 12:45:53', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'jaskaran', 'abcd@gmail.com', NULL, '$2y$10$lshOlcaD4ouWangWsFilMeRecGfg/fOZcvcHfKA9/r.dHK2pQzQYa', 'i5pHJdrdbwxufF997X0wGCqkJKAN9XEykB6QThma83Out0vO06jOrmcuqSyT', '2019-02-06 22:57:02', '2019-02-06 22:57:02', NULL),
(2, 'jaskaran', 'qwewe@gmail.com', NULL, '$2y$10$n2QeaRhYAjmB6i.0AgFd6OlcF.t.lKI0iJDSCxqOPz/dJRr6/1mRO', 'SKswQCJyoWtlG4lo5bo8XYTl7nsyzqzHoZs5L02TuA1ktiOJf39jikenl7FF', '2019-02-06 22:59:34', '2019-02-06 22:59:34', 3),
(3, 'jansher', '123@gmail.com', NULL, '$2y$10$yyJpT5Zy3UOmoESj8j.9DOyBKMgKJ0X2hg64/45S3MaSv/qQ53C8m', 't2Nj4Prq5z3uC0BQXr3H12BZDUBASKuiehPJL2aO65R0jROY9WTGizCD7QIc', '2019-02-06 23:35:47', '2019-02-06 23:35:47', 3),
(4, 'admin', 'admin@gmail.com', NULL, '$2y$10$4Cu0LISbn7oEkVXPGaFf5ubuvtNcy6D.koDpibu6s3Un5NhLUirva', 'N2YYopClVWqAHnnJhcGYGR9CtrwImW63PvUb64eDVcn621JpVp8YEIKYNEqf', '2019-02-07 00:07:31', '2019-02-07 00:07:31', 1),
(16, 'jask', 'asdasd@gmail.com', NULL, '$2y$10$hsS75b0YTpDWYBtYrtqonukogzcxCaxeT2VQOP858lntLzX07FLL2', NULL, '2019-02-07 12:41:19', '2019-02-07 12:41:19', 3),
(20, 'calvin', '5555@gmail.com', NULL, '$2y$10$iJ/hSEJHtJnUpcSmitff3uVw9s0E/sq4xc0Lx5fsNO.5EZqf/poKS', 'g4JaOzOiilAZqN59BayV5253CLyWtvSHqg6Z6qI65ofJtBt5ain1nugdzUKh', '2019-02-07 12:48:08', '2019-02-07 12:48:08', 3),
(50, 'lil uzi vert', 'lil@gmail.com', NULL, '$2y$10$HG.yXWunpAFLGr/MDDkh7uj05VeWOGQDOKuSksRLESNxG1gyqQITa', 'FYD4L48OlrTVs4JZWDLffesk04LBSSeXEAGMgoyrpJRrShCTxrp8Nts2vmvb', '2019-02-07 12:59:39', '2019-02-07 12:59:39', 3),
(100, 'jaskasas', 'as@gmail.com', NULL, '$2y$10$JhPiHvXeT6ctlOXtrbmdXeO86BjxVkZynKSFTZ3er2CoMo8zI0dXO', 'byvzmp5kt8tIISHj3Q4lRbZBjPMOkmQNqliWuHTzDCYa7GQnljiCStumOxOd', '2019-02-07 13:02:44', '2019-02-07 13:02:44', 2),
(1000, 'iowa', 'iowa@gmail.com', NULL, '$2y$10$kX4aRsldxmHUKdZ2qVoNku5vCRHHIGf8FFqSoiZTXb3p9vbXLu4CS', 'sPPP7LKFfFGewv7Aqq5xIy1dsleoGO9chi6py7PAsEMDeyvY4THaDVmKIObB', '2019-02-08 11:13:24', '2019-02-08 11:13:24', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_company`
--

CREATE TABLE `user_company` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_company`
--

INSERT INTO `user_company` (`user_id`, `company_id`) VALUES
(100, 1),
(50, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_teams`
--

CREATE TABLE `user_teams` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `team_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_teams`
--

INSERT INTO `user_teams` (`user_id`, `team_id`) VALUES
(50, 40),
(100, 100),
(1000, 1000),
(2000000, 1234567),
(20, 50);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `team_id` (`team_id`),
  ADD KEY `company_id` (`company_id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `shares`
--
ALTER TABLE `shares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2000001;
--
-- Constraints for dumped tables
--

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
  ADD CONSTRAINT `company_co` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `team_co` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `company_transactions` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `team_transactions` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
