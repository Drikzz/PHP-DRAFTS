<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library catalogs</title>
    <link rel="stylesheet" href="library.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <p class="document-heading">The Book Haven</p>
        <div class="view-button-container">
            <a href="addbook.php" class="view-button">Add book</a>
            <p class="login">Login</p>
        </div>
    </header>
    
    <!-- Call of book.class.php and instance of the class Book -->
    <?php

        //functions and class calls
        require_once('book.class.php');

        $book_obj = new Book();
        $array = $book_obj->showAll();

        //initialize to empty before assigning
        $keyword = $genre = $format = '';
        $age_group = []; // declare as array to check the checkbox of age_group


        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
            
            // get and clean the inputs
            $keyword = htmlentities($_POST['keyword']);
            $genre = htmlentities($_POST['genre']);
            $format = htmlentities($_POST['format']);

            if (isset($_POST['age_group'])) {
                $age_group = $_POST['age_group']; 
                $age_group_implode = implode(',', $age_group); // set array age_group to string to be passed in the paramaters
            } else {
                $age_group_implode = ''; //let implode be empty if no age_group input
            }

            $array = $book_obj->show_result($keyword, $genre, $format, $age_group_implode);
        }
    ?>

    <div>
        <form action="" method="post" class="search">

            <div class="input-row">
                <!-- genre dropdown -->
                <label for="genre">Genre</label>
                <select name="genre" id="genre">
                    <option value="">ALL</option>
                    <option value="Sci-Fi" <?= (isset($genre) && $genre=='Sci-Fi')? 'selected=true':'' ?>>Sci-Fi</option>
                    <option value="Fantasy" <?= (isset($genre) && $genre=='Fantasy')? 'selected=true':'' ?>>Fantasy</option>
                    <option value="Romance" <?= (isset($genre) && $genre=='Romance')? 'selected=true':'' ?>>Romance</option>
                    <option value="Thriller" <?= (isset($genre) && $genre=='Thriller')? 'selected=true':'' ?>>Thriller</option>
                    <option value="Horror" <?= (isset($genre) && $genre=='Horror')? 'selected=true':'' ?>>Horror</option>
                    <option value="Philosophy" <?= (isset($genre) && $genre=='Philosophy')? 'selected=true':'' ?>>Philosophy</option>
                </select>
            </div>
            
            <div class="input-row">
                <!-- format radio button -->
                <label for="genre">Format</label>
                <select name="format" id="format">
                    <option value="">ALL</option>
                    <option value="Hardbound" <?= (isset($format) && $format=='Hardbound')? 'selected=true':'' ?>>Hardbound</option>
                    <option value="Softbound" <?= (isset($format) && $format=='Softbound')? 'selected=true':'' ?>>Softbound</option>
                </select>

            </div>
            
            <!-- age group checkbox -->
            <div class="input-row">
                <!-- naging array ung mga checkbox -->
                <label for="age_group">Format</label>
                <input type="checkbox" name="age_group[]" id="Kids" value="Kids" <?= (in_array("Kids", $age_group)) ? 'checked':'' ?>> 
                <label for="Kids">Kids</label>
                
                <input type="checkbox" name="age_group[]" id="Teens" value="Teens" <?= (in_array("Teens", $age_group)) ? 'checked':'' ?>>
                <label for="Teens">Teens</label>

                <input type="checkbox" name="age_group[]" id="Adult" value="Adult" <?= (in_array("Adult", $age_group)) ? 'checked':'' ?>>
                <label for="Adult">Adult</label>
            </div>

            <div class="input-row">
                <!-- search -->
                <label for="search">Search</label>
                <input type="text" name="keyword" id="keyword" value="<?= $keyword ?>">
                <input type="submit" value="Search" name="search" id="search">
            </div> 
        </form>
    </div>

    <div class="table-container">
       <table>
        <tr>
            <th>No.</th>
            <!-- ADDED -->
            <th>Barcode</th>

            <th>Title</th>
            <th>Author</th>
            <th>Genre</th>
            <th>Publisher</th>
            <th>Publication Date</th>
            <th>Edition</th>
            <th>Number of Copies</th>
            <th>Format</th>
            <th>Age Group</th>
            <th>Book Rating</th>
            <th>Description</th>
            
            <!-- ADDED -->
            <th>Manage</th>
        </tr>

        <?php

            $i = 1;

            foreach($array as $arr) {

                // Convert the comma-separated age_group string back into an array
                $age_group_array = explode(',', $arr['book_age_group']);

                // Join the array elements into a comma-separated string for display
                $age_group_display = implode(', ', $age_group_array);

                ?>
                <tr class="data-row">
                    <td><?= $i ?></td>
                    <!-- ADDED -->
                    <td><?= $arr['book_barcode']?></td>

                    <td><?= $arr['book_title']?></td>
                    <td><?= $arr['book_author']?></td>
                    <td><?= $arr['book_genre']?></td>
                    <td><?= $arr['book_publisher']?></td>
                    <td><?= $arr['book_pub_date']?></td>
                    <td><?= $arr['book_edition']?></td>
                    <td><?= $arr['book_copies']?></td>
                    <td><?= $arr['book_format']?></td>
                    <td><?= $age_group_display ?></td>
                    <td><?= $arr['book_rating']?></td>
                    <td><?= $arr['book_desc']?></td>

                    <td>
                        <a href="editbook.php?book_selected=<?= $arr['book_id']?>">Edit</a>
                        <a href="" class="deleteBtn" data-id="<?= $arr['book_id']?>" data-name="<?= $arr['book_title']?>">Delete</a>
                    </td>
                </tr>
                <?php
                $i++;
            }
        ?>
    </table> 
    </div>
    <script src="book.js"></script>
</body>
</html>