<?php
    require_once 'functions.php';
    require_once 'account.class.php';

    //redirects the user if he's already logged in and trying to access register.php.
    // no need to go back to register. experiment by me
    session_start();
    
    if (isset($_SESSION['account']['is_staff'])) {
        header('location: dashboard.php');
    } else {
        header('location: homepage.php');
    }

    //variables declarations
    $first_name = $last_name = $username = $password = $confirm_password = $role = $is_staff = $is_admin = '';
    $first_name_err = $last_name_err = $username_err = $password_err = $role_err = $is_staff_err = $is_admin_err = '';

    //object declaration
    $accountObj = new Account();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $first_name = clean_input($_POST['first_name']);
        $last_name = clean_input($_POST['last_name']);
        $username = clean_input($_POST['username']);
        $password = clean_input($_POST['password']);
        $confirm_password = clean_input($_POST['confirm_password']);
        $role = clean_input($_POST['role']);
        $is_staff = clean_input($_POST['is_staff']);
        $is_admin = clean_input($_POST['is_admin']);

        //check for error
        if(empty($first_name)){
            $first_name_err = 'First name is required';
        }

        if(empty($last_name)){
            $last_name_err = 'Last name is required';
        }

        if (empty($username)) {
            $username_err = 'Username is required';
        }

        if (!(empty($username)) && $accountObj->usernameExist($username, $excludeID = null))
        {
            $username_err = 'Username exists';
        }
        
        
        //putting $first_name, $last_name, and $username in a safesearchtext to prevent regex injection
        $safeSearch_firstn = preg_quote($first_name, '/');
        $safeSearch_lastn = preg_quote($last_name, '/');
        $safeSearch_usern = preg_quote($username, '/');

        $pattern_firstn = "/$safeSearch_firstn/";
        $pattern_lastn = "/$safeSearch_lastn/";
        $pattern_usern = "/$safeSearch_usern/";

        if (empty($password) || (empty($confirm_password))) {
            
            $password_err = 'Both fields are required!';
        
        } elseif ($password !== $confirm_password) {
            
            $password_err = 'Password do not match';
        
        } elseif (strlen($password) < 8 || strlen($password) > 16) {
            
            $password_err = "Password should be min 8 characters and max 16 characters";
            // $confirm_password_err[] = "Password should be min 8 characters and max 16 characters";

        }
        elseif (!preg_match("/\d/", $password)) {

            $password_err = "Password should contain at least one digit";
            // $confirm_password_err[] = "Password should contain at least one digit";
        }
        elseif (!preg_match("/[A-Z]/", $password)) {

            $password_err = "Password should contain at least one Capital Letter";
            // $confirm_password_err[] = "Password should contain at least one Capital Letter";

        }
        elseif (!preg_match("/[a-z]/", $password)) {
            
            $password_err = "Password should contain at least one small Letter";
            // $confirm_password_err[] = "Password should contain at least one small Letter";

        }
        elseif (!preg_match("/\W/", $password)) {

            $password_err = "Password should contain at least one special character";
            // $confirm_password_err[] = "Password should contain at least one special character";

        }
        elseif (preg_match("/\s/", $password)) {

            $password_err = "Password should not contain any white space";
        
        } elseif (preg_match("/^$safeSearch_firstn$/i", $password) || preg_match("/^$safeSearch_lastn$/i", $password) || preg_match("/^$safeSearch_usern$/i", $password)) {
            //regex that checks only for full first_name, last_name, and username. variations such as removing a single char in those fields will let the user be registered.
            $password_err = "Weak password! Avoid using your first name, last name, or username";
        }

        if(empty($first_name_err) && empty($last_name_err) && empty($username_err) && empty($password_err)){

            //passing to the object
            $accountObj->first_name = $first_name;
            $accountObj->last_name = $last_name;

            $accountObj->username = $username;

            $accountObj->password = $password;
            $accountObj->role = $role;
            $accountObj->is_staff = $is_staff;
            $accountObj->is_admin = $is_admin;

            if($accountObj->add()){
                // If successful, notify the user the account is added
                echo 'Account Registered! ';
                ?>
                    <span><a href="login.php">Click</a> to login.</span>
                    <br>
                <?php
                
            } else {
                // If an error occurs during insertion, display an error message.
                echo 'Registering failed.';
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <style>
        .error{
            color: red;
        }
    </style>
</head>
<body>
    <form action="register.php" method="post">

        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" value="<?= $first_name ?>">
        <!-- <br> -->
        <span class="error">
            <?php 
                if (!(empty($first_name_err)))
                {
                    echo $first_name_err;
                }
            ?>
        </span>

        <br>
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name" value="<?= $last_name ?>">
        <span class="error">
            <?php 
                if (!(empty($last_name_err)))
                {
                    echo $last_name_err;
                }
            ?>
        </span>

        <br>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?= $username ?>">
        <span class="error">
            <?php 
                if (!(empty($username_err)))
                {
                    echo $username_err;
                }
            ?>
        </span>

        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" value="<?= $password ?>">
        <span class="error">
            <?php 
                if ($password_err) {
                    echo $password_err . "\n";
                }
            ?>
        </span>

        <br>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" value="<?= $confirm_password ?>">
        <span class="error">
            <?php 
                if ($password_err) {
                    echo $password_err . "\n";
                }
            ?>
        </span>
            
        <br>
        <input type="hidden" name="role" value="Customer">
        <input type="hidden" name="is_staff" value="0">
        <input type="hidden" name="is_admin" value="0">
        
        <input type="submit" value="Register">
        <br>
    </form>
</body>
</html>