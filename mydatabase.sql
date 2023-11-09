-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2023-11-09 14:23:30
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
  `studentid` varchar(110) NOT NULL,
  `staffid` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `course`
--

INSERT INTO `course` (`id`, `courseid`, `studentid`, `staffid`) VALUES
(1, 'COM3101', '123456', '123'),
(5, 'COM3102', '234567', '123'),
(7, 'COM3102', '123456', '123'),
(8, 'COM3101', '234567', '123');

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
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `coursework`
--

INSERT INTO `coursework` (`id`, `courseid`, `type`, `header`, `content`, `date`) VALUES
(1, 'COM3101', 1, 'a123', 'aaaa', '2023-12-09'),
(2, 'COM3101', 1, 'as2', 'as2', '2023-11-16'),
(3, 'COM3102', 1, 'a123', 'abc', '2023-11-23'),
(4, 'COM3102', 1, 'sss', 'sss', '2023-11-24');

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
(16, '', 'wangdongyang', 123456, '2023-10-27 11:07:38', 1, 'Chapter 3 Python Data Structures', 'docx', '771 KB', 'Chapter 3 Python Data Structures(1).docx'),
(17, 'asjdioasjdoi', 'wangdongyang', 123456, '2023-10-30 16:50:28', 0, NULL, NULL, NULL, NULL),
(18, '', 'wangdongyang', 123456, '2023-10-30 16:50:32', 1, 'Chapter 5.Advanced Search Best First A-star CSP', 'docx', '2 MB', 'Chapter 5.Advanced Search Best First A-star CSP.docx');

-- --------------------------------------------------------

--
-- 表的结构 `duedate`
--

CREATE TABLE `duedate` (
  `id` int(110) NOT NULL,
  `tittle` varchar(110) NOT NULL,
  `content` varchar(1100) NOT NULL,
  `date` date DEFAULT NULL,
  `userid` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `duedate`
--

INSERT INTO `duedate` (`id`, `tittle`, `content`, `date`, `userid`) VALUES
(1, 'COM3101', 'aaaa', '2023-11-15', 'COM3101'),
(2, 'COM3101', 'as2', '2023-11-16', 'COM3101'),
(3, 'COM3102', 'abc', '2023-11-23', 'COM3102'),
(4, 'COM3102', 'sss', '2023-11-24', 'COM3102');

-- --------------------------------------------------------

--
-- 表的结构 `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `studentid` varchar(50) NOT NULL,
  `courseid` varchar(50) NOT NULL,
  `feedback` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `feedback`
--

INSERT INTO `feedback` (`id`, `studentid`, `courseid`, `feedback`) VALUES
(1, '123456', 'COM3101', 'okok'),
(2, '123456', 'COM3102', 'that ok'),
(5, '123456', 'COM3101', '121'),
(7, '123456', 'COM3102', 'abc'),
(11, '123456', 'COM3103', 'aaaaaaasda'),
(20, '123456', 'COM3102', 'ak47'),
(21, '123456', 'COM3101', 'that nobad'),
(22, '123456', 'COM3101', 'that nobad'),
(23, '123456', 'COM3101', 'test'),
(24, '123456', 'COM3102', 'exe'),
(25, '123456', 'COM3101', 'test'),
(26, '123456', 'COM3102', 'exe'),
(37, '123456', 'COM3101', '213'),
(38, '123456', 'COM3101', '213'),
(39, '123456', 'COM3101', '213'),
(40, '123456', 'COM3101', '213'),
(41, '123456', 'COM3101', '1223'),
(42, '123456', 'COM3102', 'wo cao ni ma bi'),
(43, '123456', 'COM3102', 'qnmlgb'),
(44, '123456', 'COM3101', ''),
(45, '123456', 'COM3101', '');

-- --------------------------------------------------------

--
-- 表的结构 `friends`
--

CREATE TABLE `friends` (
  `id` int(110) NOT NULL,
  `studentid` int(110) NOT NULL,
  `friendid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `grade`
--

CREATE TABLE `grade` (
  `id` int(110) NOT NULL,
  `courseid` varchar(110) NOT NULL,
  `studentid` varchar(110) NOT NULL,
  `header` varchar(110) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `grade`
--

INSERT INTO `grade` (`id`, `courseid`, `studentid`, `header`, `score`) VALUES
(1, 'COM3101', '123456', '2', 99),
(6, 'COM3102', '123456', '2', 99),
(7, 'COM3101', '123456', '2', 99),
(8, 'COM3101', '123456', '2', 99),
(9, 'COM3101', '123456', '2', 99),
(10, 'COM3101', '123456', '2', 99);

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
  `userid` varchar(11) NOT NULL,
  `date` date NOT NULL,
  `readme` int(100) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `message`
--

INSERT INTO `message` (`id`, `studentid`, `content`, `name`, `type`, `userid`, `date`, `readme`) VALUES
(1, 123456, 'I have posted a new job with a deadline of 2023-11-15 00:00:00', 'COM3101', 0, 'COM3101', '2023-11-05', 1),
(2, 234567, 'I have posted a new job with a deadline of 2023-11-15 00:00:00', 'COM3101', 0, 'COM3101', '2023-11-05', 0),
(3, 123456, 'I have posted a new job with a deadline of 2023-11-16 00:00:00', 'COM3101', 0, 'COM3101', '2023-11-05', 1),
(4, 234567, 'I have posted a new job with a deadline of 2023-11-16 00:00:00', 'COM3101', 0, 'COM3101', '2023-11-05', 0),
(5, 234567, 'I have posted a new job with a deadline of 2023-11-23 00:00:00', 'COM3102', 0, 'COM3102', '2023-11-06', 0),
(6, 234567, 'I have posted a new job with a deadline of 2023-11-24 00:00:00', 'COM3102', 0, 'COM3102', '2023-11-06', 0);

-- --------------------------------------------------------

--
-- 表的结构 `staff`
--

CREATE TABLE `staff` (
  `id` int(110) NOT NULL,
  `name` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `staff`
--

INSERT INTO `staff` (`id`, `name`) VALUES
(123, 'demosir');

-- --------------------------------------------------------

--
-- 表的结构 `studentdue`
--

CREATE TABLE `studentdue` (
  `id` int(110) NOT NULL,
  `tittle` varchar(110) NOT NULL,
  `content` varchar(1100) NOT NULL,
  `userid` varchar(110) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `studentdue`
--

INSERT INTO `studentdue` (`id`, `tittle`, `content`, `userid`, `date`) VALUES
(48, 'abc', 'abc', '123456', '2023-11-23');

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
(123456, 'wangdongyang', '2019', '123', '123', '2023-11-09 12:53:41'),
(234567, 'wangdongyang', '2018', '123', '123', '2023-11-03 20:05:37'),
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
  `date` datetime DEFAULT NULL,
  `keyid` int(110) NOT NULL,
  `studentname` varchar(123) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `submit`
--

INSERT INTO `submit` (`id`, `header`, `studentid`, `courseid`, `link`, `filename`, `date`, `keyid`, `studentname`) VALUES
(1, 'as2', '123456', 'COM3101', '../work/123456/COM3101/as2/assignment.ts', 'assignment.ts', '2023-11-05 15:03:38', 2, 'wangdongyang');

-- --------------------------------------------------------

--
-- 表的结构 `temp`
--

CREATE TABLE `temp` (
  `number` int(110) NOT NULL,
  `studentid` int(110) NOT NULL,
  `friendid` int(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(123, '123', 'staff'),
(123123, '123', 'student'),
(123456, '123', 'student'),
(234567, '123', 'student'),
(332132, '123', 'student'),
(333333, '333', 'student'),
(938939, '1', 'student'),
(990192, '100', 'student');

-- --------------------------------------------------------

--
-- 表的结构 `worklink`
--

CREATE TABLE `worklink` (
  `id` int(110) NOT NULL,
  `link` varchar(110) NOT NULL,
  `filename` varchar(110) NOT NULL,
  `courseid` varchar(110) NOT NULL,
  `header` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `worklink`
--

INSERT INTO `worklink` (`id`, `link`, `filename`, `courseid`, `header`) VALUES
(1, '../work/COM3101/a123/assignment.ts', 'assignment.ts', 'COM3101', '1'),
(2, '../work/COM3101/as2/assignment.ts', 'assignment.ts', 'COM3101', '2'),
(3, '../work/COM3102/a123/assignment.ts', 'assignment.ts', 'COM3102', '3'),
(4, '../work/COM3102/sss/assignment.ts', 'assignment.ts', 'COM3102', '4');

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
-- 表的索引 `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `staff`
--
ALTER TABLE `staff`
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
-- 表的索引 `worklink`
--
ALTER TABLE `worklink`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `coursework`
--
ALTER TABLE `coursework`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `discussion`
--
ALTER TABLE `discussion`
  MODIFY `count` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- 使用表AUTO_INCREMENT `duedate`
--
ALTER TABLE `duedate`
  MODIFY `id` int(110) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- 使用表AUTO_INCREMENT `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(110) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(110) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用表AUTO_INCREMENT `message`
--
ALTER TABLE `message`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(110) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- 使用表AUTO_INCREMENT `studentdue`
--
ALTER TABLE `studentdue`
  MODIFY `id` int(110) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- 使用表AUTO_INCREMENT `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000;

--
-- 使用表AUTO_INCREMENT `submit`
--
ALTER TABLE `submit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `temp`
--
ALTER TABLE `temp`
  MODIFY `number` int(110) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000;

--
-- 使用表AUTO_INCREMENT `worklink`
--
ALTER TABLE `worklink`
  MODIFY `id` int(110) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
