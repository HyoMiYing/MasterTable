<?php
    session_start();

    // Display errors if there are any.
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    require_once "bootstrap.php";


    // When the submit button is pressed:
    if(isset($_POST['loginsubmit'])){

        // Clean the input.
        $username = htmlentities($_POST['username']);
        $userpassword = htmlentities($_POST['userpassword']);

        $user_row = $em->getRepository('Authentication')->findOneBy(array('name' => $username));

        // Verify the username is correct.
        if($user_row == True){

            $password_hash = $user_row->getPasswordHash();
            
            $verify_password = password_verify($userpassword, $password_hash);

            // Verify the password is correct.
            if($verify_password == True){
                $_SESSION['username'] = $username;
                unset($_SESSION['username_error']);
                unset($_SESSION['password_error']);

                // Redirect to the main page.
                header("Location: http://test.local");
            } else {
                unset($_SESSION['username_error']);
                $_SESSION['password_error'] = "Wrong password";
            }
        }
        else {
            unset($_SESSION['password_error']);
            $_SESSION['username_error'] = "No user with that name";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>PHP App Login</title>
</head>
<body>
    <form action="" method="post" class="container" style="margin-top: 50px;">
        <h1 class="h2 text-center">App Login</h1>
            <div class="form-group mb-2">
                <label for="username-input">Username</label>
                <input type="text" class="form-control" name="username" id="username-input" required>
                <small class="form-text text-danger"><?php if(isset($_SESSION['username_error'])) {echo $_SESSION['username_error'];}?></small>
            </div>
            <div class="form-group">
                <label for="password-input">Password</label>
                <input type="password" class="form-control" name="userpassword" id="password-input" required>
                <small class="form-text text-danger"><?php if(isset($_SESSION['password_error'])) {echo $_SESSION['password_error'];}?></small>
            </div>
            <input type="submit" class="btn btn-primary" name="loginsubmit" value="Log in">
            or
            <a href="register.php">Register new user</a>
    </form>
</body>
</html>