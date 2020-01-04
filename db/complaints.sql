-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2020 at 05:10 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `complaints`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaint_list`
--

CREATE TABLE `complaint_list` (
  `id` int(11) NOT NULL,
  `country_code` int(11) NOT NULL,
  `country` varchar(15) NOT NULL,
  `state_code` int(11) NOT NULL,
  `state` varchar(15) NOT NULL,
  `distt_code` int(11) NOT NULL,
  `distt` varchar(15) NOT NULL,
  `city_code` int(11) NOT NULL,
  `city` varchar(15) NOT NULL,
  `department_code` int(11) NOT NULL,
  `department` varchar(30) NOT NULL,
  `department_add` varchar(50) NOT NULL,
  `officer` varchar(30) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `email` varchar(30) NOT NULL,
  `website` varchar(30) NOT NULL,
  `social_1` varchar(30) NOT NULL,
  `social_2` varchar(30) NOT NULL,
  `social_3` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaint_list`
--

INSERT INTO `complaint_list` (`id`, `country_code`, `country`, `state_code`, `state`, `distt_code`, `distt`, `city_code`, `city`, `department_code`, `department`, `department_add`, `officer`, `mobile`, `email`, `website`, `social_1`, `social_2`, `social_3`) VALUES
(1, 91, 'india', 1, 'punjab', 148001, 'sangrur', 148023, 'Malerkotla', 0, 'ESIC', 'Backside Bus Stand', 'Aaksha Kumar / Manager', '9876543210', 'akumar@esic.in', 'esic.in', '', '', ''),
(2, 91, 'india', 1, 'punjab', 148001, 'sangrur', 148001, 'sangrur', 0, 'EPFO', 'Near Bus Stand', 'Suraj Singh / Asstt. Comm.', '9876543210', 'akumar@epfindia.gov.in', 'www.epfindia.gov.in', '', '', ''),
(3, 91, 'india', 1, 'punjab', 148001, 'sangrur', 148001, 'sangrur', 0, 'EPFO', 'Near Bus Stand', 'Suraj Singh / Asstt. Comm.', '9876543210', 'akumar@epfindia.gov.in', 'www.epfindia.gov.in', '', '', ''),
(4, 91, 'india', 1, 'punjab', 148001, 'sangrur', 148001, 'sangrur', 0, 'EPFO', 'Near Bus Stand', 'Suraj Singh / Asstt. Comm.', '9876543210', 'akumar@epfindia.gov.in', 'www.epfindia.gov.in', '', '', ''),
(5, 91, 'india', 1, 'punjab', 148001, 'sangrur', 148023, 'Malerkotla', 0, 'ESIC', 'Backside Bus Stand', 'Aaksha Kumar / Manager', '9876543210', 'akumar@esic.in', 'esic.in', '', '', ''),
(6, 91, 'india', 1, 'punjab', 147001, 'patiala', 147001, 'patiala', 0, 'EPFO', 'Near Bus Stand', 'Suraj Singh / Asstt. Comm.', '9876543210', 'akumar@epfindia.gov.in', 'www.epfindia.gov.in', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `country_list`
--

CREATE TABLE `country_list` (
  `id` int(11) NOT NULL,
  `country_code` int(11) NOT NULL,
  `country_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country_list`
--

INSERT INTO `country_list` (`id`, `country_code`, `country_name`) VALUES
(1, 91, 'india');

-- --------------------------------------------------------

--
-- Table structure for table `district_list`
--

CREATE TABLE `district_list` (
  `id` int(11) NOT NULL,
  `country_code` int(11) NOT NULL,
  `state_code` int(11) NOT NULL,
  `district_code` int(11) NOT NULL,
  `district_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `district_list`
--

INSERT INTO `district_list` (`id`, `country_code`, `state_code`, `district_code`, `district_name`) VALUES
(1, 91, 1, 148023, 'sangrur');

-- --------------------------------------------------------

--
-- Table structure for table `state_list`
--

CREATE TABLE `state_list` (
  `id` int(11) NOT NULL,
  `country_code` int(11) NOT NULL,
  `state_code` int(11) NOT NULL,
  `state_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state_list`
--

INSERT INTO `state_list` (`id`, `country_code`, `state_code`, `state_name`) VALUES
(1, 91, 1, 'punjab');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaint_list`
--
ALTER TABLE `complaint_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country_list`
--
ALTER TABLE `country_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `district_list`
--
ALTER TABLE `district_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state_list`
--
ALTER TABLE `state_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaint_list`
--
ALTER TABLE `complaint_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `country_list`
--
ALTER TABLE `country_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `district_list`
--
ALTER TABLE `district_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `state_list`
--
ALTER TABLE `state_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
