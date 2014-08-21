-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 22, 2014 at 12:47 AM
-- Server version: 5.5.38-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vivtestdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `authorrole`
--

CREATE TABLE IF NOT EXISTS `authorrole` (
  `authorid` int(8) NOT NULL,
  `roleid` varchar(255) NOT NULL,
  PRIMARY KEY (`authorid`,`roleid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authorrole`
--

INSERT INTO `authorrole` (`authorid`, `roleid`) VALUES
(2, 'Site Administrator'),
(3, 'Account Administrator'),
(4, 'Content Editor'),
(5, 'Account Administrator'),
(5, 'Content Editor'),
(5, 'Site Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` char(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`, `email`, `password`) VALUES
(2, 'V Mehra', 'vivek_mehra@infosys.com', '5bce98f73f3ed0c837f2729ed9509b38ea66a156db7f653356cb6fe37b366e85'),
(3, 'Vivek Mehra', 'me@vivekmehra.me', '8b8666375898a53c21bc7f58491f6d63fb37efa1d41dd941f7a76c404172e627'),
(4, 'VKumar', 'vivek.1376@gmail.com', '8630c6c9af0730c3e9635a44c97bfb4ac4ff57c449951a60848ac666f5f2de0c'),
(5, 'yoda', 'yoda@starwars.com', '32500d7500ce0755c1a0f96ef86b10c3100f70f9ca6d8f4d3673d2925afc2151');

-- --------------------------------------------------------

--
-- Table structure for table `chatfriends`
--

CREATE TABLE IF NOT EXISTS `chatfriends` (
  `userid` int(7) NOT NULL,
  `friendid` int(7) NOT NULL,
  PRIMARY KEY (`userid`,`friendid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chatfriends`
--

INSERT INTO `chatfriends` (`userid`, `friendid`) VALUES
(1, 2),
(1, 5),
(1, 13),
(6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `chatusers`
--

CREATE TABLE IF NOT EXISTS `chatusers` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` char(64) NOT NULL,
  `online` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `chatusers`
--

INSERT INTO `chatusers` (`id`, `first_name`, `last_name`, `email`, `username`, `password`, `online`) VALUES
(1, 'vivek', '', 'me@vivekmehra.me', 'vivek', 'a3da73976501812cd7b821a20bfb09af0a6a891e419cdfb761fb19a92c914242', 0),
(2, 'amit', '', 'amit@amit.com', 'amit', '623f0b5584eb86d9f905e52679a9ce3bca0bd91a950a03e0eaa1b2f8bb3e9908', 1),
(5, 'harry', '', 'harry@potter.com', 'harry', 'df46219531cb5d522d0845901978dccfa286a5b0437f4f9cd4e485064f6b632c', 0),
(6, 'arun', '', 'arun@arun.com', 'arun', 'b52c75123406063a2abf0a89cc0c554a182388cb5545d37c6da9313aa539d93b', 0),
(7, 'anurag', '', 'anurag@anurag.com', 'anurag', 'c30f3cfd3a437f9cf605c4a887f97d4090d906a1090b9d50befdcef7fc520fc0', 0),
(10, 'dfd', 'dssf', 'sdfsd', 'dsfs', 'b84ff8057ee3a7f87deac4ae29ac59292f02e6c28f987031648011018384d888', 0),
(12, 'cc', 'wd', 'sds', 'sds', '5dde896887f6754c9b15bfe3a441ae4806df2fde94001311e08bf110622e0bbe', 0),
(13, 'darth', 'vader', 'vader@starwars.com', 'darth', '32500d7500ce0755c1a0f96ef86b10c3100f70f9ca6d8f4d3673d2925afc2151', 1);

-- --------------------------------------------------------

--
-- Table structure for table `friendrequests`
--

CREATE TABLE IF NOT EXISTS `friendrequests` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `userid` int(7) NOT NULL,
  `requesteeid` int(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE IF NOT EXISTS `genres` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(2, 'scifi'),
(4, 'drama'),
(5, 'comedy'),
(7, 'romance'),
(8, 'thriller'),
(9, 'fantasy'),
(10, 'biography'),
(11, 'mystery'),
(14, 'crime'),
(15, 'horror'),
(16, 'animation');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `senderid` int(7) NOT NULL DEFAULT '0',
  `receiverid` int(7) NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=817 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `senderid`, `receiverid`, `message`, `timestamp`) VALUES
(654, 0, 0, 'vv', '2014-06-08 20:08:02'),
(655, 0, 0, 'hhiiiii', '2014-06-08 20:17:03'),
(656, 0, 0, 'qqq', '2014-06-08 20:29:44'),
(657, 2, 1, 'rrrr', '2014-06-08 20:31:51'),
(658, 1, 2, '34123123', '2014-06-08 20:32:12'),
(659, 1, 2, 'vbvcbcv', '2014-06-08 20:34:22'),
(660, 1, 2, 'cc', '2014-06-08 20:37:30'),
(661, 2, 1, 'hi', '2014-06-08 20:37:47'),
(662, 1, 2, 'hello', '2014-06-08 20:37:55'),
(663, 2, 1, 'eee', '2014-06-08 20:56:40'),
(664, 2, 1, 'qq', '2014-06-08 20:57:15'),
(665, 2, 1, 'qq', '2014-06-08 20:58:54'),
(666, 2, 1, 'ee', '2014-06-08 20:59:12'),
(667, 2, 1, 'ww', '2014-06-08 21:03:52'),
(668, 2, 1, 'xx', '2014-06-08 21:04:33'),
(669, 2, 1, 'rr', '2014-06-08 21:04:42'),
(670, 2, 1, 'ccc', '2014-06-08 21:05:59'),
(671, 2, 1, 'cc', '2014-06-08 21:06:47'),
(672, 2, 1, '1', '2014-06-08 21:07:31'),
(673, 2, 1, 'vvvv', '2014-06-08 21:08:15'),
(674, 2, 1, 'vv', '2014-06-08 21:19:55'),
(675, 2, 1, 'ww', '2014-06-08 21:20:05'),
(676, 1, 2, 'hello', '2014-06-08 21:21:01'),
(677, 2, 1, 'hi', '2014-06-08 21:21:14'),
(678, 1, 2, 'how r u', '2014-06-08 21:21:35'),
(679, 1, 2, 'hi', '2014-06-08 21:27:52'),
(680, 2, 1, 'hello', '2014-06-08 21:28:13'),
(681, 1, 2, 'hi', '2014-06-08 21:29:35'),
(682, 2, 1, 'hello', '2014-06-08 21:29:42'),
(683, 1, 2, 'hi', '2014-06-08 21:31:34'),
(684, 2, 1, 'hello', '2014-06-08 21:31:42'),
(685, 2, 1, 'hi', '2014-06-08 21:36:19'),
(686, 1, 2, 'hello', '2014-06-08 21:36:36'),
(687, 1, 2, 'c', '2014-06-10 19:06:16'),
(688, 2, 1, 'hi', '2014-06-10 19:06:39'),
(689, 1, 2, 'hello', '2014-06-10 19:06:45'),
(690, 0, 0, 'hi\n', '2014-06-10 19:08:43'),
(691, 0, 0, 'hello', '2014-06-10 19:08:46'),
(692, 0, 0, 'sdfsdf', '2014-06-10 19:09:02'),
(693, 2, 1, 'heee', '2014-06-10 19:10:44'),
(694, 1, 2, 'hhii', '2014-06-10 19:10:50'),
(695, 0, 0, 'ss', '2014-06-10 19:11:02'),
(696, 1, 2, 'howsdads', '2014-06-10 19:11:16'),
(697, 0, 0, 'vv', '2014-06-12 12:53:28'),
(698, 0, 0, 'aa', '2014-06-12 12:53:31'),
(699, 0, 0, 'hhhh', '2014-06-12 12:54:00'),
(700, 0, 0, 'hiii', '2014-06-12 12:54:22'),
(701, 0, 0, 'hello', '2014-06-12 12:55:11'),
(702, 0, 0, 'byeee', '2014-06-12 12:56:14'),
(703, 0, 0, 'kkk', '2014-06-12 12:57:12'),
(704, 0, 0, 'bbb b bb', '2014-06-12 12:58:01'),
(705, 0, 0, '  mm', '2014-06-12 12:58:09'),
(706, 0, 0, 'mmm', '2014-06-12 12:58:27'),
(707, 0, 0, 'q', '2014-06-12 12:58:35'),
(708, 0, 0, 'xx', '2014-06-12 13:15:54'),
(709, 0, 0, 'zz', '2014-06-12 13:16:08'),
(710, 0, 0, 'ee', '2014-06-12 13:16:15'),
(711, 0, 0, 'qq', '2014-06-12 13:16:36'),
(712, 0, 0, 'c', '2014-06-12 13:18:15'),
(713, 0, 0, 'qqq', '2014-06-12 13:18:20'),
(714, 0, 0, 'hiii', '2014-06-12 13:20:08'),
(715, 0, 0, 'cc', '2014-06-12 13:48:57'),
(716, 0, 0, 'cc', '2014-06-12 13:50:11'),
(717, 0, 0, 'aaa', '2014-06-12 13:50:24'),
(718, 0, 0, 'vv', '2014-06-12 13:51:02'),
(719, 0, 0, 'vv', '2014-06-12 13:52:05'),
(720, 0, 0, 'vv', '2014-06-12 13:58:34'),
(721, 0, 0, 'qq', '2014-06-12 13:59:17'),
(722, 0, 0, 'bbb', '2014-06-12 14:00:12'),
(723, 0, 0, 'nnn', '2014-06-12 14:01:46'),
(724, 0, 0, 'nn', '2014-06-12 14:02:21'),
(725, 0, 0, 'qq', '2014-06-12 14:03:00'),
(726, 0, 0, 'nnn', '2014-06-12 14:04:11'),
(727, 0, 0, 'bnv', '2014-06-12 14:04:25'),
(728, 0, 0, 'nn', '2014-06-12 14:07:28'),
(729, 0, 0, 'hello how r u', '2014-06-12 14:07:52'),
(730, 0, 0, 'fff', '2014-06-12 14:18:46'),
(731, 0, 0, 'vbcvbv', '2014-06-12 14:23:38'),
(732, 0, 0, 'vc', '2014-06-12 14:26:41'),
(733, 0, 0, 'hello fdds  sdf sdf df sdf s fdsd fsd fsd fsd fsdf  erw f gb cvb cvb cvbcb dg rt w nn ean n rs bd gsf ', '2014-06-12 14:27:12'),
(734, 0, 0, 'vvv', '2014-06-12 17:50:21'),
(735, 0, 0, 'hellyyy', '2014-06-12 17:59:47'),
(736, 2, 1, 'cc', '2014-06-12 19:06:37'),
(737, 2, 1, 'bbb', '2014-06-12 19:06:42'),
(738, 1, 2, 'vv', '2014-06-12 19:42:53'),
(739, 1, 2, 'cc', '2014-06-12 19:46:35'),
(740, 2, 1, 'cvcv', '2014-06-12 19:46:52'),
(741, 2, 1, 'nn', '2014-06-12 19:47:38'),
(742, 2, 1, 'cvcv', '2014-06-12 19:48:15'),
(743, 1, 2, 'cc', '2014-06-12 19:54:13'),
(744, 1, 2, 'cc', '2014-06-12 20:09:34'),
(745, 1, 2, 'cc', '2014-06-12 20:15:13'),
(746, 1, 2, 'cc', '2014-06-12 20:36:53'),
(747, 1, 2, 'cccc', '2014-06-12 20:37:19'),
(748, 1, 2, 'sdsd', '2014-06-12 20:41:39'),
(749, 2, 1, 'cvc', '2014-06-12 20:47:02'),
(750, 2, 1, 'vv', '2014-06-12 20:47:19'),
(751, 1, 2, 'aa', '2014-06-12 20:47:36'),
(752, 2, 1, 'hellooo', '2014-06-12 20:47:53'),
(753, 2, 1, 'heeewele34', '2014-06-12 20:48:57'),
(754, 1, 2, 'hello', '2014-06-12 20:59:58'),
(755, 2, 1, 'hi', '2014-06-12 21:00:32'),
(756, 1, 2, 'hi', '2014-06-12 21:05:20'),
(757, 2, 1, 'hello', '2014-06-12 21:05:27'),
(758, 1, 2, 'hi amit', '2014-06-12 21:14:38'),
(759, 2, 1, 'hello vviek', '2014-06-12 21:15:02'),
(760, 1, 2, 'cc', '2014-06-12 21:15:35'),
(761, 2, 1, 'dfsdf', '2014-06-12 21:16:28'),
(762, 2, 1, 'rterter', '2014-06-12 21:16:30'),
(763, 2, 1, 'werwerwer', '2014-06-12 21:16:32'),
(764, 2, 1, 'vbvc', '2014-06-12 21:16:34'),
(765, 2, 1, 'dfsdf', '2014-06-12 21:16:38'),
(766, 2, 1, 'hiiidfsd\n', '2014-06-12 21:17:10'),
(767, 2, 1, 'vfgs', '2014-06-12 21:17:13'),
(768, 2, 1, 'ewerwer', '2014-06-12 21:17:15'),
(769, 2, 1, 'bvcvbcvb', '2014-06-12 21:17:18'),
(770, 2, 1, 'fsdfsdf', '2014-06-12 21:17:20'),
(771, 2, 1, 'bnnvbnbn', '2014-06-12 21:17:23'),
(772, 2, 1, 'erweerwer', '2014-06-12 21:17:28'),
(773, 1, 2, 'ccv', '2014-06-19 10:56:50'),
(774, 1, 2, 'dfsd', '2014-06-19 10:56:51'),
(775, 1, 2, '\ndsfsdf', '2014-06-19 10:56:52'),
(776, 1, 2, '\ndsfsdf', '2014-06-19 10:56:53'),
(777, 1, 2, '\nerwerwe', '2014-06-19 10:56:55'),
(778, 1, 2, '\ndsfsd', '2014-06-19 10:56:56'),
(779, 1, 2, '\ndsfsd', '2014-06-19 10:56:57'),
(780, 1, 2, '\nsdfsd', '2014-06-19 10:56:58'),
(781, 1, 2, '\ndfsd', '2014-06-19 10:56:59'),
(782, 1, 2, '\n332423', '2014-06-19 10:57:02'),
(783, 1, 2, 'xcvcv', '2014-06-19 11:01:13'),
(784, 1, 2, '\ncxvx', '2014-06-19 11:01:14'),
(785, 1, 2, '\ndfsdf', '2014-06-19 11:01:15'),
(786, 1, 2, '\nerwe', '2014-06-19 11:01:16'),
(787, 1, 2, '\ndfsdf', '2014-06-19 11:01:17'),
(788, 1, 2, '\ncxvxcv', '2014-06-19 11:01:18'),
(789, 1, 2, '\nrrqeqw', '2014-06-19 11:01:20'),
(790, 1, 2, 'cxxc', '2014-06-20 08:40:10'),
(791, 1, 2, 'hi amit', '2014-06-21 06:51:38'),
(792, 2, 1, 'hello vivek', '2014-06-21 06:51:49'),
(793, 1, 2, '\nfdfs df sdf sd ds fs gdsd gs dg sdg sd gsd g sdg sdg sd gs dgse g dg sd gsd g sd gsd gs dg', '2014-06-21 06:52:21'),
(794, 1, 2, 'hi', '2014-06-21 06:55:23'),
(795, 2, 1, 'hellooo', '2014-06-21 06:55:48'),
(796, 1, 2, '\nsfaaf asf as f', '2014-06-21 06:55:55'),
(797, 1, 2, '\nhhfsdff 342 34', '2014-06-21 06:56:36'),
(798, 1, 2, 'ddgsdf f sdfdsf', '2014-06-21 06:57:15'),
(799, 1, 2, 'dfs', '2014-08-19 20:39:48'),
(800, 1, 2, '\n', '2014-08-19 20:39:49'),
(801, 1, 2, 'dfdf', '2014-08-19 20:39:54'),
(802, 1, 2, '\nd', '2014-08-19 20:39:56'),
(803, 1, 2, '\n', '2014-08-19 20:39:57'),
(804, 1, 2, '\n', '2014-08-19 20:40:00'),
(805, 1, 2, '\n', '2014-08-19 20:40:01'),
(806, 1, 2, '\n', '2014-08-19 20:40:01'),
(807, 1, 2, '\n', '2014-08-19 20:40:01'),
(808, 1, 2, '\nfdg fg df gdfg d fgd fg dsfg dsf gf g fdsg fdg sdf g', '2014-08-19 20:40:10'),
(809, 1, 2, 'hello how are you', '2014-08-19 20:40:50'),
(810, 0, 0, 'dfsdf\ndsfsdf\n', '2014-08-20 17:19:55'),
(811, 0, 0, 'ewer\n', '2014-08-20 17:19:58'),
(812, 0, 0, 'dsfsdf', '2014-08-20 17:20:09'),
(813, 0, 0, 'reter', '2014-08-20 17:20:11'),
(814, 1, 13, 'hi darth', '2014-08-21 19:04:57'),
(815, 13, 1, 'hi vivek', '2014-08-21 19:05:20'),
(816, 1, 13, '\nhow r u', '2014-08-21 19:05:35');

-- --------------------------------------------------------

--
-- Table structure for table `moviegenre`
--

CREATE TABLE IF NOT EXISTS `moviegenre` (
  `movieid` int(8) NOT NULL,
  `genreid` int(8) NOT NULL,
  PRIMARY KEY (`movieid`,`genreid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `moviegenre`
--

INSERT INTO `moviegenre` (`movieid`, `genreid`) VALUES
(1, 2),
(1, 8),
(1, 11),
(4, 4),
(4, 11),
(4, 16),
(5, 2),
(5, 7),
(5, 11),
(6, 4),
(6, 7);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE IF NOT EXISTS `movies` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `year` year(4) DEFAULT NULL,
  `description` text,
  `authorid` int(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `name`, `year`, `description`, `authorid`) VALUES
(1, 'The Matrix', 1999, 'scifi', 2),
(4, 'Waking Life', NULL, 'animation', 3),
(5, 'Solaris', NULL, '', 3),
(6, 'Before Sunrise', NULL, '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `mv`
--

CREATE TABLE IF NOT EXISTS `mv` (
  `id` int(11) DEFAULT NULL,
  `name` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `description`) VALUES
('Account Administrator', 'Add, remove and edit authors'),
('Content Editor', 'Add, remove and edit jokes'),
('Site Administrator', 'Add, remove and edit categories');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
