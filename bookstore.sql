-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 21, 2018 at 11:21 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.1.5

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

CREATE TABLE `authors` (
  `Author_id` int(11) NOT NULL,
  `Author_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`Author_id`, `Author_name`) VALUES
(1, 'T.Est'),
(2, 'A.Uthor');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `IdNo` int(11) NOT NULL,
  `Phone` varchar(12) DEFAULT NULL,
  `Password` varchar(12) NOT NULL,
  `Username` varchar(12) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Address` varchar(256) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Created_Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`IdNo`, `Phone`, `Password`, `Username`, `Email`, `Address`, `Name`, `Created_Date`) VALUES
(1, '123-456-7890', 'testword', 'testusername', 'testemail@test.com', '123 real street, state, zipcode', 'T.Est', '2018-04-01 00:00:00'),
(2, '111-111-1111', 'password', 'username', 'email@email.com', '1234 fake road, state, zip', 'Z.Boone', '2018-04-21 01:00:34'),
(3, '222-222-2222', 'password', 'testuser', 'test@test.com', '4321 fake road, state, zip', 'Z.Boo', '2018-04-21 01:21:38'),
(5, '333-333-3333', 'marksnotreal', 'markawesome', 'mark@fake.email', 'Mark lives in the mind', 'M.Ark', '2018-04-21 01:39:39'),
(6, '111-111-1111', 'password', 'user6', 'jim.bob@gmail.com', '123 street dr', 'Jim Bob', '2018-04-21 15:25:24'),
(7, '987-654-3210', 'dog27', 'alex.pass', 'alex.pass@gmail.com', '561 E. South Street', 'Alex Pass', '2018-04-21 15:28:17'),
(8, '644-645-5466', 'monkey289', 'thedude', 'thedude@gmail.com', '1000 Rug Ave.', 'The Dude', '2018-04-21 15:30:00'),
(9, '654-972-3871', 'heybrother', 'ripavicii', 'aviciifan223@gmail.com', '793 main st', 'Dan Smith', '2018-04-21 15:46:08'),
(10, '648-541-5789', 'whovian123', 'TheDoctor', 'galifrey@aol.com', '87 Smith Ln.', 'Mike Applebottom', '2018-04-21 15:49:06'),
(11, '546-972-3499', 'order66', 'theChosenOne', 'jedimaster4657@yahoo.com', '561 Broad St.', 'Matt Johnson', '2018-04-21 15:51:16'),
(12, '564-913-3189', 'sam&dean', 'yellowEye', 'menofletters@secret.org', '321 Bunker Dr.', 'Charles Crowley', '2018-04-21 15:56:28'),
(13, '666-333-9147', 'gryfindor11', 'dragonslayer', 'platform9&34ths@hoggwarts.edu', '253 Durrey Ln.', 'Harry Potter', '2018-04-21 15:57:25'),
(14, '546-799-3156', 'aldy214', 'Jame.A', 'James.A@gmail.com', '23 Shoe Dr.', 'James Aldridge', '2018-04-21 16:00:45'),
(15, '466-798-4687', '1qaz@WSX', 'Billy.Gates', 'Billy.Gates@microsoft.com', '23 Microsoft Ave.', 'Bill Gates', '2018-04-21 16:03:11'),
(16, '645-656-4321', 'lambo21', 'natyp', 'natyp@yahoo.com', '32 Stumpy Rd.', 'Natalie Katowski', '2018-04-21 16:05:35'),
(17, '468-381-7391', 'mrsnuffles', 'lovemycat', 'lovemycat212@gmail.com', '8087 Speedy Ct.', 'Tammy Linkler', '2018-04-21 16:07:30'),
(18, '546-554-5849', 'password1', 'tomrad', 'tomrad@gamil.com', '54852 Cats Pl.', 'Tom Conrad', '2018-04-21 17:25:37'),
(19, '456-465-5564', 'makonhs', 'jakethegreat', 'jakethegreat@yahoo.com', '908 Bike Trl Rd.', 'Jake Makon', '2018-04-21 17:32:56'),
(20, '867-234-8534', 'danworth421', 'jared.dan', 'jared.dan@aol.com', '7876 66th St W.', 'Jared Danworth', '2018-04-21 17:34:51');

-- --------------------------------------------------------

--
-- Table structure for table `customer_payments`
--

CREATE TABLE `customer_payments` (
  `payment_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` datetime NOT NULL,
  `Customer_id` int(11) NOT NULL,
  `Order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_payments`
--

INSERT INTO `customer_payments` (`payment_id`, `amount`, `date`, `Customer_id`, `Order_id`) VALUES
(1, 15.99, '2018-04-21 00:00:00', 10, 1),
(2, 9.99, '2018-04-21 00:00:00', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `directors`
--

CREATE TABLE `directors` (
  `Dir_id` int(11) NOT NULL,
  `Dir_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `directors`
--

INSERT INTO `directors` (`Dir_id`, `Dir_name`) VALUES
(1, 'T.Est'),
(2, 'D.Irector');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `Item_id` int(11) NOT NULL,
  `Subject_id` int(11) NOT NULL,
  `Description` varchar(256) DEFAULT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Item_image` varbinary(65000) DEFAULT NULL,
  `Author_id` int(11) DEFAULT NULL,
  `Pub_id` int(11) DEFAULT NULL,
  `Director_id` int(11) DEFAULT NULL,
  `Item_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`Item_id`, `Subject_id`, `Description`, `Price`, `Item_image`, `Author_id`, `Pub_id`, `Director_id`, `Item_type`) VALUES
(1, 1, 'Book one of the exciting legend series by A.Uthor', 15.99, '', 2, 1, NULL, 'book'),
(11111, 1, 'star wars fanfiction', 9.99, NULL, 2, NULL, NULL, '1'),
(22222, 2, 'treefiddy', 3.50, NULL, 2, NULL, NULL, '1'),
(33333, 3, 'Entered through form', 12.85, NULL, 1, NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Order_id` int(11) NOT NULL,
  `Staff_id` int(11) NOT NULL,
  `Payment_id` int(11) DEFAULT NULL,
  `Customer_id` int(11) NOT NULL,
  `Completion_date` datetime DEFAULT NULL,
  `Item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Order_id`, `Staff_id`, `Payment_id`, `Customer_id`, `Completion_date`, `Item_id`) VALUES
(1, 1234, NULL, 10, NULL, 1),
(2, 1235, NULL, 3, NULL, 11111);

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `Pub_id` int(11) NOT NULL,
  `Pub_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`Pub_id`, `Pub_name`) VALUES
(1, 'T.Est'),
(2, 'P.Ublisher');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `EIN` int(11) NOT NULL,
  `Phone` varchar(12) NOT NULL,
  `Position` varchar(20) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Address` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`EIN`, `Phone`, `Position`, `Name`, `Address`) VALUES
(1234, '987-311-6544', 'Manager', 'Chris Dieant', '908 MLK Blvd.'),
(1235, '548-951-2198', 'Store Clerk', 'Sarah Mathews', '54 Airport Rd.'),
(1236, '654-654-5564', 'Store Clerk', 'Mickie Johnson', '93332 Saddle Ct.');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `Subject_id` int(11) NOT NULL,
  `Subj_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`Subject_id`, `Subj_name`) VALUES
(1, 'Sci-Fi'),
(2, 'Adventure'),
(3, 'Psychological');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`Author_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`IdNo`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `customer_payments`
--
ALTER TABLE `customer_payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `Customer_id` (`Customer_id`),
  ADD KEY `Order_id` (`Order_id`);

--
-- Indexes for table `directors`
--
ALTER TABLE `directors`
  ADD PRIMARY KEY (`Dir_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`Item_id`),
  ADD KEY `Subject_id` (`Subject_id`),
  ADD KEY `Author_id` (`Author_id`),
  ADD KEY `Pub_id` (`Pub_id`),
  ADD KEY `Director_id` (`Director_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_id`),
  ADD KEY `Staff_id` (`Staff_id`),
  ADD KEY `Payment_id` (`Payment_id`),
  ADD KEY `Customer_id` (`Customer_id`),
  ADD KEY `Item_id` (`Item_id`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`Pub_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`EIN`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`Subject_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `Author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `IdNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `customer_payments`
--
ALTER TABLE `customer_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `directors`
--
ALTER TABLE `directors`
  MODIFY `Dir_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `Pub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `EIN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1237;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `Subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
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
