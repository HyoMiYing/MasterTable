<?php

    session_start();

    
    // Show errors if there are any.
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    
    // Use Doctrine ORM.
    require_once "bootstrap.php";

    // Simple add a row to table function using Doctrine ORM.
    function add_a_row_orm($name, $post_number, $em) {
        $user = new Users();
        $user->setName ($name);
        $user->setPostNumber ($post_number);

        $em->persist($user);
        $em->flush();
        unset($_POST);
    }

    
    // If the recieved data is valid, the "add" function is run. Otherwise just reload the page.
    if(isset($_POST['add'])){

        unset($_SESSION['adderr_longname']);
        unset($_SESSION['adderr_longpost']);
        unset($_SESSION['adderr_userexists']);
        unset($_SESSION['addsucc']);
        unset($_SESSION['delerr']);
        unset($_SESSION['delsucc']);

        $name = htmlentities($_POST['name']);
        $post_number = htmlentities($_POST['post_number']);

        // Check that 'name' field isn't too long.
        if(strlen($name)>255){
            $_SESSION['adderr_longname'] = 'Name='.$name.' is too long';
            header('Location: http://test.local');
        } else {

            // Check that 'post_number' field isn't too long.
            if(strlen($post_number)>10) {
            $_SESSION['adderr_longpost'] = 'Post Number='.$post_number.' is too long';
            header("Location: http://test.local");
            } else {

                // Check whether this user already exists.
                if($users = $em->getRepository('Users')->findOneBy(array('name' => $name, 'post_number' => $post_number)) == true) {
                    $_SESSION['adderr_userexists'] = 'User with name='.$name.' and post number='.$post_number.' already exists';
                    header("Location: http://test.local");
                } else {

                    // If everything is ok, run function to add entry to database.
                    add_a_row_orm($name, $post_number, $em);
                    $_SESSION['addsucc'] = 'New user successfully added to the database';
                    header("Location: http://test.local");
            }
        }
    }
    // Redirect to home page if 'add.php' is accessed manually.
    } else {
        header("Location: http://test.local");
    }
?>