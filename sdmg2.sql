-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生日期: 2015 年 06 月 27 日 04:38
-- 伺服器版本: 5.6.12-log
-- PHP 版本: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `sdmg2`
--
CREATE DATABASE IF NOT EXISTS `sdmg2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sdmg2`;

-- --------------------------------------------------------

--
-- 表的結構 `follow`
--

CREATE TABLE IF NOT EXISTS `follow` (
  `userid` varchar(32) NOT NULL,
  `followid` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`userid`,`followid`),
  KEY `followid` (`followid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的結構 `issue`
--

CREATE TABLE IF NOT EXISTS `issue` (
  `issueid` varchar(32) NOT NULL,
  `title` varchar(32) NOT NULL,
  `authorid` varchar(32) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `views` int(11) NOT NULL,
  `content` text NOT NULL,
  `category` varchar(10) NOT NULL,
  PRIMARY KEY (`issueid`),
  KEY `authorid` (`authorid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的結構 `key`
--

CREATE TABLE IF NOT EXISTS `key` (
  `tagid` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(32) NOT NULL,
  `frequency` int(11) NOT NULL,
  PRIMARY KEY (`tagid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的結構 `postingevent`
--

CREATE TABLE IF NOT EXISTS `postingevent` (
  `notifiedid` varchar(32) NOT NULL,
  `issueid` varchar(32) NOT NULL,
  `posterid` varchar(32) NOT NULL,
  `seen` tinyint(1) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`notifiedid`,`timestamp`),
  KEY `issueid` (`issueid`),
  KEY `posterid` (`posterid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的結構 `professorid`
--

CREATE TABLE IF NOT EXISTS `professorid` (
  `userid` varchar(32) NOT NULL,
  `professorid` varchar(32) NOT NULL,
  PRIMARY KEY (`userid`,`professorid`),
  KEY `professorid` (`professorid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的結構 `reply`
--

CREATE TABLE IF NOT EXISTS `reply` (
  `replyid` varchar(32) NOT NULL,
  `replycontent` text NOT NULL,
  `userid` varchar(32) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `issueid` varchar(32) NOT NULL,
  PRIMARY KEY (`replyid`),
  KEY `userid` (`userid`),
  KEY `issueid` (`issueid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的結構 `replyevent`
--

CREATE TABLE IF NOT EXISTS `replyevent` (
  `notifiedid` varchar(32) NOT NULL,
  `issueid` varchar(32) NOT NULL,
  `replyid` varchar(32) NOT NULL,
  `seen` tinyint(1) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`notifiedid`,`timestamp`),
  KEY `issueid` (`issueid`),
  KEY `replyid` (`replyid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的結構 `ssodb`
--

CREATE TABLE IF NOT EXISTS `ssodb` (
  `userid` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 轉存資料表中的資料 `ssodb`
--

INSERT INTO `ssodb` (`userid`, `password`, `username`) VALUES
('R02725020', 'xu3jo6vmp6', '李維');

-- --------------------------------------------------------

--
-- 表的結構 `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `issueid` varchar(32) NOT NULL,
  `tagid` int(11) NOT NULL,
  PRIMARY KEY (`issueid`,`tagid`),
  KEY `tagid` (`tagid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的結構 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userid` varchar(32) NOT NULL,
  `password` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `address` varchar(256) NOT NULL,
  `addressshow` tinyint(1) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `phoneshow` tinyint(1) NOT NULL,
  `email` varchar(256) NOT NULL,
  `autobiography` text NOT NULL,
  `usercategory` varchar(10) NOT NULL,
  `image` text NOT NULL,
  `positionshow` tinyint(1) NOT NULL,
  `employershow` tinyint(1) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 轉存資料表中的資料 `user`
--

INSERT INTO `user` (`userid`, `password`, `username`, `address`, `addressshow`, `phone`, `phoneshow`, `email`, `autobiography`, `usercategory`, `image`, `positionshow`, `employershow`) VALUES
('abc', '123', '', '', 0, '', 0, '', '', '', '', 0, 0),
('R02725014', 'xu3jo6vmp6', '', '', 0, '', 0, '', '', '', '', 0, 0),
('R02725020', '', '', '', 0, '', 0, 'r02725020@ntu.edu.tw', '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- 表的結構 `userstudentid`
--

CREATE TABLE IF NOT EXISTS `userstudentid` (
  `userid` varchar(32) NOT NULL,
  `studentid` varchar(32) NOT NULL,
  PRIMARY KEY (`userid`,`studentid`),
  KEY `studentid` (`studentid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 轉存資料表中的資料 `userstudentid`
--

INSERT INTO `userstudentid` (`userid`, `studentid`) VALUES
('R02725020', 'R02725020');

-- --------------------------------------------------------

--
-- 表的結構 `userwork`
--

CREATE TABLE IF NOT EXISTS `userwork` (
  `userid` varchar(32) NOT NULL,
  `position` varchar(32) NOT NULL,
  `employer` varchar(32) NOT NULL,
  `state` int(11) NOT NULL,
  `startyear` varchar(32) NOT NULL,
  PRIMARY KEY (`userid`,`position`,`employer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 匯出資料表的 Constraints
--

--
-- 資料表的 Constraints `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `follow_ibfk_2` FOREIGN KEY (`followid`) REFERENCES `key` (`tagid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `issue`
--
ALTER TABLE `issue`
  ADD CONSTRAINT `issue_ibfk_1` FOREIGN KEY (`authorid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `postingevent`
--
ALTER TABLE `postingevent`
  ADD CONSTRAINT `postingevent_ibfk_1` FOREIGN KEY (`notifiedid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `postingevent_ibfk_2` FOREIGN KEY (`issueid`) REFERENCES `issue` (`issueid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `postingevent_ibfk_3` FOREIGN KEY (`posterid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `professorid`
--
ALTER TABLE `professorid`
  ADD CONSTRAINT `professorid_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `professorid_ibfk_2` FOREIGN KEY (`professorid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `reply_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reply_ibfk_2` FOREIGN KEY (`issueid`) REFERENCES `issue` (`issueid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `replyevent`
--
ALTER TABLE `replyevent`
  ADD CONSTRAINT `replyevent_ibfk_1` FOREIGN KEY (`notifiedid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `replyevent_ibfk_2` FOREIGN KEY (`issueid`) REFERENCES `issue` (`issueid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `replyevent_ibfk_3` FOREIGN KEY (`replyid`) REFERENCES `reply` (`replyid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `tag_ibfk_1` FOREIGN KEY (`issueid`) REFERENCES `issue` (`issueid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tag_ibfk_2` FOREIGN KEY (`tagid`) REFERENCES `key` (`tagid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `userstudentid`
--
ALTER TABLE `userstudentid`
  ADD CONSTRAINT `userstudentid_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userstudentid_ibfk_2` FOREIGN KEY (`studentid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `userwork`
--
ALTER TABLE `userwork`
  ADD CONSTRAINT `userwork_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
