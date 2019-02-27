-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2019 at 01:19 PM
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
(10, 'enrol_studs', 53, 3),
(11, 'enrol_studs', 54, 0),
(12, 'enrol_studs', 55, 0),
(13, 'fees', 54, 0),
(14, 'enrol_studs', 56, 0),
(15, 'enrol_studs', 57, 0),
(16, 'enrol_studs', 58, 0),
(17, 'enrol_studs', 59, 0),
(18, 'enrol_studs', 60, 0),
(19, 'enrol_studs', 61, 0),
(20, 'fees', 53, 1);

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
(6, 'faculty', 12),
(7, 'subject', 283),
(8, 'student', 136),
(9, 'staff', 3),
(10, 'reg_requests', 0),
(11, 'reg_users', 13),
(12, 'day', 3),
(13, 'active_students', 2),
(14, 'guardian', 0),
(15, 'enrol_requests', 0),
(16, 'specialization', 37),
(17, 'payment_logs', 1);

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
(38, 119, 'Filipino'),
(39, 122, 'Mathematics');

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
(162, 37, 39),
(163, 39, 23),
(164, 39, 25);

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
  `feeStatus` enum('ongoing','done','cancelled') NOT NULL,
  `tshirt` enum('unavailable','available') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `prosType` enum('New','Old') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prospectus`
--

INSERT INTO `prospectus` (`prosID`, `courseID`, `duration`, `prosCode`, `prosDesc`, `prosDesc2`, `effectivity`, `prosType`) VALUES
(1, 132, 2, 'ACT 2016-2017', 'G.R. # 03 series of 2015', 'No. 87 Series of 2017', '2016-2017', 'Old'),
(3, 374, 4, 'BSIT 2011-2012', '', '', '2011-2012', 'Old'),
(4, 376, 4, 'BSCS 2016-2017', '', '', '2016-2017', 'Old'),
(5, 377, 5, 'BSCPE 2014-2015', '', '', '2014-2015', 'Old'),
(6, 374, 4, 'BSIT 2018-2019', 'G.R. # 03 series of 2015', 'No. 25 Series of 2015', '2018-2019 (K+12 Compliant)', 'New'),
(7, 376, 4, 'BSCS 2018-2019', 'G.R. # 03 series of 2015', 'No. 87 Series of 2017', '2018-2019 [K + 12] Compliant', 'New'),
(8, 377, 4, 'BSCpE 2018-2019', 'G.R. # 03 series of 2015', 'No. 87 Series of 2017', '2018-2019 (K+12 Compliant)', 'New');

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

-- --------------------------------------------------------

--
-- Table structure for table `reg_guardian`
--

CREATE TABLE `reg_guardian` (
  `id` int(11) NOT NULL,
  `regID` int(11) NOT NULL,
  `studID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studID` int(11) NOT NULL,
  `yearID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `controlNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studID`, `yearID`, `uID`, `controlNo`) VALUES
(1, 1, 120, 616),
(2, 1, 121, 611),
(3, 1, 123, 0),
(4, 1, 125, 762),
(5, 1, 126, 0),
(6, 1, 127, 0),
(7, 1, 128, 0),
(8, 1, 129, 0),
(9, 1, 130, 0),
(10, 1, 131, 0),
(11, 1, 132, 159),
(12, 1, 133, 744),
(13, 1, 134, 0),
(14, 1, 135, 0),
(15, 1, 136, 0),
(16, 1, 137, 0),
(17, 1, 138, 0),
(18, 1, 139, 0),
(19, 1, 140, 0),
(20, 1, 141, 0),
(21, 1, 142, 0),
(22, 2, 143, 0),
(23, 2, 144, 149),
(24, 3, 145, 0),
(25, 3, 146, 118),
(26, 3, 147, 144),
(27, 3, 148, 102),
(28, 3, 149, 0),
(29, 4, 150, 93),
(30, 4, 151, 55),
(31, 4, 152, 102),
(32, 4, 153, 92),
(33, 4, 154, 169),
(34, 4, 155, 106),
(35, 4, 156, 131),
(36, 4, 157, 68),
(37, 4, 158, 125),
(38, 4, 159, 123),
(39, 4, 160, 124),
(40, 4, 161, 101),
(41, 4, 162, 137),
(42, 4, 163, 104),
(43, 4, 164, 107),
(44, 4, 165, 0),
(45, 4, 166, 138),
(46, 4, 167, 136),
(47, 5, 168, 80),
(48, 5, 169, 0),
(49, 5, 170, 78),
(50, 5, 171, 97),
(51, 5, 172, 97),
(52, 5, 173, 85),
(53, 5, 174, 0),
(54, 5, 175, 91),
(55, 5, 176, 75),
(56, 5, 177, 54),
(57, 5, 178, 86),
(58, 5, 179, 76),
(59, 5, 180, 81),
(60, 5, 181, 0),
(61, 5, 182, 126),
(62, 5, 183, 90),
(63, 5, 184, 142),
(64, 5, 185, 84),
(65, 1, 186, 0),
(66, 1, 187, 0),
(67, 1, 188, 0),
(68, 1, 189, 0),
(69, 1, 190, 0),
(70, 1, 191, 0),
(71, 1, 192, 0),
(72, 1, 193, 0),
(73, 1, 194, 0),
(74, 1, 195, 0),
(75, 1, 196, 0),
(76, 1, 197, 0),
(77, 1, 198, 0),
(78, 1, 199, 0),
(79, 1, 200, 0),
(80, 1, 201, 0),
(81, 1, 202, 0),
(82, 1, 203, 0),
(83, 1, 204, 0),
(84, 1, 205, 737),
(85, 1, 206, 0),
(86, 2, 207, 732),
(87, 2, 208, 715),
(88, 2, 209, 730),
(89, 2, 210, 726),
(90, 2, 211, 725),
(91, 2, 212, 727),
(92, 2, 213, 716),
(93, 3, 214, 695),
(94, 3, 215, 689),
(95, 3, 216, 696),
(96, 3, 217, 141),
(97, 3, 218, 691),
(98, 3, 219, 0),
(99, 4, 220, 637),
(100, 3, 221, 446),
(101, 3, 222, 706),
(102, 3, 223, 97),
(103, 3, 224, 702),
(104, 3, 225, 734),
(105, 3, 226, 724),
(106, 3, 227, 569),
(107, 3, 228, 711),
(108, 3, 229, 681),
(109, 4, 230, 653),
(110, 4, 231, 668),
(111, 4, 232, 580),
(112, 4, 233, 677),
(113, 4, 234, 648),
(114, 4, 235, 650),
(115, 4, 236, 641),
(116, 4, 237, 0),
(117, 4, 238, 632),
(118, 4, 239, 667),
(119, 4, 240, 656),
(120, 4, 241, 630),
(121, 4, 242, 708),
(122, 4, 243, 0),
(123, 4, 244, 661),
(124, 4, 245, 616),
(125, 4, 246, 657),
(126, 4, 247, 642),
(127, 4, 248, 633),
(128, 4, 249, 635),
(129, 4, 250, 387),
(130, 4, 251, 512),
(131, 4, 252, 620),
(132, 4, 253, 660),
(133, 4, 254, 0),
(134, 4, 255, 701),
(135, 4, 256, 694),
(136, 4, 257, 638);

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
(1, 1, 6),
(2, 2, 6),
(3, 3, 6),
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
(22, 22, 5),
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
(50, 50, 5),
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
(136, 136, 3);

-- --------------------------------------------------------

--
-- Table structure for table `studrec_per_term`
--

CREATE TABLE `studrec_per_term` (
  `id` int(11) NOT NULL,
  `studID` int(11) NOT NULL,
  `yearID` int(11) NOT NULL,
  `termID` int(11) NOT NULL,
  `prosID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(107, 1, 1, 1, 23, 'IT 2', 'Computer Programming 1', 3, 4, 'lec', '', 692),
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
(124, 3, 2, 2, 37, 'MATH 4', 'Probability & Statistics', 3, 3, 'lec', '', 217),
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
(208, 1, 1, 1, 22, 'MATH 1', 'College Algebra', 3, 3, 'lec', '', 729),
(209, 3, 1, 1, 37, 'ENGLISH 01', 'English Plus', 3, 3, 'lec', '', 649),
(210, 3, 1, 1, 37, 'ENGLISH 1', 'Communication Arts 1', 3, 3, 'lec', '', 486),
(211, 3, 1, 1, 37, 'Math 1', 'College Algebra', 3, 3, 'lec', '', 193),
(212, 3, 1, 1, 41, 'IT 1', 'IT Fundamentals', 3, 3, 'lec', '', 472),
(213, 3, 1, 1, 40, 'IT 2', 'Computer Programming 1', 3, 4, 'lec', '', 452),
(214, 3, 1, 1, 40, 'IT 2', 'Computer Programming 1', 1, 4, 'lab', '', 452),
(217, 3, 1, 1, 39, 'PE 1', 'Physical Fitness 1', 2, 2, 'lec', '', 186),
(218, 3, 1, 1, 39, 'NSTP 1', 'National Service Training Program 1', 3, 3, 'lec', '', 653),
(219, 3, 1, 1, 37, 'FILIPINO 1', 'Sining ng Pakikipagtalastasan 1', 3, 3, 'lec', '', 765),
(220, 3, 1, 2, 37, 'ENGLISH 2', 'Communications for IT', 3, 3, 'lec', '', 289),
(221, 3, 1, 2, 40, 'IT 3', 'Computer Programming 2', 3, 4, 'lec', '', 427),
(222, 3, 1, 2, 40, 'IT 3', 'Computer Programming 2', 1, 4, 'lab', '', 427),
(223, 3, 1, 2, 40, 'IT 4', 'Presentation Skill in IT', 3, 3, 'lec', '', 325),
(224, 3, 1, 2, 37, 'MATH 2', 'Trigonometry', 3, 3, 'lec', '', 423),
(225, 3, 1, 2, 40, 'IT 5', 'Fundamentals of Problem Solving', 3, 3, 'lec', '', 736),
(228, 3, 1, 2, 39, 'PE 2', 'Rythmic Activities', 2, 2, 'lec', '', 365),
(229, 3, 1, 2, 39, 'NSTP 2', 'National Service Training Program 2', 3, 3, 'lec', '', 862),
(230, 3, 1, 2, 37, 'FILIPINO 2', 'Pagbasa at Pagsulat sa Filipino', 3, 3, 'lec', '', 642),
(231, 3, 2, 1, 37, 'PHYSICS 1', 'Mechanics & Thermodynamics', 3, 3, 'lec', '', 534),
(232, 3, 2, 1, 40, 'IT 6', 'Computer & File Organization', 3, 3, 'lec', '', 413),
(233, 3, 2, 1, 40, 'IT 7', 'Object-Oriented Programming', 3, 4, 'lec', '', 189),
(234, 3, 2, 1, 40, 'IT 7', 'Object-Oriented Programming', 1, 4, 'lab', '', 189),
(235, 3, 2, 1, 40, 'IT 8', 'Operating System Application', 2, 3, 'lec', '', 579),
(236, 3, 2, 1, 40, 'IT 8', 'Operating System Application', 1, 3, 'lab', '', 579),
(237, 3, 2, 1, 37, 'MATH 3', 'Discrete Structures', 3, 3, 'lec', '', 581),
(238, 3, 2, 1, 37, 'ENGLISH 3', 'Speech and Oral Communication', 3, 3, 'lec', '', 396),
(239, 3, 2, 1, 37, 'SOC SCI 1', 'General Psychology with Drug Prevention', 3, 3, 'lec', '', 154),
(240, 3, 2, 1, 39, 'PE 3', 'Individual Sports', 2, 2, 'lec', '', 125),
(241, 3, 2, 1, 37, 'HUMANITIES 1', 'Art, Man & Society', 3, 3, 'lec', '', 738),
(242, 3, 2, 2, 37, 'PHYSICS 2', 'Electricity & Magnetism', 3, 3, 'lec', '', 693),
(243, 3, 2, 2, 41, 'IT-ELE 1', 'Data Comm. & Computer Networks', 3, 3, 'lec', '', 271),
(244, 3, 2, 2, 40, 'IT 9', 'Database Management System 1', 2, 3, 'lec', '', 542),
(245, 3, 2, 2, 40, 'IT 9', 'Database Management System 1', 1, 3, 'lab', '', 542),
(246, 3, 2, 2, 40, 'IT-ELE 2', 'Web Page Desin & Development', 2, 3, 'lec', '', 953),
(247, 3, 2, 2, 40, 'IT-ELE 2', 'Web Page Desin & Development', 1, 3, 'lab', '', 953),
(248, 3, 2, 2, 40, 'IT 10', 'Systems Analysis & Design', 3, 3, 'lec', '', 318),
(249, 3, 2, 2, 37, 'MATH 4', 'Probability & Statistics', 3, 3, 'lec', '', 217),
(250, 3, 2, 2, 37, 'SOC SCI 2', 'Professional Ethics with Values Formation', 3, 3, 'lec', '', 512),
(251, 3, 2, 2, 37, 'ENGLISH 4', 'Business English & Correspondence', 3, 3, 'lec', '', 925),
(252, 3, 2, 2, 39, 'PE 4', 'Team Sports', 2, 2, 'lec', '', 347),
(253, 3, 3, 1, 41, 'IT-ELE 3', 'Computer Animation', 2, 3, 'lec', '', 934),
(254, 3, 3, 1, 41, 'IT-ELE 3', 'Computer Animation', 1, 3, 'lab', '', 934),
(255, 3, 3, 1, 40, 'IT 11', 'Database Management System 2', 3, 3, 'lec', '', 294),
(256, 3, 3, 1, 40, 'IT 12', 'Modelling & Simulation', 3, 3, 'lec', '', 195),
(257, 3, 3, 1, 40, 'IT 13', 'Management Information System', 3, 3, 'lec', '', 753),
(258, 3, 3, 1, 37, 'ECO 1', 'Economics w/ Taxation & Agrarian Reform', 3, 3, 'lec', '', 257),
(259, 3, 3, 1, 37, 'HUMANITIES 2', 'Philippine Literature', 3, 3, 'lec', '', 954),
(260, 3, 3, 1, 37, 'ACCOUNTING 1', 'Accounting Principles', 3, 3, 'lec', '', 752),
(261, 3, 3, 1, 40, 'IT 14', 'Quality Conciousness, habits & Processes', 3, 3, 'lec', '', 184),
(262, 3, 3, 2, 40, 'IT 15', 'Software Engineering', 2, 3, 'lec', '', 893),
(263, 3, 3, 2, 40, 'IT 15', 'Software Engineering', 1, 3, 'lab', '', 893),
(264, 3, 3, 2, 40, 'IT 16', 'Multimedia System', 2, 3, 'lec', '', 842),
(265, 3, 3, 2, 40, 'IT 16', 'Multimedia System', 1, 3, 'lab', '', 842),
(266, 3, 3, 2, 41, 'IT-ELE 4', 'Mobile Applicatoins Development', 2, 3, 'lec', '', 732),
(267, 3, 3, 2, 41, 'IT-ELE 4', 'Mobile Applicatoins Development', 1, 3, 'lab', '', 732),
(268, 3, 3, 2, 41, 'IT-ELE 5', 'Project Management', 3, 3, 'lec', '', 924),
(269, 3, 3, 2, 41, 'FREE-ELE 2', 'Busines Systems', 3, 3, 'lec', '', 123),
(270, 3, 3, 2, 41, 'FREE-ELE 1', 'Dynamic Web Applications', 2, 4, 'lec', '', 148),
(271, 3, 3, 2, 41, 'FREE-ELE 1', 'Dynamic Web Applications', 2, 4, 'lab', '', 148),
(272, 3, 4, 3, 40, 'IT PRAC', 'Practicum/OJT', 9, 9, 'lec', '', 258),
(273, 3, 4, 1, 40, 'IT PRO', 'IT Proposal', 6, 6, 'lec', '', 613),
(274, 3, 4, 1, 41, 'FREE-ELE 3', 'Computer Graphics & Visualization', 2, 3, 'lec', '', 179),
(275, 3, 4, 1, 41, 'FREE-ELE 3', 'Computer Graphics & Visualization', 1, 3, 'lab', '', 179),
(276, 3, 4, 1, 38, 'IT-SEMINAR', 'Seminars & Field Trip', 3, 3, 'lec', '', 825),
(277, 3, 4, 1, 41, 'FREE-ELE 4', 'Digital Design', 3, 3, 'lec', '', 174),
(278, 3, 4, 1, 40, 'IT 17', 'Information System Security', 2, 3, 'lec', '', 615),
(279, 3, 4, 1, 40, 'IT 17', 'Information System Security', 1, 3, 'lab', '', 615),
(280, 3, 4, 2, 40, 'IT 18', 'Software Integration', 3, 3, 'lec', '', 857),
(281, 3, 4, 2, 40, 'IT 19', 'Capstons Project (IT Thesis)', 3, 4, 'lec', '', 827),
(282, 3, 4, 2, 40, 'IT 19', 'Capstons Project (IT Thesis)', 1, 4, 'lab', '', 827),
(283, 3, 4, 2, 38, 'FREE-ELE 5', 'PHILNITS', 3, 3, 'lec', '', 321),
(284, 3, 4, 2, 40, 'IT 20', 'Internet Programming with Database', 2, 3, 'lec', '', 972),
(285, 3, 4, 2, 40, 'IT 20', 'Internet Programming with Database', 1, 3, 'lab', '', 972),
(286, 3, 4, 2, 37, 'RIZAL COURSE', 'Life & Works of Rizal', 3, 3, 'lec', '', 782),
(287, 3, 4, 1, 37, 'Fil 3', 'Masining na Pagpapahayag', 3, 3, 'lec', '', 245),
(288, 4, 1, 1, 9, '*ENGLISH 01', 'English Plus', 3, 3, 'lec', '', 732),
(289, 4, 1, 1, 9, 'ENGLISH 1', 'Communication Arts 1', 3, 3, 'lec', '', 587),
(290, 4, 1, 1, 9, 'MATH 1', 'College Algebra', 3, 3, 'lec', '', 865),
(291, 4, 1, 1, 6, 'CS 1', 'CS Fundamentals', 3, 3, 'lec', '', 319),
(292, 4, 1, 1, 6, 'CS 2', 'Computer Programming 1', 3, 4, 'lec', '', 415),
(293, 4, 1, 1, 6, 'CS 2', 'Computer Programming 1', 1, 4, 'lab', '', 415),
(295, 3, 1, 1, 40, 'KB 1', 'Keyboarding 1', 3, 3, 'lab', '', 451),
(296, 4, 1, 1, 6, 'KB 1 (lab)', 'Keyboarding 1', 3, 3, 'lab', '', 136),
(297, 4, 1, 1, 10, 'PE 1', 'Physical Fitness 1', 2, 2, 'lec', '', 254),
(298, 4, 1, 1, 10, 'NSTP 1', 'NSTP 1', 3, 3, 'lec', '', 619),
(299, 4, 1, 1, 9, 'ACCOUNTING 1', 'Accounting Principles', 3, 3, 'lec', '', 863),
(300, 4, 1, 2, 9, 'ENGLISH 2', 'Communications for IT', 3, 3, 'lec', '', 436),
(301, 4, 1, 2, 6, 'CS 3', 'Computer Programming 2', 3, 4, 'lec', '', 573),
(302, 4, 1, 2, 6, 'CS 3', 'Computer Programming 2', 1, 4, 'lab', '', 573),
(303, 4, 1, 2, 6, 'CS 4', 'Data Structure', 3, 3, 'lec', '', 527),
(304, 4, 1, 2, 9, 'MATH 2', 'Trigonometry', 3, 3, 'lec', '', 764),
(305, 4, 1, 2, 9, 'ECON 1', 'Economics w/ Taxation & Agrarian Reform', 3, 3, 'lec', '', 124),
(306, 3, 1, 2, 40, 'KB 2', 'Keyboarding 2', 3, 3, 'lab', '', 529),
(307, 4, 1, 2, 6, 'KB 2 (lab)', 'Keyboarding 2', 3, 3, 'lab', '', 175),
(308, 4, 1, 2, 10, 'PE 2', 'Rhythmic Activities', 2, 2, 'lec', '', 981),
(309, 4, 1, 2, 10, 'NSTP 2', 'National Service Training Program 2', 3, 3, 'lec', '', 536),
(310, 4, 2, 1, 9, 'PHYSICS 1', 'Mechanics & Thermodynamics', 3, 3, 'lec', '', 268),
(311, 4, 2, 1, 7, 'CS 5', 'Object-Oriented Programming', 3, 4, 'lec', '', 913),
(312, 4, 2, 1, 7, 'CS 5', 'Object-Oriented Programming', 1, 4, 'lab', '', 913),
(313, 4, 2, 1, 7, 'CS 6', 'Design & Analysis of Algorithm', 3, 3, 'lec', '', 158),
(314, 4, 2, 1, 9, 'MATH 3', 'Discrete Structures', 3, 3, 'lec', '', 389),
(315, 4, 2, 1, 9, 'ENGLISH 3', 'Speech & Oral Communication', 3, 3, 'lec', '', 918),
(316, 4, 2, 1, 9, 'MATH 4', 'Calculus', 3, 3, 'lec', '', 179),
(317, 4, 2, 1, 9, 'SOC SCI 1', 'General Psychology with Drug Prevention', 3, 3, 'lec', '', 813),
(318, 4, 2, 1, 10, 'PE 3', 'Individual Sports', 2, 2, 'lec', '', 145),
(319, 4, 2, 2, 9, 'PHYSICS 2', 'Electricity & Magnetism', 3, 3, 'lec', '', 392),
(320, 4, 2, 2, 7, 'CS 7', 'Automata & Language Theory', 3, 3, 'lec', '', 758),
(321, 4, 2, 2, 7, 'CS 8', 'Database Management System 1', 2, 3, 'lec', '', 432),
(322, 4, 2, 2, 7, 'CS 8', 'Database Management System 1', 1, 3, 'lab', '', 432),
(323, 4, 2, 2, 7, 'CS 9', 'System Analysis & Design', 3, 3, 'lec', '', 461),
(324, 4, 2, 2, 6, 'CS 10', 'Logic Design & Switching Theory', 3, 3, 'lec', '', 985),
(325, 4, 2, 2, 9, 'MATH 5', 'Probability & Statistics', 3, 3, 'lec', '', 176),
(326, 4, 2, 2, 9, 'HUMANITIES 1', 'Art, Man & Society', 3, 3, 'lec', '', 453),
(327, 4, 2, 2, 9, 'ENGLISH 4', 'Business English & Correspondence', 3, 3, 'lec', '', 714),
(328, 4, 2, 2, 10, 'PE 4', 'Team Sports', 2, 2, 'lec', '', 973),
(329, 1, 1, 1, 23, 'IT 1', 'IT Fundamentals', 3, 3, 'lec', '', 634),
(330, 1, 1, 1, 23, 'IT 2', 'Computer Programming 1', 3, 4, 'lec', '', 692),
(331, 1, 1, 1, 23, 'IT 2', 'Computer Programming 1', 1, 4, 'lab', '', 692),
(332, 1, 1, 1, 23, 'KB 1', 'Keyboarding 1', 3, 3, 'lab', '', 987),
(333, 1, 1, 1, 24, 'PE 1', 'Physical Fitness 1', 2, 2, 'lec', '', 139),
(334, 1, 1, 1, 24, 'NSTP 1', 'National Service Training Program 1', 3, 3, 'lec', '', 967),
(335, 4, 1, 1, 9, 'FILIPINO 1', 'Komunikasyon sa Akademikong Filipino', 3, 3, 'lec', '', 843),
(336, 1, 1, 1, 22, 'FILIPINO 1', 'Komunikasyon sa Akademikong Filipino', 3, 3, 'lec', '', 461),
(337, 1, 1, 2, 22, 'ENGLISH 2', 'Communications for IT', 3, 3, 'lec', '', 934),
(338, 1, 1, 2, 23, 'IT 3', 'Computer Programming 2', 3, 3, 'lec', '', 928),
(339, 1, 1, 2, 23, 'IT 4', 'Presentation Skills in IT', 3, 3, 'lec', '', 361),
(340, 1, 1, 2, 22, 'MATH 2', 'Trigonometry', 3, 3, 'lec', '', 275),
(341, 1, 1, 2, 25, 'IT 5', 'Fundamentals of Problem Solving', 3, 3, 'lec', '', 517),
(342, 1, 1, 2, 23, 'KB 2', 'Keyboarding 2', 3, 3, 'lab', '', 591),
(343, 1, 1, 2, 24, 'PE 2', 'Rhythmic Activities', 2, 2, 'lec', '', 456),
(344, 1, 1, 2, 24, 'NSTP 2', 'National Service Training Program 2', 3, 3, 'lec', '', 642),
(345, 1, 1, 2, 22, 'FILIPINO 2', 'Pagbasa at Pagsulat Tungo sa Pananaliksik', 3, 3, 'lec', '', 948),
(346, 1, 2, 3, 23, 'IT 4a', 'Quality Consiousness, Habits & Processes', 3, 3, 'lec', '', 163),
(347, 1, 2, 3, 22, 'Humanities 1', 'Philippine Literature', 3, 3, 'lec', '', 583),
(348, 1, 2, 1, 22, 'PHYSICS 1', 'Mechanics & Thermodynamics', 3, 3, 'lec', '', 528),
(349, 1, 2, 1, 25, 'IT 6', 'Computer & FIle Organization', 3, 3, 'lec', '', 968),
(350, 1, 2, 1, 25, 'IT 7', 'Object-Oriented Programming', 3, 4, 'lec', '', 437),
(351, 1, 2, 1, 25, 'IT 7', 'Object-Oriented Programming', 1, 4, 'lab', '', 437),
(352, 1, 2, 1, 23, 'IT 8', 'Operating System Applications', 2, 3, 'lec', '', 179),
(353, 1, 2, 1, 23, 'IT 8', 'Operating System Applications', 1, 3, 'lab', '', 179),
(354, 1, 2, 1, 22, 'MATH 3', 'Discrete Structures', 3, 3, 'lec', '', 984),
(355, 1, 2, 1, 22, 'ENGLISH 3', 'Speech & Oral Communication', 3, 3, 'lec', '', 834),
(356, 1, 2, 1, 22, 'SOC SCI 1', 'General Psychology with Drug Prevention', 3, 3, 'lec', '', 367),
(357, 1, 2, 1, 22, 'FILIPINO 3', 'Masining na Pagpapahayag', 3, 3, 'lec', '', 678),
(358, 1, 2, 1, 24, 'PE 3', 'Individual Sports', 1, 2, 'lec', '', 721),
(359, 1, 2, 1, 22, 'HUMANITIES 2', 'Art, Man & Society', 3, 3, 'lec', '', 185),
(360, 1, 2, 2, 22, 'PHYSICS 2', 'Electricity & Magnetism', 3, 3, 'lec', '', 647),
(361, 1, 2, 2, 26, 'IT-ELE 1', 'Data Comm. & Computer Networks', 3, 3, 'lec', '', 589),
(362, 1, 2, 2, 25, 'IT 9', 'Database Management System 1', 2, 3, 'lec', '', 756),
(363, 1, 2, 2, 25, 'IT 9', 'Database Management System 1', 1, 3, 'lab', '', 756),
(364, 1, 2, 2, 25, 'IT-ELE 2', 'Web Page Design & Development', 2, 3, 'lec', '', 279),
(365, 1, 2, 2, 25, 'IT-ELE 2', 'Web Page Design & Development', 1, 3, 'lab', '', 279),
(366, 1, 2, 2, 22, 'ITPRAC', 'ITPRAC', 3, 3, 'lec', '', 285),
(367, 1, 2, 2, 25, 'IT 10', 'System Analysis & Design', 3, 3, 'lec', '', 239),
(368, 1, 2, 2, 22, 'MATH 4', 'Probability and Statistics', 3, 3, 'lec', '', 428),
(369, 1, 2, 2, 22, 'SOC SCI 2', 'Professional Ethics with Values Formation', 3, 3, 'lec', '', 395),
(370, 1, 2, 2, 22, 'ENGLISH 4', 'Business English & Correspondence', 3, 3, 'lec', '', 173),
(371, 1, 2, 2, 24, 'PE 4', 'Team Sports', 2, 2, 'lec', '', 159);

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
(180, 207, 2, 206),
(181, 220, 1, 210),
(182, 221, 1, 213),
(183, 222, 1, 213),
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
(245, 307, 1, 296),
(246, 308, 1, 297),
(247, 309, 1, 298),
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
(263, 338, 1, 107),
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
(288, 371, 1, 358);

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
(53, 2, '2018-2019', 'active'),
(54, 1, '2018-2019', 'inactive'),
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
(108, 2, 'Phua', 'Wphua123', 'Wowhie', '', 'Phua', '1888-10-25', 'Male', 'Cogon Ormoc City', '0', 'wow@gmail.com', 'active', '2019-02-13 02:55:56'),
(109, 2, 'CoHat', 'Acohat123', 'Alexander', '', 'CoHat', '1888-09-24', 'Male', 'Ormoc City', '2147483647', 'alex@gmail.com', 'active', '2019-02-13 02:56:29'),
(110, 2, 'Quirino', 'Jquirino123', 'Jhay', '', 'Quirino', '1888-01-01', 'Male', 'Ormoc City', '2147483647', 'Q@gmail.com', 'active', '2019-02-13 02:56:43'),
(111, 2, 'Martinez', 'Mmartinez123', 'Martin', '', 'Martinez', '1888-01-01', 'Male', 'Ormoc City', '2147483647', 'mm@yahoo.com', 'active', '2019-02-13 02:56:55'),
(112, 2, 'Isip', 'Aisip123123', 'Apple', '', 'Isip', '1888-01-01', 'Female', 'Ormoc City', '2147483647', 'apple@gmail.com', 'active', '2019-02-13 05:50:39'),
(113, 2, 'Tarre', 'Ctarre123', 'Cheryl', '', 'Tarre', '1888-01-01', 'Female', 'Ormoc City', '2147483647', 'che@gmail.com', 'active', '2019-02-13 02:57:15'),
(114, 2, 'Lopez', 'Jlopez123', 'Jotham', '', 'Lopez', '1888-01-01', 'Male', 'Ormoc City', '2147483647', 'jot@gmail.com', 'active', '2019-02-13 02:57:23'),
(116, 2, 'temporary', 'temporary', '', '', '', '0000-00-00', '', '', '0', '', 'active', '2018-12-31 04:06:11'),
(117, 2, 'Gablino', 'Agablino123', 'Archiebald', '', 'Gablino', '1777-01-28', 'Male', 'Ormoc City', '0', 'Gablins@gmail.com', 'active', '2019-02-13 02:58:08'),
(119, 2, 'Leones', 'Nleones123', 'Nimfa', '', 'Leones', '1984-12-29', 'Female', '', '2147483647', 'aaka@gmail.com', 'active', '2019-02-13 02:58:16'),
(120, 4, 'Inclino', 'wInclino123', 'William Jay', 'Intales', 'Inclino', '0000-00-00', 'Male', '', '', 'nightfury102497@gmail.com', 'active', '2019-02-13 04:55:51'),
(121, 4, 'Banez', 'angel123', 'Angel Jean', 'Quinte', 'Banez', '0000-00-00', 'Female', '', '', 'banez@gmail.com', 'active', '2019-02-13 04:59:51'),
(122, 2, 'Pedro', 'Alexander123', 'Juan', '', 'Pedro', '1888-11-26', 'Male', 'Ormoc City', '9123482716', 'alex@gmail.com', 'active', '2019-02-13 05:04:56'),
(123, 4, '', '', 'Raffy', '', 'Pcala', '0000-00-00', 'Male', 'o', '9222222222', '', 'inactive', '2019-02-13 05:22:55'),
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
(143, 4, '', '', 'Arvin', 'Payod', 'Borja', '1996-11-18', 'Male', 'Jica Lao, Ormoc City, Leyte', '', '', 'inactive', '2019-02-16 06:50:12'),
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
(165, 4, '', '', 'JJ LOoraine', 'Erejer', 'Daga', '1999-03-25', 'Female', 'Calubi-an, Bilwang, Isabel, Leyte', '', '', 'inactive', '2019-02-16 07:30:39'),
(166, 4, '', '', 'Flaubert', 'Mangano', 'Gonzalez', '1998-02-03', 'Male', 'Libertad, Ormoc, City', '9091741045', '', 'inactive', '2019-02-16 07:33:18'),
(167, 4, '', '', 'Dan Clifford', 'Tiongson', 'Capuyan', '1998-12-23', 'Male', 'Sitio Lawis, Isabel, Leyte', '', '', 'inactive', '2019-02-16 07:34:39'),
(168, 4, '', '', 'Jheesheil', 'Labor', 'Marapoc', '1997-12-17', 'Female', 'Valencia, Ormoc City, Leyte', '', '', 'inactive', '2019-02-16 07:35:58'),
(169, 4, '', '', 'Michael Joseph', 'Fornes', 'Morilla', '1997-08-22', 'Male', 'Brgy. Tambulilid, Ormoc City, Leyte', '', '', 'inactive', '2019-02-16 07:38:04'),
(170, 4, '', '', 'Reyster', '', 'Lim', '1997-08-01', 'Male', 'Linao, Ormoc, City', '', '', 'inactive', '2019-02-16 07:39:04'),
(171, 4, '', '', 'Elmer Enrico', 'Suson', 'Mendoza', '1997-12-15', 'Male', 'Concepciom, Ormoc City', '', '', 'inactive', '2019-02-16 07:40:10'),
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
(236, 4, '', '', 'Angel Jean', 'Quinte', 'Banez', '1999-01-20', 'Female', 'Barriosite, Casilda, Merida, Leyte', '9484924908', '', 'inactive', '2019-02-20 00:26:20'),
(237, 4, '', '', 'Jayboy', 'P', 'Banzal', '1997-06-02', 'Male', 'Puertobello, Merida, Leyte', '', '', 'inactive', '2019-02-20 00:28:22'),
(238, 4, '', '', 'Angel', 'Abenio', 'Bestil', '1999-01-10', 'Female', 'Pob. Albuera, Leyte', '9075566126', '', 'inactive', '2019-02-20 00:29:52'),
(239, 4, '', '', 'Mayette', 'Hentica', 'Bulahan', '1999-05-09', 'Female', 'San Vicente, Ormoc City', '', '', 'inactive', '2019-02-20 00:31:01'),
(240, 4, '', '', 'Dave Vincent', 'S', 'Camasura', '1998-04-14', 'Male', 'Villa Theresa, Linao, Ormoc City', '9277736637', '', 'inactive', '2019-02-20 00:32:25'),
(241, 4, '', '', 'Julito', 'Asayas', 'Caquilala II', '1998-04-28', 'Male', 'Tambulilid, Ormoc City', '', '', 'inactive', '2019-02-20 00:33:39'),
(242, 4, '', '', 'Omar', 'Ruiz', 'Cayambulan', '1999-07-02', 'Male', 'San Isidro, Leyte', '', '', 'inactive', '2019-02-20 00:35:14'),
(243, 4, '', '', 'Keen Gerald', 'Estoy', 'Cormanes', '1995-01-23', 'Male', 'Can-adieng, Ormoc City', '', '', 'inactive', '2019-02-20 00:36:33'),
(244, 4, '', '', 'Joseph Ken', '', 'Estrera', '1998-11-30', 'Male', 'Altavista, Ormoc City', '', '', 'inactive', '2019-02-20 00:37:53'),
(245, 4, '', '', 'William Jay', 'Intales', 'Inclino', '1997-10-24', 'Male', 'Biasong, Puertobello, Merida, Leyte', '9106024370', '', 'inactive', '2019-02-20 00:39:17'),
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
(257, 4, '', '', 'Mitzi', 'Dayandayan', 'Yap', '1998-12-21', 'Female', 'Honan, Isabel, Leyte', '', '', 'inactive', '2019-02-20 00:56:57');

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
  MODIFY `classID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `counter`
--
ALTER TABLE `counter`
  MODIFY `countID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  MODIFY `facID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `fac_spec`
--
ALTER TABLE `fac_spec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `feeID` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prospectus`
--
ALTER TABLE `prospectus`
  MODIFY `prosID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `regID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reg_guardian`
--
ALTER TABLE `reg_guardian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `staffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `studclass`
--
ALTER TABLE `studclass`
  MODIFY `scID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `studgrade`
--
ALTER TABLE `studgrade`
  MODIFY `sgID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studprospectus`
--
ALTER TABLE `studprospectus`
  MODIFY `spID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `studrec_per_term`
--
ALTER TABLE `studrec_per_term`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stud_fee`
--
ALTER TABLE `stud_fee`
  MODIFY `sfID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=372;

--
-- AUTO_INCREMENT for table `subject_req`
--
ALTER TABLE `subject_req`
  MODIFY `subReqID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=289;

--
-- AUTO_INCREMENT for table `term`
--
ALTER TABLE `term`
  MODIFY `termID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=258;

--
-- AUTO_INCREMENT for table `year`
--
ALTER TABLE `year`
  MODIFY `yearID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `year_req`
--
ALTER TABLE `year_req`
  MODIFY `yrID` int(11) NOT NULL AUTO_INCREMENT;

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
