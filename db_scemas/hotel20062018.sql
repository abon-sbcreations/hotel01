-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2018 at 07:46 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel01`
--

-- --------------------------------------------------------

--
-- Table structure for table `hotel_room_item`
--

CREATE TABLE `hotel_room_item` (
  `hotel_room_item_id` int(4) NOT NULL,
  `hotel_room_item_brand` varchar(64) DEFAULT NULL,
  `hotel_room_item_size` varchar(32) DEFAULT NULL,
  `hotel_room_item_weight` varchar(32) DEFAULT NULL,
  `is_item_reuseable` enum('Y','N') DEFAULT NULL,
  `is_item_available` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room_item_master`
--

CREATE TABLE `room_item_master` (
  `room_item_id` int(4) NOT NULL,
  `room_item_cat` varchar(128) DEFAULT NULL,
  `room_item_subcat` varchar(128) DEFAULT NULL,
  `room_item_name` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_item_master`
--

INSERT INTO `room_item_master` (`room_item_id`, `room_item_cat`, `room_item_subcat`, `room_item_name`) VALUES
(1, 'c2', 'c24', 'item01'),
(3, 'c2', 'c21', 'item03'),
(4, 'c2', 'c22', 'item04'),
(7, 'c2', 'c24', 'item04'),
(14, 'c3', 'c33', 'item001');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_amenities_master`
--

CREATE TABLE `tbl_amenities_master` (
  `amenity_id` int(3) NOT NULL,
  `amenity_name` varchar(32) DEFAULT NULL,
  `amenity_desc` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_amenities_master`
--

INSERT INTO `tbl_amenities_master` (`amenity_id`, `amenity_name`, `amenity_desc`) VALUES
(1, 'facility01', 'facility 01'),
(2, 'facility02', 'facility 02'),
(3, 'facility03', 'facility 03'),
(4, 'facility04', 'facility 04'),
(5, 'facility05', 'facility 05'),
(6, 'facility06', 'facility 06'),
(7, 'facility07', 'facility 07'),
(8, 'facility0-8', 'facility 08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hotel_master`
--

CREATE TABLE `tbl_hotel_master` (
  `hotel_id` int(4) NOT NULL,
  `hotel_name` varchar(64) DEFAULT NULL,
  `hotel_type` varchar(16) DEFAULT NULL,
  `hotel_address` varchar(255) DEFAULT NULL,
  `hotel_reg_number` varchar(32) DEFAULT NULL,
  `hotel_gst_number` varchar(32) DEFAULT NULL,
  `hotel_check_in_time` varchar(16) DEFAULT NULL,
  `hotel_check_out_time` varchar(16) DEFAULT NULL,
  `hotel_has_restaurant` enum('Y','N') DEFAULT NULL,
  `hotel_has_bar` enum('Y','N') DEFAULT NULL,
  `hotel_reg_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_hotel_master`
--

INSERT INTO `tbl_hotel_master` (`hotel_id`, `hotel_name`, `hotel_type`, `hotel_address`, `hotel_reg_number`, `hotel_gst_number`, `hotel_check_in_time`, `hotel_check_out_time`, `hotel_has_restaurant`, `hotel_has_bar`, `hotel_reg_date`) VALUES
(1, 'hotel01', '1*', 'hotel address1', '1', '1', '10:00', '22:00', 'Y', 'N', '2018-06-01 00:00:00'),
(2, 'hotel02', '2*', 'hotel address2', '2', '2', '10:00', '22:00', 'N', 'Y', '2018-06-01 00:00:00'),
(5, 'hotel03', '3*', 'hotel address3', '3', '3', '10:00', '22:00', 'N', 'Y', '2018-06-01 00:00:00'),
(6, 'hotel04', '4*', 'hotel address4', '4', '4', '10:00', '22:00', 'Y', 'N', '2018-06-01 00:00:00'),
(15, 'hotel05', '1*', 'hotel address5', '5', '5', '10:00', '22:00', 'N', 'Y', '2018-06-01 00:00:00'),
(16, 'hotel06', '3*', 'hotel address6', '6', '6', '10:00', '22:00', 'Y', 'N', '2018-06-01 00:00:00'),
(17, 'hotel07', '4*', 'hotel address7', '7', '7', '10:00', '22:00', 'N', 'Y', '2018-06-01 00:00:00'),
(18, 'hotel08', '1*', 'hotel address8', '8', '8', '10:00', '22:00', 'N', 'Y', '2018-06-01 00:00:00'),
(20, 'hotel0511', '1*', 'hotel address5', '511', '511', '10:00', '22:00', 'N', 'Y', NULL),
(21, 'ewqfqf', '4*', 'e21e12e12e122e12e', '1234', '1234', '10:00', '15:00', 'Y', 'Y', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hotel_room_detail`
--

CREATE TABLE `tbl_hotel_room_detail` (
  `hotel_room_master_id` int(5) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `hotel_room_type` int(11) DEFAULT NULL,
  `hotel_room_rent` int(11) DEFAULT NULL,
  `hotel_room_desc` text,
  `hotel_room_amenities` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room_master`
--

CREATE TABLE `tbl_room_master` (
  `room_master_id` int(2) NOT NULL,
  `room_type` varchar(32) DEFAULT NULL,
  `room_type_Desc` text,
  `room_type_status` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_room_master`
--

INSERT INTO `tbl_room_master` (`room_master_id`, `room_type`, `room_type_Desc`, `room_type_status`) VALUES
(1, 'none', 'Basic Room', 'Y'),
(2, 'ac', 'AC Room', 'Y'),
(3, 'delux', 'Delux Room', 'Y'),
(4, 'corporate1', 'Corporate Room', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_super_admin`
--

CREATE TABLE `tbl_super_admin` (
  `admin_id` int(4) NOT NULL,
  `admin_username` varchar(32) DEFAULT NULL,
  `admin_password` varchar(32) DEFAULT NULL,
  `admin_display_name` varchar(128) DEFAULT NULL,
  `admin_status` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_super_admin`
--

INSERT INTO `tbl_super_admin` (`admin_id`, `admin_username`, `admin_password`, `admin_display_name`, `admin_status`) VALUES
(1, 'user01', 'a6e8f1aecdfdad4883fe615084c07e1b', 'user1 user1', 'Y'),
(2, 'user02', '9f6b058b2e7a0d8794f6c6a71d9eb40e', 'user2 user2', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `website_operator`
--

CREATE TABLE `website_operator` (
  `operator_id` int(4) NOT NULL,
  `operator_username` varchar(32) DEFAULT NULL,
  `operator_password` varchar(32) DEFAULT NULL,
  `operator_display_name` varchar(128) DEFAULT NULL,
  `operator_status` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hotel_room_item`
--
ALTER TABLE `hotel_room_item`
  ADD PRIMARY KEY (`hotel_room_item_id`);

--
-- Indexes for table `room_item_master`
--
ALTER TABLE `room_item_master`
  ADD PRIMARY KEY (`room_item_id`);

--
-- Indexes for table `tbl_amenities_master`
--
ALTER TABLE `tbl_amenities_master`
  ADD PRIMARY KEY (`amenity_id`);

--
-- Indexes for table `tbl_hotel_master`
--
ALTER TABLE `tbl_hotel_master`
  ADD PRIMARY KEY (`hotel_id`),
  ADD UNIQUE KEY `hotel_reg_number` (`hotel_reg_number`),
  ADD UNIQUE KEY `hotel_gst_number` (`hotel_gst_number`);

--
-- Indexes for table `tbl_hotel_room_detail`
--
ALTER TABLE `tbl_hotel_room_detail`
  ADD PRIMARY KEY (`hotel_room_master_id`);

--
-- Indexes for table `tbl_room_master`
--
ALTER TABLE `tbl_room_master`
  ADD PRIMARY KEY (`room_master_id`);

--
-- Indexes for table `tbl_super_admin`
--
ALTER TABLE `tbl_super_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `website_operator`
--
ALTER TABLE `website_operator`
  ADD PRIMARY KEY (`operator_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hotel_room_item`
--
ALTER TABLE `hotel_room_item`
  MODIFY `hotel_room_item_id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_item_master`
--
ALTER TABLE `room_item_master`
  MODIFY `room_item_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_amenities_master`
--
ALTER TABLE `tbl_amenities_master`
  MODIFY `amenity_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_hotel_master`
--
ALTER TABLE `tbl_hotel_master`
  MODIFY `hotel_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_hotel_room_detail`
--
ALTER TABLE `tbl_hotel_room_detail`
  MODIFY `hotel_room_master_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_room_master`
--
ALTER TABLE `tbl_room_master`
  MODIFY `room_master_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_super_admin`
--
ALTER TABLE `tbl_super_admin`
  MODIFY `admin_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `website_operator`
--
ALTER TABLE `website_operator`
  MODIFY `operator_id` int(4) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
