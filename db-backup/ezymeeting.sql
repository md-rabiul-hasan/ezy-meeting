-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2020 at 06:55 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ezymeeting`
--

-- --------------------------------------------------------

--
-- Table structure for table `agendas`
--

CREATE TABLE `agendas` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `memo_id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `client` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `explanatory_template_id` int(11) NOT NULL,
  `explanatory_description` text CHARACTER SET utf8 NOT NULL,
  `memo_file` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `resolved_template_id` int(11) NOT NULL,
  `resolved_description` text CHARACTER SET utf8 NOT NULL,
  `minute_file` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `agenda_sl` int(11) NOT NULL,
  `agenda_prefix` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0=no result;1=resolved;2=draft',
  `entry_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `agendas`
--

INSERT INTO `agendas` (`id`, `company_id`, `meeting_id`, `title`, `memo_id`, `division_id`, `client`, `amount`, `explanatory_template_id`, `explanatory_description`, `memo_file`, `resolved_template_id`, `resolved_description`, `minute_file`, `agenda_sl`, `agenda_prefix`, `status`, `entry_user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'crikcet agenda 1', 1, 1, 'cl 1', '76555.00', 1, 'Lorem&nbsp;ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for use in a type specimen book.', 'storage/company/1/meeting/1/agenda/agenda-memo-115991586385f51396e4dfff.pdf', 0, '', '', 1, 'agenda pre', 0, 1, '2020-09-03 18:43:58', '2020-09-03 18:43:58'),
(2, 1, 1, 'crikket agenda 2', 2, 2, 'cl 2', '766666.00', 2, 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content.', 'storage/company/1/meeting/1/agenda/agenda-memo-115991586775f5139957b323.pdf', 0, '', '', 2, 'agenda pre', 0, 1, '2020-09-03 18:44:37', '2020-09-03 18:44:37');

-- --------------------------------------------------------

--
-- Table structure for table `agendas_history`
--

CREATE TABLE `agendas_history` (
  `id` int(11) NOT NULL,
  `agenda_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `memo_id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `client` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `explanatory_template_id` int(11) NOT NULL,
  `explanatory_description` text COLLATE utf8_unicode_ci NOT NULL,
  `memo_file` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `resolved_template_id` int(11) NOT NULL,
  `resolved_description` text COLLATE utf8_unicode_ci NOT NULL,
  `minute_file` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `agenda_sl` int(11) NOT NULL,
  `agenda_prefix` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `entry_user_id` int(11) NOT NULL,
  `operation_text` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `operation_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `agendas_history`
--

INSERT INTO `agendas_history` (`id`, `agenda_id`, `company_id`, `meeting_id`, `title`, `memo_id`, `division_id`, `client`, `amount`, `explanatory_template_id`, `explanatory_description`, `memo_file`, `resolved_template_id`, `resolved_description`, `minute_file`, `agenda_sl`, `agenda_prefix`, `entry_user_id`, `operation_text`, `operation_user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'crikcet agenda 1', 1, 1, 'cl 1', '76555.00', 1, 'Lorem&nbsp;ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Ciceros De Finibus Bonorum et Malorum for use in a type specimen book.', 'storage/company/1/meeting/1/agenda/agenda-memo-115991586385f51396e4dfff.pdf', 0, '', '', 1, 'agenda pre', 1, 'Agenda Created', 1, '2020-09-03 18:43:58', '2020-09-03 18:43:58'),
(2, 2, 1, 1, 'crikket agenda 2', 2, 2, 'cl 2', '766666.00', 2, 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content.', 'storage/company/1/meeting/1/agenda/agenda-memo-115991586775f5139957b323.pdf', 0, '', '', 2, 'agenda pre', 1, 'Agenda Created', 1, '2020-09-03 18:44:37', '2020-09-03 18:44:37');

-- --------------------------------------------------------

--
-- Table structure for table `agenda_results`
--

CREATE TABLE `agenda_results` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `agenda_id` int(11) NOT NULL,
  `max_vote_option` int(11) NOT NULL,
  `max_vote` int(11) DEFAULT NULL,
  `is_disicion_change` tinyint(4) NOT NULL DEFAULT 0,
  `change_vote_option` int(11) DEFAULT NULL,
  `decision_change_user_id` int(11) NOT NULL,
  `entry_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `agenda_templates`
--

CREATE TABLE `agenda_templates` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: Explenatory 2:Resolved',
  `description` text CHARACTER SET utf8 NOT NULL,
  `entry_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `agenda_templates`
--

INSERT INTO `agenda_templates` (`id`, `company_id`, `name`, `type`, `description`, `entry_user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'agenda tenplate 1', 1, 'Lorem&nbsp;ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for use in a type specimen book.', 1, '2020-09-03 18:42:18', '2020-09-03 18:42:18'),
(2, 1, 'agenda tenplarte 2', 1, 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content.', 1, '2020-09-03 18:42:44', '2020-09-03 18:42:44');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `is_open` tinyint(1) NOT NULL DEFAULT 0,
  `opening_time` time NOT NULL,
  `closing_time` time NOT NULL,
  `date` date NOT NULL,
  `entry_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `company_id`, `meeting_id`, `is_open`, `opening_time`, `closing_time`, `date`, `entry_user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '12:44:58', '00:00:00', '2020-09-04', 1, '2020-09-03 18:44:58', '2020-09-03 18:44:58');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_members`
--

CREATE TABLE `attendance_members` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `attendance_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_attend` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `attendance_members`
--

INSERT INTO `attendance_members` (`id`, `company_id`, `meeting_id`, `attendance_id`, `user_id`, `is_attend`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 164, 0, '2020-09-03 18:44:58', '2020-09-03 18:44:58'),
(2, 1, 1, 1, 168, 0, '2020-09-03 18:44:58', '2020-09-03 18:44:58'),
(3, 1, 1, 1, 169, 0, '2020-09-03 18:44:58', '2020-09-03 18:44:58'),
(4, 1, 1, 1, 163, 1, '2020-09-04 07:48:32', '2020-09-04 07:48:32');

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `chat_message_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `chat_message` mediumtext COLLATE utf8mb4_bin NOT NULL,
  `is_group_message` int(11) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `chat_message`
--

INSERT INTO `chat_message` (`chat_message_id`, `company_id`, `to_user_id`, `from_user_id`, `chat_message`, `is_group_message`, `timestamp`, `status`) VALUES
(1, 1, 168, 166, 'hi', 0, '2020-09-04 04:54:08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `committees`
--

CREATE TABLE `committees` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `prefix` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `quorum` int(11) NOT NULL,
  `current_index` int(11) NOT NULL,
  `committee_users` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `chairman_id` int(11) NOT NULL,
  `entry_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `committees`
--

INSERT INTO `committees` (`id`, `company_id`, `name`, `description`, `prefix`, `quorum`, `current_index`, `committee_users`, `chairman_id`, `entry_user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'cricket committee', 'desc', 'sh', 2, 3, '164,168,169', 163, 1, '2020-09-03 18:39:08', '2020-09-03 18:39:08');

-- --------------------------------------------------------

--
-- Table structure for table `committees_history`
--

CREATE TABLE `committees_history` (
  `id` int(11) NOT NULL,
  `committee_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `prefix` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `quorum` int(11) NOT NULL,
  `current_index` int(11) NOT NULL,
  `committee_users` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `chairman_id` int(11) NOT NULL,
  `entry_user_id` int(11) NOT NULL,
  `operation_text` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `operation_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `committees_history`
--

INSERT INTO `committees_history` (`id`, `committee_id`, `company_id`, `name`, `description`, `prefix`, `quorum`, `current_index`, `committee_users`, `chairman_id`, `entry_user_id`, `operation_text`, `operation_user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'cricket committee', 'desc', 'sh', 2, 3, '164,168,169', 163, 1, 'Committee Create', 1, '2020-09-03 18:39:08', '2020-09-03 18:39:08');

-- --------------------------------------------------------

--
-- Table structure for table `committee_users`
--

CREATE TABLE `committee_users` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `committee_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_chairman` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `committee_users`
--

INSERT INTO `committee_users` (`id`, `company_id`, `committee_id`, `user_id`, `is_chairman`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 164, 0, '2020-09-03 18:39:08', '2020-09-03 18:39:08'),
(2, 1, 1, 168, 0, '2020-09-03 18:39:08', '2020-09-03 18:39:08'),
(3, 1, 1, 169, 0, '2020-09-03 18:39:08', '2020-09-03 18:39:08'),
(4, 1, 1, 163, 1, '2020-09-03 18:39:08', '2020-09-03 18:39:08');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `name` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registration_no` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `license_no` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `division` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `district` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `zip_code` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `package_id`, `name`, `email`, `phone`, `image`, `registration_no`, `license_no`, `country`, `division`, `district`, `zip_code`, `created_at`, `updated_at`) VALUES
(1, 3, 'venture Solution Ltd', 'venture@nxt.com', '01859443458', '1554611443.PNG', '32412341234', '12341234234', 'Bangladesh', 'Dhaka', 'Dhaka', '3452', '2020-04-28 03:09:34', '2020-04-28 03:09:34'),
(5, 0, 'VSL', 'fahim@venturenxt.com', '', NULL, '', '', '', '', '', '', '2020-05-31 13:23:41', '2020-05-31 06:23:41'),
(6, 0, 'KD IT Solution', 'ezymeeting@gmail.com', '', NULL, '', '', '', '', '', '', '2020-05-31 14:11:03', '2020-05-31 07:11:03'),
(8, 0, 'Fintech', 'tanveer@fintech.com', '', NULL, '', '', '', '', '', '', '2020-06-01 11:16:37', '2020-06-01 04:16:37'),
(10, 0, 'FINTECH', 'test@gmail.com', '', NULL, '', '', '', '', '', '', '2020-06-03 17:38:54', '2020-06-03 10:38:54'),
(11, 0, 'Fintech', 'ovisam88@gmail.com', '', NULL, '', '', '', '', '', '', '2020-06-03 21:23:04', '2020-06-03 14:23:04'),
(12, 0, 'Chand hosiari', 'mrjitumia@yahoo.com', '', NULL, '', '', '', '', '', '', '2020-06-04 05:53:51', '2020-06-03 22:53:51'),
(13, 0, 'Fintech', 'mamun.fintech@gmail.com', '', NULL, '', '', '', '', '', '', '2020-06-05 14:03:22', '2020-06-05 07:03:22'),
(14, 3, 'Tradestone Ltd.', 'khalid@venturenxt.com', '', NULL, '', '', '', '', '', '', '2020-06-06 12:45:07', '2020-06-06 05:45:07'),
(17, 0, 'Tonight Show', 'john@email.com', '', NULL, '', '', '', '', '', '', '2020-06-13 19:49:39', '2020-06-13 12:49:39'),
(19, 0, 'pegasus', 'ghhaidar@yahoo.com', '', NULL, '', '', '', '', '', '', '2020-06-18 18:10:45', '2020-06-18 11:10:45'),
(21, 0, 'royalltd', 'ghfaarhad@yahoo.com', '', NULL, '', '', '', '', '', '', '2020-06-21 15:36:03', '2020-06-21 08:36:03'),
(28, 0, 'sadsadasda', 'asadsddmin@gmail.com', '', NULL, '', '', '', '', '', '', '2020-06-22 11:16:25', '2020-06-22 04:16:25'),
(33, 0, 'sure success ltd.', 'luckytheseven73@gmail.com', '', NULL, '', '', '', '', '', '', '2020-06-28 13:13:16', '2020-06-28 06:13:16'),
(41, 0, 'BRAC Bank Limited', 'bilas.ice@gmail.com', '', NULL, '', '', '', '', '', '', '2020-07-01 13:26:30', '2020-07-01 06:26:30'),
(56, 0, 'VSL LTD', 'hrahman.2k11@gmail.com', '', NULL, '', '', '', '', '', '', '2020-07-05 03:26:05', '2020-07-04 20:26:05'),
(57, 0, 'cname', 'email2@gmail.com', '', NULL, '', '', '', '', '', '', '2020-07-05 13:35:43', '2020-07-05 06:35:43'),
(58, 0, 'cn4', 'email4@gmail.com', '', NULL, '', '', '', '', '', '', '2020-07-05 13:49:57', '2020-07-05 06:49:57'),
(59, 0, 'cn 5', 'email5@gmail.com', '', NULL, '', '', '', '', '', '', '2020-07-05 13:52:01', '2020-07-05 06:52:01'),
(60, 0, 'cn', 'a@gmail.com', '', NULL, '', '', '', '', '', '', '2020-07-05 14:10:02', '2020-07-05 07:10:02'),
(61, 0, 'cnn', 'f@gmail.com', '', NULL, '', '', '', '', '', '', '2020-07-05 15:58:30', '2020-07-05 08:58:30'),
(62, 0, 'digital it', 'it@gmail.com', '', NULL, '', '', '', '', '', '', '2020-07-05 20:28:50', '2020-07-05 13:28:50'),
(63, 0, 'MM & Co', 'mansib@gmail.com', '', NULL, '', '', '', '', '', '', '2020-07-05 23:09:42', '2020-07-05 16:09:42'),
(64, 0, 'ABC', 'razin223@gmail.com', '', NULL, '', '', '', '', '', '', '2020-07-08 17:20:27', '2020-07-08 10:20:27'),
(65, 0, 'info tech', 'hasan@gmail.com', '', NULL, '', '', '', '', '', '', '2020-07-11 12:51:36', '2020-07-11 05:51:36'),
(66, 0, 'mmm', 'monirjss@gmail.com', '', NULL, '', '', '', '', '', '', '2020-07-12 11:58:29', '2020-07-12 04:58:29'),
(67, 0, 'F It', 'hasanfci@gmail.com', '', NULL, '', '', '', '', '', '', '2020-07-12 15:28:40', '2020-07-12 08:28:40'),
(68, 0, 'Fintech', 'niru@gmail.com', '', NULL, '', '', '', '', '', '', '2020-07-19 01:21:16', '2020-07-18 18:21:16'),
(69, 0, 'sowanltd', 'Mranowar@yahoo.com', '', NULL, '', '', '', '', '', '', '2020-07-19 03:01:56', '2020-07-18 20:01:56'),
(70, 0, 'tech view it', 'superadmin@gmail.com', '', NULL, '', '', '', '', '', '', '2020-07-21 13:13:42', '2020-07-21 06:13:42'),
(71, 3, 'GS it', 'halimkhanfeni7@gmail.com', '', NULL, '', '', '', '', '', '', '2020-07-22 13:57:56', '2020-07-22 06:57:56');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `entry_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `company_id`, `name`, `entry_user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'div 1', 1, '2020-09-03 18:39:41', '2020-09-03 18:39:41'),
(2, 1, 'div 2', 1, '2020-09-03 18:39:47', '2020-09-03 18:39:47');

-- --------------------------------------------------------

--
-- Table structure for table `documentation`
--

CREATE TABLE `documentation` (
  `id` int(100) NOT NULL,
  `heading1` varchar(100) NOT NULL,
  `heading2` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `description_title` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `login_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_type` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`login_details_id`, `user_id`, `last_activity`, `is_type`) VALUES
(1, 163, '2020-09-03 18:48:19', 'no'),
(2, 166, '2020-09-03 18:49:51', 'no'),
(3, 1, '2020-09-04 04:28:47', 'no'),
(4, 166, '2020-09-04 04:55:05', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `id` int(11) NOT NULL,
  `meeting_unique_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(11) NOT NULL,
  `committee_id` int(11) NOT NULL,
  `chairman_id` int(11) NOT NULL,
  `member_list` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `meeting_date` date NOT NULL,
  `meeting_time` time NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_open` tinyint(1) NOT NULL DEFAULT 0,
  `entry_user_id` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`id`, `meeting_unique_id`, `company_id`, `committee_id`, `chairman_id`, `member_list`, `title`, `meeting_date`, `meeting_time`, `location`, `is_open`, `entry_user_id`, `create_at`, `updated_at`) VALUES
(1, '11fbc3eaf289f5cd375dffe204202ba5', 1, 1, 163, '164,168,169', 'cricket committee 1st Meeting', '2020-09-10', '06:30:09', 'location comilla', 1, 1, '2020-09-03 18:43:23', '2020-09-03 18:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `meetings_history`
--

CREATE TABLE `meetings_history` (
  `id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `meeting_unique_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(11) NOT NULL,
  `committee_id` int(11) NOT NULL,
  `chairman_id` int(11) NOT NULL,
  `title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `meeting_date` date NOT NULL,
  `meeting_time` time NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_open` tinyint(1) NOT NULL DEFAULT 0,
  `entry_user_id` int(11) NOT NULL,
  `operation_text` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `operation_user_id` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meetings_history`
--

INSERT INTO `meetings_history` (`id`, `meeting_id`, `meeting_unique_id`, `company_id`, `committee_id`, `chairman_id`, `title`, `meeting_date`, `meeting_time`, `location`, `is_open`, `entry_user_id`, `operation_text`, `operation_user_id`, `create_at`, `updated_at`) VALUES
(1, 1, '11fbc3eaf289f5cd375dffe204202ba5', 1, 1, 163, 'cricket committee 1st Meeting', '2020-09-05', '06:30:09', 'location comilla', 0, 1, 'Meeting Create', 1, '2020-09-03 18:43:23', '2020-09-03 18:43:23'),
(2, 1, '11fbc3eaf289f5cd375dffe204202ba5', 1, 1, 163, 'cricket committee 1st Meeting', '2020-09-10', '06:30:09', 'location comilla', 1, 1, 'Meeting Update', 1, '2020-09-04 04:44:25', '2020-09-04 04:44:25');

-- --------------------------------------------------------

--
-- Table structure for table `meeting_activaty_history`
--

CREATE TABLE `meeting_activaty_history` (
  `id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `operation_text` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `operation_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meeting_activaty_history`
--

INSERT INTO `meeting_activaty_history` (`id`, `meeting_id`, `company_id`, `operation_text`, `operation_user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Meeting Published', 1, '2020-09-03 18:44:50', '2020-09-03 18:44:50');

-- --------------------------------------------------------

--
-- Table structure for table `meeting_attendance_activity_history`
--

CREATE TABLE `meeting_attendance_activity_history` (
  `id` int(11) NOT NULL,
  `attendance_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `operations_text` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `operation_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meeting_attendance_activity_history`
--

INSERT INTO `meeting_attendance_activity_history` (`id`, `attendance_id`, `company_id`, `meeting_id`, `operations_text`, `operation_user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Meeting Attendance Active', 1, '2020-09-03 18:44:58', '2020-09-03 18:44:58');

-- --------------------------------------------------------

--
-- Table structure for table `meeting_comments`
--

CREATE TABLE `meeting_comments` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `meeting_notices`
--

CREATE TABLE `meeting_notices` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `notice_file` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `entry_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `memos`
--

CREATE TABLE `memos` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `entry_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `memos`
--

INSERT INTO `memos` (`id`, `company_id`, `name`, `entry_user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'memo 1', 1, '2020-09-03 18:39:56', '2020-09-03 18:39:56'),
(2, 1, 'memo 2', 1, '2020-09-03 18:40:06', '2020-09-03 18:40:06');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_name` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `submenu_parent_id` int(11) NOT NULL,
  `icon` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fa fa-circle-o',
  `role_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `menu_name`, `link`, `status`, `parent_id`, `submenu_parent_id`, `icon`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 'dashboard.php', 1, 0, 0, 'list-icon lnr lnr-home', '1,2,3', NULL, NULL),
(2, 'Users', 'users/all-user.php', 1, 0, 0, 'list-icon lnr lnr-users', '1,2', NULL, NULL),
(3, 'Settings', 'settings', 1, 0, 0, 'feather feather-settings', '1', NULL, NULL),
(4, 'Committee', 'settings/committee/all-committee.php', 2, 3, 3, 'list-icon fa fa-cogs', '1', NULL, NULL),
(5, 'Divisions', 'settings/divisions/all-division.php', 2, 3, 3, 'list-icon fa fa-cogs', '1', NULL, NULL),
(6, 'Memos', 'settings/memos/all-memo.php', 2, 3, 3, 'list-icon fa fa-cogs', '1', NULL, NULL),
(7, 'Settings', 'settings/settings/all-setting.php', 2, 3, 3, 'list-icon fa fa-cogs', '1', NULL, NULL),
(8, 'Agenda Template', 'agenda-template/all-agenda-template.php', 1, 0, 0, 'list-icon lnr lnr-apartment', '1', NULL, NULL),
(9, 'Meetings', 'meeting/all-meeting.php', 1, 0, 0, 'list-icon lnr lnr-select', '1,2', NULL, NULL),
(10, 'Vote Optioin', 'settings/vote-option/all-vote-option.php', 2, 3, 3, 'list-icon fa fa-cogs', '1', NULL, NULL),
(12, 'Chat', 'chat/index.php', 1, 0, 0, 'list-icon lnr lnr-bubble', '1,2,3', NULL, NULL),
(13, 'Notice', 'notice/all-notice.php', 1, 0, 0, 'list-icon lnr lnr-book', '1,2', NULL, NULL),
(14, 'Zoom-Setup', 'settings/zoom/zoom-setup.php', 2, 3, 3, 'list-icon fa fa-cogs', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `minute_pdf_template`
--

CREATE TABLE `minute_pdf_template` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `template_name` varchar(255) NOT NULL,
  `header_style` varchar(255) NOT NULL,
  `content_style` varchar(255) NOT NULL,
  `footer_style` varchar(255) NOT NULL,
  `entry_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `notice_title` varchar(255) NOT NULL,
  `notice_file` varchar(150) DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `committee_id` varchar(100) DEFAULT NULL,
  `to_users` varchar(255) NOT NULL,
  `entry_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `package_info`
--

CREATE TABLE `package_info` (
  `sl` int(11) NOT NULL,
  `package_title` varchar(50) NOT NULL,
  `package_price_bdt` double(8,0) NOT NULL,
  `package_price_usd` double(8,0) NOT NULL,
  `super_admin` int(5) NOT NULL,
  `committee_member` int(5) NOT NULL,
  `number_of_committee` int(5) NOT NULL,
  `subscription_type` int(1) NOT NULL DEFAULT 1 COMMENT '1=monthly;2=yearly',
  `audio_calling` int(1) NOT NULL DEFAULT 0,
  `video_calling` int(1) NOT NULL DEFAULT 0,
  `individual_chat` int(1) NOT NULL DEFAULT 0,
  `multiple_meeting` int(1) NOT NULL DEFAULT 0,
  `storage` varchar(25) NOT NULL,
  `payment_method` varchar(25) NOT NULL DEFAULT 'bKash/Visa/Master',
  `transaction_charge` varchar(25) NOT NULL,
  `display_status` int(1) NOT NULL DEFAULT 1 COMMENT '1=show;0=hide',
  `entry_dt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `package_info`
--

INSERT INTO `package_info` (`sl`, `package_title`, `package_price_bdt`, `package_price_usd`, `super_admin`, `committee_member`, `number_of_committee`, `subscription_type`, `audio_calling`, `video_calling`, `individual_chat`, `multiple_meeting`, `storage`, `payment_method`, `transaction_charge`, `display_status`, `entry_dt`) VALUES
(0, 'Demo', 0, 0, 1, 6, 2, 1, 0, 0, 0, 0, '3GB', 'bKash/Visa/Master', 'Free', 0, '2020-07-04'),
(1, 'Silver package', 860, 10, 2, 12, 2, 1, 0, 0, 0, 0, '3GB', 'bKash/Visa/Master', 'Free', 1, '2020-04-28'),
(2, 'Gold package', 1920, 20, 4, 18, 10, 1, 1, 0, 1, 0, '10GB', 'bKash/Visa/Master', 'Free', 1, '2020-04-28'),
(3, 'Platinum package', 86000, 1000, 10, 50, 25, 2, 1, 1, 1, 1, '1TB', 'bKash/Visa/Master', 'Subscription Based', 1, '2020-04-28');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `agenda_pefix` varchar(150) NOT NULL,
  `meeting_signatory_name` varchar(150) NOT NULL,
  `meeting_signatory_designation` varchar(150) NOT NULL,
  `entry_user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company_id`, `agenda_pefix`, `meeting_signatory_name`, `meeting_signatory_designation`, `entry_user`, `created_at`, `updated_at`) VALUES
(1, 1, 'agenda pre', 'mnsn', 'mnsd', 1, '2020-09-03 18:40:24', '2020-09-03 18:40:24');

-- --------------------------------------------------------

--
-- Table structure for table `setting_history`
--

CREATE TABLE `setting_history` (
  `id` int(11) NOT NULL,
  `setting_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `agenda_pefix` varchar(100) NOT NULL,
  `meeting_signatory_name` varchar(150) NOT NULL,
  `meeting_signatory_designation` varchar(150) NOT NULL,
  `entry_user_id` int(11) NOT NULL,
  `operation_text` varchar(100) NOT NULL,
  `operation_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting_history`
--

INSERT INTO `setting_history` (`id`, `setting_id`, `company_id`, `agenda_pefix`, `meeting_signatory_name`, `meeting_signatory_designation`, `entry_user_id`, `operation_text`, `operation_user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'agenda pre', 'mnsn', 'mnsd', 1, 'Setting Create', 1, '2020-09-03 18:40:24', '2020-09-03 18:40:24');

-- --------------------------------------------------------

--
-- Table structure for table `signed_minute_uploads`
--

CREATE TABLE `signed_minute_uploads` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `signed_minute_file` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `entry_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_id` int(11) NOT NULL COMMENT '1. Super Admin 2. Admin 3. Member',
  `is_active` tinyint(1) NOT NULL,
  `is_logged` int(11) NOT NULL DEFAULT 0,
  `avatar` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `entry_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `company_id`, `name`, `email`, `password`, `phone`, `role_id`, `is_active`, `is_logged`, `avatar`, `entry_user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Super Admin', 'admin@venturenxt.com', '$2y$10$pOlSzyHbryKdiYtzU2JJ8e8Kx/8VjPpTMV7bYBMUuT2NoXXg7eWnG', '01859443458', 1, 1, 0, '', 1, '2020-04-24 05:40:09', '2020-04-24 05:40:09'),
(163, 1, 'Kawsar Uddin', 'kawsar@gmail.com', '$2y$10$pOlSzyHbryKdiYtzU2JJ8e8Kx/8VjPpTMV7bYBMUuT2NoXXg7eWnG', '01776767676', 3, 1, 0, '', 1, '2020-08-04 05:44:15', '2020-08-04 05:44:15'),
(164, 1, 'Nasir Uddin', 'nasir@gmail.com', '$2y$10$pOlSzyHbryKdiYtzU2JJ8e8Kx/8VjPpTMV7bYBMUuT2NoXXg7eWnG', '01831221222', 3, 1, 0, '', 1, '2020-08-04 05:44:52', '2020-08-04 05:44:52'),
(165, 1, 'Md. Rabiul Hasan', 'hasan@gmail.com', '$2y$10$pOlSzyHbryKdiYtzU2JJ8e8Kx/8VjPpTMV7bYBMUuT2NoXXg7eWnG', '01859443458', 2, 1, 0, '', 1, '2020-08-04 05:52:36', '2020-08-04 05:52:36'),
(166, 1, 'Bulbul Ahmed', 'bulbul@gmail.com', '$2y$10$pOlSzyHbryKdiYtzU2JJ8e8Kx/8VjPpTMV7bYBMUuT2NoXXg7eWnG', '01987878787', 3, 1, 1, '', 1, '2020-08-04 05:53:43', '2020-08-04 05:53:43'),
(167, 1, 'Motaleb Hossain', 'munna@gmail.com', '$2y$10$pOlSzyHbryKdiYtzU2JJ8e8Kx/8VjPpTMV7bYBMUuT2NoXXg7eWnG', '01987878787', 2, 1, 0, '', 1, '2020-08-05 04:57:17', '2020-08-05 04:57:17'),
(168, 1, 'halim', 'halim@gmail.com', '$2y$10$pOlSzyHbryKdiYtzU2JJ8e8Kx/8VjPpTMV7bYBMUuT2NoXXg7eWnG', '01723456787', 3, 1, 0, '', 165, '2020-09-03 18:01:50', '2020-09-03 18:01:50'),
(169, 1, 'nijam', 'nijam@gmail.com', '$2y$10$pOlSzyHbryKdiYtzU2JJ8e8Kx/8VjPpTMV7bYBMUuT2NoXXg7eWnG', '01854678765', 3, 1, 0, '', 1, '2020-09-03 18:05:36', '2020-09-03 18:05:36');

-- --------------------------------------------------------

--
-- Table structure for table `user_directors`
--

CREATE TABLE `user_directors` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `director_type` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `starting_date` date NOT NULL,
  `ending_date` date NOT NULL,
  `entry_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_documents`
--

CREATE TABLE `user_documents` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `document_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `document_file` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `entry_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_educations`
--

CREATE TABLE `user_educations` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `institute_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `profession_education` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seminar_training` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entry_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_experiences`
--

CREATE TABLE `user_experiences` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `institute_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `appointment_date` date NOT NULL,
  `designation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `responsibilities` text COLLATE utf8_unicode_ci NOT NULL,
  `entry_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `father_name` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_name` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maritial_status` tinyint(1) DEFAULT 1,
  `designation` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `spouse_name` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `spouse_profession` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `spouse_nationality` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hierarchy` int(11) DEFAULT NULL,
  `is_voter` tinyint(1) NOT NULL DEFAULT 0,
  `nationality` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emergency_contact_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emergency_contact_phone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emergency_contact_fax` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emergency_contact_email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `nid` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tin` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `present_working_institute_name` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `present_working_institue_business` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `present_working_institute_desingnation` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `present_address` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `parmanent_address` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `work_phone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `own_share` float DEFAULT NULL,
  `family_share` float DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `entry_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `company_id`, `user_id`, `father_name`, `mother_name`, `maritial_status`, `designation`, `spouse_name`, `spouse_profession`, `spouse_nationality`, `hierarchy`, `is_voter`, `nationality`, `emergency_contact_name`, `emergency_contact_phone`, `emergency_contact_fax`, `emergency_contact_email`, `date_of_birth`, `nid`, `tin`, `present_working_institute_name`, `present_working_institue_business`, `present_working_institute_desingnation`, `present_address`, `parmanent_address`, `work_phone`, `own_share`, `family_share`, `joining_date`, `entry_user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 168, NULL, NULL, 1, '', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 165, '2020-09-03 18:01:51', '2020-09-03 18:01:51'),
(2, 1, 169, NULL, NULL, 1, '', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-09-03 18:05:36', '2020-09-03 18:05:36');

-- --------------------------------------------------------

--
-- Table structure for table `user_relatives`
--

CREATE TABLE `user_relatives` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `relation_with_user` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `institute_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `entry_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `agenda_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `remarks` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `vote_option_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `company_id`, `meeting_id`, `agenda_id`, `user_id`, `remarks`, `vote_option_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 163, '', 1, '2020-04-09 07:48:43', '2020-09-03 18:48:43');

-- --------------------------------------------------------

--
-- Table structure for table `vote_options`
--

CREATE TABLE `vote_options` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entry_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vote_options`
--

INSERT INTO `vote_options` (`id`, `company_id`, `name`, `color`, `entry_user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'accept 1', '#52f218', 1, '2020-09-03 18:40:59', '2020-09-03 18:40:59'),
(2, 1, 'no comment', '#1bb5d0', 1, '2020-09-03 18:41:13', '2020-09-03 18:41:13'),
(3, 1, 'decline', '#c51616', 1, '2020-09-03 18:41:31', '2020-09-03 18:41:31');

-- --------------------------------------------------------

--
-- Table structure for table `zoom_credential`
--

CREATE TABLE `zoom_credential` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `login_url` varchar(100) NOT NULL DEFAULT 'https://zoom.us/oauth/authorize?response_type=code&client_id=%s&redirect_uri=%s',
  `client_id` varchar(100) NOT NULL,
  `client_secret` varchar(100) NOT NULL,
  `redirect_url` varchar(100) NOT NULL,
  `entry_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zoom_meeting_call`
--

CREATE TABLE `zoom_meeting_call` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `duration` int(11) NOT NULL,
  `zoom_meeting_id` varchar(100) NOT NULL,
  `meeting_link` text NOT NULL,
  `password` varchar(100) NOT NULL,
  `entry_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zoom_meeting_token`
--

CREATE TABLE `zoom_meeting_token` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `token` text NOT NULL,
  `entry_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agendas`
--
ALTER TABLE `agendas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `meeting_id` (`meeting_id`),
  ADD KEY `memo_id` (`memo_id`),
  ADD KEY `division_id` (`division_id`),
  ADD KEY `entry_user_id` (`entry_user_id`);

--
-- Indexes for table `agendas_history`
--
ALTER TABLE `agendas_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agenda_results`
--
ALTER TABLE `agenda_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `meeting_id` (`meeting_id`),
  ADD KEY `agenda_id` (`agenda_id`),
  ADD KEY `max_vote_option` (`max_vote_option`),
  ADD KEY `decision_change_user_id` (`decision_change_user_id`) USING BTREE;

--
-- Indexes for table `agenda_templates`
--
ALTER TABLE `agenda_templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `entry_user_id` (`entry_user_id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `meeting_id` (`meeting_id`),
  ADD KEY `entry_user_id` (`entry_user_id`);

--
-- Indexes for table `attendance_members`
--
ALTER TABLE `attendance_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `meeting_id` (`meeting_id`),
  ADD KEY `attendance_id` (`attendance_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`chat_message_id`);

--
-- Indexes for table `committees`
--
ALTER TABLE `committees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `entry_user_id` (`entry_user_id`),
  ADD KEY `chairman_id` (`chairman_id`);

--
-- Indexes for table `committees_history`
--
ALTER TABLE `committees_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `committee_users`
--
ALTER TABLE `committee_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid` (`email`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `entry_user_id` (`entry_user_id`);

--
-- Indexes for table `documentation`
--
ALTER TABLE `documentation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`login_details_id`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `meeting_unique_id` (`meeting_unique_id`),
  ADD KEY `committee_id` (`committee_id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `entry_user_id` (`entry_user_id`);

--
-- Indexes for table `meetings_history`
--
ALTER TABLE `meetings_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meeting_activaty_history`
--
ALTER TABLE `meeting_activaty_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meeting_attendance_activity_history`
--
ALTER TABLE `meeting_attendance_activity_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meeting_comments`
--
ALTER TABLE `meeting_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meeting_notices`
--
ALTER TABLE `meeting_notices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `meeting_id` (`meeting_id`),
  ADD KEY `entry_user_id` (`entry_user_id`);

--
-- Indexes for table `memos`
--
ALTER TABLE `memos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `entry_user_id` (`entry_user_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `minute_pdf_template`
--
ALTER TABLE `minute_pdf_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_info`
--
ALTER TABLE `package_info`
  ADD PRIMARY KEY (`sl`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `setting_history`
--
ALTER TABLE `setting_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signed_minute_uploads`
--
ALTER TABLE `signed_minute_uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `meeting_id` (`meeting_id`),
  ADD KEY `entry_user_id` (`entry_user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `user_directors`
--
ALTER TABLE `user_directors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `entry_user_id` (`entry_user_id`);

--
-- Indexes for table `user_documents`
--
ALTER TABLE `user_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_educations`
--
ALTER TABLE `user_educations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `entry_user_id` (`entry_user_id`);

--
-- Indexes for table `user_experiences`
--
ALTER TABLE `user_experiences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `entry_user_id` (`entry_user_id`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `entry_user_id` (`entry_user_id`);

--
-- Indexes for table `user_relatives`
--
ALTER TABLE `user_relatives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `entry_user_id` (`entry_user_id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `meeting_id` (`meeting_id`),
  ADD KEY `agenda_id` (`agenda_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `vote_option_id` (`vote_option_id`);

--
-- Indexes for table `vote_options`
--
ALTER TABLE `vote_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `entry_user_id` (`entry_user_id`);

--
-- Indexes for table `zoom_credential`
--
ALTER TABLE `zoom_credential`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zoom_meeting_call`
--
ALTER TABLE `zoom_meeting_call`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zoom_meeting_token`
--
ALTER TABLE `zoom_meeting_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agendas`
--
ALTER TABLE `agendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `agendas_history`
--
ALTER TABLE `agendas_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `agenda_results`
--
ALTER TABLE `agenda_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agenda_templates`
--
ALTER TABLE `agenda_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance_members`
--
ALTER TABLE `attendance_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `committees`
--
ALTER TABLE `committees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `committees_history`
--
ALTER TABLE `committees_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `committee_users`
--
ALTER TABLE `committee_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `documentation`
--
ALTER TABLE `documentation`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `login_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `meetings_history`
--
ALTER TABLE `meetings_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `meeting_activaty_history`
--
ALTER TABLE `meeting_activaty_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `meeting_attendance_activity_history`
--
ALTER TABLE `meeting_attendance_activity_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `meeting_comments`
--
ALTER TABLE `meeting_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meeting_notices`
--
ALTER TABLE `meeting_notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `memos`
--
ALTER TABLE `memos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `minute_pdf_template`
--
ALTER TABLE `minute_pdf_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `package_info`
--
ALTER TABLE `package_info`
  MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setting_history`
--
ALTER TABLE `setting_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `signed_minute_uploads`
--
ALTER TABLE `signed_minute_uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `user_directors`
--
ALTER TABLE `user_directors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_documents`
--
ALTER TABLE `user_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_educations`
--
ALTER TABLE `user_educations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_experiences`
--
ALTER TABLE `user_experiences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_relatives`
--
ALTER TABLE `user_relatives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vote_options`
--
ALTER TABLE `vote_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `zoom_credential`
--
ALTER TABLE `zoom_credential`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zoom_meeting_call`
--
ALTER TABLE `zoom_meeting_call`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zoom_meeting_token`
--
ALTER TABLE `zoom_meeting_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agendas`
--
ALTER TABLE `agendas`
  ADD CONSTRAINT `agendas_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `agendas_ibfk_2` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`id`),
  ADD CONSTRAINT `agendas_ibfk_3` FOREIGN KEY (`memo_id`) REFERENCES `memos` (`id`),
  ADD CONSTRAINT `agendas_ibfk_4` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`);

--
-- Constraints for table `committees`
--
ALTER TABLE `committees`
  ADD CONSTRAINT `committees_ibfk_1` FOREIGN KEY (`chairman_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `meetings`
--
ALTER TABLE `meetings`
  ADD CONSTRAINT `meetings_ibfk_1` FOREIGN KEY (`committee_id`) REFERENCES `committees` (`id`),
  ADD CONSTRAINT `meetings_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `meetings_ibfk_3` FOREIGN KEY (`entry_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `settings_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`);

--
-- Constraints for table `user_directors`
--
ALTER TABLE `user_directors`
  ADD CONSTRAINT `user_directors_ibfk_1` FOREIGN KEY (`entry_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_educations`
--
ALTER TABLE `user_educations`
  ADD CONSTRAINT `user_educations_ibfk_1` FOREIGN KEY (`entry_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_experiences`
--
ALTER TABLE `user_experiences`
  ADD CONSTRAINT `user_experiences_ibfk_1` FOREIGN KEY (`entry_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD CONSTRAINT `user_profiles_ibfk_1` FOREIGN KEY (`entry_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_relatives`
--
ALTER TABLE `user_relatives`
  ADD CONSTRAINT `user_relatives_ibfk_1` FOREIGN KEY (`entry_user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
