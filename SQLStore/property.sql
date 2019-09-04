-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2019 at 09:35 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.28

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
(1, 'admin', 'admin', 'admin@gmail.com', '2016-10-08', '9083462872', '2019-05-01 11:31:03', 1, 1, '0000-00-00'),
(13, 'customer', 'admin', 'customer@gmailcom', '0000-00-00', '8422054299', '2019-05-01 13:39:11', 1, 2, '0000-00-00'),
(14, 'vivek', '827ccb0eea8a706c4c34a16891f84e7b', 'tyona1@gmail.com', '0000-00-00', '8422054298', '2019-02-26 11:11:39', 1, 2, '0000-00-00'),
(15, 'vivek', '827ccb0eea8a706c4c34a16891f84e7b', 'tyona@gmail5.com', '0000-00-00', '8422054212', '2019-02-28 07:16:48', 1, 2, '0000-00-00'),
(16, 'Adam ', '5f4dcc3b5aa765d61d8327deb882cf99', 'adam@gmail.com', '0000-00-00', '7777777779', '2019-05-01 11:35:34', 1, 2, '0000-00-00'),
(17, 'Sarah', '5f4dcc3b5aa765d61d8327deb882cf99', 'sarah@gmail.com', '0000-00-00', '7777777776', '2019-05-03 05:19:27', 1, 2, '0000-00-00'),
(18, 'admin1@gmail.com', 'password', '', '0000-00-00', '', '2019-05-01 13:40:26', 1, 0, '0000-00-00'),
(19, 'admin1', 'password', 'admin1@gmail.com', '0000-00-00', '', '2019-05-01 13:41:11', 1, 0, '0000-00-00');

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
  `full_address` text NOT NULL,
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

INSERT INTO `tbl_property` (`id`, `name`, `category`, `propert_des`, `image`, `location`, `full_address`, `bedroom`, `bathroom`, `area`, `garage`, `price`, `status`, `add_date`, `updated_date`) VALUES
(1, 'Warwick House', '3', 'description', '1.jpg', 'Amesterdam', '', 2, 2, '1000', 1, 2000, 1, '2019-02-27', '2019-05-01 11:22:13'),
(2, 'Westminster Building', '1', 'Luxurious House', '2.jpg', 'London', '', 1, 1, '500', 0, 400, 1, '2019-02-27', '2019-02-27 11:39:07'),
(3, 'Liverpool House', '1', 'budget house', '4.jpg', 'London', '', 3, 3, '1300', 2, 200, 1, '2019-02-27', '2019-02-27 11:41:19'),
(33, 'Lovely house', '4', 'Bladsafjkdsajflkdsjflkdsj', '1556718593_slider1.jpg', 'Amesterdam ', '', 2, 1, '4', 1, 1500, 1, '2019-05-01', '2019-05-09 23:00:00'),
(34, 'Asda', '3', 'asdfasdfasdfadsfasdf', '1557746001_1551422781_1.jpg', 'Hendon', '', 2, 1, '', 0, 102, 1, '2019-05-13', '2019-05-13 11:13:21'),
(35, 'The perfect house', '3', 'asdfadsfadsfasdfasdfadsfasdfdsafasdfasdf', '1557751690_1.jpg', 'Wondsworth', '77 Aslett Street, SW18 2BE', 1, 1, '', 0, 102, 1, '2019-05-13', '2019-05-13 12:48:10'),
(36, 'The perfect house', '3', 'asdfadsfadsfasdfasdfadsfasdfdsafasdfasdf', '1557752103_1.jpg', 'Wondsworth   ', '77', 1, 1, '', 0, 102, 1, '2019-05-13', '2019-05-12 23:00:00');

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

--
-- Dumping data for table `tbl_property_image`
--

INSERT INTO `tbl_property_image` (`image_id`, `property_id`, `image`, `updattime`) VALUES
(1, 33, '1556718593_slider3.jpg', '2019-05-01 13:49:53'),
(2, 33, '1556718594_slider3.jpg', '2019-05-01 13:49:54'),
(3, 34, '1557746001_4.jpg', '2019-05-13 11:13:21');

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
(1, 'Arthur', 'agent-9623191.jpg', 'Had a wonderful time selecting the dream home for my family with Adam\'s.', 1, '2019-02-27', '2019-05-06 13:21:24'),
(2, 'Tom', 'iron.jpeg', 'I highly recommend the team from Adam\'s for your house', 1, '2019-02-27', '2019-05-06 13:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` bigint(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `update_date` date NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `first_name`, `last_name`, `password`, `email`, `contact_no`, `dob`, `add_date`, `update_date`, `is_admin`) VALUES
(1, '', '', 'adam', 'adam@gmail.com', '', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00', 1),
(2, '', '', '5f4dcc3b5aa765d61d8327deb882cf99', 'cabdi@gmail.com', '7777777777', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00', 2),
(3, '', '', '319f4d26e3c536b5dd871bb2c52e3178', 'cabdi1@gmail.com', '7777777778', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00', 2),
(4, '', '', '5f4dcc3b5aa765d61d8327deb882cf99', 'cardif@gmail.com', '', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00', 0),
(5, '', '', '5f4dcc3b5aa765d61d8327deb882cf99', 'xasan@gmail.com', '', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00', 0),
(6, '', '', '1a1dc91c907325c69271ddf0c944bc72', 'k1557833@kingston.ac.uk', '', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00', 0),
(7, 'Awil', 'Aden', '1a1dc91c907325c69271ddf0c944bc72', 'awil@gmail.com', '', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00', 0),
(8, 'Haji', 'haji', '5f4dcc3b5aa765d61d8327deb882cf99', 'haji@hotmail.com', '', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00', 0),
(9, 'Osman', 'Liban', '5f4dcc3b5aa765d61d8327deb882cf99', 'osman@gmail.com', '', '0000-00-00', '2019-05-06 09:08:44', '0000-00-00', 1),
(10, 'leyla', 'haji', '5f4dcc3b5aa765d61d8327deb882cf99', 'layla@gmail.com', '', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00', 0),
(11, 'Adam', 'Adam', '5f4dcc3b5aa765d61d8327deb882cf99', 'adam1@gmail.com', '', '0000-00-00', '2019-05-09 13:07:57', '0000-00-00', 1);

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
(2, 1, 13, '2000', '2019-02-28'),
(9, 33, 17, '1500', '2019-05-03'),
(10, 2, 17, '400', '2019-05-03'),
(11, 3, 17, '200', '2019-05-03'),
(12, 2, 8, '400', '2019-05-03'),
(13, 3, 8, '200', '2019-05-03');

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
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

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
  MODIFY `prop_id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_property_image`
--
ALTER TABLE `tbl_property_image`
  MODIFY `image_id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_testinomial`
--
ALTER TABLE `tbl_testinomial`
  MODIFY `testinomial_id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  MODIFY `wishlist_id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
