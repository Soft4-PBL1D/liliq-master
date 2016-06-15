-- drop database if exists Users;
-- create database Users;
use pbl;
--
-- データベース: `Users`
--
-- --------------------------------------------------------

--
-- テーブルの構造 `ClassAttendTable`
--

CREATE TABLE IF NOT EXISTS `ClassAttendTable` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` varchar(10) NOT NULL COMMENT 'ユーザーID',
  `Date` date DEFAULT NULL COMMENT '出席日',
  `Time` int(16) DEFAULT NULL COMMENT '時限目（１〜５）',
  `Type` int(4) DEFAULT NULL COMMENT '出席：0 遅刻：1 欠席：2 就活：3 病欠：4 登校前:8',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
--
-- -- --------------------------------------------------------
--
-- --
-- -- テーブルの構造 `FaceTable`
-- --
--
--
CREATE TABLE IF NOT EXISTS `FaceTable` (
  `UserId` varchar(10) NOT NULL COMMENT 'ユーザーID',
  `imagePath` varchar(256) DEFAULT NULL COMMENT '顔面パス',
  PRIMARY KEY (`UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --
-- -- テーブルのデータのダンプ `FaceTable`
-- --
--
-- -- --------------------------------------------------------
--
-- --
-- -- テーブルの構造 `SchoolAttendTable`
-- --
--
CREATE TABLE IF NOT EXISTS `SchoolAttendTable` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` varchar(10) NOT NULL COMMENT 'ユーザーID',
  `Time` int(16) NOT NULL COMMENT '登下校時間（unixTime）',
  `Type` int(2) NOT NULL COMMENT '教師＝１、生徒＝０',
  `Checking` int(2) NOT NULL COMMENT '０＝登校、１＝下校、２＝異常下校',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;
--
-- --
-- テーブルのデータのダンプ `SchoolAttendTable`
--
-- --------------------------------------------------------

--
-- テーブルの構造 `UserTable`
--
--
--
CREATE TABLE IF NOT EXISTS `SchoolDayTable` (
  `ident` int NOT NULL AUTO_INCREMENT,
  `Date` DATE NOT NULL COMMENT '20**-**-**',
  `Week` int NOT NULL COMMENT '曜日（0~6））',
  `SchoolDay` int NOT NULL COMMENT '休校or登校日',
  `SchoolStartTime` int NOT NULL COMMENT '登校時間',
  `SchoolEndTime` int NOT NULL COMMENT '下校時間',
  PRIMARY KEY (`ident`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- テーブルのデータのダンプ `UserTable`
