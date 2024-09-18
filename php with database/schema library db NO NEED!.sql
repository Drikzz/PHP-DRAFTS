//show create query of a tables
SHOW CREATE TABLE book_content;

//database query
CREATE TABLE `book_content` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `book_desc` varchar(255) NOT NULL,
  PRIMARY KEY (`book_id`),
  UNIQUE KEY `book_barcode` (`book_barcode`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
