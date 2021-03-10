-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2021 at 03:30 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `custom_url`
--

-- --------------------------------------------------------

--
-- Table structure for table `action_list_latforms`
--

CREATE TABLE `action_list_latforms` (
  `id` int(11) NOT NULL,
  `action_name` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clickthroughs`
--

CREATE TABLE `clickthroughs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `link_id` int(11) NOT NULL,
  `link_platform_id` int(11) NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdAt` timestamp NULL DEFAULT NULL,
  `updatedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clickthroughs`
--

INSERT INTO `clickthroughs` (`id`, `link_id`, `link_platform_id`, `ip`, `createdAt`, `updatedAt`) VALUES
(2, 439, 533, '127.0.0.1', '2021-01-13 17:00:00', '2021-01-13 17:00:00'),
(3, 439, 534, '127.0.0.1', '2021-01-13 17:00:00', '2021-01-13 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `video_embed_url` varchar(255) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `short_link` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `deletedAt` datetime DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `show_status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id`, `image_path`, `video_embed_url`, `id_user`, `short_link`, `createdAt`, `updatedAt`, `deletedAt`, `title`, `show_status`) VALUES
(338, 'lswuu9nccu6tx0nimblm', 'https://www.youtube.com/embed/ioNng23DkIM', 4, 'HXs4yfGD9xxx', '2020-12-18 00:00:00', '2020-12-18 00:00:00', NULL, 'ses dumm', 2),
(344, NULL, 'asdasdasd', 4, 'zR4sV3S6N', '2020-12-27 00:00:00', '2020-12-27 00:00:00', NULL, 'testasd', 1),
(345, NULL, 'asdasdasd', 4, '4cWSi11ZR', '2020-12-27 00:00:00', '2020-12-27 00:00:00', NULL, 'testasd', 1),
(348, NULL, 'asdasdasd', 4, 'TFNqnFWLw', '2020-12-27 00:00:00', '2020-12-27 00:00:00', '2021-01-15 04:32:59', 'testasd', 1),
(349, NULL, 'asdasdasd', 4, 'H1G2pGaLZ', '2020-12-27 00:00:00', '2020-12-27 00:00:00', '2021-01-15 04:33:18', 'testasd', 1),
(350, NULL, 'asdasdasd', 4, 'xxaxaxax', '2020-12-27 00:00:00', '2020-12-27 00:00:00', NULL, 'testasd', 2),
(357, NULL, 'asdasdasd', 4, 'Rkv1Ldim3', '2020-12-27 00:00:00', '2020-12-27 00:00:00', '2021-01-08 10:15:16', 'testasd', 1),
(358, NULL, 'asdasdasd', 4, '86gNTfwDe', '2020-12-27 00:00:00', '2020-12-27 00:00:00', '2021-01-06 08:33:17', 'testasd', 1),
(359, NULL, 'asdasdasd', 4, 'jqDvYd5Vm', '2020-12-27 00:00:00', '2020-12-27 00:00:00', '2021-01-08 10:15:11', 'testasd', 1),
(372, NULL, 'https://www.youtube.com/embed/_Hu446ApWaY', 4, 'k0Egckq7w', '2021-01-04 00:00:00', '2021-01-04 00:00:00', NULL, 'percobaan', 1),
(374, NULL, 'sad bgt', 4, 'nE3myxmoL', '2021-01-06 00:00:00', '2021-01-06 00:00:00', NULL, 'sad', 1),
(375, NULL, 'adadadasdasd', 4, 'Uyw5eznY0', '2021-01-06 00:00:00', '2021-01-06 00:00:00', '2021-01-15 08:10:48', 'aaaa baru nih', 1),
(439, 'cdhcu8yqip6bflxugfob', 'https://www.youtube.com/embed/_Hu446ApWaY', 4, 'XdgcNWcgg', '2021-01-11 00:00:00', '2021-01-11 00:00:00', NULL, 'tes', 1),
(453, NULL, 'baru', 4, 'FhNSXGb5I', '2021-01-15 00:00:00', '2021-01-15 00:00:00', NULL, 'sebuah', 1),
(454, 'cdntqgpbqgl9vfzs6n0v', 'Bumi Biru', 4, '3NUtTUWM', '2021-01-15 00:00:00', '2021-01-15 00:00:00', NULL, 'Bumi Biruu', 1),
(455, NULL, '', 4, 'Sf0bdMRkk', '2021-01-15 00:00:00', '2021-01-15 00:00:00', NULL, 'sad', 1),
(456, NULL, '', 4, 'Gpt1SoJnJ', '2021-01-18 00:00:00', '2021-01-18 00:00:00', NULL, 'senin', 1),
(457, 'c2mcpbhpkbhnkl6gldbp', 'aksdaksd', 4, 'xxxxxxax', '2021-02-03 00:00:00', '2021-02-03 00:00:00', '2021-02-03 00:43:28', 'final', 1),
(458, NULL, 'https://www.youtube.com/embed/_Hu446ApWaY', 4, 'Vt09kLCSs', '2021-02-03 00:00:00', '2021-02-03 00:00:00', NULL, 'hapus aja', 1),
(459, NULL, 'https://www.youtube.com/embed/_Hu446ApWaY', 12, 'y33PVxgLa', '2021-02-05 00:00:00', '2021-02-05 00:00:00', NULL, 'xx tes 1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `link_platforms`
--

CREATE TABLE `link_platforms` (
  `id` int(11) NOT NULL,
  `url_platform` varchar(255) DEFAULT NULL,
  `jenis_platform` int(11) DEFAULT NULL,
  `text` int(11) DEFAULT NULL,
  `id_link` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `deletedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `link_platforms`
--

INSERT INTO `link_platforms` (`id`, `url_platform`, `jenis_platform`, `text`, `id_link`, `createdAt`, `updatedAt`, `deletedAt`) VALUES
(388, 'https://www.youtube.com/watch?v=ioNng23DkIM', 11, 1, 338, '2020-12-18 00:00:00', '2021-01-14 00:00:00', NULL),
(432, 'MASUK NIH', 11, 1, NULL, '2021-01-06 00:00:00', '2021-01-06 00:00:00', NULL),
(433, 'asdasd', 11, 1, NULL, '2021-01-06 00:00:00', '2021-01-06 00:00:00', NULL),
(440, 'asdasd', 11, 1, 372, '2021-01-06 00:00:00', '2021-01-06 00:00:00', '2021-01-06 05:07:38'),
(441, 'data masuk kedua', 11, 1, 372, '2021-01-06 00:00:00', '2021-01-06 00:00:00', '2021-01-06 05:08:44'),
(442, 'data masuk ketiga', 19, 1, 372, '2021-01-06 00:00:00', '2021-01-06 00:00:00', '2021-01-06 05:11:57'),
(443, 'BARU', 11, 14, 372, '2021-01-06 00:00:00', '2021-01-06 00:00:00', '2021-01-06 05:09:13'),
(445, 'zzzz', 11, 1, 372, '2021-01-06 00:00:00', '2021-01-06 00:00:00', '2021-01-06 05:09:54'),
(467, '', 11, 1, 374, '2021-01-06 00:00:00', '2021-01-06 00:00:00', NULL),
(468, 'TEST YG INI UNTUK LIHATa', 11, 1, 375, '2021-01-06 00:00:00', '2021-01-06 00:00:00', '2021-01-11 06:36:25'),
(533, 'https://www.youtube.com/watch?v=_Hu446ApWaY', 22, 10, 439, '2021-01-11 00:00:00', '2021-01-11 00:00:00', NULL),
(534, 'https://www.youtube.com/watch?v=_Hu446ApWaY', 11, 1, 439, '2021-01-11 00:00:00', '2021-01-11 00:00:00', NULL),
(535, 'asd', 11, 11, 375, '2021-01-11 00:00:00', '2021-01-11 00:00:00', '2021-01-11 08:50:42'),
(536, 'asd edited', 11, 14, 375, '2021-01-11 00:00:00', '2021-01-11 00:00:00', '2021-01-11 08:53:27'),
(537, 'INI NIH', 11, 1, 375, '2021-01-11 00:00:00', '2021-01-11 00:00:00', '2021-01-11 08:54:43'),
(538, 'pengganti INI NIH EDITED SELASA', 11, 11, 375, '2021-01-11 00:00:00', '2021-01-12 00:00:00', '2021-01-12 06:28:25'),
(541, 'coklat kue', 11, 1, 375, '2021-01-12 00:00:00', '2021-01-12 00:00:00', NULL),
(553, 'asdasd', 11, 1, 453, '2021-01-15 00:00:00', '2021-01-15 00:00:00', NULL),
(554, 'Bumi Biruu', 11, 1, 454, '2021-01-15 00:00:00', '2021-02-03 00:00:00', NULL),
(555, 'asd', 11, 1, 455, '2021-01-15 00:00:00', '2021-01-15 00:00:00', NULL),
(557, 'cek', 11, 1, 457, '2021-02-03 00:00:00', '2021-02-03 00:00:00', NULL),
(558, 'https://www.youtube.com/watch?v=_Hu446ApWaY', 11, 1, 458, '2021-02-03 00:00:00', '2021-02-03 00:00:00', NULL),
(559, 'edited', 11, 1, 459, '2021-02-05 00:00:00', '2021-02-05 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `list_platforms`
--

CREATE TABLE `list_platforms` (
  `id` int(11) NOT NULL,
  `platform_name` varchar(255) DEFAULT NULL,
  `logo_image_path` varchar(255) DEFAULT NULL,
  `platform_regex` varchar(255) DEFAULT NULL,
  `published` tinyint(4) NOT NULL DEFAULT 1,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `deletedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_platforms`
--

INSERT INTO `list_platforms` (`id`, `platform_name`, `logo_image_path`, `platform_regex`, `published`, `createdAt`, `updatedAt`, `deletedAt`) VALUES
(11, 'spotify', 'assets/logo/iztr9ahj2dv2svasuxxb', 'www.spotify.com', 1, '0000-00-00 00:00:00', '2021-02-03 00:00:00', NULL),
(19, 'dummy', 'assets/logo/kyfdz1dtmhvmdjsxahxt', 'dummy.com', 1, '2021-01-04 00:00:00', '2021-02-03 00:00:00', NULL),
(22, 'youtube', 'assets/logo/preud4qgvghzhcrqssif', 'https://www.youtube.com', 1, '2021-01-11 00:00:00', '2021-01-11 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `list_text`
--

CREATE TABLE `list_text` (
  `id` int(11) NOT NULL,
  `text` varchar(32) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_text`
--

INSERT INTO `list_text` (`id`, `text`, `createdAt`, `updatedAt`) VALUES
(1, 'Listen', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Purchase', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Play', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Buy', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Buy Online', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Download', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Stream', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Go To', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Visit', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Watch', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'View', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Pre-Order', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Pre-Save', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'Pre-Add', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'Buy Tickets', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'View Ticket Prices', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'Discover', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'Check it Out', '2021-01-04 00:00:00', '2021-01-04 00:00:00');

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
(1, '2020_12_26_110455_create_visit_table', 1),
(2, '2020_12_26_110846_create_clickthrough_table', 1),
(3, '2021_01_24_154029_create_notifications_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pemberitahuan',
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
(1, '', 'Pemberitahuan', 0, 'melanggar', NULL, NULL, NULL),
(2, '', '', 4, 'melanggar', '2021-01-26 21:51:09', NULL, NULL),
(3, '', 'Pemberitahuan', 4, 'kekerasn', '2021-01-26 21:50:14', NULL, NULL),
(4, '', 'Pemberitahuan', 4, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2021-01-26 21:50:14', '2021-01-23 17:00:00', '2021-01-24 17:00:00'),
(5, '', '', 4, 'x', '2021-01-26 21:50:14', '2021-01-24 17:00:00', '2021-01-24 17:00:00'),
(6, '', 'Pemberitahuan', 4, 'Link anda dengan kode 3NUtTUWMb dan judul  terpaksa kami lakukan blokir karena:', '2021-01-26 21:50:14', '2021-01-24 17:00:00', '2021-01-24 17:00:00'),
(7, '', 'Pemberitahuan', 4, 'Link anda dengan kode 3NUtTUWMb dan judul  terpaksa kami lakukan blokir karena:', '2021-01-26 21:50:14', '2021-01-24 17:00:00', '2021-01-24 17:00:00'),
(8, '', 'Pemberitahuan', 4, 'asal ubah', '2021-01-26 21:50:14', '2021-01-24 17:00:00', '2021-01-24 17:00:00'),
(9, '', 'Pemberitahuan', 4, 'Link anda dengan kode \"3NUtTUWMb\"\" dan judul \"\"\" terpaksa kami lakukan blokir karena: saya suka', '2021-01-26 21:50:14', '2021-01-25 17:00:00', '2021-01-25 17:00:00'),
(10, '', 'Pemberitahuan', 4, 'Link anda dengan kode \"HXs4yfGD9xxx\"\" dan judul \"\"\" terpaksa kami lakukan blokir karena:', '2021-01-26 21:50:14', '2021-01-25 17:00:00', '2021-01-25 17:00:00'),
(11, '', 'Pemberitahuan', 4, 'baru ni', '2021-01-26 21:50:14', '2021-01-25 17:00:00', '2021-01-25 17:00:00'),
(12, '', 'Pemberitahuan', 4, 'tanggal format baru', '2021-01-26 21:50:14', '2021-01-26 03:06:42', '2021-01-26 03:06:42'),
(13, '', 'Pemberitahuan', 4, 'format baru. test lagi', '2021-01-26 21:50:14', '2021-01-26 03:07:05', '2021-01-26 03:07:05'),
(14, '', 'Pemberitahuan', 4, 'Link anda dengan kode \"3NUtTUWMb\"\" dan judul \"\"\" terpaksa kami lakukan blokir karena: saya tidak suka', '2021-01-26 21:53:46', '2021-01-26 21:53:39', '2021-01-26 21:53:39'),
(15, '', 'Pemberitahuan', 4, 'cek apakah notifikasi nambah', '2021-01-26 21:55:25', '2021-01-26 21:55:16', '2021-01-26 21:55:16'),
(16, '', 'Pemberitahuan', 4, 'cek notif lagi', '2021-01-26 21:59:27', '2021-01-26 21:59:14', '2021-01-26 21:59:14'),
(17, '', 'Pemberitahuan', 4, 'tes', '2021-02-02 13:32:01', '2021-02-02 01:59:11', '2021-02-02 01:59:11'),
(18, '', 'Pemberitahuan', 4, 'Link anda dengan kode \"3NUtTUWMb\"\" dan judul \"\"\" terpaksa kami lakukan blokir karena:', '2021-02-02 13:32:01', '2021-02-02 01:59:29', '2021-02-02 01:59:29'),
(19, '', 'Pemberitahuan', 4, 'Link anda dengan kode \"3NUtTUWMb\"\" dan judul \"\"\" terpaksa kami lakukan blokir karena:', '2021-02-02 13:32:01', '2021-02-02 02:44:14', '2021-02-02 02:44:14'),
(20, '', 'Pemberitahuan', 4, 'Link anda dengan kode \"3NUtTUWMb\"\" dan judul \"\"\" terpaksa kami lakukan blokir karena:', '2021-02-02 13:32:01', '2021-02-02 02:44:21', '2021-02-02 02:44:21'),
(21, '', 'Pemberitahuan', 4, 'pelanggaran', '2021-02-02 19:39:54', '2021-02-02 19:39:45', '2021-02-02 19:39:45'),
(22, '', 'Pemberitahuan', 4, 'Link anda dengan kode \"HXs4yfGD9xxx\"\" dan judul \"\"\" terpaksa kami lakukan blokir karena:', '2021-02-03 02:24:41', '2021-02-02 22:35:40', '2021-02-02 22:35:40'),
(23, '', 'Pemberitahuan', 4, 'Link anda dengan kode \"HXs4yfGD9xxx\"\" dan judul \"\"\" terpaksa kami lakukan blokir karena:', '2021-02-03 02:24:41', '2021-02-02 22:35:50', '2021-02-02 22:35:50'),
(24, '', 'Pemberitahuan', 4, 'Link anda dengan kode \"HXs4yfGD9xxx\"\" dan judul \"\"\" terpaksa kami lakukan blokir karena:', '2021-02-03 02:24:41', '2021-02-02 22:35:57', '2021-02-02 22:35:57'),
(25, '', 'Pemberitahuan', 4, 'Link anda dengan kode \"HXs4yfGD9xxx\"\" dan judul \"\"\" terpaksa kami lakukan blokir karena:', '2021-02-03 02:24:41', '2021-02-02 22:39:44', '2021-02-02 22:39:44');

-- --------------------------------------------------------

--
-- Table structure for table `reason`
--

CREATE TABLE `reason` (
  `id` int(11) NOT NULL,
  `reason` varchar(128) NOT NULL,
  `text` varchar(128) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime NOT NULL DEFAULT current_timestamp(),
  `deletedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reason`
--

INSERT INTO `reason` (`id`, `reason`, `text`, `createdAt`, `updatedAt`, `deletedAt`) VALUES
(1, 'Pornography', 'This link contains Pornography', '2021-02-03 13:34:45', '2021-02-03 13:34:45', NULL),
(2, 'Violence', 'This link contains/inciting Violence', '2021-02-03 13:34:45', '2021-02-03 13:34:45', NULL),
(3, 'Copyright Issues', 'I have copyright issues with this Link!!', '2021-02-03 13:34:45', '2021-02-03 07:21:04', NULL),
(4, 'Breaking Law', 'I believe this Link is breaking law', '2021-02-03 13:34:45', '2021-02-03 13:34:45', NULL),
(5, 'Hak Cipta', 'Konten ini melanggar hak cipta seseoranggg', '2021-02-03 07:00:28', '2021-02-03 08:44:32', '2021-02-03 08:44:36');

-- --------------------------------------------------------

--
-- Table structure for table `reason_report`
--

CREATE TABLE `reason_report` (
  `id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `reason_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reason_report`
--

INSERT INTO `reason_report` (`id`, `report_id`, `reason_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(10, 9, 1),
(11, 9, 2),
(12, 10, 1),
(13, 10, 2),
(14, 10, 3),
(15, 10, 4),
(16, 11, 1),
(17, 11, 2),
(18, 11, 3),
(19, 11, 4),
(20, 12, 4);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `link` int(11) NOT NULL,
  `ip_reporter` varchar(32) NOT NULL,
  `additional_reason` text DEFAULT NULL,
  `validated` tinyint(4) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `link`, `ip_reporter`, `additional_reason`, `validated`, `createdAt`, `updatedAt`) VALUES
(1, 454, '127.0.0.1', 'saya gasuka', 1, '2021-01-15 00:00:00', '2021-01-15 00:00:00'),
(9, 338, '127.0.0.1', 'Tcakep', 0, '2021-01-22 00:00:00', '2021-01-22 00:00:00'),
(10, 338, '127.0.0.1', 'kedua nih, isinya 4 reasons', 1, '2021-01-22 00:00:00', '2021-01-22 00:00:00'),
(11, 338, '127.0.0.1', 'kedua nih, isinya 4 reasons', 0, '2021-01-22 00:00:00', '2021-01-22 00:00:00'),
(12, 454, '127.0.0.1', 'jelek banget, benci saya', 0, '2021-01-26 00:00:00', '2021-01-26 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sequelizemeta`
--

CREATE TABLE `sequelizemeta` (
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sequelizemeta`
--

INSERT INTO `sequelizemeta` (`name`) VALUES
('20201105091100-create-user.js'),
('20201105091130-create-link.js'),
('20201105091134-create-link-platform.js'),
('20201105091206-create-list-platform.js'),
('20201105091238-create-action-list-latform.js');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `admin`, `active`, `createdAt`, `updatedAt`) VALUES
(3, 'test@test.com', NULL, '$2b$10$GJOC1oP3SziiaaUlJ8M.HuzTZ7lXq2Z4eCNtGpU0rfB9qI3sGB1RS', 1, 1, '2020-11-10 05:05:51', '2020-11-10 05:05:51'),
(4, 'test2@test.com', 'usernamenew', '$2y$12$GhyS97AVmvatINuHKGddauhy.CeBjpyJvrXGiaqvLamBSQbBjpDda', 0, 1, '2020-11-18 02:08:05', '2021-02-03 01:11:10'),
(10, 'SA@SA.com', 'SA', '$2y$12$YNanVa4s34ecKLlHJyM.tOLPVSWmmuHsmomMogBqvW03I6syOQhJK', 2, 1, '2020-11-10 05:05:51', '2021-01-15 01:22:50'),
(12, 'xxx@xxx.com', 'xxxxxxxx', '$2y$12$rD2icaH6af76NevFkLExXe9jabOvQfhDai55VeIu5uK.YQ7XBwY0a', 0, 1, '2021-02-05 00:00:00', '2021-02-05 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `link_id` int(11) NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdAt` timestamp NULL DEFAULT NULL,
  `updatedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`id`, `link_id`, `ip`, `referer`, `createdAt`, `updatedAt`) VALUES
(1, 338, '127.0.0.1', 'Localhost', '2020-12-25 17:00:00', '2020-12-25 17:00:00'),
(3, 338, '121.11.22.3', 'Youtube', '2020-12-25 17:00:00', '2020-12-25 17:00:00'),
(4, 338, '127.0.0.1\r\n312.123.13.1', 'Youtube', '2020-12-26 17:00:00', '2020-12-25 17:00:00'),
(17, 350, '127.0.0.1', 'localhost', '2021-01-04 17:00:00', '2021-01-04 17:00:00'),
(22, 439, '127.0.0.1', 'localhost', '2021-01-10 17:00:00', '2021-01-10 17:00:00'),
(23, 372, '127.0.0.1', 'localhost', '2021-01-14 17:00:00', '2021-01-14 17:00:00'),
(24, 454, '127.0.0.1', 'localhost', '2021-01-14 17:00:00', '2021-01-14 17:00:00'),
(25, 338, '312.123.13.1', 'Youtube', '2020-12-27 17:00:00', '2020-12-25 17:00:00'),
(26, 338, '127.0.0.1', 'Localhost', '2020-11-26 05:55:25', '2020-12-25 17:00:00'),
(27, 338, '127.0.0.1', 'Localhost', '2021-01-01 05:55:25', '2020-12-25 17:00:00'),
(28, 374, '127.0.0.1', 'localhost', '2021-02-03 17:00:00', '2021-02-03 17:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action_list_latforms`
--
ALTER TABLE `action_list_latforms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clickthroughs`
--
ALTER TABLE `clickthroughs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `link_id` (`link_id`),
  ADD KEY `link_platform_id` (`link_platform_id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `link_platforms`
--
ALTER TABLE `link_platforms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_link` (`id_link`),
  ADD KEY `id_link_2` (`id_link`),
  ADD KEY `jenis_platform` (`jenis_platform`),
  ADD KEY `text` (`text`);

--
-- Indexes for table `list_platforms`
--
ALTER TABLE `list_platforms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_text`
--
ALTER TABLE `list_text`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `reason`
--
ALTER TABLE `reason`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reason_report`
--
ALTER TABLE `reason_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `report_id` (`report_id`),
  ADD KEY `reason_id` (`reason_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `link` (`link`);

--
-- Indexes for table `sequelizemeta`
--
ALTER TABLE `sequelizemeta`
  ADD PRIMARY KEY (`name`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `link_id` (`link_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action_list_latforms`
--
ALTER TABLE `action_list_latforms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clickthroughs`
--
ALTER TABLE `clickthroughs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=460;

--
-- AUTO_INCREMENT for table `link_platforms`
--
ALTER TABLE `link_platforms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=560;

--
-- AUTO_INCREMENT for table `list_platforms`
--
ALTER TABLE `list_platforms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `list_text`
--
ALTER TABLE `list_text`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `reason`
--
ALTER TABLE `reason`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reason_report`
--
ALTER TABLE `reason_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clickthroughs`
--
ALTER TABLE `clickthroughs`
  ADD CONSTRAINT `clickthroughs_ibfk_1` FOREIGN KEY (`link_platform_id`) REFERENCES `link_platforms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `links`
--
ALTER TABLE `links`
  ADD CONSTRAINT `links_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `link_platforms`
--
ALTER TABLE `link_platforms`
  ADD CONSTRAINT `link_platforms_ibfk_1` FOREIGN KEY (`id_link`) REFERENCES `links` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `link_platforms_ibfk_2` FOREIGN KEY (`jenis_platform`) REFERENCES `list_platforms` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `link_platforms_ibfk_3` FOREIGN KEY (`text`) REFERENCES `list_text` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `reason_report`
--
ALTER TABLE `reason_report`
  ADD CONSTRAINT `reason_report_ibfk_1` FOREIGN KEY (`reason_id`) REFERENCES `reason` (`id`),
  ADD CONSTRAINT `reason_report_ibfk_2` FOREIGN KEY (`report_id`) REFERENCES `report` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`link`) REFERENCES `links` (`id`);

--
-- Constraints for table `visits`
--
ALTER TABLE `visits`
  ADD CONSTRAINT `visits_ibfk_1` FOREIGN KEY (`link_id`) REFERENCES `links` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
