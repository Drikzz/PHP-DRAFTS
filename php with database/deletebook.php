<?php 
    if (isset($_GET['id'])) {
        $book_id = $_GET['id'];
    } else {
        echo 'Book ID not provided';
        exit();
    }

    require_once 'book.class.php';

    $bookObj  = new Book();

    if ($bookObj->deleteBook($book_id)) {
        echo 'success';
    } else { 
        echo 'failed';
    }
