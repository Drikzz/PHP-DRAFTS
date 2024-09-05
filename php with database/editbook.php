<?php 
    require_once('function_clean.php');
    require_once('book.class.php');

    $barcode = $title = $author = $genre = $publisher = $pub_date = $edition = $copies = $format = $rating = $desc = '';
    $age_group = []; //Initialize age group as array
    $barcodeErr = $titleErr = $authorErr = $genreErr = $publisherErr = $pub_dateErr = $editionErr = $copiesErr = $formatErr = $age_groupErr = $ratingErr = $descErr = '';

    //POPULATING INPUTS
    if (isset($_GET['book_selected'])) {

        $book_id = $_GET['book_selected'];
        // echo $book_id;
        $selected_book = new Book;
        $book_contents = $selected_book->showbookonly($book_id);
        
        // Populate form with current book data
        $barcode = $book_contents['book_barcode'];  
        $title = $book_contents['book_title'];  
        $author = $book_contents['book_author'];
        $genre = $book_contents['book_genre'];
        $publisher = $book_contents['book_publisher'];
        $pub_date = $book_contents['book_pub_date'];
        $edition = $book_contents['book_edition'];
        $copies = $book_contents['book_copies'];
        $format = $book_contents['book_format'];
        $age_group = explode(',', $book_contents['book_age_group']);
        $rating = $book_contents['book_rating'];
        $desc = $book_contents['book_desc'];

    }

    //SETTING AND VALIDATING INPUTS
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        //Getting inputs from the add book form

        //ADDED
        $barcode = clean($_POST['barcode']);
        $title = clean($_POST['title']);
        $author = clean($_POST['author']);
        $genre = clean($_POST['genre']);
        $publisher = clean($_POST['publisher']);
        $pub_date = clean($_POST['pub_date']);
        $edition = clean($_POST['edition']);
        $copies = clean($_POST['copies']);
        $format = (isset($_POST['format'])) ? clean($_POST['format']): '';

        // Check if 'age_group' is set and clean each value
        if (isset($_POST['age_group'])) {   
            $age_group = array_map('clean', $_POST['age_group']); // Keep the age group as an array
        }
        
        $rating = clean($_POST['rating']);
        $desc = clean($_POST['desc']);

        //Error checking
        $bookObj = new book();
        $book_barcode = $bookObj->is_unique_barcode($barcode);

        if (empty($barcode)) {

            //Empty barcode input
            $barcodeErr = "* Barcode required";

        } elseif (!$book_barcode && $barcode != $book_contents['book_barcode']) {

            echo $barcode;
            //Checks if the current barcode is unique and not owned by another book 
            $barcodeErr = "* Barcode $barcode already exists";

        } else {

            //proceed to update the book details in the database
            // If barcode remains unchanged or passes first 2 condition then update this book.

            $result = $bookObj->edit_book($book_id);

            if ($result) {
                // Success message or redirect
                echo "Book details updated successfully!";
            } else {
                // Handle error if update fails
                echo "Failed to update book details.";
            }
        }
        
        if (empty($title)) {
            $titleErr = '* Title required!';
        }

        if (empty($author)) {
            $authorErr = '* Author required!';
        }

        if (empty($genre)) {
            $genreErr = '* Genre required!';
        }

        if (empty($publisher)) {
            $publisherErr = '* Publisher required!';
        }

        if (empty($pub_date)) {
            $pub_dateErr = '* Publication Date required!';
        }

        if (empty($edition)) {
            $editionErr = '* Edition required!';
        }elseif (!(is_numeric($edition))) {
            $editionErr = '* Edition should be a number';
        } elseif ($edition < 0) {
            $editionErr = '* Edition should be greater than 0!';
        }

        if (empty($copies)) {
            $copiesErr = '* Copies required!';
        }elseif (!(is_numeric($copies))) {
            $copiesErr = '* Copies should be a number';
        } elseif ($copies < 0) {
            $copiesErr = '* Copies should be greater than 0!';
        }

        if (empty($format)) {
            $formatErr = '* Format required!';
        }

        if (empty($age_group)) {
            $age_groupErr = '* Age Group required!';
        }

        if (empty($rating) || $rating < 1 || $rating > 5) {
            $ratingErr = '* Rating required';
        }

        if (empty($desc)) {
            $descErr = '* Description required!';
        }

        if (empty($barcodeErr) && empty($titleErr) && empty($authorErr) && empty($genreErr) && empty($publisherErr) && empty($pub_dateErr) && empty($editionErr) 
            && empty($copiesErr) && empty($formatErr) && empty($age_groupErr) && empty($ratingErr) && empty($descErr)) {
                
            //if no errors, then save to db
            $bookObj = new book();
            $bookObj->barcode = $barcode;
            $bookObj->title = $title;
            $bookObj->author = $author;
            $bookObj->genre = $genre;
            $bookObj->publisher = $publisher;
            $bookObj->pub_date = $pub_date;
            $bookObj->edition = $edition;
            $bookObj->copies = $copies;
            $bookObj->format = $format;
            $bookObj->age_group = implode(',', $age_group); // Convert to string only when saving to DB
            $bookObj->rating = $rating;
            $bookObj->description = $desc;
            if ($bookObj->update_book_details($_GET['book_selected'])) {
                header('location: library.php');
            }
            else {
                echo 'Error!';
            }
        }
    } 
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="addbook.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <header>
        <p class="document-heading">The Book Haven</p>
        <div class="add-button-container">
            <a href="library.php" class="add-button">View library</a>
            <p class="login">Login</p>
        </div>
    </header>

    <div class="form-container">
        <form action="" method="post">

        <div class="form-title-container">
            <p class="form-title">Fill up the following.</p>
        </div>

        <div class="input-container">

            <div class="left-form-inputs">

                <div class="input-error">
                    <label for="title">Book Barcode</label>
                    
                    <?php
                        if (empty($_POST['barcode'])) {
                            ?>
                            <span class="error"><?= $barcodeErr ?></span>
                            <?php
                        }
                    ?>
                </div>
                <input type="text" name="barcode" id="barcode" value="<?= $barcode ?>" placeholder="Enter Book Barcode">

                <div class="input-error">
                    <label for="title">Book Title</label>
                    
                    <?php
                        if (empty($_POST['title'])) {
                            ?>
                            <span class="error"><?= $titleErr ?></span>
                            <?php
                        }
                    ?>
                </div>
                <input type="text" name="title" id="title" value="<?= $title ?>" placeholder="Enter Book Title">
                        
                <div class="input-error">
                    <label for="author">Book Author</label>
                    <?php
                        if (empty($_POST['author'])) {
                            ?>
                            <span class="error"><?= $authorErr ?></span>
                            <?php
                        }
                        ?>  
                </div>
                <input type="text" name="author" id="author" value="<?= $author ?>" placeholder="Enter Lead Author's Name">
                        
                <div class="input-error">
                    <label for="genre">Book Genre</label>
                    <?php
                        if (empty($_POST['genre'])) {
                            ?>
                            <span class="error"><?= $genreErr ?></span>
                            <?php
                        }
                    ?>  
                </div>

                <select name="genre" id="genre">
                    <option value="">--SELECT--</option>
                    <option value="Sci-Fi" <?= (isset($genre) && $genre=='Sci-Fi')? 'selected=true':'' ?>>Sci-Fi</option>
                    <option value="Fantasy" <?= (isset($genre) && $genre=='Fantasy')? 'selected=true':'' ?>>Fantasy</option>
                    <option value="Romance" <?= (isset($genre) && $genre=='Romance')? 'selected=true':'' ?>>Romance</option>
                    <option value="Thriller" <?= (isset($genre) && $genre=='Thriller')? 'selected=true':'' ?>>Thriller</option>
                    <option value="Horror" <?= (isset($genre) && $genre=='Horror')? 'selected=true':'' ?>>Horror</option>
                    <option value="Philosophy" <?= (isset($genre) && $genre=='Philosophy')? 'selected=true':'' ?>>Philosophy</option>
                </select>
                        
                <div class="input-error">
                    <label for="publisher">Book Publisher</label>
                    <?php
                        if (empty($_POST['publisher'])) {
                            ?>
                            <span class="error"><?= $publisherErr ?></span>
                            <?php
                        }
                    ?>
                </div>
                <input type="text" name="publisher" id="publisher" value="<?= $publisher ?>" placeholder="Enter Publisher's Company Name">

                
                        
                <div class="input-error">
                    <label for="pub_date">Book Publication Date</label>
                    <?php
                        if (empty($_POST['pub_date'])) {
                            ?>
                            <span class="error"><?= $pub_dateErr ?></span>
                            <?php
                        }
                    ?>
                </div>
                <input type="date" name="pub_date" id="pub_date" value="<?= $pub_date ?>">


                <div class="input-error">
                    <label for="edition">Book Edition</label>
                    <?php
                        if (!empty($editionErr)) {
                            ?>
                            <span class="error"><?= $editionErr ?></span>
                            <?php
                        }
                    ?>
                </div>
                <input type="number" name="edition" id="edition" value="<?= $edition ?>" placeholder="Enter Edition Number">

                
                <div class="input-error">
                    <label for="copies">Number of Copies</label>
                    <?php
                        if (!empty($copiesErr)) {
                            ?>
                            <span class="error"><?= $copiesErr ?></span>
                            <?php
                        }
                    ?>
                </div>
                <input type="number" name="copies" id="copies" value="<?= $copies ?>" placeholder="Enter number of copies">

            </div>
            
            <div class="right-form-inputs">

                <div class="input-error">
                    <label class="label-form" for="format">Format</label>
                    <?php
                    if (!empty($formatErr)) {
                        echo "<span class='error'>$formatErr</span>";
                    }
                    ?>
                </div>
                <div class="input-row-container">
                    <div class="input-row">
                        <input type="radio" name="format" id="Hardbound" value="Hardbound" <?= (isset($format) && $format == 'Hardbound')? 'checked':''?>>
                        <label for="Hardbound">Hardbound</label>
                    </div>
                    
                    <div class="input-row">
                        <input type="radio" name="format" id="Softbound" value="Softbound" <?= (isset($format) && $format == 'Softbound')? 'checked':''?>>
                        <label for="Softbound">Softbound</label>
                    </div>
                </div>
                

                <div class="input-error">
                    <label class="label-form" for="age_group">Age Group</label>
                    <?php
                    if (!empty($age_groupErr)) {
                        echo "<span class='error'>$age_groupErr</span>";
                    }
                    ?>
                </div>

                <div class="input-row-container">
                    <div class="input-row">
                        <input type="checkbox" name="age_group[]" id="Kids" value="Kids" <?= in_array('Kids', $age_group) ? 'checked' : '' ?>>
                        <label for="Kids">Kids</label>
                    </div>

                    <div class="input-row">
                        <input type="checkbox" name="age_group[]" id="Teens" value="Teens" <?= in_array('Teens', $age_group) ? 'checked' : '' ?>>
                        <label for="Teens">Teens</label>
                    </div>

                    <div class="input-row">
                        <input type="checkbox" name="age_group[]" id="Adult" value="Adult" <?= in_array('Adult', $age_group) ? 'checked' : '' ?>>
                        <label for="Adult">Adult</label>
                    </div>
                </div>
                
                <div class="input-error">
                    <label class="label-form" for="rating">Rating</label>
                    <?php
                        if (!empty($ratingErr)) {
                            ?>
                            <span class="error"><?= $ratingErr ?></span>
                            <?php
                        }
                    ?>  
                </div>

                <div class="bar-container">
                    <span>1</span>
                    <input type="range" name="rating" class="bar" id="rating" min="1" max="5">
                    <span>5</span>
                </div>
                
                <div class="input-error">
                <label class="label-form" for="desc">Description</label>
                <?php
                        if (empty($_POST['desc'])) {
                            ?>
                            <span class="error"><?= $descErr ?></span>
                            <?php
                        }
                    ?>  
                </div>
                
                <input type="text" name="desc" class="desc" id="desc" value="<?= $desc ?>" placeholder="Describe this book (optional)">

                <input type="submit" name="submit" class="submit-btn" value="Update details">
            </div>
        </div>
    </div>

        </form>
    </div>
</body>
</html>