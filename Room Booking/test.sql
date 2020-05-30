-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2020 at 08:19 PM
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
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `activebookings`
--

CREATE TABLE `activebookings` (
  `dateofbooking` varchar(20) DEFAULT NULL,
  `dateofevent` varchar(20) DEFAULT NULL,
  `purpose` varchar(100) DEFAULT NULL,
  `roomid` varchar(20) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `starttime` time DEFAULT NULL,
  `endtime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activebookings`
--

INSERT INTO `activebookings` (`dateofbooking`, `dateofevent`, `purpose`, `roomid`, `username`, `starttime`, `endtime`) VALUES
('2020-05-29', '2020-05-31', 'program', '5', 'shravya', '09:30:00', '12:30:00'),
('2020-05-29', '2020-05-30', 'maths class', '9', 'shravya', '08:30:00', '10:00:00'),
('2020-05-29', '2020-06-01', 'physics tutorial', '1', 'shravya', '11:00:00', '12:00:00'),
('2020-05-29', '2020-06-02', 'construction work', '3', 'shravya', '09:00:00', '11:30:00'),
('2020-05-29', '2020-05-30', 'project discussion', '2', 'Jagruthi', '09:30:00', '10:30:00'),
('2020-05-29', '2020-06-01', 'AI workshop', '8', 'Jagruthi', '09:00:00', '12:00:00'),
('2020-05-29', '2020-06-02', 'yoga session', '1', 'Jagruthi', '17:00:00', '18:00:00'),
('2020-05-29', '2020-05-31', 'talk on stress management', '2', 'sneha', '10:00:00', '10:30:00'),
('2020-05-29', '2020-06-02', 'CS208 class', '8', 'sneha', '11:00:00', '13:00:00'),
('2020-05-29', '2020-05-30', 'ma204 extra class', '4', 'pulakitha', '10:00:00', '11:00:00'),
('2020-05-29', '2020-06-01', 'talk on personality development', '3', 'pulakitha', '09:00:00', '09:30:00'),
('2020-05-29', '2020-06-02', 'dbms project submission', '1', 'pulakitha', '09:00:00', '11:30:00'),
('2020-05-29', '2020-05-30', 'paper distribution', '3', 'hanupriya', '12:00:00', '13:30:00'),
('2020-05-29', '2020-06-02', 'CP contest', '6', 'hanupriya', '16:30:00', '17:30:00'),
('2020-05-29', '2020-06-01', 'club interview', '4', 'hanupriya', '16:30:00', '17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `password`) VALUES
('admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `expiredbookings`
--

CREATE TABLE `expiredbookings` (
  `dateofbooking` varchar(20) DEFAULT NULL,
  `dateofevent` varchar(20) DEFAULT NULL,
  `purpose` varchar(100) DEFAULT NULL,
  `roomid` varchar(20) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `starttime` time DEFAULT NULL,
  `endtime` time DEFAULT NULL,
  `dateofcancellation` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `roomid` bigint(20) UNSIGNED NOT NULL,
  `roomno` varchar(10) DEFAULT NULL,
  `building` varchar(20) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`roomid`, `roomno`, `building`, `capacity`) VALUES
(1, '201', '1E', 69),
(2, '201', '1B', 270),
(3, '202', '1B', 180),
(4, '203', '1E', 70),
(5, '104', '1E', 140),
(6, '302', '1B', 40),
(7, '105', '1B', 100),
(8, '502', '1E', 70),
(9, '401', '1E', 40);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `email`) VALUES
('shravya', 'ramasahayam', 'cse180001052@iiti.ac.in'),
('jagruthi', 'patibandla', 'cse180001021@iiti.ac.in'),
('sneha', 'shree', 'cse180001013@iiti.ac.in'),
('pulakitha', 'rapolu', 'cse180001041@iiti.ac.in'),
('hanupriya', 'priya', 'cse180001016@iiti.ac.in'),
('', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`roomid`),
  ADD UNIQUE KEY `roomid` (`roomid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `roomid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `exxpiry` ON SCHEDULE EVERY 1 MINUTE STARTS '2020-05-25 19:40:34' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
INSERT INTO expiredbookings(`username`,`starttime`,`endtime`,`roomid`,`dateofbooking`,`dateofevent`,`purpose`) 
select `username`,`starttime`,`endtime`,`roomid`,`dateofbooking`,`dateofevent`,`purpose` from activebookings where dateofevent<CURDATE();
 DELETE from activebookings where dateofevent<curdate();
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
