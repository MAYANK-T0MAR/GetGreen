-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2024 at 12:49 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test1`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(180, 8, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `supplier_id`, `price`, `quantity`, `total_price`, `order_date`, `status`) VALUES
(68, 11, 2, 5, 70.00, 1, 70.00, '2024-04-05 02:32:42', 'cancelled'),
(82, 11, 2, 5, 57.00, 1, 57.00, '2024-04-08 06:36:55', 'delivered'),
(83, 20, 2, 5, 57.00, 2, 114.00, '2024-04-11 03:03:19', 'cancelled'),
(84, 20, 2, 5, 57.00, 1, 57.00, '2024-04-11 03:14:04', 'cancelled'),
(85, 11, 4, 5, 200.00, 4, 800.00, '2024-04-11 04:51:40', 'received'),
(89, 8, 2, 5, 57.00, 3, 171.00, '2024-05-12 09:05:31', 'cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `plants`
--

CREATE TABLE `plants` (
  `id` int(11) NOT NULL,
  `size` varchar(50) NOT NULL,
  `sizeDescription` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `img` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `best` tinyint(1) NOT NULL,
  `featured` tinyint(1) NOT NULL,
  `description` text NOT NULL,
  `light` text NOT NULL,
  `care` text NOT NULL,
  `supplier_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plants`
--

INSERT INTO `plants` (`id`, `size`, `sizeDescription`, `name`, `img`, `price`, `best`, `featured`, `description`, `light`, `care`, `supplier_id`) VALUES
(2, 'large', '6-10ft tall', 'new plant 2 (from mysql database, cheap)', 'https://images.unsplash.com/photo-1485955900006-10f4d324d411?q=80&amp;w=2072&amp;auto=format&amp;fit=crop&amp;ixlib=rb-4.0.3&amp;ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 55.00, 1, 0, 'You can`t go wrong with carefree plants', 'jfhdjfh kjdfhdjk', 'Easy - Simple weekly waterings will keep your plant happy.', 5),
(3, 'small', '5-6 ft tall', 'Inserted plant', 'https://plus.unsplash.com/premium_photo-1669243451680-c318522b9949?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 200.00, 1, 1, 'a newly added plant to the collection', 'needs average lighting like others', 'needs water 2 times a day', 5),
(4, 'medium', '7-8 ft tall', 'Inserted Plant', 'https://images.unsplash.com/photo-1507988914355-bf49fdbc7368?q=80&w=1956&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 200.00, 1, 1, 'Another inserted plant by admin', 'needs good lighting', 'needs proper care', 5),
(5, 'large', '9-10 ft tall', 'Inserted Plant 3', 'https://images.unsplash.com/photo-1519241923167-9c69efe2d7b6?q=80&w=2002&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 400.00, 1, 1, '3rd inserted plant by admin', 'needs good lighting', 'needs proper care', 5),
(6, 'large', '9-10 ft tall', 'Inserted Plant 4 (updated)', 'https://images.unsplash.com/photo-1519336056116-bc0f1771dec8?q=80&amp;w=1974&amp;auto=format&amp;fit=crop&amp;ixlib=rb-4.0.3&amp;ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 400.00, 1, 1, '4th inserted plant by admin', 'needs good lighting', 'needs proper care', 4),
(7, 'small', '5-6 ft tall', 'new plant 2', 'https://images.unsplash.com/photo-1524274518417-e7b3f1879339?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 500.00, 1, 1, 'new plant inserted in the lab', 'needs average lighting', 'needs average care', 4),
(8, 'small', '5-6 ft tall', 'new plant 3 inserted in lab', 'https://images.unsplash.com/photo-1463320898484-cdee8141c787?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 600.00, 1, 1, 'new plant inserted in the lab ', 'average lighting needed', 'average care needed', 4),
(10, 'small', '5-6 ft tall', 'Plant by kyari', 'https://images.unsplash.com/photo-1524274518417-e7b3f1879339?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 100.00, 1, 0, 'test description', 'needs average lighting', 'needs average care', 4),
(11, 'large', '5-6 ft tall', 'new plant TT', 'https://images.unsplash.com/photo-1524274518417-e7b3f1879339?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 99.00, 0, 0, 'jhjhgjhgjhg', 'jhjjhgjhgjhg', 'jhgjhgjhgj', 4),
(12, 'small', '5-6 ft tall', 'rose', 'https://images.unsplash.com/photo-1435783459217-ee7fe5414abe?q=80&amp;w=1974&amp;auto=format&amp;fit=crop&amp;ixlib=rb-4.0.3&amp;ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 150.00, 0, 0, 'a regular rose plant', 'average light needed', 'average care needed', 5),
(13, 'large', '5-6 ft tall', 'product by store 1', 'https://images.unsplash.com/photo-1435783459217-ee7fe5414abe?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 100.00, 0, 0, 'kdfhdkhf', 'jdfdjkfh', 'kdjfhdkjfh', 7);

-- --------------------------------------------------------

--
-- Table structure for table `registration1`
--

CREATE TABLE `registration1` (
  `id` int(11) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `number` bigint(10) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration1`
--

INSERT INTO `registration1` (`id`, `firstName`, `lastName`, `email`, `password`, `number`, `address`) VALUES
(6, 'mmm', 'iii', 'ggg@gmail.com', '4512247', 6663354, ''),
(7, 'kkk', 'ttt', 'rr@gmail.com', '444585', 7899, ''),
(8, 'Tyler', 'durden', 'tyler@gmail.com', '321', 123, ''),
(9, 'tyler', 'snk', 'dfbd@gmail.com', '4444', 7897, ''),
(11, 'aman', 'tomar', 'aman@gmail.com', '123', 123, 'new delhi, 456000, old high court road, 57-appartment, 4th floor, UT-5478'),
(12, 'dhruv', 'verma', 'abc@gmail.com', '123456', 6260325475, ''),
(13, 'dhruv', 'verma', 'abc@gmail.com', '123456', 6260325475, ''),
(14, '555', '456', 'abc@gmail.com', 'jhfdtt', 0, ''),
(15, 'Only letters and whi', 'sjdfhjkfh', 'abc@gmail.com', '545435', 354354, ''),
(16, '545454', 'bdjd', 'abc@gmail.com', '6454', 542545, ''),
(17, 'dhruv', 'verma', 'dhruv@gmail.com', '123', 1234567890, ''),
(18, 'aru', 'yo', 'aru@gmail.com', '123', 1234567890, ''),
(20, 'new', 'user', 'new12@gmail.com', '123456789f', 7894561230, 'hgjh kjhjk kkjhkj 656 Y-655, PK/654, hjhjjjg kjhk, kkjhkj, kjhkj');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `store_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `email`, `password`, `store_name`) VALUES
(1, 'new@gmail.com', '123', 'local nursery'),
(2, 'new2@gmail.com', '1232', 'local nursery2'),
(4, 'new4@gmail.com', '123', 'Kyaari'),
(5, 'new5@gmail.com', '123', 'local nursery'),
(6, 'store2@gmail.com', '123', 'store2'),
(7, 'store1@gmail.com', '123', 'store1'),
(10, 'djfdj@gmail.com', '12345678f', 'kdjd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fk_product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `fk_orders_products` (`product_id`);

--
-- Indexes for table `plants`
--
ALTER TABLE `plants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_supplier_id` (`supplier_id`);

--
-- Indexes for table `registration1`
--
ALTER TABLE `registration1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `plants`
--
ALTER TABLE `plants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `registration1`
--
ALTER TABLE `registration1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_product_id` FOREIGN KEY (`product_id`) REFERENCES `plants` (`id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `registration1` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_products` FOREIGN KEY (`product_id`) REFERENCES `plants` (`id`),
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registration1` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`);

--
-- Constraints for table `plants`
--
ALTER TABLE `plants`
  ADD CONSTRAINT `fk_supplier_id` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
