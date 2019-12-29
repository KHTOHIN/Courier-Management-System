-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2017 at 05:50 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `couriermanagementsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(64) NOT NULL,
  `b_location` text NOT NULL,
  `b_phone` varchar(16) NOT NULL,
  `b_email` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `branch_name`, `b_location`, `b_phone`, `b_email`) VALUES
(1, 'Dhaka', 'Dhanmondi 32 Road Bridge, Dhanmondi Bridge, Dhaka', '32165498', 'dhaka@curier.dev'),
(2, 'Gaibandha ', 'Gaibandha Sadar Upazila', '6456456', 'Gaibandha@dev.local'),
(3, 'Rajshahi', 'Rajshahi Railway Station, Rajshahi', '5345345234', 'Rajshahi@dev.local'),
(4, 'Chapai Nawabganj', 'Chapai Nawabganj Bus Station, Boalia', '34534534', 'ChapaiNawabganj@dev.local');

-- --------------------------------------------------------

--
-- Table structure for table `courier_details`
--

CREATE TABLE `courier_details` (
  `courier_details_id` varchar(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courier_details`
--

INSERT INTO `courier_details` (`courier_details_id`, `payment_id`, `product_id`, `date`, `price`) VALUES
('SRP10002', 2, 1, '2017-11-18 06:56:53', 270);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `payment_type_name` varchar(64) NOT NULL,
  `payment_tax` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_type_name`, `payment_tax`) VALUES
(2, 'bKash', 50),
(3, 'Brac Bank', 4);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_type` varchar(64) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_weight` varchar(12) NOT NULL,
  `product_details` text NOT NULL,
  `se_id` int(11) NOT NULL,
  `re_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_type`, `product_name`, `product_weight`, `product_details`, `se_id`, `re_id`) VALUES
(1, 'etc', 'etc', '2', 'sensetive product. please be carefull', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sender_reciver`
--

CREATE TABLE `sender_reciver` (
  `se_re_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `phone` varchar(64) NOT NULL,
  `address` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sender_reciver`
--

INSERT INTO `sender_reciver` (`se_re_id`, `branch_id`, `name`, `email`, `phone`, `address`) VALUES
(1, 2, 'Arafat', '1000268@daffodil.ac', '+88 455778798098', 'fdfzdhdzh'),
(2, 1, 'Biplob', 'bilob@dev.local', '+88 4557787980982', 'ewrwqw');

-- --------------------------------------------------------

--
-- Table structure for table `shipment`
--

CREATE TABLE `shipment` (
  `shipment_id` int(11) NOT NULL,
  `curiour_id` varchar(11) NOT NULL,
  `s_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `location` varchar(64) NOT NULL,
  `status` varchar(64) NOT NULL DEFAULT 'Awaiting Approval',
  `note` varchar(64) NOT NULL DEFAULT 'shipment pending to approve '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipment`
--

INSERT INTO `shipment` (`shipment_id`, `curiour_id`, `s_date`, `location`, `status`, `note`) VALUES
(1, 'SRP10002', '2017-11-18 06:56:53', 'fdfzdhdzh', 'Awaiting Approval', 'shipment pending to approve '),
(2, 'SRP10002', '2017-11-18 07:01:37', 'Gaibandha', 'Approved', 'Processing'),
(3, 'SRP10002', '2017-11-18 07:07:34', 'GIbandha', 'Shipment Collected', 'shipmaetdfasdf');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` tinyint(4) NOT NULL,
  `fullname` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `pass` text NOT NULL,
  `role` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `pass`, `role`) VALUES
(2, 'Biplob Sarkar', 'biplob@dev.local', '$2y$10$/D9jpXkFVKgmo4NXyeyXDe8p0iFBaxxi0SQ26yC8Au.noQJL/yRSe', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `courier_details`
--
ALTER TABLE `courier_details`
  ADD PRIMARY KEY (`courier_details_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `sender_reciver`
--
ALTER TABLE `sender_reciver`
  ADD PRIMARY KEY (`se_re_id`);

--
-- Indexes for table `shipment`
--
ALTER TABLE `shipment`
  ADD PRIMARY KEY (`shipment_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sender_reciver`
--
ALTER TABLE `sender_reciver`
  MODIFY `se_re_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `shipment`
--
ALTER TABLE `shipment`
  MODIFY `shipment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
