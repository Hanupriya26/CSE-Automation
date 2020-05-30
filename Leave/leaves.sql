-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2020 at 08:24 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leaves`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_ID` varchar(30) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_ID`, `user_name`, `password`) VALUES
('admin', 'Priya', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `date` date NOT NULL,
  `user_ID` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `reason` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`date`, `user_ID`, `type`, `status`, `remarks`, `reason`) VALUES
('2020-06-04', 'cse180001013', 'casual', 'Disapproved', 'invalid reason', 'none'),
('2020-06-06', 'cse180001013', 'Educational', 'Approved', 'Valid', 'Exams'),
('2020-05-28', 'cse180001052@iiti.ac.in', 'Medical', 'Approved', 'Valid', 'Fever'),
('2020-05-29', 'cse180001052@iiti.ac.in', 'Medical', 'Approved', 'ok', 'Vomitings'),
('2020-06-02', 'cse180001052@iiti.ac.in', 'Travel', 'Approved', 'Acceptable', 'Vacation'),
('2020-06-06', 'cse180001052@iiti.ac.in', 'casual', 'Disapproved', 'unclear', 'Other work'),
('2020-06-06', 'cse180001021@iiti.ac.in', 'Emergency', 'Approved', 'Okay', 'Family');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_ID` varchar(30) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_ID`, `user_name`, `password`) VALUES
('cse180001021@iiti.ac.in', 'Jagruthi', 'patibandla'),
('cse180001052@iiti.ac.in', 'Shravya', 'ramasahayam'),
('cse180001013', 'Sneha', 'wow'),
('cse180001041@iiti.ac.in', 'pulakitha', 'rapolu'),
('cse180001016@iiti.ac.in', 'hanupriya', 'chitra');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
