-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2019 at 08:38 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `appoint_requests`
--

CREATE TABLE `appoint_requests` (
  `ID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `SupervisorID` int(11) NOT NULL,
  `Msg` text NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `State` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appoint_requests`
--

INSERT INTO `appoint_requests` (`ID`, `StudentID`, `SupervisorID`, `Msg`, `Date`, `Time`, `State`) VALUES
(1, 500, 1250, 'please meet me', '2018-11-16', '13:58:00', 'Pending'),
(2, 502, 1251, 'please meet', '2019-02-17', '16:00:00', 'Pending'),
(4, 502, 1250, 'please meet i want to discuss.', '2019-03-13', '11:59:00', 'Pending'),
(16, 507, 1253, 'Would like meeting to discuss the sales project ', '2019-05-22', '13:30:00', 'Pending'),
(17, 512, 1253, '', '2019-04-26', '15:00:00', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `DepartmentID` int(11) NOT NULL,
  `CreatDate` datetime NOT NULL,
  `CreatedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`ID`, `Name`, `DepartmentID`, `CreatDate`, `CreatedBy`) VALUES
(1, 'Web Development', 1, '2018-10-18 02:07:02', 0),
(2, 'Mobile Development', 1, '2018-10-20 04:09:03', 0),
(3, 'Big Data Logic', 1, '2018-10-18 02:07:02', 0),
(6, 'Project Design', 1, '2018-10-20 04:09:03', 0),
(7, '3D Animation and Visualisation', 1, '2018-10-18 02:07:02', 0),
(12, 'Audio Technology', 1, '2018-10-20 04:09:03', 0),
(13, 'Games Development', 1, '2018-10-18 02:07:02', 0),
(14, 'Advanced HTML', 1, '2018-10-20 04:09:03', 0),
(15, 'Security Training', 1, '2018-10-18 02:07:02', 0),
(16, 'Cascading Style Sheets (CSS)', 1, '2018-10-20 04:09:03', 0),
(17, 'Designing Internetwork Solutions', 1, '2018-10-18 02:07:02', 0),
(18, 'Interconnecting Networking Devices', 1, '2018-10-20 04:09:03', 0),
(19, 'IOS Development', 1, '2018-10-18 02:07:02', 0),
(20, 'Android Development', 1, '2018-10-20 04:09:03', 0),
(21, 'System Programming ', 1, '2018-10-18 02:07:02', 0),
(22, 'Linux Systems', 1, '2018-10-20 04:09:03', 0),
(23, 'Cloud System Center ', 1, '2018-10-18 02:07:02', 0),
(24, 'Server Administrator ', 1, '2018-10-20 04:09:03', 0),
(25, 'IT Security Engineer', 1, '2018-10-18 02:07:02', 0),
(26, 'IT Foundation ', 1, '2018-10-20 04:09:03', 0),
(27, 'IT Service Lifecycle', 1, '2018-10-18 02:07:02', 0),
(28, 'UX&UI Desgin', 1, '2018-10-20 04:09:03', 0),
(29, 'Managing Project Teams', 1, '2018-10-18 02:07:02', 0),
(30, 'Project Management ', 1, '2018-10-20 04:09:03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `CreateDate` datetime NOT NULL,
  `CreatedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`ID`, `Name`, `CreateDate`, `CreatedBy`) VALUES
(1, 'Computer Science', '2018-10-12 05:09:18', 0),
(2, 'Electrical Engineering', '2018-10-17 02:04:05', 0),
(4, 'Business and Society', '2019-03-15 02:04:05', 0),
(5, 'Economics and Law', '2019-03-15 02:04:05', 0),
(6, 'Fashion, Marketing and Tourism', '2019-03-15 02:04:05', 0),
(7, 'Management and HRM', '2019-03-15 02:04:05', 0),
(8, 'Media and Journalism', '2019-03-15 02:04:05', 0),
(9, 'Social Sciences', '2019-03-15 02:04:05', 0),
(10, 'Computer Games', '2019-03-15 02:04:05', 0),
(11, 'Applied Science', '2019-03-15 02:04:05', 0),
(12, 'Civil Engineering and Environmental Management', '2019-03-15 02:04:05', 0),
(13, 'Construction and Surveying', '2019-03-15 02:04:05', 0),
(14, 'Cyber Security and Networks', '2019-03-15 02:04:05', 0),
(15, 'Mechanical Engineering', '2019-03-15 02:04:05', 0),
(16, 'Biological and Biomedical Sciences', '2019-03-15 02:04:05', 0),
(17, 'Nursing and Community Health', '2019-03-15 02:04:05', 0),
(18, 'Occupational Therapy, and Human Nutrition and Dietetics', '2019-03-15 02:04:05', 0),
(19, 'Physiotherapy and Paramedicine', '2019-03-15 02:04:05', 0),
(20, 'Podiatry and Radiography', '2019-03-15 02:04:05', 0),
(21, 'Psychology', '2019-03-15 02:04:05', 0),
(22, 'Social Work', '2019-03-15 02:04:05', 0),
(23, 'Vision Sciences', '2019-03-15 02:04:05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `flag_table`
--

CREATE TABLE `flag_table` (
  `ID` int(11) NOT NULL,
  `TopicID` int(11) NOT NULL,
  `SupervisorID` int(11) NOT NULL,
  `Count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `logindetails`
--

CREATE TABLE `logindetails` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `username` text NOT NULL,
  `Password` text NOT NULL,
  `LoginTime` datetime NOT NULL,
  `UserType` text NOT NULL,
  `DepartmentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logindetails`
--

INSERT INTO `logindetails` (`ID`, `UserID`, `username`, `Password`, `LoginTime`, `UserType`, `DepartmentID`) VALUES
(1, 0, 'admin', '81DC9BDB52D04DC20036DBD8313ED055', '2018-10-12 01:02:06', 'Admin', 0),
(64, 1253, 'super', '81dc9bdb52d04dc20036dbd8313ed055', '2019-04-07 17:42:03', 'Supervisor', 1),
(66, 506, 'stu', '81dc9bdb52d04dc20036dbd8313ed055', '2019-04-13 15:54:54', 'Student', 1),
(67, 1256, 'Aaron Hodgson', '81dc9bdb52d04dc20036dbd8313ed055', '2019-04-13 16:21:50', 'Supervisor', 1),
(68, 1257, 'Evan Harvey', '81dc9bdb52d04dc20036dbd8313ed055', '2019-04-13 16:28:38', 'Supervisor', 1),
(69, 1258, 'Ellis Hunter', '81dc9bdb52d04dc20036dbd8313ed055', '2019-04-13 16:31:35', 'Supervisor', 1),
(70, 1259, 'Kian Pollard', '81dc9bdb52d04dc20036dbd8313ed055', '2019-04-13 16:36:55', 'Supervisor', 1),
(71, 1260, 'Scott Heath', '81dc9bdb52d04dc20036dbd8313ed055', '2019-04-13 16:42:35', 'Supervisor', 1),
(72, 1261, 'Rebecca Poole', '81dc9bdb52d04dc20036dbd8313ed055', '2019-04-13 16:43:18', 'Supervisor', 1),
(73, 1262, 'Jay Ward', '81dc9bdb52d04dc20036dbd8313ed055', '2019-04-13 16:44:47', 'Supervisor', 1),
(74, 1263, 'Mohammad Fox', '81dc9bdb52d04dc20036dbd8313ed055', '2019-04-13 16:45:36', 'Supervisor', 1),
(75, 1264, 'Declan Robson', '81dc9bdb52d04dc20036dbd8313ed055', '2019-04-13 16:46:12', 'Supervisor', 1),
(76, 507, 'LKhan', '81dc9bdb52d04dc20036dbd8313ed055', '2019-04-13 16:54:22', 'Student', 1),
(77, 508, 'SDickinson', '81dc9bdb52d04dc20036dbd8313ed055', '2019-04-13 16:55:21', 'Student', 1),
(78, 509, 'AWhittaker', '81dc9bdb52d04dc20036dbd8313ed055', '2019-04-13 16:56:16', 'Student', 1),
(80, 511, 'RCameron', '81dc9bdb52d04dc20036dbd8313ed055', '2019-04-13 17:02:54', 'Student', 1),
(81, 512, 'LPollard', '81dc9bdb52d04dc20036dbd8313ed055', '2019-04-13 16:03:41', 'Student', 1),
(82, 513, 'SNorton', '81dc9bdb52d04dc20036dbd8313ed055', '2019-04-13 17:04:49', 'Student', 1),
(83, 514, 'AConnor', '81dc9bdb52d04dc20036dbd8313ed055', '2019-04-13 17:05:48', 'Student', 1),
(84, 515, 'LStone', '81dc9bdb52d04dc20036dbd8313ed055', '2019-04-13 17:06:36', 'Student', 1),
(85, 516, 'GBarlow', '81dc9bdb52d04dc20036dbd8313ed055', '2019-04-13 17:07:20', 'Student', 1),
(86, 517, 'BDoyle', '81dc9bdb52d04dc20036dbd8313ed055', '2019-04-13 17:08:15', 'Student', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_table`
--

CREATE TABLE `student_table` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `FatherName` varchar(100) NOT NULL,
  `Email` text NOT NULL,
  `Phone` text NOT NULL,
  `Address` text NOT NULL,
  `DepartmentID` int(11) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `UpdateDate` datetime NOT NULL,
  `CreatedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_table`
--

INSERT INTO `student_table` (`ID`, `Name`, `FatherName`, `Email`, `Phone`, `Address`, `DepartmentID`, `DateAdded`, `UpdateDate`, `CreatedBy`) VALUES
(506, 'Kameran', 'Youssef', 'mrkameranyoussef@gmail.com', '0141 111 2222', '1 Glasgow Street, Glasgow, G10AA, Scotland', 1, '2019-04-13 15:54:54', '0000-00-00 00:00:00', 0),
(507, 'Luca ', 'Khan', 'email@email.com', '079 0223 6746', '20 Middlewich Road\r\nFINTRY\r\nAB53 0JN', 1, '2019-04-13 16:54:22', '0000-00-00 00:00:00', 0),
(508, 'Scarlett ', 'Dickinson', 'email@email.com', '078 8067 0123', '10 St Denys Road\r\nPREES HIGHER HEATH\r\nSY13 6RA', 1, '2019-04-13 16:55:21', '0000-00-00 00:00:00', 0),
(509, 'Adam ', 'Whittaker', 'email@email.com', ' 078 2771 7209', '13 Glandovey Terrace\r\nTREGLEMAIS\r\nSA62 1PF', 1, '2019-04-13 16:56:16', '0000-00-00 00:00:00', 0),
(511, 'Rachel ', 'Cameron', 'email@email.com', '078 6159 5283', '79 Osborne Road\r\nKINGSBARNS\r\nKY16 3TG', 1, '2019-04-13 17:02:54', '0000-00-00 00:00:00', 0),
(512, 'Luke', 'Pollard', 'email@email.com', '078 4136 8472', '1 Main Road\r\nAUCHLUNKART\r\nAB55 0HD', 1, '2019-04-13 16:03:41', '0000-00-00 00:00:00', 0),
(513, 'Sebastian', 'Norton', 'email@email.com', '079 0028 5183', '10 Duckpit Lane\r\nUPSETTLINGTON\r\nTD15 7SG', 1, '2019-04-13 17:04:49', '0000-00-00 00:00:00', 0),
(514, 'Alice', 'Connor', 'email@email.com', ' 078 7736 0817', '99 Nith Street\r\nGLAN-DWYFACH\r\nLL51 3WU', 1, '2019-04-13 17:05:48', '0000-00-00 00:00:00', 0),
(515, 'Lydia', 'Stone', 'email@email.com', '070 0459 9766', '17 Annfield Rd\r\nBEDDINGTON CORNER\r\nCR4 4RB', 1, '2019-04-13 17:06:36', '0000-00-00 00:00:00', 0),
(516, 'Gracie ', 'Barlow', 'email@email.com', '078 2344 5188', '77 Essex Rd\r\nTASLEY\r\nWV16 5BB', 1, '2019-04-13 17:07:20', '0000-00-00 00:00:00', 0),
(517, 'Bailey ', 'Doyle', 'email@email.com', '070 3161 0234', '49 Ballifeary Road\r\nBALLINLICK\r\nPH8 8SA   ', 1, '2019-04-13 17:08:15', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `suggested_topics`
--

CREATE TABLE `suggested_topics` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Description` text NOT NULL,
  `Objective` text NOT NULL,
  `Goals` text NOT NULL,
  `Complexity` text NOT NULL,
  `CourseID` int(11) NOT NULL,
  `SupervisorID` int(11) NOT NULL,
  `DepartmentID` int(11) NOT NULL,
  `State` text NOT NULL,
  `DateTime` datetime NOT NULL,
  `CreatedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suggested_topics`
--

INSERT INTO `suggested_topics` (`ID`, `Name`, `Description`, `Objective`, `Goals`, `Complexity`, `CourseID`, `SupervisorID`, `DepartmentID`, `State`, `DateTime`, `CreatedBy`) VALUES
(2, 'Weather App', 'Weather app based on yahoo weather API.', 'Development', 'The goal to develop weather app for Android and IOS. ', 'Easy', 2, 1253, 1, 'Waiting', '2019-04-13 19:03:01', 511),
(3, 'Educational website ', 'create a website to for young people to learn  about programming. ', 'Development', 'The goal is to develop the website to teach program with animation and colourful theme.', 'Easy', 1, 1253, 1, 'Waiting', '2019-04-13 19:09:22', 512);

-- --------------------------------------------------------

--
-- Table structure for table `supervisor_courses`
--

CREATE TABLE `supervisor_courses` (
  `ID` int(11) NOT NULL,
  `SupervisorID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `DepartmentID` int(11) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `DateAdded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supervisor_courses`
--

INSERT INTO `supervisor_courses` (`ID`, `SupervisorID`, `CourseID`, `DepartmentID`, `CreatedBy`, `DateAdded`) VALUES
(1, 1250, 1, 1, 0, '2018-11-03 04:43:07'),
(2, 1250, 2, 1, 0, '2018-11-03 04:44:19'),
(3, 1252, 4, 2, 0, '2018-11-03 04:45:21'),
(4, 1251, 2, 1, 0, '2019-03-05 12:23:05'),
(5, 1253, 2, 1, 0, '2019-04-07 17:47:08'),
(6, 1253, 1, 1, 0, '2019-04-13 15:50:51'),
(7, 1253, 3, 1, 0, '2019-04-13 15:50:55'),
(8, 1253, 7, 1, 0, '2019-04-13 15:50:59'),
(9, 1253, 12, 1, 0, '2019-04-13 15:51:02'),
(10, 1253, 13, 1, 0, '2019-04-13 15:51:07'),
(11, 1253, 14, 1, 0, '2019-04-13 15:51:12'),
(12, 1253, 15, 1, 0, '2019-04-13 15:51:19'),
(13, 1253, 16, 1, 0, '2019-04-13 15:51:25'),
(14, 1253, 17, 1, 0, '2019-04-13 15:51:42'),
(15, 1253, 18, 1, 0, '2019-04-13 15:51:47'),
(16, 1253, 19, 1, 0, '2019-04-13 15:51:54'),
(17, 1253, 20, 1, 0, '2019-04-13 15:51:58'),
(18, 1253, 21, 1, 0, '2019-04-13 15:52:03'),
(19, 1253, 22, 1, 0, '2019-04-13 15:52:07'),
(20, 1253, 23, 1, 0, '2019-04-13 15:52:13'),
(21, 1253, 24, 1, 0, '2019-04-13 15:52:25'),
(22, 1253, 25, 1, 0, '2019-04-13 15:52:29'),
(23, 1253, 26, 1, 0, '2019-04-13 15:52:33'),
(24, 1253, 28, 1, 0, '2019-04-13 15:52:38'),
(25, 1253, 29, 1, 0, '2019-04-13 15:52:42'),
(26, 1253, 30, 1, 0, '2019-04-13 15:52:46'),
(27, 1256, 1, 1, 0, '2019-04-13 16:23:07'),
(28, 1256, 2, 1, 0, '2019-04-13 16:23:10'),
(29, 1256, 3, 1, 0, '2019-04-13 16:23:14'),
(30, 1256, 6, 1, 0, '2019-04-13 16:23:17'),
(31, 1256, 7, 1, 0, '2019-04-13 16:23:21'),
(32, 1256, 12, 1, 0, '2019-04-13 16:23:25'),
(33, 1256, 13, 1, 0, '2019-04-13 16:23:29'),
(34, 1256, 14, 1, 0, '2019-04-13 16:23:32'),
(35, 1256, 15, 1, 0, '2019-04-13 16:23:38'),
(36, 1256, 16, 1, 0, '2019-04-13 16:23:43'),
(37, 1256, 17, 1, 0, '2019-04-13 16:23:48'),
(38, 1256, 18, 1, 0, '2019-04-13 16:23:53'),
(39, 1256, 19, 1, 0, '2019-04-13 16:23:57'),
(40, 1256, 20, 1, 0, '2019-04-13 16:24:01'),
(41, 1256, 21, 1, 0, '2019-04-13 16:24:05'),
(42, 1256, 22, 1, 0, '2019-04-13 16:24:09'),
(43, 1256, 23, 1, 0, '2019-04-13 16:24:13'),
(44, 1256, 24, 1, 0, '2019-04-13 16:24:19'),
(45, 1256, 25, 1, 0, '2019-04-13 16:24:23'),
(46, 1256, 26, 1, 0, '2019-04-13 16:24:27'),
(47, 1256, 28, 1, 0, '2019-04-13 16:24:32'),
(48, 1256, 29, 1, 0, '2019-04-13 16:24:36'),
(49, 1256, 30, 1, 0, '2019-04-13 16:24:41'),
(50, 1257, 1, 1, 0, '2019-04-13 16:29:00'),
(51, 1257, 2, 1, 0, '2019-04-13 16:29:03'),
(52, 1257, 3, 1, 0, '2019-04-13 16:29:06'),
(53, 1257, 6, 1, 0, '2019-04-13 16:29:15'),
(54, 1257, 7, 1, 0, '2019-04-13 16:29:19'),
(55, 1257, 12, 1, 0, '2019-04-13 16:29:22'),
(56, 1257, 13, 1, 0, '2019-04-13 16:29:26'),
(57, 1257, 14, 1, 0, '2019-04-13 16:29:31'),
(58, 1257, 15, 1, 0, '2019-04-13 16:29:35'),
(59, 1257, 16, 1, 0, '2019-04-13 16:29:40'),
(60, 1257, 17, 1, 0, '2019-04-13 16:29:44'),
(61, 1257, 18, 1, 0, '2019-04-13 16:29:48'),
(62, 1257, 19, 1, 0, '2019-04-13 16:29:52'),
(63, 1257, 20, 1, 0, '2019-04-13 16:29:55'),
(64, 1257, 21, 1, 0, '2019-04-13 16:29:59'),
(65, 1257, 22, 1, 0, '2019-04-13 16:30:09'),
(66, 1257, 23, 1, 0, '2019-04-13 16:30:12'),
(67, 1257, 24, 1, 0, '2019-04-13 16:30:17'),
(68, 1257, 25, 1, 0, '2019-04-13 16:30:21'),
(69, 1257, 26, 1, 0, '2019-04-13 16:30:26'),
(70, 1257, 27, 1, 0, '2019-04-13 16:30:35'),
(71, 1257, 28, 1, 0, '2019-04-13 16:30:39'),
(72, 1257, 29, 1, 0, '2019-04-13 16:30:43'),
(73, 1257, 30, 1, 0, '2019-04-13 16:30:47'),
(74, 1258, 1, 1, 0, '2019-04-13 16:31:46'),
(75, 1258, 2, 1, 0, '2019-04-13 16:31:49'),
(76, 1258, 3, 1, 0, '2019-04-13 16:31:53'),
(77, 1258, 6, 1, 0, '2019-04-13 16:31:57'),
(78, 1258, 7, 1, 0, '2019-04-13 16:32:00'),
(79, 1258, 12, 1, 0, '2019-04-13 16:32:05'),
(80, 1258, 13, 1, 0, '2019-04-13 16:32:09'),
(81, 1258, 14, 1, 0, '2019-04-13 16:32:12'),
(82, 1258, 15, 1, 0, '2019-04-13 16:32:17'),
(83, 1258, 16, 1, 0, '2019-04-13 16:32:22'),
(84, 1258, 17, 1, 0, '2019-04-13 16:32:26'),
(85, 1258, 18, 1, 0, '2019-04-13 16:32:29'),
(86, 1258, 19, 1, 0, '2019-04-13 16:32:33'),
(87, 1258, 20, 1, 0, '2019-04-13 16:32:37'),
(88, 1258, 21, 1, 0, '2019-04-13 16:32:42'),
(89, 1258, 22, 1, 0, '2019-04-13 16:32:48'),
(90, 1258, 24, 1, 0, '2019-04-13 16:32:52'),
(91, 1258, 25, 1, 0, '2019-04-13 16:32:56'),
(92, 1258, 26, 1, 0, '2019-04-13 16:33:00'),
(93, 1258, 28, 1, 0, '2019-04-13 16:33:04'),
(94, 1258, 29, 1, 0, '2019-04-13 16:33:08'),
(95, 1258, 30, 1, 0, '2019-04-13 16:33:12'),
(96, 1259, 19, 1, 0, '2019-04-13 16:37:06'),
(97, 1259, 1, 1, 0, '2019-04-13 16:46:34'),
(98, 1259, 2, 1, 0, '2019-04-13 16:46:38'),
(99, 1259, 17, 1, 0, '2019-04-13 16:46:40'),
(100, 1259, 25, 1, 0, '2019-04-13 16:46:43'),
(101, 1259, 29, 1, 0, '2019-04-13 16:46:47'),
(102, 1259, 14, 1, 0, '2019-04-13 16:46:52'),
(103, 1259, 20, 1, 0, '2019-04-13 16:46:57'),
(104, 1260, 1, 1, 0, '2019-04-13 16:47:10'),
(105, 1260, 3, 1, 0, '2019-04-13 16:47:15'),
(106, 1260, 13, 1, 0, '2019-04-13 16:47:19'),
(107, 1260, 16, 1, 0, '2019-04-13 16:47:22'),
(108, 1260, 19, 1, 0, '2019-04-13 16:47:27'),
(109, 1260, 24, 1, 0, '2019-04-13 16:47:31'),
(110, 1260, 28, 1, 0, '2019-04-13 16:47:35'),
(111, 1261, 14, 1, 0, '2019-04-13 16:47:45'),
(112, 1261, 30, 1, 0, '2019-04-13 16:47:49'),
(113, 1261, 29, 1, 0, '2019-04-13 16:47:53'),
(114, 1261, 22, 1, 0, '2019-04-13 16:47:56'),
(115, 1261, 13, 1, 0, '2019-04-13 16:48:00'),
(116, 1261, 21, 1, 0, '2019-04-13 16:48:04'),
(117, 1262, 22, 1, 0, '2019-04-13 16:48:35'),
(118, 1262, 2, 1, 0, '2019-04-13 16:48:38'),
(119, 1262, 3, 1, 0, '2019-04-13 16:48:40'),
(120, 1262, 12, 1, 0, '2019-04-13 16:48:44'),
(121, 1262, 7, 1, 0, '2019-04-13 16:48:48'),
(122, 1262, 29, 1, 0, '2019-04-13 16:48:52'),
(123, 1262, 17, 1, 0, '2019-04-13 16:49:00'),
(124, 1263, 1, 1, 0, '2019-04-13 16:49:09'),
(125, 1263, 2, 1, 0, '2019-04-13 16:49:12'),
(126, 1263, 3, 1, 0, '2019-04-13 16:49:15'),
(127, 1263, 7, 1, 0, '2019-04-13 16:49:19'),
(128, 1263, 13, 1, 0, '2019-04-13 16:49:37'),
(129, 1263, 18, 1, 0, '2019-04-13 16:49:41'),
(130, 1263, 23, 1, 0, '2019-04-13 16:49:44'),
(131, 1263, 26, 1, 0, '2019-04-13 16:49:47'),
(132, 1263, 28, 1, 0, '2019-04-13 16:49:51'),
(133, 1263, 29, 1, 0, '2019-04-13 16:49:55'),
(134, 1264, 2, 1, 0, '2019-04-13 16:50:35'),
(135, 1264, 13, 1, 0, '2019-04-13 16:50:39'),
(136, 1264, 6, 1, 0, '2019-04-13 16:50:42'),
(137, 1264, 17, 1, 0, '2019-04-13 16:50:48'),
(138, 1264, 15, 1, 0, '2019-04-13 16:50:51'),
(139, 1264, 28, 1, 0, '2019-04-13 16:50:57');

-- --------------------------------------------------------

--
-- Table structure for table `supervisor_table`
--

CREATE TABLE `supervisor_table` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` text NOT NULL,
  `Phone` text NOT NULL,
  `Address` text NOT NULL,
  `DepartmentID` int(11) NOT NULL,
  `ProjLimit` int(11) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `UpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supervisor_table`
--

INSERT INTO `supervisor_table` (`ID`, `Name`, `Email`, `Phone`, `Address`, `DepartmentID`, `ProjLimit`, `CreatedBy`, `DateAdded`, `UpdateDate`) VALUES
(1253, 'Kameran Youssef', 'mrkameranyoussef@gmail.com', '0141 111 2222', '1 Glasgow Street, Glasgow, G10AA, Scotland', 1, 9, 0, '2019-04-07 17:42:03', '0000-00-00 00:00:00'),
(1256, 'Aaron Hodgson', 'email@email.com', '070 3161 0739', '26 Buckingham Rd, THORPE\r\nLN12 3NA', 1, 10, 0, '2019-04-13 16:21:50', '0000-00-00 00:00:00'),
(1257, 'Evan Harvey', 'email@email.com', '078 6704 5188', '12 Leicester Road\r\nAYCLIFFE\r\nDL5 7EW', 1, 10, 0, '2019-04-13 16:28:38', '0000-00-00 00:00:00'),
(1258, 'Ellis Hunter', 'email@email.com', ' 070 7267 9817', '43 Monks Way\r\nTOMICH\r\nIV4 6LP', 1, 10, 0, '2019-04-13 16:31:35', '0000-00-00 00:00:00'),
(1259, 'Kian Pollard', 'email@email.com', '070 5595 3129', '88 Bridge Street\r\nGODSTONE\r\nRH9 6HA', 1, 10, 0, '2019-04-13 16:36:55', '0000-00-00 00:00:00'),
(1260, 'Scott Heath', 'email@email.com', '079 5370 9633', '90 Main St\r\nACHNAHA\r\nPA34 0PA', 1, 10, 0, '2019-04-13 16:42:35', '0000-00-00 00:00:00'),
(1261, 'Rebecca Poole', 'email@email.com', '079 4212 9943', '53 South Western Terrace\r\nMINTERNE MAGNA\r\nDT2 1BT', 1, 10, 0, '2019-04-13 16:43:18', '0000-00-00 00:00:00'),
(1262, 'Jay Ward', 'email@email.com', '070 4799 7543', '69 Withers Close\r\nALLANGILLFOOT\r\nDG13 3DQ', 1, 10, 0, '2019-04-13 16:44:47', '0000-00-00 00:00:00'),
(1263, 'Mohammad Fox', 'email@email.com', '077 0043 7713', '45 Quay Street\r\nNANTYCAWS\r\nSA32 7QH', 1, 10, 0, '2019-04-13 16:45:36', '0000-00-00 00:00:00'),
(1264, 'Declan Robson', 'email@email.com', ' 070 0078 1882', '47 Uxbridge Road\r\nSKETTY\r\nSA2 9QT\r\n', 1, 10, 0, '2019-04-13 16:46:12', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `taken_projects`
--

CREATE TABLE `taken_projects` (
  `ID` int(11) NOT NULL,
  `SupervisorID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `DepartmentID` int(11) NOT NULL,
  `TopicID` int(11) NOT NULL,
  `State` text NOT NULL,
  `Message` text NOT NULL,
  `DateAdded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taken_projects`
--

INSERT INTO `taken_projects` (`ID`, `SupervisorID`, `StudentID`, `CourseID`, `DepartmentID`, `TopicID`, `State`, `Message`, `DateAdded`) VALUES
(12, 1253, 506, 2, 1, 4, 'Accepted', 'Hello, I would to apply for this project please.', '2019-04-13 16:39:57'),
(13, 1253, 507, 13, 1, 5, 'Pending', '', '2019-04-13 18:51:41'),
(14, 1253, 508, 22, 1, 6, 'Pending', '', '2019-04-13 18:54:41'),
(15, 1253, 509, 2, 1, 7, 'Rejected', '', '2019-04-13 18:55:03'),
(16, 1253, 513, 28, 1, 12, 'Pending', '', '2019-04-13 19:11:17');

-- --------------------------------------------------------

--
-- Table structure for table `topics_table`
--

CREATE TABLE `topics_table` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Description` text NOT NULL,
  `Objective` text NOT NULL,
  `Goals` text NOT NULL,
  `Complexity` text NOT NULL,
  `CourseID` int(11) NOT NULL,
  `SupervisorID` int(11) NOT NULL,
  `DepartmentID` int(11) NOT NULL,
  `DateTime` datetime NOT NULL,
  `CreatedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topics_table`
--

INSERT INTO `topics_table` (`ID`, `Name`, `Description`, `Objective`, `Goals`, `Complexity`, `CourseID`, `SupervisorID`, `DepartmentID`, `DateTime`, `CreatedBy`) VALUES
(4, 'Sales App', 'Jump to Application development - Develop sales app for IOS and Android.', 'Develop and test', 'The project goal is to deploy the application on the app store. ', 'Hard', 2, 1253, 1, '2019-04-13 16:06:42', 1253),
(5, 'IOS Game', 'Create IOS game, simple 2D game using objective-c. ', 'Development', 'The goal is to design, develop and release the app on IOS app store.', 'Hard', 13, 1253, 1, '2019-04-13 17:11:11', 1253),
(6, 'LInux OS', 'Create computer operating system based on Linux systems. ', 'Develop and test', 'The goal is to research methods of creating operating system, and develop and test operating system.  ', 'Hard', 22, 1253, 1, '2019-04-13 17:13:27', 1253),
(7, 'Traffic App', 'Develop and test traffic app, the app gets traffic data from an API ', 'Development', 'The goal is to develop and deploy the app.', 'Easy', 2, 1253, 1, '2019-04-13 17:59:38', 1253),
(8, 'Create Server', 'Create privet server system with C. ', 'Develop and test', 'The goal is to develop and deploy the system on Linux, ', 'Easy', 21, 1253, 1, '2019-04-13 18:01:19', 1253),
(9, 'Search Engine', 'Create search engine website.', 'Develop and test', 'The end goal of the project is develop basic implementation of search such as Google. ', 'Hard', 1, 1253, 1, '2019-04-13 17:03:14', 1253),
(10, 'Data Analysis ', 'Create data analysis system using paython', 'Develop and test', 'The goal is to develop a system for big data using machine learning.  ', 'Hard', 3, 1253, 1, '2019-04-13 18:05:19', 1253),
(11, 'Security system ', 'Security is the most important element in a system.', 'Experimental ', 'The goal is to research the importance of Security.', 'Easy', 15, 1253, 1, '2019-04-13 18:08:05', 1253),
(12, 'User interface ', 'The NHS requires new user interface for the online website. ', 'Design ', 'The goal is to design and implement new interface for NHS website.', 'Easy', 28, 1253, 1, '2019-04-13 18:09:49', 1253),
(13, 'Health System', 'Create new system for wearable device. ', 'Develop and test', 'The goal is to develop and test application that tracks users health, the application is to be developed for wearable devices such Apple watch.  ', 'Hard', 19, 1253, 1, '2019-04-13 18:13:39', 1253),
(14, 'image Recognition ', 'There are lots of images online is important to organise the images accordingly.  ', 'Development', 'The goal of the project is develop a system to organise images accordingly from internet source. ', 'Hard', 7, 1253, 1, '2019-04-13 18:41:36', 1253);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appoint_requests`
--
ALTER TABLE `appoint_requests`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `flag_table`
--
ALTER TABLE `flag_table`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `logindetails`
--
ALTER TABLE `logindetails`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `student_table`
--
ALTER TABLE `student_table`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `suggested_topics`
--
ALTER TABLE `suggested_topics`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `supervisor_courses`
--
ALTER TABLE `supervisor_courses`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `supervisor_table`
--
ALTER TABLE `supervisor_table`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `taken_projects`
--
ALTER TABLE `taken_projects`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `topics_table`
--
ALTER TABLE `topics_table`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appoint_requests`
--
ALTER TABLE `appoint_requests`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `flag_table`
--
ALTER TABLE `flag_table`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logindetails`
--
ALTER TABLE `logindetails`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `student_table`
--
ALTER TABLE `student_table`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=518;

--
-- AUTO_INCREMENT for table `suggested_topics`
--
ALTER TABLE `suggested_topics`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supervisor_courses`
--
ALTER TABLE `supervisor_courses`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `supervisor_table`
--
ALTER TABLE `supervisor_table`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1265;

--
-- AUTO_INCREMENT for table `taken_projects`
--
ALTER TABLE `taken_projects`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `topics_table`
--
ALTER TABLE `topics_table`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
