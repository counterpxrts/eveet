-- phpMyAdmin SQL Dump
-- version 4.7.8
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 06, 2018 at 11:18 AM
-- Server version: 10.2.13-MariaDB
-- PHP Version: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eveet`
--
CREATE DATABASE IF NOT EXISTS `eveet` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `eveet`;

-- --------------------------------------------------------

--
-- Table structure for table `Attending`
--

DROP TABLE IF EXISTS `Attending`;
CREATE TABLE `Attending` (
  `AttendingID` int(255) NOT NULL,
  `EventID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Event`
--

DROP TABLE IF EXISTS `Event`;
CREATE TABLE `Event` (
  `EventID` int(255) NOT NULL,
  `EventName` varchar(255) NOT NULL,
  `HostID` int(255) NOT NULL,
  `EventLocation` varchar(255) NOT NULL,
  `EventDate` date NOT NULL,
  `EventTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Host`
--

DROP TABLE IF EXISTS `Host`;
CREATE TABLE `Host` (
  `HostUserID` int(11) NOT NULL,
  `HostUserFullName` varchar(255) NOT NULL,
  `HostUserLocation` varchar(255) NOT NULL,
  `HostUserEmail` varchar(255) NOT NULL,
  `HostUserPassword` varchar(255) NOT NULL,
  `HostUserName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Interested`
--

DROP TABLE IF EXISTS `Interested`;
CREATE TABLE `Interested` (
  `InterestedID` int(255) NOT NULL,
  `EventID` int(255) NOT NULL,
  `UserID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
CREATE TABLE `User` (
  `UserID` int(255) NOT NULL,
  `UserFullName` varchar(255) NOT NULL,
  `UserLocation` varchar(255) NOT NULL,
  `UserGender` tinyint(1) DEFAULT NULL,
  `UserDOB` varchar(255) NOT NULL,
  `UserEmail` varchar(255) NOT NULL,
  `UserPassword` varchar(255) NOT NULL,
  `UserName` varchar(20) NOT NULL,
  `UserDescription` text NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Attending`
--
ALTER TABLE `Attending`
  ADD PRIMARY KEY (`AttendingID`);

--
-- Indexes for table `Event`
--
ALTER TABLE `Event`
  ADD PRIMARY KEY (`EventID`);

--
-- Indexes for table `Host`
--
ALTER TABLE `Host`
  ADD PRIMARY KEY (`HostUserID`);

--
-- Indexes for table `Interested`
--
ALTER TABLE `Interested`
  ADD PRIMARY KEY (`InterestedID`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Attending`
--
ALTER TABLE `Attending`
  MODIFY `AttendingID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Event`
--
ALTER TABLE `Event`
  MODIFY `EventID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Host`
--
ALTER TABLE `Host`
  MODIFY `HostUserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Interested`
--
ALTER TABLE `Interested`
  MODIFY `InterestedID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `UserID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
