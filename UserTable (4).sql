-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- ホスト: localhost
-- 生成日時: 2016 年 6 月 16 日 18:21
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
use pbl;
DROP TABLE `UserTable`;
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
('0K01001', '秋月', 0, '490a3ef381d008b3985e3c0117df67e4ad1e0637'),
('0K01002', '芥川　周平', 0, '0814263a4a4cb75ee08a4d021ff4c028f0b95e0c'),
('0K01003', '円佛　直也', 0, 'd4626eac1d019b52b729783ec66464b924164154'),
('0K01004', '古曵　昌俊', 0, '52581d723bf830dc9128371e7e7f8bd579d78835'),
('0K01005', '佐々木　涼太', 0, 'ec17ef0b5b3f81731737560b5dfd2b7afc89b2b3'),
('0K01006', '多田　涼太', 0, 'f41c0879ba5ccec8be3d906a7f71ea775fdec5c9'),
('0K01007', '土田　昇平', 0, 'e3ea2bb634cfbc6c5532f358594bfe94b019986e'),
('0K01008', '寺口　悟司', 0, '3e0020b32d9b4f10c65e5a871b267556e8872cb2'),
('0K01009', '土居　幸太郎', 0, '30b2f58f00a7d68bb9b4256b87d3a51b07cfdc71'),
('0K01010', '栂野　仁志', 0, '8e09efcc76e7c6fff5d2c4c17c3cd5cca28f5636'),
('0K01011', '土肥　侑平', 0, '233e1641e691c4fb40f4106bb4a9246eea35de7a'),
('0K01012', '長谷川　遼', 0, 'ffcd21a857b3806e0e69c5efe7f85eb838b68877'),
('0K01013', '藤井　貴之', 0, 'ca6e62cb4071a2df8f306ea57d47a3c7172dc09c'),
('0K01014', '前田　貴大', 0, '5aab615dbdbc1793d5ae475c206e99392ccc7f38'),
('0K01015', '増澤　優駿', 0, '9ec6ff422cbadfe6dd032788fa6c8fc880962a7a'),
('0K01016', '松本　祐樹', 0, 'd8e5d56efa33e9729432950ff7783e707148df47'),
('0K01017', '村井　亮哉', 0, '48698eef5e00a55d776c5fa587641c2e7641faeb'),
('0K01018', '森本　大佑', 0, '97d1f89a12c7dad6f8c2d19b21c942bf2d226f27'),
('0K01019', '山口　大貴', 0, 'b1adb96bfc8034d24e907de28f6ba58a394a2632'),
('0K01020', '山中　竣介', 0, '4d627c0320400218e160cfab8d1723316a414ea2'),
('0K01021', '吉田　朋広', 0, '85db74cbb510cdc4ae9bad4af1d376b509eb6750'),
('0K01022', '川西　望未', 0, '765e77a93091970386313379cb130f8e2522da98');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
