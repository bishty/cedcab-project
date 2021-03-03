-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 27, 2021 at 02:54 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cedcab`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE `tbl_location` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `distance` int(255) NOT NULL,
  `is_available` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`id`, `name`, `distance`, `is_available`) VALUES
(1, 'Charbagh', 0, 1),
(2, 'Indira Nagar', 10, 1),
(3, 'BBD ', 30, 1),
(4, 'Barabanki', 60, 1),
(5, 'Faizabad', 100, 1),
(6, 'Basti ', 150, 1),
(7, 'Gorakhpur', 210, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ride`
--

CREATE TABLE `tbl_ride` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `from` varchar(255) NOT NULL,
  `to` varchar(255) NOT NULL,
  `total_distance` varchar(255) NOT NULL,
  `luggage` varchar(255) NOT NULL,
  `total_fare` varchar(255) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `customer_user_id` varchar(255) NOT NULL,
  `cabtype` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ride`
--

INSERT INTO `tbl_ride` (`id`, `date`, `from`, `to`, `total_distance`, `luggage`, `total_fare`, `status`, `customer_user_id`, `cabtype`) VALUES
(1, '2021-02-26', 'Barabanki', 'Faizabad', '40', '46', '975', 0, '28', 'CedRoyal'),
(2, '2021-02-26', 'BBD ', 'Barabanki', '30', '46', '755', 2, '28', 'CedMini'),
(3, '2021-02-26', 'Charbagh', 'Barabanki', '60', '23', '1255', 2, '29', 'CedRoyal'),
(4, '2021-02-26', 'Indira Nagar', 'BBD ', '20', '23', '695', 0, '30', 'CedRoyal'),
(5, '2021-02-27', 'Indira Nagar', 'BBD ', '20', '23', '625', 0, '31', 'CedMini'),
(7, '2021-02-27', 'Barabanki', 'Faizabad', '40', '23', '885', 1, '28', 'CedMini'),
(8, '2021-02-27', '', '', '0', '67', '795', 1, '28', 'CedRoyal'),
(9, '2021-02-27', 'Basti ', 'Gorakhpur', '60', '23', '1255', 1, '28', 'CedRoyal');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dateofsignup` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `mobile` varchar(15) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `filess` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `email_id`, `name`, `dateofsignup`, `mobile`, `status`, `password`, `is_admin`, `filess`) VALUES
(1, 'admin@gmail.com', 'Admin', '2021-02-22 17:33:36', '6754433415156', 1, 'Password123$', 1, ''),
(28, 'bishtabhishek1996@gmail.com', 'abhishek bisht', '2021-02-25 11:19:23', '9536132001', 1, '123454', 0, 'upload/aaa.png_abhishek bisht.png'),
(29, 'armyofficer1996@gmail.com', 'akash bisht', '2021-02-26 12:17:01', '896543673', 1, '123', 0, 'upload/hckert.png_akash bisht.png'),
(30, 'himanshu@gmail.com', 'himanshu', '2021-02-26 15:09:00', '564326787545', 0, '12345678', 0, 'upload/hckert.png_himanshu.png'),
(31, 'prince@gmail.com', 'prince', '2021-02-26 17:45:22', '8976898992', 0, '12345', 0, 'upload/hckert.png_prince.png'),
(32, 'ssss@gtamil.com', 'himanshu', '2021-02-27 09:33:52', '8967543290', 0, '1234', 0, 'upload/aaa.png_himanshu.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ride`
--
ALTER TABLE `tbl_ride`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_location`
--
ALTER TABLE `tbl_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_ride`
--
ALTER TABLE `tbl_ride`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
