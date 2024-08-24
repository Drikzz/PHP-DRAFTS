<?php 
    require_once('function_clean.php');

    $title = $author = $genre = $publisher = $pub_date = $edition = $copies = $format = $rating = $desc = '';
    $age_group = []; //Initialize age group as array
    $titleErr = $authorErr = $genreErr = $publisherErr = $pub_dateErr = $editionErr = $copiesErr = $formatErr = $age_groupErr = $ratingErr = $descErr = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        //Getting inputs from the add book form
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
        if (empty($title)) {
            $titleErr = 'Title is required!';
        }

        if (empty($author)) {
            $authorErr = 'Author is required!';
        }

        if (empty($genre)) {
            $genreErr = 'Genre is required!';
        }

        if (empty($publisher)) {
            $publisherErr = 'Publisher is required!';
        }

        if (empty($pub_date)) {
            $pub_dateErr = 'Publication Date is required!';
        }

        if (empty($edition)) {
            $editionErr = 'Edition is required!';
        }elseif (!(is_numeric($edition))) {
            $editionErr = 'Edition should be a number';
        } elseif ($edition < 0) {
            $editionErr = 'Edition should be greater than 0!';
        }

        if (empty($copies)) {
            $copiesErr = 'Copies is required!';
        }elseif (!(is_numeric($copies))) {
            $copiesErr = 'Copies should be a number';
        } elseif ($copies < 0) {
            $copiesErr = 'Copies should be greater than 0!';
        }

        if (empty($format)) {
            $formatErr = 'Format is required!';
        }

        if (empty($age_group)) {
            $age_groupErr = 'Age Group is required!';
        }

        if (empty($rating)) {
            $ratingErr = 'Rating is required!';
        }

        if (empty($desc)) {
            $descErr = 'Description is required!';
        }

        if (empty($titleErr) && empty($authorErr) && empty($genreErr) && empty($publisherErr) && empty($pub_dateErr) && empty($editionErr) 
            && empty($copiesErr) && empty($formatErr) && empty($age_groupErr) && empty($ratingErr) && empty($descErr)) {
                
            //if no errors, then save to db
            require_once('book.class.php');

            $bookObj = new book();
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

            if ($bookObj->add_book()) {
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
    <title>Add Book</title>
    <link rel="stylesheet" href="addbook.css">
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <header>
        <div>

        </div>
    </header>
    <h1>Add a new book to the library!</h1>

    <form action="" method="post" class="form">
        <label for="title">Book Title</label>
        <br>
        <input type="text" name="title" id="title" value="<?= $title ?>" placeholder="Enter Book Title">
        <?php
            if (empty($_POST['title'])) {
                ?>
                <span class="error"><?= $titleErr ?></span>
                <?php
            }
        ?>
        <br>

        <label for="author">Book Author</label>
        <br>
        <input type="text" name="author" id="author" value="<?= $author ?>" placeholder="Enter Lead Author's Name">
        <?php
            if (empty($_POST['author'])) {
                ?>
                <span class="error"><?= $authorErr ?></span>
                <?php
            }
        ?>  
        <br>

        <label for="genre">Book Genre</label>
        <br>
        <select name="genre" id="genre">
            <option value="">--SELECT--</option>
            <option value="Sci-Fi" <?= (isset($genre) && $genre=='Sci-Fi')? 'selected=true':'' ?>)>Sci-Fi</option>
            <option value="Fantasy" <?= (isset($genre) && $genre=='Fantasy')? 'selected=true':'' ?>>Fantasy</option>
            <option value="Romance" <?= (isset($genre) && $genre=='Romance')? 'selected=true':'' ?>>Romance</option>
            <option value="Thriller" <?= (isset($genre) && $genre=='Thriller')? 'selected=true':'' ?>>Thriller</option>
            <option value="Horror" <?= (isset($genre) && $genre=='Horror')? 'selected=true':'' ?>>Horror</option>
            <option value="Philosophy" <?= (isset($genre) && $genre=='Philosophy')? 'selected=true':'' ?>>Philosophy</option>
        </select>
        <?php
            if (empty($_POST['genre'])) {
                ?>
                <span class="error"><?= $genreErr ?></span>
                <?php
            }
        ?>  
        <br>

        <label for="publisher">Book Publisher</label>
        <br>
        <input type="text" name="publisher" id="publisher" value="<?= $publisher ?>" placeholder="Enter Publisher's Company Name">
        <?php
            if (empty($_POST['publisher'])) {
                ?>
                <span class="error"><?= $publisherErr ?></span>
                <?php
            }
        ?>
        <br>
        

        <label for="pub_date">Book Publication Date</label>
        <br>
        <input type="date" name="pub_date" id="pub_date" value="<?= $pub_date ?>">
        <?php
            if (empty($_POST['pub_date'])) {
                ?>
                <span class="error"><?= $pub_dateErr ?></span>
                <?php
            }
        ?>
        <br>

        <label for="edition">Book Edition</label>
        <br>
        <input type="number" name="edition" id="edition" value="<?= $edition ?>" placeholder="Enter Edition Number">
        <?php
            if (!empty($editionErr)) {
                ?>
                <span class="error"><?= $editionErr ?></span>
                <?php
            }
        ?>
        <br>

        <label for="copies">Number of Copies</label>
        <br>
        <input type="number" name="copies" id="copies" value="<?= $copies ?>" placeholder="Enter number of copies">
        <?php
            if (!empty($copiesErr)) {
                ?>
                <span class="error"><?= $copiesErr ?></span>
                <?php
            }
        ?>
        <br>

        <label for="format">Format</label>
        <br>
        <input type="radio" name="format" id="Hardbound" value="Hardbound" <?= (isset($format) && $format == 'Hardbound')? 'checked':''?>>
        <label for="Hardbound">Hardbound</label>
        <input type="radio" name="format" id="Softbound" value="Softbound" <?= (isset($format) && $format == 'Softbound')? 'checked':''?>>
        <label for="Softbound">Softbound</label>
        <?php
            if (!empty($formatErr)) {
                echo "<span class='error'>$formatErr</span>";
            }
        ?>
        <br>

        <label for="age_group">Age Group</label>
<br>
<input type="checkbox" name="age_group[]" id="Kids" value="Kids" <?= in_array('Kids', $age_group) ? 'checked' : '' ?>>
<label for="Kids">Kids</label>
<input type="checkbox" name="age_group[]" id="Teens" value="Teens" <?= in_array('Teens', $age_group) ? 'checked' : '' ?>>
<label for="Teens">Teens</label>
<input type="checkbox" name="age_group[]" id="Adult" value="Adult" <?= in_array('Adult', $age_group) ? 'checked' : '' ?>>
<label for="Adult">Adult</label>
<?php
    if (!empty($age_groupErr)) {
        echo "<span class='error'>$age_groupErr</span>";
    }
?>
<br>


        <label for="rating">Rating</label>
        <br>
        <span>1</span>
        <input type="range" name="rating" id="rating" value="" min="1" max="5" <?= (isset($rating) && $rating == 'rating')? 'rating':''?>>
        <span>5</span>
        <br>

        <label for="desc">Description</label>
        <br>
        <input type="text" name="desc" id="desc" placeholder="Describe this book (optional)" style="height: 100px;">
        <?php
            if (empty($_POST['desc'])) {
                ?>
                <span class="error"><?= $descErr ?></span>
                <?php
            }
        ?>
        <br>
        <input type="submit" name="submit" value="submit">

    </form>
</body>
</html>