-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2024 at 02:27 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food`
--

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id` int(5) NOT NULL,
  `sname` varchar(22) NOT NULL,
  `email` varchar(20) NOT NULL,
  `subject` varchar(20) NOT NULL,
  `msg` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`id`, `sname`, `email`, `subject`, `msg`) VALUES
(23, 'rupesh bhatia', 'trr44@gmail.com', 'trararara', 'fsdfgdfg');

-- --------------------------------------------------------

--
-- Table structure for table `formdata`
--

CREATE TABLE `formdata` (
  `id` int(5) NOT NULL,
  `name` varchar(22) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `phone` int(11) NOT NULL,
  `prole` varchar(20) NOT NULL,
  `pin` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `formdata`
--

INSERT INTO `formdata` (`id`, `name`, `username`, `email`, `password`, `address`, `city`, `state`, `phone`, `prole`, `pin`) VALUES
(16, 'Sammi', 'rajesh123', 'rupesh123@gmail.com', '$2y$10$W5BHYfwk0F2fwEtYT6dCDe3h4IkV4Syrr1EWYvCUAlBovoTRWM.XO', 'jahu', 'hamirpur', 'himachal pradesh', 2147483647, '1', 123052),
(17, 'admin', 'admin123', 'admin@123', '$2y$10$h1OrZILqhiKR7NivIy4GleyXRJNb8OL20xnOElRA880t7xzrqIx8K', 'vill seu', 'hamirpur', 'mandi', 2147483647, '2', 123052),
(18, 'rupesh', 'test2', 'rajesh@gmaiil.com', '$2y$10$yM9ihEqHa.CiAstNr6hv1OOD6sTMqz9ehgS8ewqp1TtM8C2uiYZm.', 'vill seu', 'hamirpur', 'mandi', 3453453, '1', 1123),
(19, 'rupesh', 'rupesh5007', 'rupesh12345678@gmail.com', '$2y$10$bDlIWVDOe4TAgWMZy58n3eZnuTssUKie92igheV82jeodQ09pB8v6', 'hamirpur', 'hamirpur', 'hamirpur', 2147483647, '1', 1235566),
(20, 'rupesh', 'admin5007', 'rupesh1234567866@gmail.com', '$2y$10$zq4NKuIJufsuF9ASNMCYN.goC/J/9jyqud9f9UY15zpTTTcSUXkgq', 'hamirpur', 'hamirpur', 'hamirpur', 2147483647, '2', 1235566);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(5) NOT NULL,
  `image` varchar(100) NOT NULL,
  `iname` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `price` int(5) NOT NULL,
  `type` varchar(100) NOT NULL,
  `code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `image`, `iname`, `description`, `price`, `type`, `code`) VALUES
(23, '2 Veg Longer Burger.jpg', 'Veg Burger', ' Greek yogurt and cucumber sauce. ', 200, 'veg', 'b201'),
(24, '2 pcs Smoky Red Chicken.png', 'Smoky Red chicken', 'Crispy Chicken 200g', 500, 'nonveg', 's234'),
(25, '7UP Can 300 ml.jpg', '7up', '20% discount', 70, 'veg', 'c405'),
(26, 'fruit_salad_.jpg', 'Mixed Fruit Salad', '200gm', 200, 'veg', 'c606'),
(27, 'Chicken Longer Burger &amp; 2 Strips Combo.jpg', 'Chicken Longer Burge', '2 burgers with 2 strips combo', 250, 'nonveg', 'c9902');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(5) NOT NULL,
  `item` varchar(100) NOT NULL,
  `price` int(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `quantity` int(5) NOT NULL,
  `orderid` varchar(150) NOT NULL,
  `status` varchar(20) NOT NULL,
  `createdat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `orderstatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `item`, `price`, `username`, `quantity`, `orderid`, `status`, `createdat`, `orderstatus`) VALUES
(16, 'Veg Burger', 200, 'rajesh123', 1, '65929db3c08a4', 'payment success', '2024-03-27 17:28:46', 'dispatched'),
(17, 'Smoky Red chicken', 500, 'rajesh123', 1, '65929db3c08a4', 'payment success', '2024-03-27 17:28:46', 'dispatched'),
(18, 'Veg Burger', 200, 'rajesh123', 1, '6592b9042a05a', 'payment success', '2024-03-27 17:24:31', 'delivered'),
(19, 'Smoky Red chicken', 500, 'rajesh123', 2, '6592b9042a05a', 'payment success', '2024-03-27 17:24:31', 'delivered'),
(20, 'Veg Burger', 200, 'rajesh123', 1, '6592d662c41ea', 'payment success', '2024-03-27 17:24:31', 'delivered'),
(21, 'Veg Burger', 200, 'rajesh123', 1, '6592e6508c255', 'payment success', '2024-01-01 16:20:34', ''),
(22, 'Smoky Red chicken', 500, 'rajesh123', 1, '6592e6508c255', 'payment success', '2024-01-01 16:20:34', ''),
(23, 'Veg Burger', 200, 'rajesh123', 4, '6592f1e7b68a4', 'payment success', '2024-03-27 17:24:31', 'delivered'),
(24, 'Veg Burger', 200, 'test2', 1, '659304bdee0f1', 'payment success', '2024-03-27 17:07:01', 'delivered'),
(25, 'Smoky Red chicken', 500, 'test2', 1, '659304bdee0f1', 'payment success', '2024-03-27 17:07:01', 'delivered'),
(27, 'Veg Burger', 200, 'rupesh5007', 1, '65e2bd8c537c5', 'payment success', '2024-03-27 17:21:16', 'delivered'),
(28, 'Veg Burger', 200, 'rupesh5007', 1, '65e2bdf86413b', 'payment success', '2024-03-27 17:21:16', 'delivered');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `formdata`
--
ALTER TABLE `formdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `formdata`
--
ALTER TABLE `formdata`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
