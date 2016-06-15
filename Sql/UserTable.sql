-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- ホスト: localhost
-- 生成日時: 2016 年 6 月 08 日 11:02
-- サーバのバージョン: 5.5.49-0ubuntu0.14.04.1
-- PHP のバージョン: 5.5.9-1ubuntu4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- データベース: `Users`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `UserTable`
--

DROP TABLE IF EXISTS `UserTable`;
CREATE TABLE IF NOT EXISTS `UserTable` (
  `UserId` varchar(10) NOT NULL COMMENT 'ユーザーID',
  `Name` varchar(50) CHARACTER SET utf32 NOT NULL COMMENT '名前',
  `Type` int(11) NOT NULL COMMENT '教師＝１、生徒＝０',
  `Password` varchar(100) CHARACTER SET utf32 NOT NULL COMMENT 'パスワード',
  PRIMARY KEY (`UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- テーブルのデータのダンプ `UserTable`
--

INSERT INTO `UserTable` (`UserId`, `Name`, `Type`, `Password`) VALUES
('0K01001', 'gorira', 0, '2baae8aa5d61d9589a50e270a54363195706b8f3'),
('test', 'testman', 0, 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
