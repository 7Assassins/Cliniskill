-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 05, 2022 at 12:48 PM
-- Server version: 5.7.37
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cliniski_tech`
--

-- --------------------------------------------------------

--
-- Table structure for table `certificates_received`
--

CREATE TABLE `certificates_received` (
  `cr_id` int(11) NOT NULL,
  `cr_certificate_id` int(11) NOT NULL,
  `cr_name` text NOT NULL,
  `cr_reg_number` varchar(255) NOT NULL,
  `cr_location` varchar(255) NOT NULL,
  `cr_date_of_completion` date NOT NULL,
  `grades` text,
  `cr_created_at` datetime NOT NULL,
  `cr_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `certificates_received`
--

INSERT INTO `certificates_received` (`cr_id`, `cr_certificate_id`, `cr_name`, `cr_reg_number`, `cr_location`, `cr_date_of_completion`, `grades`, `cr_created_at`, `cr_updated_at`) VALUES
(1, 1, 'Divya', '1524SD', 'HYD', '2022-04-05', 'Array.#$-Array.#$-Array.#$-Array', '2022-04-05 12:39:13', '2022-04-05 07:09:13'),
(2, 1, 'syed', '123456', 'warangal', '2022-04-10', '1.#$-2.#$-3.#$-4', '2022-04-05 12:40:11', '2022-04-05 07:10:11');

-- --------------------------------------------------------

--
-- Table structure for table `certificate_details`
--

CREATE TABLE `certificate_details` (
  `cd_id` int(11) NOT NULL,
  `cd_name_of_the_certificate` text NOT NULL,
  `cd_description` longtext NOT NULL,
  `cd_grades` text NOT NULL,
  `cd_created_at` datetime NOT NULL,
  `cd_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `certificate_details`
--

INSERT INTO `certificate_details` (`cd_id`, `cd_name_of_the_certificate`, `cd_description`, `cd_grades`, `cd_created_at`, `cd_updated_at`) VALUES
(1, 'ADVANCE POST GRADUATE PROGRAM IN\r\nCLINICAL RESEARCH AND MANAGEMENT', 'This is to certify that the candidate has successfully completed the <b>Advance Post\r\nGraduate Program in Clinical Research and Management.</b> The Candidate has\r\nSatisfactory Knowledge & Proficiency in CLINICAL RESEARCH, CLINICAL DATA\r\nMANAGEMENT, PHARMACOVIGILANCE  & MEDICAL WRITING.', 'Clinical Research.#$-Clinical Data Management.#$-Pharmacovigilance.#$-Medical Writing', '2022-02-16 16:31:15', '2022-02-24 13:48:39'),
(2, 'ADVANCE POST GRADUATE PROGRAM IN CLINICAL RESEARCH AND PHARMACOVIGILANCE', 'This is to certify that the candidate has successfully completed the Advance Certification program in Clinical Research and Pharmacovigilance. The Candidate has Satisfactory Knowledge & Proficiency in CLINICAL RESEARCH & PHARMACOVIGILANCE.', 'Clinical Research.#$-Pharmacovigilance', '2022-02-16 16:36:28', '2022-02-22 12:55:50');

-- --------------------------------------------------------

--
-- Table structure for table `user_basic_details`
--

CREATE TABLE `user_basic_details` (
  `ubd_id` bigint(20) NOT NULL,
  `ubd_status` tinyint(4) NOT NULL COMMENT '1 : Active 2 : Inactive',
  `ubd_name` varchar(255) NOT NULL,
  `ubd_email` varchar(255) NOT NULL,
  `ubd_mobile` bigint(20) NOT NULL,
  `ubd_password` varchar(500) NOT NULL,
  `ubd_created_at` datetime NOT NULL,
  `ubd_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_basic_details`
--

INSERT INTO `user_basic_details` (`ubd_id`, `ubd_status`, `ubd_name`, `ubd_email`, `ubd_mobile`, `ubd_password`, `ubd_created_at`, `ubd_updated_at`) VALUES
(1, 1, 'ADMIN', 'admin@CliniSun.com', 8801974877, 'd9e6762dd1c8eaf6d61b3c6192fc408d4d6d5f1176d0c29169bc24e71c3f274ad27fcd5811b313d681f7e55ec02d73d499c95455b6b5bb503acf574fba8ffe85', '2022-01-31 10:40:35', '2022-04-05 07:05:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificates_received`
--
ALTER TABLE `certificates_received`
  ADD PRIMARY KEY (`cr_id`);

--
-- Indexes for table `certificate_details`
--
ALTER TABLE `certificate_details`
  ADD PRIMARY KEY (`cd_id`);

--
-- Indexes for table `user_basic_details`
--
ALTER TABLE `user_basic_details`
  ADD PRIMARY KEY (`ubd_id`),
  ADD UNIQUE KEY `ubd_email` (`ubd_email`),
  ADD UNIQUE KEY `ubd_mobile` (`ubd_mobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certificates_received`
--
ALTER TABLE `certificates_received`
  MODIFY `cr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `certificate_details`
--
ALTER TABLE `certificate_details`
  MODIFY `cd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_basic_details`
--
ALTER TABLE `user_basic_details`
  MODIFY `ubd_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
