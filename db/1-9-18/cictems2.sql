-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2019 at 04:51 AM
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
(1, 47, 2);

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
(1, 54, 3, 25, 36, 25, 1, 'ENG111', '07:30:00', '08:30:00', 0, 'unlocked', '2019-01-08 02:35:58'),
(2, 54, 4, 29, 36, 25, 1, 'MAT112', '08:30:00', '09:30:00', 0, 'unlocked', '2019-01-08 02:35:58'),
(3, 54, 5, 33, 31, 25, 2, 'Physics111', '09:30:00', '11:00:00', 0, 'unlocked', '2019-01-09 03:05:26'),
(4, 54, 6, 33, 31, 25, 2, 'Physics111', '11:00:00', '11:30:00', 0, 'unlocked', '2019-01-09 03:05:26'),
(5, 54, 7, 25, 36, 25, 1, 'MAT113', '13:00:00', '14:00:00', 0, 'unlocked', '2019-01-08 02:35:58'),
(6, 54, 8, 34, 30, 25, 1, 'Psych111', '14:00:00', '15:00:00', 0, 'unlocked', '2019-01-09 03:05:26'),
(7, 54, 9, 31, 29, 25, 2, 'IT-Com111', '15:00:00', '16:00:00', 0, 'locked', '2019-01-09 03:08:06'),
(8, 54, 10, 31, 29, 25, 2, 'IT-Com111', '16:00:00', '16:30:00', 0, 'locked', '2019-01-09 03:08:06'),
(9, 54, 11, 35, 29, 25, 2, 'IT-Prog111', '16:30:00', '17:30:00', 0, 'locked', '2019-01-09 03:09:01'),
(10, 54, 12, 35, 29, 25, 2, 'IT-Prog111', '17:30:00', '18:00:00', 0, 'locked', '2019-01-09 03:09:01'),
(11, 54, 13, 34, 30, 25, 1, 'NSTP111', '18:00:00', '19:00:00', 0, 'unlocked', '2019-01-08 02:35:58'),
(12, 54, 14, 34, 30, 25, 2, 'PE111', '07:30:00', '08:30:00', 0, 'unlocked', '2019-01-08 02:35:58');

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
(10, 'enrol_studs', 53, 2),
(11, 'enrol_studs', 54, 4),
(12, 'enrol_studs', 55, 0),
(13, 'fees', 54, 5);

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
(1, 'term', 3),
(2, 'room', 10),
(3, 'course', 4),
(4, 'prospectus', 7),
(5, 'section', 34),
(6, 'faculty', 9),
(7, 'subject', 64),
(8, 'student', 32),
(9, 'staff', 2),
(10, 'reg_requests', 2),
(11, 'reg_users', 13),
(12, 'day', 2),
(13, 'active_students', 7),
(14, 'guardian', 0),
(15, 'enrol_requests', 4),
(16, 'specialization', 7),
(17, 'payment_logs', 3);

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
(2, 'TTH', 2);

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
  `uID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`facID`, `uID`) VALUES
(28, 106),
(29, 107),
(30, 108),
(31, 109),
(32, 110),
(33, 111),
(34, 112),
(35, 113),
(36, 114),
(0, 116);

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
(29, 31, 9),
(30, 29, 6),
(31, 29, 8),
(32, 29, 7),
(36, 30, 9),
(37, 30, 10),
(38, 32, 6),
(39, 32, 7),
(40, 33, 6),
(41, 33, 8),
(42, 33, 7),
(43, 34, 6),
(44, 35, 7),
(45, 36, 9),
(46, 28, 6),
(47, 28, 7),
(48, 28, 8);

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
(1, 54, 'Christmas Party 2018', 'All ICTE Students', '500.00', 'December 15, 2018', 'ongoing'),
(2, 54, 'Foundation Days 2019', 'All ICTE Students', '750.00', 'January 25, 2019', 'ongoing');

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
  `prosDesc` varchar(20) NOT NULL,
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
(6, 374, 4, 'BSIT 2018-2019', '', '2018-2019 (K+12 Compliant)', 'New'),
(7, 376, 4, 'BSCS 2018-2019', '', '2018-2019', 'New'),
(8, 377, 4, 'BSCpE 2018-2019', '', '2018-2019', 'New');

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
(0, '', '', 0, 'active'),
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
(1, 25, 9),
(2, 26, 6),
(3, 26, 9),
(13, 29, 9),
(14, 30, 6),
(15, 30, 8),
(16, 31, 8),
(17, 31, 7),
(18, 32, 8),
(19, 32, 7),
(20, 33, 6),
(21, 33, 8),
(22, 33, 9),
(23, 33, 7),
(24, 34, 10),
(25, 34, 9),
(26, 35, 9),
(27, 35, 8),
(28, 35, 10),
(29, 36, 7),
(30, 36, 8),
(31, 36, 6);

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
(59, 377, 1, 1, 'BSCPE-1102');

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
  `specDesc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specialization`
--

INSERT INTO `specialization` (`specID`, `specDesc`) VALUES
(6, 'Common IT Courses'),
(7, 'Professional IT Courses (Including Accounting)'),
(8, 'IT Electives/Free Electives'),
(9, 'General Education Courses (Including Filipino)'),
(10, 'Other Courses (PE and NSTP)');

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
(1, 1, 43, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:05:57'),
(2, 2, 43, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:05:57'),
(3, 5, 43, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:05:57'),
(4, 6, 43, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:05:57'),
(5, 11, 43, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:05:57'),
(6, 3, 43, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:05:57'),
(7, 4, 43, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:05:57'),
(8, 7, 43, '100.00', '100.00', '100.00', '100.00', '100', 'Passed', '', 'Enrolled', '2019-01-09 11:05:57'),
(9, 8, 43, '100.00', '100.00', '100.00', '100.00', '100', 'Passed', '', 'Enrolled', '2019-01-09 11:05:57'),
(10, 9, 43, '100.00', '100.00', '100.00', '100.00', '100', 'Passed', '', 'Enrolled', '2019-01-09 11:05:57'),
(11, 10, 43, '100.00', '100.00', '100.00', '100.00', '100', 'Passed', '', 'Enrolled', '2019-01-09 11:05:57'),
(12, 12, 43, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:05:57'),
(13, 1, 67, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:06:08'),
(14, 2, 67, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:06:08'),
(15, 5, 67, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:06:08'),
(16, 6, 67, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:06:08'),
(17, 11, 67, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:06:08'),
(18, 3, 67, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:06:08'),
(19, 4, 67, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:06:08'),
(20, 7, 67, '74.00', '74.00', '71.00', '71.00', '72.2', 'Failed', '', 'Enrolled', '2019-01-09 11:06:08'),
(21, 8, 67, '74.00', '74.00', '71.00', '71.00', '72.2', 'Failed', '', 'Enrolled', '2019-01-09 11:06:08'),
(22, 9, 67, '100.00', '100.00', '100.00', '88.00', '95.2', 'Passed', '', 'Enrolled', '2019-01-09 11:06:08'),
(23, 10, 67, '100.00', '100.00', '100.00', '88.00', '95.2', 'Passed', '', 'Enrolled', '2019-01-09 11:06:08'),
(24, 12, 67, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:06:08'),
(25, 1, 49, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:06:21'),
(26, 2, 49, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:06:21'),
(27, 5, 49, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:06:21'),
(28, 6, 49, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:06:21'),
(29, 11, 49, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:06:21'),
(30, 3, 49, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:06:21'),
(31, 4, 49, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:06:21'),
(32, 7, 49, '70.00', '70.00', '70.00', '70.00', '70', 'Failed', '', 'Enrolled', '2019-01-09 11:06:21'),
(33, 8, 49, '70.00', '70.00', '70.00', '70.00', '70', 'Failed', '', 'Enrolled', '2019-01-09 11:06:21'),
(34, 9, 49, '100.00', '100.00', '100.00', '100.00', '100', 'Passed', '', 'Enrolled', '2019-01-09 11:06:21'),
(35, 10, 49, '100.00', '100.00', '100.00', '100.00', '100', 'Passed', '', 'Enrolled', '2019-01-09 11:06:21'),
(36, 12, 49, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:06:21'),
(37, 1, 68, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:06:34'),
(38, 2, 68, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:06:34'),
(39, 5, 68, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:06:34'),
(40, 6, 68, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:06:34'),
(41, 11, 68, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:06:34'),
(42, 3, 68, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:06:34'),
(43, 4, 68, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:06:34'),
(44, 7, 68, 'Dropped', '', '', '', '50', 'Dropped', '', 'Enrolled', '2019-01-09 11:06:34'),
(45, 8, 68, 'Dropped', '', '', '', '50', 'Dropped', '', 'Enrolled', '2019-01-09 11:06:34'),
(46, 9, 68, '100.00', '100.00', '100.00', '100.00', '100', 'Passed', '', 'Enrolled', '2019-01-09 11:06:34'),
(47, 10, 68, '100.00', '100.00', '100.00', '100.00', '100', 'Passed', '', 'Enrolled', '2019-01-09 11:06:34'),
(48, 12, 68, '', '', '', '', '', '', '', 'Enrolled', '2019-01-09 11:06:34');

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
(57, 1, 67, 688, 'no'),
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
(74, 1, 115, 1928, 'yes');

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
(1, 43, 9, 107, 54, '1.0', 'Passed', 'Class', '2019-01-09 11:08:05'),
(2, 43, 10, 107, 54, '1.0', 'Passed', 'Class', '2019-01-09 11:08:05'),
(3, 67, 9, 107, 54, '5.0', 'Failed', 'Class', '2019-01-09 11:08:05'),
(4, 67, 10, 107, 54, '5.0', 'Failed', 'Class', '2019-01-09 11:08:05'),
(5, 49, 9, 107, 54, '5.0', 'Failed', 'Class', '2019-01-09 11:08:05'),
(6, 49, 10, 107, 54, '5.0', 'Failed', 'Class', '2019-01-09 11:08:05'),
(7, 68, 9, 107, 54, '5.0', 'Dropped', 'Class', '2019-01-09 11:08:05'),
(8, 68, 10, 107, 54, '5.0', 'Dropped', 'Class', '2019-01-09 11:08:06'),
(9, 43, 11, 107, 54, '1.0', 'Passed', 'Class', '2019-01-09 11:09:01'),
(10, 43, 12, 107, 54, '1.0', 'Passed', 'Class', '2019-01-09 11:09:01'),
(11, 67, 11, 107, 54, '1.4', 'Passed', 'Class', '2019-01-09 11:09:01'),
(12, 67, 12, 107, 54, '1.4', 'Passed', 'Class', '2019-01-09 11:09:01'),
(13, 49, 11, 107, 54, '1.0', 'Passed', 'Class', '2019-01-09 11:09:01'),
(14, 49, 12, 107, 54, '1.0', 'Passed', 'Class', '2019-01-09 11:09:01'),
(15, 68, 11, 107, 54, '1.0', 'Passed', 'Class', '2019-01-09 11:09:01'),
(16, 68, 12, 107, 54, '1.0', 'Passed', 'Class', '2019-01-09 11:09:01');

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
(67, 69, 3),
(68, 70, 3),
(69, 71, 3),
(70, 72, 3),
(71, 73, 3),
(72, 74, 7);

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
(1, 43, 1, '500.00', '0.00'),
(2, 49, 1, '500.00', '0.00'),
(3, 67, 1, '500.00', '0.00'),
(4, 68, 1, '500.00', '0.00'),
(5, 43, 2, '750.00', '0.00'),
(6, 49, 2, '750.00', '0.00'),
(7, 67, 2, '750.00', '0.00'),
(8, 68, 2, '750.00', '0.00');

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
  `type` enum('lec','lab') NOT NULL,
  `nonSub_pre` varchar(15) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subID`, `prosID`, `yearID`, `semID`, `specID`, `subCode`, `subDesc`, `units`, `type`, `nonSub_pre`, `id`) VALUES
(3, 6, 1, 1, 9, 'ENG111', 'Purposive Communication', 3, 'lec', '', 182),
(4, 6, 1, 1, 9, 'MAT112', 'Remedial Mathematics (Pre-Calculus)', 3, 'lec', 'for non-STEM', 597),
(5, 6, 1, 1, 9, 'Physics111', 'General Physics', 3, 'lec', 'for non-STEM', 962),
(6, 6, 1, 1, 9, 'Physics111', 'General Physics', 1, 'lab', 'for non-STEM', 962),
(7, 6, 1, 1, 9, 'MAT113', 'Mathematics in the Modern World', 3, 'lec', '', 596),
(8, 6, 1, 1, 9, 'Psych111', 'Understanding the self', 3, 'lec', '', 945),
(9, 6, 1, 1, 8, 'IT-Com111', 'Introduction to Computing', 2, 'lec', '', 489),
(10, 6, 1, 1, 8, 'IT-Com111', 'Introduction to Computing', 1, 'lab', '', 489),
(11, 6, 1, 1, 8, 'IT-Prog111', 'Fundamentals of Programming', 2, 'lec', '', 412),
(12, 6, 1, 1, 8, 'IT-Prog111', 'Fundamentals of Programming', 1, 'lab', '', 412),
(13, 6, 1, 1, 10, 'NSTP111', 'National Service Training Prog1', 3, 'lec', '', 396),
(14, 6, 1, 1, 10, 'PE111', 'Physical Fitness 1', 2, 'lec', '', 957),
(15, 6, 1, 2, 9, 'MAT121', 'Discrete Structures', 3, 'lec', '', 431),
(16, 6, 1, 2, 9, 'STS121', 'Service, Technology and Society', 3, 'lec', '', 764),
(17, 6, 1, 2, 9, 'SOCIO121', 'Social Issues and Professional Practice', 3, 'lec', '', 485),
(18, 6, 1, 2, 6, 'IT-Prog121', 'Computer Programming 2', 2, 'lec', '', 142),
(19, 6, 1, 2, 6, 'IT-Prog121', 'Computer Programming 2', 1, 'lab', '', 142),
(20, 6, 1, 2, 6, 'IT-HC', 'Introduction to Human Computer Interaction', 2, 'lec', '', 479),
(21, 6, 1, 2, 6, 'IT-HC', 'Introduction to Human Computer Interaction', 1, 'lab', '', 479),
(22, 6, 1, 2, 6, 'IT-DIGILog121', 'Digital Logic Design', 3, 'lec', '', 493),
(23, 6, 1, 2, 9, 'Hist121', 'Readings in Philippine History', 3, 'lec', '', 852),
(24, 6, 1, 2, 10, 'NSTP121', 'National Service Training Program 2', 3, 'lec', '', 356),
(25, 6, 1, 2, 10, 'PE121', 'Rythmic Activities', 2, 'lec', '', 562),
(26, 7, 1, 1, 9, 'Physics111', 'General Physics', 3, 'lec', '', 572),
(27, 7, 1, 1, 9, 'Physics111', 'General Physics', 1, 'lab', '', 572),
(33, 7, 2, 2, 8, 'subject comsci', 'Description for comsci', 2, 'lec', '', 352),
(34, 7, 2, 2, 8, 'subject comsci', 'Description for comsci', 1, 'lab', '', 352),
(35, 7, 2, 2, 9, 'another comsci', 'subject for comsci', 3, 'lec', '', 389),
(36, 8, 1, 1, 9, 'ENG111', 'Purposive Communication', 3, 'lec', '', 196),
(37, 8, 1, 1, 9, 'MAT112', 'Remedial Mathematics (Pre-Calculus)', 3, 'lec', 'for non-STEM', 837),
(38, 8, 1, 1, 9, 'Physics111', 'General Physics', 3, 'lec', 'for non-STEM', 671),
(39, 8, 1, 1, 9, 'Physics111', 'General Physics', 1, 'lab', 'for non-STEM', 671),
(40, 8, 1, 1, 9, 'MAT113', 'Mathematics in the Modern World', 3, 'lec', '', 942),
(41, 8, 1, 1, 9, 'Psych111', 'Understanding the Self', 3, 'lec', '', 652),
(42, 8, 1, 1, 6, 'CpE-CompDS111', 'Computer Engineering as a Discipline', 3, 'lec', '', 743),
(43, 8, 1, 1, 7, 'CpE-ProgLo112', 'Programming Logic and Design', 2, 'lec', '', 721),
(44, 8, 1, 1, 7, 'CpE-ProgLo112', 'Programming Logic and Design', 1, 'lab', '', 721),
(45, 8, 1, 1, 9, 'Chem111', 'Chemistry for Engineers', 2, 'lec', '', 951),
(46, 8, 1, 1, 9, 'Chem111', 'Chemistry for Engineers', 1, 'lab', '', 951),
(47, 8, 1, 1, 10, 'NSTP111', 'National Service Training Prog1', 3, 'lec', '', 269),
(48, 8, 1, 1, 10, 'PE111', 'Physical Fitness 1', 2, 'lec', '', 419),
(49, 8, 2, 3, 7, 'CpE-Datstruct201', 'Data Structures and Algorithm Analysis', 3, 'lec', '', 589),
(50, 8, 2, 3, 7, 'CpE-Datstruct201', 'Data Structures and Algorithm Analysis', 1, 'lab', '', 589),
(51, 8, 2, 3, 7, 'MAT201', 'Engineering Data Analysis', 3, 'lec', '', 421),
(52, 8, 1, 2, 9, 'MAT121', 'Discrete Mathematics', 3, 'lec', '', 614),
(53, 8, 1, 2, 9, 'STS121', 'Science, Technology & Society', 3, 'lec', '', 875),
(54, 8, 1, 2, 8, 'Draft121', 'Technical Drafting', 2, 'lec', '', 312),
(55, 8, 1, 2, 8, 'Draft121', 'Technical Drafting', 1, 'lab', '', 312),
(56, 8, 1, 2, 8, 'Opt121', 'Productivity Tools 1', 2, 'lec', '', 432),
(57, 8, 1, 2, 8, 'Opt121', 'Productivity Tools 1', 1, 'lab', '', 432),
(58, 8, 1, 2, 6, 'Cpe-Eco121', 'Engineering Economics', 3, 'lec', '', 381),
(59, 8, 1, 2, 9, 'Physics121', 'Physics for Engineers', 3, 'lec', '', 274),
(60, 8, 1, 2, 9, 'Physics121', 'Physics for Engineers', 1, 'lab', '', 274),
(61, 8, 1, 2, 9, 'Hist121', 'Readings in Philippine History', 3, 'lec', '', 683),
(62, 8, 1, 2, 10, 'NSTP121', 'National Service Training Prog2', 3, 'lec', '', 176),
(63, 8, 1, 2, 9, 'MAT122', 'Calculus 1', 3, 'lec', '', 947),
(64, 8, 1, 2, 10, 'PE121', 'Rhythmic Activities', 2, 'lec', '', 682),
(65, 8, 1, 2, 8, 'Cpe-HDL121', 'Introduction to HDL', 2, 'lec', '', 486),
(66, 8, 1, 2, 8, 'Cpe-HDL121', 'Introduction to HDL', 1, 'lab', '', 486),
(67, 8, 2, 3, 8, 'OPT201', 'Productivity Tools 2', 2, 'lec', '', 271),
(68, 8, 2, 3, 8, 'OPT201', 'Productivity Tools 2', 1, 'lab', '', 271),
(69, 4, 1, 1, 9, '*English 01', 'English Plus', 3, 'lec', '', 357),
(70, 4, 1, 1, 9, 'ENGLISH 1', 'Communication Arts 1', 3, 'lec', '', 214),
(71, 4, 1, 1, 9, 'MATH 1', 'College Algebra', 3, 'lec', '', 782),
(72, 4, 1, 1, 6, 'CS 1', 'CS Fundamentals', 3, 'lec', '', 534),
(73, 4, 1, 1, 7, 'CS 2', 'Computer Programming 1', 3, 'lec', '', 634),
(74, 4, 1, 1, 7, 'CS 2', 'Computer Programming 1', 1, 'lab', '', 634),
(76, 4, 1, 1, 6, 'KB 1', 'Keyboarding 1', 3, 'lab', '', 348),
(77, 4, 1, 1, 10, 'PE 1', 'Physical Fitness 1', 2, 'lec', '', 916),
(78, 4, 1, 1, 10, 'NSTP 1', 'National Service Training Program 1', 3, 'lec', '', 163),
(79, 4, 1, 1, 7, 'ACCOUNTING1', 'Accounting Principles', 3, 'lec', '', 513),
(80, 1, 1, 1, 9, '*ENGLISH 01', 'English Plus', 3, 'lec', '', 427),
(81, 1, 1, 1, 9, 'ENGLISH 1', 'Communication Arts 1', 3, 'lec', '', 316),
(82, 1, 1, 1, 9, 'MATH 1', 'College Algebra', 3, 'lec', '', 925),
(83, 1, 1, 1, 6, 'IT1', 'IT Fundamentals', 3, 'lec', '', 982),
(84, 1, 1, 1, 7, 'IT 2', 'Computer Programming 1', 3, 'lec', '', 987),
(85, 1, 1, 1, 7, 'IT 2', 'Computer Programming 1', 1, 'lab', '', 987),
(86, 1, 1, 1, 6, 'KB 1', 'Keyboarding 1', 3, 'lab', '', 291),
(87, 1, 1, 1, 10, 'PE 1', 'Physical Fitness 1', 2, 'lec', '', 579),
(88, 1, 1, 1, 10, 'NSTP 1', 'National Service Training Program 1', 3, 'lec', '', 471),
(89, 1, 1, 1, 9, 'FILIPINO 1', 'Komunikasyon sa Akademikong Filipino', 3, 'lec', '', 913);

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
(1, 15, 1, 7),
(2, 18, 1, 11),
(3, 19, 1, 11),
(4, 20, 1, 9),
(5, 21, 1, 9),
(6, 22, 1, 9),
(7, 24, 1, 13),
(8, 25, 1, 14),
(12, 52, 1, 40),
(13, 59, 1, 38),
(14, 60, 1, 38),
(15, 62, 1, 47),
(16, 63, 1, 37),
(17, 64, 1, 48),
(18, 49, 1, 52),
(19, 50, 1, 52),
(20, 51, 1, 63),
(21, 67, 1, 56),
(22, 68, 1, 56),
(23, 70, 2, 69),
(24, 81, 2, 80);

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
(55, 3, '2018-2019', 'inactive');

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
(43, 4, 'Inclino', 'Iamwilliam1', 'William Jay', 'Intales', 'Inclino', '1997-10-24', 'Male', 'Puertobello', '0921212121', '', 'active', 'yes', '2018-12-08 04:58:04'),
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
(67, 4, '', '', 'Mercy Jane', '', 'Lapinid', '0000-00-00', 'Female', '', '', '', 'inactive', 'yes', '2018-11-14 02:14:52'),
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
(106, 2, 'Bernardo', 'Bernards1', 'Mark', '', 'Bernardo', '1992-10-30', 'Male', 'Ormoc City', '', 'mark@gmail.com', 'active', 'no', '2019-01-07 12:22:17'),
(107, 2, 'Cantero', 'Iamjojo1', 'Joscoro', '', 'Cantero', '1888-11-30', 'Male', 'Sanjuan', '', 'jojo@gmail.com', 'active', 'no', '2018-12-01 00:01:41'),
(108, 2, 'Phua', 'Iamwowhie1', 'Wowhie', '', 'Phua', '1888-10-25', 'Male', 'Cogon Ormoc City', '', 'wow@gmail.com', 'active', 'no', '2018-12-01 07:39:46'),
(109, 2, 'CoHat', 'Iamalex1', 'Alexander', '', 'CoHat', '1888-09-24', 'Male', 'Ormoc City', '09876173627', 'alex@gmail.com', 'active', 'no', '2018-12-08 05:54:46'),
(110, 2, 'Quirino', 'Iamquirino1', 'Jhay', '', 'Quirino', '1888-01-01', 'Male', 'Ormoc City', '09121212143', 'Q@gmail.com', 'active', 'no', '2018-12-08 05:57:03'),
(111, 2, 'Martinez', 'Iammartin1', 'Martin', '', 'Martinez', '1888-01-01', 'Male', 'Ormoc City', '09785745745', 'mm@yahoo.com', 'active', 'no', '2018-12-08 05:57:21'),
(112, 2, 'Isip', 'Iamapple1', 'Apple', '', 'Isip', '1888-01-01', 'Female', 'Ormoc City', '09758458454', 'apple@gmail.com', 'active', 'no', '2018-12-08 05:57:38'),
(113, 2, 'Tarre', 'Iamtarre1', 'Cheryl', '', 'Tarre', '1888-01-01', 'Female', 'Ormoc City', '09847237273', 'che@gmail.com', 'active', 'no', '2018-12-08 05:57:57'),
(114, 2, 'Lopez', 'Iamlopez1', 'Jotham', '', 'Lopez', '1888-01-01', 'Male', 'Ormoc City', '09323232323', 'jot@gmail.com', 'active', 'no', '2018-12-08 05:58:14'),
(115, 4, 'Sample', 'Iamsample1', 'Sample', '', 'Sample', '1997-10-24', 'Male', 'Ormoc city', '09121212717', 'sample@gmail.com', 'active', 'yes', '2018-12-13 03:29:09'),
(116, 2, 'temporary', 'temporary', '', '', '', '0000-00-00', '', '', '', '', 'active', 'no', '2018-12-31 04:06:11');

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
  ADD PRIMARY KEY (`specID`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `classID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `counter`
--
ALTER TABLE `counter`
  MODIFY `countID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `dayID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enrolment_settings`
--
ALTER TABLE `enrolment_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `facID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `fac_spec`
--
ALTER TABLE `fac_spec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `secID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `specialization`
--
ALTER TABLE `specialization`
  MODIFY `specID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `studclass`
--
ALTER TABLE `studclass`
  MODIFY `scID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `studgrade`
--
ALTER TABLE `studgrade`
  MODIFY `sgID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `studprospectus`
--
ALTER TABLE `studprospectus`
  MODIFY `spID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `stud_fee`
--
ALTER TABLE `stud_fee`
  MODIFY `sfID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `subject_req`
--
ALTER TABLE `subject_req`
  MODIFY `subReqID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `term`
--
ALTER TABLE `term`
  MODIFY `termID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

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
