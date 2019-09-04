-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2019 at 09:52 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `property`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `prop_id` bigint(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `dob` date NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` smallint(1) NOT NULL DEFAULT '1',
  `is_super_admin` smallint(1) NOT NULL,
  `update_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`prop_id`, `username`, `password`, `email`, `dob`, `contact_no`, `add_date`, `status`, `is_super_admin`, `update_date`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'tyona@gmail.com', '2016-10-08', '9083462872', '2019-02-23 05:16:53', 1, 1, '0000-00-00'),
(13, 'customer', '827ccb0eea8a706c4c34a16891f84e7b', 'tyona2@gmail.com', '0000-00-00', '8422054299', '2019-02-26 10:46:05', 1, 2, '0000-00-00'),
(14, 'vivek', '827ccb0eea8a706c4c34a16891f84e7b', 'tyona1@gmail.com', '0000-00-00', '8422054298', '2019-02-26 11:11:39', 1, 2, '0000-00-00'),
(15, 'vivek', '827ccb0eea8a706c4c34a16891f84e7b', 'tyona@gmail5.com', '0000-00-00', '8422054212', '2019-02-28 07:16:48', 1, 2, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_agent`
--

CREATE TABLE `tbl_agent` (
  `agent_id` int(16) NOT NULL,
  `name` varchar(500) NOT NULL,
  `image` text NOT NULL,
  `designation` varchar(500) NOT NULL,
  `facebook` text NOT NULL,
  `twitter` text NOT NULL,
  `linkdin` text NOT NULL,
  `instagram` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `add_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_agent`
--

INSERT INTO `tbl_agent` (`agent_id`, `name`, `image`, `designation`, `facebook`, `twitter`, `linkdin`, `instagram`, `status`, `add_date`) VALUES
(1, 'James', 'agent-9623191.jpg', 'Customer Service', '#', '#', '#', '#', 1, '2019-02-27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blog`
--

CREATE TABLE `tbl_blog` (
  `blog_id` bigint(11) NOT NULL,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `title` varchar(500) NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `comment` int(16) NOT NULL,
  `author_name` varchar(500) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `add_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_blog`
--

INSERT INTO `tbl_blog` (`blog_id`, `update_date`, `title`, `image`, `description`, `comment`, `author_name`, `status`, `add_date`) VALUES
(1, '2019-02-28 07:50:54', 'How to Choose the Right Property', '2.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 10, 'Admin', 1, '2019-02-27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_property`
--

CREATE TABLE `tbl_property` (
  `id` bigint(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `category` varchar(100) NOT NULL,
  `propert_des` text NOT NULL,
  `image` varchar(200) NOT NULL,
  `location` text NOT NULL,
  `bedroom` int(3) NOT NULL,
  `bathroom` int(3) NOT NULL,
  `area` varchar(500) NOT NULL,
  `garage` int(3) NOT NULL,
  `price` int(16) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `add_date` varchar(100) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_property`
--

INSERT INTO `tbl_property` (`id`, `name`, `category`, `propert_des`, `image`, `location`, `bedroom`, `bathroom`, `area`, `garage`, `price`, `status`, `add_date`, `updated_date`) VALUES
(1, 'Warwick House', '1', 'description', '1.jpg', 'London', 2, 2, '1000', 1, 2000, 1, '2019-02-27', '2019-02-27 11:33:10'),
(2, 'Westminster Building', '1', 'Luxurious House', '2.jpg', 'London', 1, 1, '500', 0, 400, 1, '2019-02-27', '2019-02-27 11:39:07'),
(3, 'Liverpool House', '1', 'budget house', '4.jpg', 'London', 3, 3, '1300', 2, 200, 1, '2019-02-27', '2019-02-27 11:41:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_property_image`
--

CREATE TABLE `tbl_property_image` (
  `image_id` int(16) NOT NULL,
  `property_id` int(16) NOT NULL,
  `image` text NOT NULL,
  `updattime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_testinomial`
--

CREATE TABLE `tbl_testinomial` (
  `testinomial_id` int(16) NOT NULL,
  `name` varchar(500) NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `add_date` varchar(100) NOT NULL,
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_testinomial`
--

INSERT INTO `tbl_testinomial` (`testinomial_id`, `name`, `image`, `description`, `status`, `add_date`, `updatetime`) VALUES
(1, 'Arthur', 'agent-9623191.jpg', 'Had a wonderful time selecting the dream home for my family with Tyona.', 1, '2019-02-27', '2019-02-27 11:44:33'),
(2, 'Tom', 'iron.jpeg', 'I highly recommend the team from tyona  for your house', 1, '2019-02-27', '2019-02-27 11:46:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

CREATE TABLE `tbl_wishlist` (
  `wishlist_id` int(16) NOT NULL,
  `property_id` int(16) NOT NULL,
  `customer_id` int(16) NOT NULL,
  `price` varchar(100) NOT NULL,
  `add_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_wishlist`
--

INSERT INTO `tbl_wishlist` (`wishlist_id`, `property_id`, `customer_id`, `price`, `add_date`) VALUES
(1, 4, 13, '499', '2019-02-28'),
(2, 1, 13, '2000', '2019-02-28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`prop_id`);

--
-- Indexes for table `tbl_agent`
--
ALTER TABLE `tbl_agent`
  ADD PRIMARY KEY (`agent_id`);

--
-- Indexes for table `tbl_blog`
--
ALTER TABLE `tbl_blog`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indexes for table `tbl_property`
--
ALTER TABLE `tbl_property`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_property_image`
--
ALTER TABLE `tbl_property_image`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `tbl_testinomial`
--
ALTER TABLE `tbl_testinomial`
  ADD PRIMARY KEY (`testinomial_id`);

--
-- Indexes for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD PRIMARY KEY (`wishlist_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `prop_id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_agent`
--
ALTER TABLE `tbl_agent`
  MODIFY `agent_id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_blog`
--
ALTER TABLE `tbl_blog`
  MODIFY `blog_id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_property`
--
ALTER TABLE `tbl_property`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_property_image`
--
ALTER TABLE `tbl_property_image`
  MODIFY `image_id` int(16) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_testinomial`
--
ALTER TABLE `tbl_testinomial`
  MODIFY `testinomial_id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  MODIFY `wishlist_id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
