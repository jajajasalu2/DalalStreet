-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 07, 2019 at 03:58 PM
-- Server version: 5.7.25-0ubuntu0.16.04.2
-- PHP Version: 7.2.14-1+ubuntu16.04.1+deb.sury.org+1

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
(1, 'company', 2326.98, '2019-02-07 04:25:06', 'COMPANY', '2019-02-07 00:08:06'),
(2, 'ibm', 2280.86, '2019-02-07 04:38:05', 'COMPANY', NULL),
(3, 'google', 2658.8, '2019-02-07 04:25:59', '', NULL),
(4, 'fb', 1395.68, '2019-02-07 04:36:11', '', NULL),
(5, 'amazon', 3644.47, '2019-02-07 04:26:13', '', NULL);

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
(2, 30, 1);

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

--
-- Dumping data for table `company_dividends`
--

INSERT INTO `company_dividends` (`company_id`, `dividend`, `shares_per_dividend`, `profit_or_loss`) VALUES
(2, 2000, 2, 0);

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
(3, '2019-02-07 09:13:14'),
(4, '2019-02-07 09:21:57'),
(5, '2019-02-07 09:23:34'),
(6, '2019-02-07 09:24:56'),
(7, '2019-02-07 09:27:04'),
(8, '2019-02-07 09:27:57'),
(9, '2019-02-07 09:29:10');

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
(215, 2, 2, '2019-02-07', '2019-02-07', 10),
(150, 2, 3, '2019-02-07', '2019-02-07', 11),
(270, 1, 1, '2019-02-07', '2019-02-07', 12),
(22, 4, 2, '2019-02-07', '2019-02-07', 14),
(50, 4, 3, '2019-02-07', '2019-02-07', 15),
(10, 1, 3, '2019-02-07', '2019-02-07', 16),
(2, 3, 2, '2019-02-07', '2019-02-07', 17),
(535, 2, 1, '2019-02-07', '2019-02-07', 18),
(3, 3, 1, '2019-02-07', '2019-02-07', 19),
(20, 4, 1, '2019-02-07', '2019-02-07', 20),
(40, 5, 3, '2019-02-07', '2019-02-07', 21);

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
(2, 3, 488, '2019-02-07 09:53:45', '2019-02-07 09:53:45', 2505.65),
(1, 3, 4, '2019-02-07 09:54:11', '2019-02-07 09:54:11', 2532.04);

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
(1, 98256900, '2019-02-07 04:38:05'),
(2, 120000000000, '2019-02-07 04:36:11'),
(3, 13000000000000, '2019-02-07 04:26:13');

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
(100, 1, 2, 2, '2019-02-07 03:43:14', '2019-02-07 03:43:14', 3),
(150, 1, 2, 3, '2019-02-07 03:43:31', '2019-02-07 03:43:31', 3),
(1, 1, 1, 1, '2019-02-07 04:16:46', '2019-02-07 04:16:46', 9),
(12, 1, 2, 2, '2019-02-07 04:20:57', '2019-02-07 04:20:57', 9),
(12, 1, 3, 2, '2019-02-07 04:23:26', '2019-02-07 04:23:26', 9),
(20, 1, 4, 2, '2019-02-07 04:23:26', '2019-02-07 04:23:26', 9),
(5, 1, 1, 1, '2019-02-07 04:23:26', '2019-02-07 04:23:26', 9),
(12, 2, 3, 2, '2019-02-07 04:23:41', '2019-02-07 04:23:41', 9),
(500, 4, 3, 2, '2019-02-07 04:23:45', '2019-02-07 04:23:45', 9),
(1, 1, 2, 2, '2019-02-07 04:23:49', '2019-02-07 04:23:49', 9),
(12, 3, 3, 2, '2019-02-07 04:24:01', '2019-02-07 04:24:01', 9),
(100, 1, 2, 2, '2019-02-07 04:24:01', '2019-02-07 04:24:01', 9),
(50, 1, 4, 3, '2019-02-07 04:24:04', '2019-02-07 04:24:04', 9),
(10, 1, 1, 3, '2019-02-07 04:24:05', '2019-02-07 04:24:05', 9),
(2, 1, 3, 2, '2019-02-07 04:24:06', '2019-02-07 04:24:06', 9),
(2, 1, 2, 2, '2019-02-07 04:24:11', '2019-02-07 04:24:11', 9),
(4, 4, 3, 1, '2019-02-07 04:24:11', '2019-02-07 04:24:11', 9),
(200, 1, 1, 1, '2019-02-07 04:24:29', '2019-02-07 04:24:29', 9),
(14, 1, 1, 1, '2019-02-07 04:24:38', '2019-02-07 04:24:38', 9),
(600, 1, 2, 1, '2019-02-07 04:24:39', '2019-02-07 04:24:39', 9),
(16, 1, 2, 1, '2019-02-07 04:24:40', '2019-02-07 04:24:40', 9),
(2, 1, 3, 1, '2019-02-07 04:24:52', '2019-02-07 04:24:52', 9),
(1, 1, 3, 1, '2019-02-07 04:24:53', '2019-02-07 04:24:53', 9),
(250, 1, 3, 1, '2019-02-07 04:25:00', '2019-02-07 04:25:00', 9),
(50, 1, 1, 1, '2019-02-07 04:25:06', '2019-02-07 04:25:06', 9),
(20, 1, 4, 1, '2019-02-07 04:25:17', '2019-02-07 04:25:17', 9),
(1, 2, 2, 1, '2019-02-07 04:25:47', '2019-02-07 04:25:47', 9),
(20, 1, 2, 1, '2019-02-07 04:25:52', '2019-02-07 04:25:52', 9),
(250, 2, 3, 1, '2019-02-07 04:25:59', '2019-02-07 04:25:59', 9),
(40, 1, 5, 3, '2019-02-07 04:26:13', '2019-02-07 04:26:13', 9),
(2, 1, 4, 2, '2019-02-07 04:36:11', '2019-02-07 04:36:11', 9),
(100, 2, 2, 1, '2019-02-07 04:38:05', '2019-02-07 04:38:05', 9);

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
(3, 'jansher', '123@gmail.com', NULL, '$2y$10$yyJpT5Zy3UOmoESj8j.9DOyBKMgKJ0X2hg64/45S3MaSv/qQ53C8m', 'W95cUV1yvG1lz9nshQRjuXaSz61BjGfNFxJOqSf9zK5RGBfUhAw0a0WcwxhJ', '2019-02-06 23:35:47', '2019-02-06 23:35:47', 3),
(4, 'admin', 'admin@gmail.com', NULL, '$2y$10$4Cu0LISbn7oEkVXPGaFf5ubuvtNcy6D.koDpibu6s3Un5NhLUirva', '95YcYVah6MJQ5srqxVfpdtiLqGFnRZdK8jp3X2Txmi7IOmwnTPkUjlpEb7hG', '2019-02-07 00:07:31', '2019-02-07 00:07:31', 1),
(5, 'Simran Bhagwandasani', 'simirb98@gmail.com', NULL, '$2y$10$648s9vsK5D42pm/Wtf3cReCCya3uMcwo7DfXJQLEgebvY/8qj5od6', 'iLIWe2r8opirclDXIiSZBPuHCqpyijuwU9jkVOgu1bRCHwglSUh0zgHh5Dnn', '2019-02-07 02:11:07', '2019-02-07 02:11:07', 2),
(6, 'Chinmay Patil', 'chinmay4451@gmail.com', NULL, '$2y$10$.RKsdby608pJmNlK12iUHueOMm926b9BqSFxdceUUT5WnNm1hZZdS', 'lwASAn31IixofknAB3gHH2iy5auqhaGvoUlNblvuGG93DeZtjJ84RDTvnrBs', '2019-02-07 02:11:40', '2019-02-07 02:11:40', 2),
(7, 'Alpha;delete from users;commit', 'a@abc.com', NULL, '$2y$10$EXaGhiPYUPvlawtRwPgpSOZ1FT7nfkqamztUBdoksoaWxs1DnYg3m', 'k1CL2vnVAE7WyVZ2T9YPzLakmr8WR6USbnYJnq26eMMljyTxgPJt99bE7sfj', '2019-02-07 02:32:37', '2019-02-07 02:32:37', 3),
(8, '<script>alert("hacked");</script>', 'a@ac.com', NULL, '$2y$10$7U3sF3mrawgabp5ZiOMJc.XiNfKlMAuzEFa/bldcd8XdGt1d7voS.', 'b9VFi1GfoxBcqKO2IgQDKah08fG9DG5wA7u2ROwyTeVXSGSDl3Yimv5eRWdv', '2019-02-07 02:35:01', '2019-02-07 02:35:01', 3),
(9, 'Rishabh', 'ranpisevindhya@gmail.com', NULL, '$2y$10$hliCvA.g6orYShrFmTlooONpnT9AUW6nn9.wu1uI/bqZ4oghKdj6y', NULL, '2019-02-07 04:15:31', '2019-02-07 04:15:31', 2),
(10, 'Dusksks', 'Kdkh@gs.com', NULL, '$2y$10$zW/pDdHPoZYkKg9YrmnVXO2xPmTZz6bBqmapyN2pmVZdogq/YPxIe', NULL, '2019-02-07 04:15:31', '2019-02-07 04:15:31', 2),
(11, 'Kamlesh', 'kamelshmishar@gmail.com', NULL, '$2y$10$6Rl97rkeKShI6vMdl74JzO1ZM8i/2U41fQArIp5QghalMGyiZV7Ye', NULL, '2019-02-07 04:15:42', '2019-02-07 04:15:42', 2),
(12, 'Siddhanth Pai', '2017.siddhanth.pai@ves.ac.in', NULL, '$2y$10$kvTp/DAmXh8.ntFFtV8jEOwG7viUYJV3YCWiSndw97bJqORrzrGAG', NULL, '2019-02-07 04:16:03', '2019-02-07 04:16:03', 2),
(13, 'Aditya', 'adityaranka06@gmail.com', NULL, '$2y$10$cJPMFoV.exVp7aGrPv48FOL79Q8DJAwJwmdbYR36ekNx2ZRhOktYu', NULL, '2019-02-07 04:16:13', '2019-02-07 04:16:13', 2),
(14, 'Qwerty', 'test@test.com', NULL, '$2y$10$.Ar/mJx.hyXmOQNCEUNRpeuhp5WPUASPmlsxWRwrjKrC2WWoKJKwy', NULL, '2019-02-07 04:16:22', '2019-02-07 04:16:22', 2),
(15, 'Muskan Chelwani', '2017.muskan.chelwani@ves.ac.in', NULL, '$2y$10$C.4ySQqmlTKw0N7b4gY2IexobgDpx8O6TyJoxSbslSRFRFbTPddm2', NULL, '2019-02-07 04:16:24', '2019-02-07 04:16:24', 2),
(16, 'ABC', 's@email.com', NULL, '$2y$10$iNOs7szwlBmA.uNg7VbbnO01bZIrCPdplqwZjZY3mIUq3BXlEkeLe', 'jl9RYc032DObocG1auJa5iqu9UaL5vn4wXqCyG179UfI33GCAMBZhrazKPAC', '2019-02-07 04:16:38', '2019-02-07 04:16:38', 2),
(17, 'Mohnish', '2016.mohnish.niduvaje@ves.ac.in', NULL, '$2y$10$yUTpwZNkr9tSEVnRwRdsBOlLSL8a/h.l/VJtXLoB8cgikUKi3.QXm', NULL, '2019-02-07 04:16:44', '2019-02-07 04:16:44', 2),
(18, 'Dhanashree shetty', '2017.dhanashree.shetty@ves.ac.in', NULL, '$2y$10$V9vWLKeNJkxIEW7YZ5CQy.IcqgBIv.OX0TVi1lh2bG.aAOXGpwNxe', NULL, '2019-02-07 04:17:45', '2019-02-07 04:17:45', 2),
(19, 'Ninad', 'nsiwnaarda@gmail.com', NULL, '$2y$10$Jd0fuDHl9oQdSkU4AM1shOOESDOpC9diDZx7KgxqkbEuoGeTVeCba', NULL, '2019-02-07 04:19:13', '2019-02-07 04:19:13', 2),
(20, 'Neelam Somai', '2017.neelam.somai@ves.ac.in', NULL, '$2y$10$HauluqvHvLy5nakkGih/T.t5Xwf7L3SUi8XWKmmqY/5HHmKmybNlK', NULL, '2019-02-07 04:20:36', '2019-02-07 04:20:36', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_teams`
--

CREATE TABLE `user_teams` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `team_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_teams`
--

INSERT INTO `user_teams` (`user_id`, `team_id`) VALUES
(5, 1),
(3, 2),
(10, 2),
(9, 3);

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
-- Indexes for table `user_teams`
--
ALTER TABLE `user_teams`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `team_id` (`team_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `shares`
--
ALTER TABLE `shares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
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

--
-- Constraints for table `user_teams`
--
ALTER TABLE `user_teams`
  ADD CONSTRAINT `teamco` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`),
  ADD CONSTRAINT `user_teams_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
