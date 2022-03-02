-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-03-11 15:27:54
-- 伺服器版本： 10.4.17-MariaDB
-- PHP 版本： 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `colands`
--

-- --------------------------------------------------------

--
-- 資料表結構 `battlecalculator`
--

CREATE TABLE `battlecalculator` (
  `battlecalculator_id` int(7) NOT NULL,
  `battleCalculator_battleField_id` int(11) NOT NULL,
  `battleCalculator_battleInfo_name` varchar(30) NOT NULL,
  `battleCalculator_user_id` int(7) NOT NULL,
  `battleCalculator_user_name` varchar(30) NOT NULL,
  `battleCalculator_country_name` varchar(30) NOT NULL,
  `battleCalculator_operatingTactic` varchar(30) NOT NULL,
  `battleCalculator_empireBase` int(7) NOT NULL,
  `battleCalculator_repbulicBase` int(7) NOT NULL,
  `battleCalculator_commonwealthBase` int(7) NOT NULL,
  `battleCalculator_pointOne` int(7) NOT NULL,
  `battleCalculator_pointTwo` int(7) NOT NULL,
  `battleCalculator_pointThree` int(7) NOT NULL,
  `battleCalculator_pointFour` int(7) NOT NULL,
  `battleCalculator_pointFive` int(7) NOT NULL,
  `battleCalculator_result` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `battlecalculator`
--

INSERT INTO `battlecalculator` (`battlecalculator_id`, `battleCalculator_battleField_id`, `battleCalculator_battleInfo_name`, `battleCalculator_user_id`, `battleCalculator_user_name`, `battleCalculator_country_name`, `battleCalculator_operatingTactic`, `battleCalculator_empireBase`, `battleCalculator_repbulicBase`, `battleCalculator_commonwealthBase`, `battleCalculator_pointOne`, `battleCalculator_pointTwo`, `battleCalculator_pointThree`, `battleCalculator_pointFour`, `battleCalculator_pointFive`, `battleCalculator_result`) VALUES
(56, 2, '戰場2', 1, '征夷大將軍', '漢諾莎皇國', 'noTactic', 1000, 0, 0, 0, 0, 0, 0, 0, '皇國勝利點: 0'),
(57, 2, '戰場2', 2, '五星上將', '波瑪倫民國', 'noTactic', 1000, 0, 0, 0, 0, 0, 0, 0, '基地淪陷'),
(58, 2, '戰場2', 3, '大司馬大將軍領尚書事', '烏斯爾登國協', 'noTactic', 0, 200, 0, 200, 200, 200, 200, 0, '國協勝利點: 4'),
(59, 3, '戰場3', 3, '大司馬大將軍領尚書事', '烏斯爾登國協', 'noTactic', 0, 200, 0, 200, 200, 200, 200, 0, '國協勝利點: 5'),
(60, 1, '戰場1', 3, '大司馬大將軍領尚書事', '烏斯爾登國協', 'noTactic', 0, 200, 0, 200, 200, 200, 200, 0, '國協勝利點: 4'),
(61, 1, '戰場1', 2, '五星上將', '波瑪倫民國', 'noTactic', 1000, 0, 0, 0, 0, 0, 0, 0, '基地淪陷'),
(62, 1, '戰場1', 1, '征夷大將軍', '漢諾莎皇國', 'noTactic', 1000, 0, 0, 0, 0, 0, 0, 0, '皇國勝利點: 0'),
(63, 8, '戰場1', 1, '征夷大將軍', '漢諾莎皇國', 'noTactic', 1000, 0, 0, 0, 0, 0, 0, 0, '皇國勝利點: 0'),
(64, 8, '戰場1', 2, '五星上將', '波瑪倫民國', 'noTactic', 1000, 0, 0, 0, 0, 0, 0, 0, '基地淪陷'),
(65, 8, '戰場1', 3, '大司馬大將軍領尚書事', '烏斯爾登國協', 'noTactic', 0, 200, 0, 200, 200, 200, 200, 0, '國協勝利點: 4');

-- --------------------------------------------------------

--
-- 資料表結構 `battlefield`
--

CREATE TABLE `battlefield` (
  `battleField_id` int(7) NOT NULL,
  `battleField_battleInfo_name` varchar(30) NOT NULL,
  `battleField_status` varchar(10) NOT NULL,
  `battlefield_empireParticipation` varchar(10) NOT NULL,
  `battlefield_republicParticipation` varchar(10) NOT NULL,
  `battlefield_commonwealthParticipation` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `battlefield`
--

INSERT INTO `battlefield` (`battleField_id`, `battleField_battleInfo_name`, `battleField_status`, `battlefield_empireParticipation`, `battlefield_republicParticipation`, `battlefield_commonwealthParticipation`) VALUES
(1, '戰場1', '國協勝利', 'joined', 'joined', 'joined'),
(2, '戰場2', '國協勝利', 'joined', 'joined', 'joined'),
(3, '戰場3', '國協勝利', '', '', 'joined'),
(8, '戰場1', '國協勝利', 'joined', 'joined', 'joined'),
(9, '戰場1', '未分高下', '', '', '');

-- --------------------------------------------------------

--
-- 資料表結構 `battleinfo`
--

CREATE TABLE `battleinfo` (
  `batlleInfo_name` varchar(30) NOT NULL,
  `batlleInfo_tacticOne` varchar(30) NOT NULL,
  `batlleInfo_tacticTwo` varchar(30) NOT NULL,
  `batlleInfo_tacticThree` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `battleinfo`
--

INSERT INTO `battleinfo` (`batlleInfo_name`, `batlleInfo_tacticOne`, `batlleInfo_tacticTwo`, `batlleInfo_tacticThree`) VALUES
('戰場1', '焦土作戰', '緊急動員', '防御行動'),
('戰場2', '虛假情報', '軍國主義', '以戰養戰'),
('戰場3', '閃電戰術', '縱深防御', '跳島作戰'),
('戰場4', '穩守突擊', '民族主義', '軍國主義'),
('戰場5', '閃電戰術', '以戰養戰', '防御行動'),
('戰場6', '緊急動員', '焦土作戰', '虛假情報'),
('戰場7', '以戰養戰', '縱深防御', '穩守突擊');

-- --------------------------------------------------------

--
-- 資料表結構 `country`
--

CREATE TABLE `country` (
  `country_name` varchar(30) NOT NULL,
  `country_military` int(7) NOT NULL,
  `country_privilege` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `country`
--

INSERT INTO `country` (`country_name`, `country_military`, `country_privilege`) VALUES
('波瑪倫民國', 100000, 1),
('漢諾莎皇國', 100000, 4),
('烏斯爾登國協', 100000, 9);

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `user_id` int(7) NOT NULL,
  `user_email` varchar(60) NOT NULL,
  `user_password` char(12) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_country_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`user_id`, `user_email`, `user_password`, `user_name`, `user_country_name`) VALUES
(1, 'empire@urbase.net', 'e123123', '征夷大將軍', '漢諾莎皇國'),
(2, 'republic@urbase.net', 'r123123', '五星上將', '波瑪倫民國'),
(3, 'commonwealth@urbase.net', 'c123123', '大司馬大將軍領尚書事', '烏斯爾登國協');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `battlecalculator`
--
ALTER TABLE `battlecalculator`
  ADD PRIMARY KEY (`battlecalculator_id`),
  ADD KEY `battleCalculator_battleField_id` (`battleCalculator_battleField_id`),
  ADD KEY `battleCalculator_battleInfo_name` (`battleCalculator_battleInfo_name`),
  ADD KEY `battleCalculator_user_id` (`battleCalculator_user_id`),
  ADD KEY `battleCalculator_country_name` (`battleCalculator_country_name`),
  ADD KEY `battleCalculator_user_name` (`battleCalculator_user_name`);

--
-- 資料表索引 `battlefield`
--
ALTER TABLE `battlefield`
  ADD PRIMARY KEY (`battleField_id`),
  ADD KEY `battleField_battleInfo_name` (`battleField_battleInfo_name`) USING BTREE;

--
-- 資料表索引 `battleinfo`
--
ALTER TABLE `battleinfo`
  ADD PRIMARY KEY (`batlleInfo_name`);

--
-- 資料表索引 `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_name`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name_2` (`user_name`),
  ADD KEY `user_country_name` (`user_country_name`),
  ADD KEY `user_name` (`user_name`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `battlecalculator`
--
ALTER TABLE `battlecalculator`
  MODIFY `battlecalculator_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `battlefield`
--
ALTER TABLE `battlefield`
  MODIFY `battleField_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `battlecalculator`
--
ALTER TABLE `battlecalculator`
  ADD CONSTRAINT `battleCalculator_battleField_id` FOREIGN KEY (`battleCalculator_battleField_id`) REFERENCES `battlefield` (`battleField_id`),
  ADD CONSTRAINT `battleCalculator_battleInfo_name` FOREIGN KEY (`battleCalculator_battleInfo_name`) REFERENCES `battleinfo` (`batlleInfo_name`),
  ADD CONSTRAINT `battleCalculator_country_name` FOREIGN KEY (`battleCalculator_country_name`) REFERENCES `country` (`country_name`),
  ADD CONSTRAINT `battleCalculator_user_id` FOREIGN KEY (`battleCalculator_user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `battleCalculator_user_name` FOREIGN KEY (`battleCalculator_user_name`) REFERENCES `user` (`user_name`);

--
-- 資料表的限制式 `battlefield`
--
ALTER TABLE `battlefield`
  ADD CONSTRAINT `battleField_battleInfo_name` FOREIGN KEY (`battleField_battleInfo_name`) REFERENCES `battleinfo` (`batlleInfo_name`);

--
-- 資料表的限制式 `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_country_name` FOREIGN KEY (`user_country_name`) REFERENCES `country` (`country_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
