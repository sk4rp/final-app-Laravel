-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Сен 19 2024 г., 21:36
-- Версия сервера: 5.7.24
-- Версия PHP: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `final`
--

-- --------------------------------------------------------

--
-- Структура таблицы `clicks`
--

CREATE TABLE `clicks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `offer_id` bigint(20) UNSIGNED NOT NULL,
  `webmaster_id` bigint(20) UNSIGNED NOT NULL,
  `client_ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clicked_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `clicks`
--

INSERT INTO `clicks` (`id`, `offer_id`, `webmaster_id`, `client_ip`, `clicked_at`, `created_at`, `updated_at`) VALUES
(1, 21, 42, '185.222.218.21', '2023-10-07 16:06:09', '2024-09-19 13:03:39', '2024-09-19 13:03:39'),
(2, 22, 44, '23.67.232.251', '2024-02-18 12:20:40', '2024-09-19 13:03:39', '2024-09-19 13:03:39'),
(3, 23, 46, '207.132.45.146', '2024-01-25 12:18:53', '2024-09-19 13:03:39', '2024-09-19 13:03:39'),
(4, 24, 48, '247.65.74.185', '2024-07-31 10:18:31', '2024-09-19 13:03:39', '2024-09-19 13:03:39'),
(5, 25, 50, '205.105.208.24', '2024-01-20 08:21:26', '2024-09-19 13:03:39', '2024-09-19 13:03:39'),
(6, 26, 52, '46.166.215.15', '2024-03-19 22:13:39', '2024-09-19 13:03:39', '2024-09-19 13:03:39'),
(7, 27, 54, '1.33.108.108', '2024-07-01 11:15:27', '2024-09-19 13:03:39', '2024-09-19 13:03:39'),
(8, 28, 56, '47.76.38.15', '2024-07-11 23:29:46', '2024-09-19 13:03:39', '2024-09-19 13:03:39'),
(9, 29, 58, '250.73.170.238', '2024-05-10 02:59:25', '2024-09-19 13:03:39', '2024-09-19 13:03:39'),
(10, 30, 60, '239.181.137.166', '2024-02-18 04:27:11', '2024-09-19 13:03:39', '2024-09-19 13:03:39');

-- --------------------------------------------------------

--
-- Структура таблицы `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `offer_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `expenses`
--

INSERT INTO `expenses` (`id`, `offer_id`, `amount`, `date`, `created_at`, `updated_at`) VALUES
(1, 31, '12.72', '2003-12-31', '2024-09-19 13:03:40', '2024-09-19 13:03:40'),
(2, 32, '97.99', '1971-04-13', '2024-09-19 13:03:40', '2024-09-19 13:03:40'),
(3, 33, '38.06', '2006-05-16', '2024-09-19 13:03:40', '2024-09-19 13:03:40'),
(4, 34, '20.65', '1985-03-16', '2024-09-19 13:03:40', '2024-09-19 13:03:40'),
(5, 35, '99.77', '1987-02-04', '2024-09-19 13:03:40', '2024-09-19 13:03:40'),
(6, 36, '71.01', '1983-09-07', '2024-09-19 13:03:40', '2024-09-19 13:03:40'),
(7, 37, '72.49', '1973-11-18', '2024-09-19 13:03:40', '2024-09-19 13:03:40'),
(9, 39, '49.56', '2004-04-09', '2024-09-19 13:03:40', '2024-09-19 13:03:40'),
(10, 40, '24.69', '2006-07-21', '2024-09-19 13:03:40', '2024-09-19 13:03:40');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(13, '2014_10_12_000000_create_users_table', 1),
(14, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(15, '2024_09_19_171409_create_offers_table', 1),
(16, '2024_09_19_171517_create_expenses_table', 1),
(17, '2024_09_19_171529_create_clicks_table', 1),
(18, '2024_09_19_171551_create_offer_subscriptions_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `advertiser_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost_per_click` decimal(8,2) NOT NULL,
  `target_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_themes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `offers`
--

INSERT INTO `offers` (`id`, `advertiser_id`, `name`, `cost_per_click`, `target_url`, `site_themes`, `is_active`, `created_at`, `updated_at`) VALUES
(4, 14, 'blanditiis', '2.71', 'http://www.boyer.com/', 'dignissimos, eum, laborum', 1, '2024-09-19 13:03:32', '2024-09-19 13:03:32'),
(5, 15, 'ea', '4.16', 'http://www.koss.com/odit-sit-nihil-qui-laborum-vitae-optio.html', 'et, dolorem, culpa', 0, '2024-09-19 13:03:32', '2024-09-19 13:03:32'),
(6, 16, 'et', '4.84', 'https://legros.info/voluptatem-porro-tempore-sit-id-voluptatem.html', 'ipsam, illum, expedita', 1, '2024-09-19 13:03:32', '2024-09-19 13:03:32'),
(7, 17, 'mollitia', '2.89', 'http://kling.org/recusandae-explicabo-reprehenderit-ipsam-quia', 'aut, et, vel', 1, '2024-09-19 13:03:32', '2024-09-19 13:03:32'),
(8, 18, 'eius', '3.99', 'http://www.graham.com/', 'autem, voluptates, et', 1, '2024-09-19 13:03:32', '2024-09-19 13:03:32'),
(9, 19, 'dolores', '1.90', 'http://runolfsdottir.com/inventore-quas-possimus-et-ipsam-officiis.html', 'eligendi, eum, et', 0, '2024-09-19 13:03:32', '2024-09-19 13:03:32'),
(10, 20, 'sapiente', '3.41', 'http://www.block.com/et-sit-eaque-placeat-accusantium-id-modi', 'consectetur, et, laboriosam', 0, '2024-09-19 13:03:32', '2024-09-19 13:03:32'),
(11, 22, 'dolor', '2.13', 'https://ryan.com/id-accusamus-et-voluptatem-molestiae-porro.html', 'nobis, ducimus, aut', 1, '2024-09-19 13:03:32', '2024-09-19 13:03:32'),
(12, 24, 'voluptas', '2.89', 'http://www.roberts.com/', 'molestias, et, veritatis', 0, '2024-09-19 13:03:33', '2024-09-19 13:03:33'),
(13, 26, 'accusamus', '4.65', 'http://larkin.org/aspernatur-quidem-ab-qui-delectus-porro-iste-laboriosam.html', 'voluptas, nobis, autem', 1, '2024-09-19 13:03:33', '2024-09-19 13:03:33'),
(14, 28, 'voluptatem', '2.47', 'http://hahn.org/', 'quos, inventore, quia', 1, '2024-09-19 13:03:33', '2024-09-19 13:03:33'),
(15, 30, 'libero', '4.85', 'http://www.beahan.info/', 'distinctio, eos, quam', 0, '2024-09-19 13:03:34', '2024-09-19 13:03:34'),
(16, 32, 'culpa', '1.53', 'http://www.considine.org/fuga-dolorem-perferendis-voluptas-ea.html', 'iste, voluptatum, iusto', 0, '2024-09-19 13:03:34', '2024-09-19 13:03:34'),
(17, 34, 'tempora', '2.45', 'http://www.ernser.net/', 'sunt, voluptatum, repellendus', 1, '2024-09-19 13:03:34', '2024-09-19 13:03:34'),
(18, 36, 'corporis', '4.04', 'http://dickinson.net/voluptate-suscipit-beatae-voluptas-distinctio', 'dicta, rerum, aliquid', 0, '2024-09-19 13:03:35', '2024-09-19 13:03:35'),
(19, 38, 'voluptatem', '0.59', 'https://daugherty.com/repellat-ut-repellendus-quisquam-doloribus-nulla-labore-aut-quaerat.html', 'iusto, sit, qui', 1, '2024-09-19 13:03:35', '2024-09-19 13:03:35'),
(20, 40, 'quis', '0.94', 'http://mcclure.info/animi-atque-ea-error-aut-sint-in', 'dignissimos, voluptas, perspiciatis', 1, '2024-09-19 13:03:35', '2024-09-19 13:03:35'),
(21, 41, 'voluptatem', '3.29', 'https://jacobi.biz/autem-voluptas-alias-rerum-amet-consequatur-quos-earum-fuga.html', 'nisi, assumenda, doloribus', 0, '2024-09-19 13:03:36', '2024-09-19 13:03:36'),
(22, 43, 'vel', '1.97', 'http://www.hagenes.com/', 'et, nemo, officia', 0, '2024-09-19 13:03:36', '2024-09-19 13:03:36'),
(23, 45, 'aut', '4.43', 'https://donnelly.com/est-voluptatibus-recusandae-unde-ratione-iste-sit.html', 'voluptas, animi, enim', 1, '2024-09-19 13:03:36', '2024-09-19 13:03:36'),
(24, 47, 'nobis', '3.33', 'http://www.mann.com/itaque-eaque-autem-reiciendis-velit-reiciendis-nostrum.html', 'temporibus, expedita, quos', 1, '2024-09-19 13:03:37', '2024-09-19 13:03:37'),
(25, 49, 'qui', '3.29', 'http://gulgowski.net/dolor-pariatur-ducimus-aut-dolor-culpa.html', 'repellendus, ipsam, debitis', 1, '2024-09-19 13:03:37', '2024-09-19 13:03:37'),
(26, 51, 'mollitia', '1.82', 'http://maggio.com/sit-voluptate-nulla-quasi.html', 'sequi, sunt, consequatur', 1, '2024-09-19 13:03:37', '2024-09-19 13:03:37'),
(27, 53, 'rerum', '0.93', 'http://gerhold.net/', 'saepe, ut, saepe', 0, '2024-09-19 13:03:38', '2024-09-19 13:03:38'),
(28, 55, 'sunt', '1.60', 'https://witting.org/consequuntur-hic-omnis-praesentium-praesentium-accusantium-maxime.html', 'aut, adipisci, aperiam', 1, '2024-09-19 13:03:38', '2024-09-19 13:03:38'),
(29, 57, 'consectetur', '1.56', 'http://www.zemlak.org/sit-culpa-consequuntur-doloribus', 'pariatur, consectetur, dolorum', 0, '2024-09-19 13:03:38', '2024-09-19 13:03:38'),
(30, 59, 'voluptatem', '0.72', 'http://www.collier.com/', 'et, et, sint', 1, '2024-09-19 13:03:39', '2024-09-19 13:03:39'),
(31, 61, 'officia', '2.42', 'http://www.cole.com/', 'et, veniam, consequuntur', 1, '2024-09-19 13:03:39', '2024-09-19 13:03:39'),
(32, 62, 'quisquam', '2.63', 'https://littel.com/enim-aut-odit-aperiam-enim.html', 'adipisci, quo, odio', 1, '2024-09-19 13:03:39', '2024-09-19 13:03:39'),
(33, 63, 'dolor', '4.62', 'http://graham.com/quis-cumque-dolores-placeat-voluptatum-beatae-eum-et', 'blanditiis, dolorum, sint', 1, '2024-09-19 13:03:39', '2024-09-19 13:03:39'),
(34, 64, 'aut', '3.94', 'http://www.marquardt.com/modi-cum-commodi-laborum-aut-eligendi-consequuntur-ullam', 'soluta, assumenda, repellendus', 1, '2024-09-19 13:03:39', '2024-09-19 13:03:39'),
(35, 65, 'et', '3.66', 'http://mitchell.com/officia-perspiciatis-non-nulla-et-deleniti-odit-aut.html', 'pariatur, at, vel', 1, '2024-09-19 13:03:40', '2024-09-19 13:03:40'),
(36, 66, 'ad', '2.21', 'http://www.heller.com/dolore-et-ut-ipsa-sed-aut.html', 'quam, velit, quos', 0, '2024-09-19 13:03:40', '2024-09-19 13:03:40'),
(37, 67, 'ipsum', '2.71', 'http://shields.com/', 'aliquid, beatae, consequatur', 0, '2024-09-19 13:03:40', '2024-09-19 13:03:40'),
(39, 69, 'tempore', '3.87', 'https://www.purdy.biz/enim-eum-cupiditate-ut-ex', 'ut, voluptatibus, deleniti', 1, '2024-09-19 13:03:40', '2024-09-19 13:03:40'),
(40, 70, 'quis', '4.13', 'http://pollich.info/culpa-labore-accusamus-ut-libero-in-mollitia', 'in, deleniti, cupiditate', 0, '2024-09-19 13:03:40', '2024-09-19 13:03:40'),
(41, 68, 'вывыфвыфвфывыф', '111.00', 'http://bashirian.com/possimuds', 'fdsfsd', 1, '2024-09-19 14:21:39', '2024-09-19 14:21:44');

-- --------------------------------------------------------

--
-- Структура таблицы `offer_subscriptions`
--

CREATE TABLE `offer_subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `webmaster_id` bigint(20) UNSIGNED NOT NULL,
  `offer_id` bigint(20) UNSIGNED NOT NULL,
  `cost_per_click` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `offer_subscriptions`
--

INSERT INTO `offer_subscriptions` (`id`, `webmaster_id`, `offer_id`, `cost_per_click`, `created_at`, `updated_at`) VALUES
(1, 21, 11, '0.54', '2024-09-19 13:03:35', '2024-09-19 13:03:35'),
(2, 23, 12, '2.48', '2024-09-19 13:03:35', '2024-09-19 13:03:35'),
(3, 25, 13, '4.11', '2024-09-19 13:03:35', '2024-09-19 13:03:35'),
(4, 27, 14, '2.16', '2024-09-19 13:03:35', '2024-09-19 13:03:35'),
(5, 29, 15, '0.58', '2024-09-19 13:03:35', '2024-09-19 13:03:35'),
(6, 31, 16, '0.58', '2024-09-19 13:03:35', '2024-09-19 13:03:35'),
(7, 33, 17, '4.93', '2024-09-19 13:03:35', '2024-09-19 13:03:35'),
(8, 35, 18, '0.79', '2024-09-19 13:03:35', '2024-09-19 13:03:35'),
(9, 37, 19, '4.34', '2024-09-19 13:03:35', '2024-09-19 13:03:35'),
(10, 39, 20, '1.54', '2024-09-19 13:03:35', '2024-09-19 13:03:35'),
(14, 71, 39, '0.05', '2024-09-19 15:41:57', '2024-09-19 15:41:57'),
(15, 71, 41, '0.02', '2024-09-19 16:19:51', '2024-09-19 16:19:51');

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('advertiser','webmaster','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(4, 'Prof. Claud Murray PhD', 'xritchie@example.org', '$2y$12$y.FMcxOOo2gzFtS0inttr.IyToNwRCm4ez4kFqHnicPTGsVL6PCLi', 'advertiser', '2024-09-19 13:03:30', '2024-09-19 13:03:30'),
(5, 'Bartholome Borer Sr.', 'lindgren.houston@example.org', '$2y$12$r0k6DQORfMKSte540FqpNurDbKxgChcTfOdC4Xkuk3XKLu/YB7OVC', 'admin', '2024-09-19 13:03:30', '2024-09-19 13:03:30'),
(6, 'Katarina Hettinger', 'theresa12@example.org', '$2y$12$RQDLm52.YxASDVwpuxa.uuKtgbeURrvop3VqpNsmFBHlOkP2ghb.G', 'advertiser', '2024-09-19 13:03:30', '2024-09-19 13:03:30'),
(7, 'Hazel Jenkins MD', 'runolfsdottir.winston@example.net', '$2y$12$/OHHtd5i/9I4oYISS.A2OeGXi0vTeU/L903N2VwyctWg39SC8vLU.', 'advertiser', '2024-09-19 13:03:30', '2024-09-19 13:03:30'),
(8, 'Marion Keeling', 'okuneva.ernesto@example.org', '$2y$12$RuiJum4tLnJC4ig5S4SiaOMgsAnFP57GmRBl0Wi8Kgfdtfb1qoTF.', 'admin', '2024-09-19 13:03:30', '2024-09-19 13:03:30'),
(9, 'Prof. Brice Hoppe', 'keeley.pacocha@example.org', '$2y$12$49NrChJJNnyc6T00ztRoQuc9X.8PahUDFTxkvK5TW1S0F8VEJMjse', 'advertiser', '2024-09-19 13:03:30', '2024-09-19 13:03:30'),
(10, 'Golden Beier', 'manuel28@example.net', '$2y$12$WtnSDgvMNa/7JKjkAspu8ecBSLWpFRbuphYr6cbrt/Gc9k6q6BW4u', 'advertiser', '2024-09-19 13:03:30', '2024-09-19 13:03:30'),
(11, 'Maggie Streich', 'orn.darryl@example.com', '$2y$12$WRd5.TF3eR.P6gRFXLRcV.xfbDt8hIWmcjpOjKc2PKiyYuRS/gZwq', 'admin', '2024-09-19 13:03:31', '2024-09-19 13:03:31'),
(12, 'Kim Effertz', 'mkeeling@example.org', '$2y$12$b91zzxm7lalntOJnyud6ce/90WckgXLOTbMGLNBhcfK/MEkHWrAOW', 'webmaster', '2024-09-19 13:03:31', '2024-09-19 13:03:31'),
(13, 'Miss Reina Gutkowski', 'kovacek.ole@example.com', '$2y$12$qkthF/XI0rFieOXQiMPOn.4Kk6TXJ3/hIMOnzoxtBvy0W6ofw6Ppq', 'admin', '2024-09-19 13:03:31', '2024-09-19 13:03:31'),
(14, 'Dr. Jesse Bogisich', 'florence.kris@example.net', '$2y$12$VJknLu9XY6tjIIiHk3xOreO4ujsJFldfMp6vxax1F2h2dl.32lpU6', 'admin', '2024-09-19 13:03:31', '2024-09-19 13:03:31'),
(15, 'Breana Stiedemann Jr.', 'orrin.ebert@example.org', '$2y$12$dVhMo/dHW9cpThz.1haPge/ZBN5qrwKR2bzjHPwjYmRJYEGGjo7x.', 'advertiser', '2024-09-19 13:03:31', '2024-09-19 13:03:31'),
(16, 'Janelle Medhurst Jr.', 'ihilpert@example.com', '$2y$12$uP9ytn/DeF7WA1fHU5Add.q1XTSSBj93tPbHVEL8PEb/1akM9tgr6', 'advertiser', '2024-09-19 13:03:31', '2024-09-19 13:03:31'),
(17, 'Dr. Christiana Littel', 'swaniawski.dedric@example.com', '$2y$12$V//sNnMrvsQPzxa9fyjKd.5yJy14hxGIXUG5WpONJHdua3eriNWcu', 'advertiser', '2024-09-19 13:03:32', '2024-09-19 13:03:32'),
(18, 'Prof. Joseph Hegmann DVM', 'freeda83@example.com', '$2y$12$SwjvGJ6nj4I8nDp0Yom90elJ5.5UPC3lxcu.SgMP0NbNIGmzrOX6u', 'webmaster', '2024-09-19 13:03:32', '2024-09-19 13:03:32'),
(19, 'Amani Kihn', 'elva78@example.org', '$2y$12$ZQvqu5xUpUoZAFGgXLhqzuwuP3MOCShYIA9WM5f08mZxsml5X6l9q', 'webmaster', '2024-09-19 13:03:32', '2024-09-19 13:03:32'),
(20, 'Dusty Conn', 'abdullah91@example.net', '$2y$12$U./0CEoEJiuaZHzl7/EAoOt6VELcnj6iljWjrAnvRFZhO1pE.H5E2', 'advertiser', '2024-09-19 13:03:32', '2024-09-19 13:03:32'),
(21, 'Ms. Bulah McLaughlin PhD', 'maxine.sauer@example.com', '$2y$12$a6BFLiFFOzpWxKJ2.AdKw.x5a1gx6rdyzKzC7PoPBiZ760mpch8cK', 'webmaster', '2024-09-19 13:03:32', '2024-09-19 13:03:32'),
(22, 'Mr. Brooks Kuvalis IV', 'rgleichner@example.net', '$2y$12$0xXzucBGjaS8tYirpRsASuVzG1rxemeW.j5rqzB2sFk4ua2t6fNDW', 'advertiser', '2024-09-19 13:03:32', '2024-09-19 13:03:32'),
(23, 'Elwyn Yundt', 'fgerlach@example.org', '$2y$12$Vl9ZUXu2jd0VlQKyLY8AcupbqlIcECxnM/S5GwVvezLmqYZ9AiUMi', 'webmaster', '2024-09-19 13:03:33', '2024-09-19 13:03:33'),
(24, 'Ms. Anabelle Yost III', 'finn98@example.net', '$2y$12$uOe7clWZHSZzyIe3bM1UwufMoZdtl/aSwYUQ/clTkh0awS0JqHaqC', 'advertiser', '2024-09-19 13:03:33', '2024-09-19 13:03:33'),
(25, 'Mrs. Imogene O\'Connell', 'joaquin52@example.org', '$2y$12$goox6ms6uM8of6wiymhk0OwjFROeto9PW7sIV5UCprHWf8iqkYogO', 'webmaster', '2024-09-19 13:03:33', '2024-09-19 13:03:33'),
(26, 'Tess Kassulke', 'gertrude25@example.org', '$2y$12$Q.Cai6HWqdE7csuKyJQsJutQ4165.oliSeA9jipYT.C.7r/zhrHo6', 'webmaster', '2024-09-19 13:03:33', '2024-09-19 13:03:33'),
(27, 'Leonel Hill', 'dee88@example.net', '$2y$12$mk1vSQ5WnttcwHaDGSO2X.rajlH3cZTeRcrHWpdoGmLRVcJDr7v0m', 'webmaster', '2024-09-19 13:03:33', '2024-09-19 13:03:33'),
(28, 'Winfield Schimmel', 'jaskolski.betty@example.org', '$2y$12$nfPaYmHmzkKP6dx58Jta2e1h8tHwYyibch12hC0WpZQwXSoPzr0im', 'advertiser', '2024-09-19 13:03:33', '2024-09-19 13:03:33'),
(29, 'Israel Tremblay', 'athiel@example.net', '$2y$12$Pl33J2tnal.H6LKpDipgreLIwr7FpbEu4OWmRHm39TxFSn17srZYe', 'webmaster', '2024-09-19 13:03:34', '2024-09-19 13:03:34'),
(30, 'Sophia Marquardt III', 'osvaldo.mcclure@example.org', '$2y$12$TpfVY5rZpYE2PFdbO2SWU.tdSrq9Pqk0tyisj7k9RXFCqHpAPo1kG', 'admin', '2024-09-19 13:03:34', '2024-09-19 13:03:34'),
(31, 'Mr. Cameron Howell II', 'wortiz@example.net', '$2y$12$2rgRi8SAs30Fo5bEI8kdVehvfSy9PlzPAKHCF1fLoQ2LGXvian/8a', 'webmaster', '2024-09-19 13:03:34', '2024-09-19 13:03:34'),
(32, 'Ewald Mayert', 'taya.conroy@example.com', '$2y$12$JjJP9SMAZarn2KH.dWCnmeccHA/yKN/mocGiQT/WxKQY36WeFqYci', 'webmaster', '2024-09-19 13:03:34', '2024-09-19 13:03:34'),
(33, 'Gabe Mann', 'miller.alexanne@example.net', '$2y$12$06qXBolcbI6QUdxVI0HikufkKzpwv.mep8KDcTLWWQxnkqq.h.9Tq', 'webmaster', '2024-09-19 13:03:34', '2024-09-19 13:03:34'),
(34, 'Prof. Tomasa Feeney', 'pauline.koch@example.com', '$2y$12$cC0P6QYT5EKunHuxLOWC1edDLEgTlW0Roje2NCr95GZsujWy57202', 'webmaster', '2024-09-19 13:03:34', '2024-09-19 13:03:34'),
(35, 'Connie Leffler V', 'ikuhn@example.com', '$2y$12$0.SLwqZdCkFQDMVkBU29HubE3pKH51Ia/uCDCLD6nApuZTwoRH.9y', 'webmaster', '2024-09-19 13:03:35', '2024-09-19 13:03:35'),
(36, 'Alejandrin Kertzmann', 'hubert04@example.org', '$2y$12$86Ly8n/N4uweMa5WF70eMea2rAkhDq8AuWgZIjmS2ET4I4QEf5PSe', 'admin', '2024-09-19 13:03:35', '2024-09-19 13:03:35'),
(37, 'Bettye Little Sr.', 'keagan41@example.net', '$2y$12$S9QgrFEvQG743L6IR4osfetntLYjFTrye3BqgBeeNjusIBLdnB5aa', 'webmaster', '2024-09-19 13:03:35', '2024-09-19 13:03:35'),
(38, 'Dr. Gianni Dickinson Sr.', 'collier.alexie@example.org', '$2y$12$VA/o2XBzZVRaWtVMPadsjOw39ahVYqqprTECSxqeUCVYdZuSx7w92', 'admin', '2024-09-19 13:03:35', '2024-09-19 13:03:35'),
(39, 'Marco Jones', 'cparker@example.com', '$2y$12$cLphtQorz7G2avslSq4wiuQGp/4gQXHvopxzeDLFfJy/Y2fQMjZFa', 'webmaster', '2024-09-19 13:03:35', '2024-09-19 13:03:35'),
(40, 'Mr. Elbert Lemke DDS', 'lynch.garret@example.net', '$2y$12$A5K3y0mCVx1vGMCZMypAh.A/oXWebay/R/1YksfiClrDEYyr6Buz.', 'webmaster', '2024-09-19 13:03:35', '2024-09-19 13:03:35'),
(41, 'Jamar Botsford', 'nienow.broderick@example.net', '$2y$12$s02xADxz1E7mQLn26UO02uWThc6XCMEiMnbf4nOAzGBbHPp4dttWC', 'webmaster', '2024-09-19 13:03:36', '2024-09-19 13:03:36'),
(42, 'Emerson Balistreri DVM', 'mills.ursula@example.com', '$2y$12$gOEuBeGsfP/Y7cR1K.F06.EVRu1SeEqI0nNxP3DoH5rkqOIXfvQqa', 'webmaster', '2024-09-19 13:03:36', '2024-09-19 13:03:36'),
(43, 'Aletha Kling', 'carter.princess@example.net', '$2y$12$GyLLqQTIRgris/LbGRuZJ.i0.lGpF7mYrMVe/W0HArSMZV83lo8hu', 'webmaster', '2024-09-19 13:03:36', '2024-09-19 13:03:36'),
(44, 'Dr. Justus Bruen I', 'vgrady@example.org', '$2y$12$fz/6hf7vokFY.CVy9ARhPuvvJb6/38oqpbiEVtXXZQzYZjz3Cpe1W', 'webmaster', '2024-09-19 13:03:36', '2024-09-19 13:03:36'),
(45, 'Dr. Jayson Bahringer II', 'jaqueline61@example.org', '$2y$12$P1FSUuOnAr/QstR1wJl34OaGj7baVxIkVKw9xpoDbi/yPwvZxsXfC', 'webmaster', '2024-09-19 13:03:36', '2024-09-19 13:03:36'),
(46, 'Casey Walter', 'rherman@example.net', '$2y$12$JwWjkRuLo9KpzX3JHY18PeG5fkU9KvyXJvVBnUoECOL7N6zruUm6q', 'webmaster', '2024-09-19 13:03:36', '2024-09-19 13:03:36'),
(47, 'Merle Grady', 'rebecca21@example.net', '$2y$12$EyhYUYNyV8418SAyIxqxPeHcjp6JvfkxopeD73HfODRlg79XTqn7y', 'advertiser', '2024-09-19 13:03:37', '2024-09-19 13:03:37'),
(48, 'Dr. Lemuel Goldner', 'stephania.schuppe@example.com', '$2y$12$CgKmQXK.YyfitKSC.ws2E.CbX/DxUVtLalca2Pu.T3YpeJ/B.nbdu', 'webmaster', '2024-09-19 13:03:37', '2024-09-19 13:03:37'),
(49, 'Prof. Ahmad Ward DVM', 'armstrong.jasper@example.com', '$2y$12$cdKsZIG88NRsmDXq30MNMOcQzOsgqmWQn0Ay8D1c08UCkNUbz4VN2', 'advertiser', '2024-09-19 13:03:37', '2024-09-19 13:03:37'),
(50, 'Shad McLaughlin', 'kuhlman.lionel@example.net', '$2y$12$CxTLaFzf0dTqfnG3z1q/JO8AIUjaM9kPS1lgl1XtbaT2fBEstosIS', 'webmaster', '2024-09-19 13:03:37', '2024-09-19 13:03:37'),
(51, 'Trinity Greenholt', 'ubaldo.wisozk@example.org', '$2y$12$74z6331PCbjcG45aL/GrOuO58OhTZcz7SXIqYu6BGVq/3aMmTDazG', 'admin', '2024-09-19 13:03:37', '2024-09-19 13:03:37'),
(52, 'Miss Letha Becker', 'dietrich.lucinda@example.net', '$2y$12$5eC4Hpvy75eFoJN191xaqeHyJN4OS0I9nif9o0d/Yvo6mvAwzasty', 'webmaster', '2024-09-19 13:03:37', '2024-09-19 13:03:37'),
(53, 'Kariane VonRueden', 'kgleichner@example.org', '$2y$12$EJhtLiK5Cz/T5BPAvwLGmOKMjUy/QwmbHWTI9ttpHsJ9DmPxzBbpi', 'advertiser', '2024-09-19 13:03:38', '2024-09-19 13:03:38'),
(54, 'Clinton Barton', 'ruthie65@example.com', '$2y$12$o2IScPn8vDUv0rkBqGi.nuGM3MU839jZq7ISkZbgoerdFe7HFZS.e', 'webmaster', '2024-09-19 13:03:38', '2024-09-19 13:03:38'),
(55, 'Prof. Nina Paucek Jr.', 'jazmyn87@example.org', '$2y$12$0XunIMduMy0lshsSeT.fMuw8KOGI/0GLOj77bbghuzkoa3qbeFDWe', 'admin', '2024-09-19 13:03:38', '2024-09-19 13:03:38'),
(56, 'Miss Mittie Deckow DDS', 'goyette.selena@example.org', '$2y$12$x0LWP5oQocKhshzPGK/cbu7gyA5kY5mzKzzmlXGI0v4x4QuQU20OS', 'webmaster', '2024-09-19 13:03:38', '2024-09-19 13:03:38'),
(57, 'Lawson Simonis', 'kilback.kellen@example.com', '$2y$12$ANQKovEFsCvguzGvd2vPf.NfM60/ZRfNGq7uft3fpc4KGdOqapSRO', 'advertiser', '2024-09-19 13:03:38', '2024-09-19 13:03:38'),
(58, 'Ms. Alyson Schultz', 'alessia55@example.org', '$2y$12$zKh/4DK7azXEOnIIG44S9eNGf.Guy7gRaA1mihulGAy3H0uSUl4Yq', 'webmaster', '2024-09-19 13:03:38', '2024-09-19 13:03:38'),
(59, 'Savannah Hyatt', 'august69@example.net', '$2y$12$baFh3e1zZ5M3T0wLlR8zweh12DuUq9pikfQXzzqLvif5h89QAc7ZC', 'advertiser', '2024-09-19 13:03:39', '2024-09-19 13:03:39'),
(60, 'Prof. Werner Carroll DVM', 'smith.keely@example.net', '$2y$12$jcnZxt6rkrV7LXjYKIi3ZuPh85KUeCfpmkGzA4salFljJlAXxF67K', 'webmaster', '2024-09-19 13:03:39', '2024-09-19 13:03:39'),
(61, 'Laney Mitchell', 'hermiston.kevon@example.org', '$2y$12$sHTd702Hw8wWeTcuXXkFS.9Asdj/utZjX9hZUNcTBRN80c1b3zLPO', 'advertiser', '2024-09-19 13:03:39', '2024-09-19 13:03:39'),
(62, 'Miss Krystal Welch', 'zhauck@example.com', '$2y$12$7taC8jqKrkHuJcDKN6D8T.nMJ67NhS0INYyJnxh6KHaPMk7p6QXEa', 'webmaster', '2024-09-19 13:03:39', '2024-09-19 13:03:39'),
(63, 'Brown Johnston DVM', 'cloyd08@example.org', '$2y$12$ppU4o2VqLTad5VsyuAP86eZGQK9yE4UFrtSEetz4xqH5I6WIL8mUG', 'admin', '2024-09-19 13:03:39', '2024-09-19 13:03:39'),
(64, 'Ed Bode', 'considine.nickolas@example.com', '$2y$12$rnGScpD6RJSqACZ/cxaoO.yRE1SIOx2h3/d4esKV4ju42eZOg36La', 'advertiser', '2024-09-19 13:03:39', '2024-09-19 13:03:39'),
(65, 'Janelle Lubowitz', 'erick39@example.net', '$2y$12$wqNtc5NC1W5aZQ2flG/huOibW8kTi9mGyDLHGv1scrT2Uyhy2/CaG', 'admin', '2024-09-19 13:03:40', '2024-09-19 13:03:40'),
(66, 'Idell Hauck', 'samara.homenick@example.com', '$2y$12$fGw9fy4pp5pHgt7a.da71OyHPk4tnQzXOQ6b4fE2rwmM/YmYenQyu', 'advertiser', '2024-09-19 13:03:40', '2024-09-19 13:03:40'),
(67, 'Blanche Langworth', 'pmraz@example.net', '$2y$12$LpnlClsuOsXPBs5D9kVrJ.QQJ.wy7vE9.EM17ZwBsBbhArMo6KhVi', 'webmaster', '2024-09-19 13:03:40', '2024-09-19 13:03:40'),
(68, 'Ms. Alivia McCullough', 'anna70@example.org', '$2y$12$bV1AVE/.9LccuqiIYbaRQ./JFYWmcAsiZLSvPD8wd.QM/M0oiTjge', 'advertiser', '2024-09-19 13:03:40', '2024-09-19 13:03:40'),
(69, 'Mr. Braeden Christiansen', 'cummerata.jammie@example.net', '$2y$12$LK9qZ818zable30YfromPOBH3L.lFaQ0HQTP19DqPByxT1XB5UEO2', 'admin', '2024-09-19 13:03:40', '2024-09-19 13:03:40'),
(70, 'Mr. Jaylen Rogahn', 'clementina.greenholt@example.org', '$2y$12$AaVr.B116w5lTZNE3cv0JuHhfzt.tCtOf7F0baqMq3WyNlSzHFs6W', 'admin', '2024-09-19 13:03:40', '2024-09-19 13:03:40'),
(71, 'Maxim', 'supr.kz@gmail.com', '$2y$12$wgXoZMHY9T/HZIqlDrn7yupx7euLiTxMghBIOgzAJPrM4Ci3ELk0m', 'webmaster', '2024-09-19 13:42:14', '2024-09-19 14:43:28'),
(72, 'TestoviyUser', 'maxim.mmmm@mail.ru', '$2y$12$PocVp53wWeGwFh/lUxej0e5wt8BffU826h9I9/XtsET3Z9QutXSEe', 'advertiser', '2024-09-19 16:11:33', '2024-09-19 16:11:33');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `clicks`
--
ALTER TABLE `clicks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clicks_offer_id_foreign` (`offer_id`),
  ADD KEY `clicks_webmaster_id_foreign` (`webmaster_id`);

--
-- Индексы таблицы `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_offer_id_foreign` (`offer_id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offers_advertiser_id_foreign` (`advertiser_id`);

--
-- Индексы таблицы `offer_subscriptions`
--
ALTER TABLE `offer_subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offer_subscriptions_webmaster_id_foreign` (`webmaster_id`),
  ADD KEY `offer_subscriptions_offer_id_foreign` (`offer_id`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `clicks`
--
ALTER TABLE `clicks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT для таблицы `offer_subscriptions`
--
ALTER TABLE `offer_subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `clicks`
--
ALTER TABLE `clicks`
  ADD CONSTRAINT `clicks_offer_id_foreign` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`),
  ADD CONSTRAINT `clicks_webmaster_id_foreign` FOREIGN KEY (`webmaster_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_offer_id_foreign` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`);

--
-- Ограничения внешнего ключа таблицы `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_advertiser_id_foreign` FOREIGN KEY (`advertiser_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `offer_subscriptions`
--
ALTER TABLE `offer_subscriptions`
  ADD CONSTRAINT `offer_subscriptions_offer_id_foreign` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`),
  ADD CONSTRAINT `offer_subscriptions_webmaster_id_foreign` FOREIGN KEY (`webmaster_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
