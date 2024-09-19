-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Сен 19 2024 г., 22:14
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
(1, 21, 42, '89.3.206.122', '2023-10-05 20:59:18', '2024-09-19 17:10:26', '2024-09-19 17:10:26'),
(2, 22, 44, '32.230.100.219', '2024-02-15 07:36:53', '2024-09-19 17:10:26', '2024-09-19 17:10:26'),
(3, 23, 46, '228.26.152.133', '2023-12-07 06:36:40', '2024-09-19 17:10:26', '2024-09-19 17:10:26'),
(4, 24, 48, '25.128.17.193', '2023-12-14 01:29:27', '2024-09-19 17:10:26', '2024-09-19 17:10:26'),
(5, 25, 50, '184.23.167.219', '2023-10-03 06:28:10', '2024-09-19 17:10:26', '2024-09-19 17:10:26'),
(6, 26, 52, '95.72.149.208', '2024-02-26 22:19:59', '2024-09-19 17:10:26', '2024-09-19 17:10:26'),
(7, 27, 54, '202.78.122.205', '2023-10-29 17:49:46', '2024-09-19 17:10:26', '2024-09-19 17:10:26'),
(8, 28, 56, '219.97.119.205', '2024-08-02 13:03:42', '2024-09-19 17:10:26', '2024-09-19 17:10:26'),
(9, 29, 58, '64.88.142.243', '2023-12-02 14:20:56', '2024-09-19 17:10:26', '2024-09-19 17:10:26'),
(10, 30, 60, '8.49.27.89', '2023-12-21 15:24:24', '2024-09-19 17:10:26', '2024-09-19 17:10:26');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2024_09_19_171409_create_offers_table', 1),
(4, '2024_09_19_171529_create_clicks_table', 1),
(5, '2024_09_19_171551_create_offer_subscriptions_table', 1);

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
(1, 11, 'commodi', '3.00', 'http://www.ortiz.com/', 'beatae, laudantium, debitis', 0, '2024-09-19 17:10:19', '2024-09-19 17:10:19'),
(2, 12, 'enim', '1.54', 'http://kunde.com/', 'magni, voluptatibus, dolor', 0, '2024-09-19 17:10:19', '2024-09-19 17:10:19'),
(3, 13, 'impedit', '1.78', 'http://rippin.info/iure-ea-sed-corrupti-qui.html', 'tenetur, explicabo, ut', 1, '2024-09-19 17:10:19', '2024-09-19 17:10:19'),
(4, 14, 'quod', '3.67', 'http://www.aufderhar.com/ut-sed-similique-quaerat-et', 'vero, eos, accusamus', 0, '2024-09-19 17:10:19', '2024-09-19 17:10:19'),
(5, 15, 'quam', '2.10', 'http://www.nolan.net/', 'quae, animi, quia', 1, '2024-09-19 17:10:19', '2024-09-19 17:10:19'),
(6, 16, 'similique', '2.06', 'http://gusikowski.com/voluptas-et-rerum-vitae-mollitia-repellendus-eos', 'atque, corporis, suscipit', 0, '2024-09-19 17:10:19', '2024-09-19 17:10:19'),
(7, 17, 'aspernatur', '1.70', 'http://www.jacobi.com/distinctio-quam-quos-doloribus-dolorum.html', 'sapiente, eaque, enim', 0, '2024-09-19 17:10:19', '2024-09-19 17:10:19'),
(8, 18, 'odit', '2.39', 'http://www.daugherty.com/harum-neque-nemo-impedit-molestiae', 'ea, aut, consequuntur', 0, '2024-09-19 17:10:19', '2024-09-19 17:10:19'),
(9, 19, 'iusto', '1.46', 'http://www.kerluke.com/est-optio-qui-eaque-eos-ducimus-quia-dolores', 'rerum, voluptatem, sed', 0, '2024-09-19 17:10:19', '2024-09-19 17:10:19'),
(10, 20, 'aliquid', '3.79', 'http://www.gusikowski.net/sint-quas-ratione-quia-quia', 'consequuntur, consequatur, voluptas', 1, '2024-09-19 17:10:19', '2024-09-19 17:10:19'),
(11, 22, 'facilis', '0.71', 'http://hauck.com/', 'at, fuga, cumque', 0, '2024-09-19 17:10:19', '2024-09-19 17:10:19'),
(12, 24, 'molestias', '1.47', 'http://littel.com/id-dolorem-et-quos-aliquid-tenetur.html', 'et, voluptatem, sint', 0, '2024-09-19 17:10:20', '2024-09-19 17:10:20'),
(13, 26, 'quaerat', '0.54', 'http://becker.com/voluptate-voluptas-sed-sed-enim', 'consequatur, ratione, nihil', 0, '2024-09-19 17:10:20', '2024-09-19 17:10:20'),
(14, 28, 'blanditiis', '3.82', 'http://wiegand.com/animi-in-vero-dolore-rerum-accusantium-est-ipsa', 'omnis, perspiciatis, sit', 0, '2024-09-19 17:10:20', '2024-09-19 17:10:20'),
(15, 30, 'et', '3.39', 'http://ryan.com/rem-aut-voluptatem-quia-et.html', 'dolore, quos, et', 1, '2024-09-19 17:10:21', '2024-09-19 17:10:21'),
(16, 32, 'exercitationem', '2.44', 'http://cole.biz/quia-qui-quidem-voluptate-et.html', 'ad, in, officiis', 0, '2024-09-19 17:10:21', '2024-09-19 17:10:21'),
(17, 34, 'est', '1.08', 'http://dooley.net/', 'quos, quae, nostrum', 0, '2024-09-19 17:10:21', '2024-09-19 17:10:21'),
(18, 36, 'in', '4.46', 'http://www.borer.biz/', 'aliquam, et, totam', 0, '2024-09-19 17:10:22', '2024-09-19 17:10:22'),
(19, 38, 'et', '1.31', 'https://mcglynn.biz/libero-molestiae-non-culpa-omnis-at.html', 'quae, expedita, rerum', 1, '2024-09-19 17:10:22', '2024-09-19 17:10:22'),
(20, 40, 'occaecati', '3.16', 'http://www.kessler.com/expedita-enim-sapiente-quasi-quas', 'esse, aut, reiciendis', 0, '2024-09-19 17:10:22', '2024-09-19 17:10:22'),
(21, 41, 'veritatis', '0.94', 'http://krajcik.com/voluptas-dolore-ipsam-dolorem-minus-dolorem-at.html', 'unde, omnis, et', 0, '2024-09-19 17:10:22', '2024-09-19 17:10:22'),
(22, 43, 'dolor', '1.32', 'http://www.hoppe.biz/eaque-aut-ut-error-velit-id-ut', 'rerum, exercitationem, qui', 1, '2024-09-19 17:10:23', '2024-09-19 17:10:23'),
(23, 45, 'animi', '4.18', 'https://www.damore.com/praesentium-debitis-maxime-qui-voluptas', 'a, exercitationem, vitae', 1, '2024-09-19 17:10:23', '2024-09-19 17:10:23'),
(24, 47, 'ipsa', '2.62', 'http://spencer.com/eum-rem-accusamus-excepturi-voluptatem-aut-laborum-asperiores-quo', 'eos, eveniet, assumenda', 1, '2024-09-19 17:10:23', '2024-09-19 17:10:23'),
(25, 49, 'dolores', '0.57', 'http://murphy.net/repellat-fugit-odio-nulla-enim', 'perspiciatis, exercitationem, et', 0, '2024-09-19 17:10:24', '2024-09-19 17:10:24'),
(26, 51, 'illo', '1.47', 'http://www.fahey.biz/nulla-et-voluptates-non-et-laboriosam.html', 'qui, hic, veniam', 1, '2024-09-19 17:10:24', '2024-09-19 17:10:24'),
(27, 53, 'et', '4.06', 'https://gorczany.com/ut-odit-id-aut-soluta-excepturi.html', 'nihil, voluptatem, error', 0, '2024-09-19 17:10:24', '2024-09-19 17:10:24'),
(28, 55, 'facilis', '3.11', 'https://www.ebert.com/sed-voluptatem-et-quas-corporis-in', 'sed, sint, maiores', 0, '2024-09-19 17:10:25', '2024-09-19 17:10:25'),
(29, 57, 'quos', '1.60', 'http://schoen.org/', 'et, in, cupiditate', 0, '2024-09-19 17:10:25', '2024-09-19 17:10:25'),
(30, 59, 'eos', '1.61', 'http://denesik.com/', 'tempore, similique, dolorum', 0, '2024-09-19 17:10:25', '2024-09-19 17:10:25');

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
(1, 21, 11, '2.19', '2024-09-19 17:10:22', '2024-09-19 17:10:22'),
(2, 23, 12, '3.19', '2024-09-19 17:10:22', '2024-09-19 17:10:22'),
(3, 25, 13, '4.25', '2024-09-19 17:10:22', '2024-09-19 17:10:22'),
(4, 27, 14, '4.64', '2024-09-19 17:10:22', '2024-09-19 17:10:22'),
(5, 29, 15, '2.86', '2024-09-19 17:10:22', '2024-09-19 17:10:22'),
(6, 31, 16, '2.35', '2024-09-19 17:10:22', '2024-09-19 17:10:22'),
(7, 33, 17, '0.77', '2024-09-19 17:10:22', '2024-09-19 17:10:22'),
(8, 35, 18, '3.33', '2024-09-19 17:10:22', '2024-09-19 17:10:22'),
(9, 37, 19, '4.10', '2024-09-19 17:10:22', '2024-09-19 17:10:22'),
(10, 39, 20, '3.75', '2024-09-19 17:10:22', '2024-09-19 17:10:22');

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
(1, 'Prof. Guillermo Jast MD', 'hschmeler@example.com', '$2y$12$bYhVXD/ZtyF39M0Rxm/XWekltUrsHc7DoJ3MsdSAwfKKZ9SJr52Xa', 'webmaster', '2024-09-19 17:10:17', '2024-09-19 17:10:17'),
(2, 'Mrs. Laurence Blick', 'sofia43@example.com', '$2y$12$aWxSS3iclVSU6rADcNngsu7nPZcrzh4MKH8H.bvFXC8BkFVO3K2su', 'admin', '2024-09-19 17:10:17', '2024-09-19 17:10:17'),
(3, 'Henri Kuphal', 'durgan.nicholas@example.net', '$2y$12$HJhJL2xV0YHCkKSMN7fTJ.sy7BVT/ehnqRfzXYvi7mOpkoCibjbDa', 'webmaster', '2024-09-19 17:10:17', '2024-09-19 17:10:17'),
(4, 'Waino Dare', 'victor.lemke@example.org', '$2y$12$DdgGBFr2uBa1aPO2CPdHhOse0I2iFANEJlOrD25c.Eq79Tu6LOvui', 'webmaster', '2024-09-19 17:10:17', '2024-09-19 17:10:17'),
(5, 'Tristin Dooley', 'iheller@example.net', '$2y$12$NZbFpbJG8XhBw7FsiyMSCOtjrIIchiRPWB3AMfH9Znk69ZLeXmtyO', 'webmaster', '2024-09-19 17:10:17', '2024-09-19 17:10:17'),
(6, 'Prof. Jarret Ziemann DDS', 'qgorczany@example.com', '$2y$12$DRAjiDnv/0RCmpZfH2hFxO9LK2dKlmdtzJmbq/XTa/LaIv1LHnW5C', 'admin', '2024-09-19 17:10:17', '2024-09-19 17:10:17'),
(7, 'Florine Kuhlman', 'anderson.idell@example.net', '$2y$12$jV4HnyuKwhOdVlL1iKxnpeldkhyLBtFmIknxH2K7t/iO1s4BhY7dW', 'admin', '2024-09-19 17:10:17', '2024-09-19 17:10:17'),
(8, 'Prof. Cornelius Cruickshank', 'pokuneva@example.com', '$2y$12$0FTeX7UFaeHyiOkW0w7HBO0DhLzJvYX.FA5H4cPWa/FutjQwQi776', 'advertiser', '2024-09-19 17:10:17', '2024-09-19 17:10:17'),
(9, 'Kolby Wolff I', 'abel.veum@example.org', '$2y$12$RVL7iH.utMJBrJfTVg5ckunRe/s..enVB/vR46WWgjqFlsOvkDc2C', 'admin', '2024-09-19 17:10:17', '2024-09-19 17:10:17'),
(10, 'Armani Wisoky', 'kristoffer.schmitt@example.org', '$2y$12$S5Pox8n.L1IbnjpLF2GWOeCpxqlWH6JY4/sKZxKSvHj3R.KHpnWmi', 'admin', '2024-09-19 17:10:17', '2024-09-19 17:10:17'),
(11, 'Prof. Khalil Hane', 'immanuel91@example.org', '$2y$12$/E8eMtvF4m.CRYRDKKLZlONl.yOccngqvAVmNlx0xSN4C4BlUQ6ua', 'advertiser', '2024-09-19 17:10:17', '2024-09-19 17:10:17'),
(12, 'Jeremie Bauch', 'yleffler@example.net', '$2y$12$FhgtNEnYiVB1nlyOfRoc6.JzTU2HzhalH12/A335cuTHY0nIxKg4y', 'webmaster', '2024-09-19 17:10:18', '2024-09-19 17:10:18'),
(13, 'Hallie Goodwin II', 'herzog.kaylin@example.net', '$2y$12$S3WMuh58/WjsSRYMc48AW.W3XmwNl3/k6bljqenavZ31.PmMWGSB.', 'admin', '2024-09-19 17:10:18', '2024-09-19 17:10:18'),
(14, 'Myrtice Nicolas V', 'russel.kovacek@example.org', '$2y$12$4/WkiCvFf9GFCnEXjlxjZecHOSsUsRgQDnUPNi9IqMFKRLD1l/D7O', 'admin', '2024-09-19 17:10:18', '2024-09-19 17:10:18'),
(15, 'Dr. Josiah Satterfield', 'oohara@example.com', '$2y$12$DN694sPhdmmvQgaeh8ZF0ePKS53ASXbivtaYjp78wHkOl42h4DCeC', 'webmaster', '2024-09-19 17:10:18', '2024-09-19 17:10:18'),
(16, 'Carolina Turcotte DVM', 'meghan.corkery@example.com', '$2y$12$0iTN9H6TEbyFKezBJuIvkuZ1IUe2ySZdDOLh7WN.ztk1ipIhVTGDS', 'webmaster', '2024-09-19 17:10:18', '2024-09-19 17:10:18'),
(17, 'Brandyn Boyer V', 'nikolaus.kirsten@example.org', '$2y$12$RdES92GXJq1Z9vqzGB1.mOsiZ.9sxLw/mNLAtmKN3eHYvy/gxE0RO', 'admin', '2024-09-19 17:10:18', '2024-09-19 17:10:18'),
(18, 'Carmen Moen', 'reichert.marianne@example.org', '$2y$12$j9WGOg8GRMeHdLIUnCom/OG.vs9TxQhjDpn.7Cje5u539XYTESD8K', 'webmaster', '2024-09-19 17:10:19', '2024-09-19 17:10:19'),
(19, 'Peter Doyle', 'fiona.heller@example.net', '$2y$12$MPoJ80LLjFtAdyZ42Rx7Xu5y8pd9WYOYvLDrYxwNqPAZTaQ9s4kSm', 'admin', '2024-09-19 17:10:19', '2024-09-19 17:10:19'),
(20, 'Brycen Walsh', 'valentine.kuhlman@example.org', '$2y$12$EVh2VtBhDB3QnpbBJzC.z.S4ZnZ64kwlfEAKxvkmsVQfK654sSrzO', 'admin', '2024-09-19 17:10:19', '2024-09-19 17:10:19'),
(21, 'Amaya Brakus', 'aubrey71@example.com', '$2y$12$9vfy1p8i5qRD2krIKlF9M.kSDjAlaXJ.UPxs3KPvTTia1JR1CJSrS', 'webmaster', '2024-09-19 17:10:19', '2024-09-19 17:10:19'),
(22, 'Stephen Streich', 'skiles.emilio@example.net', '$2y$12$ZqLWo6RHuzCp6y3EMd29WecdEaCSdWzOGQXz5cX6INMtupTExMhNO', 'advertiser', '2024-09-19 17:10:19', '2024-09-19 17:10:19'),
(23, 'Obie Satterfield', 'senger.jayda@example.org', '$2y$12$Psw1tkP5RinWoQ7jnK6xE.eSOeaWs3O2ltD1e12/iDi6ElXuZwBIO', 'webmaster', '2024-09-19 17:10:19', '2024-09-19 17:10:19'),
(24, 'Dr. Emerson Trantow Jr.', 'rylan.monahan@example.org', '$2y$12$qSBdUTKdvlYRINW7nCfp5ekkT.7eKJX6khTgYja5uorC4kWXEQski', 'admin', '2024-09-19 17:10:20', '2024-09-19 17:10:20'),
(25, 'Edmond Pacocha', 'london63@example.net', '$2y$12$p0NbYpvXA5r2oMLy622cne6wEzZqLdHqsl409CR1cWrlFdYCK86.S', 'webmaster', '2024-09-19 17:10:20', '2024-09-19 17:10:20'),
(26, 'Kaleigh Morissette', 'gloria.auer@example.net', '$2y$12$fVISe0kNSZpd4E7s7R.3E.4e7S0ICMUOxr.c4OG.ZaZw16ZdXyxsS', 'admin', '2024-09-19 17:10:20', '2024-09-19 17:10:20'),
(27, 'Major Mraz', 'vreinger@example.net', '$2y$12$N.EcUs.uZ4zaFb79Eh1VzeeDQT80oBTd7yVBYmRN2nzV3elzf8Ak2', 'webmaster', '2024-09-19 17:10:20', '2024-09-19 17:10:20'),
(28, 'Emile Treutel', 'viva.morar@example.net', '$2y$12$WiTlnQkP8dWeekyg4iDDWeCdx0Bnz.Zkfyl44vGC3RSYs0mbAtLTS', 'webmaster', '2024-09-19 17:10:20', '2024-09-19 17:10:20'),
(29, 'Keanu O\'Reilly', 'mylene21@example.org', '$2y$12$tnVBtpVlqST4Dh71xsZVMOWfir4oty9O/pCvK7wX0IR2TTvk5y1l2', 'webmaster', '2024-09-19 17:10:20', '2024-09-19 17:10:20'),
(30, 'Velva Hessel', 'wiza.frida@example.com', '$2y$12$g3cbgyM8hufmvc/K8QlcueqAdYwrEpyGvzsJOwif2pkblC9xwgp8K', 'advertiser', '2024-09-19 17:10:21', '2024-09-19 17:10:21'),
(31, 'Deshaun Grady V', 'gorczany.cortez@example.net', '$2y$12$3woshejCCcHiwHJxEphMteMFItsp6FMknH.qp1FVCy232a8n3iYQ6', 'webmaster', '2024-09-19 17:10:21', '2024-09-19 17:10:21'),
(32, 'Marian Hansen', 'rowe.carrie@example.org', '$2y$12$pF.9t4RNKE8fdEOK8chB7uvJ0EtLbQ8Ctf2ZbQGDG3pohUIc9Wjsy', 'webmaster', '2024-09-19 17:10:21', '2024-09-19 17:10:21'),
(33, 'Keshawn Price', 'alexandro.rogahn@example.com', '$2y$12$z43sBwxN40mWVajQvVH3qeLYUkN5AaYFlG0V.qTASsILlFYGOfEW2', 'webmaster', '2024-09-19 17:10:21', '2024-09-19 17:10:21'),
(34, 'Dr. Jaydon Haley Jr.', 'eleonore.smitham@example.org', '$2y$12$RZMKIoV08DoTJta3sZuheecrF1hfJ7F.YQgXjnV1cbybrUsZS/iby', 'admin', '2024-09-19 17:10:21', '2024-09-19 17:10:21'),
(35, 'Mafalda Kshlerin', 'dtillman@example.net', '$2y$12$tlwK/vwQu/yZ.w.bH2ep5OvoX7o9OsXyKHU7rfQl8VooQo0rp3Tee', 'webmaster', '2024-09-19 17:10:21', '2024-09-19 17:10:21'),
(36, 'Prof. Freeman Rosenbaum', 'melyssa.kohler@example.org', '$2y$12$acepsfWxyesCoeKWCk3Cue6TC/228.Ggz7uMvu3nR6.sF8mD6HRHi', 'webmaster', '2024-09-19 17:10:22', '2024-09-19 17:10:22'),
(37, 'Garth Funk MD', 'alex84@example.com', '$2y$12$jaCzP8KAtofjA3ZvbkB4r.r3pUqQUt9Dd.WPlJavbd7YLoYEJi692', 'webmaster', '2024-09-19 17:10:22', '2024-09-19 17:10:22'),
(38, 'Melissa Kunze', 'xfarrell@example.net', '$2y$12$5CTayrhOnTc3kc/29UYpI.Igus/RRbJtgKo9QJvVLJHIJ8IPPqYEi', 'admin', '2024-09-19 17:10:22', '2024-09-19 17:10:22'),
(39, 'Mavis Feest', 'nicola.strosin@example.org', '$2y$12$8o2kRPU2Lla/Ap5Tr5qDCO6nWmR1BtsNujJVZfWD/bDW.btLkXQ5i', 'webmaster', '2024-09-19 17:10:22', '2024-09-19 17:10:22'),
(40, 'Jillian Hudson', 'carmstrong@example.org', '$2y$12$.1aXWdifLZCg0sAg.jB.luLUcUb1rdDiBCgZZejSbR1xxRSKuIrNS', 'admin', '2024-09-19 17:10:22', '2024-09-19 17:10:22'),
(41, 'Gregory Volkman', 'desiree49@example.net', '$2y$12$8ciEtNGthbwrCJSlVP.g9.hEkK4Z/R/uyEZ2K1j8DGzV559MgPYH6', 'webmaster', '2024-09-19 17:10:22', '2024-09-19 17:10:22'),
(42, 'Prof. Vickie Dare', 'sipes.cortney@example.com', '$2y$12$wCOWn2XniR/9JHcCoTAYxeXgxLvV837aIEg8nKAv3rPvajHqSaR9e', 'webmaster', '2024-09-19 17:10:23', '2024-09-19 17:10:23'),
(43, 'Beverly DuBuque', 'ernser.piper@example.net', '$2y$12$s34oVT9Yo15/HQcIaVhjhupAYlNRNEHqBGcZbwPJbbBeFIGRT6lve', 'advertiser', '2024-09-19 17:10:23', '2024-09-19 17:10:23'),
(44, 'Prof. Thurman Champlin', 'jermaine54@example.org', '$2y$12$FQeZ5hzgYNXw/qDe9Sh4Q.S8tuKppHOEl8exsxeSpQ1vc0med/h1W', 'webmaster', '2024-09-19 17:10:23', '2024-09-19 17:10:23'),
(45, 'Ivory Hoppe', 'wilbert88@example.org', '$2y$12$dFQbEqy./NEH26VrNQA4KO8ixFB5Upy75FPCNKgj87JwkITPSPNzC', 'advertiser', '2024-09-19 17:10:23', '2024-09-19 17:10:23'),
(46, 'Lenora Kreiger', 'jullrich@example.com', '$2y$12$VUXiONJTBpyRK8Q/1s6hAOgGDZoPFRMBa75.UQsZBauYV1Su.bQsW', 'webmaster', '2024-09-19 17:10:23', '2024-09-19 17:10:23'),
(47, 'Kayden Russel I', 'helene.rolfson@example.org', '$2y$12$Gai5UX0snyaJ88yHTt9mmOcc.01Cr3pEIYMt.HzesU2SZ7kaEB8cm', 'webmaster', '2024-09-19 17:10:23', '2024-09-19 17:10:23'),
(48, 'Mr. Bobby Bode', 'zlind@example.com', '$2y$12$UM6.Zc4zKMHNylOrQS09zOoFFpOGkuBe4VGsN4y4aKQgfHK2CCLIe', 'webmaster', '2024-09-19 17:10:24', '2024-09-19 17:10:24'),
(49, 'Ms. Sabryna D\'Amore DDS', 'franecki.michaela@example.net', '$2y$12$k1UH88YkwpAndd3bexE.beiuGQRPI4xgm9YVnz4ipBxv/CIK7dmpK', 'webmaster', '2024-09-19 17:10:24', '2024-09-19 17:10:24'),
(50, 'Dr. Roy Bruen Jr.', 'ebruen@example.net', '$2y$12$tOBCLiOipOgFze1x69R80eaAPBTknuQKHhCCcr8riy3Ilkskogini', 'webmaster', '2024-09-19 17:10:24', '2024-09-19 17:10:24'),
(51, 'Alta Herman', 'keshawn39@example.net', '$2y$12$XXfuW41X8JVoQ8EV0B.v6eME9cVPpG/1TG8nyJ/AAqhBfiwCne7o2', 'admin', '2024-09-19 17:10:24', '2024-09-19 17:10:24'),
(52, 'Miss Alvena Terry', 'borer.oda@example.net', '$2y$12$S87msGU5qmc71zqBMHM7MeMQ66Jh6fnp0pMMOV5dNP/RRBg/P1TOG', 'webmaster', '2024-09-19 17:10:24', '2024-09-19 17:10:24'),
(53, 'Newell Breitenberg', 'shaun13@example.org', '$2y$12$AFR/MKdf2bkeg4dQ9KOLZu7wmbttDmNgy9hBoB1AnONfydzzO3HAm', 'admin', '2024-09-19 17:10:24', '2024-09-19 17:10:24'),
(54, 'Leopoldo Kovacek', 'bernier.connie@example.org', '$2y$12$BoPbLhzD/J5Ubv3b/Ik5vOrrs/LWby7oHZnmhJdKAClohrshG.016', 'webmaster', '2024-09-19 17:10:25', '2024-09-19 17:10:25'),
(55, 'Cecile Brown', 'xankunding@example.com', '$2y$12$/hI/mYyjn/.0n/Xg62xMVuUtQv/tu5YaPqtNiK1dy.Spw0qi6Slw.', 'admin', '2024-09-19 17:10:25', '2024-09-19 17:10:25'),
(56, 'Barry Lang DVM', 'hbahringer@example.org', '$2y$12$KU4C1glz1GZtsw2tBCIR4ejBeuKX5/TaUPLvbuU6oADf8lNsixomK', 'webmaster', '2024-09-19 17:10:25', '2024-09-19 17:10:25'),
(57, 'Coralie Altenwerth', 'oberbrunner.ethel@example.org', '$2y$12$RQu775zTp2TXIDJkCOJ.rOc281pv4lMf6VYQap2sXGc2gBHc1J8PK', 'admin', '2024-09-19 17:10:25', '2024-09-19 17:10:25'),
(58, 'Madelyn Murazik', 'hills.molly@example.com', '$2y$12$7iEv00vZOXCluTjmsLP84.bXE2uO91/SK40Lc6oZsP0DWs5aE2elu', 'webmaster', '2024-09-19 17:10:25', '2024-09-19 17:10:25'),
(59, 'Shaun Johns', 'uhintz@example.net', '$2y$12$sYmt3xzA8/ZuFKieH9cCje673DL311Pqi2jbuNdWOT6qiFf0C8HUe', 'advertiser', '2024-09-19 17:10:25', '2024-09-19 17:10:25'),
(60, 'Seth Bayer', 'loy.sanford@example.com', '$2y$12$eC0tudmkdV3nT45Yq94PeuLl1GOEUv5wJ7.3hVNHjHCk1sgC9YFSW', 'webmaster', '2024-09-19 17:10:26', '2024-09-19 17:10:26');

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
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `offer_subscriptions`
--
ALTER TABLE `offer_subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

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
