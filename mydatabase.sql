-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2023-10-28 20:15:06
-- 服务器版本： 10.4.28-MariaDB
-- PHP 版本： 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `mydatabase`
--

-- --------------------------------------------------------

--
-- 表的结构 `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `courseid` varchar(110) NOT NULL,
  `studentid` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `course`
--

INSERT INTO `course` (`id`, `courseid`, `studentid`) VALUES
(1, 'COM3101', '123456'),
(2, 'COM3102', '123456');

-- --------------------------------------------------------

--
-- 表的结构 `coursework`
--

CREATE TABLE `coursework` (
  `id` int(11) NOT NULL,
  `courseid` varchar(110) NOT NULL,
  `type` int(10) NOT NULL DEFAULT 0,
  `header` varchar(110) NOT NULL,
  `content` varchar(1100) NOT NULL,
  `date` date DEFAULT NULL,
  `link` varchar(110) NOT NULL,
  `grade` varchar(110) NOT NULL DEFAULT 'no grade'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `coursework`
--

INSERT INTO `coursework` (`id`, `courseid`, `type`, `header`, `content`, `date`, `link`, `grade`) VALUES
(1, 'COM3101', 0, 'Weekend 1', 'this is demo weekend .', NULL, '', 'no grade'),
(2, 'COM3102', 0, 'Weekend 12131231123123', 'this is demo weekend .', NULL, 'demodemo', 'no grade'),
(3, 'COM3101', 1, 'Weekend 1', 'this is demo weekend .', '2023-10-04', 'demodemo', 'No grade'),
(4, 'COM3102', 1, 'Weekend 2', 'this is demo weekend .', '2023-10-04', 'demodemo', 'No grade');

-- --------------------------------------------------------

--
-- 表的结构 `discussion`
--

CREATE TABLE `discussion` (
  `count` int(11) NOT NULL,
  `content` varchar(1100) NOT NULL,
  `name` varchar(110) NOT NULL,
  `id` int(110) NOT NULL,
  `date` datetime DEFAULT NULL,
  `type` int(10) NOT NULL DEFAULT 0,
  `filename` varchar(110) DEFAULT NULL,
  `filetype` varchar(110) DEFAULT NULL,
  `filesize` varchar(110) DEFAULT NULL,
  `link` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `discussion`
--

INSERT INTO `discussion` (`count`, `content`, `name`, `id`, `date`, `type`, `filename`, `filetype`, `filesize`, `link`) VALUES
(14, '', 'wangdongyang', 123456, '2023-10-27 11:06:47', 1, 'Chapter 3 Python Data Structures', 'docx', '771 KB', 'Chapter 3 Python Data Structures.docx'),
(15, '', 'wangdongyang', 123456, '2023-10-27 11:07:35', 1, 'Chapter 4 Uninformed Search DFS and BFS 2023', 'docx', '1 MB', 'Chapter 4 Uninformed Search DFS and BFS 2023.docx'),
(16, '', 'wangdongyang', 123456, '2023-10-27 11:07:38', 1, 'Chapter 3 Python Data Structures', 'docx', '771 KB', 'Chapter 3 Python Data Structures(1).docx');

-- --------------------------------------------------------

--
-- 表的结构 `duedate`
--

CREATE TABLE `duedate` (
  `id` int(110) NOT NULL,
  `tittle` varchar(110) NOT NULL,
  `content` varchar(1100) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `duedate`
--

INSERT INTO `duedate` (`id`, `tittle`, `content`, `date`) VALUES
(3, 'COM3101', 'demo content', '2023-10-31'),
(5, 'COM3102', 'demo content', '2023-10-31'),
(6, 'COM3101', 'demo content', '2023-10-31');

-- --------------------------------------------------------

--
-- 表的结构 `friends`
--

CREATE TABLE `friends` (
  `id` int(110) NOT NULL,
  `studentid` int(110) NOT NULL,
  `friendid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `friends`
--

INSERT INTO `friends` (`id`, `studentid`, `friendid`) VALUES
(45, 123123, 123456),
(46, 123456, 123123),
(47, 234567, 123456),
(48, 123456, 234567);

-- --------------------------------------------------------

--
-- 表的结构 `message`
--

CREATE TABLE `message` (
  `id` int(20) NOT NULL,
  `studentid` int(20) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` int(1) NOT NULL,
  `userid` int(11) NOT NULL,
  `date` date NOT NULL,
  `readme` int(100) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `message`
--

INSERT INTO `message` (`id`, `studentid`, `content`, `name`, `type`, `userid`, `date`, `readme`) VALUES
(1, 123123, '12121', 'wangdongyang', 1, 123456, '2023-10-23', 0),
(2, 123123, '1212', 'wangdongyang', 1, 123456, '2023-10-23', 0),
(5, 234567, '12321312', 'wangdongyang', 0, 123456, '2023-10-26', 0),
(6, 234567, 'daisodjaoisjdaoi', 'wangdongyang', 0, 123456, '2023-10-26', 0),
(7, 234567, '2112', 'wangdongyang', 0, 123456, '2023-10-27', 0),
(8, 234567, 'Hello, this is wangdongyang. I want to be friends with you.', 'wangdongyang', 1, 123456, '2023-10-27', 0),
(9, 332132, 'Hello, this is wangdongyang. I want to be friends with you.', 'wangdongyang', 1, 123456, '2023-10-27', 0);

-- --------------------------------------------------------

--
-- 表的结构 `studentdue`
--

CREATE TABLE `studentdue` (
  `id` int(110) NOT NULL,
  `tittle` varchar(110) NOT NULL,
  `content` varchar(1100) NOT NULL,
  `studentid` varchar(110) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `studentdue`
--

INSERT INTO `studentdue` (`id`, `tittle`, `content`, `studentid`, `date`) VALUES
(1, 'demo', 'demo11', '123456', '2023-11-03');

-- --------------------------------------------------------

--
-- 表的结构 `students`
--

CREATE TABLE `students` (
  `id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `year` year(4) NOT NULL,
  `programe` varchar(8) NOT NULL,
  `password` varchar(15) NOT NULL,
  `lastlogin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `students`
--

INSERT INTO `students` (`id`, `name`, `year`, `programe`, `password`, `lastlogin`) VALUES
(123123, '123', '2018', '123', '123', '2023-10-23 15:38:41'),
(123456, 'wangdongyang', '2019', '123', '123', '2023-10-28 20:09:04'),
(234567, 'wangdongyang', '2018', '123', '123', '2023-10-24 17:18:16'),
(332132, '123', '2018', '123', '123', '2023-10-21 17:41:21'),
(333333, '213', '2018', '333', '333', NULL),
(938939, '123', '2018', '1', '1', NULL),
(990192, '213', '2020', '100', '100', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `submit`
--

CREATE TABLE `submit` (
  `id` int(11) NOT NULL,
  `header` varchar(110) NOT NULL,
  `studentid` varchar(110) NOT NULL,
  `courseid` varchar(110) NOT NULL,
  `link` varchar(110) DEFAULT NULL,
  `filename` varchar(110) NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `submit`
--

INSERT INTO `submit` (`id`, `header`, `studentid`, `courseid`, `link`, `filename`, `date`) VALUES
(1, 'Weekend 1', '123456', 'COM3101', '../work/123456/COM3101/Weekend 1/Chapter 1. Introduction to AI - an Overview STU.docx', 'Chapter 1. Introduction to AI - an Overview STU.docx', '2023-10-28 08:34:04'),
(2, 'Weekend 1', '123456', 'COM3101', '../work/123456/COM3101/Weekend 1/COM3102 Project specification (AY2023-24).pdf', 'COM3102 Project specification (AY2023-24).pdf', '2023-10-28 08:34:04'),
(3, 'Weekend 2', '123456', 'COM3102', '../work/123456/COM3102/Weekend 2/AMS1001_Chapter 1.pdf', 'AMS1001_Chapter 1.pdf', '2023-10-28 08:34:21');

-- --------------------------------------------------------

--
-- 表的结构 `temp`
--

CREATE TABLE `temp` (
  `number` int(110) NOT NULL,
  `studentid` int(110) NOT NULL,
  `friendid` int(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `temp`
--

INSERT INTO `temp` (`number`, `studentid`, `friendid`) VALUES
(61, 123456, 234567),
(62, 123456, 332132);

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `password` varchar(10) NOT NULL,
  `type` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `password`, `type`) VALUES
(123123, '123', 'student'),
(123456, '123', 'student'),
(234567, '123', 'student'),
(332132, '123', 'student'),
(333333, '333', 'student'),
(938939, '1', 'student'),
(990192, '100', 'student');

--
-- 转储表的索引
--

--
-- 表的索引 `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `coursework`
--
ALTER TABLE `coursework`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `discussion`
--
ALTER TABLE `discussion`
  ADD PRIMARY KEY (`count`);

--
-- 表的索引 `duedate`
--
ALTER TABLE `duedate`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `studentdue`
--
ALTER TABLE `studentdue`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `submit`
--
ALTER TABLE `submit`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `temp`
--
ALTER TABLE `temp`
  ADD PRIMARY KEY (`number`);

--
-- 表的索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `coursework`
--
ALTER TABLE `coursework`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `discussion`
--
ALTER TABLE `discussion`
  MODIFY `count` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- 使用表AUTO_INCREMENT `duedate`
--
ALTER TABLE `duedate`
  MODIFY `id` int(110) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(110) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- 使用表AUTO_INCREMENT `message`
--
ALTER TABLE `message`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用表AUTO_INCREMENT `studentdue`
--
ALTER TABLE `studentdue`
  MODIFY `id` int(110) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000;

--
-- 使用表AUTO_INCREMENT `submit`
--
ALTER TABLE `submit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `temp`
--
ALTER TABLE `temp`
  MODIFY `number` int(110) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
