<?php 
    require_once 'account.class.php';

    session_start();

    $accountObj = new Account();

    if (isset($_SESSION['account'])) {
        $username = $_SESSION['account']['username'];
    }
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <?php
        ?>
        <h1>Welcome, <?php echo $username?>!</h1>
        <a href="logout.php">Logout</a>
        <?php
    ?>
</body>
</html>