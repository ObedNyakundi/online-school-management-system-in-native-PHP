-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 02, 2022 at 07:55 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skuli`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `class` varchar(10) NOT NULL,
  `subject` varchar(20) NOT NULL,
  `numberOfCopies` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `class`, `subject`, `numberOfCopies`) VALUES
(1, 'KLB Science class 1', '1 red', 'Science', 236),
(2, 'Kaka Sungura na Wenzake', '2 blue', 'Kiswahili', 31),
(3, 'Test It &amp; Fix It Social Studies', '3 red', 'Social Studies', 20),
(4, 'Test it &amp; fix it Class 3', '3 red', 'Maths', 5),
(5, 'Test it &amp; fix it Class 3', '3 red', 'Maths', 5);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `label` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `label`) VALUES
(1, 'Nursery'),
(2, '1 red'),
(3, '1 blue'),
(4, '2 red'),
(5, '2 blue'),
(6, '3 red');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `maths` int(3) NOT NULL,
  `english` int(3) NOT NULL,
  `kiswahili` int(3) NOT NULL,
  `science` int(3) NOT NULL,
  `socialStudies` int(3) NOT NULL,
  `totals` int(3) NOT NULL,
  `average` float NOT NULL,
  `label` varchar(20) NOT NULL,
  `upi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`id`, `name`, `maths`, `english`, `kiswahili`, `science`, `socialStudies`, `totals`, `average`, `label`, `upi`) VALUES
(1, 'Anita David', 67, 56, 43, 43, 78, 287, 57.4, 'opening Term 1 2019', 'MSA234'),
(2, 'Athuman Hassan', 77, 71, 54, 67, 89, 358, 71.6, 'opening Term 1 2019', 'MSA123'),
(3, 'Kitunguu Saumu', 77, 67, 71, 89, 54, 358, 71.6, 'opening Term 1 2019', 'MSA134'),
(5, 'Example Three', 56, 67, 66, 89, 56, 334, 66.8, 'Final Term 1 2018', '123sd'),
(6, 'Mwenyekiti Omondi', 87, 77, 67, 43, 43, 317, 63.4, 'Final Term 1 2018', '3456'),
(7, 'Godfrey Ochieng', 34, 54, 45, 78, 90, 301, 60.2, 'Opening Term 1 2019', 'MSA889'),
(9, 'Athuman Hassan', 78, 22, 55, 46, 34, 235, 47, 'Opening Term 1 2021', 'MSA123'),
(10, 'Anita David', 68, 95, 98, 65, 78, 404, 80.8, 'Opening Term 1 2021', 'MSA234'),
(11, 'Godfrey Ochieng', 56, 98, 55, 44, 45, 298, 59.6, 'Opening Term 1 2021', 'MSA889'),
(13, 'Example Three', 45, 89, 33, 36, 98, 301, 60.2, 'Opening Term 1 2021', '123sd'),
(14, 'Mwenyekiti Omondi One', 78, 88, 45, 77, 22, 310, 62, 'Opening Term 1 2021', '3456'),
(15, 'Ann Kea', 77, 77, 74, 55, 44, 327, 65.4, 'Opening Term 1 2021', 'MSA324');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `name` varchar(200) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `upi` varchar(20) NOT NULL,
  `class` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`name`, `dateOfBirth`, `upi`, `class`) VALUES
('Askah Manani', '2016-04-05', '1234ee', '2 blue'),
('Example Three', '2018-12-03', '123sd', '1 blue'),
('Mwenyekiti Omondi One', '2018-11-26', '3456', '1 blue'),
('Athuman Hassan', '2010-11-09', 'MSA123', 'Nursery'),
('Anita David', '2018-09-02', 'MSA234', 'Nursery'),
('Ann Kea', '2018-12-04', 'MSA324', '1 blue'),
('Godfrey Ochieng', '2018-12-30', 'MSA889', 'Nursery'),
('Alfred Koech', '2011-04-11', 'WE455', '2 red');

--
-- Triggers `students`
--
DELIMITER $$
CREATE TRIGGER `delete_student_records` BEFORE DELETE ON `students` FOR EACH ROW DELETE FROM exam WHERE exam.upi=old.upi
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `label` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `label`) VALUES
(1, 'Maths'),
(2, 'English'),
(3, 'Kiswahili'),
(4, 'Social Studies'),
(5, 'Religious Studies'),
(6, 'science');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `name` varchar(200) NOT NULL,
  `tscNum` int(10) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `dateOfAppointment` date NOT NULL,
  `currentWorkingStation` varchar(200) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'teacher',
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`name`, `tscNum`, `dateOfBirth`, `dateOfAppointment`, `currentWorkingStation`, `type`, `password`) VALUES
('Ace Nyakundi', 1233, '1995-01-01', '2018-12-12', 'Longo Sec', 'teacher', 'mimi'),
('Obed Nyakundi', 1234, '2018-12-02', '2018-12-19', 'Longo Primary', 'HTeacher', 'mimi');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `label` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `label`) VALUES
(1, 'Opening Term'),
(2, 'Mid Term'),
(3, 'Final Term');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`upi`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`tscNum`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
