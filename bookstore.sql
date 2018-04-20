-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 20, 2018 at 12:34 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

DROP TABLE IF EXISTS `authors`;
CREATE TABLE IF NOT EXISTS `authors` (
  `Author_id` int(11) NOT NULL AUTO_INCREMENT,
  `Author_name` varchar(50) NOT NULL,
  PRIMARY KEY (`Author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `IdNo` int(11) NOT NULL AUTO_INCREMENT,
  `Phone` varchar(12) DEFAULT NULL,
  `Password` varchar(12) NOT NULL,
  `Username` varchar(12) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Address` varchar(256) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Created_Date` datetime NOT NULL,
  PRIMARY KEY (`IdNo`),
  UNIQUE KEY `Username` (`Username`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_payments`
--

DROP TABLE IF EXISTS `customer_payments`;
CREATE TABLE IF NOT EXISTS `customer_payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` decimal(10,2) NOT NULL,
  `date` datetime NOT NULL,
  `Customer_id` int(11) NOT NULL,
  `Order_id` int(11) NOT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `Customer_id` (`Customer_id`),
  KEY `Order_id` (`Order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `directors`
--

DROP TABLE IF EXISTS `directors`;
CREATE TABLE IF NOT EXISTS `directors` (
  `Dir_id` int(11) NOT NULL AUTO_INCREMENT,
  `Dir_name` varchar(50) NOT NULL,
  PRIMARY KEY (`Dir_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `Item_id` int(11) NOT NULL AUTO_INCREMENT,
  `Subject_id` int(11) NOT NULL,
  `Description` varchar(256) DEFAULT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Item_image` varbinary(65000) NOT NULL,
  `Author_id` int(11) DEFAULT NULL,
  `Pub_id` int(11) DEFAULT NULL,
  `Director_id` int(11) DEFAULT NULL,
  `Item_type` varchar(10) NOT NULL,
  PRIMARY KEY (`Item_id`),
  KEY `Subject_id` (`Subject_id`),
  KEY `Author_id` (`Author_id`),
  KEY `Pub_id` (`Pub_id`),
  KEY `Director_id` (`Director_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `Order_id` int(11) NOT NULL AUTO_INCREMENT,
  `Staff_id` int(11) NOT NULL,
  `Payment_id` int(11) NOT NULL,
  `Customer_id` int(11) NOT NULL,
  `Completion_date` datetime NOT NULL,
  `Item_id` int(11) NOT NULL,
  PRIMARY KEY (`Order_id`),
  KEY `Staff_id` (`Staff_id`),
  KEY `Payment_id` (`Payment_id`),
  KEY `Customer_id` (`Customer_id`),
  KEY `Item_id` (`Item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

DROP TABLE IF EXISTS `publishers`;
CREATE TABLE IF NOT EXISTS `publishers` (
  `Pub_id` int(11) NOT NULL AUTO_INCREMENT,
  `Pub_name` varchar(50) NOT NULL,
  PRIMARY KEY (`Pub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `EIN` int(11) NOT NULL AUTO_INCREMENT,
  `Phone` varchar(12) NOT NULL,
  `Position` varchar(20) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Address` varchar(256) NOT NULL,
  PRIMARY KEY (`EIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE IF NOT EXISTS `subject` (
  `Subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `Subj_name` varchar(50) NOT NULL,
  PRIMARY KEY (`Subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_payments`
--
ALTER TABLE `customer_payments`
  ADD CONSTRAINT `customer_payments_ibfk_1` FOREIGN KEY (`Customer_id`) REFERENCES `customers` (`IdNo`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `customer_payments_ibfk_2` FOREIGN KEY (`Order_id`) REFERENCES `orders` (`Order_id`) ON UPDATE NO ACTION;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`Subject_id`) REFERENCES `subject` (`Subject_id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `items_ibfk_2` FOREIGN KEY (`Author_id`) REFERENCES `authors` (`Author_id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `items_ibfk_3` FOREIGN KEY (`Pub_id`) REFERENCES `publishers` (`Pub_id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `items_ibfk_4` FOREIGN KEY (`Director_id`) REFERENCES `directors` (`Dir_id`) ON UPDATE NO ACTION;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`Customer_id`) REFERENCES `customers` (`IdNo`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`Payment_id`) REFERENCES `customer_payments` (`payment_id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`Item_id`) REFERENCES `items` (`Item_id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`Staff_id`) REFERENCES `staff` (`EIN`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
