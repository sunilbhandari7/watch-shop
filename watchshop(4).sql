-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2024 at 03:32 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `watchshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(39, 'Sunil Bhandari', 'sunil7', '501ab5444eae9ad32b562570b36ff628ec3790ce');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_buy`
--

CREATE TABLE `tbl_buy` (
  `id` int(10) UNSIGNED NOT NULL,
  `watch` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_contact` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_buy`
--

INSERT INTO `tbl_buy` (`id`, `watch`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`, `customer_id`, `product_id`) VALUES
(40, 'Everest Black Automatic Watch', '89000.00', 1, '89000.00', '2024-05-13 08:53:08', 'Delivered', 'sunil Bhandari', '9749351919', 'wedfg@gmail.com', ' Kathmandu', 2, 38),
(41, 'Everest Black Watch', '230000.00', 1, '230000.00', '2024-05-20 07:48:40', 'Canceled', 'sunil Bhandari', '9749351919', 'sunilbhandari2021@gmail.com', ' Kathmandu', 2, 39),
(42, 'Charumati Blue', '78999.00', 1, '78999.00', '0000-00-00 00:00:00', 'Delivered', 'wedfghjk', '9749351919', 'sunilbhandari2021@gmail.com', ' Kathmandu', 2, 42);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(4, 'Mens Watch', 'Watch_product_677.png', 'Yes', 'Yes'),
(5, 'Ladies Watch', 'Watch_product_83.png', 'Yes', 'Yes'),
(6, 'Unisex Watch', 'Watch_product_251.png', 'Yes', 'Yes'),
(7, 'gfhjdke', 'Watch_product_212.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `full_name`, `username`, `password`, `email`, `phone`, `address`) VALUES
(2, 'sunil Bhandari', 'wedfghjk', '9a8bf05033641ac54dc6f5dc4aba5419004b38ef', 'sunilbhandari2021@gmail.com', '9749351919', 'Kathmandu');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_watch`
--

CREATE TABLE `tbl_watch` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_watch`
--

INSERT INTO `tbl_watch` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(38, 'Everest Black Automatic Watch', 'This is a Everest Black Automatic Watch which is made up of metal', '89000.00', 'Watch-Name975.png', 4, 'Yes', 'Yes'),
(39, 'Everest Black Watch', 'This is a  Everest Black Watch which is made up of silver metal.', '230000.00', 'Watch-Name184.webp', 4, 'Yes', 'Yes'),
(41, 'Charumati Rose Gold Watch', 'This is a Charumati Rose Gold Watch made up of metal', '120000.00', 'Watch-Name356.webp', 5, 'Yes', 'Yes'),
(42, 'Charumati Blue', 'This is a Charumati Blue Watch which is made up of metal', '78999.00', 'Watch-Name727.webp', 5, 'Yes', 'Yes'),
(44, 'Karma U Black', 'This is a Karma U Black Watch which is made up of metal.', '67890.00', 'Watch-Name13.webp', 6, 'Yes', 'Yes'),
(45, 'Karma Watch', 'This is a Karma Watch which is made up of metal', '56900.00', 'Watch-Name745.webp', 6, 'No', 'No'),
(46, 'Karma U Silver', 'This is a Karma U Silver Watch which is made up of metalic steel.', '190000.00', 'Watch-Name104.webp', 6, 'Yes', 'Yes'),
(47, 'Charumati Green', 'This is a Charumati Green Watch which is made up of metal', '129999.00', 'Watch-Name88.webp', 5, 'Yes', 'Yes'),
(48, 'Everest White Watch', 'This is a Everest Gun Metal White Automatic Watch which is made up of silver gun metal', '89000.00', 'Watch-Name495.webp', 4, 'Yes', 'Yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_buy`
--
ALTER TABLE `tbl_buy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `fk_order_product` (`product_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_watch`
--
ALTER TABLE `tbl_watch`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbl_buy`
--
ALTER TABLE `tbl_buy`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_watch`
--
ALTER TABLE `tbl_watch`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
