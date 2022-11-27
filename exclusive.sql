-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 02, 2021 at 03:37 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exclusive`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `ordering` int(11) NOT NULL,
  `visibilty` tinyint(4) NOT NULL DEFAULT 0,
  `allow_comment` tinyint(4) NOT NULL DEFAULT 0,
  `allow_ads` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `ordering`, `visibilty`, `allow_comment`, `allow_ads`) VALUES
(7, 'electronics', 'electronics', 2, 0, 0, 0),
(8, 'cell phones', 'cell phones', 3, 0, 0, 0),
(9, 'hand made', 'hand made items', 4, 0, 0, 0),
(10, 'clothing', 'clothing', 5, 0, 0, 0),
(11, 'computers', 'computers items', 1, 0, 0, 0),
(12, 'software', 'software items', 6, 0, 0, 0),
(13, 'toys and game', 'toys and game for ', 7, 0, 0, 0),
(14, 'smart home', 'smart home', 7, 0, 0, 0),
(15, 'nike product', 'nike product', 8, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `comment_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`c_id`),
  KEY `item_comment` (`item_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(255) NOT NULL,
  `add_date` date NOT NULL,
  `country_made` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `rating` smallint(6) NOT NULL,
  `approve` tinyint(4) NOT NULL DEFAULT 0,
  `cat_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `member_1` (`member_id`),
  KEY `cat_1` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `price`, `add_date`, `country_made`, `status`, `rating`, `approve`, `cat_id`, `member_id`) VALUES
(11, 'keyboard', 'very good keyboard ', '$10', '2021-11-12', 'china', '1', 4, 0, 11, 34),
(13, 'speakers', 'good speakers', '$30', '2021-11-12', 'china', '2', 4, 0, 7, 21),
(15, 'windows 11', 'windows 11 promo', '$100', '2021-11-12', 'Europe', '1', 5, 0, 12, 41),
(16, 'shirt', ' high Quality shirt ', '$50', '2021-11-12', 'china', '1', 4, 0, 10, 21),
(18, 'windows vista', 'windows vista original', '$100', '2021-11-13', 'Europe', '1', 5, 0, 12, 21),
(21, 'windows', 'windows', '$200', '2021-11-13', 'Europe', '2', 4, 0, 12, 34),
(23, 'play station 4 game ', 'play station 4 game ', '$50', '2021-11-13', 'USA', '1', 5, 0, 13, 34),
(26, 'electronics', 'pc and mobile phones', '$100', '2021-10-13', 'Europe', '1', 5, 0, 12, 57),
(27, 'electronics', 'pc and mobile phones', '$100', '2021-10-13', 'Europe', '1', 5, 0, 9, 34),
(28, 'electronics', 'pc and mobile phones', '$100', '2021-11-14', 'Europe', '1', 4, 0, 12, 1),
(29, 'electronics', 'pc and mobile phones', '$100', '2021-11-16', 'Europe', '1', 4, 0, 12, 1),
(30, 'keyboard', 'great keyboard', '900', '2021-11-26', 'philippines', '1', 4, 0, 7, 58),
(31, 'phone', 'good phone', '190', '2021-11-27', 'philippines', '1', 4, 0, 8, 58);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `total_price` float(6,2) NOT NULL DEFAULT 0.00,
  `order_status` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `first_name`, `last_name`, `email`, `address`, `address2`, `country`, `state`, `zipcode`, `total_price`, `order_status`, `created_at`, `updated_at`) VALUES
(4, 'Justine Rome', 'Guillermo', 'justineguillermo00@gmail.com', '130 shanghai street', '130 shanghai street', 'United States', 'California', '1551', 19.00, 'confirmed', '2021-11-27 01:56:23', '2021-11-27 01:56:23');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `product_price` float(6,2) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total_price` double(6,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_name`, `product_price`, `qty`, `total_price`) VALUES
(1, 3, 1, 'Black T-shirt', 10.00, 1, 9.50),
(2, 3, 3, 'Maroon T-shirt', 10.00, 5, 47.50),
(3, 3, 4, 'Orange T-shirt', 10.00, 6, 57.00),
(4, 4, 1, 'Black T-shirt', 9.50, 2, 19.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) DEFAULT NULL,
  `product_slug` varchar(255) DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `full_description` text DEFAULT NULL,
  `price` double(255,2) DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `product_id` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_slug`, `short_description`, `full_description`, `price`, `is_featured`, `is_active`, `created_at`, `updated_at`, `product_id`) VALUES
(1, 'Black T-shirt', 'black-tshirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis omnis suscipit esse ipsam officia. Quis sint nihil magnam explicabo veniam hic. Vitae nam iusto reiciendis ratione sed suscipit, aspernatur repudiandae.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis omnis suscipit esse ipsam officia. Quis sint nihil magnam explicabo veniam hic. Vitae nam iusto reiciendis ratione sed suscipit, aspernatur repudiandae.\r\n\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis omnis suscipit esse ipsam officia. Quis sint nihil magnam explicabo veniam hic. Vitae nam iusto reiciendis ratione sed suscipit, aspernatur repudiandae.\r\n\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis omnis suscipit esse ipsam officia. Quis sint nihil magnam explicabo veniam hic. Vitae nam iusto reiciendis ratione sed suscipit, aspernatur repudiandae.', 900.00, 0, 1, '2021-02-11 22:02:17', '2021-02-11 22:02:21', 1),
(2, 'Blue T-shirt', 'blue-tshirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis omnis suscipit esse ipsam officia. Quis sint nihil magnam explicabo veniam hic. Vitae nam iusto reiciendis ratione sed suscipit, aspernatur repudiandae.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis omnis suscipit esse ipsam officia. Quis sint nihil magnam explicabo veniam hic. Vitae nam iusto reiciendis ratione sed suscipit, aspernatur repudiandae.', 900.00, 0, 1, '2021-02-11 22:02:50', '2021-02-11 22:02:53', 2),
(3, 'Maroon T-shirt', 'maroon-tshirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis omnis suscipit esse ipsam officia. Quis sint nihil magnam explicabo veniam hic. Vitae nam iusto reiciendis ratione sed suscipit, aspernatur repudiandae.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis omnis suscipit esse ipsam officia. Quis sint nihil magnam explicabo veniam hic. Vitae nam iusto reiciendis ratione sed suscipit, aspernatur repudiandae.', 900.00, 0, 1, '2021-02-11 22:03:21', '2021-02-11 22:03:24', 3),
(4, 'Orange T-shirt', 'orange-tshirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis omnis suscipit esse ipsam officia. Quis sint nihil magnam explicabo veniam hic. Vitae nam iusto reiciendis ratione sed suscipit, aspernatur repudiandae.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis omnis suscipit esse ipsam officia. Quis sint nihil magnam explicabo veniam hic. Vitae nam iusto reiciendis ratione sed suscipit, aspernatur repudiandae.', 900.00, 0, 1, '2021-02-11 22:03:50', '2021-02-11 22:03:53', 4),
(5, 'anyname', 'productslug', '2021-02-11 22:02:21', '2021-02-11 22:02:21', 25.00, 0, 1, '2021-02-11 22:02:21', '2021-02-11 22:02:21', 5),
(6, 'demonhunters', 'demonhunters', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas rutrum sagittis venenatis. Ut id l', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas rutrum sagittis venenatis. Ut id libero quis leo auctor efficitur. In hac habitasse platea dictumst. Duis viverra feugiat nisl, at feugiat risus convallis in. Vivamus luctus vestibulum finibus. Etiam ornare dignissim purus sed sollicitudin. Quisque iaculis non quam eget fermentum. Cras mollis gravida quam. Curabitur eleifend, tortor ac gravida vulputate, ligula dolor dapibus enim, ac auctor velit diam eu dolor. Suspendisse pulvinar enim lectus, tempor consectetur felis ultrices in. Nullam molestie ultricies est, eu congue sem imperdiet nec.', 900.00, 0, 1, '2021-28-11 20:51:42', '2021-28-11 20:51:42', 492),
(7, 'jbl speakers', 'jblspeakers', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas rutrum sagittis venenatis. Ut id l', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas rutrum sagittis venenatis. Ut id libero quis leo auctor efficitur. In hac habitasse platea dictumst. Duis viverra feugiat nisl, at feugiat risus convallis in. Vivamus luctus vestibulum finibus. Etiam ornare dignissim purus sed sollicitudin. Quisque iaculis non quam eget fermentum. Cras mollis gravida quam. Curabitur eleifend, tortor ac gravida vulputate, ligula dolor dapibus enim, ac auctor velit diam eu dolor. Suspendisse pulvinar enim lectus, tempor consectetur felis ultrices in. Nullam molestie ultricies est, eu congue sem imperdiet nec.', 10000.00, 1, 1, '2021-28-11 21:38:49', '2021-28-11 21:38:49', 981);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE IF NOT EXISTS `product_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `display_order` int(11) DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `img`, `display_order`, `is_featured`) VALUES
(1, 1, 'black-tshirt-1.jpg', 1, 1),
(5, 2, 'blue-tshirt-1.jpg', 1, 1),
(7, 3, 'maroon-tshirt.jpg', 1, 1),
(8, 4, 'orange-tshirt-1.jpg', 1, 1),
(9, 5, 'anyname.jpg', 1, 1),
(10, 492, 'wp5138328.jpg', 1, 1),
(11, 981, '61a3866929ea36.93873338.png', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf16 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Fullname` varchar(255) CHARACTER SET utf8 NOT NULL,
  `GroupID` int(11) NOT NULL DEFAULT 0,
  `trustStatus` int(11) NOT NULL DEFAULT 0,
  `regStatus` int(11) NOT NULL DEFAULT 0,
  `Date` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`userID`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `Email`, `Fullname`, `GroupID`, `trustStatus`, `regStatus`, `Date`) VALUES
(1, 'kaye', '8cb2237d0679ca88db6464eac60da96345513964', 'kaye@gmail.com', 'kaye', 1, 0, 0, '2021-11-12'),
(21, 'lyka', '8cb2237d0679ca88db6464eac60da96345513964', 'lyka@gmail.com', 'lyka', 0, 0, 0, '2021-11-12'),
(34, 'kyla', '8cb2237d0679ca88db6464eac60da96345513964', 'kyla@gamil.com', 'kyla', 1, 1, 1, '2021-11-12'),
(41, 'sammy', '8cb2237d0679ca88db6464eac60da96345513964', 'sammy@gmail.com', 'sammy', 0, 0, 1, '2021-11-12'),
(57, 'lily', '8cb2237d0679ca88db6464eac60da96345513964', 'lily@gmail.com', 'lily', 0, 0, 1, '2021-11-12'),
(58, 'rome.jg', '545e69a8f53dfa3668a6a28e2a4233142fbcfad8', 'justineguillermo00@gmail.com', 'justine guillermo', 1, 0, 0, '2021-11-24');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `item_comment` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `cat_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_1` FOREIGN KEY (`member_id`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
