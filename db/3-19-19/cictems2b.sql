-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2019 at 03:22 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cictems2`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_rights`
--

CREATE TABLE `access_rights` (
  `id` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `modID` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access_rights`
--

INSERT INTO `access_rights` (`id`, `uID`, `modID`) VALUES
(3, 109, 2),
(4, 109, 20),
(5, 54, 25),
(7, 109, 14),
(8, 47, 25),
(9, 106, 2),
(10, 106, 20),
(11, 122, 2),
(12, 122, 20),
(13, 112, 2),
(14, 112, 20),
(15, 107, 2),
(16, 107, 20),
(17, 124, 13),
(18, 124, 4),
(20, 124, 25),
(23, 124, 14),
(24, 124, 21),
(25, 124, 18),
(26, 124, 20),
(27, 124, 22),
(28, 124, 19);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `classID` int(11) NOT NULL,
  `termID` int(11) NOT NULL,
  `subID` int(11) NOT NULL,
  `roomID` int(11) NOT NULL,
  `facID` int(11) NOT NULL,
  `secID` int(11) NOT NULL,
  `dayID` int(11) NOT NULL,
  `classCode` varchar(15) NOT NULL,
  `timeIn` time NOT NULL,
  `timeOut` time NOT NULL,
  `merge_with` int(11) NOT NULL,
  `status` enum('unlocked','locked') NOT NULL,
  `date_submitted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`classID`, `termID`, `subID`, `roomID`, `facID`, `secID`, `dayID`, `classCode`, `timeIn`, `timeOut`, `merge_with`, `status`, `date_submitted`) VALUES
(1, 53, 13, 36, 33, 27, 2, 'MAT121', '07:30:00', '09:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(2, 53, 14, 34, 38, 27, 1, 'STS121', '09:00:00', '10:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(3, 53, 15, 25, 31, 27, 2, 'Socio121', '10:00:00', '11:30:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(4, 53, 16, 36, 33, 27, 1, 'IT-Prog121', '13:00:00', '13:40:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(5, 53, 17, 36, 33, 27, 1, 'IT-Prog121', '13:40:00', '14:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(6, 53, 18, 36, 35, 27, 2, 'IT-HC1211', '14:00:00', '15:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(7, 53, 19, 36, 35, 27, 2, 'IT-HC1211', '15:00:00', '15:30:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(8, 53, 20, 36, 35, 27, 1, 'IT-DiGiLog121', '15:30:00', '16:30:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(9, 53, 21, 34, 30, 27, 2, 'Hist121', '16:30:00', '18:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(10, 53, 22, 34, 37, 27, 1, 'NSTP121', '18:00:00', '19:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(11, 53, 23, 35, 37, 27, 2, 'PE121', '09:00:00', '10:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(12, 53, 13, 32, 29, 28, 1, 'MAT121', '10:00:00', '11:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(13, 53, 14, 34, 36, 28, 2, 'STS121', '13:00:00', '14:30:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(14, 53, 15, 25, 36, 28, 1, 'Socio121', '14:30:00', '15:30:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(15, 53, 16, 26, 33, 28, 2, 'IT-Prog121', '15:30:00', '16:30:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(16, 53, 17, 26, 33, 28, 2, 'IT-Prog121', '16:30:00', '17:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(17, 53, 18, 36, 35, 28, 1, 'IT-HC1211', '17:00:00', '17:40:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(18, 53, 19, 36, 35, 28, 1, 'IT-HC1211', '17:40:00', '18:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(19, 53, 20, 33, 33, 28, 2, 'IT-DiGiLog121', '18:00:00', '19:30:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(20, 53, 21, 34, 38, 28, 1, 'Hist121', '07:30:00', '08:30:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(21, 53, 22, 26, 30, 28, 2, 'NSTP121', '08:30:00', '10:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(22, 53, 23, 34, 30, 28, 2, 'PE121', '10:00:00', '11:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(23, 53, 37, 35, 38, 31, 2, 'Filipino221', '11:00:00', '12:30:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(24, 53, 38, 26, 32, 31, 1, 'IT-DBms221', '13:00:00', '13:40:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(25, 53, 39, 26, 32, 31, 1, 'IT-DBms221', '13:40:00', '14:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(26, 53, 40, 32, 32, 31, 2, 'IT-IntProg221', '14:00:00', '15:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(27, 53, 41, 32, 32, 31, 2, 'IT-IntProg221', '15:00:00', '15:30:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(28, 53, 42, 31, 32, 31, 1, 'IT-Netwrk221', '15:30:00', '16:10:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(29, 53, 43, 31, 32, 31, 1, 'IT-Netwrk221', '16:10:00', '16:30:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(30, 53, 44, 33, 28, 31, 2, 'IT-SAD221', '16:30:00', '18:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(31, 53, 45, 36, 35, 31, 1, 'IT-NetWrk201', '18:00:00', '18:40:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(32, 53, 46, 36, 35, 31, 1, 'IT-NetWrk201', '18:40:00', '19:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(33, 53, 47, 29, 31, 31, 2, 'Entrep221', '07:30:00', '09:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(34, 53, 48, 32, 33, 31, 1, 'IT-QM221', '09:00:00', '10:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(35, 53, 49, 35, 37, 31, 2, 'PE221', '10:00:00', '11:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(36, 53, 37, 29, 36, 32, 1, 'Filipino221', '11:00:00', '12:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(37, 53, 38, 26, 33, 32, 2, 'IT-DBms221', '13:00:00', '14:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(38, 53, 39, 26, 33, 32, 2, 'IT-DBms221', '14:00:00', '14:30:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(39, 53, 40, 31, 32, 32, 1, 'IT-IntProg221', '14:30:00', '15:10:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(40, 53, 41, 31, 32, 32, 1, 'IT-IntProg221', '15:10:00', '15:30:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(41, 53, 42, 32, 32, 32, 2, 'IT-Netwrk221', '15:30:00', '16:30:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(42, 53, 43, 32, 32, 32, 2, 'IT-Netwrk221', '16:30:00', '17:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(43, 53, 44, 33, 28, 32, 1, 'IT-SAD221', '17:00:00', '18:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(44, 53, 45, 32, 28, 32, 2, 'IT-NetWrk201', '18:00:00', '19:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(45, 53, 46, 32, 28, 32, 2, 'IT-NetWrk201', '19:00:00', '19:30:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(46, 53, 47, 25, 30, 32, 1, 'Entrep221', '07:30:00', '08:30:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(47, 53, 48, 33, 35, 32, 2, 'IT-QM221', '08:30:00', '10:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(48, 53, 49, 26, 0, 32, 2, 'PE221', '10:00:00', '11:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(49, 53, 62, 36, 28, 35, 1, 'IT-Free-Ele321', '11:00:00', '11:40:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(50, 53, 63, 36, 28, 35, 1, 'IT-Free-Ele321', '11:40:00', '12:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(51, 53, 64, 31, 28, 35, 2, 'IT-IAS321', '13:00:00', '14:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(52, 53, 65, 31, 28, 35, 2, 'IT-IAS321', '14:00:00', '14:30:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(53, 53, 66, 26, 33, 35, 1, 'IT-ELE321', '14:30:00', '15:10:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(54, 53, 67, 26, 33, 35, 1, 'IT-ELE321', '15:10:00', '15:30:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(55, 53, 68, 36, 29, 35, 2, 'IT-ELE322', '15:30:00', '16:30:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(56, 53, 69, 36, 29, 35, 2, 'IT-ELE322', '16:30:00', '17:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(57, 53, 70, 31, 29, 35, 1, 'IT-Pro321', '17:00:00', '18:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(58, 53, 71, 31, 29, 35, 2, 'IT-Techno301', '18:00:00', '19:30:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(59, 53, 72, 31, 28, 35, 1, 'IT-Free-Ele-322', '07:30:00', '08:30:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(60, 53, 73, 25, 36, 35, 2, 'Rizal321', '08:30:00', '10:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(61, 53, 62, 36, 33, 36, 1, 'IT-Free-Ele321', '10:00:00', '10:40:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(62, 53, 63, 36, 33, 36, 1, 'IT-Free-Ele321', '10:40:00', '11:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(63, 53, 64, 33, 29, 36, 2, 'IT-IAS321', '13:00:00', '14:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(64, 53, 65, 33, 29, 36, 2, 'IT-IAS321', '14:00:00', '14:30:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(65, 53, 66, 32, 29, 36, 1, 'IT-ELE321', '14:30:00', '15:10:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(66, 53, 67, 32, 29, 36, 1, 'IT-ELE321', '15:10:00', '15:30:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(67, 53, 68, 0, 0, 36, 2, 'IT-ELE322', '15:30:00', '16:30:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(68, 53, 69, 0, 0, 36, 2, 'IT-ELE322', '16:30:00', '17:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(69, 53, 70, 32, 33, 36, 1, 'IT-Pro321', '17:00:00', '18:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(70, 53, 71, 36, 35, 36, 2, 'IT-Techno301', '18:00:00', '19:30:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(71, 53, 72, 32, 29, 36, 1, 'IT-Free-Ele-322', '07:30:00', '08:30:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(72, 53, 73, 34, 38, 36, 2, 'Rizal321', '08:30:00', '10:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(73, 53, 82, 0, 0, 39, 2, 'IT-Capstone421', '10:00:00', '14:30:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(74, 53, 83, 32, 29, 39, 1, 'IT-ELE-421', '13:00:00', '13:40:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(75, 53, 84, 32, 29, 39, 1, 'IT-ELE-421', '13:40:00', '14:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(76, 53, 85, 33, 28, 39, 2, 'ITSeminar421', '14:30:00', '16:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(77, 53, 82, 0, 0, 40, 1, 'IT-Capstone421', '16:00:00', '19:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(78, 53, 83, 0, 0, 40, 2, 'IT-ELE-421', '13:00:00', '14:00:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(79, 53, 84, 0, 0, 40, 2, 'IT-ELE-421', '14:00:00', '14:30:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(80, 53, 85, 33, 35, 40, 1, 'ITSeminar421', '14:30:00', '15:30:00', 0, 'unlocked', '2019-02-28 05:50:10'),
(81, 62, 231, 25, 31, 29, 2, 'PHYSICS 1', '07:30:00', '09:00:00', 0, 'unlocked', '2019-03-10 12:33:20'),
(82, 62, 232, 37, 32, 29, 1, 'IT 6', '11:30:00', '12:30:00', 0, 'unlocked', '2019-03-10 12:33:20'),
(83, 62, 235, 31, 29, 29, 1, 'IT 8', '07:30:00', '08:30:00', 0, 'unlocked', '2019-03-10 12:33:20'),
(84, 62, 236, 31, 29, 29, 1, 'IT 8', '08:30:00', '09:30:00', 0, 'unlocked', '2019-03-10 12:33:20'),
(85, 62, 237, 25, 34, 29, 1, 'MATH 3', '13:00:00', '14:00:00', 0, 'unlocked', '2019-03-10 12:33:20'),
(86, 62, 238, 35, 36, 29, 1, 'ENGLISH 3', '17:00:00', '18:00:00', 0, 'unlocked', '2019-03-10 12:33:20'),
(87, 62, 239, 34, 30, 29, 1, 'SOC SCI 1', '16:00:00', '17:00:00', 0, 'unlocked', '2019-03-10 12:33:20'),
(88, 62, 240, 29, 37, 29, 2, 'PE 3', '14:00:00', '15:00:00', 0, 'unlocked', '2019-03-10 12:33:20'),
(89, 62, 253, 31, 32, 33, 2, 'IT-ELE 3', '13:00:00', '14:30:00', 0, 'unlocked', '2019-03-03 13:59:02'),
(90, 62, 254, 31, 32, 33, 2, 'IT-ELE 3', '14:30:00', '16:00:00', 0, 'unlocked', '2019-03-03 13:59:02'),
(91, 62, 255, 31, 29, 33, 1, 'IT 11', '09:30:00', '11:30:00', 0, 'unlocked', '2019-03-06 08:08:57'),
(92, 62, 256, 30, 28, 33, 2, 'IT 12', '10:30:00', '12:00:00', 0, 'unlocked', '2019-03-03 13:59:02'),
(93, 62, 257, 26, 35, 33, 1, 'IT 13', '16:00:00', '18:00:00', 0, 'unlocked', '2019-03-06 08:10:57'),
(94, 62, 258, 35, 34, 33, 1, 'ECO 1', '11:30:00', '12:30:00', 0, 'unlocked', '2019-03-03 13:59:03'),
(95, 62, 259, 35, 40, 33, 1, 'HUMANITIES 2', '15:00:00', '16:00:00', 0, 'unlocked', '2019-03-05 06:27:10'),
(96, 62, 260, 26, 31, 33, 1, 'ACCOUNTING 1', '13:00:00', '14:00:00', 0, 'unlocked', '2019-03-06 08:11:45'),
(97, 62, 273, 26, 35, 37, 1, 'IT PRO', '10:00:00', '12:00:00', 0, 'locked', '2019-03-13 06:37:44'),
(98, 62, 274, 31, 32, 37, 1, 'FREE-ELE 3', '17:00:00', '18:00:00', 0, 'locked', '2019-03-13 06:52:15'),
(99, 62, 275, 31, 32, 37, 1, 'FREE-ELE 3', '18:00:00', '19:00:00', 0, 'locked', '2019-03-13 06:52:15'),
(100, 62, 276, 26, 35, 37, 1, 'IT-SEMINAR', '09:00:00', '10:00:00', 0, 'locked', '2019-03-13 07:03:06'),
(101, 62, 277, 33, 28, 37, 2, 'FREE-ELE 4', '13:00:00', '14:30:00', 0, 'locked', '2019-03-13 07:24:20'),
(102, 62, 278, 31, 29, 37, 1, 'IT 17', '13:00:00', '14:00:00', 0, 'locked', '2019-03-13 07:15:15'),
(103, 62, 279, 31, 29, 37, 1, 'IT 17', '14:00:00', '15:00:00', 0, 'locked', '2019-03-13 07:15:15'),
(104, 62, 287, 35, 38, 37, 2, 'Fil 3', '07:30:00', '09:00:00', 0, 'unlocked', '2019-03-10 12:33:20'),
(105, 62, 393, 31, 29, 61, 1, 'FREE-ELE 2', '13:00:00', '14:00:00', 102, 'unlocked', '2019-03-03 14:19:56'),
(106, 62, 394, 31, 29, 61, 1, 'FREE-ELE 2', '14:00:00', '15:00:00', 103, 'unlocked', '2019-03-03 14:19:56'),
(107, 62, 395, 31, 32, 61, 1, 'FREE-ELE 3', '17:00:00', '18:00:00', 98, 'unlocked', '2019-03-03 14:19:56'),
(108, 62, 396, 31, 32, 61, 1, 'FREE-ELE 3', '18:00:00', '19:00:00', 99, 'unlocked', '2019-03-03 14:19:56'),
(109, 62, 397, 26, 35, 61, 1, 'CS-SEMINAR', '09:00:00', '10:00:00', 100, 'unlocked', '2019-03-03 14:19:56'),
(110, 62, 400, 35, 38, 61, 2, 'FILIPINO 3', '07:30:00', '09:00:00', 104, 'unlocked', '2019-03-03 14:19:57'),
(111, 62, 402, 34, 30, 61, 2, 'SOC SCI 4', '13:00:00', '14:30:00', 0, 'unlocked', '2019-03-03 14:19:57'),
(112, 62, 435, 35, 36, 55, 1, 'ENGLISH 3', '17:00:00', '18:00:00', 86, 'unlocked', '2019-03-05 06:22:46'),
(113, 62, 436, 25, 34, 55, 1, 'MATH 6', '13:00:00', '14:00:00', 85, 'unlocked', '2019-03-05 06:22:46'),
(114, 62, 437, 25, 34, 55, 2, 'MATH 7', '01:00:00', '02:30:00', 0, 'unlocked', '2019-03-05 11:46:18'),
(115, 62, 438, 38, 33, 55, 2, 'CpE 2', '02:30:00', '05:00:00', 0, 'unlocked', '2019-03-06 08:16:37'),
(116, 62, 439, 25, 31, 55, 1, 'PHYSICS 2', '07:30:00', '08:30:00', 0, 'unlocked', '2019-03-06 08:19:15'),
(117, 62, 440, 25, 31, 55, 1, 'PHYSICS 2', '08:30:00', '09:30:00', 0, 'unlocked', '2019-03-06 08:20:18'),
(118, 62, 441, 34, 30, 55, 1, 'SOC SCI 1', '16:00:00', '17:00:00', 87, 'unlocked', '2019-03-05 06:22:46'),
(119, 62, 442, 35, 40, 55, 1, 'HUMANITIES 1', '15:00:00', '16:00:00', 95, 'unlocked', '2019-03-05 06:27:10'),
(120, 62, 443, 29, 37, 55, 2, 'PE 3', '14:00:00', '15:00:00', 88, 'unlocked', '2019-03-06 08:07:12'),
(121, 62, 453, 31, 28, 56, 2, 'ENGDRA2', '16:00:00', '17:30:00', 0, 'unlocked', '2019-03-06 08:21:23'),
(122, 62, 454, 35, 34, 56, 1, 'ECOEng', '11:30:00', '12:30:00', 94, 'unlocked', '2019-03-05 06:34:02'),
(125, 62, 457, 38, 33, 56, 2, 'CpE 4', '07:30:00', '09:00:00', 0, 'unlocked', '2019-03-06 08:22:32'),
(126, 62, 458, 38, 33, 56, 2, 'CpE 4', '09:00:00', '10:30:00', 0, 'unlocked', '2019-03-06 08:22:32'),
(129, 62, 461, 26, 35, 56, 2, 'RESEARCH1', '13:00:00', '14:30:00', 0, 'unlocked', '2019-03-05 06:39:48'),
(130, 62, 462, 34, 30, 56, 2, 'SOC SCI 3', '01:00:00', '02:30:00', 0, 'unlocked', '2019-03-05 06:41:34'),
(131, 62, 463, 38, 33, 56, 1, 'IT 4', '16:00:00', '17:00:00', 0, 'unlocked', '2019-03-06 08:24:46'),
(132, 62, 464, 38, 33, 56, 1, 'IT 4', '17:00:00', '18:00:00', 0, 'unlocked', '2019-03-06 08:24:45'),
(133, 62, 476, 25, 34, 57, 1, 'CpE 11', '16:00:00', '17:00:00', 0, 'unlocked', '2019-03-05 06:44:29'),
(134, 62, 477, 25, 34, 57, 1, 'CpE 12', '17:00:00', '18:00:00', 0, 'unlocked', '2019-03-05 06:45:06'),
(135, 62, 478, 26, 35, 57, 1, 'CpE 13', '14:00:00', '16:00:00', 0, 'unlocked', '2019-03-06 08:26:07'),
(136, 62, 479, 38, 33, 57, 2, 'CpE 14', '07:30:00', '09:00:00', 125, 'unlocked', '2019-03-06 08:22:33'),
(137, 62, 480, 38, 33, 57, 2, 'CpE 14', '09:00:00', '10:30:00', 126, 'unlocked', '2019-03-06 08:22:32'),
(138, 62, 481, 38, 33, 57, 1, 'CpE 15', '07:30:00', '08:30:00', 0, 'unlocked', '2019-03-06 08:28:18'),
(139, 62, 482, 38, 33, 57, 1, 'CpE 15', '08:30:00', '09:30:00', 0, 'unlocked', '2019-03-06 08:28:18'),
(140, 62, 483, 35, 28, 57, 2, 'CpE 16', '14:30:00', '16:00:00', 0, 'unlocked', '2019-03-05 07:01:46'),
(141, 62, 484, 26, 38, 57, 1, 'FILIPINO 3', '01:00:00', '02:00:00', 0, 'unlocked', '2019-03-05 07:05:16'),
(142, 62, 485, 38, 33, 57, 1, 'CpE 17', '09:30:00', '10:30:00', 0, 'unlocked', '2019-03-05 07:06:18'),
(143, 62, 486, 38, 33, 57, 1, 'CpE 17', '10:30:00', '11:30:00', 0, 'unlocked', '2019-03-05 07:10:27'),
(144, 62, 487, 31, 29, 57, 2, 'FREE-ELE 1', '10:00:00', '11:30:00', 0, 'unlocked', '2019-03-05 07:19:25'),
(145, 62, 488, 31, 29, 57, 2, 'FREE-ELE 1', '11:30:00', '13:00:00', 0, 'unlocked', '2019-03-05 07:20:41'),
(146, 62, 502, 26, 35, 58, 2, 'CpE-Proj1', '10:30:00', '12:00:00', 0, 'unlocked', '2019-03-05 07:33:59'),
(147, 62, 503, 37, 32, 58, 1, 'IT 7', '13:00:00', '14:00:00', 0, 'unlocked', '2019-03-05 07:35:47'),
(148, 62, 504, 37, 32, 58, 1, 'IT 7', '14:00:00', '15:00:00', 0, 'unlocked', '2019-03-05 07:36:29'),
(149, 62, 505, 30, 29, 58, 1, 'IT 8', '16:00:00', '17:00:00', 0, 'unlocked', '2019-03-05 07:38:10'),
(150, 62, 506, 30, 29, 58, 1, 'IT 8', '17:00:00', '18:00:00', 0, 'unlocked', '2019-03-05 07:40:00'),
(151, 62, 507, 37, 32, 58, 2, 'FREE-ELE 3', '07:30:00', '09:00:00', 0, 'unlocked', '2019-03-05 07:41:14'),
(152, 62, 508, 34, 30, 58, 1, 'SOC SCI 4', '09:30:00', '10:30:00', 0, 'unlocked', '2019-03-05 07:41:58'),
(153, 62, 509, 33, 28, 58, 1, 'IT 9', '11:30:00', '12:30:00', 0, 'unlocked', '2019-03-05 07:42:45'),
(154, 62, 510, 26, 35, 58, 2, 'CompE-Sem', '09:00:00', '09:30:00', 0, 'unlocked', '2019-03-05 07:44:15'),
(155, 62, 244, 30, 28, 29, 2, 'IT 9', '19:30:00', '20:30:00', 0, 'unlocked', '2019-03-06 12:55:59'),
(156, 62, 250, 29, 40, 29, 2, 'SOC SCI 2', '17:00:00', '18:30:00', 0, 'unlocked', '2019-03-06 13:13:20'),
(157, 62, 245, 30, 28, 29, 2, 'IT 9', '20:30:00', '21:00:00', 0, 'unlocked', '2019-03-06 13:17:16'),
(158, 62, 241, 35, 30, 29, 1, 'HUMANITIES 1', '20:30:00', '21:30:00', 0, 'unlocked', '2019-03-06 13:46:43'),
(159, 62, 211, 25, 31, 25, 2, 'Math 1', '13:00:00', '14:30:00', 0, 'unlocked', '2019-03-06 13:49:21'),
(160, 62, 242, 25, 31, 29, 1, 'PHYSICS 2', '06:30:00', '07:30:00', 0, 'unlocked', '2019-03-06 14:01:36'),
(161, 62, 268, 29, 32, 33, 2, 'IT-ELE 5', '19:30:00', '21:00:00', 0, 'unlocked', '2019-03-06 14:19:57'),
(162, 62, 212, 32, 32, 25, 1, 'IT 1', '08:30:00', '09:30:00', 0, 'unlocked', '2019-03-07 03:26:46'),
(163, 62, 295, 33, 32, 25, 1, 'KB 1', '07:30:00', '08:30:00', 0, 'unlocked', '2019-03-07 03:30:43'),
(164, 62, 213, 30, 29, 25, 2, 'IT 2', '06:00:00', '07:30:00', 0, 'unlocked', '2019-03-07 03:44:00'),
(165, 62, 214, 30, 29, 25, 2, 'IT 2', '08:00:00', '09:30:00', 0, 'unlocked', '2019-03-07 03:49:14'),
(166, 62, 243, 25, 28, 29, 1, 'IT-ELE 1', '03:00:00', '04:00:00', 0, 'unlocked', '2019-03-08 11:21:34'),
(167, 62, 261, 26, 33, 33, 1, 'IT 14', '02:00:00', '03:00:00', 0, 'unlocked', '2019-03-08 11:58:20'),
(168, 62, 219, 29, 38, 25, 1, 'FILIPINO 1', '13:00:00', '14:00:00', 0, 'unlocked', '2019-03-08 12:08:37'),
(169, 53, 280, 26, 0, 68, 1, 'IT 18', '07:30:00', '08:30:00', 0, 'unlocked', '2019-03-15 11:03:17');

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

CREATE TABLE `counter` (
  `countID` int(11) NOT NULL,
  `module` varchar(15) NOT NULL,
  `termID` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `counter`
--

INSERT INTO `counter` (`countID`, `module`, `termID`, `total`) VALUES
(6, 'fees', 24, 0),
(7, 'enrol_studs', 24, 0),
(8, 'enrol_studs', 45, 0),
(9, 'fees', 45, 0),
(10, 'enrol_studs', 53, 0),
(11, 'enrol_studs', 54, 0),
(12, 'enrol_studs', 55, 0),
(13, 'fees', 54, 0),
(14, 'enrol_studs', 56, 0),
(15, 'enrol_studs', 57, 0),
(16, 'enrol_studs', 58, 0),
(17, 'enrol_studs', 59, 0),
(18, 'enrol_studs', 60, 0),
(19, 'enrol_studs', 61, 0),
(20, 'fees', 53, 0),
(21, 'enrol_studs', 62, 93),
(22, 'enrol_studs', 63, 0),
(23, 'enrol_studs', 64, 0),
(24, 'enrol_studs', 65, 0),
(25, 'fees', 62, 7);

-- --------------------------------------------------------

--
-- Table structure for table `counter2`
--

CREATE TABLE `counter2` (
  `countID` int(11) NOT NULL,
  `module` varchar(15) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `counter2`
--

INSERT INTO `counter2` (`countID`, `module`, `total`) VALUES
(1, 'term', 4),
(2, 'room', 12),
(3, 'course', 4),
(4, 'prospectus', 7),
(5, 'section', 40),
(6, 'faculty', 13),
(7, 'subject', 506),
(8, 'student', 144),
(9, 'staff', 3),
(10, 'reg_requests', 0),
(11, 'reg_users', 0),
(12, 'day', 3),
(13, 'active_students', 0),
(14, 'guardian', 0),
(15, 'enrol_requests', 1),
(16, 'specialization', 35),
(17, 'payment_logs', 81);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courseID` int(11) NOT NULL,
  `courseCode` char(10) NOT NULL,
  `courseDesc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseID`, `courseCode`, `courseDesc`) VALUES
(132, 'ACT', 'Associate of Computer Technology'),
(374, 'BSIT', 'Bachelor of Science in Information Technology'),
(376, 'BSCS', 'Bachelor of Science in Computer Science'),
(377, 'BSCPE', 'Bachelor of Science in Computer Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `day`
--

CREATE TABLE `day` (
  `dayID` int(11) NOT NULL,
  `dayDesc` varchar(20) NOT NULL,
  `dayCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `day`
--

INSERT INTO `day` (`dayID`, `dayDesc`, `dayCount`) VALUES
(0, '', 0),
(1, 'MWF', 3),
(2, 'TTH', 2),
(3, 'SAT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `deanslist_reqs`
--

CREATE TABLE `deanslist_reqs` (
  `id` int(11) NOT NULL,
  `termID` int(11) NOT NULL,
  `min_units` int(11) NOT NULL,
  `max_units` int(11) NOT NULL,
  `min_gwa` decimal(10,2) NOT NULL,
  `max_gwa` decimal(10,2) NOT NULL,
  `discount` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deanslist_reqs`
--

INSERT INTO `deanslist_reqs` (`id`, `termID`, `min_units`, `max_units`, `min_gwa`, `max_gwa`, `discount`) VALUES
(1, 62, 12, 29, '1.00', '1.29', '100%'),
(2, 62, 12, 29, '1.30', '1.50', '50%'),
(3, 53, 12, 29, '1.00', '1.29', '100%'),
(4, 53, 12, 29, '1.00', '1.29', '50%'),
(5, 63, 12, 29, '1.00', '1.29', '100%'),
(6, 63, 12, 29, '1.00', '1.29', '50%'),
(8, 65, 12, 29, '1.00', '1.29', '100%'),
(9, 65, 12, 29, '1.30', '1.50', '50%');

-- --------------------------------------------------------

--
-- Table structure for table `enrolment_settings`
--

CREATE TABLE `enrolment_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `some_value` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrolment_settings`
--

INSERT INTO `enrolment_settings` (`id`, `name`, `some_value`) VALUES
(1, 'enrollment_pw', 'Enrolment1'),
(2, 'status', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `facID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `special` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`facID`, `uID`, `special`) VALUES
(0, 116, ''),
(28, 106, 'Programming'),
(29, 107, 'Programming'),
(30, 108, 'Story of my life'),
(31, 109, 'Science & Mathematics'),
(32, 110, 'Multimedia'),
(33, 111, 'Engineering'),
(34, 112, 'Engineering'),
(35, 113, 'All of the above'),
(36, 114, 'English'),
(37, 117, 'Physical Education'),
(38, 119, 'Filipino'),
(39, 122, 'Mathematics'),
(40, 258, 'english');

-- --------------------------------------------------------

--
-- Table structure for table `fac_spec`
--

CREATE TABLE `fac_spec` (
  `id` int(11) NOT NULL,
  `facID` int(11) NOT NULL,
  `specID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fac_spec`
--

INSERT INTO `fac_spec` (`id`, `facID`, `specID`) VALUES
(78, 28, 6),
(79, 28, 7),
(80, 28, 8),
(81, 28, 18),
(82, 28, 20),
(83, 28, 21),
(84, 28, 13),
(85, 28, 16),
(86, 28, 15),
(87, 29, 6),
(88, 29, 8),
(89, 29, 7),
(90, 29, 13),
(91, 29, 15),
(92, 29, 16),
(121, 35, 15),
(122, 35, 20),
(123, 35, 35),
(124, 36, 32),
(125, 36, 17),
(126, 36, 12),
(130, 31, 17),
(131, 31, 12),
(132, 31, 32),
(139, 32, 15),
(140, 32, 13),
(141, 32, 33),
(142, 32, 35),
(143, 33, 21),
(144, 33, 18),
(145, 33, 20),
(146, 33, 13),
(147, 33, 16),
(148, 33, 15),
(149, 33, 33),
(150, 33, 35),
(151, 33, 36),
(152, 34, 18),
(153, 34, 13),
(154, 34, 33),
(163, 39, 23),
(164, 39, 25),
(165, 37, 19),
(166, 37, 34),
(167, 37, 14),
(168, 37, 24),
(169, 37, 29),
(170, 37, 10),
(171, 37, 39),
(172, 30, 17),
(173, 30, 19),
(174, 30, 32),
(175, 30, 34),
(176, 30, 12),
(177, 30, 14),
(178, 38, 12),
(179, 40, 17);

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `feeID` int(11) NOT NULL,
  `termID` int(11) NOT NULL,
  `trans_feeID` int(11) NOT NULL,
  `feeName` varchar(50) NOT NULL,
  `feeDesc` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `dueDate` varchar(40) NOT NULL,
  `feeStatus` enum('ongoing','done','cancelled') NOT NULL,
  `tshirt` enum('unavailable','available') NOT NULL,
  `date_cancelled` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`feeID`, `termID`, `trans_feeID`, `feeName`, `feeDesc`, `amount`, `dueDate`, `feeStatus`, `tshirt`, `date_cancelled`) VALUES
(1, 62, 0, 'Booklet', 'All CICTE Students', '100.00', 'Semptember 21, 2018', 'ongoing', 'unavailable', '0000-00-00'),
(2, 62, 0, 'Intramurals 2k18', 'All CICTE Students', '750.00', 'August 21, 2018', 'ongoing', 'available', '0000-00-00'),
(3, 62, 0, 'Seminar Capstone', 'Pending', '2500.00', 'November 15, 2018', 'ongoing', 'unavailable', '0000-00-00'),
(4, 62, 0, 'Seminar-Safety Mngt', 'Pending', '2500.00', 'December 1, 2018', 'ongoing', 'unavailable', '0000-00-00'),
(5, 62, 0, 'Defense Research', 'Pending', '800.00', 'Pending', 'ongoing', 'unavailable', '0000-00-00'),
(6, 62, 0, 'Defense Capstone', 'Pending', '2500.00', 'Pending', 'ongoing', 'unavailable', '0000-00-00'),
(7, 62, 0, 'Seminar', 'Pending', '2500.00', 'Pending', 'ongoing', 'unavailable', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `grade_formula`
--

CREATE TABLE `grade_formula` (
  `id` int(11) NOT NULL,
  `prelim` decimal(10,2) NOT NULL,
  `midterm` decimal(10,2) NOT NULL,
  `prefi` decimal(10,2) NOT NULL,
  `final` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade_formula`
--

INSERT INTO `grade_formula` (`id`, `prelim`, `midterm`, `prefi`, `final`) VALUES
(1, '0.20', '0.20', '0.20', '0.40');

-- --------------------------------------------------------

--
-- Table structure for table `grade_metric`
--

CREATE TABLE `grade_metric` (
  `entryID` int(11) NOT NULL,
  `grade` double NOT NULL,
  `metric` decimal(10,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade_metric`
--

INSERT INTO `grade_metric` (`entryID`, `grade`, `metric`) VALUES
(1, 75, '3.0'),
(2, 76, '2.9'),
(3, 77, '2.9'),
(4, 78, '2.8'),
(5, 79, '2.7'),
(6, 80, '2.6'),
(7, 81, '2.5'),
(8, 82, '2.5'),
(9, 83, '2.4'),
(10, 84, '2.3'),
(11, 85, '2.2'),
(12, 86, '2.1'),
(13, 87, '2.0'),
(14, 88, '2.0'),
(15, 89, '1.9'),
(16, 90, '1.8'),
(17, 91, '1.7'),
(18, 92, '1.6'),
(19, 93, '1.5'),
(20, 94, '1.5'),
(21, 95, '1.4'),
(22, 96, '1.3'),
(23, 97, '1.2'),
(24, 98, '1.1'),
(25, 99, '1.0'),
(26, 100, '1.0');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `modID` decimal(10,1) NOT NULL,
  `modDesc` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `modID`, `modDesc`) VALUES
(1, '1.0', 'classes'),
(2, '2.0', 'enrollment'),
(3, '3.0', 'grade'),
(4, '4.0', 'payment'),
(5, '5.0', 'term'),
(6, '6.0', 'room'),
(7, '7.0', 'course'),
(8, '8.0', 'prospectus'),
(9, '9.0', 'section'),
(10, '10.0', 'subject'),
(11, '11.0', 'class'),
(12, '12.0', 'grade_formula'),
(13, '13.0', 'fees'),
(14, '14.0', 'users_student'),
(15, '15.0', 'users_faculty'),
(16, '16.0', 'users_staff'),
(17, '17.0', 'users_guardian'),
(18, '18.0', 'reports_prospectus'),
(19, '19.0', 'reports_student'),
(20, '20.0', 'reports_grade'),
(21, '21.0', 'reports_fees'),
(22, '22.0', 'reports_schedule'),
(23, '16.5', 'registration'),
(24, '2.1', 'incomplete'),
(25, '9.5', 'day'),
(27, '20.5', 'reports_remark'),
(28, '24.0', 'my_class'),
(29, '100.0', 'profile'),
(30, '101.0', 'settings'),
(31, '25.0', 'confirmation(enrol)'),
(32, '26.0', 'schedule'),
(33, '10.5', 'specialization'),
(34, '21.5', 'reports_payment_logs'),
(35, '27.0', 'auto_schedule'),
(36, '24.1', 'faculty_inc'),
(37, '23.0', 'reports_deans_list'),
(38, '12.5', 'honor list qual');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `studID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `feeID` int(11) NOT NULL,
  `trans_feeID` int(11) NOT NULL,
  `paidDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `amount` decimal(10,2) NOT NULL,
  `action` varchar(80) NOT NULL,
  `or_number` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `studID`, `uID`, `feeID`, `trans_feeID`, `paidDate`, `amount`, `action`, `or_number`) VALUES
(1, 115, 1, 2, 0, '2019-03-14 03:51:42', '750.00', 'collect', '1'),
(2, 124, 1, 2, 0, '2019-03-14 03:51:57', '750.00', 'collect', '2'),
(3, 120, 1, 2, 0, '2019-03-14 03:53:06', '750.00', 'collect', '3'),
(4, 109, 1, 1, 0, '2019-03-14 03:53:26', '100.00', 'collect', '4'),
(5, 118, 1, 2, 0, '2019-03-14 03:53:52', '750.00', 'collect', '5'),
(6, 134, 1, 2, 0, '2019-03-14 03:54:31', '750.00', 'collect', '6'),
(7, 128, 1, 2, 0, '2019-03-14 03:54:47', '750.00', 'collect', '7'),
(8, 119, 1, 2, 0, '2019-03-14 03:55:11', '750.00', 'collect', '8'),
(9, 114, 1, 3, 0, '2019-03-14 03:57:28', '2500.00', 'collect', '9'),
(10, 110, 1, 2, 0, '2019-03-14 03:57:50', '750.00', 'collect', '10'),
(11, 115, 1, 6, 0, '2019-03-14 03:59:18', '2500.00', 'collect', '12'),
(12, 115, 1, 7, 0, '2019-03-14 03:59:32', '2500.00', 'collect', '13'),
(13, 124, 1, 6, 0, '2019-03-14 03:59:58', '2500.00', 'collect', '14'),
(14, 124, 1, 7, 0, '2019-03-14 04:00:10', '2500.00', 'collect', 'asd'),
(15, 120, 1, 6, 0, '2019-03-14 04:00:40', '2500.00', 'collect', '343'),
(16, 120, 1, 7, 0, '2019-03-14 04:00:59', '2500.00', 'collect', '232'),
(17, 118, 1, 6, 0, '2019-03-14 04:01:23', '2500.00', 'collect', '565'),
(18, 118, 1, 7, 0, '2019-03-14 04:01:30', '2500.00', 'collect', '565a'),
(19, 134, 1, 7, 0, '2019-03-14 04:19:50', '2500.00', 'collect', '1aa'),
(20, 134, 1, 6, 0, '2019-03-14 04:19:59', '2500.00', 'collect', '787'),
(21, 128, 1, 6, 0, '2019-03-14 04:20:54', '2500.00', 'collect', '2aa'),
(22, 128, 1, 7, 0, '2019-03-14 04:21:03', '2500.00', 'collect', '232a'),
(23, 119, 1, 6, 0, '2019-03-14 04:21:27', '2500.00', 'collect', '23222'),
(24, 119, 1, 7, 0, '2019-03-14 04:21:31', '2500.00', 'collect', 'asdsa'),
(25, 114, 1, 6, 0, '2019-03-14 04:22:22', '2500.00', 'collect', 'asdsaaa'),
(26, 114, 1, 7, 0, '2019-03-14 04:22:28', '2500.00', 'collect', 'asd22'),
(27, 110, 1, 6, 0, '2019-03-14 04:22:52', '2500.00', 'collect', 'ww'),
(28, 110, 1, 7, 0, '2019-03-14 04:22:56', '2500.00', 'collect', 'sss'),
(29, 126, 1, 6, 0, '2019-03-14 04:23:40', '2500.00', 'collect', 'sda'),
(30, 126, 1, 7, 0, '2019-03-14 04:23:48', '2500.00', 'collect', 'assaa'),
(31, 126, 1, 2, 0, '2019-03-14 04:24:01', '750.00', 'collect', '11aa'),
(32, 125, 1, 2, 0, '2019-03-14 04:24:23', '750.00', 'collect', 'gg'),
(33, 125, 1, 6, 0, '2019-03-14 04:24:35', '2500.00', 'collect', 'vva'),
(34, 125, 1, 7, 0, '2019-03-14 04:24:39', '2500.00', 'collect', 'bff'),
(35, 132, 1, 1, 0, '2019-03-14 04:24:56', '100.00', 'collect', 'fasd'),
(36, 132, 1, 2, 0, '2019-03-14 04:25:05', '750.00', 'collect', 'ioi'),
(37, 132, 1, 6, 0, '2019-03-14 04:25:13', '2500.00', 'collect', 'va'),
(38, 132, 1, 7, 0, '2019-03-14 04:25:17', '2500.00', 'collect', 'bfgfg'),
(39, 112, 1, 2, 0, '2019-03-14 04:25:49', '750.00', 'collect', 'sds22'),
(40, 112, 1, 6, 0, '2019-03-14 04:26:10', '2500.00', 'collect', '3421'),
(41, 112, 1, 7, 0, '2019-03-14 04:26:17', '2500.00', 'collect', 'fa221'),
(42, 113, 1, 2, 0, '2019-03-14 04:26:42', '750.00', 'collect', '22asd'),
(43, 113, 1, 6, 0, '2019-03-14 04:26:53', '2500.00', 'collect', '22ggga'),
(44, 113, 1, 7, 0, '2019-03-14 04:26:57', '2500.00', 'collect', 'kjkj'),
(45, 123, 1, 2, 0, '2019-03-14 04:27:17', '750.00', 'collect', 'bjf'),
(46, 123, 1, 6, 0, '2019-03-14 04:27:32', '2500.00', 'collect', 'hgf'),
(47, 123, 1, 7, 0, '2019-03-14 04:27:37', '2500.00', 'collect', 'bnbf'),
(48, 129, 1, 1, 0, '2019-03-14 04:27:54', '100.00', 'collect', 'gss'),
(49, 129, 1, 2, 0, '2019-03-14 04:28:02', '750.00', 'collect', 'kjm'),
(50, 117, 1, 1, 0, '2019-03-14 04:28:24', '100.00', 'collect', '98po'),
(51, 117, 1, 2, 0, '2019-03-14 04:28:36', '750.00', 'collect', 'nnhd'),
(52, 117, 1, 6, 0, '2019-03-14 04:28:48', '2500.00', 'collect', 'nnb'),
(53, 117, 1, 7, 0, '2019-03-14 04:28:53', '2500.00', 'collect', 'dfds'),
(54, 127, 1, 1, 0, '2019-03-14 04:29:09', '100.00', 'collect', 'fgjhj'),
(55, 127, 1, 2, 0, '2019-03-14 04:29:16', '750.00', 'collect', 'jhds'),
(56, 127, 1, 6, 0, '2019-03-14 04:29:26', '2500.00', 'collect', '343as'),
(57, 127, 1, 7, 0, '2019-03-14 04:29:34', '2500.00', 'collect', '323s'),
(58, 136, 1, 1, 0, '2019-03-14 04:29:47', '100.00', 'collect', 'fgf343'),
(59, 136, 1, 2, 0, '2019-03-14 04:30:04', '750.00', 'collect', 'hghfg'),
(60, 136, 1, 6, 0, '2019-03-14 04:30:13', '2500.00', 'collect', 'gf343'),
(61, 136, 1, 7, 0, '2019-03-14 04:30:17', '2500.00', 'collect', 'sada'),
(62, 111, 1, 1, 0, '2019-03-14 04:30:38', '100.00', 'collect', '757457'),
(63, 111, 1, 2, 0, '2019-03-14 04:30:49', '750.00', 'collect', '2525'),
(64, 111, 1, 6, 0, '2019-03-14 04:31:04', '2500.00', 'collect', 'fdfds'),
(65, 111, 1, 7, 0, '2019-03-14 04:31:10', '2500.00', 'collect', 'nngg'),
(66, 121, 1, 1, 0, '2019-03-14 04:31:26', '100.00', 'collect', 'ddjhgjh'),
(67, 121, 1, 2, 0, '2019-03-14 04:31:34', '750.00', 'collect', 'jkj65'),
(68, 121, 1, 6, 0, '2019-03-14 04:32:23', '2500.00', 'collect', 'fgss3'),
(69, 121, 1, 3, 0, '2019-03-14 04:32:40', '2500.00', 'collect', 'asd22ad'),
(70, 121, 1, 7, 0, '2019-03-14 04:33:04', '2500.00', 'collect', 'ghghg343'),
(71, 135, 1, 1, 0, '2019-03-14 04:33:24', '100.00', 'collect', 'fdfd'),
(72, 133, 1, 2, 0, '2019-03-14 04:33:52', '750.00', 'collect', 'asd22asd'),
(73, 133, 1, 3, 0, '2019-03-14 04:34:00', '2500.00', 'collect', 'dfd33'),
(74, 133, 1, 6, 0, '2019-03-14 04:34:16', '2500.00', 'collect', 'fd33f'),
(75, 116, 1, 2, 0, '2019-03-14 04:34:34', '750.00', 'collect', 'fd343s'),
(76, 100, 1, 2, 0, '2019-03-14 04:35:36', '750.00', 'collect', 'sadaww'),
(77, 100, 1, 3, 0, '2019-03-14 04:36:24', '2500.00', 'collect', '343dfas'),
(78, 100, 1, 7, 0, '2019-03-14 04:36:56', '2500.00', 'collect', 'asda'),
(79, 131, 1, 1, 0, '2019-03-14 04:37:10', '100.00', 'collect', 'asdaasdaa'),
(80, 131, 1, 6, 0, '2019-03-14 04:37:20', '2500.00', 'collect', 'asdas22'),
(81, 131, 1, 7, 0, '2019-03-14 04:37:24', '2500.00', 'collect', 'fadas');

-- --------------------------------------------------------

--
-- Table structure for table `prospectus`
--

CREATE TABLE `prospectus` (
  `prosID` int(11) NOT NULL,
  `courseID` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `prosCode` varchar(20) NOT NULL,
  `prosDesc` varchar(50) NOT NULL,
  `prosDesc2` varchar(50) NOT NULL,
  `effectivity` varchar(30) NOT NULL,
  `prosType` enum('New','Old') NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prospectus`
--

INSERT INTO `prospectus` (`prosID`, `courseID`, `duration`, `prosCode`, `prosDesc`, `prosDesc2`, `effectivity`, `prosType`, `updated_at`) VALUES
(1, 132, 2, 'ACT 2016-2017', 'G.R. # 03 series of 2015', 'No. 87 Series of 2017', '2016-2017', 'Old', '2019-03-05'),
(3, 374, 4, 'BSIT 2011-2012', '', '', '2011-2012', 'Old', '2019-03-06'),
(4, 376, 4, 'BSCS 2016-2017', '', '', '2016-2017', 'Old', '2019-02-28'),
(5, 377, 5, 'BSCPE 2014-2015', '', '', '2014-2015', 'Old', '2019-03-04'),
(6, 374, 4, 'BSIT 2018-2019', 'G.R. # 03 series of 2015', 'No. 25 Series of 2015', '2018-2019 (K+12 Compliant)', 'New', '2019-03-06'),
(7, 376, 4, 'BSCS 2018-2019', 'G.R. # 03 series of 2015', 'No. 87 Series of 2017', '2018-2019 [K + 12] Compliant', 'New', '2019-02-28'),
(8, 377, 4, 'BSCpE 2018-2019', 'G.R. # 03 series of 2015', 'No. 87 Series of 2017', '2018-2019 (K+12 Compliant)', 'New', '2019-03-04');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `module` varchar(20) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` varchar(70) NOT NULL,
  `title` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `module`, `name`, `description`, `title`) VALUES
(1, 'reports_prospectus', 'CHERYL M. TARRE, DBA (cand), MST-CS, MSC', 'Dean-College of ICT & Engineering Western Leyte College of Ormoc City', 'Dean');

-- --------------------------------------------------------

--
-- Table structure for table `reports_date`
--

CREATE TABLE `reports_date` (
  `id` int(11) NOT NULL,
  `termID` int(11) NOT NULL,
  `module` varchar(20) NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports_date`
--

INSERT INTO `reports_date` (`id`, `termID`, `module`, `updated_at`) VALUES
(1, 53, 'enrolled_students', '2016-02-19'),
(2, 53, 'fees', '2019-03-10'),
(3, 53, 'class_schedules', '2019-02-20'),
(4, 62, 'enrolled_students', '2019-02-28'),
(5, 62, 'fees', '2019-02-28'),
(6, 62, 'class_schedules', '2019-02-28'),
(7, 63, 'enrolled_students', '2000-01-01'),
(8, 63, 'fees', '2000-01-01'),
(9, 63, 'class_schedules', '2000-01-01'),
(13, 65, 'enrolled_students', '2000-01-01'),
(14, 65, 'fees', '2000-01-01'),
(15, 65, 'class_schedules', '2000-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `requisite_type`
--

CREATE TABLE `requisite_type` (
  `req_type` int(11) NOT NULL,
  `typeDesc` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requisite_type`
--

INSERT INTO `requisite_type` (`req_type`, `typeDesc`) VALUES
(1, 'Prerequisite'),
(2, 'Corequisite'),
(3, 'Yearlevel');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `roleID` int(11) NOT NULL,
  `roleDesc` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`roleID`, `roleDesc`) VALUES
(1, 'Admin'),
(2, 'Faculty'),
(3, 'Staff'),
(4, 'Student'),
(5, 'Guardian');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomID` int(11) NOT NULL,
  `roomName` varchar(15) NOT NULL,
  `roomLoc` varchar(40) NOT NULL,
  `capacity` int(11) NOT NULL,
  `status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomID`, `roomName`, `roomLoc`, `capacity`, `status`) VALUES
(0, '', '', 300, 'active'),
(25, 'Physics Room', '3rd floor', 35, 'active'),
(26, 'Trainers Lab', '2nd Floor', 35, 'active'),
(29, 'Chemistry Room', '3rd floor', 35, 'active'),
(30, 'LAB 2', '2nd floor', 35, 'active'),
(31, 'LAB 3', '4th floor', 35, 'active'),
(32, 'LAB 4', '4th floor', 35, 'active'),
(33, 'LAB 1', '2nd floor', 35, 'active'),
(34, 'EngDra', '3rd floor', 35, 'active'),
(35, 'English Room', '3rd floor', 35, 'active'),
(36, 'LAB 5', '4th floor', 35, 'active'),
(37, 'LAB 6', '2nd Floor', 35, 'active'),
(38, 'Hardware Lab', 'second floor', 35, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `room_spec`
--

CREATE TABLE `room_spec` (
  `id` int(11) NOT NULL,
  `roomID` int(11) NOT NULL,
  `specID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_spec`
--

INSERT INTO `room_spec` (`id`, `roomID`, `specID`) VALUES
(35, 34, 9),
(36, 34, 18),
(37, 34, 12),
(38, 34, 17),
(39, 34, 34),
(40, 34, 19),
(41, 34, 32),
(42, 34, 14),
(43, 34, 29),
(44, 34, 10),
(45, 34, 39),
(46, 34, 37),
(47, 34, 24),
(48, 34, 22),
(49, 29, 17),
(50, 29, 32),
(51, 29, 12),
(52, 29, 19),
(53, 29, 34),
(54, 29, 22),
(55, 29, 9),
(56, 29, 10),
(57, 29, 39),
(58, 35, 8),
(59, 35, 10),
(60, 35, 9),
(61, 35, 17),
(62, 35, 19),
(63, 35, 32),
(64, 35, 34),
(65, 35, 12),
(66, 35, 14),
(67, 35, 22),
(68, 35, 24),
(69, 35, 29),
(70, 35, 37),
(71, 35, 39),
(72, 33, 7),
(73, 33, 8),
(74, 33, 6),
(75, 33, 20),
(76, 33, 21),
(77, 33, 36),
(78, 33, 15),
(79, 33, 25),
(80, 33, 30),
(81, 33, 40),
(82, 30, 8),
(83, 30, 6),
(84, 30, 18),
(85, 30, 20),
(86, 30, 21),
(87, 30, 35),
(88, 30, 36),
(89, 30, 13),
(90, 30, 23),
(91, 30, 25),
(92, 30, 28),
(93, 30, 30),
(94, 30, 7),
(95, 30, 38),
(96, 30, 40),
(97, 30, 41),
(98, 31, 7),
(99, 31, 8),
(100, 31, 18),
(101, 31, 21),
(102, 31, 33),
(103, 31, 15),
(104, 31, 16),
(105, 31, 23),
(106, 31, 20),
(107, 31, 35),
(108, 31, 25),
(109, 31, 26),
(110, 31, 30),
(111, 31, 28),
(112, 31, 31),
(113, 31, 6),
(114, 31, 38),
(115, 31, 41),
(116, 31, 40),
(117, 32, 7),
(118, 32, 8),
(119, 32, 18),
(120, 32, 20),
(121, 32, 21),
(122, 32, 33),
(123, 32, 35),
(124, 32, 36),
(125, 32, 13),
(126, 32, 15),
(127, 32, 16),
(128, 32, 23),
(129, 32, 25),
(130, 32, 26),
(131, 32, 28),
(132, 32, 30),
(133, 32, 31),
(134, 32, 6),
(135, 32, 38),
(136, 32, 40),
(137, 32, 41),
(138, 36, 8),
(139, 36, 6),
(140, 36, 7),
(141, 36, 18),
(142, 36, 20),
(143, 36, 21),
(144, 36, 33),
(145, 36, 35),
(146, 36, 36),
(147, 36, 13),
(148, 36, 15),
(149, 36, 16),
(150, 36, 23),
(151, 36, 25),
(152, 36, 26),
(153, 36, 28),
(154, 36, 31),
(155, 36, 30),
(156, 36, 41),
(157, 36, 40),
(158, 36, 38),
(159, 25, 9),
(160, 25, 17),
(161, 25, 32),
(162, 25, 12),
(163, 25, 22),
(164, 25, 27),
(165, 25, 37),
(166, 26, 6),
(167, 26, 9),
(168, 26, 18),
(169, 26, 35),
(170, 26, 36),
(171, 26, 21),
(172, 26, 33),
(173, 26, 13),
(174, 26, 16),
(175, 26, 23),
(176, 26, 24),
(177, 26, 14),
(178, 26, 19),
(179, 37, 18),
(180, 37, 20),
(181, 37, 21),
(182, 37, 33),
(183, 37, 35),
(184, 37, 36),
(185, 37, 13),
(186, 37, 15),
(187, 37, 16),
(188, 37, 23),
(189, 37, 25),
(190, 37, 26),
(191, 37, 28),
(192, 37, 30),
(193, 37, 31),
(194, 37, 6),
(195, 37, 8),
(196, 37, 7),
(197, 37, 38),
(198, 37, 40),
(199, 37, 41),
(200, 38, 17);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `secID` int(11) NOT NULL,
  `courseID` int(11) NOT NULL,
  `semID` int(11) NOT NULL,
  `yearID` int(11) NOT NULL,
  `secName` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`secID`, `courseID`, `semID`, `yearID`, `secName`) VALUES
(25, 374, 1, 1, 'BSIT-1101'),
(26, 374, 1, 1, 'BSIT-1102'),
(27, 374, 2, 1, 'BSIT-1201'),
(28, 374, 2, 1, 'BSIT-1202'),
(29, 374, 1, 2, 'BSIT-2101'),
(30, 374, 1, 2, 'BSIT-2102'),
(31, 374, 2, 2, 'BSIT-2201'),
(32, 374, 2, 2, 'BSIT-2202'),
(33, 374, 1, 3, 'BSIT-3101'),
(34, 374, 1, 3, 'BSIT-3102'),
(35, 374, 2, 3, 'BSIT-3201'),
(36, 374, 2, 3, 'BSIT-3202'),
(37, 374, 1, 4, 'BSIT-4101'),
(38, 374, 1, 4, 'BSIT-4102'),
(39, 374, 2, 4, 'BSIT-4201'),
(40, 374, 2, 4, 'BSIT-4202'),
(44, 132, 2, 1, 'ACT-1201'),
(45, 132, 1, 2, 'ACT-2101'),
(46, 132, 1, 2, 'ACT-2102'),
(47, 132, 2, 2, 'ACT-2201'),
(48, 132, 2, 2, 'ACT-2202'),
(49, 376, 1, 1, 'BSCS -1101'),
(50, 376, 1, 1, 'BSCS-1102'),
(51, 376, 1, 2, 'BSCS-2101'),
(52, 376, 2, 2, 'BSCS-2201'),
(53, 377, 1, 1, 'BSCPE-1101'),
(55, 377, 1, 2, 'BSCPE-2101'),
(56, 377, 1, 3, 'BSCPE-3101'),
(57, 377, 1, 4, 'BSCPE-4101'),
(58, 377, 1, 5, 'BSCPE-5101'),
(59, 377, 1, 1, 'BSCPE-1102'),
(60, 376, 1, 3, 'BSCS-3101'),
(61, 376, 1, 4, 'BSCS-4101'),
(62, 376, 2, 1, 'BSCS-1201'),
(63, 376, 2, 3, 'BSCS-3201'),
(64, 376, 2, 4, 'BSCS-4201'),
(65, 132, 1, 1, 'ACT-1101'),
(66, 132, 1, 1, 'ACT-1102'),
(67, 132, 2, 1, 'ACT-1202'),
(68, 374, 2, 4, 'BSIT-4203');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semID` int(11) NOT NULL,
  `semOrder` int(11) NOT NULL,
  `semDesc` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semID`, `semOrder`, `semDesc`) VALUES
(1, 1, '1st Semester'),
(2, 2, '2nd Semester'),
(3, 3, 'Summer');

-- --------------------------------------------------------

--
-- Table structure for table `specialization`
--

CREATE TABLE `specialization` (
  `specID` int(11) NOT NULL,
  `prosID` int(11) NOT NULL,
  `specDesc` varchar(50) NOT NULL,
  `specColor` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specialization`
--

INSERT INTO `specialization` (`specID`, `prosID`, `specDesc`, `specColor`) VALUES
(6, 4, 'Common CS Courses', '#C0382B'),
(7, 4, 'Professional CS Courses', '#2980B9'),
(8, 4, 'CS Electives/Free Electives', '#8E43AD'),
(9, 4, 'General Education Courses (Including Filipino)', '#222F3D'),
(10, 4, 'Other Courses (PE and NSTP)', '#27AF60'),
(12, 6, 'General Education Courses (Including Filipino)', '#222F3D'),
(13, 6, 'Common IT Courses', '#C0382B'),
(14, 6, 'Other Courses (PE and NSTP)', '#27AF60'),
(15, 6, 'Professional IT Courses', '#2980B9'),
(16, 6, 'IT Electives/Free Electives', '#8E43AD'),
(17, 8, 'General Education Courses (Including Filipino)', '#222F3D'),
(18, 8, 'Common BSCpE Courses', '#C0382B'),
(19, 8, 'Other Courses (PE and NSTP)', '#27AF60'),
(20, 8, 'Professional BSCpE Courses', '#2980B9'),
(21, 8, 'BSCpE Electives/Free Electives', '#8E43AD'),
(22, 1, 'General Education Courses (Including Filipino)', '#222F3D'),
(23, 1, 'Common ACT Courses', '#C0382B'),
(24, 1, 'Other Courses (PE and NSTP)', '#27AF60'),
(25, 1, 'Professional ACT Courses', '#2980B9'),
(26, 1, 'ACT Electives/Free Electives', '#8E43AD'),
(27, 5, 'General Education Courses (Including Filipino)', '#222F3D'),
(28, 5, 'Common BSCpE Courses', '#C0382B'),
(29, 5, 'Other Courses (PE and NSTP)', '#27AF60'),
(30, 5, 'Professional BSCpE Courses', '#2980B9'),
(31, 5, 'BSCpE Electives/Free Electives', '#8E43AD'),
(32, 7, 'General Education Courses (Including Filipino)', '#222F3D'),
(33, 7, 'Common CS Courses', '#C0382B'),
(34, 7, 'Other Courses (PE and NSTP)', '#27AF60'),
(35, 7, 'Professional CS Courses', '#2980B9'),
(36, 7, 'CS Electives/Free Electives', '#8E43AD'),
(37, 3, 'General Education Courses (Including Filipino)', '#222F3D'),
(38, 3, 'Common IT Courses', '#C0382B'),
(39, 3, 'Other Courses (PE and NSTP)', '#27AF60'),
(40, 3, 'Professional IT Courses', '#2980B9'),
(41, 3, 'IT Electives/Free Electives', '#8E43AD');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffID` int(11) NOT NULL,
  `uID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffID`, `uID`) VALUES
(1, 47),
(2, 54),
(3, 124);

-- --------------------------------------------------------

--
-- Table structure for table `studclass`
--

CREATE TABLE `studclass` (
  `scID` int(11) NOT NULL,
  `classID` int(11) NOT NULL,
  `studID` int(11) NOT NULL,
  `prelim` varchar(7) NOT NULL,
  `midterm` varchar(7) NOT NULL,
  `prefi` varchar(7) NOT NULL,
  `final` varchar(7) NOT NULL,
  `finalgrade` varchar(7) NOT NULL,
  `remarks` enum('','Passed','Failed','Incomplete','Dropped') NOT NULL,
  `reason` varchar(50) NOT NULL,
  `status` enum('Unenrolled','Enrolled','Pending') NOT NULL,
  `enrolled_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studclass`
--

INSERT INTO `studclass` (`scID`, `classID`, `studID`, `prelim`, `midterm`, `prefi`, `final`, `finalgrade`, `remarks`, `reason`, `status`, `enrolled_date`) VALUES
(59, 82, 86, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:39:24'),
(60, 83, 86, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:39:24'),
(61, 84, 86, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:39:24'),
(62, 85, 86, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:39:24'),
(63, 86, 86, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:39:24'),
(64, 87, 86, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:39:24'),
(65, 81, 86, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:39:24'),
(66, 88, 86, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:39:24'),
(67, 155, 86, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:39:24'),
(69, 157, 86, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:39:24'),
(70, 96, 86, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:39:48'),
(71, 94, 86, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:39:59'),
(72, 82, 87, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:41:59'),
(73, 83, 87, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:41:59'),
(74, 84, 87, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:41:59'),
(75, 85, 87, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:41:59'),
(76, 86, 87, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:41:59'),
(77, 87, 87, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:41:59'),
(79, 88, 87, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:41:59'),
(80, 155, 87, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:41:59'),
(82, 157, 87, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:41:59'),
(83, 96, 87, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:43:17'),
(84, 94, 87, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:43:24'),
(90, 87, 88, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:49:50'),
(91, 158, 88, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:49:50'),
(92, 81, 88, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:49:50'),
(95, 156, 88, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:49:50'),
(97, 94, 88, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:51:05'),
(98, 96, 88, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:51:15'),
(99, 95, 88, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:53:25'),
(100, 82, 89, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:55:07'),
(101, 83, 89, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:55:07'),
(102, 84, 89, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:55:08'),
(103, 85, 89, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:55:08'),
(104, 86, 89, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:55:08'),
(105, 87, 89, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:55:08'),
(107, 81, 89, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:55:08'),
(108, 88, 89, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:55:08'),
(109, 155, 89, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:55:08'),
(111, 157, 89, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:55:08'),
(112, 96, 89, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:56:39'),
(113, 94, 89, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:56:51'),
(114, 82, 90, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:57:56'),
(115, 83, 90, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:57:56'),
(116, 84, 90, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:57:56'),
(117, 85, 90, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:57:56'),
(118, 86, 90, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:57:56'),
(119, 87, 90, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:57:56'),
(121, 81, 90, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:57:56'),
(122, 88, 90, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:57:56'),
(123, 155, 90, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:57:56'),
(125, 157, 90, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:57:56'),
(126, 96, 90, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:58:27'),
(127, 94, 90, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 21:58:34'),
(128, 82, 91, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:02:10'),
(129, 83, 91, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:02:10'),
(130, 84, 91, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:02:10'),
(131, 85, 91, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:02:10'),
(132, 86, 91, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:02:10'),
(135, 160, 91, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:02:10'),
(137, 88, 91, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:02:10'),
(138, 155, 91, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:02:10'),
(139, 156, 91, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:02:10'),
(140, 157, 91, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:02:10'),
(141, 104, 91, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:03:43'),
(142, 95, 91, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:04:11'),
(143, 82, 92, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:05:13'),
(144, 83, 92, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:05:13'),
(145, 84, 92, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:05:13'),
(146, 85, 92, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:05:13'),
(147, 86, 92, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:05:13'),
(148, 87, 92, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:05:13'),
(153, 155, 92, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:05:13'),
(155, 157, 92, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:05:13'),
(156, 91, 93, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:07:41'),
(157, 93, 93, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:07:41'),
(158, 94, 93, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:07:42'),
(160, 96, 93, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:07:42'),
(161, 89, 93, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:07:42'),
(162, 90, 93, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:07:42'),
(163, 92, 93, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:07:42'),
(164, 86, 93, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:08:13'),
(165, 104, 93, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:08:26'),
(166, 91, 94, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:10:18'),
(167, 93, 94, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:10:18'),
(170, 96, 94, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:10:19'),
(174, 100, 94, '60.00', '60.00', '60.00', '60.00', '60', 'Failed', '', 'Enrolled', '2019-03-06 22:10:38'),
(175, 98, 94, '88.00', '83.00', '82.00', '83.00', '83.8', 'Passed', '', 'Enrolled', '2019-03-06 22:11:16'),
(176, 99, 94, '88.00', '83.00', '82.00', '83.00', '83.8', 'Passed', '', 'Enrolled', '2019-03-06 22:11:27'),
(177, 91, 95, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:12:52'),
(178, 93, 95, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:12:52'),
(184, 92, 95, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:12:52'),
(185, 98, 95, '82.00', '81.00', '82.00', '83.00', '82.2', 'Passed', '', 'Enrolled', '2019-03-06 22:13:20'),
(186, 99, 95, '82.00', '81.00', '82.00', '83.00', '82.2', 'Passed', '', 'Enrolled', '2019-03-06 22:13:30'),
(187, 101, 95, '81.00', '82.00', '83.00', '82.00', '82', 'Passed', '', 'Enrolled', '2019-03-06 22:15:10'),
(188, 161, 95, '', '', '', '', '', '', '', 'Enrolled', '2019-03-06 22:20:19'),
(189, 100, 95, '87.00', '85.00', '87.00', '88.00', '87', 'Passed', '', 'Enrolled', '2019-03-06 22:20:41'),
(199, 162, 96, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 11:57:18'),
(200, 163, 96, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 11:57:53'),
(201, 85, 96, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 11:59:12'),
(202, 86, 96, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 12:00:06'),
(203, 104, 96, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 12:00:25'),
(204, 88, 96, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 12:01:14'),
(205, 164, 96, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 12:08:48'),
(206, 165, 96, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 12:08:59'),
(207, 156, 96, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 12:09:58'),
(208, 158, 96, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 12:48:14'),
(209, 91, 97, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 12:50:40'),
(210, 93, 97, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 12:50:40'),
(216, 92, 97, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 12:50:40'),
(218, 98, 97, '60.00', '60.00', '60.00', '60.00', '60', 'Failed', '', 'Enrolled', '2019-03-07 12:51:28'),
(219, 99, 97, '60.00', '60.00', '60.00', '60.00', '60', 'Failed', '', 'Enrolled', '2019-03-07 12:51:35'),
(220, 91, 98, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 12:57:35'),
(227, 92, 98, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 12:57:35'),
(230, 104, 98, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 12:58:53'),
(231, 100, 98, '77.00', 'INC', 'INC', 'INC', '', 'Incomplete', '', 'Enrolled', '2019-03-07 12:59:13'),
(232, 160, 98, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 12:59:25'),
(233, 88, 98, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 13:01:48'),
(234, 97, 99, '87.61', '87.00', '88.00', '82.00', '85.32', 'Passed', '', 'Enrolled', '2019-03-07 13:04:48'),
(235, 98, 99, '88.00', '85.00', '87.00', '88.00', '87.2', 'Passed', '', 'Enrolled', '2019-03-07 13:04:48'),
(236, 99, 99, '88.00', '85.00', '87.00', '88.00', '87.2', 'Passed', '', 'Enrolled', '2019-03-07 13:04:48'),
(237, 100, 99, '82.00', '83.00', '84.00', '84.00', '83.4', 'Passed', '', 'Enrolled', '2019-03-07 13:04:48'),
(238, 102, 99, '88.50', '89.00', '82.00', '84.00', '85.5', 'Passed', '', 'Enrolled', '2019-03-07 13:04:48'),
(239, 103, 99, '88.50', '89.00', '82.00', '84.00', '85.5', 'Passed', '', 'Enrolled', '2019-03-07 13:04:48'),
(240, 101, 99, '88.00', '82.00', '83.40', '82.00', '83.48', 'Passed', '', 'Enrolled', '2019-03-07 13:04:48'),
(242, 86, 99, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 13:05:36'),
(243, 91, 100, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 13:07:29'),
(248, 89, 100, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 13:07:29'),
(249, 90, 100, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 13:07:29'),
(252, 96, 100, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 13:08:03'),
(253, 159, 100, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 13:08:26'),
(254, 100, 100, '88.00', '82.00', '75.00', 'INC', '', 'Incomplete', '', 'Enrolled', '2019-03-07 13:08:43'),
(255, 97, 100, '60.00', '60.00', '60.00', '60.00', '60', 'Failed', '', 'Enrolled', '2019-03-07 13:10:20'),
(268, 93, 101, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 13:29:44'),
(269, 94, 101, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 13:29:44'),
(271, 96, 101, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 13:29:44'),
(272, 89, 101, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 13:29:44'),
(273, 90, 101, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 13:29:44'),
(274, 92, 101, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 13:29:44'),
(279, 83, 101, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 13:56:32'),
(280, 84, 101, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 13:56:49'),
(281, 98, 100, 'Dropped', '', '', '', '50', 'Dropped', '', 'Enrolled', '2019-03-07 14:00:19'),
(282, 99, 100, 'Dropped', '', '', '', '50', 'Dropped', '', 'Enrolled', '2019-03-07 14:00:37'),
(285, 93, 102, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 14:02:02'),
(286, 94, 102, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 14:02:02'),
(288, 96, 102, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 14:02:02'),
(289, 89, 102, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 14:02:02'),
(290, 90, 102, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 14:02:02'),
(291, 92, 102, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 14:02:02'),
(294, 93, 103, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 14:04:02'),
(298, 89, 103, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 14:04:02'),
(299, 90, 103, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 14:04:02'),
(300, 92, 103, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 14:04:02'),
(302, 83, 103, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 14:05:55'),
(303, 84, 103, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 14:06:02'),
(304, 155, 103, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 14:06:19'),
(305, 157, 103, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 14:06:27'),
(306, 82, 103, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 14:06:44'),
(307, 160, 103, '', '', '', '', '', '', '', 'Enrolled', '2019-03-07 14:07:31'),
(308, 91, 104, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:22:43'),
(309, 93, 104, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:22:43'),
(312, 96, 104, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:22:43'),
(313, 89, 104, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:22:43'),
(314, 90, 104, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:22:43'),
(315, 92, 104, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:22:43'),
(317, 166, 104, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:23:09'),
(318, 91, 105, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:25:53'),
(323, 89, 105, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:25:53'),
(324, 90, 105, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:25:53'),
(325, 92, 105, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:25:53'),
(327, 82, 105, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:26:19'),
(329, 160, 105, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:27:03'),
(330, 104, 105, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:27:19'),
(331, 100, 105, '78.00', 'Dropped', '', '', '55.6', 'Dropped', '', 'Enrolled', '2019-03-08 19:27:32'),
(334, 94, 106, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:31:06'),
(337, 89, 106, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:31:06'),
(338, 90, 106, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:31:06'),
(339, 92, 106, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:31:06'),
(340, 161, 106, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:31:06'),
(341, 83, 106, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:31:27'),
(342, 84, 106, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:31:46'),
(343, 85, 106, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:32:04'),
(344, 87, 106, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:32:26'),
(345, 155, 106, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:32:56'),
(346, 157, 106, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:33:11'),
(347, 97, 106, 'Dropped', '', '', '', '50', 'Dropped', '', 'Enrolled', '2019-03-08 19:35:33'),
(348, 100, 106, 'INC', '88.00', '81.00', '80.00', '', 'Incomplete', '', 'Enrolled', '2019-03-08 19:35:48'),
(351, 94, 107, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:37:18'),
(352, 95, 107, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:37:18'),
(353, 96, 107, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:37:18'),
(358, 83, 107, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:38:10'),
(359, 84, 107, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:38:16'),
(360, 86, 107, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:38:30'),
(361, 155, 107, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:38:51'),
(362, 157, 107, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:39:03'),
(363, 88, 107, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:39:21'),
(365, 93, 108, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:41:40'),
(366, 94, 108, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:41:40'),
(368, 96, 108, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:41:40'),
(371, 92, 108, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:41:40'),
(373, 82, 108, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:42:30'),
(374, 83, 108, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:42:48'),
(375, 84, 108, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:42:54'),
(376, 155, 108, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:43:16'),
(377, 157, 108, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:43:23'),
(378, 97, 109, '70.00', 'Dropped', '', '', '54', 'Dropped', '', 'Enrolled', '2019-03-08 19:44:49'),
(379, 98, 109, '60.00', 'Dropped', '', '', '52', 'Dropped', '', 'Enrolled', '2019-03-08 19:44:49'),
(380, 99, 109, '60.00', 'Dropped', '', '', '52', 'Dropped', '', 'Enrolled', '2019-03-08 19:44:49'),
(381, 100, 109, 'Dropped', '', '', '', '50', 'Dropped', '', 'Enrolled', '2019-03-08 19:44:49'),
(382, 102, 109, 'Dropped', '', '', '', '50', 'Dropped', '', 'Enrolled', '2019-03-08 19:44:49'),
(383, 103, 109, 'Dropped', '', '', '', '50', 'Dropped', '', 'Enrolled', '2019-03-08 19:44:49'),
(384, 101, 109, 'Dropped', '', '', '', '50', 'Dropped', '', 'Enrolled', '2019-03-08 19:44:49'),
(386, 91, 109, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:45:30'),
(387, 97, 110, '85.50', '87.00', '88.00', '81.00', '84.5', 'Passed', '', 'Enrolled', '2019-03-08 19:47:13'),
(388, 98, 110, '80.00', '82.00', '83.00', '86.00', '83.4', 'Passed', '', 'Enrolled', '2019-03-08 19:47:14'),
(389, 99, 110, '80.00', '82.00', '83.00', '86.00', '83.4', 'Passed', '', 'Enrolled', '2019-03-08 19:47:14'),
(390, 100, 110, '88.00', '82.00', '86.00', '88.00', '86.4', 'Passed', '', 'Enrolled', '2019-03-08 19:47:14'),
(391, 102, 110, '88.00', '85.00', '86.66', '87.00', '86.73', 'Passed', '', 'Enrolled', '2019-03-08 19:47:14'),
(392, 103, 110, '88.00', '85.00', '86.66', '87.00', '86.73', 'Passed', '', 'Enrolled', '2019-03-08 19:47:14'),
(393, 101, 110, '81.00', '82.00', '83.00', '84.00', '82.8', 'Passed', '', 'Enrolled', '2019-03-08 19:47:14'),
(394, 104, 110, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:47:14'),
(395, 97, 111, '60.00', '68.00', 'INC', 'INC', '', 'Incomplete', '', 'Enrolled', '2019-03-08 19:49:26'),
(396, 98, 111, '88.00', '75.00', '75.00', '75.00', '77.6', 'Passed', '', 'Enrolled', '2019-03-08 19:49:26'),
(397, 99, 111, '88.00', '75.00', '75.00', '75.00', '77.6', 'Passed', '', 'Enrolled', '2019-03-08 19:49:26'),
(398, 100, 111, 'Dropped', '', '', '', '50', 'Dropped', '', 'Enrolled', '2019-03-08 19:49:26'),
(402, 104, 111, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:49:26'),
(403, 96, 111, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:50:19'),
(404, 91, 111, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:50:35'),
(405, 97, 112, '87.00', '81.00', '82.00', '89.00', '85.6', 'Passed', '', 'Enrolled', '2019-03-08 19:51:59'),
(406, 98, 112, '80.00', '84.44', '85.00', '86.00', '84.29', 'Passed', '', 'Enrolled', '2019-03-08 19:51:59'),
(407, 99, 112, '80.00', '84.44', '85.00', '86.00', '84.29', 'Passed', '', 'Enrolled', '2019-03-08 19:51:59'),
(408, 100, 112, '88.22', '81.00', '82.00', '84.00', '83.84', 'Passed', '', 'Enrolled', '2019-03-08 19:51:59'),
(409, 102, 112, '83.00', '82.00', '83.00', '84.00', '83.2', 'Passed', '', 'Enrolled', '2019-03-08 19:51:59'),
(410, 103, 112, '83.00', '82.00', '83.00', '84.00', '83.2', 'Passed', '', 'Enrolled', '2019-03-08 19:51:59'),
(411, 101, 112, '82.00', '84.00', '86.00', '87.00', '85.2', 'Passed', '', 'Enrolled', '2019-03-08 19:51:59'),
(412, 104, 112, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:51:59'),
(413, 86, 112, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:52:48'),
(414, 97, 113, '90.00', '88.00', '89.00', '81.00', '85.8', 'Passed', '', 'Enrolled', '2019-03-08 19:53:31'),
(415, 98, 113, '82.00', '85.00', '89.00', '84.00', '84.8', 'Passed', '', 'Enrolled', '2019-03-08 19:53:31'),
(416, 99, 113, '82.00', '85.00', '89.00', '84.00', '84.8', 'Passed', '', 'Enrolled', '2019-03-08 19:53:31'),
(417, 100, 113, '86.00', '81.00', '83.00', '89.00', '85.6', 'Passed', '', 'Enrolled', '2019-03-08 19:53:31'),
(418, 102, 113, '84.00', '83.33', '84.00', '86.00', '84.67', 'Passed', '', 'Enrolled', '2019-03-08 19:53:31'),
(419, 103, 113, '84.00', '83.33', '84.00', '86.00', '84.67', 'Passed', '', 'Enrolled', '2019-03-08 19:53:31'),
(420, 101, 113, '83.92', '84.50', '89.00', '81.00', '83.88', 'Passed', '', 'Enrolled', '2019-03-08 19:53:31'),
(422, 97, 114, '83.50', '82.00', '88.00', '92.00', '87.5', 'Passed', '', 'Enrolled', '2019-03-08 19:54:27'),
(423, 98, 114, '89.00', '86.65', '87.00', '81.00', '84.93', 'Passed', '', 'Enrolled', '2019-03-08 19:54:27'),
(424, 99, 114, '89.00', '86.65', '87.00', '81.00', '84.93', 'Passed', '', 'Enrolled', '2019-03-08 19:54:28'),
(425, 100, 114, '87.00', '88.00', '89.00', '88.30', '88.12', 'Passed', '', 'Enrolled', '2019-03-08 19:54:28'),
(426, 102, 114, '82.00', '86.00', '87.00', '88.00', '86.2', 'Passed', '', 'Enrolled', '2019-03-08 19:54:28'),
(427, 103, 114, '82.00', '86.00', '87.00', '88.00', '86.2', 'Passed', '', 'Enrolled', '2019-03-08 19:54:28'),
(428, 101, 114, '84.00', '82.00', '86.00', '87.00', '85.2', 'Passed', '', 'Enrolled', '2019-03-08 19:54:28'),
(430, 86, 114, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:55:02'),
(431, 97, 115, '95.00', '98.00', '99.50', '100.00', '98.5', 'Passed', '', 'Enrolled', '2019-03-08 19:55:44'),
(432, 98, 115, '95.00', '98.00', '96.00', '98.00', '97', 'Passed', '', 'Enrolled', '2019-03-08 19:55:44'),
(433, 99, 115, '95.00', '98.00', '96.00', '98.00', '97', 'Passed', '', 'Enrolled', '2019-03-08 19:55:44'),
(434, 100, 115, '100.00', '97.00', '98.00', '100.00', '99', 'Passed', '', 'Enrolled', '2019-03-08 19:55:44'),
(435, 102, 115, '96.00', '94.00', '95.00', '100.00', '97', 'Passed', '', 'Enrolled', '2019-03-08 19:55:44'),
(436, 103, 115, '96.00', '94.00', '95.00', '100.00', '97', 'Passed', '', 'Enrolled', '2019-03-08 19:55:44'),
(437, 101, 115, '97.00', '98.00', '99.00', '100.00', '98.8', 'Passed', '', 'Enrolled', '2019-03-08 19:55:44'),
(440, 98, 116, '75.00', '75.00', 'INC', 'INC', '', 'Incomplete', '', 'Enrolled', '2019-03-08 19:56:50'),
(441, 99, 116, '75.00', '75.00', 'INC', 'INC', '', 'Incomplete', '', 'Enrolled', '2019-03-08 19:56:50'),
(443, 102, 116, '75.50', '78.00', 'INC', 'INC', '', 'Incomplete', '', 'Enrolled', '2019-03-08 19:56:50'),
(444, 103, 116, '75.50', '78.00', 'INC', 'INC', '', 'Incomplete', '', 'Enrolled', '2019-03-08 19:56:50'),
(445, 101, 116, '75.00', '75.00', '75.00', '75.00', '75', 'Passed', '', 'Enrolled', '2019-03-08 19:56:50'),
(447, 167, 116, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:58:52'),
(448, 155, 116, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:59:20'),
(449, 157, 116, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 19:59:27'),
(450, 97, 117, '75.00', '83.00', '81.00', '80.00', '79.8', 'Passed', '', 'Enrolled', '2019-03-08 20:00:29'),
(451, 98, 117, '88.00', '84.44', '85.00', '86.00', '85.89', 'Passed', '', 'Enrolled', '2019-03-08 20:00:29'),
(452, 99, 117, '88.00', '84.44', '85.00', '86.00', '85.89', 'Passed', '', 'Enrolled', '2019-03-08 20:00:29'),
(453, 100, 117, '82.00', '83.00', '84.00', '83.00', '83', 'Passed', '', 'Enrolled', '2019-03-08 20:00:29'),
(454, 102, 117, '84.44', '85.00', '86.00', '88.00', '86.29', 'Passed', '', 'Enrolled', '2019-03-08 20:00:29'),
(455, 103, 117, '84.44', '85.00', '86.00', '88.00', '86.29', 'Passed', '', 'Enrolled', '2019-03-08 20:00:29'),
(456, 101, 117, '78.00', '79.00', '80.00', '81.00', '79.8', 'Passed', '', 'Enrolled', '2019-03-08 20:00:29'),
(458, 97, 118, '88.00', '82.00', '82.00', '81.00', '82.8', 'Passed', '', 'Enrolled', '2019-03-08 20:01:25'),
(459, 98, 118, '83.00', '84.00', '83.00', '82.00', '82.8', 'Passed', '', 'Enrolled', '2019-03-08 20:01:25'),
(460, 99, 118, '83.00', '84.00', '83.00', '82.00', '82.8', 'Passed', '', 'Enrolled', '2019-03-08 20:01:25'),
(461, 100, 118, '84.50', '82.00', '87.77', '85.00', '84.85', 'Passed', '', 'Enrolled', '2019-03-08 20:01:25'),
(462, 102, 118, '85.00', '86.00', '87.00', '81.00', '84', 'Passed', '', 'Enrolled', '2019-03-08 20:01:25'),
(463, 103, 118, '85.00', '86.00', '87.00', '81.00', '84', 'Passed', '', 'Enrolled', '2019-03-08 20:01:25'),
(464, 101, 118, '82.00', '83.09', '84.50', '85.00', '83.92', 'Passed', '', 'Enrolled', '2019-03-08 20:01:25'),
(466, 97, 119, '91.00', '90.91', '88.88', '82.00', '86.96', 'Passed', '', 'Enrolled', '2019-03-08 20:02:11'),
(467, 98, 119, '84.00', '85.00', '87.00', '88.00', '86.4', 'Passed', '', 'Enrolled', '2019-03-08 20:02:11'),
(468, 99, 119, '84.00', '85.00', '87.00', '88.00', '86.4', 'Passed', '', 'Enrolled', '2019-03-08 20:02:11'),
(469, 100, 119, '83.33', '84.50', '82.00', '83.00', '83.17', 'Passed', '', 'Enrolled', '2019-03-08 20:02:11'),
(470, 102, 119, '90.00', '91.00', '92.00', '91.00', '91', 'Passed', '', 'Enrolled', '2019-03-08 20:02:11'),
(471, 103, 119, '90.00', '91.00', '92.00', '91.00', '91', 'Passed', '', 'Enrolled', '2019-03-08 20:02:11'),
(472, 101, 119, '81.00', '87.00', '88.00', '89.00', '86.8', 'Passed', '', 'Enrolled', '2019-03-08 20:02:11'),
(474, 97, 120, '83.00', '82.00', '81.00', '84.00', '82.8', 'Passed', '', 'Enrolled', '2019-03-08 20:03:20'),
(475, 98, 120, '87.00', '88.42', '89.00', '82.00', '85.68', 'Passed', '', 'Enrolled', '2019-03-08 20:03:20'),
(476, 99, 120, '87.00', '88.42', '89.00', '82.00', '85.68', 'Passed', '', 'Enrolled', '2019-03-08 20:03:20'),
(477, 100, 120, '82.00', '83.33', '85.00', '86.00', '84.47', 'Passed', '', 'Enrolled', '2019-03-08 20:03:20'),
(478, 102, 120, '87.00', '84.00', '84.00', '81.00', '83.4', 'Passed', '', 'Enrolled', '2019-03-08 20:03:20'),
(479, 103, 120, '87.00', '84.00', '84.00', '81.00', '83.4', 'Passed', '', 'Enrolled', '2019-03-08 20:03:20'),
(480, 101, 120, '82.00', '83.00', '82.00', '84.00', '83', 'Passed', '', 'Enrolled', '2019-03-08 20:03:20'),
(490, 91, 121, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 20:05:10'),
(491, 93, 121, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 20:05:10'),
(496, 89, 121, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 20:05:11'),
(497, 90, 121, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 20:05:11'),
(500, 100, 121, '98.00', '100.00', '99.00', '98.00', '98.6', 'Passed', '', 'Enrolled', '2019-03-08 20:05:58'),
(507, 89, 122, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 20:06:36'),
(508, 90, 122, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 20:06:36'),
(511, 85, 122, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 20:07:39'),
(513, 100, 122, '60.00', '60.00', '60.00', '60.00', '60', 'Failed', '', 'Enrolled', '2019-03-08 20:11:15'),
(514, 97, 123, '82.00', '83.00', '82.40', 'INC', '', 'Incomplete', '', 'Enrolled', '2019-03-08 20:14:19'),
(515, 98, 123, '87.00', '88.00', '89.99', '85.00', '87', 'Passed', '', 'Enrolled', '2019-03-08 20:14:20'),
(516, 99, 123, '87.00', '88.00', '89.99', '85.00', '87', 'Passed', '', 'Enrolled', '2019-03-08 20:14:20'),
(517, 100, 123, '82.00', '83.00', '83.33', '84.00', '83.27', 'Passed', '', 'Enrolled', '2019-03-08 20:14:20'),
(518, 102, 123, '81.00', '82.00', '83.00', '84.00', '82.8', 'Passed', '', 'Enrolled', '2019-03-08 20:14:20'),
(519, 103, 123, '81.00', '82.00', '83.00', '84.00', '82.8', 'Passed', '', 'Enrolled', '2019-03-08 20:14:20'),
(520, 101, 123, '81.00', '84.00', '89.00', '81.00', '83.2', 'Passed', '', 'Enrolled', '2019-03-08 20:14:20'),
(521, 104, 123, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 20:14:20'),
(522, 97, 124, '97.00', '98.00', '100.00', '94.00', '96.6', 'Passed', '', 'Enrolled', '2019-03-08 20:15:24'),
(523, 98, 124, '96.50', '97.00', '95.00', '100.00', '97.7', 'Passed', '', 'Enrolled', '2019-03-08 20:15:25'),
(524, 99, 124, '96.50', '97.00', '95.00', '100.00', '97.7', 'Passed', '', 'Enrolled', '2019-03-08 20:15:25'),
(525, 100, 124, '100.00', '99.00', '98.00', '100.00', '99.4', 'Passed', '', 'Enrolled', '2019-03-08 20:15:25'),
(526, 102, 124, '98.00', '95.00', '100.00', '97.50', '97.6', 'Passed', '', 'Enrolled', '2019-03-08 20:15:25'),
(527, 103, 124, '98.00', '95.00', '100.00', '97.50', '97.6', 'Passed', '', 'Enrolled', '2019-03-08 20:15:25'),
(528, 101, 124, '95.00', '98.00', '100.00', '96.00', '97', 'Passed', '', 'Enrolled', '2019-03-08 20:15:25'),
(530, 97, 125, '89.44', '88.88', '82.30', '84.00', '85.72', 'Passed', '', 'Enrolled', '2019-03-08 20:16:20'),
(531, 98, 125, '86.66', '85.00', '87.00', '88.00', '86.93', 'Passed', '', 'Enrolled', '2019-03-08 20:16:20'),
(532, 99, 125, '86.66', '85.00', '87.00', '88.00', '86.93', 'Passed', '', 'Enrolled', '2019-03-08 20:16:20'),
(533, 100, 125, '79.00', '80.12', '82.00', '85.00', '82.22', 'Passed', '', 'Enrolled', '2019-03-08 20:16:20'),
(534, 102, 125, '87.00', '88.23', '83.00', '82.00', '84.45', 'Passed', '', 'Enrolled', '2019-03-08 20:16:20'),
(535, 103, 125, '87.00', '88.23', '83.00', '82.00', '84.45', 'Passed', '', 'Enrolled', '2019-03-08 20:16:20'),
(536, 101, 125, '83.00', '84.00', '86.00', '87.00', '85.4', 'Passed', '', 'Enrolled', '2019-03-08 20:16:20'),
(538, 97, 126, '90.00', '91.99', '92.00', '91.00', '91.2', 'Passed', '', 'Enrolled', '2019-03-08 20:17:22'),
(539, 98, 126, '87.77', '85.00', '88.00', '87.76', '87.26', 'Passed', '', 'Enrolled', '2019-03-08 20:17:22'),
(540, 99, 126, '87.77', '85.00', '88.00', '87.76', '87.26', 'Passed', '', 'Enrolled', '2019-03-08 20:17:22'),
(542, 102, 126, '85.55', '83.00', '82.00', '87.00', '84.91', 'Passed', '', 'Enrolled', '2019-03-08 20:17:22'),
(543, 103, 126, '85.55', '83.00', '82.00', '87.00', '84.91', 'Passed', '', 'Enrolled', '2019-03-08 20:17:22'),
(544, 101, 126, '82.00', '83.00', '82.00', '81.00', '81.8', 'Passed', '', 'Enrolled', '2019-03-08 20:17:22'),
(546, 97, 127, '81.77', '82.00', '84.50', '82.00', '82.45', 'Passed', '', 'Enrolled', '2019-03-08 20:18:15'),
(547, 98, 127, '85.00', '88.77', '89.00', '88.00', '87.75', 'Passed', '', 'Enrolled', '2019-03-08 20:18:15'),
(548, 99, 127, '85.00', '88.77', '89.00', '88.00', '87.75', 'Passed', '', 'Enrolled', '2019-03-08 20:18:15'),
(549, 100, 127, '81.00', '82.00', '84.00', '85.00', '83.4', 'Passed', '', 'Enrolled', '2019-03-08 20:18:15'),
(550, 102, 127, '84.50', '85.00', '86.00', '87.00', '85.9', 'Passed', '', 'Enrolled', '2019-03-08 20:18:15'),
(551, 103, 127, '84.50', '85.00', '86.00', '87.00', '85.9', 'Passed', '', 'Enrolled', '2019-03-08 20:18:15'),
(552, 101, 127, '83.20', '84.00', '85.00', '88.00', '85.64', 'Passed', '', 'Enrolled', '2019-03-08 20:18:15'),
(554, 97, 128, '94.81', '97.00', '99.00', '100.00', '98.16', 'Passed', '', 'Enrolled', '2019-03-08 20:19:00'),
(555, 98, 128, '95.55', '98.00', '95.00', '99.00', '97.31', 'Passed', '', 'Enrolled', '2019-03-08 20:19:00'),
(556, 99, 128, '95.55', '98.00', '95.00', '99.00', '97.31', 'Passed', '', 'Enrolled', '2019-03-08 20:19:00'),
(557, 100, 128, '96.00', '100.00', '97.50', '99.00', '98.3', 'Passed', '', 'Enrolled', '2019-03-08 20:19:01'),
(558, 102, 128, '98.89', '97.00', '88.00', '89.00', '92.38', 'Passed', '', 'Enrolled', '2019-03-08 20:19:01'),
(559, 103, 128, '98.89', '97.00', '88.00', '89.00', '92.38', 'Passed', '', 'Enrolled', '2019-03-08 20:19:01'),
(560, 101, 128, '97.00', '100.00', '95.00', '100.00', '98.4', 'Passed', '', 'Enrolled', '2019-03-08 20:19:01'),
(561, 104, 128, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 20:19:01'),
(568, 101, 129, '60.00', '60.00', '60.00', '60.00', '60', 'Failed', '', 'Enrolled', '2019-03-08 20:19:49'),
(570, 162, 129, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 20:21:04'),
(571, 164, 129, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 20:21:17'),
(572, 165, 129, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 20:21:23'),
(573, 86, 129, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 20:21:33'),
(574, 97, 130, '70.00', '75.50', '71.20', 'INC', '', 'Incomplete', '', 'Enrolled', '2019-03-08 20:22:22'),
(578, 102, 130, '77.00', '78.00', '70.00', '70.00', '73', 'Failed', '', 'Enrolled', '2019-03-08 20:22:22'),
(579, 103, 130, '77.00', '78.00', '70.00', '70.00', '73', 'Failed', '', 'Enrolled', '2019-03-08 20:22:22'),
(580, 101, 130, '75.00', '75.00', 'INC', 'INC', '', 'Incomplete', '', 'Enrolled', '2019-03-08 20:22:22'),
(582, 93, 130, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 20:23:27'),
(583, 97, 131, '91.00', '92.00', '91.40', '90.00', '90.88', 'Passed', '', 'Enrolled', '2019-03-08 20:23:55'),
(587, 102, 131, '82.00', '84.44', '85.00', '86.00', '84.69', 'Passed', '', 'Enrolled', '2019-03-08 20:23:55'),
(588, 103, 131, '82.00', '84.44', '85.00', '86.00', '84.69', 'Passed', '', 'Enrolled', '2019-03-08 20:23:55'),
(591, 97, 132, '92.22', '91.00', '92.49', '88.00', '90.34', 'Passed', '', 'Enrolled', '2019-03-08 20:24:39'),
(592, 98, 132, '90.00', '91.00', '92.00', '87.77', '89.71', 'Passed', '', 'Enrolled', '2019-03-08 20:24:39'),
(593, 99, 132, '90.00', '91.00', '92.00', '87.77', '89.71', 'Passed', '', 'Enrolled', '2019-03-08 20:24:39'),
(594, 100, 132, '91.00', '90.00', '91.00', '92.00', '91.2', 'Passed', '', 'Enrolled', '2019-03-08 20:24:39'),
(595, 102, 132, '91.10', '92.00', '87.00', '90.00', '90.02', 'Passed', '', 'Enrolled', '2019-03-08 20:24:39'),
(596, 103, 132, '91.10', '92.00', '87.00', '90.00', '90.02', 'Passed', '', 'Enrolled', '2019-03-08 20:24:39'),
(597, 101, 132, '91.00', '90.00', '87.00', '81.00', '86', 'Passed', '', 'Enrolled', '2019-03-08 20:24:39'),
(598, 104, 132, '', '', '', '', '', '', '', 'Enrolled', '2019-03-08 20:24:39'),
(599, 97, 133, '76.50', '70.50', '69.00', '60.00', '67.2', 'Failed', '', 'Enrolled', '2019-03-10 19:50:49'),
(603, 102, 133, '79.00', '80.00', 'INC', 'INC', '', 'Incomplete', '', 'Enrolled', '2019-03-10 19:50:49'),
(604, 103, 133, '79.00', '80.00', 'INC', 'INC', '', 'Incomplete', '', 'Enrolled', '2019-03-10 19:50:49'),
(605, 101, 133, '75.00', '75.00', '77.90', 'INC', '', 'Incomplete', '', 'Enrolled', '2019-03-10 19:50:49'),
(607, 83, 133, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 19:52:31'),
(608, 84, 133, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 19:53:36'),
(613, 102, 134, '81.00', '83.00', '82.00', '85.00', '83.2', 'Passed', '', 'Enrolled', '2019-03-10 19:54:54'),
(617, 91, 134, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 19:56:16'),
(618, 93, 134, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 19:56:16'),
(619, 94, 134, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 19:56:16'),
(620, 95, 134, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 19:56:16'),
(625, 92, 134, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 19:56:16'),
(627, 87, 134, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 19:56:54'),
(628, 104, 135, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 19:58:10'),
(631, 99, 136, '84.50', '86.00', '87.00', '81.00', '83.9', 'Passed', '', 'Enrolled', '2019-03-10 19:58:41'),
(637, 97, 136, '83.33', '82.00', '83.00', '81.00', '82.07', 'Passed', '', 'Enrolled', '2019-03-10 20:00:22'),
(638, 98, 136, '84.50', '86.00', '87.00', '81.00', '83.9', 'Passed', '', 'Enrolled', '2019-03-10 20:00:22'),
(639, 99, 136, '84.50', '86.00', '87.00', '81.00', '83.9', 'Passed', '', 'Enrolled', '2019-03-10 20:00:22'),
(640, 100, 136, '86.00', '87.00', '83.00', '88.00', '86.4', 'Passed', '', 'Enrolled', '2019-03-10 20:00:22'),
(641, 102, 136, '82.00', '84.00', '85.00', '87.29', '85.12', 'Passed', '', 'Enrolled', '2019-03-10 20:00:22'),
(642, 103, 136, '82.00', '84.00', '85.00', '87.29', '85.12', 'Passed', '', 'Enrolled', '2019-03-10 20:00:22'),
(643, 101, 136, '81.00', '82.00', '83.00', '82.00', '82', 'Passed', '', 'Enrolled', '2019-03-10 20:00:22'),
(645, 97, 142, '82.25', '81.00', '82.00', '83.33', '82.38', 'Passed', '', 'Enrolled', '2019-03-10 20:11:43'),
(649, 102, 142, '83.33', '84.50', '85.00', '86.00', '84.97', 'Passed', '', 'Enrolled', '2019-03-10 20:11:43'),
(650, 103, 142, '83.33', '84.50', '85.00', '86.00', '84.97', 'Passed', '', 'Enrolled', '2019-03-10 20:11:43'),
(651, 101, 142, '77.77', '80.00', '81.00', '84.00', '81.35', 'Passed', '', 'Enrolled', '2019-03-10 20:11:43'),
(653, 112, 23, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 20:14:09'),
(654, 113, 23, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 20:14:09'),
(655, 116, 23, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 20:14:09'),
(656, 117, 23, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 20:14:09'),
(658, 119, 23, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 20:14:09'),
(659, 114, 23, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 20:14:09'),
(660, 115, 23, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 20:14:09'),
(661, 120, 23, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 20:14:09'),
(662, 121, 23, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 20:16:02'),
(663, 122, 23, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 20:16:18'),
(664, 131, 23, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 20:18:12'),
(665, 132, 23, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 20:18:19'),
(672, 129, 26, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 20:19:09'),
(674, 112, 26, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 20:43:28'),
(675, 113, 26, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 20:43:28'),
(676, 116, 26, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 20:43:28'),
(677, 117, 26, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 20:43:28'),
(682, 120, 26, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 20:43:28'),
(683, 121, 26, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 20:44:06'),
(684, 122, 26, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 20:44:15'),
(685, 133, 26, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 20:45:01'),
(688, 130, 26, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 20:46:53'),
(689, 122, 28, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 20:48:35'),
(690, 131, 28, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 20:48:35'),
(691, 132, 28, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 20:48:35'),
(692, 121, 28, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 20:48:35'),
(696, 130, 28, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 20:48:35'),
(697, 133, 28, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 20:49:09'),
(698, 134, 28, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 20:49:14'),
(699, 135, 28, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 20:49:20'),
(702, 122, 27, '', '', '', '', '', '', '', 'Pending', '2019-03-10 20:56:17'),
(705, 121, 27, '', '', '', '', '', '', '', 'Pending', '2019-03-10 20:56:17'),
(706, 125, 27, '', '', '', '', '', '', '', 'Pending', '2019-03-10 20:56:17'),
(707, 126, 27, '', '', '', '', '', '', '', 'Pending', '2019-03-10 20:56:17'),
(708, 129, 27, '', '', '', '', '', '', '', 'Pending', '2019-03-10 20:56:17'),
(710, 133, 27, '', '', '', '', '', '', '', 'Pending', '2019-03-10 20:56:55'),
(711, 134, 27, '', '', '', '', '', '', '', 'Pending', '2019-03-10 20:57:03'),
(712, 153, 27, '', '', '', '', '', '', '', 'Pending', '2019-03-10 20:57:18'),
(713, 122, 143, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 21:02:53'),
(717, 125, 143, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 21:02:53'),
(718, 126, 143, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 21:02:53'),
(721, 119, 143, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 21:03:35'),
(722, 112, 143, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 21:03:56'),
(723, 152, 143, '', '', '', '', '', '', '', 'Enrolled', '2019-03-10 21:06:38'),
(724, 133, 41, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 14:40:53'),
(725, 134, 41, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 14:40:53'),
(726, 135, 41, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 14:40:53'),
(737, 121, 41, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 14:42:29'),
(738, 122, 41, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 14:42:39'),
(739, 130, 41, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 14:42:52'),
(740, 131, 41, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 14:45:25'),
(741, 132, 41, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 14:45:34'),
(742, 153, 144, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 14:53:39'),
(743, 135, 144, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 14:54:14'),
(744, 149, 144, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 14:54:35'),
(745, 150, 144, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 14:54:50'),
(746, 121, 144, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 14:55:16'),
(747, 144, 144, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 14:56:03'),
(748, 145, 144, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 14:56:11'),
(749, 133, 46, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 14:58:34'),
(750, 134, 46, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 14:58:34'),
(762, 135, 46, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:00:07'),
(763, 121, 46, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:01:35'),
(764, 122, 46, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:01:44'),
(765, 131, 46, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:02:31'),
(766, 132, 46, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:03:05'),
(767, 130, 46, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:03:13'),
(768, 133, 35, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:04:25'),
(769, 134, 35, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:04:25'),
(770, 135, 35, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:04:25'),
(771, 138, 35, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:04:25'),
(772, 139, 35, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:04:25'),
(774, 142, 35, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:04:25'),
(775, 143, 35, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:04:25'),
(776, 136, 35, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:04:25'),
(777, 137, 35, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:04:25'),
(778, 140, 35, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:04:25'),
(779, 144, 35, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:04:25'),
(780, 145, 35, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:04:25'),
(781, 133, 44, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:06:40'),
(782, 134, 44, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:06:40'),
(783, 135, 44, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:06:40'),
(784, 138, 44, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:06:40'),
(785, 139, 44, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:06:40'),
(786, 141, 44, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:06:40'),
(787, 142, 44, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:06:40'),
(788, 143, 44, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:06:40'),
(789, 136, 44, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:06:40'),
(790, 137, 44, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:06:40'),
(791, 140, 44, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:06:40'),
(792, 144, 44, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:06:40'),
(793, 145, 44, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:06:40'),
(795, 134, 32, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:08:25'),
(804, 140, 32, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:08:25'),
(807, 153, 32, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:12:57'),
(808, 149, 32, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:13:30'),
(809, 150, 32, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:13:37'),
(810, 151, 32, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 15:13:57'),
(811, 154, 32, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:43:10'),
(813, 134, 45, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:43:58'),
(815, 138, 45, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:43:58'),
(816, 139, 45, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:43:58'),
(823, 144, 45, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:43:58'),
(824, 145, 45, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:43:58'),
(825, 122, 45, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:45:23'),
(826, 153, 45, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:45:58'),
(827, 133, 40, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:47:24'),
(828, 134, 40, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:47:24'),
(829, 135, 40, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:47:24'),
(830, 138, 40, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:47:24'),
(831, 139, 40, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:47:24'),
(832, 141, 40, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:47:24'),
(833, 142, 40, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:47:24'),
(834, 143, 40, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:47:24'),
(835, 136, 40, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:47:24'),
(836, 137, 40, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:47:24'),
(837, 140, 40, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:47:24'),
(838, 144, 40, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:47:24'),
(839, 145, 40, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:47:24'),
(840, 133, 31, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:48:30'),
(841, 134, 31, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:48:30'),
(842, 135, 31, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:48:30'),
(843, 138, 31, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:48:30'),
(844, 139, 31, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:48:30'),
(845, 141, 31, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:48:30'),
(846, 142, 31, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:48:30'),
(847, 143, 31, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:48:30'),
(848, 136, 31, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:48:30'),
(849, 137, 31, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:48:30'),
(850, 140, 31, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:48:30'),
(851, 144, 31, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:48:30'),
(852, 145, 31, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:48:30'),
(853, 133, 39, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:49:42'),
(854, 134, 39, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:49:42'),
(855, 135, 39, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:49:42'),
(856, 138, 39, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:49:43'),
(857, 139, 39, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:49:43'),
(858, 141, 39, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:49:43'),
(859, 142, 39, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:49:43'),
(860, 143, 39, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:49:43'),
(861, 136, 39, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:49:43'),
(862, 137, 39, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:49:43'),
(863, 140, 39, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:49:43'),
(864, 144, 39, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:49:43'),
(865, 145, 39, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:49:43'),
(866, 133, 145, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:52:20'),
(867, 134, 145, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:52:20'),
(868, 135, 145, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:52:20'),
(869, 138, 145, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:52:20'),
(870, 139, 145, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:52:20'),
(871, 141, 145, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:52:20'),
(872, 142, 145, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:52:20'),
(873, 143, 145, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:52:20'),
(874, 136, 145, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:52:20'),
(875, 137, 145, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:52:20'),
(876, 140, 145, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:52:20'),
(877, 144, 145, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:52:20'),
(878, 145, 145, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:52:20'),
(879, 133, 42, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:53:39'),
(880, 134, 42, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:53:39'),
(881, 135, 42, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:53:39'),
(882, 138, 42, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:53:39'),
(883, 139, 42, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:53:39'),
(884, 141, 42, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:53:39'),
(885, 142, 42, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:53:39'),
(886, 143, 42, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:53:39'),
(887, 136, 42, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:53:39'),
(888, 137, 42, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:53:39'),
(889, 140, 42, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:53:39'),
(890, 144, 42, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:53:39'),
(891, 145, 42, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:53:39'),
(892, 133, 43, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:55:39'),
(893, 134, 43, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:55:39'),
(894, 135, 43, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:55:39'),
(895, 138, 43, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:55:39'),
(896, 139, 43, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:55:39'),
(897, 141, 43, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:55:39'),
(898, 142, 43, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:55:39'),
(899, 143, 43, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:55:39'),
(900, 136, 43, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:55:39'),
(901, 137, 43, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:55:39'),
(902, 140, 43, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:55:39'),
(903, 144, 43, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:55:39'),
(904, 145, 43, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:55:39'),
(905, 133, 29, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:58:21');
INSERT INTO `studclass` (`scID`, `classID`, `studID`, `prelim`, `midterm`, `prefi`, `final`, `finalgrade`, `remarks`, `reason`, `status`, `enrolled_date`) VALUES
(906, 134, 29, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:58:21'),
(907, 135, 29, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:58:21'),
(911, 142, 29, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:58:21'),
(912, 143, 29, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:58:21'),
(915, 140, 29, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:58:21'),
(918, 153, 29, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:59:04'),
(919, 133, 38, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:59:49'),
(920, 134, 38, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:59:49'),
(921, 135, 38, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:59:49'),
(922, 138, 38, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:59:49'),
(923, 139, 38, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:59:49'),
(924, 141, 38, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:59:49'),
(925, 142, 38, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:59:49'),
(926, 143, 38, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:59:49'),
(927, 136, 38, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:59:49'),
(928, 137, 38, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:59:49'),
(929, 140, 38, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:59:49'),
(930, 144, 38, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:59:49'),
(931, 145, 38, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 19:59:49'),
(932, 154, 29, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:00:34'),
(933, 151, 29, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:00:41'),
(934, 133, 34, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:01:47'),
(935, 134, 34, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:01:47'),
(936, 135, 34, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:01:47'),
(937, 138, 34, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:01:47'),
(938, 139, 34, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:01:47'),
(939, 141, 34, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:01:47'),
(940, 142, 34, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:01:47'),
(941, 143, 34, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:01:47'),
(942, 136, 34, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:01:47'),
(943, 137, 34, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:01:47'),
(944, 140, 34, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:01:47'),
(945, 144, 34, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:01:47'),
(946, 145, 34, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:01:47'),
(947, 133, 37, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:03:26'),
(948, 134, 37, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:03:26'),
(949, 135, 37, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:03:26'),
(950, 138, 37, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:03:26'),
(951, 139, 37, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:03:26'),
(952, 141, 37, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:03:26'),
(953, 142, 37, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:03:26'),
(954, 143, 37, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:03:26'),
(955, 136, 37, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:03:26'),
(956, 137, 37, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:03:26'),
(957, 140, 37, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:03:26'),
(958, 144, 37, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:03:26'),
(959, 145, 37, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:03:26'),
(960, 133, 33, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:04:44'),
(961, 134, 33, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:04:44'),
(962, 135, 33, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:04:44'),
(963, 138, 33, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:04:44'),
(964, 139, 33, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:04:44'),
(965, 141, 33, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:04:44'),
(966, 142, 33, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:04:44'),
(967, 143, 33, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:04:44'),
(968, 136, 33, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:04:44'),
(969, 137, 33, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:04:44'),
(970, 140, 33, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:04:44'),
(971, 144, 33, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:04:44'),
(972, 145, 33, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:04:44'),
(973, 147, 59, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:05:58'),
(974, 148, 59, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:05:58'),
(975, 149, 59, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:05:58'),
(976, 150, 59, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:05:58'),
(977, 152, 59, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:05:58'),
(978, 153, 59, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:05:58'),
(979, 146, 59, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:05:58'),
(980, 151, 59, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:05:58'),
(981, 154, 59, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:05:58'),
(982, 112, 59, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:07:41'),
(983, 147, 57, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:08:10'),
(984, 148, 57, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:08:10'),
(985, 149, 57, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:08:10'),
(986, 150, 57, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:08:10'),
(987, 152, 57, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:08:10'),
(988, 153, 57, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:08:10'),
(989, 146, 57, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:08:10'),
(990, 151, 57, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:08:10'),
(991, 154, 57, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:08:10'),
(992, 147, 63, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:08:51'),
(993, 148, 63, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:08:51'),
(997, 153, 63, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:08:51'),
(998, 146, 63, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:08:51'),
(999, 151, 63, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:08:51'),
(1000, 154, 63, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:08:51'),
(1001, 134, 63, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:10:17'),
(1002, 135, 63, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:10:21'),
(1003, 141, 63, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:10:47'),
(1004, 144, 63, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:11:48'),
(1005, 145, 63, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:11:57'),
(1006, 147, 53, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:13:00'),
(1007, 148, 53, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:13:00'),
(1008, 149, 53, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:13:00'),
(1009, 150, 53, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:13:00'),
(1010, 152, 53, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:13:00'),
(1011, 153, 53, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:13:00'),
(1012, 146, 53, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:13:00'),
(1013, 151, 53, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:13:01'),
(1014, 154, 53, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:13:01'),
(1015, 112, 53, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:13:44'),
(1016, 147, 49, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:14:07'),
(1017, 148, 49, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:14:07'),
(1018, 149, 49, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:14:07'),
(1019, 150, 49, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:14:07'),
(1020, 152, 49, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:14:07'),
(1021, 153, 49, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:14:07'),
(1022, 146, 49, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:14:07'),
(1023, 151, 49, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:14:07'),
(1024, 154, 49, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:14:07'),
(1025, 147, 61, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:14:45'),
(1026, 148, 61, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:14:45'),
(1027, 149, 61, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:14:45'),
(1028, 150, 61, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:14:45'),
(1030, 153, 61, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:14:45'),
(1031, 146, 61, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:14:45'),
(1032, 151, 61, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:14:45'),
(1033, 154, 61, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:14:45'),
(1034, 112, 61, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:15:11'),
(1035, 122, 61, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:15:25'),
(1036, 115, 61, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:15:49'),
(1037, 147, 55, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:17:47'),
(1038, 148, 55, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:17:47'),
(1039, 149, 55, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:17:47'),
(1040, 150, 55, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:17:47'),
(1041, 152, 55, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:17:47'),
(1042, 153, 55, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:17:47'),
(1043, 146, 55, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:17:47'),
(1044, 151, 55, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:17:47'),
(1045, 154, 55, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:17:47'),
(1046, 147, 47, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:18:22'),
(1047, 148, 47, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:18:22'),
(1048, 149, 47, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:18:22'),
(1049, 150, 47, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:18:22'),
(1050, 152, 47, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:18:22'),
(1051, 153, 47, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:18:22'),
(1052, 146, 47, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:18:22'),
(1053, 151, 47, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:18:22'),
(1054, 154, 47, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:18:22'),
(1055, 147, 54, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:18:42'),
(1056, 148, 54, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:18:42'),
(1057, 149, 54, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:18:42'),
(1058, 150, 54, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:18:42'),
(1059, 152, 54, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:18:42'),
(1060, 153, 54, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:18:42'),
(1061, 146, 54, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:18:42'),
(1062, 151, 54, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:18:42'),
(1063, 154, 54, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:18:42'),
(1064, 147, 51, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:20:00'),
(1065, 148, 51, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:20:00'),
(1066, 149, 51, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:20:00'),
(1067, 150, 51, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:20:00'),
(1068, 152, 51, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:20:00'),
(1069, 153, 51, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:20:00'),
(1070, 146, 51, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:20:00'),
(1071, 151, 51, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:20:00'),
(1072, 154, 51, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:20:00'),
(1073, 147, 48, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:21:52'),
(1074, 148, 48, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:21:52'),
(1075, 149, 48, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:21:52'),
(1076, 150, 48, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:21:52'),
(1077, 152, 48, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:21:52'),
(1078, 153, 48, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:21:52'),
(1079, 146, 48, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:21:52'),
(1080, 151, 48, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:21:52'),
(1081, 154, 48, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:21:52'),
(1082, 112, 48, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:22:08'),
(1083, 147, 52, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:22:30'),
(1084, 148, 52, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:22:30'),
(1085, 149, 52, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:22:30'),
(1086, 150, 52, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:22:30'),
(1087, 152, 52, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:22:30'),
(1088, 153, 52, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:22:30'),
(1089, 146, 52, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:22:30'),
(1090, 151, 52, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:22:30'),
(1091, 154, 52, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:22:30'),
(1092, 147, 62, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:22:59'),
(1093, 148, 62, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:22:59'),
(1094, 149, 62, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:22:59'),
(1095, 150, 62, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:22:59'),
(1096, 152, 62, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:22:59'),
(1097, 153, 62, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:22:59'),
(1098, 146, 62, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:22:59'),
(1099, 151, 62, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:22:59'),
(1100, 154, 62, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:22:59'),
(1101, 147, 58, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:23:57'),
(1102, 148, 58, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:23:57'),
(1103, 149, 58, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:23:57'),
(1104, 150, 58, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:23:57'),
(1105, 152, 58, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:23:57'),
(1106, 153, 58, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:23:57'),
(1107, 146, 58, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:23:57'),
(1108, 151, 58, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:23:57'),
(1109, 154, 58, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:23:57'),
(1110, 147, 60, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:24:49'),
(1111, 148, 60, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:24:49'),
(1112, 149, 60, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:24:49'),
(1113, 150, 60, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:24:49'),
(1114, 152, 60, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:24:49'),
(1115, 153, 60, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:24:49'),
(1116, 146, 60, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:24:49'),
(1117, 151, 60, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:24:49'),
(1118, 154, 60, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:24:49'),
(1119, 147, 56, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:25:44'),
(1120, 148, 56, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:25:44'),
(1121, 149, 56, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:25:44'),
(1122, 150, 56, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:25:44'),
(1123, 152, 56, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:25:44'),
(1124, 153, 56, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:25:44'),
(1125, 146, 56, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:25:44'),
(1126, 151, 56, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:25:44'),
(1127, 154, 56, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:25:44'),
(1128, 112, 56, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:26:00'),
(1129, 147, 64, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:26:24'),
(1130, 148, 64, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:26:24'),
(1131, 149, 64, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:26:24'),
(1132, 150, 64, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:26:24'),
(1133, 152, 64, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:26:24'),
(1134, 153, 64, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:26:24'),
(1135, 146, 64, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:26:24'),
(1136, 151, 64, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:26:24'),
(1137, 154, 64, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:26:24'),
(1138, 112, 64, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:26:55'),
(1139, 138, 64, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:27:44'),
(1140, 139, 64, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:28:03'),
(1141, 105, 147, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:34:57'),
(1142, 106, 147, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:34:57'),
(1143, 107, 147, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:34:57'),
(1144, 108, 147, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:34:57'),
(1145, 109, 147, '', '', '', '', '', '', '', 'Enrolled', '2019-03-11 20:34:57'),
(1146, 76, 127, '', '', '', '', '', '', '', 'Unenrolled', '2019-03-15 18:55:58'),
(1147, 57, 127, '', '', '', '', '', '', '', 'Unenrolled', '2019-03-15 18:56:39'),
(1148, 169, 127, '', '', '', '', '', '', '', 'Unenrolled', '2019-03-15 19:03:40');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studID` int(11) NOT NULL,
  `yearID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `controlNo` int(11) NOT NULL,
  `status` enum('Old','New','Transferee') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studID`, `yearID`, `uID`, `controlNo`, `status`) VALUES
(4, 1, 125, 762, 'Old'),
(5, 1, 126, 0, 'Old'),
(6, 1, 127, 0, 'Old'),
(7, 1, 128, 0, 'Old'),
(8, 1, 129, 0, 'Old'),
(9, 1, 130, 0, 'Old'),
(10, 1, 131, 0, 'Old'),
(11, 1, 132, 159, 'Old'),
(12, 1, 133, 744, 'Old'),
(13, 1, 134, 0, 'Old'),
(14, 1, 135, 0, 'Old'),
(15, 1, 136, 0, 'Old'),
(16, 1, 137, 0, 'Old'),
(17, 1, 138, 0, 'Old'),
(18, 1, 139, 0, 'Old'),
(19, 1, 140, 0, 'Old'),
(20, 1, 141, 0, 'Old'),
(21, 1, 142, 0, 'Old'),
(23, 2, 144, 149, 'Old'),
(24, 3, 145, 0, 'Old'),
(25, 3, 146, 118, 'Old'),
(26, 2, 147, 144, 'Old'),
(27, 3, 148, 102, 'Old'),
(28, 3, 149, 0, 'Old'),
(29, 4, 150, 93, 'Old'),
(30, 4, 151, 55, 'Old'),
(31, 4, 152, 102, 'Old'),
(32, 4, 153, 92, 'Old'),
(33, 4, 154, 169, 'Old'),
(34, 4, 155, 106, 'Old'),
(35, 4, 156, 131, 'Old'),
(36, 4, 157, 68, 'Old'),
(37, 4, 158, 125, 'Old'),
(38, 4, 159, 123, 'Old'),
(39, 4, 160, 124, 'Old'),
(40, 4, 161, 101, 'Old'),
(41, 4, 162, 137, 'Old'),
(42, 4, 163, 104, 'Old'),
(43, 4, 164, 107, 'Old'),
(44, 4, 165, 0, 'Old'),
(45, 4, 166, 138, 'Old'),
(46, 4, 167, 136, 'Old'),
(47, 5, 168, 80, 'Old'),
(48, 5, 169, 0, 'Old'),
(49, 5, 170, 78, 'Old'),
(51, 5, 172, 97, 'Old'),
(52, 5, 173, 85, 'Old'),
(53, 5, 174, 0, 'Old'),
(54, 5, 175, 91, 'Old'),
(55, 5, 176, 75, 'Old'),
(56, 5, 177, 54, 'Old'),
(57, 5, 178, 86, 'Old'),
(58, 5, 179, 76, 'Old'),
(59, 5, 180, 81, 'Old'),
(60, 5, 181, 0, 'Old'),
(61, 5, 182, 126, 'Old'),
(62, 5, 183, 90, 'Old'),
(63, 5, 184, 142, 'Old'),
(64, 5, 185, 84, 'Old'),
(65, 1, 186, 0, 'Old'),
(66, 1, 187, 0, 'Old'),
(67, 1, 188, 0, 'Old'),
(68, 1, 189, 0, 'Old'),
(69, 1, 190, 0, 'Old'),
(70, 1, 191, 0, 'Old'),
(71, 1, 192, 0, 'Old'),
(72, 1, 193, 0, 'Old'),
(73, 1, 194, 0, 'Old'),
(74, 1, 195, 0, 'Old'),
(75, 1, 196, 0, 'Old'),
(76, 1, 197, 0, 'Old'),
(77, 1, 198, 0, 'Old'),
(78, 1, 199, 0, 'Old'),
(79, 1, 200, 0, 'Old'),
(80, 1, 201, 0, 'Old'),
(81, 1, 202, 0, 'Old'),
(82, 1, 203, 0, 'Old'),
(83, 1, 204, 0, 'Old'),
(84, 1, 205, 737, 'Old'),
(85, 1, 206, 0, 'Old'),
(86, 2, 207, 732, 'Transferee'),
(87, 2, 208, 715, 'Old'),
(88, 2, 209, 730, 'Old'),
(89, 2, 210, 726, 'Old'),
(90, 2, 211, 725, 'Old'),
(91, 2, 212, 727, 'Old'),
(92, 2, 213, 716, 'Old'),
(93, 3, 214, 695, 'Old'),
(94, 3, 215, 689, 'Old'),
(95, 3, 216, 696, 'Old'),
(96, 3, 217, 141, 'Old'),
(97, 3, 218, 691, 'Old'),
(98, 3, 219, 0, 'Old'),
(99, 4, 220, 637, 'Old'),
(100, 3, 221, 446, 'Old'),
(101, 3, 222, 706, 'Old'),
(102, 3, 223, 97, 'Old'),
(103, 3, 224, 702, 'Old'),
(104, 3, 225, 734, 'Old'),
(105, 3, 226, 724, 'Old'),
(106, 3, 227, 569, 'Old'),
(107, 3, 228, 711, 'Old'),
(108, 3, 229, 681, 'Old'),
(109, 4, 230, 653, 'Old'),
(110, 4, 231, 668, 'Old'),
(111, 4, 232, 580, 'Old'),
(112, 4, 233, 677, 'Old'),
(113, 4, 234, 648, 'Old'),
(114, 4, 235, 650, 'Old'),
(115, 4, 236, 641, 'Transferee'),
(116, 4, 237, 0, 'Old'),
(117, 4, 238, 632, 'Old'),
(118, 4, 239, 667, 'Old'),
(119, 4, 240, 656, 'Old'),
(120, 4, 241, 630, 'Old'),
(121, 4, 242, 708, 'Old'),
(122, 3, 243, 0, 'Old'),
(123, 4, 244, 661, 'Old'),
(124, 4, 245, 616, 'New'),
(125, 4, 246, 657, 'Old'),
(126, 4, 247, 642, 'Old'),
(127, 4, 248, 633, 'Old'),
(128, 4, 249, 635, 'Old'),
(129, 4, 250, 387, 'Old'),
(130, 4, 251, 512, 'Old'),
(131, 4, 252, 620, 'Old'),
(132, 4, 253, 660, 'Old'),
(133, 4, 254, 0, 'Old'),
(134, 3, 255, 701, 'Old'),
(135, 4, 256, 694, 'Old'),
(136, 4, 257, 638, 'Old'),
(137, 1, 259, 0, 'Old'),
(138, 1, 260, 0, 'Old'),
(139, 1, 261, 0, 'Old'),
(141, 3, 263, 111111, 'Old'),
(142, 4, 264, 604, 'Old'),
(143, 3, 265, 0, 'Old'),
(144, 1, 266, 57, 'Old'),
(145, 4, 267, 133, 'Old'),
(146, 2, 268, 2189, 'Old'),
(147, 4, 269, 2188, 'Old'),
(148, 2, 270, 573, 'Old'),
(149, 2, 271, 0, 'Old'),
(150, 1, 272, 2924, 'Old');

-- --------------------------------------------------------

--
-- Table structure for table `studgrade`
--

CREATE TABLE `studgrade` (
  `sgID` int(11) NOT NULL,
  `studID` int(11) NOT NULL,
  `subID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `termID` int(11) NOT NULL,
  `sgGrade` decimal(10,1) NOT NULL,
  `remarks` enum('Passed','Failed','Incomplete','Dropped') NOT NULL,
  `grade_type` enum('Class','Credit') NOT NULL,
  `sgDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studgrade`
--

INSERT INTO `studgrade` (`sgID`, `studID`, `subID`, `uID`, `termID`, `sgGrade`, `remarks`, `grade_type`, `sgDate`) VALUES
(1, 99, 273, 113, 62, '2.2', 'Passed', 'Class', '2019-03-13 14:37:43'),
(2, 100, 273, 113, 62, '5.0', 'Failed', 'Class', '2019-03-13 14:37:44'),
(3, 106, 273, 113, 62, '5.0', 'Dropped', 'Class', '2019-03-13 14:37:44'),
(4, 109, 273, 113, 62, '5.0', 'Dropped', 'Class', '2019-03-13 14:37:44'),
(5, 110, 273, 113, 62, '2.2', 'Passed', 'Class', '2019-03-13 14:37:44'),
(6, 111, 273, 113, 62, '0.0', 'Incomplete', 'Class', '2019-03-13 14:37:44'),
(7, 112, 273, 113, 62, '2.1', 'Passed', 'Class', '2019-03-13 14:37:44'),
(8, 113, 273, 113, 62, '2.1', 'Passed', 'Class', '2019-03-13 14:37:44'),
(9, 114, 273, 113, 62, '2.0', 'Passed', 'Class', '2019-03-13 14:37:44'),
(10, 115, 273, 113, 62, '1.0', 'Passed', 'Class', '2019-03-13 14:37:44'),
(11, 117, 273, 113, 62, '2.6', 'Passed', 'Class', '2019-03-13 14:37:44'),
(12, 118, 273, 113, 62, '2.4', 'Passed', 'Class', '2019-03-13 14:37:44'),
(13, 119, 273, 113, 62, '2.0', 'Passed', 'Class', '2019-03-13 14:37:44'),
(14, 120, 273, 113, 62, '2.4', 'Passed', 'Class', '2019-03-13 14:37:44'),
(15, 123, 273, 113, 62, '0.0', 'Incomplete', 'Class', '2019-03-13 14:37:44'),
(16, 124, 273, 113, 62, '1.2', 'Passed', 'Class', '2019-03-13 14:37:44'),
(17, 125, 273, 113, 62, '2.1', 'Passed', 'Class', '2019-03-13 14:37:44'),
(18, 126, 273, 113, 62, '1.7', 'Passed', 'Class', '2019-03-13 14:37:44'),
(19, 127, 273, 113, 62, '2.5', 'Passed', 'Class', '2019-03-13 14:37:44'),
(20, 128, 273, 113, 62, '1.1', 'Passed', 'Class', '2019-03-13 14:37:44'),
(21, 130, 273, 113, 62, '0.0', 'Incomplete', 'Class', '2019-03-13 14:37:44'),
(22, 131, 273, 113, 62, '1.7', 'Passed', 'Class', '2019-03-13 14:37:44'),
(23, 132, 273, 113, 62, '1.8', 'Passed', 'Class', '2019-03-13 14:37:44'),
(24, 133, 273, 113, 62, '5.0', 'Failed', 'Class', '2019-03-13 14:37:44'),
(25, 136, 273, 113, 62, '2.5', 'Passed', 'Class', '2019-03-13 14:37:44'),
(26, 142, 273, 113, 62, '2.5', 'Passed', 'Class', '2019-03-13 14:37:44'),
(27, 94, 274, 110, 62, '2.3', 'Passed', 'Class', '2019-03-13 14:52:15'),
(28, 94, 275, 110, 62, '2.3', 'Passed', 'Class', '2019-03-13 14:52:15'),
(29, 95, 274, 110, 62, '2.5', 'Passed', 'Class', '2019-03-13 14:52:15'),
(30, 95, 275, 110, 62, '2.5', 'Passed', 'Class', '2019-03-13 14:52:15'),
(31, 97, 274, 110, 62, '5.0', 'Failed', 'Class', '2019-03-13 14:52:15'),
(32, 97, 275, 110, 62, '5.0', 'Failed', 'Class', '2019-03-13 14:52:15'),
(33, 99, 274, 110, 62, '2.0', 'Passed', 'Class', '2019-03-13 14:52:15'),
(34, 99, 275, 110, 62, '2.0', 'Passed', 'Class', '2019-03-13 14:52:15'),
(35, 100, 274, 110, 62, '5.0', 'Dropped', 'Class', '2019-03-13 14:52:15'),
(36, 100, 275, 110, 62, '5.0', 'Dropped', 'Class', '2019-03-13 14:52:15'),
(37, 109, 274, 110, 62, '5.0', 'Dropped', 'Class', '2019-03-13 14:52:15'),
(38, 109, 275, 110, 62, '5.0', 'Dropped', 'Class', '2019-03-13 14:52:15'),
(39, 110, 274, 110, 62, '2.4', 'Passed', 'Class', '2019-03-13 14:52:15'),
(40, 110, 275, 110, 62, '2.4', 'Passed', 'Class', '2019-03-13 14:52:15'),
(41, 111, 274, 110, 62, '2.8', 'Passed', 'Class', '2019-03-13 14:52:15'),
(42, 111, 275, 110, 62, '2.8', 'Passed', 'Class', '2019-03-13 14:52:15'),
(43, 112, 274, 110, 62, '2.3', 'Passed', 'Class', '2019-03-13 14:52:15'),
(44, 112, 275, 110, 62, '2.3', 'Passed', 'Class', '2019-03-13 14:52:15'),
(45, 113, 274, 110, 62, '2.2', 'Passed', 'Class', '2019-03-13 14:52:15'),
(46, 113, 275, 110, 62, '2.2', 'Passed', 'Class', '2019-03-13 14:52:15'),
(47, 114, 274, 110, 62, '2.2', 'Passed', 'Class', '2019-03-13 14:52:15'),
(48, 114, 275, 110, 62, '2.2', 'Passed', 'Class', '2019-03-13 14:52:15'),
(49, 115, 274, 110, 62, '1.2', 'Passed', 'Class', '2019-03-13 14:52:15'),
(50, 115, 275, 110, 62, '1.2', 'Passed', 'Class', '2019-03-13 14:52:15'),
(51, 116, 274, 110, 62, '0.0', 'Incomplete', 'Class', '2019-03-13 14:52:15'),
(52, 116, 275, 110, 62, '0.0', 'Incomplete', 'Class', '2019-03-13 14:52:15'),
(53, 117, 274, 110, 62, '2.1', 'Passed', 'Class', '2019-03-13 14:52:15'),
(54, 117, 275, 110, 62, '2.1', 'Passed', 'Class', '2019-03-13 14:52:15'),
(55, 118, 274, 110, 62, '2.4', 'Passed', 'Class', '2019-03-13 14:52:15'),
(56, 118, 275, 110, 62, '2.4', 'Passed', 'Class', '2019-03-13 14:52:15'),
(57, 119, 274, 110, 62, '2.1', 'Passed', 'Class', '2019-03-13 14:52:15'),
(58, 119, 275, 110, 62, '2.1', 'Passed', 'Class', '2019-03-13 14:52:15'),
(59, 120, 274, 110, 62, '2.1', 'Passed', 'Class', '2019-03-13 14:52:15'),
(60, 120, 275, 110, 62, '2.1', 'Passed', 'Class', '2019-03-13 14:52:15'),
(61, 123, 274, 110, 62, '2.0', 'Passed', 'Class', '2019-03-13 14:52:15'),
(62, 123, 275, 110, 62, '2.0', 'Passed', 'Class', '2019-03-13 14:52:15'),
(63, 124, 274, 110, 62, '1.1', 'Passed', 'Class', '2019-03-13 14:52:15'),
(64, 124, 275, 110, 62, '1.1', 'Passed', 'Class', '2019-03-13 14:52:15'),
(65, 125, 274, 110, 62, '2.0', 'Passed', 'Class', '2019-03-13 14:52:15'),
(66, 125, 275, 110, 62, '2.0', 'Passed', 'Class', '2019-03-13 14:52:15'),
(67, 126, 274, 110, 62, '2.0', 'Passed', 'Class', '2019-03-13 14:52:15'),
(68, 126, 275, 110, 62, '2.0', 'Passed', 'Class', '2019-03-13 14:52:15'),
(69, 127, 274, 110, 62, '2.0', 'Passed', 'Class', '2019-03-13 14:52:15'),
(70, 127, 275, 110, 62, '2.0', 'Passed', 'Class', '2019-03-13 14:52:15'),
(71, 128, 274, 110, 62, '1.2', 'Passed', 'Class', '2019-03-13 14:52:15'),
(72, 128, 275, 110, 62, '1.2', 'Passed', 'Class', '2019-03-13 14:52:15'),
(73, 132, 274, 110, 62, '1.8', 'Passed', 'Class', '2019-03-13 14:52:15'),
(74, 132, 275, 110, 62, '1.8', 'Passed', 'Class', '2019-03-13 14:52:15'),
(75, 136, 274, 110, 62, '2.3', 'Passed', 'Class', '2019-03-13 14:52:15'),
(76, 136, 275, 110, 62, '2.3', 'Passed', 'Class', '2019-03-13 14:52:15'),
(77, 136, 274, 110, 62, '2.3', 'Passed', 'Class', '2019-03-13 14:52:15'),
(78, 136, 275, 110, 62, '2.3', 'Passed', 'Class', '2019-03-13 14:52:15'),
(79, 94, 276, 113, 62, '5.0', 'Failed', 'Class', '2019-03-13 15:03:06'),
(80, 95, 276, 113, 62, '2.0', 'Passed', 'Class', '2019-03-13 15:03:06'),
(81, 98, 276, 113, 62, '0.0', 'Incomplete', 'Class', '2019-03-13 15:03:06'),
(82, 99, 276, 113, 62, '2.4', 'Passed', 'Class', '2019-03-13 15:03:06'),
(83, 100, 276, 113, 62, '0.0', 'Incomplete', 'Class', '2019-03-13 15:03:06'),
(84, 105, 276, 113, 62, '5.0', 'Dropped', 'Class', '2019-03-13 15:03:06'),
(85, 106, 276, 113, 62, '0.0', 'Incomplete', 'Class', '2019-03-13 15:03:06'),
(86, 109, 276, 113, 62, '5.0', 'Dropped', 'Class', '2019-03-13 15:03:06'),
(87, 110, 276, 113, 62, '2.1', 'Passed', 'Class', '2019-03-13 15:03:06'),
(88, 111, 276, 113, 62, '5.0', 'Dropped', 'Class', '2019-03-13 15:03:06'),
(89, 112, 276, 113, 62, '2.3', 'Passed', 'Class', '2019-03-13 15:03:06'),
(90, 113, 276, 113, 62, '2.1', 'Passed', 'Class', '2019-03-13 15:03:06'),
(91, 114, 276, 113, 62, '2.0', 'Passed', 'Class', '2019-03-13 15:03:06'),
(92, 115, 276, 113, 62, '1.0', 'Passed', 'Class', '2019-03-13 15:03:06'),
(93, 117, 276, 113, 62, '2.4', 'Passed', 'Class', '2019-03-13 15:03:06'),
(94, 118, 276, 113, 62, '2.2', 'Passed', 'Class', '2019-03-13 15:03:06'),
(95, 119, 276, 113, 62, '2.4', 'Passed', 'Class', '2019-03-13 15:03:06'),
(96, 120, 276, 113, 62, '2.3', 'Passed', 'Class', '2019-03-13 15:03:06'),
(97, 121, 276, 113, 62, '1.0', 'Passed', 'Class', '2019-03-13 15:03:06'),
(98, 122, 276, 113, 62, '5.0', 'Failed', 'Class', '2019-03-13 15:03:06'),
(99, 123, 276, 113, 62, '2.4', 'Passed', 'Class', '2019-03-13 15:03:06'),
(100, 124, 276, 113, 62, '1.0', 'Passed', 'Class', '2019-03-13 15:03:06'),
(101, 125, 276, 113, 62, '2.5', 'Passed', 'Class', '2019-03-13 15:03:06'),
(102, 127, 276, 113, 62, '2.4', 'Passed', 'Class', '2019-03-13 15:03:06'),
(103, 128, 276, 113, 62, '1.1', 'Passed', 'Class', '2019-03-13 15:03:06'),
(104, 132, 276, 113, 62, '1.7', 'Passed', 'Class', '2019-03-13 15:03:06'),
(105, 136, 276, 113, 62, '2.1', 'Passed', 'Class', '2019-03-13 15:03:06'),
(106, 99, 278, 107, 62, '2.1', 'Passed', 'Class', '2019-03-13 15:15:15'),
(107, 99, 279, 107, 62, '2.1', 'Passed', 'Class', '2019-03-13 15:15:15'),
(108, 109, 278, 107, 62, '5.0', 'Dropped', 'Class', '2019-03-13 15:15:15'),
(109, 109, 279, 107, 62, '5.0', 'Dropped', 'Class', '2019-03-13 15:15:15'),
(110, 110, 278, 107, 62, '2.0', 'Passed', 'Class', '2019-03-13 15:15:15'),
(111, 110, 279, 107, 62, '2.0', 'Passed', 'Class', '2019-03-13 15:15:15'),
(112, 112, 278, 107, 62, '2.4', 'Passed', 'Class', '2019-03-13 15:15:15'),
(113, 112, 279, 107, 62, '2.4', 'Passed', 'Class', '2019-03-13 15:15:15'),
(114, 113, 278, 107, 62, '2.2', 'Passed', 'Class', '2019-03-13 15:15:15'),
(115, 113, 279, 107, 62, '2.2', 'Passed', 'Class', '2019-03-13 15:15:15'),
(116, 114, 278, 107, 62, '2.1', 'Passed', 'Class', '2019-03-13 15:15:15'),
(117, 114, 279, 107, 62, '2.1', 'Passed', 'Class', '2019-03-13 15:15:15'),
(118, 115, 278, 107, 62, '1.2', 'Passed', 'Class', '2019-03-13 15:15:15'),
(119, 115, 279, 107, 62, '1.2', 'Passed', 'Class', '2019-03-13 15:15:15'),
(120, 116, 278, 107, 62, '0.0', 'Incomplete', 'Class', '2019-03-13 15:15:15'),
(121, 116, 279, 107, 62, '0.0', 'Incomplete', 'Class', '2019-03-13 15:15:15'),
(122, 117, 278, 107, 62, '2.1', 'Passed', 'Class', '2019-03-13 15:15:15'),
(123, 117, 279, 107, 62, '2.1', 'Passed', 'Class', '2019-03-13 15:15:15'),
(124, 118, 278, 107, 62, '2.3', 'Passed', 'Class', '2019-03-13 15:15:15'),
(125, 118, 279, 107, 62, '2.3', 'Passed', 'Class', '2019-03-13 15:15:15'),
(126, 119, 278, 107, 62, '1.7', 'Passed', 'Class', '2019-03-13 15:15:15'),
(127, 119, 279, 107, 62, '1.7', 'Passed', 'Class', '2019-03-13 15:15:15'),
(128, 120, 278, 107, 62, '2.4', 'Passed', 'Class', '2019-03-13 15:15:15'),
(129, 120, 279, 107, 62, '2.4', 'Passed', 'Class', '2019-03-13 15:15:15'),
(130, 123, 278, 107, 62, '2.4', 'Passed', 'Class', '2019-03-13 15:15:15'),
(131, 123, 279, 107, 62, '2.4', 'Passed', 'Class', '2019-03-13 15:15:15'),
(132, 124, 278, 107, 62, '1.1', 'Passed', 'Class', '2019-03-13 15:15:15'),
(133, 124, 279, 107, 62, '1.1', 'Passed', 'Class', '2019-03-13 15:15:15'),
(134, 125, 278, 107, 62, '2.3', 'Passed', 'Class', '2019-03-13 15:15:15'),
(135, 125, 279, 107, 62, '2.3', 'Passed', 'Class', '2019-03-13 15:15:15'),
(136, 126, 278, 107, 62, '2.2', 'Passed', 'Class', '2019-03-13 15:15:15'),
(137, 126, 279, 107, 62, '2.2', 'Passed', 'Class', '2019-03-13 15:15:15'),
(138, 127, 278, 107, 62, '2.1', 'Passed', 'Class', '2019-03-13 15:15:15'),
(139, 127, 279, 107, 62, '2.1', 'Passed', 'Class', '2019-03-13 15:15:15'),
(140, 128, 278, 107, 62, '1.6', 'Passed', 'Class', '2019-03-13 15:15:15'),
(141, 128, 279, 107, 62, '1.6', 'Passed', 'Class', '2019-03-13 15:15:15'),
(142, 130, 278, 107, 62, '5.0', 'Failed', 'Class', '2019-03-13 15:15:15'),
(143, 130, 279, 107, 62, '5.0', 'Failed', 'Class', '2019-03-13 15:15:15'),
(144, 131, 278, 107, 62, '2.2', 'Passed', 'Class', '2019-03-13 15:15:15'),
(145, 131, 279, 107, 62, '2.2', 'Passed', 'Class', '2019-03-13 15:15:15'),
(146, 132, 278, 107, 62, '1.8', 'Passed', 'Class', '2019-03-13 15:15:15'),
(147, 132, 279, 107, 62, '1.8', 'Passed', 'Class', '2019-03-13 15:15:15'),
(148, 133, 278, 107, 62, '0.0', 'Incomplete', 'Class', '2019-03-13 15:15:15'),
(149, 133, 279, 107, 62, '0.0', 'Incomplete', 'Class', '2019-03-13 15:15:15'),
(150, 136, 278, 107, 62, '2.2', 'Passed', 'Class', '2019-03-13 15:15:15'),
(151, 136, 279, 107, 62, '2.2', 'Passed', 'Class', '2019-03-13 15:15:15'),
(152, 142, 278, 107, 62, '2.2', 'Passed', 'Class', '2019-03-13 15:15:15'),
(153, 142, 279, 107, 62, '2.2', 'Passed', 'Class', '2019-03-13 15:15:15'),
(154, 95, 277, 106, 62, '2.5', 'Passed', 'Class', '2019-03-13 15:24:20'),
(155, 99, 277, 106, 62, '2.4', 'Passed', 'Class', '2019-03-13 15:24:20'),
(156, 109, 277, 106, 62, '5.0', 'Dropped', 'Class', '2019-03-13 15:24:20'),
(157, 110, 277, 106, 62, '2.4', 'Passed', 'Class', '2019-03-13 15:24:20'),
(158, 112, 277, 106, 62, '2.2', 'Passed', 'Class', '2019-03-13 15:24:20'),
(159, 113, 277, 106, 62, '2.3', 'Passed', 'Class', '2019-03-13 15:24:20'),
(160, 114, 277, 106, 62, '2.2', 'Passed', 'Class', '2019-03-13 15:24:20'),
(161, 115, 277, 106, 62, '1.0', 'Passed', 'Class', '2019-03-13 15:24:20'),
(162, 116, 277, 106, 62, '3.0', 'Passed', 'Class', '2019-03-13 15:24:20'),
(163, 117, 277, 106, 62, '2.6', 'Passed', 'Class', '2019-03-13 15:24:20'),
(164, 118, 277, 106, 62, '2.3', 'Passed', 'Class', '2019-03-13 15:24:20'),
(165, 119, 277, 106, 62, '2.0', 'Passed', 'Class', '2019-03-13 15:24:20'),
(166, 120, 277, 106, 62, '2.4', 'Passed', 'Class', '2019-03-13 15:24:20'),
(167, 123, 277, 106, 62, '2.4', 'Passed', 'Class', '2019-03-13 15:24:20'),
(168, 124, 277, 106, 62, '1.2', 'Passed', 'Class', '2019-03-13 15:24:20'),
(169, 125, 277, 106, 62, '2.2', 'Passed', 'Class', '2019-03-13 15:24:20'),
(170, 126, 277, 106, 62, '2.5', 'Passed', 'Class', '2019-03-13 15:24:20'),
(171, 127, 277, 106, 62, '2.1', 'Passed', 'Class', '2019-03-13 15:24:20'),
(172, 128, 277, 106, 62, '1.1', 'Passed', 'Class', '2019-03-13 15:24:20'),
(173, 129, 277, 106, 62, '5.0', 'Failed', 'Class', '2019-03-13 15:24:20'),
(174, 130, 277, 106, 62, '0.0', 'Incomplete', 'Class', '2019-03-13 15:24:20'),
(175, 132, 277, 106, 62, '2.1', 'Passed', 'Class', '2019-03-13 15:24:20'),
(176, 133, 277, 106, 62, '0.0', 'Incomplete', 'Class', '2019-03-13 15:24:20'),
(177, 136, 277, 106, 62, '2.5', 'Passed', 'Class', '2019-03-13 15:24:20'),
(178, 142, 277, 106, 62, '2.5', 'Passed', 'Class', '2019-03-13 15:24:20');

-- --------------------------------------------------------

--
-- Table structure for table `studprospectus`
--

CREATE TABLE `studprospectus` (
  `spID` int(11) NOT NULL,
  `studID` int(11) NOT NULL,
  `prosID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studprospectus`
--

INSERT INTO `studprospectus` (`spID`, `studID`, `prosID`) VALUES
(4, 4, 8),
(5, 5, 8),
(6, 6, 8),
(7, 7, 8),
(8, 8, 8),
(9, 9, 8),
(10, 10, 8),
(11, 11, 8),
(12, 12, 8),
(13, 13, 8),
(14, 14, 8),
(15, 15, 8),
(16, 16, 8),
(17, 17, 8),
(18, 18, 8),
(19, 19, 8),
(20, 20, 8),
(21, 21, 8),
(23, 23, 5),
(24, 24, 5),
(25, 25, 5),
(26, 26, 5),
(27, 27, 5),
(28, 28, 5),
(29, 29, 5),
(30, 30, 5),
(31, 31, 5),
(32, 32, 5),
(33, 33, 5),
(34, 34, 5),
(35, 35, 5),
(36, 36, 5),
(37, 37, 5),
(38, 38, 5),
(39, 39, 5),
(40, 40, 5),
(41, 41, 5),
(42, 42, 5),
(43, 43, 5),
(44, 44, 5),
(45, 45, 5),
(46, 46, 5),
(47, 47, 5),
(48, 48, 5),
(49, 49, 5),
(51, 51, 5),
(52, 52, 5),
(53, 53, 5),
(54, 54, 5),
(55, 55, 5),
(56, 56, 5),
(57, 57, 5),
(58, 58, 5),
(59, 59, 5),
(60, 60, 5),
(61, 61, 5),
(62, 62, 5),
(63, 63, 5),
(64, 64, 5),
(65, 65, 6),
(66, 66, 6),
(67, 67, 6),
(68, 68, 6),
(69, 69, 6),
(70, 70, 6),
(71, 71, 6),
(72, 72, 6),
(73, 73, 6),
(74, 74, 6),
(75, 75, 6),
(76, 76, 6),
(77, 77, 6),
(78, 78, 6),
(79, 79, 6),
(80, 80, 6),
(81, 81, 6),
(82, 82, 6),
(83, 83, 6),
(84, 84, 3),
(85, 85, 6),
(86, 86, 3),
(87, 87, 3),
(88, 88, 3),
(89, 89, 3),
(90, 90, 3),
(91, 91, 3),
(92, 92, 3),
(93, 93, 3),
(94, 94, 3),
(95, 95, 3),
(96, 96, 3),
(97, 97, 3),
(98, 98, 6),
(99, 99, 3),
(100, 100, 3),
(101, 101, 3),
(102, 102, 3),
(103, 103, 3),
(104, 104, 3),
(105, 105, 3),
(106, 106, 3),
(107, 107, 3),
(108, 108, 3),
(109, 109, 3),
(110, 110, 3),
(111, 111, 3),
(112, 112, 3),
(113, 113, 3),
(114, 114, 3),
(115, 115, 3),
(116, 116, 3),
(117, 117, 3),
(118, 118, 3),
(119, 119, 3),
(120, 120, 3),
(121, 121, 3),
(122, 122, 3),
(123, 123, 3),
(124, 124, 3),
(125, 125, 3),
(126, 126, 3),
(127, 127, 3),
(128, 128, 3),
(129, 129, 3),
(130, 130, 3),
(131, 131, 3),
(132, 132, 3),
(133, 133, 3),
(134, 134, 3),
(135, 135, 3),
(136, 136, 3),
(137, 137, 6),
(138, 138, 6),
(139, 139, 6),
(140, 142, 3),
(141, 143, 5),
(142, 144, 5),
(143, 145, 5),
(144, 146, 4),
(145, 147, 4),
(146, 148, 1),
(147, 149, 1),
(148, 150, 1);

-- --------------------------------------------------------

--
-- Table structure for table `studrec_per_term`
--

CREATE TABLE `studrec_per_term` (
  `id` int(11) NOT NULL,
  `studID` int(11) NOT NULL,
  `yearID` int(11) NOT NULL,
  `termID` int(11) NOT NULL,
  `prosID` int(11) NOT NULL,
  `status` enum('Old','New','Transferee') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studrec_per_term`
--

INSERT INTO `studrec_per_term` (`id`, `studID`, `yearID`, `termID`, `prosID`, `status`) VALUES
(1, 86, 2, 62, 3, 'Transferee'),
(6, 88, 2, 62, 3, 'Old'),
(8, 87, 2, 62, 3, 'Old'),
(10, 89, 2, 62, 3, 'Old'),
(11, 90, 2, 62, 3, 'Old'),
(12, 91, 2, 62, 3, 'Old'),
(13, 92, 2, 62, 3, 'Old'),
(14, 93, 3, 62, 3, 'Old'),
(15, 94, 3, 62, 3, 'Old'),
(16, 95, 3, 62, 3, 'Old'),
(17, 96, 3, 62, 3, 'Old'),
(18, 97, 3, 62, 3, 'Old'),
(19, 98, 3, 62, 6, 'Old'),
(20, 99, 4, 62, 3, 'Old'),
(21, 100, 3, 62, 3, 'Old'),
(22, 102, 3, 62, 3, 'Old'),
(23, 101, 3, 62, 3, 'Old'),
(25, 103, 3, 62, 3, 'Old'),
(26, 104, 3, 62, 3, 'Old'),
(27, 105, 3, 62, 3, 'Old'),
(28, 106, 3, 62, 3, 'Old'),
(29, 107, 3, 62, 3, 'Old'),
(30, 108, 3, 62, 3, 'Old'),
(31, 109, 4, 62, 3, 'Old'),
(32, 110, 4, 62, 3, 'Old'),
(33, 111, 4, 62, 3, 'Old'),
(34, 112, 4, 62, 3, 'Old'),
(35, 113, 4, 62, 3, 'Old'),
(36, 114, 4, 62, 3, 'Old'),
(37, 115, 4, 62, 3, 'Transferee'),
(38, 116, 4, 62, 3, 'Old'),
(39, 117, 4, 62, 3, 'Old'),
(40, 118, 4, 62, 3, 'Old'),
(41, 119, 4, 62, 3, 'Old'),
(42, 120, 4, 62, 3, 'Old'),
(43, 121, 3, 62, 3, 'Old'),
(44, 122, 3, 62, 3, 'Old'),
(45, 123, 4, 62, 3, 'Old'),
(46, 124, 4, 62, 3, 'New'),
(47, 125, 4, 62, 3, 'Old'),
(48, 126, 4, 62, 3, 'Old'),
(49, 127, 4, 62, 3, 'Old'),
(50, 128, 4, 62, 3, 'Old'),
(51, 129, 4, 62, 3, 'Old'),
(52, 130, 4, 62, 3, 'Old'),
(53, 131, 4, 62, 3, 'Old'),
(54, 132, 4, 62, 3, 'Old'),
(56, 133, 4, 62, 3, 'Old'),
(57, 134, 3, 62, 3, 'Old'),
(58, 135, 4, 62, 3, 'Old'),
(59, 136, 4, 62, 3, 'Old'),
(60, 142, 4, 62, 3, 'Old'),
(61, 23, 2, 62, 5, 'Old'),
(62, 26, 2, 62, 5, 'Old'),
(63, 28, 3, 62, 5, 'Old'),
(64, 143, 3, 62, 5, 'Old'),
(65, 41, 4, 62, 5, 'Old'),
(66, 144, 1, 62, 5, 'Old'),
(67, 46, 4, 62, 5, 'Old'),
(68, 35, 4, 62, 5, 'Old'),
(69, 44, 4, 62, 5, 'Old'),
(70, 32, 4, 62, 5, 'Old'),
(71, 45, 4, 62, 5, 'Old'),
(72, 40, 4, 62, 5, 'Old'),
(73, 31, 4, 62, 5, 'Old'),
(74, 39, 4, 62, 5, 'Old'),
(75, 145, 4, 62, 5, 'Old'),
(76, 42, 4, 62, 5, 'Old'),
(77, 43, 4, 62, 5, 'Old'),
(78, 29, 4, 62, 5, 'Old'),
(79, 38, 4, 62, 5, 'Old'),
(80, 34, 4, 62, 5, 'Old'),
(81, 37, 4, 62, 5, 'Old'),
(82, 33, 4, 62, 5, 'Old'),
(83, 59, 5, 62, 5, 'Old'),
(84, 57, 5, 62, 5, 'Old'),
(85, 63, 5, 62, 5, 'Old'),
(86, 53, 5, 62, 5, 'Old'),
(87, 49, 5, 62, 5, 'Old'),
(88, 61, 5, 62, 5, 'Old'),
(89, 55, 5, 62, 5, 'Old'),
(90, 47, 5, 62, 5, 'Old'),
(91, 54, 5, 62, 5, 'Old'),
(92, 51, 5, 62, 5, 'Old'),
(93, 48, 5, 62, 5, 'Old'),
(94, 52, 5, 62, 5, 'Old'),
(95, 62, 5, 62, 5, 'Old'),
(96, 58, 5, 62, 5, 'Old'),
(97, 60, 5, 62, 5, 'Old'),
(98, 56, 5, 62, 5, 'Old'),
(99, 64, 5, 62, 5, 'Old'),
(100, 147, 4, 62, 4, 'Old');

-- --------------------------------------------------------

--
-- Table structure for table `stud_fee`
--

CREATE TABLE `stud_fee` (
  `sfID` int(11) NOT NULL,
  `studID` int(11) NOT NULL,
  `feeID` int(11) NOT NULL,
  `payable` decimal(10,2) NOT NULL,
  `receivable` decimal(10,2) NOT NULL,
  `tsize` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stud_fee`
--

INSERT INTO `stud_fee` (`sfID`, `studID`, `feeID`, `payable`, `receivable`, `tsize`) VALUES
(1, 86, 1, '100.00', '0.00', ''),
(2, 87, 1, '100.00', '0.00', ''),
(3, 88, 1, '100.00', '0.00', ''),
(4, 89, 1, '100.00', '0.00', ''),
(5, 90, 1, '100.00', '0.00', ''),
(6, 91, 1, '100.00', '0.00', ''),
(7, 92, 1, '100.00', '0.00', ''),
(8, 93, 1, '100.00', '0.00', ''),
(9, 94, 1, '100.00', '0.00', ''),
(10, 95, 1, '100.00', '0.00', ''),
(11, 96, 1, '100.00', '0.00', ''),
(12, 97, 1, '100.00', '0.00', ''),
(13, 98, 1, '100.00', '0.00', ''),
(14, 100, 1, '100.00', '0.00', ''),
(15, 101, 1, '100.00', '0.00', ''),
(16, 102, 1, '100.00', '0.00', ''),
(17, 103, 1, '100.00', '0.00', ''),
(18, 104, 1, '100.00', '0.00', ''),
(19, 105, 1, '100.00', '0.00', ''),
(20, 106, 1, '100.00', '0.00', ''),
(21, 107, 1, '100.00', '0.00', ''),
(22, 108, 1, '100.00', '0.00', ''),
(23, 122, 1, '100.00', '0.00', ''),
(24, 134, 1, '100.00', '0.00', ''),
(25, 99, 1, '100.00', '0.00', ''),
(26, 109, 1, '0.00', '0.00', 'M'),
(27, 110, 1, '100.00', '0.00', ''),
(28, 111, 1, '0.00', '0.00', 'M'),
(29, 112, 1, '100.00', '0.00', ''),
(30, 113, 1, '100.00', '0.00', ''),
(31, 114, 1, '100.00', '0.00', ''),
(32, 115, 1, '100.00', '0.00', ''),
(33, 116, 1, '100.00', '0.00', ''),
(34, 117, 1, '0.00', '0.00', 'M'),
(35, 118, 1, '100.00', '0.00', ''),
(36, 119, 1, '100.00', '0.00', ''),
(37, 120, 1, '100.00', '0.00', ''),
(38, 121, 1, '0.00', '0.00', 'M'),
(39, 123, 1, '100.00', '0.00', ''),
(40, 124, 1, '100.00', '0.00', ''),
(41, 125, 1, '100.00', '0.00', ''),
(42, 126, 1, '100.00', '0.00', ''),
(43, 127, 1, '0.00', '0.00', 'M'),
(44, 128, 1, '100.00', '0.00', ''),
(45, 129, 1, '0.00', '0.00', 'M'),
(46, 130, 1, '100.00', '0.00', ''),
(47, 131, 1, '0.00', '0.00', 'M'),
(48, 132, 1, '0.00', '0.00', 'M'),
(49, 133, 1, '100.00', '0.00', ''),
(50, 135, 1, '0.00', '0.00', 'M'),
(51, 136, 1, '0.00', '0.00', 'M'),
(52, 142, 1, '100.00', '0.00', ''),
(53, 147, 1, '100.00', '0.00', ''),
(54, 144, 1, '100.00', '0.00', ''),
(55, 23, 1, '100.00', '0.00', ''),
(56, 26, 1, '100.00', '0.00', ''),
(57, 27, 1, '100.00', '0.00', ''),
(58, 28, 1, '100.00', '0.00', ''),
(59, 143, 1, '100.00', '0.00', ''),
(60, 29, 1, '100.00', '0.00', ''),
(61, 31, 1, '100.00', '0.00', ''),
(62, 32, 1, '100.00', '0.00', ''),
(63, 33, 1, '100.00', '0.00', ''),
(64, 34, 1, '100.00', '0.00', ''),
(65, 35, 1, '100.00', '0.00', ''),
(66, 37, 1, '100.00', '0.00', ''),
(67, 38, 1, '100.00', '0.00', ''),
(68, 39, 1, '100.00', '0.00', ''),
(69, 40, 1, '100.00', '0.00', ''),
(70, 41, 1, '100.00', '0.00', ''),
(71, 42, 1, '100.00', '0.00', ''),
(72, 43, 1, '100.00', '0.00', ''),
(73, 44, 1, '100.00', '0.00', ''),
(74, 45, 1, '100.00', '0.00', ''),
(75, 46, 1, '100.00', '0.00', ''),
(76, 145, 1, '100.00', '0.00', ''),
(77, 47, 1, '100.00', '0.00', ''),
(78, 48, 1, '100.00', '0.00', ''),
(79, 49, 1, '100.00', '0.00', ''),
(80, 51, 1, '100.00', '0.00', ''),
(81, 52, 1, '100.00', '0.00', ''),
(82, 53, 1, '100.00', '0.00', ''),
(83, 54, 1, '100.00', '0.00', ''),
(84, 55, 1, '100.00', '0.00', ''),
(85, 56, 1, '100.00', '0.00', ''),
(86, 57, 1, '100.00', '0.00', ''),
(87, 58, 1, '100.00', '0.00', ''),
(88, 59, 1, '100.00', '0.00', ''),
(89, 60, 1, '100.00', '0.00', ''),
(90, 61, 1, '100.00', '0.00', ''),
(91, 62, 1, '100.00', '0.00', ''),
(92, 63, 1, '100.00', '0.00', ''),
(93, 64, 1, '100.00', '0.00', ''),
(94, 86, 2, '750.00', '0.00', ''),
(95, 87, 2, '750.00', '0.00', ''),
(96, 88, 2, '750.00', '0.00', ''),
(97, 89, 2, '750.00', '0.00', ''),
(98, 90, 2, '750.00', '0.00', ''),
(99, 91, 2, '750.00', '0.00', ''),
(100, 92, 2, '750.00', '0.00', ''),
(101, 93, 2, '750.00', '0.00', ''),
(102, 94, 2, '750.00', '0.00', ''),
(103, 95, 2, '750.00', '0.00', ''),
(104, 96, 2, '750.00', '0.00', ''),
(105, 97, 2, '750.00', '0.00', ''),
(106, 98, 2, '750.00', '0.00', ''),
(107, 100, 2, '0.00', '0.00', 'M'),
(108, 101, 2, '750.00', '0.00', ''),
(109, 102, 2, '750.00', '0.00', ''),
(110, 103, 2, '750.00', '0.00', ''),
(111, 104, 2, '750.00', '0.00', ''),
(112, 105, 2, '750.00', '0.00', ''),
(113, 106, 2, '750.00', '0.00', ''),
(114, 107, 2, '750.00', '0.00', ''),
(115, 108, 2, '750.00', '0.00', ''),
(116, 122, 2, '750.00', '0.00', ''),
(117, 134, 2, '0.00', '0.00', 'M'),
(118, 99, 2, '750.00', '0.00', ''),
(119, 109, 2, '750.00', '0.00', ''),
(120, 110, 2, '0.00', '0.00', 'M'),
(121, 111, 2, '0.00', '0.00', 'M'),
(122, 112, 2, '0.00', '0.00', 'M'),
(123, 113, 2, '0.00', '0.00', 'M'),
(124, 114, 2, '750.00', '0.00', ''),
(125, 115, 2, '0.00', '0.00', 'M'),
(126, 116, 2, '0.00', '0.00', 'M'),
(127, 117, 2, '0.00', '0.00', 'M'),
(128, 118, 2, '0.00', '0.00', 'M'),
(129, 119, 2, '0.00', '0.00', 'M'),
(130, 120, 2, '0.00', '0.00', 'M'),
(131, 121, 2, '0.00', '0.00', 'M'),
(132, 123, 2, '0.00', '0.00', 'M'),
(133, 124, 2, '0.00', '0.00', 'M'),
(134, 125, 2, '0.00', '0.00', 'M'),
(135, 126, 2, '0.00', '0.00', 'M'),
(136, 127, 2, '0.00', '0.00', 'M'),
(137, 128, 2, '0.00', '0.00', 'M'),
(138, 129, 2, '0.00', '0.00', 'M'),
(139, 130, 2, '750.00', '0.00', ''),
(140, 131, 2, '750.00', '0.00', ''),
(141, 132, 2, '0.00', '0.00', 'M'),
(142, 133, 2, '0.00', '0.00', 'M'),
(143, 135, 2, '750.00', '0.00', ''),
(144, 136, 2, '0.00', '0.00', 'M'),
(145, 142, 2, '750.00', '0.00', ''),
(146, 147, 2, '750.00', '0.00', ''),
(147, 144, 2, '750.00', '0.00', ''),
(148, 23, 2, '750.00', '0.00', ''),
(149, 26, 2, '750.00', '0.00', ''),
(150, 27, 2, '750.00', '0.00', ''),
(151, 28, 2, '750.00', '0.00', ''),
(152, 143, 2, '750.00', '0.00', ''),
(153, 29, 2, '750.00', '0.00', ''),
(154, 31, 2, '750.00', '0.00', ''),
(155, 32, 2, '750.00', '0.00', ''),
(156, 33, 2, '750.00', '0.00', ''),
(157, 34, 2, '750.00', '0.00', ''),
(158, 35, 2, '750.00', '0.00', ''),
(159, 37, 2, '750.00', '0.00', ''),
(160, 38, 2, '750.00', '0.00', ''),
(161, 39, 2, '750.00', '0.00', ''),
(162, 40, 2, '750.00', '0.00', ''),
(163, 41, 2, '750.00', '0.00', ''),
(164, 42, 2, '750.00', '0.00', ''),
(165, 43, 2, '750.00', '0.00', ''),
(166, 44, 2, '750.00', '0.00', ''),
(167, 45, 2, '750.00', '0.00', ''),
(168, 46, 2, '750.00', '0.00', ''),
(169, 145, 2, '750.00', '0.00', ''),
(170, 47, 2, '750.00', '0.00', ''),
(171, 48, 2, '750.00', '0.00', ''),
(172, 49, 2, '750.00', '0.00', ''),
(173, 51, 2, '750.00', '0.00', ''),
(174, 52, 2, '750.00', '0.00', ''),
(175, 53, 2, '750.00', '0.00', ''),
(176, 54, 2, '750.00', '0.00', ''),
(177, 55, 2, '750.00', '0.00', ''),
(178, 56, 2, '750.00', '0.00', ''),
(179, 57, 2, '750.00', '0.00', ''),
(180, 58, 2, '750.00', '0.00', ''),
(181, 59, 2, '750.00', '0.00', ''),
(182, 60, 2, '750.00', '0.00', ''),
(183, 61, 2, '750.00', '0.00', ''),
(184, 62, 2, '750.00', '0.00', ''),
(185, 63, 2, '750.00', '0.00', ''),
(186, 64, 2, '750.00', '0.00', ''),
(187, 99, 3, '2500.00', '0.00', ''),
(188, 109, 3, '2500.00', '0.00', ''),
(189, 110, 3, '2500.00', '0.00', ''),
(190, 111, 3, '2500.00', '0.00', ''),
(191, 112, 3, '2500.00', '0.00', ''),
(192, 113, 3, '2500.00', '0.00', ''),
(193, 114, 3, '0.00', '0.00', 'M'),
(194, 115, 3, '2500.00', '0.00', ''),
(195, 116, 3, '2500.00', '0.00', ''),
(196, 117, 3, '2500.00', '0.00', ''),
(197, 118, 3, '2500.00', '0.00', ''),
(198, 119, 3, '2500.00', '0.00', ''),
(199, 120, 3, '2500.00', '0.00', ''),
(200, 121, 3, '0.00', '0.00', 'M'),
(201, 123, 3, '2500.00', '0.00', ''),
(202, 124, 3, '2500.00', '0.00', ''),
(203, 125, 3, '2500.00', '0.00', ''),
(204, 126, 3, '2500.00', '0.00', ''),
(205, 127, 3, '2500.00', '0.00', ''),
(206, 128, 3, '2500.00', '0.00', ''),
(207, 129, 3, '2500.00', '0.00', ''),
(208, 130, 3, '2500.00', '0.00', ''),
(209, 131, 3, '2500.00', '0.00', ''),
(210, 132, 3, '2500.00', '0.00', ''),
(211, 133, 3, '0.00', '0.00', 'M'),
(212, 135, 3, '2500.00', '0.00', ''),
(213, 136, 3, '2500.00', '0.00', ''),
(214, 142, 3, '2500.00', '0.00', ''),
(215, 99, 6, '2500.00', '0.00', ''),
(216, 109, 6, '2500.00', '0.00', ''),
(217, 110, 6, '0.00', '0.00', 'M'),
(218, 111, 6, '0.00', '0.00', 'M'),
(219, 112, 6, '0.00', '0.00', 'M'),
(220, 113, 6, '0.00', '0.00', 'M'),
(221, 114, 6, '0.00', '0.00', 'M'),
(222, 115, 6, '0.00', '0.00', 'M'),
(223, 116, 6, '2500.00', '0.00', ''),
(224, 117, 6, '0.00', '0.00', 'M'),
(225, 118, 6, '0.00', '0.00', 'M'),
(226, 119, 6, '0.00', '0.00', 'M'),
(227, 120, 6, '0.00', '0.00', 'M'),
(228, 121, 6, '0.00', '0.00', 'M'),
(229, 123, 6, '0.00', '0.00', 'M'),
(230, 124, 6, '0.00', '0.00', 'M'),
(231, 125, 6, '0.00', '0.00', 'M'),
(232, 126, 6, '0.00', '0.00', 'M'),
(233, 127, 6, '0.00', '0.00', 'M'),
(234, 128, 6, '0.00', '0.00', 'M'),
(235, 129, 6, '2500.00', '0.00', ''),
(236, 130, 6, '2500.00', '0.00', ''),
(237, 131, 6, '0.00', '0.00', 'M'),
(238, 132, 6, '0.00', '0.00', 'M'),
(239, 133, 6, '0.00', '0.00', 'M'),
(240, 135, 6, '2500.00', '0.00', ''),
(241, 136, 6, '0.00', '0.00', 'M'),
(242, 142, 6, '2500.00', '0.00', ''),
(243, 99, 7, '2500.00', '0.00', ''),
(244, 109, 7, '2500.00', '0.00', ''),
(245, 110, 7, '0.00', '0.00', 'M'),
(246, 111, 7, '0.00', '0.00', 'M'),
(247, 112, 7, '0.00', '0.00', 'M'),
(248, 113, 7, '0.00', '0.00', 'M'),
(249, 114, 7, '0.00', '0.00', 'M'),
(250, 115, 7, '0.00', '0.00', 'M'),
(251, 116, 7, '2500.00', '0.00', ''),
(252, 117, 7, '0.00', '0.00', 'M'),
(253, 118, 7, '0.00', '0.00', 'M'),
(254, 119, 7, '0.00', '0.00', 'M'),
(255, 120, 7, '0.00', '0.00', 'M'),
(256, 121, 7, '0.00', '0.00', 'M'),
(257, 123, 7, '0.00', '0.00', 'M'),
(258, 124, 7, '0.00', '0.00', 'M'),
(259, 125, 7, '0.00', '0.00', 'M'),
(260, 126, 7, '0.00', '0.00', 'M'),
(261, 127, 7, '0.00', '0.00', 'M'),
(262, 128, 7, '0.00', '0.00', 'M'),
(263, 129, 7, '2500.00', '0.00', ''),
(264, 130, 7, '2500.00', '0.00', ''),
(265, 131, 7, '0.00', '0.00', 'M'),
(266, 132, 7, '0.00', '0.00', 'M'),
(267, 133, 7, '2500.00', '0.00', ''),
(268, 135, 7, '2500.00', '0.00', ''),
(269, 136, 7, '0.00', '0.00', 'M'),
(270, 142, 7, '2500.00', '0.00', ''),
(271, 134, 7, '0.00', '0.00', 'M'),
(272, 134, 6, '0.00', '0.00', 'M'),
(273, 121, 5, '800.00', '0.00', ''),
(274, 100, 3, '0.00', '0.00', 'M'),
(275, 100, 7, '0.00', '0.00', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subID` int(11) NOT NULL,
  `prosID` int(11) NOT NULL,
  `yearID` int(11) NOT NULL,
  `semID` int(11) NOT NULL,
  `specID` int(11) NOT NULL,
  `subCode` varchar(20) NOT NULL,
  `subDesc` varchar(70) NOT NULL,
  `units` int(11) NOT NULL,
  `total_units` int(11) NOT NULL,
  `type` enum('lec','lab') NOT NULL,
  `nonSub_pre` varchar(15) NOT NULL,
  `id` int(11) NOT NULL,
  `is_counted` enum('yes','no') NOT NULL,
  `hrs_per_wk` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subID`, `prosID`, `yearID`, `semID`, `specID`, `subCode`, `subDesc`, `units`, `total_units`, `type`, `nonSub_pre`, `id`, `is_counted`, `hrs_per_wk`) VALUES
(1, 6, 1, 1, 12, 'ENG111', 'Purposive Communication', 3, 3, 'lec', '', 274, 'yes', '03:00:00'),
(2, 6, 1, 1, 12, 'MAT1 12', 'Remedial Mathematics (Pre-Calculus)', 3, 3, 'lec', 'for non-STEM', 381, 'yes', '03:00:00'),
(3, 6, 1, 1, 12, 'Physics111', 'General Physics', 3, 4, 'lec', 'for non-STEM', 923, 'yes', '03:00:00'),
(4, 6, 1, 1, 12, 'Physics111', 'General Physics', 1, 4, 'lab', 'for non-STEM', 923, 'yes', '03:00:00'),
(5, 6, 1, 1, 12, 'MAT113', 'Mathematics in the Modern World', 3, 3, 'lec', '', 439, 'yes', '03:00:00'),
(6, 6, 1, 1, 12, 'Psych111', 'Understanding the Self', 3, 3, 'lec', '', 682, 'yes', '03:00:00'),
(7, 6, 1, 1, 13, 'IT-Com111', 'Introduction to Computing', 2, 3, 'lec', '', 279, 'yes', '03:00:00'),
(8, 6, 1, 1, 13, 'IT-Com111', 'Introduction to Computing', 1, 3, 'lab', '', 279, 'yes', '03:00:00'),
(9, 6, 1, 1, 13, 'IT-Prog111', 'Fundamentals of Programming', 2, 3, 'lec', '', 965, 'yes', '03:00:00'),
(10, 6, 1, 1, 13, 'IT-Prog111', 'Fundamentals of Programming', 1, 3, 'lab', '', 965, 'yes', '03:00:00'),
(11, 6, 1, 1, 14, 'NSTP111', 'National Service Training Prog1', 3, 3, 'lec', '', 831, 'yes', '03:00:00'),
(12, 6, 1, 1, 14, 'PE111', 'Physical Fitness 1', 2, 2, 'lec', '', 647, 'yes', '03:00:00'),
(13, 6, 1, 2, 15, 'MAT121', 'Discrete Structure', 3, 3, 'lec', '', 257, 'yes', '03:00:00'),
(14, 6, 1, 2, 12, 'STS121', 'Science, Technology & Society', 3, 3, 'lec', '', 869, 'yes', '03:00:00'),
(15, 6, 1, 2, 12, 'Socio121', 'Social Issues & Professional Practice', 3, 3, 'lec', '', 348, 'yes', '03:00:00'),
(16, 6, 1, 2, 13, 'IT-Prog121', 'Computer Programming 2', 2, 3, 'lec', '', 645, 'yes', '03:00:00'),
(17, 6, 1, 2, 13, 'IT-Prog121', 'Computer Programming 2', 1, 3, 'lab', '', 645, 'yes', '03:00:00'),
(18, 6, 1, 2, 15, 'IT-HC1211', 'Introduction to Human Computer Interaction', 2, 3, 'lec', '', 265, 'yes', '03:00:00'),
(19, 6, 1, 2, 15, 'IT-HC1211', 'Introduction to Human Computer Interaction', 1, 3, 'lab', '', 265, 'yes', '03:00:00'),
(20, 6, 1, 2, 15, 'IT-DiGiLog121', 'Digital Logic Design', 3, 3, 'lec', '', 543, 'yes', '03:00:00'),
(21, 6, 1, 2, 12, 'Hist121', 'Readings in Philippine History', 3, 3, 'lec', '', 291, 'yes', '03:00:00'),
(22, 6, 1, 2, 14, 'NSTP121', 'National Service Training Prog2', 3, 3, 'lec', '', 193, 'yes', '03:00:00'),
(23, 6, 1, 2, 14, 'PE121', 'Rhythmic Activities', 2, 2, 'lec', '', 964, 'yes', '03:00:00'),
(24, 6, 2, 1, 13, 'IT-DBms211', 'Fundamentals of Database Systems', 2, 3, 'lec', '', 495, 'yes', '03:00:00'),
(25, 6, 2, 1, 13, 'IT-DBms211', 'Fundamentals of Database Systems', 1, 3, 'lab', '', 495, 'yes', '03:00:00'),
(26, 6, 2, 1, 16, 'IT-Ele211', 'Object Oriented Programming', 2, 3, 'lec', '', 761, 'yes', '03:00:00'),
(27, 6, 2, 1, 16, 'IT-Ele211', 'Object Oriented Programming', 1, 3, 'lab', '', 761, 'yes', '03:00:00'),
(28, 6, 2, 1, 16, 'IT-Ele212', 'Platform Technologies', 2, 3, 'lec', '', 324, 'yes', '03:00:00'),
(29, 6, 2, 1, 16, 'IT-Ele212', 'Platform Technologies', 1, 3, 'lab', '', 324, 'yes', '03:00:00'),
(30, 6, 2, 1, 12, 'Hum211', 'Art Appreciation', 3, 3, 'lec', '', 852, 'yes', '03:00:00'),
(31, 6, 2, 1, 12, 'Socio211', 'The Contemporary World', 3, 3, 'lec', '', 392, 'yes', '03:00:00'),
(32, 6, 2, 1, 13, 'IT-Datstruct1202', 'Data Structure & Algorithm Analysis', 2, 3, 'lec', '', 765, 'yes', '03:00:00'),
(33, 6, 2, 1, 13, 'IT-Datstruct1202', 'Data Structure & Algorithm Analysis', 1, 3, 'lab', '', 765, 'yes', '03:00:00'),
(34, 6, 2, 1, 12, 'Filipino211', 'Komonikasyon sa Akademikong Filipino', 3, 3, 'lec', '', 298, 'yes', '03:00:00'),
(35, 6, 2, 1, 14, 'PE211', 'Individual Sports', 2, 2, 'lec', '', 352, 'yes', '03:00:00'),
(36, 6, 2, 1, 12, 'Ethics211', 'Ethics', 3, 3, 'lec', '', 659, 'yes', '03:00:00'),
(37, 6, 2, 2, 12, 'Filipino221', 'Panitikan', 3, 3, 'lec', '', 517, 'yes', '03:00:00'),
(38, 6, 2, 2, 13, 'IT-DBms221', 'Information Management 2', 2, 3, 'lec', '', 615, 'yes', '03:00:00'),
(39, 6, 2, 2, 13, 'IT-DBms221', 'Information Management 2', 1, 3, 'lab', '', 615, 'yes', '03:00:00'),
(40, 6, 2, 2, 15, 'IT-IntProg221', 'Integrative Programming & Technologies 1', 2, 3, 'lec', '', 123, 'yes', '03:00:00'),
(41, 6, 2, 2, 15, 'IT-IntProg221', 'Integrative Programming & Technologies 1', 1, 3, 'lab', '', 123, 'yes', '03:00:00'),
(42, 6, 2, 2, 15, 'IT-Netwrk221', 'Networking 2', 2, 3, 'lec', '#REF!', 643, 'yes', '03:00:00'),
(43, 6, 2, 2, 15, 'IT-Netwrk221', 'Networking 2', 1, 3, 'lab', '#REF!', 643, 'yes', '03:00:00'),
(44, 6, 2, 2, 15, 'IT-SAD221', 'Systems Analysis & Design', 3, 3, 'lec', '', 376, 'yes', '03:00:00'),
(45, 6, 2, 2, 15, 'IT-NetWrk201', 'Networking 1', 2, 3, 'lec', '', 672, 'yes', '03:00:00'),
(46, 6, 2, 2, 15, 'IT-NetWrk201', 'Networking 1', 1, 3, 'lab', '', 672, 'yes', '03:00:00'),
(47, 6, 2, 2, 12, 'Entrep221', 'The Entrepreneurial Mind', 3, 3, 'lec', '', 741, 'yes', '03:00:00'),
(48, 6, 2, 2, 15, 'IT-QM221', 'Quantitative Methods (incl. Modelling & Simulation)', 3, 3, 'lec', '', 548, 'yes', '03:00:00'),
(49, 6, 2, 2, 14, 'PE221', 'Team Sports', 2, 2, 'lec', '', 384, 'yes', '03:00:00'),
(50, 6, 3, 1, 15, 'IT-ACTA311', 'Computer Accounting', 3, 3, 'lec', '', 465, 'yes', '03:00:00'),
(51, 6, 3, 1, 15, 'IT-SIA311', 'System Integration & Architecture1', 2, 3, 'lec', '', 462, 'yes', '03:00:00'),
(52, 6, 3, 1, 15, 'IT-SIA311', 'System Integration & Architecture1', 1, 3, 'lab', '', 462, 'yes', '03:00:00'),
(53, 6, 3, 1, 15, 'IT-IAS311', 'Information Assurance & Security 1', 2, 3, 'lec', '', 173, 'yes', '03:00:00'),
(54, 6, 3, 1, 15, 'IT-IAS311', 'Information Assurance & Security 1', 1, 3, 'lab', '', 173, 'yes', '03:00:00'),
(55, 6, 3, 1, 15, 'IT-APSDEV311', 'Application Devt & Emerging Technologies', 2, 3, 'lec', '', 271, 'yes', '03:00:00'),
(56, 6, 3, 1, 15, 'IT-APSDEV311', 'Application Devt & Emerging Technologies', 1, 3, 'lab', '', 271, 'yes', '03:00:00'),
(57, 6, 3, 1, 15, 'IT-Comotna311', 'Methods of Research in Computing', 3, 3, 'lec', '', 473, 'yes', '03:00:00'),
(58, 6, 3, 1, 15, 'IT-PL301', 'Programming Languages', 2, 3, 'lec', '', 136, 'yes', '03:00:00'),
(59, 6, 3, 1, 15, 'IT-PL301', 'Programming Languages', 1, 3, 'lab', '', 136, 'yes', '03:00:00'),
(60, 6, 3, 1, 12, 'Filipino311', 'Masining na Pagpapahayag', 3, 3, 'lec', '', 796, 'yes', '03:00:00'),
(61, 6, 3, 1, 16, 'IT-Free-Ele311', 'Business Analytics', 3, 3, 'lec', '', 541, 'yes', '03:00:00'),
(62, 6, 3, 2, 16, 'IT-Free-Ele321', 'Animation Technology & 2D', 2, 3, 'lec', '', 542, 'yes', '03:00:00'),
(63, 6, 3, 2, 16, 'IT-Free-Ele321', 'Animation Technology & 2D', 1, 3, 'lab', '', 542, 'yes', '03:00:00'),
(64, 6, 3, 2, 15, 'IT-IAS321', 'Information Assurance & Security', 2, 3, 'lec', '', 243, 'yes', '03:00:00'),
(65, 6, 3, 2, 15, 'IT-IAS321', 'Information Assurance & Security', 1, 3, 'lab', '', 243, 'yes', '03:00:00'),
(66, 6, 3, 2, 16, 'IT-ELE321', 'Integrative Programming & Technologies', 2, 3, 'lec', '', 976, 'yes', '03:00:00'),
(67, 6, 3, 2, 16, 'IT-ELE321', 'Integrative Programming & Technologies', 1, 3, 'lab', '', 976, 'yes', '03:00:00'),
(68, 6, 3, 2, 16, 'IT-ELE322', 'Intelligent Systems', 2, 3, 'lec', '', 978, 'yes', '03:00:00'),
(69, 6, 3, 2, 16, 'IT-ELE322', 'Intelligent Systems', 1, 3, 'lab', '', 978, 'yes', '03:00:00'),
(70, 6, 3, 2, 15, 'IT-Pro321', 'IT Proposal', 3, 3, 'lec', '', 613, 'yes', '03:00:00'),
(71, 6, 3, 2, 15, 'IT-Techno301', 'Technopreneurship', 3, 3, 'lec', '', 295, 'yes', '03:00:00'),
(72, 6, 3, 2, 16, 'IT-Free-Ele-322', 'Analytics Modelling: Techniques and Tools', 3, 3, 'lec', '', 763, 'yes', '03:00:00'),
(73, 6, 3, 2, 12, 'Rizal321', 'Life & Works of Dr. Jose Rizal', 3, 3, 'lec', '', 347, 'yes', '03:00:00'),
(74, 6, 3, 3, 15, 'IT-PRAC401', 'PRACTICUM/OJT', 9, 9, 'lec', '', 438, 'yes', '03:00:00'),
(75, 6, 4, 1, 13, 'IT-Free-ELe411', '3D Animation and Modelling', 2, 3, 'lec', '', 651, 'yes', '03:00:00'),
(76, 6, 4, 1, 13, 'IT-Free-ELe411', '3D Animation and Modelling', 1, 3, 'lab', '', 651, 'yes', '03:00:00'),
(77, 6, 4, 1, 15, 'IT-SysAd411', 'System Administration & Maintenance', 3, 3, 'lec', '', 218, 'yes', '03:00:00'),
(78, 6, 4, 1, 12, 'IT-Capstone411', 'Capstone Project 1', 9, 9, 'lec', '', 794, 'yes', '03:00:00'),
(79, 6, 4, 1, 16, 'IT-ELe411', 'Web Systems Technologies', 2, 3, 'lec', '', 321, 'yes', '03:00:00'),
(80, 6, 4, 1, 16, 'IT-ELe411', 'Web Systems Technologies', 1, 3, 'lab', '', 321, 'yes', '03:00:00'),
(81, 6, 4, 1, 12, 'IT-CertExam411', 'Philnits/Microsoft/TESDA', 3, 3, 'lec', '', 158, 'yes', '03:00:00'),
(82, 6, 4, 2, 15, 'IT-Capstone421', 'Capstone Project 2', 9, 9, 'lec', '', 329, 'yes', '03:00:00'),
(83, 6, 4, 2, 16, 'IT-ELE-421', 'Embedded Systems', 2, 3, 'lec', '', 185, 'yes', '03:00:00'),
(84, 6, 4, 2, 16, 'IT-ELE-421', 'Embedded Systems', 1, 3, 'lab', '', 185, 'yes', '03:00:00'),
(85, 6, 4, 2, 15, 'ITSeminar421', 'IT Seminars/Fieldtrips', 3, 3, 'lec', '', 714, 'yes', '03:00:00'),
(86, 8, 1, 1, 17, 'ENG111', 'Purposive Communication', 3, 3, 'lec', '', 357, 'yes', '03:00:00'),
(87, 8, 1, 1, 17, 'MAT112', 'Remedial Mathematics (Pre-Calculus)', 3, 3, 'lec', 'for non-STEM', 329, 'yes', '03:00:00'),
(88, 7, 1, 1, 32, 'ENG111', 'Purposive Communication', 3, 3, 'lec', '', 157, 'yes', '03:00:00'),
(89, 8, 1, 1, 17, 'Physics111', 'General Physics', 3, 4, 'lec', 'for non-STEM', 845, 'yes', '03:00:00'),
(90, 8, 1, 1, 17, 'Physics111', 'General Physics', 3, 4, 'lab', 'for non-STEM', 845, 'yes', '03:00:00'),
(91, 8, 1, 1, 17, 'MAT113', 'Mathematics in the Modern World', 3, 3, 'lec', '', 425, 'yes', '03:00:00'),
(92, 8, 1, 1, 17, 'Psych111', 'Understanding the Self', 3, 3, 'lec', '', 876, 'yes', '03:00:00'),
(93, 7, 1, 1, 32, 'MAT112', 'Remedial Mathematics (Pre-Calculus)', 3, 3, 'lec', 'for non-STEM', 942, 'yes', '03:00:00'),
(94, 8, 1, 1, 20, 'CpE-CompDs111', 'Computer Engineering as a Discipline', 3, 1, 'lec', '', 731, 'yes', '03:00:00'),
(95, 7, 1, 1, 32, 'Physics111', 'General Physics', 3, 4, 'lec', 'for non-STEM', 943, 'yes', '03:00:00'),
(96, 7, 1, 1, 32, 'Physics111', 'General Physics', 1, 4, 'lab', 'for non-STEM', 943, 'yes', '03:00:00'),
(97, 4, 1, 1, 10, 'NSTP 1', 'National Service Training Program 1', 3, 3, 'lec', '', 619, 'yes', '03:00:00'),
(99, 7, 1, 1, 32, 'MAT113', 'Mathematics in the Modern World', 3, 3, 'lec', '', 751, 'yes', '03:00:00'),
(100, 8, 1, 1, 20, 'Chem111', 'Chemistry for Engineers', 3, 2, 'lec', '', 643, 'yes', '03:00:00'),
(101, 8, 1, 1, 20, 'Chem111', 'Chemistry for Engineers', 3, 2, 'lab', '', 643, 'yes', '03:00:00'),
(102, 7, 1, 1, 32, 'Psych111', 'Understanding the Self', 3, 3, 'lec', '', 584, 'yes', '03:00:00'),
(103, 8, 1, 1, 19, 'NSTP111', 'National Service Training Prog1', 3, 3, 'lec', '', 428, 'yes', '03:00:00'),
(104, 7, 1, 1, 33, 'CS-COM111', 'Introduction to Computing', 2, 3, 'lec', '', 214, 'yes', '03:00:00'),
(105, 7, 1, 1, 33, 'CS-COM111', 'Introduction to Computing', 1, 3, 'lab', '', 214, 'yes', '03:00:00'),
(106, 8, 1, 1, 19, 'PE111', 'Physical Fitness 1`', 2, 2, 'lec', '', 732, 'yes', '03:00:00'),
(108, 7, 1, 1, 33, 'CS-Prog111', 'Fundamentals of Programming', 2, 3, 'lec', '', 236, 'yes', '03:00:00'),
(109, 7, 1, 1, 33, 'CS-Prog111', 'Fundamentals of Programming', 1, 3, 'lab', '', 236, 'yes', '03:00:00'),
(110, 8, 1, 2, 17, 'STS121', 'Science, Technology & Society', 3, 3, 'lec', '', 281, 'yes', '03:00:00'),
(111, 7, 1, 1, 34, 'NSTP111', 'National Service Training Prog1', 3, 3, 'lec', '', 149, 'yes', '03:00:00'),
(112, 8, 1, 2, 21, 'Draft121', 'Technical Drafting', 3, 1, 'lec', '', 548, 'yes', '03:00:00'),
(113, 7, 1, 1, 34, 'PE111', 'Physical Fitness 1', 2, 2, 'lec', '', 349, 'yes', '03:00:00'),
(114, 8, 1, 2, 21, 'Opt121', 'Productivity Tools 1', 3, 2, 'lec', '', 395, 'yes', '03:00:00'),
(115, 8, 1, 2, 21, 'Opt121', 'Productivity Tools 1', 3, 2, 'lab', '', 395, 'yes', '03:00:00'),
(116, 8, 1, 2, 20, 'Cpe-Eco121', 'Engineering Economics', 3, 3, 'lec', '', 715, 'yes', '03:00:00'),
(117, 7, 1, 2, 36, 'MAT121', 'Discrete Structures 1', 3, 3, 'lec', '', 792, 'yes', '03:00:00'),
(118, 8, 1, 2, 17, 'Physics121', 'Physics for Engineers', 3, 2, 'lec', '', 653, 'yes', '03:00:00'),
(119, 8, 1, 2, 17, 'Physics121', 'Physics for Engineers', 3, 2, 'lab', '', 653, 'yes', '03:00:00'),
(120, 7, 1, 2, 32, 'STS121', 'Science, Technology & Society', 3, 3, 'lec', '', 896, 'yes', '03:00:00'),
(121, 8, 1, 2, 17, 'Hist121', 'Readings in Philippine History', 3, 3, 'lec', '', 986, 'yes', '03:00:00'),
(122, 8, 1, 2, 19, 'NSTP121', 'National Service Training Prog2', 3, 3, 'lec', '', 493, 'yes', '03:00:00'),
(123, 8, 1, 2, 17, 'MAT122', 'Calculus 1', 3, 3, 'lec', '', 318, 'yes', '03:00:00'),
(124, 3, 2, 2, 37, 'MATH 4', 'Probability & Statistics', 3, 3, 'lec', '', 217, 'yes', '03:00:00'),
(125, 8, 1, 2, 19, 'PE121', 'Rythmic Activities', 2, 2, 'lec', '', 861, 'yes', '03:00:00'),
(126, 7, 1, 2, 33, 'CS-Prog121', 'Computer Programming 2', 2, 3, 'lec', '', 712, 'yes', '03:00:00'),
(127, 7, 1, 2, 33, 'CS-Prog121', 'Computer Programming 2', 1, 3, 'lab', '', 712, 'yes', '03:00:00'),
(128, 7, 1, 2, 35, 'CS-HC1211', 'Introduction to Human Computer Interaction', 2, 3, 'lec', '', 187, 'yes', '03:00:00'),
(129, 7, 1, 2, 35, 'CS-HC1211', 'Introduction to Human Computer Interaction', 1, 3, 'lab', '', 187, 'yes', '03:00:00'),
(130, 8, 2, 3, 21, 'CpE-Datstruct201', 'Data Structures & Algorithm Analysis', 3, 4, 'lec', '', 562, 'yes', '03:00:00'),
(131, 8, 2, 3, 21, 'CpE-Datstruct201', 'Data Structures & Algorithm Analysis', 3, 4, 'lab', '', 562, 'yes', '03:00:00'),
(132, 8, 2, 3, 17, 'MAT201', 'Engineering  Data Analysis', 3, 3, 'lec', '', 956, 'yes', '03:00:00'),
(133, 8, 2, 3, 21, 'OPT201', 'Productivity Tools 2', 3, 2, 'lec', '', 279, 'yes', '03:00:00'),
(134, 8, 2, 3, 21, 'OPT201', 'Productivity Tools 2', 3, 2, 'lab', '', 279, 'yes', '03:00:00'),
(135, 8, 2, 1, 20, 'CAD211', 'Computer-Aided Drafting', 3, 2, 'lec', '', 746, 'yes', '03:00:00'),
(136, 8, 2, 1, 20, 'CAD211', 'Computer-Aided Drafting', 3, 2, 'lab', '', 746, 'yes', '03:00:00'),
(137, 8, 2, 1, 20, 'CpE-OOP211', 'Object-Oriented Programming', 3, 3, 'lec', '', 196, 'yes', '03:00:00'),
(138, 8, 2, 1, 20, 'CpE-OOP211', 'Object-Oriented Programming', 3, 3, 'lab', '', 196, 'yes', '03:00:00'),
(139, 8, 2, 1, 17, 'CpE-EC211', 'Fundamentals of Electric Circuits', 3, 3, 'lec', '', 487, 'yes', '03:00:00'),
(140, 8, 2, 1, 17, 'CpE-EC211', 'Fundamentals of Electric Circuits', 3, 3, 'lab', '', 487, 'yes', '03:00:00'),
(141, 8, 2, 1, 17, 'MAT211', 'Calculus 2', 3, 3, 'lec', '', 749, 'yes', '03:00:00'),
(142, 8, 2, 1, 17, 'Hum211', 'Art Appreciation', 3, 3, 'lec', '', 365, 'yes', '03:00:00'),
(143, 8, 2, 1, 17, 'Socio211', 'The Contemporary World', 3, 3, 'lec', '', 568, 'yes', '03:00:00'),
(144, 8, 2, 1, 17, 'Filipino211', 'Komonikasyon sa Akademikong Filipino', 3, 3, 'lec', '', 685, 'yes', '03:00:00'),
(145, 8, 2, 1, 19, 'PE211', 'Individual Sports', 2, 2, 'lec', '', 948, 'yes', '03:00:00'),
(146, 8, 2, 1, 21, 'Ethics211', 'Engineering Ethics', 3, 3, 'lec', '', 271, 'yes', '03:00:00'),
(147, 8, 2, 2, 17, 'Filipino221', 'Panitikan', 3, 3, 'lec', '', 623, 'yes', '03:00:00'),
(148, 8, 2, 2, 21, 'MAT221', 'Differential Equations', 3, 3, 'lec', '', 384, 'yes', '03:00:00'),
(149, 8, 2, 2, 20, 'CpE-EC221', 'Fundamentals of Electronic Circuits', 3, 3, 'lec', '', 321, 'yes', '03:00:00'),
(150, 8, 2, 2, 20, 'CpE-EC221', 'Fundamentals of Electronic Circuits', 3, 3, 'lab', '', 321, 'yes', '03:00:00'),
(151, 8, 2, 2, 20, 'Cpe-SoftD221', 'Software Design', 3, 3, 'lec', '', 324, 'yes', '03:00:00'),
(152, 8, 2, 2, 20, 'Cpe-SoftD221', 'Software Design', 3, 3, 'lab', '', 324, 'yes', '03:00:00'),
(153, 8, 2, 2, 20, 'CPE-OS221', 'Operating Systems', 3, 3, 'lec', '', 924, 'yes', '03:00:00'),
(154, 8, 2, 2, 20, 'CPE-OS221', 'Operating Systems', 3, 3, 'lab', '', 924, 'yes', '03:00:00'),
(155, 8, 2, 2, 17, 'CpE-NUM221', 'Numerical Methods', 3, 3, 'lec', '', 254, 'yes', '03:00:00'),
(156, 8, 2, 2, 20, 'ENVI-221', 'Environmental Engineering', 3, 3, 'lec', '', 179, 'yes', '03:00:00'),
(157, 8, 2, 2, 19, 'PE221', 'Team Sports', 2, 2, 'lec', '', 496, 'yes', '03:00:00'),
(158, 8, 2, 2, 20, 'CpE-TECEng221', 'Engineering Technologies in CpE', 3, 3, 'lec', '', 596, 'yes', '03:00:00'),
(159, 8, 3, 3, 20, 'CpE-Techno301', 'Technopreneurship', 3, 3, 'lec', '', 651, 'yes', '03:00:00'),
(160, 8, 3, 3, 20, 'CpE-Laws301', 'CpE Laws and Professional Practice', 3, 3, 'lec', '', 725, 'yes', '03:00:00'),
(161, 8, 3, 3, 20, 'CpE-HDL301', 'Introduction to HDL', 3, 2, 'lec', '', 251, 'yes', '03:00:00'),
(162, 8, 3, 3, 20, 'CpE-HDL301', 'Introduction to HDL', 3, 2, 'lab', '', 251, 'yes', '03:00:00'),
(163, 8, 3, 1, 20, 'CpE-SenS311', 'Fundamentals of Mixed Signals and', 3, 3, 'lec', '', 827, 'yes', '03:00:00'),
(164, 8, 3, 1, 20, 'CpE-SenS311', 'Fundamentals of Mixed Signals and', 3, 3, 'lab', '', 827, 'yes', '03:00:00'),
(165, 8, 3, 1, 20, 'CpE-LDes311', 'Logic Circuits and Design', 3, 3, 'lec', '', 165, 'yes', '03:00:00'),
(166, 8, 3, 1, 20, 'CpE-LDes311', 'Logic Circuits and Design', 3, 3, 'lab', '', 165, 'yes', '03:00:00'),
(167, 8, 3, 1, 20, 'CpE-Dat311', 'Data and Digital Communications', 3, 3, 'lec', '', 847, 'yes', '03:00:00'),
(168, 8, 3, 1, 20, 'CpE-Dat311', 'Data and Digital Communications', 3, 3, 'lab', '', 847, 'yes', '03:00:00'),
(169, 8, 3, 1, 20, 'CpE-Cont311', 'Feedback and Control Systems', 3, 3, 'lec', '', 274, 'yes', '03:00:00'),
(170, 8, 3, 1, 20, 'CpE-Cont311', 'Feedback and Control Systems', 3, 3, 'lab', '', 274, 'yes', '03:00:00'),
(171, 8, 3, 1, 20, 'CpE-Research311', 'CPE Research', 3, 3, 'lec', '', 638, 'yes', '03:00:00'),
(172, 8, 3, 1, 17, 'Filipino311', 'Masining na Pagpapahayag', 3, 3, 'lec', '', 135, 'yes', '03:00:00'),
(173, 8, 3, 1, 20, 'CpE-Ele311', 'Introduction to Robotics', 3, 3, 'lec', '', 246, 'yes', '03:00:00'),
(174, 8, 3, 1, 20, 'CpE-Ele311', 'Introduction to Robotics', 3, 3, 'lab', '', 246, 'yes', '03:00:00'),
(175, 8, 3, 1, 20, 'CAD311', 'Computer Engineering Drafting & Design', 3, 2, 'lec', '', 512, 'yes', '03:00:00'),
(176, 8, 3, 1, 20, 'CAD311', 'Computer Engineering Drafting & Design', 3, 2, 'lab', '', 512, 'yes', '03:00:00'),
(177, 8, 3, 2, 21, 'CpE-Safe321', 'Basic Occupational Health & Safety', 3, 3, 'lec', '', 613, 'yes', '03:00:00'),
(178, 8, 3, 2, 20, 'CpE-Netwrk321', 'Computer Network and Security', 3, 3, 'lec', '', 591, 'yes', '03:00:00'),
(179, 8, 3, 2, 20, 'CpE-Netwrk321', 'Computer Network and Security', 3, 3, 'lab', '', 591, 'yes', '03:00:00'),
(180, 8, 3, 2, 20, 'CpE-Micro321', 'Microprocessor', 3, 3, 'lec', '', 462, 'yes', '03:00:00'),
(181, 8, 3, 2, 20, 'CpE-Micro321', 'Microprocessor', 3, 3, 'lab', '', 462, 'yes', '03:00:00'),
(182, 8, 3, 2, 20, 'Cpe-Research321', 'Methods of Research', 3, 3, 'lec', '', 594, 'yes', '03:00:00'),
(183, 8, 3, 2, 20, 'Cpe-Mgnt321', 'Engineering Management', 3, 3, 'lec', '', 421, 'yes', '03:00:00'),
(184, 8, 3, 2, 20, 'Cpe-Ele321', 'Robot Dynamics', 3, 3, 'lec', '', 894, 'yes', '03:00:00'),
(185, 8, 3, 2, 20, 'Cpe-Ele321', 'Robot Dynamics', 3, 3, 'lab', '', 894, 'yes', '03:00:00'),
(186, 8, 3, 2, 20, 'Cpe-Free-Ele321', 'Business Analytics', 3, 3, 'lec', '', 375, 'yes', '03:00:00'),
(187, 8, 3, 2, 17, 'Rizal321', 'Life & Works of Dr. Jose Rizal', 3, 3, 'lec', '', 813, 'yes', '03:00:00'),
(188, 8, 3, 3, 17, 'CpE-PRAC401', 'Practicum/OJT', 6, 6, 'lec', '', 359, 'yes', '03:00:00'),
(189, 8, 4, 1, 20, 'CpE-AO411', 'Computer Architecture & Organization', 3, 3, 'lec', '', 713, 'yes', '03:00:00'),
(190, 8, 4, 1, 20, 'CpE-AO411', 'Computer Architecture & Organization', 3, 3, 'lab', '', 713, 'yes', '03:00:00'),
(191, 8, 4, 1, 20, 'CpE-ELE411', 'Robot Design', 3, 3, 'lec', '', 391, 'yes', '03:00:00'),
(192, 8, 4, 1, 20, 'CpE-ELE411', 'Robot Design', 3, 3, 'lab', '', 391, 'yes', '03:00:00'),
(193, 8, 4, 2, 20, 'CpE-ProjDe421', 'CpE Practice and Design 2', 6, 9, 'lec', '', 367, 'yes', '03:00:00'),
(194, 8, 4, 2, 20, 'CpE-ProjDe421', 'CpE Practice and Design 2', 3, 9, 'lab', '', 367, 'yes', '03:00:00'),
(195, 8, 4, 1, 20, 'CpE-DSP411', 'Digital Signal Processing', 3, 3, 'lec', '', 792, 'yes', '03:00:00'),
(196, 8, 4, 1, 20, 'CpE-DSP411', 'Digital Signal Processing', 3, 3, 'lab', '', 792, 'yes', '03:00:00'),
(197, 8, 4, 2, 18, 'CpE-Seminar421', 'CpE Seminars and Field Trips', 3, 3, 'lec', '', 839, 'yes', '03:00:00'),
(198, 8, 4, 1, 20, 'CpE-ProjDe411', 'CpE Practice and Design 1', 6, 9, 'lec', '', 589, 'yes', '03:00:00'),
(199, 8, 4, 1, 20, 'CpE-ProjDe411', 'CpE Practice and Design 1', 3, 9, 'lab', '', 589, 'yes', '03:00:00'),
(200, 8, 4, 2, 20, 'CpE-ES421', 'Embedded Systems', 3, 3, 'lec', '', 532, 'yes', '03:00:00'),
(201, 8, 4, 2, 20, 'CpE-ES421', 'Embedded Systems', 3, 3, 'lab', '', 532, 'yes', '03:00:00'),
(202, 8, 4, 1, 20, 'CpE-Free-Ele411', 'Analytics Modelling Technologies and Tools', 3, 1, 'lec', '', 695, 'yes', '03:00:00'),
(203, 7, 4, 1, 35, 'CS-CertExam411', 'Philnits/Microsoft/TESDA', 3, 3, 'lec', '', 741, 'yes', '03:00:00'),
(204, 8, 1, 2, 18, 'Cpe-HDL121', 'Introduction to HDL', 3, 2, 'lec', '', 842, 'yes', '03:00:00'),
(205, 8, 1, 2, 18, 'Cpe-HDL121', 'Introduction to HDL', 3, 2, 'lab', '', 842, 'yes', '03:00:00'),
(206, 1, 1, 1, 22, '*ENGLISH 01', 'English Plus', 3, 3, 'lec', '', 837, 'yes', '03:00:00'),
(207, 1, 1, 1, 22, 'ENGLISH 1', 'Communication Arts 1', 3, 3, 'lec', '', 287, 'yes', '03:00:00'),
(208, 1, 1, 1, 22, 'MATH 1', 'College Algebra', 3, 3, 'lec', '', 729, 'yes', '03:00:00'),
(209, 3, 1, 1, 37, 'ENGLISH 01', 'English Plus', 3, 3, 'lec', '', 649, 'yes', '03:00:00'),
(210, 3, 1, 1, 37, 'ENGLISH 1', 'Communication Arts 1', 3, 3, 'lec', '', 486, 'yes', '03:00:00'),
(211, 3, 1, 1, 37, 'Math 1', 'College Algebra', 3, 3, 'lec', '', 193, 'yes', '03:00:00'),
(212, 3, 1, 1, 41, 'IT 1', 'IT Fundamentals', 3, 3, 'lec', '', 472, 'yes', '03:00:00'),
(213, 3, 1, 1, 40, 'IT 2', 'Computer Programming 1', 3, 4, 'lec', '', 452, 'yes', '03:00:00'),
(214, 3, 1, 1, 40, 'IT 2', 'Computer Programming 1', 1, 4, 'lab', '', 452, 'yes', '03:00:00'),
(217, 3, 1, 1, 39, 'PE 1', 'Physical Fitness 1', 2, 2, 'lec', '', 186, 'yes', '02:00:00'),
(218, 3, 1, 1, 39, 'NSTP 1', 'National Service Training Program 1', 3, 3, 'lec', '', 653, 'yes', '03:00:00'),
(219, 3, 1, 1, 37, 'FILIPINO 1', 'Sining ng Pakikipagtalastasan 1', 3, 3, 'lec', '', 765, 'yes', '03:00:00'),
(220, 3, 1, 2, 37, 'ENGLISH 2', 'Communications for IT', 3, 3, 'lec', '', 289, 'yes', '03:00:00'),
(221, 3, 1, 2, 40, 'IT 3', 'Computer Programming 2', 3, 4, 'lec', '', 427, 'yes', '03:00:00'),
(222, 3, 1, 2, 40, 'IT 3', 'Computer Programming 2', 1, 4, 'lab', '', 427, 'yes', '03:00:00'),
(223, 3, 1, 2, 40, 'IT 4', 'Presentation Skill in IT', 3, 3, 'lec', '', 325, 'yes', '03:00:00'),
(224, 3, 1, 2, 37, 'MATH 2', 'Trigonometry', 3, 3, 'lec', '', 423, 'yes', '03:00:00'),
(225, 3, 1, 2, 40, 'IT 5', 'Fundamentals of Problem Solving', 3, 3, 'lec', '', 736, 'yes', '03:00:00'),
(228, 3, 1, 2, 39, 'PE 2', 'Rythmic Activities', 2, 2, 'lec', '', 365, 'yes', '02:00:00'),
(229, 3, 1, 2, 39, 'NSTP 2', 'National Service Training Program 2', 3, 3, 'lec', '', 862, 'yes', '03:00:00'),
(230, 3, 1, 2, 37, 'FILIPINO 2', 'Pagbasa at Pagsulat sa Filipino', 3, 3, 'lec', '', 642, 'yes', '03:00:00'),
(231, 3, 2, 1, 37, 'PHYSICS 1', 'Mechanics & Thermodynamics', 3, 3, 'lec', '', 534, 'yes', '03:00:00'),
(232, 3, 2, 1, 40, 'IT 6', 'Computer & File Organization', 3, 3, 'lec', '', 413, 'yes', '03:00:00'),
(233, 3, 2, 1, 40, 'IT 7', 'Object-Oriented Programming', 3, 4, 'lec', '', 189, 'yes', '03:00:00'),
(234, 3, 2, 1, 40, 'IT 7', 'Object-Oriented Programming', 1, 4, 'lab', '', 189, 'yes', '03:00:00'),
(235, 3, 2, 1, 40, 'IT 8', 'Operating System Application', 2, 3, 'lec', '', 579, 'yes', '03:00:00'),
(236, 3, 2, 1, 40, 'IT 8', 'Operating System Application', 1, 3, 'lab', '', 579, 'yes', '03:00:00'),
(237, 3, 2, 1, 37, 'MATH 3', 'Discrete Structures', 3, 3, 'lec', '', 581, 'yes', '03:00:00'),
(238, 3, 2, 1, 37, 'ENGLISH 3', 'Speech and Oral Communication', 3, 3, 'lec', '', 396, 'yes', '03:00:00'),
(239, 3, 2, 1, 37, 'SOC SCI 1', 'General Psychology with Drug Prevention', 3, 3, 'lec', '', 154, 'yes', '03:00:00'),
(240, 3, 2, 1, 39, 'PE 3', 'Individual Sports', 2, 2, 'lec', '', 125, 'yes', '02:00:00'),
(241, 3, 2, 1, 37, 'HUMANITIES 1', 'Art, Man & Society', 3, 3, 'lec', '', 738, 'yes', '03:00:00'),
(242, 3, 2, 2, 37, 'PHYSICS 2', 'Electricity & Magnetism', 3, 3, 'lec', '', 693, 'yes', '03:00:00'),
(243, 3, 2, 2, 41, 'IT-ELE 1', 'Data Comm. & Computer Networks', 3, 3, 'lec', '', 271, 'yes', '03:00:00'),
(244, 3, 2, 2, 40, 'IT 9', 'Database Management System 1', 2, 3, 'lec', '', 542, 'yes', '02:30:00'),
(245, 3, 2, 2, 40, 'IT 9', 'Database Management System 1', 1, 3, 'lab', '', 542, 'yes', '02:30:00'),
(246, 3, 2, 2, 40, 'IT-ELE 2', 'Web Page Desin & Development', 2, 3, 'lec', '', 953, 'yes', '03:00:00'),
(247, 3, 2, 2, 40, 'IT-ELE 2', 'Web Page Desin & Development', 1, 3, 'lab', '', 953, 'yes', '03:00:00'),
(248, 3, 2, 2, 40, 'IT 10', 'Systems Analysis & Design', 3, 3, 'lec', '', 318, 'yes', '03:00:00'),
(249, 3, 2, 2, 37, 'MATH 4', 'Probability & Statistics', 3, 3, 'lec', '', 217, 'yes', '03:00:00'),
(250, 3, 2, 2, 37, 'SOC SCI 2', 'Professional Ethics with Values Formation', 3, 3, 'lec', '', 512, 'yes', '03:00:00'),
(251, 3, 2, 2, 37, 'ENGLISH 4', 'Business English & Correspondence', 3, 3, 'lec', '', 925, 'yes', '03:00:00'),
(252, 3, 2, 2, 39, 'PE 4', 'Team Sports', 2, 2, 'lec', '', 347, 'yes', '03:00:00'),
(253, 3, 3, 1, 41, 'IT-ELE 3', 'Computer Animation', 2, 3, 'lec', '', 934, 'yes', '03:00:00'),
(254, 3, 3, 1, 41, 'IT-ELE 3', 'Computer Animation', 1, 3, 'lab', '', 934, 'yes', '03:00:00'),
(255, 3, 3, 1, 40, 'IT 11', 'Database Management System 2', 3, 3, 'lec', '', 294, 'yes', '06:00:00'),
(256, 3, 3, 1, 40, 'IT 12', 'Modelling & Simulation', 3, 3, 'lec', '', 195, 'yes', '03:00:00'),
(257, 3, 3, 1, 40, 'IT 13', 'Management Information System', 3, 3, 'lec', '', 753, 'yes', '06:00:00'),
(258, 3, 3, 1, 37, 'ECO 1', 'Economics w/ Taxation & Agrarian Reform', 3, 3, 'lec', '', 257, 'yes', '03:00:00'),
(259, 3, 3, 1, 37, 'HUMANITIES 2', 'Philippine Literature', 3, 3, 'lec', '', 954, 'yes', '03:00:00'),
(260, 3, 3, 1, 37, 'ACCOUNTING 1', 'Accounting Principles', 3, 3, 'lec', '', 752, 'yes', '03:00:00'),
(261, 3, 3, 1, 40, 'IT 14', 'Quality Conciousness, habits & Processes', 3, 3, 'lec', '', 184, 'yes', '03:00:00'),
(262, 3, 3, 2, 40, 'IT 15', 'Software Engineering', 2, 3, 'lec', '', 893, 'yes', '03:00:00'),
(263, 3, 3, 2, 40, 'IT 15', 'Software Engineering', 1, 3, 'lab', '', 893, 'yes', '03:00:00'),
(264, 3, 3, 2, 40, 'IT 16', 'Multimedia System', 2, 3, 'lec', '', 842, 'yes', '03:00:00'),
(265, 3, 3, 2, 40, 'IT 16', 'Multimedia System', 1, 3, 'lab', '', 842, 'yes', '03:00:00'),
(266, 3, 3, 2, 41, 'IT-ELE 4', 'Mobile Applicatoins Development', 2, 3, 'lec', '', 732, 'yes', '03:00:00'),
(267, 3, 3, 2, 41, 'IT-ELE 4', 'Mobile Applicatoins Development', 1, 3, 'lab', '', 732, 'yes', '03:00:00'),
(268, 3, 3, 2, 41, 'IT-ELE 5', 'Project Management', 3, 3, 'lec', '', 924, 'yes', '03:00:00'),
(269, 3, 3, 2, 41, 'FREE-ELE 2', 'Busines Systems', 3, 3, 'lec', '', 123, 'yes', '03:00:00'),
(270, 3, 3, 2, 41, 'FREE-ELE 1', 'Dynamic Web Applications', 2, 4, 'lec', '', 148, 'yes', '03:00:00'),
(271, 3, 3, 2, 41, 'FREE-ELE 1', 'Dynamic Web Applications', 2, 4, 'lab', '', 148, 'yes', '03:00:00'),
(272, 3, 3, 3, 40, 'IT PRAC', 'Practicum/OJT', 9, 9, 'lec', '', 258, 'yes', '03:00:00'),
(273, 3, 4, 1, 40, 'IT PRO', 'IT Proposal', 6, 6, 'lec', '', 613, 'yes', '03:00:00'),
(274, 3, 4, 1, 41, 'FREE-ELE 3', 'Computer Graphics & Visualization', 2, 3, 'lec', '', 179, 'yes', '03:00:00'),
(275, 3, 4, 1, 41, 'FREE-ELE 3', 'Computer Graphics & Visualization', 1, 3, 'lab', '', 179, 'yes', '03:00:00'),
(276, 3, 4, 1, 38, 'IT-SEMINAR', 'Seminars & Field Trip', 3, 3, 'lec', '', 825, 'yes', '03:00:00'),
(277, 3, 4, 1, 41, 'FREE-ELE 4', 'Digital Design', 3, 3, 'lec', '', 174, 'yes', '03:00:00'),
(278, 3, 4, 1, 40, 'IT 17', 'Information System Security', 2, 3, 'lec', '', 615, 'yes', '03:00:00'),
(279, 3, 4, 1, 40, 'IT 17', 'Information System Security', 1, 3, 'lab', '', 615, 'yes', '03:00:00'),
(280, 3, 4, 2, 40, 'IT 18', 'Software Integration', 3, 3, 'lec', '', 857, 'yes', '03:00:00'),
(281, 3, 4, 2, 40, 'IT 19', 'Capstons Project (IT Thesis)', 3, 4, 'lec', '', 827, 'yes', '03:00:00'),
(282, 3, 4, 2, 40, 'IT 19', 'Capstons Project (IT Thesis)', 1, 4, 'lab', '', 827, 'yes', '03:00:00'),
(283, 3, 4, 2, 38, 'FREE-ELE 5', 'PHILNITS', 3, 3, 'lec', '', 321, 'yes', '03:00:00'),
(284, 3, 4, 2, 40, 'IT 20', 'Internet Programming with Database', 2, 3, 'lec', '', 972, 'yes', '03:00:00'),
(285, 3, 4, 2, 40, 'IT 20', 'Internet Programming with Database', 1, 3, 'lab', '', 972, 'yes', '03:00:00'),
(286, 3, 4, 2, 37, 'RIZAL COURSE', 'Life & Works of Rizal', 3, 3, 'lec', '', 782, 'yes', '03:00:00'),
(287, 3, 4, 1, 37, 'Fil 3', 'Masining na Pagpapahayag', 3, 3, 'lec', '', 245, 'yes', '03:00:00'),
(288, 4, 1, 1, 9, '*ENGLISH 01', 'English Plus', 3, 3, 'lec', '', 732, 'yes', '03:00:00'),
(289, 4, 1, 1, 9, 'ENGLISH 1', 'Communication Arts 1', 3, 3, 'lec', '', 587, 'yes', '03:00:00'),
(290, 4, 1, 1, 9, 'MATH 1', 'College Algebra', 3, 3, 'lec', '', 865, 'yes', '03:00:00'),
(291, 4, 1, 1, 6, 'CS 1', 'CS Fundamentals', 3, 3, 'lec', '', 319, 'yes', '03:00:00'),
(292, 4, 1, 1, 6, 'CS 2', 'Computer Programming 1', 3, 4, 'lec', '', 415, 'yes', '03:00:00'),
(293, 4, 1, 1, 6, 'CS 2', 'Computer Programming 1', 1, 4, 'lab', '', 415, 'yes', '03:00:00'),
(295, 3, 1, 1, 40, 'KB 1', 'Keyboarding 1', 3, 3, 'lab', '', 451, 'yes', '03:00:00'),
(296, 4, 1, 1, 6, 'KB 1', 'Keyboarding 1', 3, 3, 'lab', '', 136, 'yes', '03:00:00'),
(297, 4, 1, 1, 10, 'PE 1', 'Physical Fitness 1', 2, 2, 'lec', '', 254, 'yes', '03:00:00'),
(299, 4, 1, 1, 9, 'ACCOUNTING 1', 'Accounting Principles', 3, 3, 'lec', '', 863, 'yes', '03:00:00'),
(300, 4, 1, 2, 9, 'ENGLISH 2', 'Communications for IT', 3, 3, 'lec', '', 436, 'yes', '03:00:00'),
(301, 4, 1, 2, 6, 'CS 3', 'Computer Programming 2', 3, 4, 'lec', '', 573, 'yes', '03:00:00'),
(302, 4, 1, 2, 6, 'CS 3', 'Computer Programming 2', 1, 4, 'lab', '', 573, 'yes', '03:00:00'),
(303, 4, 1, 2, 6, 'CS 4', 'Data Structure', 3, 3, 'lec', '', 527, 'yes', '03:00:00'),
(304, 4, 1, 2, 9, 'MATH 2', 'Trigonometry', 3, 3, 'lec', '', 764, 'yes', '03:00:00'),
(305, 4, 1, 2, 9, 'ECON 1', 'Economics w/ Taxation & Agrarian Reform', 3, 3, 'lec', '', 124, 'yes', '03:00:00'),
(306, 3, 1, 2, 40, 'KB 2', 'Keyboarding 2', 3, 3, 'lab', '', 529, 'yes', '03:00:00'),
(307, 4, 1, 2, 6, 'KB 2', 'Keyboarding 2', 3, 3, 'lab', '', 175, 'yes', '03:00:00'),
(308, 4, 1, 2, 10, 'PE 2', 'Rhythmic Activities', 2, 2, 'lec', '', 981, 'yes', '03:00:00'),
(309, 4, 1, 2, 10, 'NSTP 2', 'National Service Training Program 2', 3, 3, 'lec', '', 536, 'yes', '03:00:00'),
(310, 4, 2, 1, 9, 'PHYSICS 1', 'Mechanics & Thermodynamics', 3, 3, 'lec', '', 268, 'yes', '03:00:00'),
(311, 4, 2, 1, 7, 'CS 5', 'Object-Oriented Programming', 3, 4, 'lec', '', 913, 'yes', '03:00:00'),
(312, 4, 2, 1, 7, 'CS 5', 'Object-Oriented Programming', 1, 4, 'lab', '', 913, 'yes', '03:00:00'),
(313, 4, 2, 1, 7, 'CS 6', 'Design & Analysis of Algorithm', 3, 3, 'lec', '', 158, 'yes', '03:00:00'),
(314, 4, 2, 1, 9, 'MATH 3', 'Discrete Structures', 3, 3, 'lec', '', 389, 'yes', '03:00:00'),
(315, 4, 2, 1, 9, 'ENGLISH 3', 'Speech & Oral Communication', 3, 3, 'lec', '', 918, 'yes', '03:00:00'),
(316, 4, 2, 1, 9, 'MATH 4', 'Calculus', 3, 3, 'lec', '', 179, 'yes', '03:00:00'),
(317, 4, 2, 1, 9, 'SOC SCI 1', 'General Psychology with Drug Prevention', 3, 3, 'lec', '', 813, 'yes', '03:00:00'),
(318, 4, 2, 1, 10, 'PE 3', 'Individual Sports', 2, 2, 'lec', '', 145, 'yes', '03:00:00'),
(319, 4, 2, 2, 9, 'PHYSICS 2', 'Electricity & Magnetism', 3, 3, 'lec', '', 392, 'yes', '03:00:00'),
(320, 4, 2, 2, 7, 'CS 7', 'Automata & Language Theory', 3, 3, 'lec', '', 758, 'yes', '03:00:00'),
(321, 4, 2, 2, 7, 'CS 8', 'Database Management System 1', 2, 3, 'lec', '', 432, 'yes', '03:00:00'),
(322, 4, 2, 2, 7, 'CS 8', 'Database Management System 1', 1, 3, 'lab', '', 432, 'yes', '03:00:00'),
(323, 4, 2, 2, 7, 'CS 9', 'System Analysis & Design', 3, 3, 'lec', '', 461, 'yes', '03:00:00'),
(324, 4, 2, 2, 6, 'CS 10', 'Logic Design & Switching Theory', 3, 3, 'lec', '', 985, 'yes', '03:00:00'),
(325, 4, 2, 2, 9, 'MATH 5', 'Probability & Statistics', 3, 3, 'lec', '', 176, 'yes', '03:00:00'),
(326, 4, 2, 2, 9, 'HUMANITIES 1', 'Art, Man & Society', 3, 3, 'lec', '', 453, 'yes', '03:00:00'),
(327, 4, 2, 2, 9, 'ENGLISH 4', 'Business English & Correspondence', 3, 3, 'lec', '', 714, 'yes', '03:00:00'),
(328, 4, 2, 2, 10, 'PE 4', 'Team Sports', 2, 2, 'lec', '', 973, 'yes', '03:00:00'),
(329, 1, 1, 1, 23, 'IT 1', 'IT Fundamentals', 3, 3, 'lec', '', 634, 'yes', '03:00:00'),
(330, 1, 1, 1, 23, 'IT 2', 'Computer Programming 1', 3, 4, 'lec', '', 692, 'yes', '03:00:00'),
(331, 1, 1, 1, 23, 'IT 2', 'Computer Programming 1', 1, 4, 'lab', '', 692, 'yes', '03:00:00'),
(332, 1, 1, 1, 23, 'KB 1', 'Keyboarding 1', 3, 3, 'lab', '', 987, 'yes', '03:00:00'),
(333, 1, 1, 1, 24, 'PE 1', 'Physical Fitness 1', 2, 2, 'lec', '', 139, 'yes', '03:00:00'),
(334, 1, 1, 1, 24, 'NSTP 1', 'National Service Training Program 1', 3, 3, 'lec', '', 967, 'yes', '03:00:00'),
(335, 4, 3, 1, 9, 'FILIPINO 1', 'Komunikasyon sa Akademikong Filipino', 3, 3, 'lec', '', 843, 'yes', '03:00:00'),
(336, 1, 1, 1, 22, 'FILIPINO 1', 'Komunikasyon sa Akademikong Filipino', 3, 3, 'lec', '', 461, 'yes', '03:00:00'),
(337, 1, 1, 2, 22, 'ENGLISH 2', 'Communications for IT', 3, 3, 'lec', '', 934, 'yes', '03:00:00'),
(338, 1, 1, 2, 23, 'IT 3', 'Computer Programming 2', 3, 3, 'lec', '', 928, 'yes', '03:00:00'),
(339, 1, 1, 2, 23, 'IT 4', 'Presentation Skills in IT', 3, 3, 'lec', '', 361, 'yes', '03:00:00'),
(340, 1, 1, 2, 22, 'MATH 2', 'Trigonometry', 3, 3, 'lec', '', 275, 'yes', '03:00:00'),
(341, 1, 1, 2, 25, 'IT 5', 'Fundamentals of Problem Solving', 3, 3, 'lec', '', 517, 'yes', '03:00:00'),
(342, 1, 1, 2, 23, 'KB 2', 'Keyboarding 2', 3, 3, 'lab', '', 591, 'yes', '03:00:00'),
(343, 1, 1, 2, 24, 'PE 2', 'Rhythmic Activities', 2, 2, 'lec', '', 456, 'yes', '03:00:00'),
(344, 1, 1, 2, 24, 'NSTP 2', 'National Service Training Program 2', 3, 3, 'lec', '', 642, 'yes', '03:00:00'),
(345, 1, 1, 2, 22, 'FILIPINO 2', 'Pagbasa at Pagsulat Tungo sa Pananaliksik', 3, 3, 'lec', '', 948, 'yes', '03:00:00'),
(346, 1, 2, 3, 23, 'IT 4a', 'Quality Consiousness, Habits & Processes', 3, 3, 'lec', '', 163, 'yes', '03:00:00'),
(347, 1, 2, 3, 22, 'Humanities 1', 'Philippine Literature', 3, 3, 'lec', '', 583, 'yes', '03:00:00'),
(348, 1, 2, 1, 22, 'PHYSICS 1', 'Mechanics & Thermodynamics', 3, 3, 'lec', '', 528, 'yes', '03:00:00'),
(349, 1, 2, 1, 25, 'IT 6', 'Computer & FIle Organization', 3, 3, 'lec', '', 968, 'yes', '03:00:00'),
(350, 1, 2, 1, 25, 'IT 7', 'Object-Oriented Programming', 3, 4, 'lec', '', 437, 'yes', '03:00:00'),
(351, 1, 2, 1, 25, 'IT 7', 'Object-Oriented Programming', 1, 4, 'lab', '', 437, 'yes', '03:00:00'),
(352, 1, 2, 1, 23, 'IT 8', 'Operating System Applications', 2, 3, 'lec', '', 179, 'yes', '03:00:00'),
(353, 1, 2, 1, 23, 'IT 8', 'Operating System Applications', 1, 3, 'lab', '', 179, 'yes', '03:00:00'),
(354, 1, 2, 1, 22, 'MATH 3', 'Discrete Structures', 3, 3, 'lec', '', 984, 'yes', '03:00:00'),
(355, 1, 2, 1, 22, 'ENGLISH 3', 'Speech & Oral Communication', 3, 3, 'lec', '', 834, 'yes', '03:00:00'),
(356, 1, 2, 1, 22, 'SOC SCI 1', 'General Psychology with Drug Prevention', 3, 3, 'lec', '', 367, 'yes', '03:00:00'),
(357, 1, 2, 1, 22, 'FILIPINO 3', 'Masining na Pagpapahayag', 3, 3, 'lec', '', 678, 'yes', '03:00:00'),
(358, 1, 2, 1, 24, 'PE 3', 'Individual Sports', 1, 2, 'lec', '', 721, 'yes', '03:00:00'),
(359, 1, 2, 1, 22, 'HUMANITIES 2', 'Art, Man & Society', 3, 3, 'lec', '', 185, 'yes', '03:00:00'),
(360, 1, 2, 2, 22, 'PHYSICS 2', 'Electricity & Magnetism', 3, 3, 'lec', '', 647, 'yes', '03:00:00'),
(361, 1, 2, 2, 26, 'IT-ELE 1', 'Data Comm. & Computer Networks', 3, 3, 'lec', '', 589, 'yes', '03:00:00'),
(362, 1, 2, 2, 25, 'IT 9', 'Database Management System 1', 2, 3, 'lec', '', 756, 'yes', '03:00:00'),
(363, 1, 2, 2, 25, 'IT 9', 'Database Management System 1', 1, 3, 'lab', '', 756, 'yes', '03:00:00'),
(364, 1, 2, 2, 25, 'IT-ELE 2', 'Web Page Design & Development', 2, 3, 'lec', '', 279, 'yes', '03:00:00'),
(365, 1, 2, 2, 25, 'IT-ELE 2', 'Web Page Design & Development', 1, 3, 'lab', '', 279, 'yes', '03:00:00'),
(366, 1, 2, 2, 22, 'ITPRAC', 'ITPRAC', 3, 3, 'lec', '', 285, 'yes', '03:00:00'),
(367, 1, 2, 2, 25, 'IT 10', 'System Analysis & Design', 3, 3, 'lec', '', 239, 'yes', '03:00:00'),
(368, 1, 2, 2, 22, 'MATH 4', 'Probability and Statistics', 3, 3, 'lec', '', 428, 'yes', '03:00:00'),
(369, 1, 2, 2, 22, 'SOC SCI 2', 'Professional Ethics with Values Formation', 3, 3, 'lec', '', 395, 'yes', '03:00:00'),
(370, 1, 2, 2, 22, 'ENGLISH 4', 'Business English & Correspondence', 3, 3, 'lec', '', 173, 'yes', '03:00:00'),
(371, 1, 2, 2, 24, 'PE 4', 'Team Sports', 2, 2, 'lec', '', 159, 'yes', '03:00:00'),
(372, 4, 3, 1, 7, 'CS 11', 'Programming Languages', 2, 3, 'lec', '', 198, 'yes', '03:00:00'),
(373, 4, 3, 1, 7, 'CS 11', 'Programming Languages', 1, 3, 'lab', '', 198, 'yes', '03:00:00'),
(374, 4, 3, 1, 6, 'CS 12', 'Software Engineering', 3, 3, 'lec', '', 194, 'yes', '03:00:00'),
(375, 4, 3, 1, 7, 'CS 13', 'Database Management System 2', 2, 3, 'lec', '', 413, 'yes', '03:00:00'),
(376, 4, 3, 1, 7, 'CS 13', 'Database Management System 2', 1, 3, 'lab', '', 413, 'yes', '03:00:00'),
(377, 4, 3, 1, 6, 'CS 14', 'Modelling & Simulation', 3, 3, 'lec', '', 425, 'yes', '03:00:00'),
(378, 4, 3, 1, 7, 'CS-ELE 1', 'Mobile Applications Development', 2, 3, 'lec', '', 651, 'yes', '03:00:00'),
(379, 4, 3, 1, 7, 'CS-ELE 1', 'Mobile Applications Development', 1, 3, 'lab', '', 651, 'yes', '03:00:00'),
(380, 4, 3, 1, 9, 'SOC SCI 2', 'Society & Culture w/ Family Planning', 3, 3, 'lec', '', 289, 'yes', '03:00:00'),
(381, 4, 3, 1, 7, 'CS-ELE 2', 'Computer Animation', 2, 3, 'lec', '', 495, 'yes', '03:00:00'),
(382, 4, 3, 1, 7, 'CS-ELE 2', 'Computer Animation', 1, 3, 'lab', '', 495, 'yes', '03:00:00'),
(383, 4, 3, 2, 6, 'CS-ELE 3', 'Web Page Design & Development', 2, 3, 'lec', '', 832, 'yes', '03:00:00'),
(384, 4, 3, 2, 6, 'CS-ELE 3', 'Web Page Design & Development', 1, 3, 'lab', '', 832, 'yes', '03:00:00'),
(385, 4, 3, 2, 6, 'FREE-ELE 1', 'Operating Systems Config & Use', 2, 3, 'lec', '', 649, 'yes', '03:00:00'),
(386, 4, 3, 2, 6, 'FREE-ELE 1', 'Operating Systems Config & Use', 1, 3, 'lab', '', 649, 'yes', '03:00:00'),
(387, 4, 3, 2, 6, 'CS-ELE 4', 'Artificial Intelligence', 3, 3, 'lec', '', 498, 'yes', '03:00:00'),
(388, 4, 3, 2, 6, 'CS PRO', 'CS Thesis Proposal', 3, 3, 'lec', '', 962, 'yes', '03:00:00'),
(389, 4, 3, 2, 6, 'CS-ELE 5', 'Project Management', 3, 3, 'lec', '', 276, 'yes', '03:00:00'),
(390, 4, 3, 2, 9, 'HUMANITIES2', 'Philippine Literature', 3, 3, 'lec', '', 172, 'yes', '03:00:00'),
(391, 4, 3, 2, 9, 'FILIPINO 2', 'Pagbasa at Pagsulat Tungo sa Pananaliksik', 3, 3, 'lec', '', 869, 'yes', '03:00:00'),
(392, 4, 4, 3, 7, 'CS PRAC', 'Practicum/ OJT', 6, 6, 'lec', '', 213, 'yes', '03:00:00'),
(393, 4, 4, 1, 6, 'FREE-ELE 2', 'Embedded Systems', 2, 3, 'lec', '', 187, 'yes', '03:00:00'),
(394, 4, 4, 1, 6, 'FREE-ELE 2', 'Embedded Systems', 1, 3, 'lab', '', 187, 'yes', '03:00:00'),
(395, 4, 4, 1, 6, 'FREE-ELE 3', 'Dynamic Web Applications', 2, 3, 'lec', '', 678, 'yes', '03:00:00'),
(396, 4, 4, 1, 6, 'FREE-ELE 3', 'Dynamic Web Applications', 1, 3, 'lab', '', 678, 'yes', '03:00:00'),
(397, 4, 4, 1, 6, 'CS-SEMINAR', 'CS Seminar & Field Trips', 3, 3, 'lec', '', 351, 'yes', '03:00:00'),
(398, 4, 4, 1, 7, 'CS 17', 'CS Thesis 1', 3, 4, 'lec', '', 531, 'yes', '03:00:00'),
(399, 4, 4, 1, 7, 'CS 17', 'CS Thesis 1', 1, 4, 'lab', '', 531, 'yes', '03:00:00'),
(400, 4, 4, 1, 9, 'FILIPINO 3', 'Masining na Pagpapahayag', 3, 3, 'lec', '', 562, 'yes', '03:00:00'),
(401, 4, 4, 1, 9, 'SOC SCI 3', 'Philippine History w/ Government & Constitution', 3, 3, 'lec', '', 273, 'yes', '03:00:00'),
(402, 4, 4, 1, 9, 'SOC SCI 4', 'Professional Ethics w/ Values Formation', 3, 3, 'lec', '', 894, 'yes', '03:00:00'),
(403, 4, 4, 2, 7, 'CS 18', 'CS Thesis 2', 3, 4, 'lec', '', 712, 'yes', '03:00:00'),
(404, 4, 4, 2, 7, 'CS 18', 'CS Thesis 2', 1, 4, 'lab', '', 712, 'yes', '03:00:00'),
(405, 4, 4, 2, 6, 'CS 19', 'Information System Security', 2, 3, 'lec', '', 382, 'yes', '03:00:00'),
(406, 4, 4, 2, 6, 'CS 19', 'Information System Security', 1, 3, 'lab', '', 382, 'yes', '03:00:00'),
(407, 4, 4, 2, 7, 'FREE-ELE 4', 'Computer Graphics & Visualization', 2, 3, 'lec', '', 365, 'yes', '03:00:00'),
(408, 4, 4, 2, 7, 'FREE-ELE 4', 'Computer Graphics & Visualization', 1, 3, 'lab', '', 365, 'yes', '03:00:00'),
(409, 4, 4, 2, 6, 'FREE-ELE 5', 'PHILNITS', 3, 3, 'lec', '', 451, 'yes', '03:00:00'),
(410, 4, 4, 2, 6, 'CS 20', 'Software Integration', 3, 3, 'lec', '', 716, 'yes', '03:00:00'),
(411, 4, 4, 2, 9, 'RIZAL COURSE', 'Life & Works of Rizal', 3, 3, 'lec', '', 517, 'yes', '03:00:00'),
(412, 5, 1, 1, 27, '*ENGLISH 01', 'English Plus', 3, 3, 'lec', '', 719, 'no', '03:00:00'),
(413, 5, 1, 1, 27, '*MATH 01', 'Math Plus', 3, 3, 'lec', '', 165, 'no', '03:00:00'),
(414, 5, 1, 1, 27, 'ENGLISH 1', 'Communication Arts 1', 3, 3, 'lec', '', 678, 'yes', '03:00:00'),
(415, 5, 1, 1, 27, 'MATH 1', 'College Algebra', 3, 3, 'lec', '', 243, 'yes', '03:00:00'),
(416, 5, 1, 1, 27, 'MATH 2', 'Plane and Special Trigonometry', 3, 3, 'lec', '', 546, 'yes', '03:00:00'),
(417, 5, 1, 1, 31, 'IT 1', 'Productivity Tools 1', 2, 3, 'lec', '', 956, 'yes', '03:00:00'),
(418, 5, 1, 1, 31, 'IT 1', 'Productivity Tools 1', 1, 3, 'lab', '', 956, 'yes', '03:00:00'),
(419, 5, 1, 1, 27, 'CHEM 1', 'General Chemistry 1', 3, 4, 'lec', '', 193, 'yes', '03:00:00'),
(420, 5, 1, 1, 27, 'CHEM 1', 'General Chemistry 1', 1, 4, 'lab', '', 193, 'yes', '03:00:00'),
(421, 5, 1, 1, 28, 'ENGDRA 1', 'Engineering Drawing 1', 1, 1, 'lab', '', 521, 'yes', '03:00:00'),
(422, 5, 1, 1, 29, 'PE 1', 'Physical Fitness 1', 2, 2, 'lec', '', 217, 'yes', '03:00:00'),
(423, 5, 1, 1, 29, 'NSTP 1', 'National Service Training Program 1', 3, 3, 'lec', '', 941, 'yes', '03:00:00'),
(424, 5, 1, 1, 27, 'FILIPINO 1', 'Komunikasyon sa Akademikong Pilipino', 3, 3, 'lec', '', 769, 'yes', '03:00:00'),
(425, 5, 1, 2, 27, 'ENGLISH 2', 'Communication Arts 2', 3, 3, 'lec', '', 175, 'yes', '03:00:00'),
(426, 5, 1, 2, 27, 'MATH 3', 'Advanced Algebra', 3, 3, 'lec', '', 198, 'yes', '03:00:00'),
(427, 5, 1, 2, 27, 'MATH 4', 'Analytic Geometry', 3, 3, 'lec', '', 329, 'yes', '03:00:00'),
(428, 5, 1, 2, 27, 'MATH 5', 'Solid Mensuration', 3, 3, 'lec', '', 963, 'yes', '03:00:00'),
(429, 5, 1, 2, 27, 'PHYSICS 1', 'Engineering Physics 1', 3, 4, 'lec', '', 596, 'yes', '03:00:00'),
(430, 5, 1, 2, 27, 'PHYSICS 1', 'Engineering Physics 1', 1, 4, 'lab', '', 596, 'yes', '03:00:00'),
(431, 5, 1, 2, 28, 'CpE 1', 'Computer Hardware Fundamentals', 1, 1, 'lab', '', 675, 'yes', '03:00:00'),
(432, 5, 1, 2, 29, 'PE 2', 'Rythmic Activities', 2, 2, 'lec', '', 167, 'yes', '03:00:00'),
(433, 5, 1, 2, 29, 'NSTP 2', 'National Service Training Program 2', 3, 3, 'lec', '', 187, 'yes', '03:00:00'),
(434, 5, 1, 2, 27, 'FILIPINO 2', 'Pagbasa at Pagsulat sa Filipino', 3, 3, 'lec', '', 396, 'yes', '03:00:00'),
(435, 5, 2, 1, 27, 'ENGLISH 3', 'Technical Communication', 3, 3, 'lec', '', 526, 'yes', '03:00:00'),
(436, 5, 2, 1, 27, 'MATH 6', 'Discrete Math', 3, 3, 'lec', '', 493, 'yes', '03:00:00'),
(437, 5, 2, 1, 27, 'MATH 7', 'Differential Calculus', 4, 4, 'lec', '', 648, 'yes', '03:00:00'),
(438, 5, 2, 1, 28, 'CpE 2', 'Computer Fundamentals & Engineering', 2, 2, 'lab', '', 513, 'yes', '05:00:00'),
(439, 5, 2, 1, 27, 'PHYSICS 2', 'Engineering Physics 2', 3, 4, 'lec', '', 653, 'yes', '03:00:00'),
(440, 5, 2, 1, 27, 'PHYSICS 2', 'Engineering Physics 2', 1, 4, 'lab', '', 653, 'yes', '03:00:00'),
(441, 5, 2, 1, 27, 'SOC SCI 1', 'General Psychology with Drug Prevention', 3, 3, 'lec', '', 943, 'yes', '03:00:00'),
(442, 5, 2, 1, 27, 'HUMANITIES 1', 'Art, Man & Society', 3, 3, 'lec', '', 542, 'yes', '03:00:00'),
(443, 5, 2, 1, 29, 'PE 3', 'Individual Sports', 2, 2, 'lec', '', 583, 'yes', '03:00:00'),
(444, 5, 2, 2, 27, 'MATH 8', 'Probability & Statistics', 3, 3, 'lec', '', 483, 'yes', '03:00:00'),
(445, 5, 2, 2, 27, 'MATH 9', 'Integral Calculus', 4, 4, 'lec', '', 691, 'yes', '03:00:00'),
(446, 5, 2, 2, 27, 'SOC SCI 2', 'Society & Culture w/ Family Planning', 3, 3, 'lec', '', 543, 'yes', '03:00:00'),
(447, 5, 2, 2, 27, 'HUMANITIES 2', 'Philippine Literature', 3, 3, 'lec', '', 651, 'yes', '03:00:00'),
(448, 5, 2, 2, 28, 'IT 2', 'Productivity Tools 2', 2, 3, 'lec', '', 821, 'yes', '03:00:00'),
(449, 5, 2, 2, 28, 'IT 2', 'Productivity Tools 2', 1, 3, 'lab', '', 821, 'yes', '03:00:00'),
(450, 5, 2, 2, 28, 'IT 3', 'Data Structures & Alogarithm Analysis', 3, 4, 'lec', '', 156, 'yes', '03:00:00'),
(451, 5, 2, 2, 28, 'IT 3', 'Data Structures & Alogarithm Analysis', 1, 4, 'lab', '', 156, 'yes', '03:00:00'),
(452, 5, 2, 2, 29, 'PE 4', 'Team Sports', 2, 2, 'lec', '', 867, 'yes', '03:00:00'),
(453, 5, 3, 1, 28, 'ENGDRA2', 'Computer Aided Drafting', 1, 1, 'lab', '', 845, 'yes', '03:00:00'),
(454, 5, 3, 1, 28, 'ECOEng', 'Engineering Economy', 3, 3, 'lec', '', 728, 'yes', '03:00:00'),
(455, 5, 3, 1, 30, 'CpE 3', 'Circuits 1', 3, 4, 'lec', '', 512, 'yes', '03:00:00'),
(456, 5, 3, 1, 30, 'CpE 3', 'Circuits 1', 1, 4, 'lab', '', 512, 'yes', '03:00:00'),
(457, 5, 3, 1, 30, 'CpE 4', 'Electronic Devices & Circuits', 3, 4, 'lec', '', 763, 'yes', '03:00:00'),
(458, 5, 3, 1, 30, 'CpE 4', 'Electronic Devices & Circuits', 1, 4, 'lab', '', 763, 'yes', '03:00:00'),
(459, 5, 3, 1, 27, 'MATH 10', 'Differential Equations', 3, 3, 'lec', '', 281, 'yes', '03:00:00'),
(460, 5, 3, 1, 30, 'CpE 5', 'Statics of Rigid Bodies', 3, 3, 'lec', '', 735, 'yes', '03:00:00'),
(461, 5, 3, 1, 30, 'RESEARCH1', 'BSCpe Research', 3, 0, 'lec', '', 593, 'yes', '03:00:00'),
(462, 5, 3, 1, 27, 'SOC SCI 3', 'Professional Ethics with Values Formation', 3, 3, 'lec', '', 427, 'yes', '03:00:00'),
(463, 5, 3, 1, 28, 'IT 4', 'Computer Systems Organization with Assembly Language', 3, 4, 'lec', '', 286, 'yes', '03:00:00'),
(464, 5, 3, 1, 28, 'IT 4', 'Computer Systems Organization with Assembly Language', 1, 4, 'lab', '', 286, 'yes', '03:00:00'),
(465, 5, 3, 2, 30, 'CpE 6', 'Mechanics of Deformable Bodies', 3, 3, 'lec', '', 721, 'yes', '03:00:00'),
(466, 5, 3, 2, 30, 'CpE 7', 'Electronics Circuits Analysis & Design', 3, 4, 'lec', '', 841, 'yes', '03:00:00'),
(467, 5, 3, 2, 30, 'CpE 7', 'Electronics Circuits Analysis & Design', 1, 4, 'lab', '', 841, 'yes', '03:00:00'),
(468, 5, 3, 2, 30, 'CpE 8', 'Logic Circuits and Switching Theory', 3, 4, 'lec', '', 257, 'yes', '03:00:00'),
(469, 5, 3, 2, 30, 'CpE 8', 'Logic Circuits and Switching Theory', 1, 4, 'lab', '', 257, 'yes', '03:00:00'),
(470, 5, 3, 2, 30, 'CpE 9', 'Circuits 2', 3, 4, 'lec', '', 417, 'yes', '03:00:00'),
(471, 5, 3, 2, 30, 'CpE 9', 'Circuits 2', 1, 4, 'lab', '', 417, 'yes', '03:00:00'),
(472, 5, 3, 2, 27, 'MATH 11', 'Advanced Engineering Mathematics for CpE', 3, 3, 'lec', '', 361, 'yes', '03:00:00'),
(473, 5, 3, 2, 30, 'ENGDRA 3', 'Computer Engineering Drafting & Design', 1, 1, 'lab', '', 127, 'yes', '03:00:00'),
(474, 5, 3, 2, 27, 'HUMANITIES3', 'Human, Nature & Life', 3, 3, 'lec', '', 614, 'yes', '03:00:00'),
(475, 5, 3, 2, 30, 'CpE 10', 'Dynamics of Rigid Bodies', 3, 3, 'lec', '', 826, 'yes', '03:00:00'),
(476, 5, 4, 1, 30, 'CpE 11', 'Engineering Management', 3, 3, 'lec', '', 581, 'yes', '03:00:00'),
(477, 5, 4, 1, 30, 'CpE 12', 'Environmental Engineering', 3, 3, 'lec', '', 643, 'yes', '03:00:00'),
(478, 5, 4, 1, 30, 'CpE 13', 'Safety Management', 1, 1, 'lec', '', 267, 'yes', '06:00:00'),
(479, 5, 4, 1, 30, 'CpE 14', 'Advanced Logic Circuit', 3, 4, 'lec', '', 695, 'yes', '03:00:00'),
(480, 5, 4, 1, 30, 'CpE 14', 'Advanced Logic Circuit', 1, 4, 'lab', '', 695, 'yes', '03:00:00'),
(481, 5, 4, 1, 30, 'CpE 15', 'Digital Signal Processing', 3, 4, 'lec', '', 316, 'yes', '03:00:00'),
(482, 5, 4, 1, 30, 'CpE 15', 'Digital Signal Processing', 1, 4, 'lab', '', 316, 'yes', '03:00:00'),
(483, 5, 4, 1, 30, 'CpE 16', 'Principles of Communication', 3, 3, 'lec', '', 748, 'yes', '03:00:00'),
(484, 5, 4, 1, 27, 'FILIPINO 3', 'Masining na Pagpapahayag', 3, 3, 'lec', '', 459, 'yes', '03:00:00'),
(485, 5, 4, 1, 30, 'CpE 17', 'Control Systems', 3, 4, 'lec', '', 713, 'yes', '03:00:00'),
(486, 5, 4, 1, 30, 'CpE 17', 'Control Systems', 1, 4, 'lab', '', 713, 'yes', '03:00:00'),
(487, 5, 4, 1, 31, 'FREE-ELE 1', 'Database Management System', 2, 3, 'lec', '', 679, 'yes', '02:30:00'),
(488, 5, 4, 1, 31, 'FREE-ELE 1', 'Database Management System', 1, 3, 'lab', '', 679, 'yes', '02:30:00'),
(489, 5, 4, 2, 28, 'IT 5', 'Operating Systems', 3, 4, 'lec', '', 481, 'yes', '03:00:00'),
(490, 5, 4, 2, 28, 'IT 5', 'Operating Systems', 1, 4, 'lab', '', 481, 'yes', '03:00:00'),
(491, 5, 4, 2, 30, 'CpE 18', 'Computer System Architecture', 3, 4, 'lec', '', 741, 'yes', '03:00:00'),
(492, 5, 4, 2, 30, 'CpE 18', 'Computer System Architecture', 1, 4, 'lab', '', 741, 'yes', '03:00:00'),
(493, 5, 4, 2, 30, 'CpE 19', 'Data Communications', 3, 3, 'lec', '', 495, 'yes', '03:00:00'),
(494, 5, 4, 2, 30, 'CpE 20', 'Microprocessor System', 3, 4, 'lec', '', 873, 'yes', '03:00:00'),
(495, 5, 4, 2, 30, 'CpE 20', 'Microprocessor System', 1, 4, 'lab', '', 873, 'yes', '03:00:00'),
(496, 5, 4, 2, 28, 'IT 6', 'Systems Analysis & Design', 2, 3, 'lec', '', 256, 'yes', '03:00:00'),
(497, 5, 4, 2, 28, 'IT 6', 'Systems Analysis & Design', 1, 3, 'lab', '', 256, 'yes', '03:00:00'),
(498, 5, 4, 2, 27, 'PHILNITS', 'PHILNETS', 3, 3, 'lec', '', 192, 'yes', '03:00:00'),
(499, 5, 4, 2, 31, 'FREE-ELE 2', 'Management and Information System', 3, 3, 'lec', '', 794, 'yes', '03:00:00'),
(500, 5, 4, 2, 30, 'CpE 21', 'Engineering Ethics & Computer Laws', 3, 3, 'lec', '', 412, 'yes', '03:00:00'),
(501, 5, 4, 3, 28, 'COMPE-Prac', 'Practicum/OJT', 6, 6, 'lec', '', 463, 'yes', '03:00:00'),
(502, 5, 5, 1, 30, 'CpE-Proj1', 'Design Project 1(Methods of Research)', 3, 3, 'lec', '', 381, 'yes', '03:00:00'),
(503, 5, 5, 1, 28, 'IT 7', 'Computer Networks', 3, 4, 'lec', '', 129, 'yes', '03:00:00'),
(504, 5, 5, 1, 28, 'IT 7', 'Computer Networks', 1, 4, 'lab', '', 129, 'yes', '03:00:00'),
(505, 5, 5, 1, 28, 'IT 8', 'Object Oriented Programming', 2, 3, 'lec', '', 314, 'yes', '03:00:00'),
(506, 5, 5, 1, 28, 'IT 8', 'Object Oriented Programming', 1, 3, 'lab', '', 314, 'yes', '03:00:00'),
(507, 5, 5, 1, 31, 'FREE-ELE 3', 'Project Management', 3, 3, 'lec', '', 235, 'yes', '03:00:00'),
(508, 5, 5, 1, 27, 'SOC SCI 4', 'Philisophy of Man', 3, 3, 'lec', '', 731, 'yes', '03:00:00'),
(509, 5, 5, 1, 28, 'IT 9', 'Software Engineering', 3, 3, 'lec', '', 184, 'yes', '03:00:00'),
(510, 5, 5, 1, 28, 'CompE-Sem', 'Seminars & Field Trips', 1, 1, 'lab', '', 516, 'yes', '03:00:00'),
(511, 5, 5, 2, 30, 'CpE-Proj2', 'Design Project 2(Project Implementation)', 2, 2, 'lab', '', 437, 'yes', '03:00:00');
INSERT INTO `subject` (`subID`, `prosID`, `yearID`, `semID`, `specID`, `subCode`, `subDesc`, `units`, `total_units`, `type`, `nonSub_pre`, `id`, `is_counted`, `hrs_per_wk`) VALUES
(512, 5, 5, 2, 27, 'ENTREP', 'Entrepreneurship', 3, 3, 'lec', '', 618, 'yes', '03:00:00'),
(513, 5, 5, 2, 27, 'SOC SCI 5', 'Philippine Government & New Constitution', 3, 3, 'lec', '', 657, 'yes', '03:00:00'),
(514, 5, 5, 2, 27, 'RIZAL COURSE', 'Life & Works of Rizal', 3, 3, 'lec', '', 431, 'yes', '03:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `subject_req`
--

CREATE TABLE `subject_req` (
  `subReqID` int(11) NOT NULL,
  `subID` int(11) NOT NULL,
  `req_type` tinyint(11) NOT NULL,
  `req_subID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_req`
--

INSERT INTO `subject_req` (`subReqID`, `subID`, `req_type`, `req_subID`) VALUES
(7, 22, 1, 11),
(8, 23, 1, 12),
(17, 35, 1, 23),
(18, 37, 1, 34),
(21, 40, 1, 26),
(22, 40, 1, 28),
(23, 41, 1, 26),
(24, 41, 1, 28),
(25, 44, 1, 26),
(29, 49, 1, 35),
(32, 53, 1, 38),
(33, 54, 1, 38),
(34, 55, 1, 40),
(35, 56, 1, 40),
(36, 57, 1, 48),
(37, 58, 1, 38),
(38, 59, 1, 38),
(39, 60, 1, 37),
(44, 71, 1, 38),
(49, 77, 1, 51),
(53, 82, 1, 78),
(54, 13, 1, 5),
(55, 16, 1, 9),
(56, 17, 1, 9),
(57, 18, 1, 7),
(58, 19, 1, 7),
(59, 20, 1, 7),
(60, 24, 1, 16),
(61, 25, 1, 16),
(62, 26, 1, 16),
(63, 27, 1, 16),
(64, 28, 1, 16),
(65, 29, 1, 16),
(68, 32, 1, 16),
(69, 33, 1, 16),
(70, 38, 1, 24),
(71, 39, 1, 24),
(72, 45, 1, 20),
(73, 46, 1, 20),
(75, 48, 1, 13),
(76, 51, 1, 42),
(77, 52, 1, 42),
(80, 66, 1, 40),
(81, 67, 1, 40),
(82, 72, 1, 61),
(83, 75, 1, 62),
(84, 76, 1, 62),
(85, 78, 1, 74),
(86, 79, 1, 66),
(87, 80, 1, 66),
(88, 64, 1, 53),
(89, 65, 1, 53),
(92, 118, 1, 89),
(93, 119, 1, 89),
(94, 117, 1, 99),
(95, 122, 1, 103),
(97, 125, 1, 106),
(98, 126, 1, 108),
(99, 127, 1, 108),
(100, 128, 1, 104),
(101, 129, 1, 104),
(112, 132, 1, 123),
(113, 133, 1, 114),
(114, 134, 1, 114),
(117, 137, 1, 130),
(118, 138, 1, 130),
(122, 145, 1, 125),
(123, 147, 1, 144),
(124, 148, 1, 141),
(125, 149, 1, 139),
(126, 150, 1, 139),
(127, 123, 1, 87),
(128, 151, 1, 137),
(129, 152, 1, 137),
(130, 153, 1, 137),
(131, 154, 1, 137),
(133, 157, 1, 145),
(134, 161, 1, 151),
(135, 162, 1, 151),
(136, 135, 1, 112),
(137, 136, 1, 112),
(138, 141, 1, 123),
(139, 155, 1, 141),
(140, 163, 1, 149),
(141, 164, 1, 149),
(142, 165, 1, 151),
(143, 166, 1, 151),
(144, 167, 1, 161),
(145, 168, 1, 161),
(146, 169, 1, 153),
(147, 170, 1, 153),
(148, 172, 1, 147),
(149, 175, 1, 135),
(150, 176, 1, 135),
(151, 178, 1, 165),
(152, 179, 1, 165),
(153, 180, 1, 163),
(154, 181, 1, 163),
(155, 182, 1, 171),
(156, 184, 1, 173),
(157, 185, 1, 173),
(161, 191, 1, 184),
(162, 192, 1, 184),
(163, 195, 1, 163),
(164, 196, 1, 163),
(167, 200, 1, 191),
(168, 201, 1, 191),
(169, 202, 1, 186),
(174, 189, 1, 178),
(175, 190, 1, 178),
(176, 198, 1, 182),
(177, 199, 1, 182),
(178, 193, 1, 198),
(179, 194, 1, 198),
(180, 207, 2, 206),
(181, 220, 1, 210),
(185, 224, 1, 211),
(186, 225, 1, 212),
(189, 228, 1, 217),
(190, 229, 1, 218),
(191, 230, 1, 219),
(193, 232, 1, 225),
(194, 233, 1, 221),
(195, 234, 1, 221),
(196, 235, 1, 225),
(197, 236, 1, 225),
(198, 237, 1, 224),
(199, 238, 1, 220),
(200, 240, 1, 228),
(201, 242, 1, 231),
(202, 243, 1, 232),
(203, 244, 1, 233),
(204, 245, 1, 233),
(205, 246, 1, 244),
(206, 247, 1, 244),
(207, 248, 1, 244),
(209, 249, 1, 237),
(210, 251, 1, 238),
(211, 252, 1, 240),
(212, 253, 1, 232),
(213, 254, 1, 232),
(214, 255, 1, 244),
(215, 256, 1, 237),
(216, 257, 1, 248),
(217, 261, 1, 223),
(218, 262, 1, 248),
(219, 263, 1, 248),
(220, 264, 1, 246),
(221, 265, 1, 246),
(222, 266, 1, 256),
(223, 267, 1, 256),
(224, 268, 1, 257),
(225, 269, 1, 257),
(226, 270, 1, 246),
(227, 271, 1, 246),
(228, 273, 1, 262),
(229, 274, 1, 253),
(230, 275, 1, 253),
(231, 277, 1, 255),
(232, 278, 1, 270),
(233, 279, 1, 270),
(234, 280, 1, 269),
(235, 281, 1, 256),
(236, 282, 1, 256),
(237, 284, 1, 270),
(238, 285, 1, 270),
(239, 287, 1, 230),
(241, 300, 1, 289),
(242, 301, 1, 292),
(243, 302, 1, 292),
(244, 304, 1, 290),
(246, 308, 1, 297),
(248, 311, 1, 301),
(249, 312, 1, 301),
(250, 314, 1, 304),
(251, 315, 1, 300),
(252, 316, 1, 304),
(253, 318, 1, 308),
(254, 319, 1, 310),
(255, 320, 1, 313),
(256, 321, 1, 311),
(257, 322, 1, 311),
(258, 323, 1, 311),
(259, 325, 1, 314),
(260, 327, 1, 315),
(261, 328, 1, 318),
(262, 337, 1, 207),
(264, 340, 1, 208),
(265, 341, 1, 329),
(266, 342, 1, 332),
(267, 343, 1, 333),
(268, 344, 1, 334),
(269, 345, 1, 336),
(270, 349, 1, 341),
(271, 350, 1, 338),
(272, 351, 1, 338),
(273, 352, 1, 341),
(274, 353, 1, 341),
(275, 354, 1, 340),
(276, 355, 1, 337),
(277, 357, 1, 345),
(278, 358, 1, 343),
(279, 360, 1, 348),
(280, 361, 1, 349),
(281, 362, 1, 350),
(282, 363, 1, 350),
(283, 364, 1, 362),
(284, 365, 1, 362),
(285, 367, 1, 362),
(286, 368, 1, 354),
(287, 370, 1, 355),
(288, 371, 1, 358),
(294, 330, 1, 91),
(295, 331, 1, 91),
(296, 309, 1, 97),
(297, 372, 1, 321),
(298, 373, 1, 321),
(299, 374, 1, 323),
(300, 375, 1, 321),
(301, 376, 1, 321),
(302, 377, 1, 311),
(303, 378, 1, 311),
(304, 379, 1, 311),
(305, 307, 1, 296),
(306, 383, 1, 375),
(307, 384, 1, 375),
(308, 385, 1, 311),
(309, 386, 1, 311),
(310, 387, 1, 311),
(311, 388, 1, 374),
(312, 389, 1, 323),
(313, 391, 1, 335),
(314, 393, 1, 377),
(315, 394, 1, 377),
(316, 398, 1, 323),
(317, 399, 1, 323),
(318, 400, 1, 391),
(319, 403, 1, 398),
(320, 404, 1, 398),
(321, 405, 1, 395),
(322, 406, 1, 395),
(323, 407, 1, 381),
(324, 408, 1, 381),
(325, 410, 1, 388),
(326, 289, 2, 288),
(327, 414, 2, 412),
(328, 415, 2, 413),
(329, 416, 2, 415),
(330, 425, 1, 414),
(331, 426, 1, 415),
(332, 427, 1, 415),
(333, 427, 1, 416),
(334, 428, 1, 415),
(335, 428, 1, 416),
(336, 429, 1, 415),
(337, 429, 1, 416),
(338, 430, 1, 415),
(339, 430, 1, 416),
(340, 432, 1, 422),
(341, 433, 1, 423),
(342, 434, 1, 424),
(343, 435, 1, 425),
(344, 436, 1, 415),
(345, 437, 1, 426),
(346, 437, 1, 427),
(347, 437, 1, 428),
(348, 439, 1, 429),
(349, 440, 1, 429),
(350, 443, 1, 432),
(351, 444, 1, 415),
(352, 445, 1, 437),
(353, 448, 1, 417),
(354, 449, 1, 417),
(355, 450, 1, 438),
(356, 451, 1, 438),
(357, 452, 1, 443),
(362, 455, 1, 439),
(363, 455, 1, 445),
(364, 456, 1, 439),
(365, 456, 1, 445),
(366, 457, 1, 439),
(367, 457, 1, 445),
(368, 458, 1, 439),
(369, 458, 1, 445),
(370, 459, 1, 445),
(371, 460, 1, 429),
(372, 460, 1, 445),
(377, 463, 1, 450),
(378, 464, 1, 450),
(379, 465, 1, 460),
(380, 466, 1, 457),
(381, 467, 1, 457),
(382, 468, 1, 457),
(383, 469, 1, 457),
(384, 470, 1, 455),
(385, 471, 1, 455),
(386, 472, 1, 459),
(387, 475, 1, 460),
(388, 477, 1, 419),
(389, 479, 1, 468),
(390, 480, 1, 468),
(391, 481, 1, 472),
(392, 482, 1, 472),
(393, 483, 1, 470),
(394, 483, 1, 466),
(396, 485, 1, 470),
(397, 485, 1, 466),
(398, 486, 1, 470),
(399, 486, 1, 466),
(400, 484, 1, 434),
(401, 489, 1, 463),
(402, 490, 1, 463),
(403, 491, 1, 463),
(404, 491, 1, 479),
(405, 492, 1, 463),
(406, 492, 1, 479),
(407, 493, 1, 483),
(408, 494, 1, 468),
(409, 494, 1, 463),
(410, 495, 1, 468),
(411, 495, 1, 463),
(412, 496, 1, 450),
(413, 497, 1, 450),
(414, 502, 1, 494),
(415, 503, 1, 493),
(416, 504, 1, 493),
(417, 505, 1, 450),
(418, 506, 1, 450),
(419, 509, 1, 450),
(420, 511, 1, 502),
(421, 188, 1, 182),
(422, 221, 1, 213),
(423, 222, 1, 213),
(424, 338, 1, 330),
(425, 74, 1, 70);

-- --------------------------------------------------------

--
-- Table structure for table `term`
--

CREATE TABLE `term` (
  `termID` int(11) NOT NULL,
  `semID` int(11) NOT NULL,
  `schoolYear` varchar(10) NOT NULL,
  `termStat` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `term`
--

INSERT INTO `term` (`termID`, `semID`, `schoolYear`, `termStat`) VALUES
(53, 2, '2018-2019', 'inactive'),
(62, 1, '2018-2019', 'active'),
(63, 1, '2019-2020', 'inactive'),
(65, 2, '2019-2020', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uID` int(11) NOT NULL,
  `roleID` int(11) NOT NULL,
  `userName` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `userPass` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `fn` varchar(25) NOT NULL,
  `mn` varchar(20) NOT NULL,
  `ln` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `address` varchar(100) NOT NULL,
  `cn` varchar(10) NOT NULL,
  `email` varchar(40) NOT NULL,
  `status` enum('inactive','active') NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uID`, `roleID`, `userName`, `userPass`, `fn`, `mn`, `ln`, `dob`, `sex`, `address`, `cn`, `email`, `status`, `date_created`) VALUES
(1, 1, 'admin', 'Iamadmin1', 'Cheryl', '', 'Tarre', '1997-10-24', 'Female', 'Kalimot ko street', '9343438534', 'cheryl@gmail.com', 'active', '2019-02-13 02:46:17'),
(47, 3, 'Prawn', 'Aprawn123', 'Angelica', '', 'Prawn', '1999-09-27', 'Female', 'Ormoc City', '2147483647', 'angelica@gmail.com', 'active', '2019-02-13 02:55:28'),
(54, 3, 'Passion', 'Rpassion123', 'Reyjoy', '', 'Passion', '2008-09-23', 'Male', 'Ormoc city', '2147483647', 'rey@gmail.com', 'active', '2019-02-13 02:55:39'),
(106, 2, 'Bernardo', 'Mbernardo123', 'Mark', '', 'Bernardo', '1992-10-30', 'Male', 'Ormoc City', '9121213939', '', 'active', '2019-02-13 03:09:12'),
(107, 2, 'Cantero', 'Jcantero123', 'Joscoro', '', 'Cantero', '1888-11-30', 'Male', 'Sanjuan', '9292726330', 'jojo@gmail.com', 'active', '2019-02-13 02:51:25'),
(108, 2, 'Phua', 'Wphua123', 'Wowie', '', 'Phua', '1888-10-25', 'Male', 'Cogon Ormoc City', '0', 'wow@gmail.com', 'active', '2019-02-28 08:54:33'),
(109, 2, 'CoHat', 'Acohat123', 'Alexander', '', 'CoHat', '1888-09-24', 'Male', 'Ormoc City', '2147483647', 'alex@gmail.com', 'active', '2019-02-13 02:56:29'),
(110, 2, 'Quirino', 'Jquirino123', 'Jhay', '', 'Quirino', '1888-01-01', 'Male', 'Ormoc City', '2147483647', 'Q@gmail.com', 'active', '2019-02-13 02:56:43'),
(111, 2, 'Martinez', 'Mmartinez123', 'Martin', '', 'Martinez', '1888-01-01', 'Male', 'Ormoc City', '2147483647', 'mm@yahoo.com', 'active', '2019-02-13 02:56:55'),
(112, 2, 'Isip', 'Aisip123123', 'Apple', '', 'Isip', '1888-01-01', 'Female', 'Ormoc City', '2147483647', 'apple@gmail.com', 'active', '2019-02-13 05:50:39'),
(113, 2, 'Tarre', 'Ctarre123', 'Cheryl', '', 'Tarre', '1888-01-01', 'Female', 'Ormoc City', '2147483647', 'che@gmail.com', 'active', '2019-02-13 02:57:15'),
(114, 2, 'Lopez', 'Jlopez123', 'Jotham', '', 'Lopez', '1888-01-01', 'Male', 'Ormoc City', '2147483647', 'jot@gmail.com', 'active', '2019-02-13 02:57:23'),
(116, 2, 'temporary', 'temporary', '', '', '', '0000-00-00', '', '', '0', '', 'active', '2018-12-31 04:06:11'),
(117, 2, 'Gablino', 'Agablino123', 'Archibald', '', 'Gablino', '1777-01-28', 'Male', 'Ormoc City', '0', 'Gablins@gmail.com', 'active', '2019-02-28 08:54:07'),
(119, 2, 'Leones', 'Nleones123', 'Nenita', '', 'Leones', '1984-12-29', 'Female', '', '2147483647', 'aaka@gmail.com', 'active', '2019-03-03 14:11:54'),
(122, 2, 'Pedro', 'Alexander123', 'Juan', '', 'Pedro', '1888-11-26', 'Male', 'Ormoc City', '9123482716', 'alex@gmail.com', 'active', '2019-02-13 05:04:56'),
(124, 3, 'Paña', 'Marvin123', 'Marvin', 'Polenio', 'Paña', '2000-09-29', 'Male', 'Ormoc City', '9121212121', 'mar@gmail.com', 'active', '2019-02-13 06:09:38'),
(125, 4, '', '', 'Mark Gil', 'Gumahin', 'Pagalan', '1998-07-05', 'Male', 'Esperanza, Pilar, Cebu, Philippines', '', '', 'inactive', '2019-02-16 06:13:08'),
(126, 4, '', '', 'Daniel', 'Rivera', 'Gadi', '0000-00-00', 'Male', '', '', '', 'inactive', '2019-02-16 06:16:37'),
(127, 4, '', '', 'Jake Austin', 'Macarine', 'Parilla', '1999-08-10', 'Male', 'SS Village, San Pablo, Ormoc City, Leyte, Philippines', '', '', 'inactive', '2019-02-16 06:18:44'),
(128, 4, '', '', 'Gerardo', 'Rojas', 'Marapoc', '2000-03-15', 'Male', 'Bliss, Ormoc City, Leyte', '', '', 'inactive', '2019-02-16 06:20:25'),
(129, 4, '', '', 'Paul Gabriel', 'Bagarinao', 'Salubre', '2000-08-27', 'Male', 'Kananga, Leyte, Philippines', '', '', 'inactive', '2019-02-16 06:22:39'),
(130, 4, '', '', 'Matthew', 'Magallanes', 'Gastardo', '2000-08-08', 'Male', 'Kananga, Leyte', '', '', 'inactive', '2019-02-16 06:25:08'),
(131, 4, '', '', 'Melquicedec', '', 'Luronilla', '1999-04-10', 'Male', 'Ballera St., Poruks, Libertad, Isabel, Leyte', '', '', 'inactive', '2019-02-16 06:27:21'),
(132, 4, '', '', 'Henry', 'Taigo', 'Manuta', '1998-04-06', 'Male', 'RCV, Bagongbuhay, Ormoc City, Leyte', '9753866020', '', 'inactive', '2019-02-16 06:29:53'),
(133, 4, '', '', 'Mark Lloyd', 'Catagug', 'Ticao', '1981-03-17', 'Male', 'San Pedro, Albuera, Leyte', '9171579287', '', 'inactive', '2019-02-16 06:32:42'),
(134, 4, '', '', 'Anton John', 'Quilay', 'Mendola', '0000-00-00', 'Male', 'Can-adieng, Ormoc City', '', '', 'inactive', '2019-02-16 06:34:08'),
(135, 4, '', '', 'Danica', 'Arevalo', 'Betita', '1999-03-09', 'Female', 'Sto. Niño Village, Baybay City, Leyte', '', '', 'inactive', '2019-02-16 06:35:43'),
(136, 4, '', '', 'Jerome', 'Mabale', 'Solteo', '1993-07-04', 'Male', 'Brgy. San Isidro, Owak, Ormoc City', '9562432030', '', 'inactive', '2019-02-16 06:37:47'),
(137, 4, '', '', 'Raphy', 'Malda', 'Boljoran', '1997-11-14', 'Male', 'Sangabon, Biasong, San Isidro, Leyte', '', '', 'inactive', '2019-02-16 06:39:30'),
(138, 4, '', '', 'Hector Bien', 'Ibalaroga', 'Tan', '1993-06-05', 'Male', 'A. Tumamak, Villaba, Ormoc, Leyte', '', '', 'inactive', '2019-02-16 06:41:02'),
(139, 4, '', '', 'Mark Jerwin', 'Estor', 'Asumbra', '1999-11-03', 'Male', 'San Roque, Uno Ipil, Ormoc City, Leyte', '', '', 'inactive', '2019-02-16 06:42:31'),
(140, 4, '', '', 'Marian', 'A', 'Gonzalo', '1999-05-11', 'Female', 'Blk. 19, Lot 8, New Camella Homes, Tambulilid, Ormoc City', '9178168869', '', 'inactive', '2019-02-16 06:44:16'),
(141, 4, '', '', 'Jude Mar', 'Bayo', 'Navia', '1999-08-21', 'Male', 'Nadongholan, Ormoc City, Leyte', '', '', 'inactive', '2019-02-16 06:45:21'),
(142, 4, '', '', 'Jedrek Mishael', 'Omega', 'Perez', '1999-09-12', 'Male', 'Arradaza, Dist. 10, Ormoc City, Leyte', '', '', 'inactive', '2019-02-16 06:46:41'),
(144, 4, '', '', 'Melvin', 'Gelagia', 'Abejaron Jr', '1998-01-04', 'Male', 'Purok 4, Tigbawan, Plaridel, Baybay City, Leyte', '', '', 'inactive', '2019-02-16 06:52:56'),
(145, 4, '', '', 'Fernoelbert', 'Longakit', 'Caranto', '1996-03-23', 'Male', '#503, Sitio Kalipay, Brygy. Cogon, Ormoc City, Leyte', '9261239584', '', 'inactive', '2019-02-16 06:55:20'),
(146, 4, '', '', 'Francis John', 'Castor', 'Bilbao', '1998-06-20', 'Male', 'Brgy. Malbasag, Dist. 28, Ormoc City, Leyte', '9104136644', '', 'inactive', '2019-02-16 06:57:01'),
(147, 4, '', '', 'Melvin', 'Gerondio', 'Aborita', '1996-10-25', 'Male', 'Purok 3, Tongonan, Kananga, Leyte', '9128662902', '', 'inactive', '2019-02-16 06:58:48'),
(148, 4, '', '', 'John Louise', '', 'Felecita', '1999-04-23', 'Male', 'Bantigue, Ormoc City', '', '', 'inactive', '2019-02-16 06:59:56'),
(149, 4, '', '', 'Alexus Alan', 'Talle', 'Abe', '1998-07-21', 'Male', 'Bilpha, Bilwang, Isabel, Leyte', '', '', 'inactive', '2019-02-16 07:01:23'),
(150, 4, '', '', 'Ralph Steeve', 'Maradan', 'Miralles', '1995-02-24', 'Male', 'Tinago, Poblacion, Merida, Leyte', '', '', 'inactive', '2019-02-16 07:03:28'),
(151, 4, '', '', 'Joshua', 'Tabon', 'Libres', '1993-08-26', 'Male', 'Brgy. Patag, Ormoc City, Leyte', '9503260075', '', 'inactive', '2019-02-16 07:05:04'),
(152, 4, '', '', 'Roger', 'Gontinas', 'Laurente Jr', '1999-05-02', 'Male', 'Bagongbuhay, Ormoc City, Leyte', '', '', 'inactive', '2019-02-16 07:06:55'),
(153, 4, '', '', 'Leah', 'Arellano', 'Fuerza', '1994-10-28', 'Female', 'Montebello, Kananga, Leyte', '', '', 'inactive', '2019-02-16 07:09:58'),
(154, 4, '', '', 'Juncel', 'Gloria', 'Villar', '1999-03-19', 'Male', 'Golden Shower, Isabel Leyt', '', '', 'inactive', '2019-02-16 07:11:15'),
(155, 4, '', '', 'Earnest Daniel', '', 'Nicolas', '1998-11-04', 'Male', 'Blk 6 Lot 8, San Pablo, Ormoc City', '', '', 'inactive', '2019-02-16 07:12:57'),
(156, 4, '', '', 'Arvin Jake', 'Tolero', 'Daffon', '1998-11-02', 'Male', 'Lawis St., Poblacion, Albuera Leyte', '', '', 'inactive', '2019-02-16 07:14:06'),
(157, 4, '', '', 'Jasper', 'Tequillo', 'Bauyaban', '1996-08-23', 'Male', 'Waling-waling, Punta, Ormoc City', '', '', 'inactive', '2019-02-16 07:15:38'),
(158, 4, '', '', 'Lloyd', 'Gonzales', 'Perez', '1998-07-12', 'Male', 'Lundag, Merida, Leyte', '', '', 'inactive', '2019-02-16 07:16:39'),
(159, 4, '', '', 'Joseph Stephen', 'P', 'Molato', '1997-07-01', 'Male', 'Ormoc Leyte', '', '', 'inactive', '2019-02-16 07:18:05'),
(160, 4, '', '', 'Ernest Daniel', 'Panes', 'Maballo', '1998-12-16', 'Male', 'Doña Feliza Mejia, Ormoc City, Leyte', '9196381024', '', 'inactive', '2019-02-16 07:19:54'),
(161, 4, '', '', 'Patrick', 'Anonat', 'Labra', '1999-03-11', 'Male', 'Camp Downes, Ormoc City, Leyte', '', '', 'inactive', '2019-02-16 07:21:26'),
(162, 4, '', '', 'Rhodnie', 'Ellazo', 'Baguna', '1998-08-17', 'Male', 'Matlang, Isabel, Leyte', '9777777777', '', 'inactive', '2019-02-16 07:25:41'),
(163, 4, '', '', 'Archangel Philip', 'D', 'Malupa', '1998-06-12', 'Male', 'Cogon, Ormoc City, Leyte', '', '', 'inactive', '2019-02-16 07:27:24'),
(164, 4, '', '', 'Jana Emilyn', 'Chu', 'Mendoza', '1999-01-15', 'Female', 'Brgy. Concepcion, Ormoc City, Leyte', '', '', 'inactive', '2019-02-16 07:29:14'),
(165, 4, '', '', 'JJ Loraine', 'Erejer', 'Daga', '1999-03-25', 'Female', 'Calubi-an, Bilwang, Isabel, Leyte', '', '', 'inactive', '2019-03-11 07:06:22'),
(166, 4, '', '', 'Flaubert', 'Mangano', 'Gonzalez', '1998-02-03', 'Male', 'Libertad, Ormoc, City', '9091741045', '', 'inactive', '2019-02-16 07:33:18'),
(167, 4, '', '', 'Dan Clifford', 'Tiongson', 'Capuyan', '1998-12-23', 'Male', 'Sitio Lawis, Isabel, Leyte', '', '', 'inactive', '2019-02-16 07:34:39'),
(168, 4, '', '', 'Jheesheil', 'Labor', 'Marapoc', '1997-12-17', 'Female', 'Valencia, Ormoc City, Leyte', '', '', 'inactive', '2019-02-16 07:35:58'),
(169, 4, '', '', 'Michael Joseph', 'Fornes', 'Morilla', '1997-08-22', 'Male', 'Brgy. Tambulilid, Ormoc City, Leyte', '', '', 'inactive', '2019-02-16 07:38:04'),
(170, 4, '', '', 'Reyster', '', 'Lim', '1997-08-01', 'Male', 'Linao, Ormoc, City', '', '', 'inactive', '2019-02-16 07:39:04'),
(172, 4, '', '', 'Elmer Enrico', 'Suson', 'Mendoza', '1997-12-15', 'Male', 'Concepciom, Ormoc City', '', '', 'inactive', '2019-02-16 07:40:11'),
(173, 4, '', '', 'Juliza', 'Dumago', 'Peroramas', '1997-05-16', 'Female', 'Brgy. San Isidro, Palompon, Leyte', '', '', 'inactive', '2019-02-16 07:41:43'),
(174, 4, '', '', 'Alastier Boy', 'Barrunn', 'Catayoc', '1998-06-07', 'Male', 'Danlug, Ormoc City', '', '', 'inactive', '2019-02-16 07:43:05'),
(175, 4, '', '', 'Lyll Brex Arnel', 'Balunan', 'Marquez', '1998-09-07', 'Male', 'Brgy. Lilo-an, Ormoc City', '9667928757', '', 'inactive', '2019-02-16 07:44:24'),
(176, 4, '', '', 'Ailen', 'Pepito', 'Malinao', '1997-08-12', 'Female', 'Inday Dora St., Urban Poor, Poblacion, Kananga, Leyte', '', '', 'inactive', '2019-02-16 07:45:50'),
(177, 4, '', '', 'Jhon Carlo', 'Orot', 'Victorio', '1994-08-01', 'Male', 'Purok 13, Linao, Ormoc City', '', '', 'inactive', '2019-02-16 07:47:09'),
(178, 4, '', '', 'Jowena', '', 'Arjona', '1997-11-11', 'Female', '212 Libertad St., Central II, Palompon, Leyte', '', '', 'inactive', '2019-02-16 07:48:26'),
(179, 4, '', '', 'Lieza Jeane', 'Monte', 'Seco', '1997-11-03', 'Female', 'Zamora, San Guillermo, Matag-ob, Leyte', '', '', 'inactive', '2019-02-16 07:49:49'),
(180, 4, '', '', 'John Mario', 'Laude', 'Agcang', '1997-03-29', 'Male', 'San Isidro, Ormoc City', '', '', 'inactive', '2019-02-16 07:51:45'),
(181, 4, '', '', 'John Carlo', 'Villero', 'Trinidad', '1998-01-16', 'Male', 'P 3, Libertad, Isabel, Leyte', '', '', 'inactive', '2019-02-16 07:53:14'),
(182, 4, '', '', 'Francis', 'Mendoza', 'Magno', '0000-00-00', 'Male', 'Ormoc City', '9012958899', '', 'inactive', '2019-02-16 07:54:43'),
(183, 4, '', '', 'Michael', 'Ablen', 'Romero', '1996-04-10', 'Male', 'Blk 8 Lot 18, Tentcity, San Isidro, Leyt', '9104136992', '', 'inactive', '2019-02-16 07:56:27'),
(184, 4, '', '', 'Mecca', '', 'Cabaron', '1997-08-28', 'Female', 'San Pablo, Ormoc City', '', '', 'inactive', '2019-02-16 07:58:05'),
(185, 4, '', '', 'Richie', 'Concepcion', 'Victorio', '1997-11-28', 'Male', 'Tongonan, Ormoc City', '', '', 'inactive', '2019-02-16 07:59:03'),
(186, 4, '', '', 'Francis Pete', 'Arino', 'Caberos', '0000-00-00', 'Male', 'National Road, San Isidro, Owak, Ormoc City', '9062739677', '', 'inactive', '2019-02-17 01:17:04'),
(187, 4, '', '', 'Kay Kent', 'R', 'Cantero', '1997-10-16', 'Male', 'San Juan, Ormoc City', '3954444970', '', 'inactive', '2019-02-17 01:18:53'),
(188, 4, '', '', 'Francis Amil', 'Pelostratos', 'Collano', '2000-06-02', 'Male', 'Dapdap, Pilar, Cebu', '', '', 'inactive', '2019-02-17 01:20:30'),
(189, 4, '', '', 'Neil Andrei', 'Mojado', 'Conejos', '1999-07-30', 'Male', 'Kananga, Ormoc City', '', '', 'inactive', '2019-02-17 01:21:56'),
(190, 4, '', '', 'Arthur Louise', 'Hermias', 'Gallano', '1997-04-30', 'Male', 'San Pedro St., Dist. 13, Ormoc City', '9276402412', '', 'inactive', '2019-02-17 01:23:47'),
(191, 4, '', '', 'Ira', 'Eajardo', 'Gonsaga', '1999-11-04', 'Female', 'Ipil, World Vision, Ormoc City', '', '', 'inactive', '2019-02-17 01:26:59'),
(192, 4, '', '', 'Xhryeh', 'Hernandez', 'Malate', '2000-04-22', 'Male', 'Fatima, Villaba, Leyte', '9291640028', '', 'inactive', '2019-02-17 01:29:09'),
(193, 4, '', '', 'Anton John', 'Quilay', 'Mendola', '1999-01-21', 'Male', '696 R. Rivilla St., Can-adieng, Ormoc City', '', '', 'inactive', '2019-02-17 01:30:54'),
(194, 4, '', '', 'Robostiano', 'Pole', 'Mesias', '1997-11-20', 'Male', 'Sitio Tabok, Brgy. Mabato, Ormoc City', '', '', 'inactive', '2019-02-17 01:32:24'),
(195, 4, '', '', 'Mark Gil', 'Gumahin', 'Pagalan', '1998-07-05', 'Male', 'Esperanzia, Pilar, Cebe City', '9083887285', '', 'inactive', '2019-02-17 01:34:03'),
(196, 4, '', '', 'Darlene', 'Lum oc', 'Pepito', '2018-06-01', 'Female', 'Cambalading, Albuera, Leyte', '', '', 'inactive', '2019-02-17 01:41:22'),
(197, 4, '', '', 'Aris', 'Indolos', 'Pino', '1997-03-31', 'Male', 'San Juan, Ormoc City', '', '', 'inactive', '2019-02-17 01:50:04'),
(198, 4, '', '', 'Khristian Dave', 'Garciano', 'Quiros', '2000-06-22', 'Male', 'Doroc, Ormoc City', '', '', 'inactive', '2019-02-17 01:51:41'),
(199, 4, '', '', 'Benjie', 'Rica', 'Roque', '1991-09-18', 'Male', 'Buenavista, Palompon, Leyte', '9752096297', '', 'inactive', '2019-02-17 01:53:20'),
(200, 4, '', '', 'Christian Angelo', 'Degecho', 'Taclas', '2000-02-28', 'Male', 'Cambalading, Albuera, Leyte', '', '', 'inactive', '2019-02-17 01:54:58'),
(201, 4, '', '', 'Rodney', 'Caballero', 'Tagalog', '0000-00-00', 'Male', 'Linao, Ormoc City', '', '', 'inactive', '2019-02-17 01:56:14'),
(202, 4, '', '', 'Mark Lloyd', 'Catague', 'Ticao', '1991-03-17', 'Male', 'Katipunan, San Pedro, Albuera, Leyte', '9171579287', '', 'inactive', '2019-02-17 01:57:51'),
(203, 4, '', '', 'Leanne Abbie', 'Alibio', 'Valledores', '1999-09-20', 'Male', 'San Jose, Ormoc City', '', '', 'inactive', '2019-02-17 01:58:58'),
(204, 4, '', '', 'John Carlo', 'Cullano', 'Vecedo', '1998-01-07', 'Male', 'Tambulilid, Ormoc City', '', '', 'inactive', '2019-02-17 02:00:02'),
(205, 4, '', '', 'Maxine Inez', 'Laranjo', 'Villamor', '1995-10-25', 'Female', 'Brgy. Punta, Ormoc City', '9777777777', '', 'inactive', '2019-02-17 02:01:44'),
(206, 4, '', '', 'Kaye', 'Mejares', 'Wenceslao', '1998-10-03', 'Female', 'Sitio Punay, Tugbong, Kananga, Leyte', '', '', 'inactive', '2019-02-17 02:08:24'),
(207, 4, '', '', 'John Mickel', 'Agudera', 'Almene', '1993-11-21', 'Male', 'Tabok, Hindang, Leyte', '', '', 'inactive', '2019-02-17 07:59:12'),
(208, 4, '', '', 'Dennis Jay', 'Duazo', 'Encienzo', '1997-12-30', 'Male', 'BB. Dec Norte, Villaba, Leyte', '', '', 'inactive', '2019-02-17 08:02:03'),
(209, 4, '', '', 'Joshua Benedict', 'Laygan', 'Lao', '1997-03-25', 'Male', 'J. Navarro St., Ormoc City', '9482358010', '', 'inactive', '2019-02-17 08:03:54'),
(210, 4, '', '', 'Donald Joseph', 'S', 'Oloroso', '0094-07-08', 'Male', 'Cogon, Ormoc City', '', '', 'inactive', '2019-02-17 08:05:56'),
(211, 4, '', '', 'Victor', 'Gullena', 'Sabite Jr', '1996-10-06', 'Male', 'Zone II, Riverside, Lemon, Capoocan, Leyte', '9067060656', '', 'inactive', '2019-02-17 08:07:59'),
(212, 4, '', '', 'Manuelito', 'Villasan', 'Sano', '1993-09-12', 'Male', 'Tambulilid, Ormoc City', '9302020540', '', 'inactive', '2019-02-17 08:09:29'),
(213, 4, '', '', 'Francis Ebenescit', 'Baul', 'Tolibao', '2018-10-10', 'Male', 'Brgy. San Isidro, Ormoc City', '9274287375', '', 'inactive', '2019-02-17 08:11:36'),
(214, 4, '', '', 'Julie', 'Sabino', 'Atup', '1999-07-13', 'Female', 'Brgy. Macabug, Ormoc City', '9453373217', '', 'inactive', '2019-02-17 08:21:55'),
(215, 4, '', '', 'Merlo John', 'Sabite', 'Baclohan', '1998-02-01', 'Male', 'Ducalang, Poblacion, Kananga, Leyte', '', '', 'inactive', '2019-02-17 08:24:29'),
(216, 4, '', '', 'Lemariae', 'Poraza', 'Bongbong', '1997-12-08', 'Female', 'Tinago, Palompon, Leyte', '', '', 'inactive', '2019-02-17 08:25:53'),
(217, 4, '', '', 'Arvin', 'Payod', 'Borja', '1998-11-18', 'Male', 'Sica Lao, Ormoc, Leyte', '', '', 'inactive', '2019-02-17 08:27:10'),
(218, 4, '', '', 'Jessah', 'Moana', 'Cabintoy', '1997-06-23', 'Female', 'Brgy. Talisayan, Albuera, Leyte', '9159689939', '', 'inactive', '2019-02-17 08:28:47'),
(219, 4, '', '', 'Johnvy Mark', 'Pagalan', 'Cayang', '1998-10-05', 'Male', 'Matlang, Isabel, Leyte', '', '', 'inactive', '2019-02-17 08:30:01'),
(220, 4, '', '', 'Maricon Francis', 'Laguna', 'Daffon', '1997-12-08', 'Female', 'Curva, Ormoc City', '909934253', '', 'inactive', '2019-02-17 08:31:59'),
(221, 4, '', '', 'Lance', 'Villarin', 'De Los Santos', '1995-12-06', 'Male', 'Mabini St., Ormoc City', '', '', 'inactive', '2019-02-17 08:33:16'),
(222, 4, '', '', 'Greg', 'Poricalwan', 'Domanillo', '1996-09-18', 'Male', 'Gaas, Ormoc City', '', '', 'inactive', '2019-02-17 08:34:42'),
(223, 4, '', '', 'Joshua Lhorman', 'Gomez', 'Domingo', '1999-08-06', 'Male', 'Katambisan, San Isidro, Ormoc City', '', '', 'inactive', '2019-02-17 08:36:33'),
(224, 4, '', '', 'James', 'Samson', 'Gravinez', '1993-12-05', 'Male', 'Liliz Ave., Cogon, Ormoc City', '', '', 'inactive', '2019-02-17 08:37:47'),
(225, 4, '', '', 'Adrian', 'Rivera', 'Lucero', '1996-03-04', 'Male', 'Revilla St., Can-adieng, Ormoc City', '', '', 'inactive', '2019-02-17 08:39:22'),
(226, 4, '', '', 'Christian Dominic', '', 'Magtibay', '1998-08-20', 'Male', 'Isabel, Leyte', '9050246274', '', 'inactive', '2019-02-17 08:41:06'),
(227, 4, '', '', 'Ace', 'Baring', 'Matuguina', '1998-02-02', 'Male', 'Camp Downes, Ormoc City', '9508204879', '', 'inactive', '2019-02-17 08:42:29'),
(228, 4, '', '', 'Martin Dave', 'M', 'Matuguina', '1996-09-04', 'Male', 'Bagongbuhay, Ormoc City', '', '', 'inactive', '2019-02-17 08:43:38'),
(229, 4, '', '', 'Lemuel', '', 'Ragasi', '1997-11-07', 'Male', 'Albuera, Leyte', '', '', 'inactive', '2019-02-17 08:44:48'),
(230, 4, '', '', 'Ray Jhay', 'Arcelo', 'Alag', '1997-02-24', 'Male', 'Curva, Ormoc City', '', '', 'inactive', '2019-02-20 00:06:58'),
(231, 4, '', '', 'Merzon', 'Bulawan', 'Albarico', '1996-01-31', 'Male', 'Tent City, San Isidro, Ormoc City', '', '', 'inactive', '2019-02-20 00:10:49'),
(232, 4, '', '', 'Jewel Jan', '', 'Apuya', '1997-11-19', 'Male', 'Dayhagan, Ormoc City', '', '', 'inactive', '2019-02-20 00:12:26'),
(233, 4, '', '', 'June Rick', 'Pono', 'Bacus', '1998-06-16', 'Male', 'Seguinon, Albuera, Leyte', '', '', 'inactive', '2019-02-20 00:21:41'),
(234, 4, '', '', 'Scyth Rash Xyl', 'Puray', 'Badayos', '1998-03-13', 'Female', 'Bonifacio St., Ormoc City', '', '', 'inactive', '2019-02-20 00:23:06'),
(235, 4, '', '', 'Anikka Gayle', 'Tanza', 'Balancio', '1999-02-12', 'Female', 'Brgy. Jica lao, Ormoc City', '', '', 'inactive', '2019-02-20 00:25:10'),
(236, 4, 'Angel', 'Abanez123', 'Angel Jean', 'Quinte', 'Banez', '1999-01-20', 'Female', 'Barriosite, Casilda, Merida, Leyte', '9484924901', '', 'active', '2019-03-13 07:51:48'),
(237, 4, '', '', 'Jayboy', 'P', 'Banzal', '1997-06-02', 'Male', 'Puertobello, Merida, Leyte', '', '', 'inactive', '2019-02-20 00:28:22'),
(238, 4, '', '', 'Angel', 'Abenio', 'Bestil', '1999-01-10', 'Female', 'Pob. Albuera, Leyte', '9075566126', '', 'inactive', '2019-02-20 00:29:52'),
(239, 4, '', '', 'Mayette', 'Hentica', 'Bulahan', '1999-05-09', 'Female', 'San Vicente, Ormoc City', '', '', 'inactive', '2019-02-20 00:31:01'),
(240, 4, '', '', 'Dave Vincent', 'S', 'Camasura', '1998-04-14', 'Male', 'Villa Theresa, Linao, Ormoc City', '9277736637', '', 'inactive', '2019-02-20 00:32:25'),
(241, 4, '', '', 'Julito', 'Asayas', 'Caquilala II', '1998-04-28', 'Male', 'Tambulilid, Ormoc City', '', '', 'inactive', '2019-02-20 00:33:39'),
(242, 4, '', '', 'Omar', 'Ruiz', 'Cayambulan', '1999-07-02', 'Male', 'San Isidro, Leyte', '', '', 'inactive', '2019-02-20 00:35:14'),
(243, 4, '', '', 'Keen Gerald', 'Estoy', 'Cormanes', '1995-01-23', 'Male', 'Can-adieng, Ormoc City', '', '', 'inactive', '2019-02-20 00:36:33'),
(244, 4, '', '', 'Joseph Ken', '', 'Estrera', '1998-11-30', 'Male', 'Altavista, Ormoc City', '', '', 'inactive', '2019-02-20 00:37:53'),
(245, 4, 'william', '123', 'William Jay', 'Intales', 'Inclino', '1997-10-24', 'Male', 'Biasong, Puertobello, Merida, Leyte', '9106024370', '', '', '2019-03-19 12:18:22'),
(246, 4, '', '', 'Karl Vincent', 'Pedroza', 'Laurente', '0000-00-00', 'Male', 'San Isidro, Tent City, Ormoc City', '', '', 'inactive', '2019-02-20 00:40:31'),
(247, 4, '', '', 'Maria Avegiel', 'T', 'Libres', '1998-02-09', 'Female', 'Calunangan, Merida, Leyte', '', '', 'inactive', '2019-02-20 00:41:54'),
(248, 4, '', '', 'Raffy', 'Bogtong', 'Pacala', '1998-12-16', 'Male', 'Libertad, Isabel, Leyte', '', '', 'inactive', '2019-02-20 00:43:00'),
(249, 4, '', '', 'Noli', 'Aranez', 'Pernes', '1999-04-12', 'Male', 'Ipil, Ormoc City', '', '', 'inactive', '2019-02-20 00:44:06'),
(250, 4, '', '', 'Harry Albert', 'Pulgo', 'Reyes', '1993-01-01', 'Male', 'Camp Downes, Ormoc City', '', '', 'inactive', '2019-02-20 00:46:04'),
(251, 4, '', '', 'Francis Hope', 'Alba', 'Rivera', '1997-03-03', 'Male', 'Ipil, Ormoc City', '', '', 'inactive', '2019-02-20 00:47:06'),
(252, 4, '', '', 'Khennie Rose', 'Tugbo', 'Sumile', '1998-03-17', 'Female', 'Balite, Villaba, Leyte', '', '', 'inactive', '2019-02-20 00:48:27'),
(253, 4, '', '', 'Joshua', 'J', 'Tayag', '1998-07-30', 'Male', 'San Antonio, Ormoc City', '', '', 'inactive', '2019-02-20 00:49:24'),
(254, 4, '', '', 'Justine Geralde', 'Guyjoro', 'Varga', '1997-06-19', 'Male', 'Luna, Ormoc City', '', '', 'inactive', '2019-02-20 00:50:43'),
(255, 4, '', '', 'Rea Lizel', 'Alerta', 'Villa', '1999-03-28', 'Female', 'Brgy. San Pablo, Ormoc City', '', '', 'inactive', '2019-02-20 00:51:59'),
(256, 4, '', '', 'Laurence Clint', '', 'Villarin', '1994-04-12', 'Male', 'Ormoc City', '', '', 'inactive', '2019-02-20 00:55:43'),
(257, 4, '', '', 'Mitzi', 'Dayandayan', 'Yap', '1998-12-21', 'Female', 'Honan, Isabel, Leyte', '', '', 'inactive', '2019-02-20 00:56:57'),
(258, 2, 'williamjay.inclino', 'trqNEa8A', 'Divina', '', 'Sagales', '1900-01-02', 'Female', 'ormoc city', '9213121231', 'williamjay.inclino@gmail.com', 'active', '2019-03-05 06:24:36'),
(259, 4, '', '', 'Rafael', '', 'Anoos', '1996-10-26', 'Male', 'Lilo-an', '9367281927', '', 'inactive', '2019-03-07 03:02:48'),
(260, 4, '', '', 'Ian Celmar', 'Alicaya', 'Avila', '1999-10-14', 'Male', 'Ipil, Ormoc City', '9488281046', '', 'inactive', '2019-03-07 03:07:51'),
(261, 4, '', '', 'Geneveve', 'Ortega', 'Baise', '2000-06-07', 'Female', 'San Juan, Ormoc City', '9068794979', '', 'inactive', '2019-03-07 03:13:41'),
(263, 4, '', '', 'fname', 'mname', 'lname', '2019-01-02', 'Male', 'sa', '', '', 'inactive', '2019-03-08 12:26:22'),
(264, 4, '', '', 'Luis Fernando', '', 'Magalona', '1997-08-04', 'Male', 'San Isidro, Ormoc City', '', '', 'inactive', '2019-03-10 12:11:30'),
(265, 4, '', '', 'Joed Gil', 'Hara', 'Laurito', '1994-03-06', 'Male', 'Isabel Leyte', '', '', 'inactive', '2019-03-10 13:02:44'),
(266, 4, '', '', 'Christian James', 'Garrido', 'Baring', '1997-02-09', 'Male', 'Tambulilid, Ormoc City', '', '', 'inactive', '2019-03-11 06:51:55'),
(267, 4, '', '', 'Ferdinand', 'Quiapo', 'Madjus', '1999-03-29', 'Male', 'Manlilinao, Ormoc City', '', '', 'inactive', '2019-03-11 11:52:12'),
(268, 4, '', '', 'Ian', 'Christian', 'Evangelista', '1990-02-18', 'Male', 'Dolores', '', '', 'inactive', '2019-03-11 12:32:16'),
(269, 4, '', '', 'Jomari Jose Alonzo', 'Barbon', 'Bunye', '1998-12-05', 'Male', 'Tambulilid', '', '', 'inactive', '2019-03-11 12:34:50'),
(270, 4, '', '', 'Lemuel', 'Martinez', 'Campo', '1998-04-14', 'Male', 'Linao, Ormoc City', '', '', 'inactive', '2019-03-11 12:38:13'),
(271, 4, '', '', 'Benjamin', 'Barron', 'Mistula', '1992-04-11', 'Male', 'Dolores', '', '', 'inactive', '2019-03-11 12:41:15'),
(272, 4, '', '', 'Rhandylle', '', 'Reluya', '1998-01-08', 'Male', 'Linao, Ormoc City', '', '', 'inactive', '2019-03-11 12:43:51');

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE `year` (
  `yearID` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `yearDesc` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `year`
--

INSERT INTO `year` (`yearID`, `duration`, `yearDesc`) VALUES
(1, 1, '1st Year'),
(2, 2, '2nd Year'),
(3, 3, '3rd Year'),
(4, 4, '4th Year'),
(5, 5, '5th Year');

-- --------------------------------------------------------

--
-- Table structure for table `year_req`
--

CREATE TABLE `year_req` (
  `yrID` int(11) NOT NULL,
  `subID` int(11) NOT NULL,
  `yearID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `year_req`
--

INSERT INTO `year_req` (`yrID`, `subID`, `yearID`) VALUES
(1, 392, 3),
(2, 397, 4),
(3, 438, 2),
(4, 453, 3),
(5, 454, 3),
(6, 461, 3),
(7, 473, 3),
(8, 476, 3),
(9, 478, 3),
(10, 487, 4),
(11, 488, 4),
(12, 498, 4),
(13, 499, 4),
(17, 507, 4),
(18, 510, 5),
(19, 512, 5),
(20, 501, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_rights`
--
ALTER TABLE `access_rights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uID` (`uID`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`classID`),
  ADD UNIQUE KEY `classID` (`classID`),
  ADD KEY `term_id` (`termID`),
  ADD KEY `sub_id` (`subID`),
  ADD KEY `room_id` (`roomID`),
  ADD KEY `user_id` (`facID`),
  ADD KEY `secID` (`secID`),
  ADD KEY `dayID` (`dayID`);

--
-- Indexes for table `counter`
--
ALTER TABLE `counter`
  ADD PRIMARY KEY (`countID`);

--
-- Indexes for table `counter2`
--
ALTER TABLE `counter2`
  ADD PRIMARY KEY (`countID`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseID`),
  ADD UNIQUE KEY `courseID` (`courseID`);

--
-- Indexes for table `day`
--
ALTER TABLE `day`
  ADD PRIMARY KEY (`dayID`),
  ADD UNIQUE KEY `dayID` (`dayID`),
  ADD KEY `dayID_2` (`dayID`);

--
-- Indexes for table `deanslist_reqs`
--
ALTER TABLE `deanslist_reqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `termID` (`termID`);

--
-- Indexes for table `enrolment_settings`
--
ALTER TABLE `enrolment_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`facID`),
  ADD UNIQUE KEY `uID` (`facID`),
  ADD KEY `user_logID` (`uID`);

--
-- Indexes for table `fac_spec`
--
ALTER TABLE `fac_spec`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facID` (`facID`),
  ADD KEY `specID` (`specID`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`feeID`),
  ADD UNIQUE KEY `feeID` (`feeID`),
  ADD KEY `term_id` (`termID`);

--
-- Indexes for table `grade_formula`
--
ALTER TABLE `grade_formula`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade_metric`
--
ALTER TABLE `grade_metric`
  ADD PRIMARY KEY (`entryID`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studID` (`studID`),
  ADD KEY `uID` (`uID`),
  ADD KEY `feeID` (`feeID`),
  ADD KEY `trans_feeID` (`trans_feeID`);

--
-- Indexes for table `prospectus`
--
ALTER TABLE `prospectus`
  ADD PRIMARY KEY (`prosID`),
  ADD UNIQUE KEY `prosID_2` (`prosID`),
  ADD KEY `course_id` (`courseID`),
  ADD KEY `prosID` (`prosID`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports_date`
--
ALTER TABLE `reports_date`
  ADD PRIMARY KEY (`id`),
  ADD KEY `termID` (`termID`);

--
-- Indexes for table `requisite_type`
--
ALTER TABLE `requisite_type`
  ADD PRIMARY KEY (`req_type`),
  ADD UNIQUE KEY `typeID` (`req_type`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleID`),
  ADD UNIQUE KEY `roleID` (`roleID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomID`),
  ADD UNIQUE KEY `roomID` (`roomID`);

--
-- Indexes for table `room_spec`
--
ALTER TABLE `room_spec`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roomID` (`roomID`),
  ADD KEY `specID` (`specID`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`secID`),
  ADD UNIQUE KEY `secID` (`secID`),
  ADD KEY `courseID` (`courseID`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semID`),
  ADD UNIQUE KEY `semID` (`semID`);

--
-- Indexes for table `specialization`
--
ALTER TABLE `specialization`
  ADD PRIMARY KEY (`specID`),
  ADD KEY `prosID` (`prosID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffID`),
  ADD UNIQUE KEY `uID` (`staffID`),
  ADD KEY `user_logID` (`uID`);

--
-- Indexes for table `studclass`
--
ALTER TABLE `studclass`
  ADD PRIMARY KEY (`scID`),
  ADD UNIQUE KEY `scID` (`scID`),
  ADD KEY `class_id` (`classID`),
  ADD KEY `sid` (`studID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studID`),
  ADD UNIQUE KEY `studID` (`studID`),
  ADD KEY `yearID` (`yearID`),
  ADD KEY `uID` (`uID`);

--
-- Indexes for table `studgrade`
--
ALTER TABLE `studgrade`
  ADD PRIMARY KEY (`sgID`),
  ADD UNIQUE KEY `sgID` (`sgID`),
  ADD KEY `studID` (`studID`),
  ADD KEY `subID` (`subID`),
  ADD KEY `uID` (`uID`),
  ADD KEY `termID` (`termID`);

--
-- Indexes for table `studprospectus`
--
ALTER TABLE `studprospectus`
  ADD PRIMARY KEY (`spID`),
  ADD UNIQUE KEY `spID` (`spID`),
  ADD KEY `sid` (`studID`),
  ADD KEY `pros_id` (`prosID`);

--
-- Indexes for table `studrec_per_term`
--
ALTER TABLE `studrec_per_term`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studID` (`studID`),
  ADD KEY `yearID` (`yearID`),
  ADD KEY `termID` (`termID`),
  ADD KEY `prosID` (`prosID`);

--
-- Indexes for table `stud_fee`
--
ALTER TABLE `stud_fee`
  ADD PRIMARY KEY (`sfID`),
  ADD UNIQUE KEY `sfID` (`sfID`),
  ADD KEY `sid` (`studID`),
  ADD KEY `fee_id` (`feeID`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subID`),
  ADD UNIQUE KEY `subID` (`subID`),
  ADD KEY `prosID` (`prosID`,`yearID`,`semID`),
  ADD KEY `yearID` (`yearID`),
  ADD KEY `semID` (`semID`),
  ADD KEY `specID` (`specID`);

--
-- Indexes for table `subject_req`
--
ALTER TABLE `subject_req`
  ADD PRIMARY KEY (`subReqID`),
  ADD UNIQUE KEY `subReqID` (`subReqID`),
  ADD KEY `subID` (`subID`),
  ADD KEY `typeID` (`req_type`),
  ADD KEY `req_subID` (`req_subID`);

--
-- Indexes for table `term`
--
ALTER TABLE `term`
  ADD PRIMARY KEY (`termID`),
  ADD UNIQUE KEY `termID` (`termID`),
  ADD KEY `semID` (`semID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uID`),
  ADD UNIQUE KEY `logID` (`uID`),
  ADD KEY `uID` (`roleID`);

--
-- Indexes for table `year`
--
ALTER TABLE `year`
  ADD PRIMARY KEY (`yearID`),
  ADD UNIQUE KEY `yearID` (`yearID`);

--
-- Indexes for table `year_req`
--
ALTER TABLE `year_req`
  ADD PRIMARY KEY (`yrID`),
  ADD UNIQUE KEY `yrID` (`yrID`),
  ADD KEY `subID` (`subID`),
  ADD KEY `yearID` (`yearID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_rights`
--
ALTER TABLE `access_rights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `classID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `counter`
--
ALTER TABLE `counter`
  MODIFY `countID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `counter2`
--
ALTER TABLE `counter2`
  MODIFY `countID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `courseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=378;

--
-- AUTO_INCREMENT for table `day`
--
ALTER TABLE `day`
  MODIFY `dayID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `deanslist_reqs`
--
ALTER TABLE `deanslist_reqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `enrolment_settings`
--
ALTER TABLE `enrolment_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `facID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `fac_spec`
--
ALTER TABLE `fac_spec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `feeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `grade_formula`
--
ALTER TABLE `grade_formula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `prospectus`
--
ALTER TABLE `prospectus`
  MODIFY `prosID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reports_date`
--
ALTER TABLE `reports_date`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `roleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `room_spec`
--
ALTER TABLE `room_spec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `secID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `specialization`
--
ALTER TABLE `specialization`
  MODIFY `specID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `studclass`
--
ALTER TABLE `studclass`
  MODIFY `scID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1155;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `studgrade`
--
ALTER TABLE `studgrade`
  MODIFY `sgID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT for table `studprospectus`
--
ALTER TABLE `studprospectus`
  MODIFY `spID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `studrec_per_term`
--
ALTER TABLE `studrec_per_term`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `stud_fee`
--
ALTER TABLE `stud_fee`
  MODIFY `sfID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=276;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=515;

--
-- AUTO_INCREMENT for table `subject_req`
--
ALTER TABLE `subject_req`
  MODIFY `subReqID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=426;

--
-- AUTO_INCREMENT for table `term`
--
ALTER TABLE `term`
  MODIFY `termID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=276;

--
-- AUTO_INCREMENT for table `year`
--
ALTER TABLE `year`
  MODIFY `yearID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `year_req`
--
ALTER TABLE `year_req`
  MODIFY `yrID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `access_rights`
--
ALTER TABLE `access_rights`
  ADD CONSTRAINT `access_rights_ibfk_1` FOREIGN KEY (`uID`) REFERENCES `users` (`uID`);

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`facID`) REFERENCES `faculty` (`facID`),
  ADD CONSTRAINT `class_ibfk_2` FOREIGN KEY (`termID`) REFERENCES `term` (`termID`),
  ADD CONSTRAINT `class_ibfk_3` FOREIGN KEY (`subID`) REFERENCES `subject` (`subID`),
  ADD CONSTRAINT `class_ibfk_4` FOREIGN KEY (`roomID`) REFERENCES `room` (`roomID`),
  ADD CONSTRAINT `class_ibfk_5` FOREIGN KEY (`secID`) REFERENCES `section` (`secID`),
  ADD CONSTRAINT `class_ibfk_6` FOREIGN KEY (`dayID`) REFERENCES `day` (`dayID`);

--
-- Constraints for table `deanslist_reqs`
--
ALTER TABLE `deanslist_reqs`
  ADD CONSTRAINT `deanslist_reqs_ibfk_1` FOREIGN KEY (`termID`) REFERENCES `term` (`termID`);

--
-- Constraints for table `faculty`
--
ALTER TABLE `faculty`
  ADD CONSTRAINT `faculty_ibfk_2` FOREIGN KEY (`uID`) REFERENCES `users` (`uID`);

--
-- Constraints for table `fac_spec`
--
ALTER TABLE `fac_spec`
  ADD CONSTRAINT `fac_spec_ibfk_1` FOREIGN KEY (`specID`) REFERENCES `specialization` (`specID`),
  ADD CONSTRAINT `fac_spec_ibfk_2` FOREIGN KEY (`facID`) REFERENCES `faculty` (`facID`);

--
-- Constraints for table `fees`
--
ALTER TABLE `fees`
  ADD CONSTRAINT `fees_ibfk_1` FOREIGN KEY (`termID`) REFERENCES `term` (`termID`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`studID`) REFERENCES `student` (`studID`),
  ADD CONSTRAINT `payments_ibfk_3` FOREIGN KEY (`uID`) REFERENCES `users` (`uID`),
  ADD CONSTRAINT `payments_ibfk_4` FOREIGN KEY (`feeID`) REFERENCES `fees` (`feeID`);

--
-- Constraints for table `prospectus`
--
ALTER TABLE `prospectus`
  ADD CONSTRAINT `prospectus_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `course` (`courseID`);

--
-- Constraints for table `reports_date`
--
ALTER TABLE `reports_date`
  ADD CONSTRAINT `reports_date_ibfk_1` FOREIGN KEY (`termID`) REFERENCES `term` (`termID`);

--
-- Constraints for table `room_spec`
--
ALTER TABLE `room_spec`
  ADD CONSTRAINT `room_spec_ibfk_1` FOREIGN KEY (`specID`) REFERENCES `specialization` (`specID`),
  ADD CONSTRAINT `room_spec_ibfk_2` FOREIGN KEY (`roomID`) REFERENCES `room` (`roomID`);

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `section_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `course` (`courseID`);

--
-- Constraints for table `specialization`
--
ALTER TABLE `specialization`
  ADD CONSTRAINT `specialization_ibfk_1` FOREIGN KEY (`prosID`) REFERENCES `prospectus` (`prosID`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`uID`) REFERENCES `users` (`uID`);

--
-- Constraints for table `studclass`
--
ALTER TABLE `studclass`
  ADD CONSTRAINT `studclass_ibfk_2` FOREIGN KEY (`studID`) REFERENCES `student` (`studID`),
  ADD CONSTRAINT `studclass_ibfk_3` FOREIGN KEY (`classID`) REFERENCES `class` (`classID`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`yearID`) REFERENCES `year` (`yearID`),
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`uID`) REFERENCES `users` (`uID`);

--
-- Constraints for table `studgrade`
--
ALTER TABLE `studgrade`
  ADD CONSTRAINT `studgrade_ibfk_1` FOREIGN KEY (`studID`) REFERENCES `student` (`studID`),
  ADD CONSTRAINT `studgrade_ibfk_2` FOREIGN KEY (`subID`) REFERENCES `subject` (`subID`),
  ADD CONSTRAINT `studgrade_ibfk_5` FOREIGN KEY (`termID`) REFERENCES `term` (`termID`),
  ADD CONSTRAINT `studgrade_ibfk_6` FOREIGN KEY (`uID`) REFERENCES `users` (`uID`);

--
-- Constraints for table `studprospectus`
--
ALTER TABLE `studprospectus`
  ADD CONSTRAINT `studprospectus_ibfk_1` FOREIGN KEY (`studID`) REFERENCES `student` (`studID`),
  ADD CONSTRAINT `studprospectus_ibfk_2` FOREIGN KEY (`prosID`) REFERENCES `prospectus` (`prosID`);

--
-- Constraints for table `studrec_per_term`
--
ALTER TABLE `studrec_per_term`
  ADD CONSTRAINT `studrec_per_term_ibfk_1` FOREIGN KEY (`termID`) REFERENCES `term` (`termID`),
  ADD CONSTRAINT `studrec_per_term_ibfk_2` FOREIGN KEY (`yearID`) REFERENCES `year` (`yearID`),
  ADD CONSTRAINT `studrec_per_term_ibfk_3` FOREIGN KEY (`prosID`) REFERENCES `prospectus` (`prosID`),
  ADD CONSTRAINT `studrec_per_term_ibfk_4` FOREIGN KEY (`studID`) REFERENCES `student` (`studID`);

--
-- Constraints for table `stud_fee`
--
ALTER TABLE `stud_fee`
  ADD CONSTRAINT `stud_fee_ibfk_1` FOREIGN KEY (`studID`) REFERENCES `student` (`studID`),
  ADD CONSTRAINT `stud_fee_ibfk_2` FOREIGN KEY (`feeID`) REFERENCES `fees` (`feeID`);

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`prosID`) REFERENCES `prospectus` (`prosID`),
  ADD CONSTRAINT `subject_ibfk_2` FOREIGN KEY (`yearID`) REFERENCES `year` (`yearID`),
  ADD CONSTRAINT `subject_ibfk_3` FOREIGN KEY (`semID`) REFERENCES `semester` (`semID`),
  ADD CONSTRAINT `subject_ibfk_4` FOREIGN KEY (`specID`) REFERENCES `specialization` (`specID`);

--
-- Constraints for table `subject_req`
--
ALTER TABLE `subject_req`
  ADD CONSTRAINT `subject_req_ibfk_1` FOREIGN KEY (`subID`) REFERENCES `subject` (`subID`),
  ADD CONSTRAINT `subject_req_ibfk_3` FOREIGN KEY (`req_subID`) REFERENCES `subject` (`subID`);

--
-- Constraints for table `term`
--
ALTER TABLE `term`
  ADD CONSTRAINT `term_ibfk_1` FOREIGN KEY (`semID`) REFERENCES `semester` (`semID`);

--
-- Constraints for table `year_req`
--
ALTER TABLE `year_req`
  ADD CONSTRAINT `year_req_ibfk_1` FOREIGN KEY (`subID`) REFERENCES `subject` (`subID`),
  ADD CONSTRAINT `year_req_ibfk_2` FOREIGN KEY (`yearID`) REFERENCES `year` (`yearID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
