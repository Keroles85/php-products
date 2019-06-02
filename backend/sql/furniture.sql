-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 01, 2019 at 10:45 AM
-- Server version: 5.7.26-0ubuntu0.19.04.1
-- PHP Version: 7.2.17-0ubuntu0.19.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `furniture`
--

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `id` int(11) NOT NULL,
  `title` varchar(55) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `img_url` varchar(128) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `visible` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`id`, `title`, `caption`, `img_url`, `active`, `visible`) VALUES
(1, 'Brick Wall Dining Room', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ', 'upload/1559132809.jpg', 1, 1),
(2, 'Living Room Sofa Couch Interior', 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat', 'upload/1559133034.jpg', 0, 0),
(3, 'Hanging bulbs', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur', 'upload/1559133542.jpg', 0, 1),
(4, 'Contemporary bedroom', 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 'upload/1559133584.jpg', 0, 1),
(5, 'Practical Office Furniture', 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 'upload/1559133622.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Living Room', 'Your living room is where you share the story of who you are. So our living room furniture helps you do that â€“ with lots of ways to show off the things youâ€™ve done and the places youâ€™ve been. And plenty of comfortable seating â€“ because sharing it all with your favorite people is the best part.'),
(2, 'Office Furniture', 'It might be work, but it doesnâ€™t have to feel like it. All it takes is a comfy chair, home office furniture that keeps things organized, and the right lighting for the job. And by making it easier to tackle those to-doâ€™s, youâ€™ll have more time to spend on your wanna-doâ€™s.'),
(3, 'Dining Room', 'Getting them to the table is easy. So our dining furniture is designed to help with the hard part â€“ keeping them there. Because when the chairs are comfy and the table is just the right size, everyone will be happy to stay for a while (even if thereâ€™s no dessert).'),
(4, 'Bedroom', 'A good nightâ€™s sleep in a comfy bed. Bedroom furniture that gives you space to store your things (in a way that means youâ€™ll find them again). With warm lighting to set the mood and soft textiles to snuggle up in. All at a price that lets you rest easy. Itâ€™s what sweet dreams are made of'),
(5, 'Lighting', 'More than just a practical convenience, the lighting in your home affects how good you feel. So the more control you have over the light level in each room, the better. With a few different light sources, you can change the mood in any space to suit the time of day and what you want to do there. Whether itâ€™s creating romance or chopping carrots. Or even both...');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_url` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `product_id`, `image_url`) VALUES
(1, 1, 'upload/1558962249.jpg'),
(2, 2, 'upload/1558962437.jpg'),
(3, 3, 'upload/1558962624.jpg'),
(4, 4, 'upload/1558962675.jpg'),
(5, 5, 'upload/1558999178.jpg'),
(6, 6, 'upload/1559058510.jpg'),
(7, 7, 'upload/1559069355.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` varchar(512) NOT NULL,
  `featured` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `cat_id`, `name`, `price`, `description`, `featured`) VALUES
(1, 1, 'Simple Living Room', '9900.00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat', 0),
(2, 1, 'Contemporary Living Room', '11550.00', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 1),
(3, 3, 'Wood Dining Room ', '12999.00', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo', 0),
(4, 2, 'High Quality Office Furniture', '25900.00', 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt', 1),
(5, 4, 'Practical Bed Room', '8900.00', 'Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur', 0),
(6, 4, 'Light Bedroom', '15900.00', 'Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', 1),
(7, 5, 'Illumination', '1699.00', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cat` (`cat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
