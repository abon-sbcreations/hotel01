-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2018 at 03:37 PM
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
(1, 34, 'cust01', '9876543210', 'abcd@abcd.com', 'cust01 address', 'Member', 0, 'plat12345', '26-07-2018'),
(2, 36, 'cust03', '9876543210', 'abcd@abcd.com', 'cust03 address3333', 'Member', 0, 'gold1111', '06-06-2018'),
(4, 34, 'cust02', '9876543211', 'abcd@abcd.com', 'address02', 'Member', 0, 'gold1236', '01-07-2018');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_admin_master`
--

CREATE TABLE `hotel_admin_master` (
  `hotel_admin_id` int(11) NOT NULL,
  `admin_user_id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `hotel_module_permission` text,
  `hotel_access_activation` varchar(16) DEFAULT NULL,
  `hotel_access_duration` smallint(2) DEFAULT NULL,
  `hotel_access_rent` decimal(8,2) DEFAULT NULL,
  `is_rent_paid` enum('Y','N') DEFAULT NULL,
  `hotel_admin_status` enum('Active','Inactive') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hotel_admin_master`
--

INSERT INTO `hotel_admin_master` (`hotel_admin_id`, `admin_user_id`, `hotel_id`, `hotel_module_permission`, `hotel_access_activation`, `hotel_access_duration`, `hotel_access_rent`, `is_rent_paid`, `hotel_admin_status`) VALUES
(1, 3, 34, '{\"1\":[\"view\",\"edit\",\"delete\"],\"2\":[\"add\"],\"3\":[\"view\",\"edit\",\"delete\"],\"4\":[\"add\"],\"6\":[\"view\",\"edit\",\"delete\"],\"7\":[\"add\"],\"8\":[\"view\",\"edit\",\"delete\"],\"9\":[\"add\"],\"10\":[\"view\",\"edit\",\"delete\"],\"11\":[\"add\"]}', '22-06-2018', 24, '12000.00', 'Y', 'Active'),
(2, 4, 34, '{\"1\":[\"view\",\"delete\"],\"2\":[\"add\",\"edit\"],\"3\":[\"add\",\"edit\"],\"4\":[\"view\",\"delete\"],\"6\":[\"add\",\"edit\"],\"7\":[\"add\",\"edit\"],\"8\":[\"view\",\"delete\"],\"9\":[\"add\",\"edit\"],\"10\":[\"add\",\"edit\"],\"11\":[\"view\",\"delete\"]}', '01-05-2018', 30, '18000.00', 'Y', 'Active'),
(3, 5, 34, '{\"1\":[\"view\",\"edit\"],\"2\":[\"view\",\"edit\"],\"3\":[\"view\",\"edit\"],\"4\":[\"view\",\"edit\"],\"6\":[\"view\",\"edit\"],\"7\":[\"view\",\"edit\"],\"8\":[\"view\",\"edit\"],\"9\":[\"view\",\"edit\"],\"10\":[\"view\",\"edit\"],\"11\":[\"view\",\"edit\"]}', '12-07-2018', 24, '12000.00', 'Y', 'Inactive'),
(4, 6, 24, '{\"1\":[\"view\"],\"2\":[\"add\"],\"3\":[\"edit\"],\"4\":[\"delete\"]}', '28-06-2018', 12, '12000.00', 'Y', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_bar_master`
--

CREATE TABLE `hotel_bar_master` (
  `menu_id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `menu_cat` varchar(128) DEFAULT NULL,
  `item_name` varchar(128) DEFAULT NULL,
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
(2, 24, 'gold card', '1201.50', 18, '1,3,5,7'),
(3, 37, 'platinum card', '1501.50', 23, '2,4,6,8'),
(4, 34, 'gold card', '1234.00', 23, '1,3,5,7');

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
(1, 24, 'Lunch', 'Veg', 'salad', 'oiqwdji iqwjf9j 8yg 8yg 8y gu8 hu hui hui hui ', '12.50', 'Y'),
(3, 34, 'Lunch', 'Veg', 'sandwitch', 'owdhduoiwq oqwhduqw ghq8wg8qwgd', '25.00', 'Y'),
(9, 24, 'Lunch', 'Non-Veg', 'chiken 65', 'woihuediubeefi', '125.00', 'Y'),
(10, 34, 'Dinner', 'Non-Veg', 'salad2', 'wefwefwfe', '12.00', 'Y'),
(11, 34, 'Dinner', 'Veg', 'salad3', 'qwfdqdqwf', '12.00', 'Y');

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
-- Table structure for table `hotel_room_booking_details`
--

CREATE TABLE `hotel_room_booking_details` (
  `booking_master_id` int(11) NOT NULL,
  `room_detail_id` int(11) NOT NULL,
  `check_in` varchar(32) NOT NULL,
  `check_out` varchar(32) NOT NULL,
  `service_master_hotel_id` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_room_booking_master`
--

CREATE TABLE `hotel_room_booking_master` (
  `hotel_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `adoult_no` int(11) NOT NULL,
  `child no` int(11) NOT NULL,
  `check_in` varchar(32) NOT NULL,
  `check_out` varchar(32) NOT NULL
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
(1, 'spa', 'facility 01'),
(2, 'facility02-', 'facility 02'),
(3, 'facility03', 'facility 03'),
(4, 'facility04', 'facility 04'),
(5, 'facility05', 'facility 05'),
(6, 'facility06', 'facility 06'),
(7, 'facility07', 'facility 07'),
(8, 'facility08', 'facility 08'),
(9, 'facility099', 'This is dummy testing in SB creation software pvt ltd.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company_master`
--

CREATE TABLE `tbl_company_master` (
  `comp_id` int(11) NOT NULL,
  `comp_name` varchar(128) DEFAULT NULL,
  `comp_reg_no` varchar(32) DEFAULT NULL,
  `comp_gst_no` varchar(32) NOT NULL,
  `comp_pan_no` varchar(32) NOT NULL,
  `comp_address` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_company_master`
--

INSERT INTO `tbl_company_master` (`comp_id`, `comp_name`, `comp_reg_no`, `comp_gst_no`, `comp_pan_no`, `comp_address`) VALUES
(14, 'c1', 'c1', 'qedwqeqe', 'qweqweqwe', 'c1'),
(15, 'sb creations', 'reg1234', '123454676', '1234546756', 'some address'),
(16, 'comp03', '123456783', '123456781', '123456782', 'aoipqwqfpiwq'),
(20, 'c2', 'c2', 'wdqwdwqd', 'wqdqwd', 'wqdqwwdwqd');

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
(24, 'Seasons Siam Hotel-2', '5*', '97 Rajaprarop Makkasan Rajathevee,\r\nBangkok, 10400,\r\nThailand Bangkok,\r\nThailand 10400.', '123456', '123456', '09:00', '08:45', 'N', 'N', NULL),
(34, ' Hotel Samode Palace', '1*', 'Village Samode,\r\nTehsil Chomu,\r\nDistrict Jaipur - 303806,\r\nRajasthan, India.', '123457', '123457', '10:00', '16:00', 'N', 'N', NULL),
(35, 'Taj Umaid Bhawan Palace', '5*', 'Lake Pichola,\r\nJodhpur - 342006,\r\nRajasthan, India.', '123458', '123458', '10:00', '09:00', '', '', NULL),
(36, 'Hotel Ratan Vilas', '4*', 'Loco Shed Road,\r\nNear Bhaskar Circle,\r\nRatanada,\r\nJodhpur - 342001,\r\nRajasthan, India', '123459', '123459', '11:00', '10:00', '', '', NULL),
(37, 'Coconut Lagoon Resort', '5*', 'District Kuttanad,\r\nKerala,\r\nKumarakom - 686563,\r\nKerala, India', '1234510', '1234510', '10:30', '09:30', 'N', 'N', NULL),
(39, 'Taj Bengal', '4*', 'Kolkata - 700043', '1234511', '1234511', '09:45', '08:45', '', '', NULL);

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
(1, 34, 3, 2000, 'abcdefgh ijkl', '1,3,5,7,8'),
(2, 34, 1, 1234, 'fine description', '3,4,5,6'),
(3, 34, 3, 1200, 'ffffff4fj56jh', '1,5,7'),
(4, 24, 4, 1200, 'ffffff4fj56jh', '2,4,6'),
(5, 24, 3, 1234, 'wadqwdwqd', '3,6,8');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_master`
--

CREATE TABLE `tbl_item_master` (
  `room_item_id` int(4) NOT NULL,
  `room_item_cat` varchar(128) DEFAULT NULL,
  `room_item_subcat` varchar(128) DEFAULT NULL,
  `room_item_name` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_master2`
--

CREATE TABLE `tbl_item_master2` (
  `room_item_id` int(4) NOT NULL,
  `room_item_cat` varchar(128) DEFAULT NULL,
  `room_item_subcat` varchar(128) DEFAULT NULL,
  `room_item_name` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_item_master2`
--

INSERT INTO `tbl_item_master2` (`room_item_id`, `room_item_cat`, `room_item_subcat`, `room_item_name`) VALUES
(1, 'c1', 'c13', 'lifeboy 350g'),
(3, 'c2', 'c21', 'item003'),
(4, 'c2', 'c22', 'item004'),
(14, 'c3', 'c33', 'item001'),
(15, 'c2', 'c22', '65165165165');

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

--
-- Dumping data for table `tbl_module_master`
--

INSERT INTO `tbl_module_master` (`module_id`, `module_name`, `module_desc`, `module_status`) VALUES
(1, 'companies', 'description 01', 'Active'),
(2, 'hotels', 'awdqwd wqdwqdwqd wdwqdwq', 'Active'),
(3, 'hotel_rooms', 'hotel_rooms', 'Active'),
(4, 'rooms', 'WDWDWQFDQW WVWFergrefre', 'Active'),
(6, 'Amenities', 'gxtycgvjhvhjvhj', 'Active'),
(7, 'room_items', 'room_items', 'Active'),
(8, 'hotel_items', 'hotel_items', 'Inactive'),
(9, 'restaurants', 'restaurants', 'Active'),
(10, 'customers', 'customers', 'Active'),
(11, 'membership_masters', 'membership_masters', 'Active');

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
(2, 'ac', 'AC Room.no additional ', 'Y'),
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
  `admin_type` varchar(64) NOT NULL,
  `admin_display_name` varchar(128) DEFAULT NULL,
  `admin_status` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_super_admin`
--

INSERT INTO `tbl_super_admin` (`admin_id`, `admin_username`, `admin_password`, `admin_type`, `admin_display_name`, `admin_status`) VALUES
(1, 'user01', 'a6e8f1aecdfdad4883fe615084c07e1b', 'Super', 'Super Admin1', 'Y'),
(2, 'user02', '9f6b058b2e7a0d8794f6c6a71d9eb40e', 'Super', 'Super Admin2', 'Y'),
(3, 'hoteladmin01', 'a6e8f1aecdfdad4883fe615084c07e1b', 'Hotel', NULL, 'Y'),
(4, 'hoteladmin02', '9f6b058b2e7a0d8794f6c6a71d9eb40e', 'Hotel', NULL, 'Y'),
(5, 'anindya', '1867f9e81c7d0c75ac2bd9f559505a95', 'Hotel', NULL, 'Y'),
(6, 'hoteladmin03', '97dff59478b8fa719609a67441cdf7d0', 'Hotel', NULL, 'Y');

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
-- Indexes for table `tbl_item_master`
--
ALTER TABLE `tbl_item_master`
  ADD PRIMARY KEY (`room_item_id`);

--
-- Indexes for table `tbl_item_master2`
--
ALTER TABLE `tbl_item_master2`
  ADD PRIMARY KEY (`room_item_id`);

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
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hotel_admin_master`
--
ALTER TABLE `hotel_admin_master`
  MODIFY `hotel_admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `hotel_room_item`
--
ALTER TABLE `hotel_room_item`
  MODIFY `hotel_room_item_id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_amenities_master`
--
ALTER TABLE `tbl_amenities_master`
  MODIFY `amenity_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_company_master`
--
ALTER TABLE `tbl_company_master`
  MODIFY `comp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_hotel_master`
--
ALTER TABLE `tbl_hotel_master`
  MODIFY `hotel_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbl_hotel_room_detail`
--
ALTER TABLE `tbl_hotel_room_detail`
  MODIFY `hotel_room_master_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_item_master`
--
ALTER TABLE `tbl_item_master`
  MODIFY `room_item_id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_item_master2`
--
ALTER TABLE `tbl_item_master2`
  MODIFY `room_item_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_module_master`
--
ALTER TABLE `tbl_module_master`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_room_master`
--
ALTER TABLE `tbl_room_master`
  MODIFY `room_master_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_super_admin`
--
ALTER TABLE `tbl_super_admin`
  MODIFY `admin_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `website_operator`
--
ALTER TABLE `website_operator`
  MODIFY `operator_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
