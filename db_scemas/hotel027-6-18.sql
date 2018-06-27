-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2018 at 11:54 AM
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
-- Table structure for table `customer_doc_master`
--

CREATE TABLE `customer_doc_master` (
  `cust_doc_id` int(11) NOT NULL,
  `cust_id` int(11) DEFAULT NULL,
  `doc_type` enum('Aadhar','Voter','Pan','Passport','Driving') DEFAULT NULL,
  `doc_number` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_master`
--

CREATE TABLE `customer_master` (
  `cust_id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `cust_name` varchar(128) DEFAULT NULL,
  `cust_phone` varchar(11) DEFAULT NULL,
  `cust_email` varchar(128) DEFAULT NULL,
  `cust_address` text,
  `cust_status` enum('Member','Guest') DEFAULT NULL,
  `membership_type` int(11) DEFAULT NULL,
  `membership_num` varchar(32) DEFAULT NULL,
  `membership_issue_date` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_master`
--

INSERT INTO `customer_master` (`cust_id`, `hotel_id`, `cust_name`, `cust_phone`, `cust_email`, `cust_address`, `cust_status`, `membership_type`, `membership_num`, `membership_issue_date`) VALUES
(1, 1, 'cust01', '9876543210', 'abcd@abcd.com', 'cust01 address', 'Member', 3, 'plat12345', '26-07-2018'),
(2, 1, 'cust03', '9876543210', 'abcd@abcd.com', 'cust03 address3333', 'Member', 2, 'gold1111', '06-06-2018'),
(4, 2, 'cust02', '9876543211', 'abcd@abcd.com', 'address02', 'Member', 4, 'gold1236', '01-07-2018');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_admin_master`
--

CREATE TABLE `hotel_admin_master` (
  `hotel_admin_id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `hotel_userid` varchar(32) DEFAULT NULL,
  `hotel_passwd` varchar(32) DEFAULT NULL,
  `hotel_access_module` varchar(128) DEFAULT NULL,
  `hotel_module_permission` text,
  `hotel_access_activation` varchar(16) DEFAULT NULL,
  `hotel_access_duration` smallint(2) DEFAULT NULL,
  `hotel_access_rent` decimal(8,2) DEFAULT NULL,
  `is_rent_paid` enum('Y','N') DEFAULT NULL,
  `hotel_admin_status` enum('Active','Inactive') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_bar_master`
--

CREATE TABLE `hotel_bar_master` (
  `menu_id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `menu_cat` varchar(128) DEFAULT NULL,
  `item_name` varchar(128) DEFAULT NULL,
  `menu_type` enum('veg','non_veg') DEFAULT NULL,
  `item_desc` text,
  `item_price` decimal(6,2) DEFAULT NULL,
  `item_available` enum('Yes','No') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_bar_served`
--

CREATE TABLE `hotel_bar_served` (
  `bar_service_id` int(11) DEFAULT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `served_place` enum('Room','DinningHall','Poolside') DEFAULT NULL,
  `served_place_detail` varchar(64) DEFAULT NULL,
  `served_on` varchar(16) DEFAULT NULL,
  `served_item` text,
  `isPaid` enum('Yes','No') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_item_master`
--

CREATE TABLE `hotel_item_master` (
  `item_id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `item_cat` varchar(64) DEFAULT NULL,
  `item_subcat` varchar(64) DEFAULT NULL,
  `item_img` varchar(128) DEFAULT NULL,
  `item_name` varchar(128) DEFAULT NULL,
  `item_attr` varchar(128) DEFAULT NULL,
  `item_desc` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_membership_master`
--

CREATE TABLE `hotel_membership_master` (
  `membership_id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `membership_card` varchar(32) DEFAULT NULL,
  `membership_card_value` decimal(8,2) DEFAULT NULL,
  `membership_validity` tinyint(2) DEFAULT NULL,
  `membership_amenity` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hotel_membership_master`
--

INSERT INTO `hotel_membership_master` (`membership_id`, `hotel_id`, `membership_card`, `membership_card_value`, `membership_validity`, `membership_amenity`) VALUES
(2, 1, 'gold card', '1201.50', 12, '1,3,5,7'),
(3, 1, 'platinum card', '1501.50', 18, '2,4,6,8'),
(4, 2, 'gold card', '1234.00', 13, '1,3,5,7');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_restaurant_master`
--

CREATE TABLE `hotel_restaurant_master` (
  `menu_id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `menu_session` enum('Lunch','Dinner','Breakfast') DEFAULT NULL,
  `menu_type` enum('Veg','Non-Veg') DEFAULT NULL,
  `item_name` varchar(128) DEFAULT NULL,
  `item_desc` text,
  `item_price` decimal(6,2) DEFAULT NULL,
  `item_available` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hotel_restaurant_master`
--

INSERT INTO `hotel_restaurant_master` (`menu_id`, `hotel_id`, `menu_session`, `menu_type`, `item_name`, `item_desc`, `item_price`, `item_available`) VALUES
(1, 1, 'Lunch', 'Veg', 'salad', 'oiqwdji iqwjf9j 8yg 8yg 8y gu8 hu hui hui hui ', '12.50', 'Y'),
(3, 1, 'Lunch', 'Veg', 'sandwitch', 'owdhduoiwq oqwhduqw ghq8wg8qwgd', '25.00', 'Y'),
(9, 1, 'Lunch', 'Non-Veg', 'chiken 65', 'woihuediubeefi', '125.00', '');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_resturant_served`
--

CREATE TABLE `hotel_resturant_served` (
  `resturant_service_id` int(11) DEFAULT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `served_place` enum('Room','DinningHall','Poolside') DEFAULT NULL,
  `served_place_detail` varchar(64) DEFAULT NULL,
  `served_on` varchar(16) DEFAULT NULL,
  `served_item` text,
  `isPaid` enum('Yes','No') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'c1', 'c13', 'lifeboy 350g'),
(3, 'c2', 'c21', 'item003'),
(4, 'c2', 'c22', 'item004'),
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
(8, 'facility08', 'facility 08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company_master`
--

CREATE TABLE `tbl_company_master` (
  `comp_id` int(11) NOT NULL,
  `comp_name` varchar(128) DEFAULT NULL,
  `comp_reg_no` varchar(32) DEFAULT NULL,
  `comp_address` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_company_master`
--

INSERT INTO `tbl_company_master` (`comp_id`, `comp_name`, `comp_reg_no`, `comp_address`) VALUES
(1, 'company-01', '123', 'some address01'),
(2, 'company+02', '123', 'some address02'),
(3, 'company 031', '123222', 'some address03123'),
(7, 'company 04', '12345', '[efkweofkowkefo'),
(9, 'comp04', '1221313', 'pwmqpwomd iqwmdipmqw\r\npqwodmpwoqdpomqwdpopo');

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
(1, 'hotel01', '4*', 'hotel address1', '1', '1', '10:00', '22:00', 'N', 'N', '2018-06-01 00:00:00'),
(2, 'hotel02', '2*', 'hotel address2', '2', '2', '10:00', '22:00', 'N', 'Y', '2018-06-01 00:00:00'),
(5, 'hotel03', '3*', 'hotel address3', '3', '3', '10:00', '22:00', 'N', 'Y', '2018-06-01 00:00:00'),
(6, 'hotel04', '4*', 'hotel address4', '4', '4', '10:00', '22:00', 'N', 'N', '2018-06-01 00:00:00'),
(15, 'hotel05', '1*', 'hotel address5', '5', '5', '10:00', '22:00', 'N', 'Y', '2018-06-01 00:00:00'),
(16, 'hotel06', '3*', 'hotel address6', '6', '6', '10:00', '22:00', 'Y', 'N', '2018-06-01 00:00:00'),
(17, 'hotel07', '4*', 'hotel address7', '7', '7', '10:00', '22:00', 'N', 'Y', '2018-06-01 00:00:00'),
(18, 'hotel08', '1*', 'hotel address8', '8', '8', '10:00', '22:00', 'N', 'Y', '2018-06-01 00:00:00'),
(20, 'the crystal palace', '7*', 'this is testing2...this is testing123', 'WB7584742', 'GST4580439', '10:00', '09:00', 'Y', 'Y', NULL),
(21, 'hotel12', '4*', 'e21e12e12e122e12e', '1234', '1234', '10:00', '22:00', 'N', 'N', NULL),
(22, 'the great western', '5*', 'this is rsbcspl testing process...', 'WB390456', 'GST3498101', '00:00', '00:00', 'Y', 'N', NULL),
(23, 'hotel oyo', '3*', 'this is alpha testing...', 'WB5710998', 'GST908812', '10:00', '09:30', 'Y', 'N', NULL),
(24, 'hotel 033', '5*', 'this is not the real time testing', 'WB0333', 'GST033333', '09:00', '08:45', 'N', 'Y', NULL);

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

--
-- Dumping data for table `tbl_hotel_room_detail`
--

INSERT INTO `tbl_hotel_room_detail` (`hotel_room_master_id`, `hotel_id`, `hotel_room_type`, `hotel_room_rent`, `hotel_room_desc`, `hotel_room_amenities`) VALUES
(1, 23, 3, 2000, 'abcdefgh ijkl', '1,3,5,7,8'),
(2, 2, 1, 1234, 'fine description', '3,4,5,6'),
(3, 1, 3, 1200, 'ffffff4fj56jh', '1,5,7'),
(4, 1, 4, 1200, 'ffffff4fj56jh', '2,4,6');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_module_master`
--

CREATE TABLE `tbl_module_master` (
  `module_id` int(11) NOT NULL,
  `module_name` varchar(32) DEFAULT NULL,
  `module_desc` text,
  `module_status` enum('Active','Inactive') DEFAULT NULL
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
-- Dumping data for table `website_operator`
--

INSERT INTO `website_operator` (`operator_id`, `operator_username`, `operator_password`, `operator_display_name`, `operator_status`) VALUES
(1, 'operator01', 'a6e8f1aecdfdad4883fe615084c07e1b', 'operator operator01', 'Y'),
(2, 'operator02', '9f6b058b2e7a0d8794f6c6a71d9eb40e', 'operator operator02', 'Y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_doc_master`
--
ALTER TABLE `customer_doc_master`
  ADD PRIMARY KEY (`cust_doc_id`);

--
-- Indexes for table `customer_master`
--
ALTER TABLE `customer_master`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `hotel_admin_master`
--
ALTER TABLE `hotel_admin_master`
  ADD PRIMARY KEY (`hotel_admin_id`);

--
-- Indexes for table `hotel_bar_master`
--
ALTER TABLE `hotel_bar_master`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `hotel_item_master`
--
ALTER TABLE `hotel_item_master`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `hotel_membership_master`
--
ALTER TABLE `hotel_membership_master`
  ADD PRIMARY KEY (`membership_id`);

--
-- Indexes for table `hotel_restaurant_master`
--
ALTER TABLE `hotel_restaurant_master`
  ADD PRIMARY KEY (`menu_id`);

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
-- Indexes for table `tbl_company_master`
--
ALTER TABLE `tbl_company_master`
  ADD PRIMARY KEY (`comp_id`);

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
-- Indexes for table `tbl_module_master`
--
ALTER TABLE `tbl_module_master`
  ADD PRIMARY KEY (`module_id`);

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
-- AUTO_INCREMENT for table `customer_doc_master`
--
ALTER TABLE `customer_doc_master`
  MODIFY `cust_doc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_master`
--
ALTER TABLE `customer_master`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hotel_admin_master`
--
ALTER TABLE `hotel_admin_master`
  MODIFY `hotel_admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotel_bar_master`
--
ALTER TABLE `hotel_bar_master`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotel_item_master`
--
ALTER TABLE `hotel_item_master`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotel_membership_master`
--
ALTER TABLE `hotel_membership_master`
  MODIFY `membership_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hotel_restaurant_master`
--
ALTER TABLE `hotel_restaurant_master`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hotel_room_item`
--
ALTER TABLE `hotel_room_item`
  MODIFY `hotel_room_item_id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_item_master`
--
ALTER TABLE `room_item_master`
  MODIFY `room_item_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_amenities_master`
--
ALTER TABLE `tbl_amenities_master`
  MODIFY `amenity_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_company_master`
--
ALTER TABLE `tbl_company_master`
  MODIFY `comp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_hotel_master`
--
ALTER TABLE `tbl_hotel_master`
  MODIFY `hotel_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_hotel_room_detail`
--
ALTER TABLE `tbl_hotel_room_detail`
  MODIFY `hotel_room_master_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_module_master`
--
ALTER TABLE `tbl_module_master`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `operator_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
