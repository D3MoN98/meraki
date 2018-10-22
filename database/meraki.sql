-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2018 at 07:15 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meraki`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(6) NOT NULL,
  `profile_pic` longtext NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `contact_no`, `password`, `dob`, `gender`, `profile_pic`, `date_created`) VALUES
(1, 'Admin', 'admin@gmail.com', '7685868978', '827ccb0eea8a706c4c34a16891f84e7b', '1995-03-11', 'male', 'default.jpg', '2018-09-07 15:03:16');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(5) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `catagory`
--

CREATE TABLE `catagory` (
  `catagory_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catagory`
--

INSERT INTO `catagory` (`catagory_id`, `name`) VALUES
(1, 'CLOTHES'),
(2, 'ACCESSORIES');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city` varchar(30) NOT NULL,
  `pincode` int(11) NOT NULL,
  `address` longtext NOT NULL,
  `landmark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `location` longtext NOT NULL,
  `payment` varchar(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0',
  `is_cancel` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_details_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL,
  `delivery_date` date NOT NULL,
  `delivered_date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `desc` longtext NOT NULL,
  `catagory` int(5) NOT NULL,
  `sub_catagory` int(5) NOT NULL,
  `size` varchar(10) NOT NULL,
  `color` varchar(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `qty` int(11) NOT NULL,
  `tags` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `mrp` float NOT NULL,
  `img` longtext NOT NULL,
  `is_delete` int(2) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `seller_id`, `name`, `slug`, `desc`, `catagory`, `sub_catagory`, `size`, `color`, `gender`, `qty`, `tags`, `price`, `mrp`, `img`, `is_delete`, `date_created`) VALUES
(1, 1, 'PEWDIEPIE WAKDONALDS', 'pewdiepie-wakdonalds', 'Official PewDiePie Merch:Proudly Serving 64 Million+ Customers																																			', 1, 1, 'M', 'White', 'unisex', 5, 'Pewdiepie', 20.99, 34.99, '1536769659-05da1aee75089885e0c4922a8e8f1ad5.jpg', 0, '2018-09-12 16:27:39'),
(2, 1, 'Cyka Blyat: PewDiePie Official Apparel', 'cyka-blyat:-pewdiepie-official-apparel', 'Official PewDiePie Merch:\r\nOnly Real Cykas. A portion of proceeds will support Save The Children.															', 1, 3, 'M', 'Black', 'male', 5, 'Pewdiepie,Russian', 34.99, 39.99, '1536775746-c316464e3c69408be954c6d05edd10a9.jpg', 0, '2018-09-12 18:09:06'),
(3, 1, 'PEWDIEPIE WAKDONALDS', 'pewdiepie-wakdonalds', 'Official PewDiePie Merch. Proudly Serving 64 Million+ Customers																																													', 1, 3, 'XL,2XL', 'Yellow', 'male', 5, 'Pewdiepie', 34.99, 39.99, '1536830168-e47466a2b62c0c5d1a292cd808c2f659.jpg', 0, '2018-09-13 07:57:39'),
(4, 1, 'PEWDIEPIE WAKDONALDS', 'pewdiepie-wakdonalds', 'Official PewDiePie Merch. Proudly Serving 64 Million+ Customers																																			', 1, 2, 'S,M,L', 'Black', 'unisex', 5, 'Pewdiepie', 20.99, 39.99, '1536846295-f62639dade54856369505ae75bac6a14.jpg', 0, '2018-09-13 13:44:55'),
(5, 1, 'PEWDIEPIE WAKDONALDS', 'pewdiepie-wakdonalds', 'Official PewDiePie Merch. Proudly Serving 64 Million+ Customers					', 1, 3, 'M,L,XL,2XL', 'Black', 'male', 5, 'Pewdiepie,Russian', 37.99, 39.99, '1536864081-940c9cf24bd156692decc11df0fe5d41.jpg', 0, '2018-09-13 18:41:21'),
(6, 1, 'PEWDIEPIE WAKDONALDS', 'pewdiepie-wakdonalds', 'Official PewDiePie Merch. Proudly Serving 64 Million+ Customers					', 1, 1, 'F,S,M', 'Black', 'unisex', 4, 'Pewdiepie,Russian', 34.99, 35.99, '1536864278-dc6f22defcd24d66d53975295ef8e33a.jpg', 0, '2018-09-13 18:44:38'),
(7, 2, 'Imagine Dragons Official Charity Tee', 'imagine-dragons-official-charity-tee', '100% of the proceeds go to the Tyler Robinson Foundation which helps families financially and emotionally as they cope with the tragedy of a pediatric cancer diagnosis.					', 1, 1, 'F,S,M,L', 'Black', 'male', 0, 'ImagineDragon,Music', 24.99, 27.99, '1536864739-82f6dfaa4f588b8bd8a52105d8826509.jpg', 0, '2018-09-13 18:52:19'),
(8, 2, 'Shawn Mendes \"Stitches\" Tee, Sweatshirt & Hoodie', 'shawn-mendes-\"stitches\"-tee,-sweatshirt-&-hoodie', '\"For millions of kids around the world, education is the key to a better future. For 2 weeks, these limited-edition items are available with proceeds benefiting Pencils of Promise! My goal is to raise $25K to build 1 school — and I know we can do it!\" - Shawn', 1, 2, 'M,L,XL', 'Black', 'male', 2, 'ShawnMendes,Music', 39.99, 39.99, '1536864893-5e4c9b36e5e5542c4cc01f6655893f3e.png', 0, '2018-09-13 18:54:53'),
(9, 2, 'Camila Cabello\'s ', 'camila-cabello\'s-', '“I am so inspired by what Save the Children is doing to give girls around the world a brighter future. So I wanted to support this amazing cause by designing this special #LoveOnly tee and hoodie.\" - Camila										', 1, 2, 'M,XL', 'Black', 'unisex', 3, 'CamilaCabello,music', 29.99, 35.99, '1537465670-d991836809ad358fa70777902153226b.jpg', 0, '2018-09-20 17:47:50'),
(10, 2, 'Ice Cube \"Bye, Felicia.\" Charity Tee', 'ice-cube-\"bye,-felicia.\"-charity-tee', 'It\'s a saying as iconic as the man himself. Help fight diabetes with the official \"Bye, Felicia.\" shirt only from Represent.', 1, 1, 'M,L', 'Black', 'male', 1, 'IceCube,music', 27.99, 24.99, '1537465754-2cef3ef1f0c10a11b02bf9d9b7277fbd.jpg', 0, '2018-09-20 17:49:14'),
(11, 2, 'Notorious Ltd. Edition \"Definition\" Tee', 'notorious-ltd.-edition-\"definition\"-tee', 'This is a never before seen design available for 2 weeks only. Get one before they are gone for good.', 1, 1, 'M,L', 'Black', 'unisex', 3, 'Notorious,music', 24.99, 24.99, '1537465820-a7e2c8a43a983e37d31c58826adc9227.jpg', 0, '2018-09-20 17:50:20'),
(12, 2, 'Slayer\'s 30th Anniversary Tee', 'slayer\'s-30th-anniversary-tee', 'Get this limited edition Slayer tee to celebrate the 30th anniversary of Reign in Blood on October 7th.', 1, 1, 'M', 'Black', 'male', 3, 'Slayer,music', 24.99, 23.99, '1537465899-35578c9b3b78a04d9975d8cf5e7ea3ae.jpg', 0, '2018-09-20 17:51:39'),
(13, 2, 'Jennifer Lopez’s Official “Lucky To Have These Curves” Tank', 'jennifer-lopez’s-official-“lucky-to-have-these-curves”-tank', '\"I designed this limited edition tank top just for my squad. Join the movement and get yours now before they\'re gone forever!\" - JLO					', 1, 6, 'M,L', 'WHITE', 'female', 3, 'JenniferLopez,music', 24.99, 24.99, '1537466214-8a4039c454321ce0a644d4d1513c6fae.jpg', 0, '2018-09-20 17:56:54'),
(14, 2, 'Niall Horan\'s Limited Edition Charity Tee', 'niall-horan\'s-limited-edition-charity-tee', '100% of the proceeds support Irish Autism Action and the Kate and Justin Rose Foundation \r\nAvailable for two weeks only!\" -- Nialler X', 1, 1, 'S,M,L', 'Black', 'male', 3, 'NiallHoran,music', 24.99, 24.99, '1537466288-01e3ca5526b146aca7fb2416168bf000.jpg', 1, '2018-09-20 17:58:08'),
(15, 3, 'Spider-Man \'\'Amazing Dad\'\' T-Shirt for Adults', 'spider-man-\'\'amazing-dad\'\'-t-shirt-for-adults', 'Show dad how amazing he is with this all-cotton Spider-Man tee celebrating your real life super hero.', 1, 1, 'S,M,L', 'Red', 'male', 3, 'spiderman,marvel', 24, 27.99, '1537607576-6720057110509.jpg', 0, '2018-09-22 09:12:57'),
(16, 3, 'Groot T-Shirt for Adults', 'groot-t-shirt-for-adults', 'Groot branches out and onto this comfortable cotton jersey tee. The tree-mendous Guardian of the Galaxy\'s smiling face is printed with eco-friendly inks.', 1, 1, 'S,M', 'Brown', 'male', 3, 'groot,marvel,gotg', 24.99, 24.99, '1537607710-6720057110511.jpg', 0, '2018-09-22 09:15:10'),
(17, 3, 'Captain America Contemporary Tee for Men', 'captain-america-contemporary-tee-for-men', 'A bold Captain America steps from the pages of Marvel Comics onto this soft cotton tee with cool contemporary illustration.', 1, 1, 'S,M', 'Navy Blue', 'male', 0, 'CaptainAmerica,marvel', 24.99, 24.99, '1537607807-6720057110094.jpg', 0, '2018-09-22 09:16:47'),
(18, 3, 'THE INVINCIBLE IRON MAN - IRON MAN OFFICIAL T-SHIRT', 'the-invincible-iron-man---iron-man-official-t-shirt', 'Alright, everybody stand down! Because the most perfect Iron Man tee is here.\r\n\r\nThis t-shirt has been forged out of 100% cotton and features the mask of your favorite Iron Man suit - Mark 42.', 1, 1, 'S,M', 'Red', 'unisex', 1, 'IronMan,marvel', 29.99, 34.99, '1537608183-iron-man-mask-t-shirt-india-700x700.jpg', 0, '2018-09-22 09:23:03'),
(19, 3, 'SKILLED MERCENARY - OFFICIAL DEADPOOL MUG', 'skilled-mercenary---official-deadpool-mug', 'Officially Licensed Deadpool, Marvel Coffee Mug. Get your Superhero, Movie & Pop Culture Coffee Mug online on Redwolf today!					', 2, 13, '', '', '', 3, 'Deadpool,marvel', 4.99, 4.99, '1537719263-deadpool-marvel-comics-coffee-mug-pbmardead021-2-700x700.jpg', 0, '2018-09-22 09:27:21'),
(20, 3, 'THOR - KAWAII ART - OFFICIAL THOR COFFEE MUG', 'thor---kawaii-art---official-thor-coffee-mug', 'Officially Licensed Thor, Avengers, Marvel Coffee Mug. Get your Superhero, Movie & Pop Culture Coffee Mug online on Redwolf today!', 2, 13, '', '', '', 2, 'Thor,marvel', 4.99, 4.99, '1537608570-marvel-comics-avengers-coffee-mug-pbmarkad006-2-700x700_jpg_pagespeed_ce_O4HMvQ57V6.jpg', 0, '2018-09-22 09:29:30'),
(21, 3, 'SPIDERMAN - KAWAII ART - OFFICIAL SPIDERMAN COFFEE MUG', 'spiderman---kawaii-art---official-spiderman-coffee-mug', 'Officially Licensed Spiderman, Avengers, Marvel Coffee Mug. Get your Superhero, Movie & Pop Culture Coffee Mug online on Redwolf today!															', 2, 13, '', '', '', 11, 'spiderman,marvel', 4.99, 4.99, '1537720945-marvel-comics-avengers-coffee-mug-pbmarkad016-1-700x700.jpg', 0, '2018-09-22 09:30:26'),
(22, 1, 'PEWDIEPIE | OFFICIAL HAT', 'pewdiepie-|-official-hat', '', 2, 7, '', 'Black', '', 5, 'Pewdiepie,Russian', 3.99, 4.99, '1537723201-bdb912dafcbb7a4c8ab9ac4534f79f53.jpg', 0, '2018-09-23 17:20:01'),
(23, 3, 'Finn Jones More Chi, More Power IRON FIST Tee', 'finn-jones-more-chi,-more-power-iron-fist-tee', '\"More Chi, More Power.\"\r\n\r\n\"Every 30 seconds, a child is diagnosed with a life-threatening medical condition. Help support The Starlight Children\'s Foundation with my limited edition IRON FIST tees and sweatshirts only from Represent.\" --- Finn.															', 1, 1, 'S,M,L', 'Black', 'male', 3, 'marvel,ironfist,netflix', 24.99, 34.99, '1538319205-1cf226b23ffe106970f728820063382a.jpg', 0, '2018-09-30 14:53:26'),
(24, 1, 'PewDiePie | Meme Review', 'pewdiepie-|-meme-review', 'If you kill memes and you know, it clap your hands.???????? Salute your fellow 9 year olds with the Meme Review clap sleeve prints.\r\n\r\nBack print includes your 9 year old anatomy.', 1, 3, 'M,L,XL', 'Black', 'unisex', 10, 'pewdiepie,meme', 24.99, 34.99, '1539095940-8081374f9a6f7b306a3b2b02227ba7ae.jpg', 0, '2018-10-09 14:39:00'),
(25, 3, 'Marvel’s Avengers Infinity War: Thanos Snap Tee', 'marvel’s-avengers-infinity-war:-thanos-snap-tee', 'Celebrate the Summer of Snap with this officially licensed, limited edition and exclusive design from Represent. Don\'t miss out before it disappears.\r\n\r\nPortion of proceeds supports The Starlight Children\'s Foundation. © Marvel 2018.', 1, 1, 'S,M,L', 'Black', 'male', 7, 'marvel,thanos,infinitywar,avengers', 20.99, 24.99, '1539096138-e4562785e93274d7bc6173a4762bca6b.jpg', 0, '2018-10-09 14:42:19'),
(26, 2, '#MarchForOurLives tshirts', '#marchforourlives-tshirts', 'On March 24, March For Our Lives took to the streets of Washington DC and communities across the U.S. to demand that their lives and safety become a priority and that we end gun violence and mass shootings in our schools today. Join us!', 1, 1, 'S,M', 'WHITE', 'male', 9, 'march', 24.99, 24.99, '1539096331-a8633b60790ec586b22f605daf03bc05.jpeg', 0, '2018-10-09 14:45:31');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `pr_imgs_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `imgs` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`pr_imgs_id`, `product_id`, `imgs`) VALUES
(1, 7, '836942-1537718834-2d4e67c9da7b150a89e53cca6356251e.jpg'),
(2, 19, '447739-1537719289-deadpool-marvel-comics-coffee-mug-pbmardead021-1-700x700.jpg'),
(3, 19, '865613-1537719289-deadpool-marvel-comics-coffee-mug-pbmardead021-3-700x700.jpg'),
(4, 21, '524484-1537720955-marvel-comics-avengers-coffee-mug-pbmarkad016-2-700x700.jpg'),
(5, 21, '962544-1537720955-marvel-comics-avengers-coffee-mug-pbmarkad016-3-700x700_jpg_pagespeed_ce_JImhKT1A_N.jpg'),
(6, 2, '736230-1537723106-c40f3a5ee212d038d1741d36d42303d1.jpeg'),
(7, 5, '655820-1537723138-36d0d50d1faf0b5a47b965d069d1f548.jpg'),
(8, 22, '521156-1537723212-a20ba42b5e694de16bc15ff06f6805e8.jpg'),
(9, 23, '66394-1538319219-2d4e67c9da7b150a89e53cca6356251e.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `desc` longtext NOT NULL,
  `review_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `seller_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `address` longtext NOT NULL,
  `password` varchar(32) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(6) NOT NULL,
  `profile_pic` longtext NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`seller_id`, `company_name`, `name`, `email`, `contact_no`, `address`, `password`, `dob`, `gender`, `profile_pic`, `status`, `date_created`) VALUES
(1, 'merchandise@india', 'Merchandise@india', 'seller1@gmail.com', '1223312345', '38 Bakhtiar Shah Road', '827ccb0eea8a706c4c34a16891f84e7b', '1995-03-11', 'male', 'default.jpg', 1, '2018-09-11 06:29:14'),
(2, 'merchandise@india', 'merchandise@india', 'seller2@gmail.com', '7685868978', '97  A, Sbi Bldg, Abdul Rehman St, Abdul Rehman Street', '827ccb0eea8a706c4c34a16891f84e7b', '0000-00-00', '', 'http://localhost/meraki/default.jpg', 1, '2018-09-13 18:45:38'),
(3, 'marvelOfficial', 'marvelOfficial', 'seller3@gmail.com', '7685868978', '48 S N Roy Road', '827ccb0eea8a706c4c34a16891f84e7b', '0000-00-00', '', 'http://localhost/meraki/default.jpg', 1, '2018-09-22 09:10:26');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `state_id` int(11) NOT NULL,
  `state_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `state_name`) VALUES
(4, 'Maharashtra'),
(5, 'Andaman & Nicobar Islands'),
(6, 'Andhra Pradesh'),
(7, 'Arunachal Pradesh'),
(8, 'Assam'),
(9, 'Bihar'),
(10, 'Chhattisgarh'),
(11, 'Dadra & Nagar Haveli'),
(12, 'Daman & Diu'),
(13, 'Delhi'),
(14, 'Goa'),
(15, 'Gujarat'),
(16, ' India'),
(17, 'Gujrat'),
(18, 'Hariyana'),
(19, 'Haryana'),
(20, 'Himachal Pradesh'),
(21, 'Jammu & Kashmir'),
(22, 'Jharkhand'),
(23, 'Karnataka'),
(24, 'Kerala'),
(25, 'Lakshadweep'),
(26, 'Madhya Pradesh'),
(27, 'Maharastra'),
(28, 'Manipur'),
(29, 'Meghalaya'),
(30, 'Mizoram'),
(31, 'Nagaland'),
(32, 'Orissa'),
(33, 'Pondicherry'),
(34, 'Punjab'),
(35, 'Rajasthan'),
(36, 'Rajastan'),
(37, 'Sikkim'),
(38, 'West Bengal'),
(39, 'Tamil Nadu'),
(40, 'Tripura'),
(41, 'Uttar Pradesh'),
(42, ' Ghazipur'),
(43, ' Hardoi'),
(44, ' Rampur'),
(45, ' Agra'),
(46, ' Farrukhabad'),
(47, ' Bulandshahr'),
(48, 'Uttarakhand'),
(49, ' Purulia');

-- --------------------------------------------------------

--
-- Table structure for table `sub_catagory`
--

CREATE TABLE `sub_catagory` (
  `sub_catagory_id` int(11) NOT NULL,
  `catagory_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_catagory`
--

INSERT INTO `sub_catagory` (`sub_catagory_id`, `catagory_id`, `name`) VALUES
(1, 1, 'Shirts'),
(2, 1, 'Hoodies'),
(3, 1, 'Long sleeves'),
(4, 1, 'Jackets'),
(5, 1, 'Sweatshirts'),
(6, 1, 'Tank Top'),
(7, 2, 'Caps'),
(8, 2, 'Watches'),
(9, 2, 'Shoes'),
(10, 2, 'Backpacks'),
(13, 2, 'Mugs');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(6) NOT NULL,
  `profile_pic` longtext NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `catagory`
--
ALTER TABLE `catagory`
  ADD PRIMARY KEY (`catagory_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `state_id` (`state_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_details_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `seller_id` (`seller_id`),
  ADD KEY `catagory` (`catagory`),
  ADD KEY `sub_catagory` (`sub_catagory`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`pr_imgs_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`seller_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `sub_catagory`
--
ALTER TABLE `sub_catagory`
  ADD PRIMARY KEY (`sub_catagory_id`),
  ADD KEY `catagory_id` (`catagory_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `catagory`
--
ALTER TABLE `catagory`
  MODIFY `catagory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_details_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `pr_imgs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `seller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `sub_catagory`
--
ALTER TABLE `sub_catagory`
  MODIFY `sub_catagory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `order_details_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `order_details_ibfk_4` FOREIGN KEY (`seller_id`) REFERENCES `seller` (`seller_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `catagory_id` FOREIGN KEY (`catagory`) REFERENCES `catagory` (`catagory_id`),
  ADD CONSTRAINT `seller_id` FOREIGN KEY (`seller_id`) REFERENCES `seller` (`seller_id`),
  ADD CONSTRAINT `sub_catagory_id` FOREIGN KEY (`sub_catagory`) REFERENCES `sub_catagory` (`sub_catagory_id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `sub_catagory`
--
ALTER TABLE `sub_catagory`
  ADD CONSTRAINT `catagory` FOREIGN KEY (`catagory_id`) REFERENCES `catagory` (`catagory_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
