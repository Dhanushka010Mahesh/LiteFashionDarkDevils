-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2024 at 12:41 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` varchar(15) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `full_name`, `username`, `email`, `password`) VALUES
('A01', 'Dhanushka', 'D0123', 'Mahesh404dhanushka2024ms@gmail.com', '$2y$10$S7Mmqh5lSE9RsSyzPv1MRuHxXzxzcr1zDc22S8txWQCWR.h.sr4f6'),
('A02', 'Mahesh', 'M0123', 'mahesh1226dhanushka@gmail.com', '$2y$10$sYN8w2IEdtIYg2LN8AtOf.PjzSAg5ICtgLlp7UetY6lC67QB7mg6G');

--
-- Triggers `admins`
--
DELIMITER $$
CREATE TRIGGER `before_insert_admins` BEFORE INSERT ON `admins` FOR EACH ROW BEGIN
   DECLARE next_id INT;
   SET next_id = (SELECT IFNULL(MAX(CAST(SUBSTRING(admin_id, 2) AS UNSIGNED)), 0) + 1 FROM admins);
   SET NEW.admin_id = CONCAT('A', LPAD(next_id, 2, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `S_cartId` varchar(15) NOT NULL,
  `ProductId` varchar(15) DEFAULT NULL,
  `CustermerId` varchar(15) DEFAULT NULL,
  `P_name` varchar(75) DEFAULT NULL,
  `P_price` decimal(9,2) DEFAULT NULL,
  `P_image1` varchar(40) DEFAULT NULL,
  `S_date` datetime DEFAULT current_timestamp(),
  `S_qty` int(11) DEFAULT NULL,
  `S_size` varchar(30) DEFAULT NULL,
  `status_items` varchar(15) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`S_cartId`, `ProductId`, `CustermerId`, `P_name`, `P_price`, `P_image1`, `S_date`, `S_qty`, `S_size`, `status_items`) VALUES
('S0001', 'P004', 'U001', 'Akasi High Waist WW Pant', 980.00, 'pImage4.jpg', '2024-11-16 16:56:40', 2, 'Small', 'Ordering'),
('S0002', 'P009', 'U001', 'Kids Printed Pijama Set', 1050.00, 'pImage3.jpg', '2024-11-16 16:56:53', 3, 'Extra Large', 'Ordering'),
('S0003', 'P012', 'U001', 'Versatile Cotton Polo T-Shirt', 1550.00, 'blue1.jpg', '2024-11-16 16:57:07', 3, 'Extra Large', 'Ordering'),
('S0004', 'P010', 'U001', 'Classic Slim-Fit Formal Shirt', 1800.00, 'bisnuess1.jpg', '2024-11-16 16:59:47', 2, 'Large', 'Ordering');

--
-- Triggers `cart`
--
DELIMITER $$
CREATE TRIGGER `before_insert_cart` BEFORE INSERT ON `cart` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE new_id VARCHAR(15);

    -- Find the max numeric part of the ID, then increment it
    SELECT COALESCE(MAX(CAST(SUBSTRING(S_cartId, 2) AS UNSIGNED)), 0) + 1 INTO max_id FROM cart;
    SET new_id = CONCAT('S', LPAD(max_id, 4, '0'));

    -- Set the new ID to the auto-incremented value
    SET NEW.S_cartId = new_id;
END
$$
DELIMITER ;

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

--
-- Triggers `category`
--
DELIMITER $$
CREATE TRIGGER `before_insert_category` BEFORE INSERT ON `category` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE new_id VARCHAR(15);

    -- Find the max numeric part of the ID, then increment it
    SELECT COALESCE(MAX(CAST(SUBSTRING(CategoryId, 2) AS UNSIGNED)), 0) + 1 INTO max_id FROM category;
    SET new_id = CONCAT('C', LPAD(max_id, 3, '0'));

    -- Set the new ID to the auto-incremented value
    SET NEW.CategoryId = new_id;
END
$$
DELIMITER ;

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
('P004', 'Akasi High Waist WW Pant', 'C002', 980.00, 1, 'pImage4.jpg', 'pImage2.jpg', 'pImage3.jpg', 'pImage1.jpg', 'Model Height 5 6, wearing size 30 Please bear in mind that the photo may be slightly different from the actual item in terms of colour due to lighting conditions or the display used to view   Wash And', '1', '1', '1', '0', '1'),
('P005', 'Aura Paisley Printed Maxi Dress', 'C002', 1100.00, 1, 'pImage4.jpg', 'pImage2.jpg', 'pImage3.jpg', 'pImage1.jpg', 'wearing size M Please bear in mind that the photo may be slightly different from the actual item in terms of colour due to lighting conditions or the display used to view', '1', '1', '1', '0', '1'),
('P006', 'Bella Oversized Printed Crop Top', 'C002', 1230.00, 1, 'pImage4.jpg', 'pImage2.jpg', 'pImage3.jpg', 'pImage1.jpg', 'Model Height 5 6 wearing size M Please bear in mind that the photo may be slightly different from the actual item in terms of colour due to lighting conditions or the display used to view', '1', '1', '1', '0', '1'),
('P007', 'Lily Printed Back Criss Cross Frock', 'C003', 720.00, 1, 'pImage3.jpg', 'pImage2.jpg', 'pImage1.jpg', 'pImage4.jpg', 'Model Height 3 10, Age 7Y Please bear in mind that the photo may be slightly different from the actual item in terms of colour due to lighting conditions or the display used to view', '1', '1', '1', '0', '1'),
('P009', 'Kids Printed Pijama Set', 'C003', 1050.00, 1, 'pImage3.jpg', 'pImage2.jpg', 'pImage1.jpg', 'pImage4.jpg', 'Model Height 3 10, Age 7Y Please bear in mind that the photo may be slightly different from the actual item in terms of colour due to lighting conditions or the display used to view', '1', '0', '0', '1', '1'),
('P010', 'Classic Slim-Fit Formal Shirt', 'C001', 1800.00, 1, 'bisnuess1.jpg', 'bisnuess2.jpg', 'bisnuess3.jpg', 'bisnuess4.jpg', 'Elevate your professional wardrobe with our Classic Slim-Fit Formal Shirt. Designed with precision tailoring, this shirt offers a sleek silhouette that enhances your style and confidence. Made from a ', '1', '0', '1', '1', '1'),
('P011', 'Premium Straight-Leg Jeans', 'C001', 2100.00, 1, 'black1.webp', 'black2.webp', 'black3.jpg', 'black4.jpg', 'Experience ultimate comfort and style with our Premium Straight-Leg Jeans. Crafted from high-quality denim, these jeans combine durability with a modern fit that\'s perfect for casual or semi-formal we', '0', '1', '1', '0', '1'),
('P012', 'Versatile Cotton Polo T-Shirt', 'C001', 1550.00, 1, 'blue1.jpg', 'blue2.jpg', 'blue3.jpg', 'blue4.jpg', 'Stay cool and stylish with our Versatile Cotton Polo T-Shirt. Made from 100% breathable cotton, this polo offers a perfect combination of comfort and casual elegance. The ribbed collar and sleeve cuff', '1', '0', '0', '1', '1'),
('P013', 'Modern Hooded Sweatshirt', 'C001', 1499.00, 1, 'body3.webp', 'body1.webp', 'body2.jpg', 'body4.jpg', 'Stay cozy and on-trend with our Modern Hooded Sweatshirt. Crafted from a soft cotton-polyester blend, this hoodie offers warmth and style for chilly days. It features a front kangaroo pocket, drawstri', '1', '1', '1', '1', '1'),
('P014', 'Classic Chino Pants', 'C001', 1760.00, 1, 'normal2.jpg', 'normal1.jpg', 'normal3.jpg', 'normal4.webp', 'Redefine smart-casual dressing with our Classic Chino Pants. These versatile trousers are made from a premium cotton-spandex blend, offering a perfect balance of comfort and stretch. With a tapered fi', '0', '1', '0', '1', '1');

--
-- Triggers `clothproduct`
--
DELIMITER $$
CREATE TRIGGER `before_insert_product` BEFORE INSERT ON `clothproduct` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE new_id VARCHAR(15);

    -- Find the max numeric part of the ID, then increment it
    SELECT COALESCE(MAX(CAST(SUBSTRING(ProductId, 2) AS UNSIGNED)), 0) + 1 INTO max_id FROM clothproduct;
    SET new_id = CONCAT('P', LPAD(max_id, 3, '0'));

    -- Set the new ID to the auto-incremented value
    SET NEW.ProductId = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustermerId` varchar(15) NOT NULL,
  `C_username` varchar(50) DEFAULT NULL,
  `C_fullname` varchar(150) DEFAULT NULL,
  `C_email` varchar(100) DEFAULT NULL,
  `C_hashpassword` varchar(100) DEFAULT NULL,
  `C_mobile` varchar(15) DEFAULT NULL,
  `C_image` varchar(50) DEFAULT 'cImage.jpg',
  `C_status` char(5) DEFAULT '1',
  `otp_code` varchar(10) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT 0,
  `C_street` varchar(60) DEFAULT NULL,
  `C_city` varchar(60) DEFAULT NULL,
  `C_zipCode` varchar(20) DEFAULT NULL,
  `C_province` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustermerId`, `C_username`, `C_fullname`, `C_email`, `C_hashpassword`, `C_mobile`, `C_image`, `C_status`, `otp_code`, `is_verified`, `C_street`, `C_city`, `C_zipCode`, `C_province`) VALUES
('U001', 'DM0123', 'Dhanushka', 'Mahesh404dhanushka2024ms@gmail.com', '$2y$10$gSb6Hgiii/tmXmbac0ufguPuNo6a9lwKpT8Yy8dOPKUlQ5giCqMsK', '0766640384', 'cImage.jpg', '1', '993226', 1, '54/1,Marawanagoda,Werellagama.', 'kandy', '20080', 'Central');

--
-- Triggers `customers`
--
DELIMITER $$
CREATE TRIGGER `before_insert_customer` BEFORE INSERT ON `customers` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE new_id VARCHAR(15);

    -- Find the max numeric part of the ID, then increment it
    SELECT COALESCE(MAX(CAST(SUBSTRING(CustermerId, 2) AS UNSIGNED)), 0) + 1 INTO max_id FROM customers;
    SET new_id = CONCAT('U', LPAD(max_id, 3, '0'));

    -- Set the new ID to the auto-incremented value
    SET NEW.CustermerId = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderId` varchar(15) NOT NULL,
  `CustomerId` varchar(15) DEFAULT NULL,
  `O_fullName` varchar(100) DEFAULT NULL,
  `O_emailAddress` varchar(100) DEFAULT NULL,
  `O_street` varchar(100) DEFAULT NULL,
  `O_city` varchar(50) DEFAULT NULL,
  `O_province` varchar(30) DEFAULT NULL,
  `O_zip_code` varchar(20) DEFAULT NULL,
  `O_country` varchar(30) DEFAULT 'Sri Lanka',
  `O_phone_number` varchar(15) DEFAULT NULL,
  `O_payment_method` varchar(25) DEFAULT 'Cash on Delivery',
  `O_status` varchar(30) DEFAULT 'Send to Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderId`, `CustomerId`, `O_fullName`, `O_emailAddress`, `O_street`, `O_city`, `O_province`, `O_zip_code`, `O_country`, `O_phone_number`, `O_payment_method`, `O_status`) VALUES
('ORD0001', 'U001', 'Dhanushka', 'Mahesh404dhanushka2024ms@gmail.com', '54/1,Marawanagoda,Werellagama.', 'kandy', 'Central', '20080', 'Sri Lanka', '0766640384', 'Cash on Delivery', 'Send to Admin'),
('ORD0002', 'U001', 'Dhanushka', 'Mahesh404dhanushka2024ms@gmail.com', '54/1,Marawanagoda,Werellagama.', 'kandy', 'Central', '20080', 'Sri Lanka', '0766640384', 'Cash on Delivery', 'Send to Admin');

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `before_insert_orders` BEFORE INSERT ON `orders` FOR EACH ROW BEGIN
   DECLARE next_id INT;
   -- Get the maximum order ID and increment it by 1
   SET next_id = (SELECT IFNULL(MAX(CAST(SUBSTRING(OrderId, 4) AS UNSIGNED)), 0) + 1 FROM orders);
   -- Generate the new OrderId by padding the next_id with leading zeros to ensure 4 digits
   SET NEW.OrderId = CONCAT('ORD', LPAD(next_id, 4, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `OrderItemsId` varchar(15) NOT NULL,
  `OrderId` varchar(15) DEFAULT NULL,
  `CartId` varchar(15) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`OrderItemsId`, `OrderId`, `CartId`, `qty`) VALUES
('SAL00001', 'ORD0001', 'S0001', 2),
('SAL00002', 'ORD0001', 'S0002', 3),
('SAL00003', 'ORD0001', 'S0003', 3),
('SAL00004', 'ORD0001', 'S0004', 2),
('SAL00005', 'ORD0002', 'S0004', 2);

--
-- Triggers `order_items`
--
DELIMITER $$
CREATE TRIGGER `before_insert_order_items` BEFORE INSERT ON `order_items` FOR EACH ROW BEGIN
    DECLARE new_id VARCHAR(15);
    DECLARE max_id INT;
    
    -- Find the maximum existing ID, extract the numeric part, and increment it
    SELECT MAX(CAST(SUBSTRING(OrderItemsId, 4) AS UNSIGNED)) INTO max_id
    FROM order_items;

    -- If no previous entries, start from 1
    IF max_id IS NULL THEN
        SET new_id = CONCAT('SAL', LPAD(1, 5, '0'));
    ELSE
        SET new_id = CONCAT('SAL', LPAD(max_id + 1, 5, '0'));
    END IF;

    -- Set the generated ID for the new row
    SET NEW.OrderItemsId = new_id;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`S_cartId`),
  ADD KEY `ProductId` (`ProductId`),
  ADD KEY `CustermerId` (`CustermerId`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderId`),
  ADD KEY `CustomerId` (`CustomerId`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`OrderItemsId`),
  ADD KEY `OrderId` (`OrderId`),
  ADD KEY `CartId` (`CartId`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `clothproduct` (`ProductId`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`CustermerId`) REFERENCES `customers` (`CustermerId`);

--
-- Constraints for table `clothproduct`
--
ALTER TABLE `clothproduct`
  ADD CONSTRAINT `clothproduct_ibfk_1` FOREIGN KEY (`P_categoryId`) REFERENCES `category` (`CategoryId`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`CustomerId`) REFERENCES `customers` (`CustermerId`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`OrderId`) REFERENCES `orders` (`OrderId`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`CartId`) REFERENCES `cart` (`S_cartId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
