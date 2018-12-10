-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2018 at 02:27 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

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
  `status` enum('unlocked','locked') NOT NULL,
  `date_submitted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`classID`, `termID`, `subID`, `roomID`, `facID`, `secID`, `dayID`, `classCode`, `timeIn`, `timeOut`, `status`, `date_submitted`) VALUES
(1, 24, 60, 12, 28, 39, 2, 'IT 18', '09:30:00', '11:00:00', 'unlocked', '2018-11-27 05:31:16');

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
(6, 'fees', 24, 9),
(7, 'enrol_studs', 24, 7),
(8, 'enrol_studs', 45, 0);

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
(1, 'term', 8),
(2, 'room', 8),
(3, 'course', 4),
(4, 'prospectus', 4),
(5, 'section', 24),
(6, 'faculty', 3),
(7, 'subject', 66),
(8, 'student', 31),
(9, 'staff', 2),
(10, 'reg_requests', 0),
(11, 'reg_users', 9),
(12, 'day', 3),
(13, 'active_students', 3),
(14, 'guardian', 0),
(15, 'enrol_requests', 0),
(16, 'specialization', 7),
(17, 'payment_logs', 16);

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
(1, 'MWF', 3),
(2, 'TTH', 2),
(3, 'Saturday', 1);

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
(2, 'status', 'inactive');

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
(29, 107);

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
(22, 28, 9),
(23, 28, 7),
(24, 29, 6),
(25, 29, 8);

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
  `dueDate` date NOT NULL,
  `feeStatus` enum('ongoing','done','cancelled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`feeID`, `termID`, `feeName`, `feeDesc`, `amount`, `dueDate`, `feeStatus`) VALUES
(12, 24, 'Christmas Party', 'All CICTE students', '1000.00', '2018-12-10', 'cancelled'),
(13, 24, 'Graduation 2k19', 'All Graduating students', '5000.00', '2019-03-15', 'cancelled'),
(14, 24, 'x', 'x', '2500.00', '2018-12-28', 'ongoing'),
(15, 24, 'sample', 'desc sample', '700.00', '2018-01-31', 'cancelled');

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
(34, '21.5', 'reports_payment_logs');

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
  `action` enum('collect','refund') NOT NULL,
  `or_number` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `studID`, `uID`, `feeID`, `paidDate`, `amount`, `action`, `or_number`) VALUES
(3, 43, 1, 12, '2018-11-06 01:18:14', '1000.00', 'collect', '0002'),
(4, 53, 1, 12, '2018-11-06 01:18:32', '500.00', 'collect', '0001'),
(5, 53, 1, 12, '2018-11-09 01:19:17', '500.00', 'collect', '0003'),
(6, 46, 1, 12, '2018-11-14 01:29:19', '1000.00', 'collect', '0004'),
(7, 43, 1, 13, '2018-11-26 01:52:32', '5000.00', 'collect', '0007'),
(8, 61, 1, 12, '2018-11-26 02:53:23', '1000.00', 'collect', '0009'),
(9, 50, 1, 12, '2018-11-26 03:01:00', '350.00', 'collect', '00099'),
(10, 50, 1, 14, '2018-11-26 03:01:13', '2500.00', 'collect', '123'),
(11, 50, 1, 12, '2018-11-26 03:01:53', '350.00', 'refund', '0123'),
(12, 43, 1, 12, '2018-11-26 03:02:57', '1000.00', 'refund', '098'),
(13, 61, 1, 15, '2018-11-27 05:46:39', '700.00', 'collect', '78'),
(14, 61, 1, 15, '2018-11-27 05:49:21', '700.00', 'refund', '78'),
(15, 61, 1, 12, '2018-11-27 05:50:14', '1000.00', 'refund', '0008'),
(16, 46, 1, 14, '2018-11-27 06:21:32', '2000.00', 'collect', '43'),
(17, 43, 1, 14, '2018-11-27 23:53:37', '1000.00', 'collect', '1'),
(18, 43, 1, 13, '2018-11-27 23:55:35', '5000.00', 'refund', '');

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
  `effectivity` varchar(15) NOT NULL,
  `prosType` enum('New','Old') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prospectus`
--

INSERT INTO `prospectus` (`prosID`, `courseID`, `duration`, `prosCode`, `prosDesc`, `effectivity`, `prosType`) VALUES
(1, 132, 2, 'ACT 2012-2013', '', '2012-2013', 'New'),
(3, 374, 4, 'BSIT 2011-2012', '', '2011-2012', 'New'),
(4, 376, 4, 'BSCS 2014-2015', '', '2014-2015', 'New'),
(5, 377, 5, 'BSCPE 2014-2015', '', '2014-2015', 'New');

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
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomID`, `roomName`, `roomLoc`, `capacity`) VALUES
(7, 'Lab1', '3rd Floor', 30),
(8, 'Trainers lab', '2nd floor', 35),
(10, 'Lab2', '4th floor', 30),
(11, 'Lab3', '4th floor', 30),
(12, 'Physics room', '3rd floor', 30),
(13, 'Chemistry room', '3rd floor', 30),
(14, 'English room', '3rd floor', 30),
(15, 'ENGdra', '3rd floor', 30);

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
(48, 132, 2, 2, 'ACT-2202');

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
  `specDesc` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specialization`
--

INSERT INTO `specialization` (`specID`, `specDesc`) VALUES
(6, 'Filipino'),
(7, 'English'),
(8, 'Information Technology'),
(9, 'Arts and Humanities'),
(10, 'Mathematics'),
(11, 'Science'),
(13, 'Business');

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
(1, 1, 43, 'INC', '', '', '', '', '', '', 'Enrolled', '2018-11-15 19:46:15'),
(2, 1, 57, '80.00', '80.00', '100.00', '100.00', '92', 'Passed', '', 'Enrolled', '2018-11-15 19:46:53'),
(3, 1, 46, '100.00', '100.00', '100.00', '60.00', '84', 'Passed', '', 'Enrolled', '2018-11-15 19:47:01'),
(4, 1, 61, '', '', '', '', '', '', '', 'Enrolled', '2018-11-15 19:47:21'),
(5, 1, 62, '', '', '', '', '', '', '', 'Enrolled', '2018-11-15 19:47:31'),
(6, 1, 50, '', '', '', '', '', '', '', 'Enrolled', '2018-11-15 19:47:41'),
(7, 1, 53, '', '', '', '', '', '', '', 'Enrolled', '2018-11-15 19:47:52');

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
(43, 4, 43, 616, 'yes'),
(44, 4, 46, 622, 'yes'),
(45, 4, 48, 617, 'no'),
(46, 1, 49, 622, 'no'),
(48, 1, 58, 733, 'no'),
(49, 1, 59, 788, 'no'),
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
(73, 4, 89, 109, 'no');

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
(12, 12, 3),
(41, 43, 3),
(42, 44, 3),
(43, 45, 3),
(44, 46, 3),
(46, 48, 3),
(47, 49, 3),
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
(65, 67, 3),
(66, 68, 3),
(67, 69, 3),
(68, 70, 3),
(69, 71, 3),
(70, 72, 3),
(71, 73, 3);

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
(64, 57, 12, '0.00', '0.00'),
(65, 43, 12, '0.00', '0.00'),
(66, 46, 12, '0.00', '1000.00'),
(67, 50, 12, '0.00', '0.00'),
(68, 53, 12, '0.00', '1000.00'),
(69, 61, 12, '0.00', '0.00'),
(70, 62, 12, '0.00', '0.00'),
(71, 43, 13, '0.00', '0.00'),
(72, 43, 14, '1500.00', '0.00'),
(73, 46, 14, '500.00', '0.00'),
(74, 50, 14, '0.00', '0.00'),
(76, 57, 15, '0.00', '0.00'),
(77, 61, 15, '0.00', '0.00'),
(82, 43, 15, '0.00', '0.00'),
(83, 57, 14, '2500.00', '0.00'),
(84, 53, 14, '2500.00', '0.00'),
(85, 61, 14, '2500.00', '0.00'),
(86, 62, 14, '2500.00', '0.00');

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
  `lec` int(11) NOT NULL,
  `lab` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subID`, `prosID`, `yearID`, `semID`, `specID`, `subCode`, `subDesc`, `lec`, `lab`) VALUES
(4, 3, 1, 1, 8, '*ENGLISH 01', 'English Plus', 3, 0),
(5, 3, 1, 1, 8, 'ENGLISH 1', 'Communication Arts 1', 3, 0),
(6, 3, 1, 1, 8, 'MATH 1', 'College Algebra', 3, 0),
(7, 3, 1, 1, 8, 'IT 1', 'IT Fundamentals', 3, 0),
(8, 3, 1, 1, 8, 'IT 2', 'Computer Programming 1', 3, 3),
(9, 3, 1, 1, 8, 'KB 1', 'Keyboarding 1', 0, 3),
(10, 3, 1, 1, 8, 'PE 1', 'Physical Fitness 1', 2, 0),
(11, 3, 1, 1, 8, 'NSTP 1', 'National Service Training Program', 3, 0),
(12, 3, 1, 1, 8, 'FILIPINO 1', 'Sining ng Pakikipagtalastasan', 3, 0),
(13, 3, 1, 2, 8, 'ENGLISH 2', 'Communications for IT', 3, 0),
(14, 3, 1, 2, 8, 'IT3', 'Computer Programming 2', 3, 3),
(15, 3, 1, 2, 8, 'IT 4', 'Presentation Skills in IT', 3, 0),
(16, 3, 1, 2, 8, 'Math 2', 'Trigonometry', 3, 0),
(17, 3, 1, 2, 8, 'IT 5', 'Fundamentals of Problem Solving', 3, 0),
(18, 3, 1, 2, 8, 'KB 2', 'Keyboarding 2', 0, 3),
(19, 3, 1, 2, 8, 'PE 2', 'Rhythmic Activities', 2, 0),
(20, 3, 1, 2, 8, 'NSTP 2', 'National Service Training Program 2', 3, 0),
(21, 3, 2, 1, 8, 'PHYSICS 1', 'Mechanics and Thermodynamics', 3, 0),
(22, 3, 2, 1, 8, 'IT 6', 'Computer and File Organization', 3, 0),
(23, 3, 2, 1, 8, 'IT 7', 'Object-Oriented Programming', 3, 3),
(24, 3, 2, 1, 8, 'IT 8', 'Operating System Application', 3, 0),
(25, 3, 2, 1, 8, 'MATH 3', 'Discrete Structures', 3, 0),
(26, 3, 2, 1, 8, 'ENGLISH 3', 'Speech and Oral Communication', 3, 0),
(27, 3, 2, 1, 8, 'SOC SCI 1', 'General Psychology with Drug Prevention', 3, 0),
(28, 3, 2, 1, 8, 'PE 3', 'Individual Sports', 2, 0),
(29, 3, 2, 1, 8, 'HUMANITIES 1', 'Art, Man and Society', 3, 0),
(30, 3, 2, 2, 8, 'PHYSICS 2', 'Electricity and Magnetism', 3, 0),
(31, 3, 2, 2, 8, 'IT-ELE 1', 'Data Comm. and Computer Networks', 3, 0),
(32, 3, 2, 2, 8, 'IT 9', 'Database Management System 1', 2, 1),
(33, 3, 2, 2, 8, 'IT-ELE 2', 'Web Page Design', 2, 1),
(34, 3, 2, 2, 8, 'IT 10', 'Systems Analysis', 3, 0),
(35, 3, 2, 2, 8, 'MATH 4', 'Probability and Statistics', 3, 0),
(36, 3, 2, 2, 8, 'SOC SCI 2', 'Professional Ethics with Values Formation', 3, 0),
(37, 3, 2, 2, 8, 'ENGLISH 4', 'Business English', 3, 0),
(38, 3, 2, 2, 8, 'PE 4', 'Team Sports', 2, 0),
(39, 3, 3, 1, 8, 'IT-ELE 3', 'Computer Animation', 2, 1),
(40, 3, 3, 1, 8, 'IT 11', 'Database Management System 2', 2, 1),
(41, 3, 3, 1, 8, 'IT 12', 'Modelling and Simulation', 3, 0),
(42, 3, 3, 1, 8, 'IT 13', 'Management Information System', 3, 0),
(43, 3, 3, 1, 8, 'ECO 1', 'Economics w/ Taxation', 3, 0),
(44, 3, 3, 1, 8, 'HUMANITIES 2', 'Philippine Literature', 3, 0),
(45, 3, 3, 1, 8, 'ACCOUNTING 1', 'Accounting Principles', 3, 0),
(46, 3, 3, 1, 8, 'IT 14', 'Quality Conciousness, habits', 3, 0),
(47, 3, 3, 2, 8, 'IT 15', 'Software Engineering', 2, 1),
(48, 3, 3, 2, 8, 'IT 16', 'Multimedia System', 0, 3),
(49, 3, 3, 2, 8, 'IT-ELE 4', 'Mobile Applicatoins Development', 2, 1),
(50, 3, 3, 2, 8, 'IT-ELE 5', 'Project Management', 3, 0),
(51, 3, 3, 2, 8, 'FREE-ELE 2', 'Busines Systems', 3, 0),
(52, 3, 3, 2, 8, 'FREE-ELE 1', 'Dynamic Web Applications', 2, 1),
(54, 3, 3, 3, 8, 'IT PRAC', 'Practicum/OJT', 9, 0),
(55, 3, 4, 1, 8, 'IT PRO', 'IT Proposal', 6, 0),
(56, 3, 4, 1, 8, 'FREE-ELE 3', 'Computer Graphics', 0, 3),
(57, 3, 4, 1, 8, 'IT-SEMINAR', 'Seminars', 3, 0),
(58, 3, 4, 1, 8, 'FREE-ELE 4', 'Digital Design', 3, 0),
(59, 3, 4, 1, 8, 'IT 17', 'Information System Security', 2, 1),
(60, 3, 4, 2, 8, 'IT 18', 'Software Integration', 3, 0),
(61, 3, 4, 2, 8, 'IT 19', 'Capstone Project (IT Thesis)', 3, 3),
(62, 3, 4, 2, 8, 'FREE-ELE 5', 'PHILNITS', 0, 3),
(63, 3, 4, 2, 8, 'IT 20', 'Internet Programming with Database', 2, 1),
(64, 3, 4, 2, 8, 'RIZAL COURSE', 'Life and Works of Rizal', 3, 0),
(65, 1, 3, 2, 8, 'IT 4', 'Presentation Skill in IT', 3, 0),
(66, 1, 2, 2, 9, 'SOC SCI 2', 'Professional Ethics with Values Formation', 0, 3),
(67, 4, 4, 2, 8, 'FREE-ELE 5', 'PHILNITS', 0, 3),
(68, 4, 1, 2, 8, 'CS 4', 'Data Structure', 3, 0),
(69, 5, 5, 2, 8, 'RIZAL COURSE', 'Life & Works of Rizal', 3, 0),
(70, 5, 2, 2, 8, 'SOC SCI 2', 'Society & Culture w/ Family Planning', 3, 0);

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
(1, 5, 2, 4),
(2, 13, 1, 5),
(3, 14, 1, 8),
(16, 16, 1, 6),
(17, 18, 1, 9),
(18, 19, 1, 10),
(19, 20, 1, 11),
(20, 22, 1, 17),
(21, 23, 1, 14),
(22, 24, 1, 17),
(23, 25, 1, 16),
(24, 26, 1, 13),
(25, 28, 1, 19),
(26, 30, 1, 21),
(27, 31, 1, 22),
(28, 32, 1, 23),
(29, 33, 1, 32),
(30, 34, 1, 32),
(31, 35, 1, 25),
(32, 37, 1, 26),
(33, 38, 1, 28),
(34, 39, 1, 22),
(35, 40, 1, 22),
(36, 41, 1, 25),
(37, 42, 1, 34),
(38, 46, 1, 15),
(39, 47, 1, 34),
(40, 48, 1, 33),
(41, 49, 1, 41),
(42, 50, 1, 42),
(43, 51, 1, 42),
(44, 52, 1, 33),
(45, 55, 1, 47),
(46, 56, 1, 39),
(47, 58, 1, 40),
(48, 59, 1, 52),
(49, 60, 1, 51),
(50, 61, 1, 41),
(51, 61, 1, 55);

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
(24, 2, '2017-2018', 'active'),
(45, 1, '2017-2018', 'inactive'),
(46, 1, '2016-2017', 'inactive'),
(47, 2, '2016-2017', 'inactive'),
(48, 3, '2016-2017', 'inactive'),
(49, 1, '2015-2016', 'inactive'),
(50, 2, '2015-2016', 'inactive'),
(51, 3, '2015-2016', 'inactive');

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
(1, 1, 'admin', 'Iamadmin1', 'Cheryl', '', 'Tarre', '1997-10-24', 'Female', 'Kalimot ko street', '09121212222', 'cheryl@gmail.com', 'active', 'no', '2018-10-09 23:23:09'),
(6, 4, 'Banez', 'Angel123', 'Angel Jean', 'Quinte', 'Banez', '1999-01-20', 'Female', 'Casilda', '09106024370', 'agnel@gmail.com', 'active', 'yes', '2018-11-14 02:59:27'),
(43, 4, 'Inclino', 'Iamwilliam1', 'William Jay', 'Intales', 'Inclino', '1997-10-24', 'Male', 'Puertoello', '0921212121', '', 'active', 'yes', '2018-11-14 02:15:19'),
(46, 4, 'Pacala', 'Raffy123', 'Raffy', '', 'Pacala', '1998-09-23', 'Male', 'Isabel', '09121212121', 'Raf@yahoo.com', 'active', 'yes', '2018-11-14 02:15:23'),
(47, 3, 'Prawn', 'Angelica1', 'Angelica', '', 'Prawn', '1999-09-27', 'Female', 'Ormoc City', '09121212228', 'angelica@gmail.com', 'active', 'no', '2018-11-14 03:04:07'),
(48, 4, '', '', 'Rhayjay', '', 'Alag', '1997-12-22', 'Male', '', '', '', 'inactive', 'yes', '2018-11-14 02:14:52'),
(49, 4, '', '', 'Julito', '', 'Caquilala', '0000-00-00', 'Male', '', '', '', 'inactive', 'yes', '2018-11-14 02:14:52'),
(54, 3, 'Passion', 'Passion1', 'Reyjoy', '', 'Passion', '2008-09-23', 'Male', 'Ormoc city', '09876212111', 'rey@gmail.com', 'active', 'no', '2018-10-10 00:20:38'),
(58, 4, '', '', 'Joshua', '', 'Tayag', '1998-09-28', 'Male', '', '', '', 'inactive', 'yes', '2018-11-14 02:14:52'),
(59, 4, '', '', 'Joseph', '', 'Estrera', '1999-02-12', 'Male', '', '', '', 'inactive', 'yes', '2018-11-14 02:14:52'),
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
(106, 2, 'Bernardo', 'Bernards1', 'Mark', '', 'Bernardo', '1992-10-30', 'Male', 'Ormoc City', '', 'mark@gmail.com', 'active', 'no', '2018-11-14 02:41:52'),
(107, 2, 'Cantero', '598416', 'Joscoro', '', 'Cantero', '1888-11-30', 'Male', 'Sanjuan', '', 'jojo@gmail.com', 'inactive', 'yes', '2018-11-14 02:35:24');

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
(1, 54, 3);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `classID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `counter`
--
ALTER TABLE `counter`
  MODIFY `countID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
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
  MODIFY `facID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `fac_spec`
--
ALTER TABLE `fac_spec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `feeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `prospectus`
--
ALTER TABLE `prospectus`
  MODIFY `prosID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
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
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `roleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `secID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `specialization`
--
ALTER TABLE `specialization`
  MODIFY `specID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `studclass`
--
ALTER TABLE `studclass`
  MODIFY `scID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `studgrade`
--
ALTER TABLE `studgrade`
  MODIFY `sgID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `studprospectus`
--
ALTER TABLE `studprospectus`
  MODIFY `spID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `stud_fee`
--
ALTER TABLE `stud_fee`
  MODIFY `sfID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `subject_req`
--
ALTER TABLE `subject_req`
  MODIFY `subReqID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `term`
--
ALTER TABLE `term`
  MODIFY `termID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT for table `year`
--
ALTER TABLE `year`
  MODIFY `yearID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `year_req`
--
ALTER TABLE `year_req`
  MODIFY `yrID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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