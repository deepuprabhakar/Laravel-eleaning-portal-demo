-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2016 at 08:11 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `infoaide_elearning2`
--

-- --------------------------------------------------------

--
-- Table structure for table `activations`
--

CREATE TABLE IF NOT EXISTS `activations` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `activations`
--

INSERT INTO `activations` (`id`, `user_id`, `code`, `completed`, `completed_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'QylWkP42NXdSA3eIDacUtjiZ1WTluj1m', 1, '2016-06-16 18:55:23', '2016-06-16 18:55:23', '2016-06-16 18:55:23'),
(3, 3, 'LGUgOCF2w9JUJpbgQZ7p5hWWJNCPlgSb', 1, '2016-06-16 18:58:04', '2016-06-16 18:58:04', '2016-06-16 18:58:04'),
(4, 4, '6lAVX9XrTN8xu5j0VVO2Z663seV6C6bY', 1, '2016-06-22 09:54:24', '2016-06-22 09:54:24', '2016-06-22 09:54:24');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `publish` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `article` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `student_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE IF NOT EXISTS `assignments` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mark` int(11) NOT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject_id` int(10) unsigned NOT NULL,
  `student_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `title`, `file`, `mark`, `remark`, `slug`, `subject_id`, `student_id`, `created_at`, `updated_at`) VALUES
(1, 'assign', 'assign.pdf', 5, 'good', 'assign', 1, 1, '2016-06-28 05:41:00', '2016-06-29 06:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `semester` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `slug`, `semester`, `created_at`, `updated_at`) VALUES
(1, 'course a', 'course-a', 6, '2016-06-21 09:06:41', '2016-06-29 09:40:55'),
(2, 'course b', 'course-b', 2, '2016-06-29 09:40:35', '2016-06-29 09:40:35');

-- --------------------------------------------------------

--
-- Table structure for table `course_info`
--

CREATE TABLE IF NOT EXISTS `course_info` (
  `id` int(10) unsigned NOT NULL,
  `course_id` int(10) unsigned NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discussionprompt`
--

CREATE TABLE IF NOT EXISTS `discussionprompt` (
  `id` int(10) unsigned NOT NULL,
  `question` text COLLATE utf8_unicode_ci NOT NULL,
  `subject_id` int(10) unsigned NOT NULL,
  `course_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

CREATE TABLE IF NOT EXISTS `exam_results` (
  `id` int(10) unsigned NOT NULL,
  `student_id` int(10) unsigned NOT NULL,
  `attended` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `exam_results`
--

INSERT INTO `exam_results` (`id`, `student_id`, `attended`, `score`, `created_at`, `updated_at`) VALUES
(9, 1, -1, 0, '2016-06-29 12:32:22', '2016-06-29 12:32:22');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(10) unsigned NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) unsigned NOT NULL,
  `sender` int(10) unsigned NOT NULL,
  `to` int(10) unsigned NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_07_02_230147_migration_cartalyst_sentinel', 1),
('2016_04_14_082830_create_courses_table', 1),
('2016_04_19_053654_create_subjects_table', 1),
('2016_04_21_102228_create_students_table', 1),
('2016_04_21_115347_create_news_table', 1),
('2016_04_23_115019_create_units_table', 6),
('2016_04_25_085825_create_discussionprompt_table', 1),
('2016_04_25_115136_create_quizzes_table', 1),
('2016_04_26_061659_create_messages_table', 1),
('2016_05_02_124352_create_articles_table', 1),
('2016_05_03_120335_create_galleries_table', 1),
('2016_05_03_175808_create_reply_discussions_table', 1),
('2016_05_04_105726_create_courseinfo_table', 1),
('2016_05_06_102642_create_projects_table', 1),
('2016_05_06_120341_create_assignments_table', 1),
('2016_05_06_221459_create_quiz_results_table', 1),
('2016_05_13_151406_add_image_to_students_table', 1),
('2016_06_17_144958_create_test_categories_table', 2),
('2016_06_22_121942_create_test_questions_table', 3),
('2016_06_22_122349_create_set_questions_table', 6),
('2016_06_28_113654_create_exam_results_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `publish` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `course` int(10) unsigned NOT NULL,
  `batch` int(11) NOT NULL,
  `audience` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `persistences`
--

CREATE TABLE IF NOT EXISTS `persistences` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `persistences`
--

INSERT INTO `persistences` (`id`, `user_id`, `code`, `created_at`, `updated_at`) VALUES
(4, 3, 'Dp7hGREP4QuXlgvsmafO90clTAld5CbC', '2016-06-17 11:36:40', '2016-06-17 11:36:40'),
(5, 3, '1PTcibEZYqR9SvkQmqDNcEs7LBxOISuz', '2016-06-17 07:32:24', '2016-06-17 07:32:24'),
(6, 3, 'tq9RnyOef0m0xxBoU12vFQNLviAFilyA', '2016-06-21 04:56:20', '2016-06-21 04:56:20'),
(11, 4, '2Heg1GPo2WnYqkXWRJJaleUhMG65cFMT', '2016-06-22 09:59:52', '2016-06-22 09:59:52'),
(23, 4, 'gHEirNmlF4k37L2OqdfVhbVViruFa2l4', '2016-06-28 08:01:45', '2016-06-28 08:01:45'),
(24, 3, 'Oz1MdhmZfKZ2zr5qnsnUYAZI1vLizNAB', '2016-06-28 10:47:22', '2016-06-28 10:47:22'),
(25, 3, 'QWUPoTCJr5OPuYfotF71XB5fdoPm1uTL', '2016-06-29 03:58:27', '2016-06-29 03:58:27'),
(26, 4, '6DBBWWYYocUlCeFxOFdpJaOX1q4vvp8I', '2016-06-29 07:03:32', '2016-06-29 07:03:32'),
(28, 4, 'fiKnXpil6LNlqgp3izohmJAKP4ER3n82', '2016-06-29 09:25:35', '2016-06-29 09:25:35'),
(29, 4, 'kKAOBh4wJv2bxO1BpzXNTJlRp3x55qv1', '2016-06-29 12:10:49', '2016-06-29 12:10:49'),
(30, 3, 'U7LvoMRygTXqRuRE6b4tSWDm1KgCNFiK', '2016-06-29 12:18:51', '2016-06-29 12:18:51');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(10) unsigned NOT NULL,
  `topic` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `project` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `student_id` int(10) unsigned NOT NULL,
  `course_id` int(10) unsigned NOT NULL,
  `batch` int(10) unsigned NOT NULL,
  `score` int(11) NOT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE IF NOT EXISTS `quizzes` (
  `id` int(10) unsigned NOT NULL,
  `question` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `A` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `B` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `C` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `D` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `answer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

CREATE TABLE IF NOT EXISTS `quiz_results` (
  `id` int(10) unsigned NOT NULL,
  `student_id` int(10) unsigned NOT NULL,
  `subject_id` int(10) unsigned NOT NULL,
  `attended` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE IF NOT EXISTS `reminders` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reply_discussions`
--

CREATE TABLE IF NOT EXISTS `reply_discussions` (
  `id` int(10) unsigned NOT NULL,
  `answer` text COLLATE utf8_unicode_ci NOT NULL,
  `subject_id` int(10) unsigned NOT NULL,
  `student_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `slug`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'Administrator', '{"users.create":true,"users.update":true,"users.view":true,"users.destroy":true,"roles.create":true,"roles.update":true,"roles.view":true,"roles.delete":true}', '2016-06-16 18:55:23', '2016-06-16 18:55:23'),
(4, 'admin', 'Admin', '', '2016-06-16 18:57:23', '2016-06-16 18:57:23'),
(5, 'user', 'User', '', '2016-06-16 18:57:34', '2016-06-16 18:57:34');

-- --------------------------------------------------------

--
-- Table structure for table `role_users`
--

CREATE TABLE IF NOT EXISTS `role_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_users`
--

INSERT INTO `role_users` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2016-06-16 18:55:23', '2016-06-16 18:55:23'),
(3, 4, '2016-06-16 18:58:04', '2016-06-16 18:58:04'),
(4, 5, '2016-06-22 09:54:24', '2016-06-22 09:54:24');

-- --------------------------------------------------------

--
-- Table structure for table `set_questions`
--

CREATE TABLE IF NOT EXISTS `set_questions` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timehr` int(11) NOT NULL,
  `timemin` int(11) NOT NULL,
  `category` text COLLATE utf8_unicode_ci NOT NULL,
  `noquestion` int(11) NOT NULL,
  `mark` int(11) NOT NULL,
  `negativemark` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `set_questions`
--

INSERT INTO `set_questions` (`id`, `title`, `slug`, `timehr`, `timemin`, `category`, `noquestion`, `mark`, `negativemark`, `created_at`, `updated_at`) VALUES
(1, 'netr', 'netr', 3, 34, '2', 12, 5, 0, '2016-06-29 09:13:49', '2016-06-29 09:13:49');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admission` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `course` int(10) unsigned NOT NULL,
  `batch` int(10) unsigned NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `qualification` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `name`, `slug`, `email`, `admission`, `gender`, `course`, `batch`, `dob`, `phone`, `address`, `qualification`, `created_at`, `updated_at`, `image`) VALUES
(1, 4, 'abhirami', 'abhirami', 'abhiramisanthosh63@gmail.com', 'h1o1', 'female', 1, 2014, '2016-06-01', '9072754422', 'address 1\r\naddress 2', 'Quali 1\r\nQuali 23', '2016-06-22 09:54:27', '2016-06-22 09:54:27', '');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `course` int(10) unsigned NOT NULL,
  `semester` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `slug`, `batch`, `file`, `course`, `semester`, `created_at`, `updated_at`) VALUES
(1, 'subject a', 'subject-a', 2014, 'subject-a-1466500034.pdf', 1, 1, '2016-06-21 09:07:14', '2016-06-21 09:07:14');

-- --------------------------------------------------------

--
-- Table structure for table `test_categories`
--

CREATE TABLE IF NOT EXISTS `test_categories` (
  `id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `test_categories`
--

INSERT INTO `test_categories` (`id`, `created_at`, `updated_at`, `name`, `slug`) VALUES
(2, '2016-06-17 11:10:31', '2016-06-17 11:10:31', 'general Knowlege', 'general-knowlege'),
(3, '2016-06-21 10:56:14', '2016-06-21 10:56:14', 'Aptitude', 'aptitude');

-- --------------------------------------------------------

--
-- Table structure for table `test_questions`
--

CREATE TABLE IF NOT EXISTS `test_questions` (
  `id` int(10) unsigned NOT NULL,
  `question` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `A` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `B` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `C` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `D` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `answer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `test_questions`
--

INSERT INTO `test_questions` (`id`, `question`, `A`, `B`, `C`, `D`, `answer`, `slug`, `category`, `created_at`, `updated_at`) VALUES
(1, 'what is a', 'a', 'd', 'gv', 'g', 'C', 'what-is-a', '3', '2016-06-28 04:19:42', '2016-06-28 04:19:42'),
(2, 'sdf', 'c', 'n', 'nyt', 'd', 'D', 'sdf', '3', '2016-06-28 04:20:00', '2016-06-28 04:20:00'),
(3, 'what ishjh', 'd', 'f', 'g', 'b', 'B', 'what-ishjh', '3', '2016-06-28 04:20:21', '2016-06-28 04:20:21'),
(4, 'whzddtg g', 'g', 'go', 'nm', 'm', 'D', 'whzddtg-g', '3', '2016-06-28 04:20:38', '2016-06-28 04:20:38');

-- --------------------------------------------------------

--
-- Table structure for table `throttle`
--

CREATE TABLE IF NOT EXISTS `throttle` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `throttle`
--

INSERT INTO `throttle` (`id`, `user_id`, `type`, `ip`, `created_at`, `updated_at`) VALUES
(1, NULL, 'global', NULL, '2016-06-22 04:04:54', '2016-06-22 04:04:54'),
(2, NULL, 'ip', '::1', '2016-06-22 04:04:54', '2016-06-22 04:04:54'),
(3, NULL, 'global', NULL, '2016-06-28 04:38:31', '2016-06-28 04:38:31'),
(4, NULL, 'ip', '::1', '2016-06-28 04:38:31', '2016-06-28 04:38:31'),
(5, 3, 'user', NULL, '2016-06-28 04:38:32', '2016-06-28 04:38:32');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE IF NOT EXISTS `units` (
  `id` int(10) unsigned NOT NULL,
  `subject_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `video` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `last_login` timestamp NULL DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `permissions`, `last_login`, `first_name`, `last_name`, `created_at`, `updated_at`) VALUES
(1, 'admin@admin.com', '$2y$10$jfmlEzXB5GzMSPEL4Rjm8OAyji9TPTbB8aMN2Cw5BcO.5NyiDznNu', NULL, '2016-06-22 04:05:16', 'Super', 'Admin', '2016-06-16 18:55:23', '2016-06-22 04:05:16'),
(3, 'eladmin@admin.com', '$2y$10$TzMRIT4tEMcDtjgBPkWKk.oKXYbLRHNezsBi4J4vptzt1G3GqPr02', NULL, '2016-06-29 12:18:51', 'EL Admin', '', '2016-06-16 18:58:04', '2016-06-29 12:18:51'),
(4, 'abhiramisanthosh63@gmail.com', '$2y$10$S2tDAVxg1veJ.SfOAQkSWuYl4b6xBw7MiBpgSkd0EHNJfwLKQegp2', NULL, '2016-06-29 12:10:50', 'abhirami', NULL, '2016-06-22 09:54:24', '2016-06-29 12:10:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activations`
--
ALTER TABLE `activations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`), ADD KEY `articles_student_id_foreign` (`student_id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`), ADD KEY `assignments_subject_id_foreign` (`subject_id`), ADD KEY `assignments_student_id_foreign` (`student_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `courses_slug_unique` (`slug`);

--
-- Indexes for table `course_info`
--
ALTER TABLE `course_info`
  ADD PRIMARY KEY (`id`), ADD KEY `course_info_course_id_foreign` (`course_id`);

--
-- Indexes for table `discussionprompt`
--
ALTER TABLE `discussionprompt`
  ADD PRIMARY KEY (`id`), ADD KEY `discussionprompt_subject_id_foreign` (`subject_id`), ADD KEY `discussionprompt_course_id_foreign` (`course_id`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD PRIMARY KEY (`id`), ADD KEY `exam_results_student_id_foreign` (`student_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`), ADD KEY `messages_sender_foreign` (`sender`), ADD KEY `messages_to_foreign` (`to`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `persistences`
--
ALTER TABLE `persistences`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `persistences_code_unique` (`code`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`), ADD KEY `projects_student_id_foreign` (`student_id`), ADD KEY `projects_course_id_foreign` (`course_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`), ADD KEY `quizzes_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`id`), ADD KEY `quiz_results_student_id_foreign` (`student_id`), ADD KEY `quiz_results_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reply_discussions`
--
ALTER TABLE `reply_discussions`
  ADD PRIMARY KEY (`id`), ADD KEY `reply_discussions_subject_id_foreign` (`subject_id`), ADD KEY `reply_discussions_student_id_foreign` (`student_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`user_id`,`role_id`);

--
-- Indexes for table `set_questions`
--
ALTER TABLE `set_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `students_slug_unique` (`slug`), ADD UNIQUE KEY `students_admission_unique` (`admission`), ADD KEY `students_user_id_foreign` (`user_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `subjects_name_batch_course_semester_unique` (`name`,`batch`,`course`,`semester`), ADD UNIQUE KEY `subjects_slug_unique` (`slug`), ADD KEY `subjects_course_foreign` (`course`);

--
-- Indexes for table `test_categories`
--
ALTER TABLE `test_categories`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `test_categories_slug_unique` (`slug`);

--
-- Indexes for table `test_questions`
--
ALTER TABLE `test_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `throttle`
--
ALTER TABLE `throttle`
  ADD PRIMARY KEY (`id`), ADD KEY `throttle_user_id_index` (`user_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `units_slug_unique` (`slug`), ADD KEY `units_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activations`
--
ALTER TABLE `activations`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `course_info`
--
ALTER TABLE `course_info`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `discussionprompt`
--
ALTER TABLE `discussionprompt`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `persistences`
--
ALTER TABLE `persistences`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `reply_discussions`
--
ALTER TABLE `reply_discussions`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `set_questions`
--
ALTER TABLE `set_questions`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `test_categories`
--
ALTER TABLE `test_categories`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `test_questions`
--
ALTER TABLE `test_questions`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `throttle`
--
ALTER TABLE `throttle`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
ADD CONSTRAINT `articles_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
ADD CONSTRAINT `assignments_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `assignments_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_info`
--
ALTER TABLE `course_info`
ADD CONSTRAINT `course_info_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `discussionprompt`
--
ALTER TABLE `discussionprompt`
ADD CONSTRAINT `discussionprompt_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `discussionprompt_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_results`
--
ALTER TABLE `exam_results`
ADD CONSTRAINT `exam_results_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
ADD CONSTRAINT `messages_sender_foreign` FOREIGN KEY (`sender`) REFERENCES `users` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `messages_to_foreign` FOREIGN KEY (`to`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
ADD CONSTRAINT `projects_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `projects_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quizzes`
--
ALTER TABLE `quizzes`
ADD CONSTRAINT `quizzes_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quiz_results`
--
ALTER TABLE `quiz_results`
ADD CONSTRAINT `quiz_results_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `quiz_results_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reply_discussions`
--
ALTER TABLE `reply_discussions`
ADD CONSTRAINT `reply_discussions_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `reply_discussions_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
ADD CONSTRAINT `students_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
ADD CONSTRAINT `subjects_course_foreign` FOREIGN KEY (`course`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `units`
--
ALTER TABLE `units`
ADD CONSTRAINT `units_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
