-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2024 at 11:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
(39, 2, 'Rock &amp; Roll', 'Art Cadiz', 'Romance', 'Cadiz Inc', '2024-09-02', '2', 55, 'Hardbound', 'Teens,Adult', 3, 'ROCKKKKKKKKKK'),
(40, 3, 'Kiann&#039;s Ride and Adventures', 'Kiann Layam', 'Thriller', 'WMSU inc', '2024-09-27', '5', 109, 'Softbound', 'Teens', 3, 'Nice nice nice'),
(49, 101, 'The Future of Us', 'John Green', 'Sci-Fi', 'Penguin Books', '2022-01-15', '1', 5, 'Hardbound', 'Teens,Adult', 4, 'A thrilling journey through time.'),
(50, 102, 'Tales of Wonder', 'JK Rowling', 'Fantasy', 'Scholastic', '2019-06-20', '2', 10, 'Softbound', 'Kids,Teens', 5, 'Magical tales that captivate all ages.'),
(51, 103, 'Love in Paris', 'Nora Roberts', 'Romance', 'Harlequin', '2021-08-11', '3', 8, 'Softbound', 'Adult', 3, 'A heartwarming love story set in Paris.'),
(52, 104, 'Into the Shadows', 'Stephen King', 'Thriller', 'Scribner', '2018-10-05', '1', 7, 'Hardbound', 'Adult', 5, 'A chilling thriller that keeps you on edge.'),
(53, 105, 'The Haunted Woods', 'H.P. Lovecraft', 'Horror', 'Arkham House', '2020-09-13', '4', 6, 'Hardbound', 'Teens,Adult', 4, 'A spine-tingling horror that haunts the reader.'),
(54, 106, 'Philosophy of Life', 'Friedrich Nietzsche', 'Philosophy', 'Dover Publications', '2015-05-25', '6', 3, 'Softbound', 'Adult', 4, 'An exploration of existential philosophy.'),
(55, 107, 'Galaxies Beyond', 'Isaac Asimov', 'Sci-Fi', 'Random House', '2017-02-14', '1', 12, 'Hardbound', 'Teens,Adult', 5, 'An epic science fiction saga across the stars.'),
(56, 108, 'The Broken Kingdom', 'Brandon Sanderson', 'Fantasy', 'Tor Books', '2023-07-22', '2', 9, 'Softbound', 'Teens,Adult', 5, 'An epic fantasy tale of betrayal and power.'),
(57, 5, 'Software Engineering', 'James Arthur', 'Philosophy', 'WMSU inc', '2024-08-21', '1', 111, 'Hardbound', 'Kids,Teens,Adult', 3, 'good good');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_content`
--
ALTER TABLE `book_content`
  ADD PRIMARY KEY (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_content`
--
ALTER TABLE `book_content`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
