-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 22, 2018 at 02:02 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ais`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', '5c428d8875d2948607f3e3fe134d71b4', '2017-10-30 11:42:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_departments`
--

DROP TABLE IF EXISTS `tbl_departments`;
CREATE TABLE IF NOT EXISTS `tbl_departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `DepartmentName` varchar(150) NOT NULL,
  `DepartmentShortName` varchar(100) NOT NULL,
  `DepartmentCode` varchar(50) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_departments`
--

INSERT INTO `tbl_departments` (`id`, `DepartmentName`, `DepartmentShortName`, `DepartmentCode`, `CreationDate`) VALUES
(5, 'Computer Centre & Networking', 'CCN', 'CCN01', '2018-06-21 04:44:43'),
(6, 'Information Liaison & Training', 'ILT', 'ILT01', '2018-06-26 08:27:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employees`
--

DROP TABLE IF EXISTS `tbl_employees`;
CREATE TABLE IF NOT EXISTS `tbl_employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `EmpId` varchar(100) NOT NULL,
  `FirstName` varchar(150) NOT NULL,
  `LastName` varchar(150) NOT NULL,
  `EmailId` varchar(200) NOT NULL,
  `Password` varchar(180) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `Dob` varchar(100) NOT NULL,
  `Department` varchar(255) NOT NULL,
  `DOJ` varchar(100) NOT NULL,
  `DOE` varchar(100) NOT NULL,
  `Reportingofficer` varchar(200) NOT NULL,
  `Project` varchar(200) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `City` varchar(200) NOT NULL,
  `Country` varchar(150) NOT NULL,
  `Phonenumber` char(11) NOT NULL,
  `Status` int(1) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `EmpId` (`EmpId`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_employees`
--

INSERT INTO `tbl_employees` (`id`, `EmpId`, `FirstName`, `LastName`, `EmailId`, `Password`, `Gender`, `Dob`, `Department`, `DOJ`, `DOE`, `Reportingofficer`, `Project`, `Address`, `City`, `Country`, `Phonenumber`, `Status`, `RegDate`) VALUES
(6, 'asdas', 'asdsa', 'sdsa', 'aaa@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Male', '6 June, 2018', 'Computer Centre & Networking', '16 June, 2018', '30 June, 2018', 'asdsadasd', 'asdasdsa', 'asdasdasd', 'asdsadas', 'asdsad', 'sadsadasds', 1, '2018-06-26 04:18:22'),
(7, 'EMP6272', 'Atul', 'Aman', 'atul@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Male', '19 January, 1997', 'Computer Centre & Networking', '14 June, 2018', '31 July, 2018', 'SSSSSS', 'SSSSSSS', 'Shalimar Bagh', 'Delhi', 'India', '1151153254', 1, '2018-06-26 10:57:59'),
(8, 'EMP6708', 'Aman', 'A', 'aman@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Male', '7 June, 2018', 'Information Liaison & Training', '19 June, 2018', '30 June, 2018', 'aadaa', 'aaaaa', 'nbyubjnjnmn', 'delhi', 'india', '1548124595', 1, '2018-06-29 08:18:49'),
(9, 'EMP007', 'Ramesh', 'Singh', 'ramesh007@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Male', '2 July, 1989', 'Information Liaison & Training', '14 June, 2018', '26 July, 2018', 'SSSSSSSSS', 'ELMS', 'HaiderPur', 'New Delhi', 'India', '8375836336', 1, '2018-07-10 05:04:10'),
(11, 'EMP008', 'Atul', 'Aman', 'atulaman6272@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Male', '19 January, 1997', 'Computer Centre & Networking', '14 June, 2018', '26 July, 2018', 'Sh. Mariappan', 'Attendance Information System', 'Shalimar Bagh', 'New Delhi', 'India', '8375836336', 1, '2018-07-17 05:02:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_in_time_attendance`
--

DROP TABLE IF EXISTS `tbl_in_time_attendance`;
CREATE TABLE IF NOT EXISTS `tbl_in_time_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `EmpId` varchar(100) NOT NULL,
  `intime` time NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `EmpId` (`EmpId`),
  KEY `EmpId_2` (`EmpId`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_in_time_attendance`
--

INSERT INTO `tbl_in_time_attendance` (`id`, `EmpId`, `intime`, `date`) VALUES
(2, 'EMP6272', '09:12:01', '2018-06-28'),
(3, 'EMP6272', '09:04:16', '2018-07-05'),
(12, 'EMP6272', '09:13:33', '2018-07-06'),
(51, 'EMP6272', '09:38:58', '2018-07-09'),
(68, 'EMP007', '16:29:59', '2018-07-10'),
(69, 'EMP6272', '16:42:55', '2018-07-10'),
(70, 'EMP007', '14:16:47', '2018-07-11'),
(71, 'EMP6272', '14:29:26', '2018-07-11'),
(72, 'EMP008', '10:36:11', '2018-07-17'),
(73, 'EMP008', '16:54:47', '2018-07-20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_out_time_attendance`
--

DROP TABLE IF EXISTS `tbl_out_time_attendance`;
CREATE TABLE IF NOT EXISTS `tbl_out_time_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `EmpId` varchar(100) NOT NULL,
  `outtime` time NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `EmpId` (`EmpId`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_out_time_attendance`
--

INSERT INTO `tbl_out_time_attendance` (`id`, `EmpId`, `outtime`, `date`) VALUES
(1, 'EMP6272', '17:27:53', '2018-06-28'),
(3, 'EMP6272', '17:27:53', '2018-07-05'),
(5, 'EMP6272', '17:27:53', '2018-07-06'),
(6, 'EMP6272', '17:27:53', '2018-07-09'),
(13, 'EMP007', '21:33:52', '2018-07-10'),
(14, 'EMP007', '14:16:53', '2018-07-11'),
(15, 'EMP6272', '14:29:39', '2018-07-11'),
(16, 'EMP008', '17:34:09', '2018-07-17'),
(17, 'EMP008', '16:54:59', '2018-07-20');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_in_time_attendance`
--
ALTER TABLE `tbl_in_time_attendance`
  ADD CONSTRAINT `tbl_in_time_attendance_ibfk_1` FOREIGN KEY (`EmpId`) REFERENCES `tbl_employees` (`EmpId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_out_time_attendance`
--
ALTER TABLE `tbl_out_time_attendance`
  ADD CONSTRAINT `tbl_out_time_attendance_ibfk_1` FOREIGN KEY (`EmpId`) REFERENCES `tbl_employees` (`EmpId`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
