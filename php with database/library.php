<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library catalogs</title>
    <link rel="stylesheet" href="library.css">
</head>
<body>
    <header>
        <p>Library</p>
        <a href="addbook.php">Add Product</a>
    </header>
    <table>
        <tr>
            <th>No.</th>
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
        </tr>

        <?php
            require_once('book.class.php');

            $book_obj = new Book();
            $array = $book_obj->showAll();

            $i = 1;

            foreach($array as $arr) {
                // Convert the comma-separated age_group string back into an array
                $age_group_array = explode(',', $arr['book_age_group']);
                // Join the array elements into a comma-separated string for display
                $age_group_display = implode(', ', $age_group_array);

                ?>
                <tr>
                    <td><?= $i ?></td>
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
                </tr>
                <?php
                $i++;
            }
        ?>
    </table>
</body>
</html>