-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2021 at 08:15 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `care_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `user_name` text NOT NULL,
  `admin_id` int(11) NOT NULL,
  `password` text DEFAULT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`first_name`, `last_name`, `user_name`, `admin_id`, `password`, `birthday`, `gender`) VALUES
('mahmoud', 'kamal', 'mahmoud', 1, 'kokolook', '2021-11-17', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `car_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `car_name` char(200) NOT NULL,
  `model_year` year(4) NOT NULL,
  `motor_capacity` int(11) NOT NULL,
  `mechanical_horse` int(11) NOT NULL,
  `model` char(200) NOT NULL,
  `number_of_set` int(11) NOT NULL,
  `tank_size` float NOT NULL,
  `price` float NOT NULL,
  `admin_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `turbo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`car_id`, `category_id`, `car_name`, `model_year`, `motor_capacity`, `mechanical_horse`, `model`, `number_of_set`, `tank_size`, `price`, `admin_id`, `count`, `turbo`) VALUES
(55677, 1, 'hyandai', 2021, 1600, 110, 'verna', 5, 50, 120000, 1, 5, 0),
(88777, 2, 'kia', 2018, 1600, 140, 'cerato', 5, 50, 250000, 1, 8, 1),
(556773, 1, 'hyandai', 2021, 1600, 110, 'Acsent', 5, 50, 120000, 1, 5, 0),
(8899900, 3, 'bmw', 2021, 2000, 250, 'E36 coupe', 4, 60, 550000, 1, 3, 1),
(8986678, 4, 'toyota', 2014, 1800, 200, 'Hais', 14, 80, 400000, 1, 12, 0);

-- --------------------------------------------------------

--
-- Table structure for table `car_category`
--

CREATE TABLE `car_category` (
  `category_id` int(11) NOT NULL,
  `category_name` char(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car_category`
--

INSERT INTO `car_category` (`category_id`, `category_name`) VALUES
(1, 'Sedan'),
(2, 'Suv'),
(3, 'Coupe'),
(4, 'Van');

-- --------------------------------------------------------

--
-- Table structure for table `car_image`
--

CREATE TABLE `car_image` (
  `image_id` int(11) NOT NULL,
  `url` text NOT NULL,
  `car_id` int(11) NOT NULL,
  `image_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car_image`
--

INSERT INTO `car_image` (`image_id`, `url`, `car_id`, `image_type`) VALUES
(1, 'http://localhost/carsApi/api/image/2018_Hyundai_Verna__6_.jpg', 55677, 'Cover'),
(2, 'http://localhost/carsApi/api/image/2018_Hyundai_Verna__4_.jpg', 55677, NULL),
(3, 'http://localhost/carsApi/api/image/KIA_Cerato_2021.jpg', 88777, 'Cover'),
(4, 'http://localhost/carsApi/api/image/2021-kia-cerato-facelift-leaked-03.jpg', 88777, NULL),
(5, 'http://localhost/carsApi/api/image/s1803901-bmw-e36-coupe-m3-bleu-estoril-1990-02.jpg', 8899900, 'Cover'),
(6, 'http://localhost/carsApi/api/image/s1803901-bmw-e36-coupe-m3-bleu-estoril-1990-08.jpg', 8899900, NULL),
(7, 'http://localhost/carsApi/api/image/BMW-M3-Coupe-E36.jpg', 8899900, NULL),
(8, 'http://localhost/carsApi/api/image/20210212120952_Hiace_front.jpg', 8986678, 'Cover'),
(9, 'http://localhost/carsApi/api/image/hais2.jpeg', 8986678, NULL),
(10, 'http://localhost/carsApi/api/image/toyota_hiace-3-door-pv_dark-green-mica-metallic.jpg', 8986678, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clint_request`
--

CREATE TABLE `clint_request` (
  `req_id` int(11) NOT NULL,
  `f_name` varchar(200) DEFAULT NULL,
  `l_name` varchar(200) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(22) DEFAULT NULL,
  `car_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clint_request`
--

INSERT INTO `clint_request` (`req_id`, `f_name`, `l_name`, `birth_date`, `address`, `phone`, `car_id`) VALUES
(6, 'mahmoud', 'kamal', '2021-11-10', 'hellwan', '35435435435', 88777);

-- --------------------------------------------------------

--
-- Table structure for table `request_doc`
--

CREATE TABLE `request_doc` (
  `doc_id` int(11) NOT NULL,
  `req_id` int(11) DEFAULT NULL,
  `front_id` text DEFAULT NULL,
  `rear_id` text DEFAULT NULL,
  `license` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_doc`
--

INSERT INTO `request_doc` (`doc_id`, `req_id`, `front_id`, `rear_id`, `license`) VALUES
(8, 6, 'http://localhost/carsApi/api/image/front_id20211121201323.jpg', 'http://localhost/carsApi/api/image/rear_id20211121201323.jpg', 'http://localhost/carsApi/api/image/license20211121201323.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `car_category`
--
ALTER TABLE `car_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `car_image`
--
ALTER TABLE `car_image`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `clint_request`
--
ALTER TABLE `clint_request`
  ADD PRIMARY KEY (`req_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `request_doc`
--
ALTER TABLE `request_doc`
  ADD PRIMARY KEY (`doc_id`),
  ADD KEY `req_id` (`req_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `car_category`
--
ALTER TABLE `car_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `car_image`
--
ALTER TABLE `car_image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `clint_request`
--
ALTER TABLE `clint_request`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `request_doc`
--
ALTER TABLE `request_doc`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `car_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `car_category` (`category_id`),
  ADD CONSTRAINT `car_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `car_image`
--
ALTER TABLE `car_image`
  ADD CONSTRAINT `car_image_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `car` (`car_id`);

--
-- Constraints for table `clint_request`
--
ALTER TABLE `clint_request`
  ADD CONSTRAINT `clint_request_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `car` (`car_id`);

--
-- Constraints for table `request_doc`
--
ALTER TABLE `request_doc`
  ADD CONSTRAINT `request_doc_ibfk_1` FOREIGN KEY (`req_id`) REFERENCES `clint_request` (`req_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
