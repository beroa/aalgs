-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: db589593745.db.1and1.com
-- Generation Time: Nov 06, 2018 at 01:07 PM
-- Server version: 5.5.60-0+deb7u1-log
-- PHP Version: 7.0.30-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db589593745`
--

-- --------------------------------------------------------

--
-- Table structure for table `roster`
--

CREATE TABLE `roster` (
  `rowid` int(10) UNSIGNED NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `ramid` char(13) NOT NULL,
  `email` varchar(80) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `role` varchar(10) NOT NULL,
  `password` varchar(80) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roster`
--

INSERT INTO `roster` (`rowid`, `lastname`, `firstname`, `ramid`, `email`, `userid`, `role`, `password`, `status`) VALUES
(1, 'Berotti', 'Alan', '', 'beroa@farmingdale.edu ', 'beroa ', 'Student', 'beroa', 1),
(3, 'Ceraldi', 'Mary Beth', '', 'ceram@farmingdale.edu', 'ceram ', 'Student', 'T1meT0GetUp2', 1),
(4, 'Gallucci', 'Christian', '', 'gallc4@farmingdale.edu ', 'gallc4 ', 'Student', 'gallc4', 1),
(6, 'Gondal', 'Usman', '', 'gondum@farmingdale.edu ', 'gondum ', 'Student', 'gondum', 1),
(7, 'Kaplan', 'Charles', '', 'kaplancr@farmingdale.edu ', 'kaplancr ', 'Faculty', 'K@plan01', 1),
(8, 'Macer', 'Yousef', '', 'maceya@farmingdale.edu ', 'maceya ', 'Student', 'maceya', 1),
(9, 'McKenzie', 'Takisha', '', 'mcket@farmingdale.edu', 'mcket ', 'Student', '33322331', 1),
(10, 'Meister', 'James', '', 'meisjj@farmingdale.edu', 'meisjj ', 'Student', '603246', 1),
(11, 'Mustafa', 'Yasman', '', 'musty@farmingdale.edu', 'musty ', 'Student', 'ym310684', 1),
(12, 'Nazir Choudhary', 'Waqar', '', 'naziw@farmingdale.edu ', 'naziw ', 'Student', 'naziw', 1),
(13, 'Rademacher', 'Steven', '', 'radese@farmingdale.edu', 'radese ', 'Student', 'Bulldawg89', 1),
(16, 'Reina', 'Andrew', '', 'reinas@farmingdale.edu', 'reinas ', 'Student', 'JoeyJohn14', 1),
(17, 'Rydberg', 'Christopher', '', 'rydbcr@farmingdale.edu ', 'rydbcr ', 'Student', 'rydbcr', 1),
(19, 'Yaqoob', 'Saad', '', 'yaqos@farmingdale.edu ', 'yaqos ', 'Student', 'yaqos', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `roster`
--
ALTER TABLE `roster`
  ADD PRIMARY KEY (`rowid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `roster`
--
ALTER TABLE `roster`
  MODIFY `rowid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
