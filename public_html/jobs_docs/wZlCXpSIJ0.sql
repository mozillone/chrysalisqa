-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 14, 2017 at 06:51 PM
-- Server version: 5.6.33-0ubuntu0.14.04.1
-- PHP Version: 5.6.23-1+deprecated+dontuse+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chrysalisqa`
--

-- --------------------------------------------------------

--
-- Table structure for table `cc_event_tags`
--

CREATE TABLE `cc_event_tags` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `tags` varchar(512) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cc_event_tags`
--

INSERT INTO `cc_event_tags` (`id`, `event_id`, `tags`, `created_at`, `updated_at`) VALUES
(1, 9, 'dsfsf', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 11, 'test,testing', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 12, 'asdf', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 13, 'gfhgfh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 14, 'Tag1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 15, 'Testing', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 16, 'test,testg,testef', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 17, 'test', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 25, 'goog,face,mash', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 27, 'test,test1,test2,test3', '0000-00-00 00:00:00', '2017-06-13 03:28:02'),
(11, 31, 'test,test1,test2', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 33, 'hello,tags', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 34, 'hekllo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 35, 'sadasd,asdasdasdasd', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cc_event_tags`
--
ALTER TABLE `cc_event_tags`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cc_event_tags`
--
ALTER TABLE `cc_event_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
