-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Apr 22, 2024 at 06:31 PM
-- Server version: 10.4.33-MariaDB-1:10.4.33+maria~ubu2004
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spnetwork_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `article_id` int(11) NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `note` longblob DEFAULT NULL,
  `linkurl` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bankcode`
--

CREATE TABLE `bankcode` (
  `BankCode` varchar(10) NOT NULL,
  `bankNameEn` varchar(100) NOT NULL,
  `bankNameTh` varchar(100) NOT NULL,
  `user_bank_type` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `bankcode`
--

INSERT INTO `bankcode` (`BankCode`, `bankNameEn`, `bankNameTh`, `user_bank_type`, `status`) VALUES
('000', 'Siam Commercial Bank PUBLIC COMPANY LTD.', 'ธนาคารไทยพาณิชย์ จำกัด (มหาชน)', '-', 1),
('002', 'BANGKOK BANK PUBLIC COMPANY LTD.', 'ธนาคารกรุงเทพ จำกัด (มหาชน)', 'BBL', 1),
('004', 'KASIKORNBANK', 'ธนาคารกสิกรไทย จำกัด (มหาชน)', 'KBANK', 1),
('006', 'KRUNG THAI BANK PUBLIC COMPANY LTD.', 'ธนาคารกรุงไทย จำกัด (มหาชน)', 'KTB', 1),
('011', 'TMBThanachart Bank Public Company Limited', 'ธนาคารทหารไทยธนชาต จำกัด (มหาชน)', 'TTB', 1),
('014', 'Siam Commercial Bank PUBLIC COMPANY LTD.', 'ธนาคารไทยพาณิชย์ จำกัด (มหาชน)', 'SCB', 1),
('017', 'CITIBANK N.A.', 'ธนาคารซิตี้แบงก์', 'CITI', 1),
('018', 'SUMITOMO MITSUI BANGKING CORPORATION', 'ธนาคารซูมิโตโม มิตซุย แบงกิ้ง คอร์ปอเรชั่น', 'SMBC', 1),
('020', 'STANDARD CHARTERED BANK (THAI) PCL.', 'ธนาคารสแตนดาร์ดชาร์เตอร์ด (ไทย) จำกัด (มหาชน)', 'SCBT', 1),
('022', 'CIMB THAI BANK PUBLIC COMPANY LIMITED', 'ธนาคารซีไอเอ็มบี ไทย จำกัด (มหาชน)', 'CIMB', 1),
('024', 'UNITED OVERSEAS BANK (THAI) PCL.', 'ธนาคารยูโอบี จำกัด (มหาชน)', 'UOBT', 1),
('025', 'BANK OF AYUDHAYA PUBLIC COMPANY LTD.', 'ธนาคารกรุงศรีอยุธยา จำกัด (มหาชน)', 'BAY', 1),
('030', 'GOVERNMENT SAVING BANK', 'ธนาคารออมสิน', 'GSB', 1),
('031', 'HONGKONG AND SHANGHAI CORPORATION LTD.', 'ธนาคารฮ่องกงและเซี่ยงไฮ้ จำกัด', 'HSBC', 1),
('032', 'DEUTSCHE BANK AKTIENGESELLSCHAFT', 'ธนาคารดอยช์แบงก์', 'DB', 1),
('033', 'GOVERNMENT HOUSING BANK', 'ธนาคารอาคารสงเคราะห์', 'GHB', 1),
('034', 'BANK FOR AGRICULTURAL AND AGRICULTURAL CO-OPERATIVES ( AGRI )', 'ธนาคารเพื่อการเกษตรและสหกรณ์การเกษตร', 'BAAC', 1),
('039', 'MIZUHO CORPORATE BANK, LTD.', 'ธนาคารมิซูโฮ คอร์ปอเรต', 'MHCB', 1),
('065', 'THANACHART BANK PUBLIC COMPANY LIMITED', 'ธนาคารธนชาต จำกัด (มหาชน)', 'TBANK', 1),
('066', 'ISLAMIC BANK OF THAILAND   ( ISBT )', 'ธนาคารอิสลามแห่งประเทศไทย', 'ISBT', 1),
('067', 'TISCO BANK PUBLIC COMPANY LIMITED', 'ธนาคารทิสโก้ จำกัด (มหาชน)', 'TSCO', 1),
('069', 'Kiatnakin Phatra Bank Public Company Limited', 'ธนาคารเกียรตินาคินภัทร จำกัด (มหาชน)', 'KKP', 1),
('070', 'INDUSTRIAL AND COMMERCIAL BANK OF CHINA (THAI) PUBLIC COMPANY LIMITED', 'ธนาคารไอซีบีซี (ไทย) จำกัด (มหาชน)', 'ICBC', 1),
('071', 'THE THAI CREDIT RETAIL BANK PUBLIC COMPANY LIMITED   ( TCRB )', 'ธนาคารไทยเครดิต เพื่อรายย่อย จำกัด (มหาชน)', 'TCRB', 1),
('073', 'Land and Houses Bank Public Company Limited', 'ธนาคารแลนด์ แอนด์ เฮ้าส์ จำกัด (มหาชน)', 'LHBANK', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bank_account`
--

CREATE TABLE `bank_account` (
  `bank_id` int(11) NOT NULL,
  `bankCode` varchar(3) DEFAULT NULL,
  `accout_name` varchar(100) DEFAULT NULL,
  `accout_number` varchar(50) DEFAULT NULL,
  `accout_logo` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `topic` varchar(200) NOT NULL,
  `news_detail` longblob DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL DEFAULT 0,
  `product_code` varchar(50) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `note_short` mediumblob DEFAULT NULL,
  `note` longblob DEFAULT NULL,
  `photo1` varchar(200) DEFAULT NULL,
  `photo2` varchar(200) DEFAULT NULL,
  `photo3` varchar(200) DEFAULT NULL,
  `photo4` varchar(200) DEFAULT NULL,
  `cost` double NOT NULL DEFAULT 0,
  `price` double NOT NULL DEFAULT 0,
  `price_member` double NOT NULL DEFAULT 0,
  `pv` int(11) NOT NULL DEFAULT 0,
  `discount` double NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(100) DEFAULT NULL,
  `note` longblob DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `type` enum('SuperAdmin','Owner','Administrator','Support') NOT NULL DEFAULT 'Support',
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `fullname`, `type`, `status`) VALUES
('dev', '$2y$10$dmX.VH2mkRyR2t910oK/NO2iMzgo9.9SsZv5lAM8bMyoHb3700FRu', 'Develop', 'SuperAdmin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`article_id`);

--
-- Indexes for table `bankcode`
--
ALTER TABLE `bankcode`
  ADD PRIMARY KEY (`BankCode`);

--
-- Indexes for table `bank_account`
--
ALTER TABLE `bank_account`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_account`
--
ALTER TABLE `bank_account`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
