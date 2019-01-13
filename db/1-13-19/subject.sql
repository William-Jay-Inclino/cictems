-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2019 at 05:09 AM
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
(13, 6, 1, 2, 12, 'MAT121', 'Discrete Structure', 3, 3, 'lec', '', 257),
(14, 6, 1, 2, 12, 'STS121', 'Science, Technology & Society', 3, 3, 'lec', '', 869),
(15, 6, 1, 2, 12, 'Socio121', 'Social Issues & Professional Practice', 3, 3, 'lec', '', 348),
(16, 6, 1, 2, 15, 'IT-Prog121', 'Computer Programming 2', 2, 3, 'lec', '', 645),
(17, 6, 1, 2, 15, 'IT-Prog121', 'Computer Programming 2', 1, 3, 'lab', '', 645),
(18, 6, 1, 2, 13, 'IT-HC1211', 'Introduction to Human Computer Interaction', 2, 3, 'lec', '', 265),
(19, 6, 1, 2, 13, 'IT-HC1211', 'Introduction to Human Computer Interaction', 1, 3, 'lab', '', 265),
(20, 6, 1, 2, 13, 'IT-DiGiLog121', 'Digital Logic Design', 3, 3, 'lec', '', 543),
(21, 6, 1, 2, 12, 'Hist121', 'Readings in Philippine History', 3, 3, 'lec', '', 291),
(22, 6, 1, 2, 14, 'NSTP121', 'National Service Training Prog2', 3, 3, 'lec', '', 193),
(23, 6, 1, 2, 14, 'PE121', 'Rhythmic Activities', 2, 2, 'lec', '', 964),
(24, 6, 2, 1, 15, 'IT-DBms211', 'Fundamentals of Database Systems', 2, 3, 'lec', '', 495),
(25, 6, 2, 1, 15, 'IT-DBms211', 'Fundamentals of Database Systems', 1, 3, 'lab', '', 495),
(26, 6, 2, 1, 15, 'IT-Ele211', 'Object Oriented Programming', 2, 3, 'lec', '', 761),
(27, 6, 2, 1, 15, 'IT-Ele211', 'Object Oriented Programming', 1, 3, 'lab', '', 761),
(28, 6, 2, 1, 15, 'IT-Ele212', 'Platform Technologies', 2, 3, 'lec', '', 324),
(29, 6, 2, 1, 15, 'IT-Ele212', 'Platform Technologies', 1, 3, 'lab', '', 324),
(30, 6, 2, 1, 14, 'Hum211', 'Art Appreciation', 3, 3, 'lec', '', 852),
(31, 6, 2, 1, 14, 'Socio211', 'The Contemporary World', 3, 3, 'lec', '', 392),
(32, 6, 2, 1, 15, 'IT-Datstruct1202', 'Data Structure & Algorithm Analysis', 2, 3, 'lec', '', 765),
(33, 6, 2, 1, 15, 'IT-Datstruct1202', 'Data Structure & Algorithm Analysis', 1, 3, 'lab', '', 765),
(34, 6, 2, 1, 12, 'Filipino211', 'Komonikasyon sa Akademikong Filipino', 3, 3, 'lec', '', 298),
(35, 6, 2, 1, 14, 'PE211', 'Individual Sports', 2, 2, 'lec', '', 352),
(36, 6, 2, 1, 14, 'Ethics211', 'Ethics', 3, 3, 'lec', '', 659),
(37, 6, 2, 2, 12, 'Filipino221', 'Panitikan', 3, 3, 'lec', '', 517),
(38, 6, 2, 2, 15, 'IT-DBms221', 'Information Management 2', 2, 3, 'lec', '', 615),
(39, 6, 2, 2, 15, 'IT-DBms221', 'Information Management 2', 1, 3, 'lab', '', 615),
(40, 6, 2, 2, 15, 'IT-IntProg221', 'Integrative Programming & Technologies 1', 2, 3, 'lec', '', 123),
(41, 6, 2, 2, 15, 'IT-IntProg221', 'Integrative Programming & Technologies 1', 1, 3, 'lab', '', 123),
(42, 6, 2, 2, 13, 'IT-Netwrk221', 'Networking 2', 2, 3, 'lec', '#REF!', 643),
(43, 6, 2, 2, 13, 'IT-Netwrk221', 'Networking 2', 1, 3, 'lab', '#REF!', 643),
(44, 6, 2, 2, 15, 'IT-SAD221', 'Systems Analysis & Design', 3, 3, 'lec', '', 376),
(45, 6, 2, 2, 13, 'IT-NetWrk201', 'Networking 1', 2, 3, 'lec', '', 672),
(46, 6, 2, 2, 13, 'IT-NetWrk201', 'Networking 1', 1, 3, 'lab', '', 672),
(47, 6, 2, 2, 14, 'Entrep221', 'The Entrepreneurial Mind', 3, 3, 'lec', '', 741),
(48, 6, 2, 2, 12, 'IT-QM221', 'Quantitative Methods (incl. Modelling & Simulation)', 3, 3, 'lec', '', 548),
(49, 6, 2, 2, 14, 'PE221', 'Team Sports', 2, 2, 'lec', '', 384),
(50, 6, 3, 1, 13, 'IT-ACTA311', 'Computer Accounting', 3, 3, 'lec', '', 465),
(51, 6, 3, 1, 13, 'IT-SIA311', 'System Integration & Architecture1', 2, 3, 'lec', '', 462),
(52, 6, 3, 1, 13, 'IT-SIA311', 'System Integration & Architecture1', 1, 3, 'lab', '', 462),
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
(64, 6, 3, 2, 13, 'IT-IAS321', 'Information Assurance & Security', 2, 3, 'lec', '', 243),
(65, 6, 3, 2, 13, 'IT-IAS321', 'Information Assurance & Security', 1, 3, 'lab', '', 243),
(66, 6, 3, 2, 15, 'IT-ELE321', 'Integrative Programming & Technologies', 2, 3, 'lec', '', 976),
(67, 6, 3, 2, 15, 'IT-ELE321', 'Integrative Programming & Technologies', 1, 3, 'lab', '', 976),
(68, 6, 3, 2, 15, 'IT-ELE322', 'Intelligent Systems', 2, 3, 'lec', '', 978),
(69, 6, 3, 2, 15, 'IT-ELE322', 'Intelligent Systems', 1, 3, 'lab', '', 978),
(70, 6, 3, 2, 15, 'IT-Pro321', 'IT Proposal', 3, 3, 'lec', '', 613),
(71, 6, 3, 2, 15, 'IT-Techno301', 'Technopreneurship', 3, 3, 'lec', '', 295),
(72, 6, 3, 2, 13, 'IT-Free-Ele-322', 'Analytics Modelling: Techniques and Tools', 3, 3, 'lec', '', 763),
(73, 6, 3, 2, 14, 'Rizal321', 'Life & Works of Dr. Jose Rizal', 3, 3, 'lec', '', 347);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`prosID`) REFERENCES `prospectus` (`prosID`),
  ADD CONSTRAINT `subject_ibfk_2` FOREIGN KEY (`yearID`) REFERENCES `year` (`yearID`),
  ADD CONSTRAINT `subject_ibfk_3` FOREIGN KEY (`semID`) REFERENCES `semester` (`semID`),
  ADD CONSTRAINT `subject_ibfk_4` FOREIGN KEY (`specID`) REFERENCES `specialization` (`specID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
