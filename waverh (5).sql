-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 15 fév. 2021 à 20:01
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `waverh`
--

-- --------------------------------------------------------

--
-- Structure de la table `actions`
--

DROP TABLE IF EXISTS `actions`;
CREATE TABLE IF NOT EXISTS `actions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `actions`
--

INSERT INTO `actions` (`id`, `name`) VALUES
(1, 'Updated'),
(2, 'Canceled'),
(3, 'Updated By Admin'),
(4, 'Validated'),
(5, 'Refused'),
(6, 'Canceled By Admin'),
(7, 'Archived'),
(8, 'Unarchived');

-- --------------------------------------------------------

--
-- Structure de la table `bank_holiday`
--

DROP TABLE IF EXISTS `bank_holiday`;
CREATE TABLE IF NOT EXISTS `bank_holiday` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `holiday_name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `type_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bank_holiday_type_id_foreign` (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `bank_holiday`
--

INSERT INTO `bank_holiday` (`id`, `holiday_name`, `start_date`, `end_date`, `type_id`) VALUES
(1, 'Manifeste de l’indépendance', '2021-02-18', '2021-02-12', 1),
(2, 'Fête du Travail.', '2021-05-01', '2021-05-02', 1),
(3, 'Aid al-Fitr', '2021-05-20', '2021-05-22', 2),
(4, 'Aid al Adha', '2021-07-20', '2021-07-21', 2),
(5, 'Fête du Trône', '2021-07-30', '2021-07-31', 1),
(6, 'Premier Moharram', '2021-08-10', '2021-08-11', 2),
(7, 'Journée de Oued Ed-Dahab', '2021-08-14', '2021-08-15', 1),
(8, 'La révolution du roi et du peuple', '2021-08-20', '2021-08-21', 1),
(9, 'Fête de la jeunesse', '2021-08-21', '2021-08-22', 1),
(10, 'Aid al Mawlid Annabawi', '2021-02-14', '2021-02-21', 2),
(11, 'Marche verte', '2021-11-08', '2021-11-07', 1),
(12, 'Fête de l’indépendance', '2021-11-18', '2021-11-19', 1),
(13, 'Premier janvier', '2021-01-01', '2021-01-02', 1),
(14, 'fgdsg', '2021-02-18', '2021-02-17', 1);

-- --------------------------------------------------------

--
-- Structure de la table `companies`
--

DROP TABLE IF EXISTS `companies`;
CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `companies`
--

INSERT INTO `companies` (`id`, `name`) VALUES
(1, 'Wave'),
(2, 'Gozil');

-- --------------------------------------------------------

--
-- Structure de la table `crons`
--

DROP TABLE IF EXISTS `crons`;
CREATE TABLE IF NOT EXISTS `crons` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date_execution` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `crons`
--

INSERT INTO `crons` (`id`, `date_execution`) VALUES
(2, '2021-02-01');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `holidays`
--

DROP TABLE IF EXISTS `holidays`;
CREATE TABLE IF NOT EXISTS `holidays` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `holidays`
--

INSERT INTO `holidays` (`id`, `type`) VALUES
(1, 'Annual vacation'),
(2, 'Other');

-- --------------------------------------------------------

--
-- Structure de la table `holiday_type`
--

DROP TABLE IF EXISTS `holiday_type`;
CREATE TABLE IF NOT EXISTS `holiday_type` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `holiday_type`
--

INSERT INTO `holiday_type` (`id`, `type`) VALUES
(1, 'Jours fériés civils'),
(2, 'Jours fériés religieux');

-- --------------------------------------------------------

--
-- Structure de la table `holyears`
--

DROP TABLE IF EXISTS `holyears`;
CREATE TABLE IF NOT EXISTS `holyears` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `holiday_id` int(10) UNSIGNED NOT NULL,
  `year_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `holyears_holiday_id_foreign` (`holiday_id`),
  KEY `holyears_year_id_foreign` (`year_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `holyears`
--

INSERT INTO `holyears` (`id`, `holiday_id`, `year_id`) VALUES
(8, 4, 1),
(7, 3, 1),
(6, 2, 1),
(5, 1, 1),
(9, 5, 1),
(10, 6, 1),
(11, 7, 1),
(12, 8, 1),
(13, 9, 1),
(14, 10, 1),
(15, 11, 1),
(16, 12, 1),
(17, 13, 1),
(18, 14, 1);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2020_12_19_094824_create_roles_table', 2),
(6, '2020_12_19_101849_create_role_user_table', 2),
(7, '2020_12_21_125423_create_role_user_table', 3),
(8, '2020_12_21_135648_rename_name_on_users_to_firstname', 4),
(9, '2020_12_21_135923_rename_name_column_on_users_to_firstname', 5),
(10, '2020_12_21_143636_add_columns_to_users_table', 6),
(11, '2020_12_21_144356_create_companies_table', 7),
(12, '2020_12_21_144601_add_column_company_to_users_table', 8),
(13, '2020_12_23_143107_update_role_user_role_id_to_role_user', 9),
(14, '2020_12_23_143906_update_colunms_role_user_role_id_to_role_user', 10),
(15, '2020_12_30_161443_create_statutes_table', 11),
(18, '2020_12_30_162005_create_requests_table', 12),
(19, '2020_12_31_092438_create_actions_table', 12),
(21, '2020_12_31_092957_create_requests_history_table', 13),
(22, '2020_12_31_103848_create_years_table', 14),
(23, '2020_12_31_103939_create_bank_holiday_table', 15),
(24, '2020_12_31_104026_create_holiday_type_table', 16),
(25, '2020_12_31_110309_create_holyears_table', 17),
(26, '2020_12_31_111013_create_holidays_table', 18),
(27, '2020_12_31_113441_add_user_id_to_requests_table', 19),
(28, '2020_12_31_113538_add_request_id_to_requests_history_table', 20),
(29, '2020_12_31_113846_add_holidaytype_to_requests_history_table', 21),
(30, '2020_12_31_144516_add_columns_to_bank_holiday', 22),
(31, '2021_01_05_133102_update_colunms_bank_holiday', 23),
(32, '2021_01_22_083838_add_token_token_startd_token_endd_to_users_table', 24),
(33, '2021_01_22_091530_update_token_token_colums_users_table', 25),
(34, '2021_02_03_133229_create_cron_table', 26),
(35, '2021_02_03_161802_create_crons_table', 27),
(36, '2021_02_05_131037_add_holymail_column_to_users_table', 28),
(37, '2021_02_05_131349_add_holymail_column_to_users_table', 29),
(38, '2021_02_08_155535_add_reset_token_to_users_table', 30);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `requests`
--

DROP TABLE IF EXISTS `requests`;
CREATE TABLE IF NOT EXISTS `requests` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `archived` tinyint(4) DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `requests_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `requests`
--

INSERT INTO `requests` (`id`, `archived`, `user_id`) VALUES
(1, NULL, 106),
(2, 0, 117),
(3, NULL, 106),
(4, NULL, 106),
(5, 1, 116),
(6, NULL, 106),
(7, NULL, 116),
(8, NULL, 117);

-- --------------------------------------------------------

--
-- Structure de la table `requests_history`
--

DROP TABLE IF EXISTS `requests_history`;
CREATE TABLE IF NOT EXISTS `requests_history` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `dayscount` double(3,1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `admincomment` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `leaving_at_evening` tinyint(4) DEFAULT NULL,
  `coming_at_evening` tinyint(4) DEFAULT NULL,
  `latest_action` tinyint(3) UNSIGNED DEFAULT NULL,
  `statut` int(10) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED DEFAULT NULL,
  `request_id` int(10) UNSIGNED NOT NULL,
  `holidaytype` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `requests_history_latest_action_foreign` (`latest_action`),
  KEY `requests_history_statut_foreign` (`statut`),
  KEY `requests_history_admin_foreign` (`admin_id`),
  KEY `requests_history_request_id_foreign` (`request_id`),
  KEY `requests_history_holidaytype_foreign` (`holidaytype`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `requests_history`
--

INSERT INTO `requests_history` (`id`, `start_date`, `end_date`, `dayscount`, `updated_at`, `admincomment`, `comment`, `leaving_at_evening`, `coming_at_evening`, `latest_action`, `statut`, `admin_id`, `request_id`, `holidaytype`) VALUES
(1, '2021-02-10', '2021-02-11', 1.0, '2021-02-09 14:45:34', NULL, NULL, 0, 0, NULL, 1, NULL, 2, 1),
(2, '2021-02-10', '2021-02-11', 1.0, '2021-02-09 14:49:45', NULL, NULL, 0, 0, 7, 5, 106, 2, 1),
(3, '2021-02-10', '2021-02-11', 1.0, '2021-02-09 14:50:06', NULL, NULL, 0, 0, 8, 1, 106, 2, 1),
(4, '2021-02-10', '2021-02-11', 1.0, '2021-02-09 14:50:23', NULL, NULL, 0, 0, 4, 2, 106, 2, 1),
(5, '2021-02-15', '2021-02-16', 1.0, '2021-02-09 15:40:44', NULL, NULL, 0, 0, NULL, 1, NULL, 3, 1),
(6, '2021-02-19', '2021-02-21', 2.0, '2021-02-11 14:20:29', NULL, NULL, 0, 0, NULL, 1, NULL, 4, 1),
(7, '2021-02-19', '2021-02-21', 2.0, '2021-02-11 14:21:40', NULL, NULL, 0, 0, 2, 1, NULL, 4, 1),
(8, '2021-02-19', '2021-02-21', 2.0, '2021-02-11 14:21:57', NULL, NULL, 0, 0, 5, 3, 106, 4, 1),
(9, '2021-02-12', '2021-02-13', 1.0, '2021-02-11 14:22:50', NULL, NULL, 0, 0, NULL, 1, NULL, 5, 1),
(10, '2021-02-12', '2021-02-13', 1.0, '2021-02-11 14:23:24', NULL, NULL, 0, 0, 7, 5, 106, 5, 1),
(11, '2021-02-27', '2021-02-28', 1.0, '2021-02-11 14:35:03', NULL, NULL, 0, 0, NULL, 1, NULL, 6, 1),
(12, '2021-02-13', '2021-02-14', 1.0, '2021-02-11 15:34:18', NULL, NULL, 0, 0, NULL, 1, NULL, 7, 1),
(13, '2021-02-22', '2021-02-23', 0.5, '2021-02-15 19:55:56', NULL, NULL, 0, 0, NULL, 1, NULL, 8, 1);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(2, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  KEY `role_user_role_id_foreign` (`role_id`),
  KEY `role_user_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`) VALUES
(2, 2),
(2, 64),
(2, 66),
(2, 63),
(2, 67),
(2, 73),
(1, 1),
(2, 83),
(2, 85),
(2, 91),
(2, 92),
(2, 97),
(2, 98),
(2, 99),
(2, 100),
(2, 101),
(2, 102),
(2, 103),
(2, 104),
(2, 105),
(2, 106),
(2, 107);

-- --------------------------------------------------------

--
-- Structure de la table `statutes`
--

DROP TABLE IF EXISTS `statutes`;
CREATE TABLE IF NOT EXISTS `statutes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `statutes`
--

INSERT INTO `statutes` (`id`, `name`, `label`) VALUES
(1, 'Being validated', 'primary'),
(2, 'Validated', 'success'),
(3, 'Refused', 'danger'),
(4, 'Canceled', 'warning'),
(5, 'Archived', 'default');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(1) DEFAULT '0',
  `statut` tinyint(1) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `hiredate` date DEFAULT NULL,
  `balance` double(3,1) DEFAULT NULL,
  `tel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `cin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cnss` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manager` int(11) DEFAULT NULL,
  `connected_at` datetime DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `token` int(11) DEFAULT NULL,
  `Token_startD` timestamp NULL DEFAULT NULL,
  `Token_endD` timestamp NULL DEFAULT NULL,
  `reset_token` int(11) DEFAULT NULL,
  `reset_token_startd` timestamp NULL DEFAULT NULL,
  `reset_token_endd` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_company_foreign` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `admin`, `statut`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `hiredate`, `balance`, `tel`, `address`, `birthdate`, `cin`, `cnss`, `manager`, `connected_at`, `company_id`, `token`, `Token_startD`, `Token_endD`, `reset_token`, `reset_token_startd`, `reset_token_endd`) VALUES
(106, 'Meriem', 'Laayouni', 'laayouni.meriem00@gmail.com', 1, 1, NULL, '$2y$10$F75HmR/90xqDuJN2ZPzjlu9XtX4L1bU2QJF3ijxz5kSLgDfDRvl.i', 'nBgMQnJKMTzYsrqayGAETEm7knfrqF3TthnK7ZRstY8HrjL1mMy5ybESP6Zm', '2021-02-01 10:08:33', '2021-02-15 18:26:40', '2021-02-01', 65.0, '0612345624', 'Lot Talhaoui n°232 rue al irfane، Oujda 60000, Maroc', '2000-11-09', 'SB8668', 'AB542', NULL, '2021-02-15 19:26:40', 1, 277279, '2021-02-01 11:08:33', '2021-02-01 11:13:33', NULL, NULL, NULL),
(116, 'Maria', 'Kendji', 'qunubexa-1915@yopmail.com', 0, 1, NULL, '$2y$10$rSay7ozIebdFb1KuPK9LrecphDO8AQbPeGAA0SEEn55Lz/PR/eWY.', 'HSHtMvRYv2DYQT5LZR3bmuE3RJgjOgrjAl7QDU3EOUsXRAK99ExFSg2oL80h', '2021-02-05 16:42:27', '2021-02-15 18:59:10', '2021-02-01', 2.5, '0612345690', 'Rue el jazouli ,oujda,Maroc', '2003-02-03', 'S124567', 'Q1234', 106, '2021-02-11 16:52:00', 1, 182806, '2021-02-05 17:42:27', '2021-02-05 17:47:27', 569931, '2021-02-11 16:49:22', '2021-02-11 16:54:22'),
(117, 'Meriem', 'Meriem', 'meriem.laayouni@ump.ac.ma', 0, 1, NULL, '$2y$10$MRPfVKtuA5yBCp3OFLbcaeN8aI2D8vcVfFHMkynftYXJSdXssBEBK', 'N5mrum1queCiSYabkgKUcrAO27PxJUEXF1ZELynhnhh19TNiSTNvXEw664OE', '2021-02-08 12:04:27', '2021-02-15 18:53:50', '2021-02-07', 19.0, '0612345600', '8,Rue le caire , quartier et ABBADI , Temara , le Maroc', '1968-01-09', 'SB8668', 'A141478', 106, '2021-02-15 19:53:50', 2, 0, NULL, NULL, 249347, '2021-02-15 19:51:05', '2021-02-15 19:56:05');

-- --------------------------------------------------------

--
-- Structure de la table `years`
--

DROP TABLE IF EXISTS `years`;
CREATE TABLE IF NOT EXISTS `years` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `year` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `years`
--

INSERT INTO `years` (`id`, `year`) VALUES
(1, 2021),
(11, 2022),
(20, 2023),
(21, 2024),
(22, 2025),
(23, 2026),
(24, 2027),
(25, 2028),
(26, 2029);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
