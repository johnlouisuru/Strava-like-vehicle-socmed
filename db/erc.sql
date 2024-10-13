-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2024 at 04:13 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user` text NOT NULL,
  `pass` text NOT NULL,
  `is_admin` int(11) NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user`, `pass`, `is_admin`, `email`) VALUES
(1, '21232f297a57a5a743894a0e4a801fc3', '21232f297a57a5a743894a0e4a801fc3', 1, 'jlouisuru@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `gc_details`
--

CREATE TABLE `gc_details` (
  `id` int(11) NOT NULL,
  `gc_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gc_details`
--

INSERT INTO `gc_details` (`id`, `gc_name`) VALUES
(1, 'Don Miguel'),
(2, 'Volta'),
(3, 'En-Gen');

-- --------------------------------------------------------

--
-- Table structure for table `gf_details`
--

CREATE TABLE `gf_details` (
  `id` int(11) NOT NULL,
  `gc_id` int(11) NOT NULL,
  `grid` int(11) NOT NULL,
  `region` int(11) NOT NULL,
  `gf_name` text NOT NULL,
  `gf_user` text NOT NULL,
  `gf_pass` text NOT NULL,
  `address` text NOT NULL,
  `contact` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gf_details`
--

INSERT INTO `gf_details` (`id`, `gc_id`, `grid`, `region`, `gf_name`, `gf_user`, `gf_pass`, `address`, `contact`, `date`) VALUES
(1, 1, 1, 1, 'Saol Coal Power Plant', 'e8e3e40fd5bd09da5a3f9c407f01009a', '21232f297a57a5a743894a0e4a801fc3', 'Saol St. Pinagpala Quezon City', '0912345678', '2024-10-04 20:29:00'),
(2, 2, 4, 7, 'Jonh-TraVolta', 'a1423b7bbd7522605a6267121a91e6f1', '21232f297a57a5a743894a0e4a801fc3', 'Barangay Kinuryente, Region 7', '8-7000', '2024-10-06 14:07:03'),
(3, 3, 5, 4, 'En-Gen Desel', '0eba728efd25856c33946447cbcbc05a', '21232f297a57a5a743894a0e4a801fc3', 'Barangay En Gen Diesel, Region 4', '67-000', '2024-10-06 14:43:36');

-- --------------------------------------------------------

--
-- Table structure for table `grid`
--

CREATE TABLE `grid` (
  `id` int(11) NOT NULL,
  `grid_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grid`
--

INSERT INTO `grid` (`id`, `grid_name`) VALUES
(1, 'Luzon'),
(2, 'Visayas'),
(3, 'Mindanao'),
(4, 'Off-Grid');

-- --------------------------------------------------------

--
-- Table structure for table `gu_details`
--

CREATE TABLE `gu_details` (
  `id` int(11) NOT NULL,
  `gf_unit` int(11) NOT NULL,
  `unit_name` text NOT NULL,
  `unit_rating` text NOT NULL,
  `tech` int(11) NOT NULL,
  `coc-pao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gu_details`
--

INSERT INTO `gu_details` (`id`, `gf_unit`, `unit_name`, `unit_rating`, `tech`, `coc-pao`) VALUES
(1, 1, 'Unit 1', '500', 5, '23-06-M-00214M'),
(2, 1, 'DG 1', '10', 7, '23-06-M-00214M'),
(3, 2, 'Inverter 1', '6000', 4, '69-06-X-00214X'),
(4, 3, 'Block A', '2000', 3, '85-05-Y-02024Z');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `gc_id` int(11) NOT NULL,
  `gf_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `activity` text NOT NULL,
  `date_occ` datetime DEFAULT NULL,
  `date_res` datetime DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `outage_class`
--

CREATE TABLE `outage_class` (
  `id` int(11) NOT NULL,
  `class_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `outage_class`
--

INSERT INTO `outage_class` (`id`, `class_name`) VALUES
(1, 'Boiler Related'),
(2, 'Generator Related'),
(3, 'Turbine/ Inverter Related'),
(4, 'Control System Related'),
(5, 'Transmission System Incurred'),
(6, 'Distribution System Incurred'),
(7, 'OTHERS - Forced Majeure'),
(8, 'OTHERS - Low System Demand'),
(9, 'OTHERS - Resource Inadequacy');

-- --------------------------------------------------------

--
-- Table structure for table `outage_event`
--

CREATE TABLE `outage_event` (
  `id` int(11) NOT NULL,
  `gc_id` int(11) NOT NULL,
  `gf_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `total_outage` text NOT NULL,
  `date_occ` datetime DEFAULT NULL,
  `time_occ` text NOT NULL,
  `date_res` datetime DEFAULT NULL,
  `time_res` text DEFAULT NULL,
  `hours_outage` text DEFAULT NULL,
  `reason` text NOT NULL,
  `too` int(11) NOT NULL,
  `too_description` int(11) DEFAULT NULL,
  `outage_class` int(11) NOT NULL,
  `date_in` datetime NOT NULL DEFAULT current_timestamp(),
  `is_completed` text NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `outage_event`
--

INSERT INTO `outage_event` (`id`, `gc_id`, `gf_id`, `unit_id`, `total_outage`, `date_occ`, `time_occ`, `date_res`, `time_res`, `hours_outage`, `reason`, `too`, `too_description`, `outage_class`, `date_in`, `is_completed`) VALUES
(3, 1, 1, 1, '980', '2024-09-17 12:35:00', '12:35', '2024-09-18 19:35:00', '19:35', NULL, 'Detailed Reason here...', 2, 6, 8, '2024-10-05 20:50:38', 'Y'),
(4, 1, 1, 2, '611', '2024-10-05 16:30:00', '16:30', NULL, NULL, NULL, 'Leakage', 1, 1, 1, '2024-10-05 22:26:13', 'N'),
(10, 2, 2, 3, '5500', '2024-10-06 12:00:00', '12:00', '2024-10-06 23:55:00', '23:55', NULL, 'Sample Reasoning', 2, 4, 4, '2024-10-06 14:27:49', 'Y'),
(16, 3, 3, 4, '2000', '2024-10-06 16:30:00', '16:30', NULL, NULL, NULL, 'Detailed Reason here...', 2, 5, 2, '2024-10-06 14:46:46', 'N'),
(17, 1, 1, 1, '100', '2024-08-08 16:50:00', '16:50', '2024-08-09 19:35:00', '19:35', NULL, 'Sample Reason', 2, 5, 1, '2024-10-06 19:23:37', 'Y'),
(18, 2, 2, 3, '10', '2024-10-06 21:30:00', '21:30', '2024-10-06 23:55:00', '23:55', NULL, 'Sample with Logs', 2, 4, 1, '2024-10-06 21:29:37', 'Y'),
(19, 2, 2, 3, '100', '2024-10-05 22:50:00', '22:50', '2024-10-06 23:55:00', '23:55', NULL, 'Sample Reason', 2, 6, 1, '2024-10-06 21:35:09', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `table_region`
--

CREATE TABLE `table_region` (
  `region_id` int(11) NOT NULL,
  `region_name` varchar(11) DEFAULT NULL,
  `region_description` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `table_region`
--

INSERT INTO `table_region` (`region_id`, `region_name`, `region_description`) VALUES
(1, 'NCR', 'National Capital Region'),
(2, 'CAR', 'Cordillera Administrative Region'),
(3, 'Region I', 'Ilocos Region'),
(4, 'Region II', 'Cagayan Valley'),
(5, 'Region III', 'Central Luzon'),
(6, 'Region IV-A', 'CALABARZON'),
(7, 'Region IV-B', 'MIMAROPA'),
(8, 'Region V', 'Bicol Region'),
(9, 'Region VI', 'Western Visayas'),
(10, 'Region VII', 'Central Visayas'),
(11, 'Region VIII', 'Eastern Visayas'),
(12, 'Region IX', 'Zamboanga Peninsula'),
(13, 'Region X', 'Northern Mindanao'),
(14, 'Region XI', 'Davao Region'),
(15, 'Region XII', 'SOCCSKSARGEN'),
(16, 'Region XIII', 'CARAGA'),
(17, 'ARMM', 'Autonomous Region in Muslim Mindanao');

-- --------------------------------------------------------

--
-- Table structure for table `tech`
--

CREATE TABLE `tech` (
  `id` int(11) NOT NULL,
  `tech_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tech`
--

INSERT INTO `tech` (`id`, `tech_name`) VALUES
(1, 'BESS'),
(2, 'BIOMASS'),
(3, 'COAL-FIRED'),
(4, 'COMBINED-CYCLE'),
(5, 'GEOTHERMAL'),
(6, 'HYDRO'),
(7, 'OIL-BASED'),
(8, 'OPEN-CYCLE'),
(9, 'SOLAR'),
(10, 'WIND'),
(11, 'HYBRID');

-- --------------------------------------------------------

--
-- Table structure for table `type_of_outage`
--

CREATE TABLE `type_of_outage` (
  `id` int(11) NOT NULL,
  `outage_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type_of_outage`
--

INSERT INTO `type_of_outage` (`id`, `outage_type`) VALUES
(1, 'Planned Outage'),
(2, 'Unplanned Outage');

-- --------------------------------------------------------

--
-- Table structure for table `type_of_outage_description`
--

CREATE TABLE `type_of_outage_description` (
  `id` int(11) NOT NULL,
  `too_id` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type_of_outage_description`
--

INSERT INTO `type_of_outage_description` (`id`, `too_id`, `description`) VALUES
(1, 1, 'In Accordance with GOMP'),
(2, 0, 'Not in Accordance with GOMP'),
(3, 2, 'Forced Outage'),
(4, 2, 'Maintenance Outage'),
(5, 2, 'Outside Management Control Outage'),
(6, 2, 'Extended GOMP');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gc_details`
--
ALTER TABLE `gc_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gf_details`
--
ALTER TABLE `gf_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grid`
--
ALTER TABLE `grid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gu_details`
--
ALTER TABLE `gu_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outage_class`
--
ALTER TABLE `outage_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outage_event`
--
ALTER TABLE `outage_event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_region`
--
ALTER TABLE `table_region`
  ADD PRIMARY KEY (`region_id`);

--
-- Indexes for table `tech`
--
ALTER TABLE `tech`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_of_outage`
--
ALTER TABLE `type_of_outage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_of_outage_description`
--
ALTER TABLE `type_of_outage_description`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gc_details`
--
ALTER TABLE `gc_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gf_details`
--
ALTER TABLE `gf_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `grid`
--
ALTER TABLE `grid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gu_details`
--
ALTER TABLE `gu_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `outage_class`
--
ALTER TABLE `outage_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `outage_event`
--
ALTER TABLE `outage_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `table_region`
--
ALTER TABLE `table_region`
  MODIFY `region_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tech`
--
ALTER TABLE `tech`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `type_of_outage`
--
ALTER TABLE `type_of_outage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `type_of_outage_description`
--
ALTER TABLE `type_of_outage_description`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
