-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2025 at 04:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookmyticket`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `adminname` varchar(100) NOT NULL,
  `adminpw` varchar(100) NOT NULL,
  `mobileno` varchar(20) NOT NULL,
  `code` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `adminname`, `adminpw`, `mobileno`, `code`) VALUES
(1, 'maharaja', '   ', '9876543211', 6698);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `cityid` int(11) NOT NULL,
  `cityname` varchar(255) NOT NULL,
  `imagefilename` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`cityid`, `cityname`, `imagefilename`) VALUES
(1, 'Chennai', 'chen.png'),
(2, 'Mumbai', 'mumbai.png');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `movieid` int(11) NOT NULL,
  `moviename` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `languages` varchar(255) NOT NULL,
  `years` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `poster` varchar(255) NOT NULL,
  `timg` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`movieid`, `moviename`, `duration`, `languages`, `years`, `city`, `poster`, `timg`) VALUES
(1, 'Raayan', '145', 'Tamil', '2024', 'Chennai', 'Rayanimg.png', 'raayant.png'),
(2, 'Indian2', '180', 'Tamil', '2024', 'Chennai', 'Indian2zd.png', 'indian2t.png'),
(3, 'Boat', '125', 'Tamil', '2024', 'Chennai', 'Boat.png', 'boatt.png'),
(4, 'Maharaja', '142', 'Tamil', '2024', 'Chennai', 'Maharaja.png', 'maharajat.png'),
(5, 'Kalki 2898 AD', '181', 'Telugu', '2024', 'Chennai', 'Kalki2898.png', 'kalkit.png'),
(6, 'Deadpool & Wolverine', '135', 'English', '2024', 'Chennai', 'Dead.png', 'deadpoolt.png'),
(7, 'Deadpool & Wolverine', '135', 'English', '2024', 'Mumbai', 'Dead.png', 'deadpoolt.png');

-- --------------------------------------------------------

--
-- Table structure for table `screens`
--

CREATE TABLE `screens` (
  `screenid` int(11) NOT NULL,
  `theatreid` int(11) NOT NULL,
  `screenname` varchar(100) NOT NULL,
  `seats` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `screens`
--

INSERT INTO `screens` (`screenid`, `theatreid`, `screenname`, `seats`, `price`) VALUES
(1, 1, 'Screen1', 300, 200),
(2, 1, 'Screen2', 250, 150),
(3, 2, '4K Dolpy Atmos', 500, 200);

-- --------------------------------------------------------

--
-- Table structure for table `showtime`
--

CREATE TABLE `showtime` (
  `showtimeid` int(11) NOT NULL,
  `screenid` int(11) NOT NULL,
  `showname` varchar(100) NOT NULL,
  `starttime` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `showtime`
--

INSERT INTO `showtime` (`showtimeid`, `screenid`, `showname`, `starttime`) VALUES
(1, 1, 'Morning', '10:30:00'),
(2, 1, 'Afternoon', '14:30:00'),
(3, 1, 'Evening', '18:30:00'),
(4, 1, 'Night', '22:30:00'),
(5, 2, 'Morning', '10:30:00'),
(6, 2, 'Afternoon', '13:30:00'),
(7, 2, 'Evening', '16:30:00'),
(8, 2, 'Night', '19:30:00'),
(9, 2, 'Others', '22:30:00'),
(10, 3, 'Morning', '10:30:00'),
(11, 3, 'Afternoon', '14:30:00'),
(12, 3, 'Evening', '18:30:00'),
(13, 3, 'Night', '22:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `theatres`
--

CREATE TABLE `theatres` (
  `theatreid` int(11) NOT NULL,
  `theatrename` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `place` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `pincode` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `theatres`
--

INSERT INTO `theatres` (`theatreid`, `theatrename`, `address`, `place`, `state`, `pincode`, `username`, `password`) VALUES
(1, 'AGS Cinemas', 'T.Nagar', 'Chennai', 'TamilNadu', '600017', 'agstnagar', 'agstnagar'),
(2, 'Kamala Cinemas', 'Vadapalani', 'Chennai', 'TamilNadu', '600026', 'kamalavp', 'kamalavp'),
(3, 'AGS Cinemas', 'Villivakkam', 'Chennai', 'TamilNadu', '600049', 'agsvv', 'agsvv'),
(4, 'INOX National', 'Arcot Road', 'Chennai', 'TamilNadu', '600092', 'inoxnational', 'inoxnational'),
(5, 'PVR: Grand Mall', 'Velachery', 'Chennai', 'TamilNadu', '600042', 'pvrgmall', 'pvrgmall');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticketid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `bmtid` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `notickets` int(11) NOT NULL,
  `seats` varchar(100) NOT NULL,
  `showid` int(11) NOT NULL,
  `screenid` int(11) NOT NULL,
  `theatreid` int(11) NOT NULL,
  `ticketdate` date NOT NULL,
  `cdate` date NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticketid`, `name`, `bmtid`, `email`, `notickets`, `seats`, `showid`, `screenid`, `theatreid`, `ticketdate`, `cdate`, `amount`) VALUES
(1, 'Madhankumar', 2, 'madhan2003@gmail.com', 10, 'A1, A2, A3, A4, A5, A6, A7, A8, A9, A10', 1, 1, 1, '2024-04-14', '2024-04-14', 2000),
(2, 'Karthick', 1, 'karthi2003@gmail.com', 10, 'D71, D72, D73, D74, D75, D76, D77, D78, D79, D80', 1, 1, 1, '2024-04-14', '2024-04-14', 2000),
(3, 'kavinkumar', 3, 'kavin2003@gmail.com', 4, 'C49, C50, C51, C52', 1, 1, 1, '2024-04-14', '2024-04-14', 800),
(4, 'kavinkumar', 3, 'kavin2003@gmail.com', 3, 'A4, A5, A6', 2, 1, 1, '2024-04-14', '2024-04-14', 600),
(5, 'kavinkumar', 3, 'kavin2003@gmail.com', 3, 'A4, A5, A6', 6, 2, 1, '2024-04-15', '2024-04-14', 900),
(16, 'Karthick', 1, 'karthi2003@gmail.com', 10, 'E86, E87, E88, E89, E90, E91, E92, E93, E94, E95', 1, 1, 1, '2024-04-18', '2024-04-18', 2000),
(15, 'Karthick', 1, 'karthi2003@gmail.com', 5, 'C47, C48, C49, C50, C51', 1, 1, 1, '2024-04-18', '2024-04-18', 1000),
(14, 'Karthick', 1, 'karthi2003@gmail.com', 4, 'A1, A2, A3, A4', 1, 1, 1, '2024-04-18', '2024-04-18', 800),
(17, 'Karthick', 1, 'karthi2003@gmail.com', 2, 'A6, A8', 1, 1, 1, '2024-07-30', '2024-07-30', 400),
(18, 'Karthick', 1, 'karthi2003@gmail.com', 6, 'A1, A2, A3, A4, A5, A6', 4, 1, 1, '2024-07-30', '2024-07-30', 1200),
(19, 'Karthick', 1, 'karthi2003@gmail.com', 3, 'A7, A8, A9', 15, 1, 1, '2024-07-31', '2024-07-31', 600),
(20, 'Karthick', 1, 'karthi2003@gmail.com', 4, 'F108, F109, F110, F111', 13, 1, 1, '2024-07-31', '2024-07-31', 800),
(21, 'Karthick', 1, 'karthi2003@gmail.com', 2, 'A1, A2', 14, 1, 1, '2024-07-31', '2024-07-31', 400),
(22, 'Karthick', 1, 'karthi2003@gmail.com', 4, 'C47, C48, C49, C50', 15, 1, 1, '2024-07-31', '2024-07-31', 800),
(23, 'Karthick', 1, 'karthi2003@gmail.com', 3, 'A3, A4, A5', 14, 1, 1, '2024-07-31', '2024-07-31', 600),
(24, 'Karthick', 1, 'karthi2003@gmail.com', 2, 'A1, A2', 16, 2, 1, '2024-07-31', '2024-07-31', 600),
(25, 'thiru', 8, 'thiru12@gmail.com', 1, 'A12', 15, 1, 1, '2024-07-31', '2024-07-31', 200),
(26, 'thiru', 8, 'thiru12@gmail.com', 2, 'B25, B26', 14, 1, 1, '2024-07-31', '2024-07-31', 400),
(27, 'thiru', 8, 'thiru12@gmail.com', 2, 'A1, A2', 14, 1, 1, '2024-08-01', '2024-07-31', 400),
(28, 'maharaja', 10, 'maharaja32@gmail.com', 4, 'M241, M242, M243, M244', 14, 1, 1, '2024-07-31', '2024-07-31', 800),
(29, 'AKALYA', 11, 'maharaja32@gmail.com', 2, 'D72, D73', 15, 1, 1, '2024-07-31', '2024-07-31', 400),
(30, 'Karthick', 1, 'karthi2003@gmail.com', 10, 'H146, H147, H148, H149, H150, H151, H152, H153, H154, H155', 4, 1, 1, '2024-08-01', '2024-07-31', 2000),
(31, 'maharaja', 10, 'maharaja32@gmail.com', 2, 'A1, A2', 1, 1, 1, '2024-08-01', '2024-08-01', 400),
(32, 'maharaja', 10, 'maharaja32@gmail.com', 1, 'B23', 1, 1, 1, '2024-08-01', '2024-08-01', 200),
(33, 'maharaja', 10, 'maharaja32@gmail.com', 2, 'B25, B26', 1, 1, 1, '2024-08-01', '2024-08-01', 400),
(34, 'raja', 12, 'maharaja32@gmail.com', 2, 'A7, A8', 1, 1, 1, '2024-08-01', '2024-08-01', 400),
(35, 'raja', 12, 'maharaja32@gmail.com', 2, 'A7, A8', 1, 1, 1, '2024-08-01', '2024-08-01', 400),
(36, 'maharajas', 13, 'maharaja32@gmail.com', 4, 'A3, A4, A5, A6', 1, 1, 1, '2024-08-01', '2024-08-01', 800),
(37, 'maharajas', 13, 'maharaja32@gmail.com', 4, 'A1, A2, A3, A4', 4, 1, 1, '2024-08-02', '2024-08-01', 800),
(38, 'maharaja', 10, 'maharaja32@gmail.com', 3, 'B29, B30, B31', 1, 1, 1, '2024-08-01', '2024-08-01', 600),
(39, 'maharaja', 10, 'maharaja32@gmail.com', 2, 'A5, A6', 3, 1, 1, '2024-08-01', '2024-08-01', 400),
(40, 'maharaja', 10, 'maharaja32@gmail.com', 1, 'M245', 5, 2, 1, '2024-08-01', '2024-08-01', 150),
(41, 'maharaja', 10, 'maharaja32@gmail.com', 3, 'C53, C54, C55', 1, 1, 1, '2024-08-01', '2024-08-01', 600),
(42, 'Karthick', 1, 'karthi2003@gmail.com', 4, 'A7, A8, A9, A10', 1, 1, 1, '2024-10-14', '2024-10-13', 800),
(43, 'AdhipanNS', 14, 'chola@gmail.com', 4, 'B27, B28, B29, B30', 1, 1, 1, '2024-10-17', '2024-10-17', 800),
(44, 'AdhipanNS', 14, 'chola@gmail.com', 4, 'C48, C49, C50, C51', 4, 1, 1, '2025-02-16', '2025-02-16', 800),
(45, 'AdhipanNS', 14, 'chola@gmail.com', 2, 'E89, E90', 4, 1, 1, '2025-02-16', '2025-02-16', 400),
(46, 'AdhipanNS', 14, 'chola@gmail.com', 2, 'E89, E90', 4, 1, 1, '2025-02-16', '2025-02-16', 400);

-- --------------------------------------------------------

--
-- Table structure for table `tmovie`
--

CREATE TABLE `tmovie` (
  `tmovieid` int(11) NOT NULL,
  `movieid` int(11) NOT NULL,
  `theatreid` int(11) NOT NULL,
  `moviename` varchar(100) NOT NULL,
  `releasedate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tmovie`
--

INSERT INTO `tmovie` (`tmovieid`, `movieid`, `theatreid`, `moviename`, `releasedate`) VALUES
(1, 1, 1, 'Raayan', '2024-07-31'),
(4, 2, 1, 'Indian2', '2024-08-01'),
(3, 1, 2, 'Raayan', '2024-07-31');

-- --------------------------------------------------------

--
-- Table structure for table `tshows`
--

CREATE TABLE `tshows` (
  `showid` int(11) NOT NULL,
  `showtimeid` int(11) NOT NULL,
  `theatreid` int(11) NOT NULL,
  `movieid` int(11) NOT NULL,
  `startdate` date NOT NULL,
  `status` int(11) NOT NULL,
  `rstatus` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tshows`
--

INSERT INTO `tshows` (`showid`, `showtimeid`, `theatreid`, `movieid`, `startdate`, `status`, `rstatus`) VALUES
(1, 1, 1, 1, '2024-07-31', 1, 0),
(2, 2, 1, 1, '2024-07-31', 1, 0),
(3, 3, 1, 1, '2024-07-31', 1, 0),
(4, 4, 1, 1, '2024-07-31', 1, 0),
(5, 5, 1, 2, '2024-07-31', 1, 0),
(6, 6, 1, 2, '2024-07-31', 1, 0),
(7, 7, 1, 2, '2024-07-31', 1, 0),
(8, 8, 1, 2, '2024-07-31', 1, 0),
(9, 9, 1, 2, '2024-07-31', 1, 0),
(10, 10, 2, 1, '2024-07-31', 1, 0),
(11, 11, 2, 1, '2024-07-31', 1, 0),
(12, 12, 2, 1, '2024-07-31', 1, 0),
(13, 13, 2, 1, '2024-07-31', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `pw` varchar(100) NOT NULL,
  `code` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `username`, `email`, `mobile`, `pw`, `code`) VALUES
(1, 'Karth', 'ick', 'Karthick', 'karthi2003@gmail.com', '9025508658', 'karthi2003', 5004),
(2, 'Madhan', 'kumar', 'Madhankumar', 'madhan2003@gmail.com', '9025581779', 'madhankumar', 5171),
(3, 'kavin', 'kumar', 'kavinkumar', 'kavin2003@gmail.com', '9514064308', 'kavinniro', 3860),
(4, 'alagesh', 'waran', 'alageshwaran', 'alagesh2004@gmail.com', '9342621906', 'alageshwaran', 6617),
(8, 'thir', 'u', 'thiru', 'thiru12@gmail.com', '9876543233', 'thiru', 0),
(6, 'hari', 'hari', 'harihari', 'hari@gmail.com', '9843977949', '12345', 3211),
(10, 'maharaj', 'a', 'maharaja', 'maharaja32@gmail.com', '9876543211', '   ', 0),
(11, 'AKALY', 'A', 'AKALYA', 'maharaja32@gmail.com', '9876543211', '123456789', 0),
(12, 'raj', 'a', 'raja', 'maharaja32@gmail.com', '9876543211', '    ', 0),
(13, 'maharaja', 's', 'maharajas', 'maharaja32@gmail.com', '9876543211', '     ', 0),
(14, 'Adhipan', 'NS', 'AdhipanNS', 'chola@gmail.com', '9876543211', 'ns200', 0),
(15, 'Mari', 'kumar', 'Marikumar', 'marikumar3248@gmail.com', '9025581779', 'mari2005', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`cityid`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`movieid`);

--
-- Indexes for table `screens`
--
ALTER TABLE `screens`
  ADD PRIMARY KEY (`screenid`);

--
-- Indexes for table `showtime`
--
ALTER TABLE `showtime`
  ADD PRIMARY KEY (`showtimeid`);

--
-- Indexes for table `theatres`
--
ALTER TABLE `theatres`
  ADD PRIMARY KEY (`theatreid`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticketid`);

--
-- Indexes for table `tmovie`
--
ALTER TABLE `tmovie`
  ADD PRIMARY KEY (`tmovieid`);

--
-- Indexes for table `tshows`
--
ALTER TABLE `tshows`
  ADD PRIMARY KEY (`showid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `cityid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `movieid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `screens`
--
ALTER TABLE `screens`
  MODIFY `screenid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `showtime`
--
ALTER TABLE `showtime`
  MODIFY `showtimeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `theatres`
--
ALTER TABLE `theatres`
  MODIFY `theatreid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticketid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tmovie`
--
ALTER TABLE `tmovie`
  MODIFY `tmovieid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tshows`
--
ALTER TABLE `tshows`
  MODIFY `showid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
