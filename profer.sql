-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 16, 2023 at 11:11 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `profer`
--

-- --------------------------------------------------------

--
-- Table structure for table `action_plans`
--

CREATE TABLE `action_plans` (
  `id` bigint(20) NOT NULL,
  `tid` bigint(20) NOT NULL DEFAULT 0,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `proposal_id` bigint(20) DEFAULT NULL,
  `programme_id` bigint(20) DEFAULT NULL,
  `main_assigned_to` varchar(50) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `ins` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `action_plans`
--

INSERT INTO `action_plans` (`id`, `tid`, `status`, `proposal_id`, `programme_id`, `main_assigned_to`, `user_id`, `ins`, `created_at`, `updated_at`) VALUES
(3, 1, 'pending', 1, 3, 'peter owaga', 1, 1, '2023-01-22 18:21:41', '2023-02-12 15:04:28'),
(4, 2, 'pending', 2, 1, 'Amanda Sue', 1, 1, '2023-02-12 10:49:49', '2023-02-12 10:50:58');

-- --------------------------------------------------------

--
-- Table structure for table `action_plan_items`
--

CREATE TABLE `action_plan_items` (
  `id` bigint(20) NOT NULL,
  `action_plan_id` bigint(20) DEFAULT NULL,
  `proposal_item_id` bigint(20) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `resources` varchar(250) DEFAULT NULL,
  `assigned_to` varchar(50) DEFAULT NULL,
  `cohort_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `action_plan_items`
--

INSERT INTO `action_plan_items` (`id`, `action_plan_id`, `proposal_item_id`, `start_date`, `end_date`, `resources`, `assigned_to`, `cohort_id`, `created_at`, `updated_at`) VALUES
(1, 3, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-22 21:21:41', '2023-01-22 21:21:41'),
(2, 3, 2, '2023-01-17', '2023-01-31', 'vehicles', 'Denis', 1, '2023-01-22 21:21:41', '2023-01-22 21:21:41'),
(3, 3, 3, '2023-01-03', '2023-01-26', 'vehicles', 'suzanne', 1, '2023-01-22 21:21:41', '2023-01-22 21:21:41'),
(4, 4, 4, NULL, NULL, NULL, NULL, NULL, '2023-02-12 13:49:49', '2023-02-12 13:49:49'),
(5, 4, 6, '2023-02-01', '2023-02-12', 'Labcoats, Mobile clinics', 'Kevin', 1, '2023-02-12 13:49:49', '2023-02-12 10:50:58');

-- --------------------------------------------------------

--
-- Table structure for table `action_plan_item_regions`
--

CREATE TABLE `action_plan_item_regions` (
  `id` bigint(20) NOT NULL,
  `proposal_item_id` bigint(20) DEFAULT NULL,
  `region_id` bigint(20) DEFAULT NULL,
  `action_plan_item_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `action_plan_item_regions`
--

INSERT INTO `action_plan_item_regions` (`id`, `proposal_item_id`, `region_id`, `action_plan_item_id`, `created_at`, `updated_at`) VALUES
(6, 1, 0, 1, '2023-02-12 13:33:39', '2023-02-12 13:33:39'),
(7, 2, 1, 2, '2023-02-12 13:33:39', '2023-02-12 13:33:39'),
(8, 2, 2, 2, '2023-02-12 13:33:39', '2023-02-12 13:33:39'),
(9, 3, 1, 3, '2023-02-12 13:33:39', '2023-02-12 13:33:39'),
(10, 3, 2, 3, '2023-02-12 13:33:39', '2023-02-12 13:33:39'),
(13, 4, 0, 4, '2023-02-12 13:50:58', '2023-02-12 13:50:58'),
(14, 6, 1, 5, '2023-02-12 13:50:58', '2023-02-12 13:50:58');

-- --------------------------------------------------------

--
-- Table structure for table `age_groups`
--

CREATE TABLE `age_groups` (
  `id` bigint(20) NOT NULL,
  `bracket` varchar(100) DEFAULT NULL,
  `ins` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `age_groups`
--

INSERT INTO `age_groups` (`id`, `bracket`, `ins`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '< 18', 1, 1, '2023-02-01 20:51:19', '2023-02-01 20:51:19'),
(2, '18-35', 1, 1, '2023-02-01 20:51:19', '2023-02-01 20:51:19'),
(3, '36 and above', 1, 1, '2023-02-01 20:52:05', '2023-02-01 20:52:05');

-- --------------------------------------------------------

--
-- Table structure for table `cohorts`
--

CREATE TABLE `cohorts` (
  `id` bigint(20) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `ins` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cohorts`
--

INSERT INTO `cohorts` (`id`, `name`, `user_id`, `ins`, `created_at`, `updated_at`) VALUES
(1, 'Youth', 1, 1, '2023-01-22 14:25:55', '2023-01-22 14:25:55'),
(2, 'Students', 1, 1, '2023-01-22 14:25:55', '2023-01-22 14:25:55'),
(3, 'Teachers', 1, 1, '2023-01-22 14:25:55', '2023-01-22 14:25:55'),
(4, 'Doctors', 1, 1, '2023-01-22 14:25:55', '2023-01-22 14:25:55');

-- --------------------------------------------------------

--
-- Table structure for table `disabilities`
--

CREATE TABLE `disabilities` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  `ins` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `disabilities`
--

INSERT INTO `disabilities` (`id`, `name`, `code`, `ins`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Intellectual Disability', 'ID', 1, 1, '2023-02-01 21:04:38', '2023-02-01 21:04:38'),
(2, 'Speech Disorder', 'SD', 1, 1, '2023-02-01 21:04:38', '2023-02-01 21:04:38'),
(3, 'Vision Impairment', 'VI', 1, 1, '2023-02-01 21:05:10', '2023-02-01 21:05:10'),
(4, 'Hearing Impairment', 'HI', 1, 1, '2023-02-01 21:05:10', '2023-02-01 21:05:10');

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `contact_person` varchar(50) DEFAULT NULL,
  `alternative_email` varchar(20) DEFAULT NULL,
  `alternative_phone` varchar(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `ins` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`id`, `name`, `phone`, `email`, `contact_person`, `alternative_email`, `alternative_phone`, `user_id`, `ins`, `created_at`, `updated_at`) VALUES
(1, 'County Government', '45256352', 'county@email.com', 'John Doe', 'john@account.com', '1234567892', 1, 1, '2023-02-03 13:36:35', '2023-02-11 14:48:06'),
(3, 'WHO', '00200333', 'who@account.com', 'John Doe', 'john@account.com', '12345', 1, 1, '2023-02-12 11:22:51', '2023-02-12 11:22:51');

-- --------------------------------------------------------

--
-- Table structure for table `narratives`
--

CREATE TABLE `narratives` (
  `id` bigint(20) NOT NULL,
  `tid` int(11) NOT NULL DEFAULT 0,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `note` varchar(255) DEFAULT NULL,
  `proposal_id` bigint(20) DEFAULT NULL,
  `proposal_item_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `ins` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `narratives`
--

INSERT INTO `narratives` (`id`, `tid`, `status`, `note`, `proposal_id`, `proposal_item_id`, `user_id`, `ins`, `created_at`, `updated_at`) VALUES
(3, 1, 'pending', 'Sample Narrative Report', 1, 3, 1, 1, '2023-02-05 08:26:40', '2023-02-12 15:21:14');

-- --------------------------------------------------------

--
-- Table structure for table `narrative_items`
--

CREATE TABLE `narrative_items` (
  `id` bigint(20) NOT NULL,
  `narrative_id` bigint(20) DEFAULT NULL,
  `proposal_id` bigint(20) DEFAULT NULL,
  `proposal_item_id` bigint(20) DEFAULT NULL,
  `narrative_pointer_id` bigint(20) DEFAULT NULL,
  `response` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `narrative_items`
--

INSERT INTO `narrative_items` (`id`, `narrative_id`, `proposal_id`, `proposal_item_id`, `narrative_pointer_id`, `response`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 3, 1, 'Activity was inline with the action plan', '2023-02-05 11:26:40', '2023-02-12 14:57:14'),
(2, 3, 1, 3, 2, 'Self employment through talent', '2023-02-05 11:26:40', '2023-02-05 11:26:40'),
(3, 3, 1, 3, 3, '1', '2023-02-05 11:26:40', '2023-02-12 14:57:14'),
(4, 3, 1, 3, 4, 'Proved the efficacy of the activity', '2023-02-05 11:26:40', '2023-02-05 11:26:40'),
(5, 3, 1, 3, 5, 'none', '2023-02-05 11:26:40', '2023-02-12 14:57:14'),
(6, 3, 1, 3, 6, 'significance of naturing talents', '2023-02-05 11:26:40', '2023-02-05 11:26:40'),
(7, 3, 1, 3, 7, 'n/a', '2023-02-05 11:26:40', '2023-02-05 11:26:40'),
(8, 3, 1, 3, 8, 'n/a', '2023-02-05 11:26:40', '2023-02-05 11:26:40'),
(9, 3, 1, 3, 9, 'n/a', '2023-02-05 11:26:40', '2023-02-05 11:26:40'),
(10, 3, 1, 3, 10, 'Self employment', '2023-02-05 11:26:40', '2023-02-12 14:57:14'),
(11, 3, 1, 3, 11, 'n/a', '2023-02-05 11:26:40', '2023-02-05 11:26:40');

-- --------------------------------------------------------

--
-- Table structure for table `narrative_pointers`
--

CREATE TABLE `narrative_pointers` (
  `id` bigint(20) NOT NULL,
  `pointer` varchar(20) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `narrative_pointers`
--

INSERT INTO `narrative_pointers` (`id`, `pointer`, `value`) VALUES
(1, 'pt_a', 'Deviation from original plan'),
(2, 'pt_b', 'Results attained'),
(3, 'pt_c', 'Number of attained results'),
(4, 'pt_d', 'How has number of attained results has affected the activity?'),
(5, 'pt_e', 'Administrative & Logisitical Challenges'),
(6, 'pt_f', 'Lesson from the activity implementation'),
(7, 'pt_g', 'List of publications used in the implementation'),
(8, 'pt_h', 'Future prospects and emerging areas'),
(9, 'pt_i', 'Case Study'),
(10, 'pt_j', 'Activity Lasting Impact'),
(11, 'pt_k', 'Future prospects to continue working on the activity');

-- --------------------------------------------------------

--
-- Table structure for table `participant_lists`
--

CREATE TABLE `participant_lists` (
  `id` bigint(20) NOT NULL,
  `tid` bigint(20) NOT NULL DEFAULT 0,
  `proposal_id` bigint(20) DEFAULT NULL,
  `proposal_item_id` bigint(20) DEFAULT NULL,
  `region_id` bigint(20) DEFAULT NULL,
  `programme_id` bigint(20) DEFAULT NULL,
  `cohort_id` bigint(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `prepared_by` varchar(20) DEFAULT NULL,
  `male_count` int(11) NOT NULL DEFAULT 0,
  `female_count` int(11) NOT NULL DEFAULT 0,
  `total_count` int(11) NOT NULL DEFAULT 0,
  `user_id` bigint(20) DEFAULT NULL,
  `ins` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `participant_lists`
--

INSERT INTO `participant_lists` (`id`, `tid`, `proposal_id`, `proposal_item_id`, `region_id`, `programme_id`, `cohort_id`, `date`, `prepared_by`, `male_count`, `female_count`, `total_count`, `user_id`, `ins`, `created_at`, `updated_at`) VALUES
(3, 1, 2, 6, 1, 1, 1, '2023-02-14', 'Johny Doe', 1, 1, 2, 1, 1, '2023-02-13 18:16:41', '2023-02-13 19:26:58'),
(4, 2, 2, 6, 1, 1, 1, '2023-02-14', 'Sue', 1, 1, 2, 1, 1, '2023-02-14 05:01:44', '2023-02-14 05:01:44'),
(5, 3, 2, 6, 1, 1, 2, '2023-01-18', 'Sue', 1, 1, 2, 1, 1, '2023-02-14 05:06:35', '2023-02-14 05:06:35');

-- --------------------------------------------------------

--
-- Table structure for table `participant_list_items`
--

CREATE TABLE `participant_list_items` (
  `id` bigint(20) NOT NULL,
  `participant_list_id` bigint(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `age_group_id` bigint(20) DEFAULT NULL,
  `disability_id` bigint(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `designation` varchar(20) DEFAULT NULL,
  `organisation` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `participant_list_items`
--

INSERT INTO `participant_list_items` (`id`, `participant_list_id`, `date`, `name`, `gender`, `age_group_id`, `disability_id`, `phone`, `email`, `designation`, `organisation`, `created_at`, `updated_at`) VALUES
(1, 3, '2023-02-14', 'Collins Biwot', 'male', 2, 4, '0712345678', 'collins@gmail.com', 'student', 'UoN', '2023-02-13 21:16:41', '2023-02-13 19:26:58'),
(2, 3, '2023-02-14', 'Stella Mary', 'male', 2, 4, '0798234876', 'stella@gmail.com', 'student', 'JKUAT', '2023-02-13 21:16:41', '2023-02-13 19:27:14'),
(3, 4, '2023-02-14', 'Wendy Archi', 'female', 2, 4, '1234567', 'wendy@account', 'accountant', 'JICA', '2023-02-14 08:01:44', '2023-02-14 08:01:44'),
(4, 4, '2023-02-14', 'Lincoln Njeru', 'male', 2, 4, '1234567', 'njeru@account.com', 'manager', 'Airweb', '2023-02-14 08:01:44', '2023-02-14 08:01:44'),
(5, 5, '2023-01-18', 'Sheila', 'female', 2, 3, '123456', 'sheial@account.com', 'Procurement', 'Lean ventures', '2023-02-14 08:06:35', '2023-02-14 08:06:35'),
(6, 5, '2023-01-18', 'Peter', 'male', 2, 1, '123456', 'peter@account.com', 'Accountant', 'KAI', '2023-02-14 08:06:35', '2023-02-14 08:06:35');

-- --------------------------------------------------------

--
-- Table structure for table `programmes`
--

CREATE TABLE `programmes` (
  `id` bigint(20) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `ins` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `programmes`
--

INSERT INTO `programmes` (`id`, `name`, `user_id`, `ins`, `created_at`, `updated_at`) VALUES
(1, 'Inclusive Health and Medication', 1, 1, '2023-01-22 14:24:21', '2023-02-11 16:56:21'),
(2, 'Inclusive Education', 1, 1, '2023-01-22 14:24:21', '2023-01-22 14:24:21'),
(3, 'Youth Empowerment', 1, 1, '2023-01-22 14:36:39', '2023-01-22 14:36:39');

-- --------------------------------------------------------

--
-- Table structure for table `proposals`
--

CREATE TABLE `proposals` (
  `id` bigint(20) NOT NULL,
  `tid` bigint(20) NOT NULL DEFAULT 0,
  `title` varchar(250) DEFAULT NULL,
  `sector` varchar(50) DEFAULT NULL,
  `donor_id` bigint(20) DEFAULT NULL,
  `region_id` bigint(20) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `budget` decimal(16,4) DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `user_id` bigint(20) DEFAULT NULL,
  `ins` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `proposals`
--

INSERT INTO `proposals` (`id`, `tid`, `title`, `sector`, `donor_id`, `region_id`, `start_date`, `end_date`, `budget`, `status`, `user_id`, `ins`, `created_at`, `updated_at`) VALUES
(1, 1, 'Talent Institution Project', 'Youth', 3, 1, '2023-01-01', '2023-01-31', '100000.0000', 'approved', 1, 1, '2023-01-22 04:28:54', '2023-02-12 11:23:10'),
(2, 2, 'Universal Health Care', 'Health', 1, 1, '2023-02-01', '2023-02-12', '5000000.0000', 'pending', 1, 1, '2023-02-12 04:33:45', '2023-02-12 05:36:59');

-- --------------------------------------------------------

--
-- Table structure for table `proposal_items`
--

CREATE TABLE `proposal_items` (
  `id` bigint(20) NOT NULL,
  `proposal_id` bigint(20) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `is_obj` int(11) NOT NULL DEFAULT 1,
  `row_num` int(11) DEFAULT NULL,
  `row_index` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `proposal_items`
--

INSERT INTO `proposal_items` (`id`, `proposal_id`, `name`, `is_obj`, `row_num`, `row_index`, `created_at`, `updated_at`) VALUES
(1, 1, 'Nature Talent', 1, 1, 0, '2023-01-22 07:28:54', '2023-01-22 07:28:54'),
(2, 1, 'Youth awareness', 0, NULL, 1, '2023-01-22 07:28:54', '2023-01-22 07:28:54'),
(3, 1, 'Promote self employment through talent', 0, NULL, 2, '2023-01-22 07:28:54', '2023-01-22 07:28:54'),
(4, 2, 'Free Access to Hospitals', 1, 1, 0, '2023-02-12 07:33:45', '2023-02-12 07:33:45'),
(6, 2, 'Initiate youth chamas that foster health insurance', 0, NULL, 1, '2023-02-12 05:36:59', '2023-02-12 05:36:59');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `ins` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `user_id`, `ins`, `created_at`, `updated_at`) VALUES
(1, 'Nairobi', 1, 1, '2023-01-22 14:22:32', '2023-01-22 14:22:32'),
(2, 'Nakuru', 1, 1, '2023-01-22 14:22:32', '2023-01-22 14:22:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action_plans`
--
ALTER TABLE `action_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `action_plan_items`
--
ALTER TABLE `action_plan_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `action_plan_id` (`action_plan_id`);

--
-- Indexes for table `action_plan_item_regions`
--
ALTER TABLE `action_plan_item_regions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `action_plan_item_id` (`action_plan_item_id`);

--
-- Indexes for table `age_groups`
--
ALTER TABLE `age_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cohorts`
--
ALTER TABLE `cohorts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disabilities`
--
ALTER TABLE `disabilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `narratives`
--
ALTER TABLE `narratives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `narrative_items`
--
ALTER TABLE `narrative_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `narrative_pointers`
--
ALTER TABLE `narrative_pointers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participant_lists`
--
ALTER TABLE `participant_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participant_list_items`
--
ALTER TABLE `participant_list_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participant_list_id` (`participant_list_id`);

--
-- Indexes for table `programmes`
--
ALTER TABLE `programmes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proposals`
--
ALTER TABLE `proposals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proposal_items`
--
ALTER TABLE `proposal_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proposal_id` (`proposal_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action_plans`
--
ALTER TABLE `action_plans`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `action_plan_items`
--
ALTER TABLE `action_plan_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `action_plan_item_regions`
--
ALTER TABLE `action_plan_item_regions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `age_groups`
--
ALTER TABLE `age_groups`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cohorts`
--
ALTER TABLE `cohorts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `disabilities`
--
ALTER TABLE `disabilities`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `narratives`
--
ALTER TABLE `narratives`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `narrative_items`
--
ALTER TABLE `narrative_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `narrative_pointers`
--
ALTER TABLE `narrative_pointers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `participant_lists`
--
ALTER TABLE `participant_lists`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `participant_list_items`
--
ALTER TABLE `participant_list_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `programmes`
--
ALTER TABLE `programmes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `proposals`
--
ALTER TABLE `proposals`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `proposal_items`
--
ALTER TABLE `proposal_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `action_plan_items`
--
ALTER TABLE `action_plan_items`
  ADD CONSTRAINT `action_plan_items_ibfk_1` FOREIGN KEY (`action_plan_id`) REFERENCES `action_plans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `action_plan_item_regions`
--
ALTER TABLE `action_plan_item_regions`
  ADD CONSTRAINT `action_plan_item_regions_ibfk_1` FOREIGN KEY (`action_plan_item_id`) REFERENCES `action_plan_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `participant_list_items`
--
ALTER TABLE `participant_list_items`
  ADD CONSTRAINT `participant_list_items_ibfk_1` FOREIGN KEY (`participant_list_id`) REFERENCES `participant_lists` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `proposal_items`
--
ALTER TABLE `proposal_items`
  ADD CONSTRAINT `proposal_items_ibfk_1` FOREIGN KEY (`proposal_id`) REFERENCES `proposals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `proposal_items_ibfk_2` FOREIGN KEY (`proposal_id`) REFERENCES `proposals` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
