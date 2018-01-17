-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 13, 2018 at 08:58 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bishal`
--

-- --------------------------------------------------------

--
-- Table structure for table `diary`
--

CREATE TABLE IF NOT EXISTS `diary` (
  `serial` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `emailid` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `mf` varchar(15) NOT NULL,
  `mob` varchar(10) NOT NULL,
  `emailid2` varchar(50) NOT NULL,
  `nation` varchar(30) NOT NULL,
  PRIMARY KEY (`serial`),
  UNIQUE KEY `emailid` (`emailid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `diary`
--

INSERT INTO `diary` (`serial`, `name`, `emailid`, `pass`, `dob`, `mf`, `mob`, `emailid2`, `nation`) VALUES
(1, 'Bishal Shaw', 'bishal@mymail.com', '123456789', '1996-09-12', 'male', '8274814482', 'ZENTACROSS001@GMAIL.COM', 'India');
