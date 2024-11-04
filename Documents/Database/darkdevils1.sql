-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2024 at 04:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `darkdevils`
--
drop database darkdevils;
create database darkdevils;
use darkdevils;
-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryId` varchar(15) NOT NULL,
  `C_name` varchar(50) DEFAULT NULL,
  `C_icon` varchar(40) DEFAULT 'pIcon.jpg',
  `CategoryInfo` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryId`, `C_name`, `C_icon`, `CategoryInfo`) VALUES
('C001', 'Men', 'pIcon.jpg', 'Discover a vast range of men’s fashion essentials designed to elevate your style, from casual wear to formal attire. Our mens collection offers quality craftsmanship, ensuring comfort and durability i'),
('C002', 'Women', 'pIcon.jpg', 'Explore the latest in womens fashion with our curated selection that brings together elegance, comfort, and individuality. Our womens category showcases styles that range from chic dresses and stylish'),
('C003', 'Kids', 'pIcon.jpg', 'Shop our kids collection for comfortable, playful, and durable clothing thats perfect for every adventure. From vibrant t-shirts and cozy hoodies to durable jeans and cute dresses, our kids category i');

-- --------------------------------------------------------

--
-- Table structure for table `clothproduct`
--

CREATE TABLE `clothproduct` (
  `ProductId` varchar(15) NOT NULL,
  `P_name` varchar(75) DEFAULT NULL,
  `P_categoryId` varchar(75) DEFAULT NULL,
  `P_price` decimal(9,2) DEFAULT NULL,
  `P_quantity` int(11) DEFAULT 1,
  `P_image1` varchar(40) DEFAULT 'pImage1.jpg',
  `P_image2` varchar(40) DEFAULT 'pImage2.jpg',
  `P_image3` varchar(40) DEFAULT 'pImage3.jpg',
  `P_image4` varchar(40) DEFAULT 'pImage4.jpg',
  `P_description` varchar(200) DEFAULT NULL,
  `P_small` char(1) DEFAULT NULL,
  `P_medium` char(1) DEFAULT NULL,
  `P_large` char(1) DEFAULT NULL,
  `P_extraLarge` char(1) DEFAULT NULL,
  `P_status` varchar(5) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clothproduct`
--

INSERT INTO `clothproduct` (`ProductId`, `P_name`, `P_categoryId`, `P_price`, `P_quantity`, `P_image1`, `P_image2`, `P_image3`, `P_image4`, `P_description`, `P_small`, `P_medium`, `P_large`, `P_extraLarge`, `P_status`) VALUES
('P001', 'Alan Parker Long Sleeve Formal Shirt', 'C001', 1150.00, 1, 'pImage1.jpg', 'pImage2.jpg', 'pImage3.jpg', 'pImage4.jpg', 'Please bear in mind that the photo may be slightly different from the actual item in terms of colour due to lighting conditions or the display used to view Wash And Care : Hand wash with cold water, W', '1', '1', '0', '1', '1'),
('P002', 'Trafford Logo Printed T Shirt', 'C001', 1320.00, 1, 'pImage1.jpg', 'pImage2.jpg', 'pImage3.jpg', 'pImage4.jpg', 'Model Height 5 8 wearing size  M Please bear in mind that the photo may be slightly different from the actual item in terms of colour due to lighting conditions or the display used to view Wash And Ca', '0', '0', '1', '1', '1'),
('P003', 'Emerald Long Sleeve Formal Regular Fit Shirt', 'C001', 1320.00, 1, 'pImage1.jpg', 'pImage2.jpg', 'pImage3.jpg', 'pImage4.jpg', 'Please bear in mind that the photo may be slightly different from the actual item in terms of color due to lighting conditions or the display used to view Wash And Care: Hand wash with cold water, Was', '0', '0', '1', '1', '1'),
('P004', 'Akasi High Waist WW Pant', 'C002', 980.00, 1, 'pImage4.jpg', 'pImage2.jpg', 'pImage3.jpg', 'pImage1.jpg', 'Model Height 5 6, wearing size 30 Please bear in mind that the photo may be slightly different from the actual item in terms of colour due to lighting conditions or the display used to view   Wash And', '1', '1', '1', '0', '1'),
('P005', 'Aura Paisley Printed Maxi Dress', 'C002', 1100.00, 1, 'pImage4.jpg', 'pImage2.jpg', 'pImage3.jpg', 'pImage1.jpg', 'wearing size M Please bear in mind that the photo may be slightly different from the actual item in terms of colour due to lighting conditions or the display used to view', '1', '1', '1', '0', '1'),
('P006', 'Bella Oversized Printed Crop Top', 'C002', 1230.00, 1, 'pImage4.jpg', 'pImage2.jpg', 'pImage3.jpg', 'pImage1.jpg', 'Model Height 5 6 wearing size M Please bear in mind that the photo may be slightly different from the actual item in terms of colour due to lighting conditions or the display used to view', '1', '1', '1', '0', '1'),
('P007', 'Lily Printed Back Criss Cross Frock', 'C003', 720.00, 1, 'pImage3.jpg', 'pImage2.jpg', 'pImage1.jpg', 'pImage4.jpg', 'Model Height 3 10, Age 7Y Please bear in mind that the photo may be slightly different from the actual item in terms of colour due to lighting conditions or the display used to view', '1', '1', '1', '0', '1'),
('P008', 'Lily Smocked Strappy Jumpsuit', 'C003', 900.00, 1, 'pImage3.jpg', 'pImage2.jpg', 'pImage1.jpg', 'pImage4.jpg', 'Model Height 3 10, Age 7Y Please bear in mind that the photo may be slightly different from the actual item in terms of colour due to lighting conditions or the display used to view', '1', '1', '1', '1', '1'),
('P009', 'Kids Printed Pijama Set', 'C003', 1050.00, 1, 'pImage3.jpg', 'pImage2.jpg', 'pImage1.jpg', 'pImage4.jpg', 'Model Height 3 10, Age 7Y Please bear in mind that the photo may be slightly different from the actual item in terms of colour due to lighting conditions or the display used to view', '1', '0', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustermerId` varchar(15) NOT NULL,
  `C_username` varchar(70) DEFAULT NULL,
  `C_fullname` varchar(150) DEFAULT NULL,
  `C_email` varchar(100) DEFAULT NULL,
  `C_hashpassword` varchar(100) DEFAULT NULL,
  `C_mobile` varchar(15) DEFAULT NULL,
  `C_address` varchar(150) DEFAULT NULL,
  `C_image` varchar(50) DEFAULT 'cImage.jpg',
  `C_status` char(5) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustermerId`, `C_username`, `C_fullname`, `C_email`, `C_hashpassword`, `C_mobile`, `C_address`, `C_image`, `C_status`) VALUES
('U001', 'Dhanushka0123', 'KGDME Jayarathna.', 'Dhanushka0123mahesh@gmail.com', '$2y$10$1EN/Arnez/SXIKsC9eibYODGHZUVuiZ9GsiwSroYqhgErfPXaNSEu$2y', '0766640384', 'No 54/1 Marawanagoda', 'cImage.jpg', '1'),
('U002', 'Mahesh123', 'SSD Chathuranga.', 'php@gmail.com', '$10$L2hfHBmxQX68iNa807hMCuQEYO8T8g8ysEnvs1idJjWdtJSOcSC8C', '0706540384', 'No 34 kurunagala', 'cImage.jpg', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryId`),
  ADD UNIQUE KEY `C_name` (`C_name`);

--
-- Indexes for table `clothproduct`
--
ALTER TABLE `clothproduct`
  ADD PRIMARY KEY (`ProductId`),
  ADD UNIQUE KEY `P_name` (`P_name`),
  ADD KEY `P_categoryId` (`P_categoryId`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustermerId`),
  ADD UNIQUE KEY `C_username` (`C_username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clothproduct`
--
ALTER TABLE `clothproduct`
  ADD CONSTRAINT `clothproduct_ibfk_1` FOREIGN KEY (`P_categoryId`) REFERENCES `category` (`CategoryId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
