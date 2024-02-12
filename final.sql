-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2024 at 04:56 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cus_id` int(255) NOT NULL,
  `cus_name` varchar(255) NOT NULL,
  `prefix_id` varchar(255) NOT NULL,
  `statuslevel_id` varchar(255) NOT NULL,
  `tell` varchar(255) NOT NULL,
  `dep_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_id`, `cus_name`, `prefix_id`, `statuslevel_id`, `tell`, `dep_id`, `username`, `password`, `image`) VALUES
(1, 'Kamonmat', '02', '02', '0865264541', '1', 'kamonmat', 'tatc2024', 'รูป'),
(2, 'Teerawat', '01', '02', '0811935541', '1', '123', '123', 'รูป');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `day_id` int(11) NOT NULL,
  `day_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`day_id`, `day_name`) VALUES
(1, 'monday'),
(2, 'thursday');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dep_id` int(20) NOT NULL,
  `dep_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dep_id`, `dep_name`) VALUES
(1, 'แผนกไอที'),
(2, 'แผนกการโรงแรม');

-- --------------------------------------------------------

--
-- Table structure for table `distance_price`
--

CREATE TABLE `distance_price` (
  `disprice_id` int(255) NOT NULL,
  `disprice_name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `distance_price`
--

INSERT INTO `distance_price` (`disprice_id`, `disprice_name`, `price`) VALUES
(1, 'ตึกการโรงแรม', '30'),
(2, 'ตึกไอที', '20');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(255) NOT NULL,
  `emp_name` varchar(255) NOT NULL,
  `prefix_id` varchar(255) NOT NULL,
  `statuslevel_id` varchar(255) NOT NULL,
  `tell` varchar(255) NOT NULL,
  `dep_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `classroom_table` varchar(255) NOT NULL,
  `Bank` varchar(100) NOT NULL,
  `Bank_number` varchar(50) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_name`, `prefix_id`, `statuslevel_id`, `tell`, `dep_id`, `username`, `password`, `classroom_table`, `Bank`, `Bank_number`, `image`) VALUES
(1, 'Tee', '01', '02', '0892530887', '1', 'TT', 'tatc', 'อัพโหลดตารางสอน', 'กสิกร', '0254569874', 'รูป'),
(2, 'drew', '1', '1', '0948859242', '1', '000', '000', 'อัพโหลดตารางสอน', 'ไทยพาณิช', '00754569875', '');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `shop_id` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `shop_id`, `price`, `image`) VALUES
(1, 'ก๋วยเตี๋ยวไก่', '1', '30', 'f1.png'),
(2, 'ข้าวกะเพราหมู', '2', '40', 'f1.png'),
(3, 'ข้าวผัดหมู', '3', '40', 'f1.png'),
(4, 'ข้าวราดแกง', '3', '30', 'f1.png');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(255) NOT NULL,
  `cus_id` varchar(255) NOT NULL,
  `emp_id` varchar(255) DEFAULT NULL,
  `shop_id` varchar(255) NOT NULL,
  `item_id` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `description` varchar(500) DEFAULT NULL COMMENT 'รายละเอียดสินค้า เช่น ไม่เอาผัก',
  `order_date` varchar(255) DEFAULT NULL,
  `order_time` varchar(255) DEFAULT NULL,
  `total_price` varchar(255) NOT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `londtitude` varchar(255) DEFAULT NULL,
  `paytype_id` varchar(255) DEFAULT NULL,
  `paystatus_id` varchar(255) DEFAULT NULL,
  `disprice_id` varchar(255) DEFAULT NULL,
  `paymet_slip` varchar(1500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `cus_id`, `emp_id`, `shop_id`, `item_id`, `amount`, `description`, `order_date`, `order_time`, `total_price`, `latitude`, `londtitude`, `paytype_id`, `paystatus_id`, `disprice_id`, `paymet_slip`) VALUES
(1, '0', NULL, ' 3', '4', '1', '', NULL, NULL, '30', '13.7366', '100.4995', '2', '2', '1', NULL),
(2, '0', NULL, ' 3', '3', '1', '', NULL, NULL, '40', '13.7366', '100.4995', '2', '2', '1', NULL),
(3, '2', NULL, ' 3', '4', '1', '', NULL, NULL, '30', '13.7366', '100.4995', '2', '2', '1', NULL),
(4, '2', '1', ' 3', '4', '1', '', NULL, NULL, '30', '13.0508', '100.9367', '2', '2', '1', NULL),
(5, '2', '1', ' 3', '4', '1', '', NULL, NULL, '30', '13.0508', '100.9367', '2', '2', '1', NULL),
(6, '2', '1', ' 3', '4', '1', '', NULL, NULL, '30', '13.0508', '100.9367', '2', '2', '1', NULL),
(7, '2', '1', ' 3', '4', '1', '', NULL, NULL, '30', '13.0508', '100.9367', '2', '1', '1', NULL),
(8, '2', NULL, ' 3', '4', '1', '', NULL, NULL, '30', '13.0508', '100.9367', '2', '2', '1', NULL),
(9, '2', '1', ' 3', '4', '1', '', '12/02/2024', NULL, '30', '13.0508', '100.9367', '1', '1', '2', NULL),
(10, '2', '1', ' 3', '4', '1', '', '12/02/2024', NULL, '30', '13.7366', '100.4995', '2', '2', '1', NULL),
(11, '2', '1', ' 3', '4', '1', '', '12/02/2024', NULL, '30', '13.0508', '100.9367', '2', '2', '1', NULL),
(12, '2', '1', ' 3', '4', '1', '', '12/02/2024', NULL, '30', '13.0508', '100.9367', '2', '2', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orderstatus_detail`
--

CREATE TABLE `orderstatus_detail` (
  `order_id` int(255) NOT NULL,
  `orderstatus_id` varchar(255) NOT NULL,
  `detail` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderstatus_detail`
--

INSERT INTO `orderstatus_detail` (`order_id`, `orderstatus_id`, `detail`) VALUES
(1, '0', NULL),
(2, '1', NULL),
(3, '9', ''),
(4, '9', ''),
(5, '9', ''),
(6, '9', ''),
(7, '9', ''),
(8, '9', ''),
(9, '3', ''),
(10, '3', NULL),
(11, '9', ''),
(12, '9', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `orderstatus_id` int(255) NOT NULL,
  `orderstatus_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`orderstatus_id`, `orderstatus_name`) VALUES
(1, 'รอรับอาหาร'),
(2, 'กำลังจัดส่ง'),
(3, 'จัดส่งสำเร็จ'),
(8, 'ยกเลิกการส่ง'),
(9, 'ยกเลิกการสั่ง');

-- --------------------------------------------------------

--
-- Table structure for table `patment_status`
--

CREATE TABLE `patment_status` (
  `paystatus_id` int(255) NOT NULL,
  `paystatus_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patment_status`
--

INSERT INTO `patment_status` (`paystatus_id`, `paystatus_name`) VALUES
(1, 'ชำระเงินเรียบร้อย'),
(2, 'ยังไม่ชำระเงิน');

-- --------------------------------------------------------

--
-- Table structure for table `patment_type`
--

CREATE TABLE `patment_type` (
  `paytype_id` int(255) NOT NULL,
  `paytype_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patment_type`
--

INSERT INTO `patment_type` (`paytype_id`, `paytype_name`) VALUES
(1, 'เงินสด'),
(2, 'เงินโอน');

-- --------------------------------------------------------

--
-- Table structure for table `prefix`
--

CREATE TABLE `prefix` (
  `prefix_id` int(255) NOT NULL,
  `prefix_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prefix`
--

INSERT INTO `prefix` (`prefix_id`, `prefix_name`) VALUES
(1, 'นาย'),
(2, 'นาง'),
(3, 'นางสาว'),
(4, 'เด็กชาย'),
(5, 'เด็กหญิง');

-- --------------------------------------------------------

--
-- Table structure for table `q_emp`
--

CREATE TABLE `q_emp` (
  `day_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `time_id` int(11) NOT NULL,
  `status_empqid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `q_emp`
--

INSERT INTO `q_emp` (`day_id`, `emp_id`, `time_id`, `status_empqid`) VALUES
(1, 1, 1, 1),
(1, 1, 2, 2),
(2, 1, 1, 1),
(1, 1, 6, 1),
(1, 1, 5, 1),
(2, 1, 2, 2),
(2, 1, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `shop_id` int(255) NOT NULL,
  `shop_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `image` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`shop_id`, `shop_name`, `location`, `image`) VALUES
(1, 'ร้านประนอม', 'โรงอาหารเก่า', 's1.png'),
(2, 'ร้านอาหารตามสั่ง', 'โรงอาหารเก่า', 's1.png'),
(3, 'ร้านข้าวแกงป้าตี๋', 'โรงอาหารเก่า', 's1.png');

-- --------------------------------------------------------

--
-- Table structure for table `statuslevel`
--

CREATE TABLE `statuslevel` (
  `statuslevel_id` int(255) NOT NULL,
  `statuslevel_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `statuslevel`
--

INSERT INTO `statuslevel` (`statuslevel_id`, `statuslevel_name`) VALUES
(1, 'ครู, อาจารย์'),
(2, 'นักเรียน, นักศึกษา');

-- --------------------------------------------------------

--
-- Table structure for table `status_empq`
--

CREATE TABLE `status_empq` (
  `status_empqid` int(255) NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status_empq`
--

INSERT INTO `status_empq` (`status_empqid`, `status_name`) VALUES
(1, 'ว่าง'),
(2, 'ไม่ว่าง');

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

CREATE TABLE `time` (
  `time_id` int(255) NOT NULL,
  `time_name` time(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time`
--

INSERT INTO `time` (`time_id`, `time_name`) VALUES
(1, '08:00:00.000000'),
(2, '09:00:00.000000'),
(3, '10:00:00.000000'),
(4, '11:00:00.000000'),
(5, '12:00:00.000000'),
(6, '13:00:00.000000'),
(7, '14:00:00.000000'),
(8, '15:00:00.000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`day_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dep_id`);

--
-- Indexes for table `distance_price`
--
ALTER TABLE `distance_price`
  ADD PRIMARY KEY (`disprice_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `orderstatus_detail`
--
ALTER TABLE `orderstatus_detail`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`orderstatus_id`);

--
-- Indexes for table `patment_status`
--
ALTER TABLE `patment_status`
  ADD PRIMARY KEY (`paystatus_id`);

--
-- Indexes for table `patment_type`
--
ALTER TABLE `patment_type`
  ADD PRIMARY KEY (`paytype_id`);

--
-- Indexes for table `prefix`
--
ALTER TABLE `prefix`
  ADD PRIMARY KEY (`prefix_id`);

--
-- Indexes for table `q_emp`
--
ALTER TABLE `q_emp`
  ADD KEY `day_id` (`day_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `time_id` (`time_id`),
  ADD KEY `status_empqid` (`status_empqid`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `statuslevel`
--
ALTER TABLE `statuslevel`
  ADD PRIMARY KEY (`statuslevel_id`);

--
-- Indexes for table `status_empq`
--
ALTER TABLE `status_empq`
  ADD PRIMARY KEY (`status_empqid`);

--
-- Indexes for table `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`time_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cus_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `day_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dep_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `distance_price`
--
ALTER TABLE `distance_price`
  MODIFY `disprice_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orderstatus_detail`
--
ALTER TABLE `orderstatus_detail`
  MODIFY `order_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `orderstatus_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `patment_status`
--
ALTER TABLE `patment_status`
  MODIFY `paystatus_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patment_type`
--
ALTER TABLE `patment_type`
  MODIFY `paytype_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prefix`
--
ALTER TABLE `prefix`
  MODIFY `prefix_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `shop_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `statuslevel`
--
ALTER TABLE `statuslevel`
  MODIFY `statuslevel_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status_empq`
--
ALTER TABLE `status_empq`
  MODIFY `status_empqid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `time`
--
ALTER TABLE `time`
  MODIFY `time_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `q_emp`
--
ALTER TABLE `q_emp`
  ADD CONSTRAINT `q_emp_ibfk_1` FOREIGN KEY (`day_id`) REFERENCES `days` (`day_id`),
  ADD CONSTRAINT `q_emp_ibfk_2` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`),
  ADD CONSTRAINT `q_emp_ibfk_3` FOREIGN KEY (`time_id`) REFERENCES `time` (`time_id`),
  ADD CONSTRAINT `q_emp_ibfk_4` FOREIGN KEY (`status_empqid`) REFERENCES `status_empq` (`status_empqid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
