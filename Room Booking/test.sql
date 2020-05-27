-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2020 at 04:14 PM
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
('2020-05-25', '2020-05-26', 'class', '5', 'shravya', '09:00:00', '09:30:00'),
('2020-05-25', '2020-05-26', 'maths', '1', 'shravya', '10:00:00', '11:30:00'),
('2020-05-25', '2020-05-27', 'koj', '1', 'Jagruthi', '08:30:00', '11:30:00');

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

--
-- Dumping data for table `expiredbookings`
--

INSERT INTO `expiredbookings` (`dateofbooking`, `dateofevent`, `purpose`, `roomid`, `username`, `starttime`, `endtime`, `dateofcancellation`) VALUES
('2020-02-24', '2020-05-14', 'class', '1', 'xyz', '09:00:00', '10:00:00', NULL),
('2020-01-21', '2020-05-14', 'class', '1', 'abc', '13:00:00', '15:30:00', NULL),
('2020-02-10', '2020-05-14', 'jdbvb', '3', 'jagruthi', '08:00:00', '09:30:00', '2020-05-12'),
('2020-05-25', '2020-05-26', 'bb', '5', 'shravya', '09:30:00', '10:00:00', '2020-05-25'),
('2020-05-23', '2020-05-24', 'cgcgj', '4', 'shravya', '10:30:00', '12:00:00', NULL),
('2020-02-03', '2020-03-04', 'iok', '3', 'shravya', '08:30:00', '09:30:00', NULL),
('2020-03-04', '2020-03-05', 'ok', '3', 'shravya', '09:00:00', '09:30:00', NULL);

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
(7, '405', '1E', NULL),
(8, '302', '1B', NULL),
(9, '603', '1B', NULL);

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
('shravya', 'potti', 'shravya16097@gmail.com'),
('jagruthi', 'akka', 'cse180001021@gmail.com'),
('sneha', 'sneha', 'cse180001013@iiti.ac.in'),
('pulakitha', 'pullu', 'cse180001041@iiti.ac.in'),
('hanupriya', 'hanu', 'cse180001016@iiti.ac.in'),
('daddy', 'mummy', 'sarayu@gmail.com');

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
  MODIFY `roomid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
