<?php

    require_once 'connection.php';

    class Book {
        public $id = '';
        public $title = '';
        public $author  = '';
        public $genre = '';
        public $publisher = '';
        public $pub_date = '';
        public $edition = '';
        public $copies = '';
        public $format = '';
        public $age_group = '';
        public $rating = '';
        public $description = '';

        protected $db;

        function __construct() {
            $this->db = new database;
        }

        function add_book() {
            $sql = "INSERT INTO book_content (book_title, book_author, book_genre, book_publisher, book_pub_date, book_edition, book_copies, book_format, book_age_group, book_rating, book_desc)
                                VALUES (:title, :author, :genre, :publisher, :pub_date, :edition, :copies, :format, :age_group, :rating, :description);";
            $query = $this->db->connection()->prepare($sql);

            $query->bindParam(':title', $this->title);
            $query->bindParam(':author', $this->author);
            $query->bindParam(':genre', $this->genre);
            $query->bindParam(':publisher', $this->publisher);
            $query->bindParam(':pub_date', $this->pub_date);
            $query->bindParam(':edition', $this->edition);
            $query->bindParam(':copies', $this->copies);
            $query->bindParam(':format', $this->format);
            $query->bindParam(':age_group', $this->age_group);
            $query->bindParam(':rating', $this->rating);
            $query->bindParam(':description', $this->description);
            
            if ($query->execute()){
                return true;
            }else{
                return false;
            }
        }

        function showAll(){
            $sql = "SELECT * FROM book_content ORDER BY book_title ASC LIMIT 10;";

            $query = $this->db->connection()->prepare($sql);
            $data = null;

            if($query->execute()) {
                $data = $query->fetchAll();
            }

            return $data;
        }
    }
    ?>