<?php
    session_start();

    // Display errors if there are any.
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    require_once "bootstrap.php";


    function register_new_user_orm($username, $hashed_password, $em) {
        $user = new Authentication();
        $user->setName ($username);
        $user->setPasswordHash($hashed_password);

        $em->persist($user);
        $em->flush();
        unset($_POST);

    }

    if(isset($_POST['registersubmit'])){

        unset($_SESSION['passwords_dont_match']);
        unset($_SESSION['user_not_unique']);
        unset($_SESSION['register_success']);
        
        $username = htmlentities($_POST['username']);
        $password1 = htmlentities($_POST['password1']);
        $password2 = htmlentities($_POST['password2']);

        $existing_user_check = $em->getRepository('Authentication')->findOneBy(array('name' => $username));

        // Check if user with this name already exists.
        if($existing_user_check != TRUE) {


            // Check if the password inputs match.
            if($password1 == $password2) {
                // Transform password to hash and add a new user.
                $hashed_password = password_hash($password1, PASSWORD_DEFAULT);

                register_new_user_orm($username, $hashed_password, $em);

                $_SESSION['register_success'] = "New user successfully added";

            } else {

                $_SESSION['passwords_dont_match'] = "Please make sure the passwords match";
            }

        } else {
            
            $_SESSION['user_not_unique'] = "User with this name already exists";
        }
        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP App Register</title>
</head>
<body>
    <form action="" method="post" class="container" style="margin-top: 50px;">
        <h1 class="h2 text-center">Register new user</h1>
            <div class="form-group">
                <label for="InputUsername">Username</label>
                <input type="text" class="form-control" id="InputUsername" name="username" required>
                <small class="form-text text-muted">Choose a unique username</small>
                <small class="form-text text-danger"><?php if(isset($_SESSION['user_not_unique'])) {echo $_SESSION['user_not_unique'];}?></small>
                <small class="form-text text-success"><?php if(isset($_SESSION['register_success'])) {echo $_SESSION['register_success'];}?></small>

            </div>
            <div class="form-group">
                <label for="Password1">Password</label>
                <input type="password" class="form-control" id="Password1" name="password1" required>
            </div>
            <div class="form-group">
                <label for="Password2">Repeat Password</label>
                <input type="password" class="form-control" id="Password2" name="password2" required>
                <small class="form-text text-danger"><?php if(isset($_SESSION['passwords_dont_match'])) {echo $_SESSION['passwords_dont_match'];}?></small>
            </div>
            <button type="submit" name="registersubmit" class="btn btn-primary">Create new user</button>
            or
            <a href="login.php">Log in with an existing user</a>
    </form>
</body>
</html>