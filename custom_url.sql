-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2021 at 05:54 AM
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
(1, 338, 389, '127.0.0.1', '2020-12-26 17:00:00', '2020-12-26 17:00:00');

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
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id`, `image_path`, `video_embed_url`, `id_user`, `short_link`, `createdAt`, `updatedAt`, `title`) VALUES
(324, NULL, NULL, NULL, 'xivs5DrjKz', '2020-12-16 00:00:00', '2020-12-16 00:00:00', 'Blackpink'),
(325, 'xye8aoedgrqtx7z5qmay', 'https://www.youtube.com/embed/e-ORhEE9VVg', NULL, 'brCXnOFPm', '2020-12-16 00:00:00', '2020-12-16 00:00:00', 'Melihat Angkasa'),
(329, 'xye8aoedgrqtx7z5qmay', 'https://www.youtube.com/embed/_Hu446ApWaY', NULL, 'ldLD3958t', '2020-12-17 00:00:00', '2020-12-17 00:00:00', 'BLACKPINK - \'How You Like That\' M/V'),
(331, 'mapcxjjg69tvwut0minw', 'https://www.youtube.com/embed/e-ORhEE9VVg', NULL, 'LQTK5nijk', '2020-12-17 00:00:00', '2020-12-17 00:00:00', 'landing create link loggedout'),
(332, 'c4gx13berwnwtgrokhpe', 'https://www.youtube.com/embed/bmVKaAV_7-A', NULL, 'zyCDqny5I', '2020-12-17 00:00:00', '2020-12-17 00:00:00', 'https://www.youtube.com/watch?v=bmVKaAV_7-A'),
(333, 'nsrksbh7bm83qy60resl', 'https://www.youtube.com/embed/bmVKaAV_7-A', NULL, 'vEDukhfZJ', '2020-12-17 00:00:00', '2020-12-17 00:00:00', 'https://www.youtube.com/watch?v=bmVKaAV_7-A'),
(334, 'fmlr117hytrqr3y5zgso', 'https://www.youtube.com/embed/bmVKaAV_7-A', NULL, 'xgWQ9ORRT', '2020-12-17 00:00:00', '2020-12-17 00:00:00', 'https://www.youtube.com/watch?v=bmVKaAV_7-A'),
(335, 'yo4vxcc5ejkyqmeeeavo', 'https://www.youtube.com/embed/bmVKaAV_7-A', NULL, '6UufMASeF', '2020-12-17 00:00:00', '2020-12-17 00:00:00', 'https://www.youtube.com/watch?v=bmVKaAV_7-A'),
(338, 'lswuu9nccu6tx0nimblm', 'https://www.youtube.com/watch?v=ioNng23DkIM', 4, 'HXs4yfGD9xxx', '2020-12-18 00:00:00', '2020-12-18 00:00:00', 'ses dumm'),
(340, NULL, NULL, 4, 'ybONvzVVK', '2020-12-24 00:00:00', '2020-12-24 00:00:00', 'A Title'),
(341, NULL, 'asdasdasd', 4, 'XvEDSMJLB', '2020-12-27 00:00:00', '2020-12-27 00:00:00', 'testasd'),
(342, NULL, 'asdasdasd', 4, 'cIus5e6Cm', '2020-12-27 00:00:00', '2020-12-27 00:00:00', 'testasd'),
(343, NULL, 'asdasdasd', 4, '08dZbOXfk', '2020-12-27 00:00:00', '2020-12-27 00:00:00', 'testasd'),
(344, NULL, 'asdasdasd', 4, 'zR4sV3S6N', '2020-12-27 00:00:00', '2020-12-27 00:00:00', 'testasd'),
(345, NULL, 'asdasdasd', 4, '4cWSi11ZR', '2020-12-27 00:00:00', '2020-12-27 00:00:00', 'testasd'),
(346, NULL, 'asdasdasd', 4, 'ngoTiLTbm', '2020-12-27 00:00:00', '2020-12-27 00:00:00', 'testasd'),
(347, NULL, 'asdasdasd', 4, 'ysDNs7dKK', '2020-12-27 00:00:00', '2020-12-27 00:00:00', 'testasd'),
(348, NULL, 'asdasdasd', 4, 'TFNqnFWLw', '2020-12-27 00:00:00', '2020-12-27 00:00:00', 'testasd'),
(349, NULL, 'asdasdasd', 4, 'H1G2pGaLZ', '2020-12-27 00:00:00', '2020-12-27 00:00:00', 'testasd'),
(350, NULL, 'asdasdasd', 4, '7RNjDOaZm', '2020-12-27 00:00:00', '2020-12-27 00:00:00', 'testasd'),
(351, NULL, 'asdasdasd', 4, '6shegL5rV', '2020-12-27 00:00:00', '2020-12-27 00:00:00', 'testasd'),
(355, NULL, 'asdasdasd', 4, '5Ilu72hWr', '2020-12-27 00:00:00', '2020-12-27 00:00:00', 'testasd'),
(357, NULL, 'asdasdasd', 4, 'Rkv1Ldim3', '2020-12-27 00:00:00', '2020-12-27 00:00:00', 'testasd'),
(358, NULL, 'asdasdasd', 4, '86gNTfwDe', '2020-12-27 00:00:00', '2020-12-27 00:00:00', 'testasd'),
(359, NULL, 'asdasdasd', 4, 'jqDvYd5Vm', '2020-12-27 00:00:00', '2020-12-27 00:00:00', 'testasd'),
(360, NULL, 'asdasdasd', 4, 'v0Xsgn2Hw', '2020-12-27 00:00:00', '2020-12-27 00:00:00', 'testasd'),
(361, NULL, 'asdasdasd', 4, 'a5xxIPwdG', '2020-12-27 00:00:00', '2020-12-27 00:00:00', 'testasd'),
(362, NULL, 'asdasdasd', 4, 'zTp6dsxV8', '2020-12-27 00:00:00', '2020-12-27 00:00:00', 'testasd'),
(363, NULL, 'asdasdasd', 4, '8PEsjZU8T', '2020-12-27 00:00:00', '2020-12-27 00:00:00', 'testasd'),
(364, NULL, 'asdasdasd', 4, '65SQT76aS', '2020-12-27 00:00:00', '2020-12-27 00:00:00', 'testasd'),
(365, NULL, 'test', 4, 'WKICncfyE', '2020-12-27 00:00:00', '2020-12-27 00:00:00', 'testtest'),
(366, NULL, 'test', 4, 'yJYzgJ1CO', '2020-12-27 00:00:00', '2020-12-27 00:00:00', 'testtest'),
(367, NULL, 'test', 4, 'M56Stg5AO', '2020-12-27 00:00:00', '2020-12-27 00:00:00', 'testtest'),
(368, NULL, 'test', 4, '17K8KXn1d', '2020-12-27 00:00:00', '2020-12-27 00:00:00', 'testtest'),
(369, NULL, 'test', 4, 'dXOkMkLqJ', '2020-12-27 00:00:00', '2020-12-27 00:00:00', 'testtest'),
(370, NULL, 'test', 4, 'tLb4dvyXw', '2020-12-27 00:00:00', '2020-12-27 00:00:00', 'testtest');

-- --------------------------------------------------------

--
-- Table structure for table `link_platforms`
--

CREATE TABLE `link_platforms` (
  `id` int(11) NOT NULL,
  `url_platform` varchar(255) DEFAULT NULL,
  `jenis_platform` varchar(255) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `id_link` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `link_platforms`
--

INSERT INTO `link_platforms` (`id`, `url_platform`, `jenis_platform`, `text`, `id_link`, `createdAt`, `updatedAt`) VALUES
(373, 'https://www.youtube.com/watch?v=ioNng23DkIM', 'youtube', 'Listen', 324, '2020-12-16 00:00:00', '2020-12-16 00:00:00'),
(374, 'https://www.youtube.com/watch?v=e-ORhEE9VVg', 'youtube', 'Watch', 325, '2020-12-16 00:00:00', '2020-12-16 00:00:00'),
(378, 'https://www.youtube.com/watch?v=_Hu446ApWaY', 'youtube', 'Listen', 329, '2020-12-17 00:00:00', '2020-12-17 00:00:00'),
(380, '', '', '', 331, '2020-12-17 00:00:00', '2020-12-17 00:00:00'),
(381, 'https://www.youtube.com/watch?v=bmVKaAV_7-A', 'spotify', 'Play', 332, '2020-12-17 00:00:00', '2020-12-17 00:00:00'),
(382, 'https://www.youtube.com/watch?v=bmVKaAV_7-A', 'youtube', 'Listen', 332, '2020-12-17 00:00:00', '2020-12-17 00:00:00'),
(383, '', '', '', 333, '2020-12-17 00:00:00', '2020-12-17 00:00:00'),
(384, '', '', '', 334, '2020-12-17 00:00:00', '2020-12-17 00:00:00'),
(385, '', '', '', 335, '2020-12-17 00:00:00', '2020-12-17 00:00:00'),
(388, 'https://www.youtube.com/watch?v=ioNng23DkIM', 'spotify', 'Listen', 338, '2020-12-18 00:00:00', '2020-12-23 00:00:00'),
(389, 'sad', 'youtube', 'Play', 338, '2020-12-18 00:00:00', '2020-12-23 00:00:00'),
(392, 'asdasd', 'spotify', 'Listen', 340, '2020-12-24 00:00:00', '2021-01-03 00:00:00'),
(393, 'asdasdasd', 'youtube', 'Listen', 341, '2020-12-27 00:00:00', '2020-12-27 00:00:00'),
(394, 'tes', 'spotify', 'Listen', 342, '2020-12-27 00:00:00', '2020-12-27 00:00:00'),
(395, 'tes', 'spotify', 'Listen', 343, '2020-12-27 00:00:00', '2020-12-27 00:00:00'),
(396, 'tes', 'spotify', 'Listen', 344, '2020-12-27 00:00:00', '2020-12-27 00:00:00'),
(397, 'asda', 'spotify', 'Listen', 345, '2020-12-27 00:00:00', '2020-12-27 00:00:00'),
(398, 'asd', 'spotify', 'Listen', 346, '2020-12-27 00:00:00', '2020-12-27 00:00:00'),
(399, 'tes', 'spotify', 'Listen', 347, '2020-12-27 00:00:00', '2020-12-27 00:00:00'),
(400, 'tes', 'spotify', 'Listen', 348, '2020-12-27 00:00:00', '2020-12-27 00:00:00'),
(401, 'asd', 'youtube', 'Listen', 349, '2020-12-27 00:00:00', '2020-12-27 00:00:00'),
(402, 'asdasd', 'spotify', 'Listen', 350, '2020-12-27 00:00:00', '2020-12-27 00:00:00'),
(403, 'asd', 'spotify', 'Listen', 351, '2020-12-27 00:00:00', '2020-12-27 00:00:00'),
(407, 'asd', 'youtube', 'Listen', 355, '2020-12-27 00:00:00', '2020-12-27 00:00:00'),
(409, 'sad', 'spotify', 'Listen', 357, '2020-12-27 00:00:00', '2020-12-27 00:00:00'),
(410, 'asda', 'youtube', 'Listen', 358, '2020-12-27 00:00:00', '2020-12-27 00:00:00'),
(411, 'asd', 'youtube', 'Listen', 359, '2020-12-27 00:00:00', '2020-12-27 00:00:00'),
(412, 'adasd', 'spotify', 'Listen', 360, '2020-12-27 00:00:00', '2020-12-27 00:00:00'),
(413, 'adasd', 'spotify', 'Listen', 361, '2020-12-27 00:00:00', '2020-12-27 00:00:00'),
(414, 'ada', 'youtube', 'Listen', 362, '2020-12-27 00:00:00', '2020-12-27 00:00:00'),
(415, 'asdasd', 'spotify', 'Listen', 363, '2020-12-27 00:00:00', '2020-12-27 00:00:00'),
(416, 'asdasd', 'spotify', 'Listen', 364, '2020-12-27 00:00:00', '2020-12-27 00:00:00'),
(417, 'test', 'spotify', 'Listen', 365, '2020-12-27 00:00:00', '2020-12-27 00:00:00'),
(418, 'asd', 'spotify', 'Listen', 366, '2020-12-27 00:00:00', '2020-12-27 00:00:00'),
(419, 'asd', 'youtube', 'Listen', 367, '2020-12-27 00:00:00', '2020-12-27 00:00:00'),
(420, 'asd', 'spotify', 'Listen', 338, '2020-12-27 00:00:00', '2020-12-27 00:00:00'),
(421, 'asd', 'spotify', 'Listen', 369, '2020-12-27 00:00:00', '2020-12-27 00:00:00'),
(422, 'asd', 'spotify', 'Listen', 370, '2020-12-27 00:00:00', '2020-12-27 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `list_platforms`
--

CREATE TABLE `list_platforms` (
  `id` int(11) NOT NULL,
  `platform_name` varchar(255) DEFAULT NULL,
  `logo_image_path` varchar(255) DEFAULT NULL,
  `platform_regex` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_platforms`
--

INSERT INTO `list_platforms` (`id`, `platform_name`, `logo_image_path`, `platform_regex`, `createdAt`, `updatedAt`) VALUES
(11, 'spotify', 'assets/logo/spotify.svg', 'www.spotify.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'youtube', 'assets/logo/youtube.svg', 'www.youtube.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'deezer', 'assets/logo/hdlqx1eapvx1yr0ejzpa', 'https://www.deezer.com/', '2020-12-22 00:00:00', '2020-12-22 00:00:00'),
(19, 'dummy', 'assets/logo/ky7qw4ranndorkmvf2ow', 'dummy.com', '2021-01-04 00:00:00', '2021-01-04 00:00:00');

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
(16, 'Get Tickets', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'View Ticket Prices', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'Discover', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'Kunjungi', '2021-01-03 00:00:00', '2021-01-03 00:00:00'),
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
(2, '2020_12_26_110846_create_clickthrough_table', 1);

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
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `admin`, `createdAt`, `updatedAt`) VALUES
(3, 'test@test.com', NULL, '$2b$10$GJOC1oP3SziiaaUlJ8M.HuzTZ7lXq2Z4eCNtGpU0rfB9qI3sGB1RS', 1, '2020-11-10 05:05:51', '2020-11-10 05:05:51'),
(4, 'test2@test.com', 'nama test 2', '$2y$12$YLKo.ayVvBmsEWnHA6Y2OON1CkgwNx8j/N1CiHLZOjCY.2NvKVwYS', 0, '2020-11-18 02:08:05', '2021-01-03 11:10:09'),
(5, 'mail88@mail.com', NULL, '$2y$12$ExUIErZWgNpcSuGUxf.QK.fkFS.w55WrMceHjZWy7ME.VIy2bGa2i', 0, '2020-12-02 00:00:00', '2020-12-02 00:00:00');

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
(2, 370, '127.0.0.1', 'Localhost', '2020-12-26 17:00:00', '2020-12-26 17:00:00'),
(3, 338, '121.11.22.3', 'Youtube', '2020-12-25 17:00:00', '2020-12-25 17:00:00'),
(4, 338, '127.0.0.1\r\n312.123.13.1', 'Youtube', '2020-12-25 17:00:00', '2020-12-25 17:00:00'),
(5, 340, '127.0.0.1', 'Direct', '2020-12-27 17:00:00', '2020-12-27 17:00:00'),
(6, 340, '127.0.0.2', 'Youtube', '2020-12-27 17:00:00', '2020-12-27 17:00:00'),
(7, 340, '127.0.0.2', 'Youtube', '2020-12-27 17:00:00', '2020-12-27 17:00:00'),
(8, 329, '127.0.0.1', 'localhost', '2020-12-27 17:00:00', '2020-12-27 17:00:00'),
(9, 324, '127.0.0.1', 'localhost', '2020-12-27 17:00:00', '2020-12-27 17:00:00'),
(10, 334, '127.0.0.1', 'localhost', '2020-12-27 17:00:00', '2020-12-27 17:00:00'),
(11, 335, '127.0.0.1', 'localhost', '2020-12-27 17:00:00', '2020-12-27 17:00:00'),
(12, 331, '127.0.0.1', 'localhost', '2020-12-27 17:00:00', '2020-12-27 17:00:00'),
(13, 325, '127.0.0.1', 'localhost', '2020-12-27 17:00:00', '2020-12-27 17:00:00'),
(14, 346, '127.0.0.1', 'localhost', '2020-12-27 17:00:00', '2020-12-27 17:00:00'),
(16, 364, '127.0.0.1', 'localhost', '2021-01-01 17:00:00', '2021-01-01 17:00:00');

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
  ADD KEY `id_link_2` (`id_link`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=371;

--
-- AUTO_INCREMENT for table `link_platforms`
--
ALTER TABLE `link_platforms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=423;

--
-- AUTO_INCREMENT for table `list_platforms`
--
ALTER TABLE `list_platforms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `list_text`
--
ALTER TABLE `list_text`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
  ADD CONSTRAINT `link_platforms_ibfk_1` FOREIGN KEY (`id_link`) REFERENCES `links` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `visits`
--
ALTER TABLE `visits`
  ADD CONSTRAINT `visits_ibfk_1` FOREIGN KEY (`link_id`) REFERENCES `links` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
