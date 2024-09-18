-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2024 at 10:42 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_content`
--

CREATE TABLE `book_content` (
  `book_id` int(11) NOT NULL,
  `book_barcode` int(11) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `book_author` varchar(255) NOT NULL,
  `book_genre` varchar(255) NOT NULL,
  `book_publisher` varchar(255) NOT NULL,
  `book_pub_date` varchar(255) NOT NULL,
  `book_edition` varchar(255) NOT NULL,
  `book_copies` int(11) NOT NULL,
  `book_format` varchar(255) NOT NULL,
  `book_age_group` varchar(255) NOT NULL,
  `book_rating` int(5) NOT NULL,
  `book_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_content`
--

INSERT INTO `book_content` (`book_id`, `book_barcode`, `book_title`, `book_author`, `book_genre`, `book_publisher`, `book_pub_date`, `book_edition`, `book_copies`, `book_format`, `book_age_group`, `book_rating`, `book_desc`) VALUES
(43, 2, 'Aldrikz\'s assignment', 'Aldrikz', 'Fantasy', 'Phoenix Corp', '2024-09-18', '5', 55, 'Hardbound', 'Kids,Teens,Adult', 3, 'Good Good'),
(44, 3, 'Skibi Sigma', 'Brain rot episodes', 'Sci-Fi', 'BrainRot', '2024-09-12', '2', 5, 'Softbound', 'Kids', 1, 'so baddddddddddd.'),
(46, 5, 'Dean\'s College Life', 'Huesca, Anthony Marc T.', 'Philosophy', 'WMSU inc.', '2024-09-05', '1', 122, 'Softbound', 'Kids,Teens,Adult', 5, 'a very good book'),
(47, 1212, 'art', 'art', 'Philosophy', 'wmsu', '2024-09-06', '1', 1, 'Hardbound', 'Kids,Teens,Adult', 3, 'asdasd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_content`
--
ALTER TABLE `book_content`
  ADD PRIMARY KEY (`book_id`),
  ADD UNIQUE KEY `book_barcode` (`book_barcode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_content`
--
ALTER TABLE `book_content`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
