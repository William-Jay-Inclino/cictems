-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2019 at 04:16 AM
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
(1, 47, 2),
(2, 107, 22),
(3, 109, 2),
(4, 109, 20),
(5, 54, 25),
(7, 109, 14);

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
(1, 54, 86, 35, 31, 53, 1, 'ENG111', '07:30:00', '08:30:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(2, 54, 87, 25, 30, 53, 2, 'MAT112', '08:30:00', '10:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(3, 54, 89, 25, 36, 53, 1, 'Physics111', '10:00:00', '11:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(4, 54, 90, 25, 36, 53, 1, 'Physics111', '11:00:00', '12:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(5, 54, 91, 29, 30, 53, 2, 'MAT113', '13:00:00', '14:30:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(6, 54, 92, 25, 31, 53, 1, 'Psych111', '14:30:00', '15:30:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(7, 54, 94, 31, 28, 53, 2, 'CpE-CompDs111', '15:30:00', '17:00:00', 0, 'locked', '2019-02-02 23:39:37'),
(8, 54, 97, 32, 35, 53, 1, 'CpE-ProgLo112', '17:00:00', '18:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(9, 54, 98, 32, 35, 53, 1, 'CpE-ProgLo112', '18:00:00', '19:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(10, 54, 100, 31, 28, 53, 2, 'Chem111', '17:00:00', '18:30:00', 0, 'locked', '2019-02-02 23:40:08'),
(11, 54, 101, 31, 28, 53, 2, 'Chem111', '18:30:00', '20:00:00', 0, 'locked', '2019-02-02 23:40:08'),
(12, 54, 103, 34, 37, 53, 1, 'NSTP111', '08:30:00', '09:30:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(13, 54, 106, 34, 30, 53, 2, 'PE111', '10:00:00', '11:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(14, 54, 135, 32, 33, 55, 2, 'CAD211', '13:00:00', '14:30:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(15, 54, 136, 32, 33, 55, 2, 'CAD211', '14:30:00', '16:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(16, 54, 137, 30, 33, 55, 1, 'CpE-OOP211', '16:00:00', '17:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(17, 54, 138, 30, 33, 55, 1, 'CpE-OOP211', '17:00:00', '18:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(18, 54, 139, 29, 36, 55, 2, 'CpE-EC211', '07:30:00', '09:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(19, 54, 140, 29, 36, 55, 2, 'CpE-EC211', '09:00:00', '10:30:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(20, 54, 141, 35, 31, 55, 1, 'MAT211', '10:30:00', '11:30:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(21, 54, 142, 29, 31, 55, 2, 'Hum211', '16:00:00', '17:30:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(22, 54, 143, 25, 31, 55, 1, 'Socio211', '18:00:00', '19:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(23, 54, 144, 35, 36, 55, 2, 'Filipino211', '10:30:00', '12:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(24, 54, 145, 29, 37, 55, 2, 'PE211', '17:30:00', '18:30:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(25, 54, 146, 33, 33, 55, 1, 'Ethics211', '07:30:00', '08:30:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(26, 54, 163, 32, 28, 56, 1, 'CpE-SenS311', '08:30:00', '09:30:00', 0, 'locked', '2019-02-02 23:40:28'),
(27, 54, 164, 32, 28, 56, 1, 'CpE-SenS311', '09:30:00', '10:30:00', 0, 'locked', '2019-02-02 23:40:28'),
(28, 54, 165, 36, 35, 56, 2, 'CpE-LDes311', '13:00:00', '14:30:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(29, 54, 166, 36, 35, 56, 2, 'CpE-LDes311', '14:30:00', '16:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(30, 54, 167, 33, 28, 56, 1, 'CpE-Dat311', '16:00:00', '17:00:00', 0, 'locked', '2019-02-02 23:40:58'),
(31, 54, 168, 33, 28, 56, 1, 'CpE-Dat311', '17:00:00', '18:00:00', 0, 'locked', '2019-02-02 23:40:58'),
(32, 54, 169, 30, 35, 56, 2, 'CpE-Cont311', '07:30:00', '09:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(33, 54, 170, 30, 35, 56, 2, 'CpE-Cont311', '09:00:00', '10:30:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(34, 54, 171, 36, 33, 56, 1, 'CpE-Research311', '10:30:00', '11:30:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(35, 54, 172, 34, 36, 56, 2, 'Filipino311', '16:00:00', '17:30:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(36, 54, 173, 33, 28, 56, 1, 'CpE-Ele311', '13:00:00', '14:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(37, 54, 174, 33, 28, 56, 1, 'CpE-Ele311', '14:00:00', '15:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(38, 54, 175, 36, 33, 56, 2, 'CAD311', '17:30:00', '19:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(39, 54, 176, 36, 33, 56, 2, 'CAD311', '19:00:00', '20:30:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(40, 54, 189, 30, 0, 57, 2, 'CpE-AO411', '13:00:00', '14:30:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(41, 54, 190, 30, 0, 57, 2, 'CpE-AO411', '14:30:00', '16:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(42, 54, 191, 31, 0, 57, 1, 'CpE-ELE411', '16:00:00', '17:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(43, 54, 192, 31, 0, 57, 1, 'CpE-ELE411', '17:00:00', '18:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(44, 54, 195, 32, 28, 57, 2, 'CpE-DSP411', '07:30:00', '09:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(45, 54, 196, 32, 28, 57, 2, 'CpE-DSP411', '09:00:00', '10:30:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(46, 54, 198, 31, 33, 57, 1, 'CpE-ProjDe411', '13:00:00', '15:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(47, 54, 199, 31, 33, 57, 1, 'CpE-ProjDe411', '15:00:00', '16:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(48, 54, 202, 32, 33, 57, 2, 'CpE-Free-Ele411', '16:00:00', '17:30:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(49, 54, 1, 34, 36, 25, 2, 'ENG111', '17:30:00', '19:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(50, 54, 2, 34, 31, 25, 1, 'MAT1 12', '13:00:00', '14:00:00', 0, 'locked', '2019-02-02 23:44:29'),
(51, 54, 3, 35, 36, 25, 2, 'Physics111', '14:00:00', '15:30:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(52, 54, 4, 35, 36, 25, 2, 'Physics111', '15:30:00', '16:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(53, 54, 5, 25, 30, 25, 1, 'MAT113', '16:00:00', '17:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(54, 54, 6, 34, 31, 25, 2, 'Psych111', '07:30:00', '09:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(55, 54, 7, 36, 29, 25, 1, 'IT-Com111', '09:00:00', '09:40:00', 0, 'locked', '2019-02-02 23:42:14'),
(56, 54, 8, 36, 29, 25, 1, 'IT-Com111', '09:40:00', '10:00:00', 0, 'locked', '2019-02-02 23:42:14'),
(57, 54, 9, 26, 29, 25, 2, 'IT-Prog111', '10:00:00', '11:00:00', 0, 'locked', '2019-02-02 23:42:54'),
(58, 54, 10, 26, 29, 25, 2, 'IT-Prog111', '11:00:00', '11:30:00', 0, 'locked', '2019-02-02 23:42:54'),
(59, 54, 11, 26, 30, 25, 1, 'NSTP111', '14:00:00', '15:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(60, 54, 12, 26, 37, 25, 2, 'PE111', '16:00:00', '17:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(61, 54, 24, 26, 34, 29, 2, 'IT-DBms211', '13:00:00', '14:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(62, 54, 25, 26, 34, 29, 2, 'IT-DBms211', '14:00:00', '14:30:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(63, 54, 26, 32, 0, 29, 1, 'IT-Ele211', '14:30:00', '15:10:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(64, 54, 27, 32, 0, 29, 1, 'IT-Ele211', '15:10:00', '15:30:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(65, 54, 28, 0, 0, 29, 2, 'IT-Ele212', '15:30:00', '16:30:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(66, 54, 29, 0, 0, 29, 2, 'IT-Ele212', '16:30:00', '17:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(67, 54, 30, 35, 36, 29, 1, 'Hum211', '17:00:00', '18:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(68, 54, 31, 35, 30, 29, 2, 'Socio211', '18:00:00', '19:30:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(69, 54, 32, 32, 32, 29, 1, 'IT-Datstruct120', '07:30:00', '08:10:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(70, 54, 33, 32, 32, 29, 1, 'IT-Datstruct120', '08:10:00', '08:30:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(71, 54, 34, 35, 38, 29, 2, 'Filipino211', '08:30:00', '10:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(72, 54, 35, 0, 37, 29, 2, 'PE211', '10:00:00', '11:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(73, 54, 36, 34, 30, 29, 1, 'Ethics211', '11:00:00', '12:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(74, 54, 50, 36, 28, 33, 1, 'IT-ACTA311', '12:00:00', '13:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(75, 54, 51, 33, 29, 33, 2, 'IT-SIA311', '13:00:00', '14:00:00', 0, 'locked', '2019-02-02 23:43:14'),
(76, 54, 52, 33, 29, 33, 2, 'IT-SIA311', '14:00:00', '14:30:00', 0, 'locked', '2019-02-02 23:43:14'),
(77, 54, 53, 0, 29, 33, 1, 'IT-IAS311', '14:30:00', '15:10:00', 0, 'locked', '2019-02-02 23:43:42'),
(78, 54, 54, 0, 29, 33, 1, 'IT-IAS311', '15:10:00', '15:30:00', 0, 'locked', '2019-02-02 23:43:42'),
(79, 54, 55, 0, 29, 33, 2, 'IT-APSDEV311', '15:30:00', '16:30:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(80, 54, 56, 0, 29, 33, 2, 'IT-APSDEV311', '16:30:00', '17:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(81, 54, 57, 36, 32, 33, 1, 'IT-Comotna311', '17:00:00', '18:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(82, 54, 58, 33, 29, 33, 2, 'IT-PL301', '18:00:00', '19:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(83, 54, 59, 33, 29, 33, 2, 'IT-PL301', '19:00:00', '19:30:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(84, 54, 60, 34, 38, 33, 1, 'Filipino311', '07:30:00', '08:30:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(85, 54, 61, 31, 33, 33, 2, 'IT-Free-Ele311', '08:30:00', '10:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(86, 54, 75, 0, 33, 37, 2, 'IT-Free-ELe411', '10:00:00', '11:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(87, 54, 76, 0, 33, 37, 2, 'IT-Free-ELe411', '11:00:00', '11:30:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(88, 54, 77, 36, 32, 37, 1, 'IT-SysAd411', '13:00:00', '14:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(89, 54, 78, 25, 38, 37, 2, 'IT-Capstone411', '14:00:00', '18:30:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(90, 54, 79, 36, 29, 37, 1, 'IT-ELe411', '18:30:00', '19:10:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(91, 54, 80, 36, 29, 37, 1, 'IT-ELe411', '19:10:00', '19:30:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(92, 54, 81, 0, 0, 37, 2, 'IT-CertExam411', '07:30:00', '09:00:00', 0, 'unlocked', '2019-02-02 23:31:16'),
(93, 54, 1, 0, 0, 26, 2, 'ENG111', '07:30:00', '09:00:00', 0, 'unlocked', '2019-02-03 01:41:13'),
(94, 54, 2, 25, 31, 26, 1, 'MAT1 12', '09:00:00', '10:00:00', 0, 'locked', '2019-02-03 02:03:42'),
(95, 54, 3, 0, 38, 26, 2, 'Physics111', '10:00:00', '11:30:00', 0, 'unlocked', '2019-02-03 01:41:14'),
(96, 54, 4, 0, 38, 26, 2, 'Physics111', '11:30:00', '12:00:00', 0, 'unlocked', '2019-02-03 01:41:14'),
(97, 54, 5, 25, 36, 26, 1, 'MAT113', '13:00:00', '14:00:00', 0, 'unlocked', '2019-02-03 01:41:14'),
(98, 54, 6, 34, 31, 26, 2, 'Psych111', '14:00:00', '15:30:00', 0, 'unlocked', '2019-02-03 01:41:14'),
(99, 54, 7, 36, 34, 26, 1, 'IT-Com111', '15:30:00', '16:10:00', 0, 'unlocked', '2019-02-03 01:41:14'),
(100, 54, 8, 36, 34, 26, 1, 'IT-Com111', '16:10:00', '16:30:00', 0, 'unlocked', '2019-02-03 01:41:14'),
(101, 54, 9, 0, 34, 26, 2, 'IT-Prog111', '16:30:00', '17:30:00', 0, 'unlocked', '2019-02-03 01:41:14'),
(102, 54, 10, 0, 34, 26, 2, 'IT-Prog111', '17:30:00', '18:00:00', 0, 'unlocked', '2019-02-03 01:41:14'),
(103, 54, 11, 26, 30, 26, 1, 'NSTP111', '18:00:00', '19:00:00', 0, 'unlocked', '2019-02-03 01:41:14'),
(104, 54, 12, 26, 37, 26, 2, 'PE111', '09:00:00', '10:00:00', 0, 'unlocked', '2019-02-03 01:41:14');

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
(11, 'enrol_studs', 54, 12),
(12, 'enrol_studs', 55, 0),
(13, 'fees', 54, 2),
(14, 'enrol_studs', 56, 0),
(15, 'enrol_studs', 57, 0),
(16, 'enrol_studs', 58, 0),
(17, 'enrol_studs', 59, 0),
(18, 'enrol_studs', 60, 0),
(19, 'enrol_studs', 61, 0);

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
(1, 'term', 9),
(2, 'room', 10),
(3, 'course', 4),
(4, 'prospectus', 7),
(5, 'section', 39),
(6, 'faculty', 11),
(7, 'subject', 149),
(8, 'student', 33),
(9, 'staff', 2),
(10, 'reg_requests', 2),
(11, 'reg_users', 14),
(12, 'day', 3),
(13, 'active_students', 8),
(14, 'guardian', 0),
(15, 'enrol_requests', 20),
(16, 'specialization', 37),
(17, 'payment_logs', 2);

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
(38, 119, 'Filipino');

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
(133, 30, 17),
(134, 30, 19),
(135, 30, 12),
(136, 30, 14),
(137, 30, 32),
(138, 30, 34),
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
(155, 38, 12),
(156, 37, 19),
(157, 37, 34),
(158, 37, 14),
(159, 37, 24),
(160, 37, 29),
(161, 37, 10),
(162, 37, 39);

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `feeID` int(11) NOT NULL,
  `termID` int(11) NOT NULL,
  `feeName` varchar(50) NOT NULL,
  `feeDesc` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `dueDate` varchar(40) NOT NULL,
  `feeStatus` enum('ongoing','done','cancelled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`feeID`, `termID`, `feeName`, `feeDesc`, `amount`, `dueDate`, `feeStatus`) VALUES
(1, 54, 'Christmas Party', 'All', '500.00', 'Dec. 15', 'ongoing'),
(2, 54, 'Foundation Days', 'All CICTE students', '650.00', 'January 30, 2019', 'ongoing');

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
-- Table structure for table `guardian`
--

CREATE TABLE `guardian` (
  `guardID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `studID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(36, '24.1', 'faculty_inc');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `studID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `feeID` int(11) NOT NULL,
  `paidDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `amount` decimal(10,2) NOT NULL,
  `action` varchar(80) NOT NULL,
  `or_number` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `studID`, `uID`, `feeID`, `paidDate`, `amount`, `action`, `or_number`) VALUES
(1, 43, 1, 1, '2019-01-26 06:11:23', '50.00', 'collect', 'ar'),
(2, 43, 1, 1, '2019-01-26 06:11:33', '450.00', 'collect', 'aj7');

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
  `effectivity` varchar(30) NOT NULL,
  `prosType` enum('New','Old') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prospectus`
--

INSERT INTO `prospectus` (`prosID`, `courseID`, `duration`, `prosCode`, `prosDesc`, `effectivity`, `prosType`) VALUES
(1, 132, 2, 'ACT 2016-2017', '', '2016-2017', 'Old'),
(3, 374, 4, 'BSIT 2011-2012', '', '2011-2012', 'Old'),
(4, 376, 4, 'BSCS 2016-2017', '', '2016-2017', 'Old'),
(5, 377, 5, 'BSCPE 2014-2015', '', '2014-2015', 'Old'),
(6, 374, 4, 'BSIT 2018-2019', 'No. 25 Series of 2015', '2018-2019 (K+12 Compliant)', 'New'),
(7, 376, 4, 'BSCS 2018-2019', 'No. 25 Series of 2015', '2018-2019 [K + 12] Compliant', 'New'),
(8, 377, 4, 'BSCpE 2018-2019', 'No. 25 Series of 2015', '2018-2019 (K+12 Compliant)', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `regID` int(11) NOT NULL,
  `roleID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `userName` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `userPass` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `fn` varchar(25) NOT NULL,
  `mn` varchar(20) NOT NULL,
  `ln` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `address` varchar(100) NOT NULL,
  `cn` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`regID`, `roleID`, `uID`, `userName`, `userPass`, `fn`, `mn`, `ln`, `dob`, `sex`, `address`, `cn`, `email`) VALUES
(2, 4, 84, 'Camasura', 'Iamdave1', 'Dave', '', 'Camasura', '2003-01-23', '', 'x', '09212121212121', 'dave@gmail.com'),
(3, 5, 0, 'Inclino1', 'Iamtata1', 'Aurora', '', 'Inclino', '1977-01-27', 'Female', 'Puertobello', '092121212121', 'Aurora@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `reg_guardian`
--

CREATE TABLE `reg_guardian` (
  `id` int(11) NOT NULL,
  `regID` int(11) NOT NULL,
  `studID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reg_guardian`
--

INSERT INTO `reg_guardian` (`id`, `regID`, `studID`) VALUES
(1, 3, 43),
(2, 3, 12);

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
-- Table structure for table `resetpass_code`
--

CREATE TABLE `resetpass_code` (
  `uID` int(11) NOT NULL,
  `code` char(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(36, 'LAB 5', '4th floor', 35, 'active');

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
(178, 26, 19);

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
(41, 132, 1, 1, 'ACT-1101'),
(42, 132, 1, 1, 'ACT-1102'),
(43, 132, 2, 1, 'ACT-1201'),
(44, 132, 2, 1, 'ACT-1202'),
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
(64, 376, 2, 4, 'BSCS-4201');

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
(1, 2, '1st Semester'),
(2, 3, '2nd Semester'),
(3, 1, 'Summer');

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
(2, 54);

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
(1, 50, 43, 'Dropped', '', '', '', '50', 'Dropped', '', 'Enrolled', '2019-02-03 07:33:00'),
(2, 53, 43, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:33:00'),
(3, 55, 43, '100.00', '100.00', '100.00', '100.00', '100', 'Passed', '', 'Enrolled', '2019-02-03 07:33:00'),
(4, 56, 43, '100.00', '100.00', '100.00', '100.00', '100', 'Passed', '', 'Enrolled', '2019-02-03 07:33:00'),
(5, 59, 43, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:33:00'),
(6, 49, 43, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:33:00'),
(7, 51, 43, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:33:00'),
(8, 52, 43, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:33:00'),
(9, 54, 43, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:33:00'),
(10, 57, 43, '100.00', '100.00', '100.00', '100.00', '100', 'Passed', '', 'Enrolled', '2019-02-03 07:33:00'),
(11, 58, 43, '100.00', '100.00', '100.00', '100.00', '100', 'Passed', '', 'Enrolled', '2019-02-03 07:33:00'),
(12, 60, 43, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:33:00'),
(13, 50, 46, '100.00', '100.00', '100.00', '100.00', '100', 'Passed', '', 'Enrolled', '2019-02-03 07:33:21'),
(14, 53, 46, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:33:21'),
(15, 55, 46, 'INC', 'INC', 'INC', 'INC', '', 'Incomplete', '', 'Enrolled', '2019-02-03 07:33:21'),
(16, 56, 46, 'INC', 'INC', 'INC', 'INC', '', 'Incomplete', '', 'Enrolled', '2019-02-03 07:33:21'),
(17, 59, 46, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:33:21'),
(18, 49, 46, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:33:21'),
(19, 51, 46, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:33:21'),
(20, 52, 46, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:33:21'),
(21, 54, 46, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:33:21'),
(22, 57, 46, '100.00', '100.00', '100.00', '100.00', '100', 'Passed', '', 'Enrolled', '2019-02-03 07:33:21'),
(23, 58, 46, '100.00', '100.00', '100.00', '100.00', '100', 'Passed', '', 'Enrolled', '2019-02-03 07:33:21'),
(24, 60, 46, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:33:21'),
(25, 50, 49, 'INC', 'INC', 'INC', 'INC', '', 'Incomplete', '', 'Enrolled', '2019-02-03 07:33:33'),
(26, 53, 49, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:33:33'),
(27, 55, 49, '70.00', '70.00', '70.00', '70.00', '70', 'Failed', '', 'Enrolled', '2019-02-03 07:33:33'),
(28, 56, 49, '70.00', '70.00', '70.00', '70.00', '70', 'Failed', '', 'Enrolled', '2019-02-03 07:33:33'),
(29, 59, 49, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:33:33'),
(30, 49, 49, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:33:33'),
(31, 51, 49, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:33:33'),
(32, 52, 49, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:33:33'),
(33, 54, 49, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:33:33'),
(34, 57, 49, '100.00', '100.00', '100.00', '100.00', '100', 'Passed', '', 'Enrolled', '2019-02-03 07:33:33'),
(35, 58, 49, '100.00', '100.00', '100.00', '100.00', '100', 'Passed', '', 'Enrolled', '2019-02-03 07:33:33'),
(36, 60, 49, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:33:33'),
(37, 50, 68, '100.00', '100.00', '100.00', '100.00', '100', 'Passed', '', 'Enrolled', '2019-02-03 07:33:52'),
(38, 53, 68, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:33:52'),
(39, 55, 68, 'Dropped', '', '', '', '50', 'Dropped', '', 'Enrolled', '2019-02-03 07:33:52'),
(40, 56, 68, 'Dropped', '', '', '', '50', 'Dropped', '', 'Enrolled', '2019-02-03 07:33:52'),
(41, 59, 68, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:33:52'),
(42, 49, 68, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:33:52'),
(43, 51, 68, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:33:52'),
(44, 52, 68, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:33:52'),
(45, 54, 68, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:33:52'),
(46, 57, 68, '100.00', '100.00', '100.00', '100.00', '100', 'Passed', '', 'Enrolled', '2019-02-03 07:33:52'),
(47, 58, 68, '100.00', '100.00', '100.00', '100.00', '100', 'Passed', '', 'Enrolled', '2019-02-03 07:33:52'),
(48, 60, 68, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:33:52'),
(49, 63, 50, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:34:15'),
(50, 64, 50, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:34:15'),
(51, 67, 50, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:34:15'),
(52, 69, 50, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:34:15'),
(53, 70, 50, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:34:15'),
(54, 73, 50, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:34:15'),
(55, 61, 50, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:34:15'),
(56, 62, 50, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:34:15'),
(57, 65, 50, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:34:16'),
(58, 66, 50, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:34:16'),
(59, 68, 50, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:34:16'),
(60, 71, 50, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:34:16'),
(61, 72, 50, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:34:16'),
(62, 63, 52, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:34:41'),
(63, 64, 52, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:34:41'),
(64, 67, 52, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:34:41'),
(65, 69, 52, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:34:41'),
(66, 70, 52, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:34:41'),
(67, 73, 52, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:34:41'),
(68, 61, 52, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:34:41'),
(69, 62, 52, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:34:41'),
(70, 65, 52, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:34:41'),
(71, 66, 52, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:34:41'),
(72, 68, 52, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:34:41'),
(73, 71, 52, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:34:41'),
(74, 72, 52, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:34:41'),
(75, 74, 53, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:35:09'),
(76, 77, 53, 'INC', 'INC', 'INC', 'INC', '', 'Incomplete', '', 'Enrolled', '2019-02-03 07:35:09'),
(77, 78, 53, 'INC', 'INC', 'INC', 'INC', '', 'Incomplete', '', 'Enrolled', '2019-02-03 07:35:09'),
(78, 81, 53, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:35:09'),
(79, 84, 53, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:35:09'),
(80, 75, 53, '100.00', '100.00', '100.00', '100.00', '100', 'Passed', '', 'Enrolled', '2019-02-03 07:35:09'),
(81, 76, 53, '100.00', '100.00', '100.00', '100.00', '100', 'Passed', '', 'Enrolled', '2019-02-03 07:35:09'),
(82, 79, 53, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:35:09'),
(83, 80, 53, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:35:09'),
(84, 82, 53, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:35:09'),
(85, 83, 53, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:35:09'),
(86, 85, 53, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:35:09'),
(87, 88, 12, '', '', '', '', '', '', '', 'Pending', '2019-02-03 07:36:42'),
(88, 90, 12, '', '', '', '', '', '', '', 'Pending', '2019-02-03 07:36:42'),
(89, 91, 12, '', '', '', '', '', '', '', 'Pending', '2019-02-03 07:36:42'),
(90, 86, 12, '', '', '', '', '', '', '', 'Pending', '2019-02-03 07:36:42'),
(91, 87, 12, '', '', '', '', '', '', '', 'Pending', '2019-02-03 07:36:42'),
(92, 89, 12, '', '', '', '', '', '', '', 'Pending', '2019-02-03 07:36:42'),
(93, 92, 12, '', '', '', '', '', '', '', 'Pending', '2019-02-03 07:36:42'),
(94, 42, 65, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:37:04'),
(95, 43, 65, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:37:04'),
(96, 46, 65, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:37:04'),
(97, 47, 65, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:37:04'),
(98, 40, 65, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:37:04'),
(99, 41, 65, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:37:04'),
(100, 44, 65, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:37:04'),
(101, 45, 65, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:37:04'),
(102, 48, 65, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:37:04'),
(103, 26, 64, 'Dropped', '', '', '', '50', 'Dropped', '', 'Enrolled', '2019-02-03 07:37:29'),
(104, 27, 64, 'Dropped', '', '', '', '50', 'Dropped', '', 'Enrolled', '2019-02-03 07:37:29'),
(105, 30, 64, '60.00', '70.00', '70.00', '70.00', '68', 'Failed', '', 'Enrolled', '2019-02-03 07:37:29'),
(106, 31, 64, '60.00', '70.00', '70.00', '70.00', '68', 'Failed', '', 'Enrolled', '2019-02-03 07:37:29'),
(107, 34, 64, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:37:29'),
(108, 36, 64, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:37:29'),
(109, 37, 64, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:37:29'),
(110, 28, 64, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:37:29'),
(111, 29, 64, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:37:29'),
(112, 32, 64, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:37:29'),
(113, 33, 64, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:37:29'),
(114, 35, 64, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:37:29'),
(115, 38, 64, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:37:29'),
(116, 39, 64, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:37:29'),
(117, 1, 62, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:37:54'),
(118, 3, 62, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:37:54'),
(119, 4, 62, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:37:54'),
(120, 6, 62, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:37:54'),
(121, 8, 62, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:37:54'),
(122, 9, 62, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:37:54'),
(123, 12, 62, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:37:54'),
(124, 2, 62, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:37:54'),
(125, 5, 62, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:37:54'),
(126, 7, 62, '100.00', '100.00', '100.00', '100.00', '100', 'Passed', '', 'Enrolled', '2019-02-03 07:37:54'),
(127, 10, 62, 'INC', 'INC', 'INC', 'INC', '', 'Incomplete', '', 'Enrolled', '2019-02-03 07:37:54'),
(128, 11, 62, 'INC', 'INC', 'INC', 'INC', '', 'Incomplete', '', 'Enrolled', '2019-02-03 07:37:54'),
(129, 13, 62, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 07:37:54'),
(130, 94, 69, '70.00', '70.00', '70.09', '70.00', '70.02', 'Failed', '', 'Enrolled', '2019-02-03 09:41:50'),
(131, 97, 69, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 09:41:50'),
(132, 99, 69, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 09:41:50'),
(133, 100, 69, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 09:41:51'),
(134, 103, 69, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 09:41:51'),
(135, 93, 69, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 09:41:51'),
(136, 95, 69, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 09:41:51'),
(137, 96, 69, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 09:41:51'),
(138, 98, 69, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 09:41:51'),
(139, 101, 69, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 09:41:51'),
(140, 102, 69, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 09:41:51'),
(141, 104, 69, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 09:41:51'),
(142, 94, 70, '100.00', '99.91', '100.00', '100.00', '99.98', 'Passed', '', 'Enrolled', '2019-02-03 09:42:18'),
(143, 97, 70, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 09:42:18'),
(144, 99, 70, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 09:42:18'),
(145, 100, 70, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 09:42:18'),
(146, 103, 70, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 09:42:18'),
(147, 93, 70, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 09:42:18'),
(148, 95, 70, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 09:42:18'),
(149, 96, 70, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 09:42:18'),
(150, 98, 70, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 09:42:18'),
(151, 101, 70, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 09:42:18'),
(152, 102, 70, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 09:42:18'),
(153, 104, 70, '', '', '', '', '', '', '', 'Enrolled', '2019-02-03 09:42:18');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studID` int(11) NOT NULL,
  `yearID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `controlNo` int(11) NOT NULL,
  `has_user` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studID`, `yearID`, `uID`, `controlNo`, `has_user`) VALUES
(12, 4, 6, 611, 'yes'),
(43, 1, 43, 616, 'yes'),
(44, 4, 46, 622, 'yes'),
(45, 4, 48, 617, 'no'),
(46, 1, 49, 622, 'no'),
(48, 1, 58, 733, 'yes'),
(49, 1, 59, 788, 'yes'),
(50, 2, 60, 828, 'no'),
(51, 2, 61, 678, 'no'),
(52, 2, 62, 878, 'no'),
(53, 3, 63, 979, 'no'),
(54, 3, 64, 777, 'no'),
(55, 3, 65, 678, 'no'),
(56, 4, 66, 654, 'no'),
(57, 1, 67, 688, 'yes'),
(58, 2, 68, 545, 'no'),
(59, 2, 69, 777, 'no'),
(60, 3, 70, 999, 'no'),
(61, 1, 71, 432, 'no'),
(62, 1, 72, 888, 'no'),
(63, 2, 73, 432, 'no'),
(64, 3, 74, 0, 'no'),
(65, 4, 75, 999, 'no'),
(66, 5, 76, 987, 'no'),
(67, 1, 83, 123, 'no'),
(68, 1, 84, 222, 'no'),
(69, 1, 85, 888, 'no'),
(70, 1, 86, 765, 'no'),
(71, 1, 87, 911, 'no'),
(72, 1, 88, 755, 'no'),
(73, 4, 89, 109, 'no'),
(74, 1, 115, 1928, 'yes'),
(75, 4, 118, 111, 'no');

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
(1, 62, 94, 106, 54, '1.0', 'Passed', 'Class', '2019-02-03 07:39:37'),
(2, 62, 100, 106, 54, '0.0', 'Incomplete', 'Class', '2019-02-03 07:40:08'),
(3, 62, 101, 106, 54, '0.0', 'Incomplete', 'Class', '2019-02-03 07:40:08'),
(4, 64, 163, 106, 54, '5.0', 'Dropped', 'Class', '2019-02-03 07:40:27'),
(5, 64, 164, 106, 54, '5.0', 'Dropped', 'Class', '2019-02-03 07:40:27'),
(6, 64, 167, 106, 54, '5.0', 'Failed', 'Class', '2019-02-03 07:40:58'),
(7, 64, 168, 106, 54, '5.0', 'Failed', 'Class', '2019-02-03 07:40:58'),
(8, 43, 7, 107, 54, '1.0', 'Passed', 'Class', '2019-02-03 07:42:14'),
(9, 43, 8, 107, 54, '1.0', 'Passed', 'Class', '2019-02-03 07:42:14'),
(10, 46, 7, 107, 54, '0.0', 'Incomplete', 'Class', '2019-02-03 07:42:14'),
(11, 46, 8, 107, 54, '0.0', 'Incomplete', 'Class', '2019-02-03 07:42:14'),
(12, 49, 7, 107, 54, '5.0', 'Failed', 'Class', '2019-02-03 07:42:14'),
(13, 49, 8, 107, 54, '5.0', 'Failed', 'Class', '2019-02-03 07:42:14'),
(14, 68, 7, 107, 54, '5.0', 'Dropped', 'Class', '2019-02-03 07:42:14'),
(15, 68, 8, 107, 54, '5.0', 'Dropped', 'Class', '2019-02-03 07:42:14'),
(16, 43, 9, 107, 54, '1.0', 'Passed', 'Class', '2019-02-03 07:42:54'),
(17, 43, 10, 107, 54, '1.0', 'Passed', 'Class', '2019-02-03 07:42:54'),
(18, 46, 9, 107, 54, '1.0', 'Passed', 'Class', '2019-02-03 07:42:54'),
(19, 46, 10, 107, 54, '1.0', 'Passed', 'Class', '2019-02-03 07:42:54'),
(20, 49, 9, 107, 54, '1.0', 'Passed', 'Class', '2019-02-03 07:42:54'),
(21, 49, 10, 107, 54, '1.0', 'Passed', 'Class', '2019-02-03 07:42:54'),
(22, 68, 9, 107, 54, '1.0', 'Passed', 'Class', '2019-02-03 07:42:54'),
(23, 68, 10, 107, 54, '1.0', 'Passed', 'Class', '2019-02-03 07:42:54'),
(24, 53, 51, 107, 54, '1.0', 'Passed', 'Class', '2019-02-03 07:43:14'),
(25, 53, 52, 107, 54, '1.0', 'Passed', 'Class', '2019-02-03 07:43:14'),
(26, 53, 53, 107, 54, '0.0', 'Incomplete', 'Class', '2019-02-03 07:43:42'),
(27, 53, 54, 107, 54, '0.0', 'Incomplete', 'Class', '2019-02-03 07:43:42'),
(28, 43, 2, 109, 54, '5.0', 'Dropped', 'Class', '2019-02-03 07:44:29'),
(29, 46, 2, 109, 54, '1.0', 'Passed', 'Class', '2019-02-03 07:44:29'),
(30, 49, 2, 109, 54, '0.0', 'Incomplete', 'Class', '2019-02-03 07:44:29'),
(31, 68, 2, 109, 54, '1.0', 'Passed', 'Class', '2019-02-03 07:44:29'),
(32, 69, 2, 109, 54, '5.0', 'Failed', 'Class', '2019-02-03 10:03:41'),
(33, 70, 2, 109, 54, '1.0', 'Passed', 'Class', '2019-02-03 10:03:41');

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
(12, 12, 3),
(41, 43, 6),
(42, 44, 3),
(43, 45, 3),
(44, 46, 6),
(46, 48, 6),
(47, 49, 6),
(48, 50, 3),
(49, 51, 3),
(50, 52, 3),
(51, 53, 3),
(52, 54, 3),
(53, 55, 3),
(54, 56, 4),
(55, 57, 1),
(56, 58, 1),
(57, 59, 4),
(58, 60, 4),
(59, 61, 4),
(60, 62, 5),
(61, 63, 5),
(62, 64, 5),
(63, 65, 5),
(64, 66, 5),
(65, 67, 6),
(66, 68, 6),
(67, 69, 6),
(68, 70, 6),
(69, 71, 6),
(70, 72, 6),
(71, 73, 6),
(72, 74, 7),
(73, 75, 6);

-- --------------------------------------------------------

--
-- Table structure for table `stud_fee`
--

CREATE TABLE `stud_fee` (
  `sfID` int(11) NOT NULL,
  `studID` int(11) NOT NULL,
  `feeID` int(11) NOT NULL,
  `payable` decimal(10,2) NOT NULL,
  `receivable` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stud_fee`
--

INSERT INTO `stud_fee` (`sfID`, `studID`, `feeID`, `payable`, `receivable`) VALUES
(1, 57, 1, '500.00', '0.00'),
(2, 43, 1, '0.00', '0.00'),
(3, 70, 1, '500.00', '0.00'),
(4, 72, 1, '500.00', '0.00'),
(5, 12, 1, '500.00', '0.00'),
(6, 73, 1, '500.00', '0.00');

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
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subID`, `prosID`, `yearID`, `semID`, `specID`, `subCode`, `subDesc`, `units`, `total_units`, `type`, `nonSub_pre`, `id`) VALUES
(1, 6, 1, 1, 12, 'ENG111', 'Purposive Communication', 3, 3, 'lec', '', 274),
(2, 6, 1, 1, 12, 'MAT1 12', 'Remedial Mathematics (Pre-Calculus)', 3, 3, 'lec', 'for non-STEM', 381),
(3, 6, 1, 1, 12, 'Physics111', 'General Physics', 3, 4, 'lec', 'for non-STEM', 923),
(4, 6, 1, 1, 12, 'Physics111', 'General Physics', 1, 4, 'lab', 'for non-STEM', 923),
(5, 6, 1, 1, 12, 'MAT113', 'Mathematics in the Modern World', 3, 3, 'lec', '', 439),
(6, 6, 1, 1, 12, 'Psych111', 'Understanding the Self', 3, 3, 'lec', '', 682),
(7, 6, 1, 1, 13, 'IT-Com111', 'Introduction to Computing', 2, 3, 'lec', '', 279),
(8, 6, 1, 1, 13, 'IT-Com111', 'Introduction to Computing', 1, 3, 'lab', '', 279),
(9, 6, 1, 1, 13, 'IT-Prog111', 'Fundamentals of Programming', 2, 3, 'lec', '', 965),
(10, 6, 1, 1, 13, 'IT-Prog111', 'Fundamentals of Programming', 1, 3, 'lab', '', 965),
(11, 6, 1, 1, 14, 'NSTP111', 'National Service Training Prog1', 3, 3, 'lec', '', 831),
(12, 6, 1, 1, 14, 'PE111', 'Physical Fitness 1', 2, 2, 'lec', '', 647),
(13, 6, 1, 2, 15, 'MAT121', 'Discrete Structure', 3, 3, 'lec', '', 257),
(14, 6, 1, 2, 12, 'STS121', 'Science, Technology & Society', 3, 3, 'lec', '', 869),
(15, 6, 1, 2, 12, 'Socio121', 'Social Issues & Professional Practice', 3, 3, 'lec', '', 348),
(16, 6, 1, 2, 13, 'IT-Prog121', 'Computer Programming 2', 2, 3, 'lec', '', 645),
(17, 6, 1, 2, 13, 'IT-Prog121', 'Computer Programming 2', 1, 3, 'lab', '', 645),
(18, 6, 1, 2, 15, 'IT-HC1211', 'Introduction to Human Computer Interaction', 2, 3, 'lec', '', 265),
(19, 6, 1, 2, 15, 'IT-HC1211', 'Introduction to Human Computer Interaction', 1, 3, 'lab', '', 265),
(20, 6, 1, 2, 15, 'IT-DiGiLog121', 'Digital Logic Design', 3, 3, 'lec', '', 543),
(21, 6, 1, 2, 12, 'Hist121', 'Readings in Philippine History', 3, 3, 'lec', '', 291),
(22, 6, 1, 2, 14, 'NSTP121', 'National Service Training Prog2', 3, 3, 'lec', '', 193),
(23, 6, 1, 2, 14, 'PE121', 'Rhythmic Activities', 2, 2, 'lec', '', 964),
(24, 6, 2, 1, 13, 'IT-DBms211', 'Fundamentals of Database Systems', 2, 3, 'lec', '', 495),
(25, 6, 2, 1, 13, 'IT-DBms211', 'Fundamentals of Database Systems', 1, 3, 'lab', '', 495),
(26, 6, 2, 1, 16, 'IT-Ele211', 'Object Oriented Programming', 2, 3, 'lec', '', 761),
(27, 6, 2, 1, 16, 'IT-Ele211', 'Object Oriented Programming', 1, 3, 'lab', '', 761),
(28, 6, 2, 1, 16, 'IT-Ele212', 'Platform Technologies', 2, 3, 'lec', '', 324),
(29, 6, 2, 1, 16, 'IT-Ele212', 'Platform Technologies', 1, 3, 'lab', '', 324),
(30, 6, 2, 1, 12, 'Hum211', 'Art Appreciation', 3, 3, 'lec', '', 852),
(31, 6, 2, 1, 12, 'Socio211', 'The Contemporary World', 3, 3, 'lec', '', 392),
(32, 6, 2, 1, 13, 'IT-Datstruct1202', 'Data Structure & Algorithm Analysis', 2, 3, 'lec', '', 765),
(33, 6, 2, 1, 13, 'IT-Datstruct1202', 'Data Structure & Algorithm Analysis', 1, 3, 'lab', '', 765),
(34, 6, 2, 1, 12, 'Filipino211', 'Komonikasyon sa Akademikong Filipino', 3, 3, 'lec', '', 298),
(35, 6, 2, 1, 14, 'PE211', 'Individual Sports', 2, 2, 'lec', '', 352),
(36, 6, 2, 1, 12, 'Ethics211', 'Ethics', 3, 3, 'lec', '', 659),
(37, 6, 2, 2, 12, 'Filipino221', 'Panitikan', 3, 3, 'lec', '', 517),
(38, 6, 2, 2, 13, 'IT-DBms221', 'Information Management 2', 2, 3, 'lec', '', 615),
(39, 6, 2, 2, 13, 'IT-DBms221', 'Information Management 2', 1, 3, 'lab', '', 615),
(40, 6, 2, 2, 15, 'IT-IntProg221', 'Integrative Programming & Technologies 1', 2, 3, 'lec', '', 123),
(41, 6, 2, 2, 15, 'IT-IntProg221', 'Integrative Programming & Technologies 1', 1, 3, 'lab', '', 123),
(42, 6, 2, 2, 15, 'IT-Netwrk221', 'Networking 2', 2, 3, 'lec', '#REF!', 643),
(43, 6, 2, 2, 15, 'IT-Netwrk221', 'Networking 2', 1, 3, 'lab', '#REF!', 643),
(44, 6, 2, 2, 15, 'IT-SAD221', 'Systems Analysis & Design', 3, 3, 'lec', '', 376),
(45, 6, 2, 2, 15, 'IT-NetWrk201', 'Networking 1', 2, 3, 'lec', '', 672),
(46, 6, 2, 2, 15, 'IT-NetWrk201', 'Networking 1', 1, 3, 'lab', '', 672),
(47, 6, 2, 2, 12, 'Entrep221', 'The Entrepreneurial Mind', 3, 3, 'lec', '', 741),
(48, 6, 2, 2, 15, 'IT-QM221', 'Quantitative Methods (incl. Modelling & Simulation)', 3, 3, 'lec', '', 548),
(49, 6, 2, 2, 14, 'PE221', 'Team Sports', 2, 2, 'lec', '', 384),
(50, 6, 3, 1, 15, 'IT-ACTA311', 'Computer Accounting', 3, 3, 'lec', '', 465),
(51, 6, 3, 1, 15, 'IT-SIA311', 'System Integration & Architecture1', 2, 3, 'lec', '', 462),
(52, 6, 3, 1, 15, 'IT-SIA311', 'System Integration & Architecture1', 1, 3, 'lab', '', 462),
(53, 6, 3, 1, 15, 'IT-IAS311', 'Information Assurance & Security 1', 2, 3, 'lec', '', 173),
(54, 6, 3, 1, 15, 'IT-IAS311', 'Information Assurance & Security 1', 1, 3, 'lab', '', 173),
(55, 6, 3, 1, 15, 'IT-APSDEV311', 'Application Devt & Emerging Technologies', 2, 3, 'lec', '', 271),
(56, 6, 3, 1, 15, 'IT-APSDEV311', 'Application Devt & Emerging Technologies', 1, 3, 'lab', '', 271),
(57, 6, 3, 1, 15, 'IT-Comotna311', 'Methods of Research in Computing', 3, 3, 'lec', '', 473),
(58, 6, 3, 1, 15, 'IT-PL301', 'Programming Languages', 2, 3, 'lec', '', 136),
(59, 6, 3, 1, 15, 'IT-PL301', 'Programming Languages', 1, 3, 'lab', '', 136),
(60, 6, 3, 1, 12, 'Filipino311', 'Masining na Pagpapahayag', 3, 3, 'lec', '', 796),
(61, 6, 3, 1, 16, 'IT-Free-Ele311', 'Business Analytics', 3, 3, 'lec', '', 541),
(62, 6, 3, 2, 16, 'IT-Free-Ele321', 'Animation Technology & 2D', 2, 3, 'lec', '', 542),
(63, 6, 3, 2, 16, 'IT-Free-Ele321', 'Animation Technology & 2D', 1, 3, 'lab', '', 542),
(64, 6, 3, 2, 15, 'IT-IAS321', 'Information Assurance & Security', 2, 3, 'lec', '', 243),
(65, 6, 3, 2, 15, 'IT-IAS321', 'Information Assurance & Security', 1, 3, 'lab', '', 243),
(66, 6, 3, 2, 16, 'IT-ELE321', 'Integrative Programming & Technologies', 2, 3, 'lec', '', 976),
(67, 6, 3, 2, 16, 'IT-ELE321', 'Integrative Programming & Technologies', 1, 3, 'lab', '', 976),
(68, 6, 3, 2, 16, 'IT-ELE322', 'Intelligent Systems', 2, 3, 'lec', '', 978),
(69, 6, 3, 2, 16, 'IT-ELE322', 'Intelligent Systems', 1, 3, 'lab', '', 978),
(70, 6, 3, 2, 15, 'IT-Pro321', 'IT Proposal', 3, 3, 'lec', '', 613),
(71, 6, 3, 2, 15, 'IT-Techno301', 'Technopreneurship', 3, 3, 'lec', '', 295),
(72, 6, 3, 2, 16, 'IT-Free-Ele-322', 'Analytics Modelling: Techniques and Tools', 3, 3, 'lec', '', 763),
(73, 6, 3, 2, 12, 'Rizal321', 'Life & Works of Dr. Jose Rizal', 3, 3, 'lec', '', 347),
(74, 6, 4, 3, 15, 'IT-PRAC401', 'PRACTICUM/OJT', 9, 9, 'lec', '', 438),
(75, 6, 4, 1, 13, 'IT-Free-ELe411', '3D Animation and Modelling', 2, 3, 'lec', '', 651),
(76, 6, 4, 1, 13, 'IT-Free-ELe411', '3D Animation and Modelling', 1, 3, 'lab', '', 651),
(77, 6, 4, 1, 15, 'IT-SysAd411', 'System Administration & Maintenance', 3, 3, 'lec', '', 218),
(78, 6, 4, 1, 12, 'IT-Capstone411', 'Capstone Project 1', 9, 9, 'lec', '', 794),
(79, 6, 4, 1, 16, 'IT-ELe411', 'Web Systems Technologies', 2, 3, 'lec', '', 321),
(80, 6, 4, 1, 16, 'IT-ELe411', 'Web Systems Technologies', 1, 3, 'lab', '', 321),
(81, 6, 4, 1, 12, 'IT-CertExam411', 'Philnits/Microsoft/TESDA', 3, 3, 'lec', '', 158),
(82, 6, 4, 2, 15, 'IT-Capstone421', 'Capstone Project 2', 9, 9, 'lec', '', 329),
(83, 6, 4, 2, 16, 'IT-ELE-421', 'Embedded Systems', 2, 3, 'lec', '', 185),
(84, 6, 4, 2, 16, 'IT-ELE-421', 'Embedded Systems', 1, 3, 'lab', '', 185),
(85, 6, 4, 2, 15, 'ITSeminar421', 'IT Seminars/Fieldtrips', 3, 3, 'lec', '', 714),
(86, 8, 1, 1, 17, 'ENG111', 'Purposive Communication', 3, 3, 'lec', '', 357),
(87, 8, 1, 1, 17, 'MAT112', 'Remedial Mathematics (Pre-Calculus)', 3, 3, 'lec', 'for non-STEM', 329),
(88, 7, 1, 1, 32, 'ENG111', 'Purposive Communication', 3, 3, 'lec', '', 157),
(89, 8, 1, 1, 17, 'Physics111', 'General Physics', 3, 4, 'lec', 'for non-STEM', 845),
(90, 8, 1, 1, 17, 'Physics111', 'General Physics', 3, 4, 'lab', 'for non-STEM', 845),
(91, 8, 1, 1, 17, 'MAT113', 'Mathematics in the Modern World', 3, 3, 'lec', '', 425),
(92, 8, 1, 1, 17, 'Psych111', 'Understanding the Self', 3, 3, 'lec', '', 876),
(93, 7, 1, 1, 32, 'MAT112', 'Remedial Mathematics (Pre-Calculus)', 3, 3, 'lec', 'for non-STEM', 942),
(94, 8, 1, 1, 20, 'CpE-CompDs111', 'Computer Engineering as a Discipline', 3, 1, 'lec', '', 731),
(95, 7, 1, 1, 32, 'Physics111', 'General Physics', 3, 4, 'lec', 'for non-STEM', 943),
(96, 7, 1, 1, 32, 'Physics111', 'General Physics', 1, 4, 'lab', 'for non-STEM', 943),
(97, 8, 1, 1, 20, 'CpE-ProgLo112', 'Programming Logic and Design', 3, 2, 'lec', '', 619),
(98, 8, 1, 1, 20, 'CpE-ProgLo112', 'Programming Logic and Design', 3, 2, 'lab', '', 619),
(99, 7, 1, 1, 32, 'MAT113', 'Mathematics in the Modern World', 3, 3, 'lec', '', 751),
(100, 8, 1, 1, 20, 'Chem111', 'Chemistry for Engineers', 3, 2, 'lec', '', 643),
(101, 8, 1, 1, 20, 'Chem111', 'Chemistry for Engineers', 3, 2, 'lab', '', 643),
(102, 7, 1, 1, 32, 'Psych111', 'Understanding the Self', 3, 3, 'lec', '', 584),
(103, 8, 1, 1, 19, 'NSTP111', 'National Service Training Prog1', 3, 3, 'lec', '', 428),
(104, 7, 1, 1, 33, 'CS-COM111', 'Introduction to Computing', 2, 3, 'lec', '', 214),
(105, 7, 1, 1, 33, 'CS-COM111', 'Introduction to Computing', 1, 3, 'lab', '', 214),
(106, 8, 1, 1, 19, 'PE111', 'Physical Fitness 1`', 2, 2, 'lec', '', 732),
(107, 8, 1, 2, 17, 'MAT121', 'Discrete Mathematics', 3, 3, 'lec', '', 692),
(108, 7, 1, 1, 33, 'CS-Prog111', 'Fundamentals of Programming', 2, 3, 'lec', '', 236),
(109, 7, 1, 1, 33, 'CS-Prog111', 'Fundamentals of Programming', 1, 3, 'lab', '', 236),
(110, 8, 1, 2, 17, 'STS121', 'Science, Technology & Society', 3, 3, 'lec', '', 281),
(111, 7, 1, 1, 34, 'NSTP111', 'National Service Training Prog1', 3, 3, 'lec', '', 149),
(112, 8, 1, 2, 21, 'Draft121', 'Technical Drafting', 3, 1, 'lec', '', 548),
(113, 7, 1, 1, 34, 'PE111', 'Physical Fitness 1', 2, 2, 'lec', '', 349),
(114, 8, 1, 2, 21, 'Opt121', 'Productivity Tools 1', 3, 2, 'lec', '', 395),
(115, 8, 1, 2, 21, 'Opt121', 'Productivity Tools 1', 3, 2, 'lab', '', 395),
(116, 8, 1, 2, 20, 'Cpe-Eco121', 'Engineering Economics', 3, 3, 'lec', '', 715),
(117, 7, 1, 2, 36, 'MAT121', 'Discrete Structures 1', 3, 3, 'lec', '', 792),
(118, 8, 1, 2, 17, 'Physics121', 'Physics for Engineers', 3, 2, 'lec', '', 653),
(119, 8, 1, 2, 17, 'Physics121', 'Physics for Engineers', 3, 2, 'lab', '', 653),
(120, 7, 1, 2, 32, 'STS121', 'Science, Technology & Society', 3, 3, 'lec', '', 896),
(121, 8, 1, 2, 17, 'Hist121', 'Readings in Philippine History', 3, 3, 'lec', '', 986),
(122, 8, 1, 2, 19, 'NSTP121', 'National Service Training Prog2', 3, 3, 'lec', '', 493),
(123, 8, 1, 2, 17, 'MAT122', 'Calculus 1', 3, 3, 'lec', '', 318),
(124, 7, 1, 2, 32, 'Socio121', 'Social Issues & Professional Practice', 3, 3, 'lec', '', 217),
(125, 8, 1, 2, 19, 'PE121', 'Rythmic Activities', 2, 2, 'lec', '', 861),
(126, 7, 1, 2, 33, 'CS-Prog121', 'Computer Programming 2', 2, 3, 'lec', '', 712),
(127, 7, 1, 2, 33, 'CS-Prog121', 'Computer Programming 2', 1, 3, 'lab', '', 712),
(128, 7, 1, 2, 35, 'CS-HC1211', 'Introduction to Human Computer Interaction', 2, 3, 'lec', '', 187),
(129, 7, 1, 2, 35, 'CS-HC1211', 'Introduction to Human Computer Interaction', 1, 3, 'lab', '', 187),
(130, 8, 2, 3, 21, 'CpE-Datstruct201', 'Data Structures & Algorithm Analysis', 3, 4, 'lec', '', 562),
(131, 8, 2, 3, 21, 'CpE-Datstruct201', 'Data Structures & Algorithm Analysis', 3, 4, 'lab', '', 562),
(132, 8, 2, 3, 17, 'MAT201', 'Engineering  Data Analysis', 3, 3, 'lec', '', 956),
(133, 8, 2, 3, 21, 'OPT201', 'Productivity Tools 2', 3, 2, 'lec', '', 279),
(134, 8, 2, 3, 21, 'OPT201', 'Productivity Tools 2', 3, 2, 'lab', '', 279),
(135, 8, 2, 1, 20, 'CAD211', 'Computer-Aided Drafting', 3, 2, 'lec', '', 746),
(136, 8, 2, 1, 20, 'CAD211', 'Computer-Aided Drafting', 3, 2, 'lab', '', 746),
(137, 8, 2, 1, 20, 'CpE-OOP211', 'Object-Oriented Programming', 3, 3, 'lec', '', 196),
(138, 8, 2, 1, 20, 'CpE-OOP211', 'Object-Oriented Programming', 3, 3, 'lab', '', 196),
(139, 8, 2, 1, 17, 'CpE-EC211', 'Fundamentals of Electric Circuits', 3, 3, 'lec', '', 487),
(140, 8, 2, 1, 17, 'CpE-EC211', 'Fundamentals of Electric Circuits', 3, 3, 'lab', '', 487),
(141, 8, 2, 1, 17, 'MAT211', 'Calculus 2', 3, 3, 'lec', '', 749),
(142, 8, 2, 1, 17, 'Hum211', 'Art Appreciation', 3, 3, 'lec', '', 365),
(143, 8, 2, 1, 17, 'Socio211', 'The Contemporary World', 3, 3, 'lec', '', 568),
(144, 8, 2, 1, 17, 'Filipino211', 'Komonikasyon sa Akademikong Filipino', 3, 3, 'lec', '', 685),
(145, 8, 2, 1, 19, 'PE211', 'Individual Sports', 2, 2, 'lec', '', 948),
(146, 8, 2, 1, 21, 'Ethics211', 'Engineering Ethics', 3, 3, 'lec', '', 271),
(147, 8, 2, 2, 17, 'Filipino221', 'Panitikan', 3, 3, 'lec', '', 623),
(148, 8, 2, 2, 21, 'MAT221', 'Differential Equations', 3, 3, 'lec', '', 384),
(149, 8, 2, 2, 20, 'CpE-EC221', 'Fundamentals of Electronic Circuits', 3, 3, 'lec', '', 321),
(150, 8, 2, 2, 20, 'CpE-EC221', 'Fundamentals of Electronic Circuits', 3, 3, 'lab', '', 321),
(151, 8, 2, 2, 20, 'Cpe-SoftD221', 'Software Design', 3, 3, 'lec', '', 324),
(152, 8, 2, 2, 20, 'Cpe-SoftD221', 'Software Design', 3, 3, 'lab', '', 324),
(153, 8, 2, 2, 20, 'CPE-OS221', 'Operating Systems', 3, 3, 'lec', '', 924),
(154, 8, 2, 2, 20, 'CPE-OS221', 'Operating Systems', 3, 3, 'lab', '', 924),
(155, 8, 2, 2, 17, 'CpE-NUM221', 'Numerical Methods', 3, 3, 'lec', '', 254),
(156, 8, 2, 2, 20, 'ENVI-221', 'Environmental Engineering', 3, 3, 'lec', '', 179),
(157, 8, 2, 2, 19, 'PE221', 'Team Sports', 2, 2, 'lec', '', 496),
(158, 8, 2, 2, 20, 'CpE-TECEng221', 'Engineering Technologies in CpE', 3, 3, 'lec', '', 596),
(159, 8, 3, 3, 20, 'CpE-Techno301', 'Technopreneurship', 3, 3, 'lec', '', 651),
(160, 8, 3, 3, 20, 'CpE-Laws301', 'CpE Laws and Professional Practice', 3, 3, 'lec', '', 725),
(161, 8, 3, 3, 20, 'CpE-HDL301', 'Introduction to HDL', 3, 2, 'lec', '', 251),
(162, 8, 3, 3, 20, 'CpE-HDL301', 'Introduction to HDL', 3, 2, 'lab', '', 251),
(163, 8, 3, 1, 20, 'CpE-SenS311', 'Fundamentals of Mixed Signals and', 3, 3, 'lec', '', 827),
(164, 8, 3, 1, 20, 'CpE-SenS311', 'Fundamentals of Mixed Signals and', 3, 3, 'lab', '', 827),
(165, 8, 3, 1, 20, 'CpE-LDes311', 'Logic Circuits and Design', 3, 3, 'lec', '', 165),
(166, 8, 3, 1, 20, 'CpE-LDes311', 'Logic Circuits and Design', 3, 3, 'lab', '', 165),
(167, 8, 3, 1, 20, 'CpE-Dat311', 'Data and Digital Communications', 3, 3, 'lec', '', 847),
(168, 8, 3, 1, 20, 'CpE-Dat311', 'Data and Digital Communications', 3, 3, 'lab', '', 847),
(169, 8, 3, 1, 20, 'CpE-Cont311', 'Feedback and Control Systems', 3, 3, 'lec', '', 274),
(170, 8, 3, 1, 20, 'CpE-Cont311', 'Feedback and Control Systems', 3, 3, 'lab', '', 274),
(171, 8, 3, 1, 20, 'CpE-Research311', 'CPE Research', 3, 3, 'lec', '', 638),
(172, 8, 3, 1, 17, 'Filipino311', 'Masining na Pagpapahayag', 3, 3, 'lec', '', 135),
(173, 8, 3, 1, 20, 'CpE-Ele311', 'Introduction to Robotics', 3, 3, 'lec', '', 246),
(174, 8, 3, 1, 20, 'CpE-Ele311', 'Introduction to Robotics', 3, 3, 'lab', '', 246),
(175, 8, 3, 1, 20, 'CAD311', 'Computer Engineering Drafting & Design', 3, 2, 'lec', '', 512),
(176, 8, 3, 1, 20, 'CAD311', 'Computer Engineering Drafting & Design', 3, 2, 'lab', '', 512),
(177, 8, 3, 2, 21, 'CpE-Safe321', 'Basic Occupational Health & Safety', 3, 3, 'lec', '', 613),
(178, 8, 3, 2, 20, 'CpE-Netwrk321', 'Computer Network and Security', 3, 3, 'lec', '', 591),
(179, 8, 3, 2, 20, 'CpE-Netwrk321', 'Computer Network and Security', 3, 3, 'lab', '', 591),
(180, 8, 3, 2, 20, 'CpE-Micro321', 'Microprocessor', 3, 3, 'lec', '', 462),
(181, 8, 3, 2, 20, 'CpE-Micro321', 'Microprocessor', 3, 3, 'lab', '', 462),
(182, 8, 3, 2, 20, 'Cpe-Research321', 'Methods of Research', 3, 3, 'lec', '', 594),
(183, 8, 3, 2, 20, 'Cpe-Mgnt321', 'Engineering Management', 3, 3, 'lec', '', 421),
(184, 8, 3, 2, 20, 'Cpe-Ele321', 'Robot Dynamics', 3, 3, 'lec', '', 894),
(185, 8, 3, 2, 20, 'Cpe-Ele321', 'Robot Dynamics', 3, 3, 'lab', '', 894),
(186, 8, 3, 2, 20, 'Cpe-Free-Ele321', 'Business Analytics', 3, 3, 'lec', '', 375),
(187, 8, 3, 2, 17, 'Rizal321', 'Life & Works of Dr. Jose Rizal', 3, 3, 'lec', '', 813),
(188, 8, 4, 3, 17, 'CpE-PRAC401', 'Practicum/OJT', 6, 6, 'lec', '', 359),
(189, 8, 4, 1, 20, 'CpE-AO411', 'Computer Architecture & Organization', 3, 3, 'lec', '', 713),
(190, 8, 4, 1, 20, 'CpE-AO411', 'Computer Architecture & Organization', 3, 3, 'lab', '', 713),
(191, 8, 4, 1, 20, 'CpE-ELE411', 'Robot Design', 3, 3, 'lec', '', 391),
(192, 8, 4, 1, 20, 'CpE-ELE411', 'Robot Design', 3, 3, 'lab', '', 391),
(193, 8, 4, 2, 20, 'CpE-ProjDe421', 'CpE Practice and Design 2', 6, 9, 'lec', '', 367),
(194, 8, 4, 2, 20, 'CpE-ProjDe421', 'CpE Practice and Design 2', 3, 9, 'lab', '', 367),
(195, 8, 4, 1, 20, 'CpE-DSP411', 'Digital Signal Processing', 3, 3, 'lec', '', 792),
(196, 8, 4, 1, 20, 'CpE-DSP411', 'Digital Signal Processing', 3, 3, 'lab', '', 792),
(197, 8, 4, 2, 18, 'CpE-Seminar421', 'CpE Seminars and Field Trips', 3, 3, 'lec', '', 839),
(198, 8, 4, 1, 20, 'CpE-ProjDe411', 'CpE Practice and Design 1', 6, 9, 'lec', '', 589),
(199, 8, 4, 1, 20, 'CpE-ProjDe411', 'CpE Practice and Design 1', 3, 9, 'lab', '', 589),
(200, 8, 4, 2, 20, 'CpE-ES421', 'Embedded Systems', 3, 3, 'lec', '', 532),
(201, 8, 4, 2, 20, 'CpE-ES421', 'Embedded Systems', 3, 3, 'lab', '', 532),
(202, 8, 4, 1, 20, 'CpE-Free-Ele411', 'Analytics Modelling Technologies and Tools', 3, 1, 'lec', '', 695),
(203, 7, 4, 1, 35, 'CS-CertExam411', 'Philnits/Microsoft/TESDA', 3, 3, 'lec', '', 741),
(204, 8, 1, 2, 18, 'Cpe-HDL121', 'Introduction to HDL', 3, 2, 'lec', '', 842),
(205, 8, 1, 2, 18, 'Cpe-HDL121', 'Introduction to HDL', 3, 2, 'lab', '', 842),
(206, 1, 1, 1, 22, '*ENGLISH 01', 'English Plus', 3, 3, 'lec', '', 837),
(207, 1, 1, 1, 22, 'ENGLISH 1', 'Communication Arts 1', 3, 3, 'lec', '', 287),
(208, 1, 1, 1, 22, 'MATH 1', 'College Algebra', 3, 3, 'lec', '', 729);

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
(46, 74, 1, 70),
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
(90, 107, 1, 91),
(92, 118, 1, 89),
(93, 119, 1, 89),
(94, 117, 1, 99),
(95, 122, 1, 103),
(97, 125, 1, 106),
(98, 126, 1, 108),
(99, 127, 1, 108),
(100, 128, 1, 104),
(101, 129, 1, 104),
(108, 130, 1, 107),
(109, 131, 1, 107),
(112, 132, 1, 123),
(113, 133, 1, 114),
(114, 134, 1, 114),
(117, 137, 1, 130),
(118, 138, 1, 130),
(119, 139, 1, 97),
(120, 140, 1, 97),
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
(158, 188, 1, 182),
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
(180, 207, 2, 206);

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
(54, 1, '2018-2019', 'active'),
(55, 3, '2018-2019', 'inactive'),
(56, 3, '2017-2018', 'inactive'),
(57, 1, '2017-2018', 'inactive'),
(58, 2, '2017-2018', 'inactive'),
(59, 3, '2016-2017', 'inactive'),
(60, 1, '2016-2017', 'inactive'),
(61, 2, '2016-2017', 'inactive');

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
  `cn` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `status` enum('inactive','active') NOT NULL,
  `is_new` enum('yes','no') NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uID`, `roleID`, `userName`, `userPass`, `fn`, `mn`, `ln`, `dob`, `sex`, `address`, `cn`, `email`, `status`, `is_new`, `date_created`) VALUES
(1, 1, 'admin', 'Iamadmin1', 'Cheryl', '', 'Tarre', '1997-10-24', 'Female', 'Kalimot ko street', '09121212211', 'cheryl@gmail.com', 'active', 'no', '2019-01-07 12:27:13'),
(6, 4, 'Banez', 'Angel123', 'Angel Jean', 'Quinte', 'Banez', '1999-01-20', 'Female', 'Casilda', '09106024370', 'agnel@gmail.com', 'active', 'yes', '2018-11-14 02:59:27'),
(43, 4, 'Inclino', 'Iamwilliam1', 'William Jay', 'Intales', 'Inclino', '1997-10-24', 'Male', 'Puertobello', '0921212122', 'nightfury102497@gmail.com', 'active', 'yes', '2019-01-22 02:00:18'),
(46, 4, 'Pacala', 'Iamraffy1', 'Raffy', '', 'Pacala', '2008-10-29', 'Male', 'Isabel', '098762121212', 'Raf@yahoo.com', 'active', 'yes', '2018-12-04 12:49:10'),
(47, 3, 'Prawn', 'Angelica1', 'Angelica', '', 'Prawn', '1999-09-27', 'Female', 'Ormoc City', '09121212228', 'angelica@gmail.com', 'active', 'no', '2018-11-14 03:04:07'),
(48, 4, '', '', 'Rhayjay', '', 'Alag', '1997-12-22', 'Male', '', '', '', 'inactive', 'yes', '2018-11-14 02:14:52'),
(49, 4, '', '', 'Julito', '', 'Caquilala', '0000-00-00', 'Male', '', '', '', 'inactive', 'yes', '2018-11-14 02:14:52'),
(54, 3, 'Passion', 'Passion1', 'Reyjoy', '', 'Passion', '2008-09-23', 'Male', 'Ormoc city', '09876212111', 'rey@gmail.com', 'active', 'no', '2018-10-10 00:20:38'),
(58, 4, 'Tayag', 'Apart123', 'Joshua', '', 'Tayag', '1998-01-20', 'Male', 'San Antonio Spurs', '092121212121', 'Josh@gmail.com', 'active', 'yes', '2018-12-03 02:50:42'),
(59, 4, 'Estrera', 'Estrera1', 'Joseph', '', 'Estrera', '2003-10-29', 'Male', 'Ambot', '0921212121', 'Estrera@gmail.com', 'active', 'yes', '2019-01-07 12:31:35'),
(60, 4, '', '', 'Mitzi', '', 'Yap', '1998-12-08', 'Female', '', '', '', 'inactive', 'yes', '2018-11-14 02:14:52'),
(61, 4, '', '', 'Scyth', '', 'Badayos', '1996-07-22', 'Female', '', '', '', 'inactive', 'yes', '2018-11-14 02:14:52'),
(62, 4, '', '', 'Angel', '', 'Bestil', '0000-00-00', 'Female', '', '', '', 'inactive', 'yes', '2018-11-14 02:14:52'),
(63, 4, '', '', 'Merzon', '', 'Albarico', '1996-01-06', 'Male', '', '', '', 'inactive', 'yes', '2018-11-14 02:14:52'),
(64, 4, '', '', 'Maricon', '', 'Daffon', '1997-11-11', 'Female', '', '', '', 'inactive', 'yes', '2018-11-14 02:14:52'),
(65, 4, '', '', 'Mayette', '', 'Bulahan', '0000-00-00', 'Female', '', '', '', 'inactive', 'yes', '2018-11-14 02:14:52'),
(66, 4, '', '', 'Jomari', '', 'Bunye', '0000-00-00', 'Male', '', '', '', 'inactive', 'yes', '2018-11-14 02:14:52'),
(67, 4, 'Lapinid', 'Lapinig101', 'Mercy Jane', '', 'Lapinid', '1996-09-29', 'Female', 'ok', '03154861648', 'd@gmail.com', 'active', 'yes', '2019-01-26 05:32:36'),
(68, 4, '', '', 'Jorge', '', 'Mendoza', '0000-00-00', 'Male', '', '', '', 'inactive', 'yes', '2018-11-14 02:14:52'),
(69, 4, '', '', 'Karl', '', 'Laurente', '0000-00-00', 'Male', '', '', '', 'inactive', 'yes', '2018-11-14 02:14:52'),
(70, 4, '', '', 'Jowanos', '', 'Alcala', '1999-08-09', 'Male', '', '', '', 'inactive', 'yes', '2018-11-14 02:14:52'),
(71, 4, '', '', 'Bonbon', '', 'Inclino', '0000-00-00', 'Male', '', '', '', 'inactive', 'yes', '2018-11-14 02:14:52'),
(72, 4, '', '', 'Khenny', '', 'Sumile', '0000-00-00', 'Female', '', '', '', 'inactive', 'yes', '2018-11-14 02:14:52'),
(73, 4, '', '', 'Avegiel', '', 'Libres', '0000-00-00', 'Female', '', '', '', 'inactive', 'yes', '2018-11-14 02:14:52'),
(74, 4, '', '', 'lemarie', '', 'Bongbong', '0000-00-00', 'Female', '', '', '', 'inactive', 'yes', '2018-11-14 02:14:52'),
(75, 4, '', '', 'Jaboy', '', 'Banzal', '0000-00-00', 'Male', '', '', '', 'inactive', 'yes', '2018-11-14 02:14:52'),
(76, 4, '', '', 'Luis', '', 'Magalona', '0000-00-00', 'Male', '', '', '', 'inactive', 'yes', '2018-11-14 02:14:52'),
(83, 4, '', '', 'Anikka', '', 'Balancio', '0000-00-00', 'Female', '', '', '', 'inactive', 'yes', '2018-11-14 02:14:52'),
(84, 4, '', '', 'Dave', '', 'Camasura', '0000-00-00', 'Male', '', '', '', 'inactive', 'yes', '2018-11-14 02:14:52'),
(85, 4, '', '', 'Rhea', '', 'Laurente', '0000-00-00', 'Female', '', '', '', 'inactive', 'yes', '2018-11-14 02:14:52'),
(86, 4, '', '', 'Kevin', '', 'Aying', '0000-00-00', 'Male', '', '', '', 'inactive', 'yes', '2018-11-14 02:14:52'),
(87, 4, '', '', 'Kyle', '', 'Aying', '0000-00-00', 'Male', '', '', '', 'inactive', 'yes', '2018-11-14 02:14:52'),
(88, 4, '', '', 'Axl', '', 'Aliasot', '0000-00-00', 'Male', '', '', '', 'inactive', 'yes', '2018-11-14 02:14:52'),
(89, 4, '', '', 'Ken', '', 'Cormanes', '0000-00-00', 'Male', '', '', '', 'inactive', 'yes', '2018-11-14 02:14:52'),
(106, 2, 'Bernardo', 'Bernards1', 'Mark', '', 'Bernardo', '1992-10-30', 'Male', 'Ormoc City', '09212121212', '', 'active', 'no', '2019-01-12 02:34:11'),
(107, 2, 'Cantero', 'Iamjojo1', 'Joscoro', '', 'Cantero', '1888-11-30', 'Male', 'Sanjuan', '09212121212', 'jojo@gmail.com', 'active', 'no', '2019-01-13 03:02:22'),
(108, 2, 'Phua', 'Iamwowhie1', 'Wowhie', '', 'Phua', '1888-10-25', 'Male', 'Cogon Ormoc City', '', 'wow@gmail.com', 'active', 'no', '2018-12-01 07:39:46'),
(109, 2, 'CoHat', 'Iamalex1', 'Alexander', '', 'CoHat', '1888-09-24', 'Male', 'Ormoc City', '09876173627', 'alex@gmail.com', 'active', 'no', '2018-12-08 05:54:46'),
(110, 2, 'Quirino', 'Iamquirino1', 'Jhay', '', 'Quirino', '1888-01-01', 'Male', 'Ormoc City', '09121212143', 'Q@gmail.com', 'active', 'no', '2018-12-08 05:57:03'),
(111, 2, 'Martinez', 'Iammartin1', 'Martin', '', 'Martinez', '1888-01-01', 'Male', 'Ormoc City', '09785745745', 'mm@yahoo.com', 'active', 'no', '2018-12-08 05:57:21'),
(112, 2, 'Isip', 'Iamapple1', 'Apple', '', 'Isip', '1888-01-01', 'Female', 'Ormoc City', '09758458454', 'apple@gmail.com', 'active', 'no', '2018-12-08 05:57:38'),
(113, 2, 'Tarre', 'Iamtarre1', 'Cheryl', '', 'Tarre', '1888-01-01', 'Female', 'Ormoc City', '09847237273', 'che@gmail.com', 'active', 'no', '2018-12-08 05:57:57'),
(114, 2, 'Lopez', 'Iamlopez1', 'Jotham', '', 'Lopez', '1888-01-01', 'Male', 'Ormoc City', '09323232323', 'jot@gmail.com', 'active', 'no', '2018-12-08 05:58:14'),
(115, 4, 'Sample', 'Iamsample1', 'Sample', '', 'Sample', '1997-10-24', 'Male', 'Ormoc city', '09121212717', 'sample@gmail.com', 'active', 'yes', '2018-12-13 03:29:09'),
(116, 2, 'temporary', 'temporary', '', '', '', '0000-00-00', '', '', '', '', 'active', 'no', '2018-12-31 04:06:11'),
(117, 2, 'Gablino', 'Gablino1', 'Archiebald', '', 'Gablino', '1777-01-28', 'Male', 'Ormoc City', '', 'Gablins@gmail.com', 'active', 'no', '2019-01-12 02:43:59'),
(118, 4, '', '', 'Sample', 'Sample name', 'Sample last', '1998-08-24', 'Female', '', '09484924908', '', 'inactive', 'yes', '2019-01-13 10:36:48'),
(119, 2, 'Leones', 'Leones101', 'Nimfa', '', 'Leones', '1984-12-29', 'Female', '', '09215545556', 'aaka@gmail.com', 'active', 'no', '2019-01-26 03:03:11');

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
(2, 61, 3),
(3, 62, 3),
(4, 63, 3),
(7, 70, 3),
(10, 50, 3),
(11, 68, 3),
(12, 69, 3),
(13, 83, 4),
(14, 84, 4),
(15, 171, 3),
(16, 173, 3),
(17, 174, 3);

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
-- Indexes for table `guardian`
--
ALTER TABLE `guardian`
  ADD PRIMARY KEY (`guardID`),
  ADD KEY `uID` (`uID`),
  ADD KEY `studID` (`studID`);

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
  ADD KEY `feeID` (`feeID`);

--
-- Indexes for table `prospectus`
--
ALTER TABLE `prospectus`
  ADD PRIMARY KEY (`prosID`),
  ADD UNIQUE KEY `prosID_2` (`prosID`),
  ADD KEY `course_id` (`courseID`),
  ADD KEY `prosID` (`prosID`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`regID`);

--
-- Indexes for table `reg_guardian`
--
ALTER TABLE `reg_guardian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `classID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `counter`
--
ALTER TABLE `counter`
  MODIFY `countID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
-- AUTO_INCREMENT for table `enrolment_settings`
--
ALTER TABLE `enrolment_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `facID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `fac_spec`
--
ALTER TABLE `fac_spec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `feeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `grade_formula`
--
ALTER TABLE `grade_formula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `guardian`
--
ALTER TABLE `guardian`
  MODIFY `guardID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prospectus`
--
ALTER TABLE `prospectus`
  MODIFY `prosID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `regID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reg_guardian`
--
ALTER TABLE `reg_guardian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `roleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `room_spec`
--
ALTER TABLE `room_spec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `secID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

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
  MODIFY `staffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `studclass`
--
ALTER TABLE `studclass`
  MODIFY `scID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `studgrade`
--
ALTER TABLE `studgrade`
  MODIFY `sgID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `studprospectus`
--
ALTER TABLE `studprospectus`
  MODIFY `spID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `stud_fee`
--
ALTER TABLE `stud_fee`
  MODIFY `sfID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `subject_req`
--
ALTER TABLE `subject_req`
  MODIFY `subReqID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `term`
--
ALTER TABLE `term`
  MODIFY `termID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `year`
--
ALTER TABLE `year`
  MODIFY `yearID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `year_req`
--
ALTER TABLE `year_req`
  MODIFY `yrID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
-- Constraints for table `guardian`
--
ALTER TABLE `guardian`
  ADD CONSTRAINT `guardian_ibfk_1` FOREIGN KEY (`uID`) REFERENCES `users` (`uID`);

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
