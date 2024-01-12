-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 12, 2024 at 04:30 AM
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
-- Database: `pulsepath001`
--

-- --------------------------------------------------------

--
-- Table structure for table `ambulance`
--

CREATE TABLE `ambulance` (
  `uid` int(6) UNSIGNED NOT NULL,
  `ambulance_no` varchar(255) NOT NULL,
  `organization` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ambulance`
--

INSERT INTO `ambulance` (`uid`, `ambulance_no`, `organization`, `reg_date`) VALUES
(1, '2030', 'test', '2024-01-06 14:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `specialization` varchar(255) NOT NULL,
  `hospital` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `specialization`, `hospital`, `phone`, `email`, `description`, `date_added`) VALUES
(1, 'Dr. John Doe', 'Cardiologist', 'City Hospital', '123-456-7890', 'john.doe@email.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id ultricies ligula. Fusce vel facilisis arcu. Sed finibus ipsum eu augue bibendum, ut tincidunt turpis malesuada. Sed et tristique libero. Etiam laoreet sem sit amet neque tincidunt, a eleifend enim cursus.', '2024-01-08 11:48:41'),
(2, 'Dr. Jane Smith', 'Orthopedic Surgeon', 'General Hospital', '987-654-3210', 'jane.smith@email.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id ultricies ligula. Fusce vel facilisis arcu. Sed finibus ipsum eu augue bibendum, ut tincidunt turpis malesuada. Sed et tristique libero. Etiam laoreet sem sit amet neque tincidunt, a eleifend enim cursus.', '2024-01-08 11:48:41'),
(3, 'Dr. Alice Johnson', 'Pediatrician', 'Children\'s Hospital', '987-654-3210', 'alice.johnson@email.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id ultricies ligula. Fusce vel facilisis arcu. Sed finibus ipsum eu augue bibendum, ut tincidunt turpis malesuada. Sed et tristique libero. Etiam laoreet sem sit amet neque tincidunt, a eleifend enim cursus.', '2024-01-08 11:48:41'),
(4, 'Dr. Brian Miller', 'Dermatologist', 'Skin Care Clinic', '123-456-7890', 'brian.miller@email.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id ultricies ligula. Fusce vel facilisis arcu. Sed finibus ipsum eu augue bibendum, ut tincidunt turpis malesuada. Sed et tristique libero. Etiam laoreet sem sit amet neque tincidunt, a eleifend enim cursus.', '2024-01-08 11:48:41');

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`id`, `name`, `phone`, `date_added`) VALUES
(1, 'Bir Hospital', '01-4221988/ 01-4221119', '2024-01-08 04:58:42'),
(2, 'Kathmandu Valley Hospital', '01-4255330', '2024-01-08 04:58:42'),
(3, 'Civil Service Hospital of Nepal', '01-4793000', '2024-01-08 04:58:42'),
(4, 'Venus Hospital', '01-4475120', '2024-01-08 04:58:42'),
(5, 'Vayodha Hospital', '01-4281666, 01-4288404', '2024-01-08 04:58:42'),
(6, 'Grande City Hospital', '01-4163500', '2024-01-08 04:58:42'),
(7, 'Teaching Hospital', '01-4412303', '2024-01-08 04:58:42'),
(8, 'Kathmandu Hospital', '01-4229656', '2024-01-08 04:58:42'),
(9, 'Kathmandu Neuro & General Hospital', '01-5327735', '2024-01-08 04:58:42'),
(10, 'Teku Hospital', '01-4253396', '2024-01-08 04:58:42'),
(11, 'Nepal Eye Hospital', '01-4260813', '2024-01-08 04:58:42'),
(12, 'Everest Hospital Pvt. Ltd.', '01-4793024', '2024-01-08 04:58:42'),
(13, 'Om Hospital & Research Center', '01-4476225', '2024-01-08 04:58:42'),
(14, 'Annapurna Neuro Hospital', '01-4256656 / 01-4256568', '2024-01-08 04:58:42'),
(15, 'Norvic International Hospital', '01-5970032', '2024-01-08 04:58:42'),
(16, 'Blue Cross Hospital', '01-4262027', '2024-01-08 04:58:42'),
(17, 'Paropakar Maternity and Womens’ Hospital', '01-4261363, 4253276, 4212568', '2024-01-08 04:58:42'),
(18, 'ERA INTERNATIONAL HOSPITAL Pvt. Ltd.', '01-4352447', '2024-01-08 04:58:42'),
(19, 'Birendra Military Hospital', '01-4271941', '2024-01-08 04:58:42'),
(20, 'Capital Hospital', '01-4168222', '2024-01-08 04:58:42'),
(21, 'Valley Maternity Nursing Home', '01-4420224', '2024-01-08 04:58:42'),
(22, 'Medicare National Hospital & Research Center', '01-4467067', '2024-01-08 04:58:42'),
(23, 'CIWEC Hospital Pvt. Ltd.', '01-4435232', '2024-01-08 04:58:42'),
(24, 'Nepal-Bharat Maitri Hospital', '01-5241288', '2024-01-08 04:58:42'),
(25, 'Kantipur Hospital', '01-4111627', '2024-01-08 04:58:42');

-- --------------------------------------------------------

--
-- Table structure for table `license`
--

CREATE TABLE `license` (
  `uid` int(6) UNSIGNED NOT NULL,
  `lisence` varchar(100) NOT NULL,
  `issue_date` date NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `license`
--

INSERT INTO `license` (`uid`, `lisence`, `issue_date`, `reg_date`) VALUES
(1, '123456', '2020-02-02', '2024-01-06 14:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `traffic_police`
--

CREATE TABLE `traffic_police` (
  `id` int(11) NOT NULL,
  `office` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `traffic_police`
--

INSERT INTO `traffic_police` (`id`, `office`, `phone`, `date_added`) VALUES
(1, 'Darbar Marg', '9851281608', '2024-01-08 11:13:56'),
(2, 'Thamel', '9842528863', '2024-01-08 11:13:56'),
(3, 'Sohrakhutte', '9858790154', '2024-01-08 11:13:56'),
(4, 'Purano Buspark', '9866894345', '2024-01-08 11:13:56'),
(5, 'Kalopul', '9851284443', '2024-01-08 11:13:56'),
(6, 'Kamalpokhari', '9815619738', '2024-01-08 11:13:56'),
(7, 'Dhalkeu', '9851282554', '2024-01-08 11:13:56'),
(8, 'Sihadarbar', '9851282670', '2024-01-08 11:13:56'),
(9, 'Thapathali', '9849347828', '2024-01-08 11:13:56'),
(10, 'Kalimati', '9851282670', '2024-01-08 11:13:56'),
(11, 'Balkhu', '9860651479', '2024-01-08 11:13:56'),
(12, 'Kirtipur', '9848205715', '2024-01-08 11:13:56'),
(13, 'Farping', '9851282005', '2024-01-08 11:13:56'),
(14, 'Kalanki', '9851282554', '2024-01-08 11:13:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(6) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `paddress` varchar(255) NOT NULL,
  `taddress` varchar(1255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `name`, `password`, `phone`, `gender`, `dob`, `paddress`, `taddress`, `reg_date`) VALUES
(1, 'Nischal Dhakal', '$2y$10$IXJSjnxgWuTMGL0YiXq3j.14GVKCCE8hX./4k7CnbUggIay3/3nGO', '9862405060', 'Male', '2003-04-19', 'Test Address', 'Test Address', '2024-01-06 14:43:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ambulance`
--
ALTER TABLE `ambulance`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `license`
--
ALTER TABLE `license`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `traffic_police`
--
ALTER TABLE `traffic_police`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ambulance`
--
ALTER TABLE `ambulance`
  MODIFY `uid` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `license`
--
ALTER TABLE `license`
  MODIFY `uid` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `traffic_police`
--
ALTER TABLE `traffic_police`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
