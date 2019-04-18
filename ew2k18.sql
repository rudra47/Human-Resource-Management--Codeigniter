-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2019 at 06:37 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ew2k18`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(30) NOT NULL,
  `cat_alias` varchar(30) NOT NULL,
  `cat_division` varchar(50) NOT NULL,
  `cat_parent` varchar(4) NOT NULL DEFAULT 'root',
  `cat_description` tinytext NOT NULL,
  `cat_status` varchar(8) NOT NULL,
  `cat_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_title`, `cat_alias`, `cat_division`, `cat_parent`, `cat_description`, `cat_status`, `cat_date`) VALUES
(1, 'Blog', 'blog', 'Business & Economics', 'root', 'Blog', 'active', '2014-11-22 18:00:00'),
(2, 'Menu', 'menu', 'Business & Economics', 'root', 'Blog', 'active', '2014-11-22 18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `collection`
--

CREATE TABLE `collection` (
  `id` int(11) NOT NULL,
  `emp_user_id` varchar(10) NOT NULL,
  `start_time` time NOT NULL,
  `lunch_start_time` time NOT NULL,
  `lunch_end_time` time NOT NULL,
  `end_time` time NOT NULL,
  `insert_time` date NOT NULL,
  `insert_ip_address` varchar(100) NOT NULL,
  `update_ip_address` varchar(100) NOT NULL,
  `update_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `collection`
--

INSERT INTO `collection` (`id`, `emp_user_id`, `start_time`, `lunch_start_time`, `lunch_end_time`, `end_time`, `insert_time`, `insert_ip_address`, `update_ip_address`, `update_time`) VALUES
(1, 'EM-x9py', '14:23:03', '14:24:25', '14:24:31', '14:24:38', '2018-11-12', '', '0', '2018-11-13 14:24:38'),
(2, 'EM-j6NQ', '09:55:23', '13:40:28', '14:30:34', '18:27:38', '2018-11-13', '', '0', '2018-11-13 14:30:38'),
(3, 'EM-UhQX', '14:31:26', '14:31:30', '14:31:34', '14:31:39', '2018-11-13', '', '0', '2018-11-13 14:31:39'),
(4, 'EM-VwfF', '14:32:06', '14:32:12', '14:32:16', '14:32:28', '2018-11-13', '', '0', '2018-11-13 14:32:28'),
(5, 'EM-GNqu', '14:32:44', '14:32:52', '14:32:57', '14:33:04', '2018-11-13', '', '0', '2018-11-13 14:33:04'),
(6, 'EM-3daj', '14:33:52', '14:33:58', '14:34:02', '14:34:06', '2018-11-13', '', '0', '2018-11-13 14:34:06'),
(7, 'EM-Oifx', '14:34:43', '14:34:47', '14:34:51', '14:34:55', '2018-11-13', '', '0', '2018-11-13 14:34:55'),
(8, 'EM-0e1B', '09:50:44', '15:00:47', '16:10:52', '18:48:58', '2018-11-11', '', '0', '2018-11-11 14:35:58'),
(9, 'EM-0e1B', '10:16:24', '14:50:00', '15:55:00', '19:31:00', '2018-11-12', '', '0', '2018-11-12 00:00:00'),
(10, 'EM-0e1B', '10:00:00', '15:04:32', '16:35:22', '00:00:00', '2018-11-13', '', '0', '2018-11-13 16:35:22'),
(15, 'EM-3daj', '10:09:25', '00:00:00', '00:00:00', '00:00:00', '2018-11-15', '', '0', '0000-00-00 00:00:00'),
(16, 'EM-Oifx', '10:10:31', '00:00:00', '00:00:00', '00:00:00', '2018-11-15', '', '0', '0000-00-00 00:00:00'),
(17, 'EM-j6NQ', '10:13:36', '12:57:39', '14:28:42', '00:00:00', '2018-11-15', '', '0', '2018-11-15 14:36:42'),
(18, 'EM-GNqu', '10:28:29', '13:01:30', '00:00:00', '00:00:00', '2018-11-16', '', '0', '2018-11-15 13:25:30'),
(19, 'EM-ocx0', '10:34:15', '14:40:05', '15:45:18', '18:48:00', '2018-11-12', '', '0', '2018-11-15 15:45:18'),
(20, 'EM-UhQX', '11:06:31', '13:14:04', '14:09:30', '00:00:00', '2018-11-15', '', '0', '2018-11-15 14:09:30'),
(21, 'EM-ocx0', '10:15:16', '15:06:00', '16:16:00', '18:39:00', '2018-11-11', '', '0', '0000-00-00 00:00:00'),
(22, 'EM-ocx0', '09:48:51', '14:41:00', '15:44:00', '19:38:00', '2018-11-15', '', '0', '0000-00-00 00:00:00'),
(23, 'EM-ocx0', '10:08:34', '14:57:00', '15:59:00', '18:45:00', '2018-11-10', '', '0', '0000-00-00 00:00:00'),
(52, 'EM-ocx0', '10:02:07', '14:11:51', '15:28:14', '18:52:35', '2018-11-17', '', '0', '2018-11-17 17:19:35'),
(72, 'EM-Oifx', '18:04:44', '00:00:00', '00:00:00', '18:04:48', '2018-11-19', '', '0', '2018-11-19 18:04:48'),
(73, 'EM-j6NQ', '10:54:58', '00:00:00', '00:00:00', '00:00:00', '2018-11-20', '', '0', '0000-00-00 00:00:00'),
(74, 'EM-UhQX', '10:55:07', '00:00:00', '00:00:00', '00:00:00', '2018-11-20', '', '0', '0000-00-00 00:00:00'),
(75, 'EM-GNqu', '10:55:18', '00:00:00', '00:00:00', '00:00:00', '2018-11-20', '', '0', '0000-00-00 00:00:00'),
(76, 'EM-3daj', '10:55:25', '00:00:00', '00:00:00', '00:00:00', '2018-11-20', '', '0', '0000-00-00 00:00:00'),
(77, 'EM-Oifx', '10:55:43', '00:00:00', '00:00:00', '00:00:00', '2018-11-20', '', '0', '0000-00-00 00:00:00'),
(78, 'EM-ocx0', '10:55:48', '14:20:12', '15:28:00', '17:29:00', '2018-11-20', '', '0', '0000-00-00 00:00:00'),
(79, 'EM-ocx0', '09:49:51', '14:06:00', '15:25:00', '18:49:00', '2018-11-21', '', '0', '0000-00-00 00:00:00'),
(80, 'EM-ocx0', '10:10:21', '13:21:00', '14:17:00', '18:46:00', '2018-11-22', '', '0', '0000-00-00 00:00:00'),
(81, 'EM-Oifx', '10:35:29', '00:00:00', '00:00:00', '00:00:00', '2018-11-22', '', '0', '0000-00-00 00:00:00'),
(82, 'EM-3daj', '10:35:34', '00:00:00', '00:00:00', '00:00:00', '2018-11-22', '', '0', '0000-00-00 00:00:00'),
(83, 'EM-GNqu', '10:35:38', '00:00:00', '00:00:00', '00:00:00', '2018-11-22', '', '0', '0000-00-00 00:00:00'),
(84, 'EM-VwfF', '10:35:44', '00:00:00', '00:00:00', '00:00:00', '2018-11-22', '', '0', '0000-00-00 00:00:00'),
(85, 'EM-UhQX', '10:35:52', '00:00:00', '00:00:00', '00:00:00', '2018-11-22', '', '0', '0000-00-00 00:00:00'),
(86, 'EM-j6NQ', '10:35:56', '00:00:00', '00:00:00', '00:00:00', '2018-11-22', '', '0', '0000-00-00 00:00:00'),
(87, 'EM-x9py', '10:36:00', '00:00:00', '00:00:00', '00:00:00', '2018-11-22', '', '0', '0000-00-00 00:00:00'),
(88, 'EM-ocx0', '11:50:10', '00:00:00', '00:00:00', '00:00:00', '2018-11-24', '', '0', '0000-00-00 00:00:00'),
(89, 'EM-Oifx', '11:53:09', '00:00:00', '00:00:00', '00:00:00', '2018-11-24', '', '0', '0000-00-00 00:00:00'),
(90, 'EM-ocx0', '12:58:43', '00:00:00', '00:00:00', '00:00:00', '2018-11-25', '', '0', '0000-00-00 00:00:00'),
(91, 'EM-j6NQ', '13:29:24', '00:00:00', '00:00:00', '00:00:00', '2018-11-25', '', '0', '0000-00-00 00:00:00'),
(92, 'EM-UhQX', '13:29:32', '00:00:00', '00:00:00', '00:00:00', '2018-11-25', '', '0', '0000-00-00 00:00:00'),
(93, 'EM-3daj', '13:29:37', '00:00:00', '00:00:00', '00:00:00', '2018-11-25', '', '0', '0000-00-00 00:00:00'),
(94, 'EM-j6NQ', '11:05:56', '00:00:00', '00:00:00', '00:00:00', '2018-11-26', '', '0', '0000-00-00 00:00:00'),
(95, 'EM-3daj', '11:06:06', '00:00:00', '00:00:00', '00:00:00', '2018-11-26', '', '0', '0000-00-00 00:00:00'),
(96, 'EM-Oifx', '11:06:15', '00:00:00', '00:00:00', '00:00:00', '2018-11-26', '', '0', '0000-00-00 00:00:00'),
(97, 'EM-ocx0', '11:06:20', '00:00:00', '00:00:00', '00:00:00', '2018-11-26', '', '0', '0000-00-00 00:00:00'),
(98, 'EM-j6NQ', '15:48:13', '00:00:00', '00:00:00', '00:00:00', '2018-11-27', '', '0', '0000-00-00 00:00:00'),
(99, 'EM-ocx0', '15:48:25', '00:00:00', '00:00:00', '00:00:00', '2018-11-27', '', '0', '0000-00-00 00:00:00'),
(100, 'EM-UhQX', '15:48:32', '00:00:00', '00:00:00', '00:00:00', '2018-11-27', '', '0', '0000-00-00 00:00:00'),
(101, 'EM-x9py', '16:56:59', '00:00:00', '00:00:00', '00:00:00', '2018-11-27', '', '0', '0000-00-00 00:00:00'),
(102, 'EM-ocx0', '10:38:58', '13:16:00', '14:58:00', '18:06:00', '2018-11-29', '', '0', '0000-00-00 00:00:00'),
(103, 'EM-ocx0', '12:17:33', '00:00:00', '00:00:00', '00:00:00', '2018-12-01', '', '0', '0000-00-00 00:00:00'),
(104, 'EM-ocx0', '11:03:01', '14:04:00', '15:52:00', '18:53:00', '2018-12-02', '', '0', '0000-00-00 00:00:00'),
(105, 'EM-UhQX', '10:04:25', '13:16:00', '14:12:00', '18:52:00', '2018-12-02', '', '0', '0000-00-00 00:00:00'),
(106, 'EM-ocx0', '11:23:54', '16:42:12', '00:00:00', '16:45:01', '2018-12-03', '', '0', '2018-12-03 16:45:01'),
(107, 'EM-ocx0', '10:52:22', '00:00:00', '00:00:00', '00:00:00', '2018-12-04', '', '0', '0000-00-00 00:00:00'),
(108, 'EM-UhQX', '10:52:29', '00:00:00', '00:00:00', '00:00:00', '2018-12-04', '', '0', '0000-00-00 00:00:00'),
(109, 'EM-3daj', '10:52:34', '00:00:00', '00:00:00', '00:00:00', '2018-12-04', '', '0', '0000-00-00 00:00:00'),
(111, 'EM-j6NQ', '10:51:06', '00:00:00', '00:00:00', '00:00:00', '2018-12-05', '', '0', '0000-00-00 00:00:00'),
(112, 'EM-Oifx', '10:51:14', '00:00:00', '00:00:00', '00:00:00', '2018-12-05', '', '0', '0000-00-00 00:00:00'),
(113, 'EM-VwfF', '10:51:22', '00:00:00', '00:00:00', '00:00:00', '2018-12-05', '', '0', '0000-00-00 00:00:00'),
(140, 'EM-ocx0', '14:17:24', '14:22:41', '14:22:46', '00:00:00', '2018-12-06', '', '0', '2018-12-06 14:22:46'),
(141, 'EM-ocx0', '16:54:53', '00:00:00', '00:00:00', '00:00:00', '2018-12-08', '', '0', '0000-00-00 00:00:00'),
(142, 'EM-ocx0', '11:37:39', '00:00:00', '00:00:00', '00:00:00', '2018-12-20', '', '0', '0000-00-00 00:00:00'),
(143, 'EM-ocx0', '12:22:00', '00:00:00', '00:00:00', '00:00:00', '2019-01-02', '', '0', '0000-00-00 00:00:00'),
(144, 'EM-ocx0', '13:31:17', '13:34:32', '14:06:46', '00:00:00', '2019-01-03', '::1', '::1', '2019-01-03 14:06:46'),
(145, 'EM-ocx0', '10:57:16', '00:00:00', '00:00:00', '00:00:00', '2019-02-03', '::1', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `designation_id` int(11) NOT NULL,
  `designation_name` varchar(50) NOT NULL,
  `added_by` varchar(50) NOT NULL,
  `edited_by` varchar(50) DEFAULT NULL,
  `designation_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`designation_id`, `designation_name`, `added_by`, `edited_by`, `designation_status`) VALUES
(1, 'Web Developer', '0', '0', 1),
(2, 'Content Writer', '0', 'Rudra', 1),
(3, 'Graphics Designer  ', 'Rudra', NULL, 1),
(4, 'Accountant ', 'Rudra', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `employee_name` varchar(150) NOT NULL,
  `employee_phone` varchar(30) NOT NULL,
  `employee_email` varchar(150) DEFAULT NULL,
  `user_id` varchar(10) NOT NULL,
  `employee_password` varchar(150) NOT NULL,
  `employee_image` varchar(255) NOT NULL,
  `employee_designation` int(11) DEFAULT NULL,
  `employee_salary` int(11) DEFAULT NULL,
  `employee_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `employee_name`, `employee_phone`, `employee_email`, `user_id`, `employee_password`, `employee_image`, `employee_designation`, `employee_salary`, `employee_status`) VALUES
(1, 'Md. Dipto', '017', 'dipto@tos.com.bd', 'EM-x9py', 'e10adc3949ba59abbe56e057f20f883e', 'dipto.jpg', 3, 8000, 1),
(2, 'HR Habib', '01977721867', 'habib@tos.com.bd', 'EM-j6NQ', 'e10adc3949ba59abbe56e057f20f883e', 'habib-4204.jpg', 2, 8000, 1),
(3, 'Sayemur Rahman Rafi', '01712', 'rafi@tos.com.bd', 'EM-UhQX', 'e10adc3949ba59abbe56e057f20f883e', 'rafi.jpg', 2, 8000, 1),
(4, 'Mahbub Amin', '017123', 'mahbub@tos.com.bd', 'EM-VwfF', 'e10adc3949ba59abbe56e057f20f883e', 'mahbub.jpg', 2, 15000, 1),
(6, 'Md. Arafat', '01712345', 'arafat@tos.com.bd', 'EM-3daj', 'e10adc3949ba59abbe56e057f20f883e', 'male.jpg', 4, 18000, 1),
(7, 'Md. Asadur Zaman', '+8801741640233', 'asadur.diu33@gmail.com', 'EM-Oifx', 'e10adc3949ba59abbe56e057f20f883e', 'asad.jpg', 1, 5000, 1),
(11, 'Rudra Sen', '+8801738201055', 'rudra1055@gmail.com', 'EM-ocx0', 'f0a7766c9d882b2737c8d8892a70560e', 'img-lrBGNwTE.jpg', 1, 5000, 1),
(12, 'ABC', '11111111111111111111111', 'abc@gmail.com', 'EM-scEV', 'e10adc3949ba59abbe56e057f20f883e', 'img-NGUejYo8.jpg', 1, 2200, 1);

-- --------------------------------------------------------

--
-- Table structure for table `leave_application`
--

CREATE TABLE `leave_application` (
  `app_id` int(11) NOT NULL,
  `app_type` varchar(30) NOT NULL,
  `app_date` date NOT NULL,
  `app_start_date` date NOT NULL,
  `app_end_date` date NOT NULL,
  `total_day` int(11) NOT NULL,
  `app_reason` text NOT NULL,
  `employee_id` int(11) NOT NULL,
  `insert_time` datetime NOT NULL,
  `leave_type` varchar(30) DEFAULT NULL,
  `paid_amount` varchar(20) DEFAULT NULL,
  `confirmation` int(11) NOT NULL,
  `update_time` datetime NOT NULL,
  `app_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_application`
--

INSERT INTO `leave_application` (`app_id`, `app_type`, `app_date`, `app_start_date`, `app_end_date`, `total_day`, `app_reason`, `employee_id`, `insert_time`, `leave_type`, `paid_amount`, `confirmation`, `update_time`, `app_status`) VALUES
(1, 'advance', '2018-11-26', '2018-11-27', '2018-11-29', 3, 'I am feeling pain in my back today', 11, '2018-11-26 12:11:04', 'paid', '.75', 2, '2018-12-01 07:12:10', 2),
(2, 'advance', '2018-11-26', '2018-11-27', '2018-11-28', 2, 'Because of my Cough.', 11, '2018-11-27 11:11:00', 'paid', '.25', 0, '2018-12-01 07:12:27', 0),
(3, 'advance', '2018-11-26', '2018-11-27', '2018-11-29', 3, 'Back Pain', 11, '2018-11-27 11:11:16', 'paid', '.50', 1, '2018-11-29 12:11:53', 1),
(4, 'adsence', '2018-12-01', '2018-11-29', '2018-11-30', 2, 'I was sick ', 11, '2018-12-01 07:12:57', 'paid', '.75', 1, '2018-12-01 07:12:46', 1),
(5, 'advance', '2018-12-01', '2018-12-03', '2018-12-05', 3, 'I am feeling pain in my head. ', 11, '2018-12-01 13:12:47', 'unpaid', '', 1, '2018-12-04 06:12:04', 1),
(6, 'advance', '2018-12-01', '2018-12-05', '2018-12-15', 10, 'I have an exam. ', 7, '2018-12-01 13:12:15', 'paid', '.25', 1, '2018-12-01 13:12:21', 1),
(7, 'adsence', '2018-11-26', '2018-11-27', '2018-11-30', 4, 'I was sick. ', 7, '2018-12-01 13:12:55', NULL, NULL, 0, '0000-00-00 00:00:00', 0),
(8, 'adsence', '2018-12-01', '2018-12-03', '2018-12-05', 3, 'I am going to Khagrachori', 11, '2018-12-04 06:12:35', 'paid', '.25', 1, '2018-12-04 06:12:48', 1),
(9, 'advance', '2018-12-04', '2018-12-05', '2018-12-07', 3, 'I want to go to home ', 11, '2018-12-04 07:12:50', NULL, NULL, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `office_holiday`
--

CREATE TABLE `office_holiday` (
  `holiday_id` int(11) NOT NULL,
  `holiday_description` varchar(255) NOT NULL,
  `holiday_date` date NOT NULL,
  `until_holiday_date` date DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `insert_date` date NOT NULL,
  `holiday_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `office_holiday`
--

INSERT INTO `office_holiday` (`holiday_id`, `holiday_description`, `holiday_date`, `until_holiday_date`, `admin_id`, `insert_date`, `holiday_status`) VALUES
(1, 'Eid', '2018-11-23', '2018-11-25', NULL, '0000-00-00', 1),
(2, 'Puja', '2018-11-25', NULL, NULL, '2018-11-22', 1),
(9, 'Eid', '2019-01-08', '2019-01-10', 1, '2019-01-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `part_time_attendance`
--

CREATE TABLE `part_time_attendance` (
  `attendance_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `emp_user_id` varchar(10) NOT NULL,
  `part_time_signout` time NOT NULL,
  `part_time_signin` time NOT NULL,
  `insert_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `part_time_attendance`
--

INSERT INTO `part_time_attendance` (`attendance_id`, `employee_id`, `emp_user_id`, `part_time_signout`, `part_time_signin`, `insert_date`) VALUES
(1, 11, 'EM-ocx0', '13:42:26', '14:24:50', '2018-12-06'),
(2, 7, 'EM-Oifx', '13:42:36', '13:42:38', '2018-12-06'),
(3, 11, 'EM-ocx0', '14:17:51', '14:24:50', '2018-12-06'),
(4, 11, 'EM-ocx0', '14:18:52', '14:24:50', '2018-12-06'),
(5, 11, 'EM-ocx0', '14:19:16', '14:24:50', '2018-12-06'),
(6, 11, 'EM-ocx0', '14:22:29', '14:24:50', '2018-12-06'),
(7, 11, 'EM-ocx0', '14:24:48', '14:24:50', '2018-12-06'),
(8, 11, 'EM-ocx0', '12:22:05', '00:00:00', '2019-01-02'),
(9, 11, 'EM-ocx0', '14:10:13', '14:10:17', '2019-01-03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account`
--

CREATE TABLE `tbl_account` (
  `ac_id` int(11) NOT NULL,
  `ac_c_id` int(11) NOT NULL,
  `ac_balance` float NOT NULL DEFAULT '0',
  `ac_due` float NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_account`
--

INSERT INTO `tbl_account` (`ac_id`, `ac_c_id`, `ac_balance`, `ac_due`) VALUES
(102, 1, 0, 0),
(103, 2, 0, 30);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ac_accounts`
--

CREATE TABLE `tbl_ac_accounts` (
  `aca_id` int(11) NOT NULL,
  `aca_title` varchar(255) NOT NULL,
  `aca_grp_id` int(11) NOT NULL,
  `aca_balance` float NOT NULL,
  `aca_type` varchar(2) NOT NULL,
  `aca_bank_cash` tinyint(1) DEFAULT NULL,
  `aca_reconciliation` tinyint(1) DEFAULT NULL,
  `aca_note` text,
  `aca_date` datetime NOT NULL,
  `aca_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_ac_accounts`
--

INSERT INTO `tbl_ac_accounts` (`aca_id`, `aca_title`, `aca_grp_id`, `aca_balance`, `aca_type`, `aca_bank_cash`, `aca_reconciliation`, `aca_note`, `aca_date`, `aca_status`) VALUES
(1, 'Mohammad Jabed', 2, 15000, 'dr', NULL, NULL, '', '2018-12-12 00:00:00', 0),
(2, 'Mohammad ', 2, 12000, 'cr', NULL, 0, 'aaaaa', '2018-12-12 00:00:00', 0),
(3, 'ABC', 3, 12000, 'dr', 0, 0, 'iiiii', '2018-12-12 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ac_entry`
--

CREATE TABLE `tbl_ac_entry` (
  `en_id` int(11) NOT NULL,
  `en_num` int(11) NOT NULL,
  `en_date` date NOT NULL,
  `en_description` text NOT NULL,
  `en_dr_cr` varchar(15) NOT NULL,
  `en_aca_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_ac_entry`
--

INSERT INTO `tbl_ac_entry` (`en_id`, `en_num`, `en_date`, `en_description`, `en_dr_cr`, `en_aca_id`) VALUES
(1, 111112, '2018-12-12', 'hello', 'br', 1),
(2, 123456, '2018-12-13', 'Hi', 'br', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ac_group`
--

CREATE TABLE `tbl_ac_group` (
  `grp_id` int(11) NOT NULL,
  `grp_title` varchar(255) NOT NULL,
  `grp_parent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ac_group`
--

INSERT INTO `tbl_ac_group` (`grp_id`, `grp_title`, `grp_parent`) VALUES
(2, 'Blog', 2),
(3, 'Groups', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_document`
--

CREATE TABLE `tbl_document` (
  `doc_id` int(11) NOT NULL,
  `doc_company` varchar(100) NOT NULL,
  `doc_project_name` varchar(255) NOT NULL,
  `doc_year` int(11) NOT NULL,
  `doc_month` varchar(20) NOT NULL,
  `doc_type` varchar(10) NOT NULL,
  `doc_filename` int(11) NOT NULL,
  `doc_body` text NOT NULL,
  `doc_file` varchar(255) NOT NULL,
  `doc_status` varchar(15) NOT NULL,
  `insert_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_document`
--

INSERT INTO `tbl_document` (`doc_id`, `doc_company`, `doc_project_name`, `doc_year`, `doc_month`, `doc_type`, `doc_filename`, `doc_body`, `doc_file`, `doc_status`, `insert_date`) VALUES
(1, 'TOS', 'Human Resource management', 2018, 'December', 'In', 1001, '<p>&nbsp;</p>\r\n\r\n<p>To</p>\r\n\r\n<p>The Principle</p>\r\n\r\n<p>Subject: Annual leave application</p>\r\n\r\n<p>Dear Mr./Mrs. {Recipient&rsquo;s Name},</p>\r\n\r\n<p>I am writing this letter to let you know that I am in need of a long-term leave. Thus, I would like to avail my full annual leave allotment as I have my complete yearly leave allowance.</p>\r\n\r\n<p>I request you to consider my leave application of thirty days as I am planning for an international vacation with my family. I would like to avail the leaves from {start date} to {end date}.</p>\r\n\r\n<p>I have delegated my current project to {person&#39;s name}. He/she very well understands about my project and is capable of handling the task without any difficulties. In fact, it is only the final part that is left to be carried out by him/her.</p>\r\n\r\n<p>During the days of my absence from office, I can be reached at {email address/contact number}.</p>\r\n\r\n<p>I will return to the office on {date}. In case I want to resume the work sooner or later than the stated date, I will let you know well in advance.</p>\r\n\r\n<p>Yours Sincerely,<br />\r\n<br />\r\n{Your Name}</p>\r\n\r\n<p>&nbsp;</p>\r\n', '1001.', 'open', '2018-12-26'),
(2, 'TOS', 'Human Resource management', 2018, 'December', 'open', 1001, '<p>asdfasfaf</p>\r\n', '', 'open', '2018-12-23'),
(3, 'TOS', 'Human Resource management', 2018, 'December', 'open', 1001, '<p>asdfasfaf</p>\r\n', '', 'open', '2018-12-23'),
(4, 'TOS', 'Human Resource management', 2018, 'December', 'open', 1001, '<p>asdfasfaf</p>\r\n', '', 'open', '2018-12-23'),
(5, 'TOS', 'Human Resource management', 2018, 'December', 'open', 1001, '<p>asdfasfaf</p>\r\n', '', 'open', '2018-12-23'),
(6, 'TOS', 'Human', 2018, 'December', 'open', 1001, '<p>asdfasd</p>\r\n', '', 'open', '2018-12-23'),
(7, 'TOS', 'Human', 2018, 'December', 'open', 1001, '<p>asdfasd</p>\r\n', '', 'open', '2018-12-23'),
(8, 'TOS', 'Human', 2018, 'December', 'open', 1001, '<p>adasd</p>\r\n', '', 'open', '2018-12-23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task`
--

CREATE TABLE `tbl_task` (
  `task_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `task_title` text NOT NULL,
  `task_start_date` date NOT NULL,
  `task_death_date` date NOT NULL,
  `task_description` text NOT NULL,
  `task_status` int(11) NOT NULL,
  `task_report` text NOT NULL,
  `insert_time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_task`
--

INSERT INTO `tbl_task` (`task_id`, `employee_id`, `task_title`, `task_start_date`, `task_death_date`, `task_description`, `task_status`, `task_report`, `insert_time`) VALUES
(1, 11, 'SMS', '2019-01-03', '2019-01-06', 'In publishing, art, and communication, content is the information and experiences that are directed towards an end-user or audience. Content is \"something that is to be expressed through some medium, as speech, writing or any of various arts\".', 1, '<p style=\"color: green\">2019-01-06</p><p>This is the first report</p><p style=\"color: green\">2019-01-06</p><p>This is the Second report</p><p style=\"color: green\">2019-01-06</p><p>This is third report</p>', '0000-00-00'),
(3, 7, 'Project 101', '2019-01-06', '2019-01-09', '	\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 0, '<p style=\"color: green\">2019-01-06</p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p style=\"color: green\">2019-01-06</p><p>fggfgf </p>', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(150) NOT NULL,
  `user_email` varchar(150) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_password`, `role`) VALUES
(1, 'Jhon Doe', 'jhon@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1),
(2, 'ABC', 'asadur.diu33@gmail.com', 'f0a7766c9d882b2737c8d8892a70560e', 2),
(3, 'Asadur', 'asadursf1994@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2);

-- --------------------------------------------------------

--
-- Table structure for table `work_report`
--

CREATE TABLE `work_report` (
  `report_id` int(11) NOT NULL,
  `employee_name` varchar(100) NOT NULL,
  `employee_message` text NOT NULL,
  `employee_id` int(11) NOT NULL,
  `insert_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_report`
--

INSERT INTO `work_report` (`report_id`, `employee_name`, `employee_message`, `employee_id`, `insert_date`) VALUES
(1, 'Rudra', 'Dear Sir, \r\nMy Codeigniter project was \" Employee Attendance System\". Now employee can send their everyday work report through this system and admin\'s can see the mail on their email account. In this case I have used a api which name is \"Sparkpost\".\r\n\r\nYour most respectful\r\nRudra Sen', 11, '2018-11-25'),
(2, 'Rudra', 'jhgftfhh v', 11, '2018-12-26'),
(3, 'Rudra', 'hgjhgj', 11, '2018-12-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`),
  ADD UNIQUE KEY `id` (`cat_id`),
  ADD KEY `cat_title` (`cat_title`);

--
-- Indexes for table `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `leave_application`
--
ALTER TABLE `leave_application`
  ADD PRIMARY KEY (`app_id`);

--
-- Indexes for table `office_holiday`
--
ALTER TABLE `office_holiday`
  ADD PRIMARY KEY (`holiday_id`);

--
-- Indexes for table `part_time_attendance`
--
ALTER TABLE `part_time_attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD PRIMARY KEY (`ac_id`),
  ADD UNIQUE KEY `ac_c_id` (`ac_c_id`);

--
-- Indexes for table `tbl_ac_accounts`
--
ALTER TABLE `tbl_ac_accounts`
  ADD PRIMARY KEY (`aca_id`);

--
-- Indexes for table `tbl_ac_entry`
--
ALTER TABLE `tbl_ac_entry`
  ADD PRIMARY KEY (`en_id`);

--
-- Indexes for table `tbl_ac_group`
--
ALTER TABLE `tbl_ac_group`
  ADD PRIMARY KEY (`grp_id`);

--
-- Indexes for table `tbl_document`
--
ALTER TABLE `tbl_document`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `tbl_task`
--
ALTER TABLE `tbl_task`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `work_report`
--
ALTER TABLE `work_report`
  ADD PRIMARY KEY (`report_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `collection`
--
ALTER TABLE `collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `leave_application`
--
ALTER TABLE `leave_application`
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `office_holiday`
--
ALTER TABLE `office_holiday`
  MODIFY `holiday_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `part_time_attendance`
--
ALTER TABLE `part_time_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_account`
--
ALTER TABLE `tbl_account`
  MODIFY `ac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `tbl_ac_accounts`
--
ALTER TABLE `tbl_ac_accounts`
  MODIFY `aca_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_ac_entry`
--
ALTER TABLE `tbl_ac_entry`
  MODIFY `en_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_ac_group`
--
ALTER TABLE `tbl_ac_group`
  MODIFY `grp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_document`
--
ALTER TABLE `tbl_document`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_task`
--
ALTER TABLE `tbl_task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `work_report`
--
ALTER TABLE `work_report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
