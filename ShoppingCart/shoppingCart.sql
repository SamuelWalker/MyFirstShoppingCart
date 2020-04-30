-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 30, 2020 at 05:29 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `shoppingCart`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) UNSIGNED NOT NULL,
  `categoryName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `categorySort` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderDetail`
--

CREATE TABLE `orderDetail` (
  `id` int(11) NOT NULL,
  `orderId` int(11) UNSIGNED NOT NULL,
  `productId` int(11) UNSIGNED DEFAULT NULL,
  `quantity` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orderDetail`
--

INSERT INTO `orderDetail` (`id`, `orderId`, `productId`, `quantity`) VALUES
(1, 1, 1, 1),
(2, 1, 5, 2),
(3, 1, 2, 1),
(4, 1, 6, 1),
(5, 2, 6, 1),
(6, 1, 7, 1),
(7, 2, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) UNSIGNED NOT NULL,
  `total` int(11) UNSIGNED DEFAULT NULL,
  `shippingFee` int(11) UNSIGNED DEFAULT NULL,
  `grandTotal` int(11) UNSIGNED DEFAULT NULL,
  `customerName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customerEmail` varchar(100) CHARACTER SET utf16 COLLATE utf16_unicode_ci DEFAULT NULL,
  `customerAddress` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customerPhone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paymentMethod` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `total`, `shippingFee`, `grandTotal`, `customerName`, `customerEmail`, `customerAddress`, `customerPhone`, `paymentMethod`) VALUES
(1, 980, 100, 1080, '林先生', NULL, '台中市忠明南路111號', '0980123456', 2),
(2, 850, 100, 950, '張達昌', NULL, '台北市大安區基隆路100號', '093456789', 3);

-- --------------------------------------------------------

--
-- Table structure for table `paymentMethod`
--

CREATE TABLE `paymentMethod` (
  `id` tinyint(2) NOT NULL,
  `method` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `paymentMethod`
--

INSERT INTO `paymentMethod` (`id`, `method`) VALUES
(1, 'credit'),
(2, 'atm'),
(3, 'cash');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) UNSIGNED NOT NULL,
  `categoryId` int(11) UNSIGNED NOT NULL DEFAULT '1',
  `productName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `productPrice` int(11) UNSIGNED DEFAULT NULL,
  `productImg` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `categoryId`, `productName`, `productPrice`, `productImg`, `description`) VALUES
(8, 1, '大人的日本史', 240, '大人的日本史.jpeg', '從鄭成功時代的大航海交流，到變成日本第一個海外殖民地，\r\n　　日本歷史一直是臺灣歷史無法迴避的一部分。\r\n　　面對急遽變化的國際局勢，我們比以往任何時候都更需要以成熟的眼光，\r\n　　重新認識這個臺灣最熟悉的國家、最陌生的歷史。　　'),
(9, 1, '我們的新世界', 355, '我們的新世界.jpeg', '&#34;人生的新世界可以如何探索。今天的新世界如何形成。\r\n以及，2030年以前，我們將面臨與經歷的事情。&#34;'),
(10, 1, '龍馬行', 2160, '龍馬行.jpeg', '他，熱血而冷靜、柔軟卻堅毅；\r\n他，廣納同志敵人，務實打造夢想；\r\n司馬遼太郎筆下的坂本龍馬，帶給人勇氣和力量，\r\n跨越時空，仍然想說：「龍馬，謝謝你！」'),
(11, 1, '原子習慣', 260, '原子習慣.jpeg', '每天都進步1%，一年後，你會進步37倍；\r\n每天都退步1%，一年後，你會弱化到趨近於0！\r\n你的一點小改變、一個好習慣，將會產生複利效應，\r\n如滾雪球般，為你帶來豐碩的人生成果！'),
(12, 1, '太閤記：天下人豐臣秀吉', 540, '太閣記：天下人豐臣秀吉（全二冊）.jpeg', '豐臣秀吉的性格開朗、身段柔軟，擁有無人能及的商人智慧，在戰國日本武將爭霸史上，堪稱最懂得操弄人心的天才。他將天生的猴臉轉化成個人魅力，靠著了不起的表演天分逐一收服各地名將，終於稱霸日本六十餘州。這部歷史長篇小說生動描述秀吉「英雄不怕出身低」的戲劇性人生。'),
(13, 1, '芋泥包', 30, '芋泥包.jpeg', '用新鮮的芋泥鴕包入的！\r\n美味可口又好吃！');

-- --------------------------------------------------------

--
-- Table structure for table `tempCart`
--

CREATE TABLE `tempCart` (
  `id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tempCart`
--

INSERT INTO `tempCart` (`id`, `productId`, `quantity`, `date`) VALUES
(1, 13, 2, '2020-04-28 17:31:05'),
(2, 10, 1, '2020-04-28 17:31:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderDetail`
--
ALTER TABLE `orderDetail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymentMethod`
--
ALTER TABLE `paymentMethod`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tempCart`
--
ALTER TABLE `tempCart`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderDetail`
--
ALTER TABLE `orderDetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tempCart`
--
ALTER TABLE `tempCart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderDetail`
--
ALTER TABLE `orderDetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`);
