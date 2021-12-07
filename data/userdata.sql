DROP TABLE IF EXISTS admin;
DROP TABLE IF EXISTS comment;
DROP TABLE IF EXISTS trails;
DROP TABLE IF EXISTS userImages;
DROP TABLE IF EXISTS users;

-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 09, 2017 at 08:05 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_sample`
--

-- --------------------------------------------------------




--
-- Table structure for table `admin`


-- --------------------------------------------------------
--

CREATE TABLE `admin` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
--

INSERT INTO `admin` (`username`, `password`) VALUES  ('paul', 'paul'),('hari','hari'),('bist','bist'),('dvader','p@ssw0rd');
-- --password t
-- ('hari', 'e358efa489f58062f10dd7316b65649e'),
-- --password y
-- ('bist', '415290769594460e2e485922904f345d');
-- --------------------------------------------------------

-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `cid` int(25) NOT NULL,
  `body` varchar(400) NOT NULL,
  `postid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `commentdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pic` bit NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `users` ADD `userID` INT NOT NULL AUTO_INCREMENT , ADD UNIQUE (`userID`); 
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `firstName`, `lastName`, `email`, `password`) VALUES
('dvader', 'darth', 'vader', 'vader@dark.force', 'p@ssw0rd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- --------------------------------------------------------

-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Table structure for table `trails post`
--

CREATE TABLE `trails` (
  `trailId` int(11)  NOT NULL AUTO_INCREMENT,
  `trailName` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`trailId`)
);

INSERT INTO `trails`(`trailName`, `description`) VALUES ('Myra Canyon Trestles','This 16km stretch will take you over 18 trestles and through two tunnels, all along the edge of a canyon with amazing views of Kelowna and Okanagan Lake. Since this trail was once part of a rail line it is virtually flat with no more than a 2% grade. ');
INSERT INTO `trails`(`trailName`, `description`) VALUES ('Knox Mountain Park ','Knox Mountain Park is better than ever, with new, mountain bike specific trails that range from fast and flowy wide-open singletrack to big jumps and steep, rocky descents.');
INSERT INTO `trails`(`trailName`, `description`) VALUES ('Myra-Bellevue Park','Myra-Bellevue Provincial Park offers cross country, all mountain and downhill as it bodes the largest network of trails in the Central Okanagan.');
INSERT INTO `trails`(`trailName`, `description`) VALUES ('Gillard', 'Gillard is a difficult and technically demanding downhill trail best suited for strong intermediate riders ');
INSERT INTO `trails`(`trailName`, `description`) VALUES ('Powers Creek','Another downhill trail that bodes a fun group of trails that follow the ridge high above Powers Creek Canyon. Great views and fast, flowy, descents.');


-- --------------------------------------------------------

--
ALTER TABLE `comment` ADD CONSTRAINT `postid` FOREIGN KEY (`postid`) REFERENCES `trails` (`trailId`) ON DELETE CASCADE ON UPDATE CASCADE;


-- Table structure for table `userImages`
--

CREATE TABLE `userImages` (
  `userID` int(11) NOT NULL,
  `contentType` varchar(255) NOT NULL,
  `image` blob NOT NULL,
  `destination` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--



--
-- Indexes for table `userImages`
--
ALTER TABLE `userImages`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `userID` (`userID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `userImages`
--
ALTER TABLE `userImages`
  ADD CONSTRAINT `userimages_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;