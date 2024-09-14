-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2024 at 09:13 PM
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
-- Database: `tokushop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `fake_user_id` varchar(255) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `choose_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category1`
--

CREATE TABLE `category1` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `is_displayed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category1`
--

INSERT INTO `category1` (`id`, `category_name`, `is_displayed`) VALUES
(1, 'Khác', 1),
(2, 'Gaoranger', 1),
(3, 'Hurricanger', 1),
(4, 'Abaranger', 1),
(5, 'Dekaranger', 1),
(6, 'Magiranger', 1),
(7, 'Boukenger', 1),
(8, 'Gekiranger', 1),
(9, 'Go-Onger', 1),
(10, 'Shinkenger', 1),
(11, 'Goseiger', 1),
(12, 'Gokaiger', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category2`
--

CREATE TABLE `category2` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `is_displayed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category2`
--

INSERT INTO `category2` (`id`, `category_name`, `is_displayed`) VALUES
(1, 'New seal', 1),
(2, 'Fullbox', 1),
(3, 'Có lỗi', 1),
(4, 'Thiếu đồ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `request` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `user_id`, `request`) VALUES
(1, 'Tien Si Nguyen', 'simavel4.0@gmail.com', 1, 'help me!!!');

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `id` int(11) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `is_valid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `coupon_code`, `discount`, `is_valid`) VALUES
(1, 'admindeptrai', 100.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `note` text DEFAULT NULL,
  `create_date` date NOT NULL,
  `update_date` date DEFAULT NULL,
  `order_state` enum('Chờ xác nhận','Đã xác nhận','Đã hủy') NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `name`, `phone`, `email`, `address`, `note`, `create_date`, `update_date`, `order_state`, `total`) VALUES
(1, 1, 'Tien Si Nguyen', '0000', 'simavel4.0@gmail.com', 'TPHCM, Q12', 'order', '2024-09-14', '2024-09-14', 'Đã xác nhận', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `category1_id` int(11) NOT NULL,
  `category2_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `represent_img` text DEFAULT NULL,
  `otherImgs` text DEFAULT NULL,
  `import_date` date NOT NULL,
  `is_displayed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `price`, `quantity`, `category1_id`, `category2_id`, `description`, `represent_img`, `otherImgs`, `import_date`, `is_displayed`) VALUES
(2, 'Abarenoh', 3000000.00, 6, 4, 2, 'đẹp', '457193073_1019845603476727_2298035922005350560_n.jpg', '456841236_1019845650143389_5866929606700386591_n.jpg, 457137755_1019845723476715_4307347777948613735_n.jpg, 457193073_1019845603476727_2298035922005350560_n.jpg, 457266782_1019845666810054_3633784204532002138_n.jpg, 457321529_1019845700143384_2819721971643445252_n.jpg, 457378127_1019845776810043_2676725500991412238_n.jpg', '2024-09-14', 1),
(3, 'Gao God', 6000000.00, 7, 2, 1, 'quá đẹp', '456335415_1015447340583220_5048169889856816044_n.jpg', '455953660_1015447397249881_441169729518803708_n.jpg, 456012527_1015450113916276_7371625165875431004_n.jpg, 456335415_1015447340583220_5048169889856816044_n.jpg, 456336012_1015447247249896_4615808527129467986_n.jpg, 456337182_1015450173916270_4323302134600720817_n.jpg, 456379743_1015450217249599_4237932888835594437_n.jpg, 456409916_1015447403916547_933352553634059767_n.jpg, 456413468_1015450287249592_2009264197264810699_n.jpg, 456482271_1015452057249415_5164758484649375752_n.jpg, 456482672_1015450067249614_5286408165239932441_n.jpg, 456513097_1015450307249590_1368017557097240603_n.jpg, 456514707_1015450093916278_1676041828416582649_n.jpg, 456561691_1015447433916544_478403953144611292_n.jpg, 456561801_1015450237249597_6798208413237250617_n.jpg, 456694984_1015450267249594_4061086398556318143_n.jpg, 456712277_1015450137249607_7148739137392250135_n.jpg', '2024-09-14', 1),
(4, 'Super Deka Robo', 3000000.00, 8, 5, 2, 'Super Deka Robo siêu tuổi thơ', '456384869_1016577280470226_236067657225719128_n.jpg', '456290911_1016577317136889_2360628319273469262_n.jpg, 456384869_1016577280470226_236067657225719128_n.jpg, 456564390_1016577510470203_6777851144753082291_n.jpg, 456593124_1016577760470178_1446107943202474805_n.jpg, 456623866_1016577540470200_6881694913239286334_n.jpg, 456719731_1016577397136881_4852099764799505055_n.jpg, 456793489_1016577597136861_2872696822511522705_n.jpg, 456813626_1016577337136887_8244436853731482838_n.jpg, 456820999_1016577670470187_2799006751767230966_n.jpg, 456909558_1016577440470210_7013170656862489637_n.jpg', '2024-09-14', 1),
(5, 'ngựa đen', 5000000.00, 8, 6, 1, 'Wolfkaiser siêu nhân phép thuật tuổi thơ nhiều ae', '456920627_1018370790290875_192654836570978289_n.jpg', '456536289_1018371043624183_2776874966498293016_n.jpg, 456920627_1018370790290875_192654836570978289_n.jpg, 456975478_1018370940290860_6627834203683774749_n.jpg, 457033290_1018371030290851_4557921043774323863_n.jpg, 457244867_1018370846957536_3853654718459806143_n.jpg, 457274083_1018371013624186_5887970975454534538_n.jpg', '2024-09-14', 1),
(6, 'Gia đình siêu nhân phép thuật', 2000000.00, 6, 6, 4, 'Siêu nhân phép thuật siêu đẹp', '456335140_1017292747065346_7825552934934438698_n.jpg', '456335140_1017292747065346_7825552934934438698_n.jpg, 456712693_1017292823732005_704190923942547119_n.jpg, 456717054_1017292840398670_2082761646807912091_n.jpg, 457001128_1017292860398668_5273719441143523179_n.jpg', '2024-09-14', 1),
(7, 'Gattai siêu nhân hải tặc', 4000000.00, 19, 12, 1, 'Robo siêu nhân hải tặc', '457135500_1019592080168746_6912279719666610522_n.jpg', '457101865_1019592366835384_7743922863489432877_n.jpg, 457135500_1019592080168746_6912279719666610522_n.jpg, 457184438_1019569440171010_6991999774884480754_n.jpg, 457194999_1019592400168714_8752873849456835036_n.jpg, 457244697_1019592390168715_1558721566421099117_n.jpg, 457284762_1019592210168733_8370509530617609511_n.jpg', '2024-09-14', 1),
(8, 'Bò Gingaman', 3000000.00, 8, 1, 2, 'đẹp', '455827166_1010656054395682_2870440949043967421_n.jpg', '455600445_1010656011062353_8654558622158373278_n.jpg, 455827166_1010656054395682_2870440949043967421_n.jpg', '2024-09-14', 1),
(9, 'Dekabase', 1800000.00, 6, 5, 4, 'Dekabase siêu đẹp', '456243991_1016351470492807_5406173382782597809_n.jpg', '456243991_1016351470492807_5406173382782597809_n.jpg, 456456679_1016351490492805_6515473959149750060_n.jpg', '2024-09-14', 1),
(10, '5 ae siêu nhân đỏ', 3500000.00, 7, 1, 1, '5 ae siêu nhân đỏ', '456783024_1015651540562800_4039992250886344231_n.jpg', '455885099_1015651593896128_8917517187356218374_n.jpg, 456651537_1015651143896173_7012444562935467349_n.jpg, 456655478_1015651570562797_7540465974028726589_n.jpg, 456669442_1015651547229466_82441218855637727_n.jpg, 456708193_1015651187229502_4037258458034921691_n.jpg, 456783024_1015651540562800_4039992250886344231_n.jpg', '2024-09-14', 1),
(11, 'Ryusoulger', 3000000.00, 7, 1, 1, 'đẹp', '457497396_1022053719922582_1455342470441122412_n.jpg', '457440797_1022053783255909_2995199960956586349_n.jpg, 457441003_1022053726589248_4956838088845462652_n.jpg, 457497396_1022053719922582_1455342470441122412_n.jpg, 457500864_1022053896589231_280146331252385417_n.jpg, 457666785_1022053819922572_9187593862608991769_n.jpg, 457736846_1022053803255907_2718812124653765374_n.jpg', '2024-09-14', 1),
(12, 'Siêu nhân thiên sứ', 5000000.00, 8, 11, 2, 'Siêu nhân thiên sứ', '457497813_1020434970084457_1524549113618390721_n.jpg', '456914025_1020435053417782_4217993581878919177_n.jpg, 457191523_1019918886802732_6324378114880812848_n.jpg, 457386074_1020435170084437_1556549893491745079_n.jpg, 457411593_1019918830136071_118226960342506171_n.jpg, 457465929_1020435143417773_6421681030569986065_n.jpg, 457465960_1019918873469400_3223614200951691646_n.jpg, 457497813_1020434970084457_1524549113618390721_n.jpg, 457501069_1019918810136073_8040079524093199125_n.jpg, 457505593_1019918866802734_2178075068857188158_n.jpg, 457554525_1020434996751121_1495493221702384802_n.jpg', '2024-09-14', 1),
(13, 'SRC Dekarobo', 1500000.00, 10, 5, 2, 'SRC Dekaranger Robo', '458921139_1028021859325768_1471976423651747224_n.jpg', '458426967_1028022179325736_9113221069355173718_n.jpg, 458492266_1028022229325731_2561725741950393703_n.jpg, 458589651_1028021899325764_3261769509989211026_n.jpg, 458780130_1028022165992404_4808465711296046130_n.jpg, 458921139_1028021859325768_1471976423651747224_n.jpg, 458941405_1028022245992396_2260229946871309948_n.jpg, 459064075_1028021942659093_6703123885406598782_n.jpg, 459092843_1028021832659104_1120273705875689034_n.jpg', '2024-09-14', 1),
(14, 'SOC GX72', 10000000.00, 10, 1, 1, 'SOC GX72 và GX78', 'product.png', 'product.png, product1.png, product2.png, product3.png, product4.png, product5.png, product6.png, product7.png, product8.png, product9.png, product10.png, product11.png', '2024-09-14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `slideshow`
--

CREATE TABLE `slideshow` (
  `id` int(11) NOT NULL,
  `img` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `is_displayed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slideshow`
--

INSERT INTO `slideshow` (`id`, `img`, `title`, `is_displayed`) VALUES
(1, 'image1.jpg', '1', 1),
(2, 'image2.jpg', '2', 1),
(3, 'image3.jpg', '3', 1),
(4, 'image4.jpg', '4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('customer','admin') NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `is_locked` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`, `name`, `phone`, `email`, `address`, `is_locked`) VALUES
(1, 'nguyentiensi', '1', 'customer', 'Tien Si Nguyen', '0000', 'simavel4.0@gmail.com', 'TPHCM, Q12', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `category1`
--
ALTER TABLE `category1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category2`
--
ALTER TABLE `category2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category1_id` (`category1_id`),
  ADD KEY `category2_id` (`category2_id`);

--
-- Indexes for table `slideshow`
--
ALTER TABLE `slideshow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category1`
--
ALTER TABLE `category1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `category2`
--
ALTER TABLE `category2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `slideshow`
--
ALTER TABLE `slideshow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category1_id`) REFERENCES `category1` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`category2_id`) REFERENCES `category2` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
