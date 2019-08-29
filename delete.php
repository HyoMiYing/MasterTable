<?php

    session_start();

    // Show errors if there are any.
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    // Use Doctrine ORM.
    require_once "bootstrap.php";

    // Validate input and delete query if it exists. Send out error message if it doesn't exist.
    function delete_entry_orm($id, $em) {
    
        session_unset();

        $single_user = $em->find('Users', $id);

        // Check if user entry is found. And delete it.
        if($single_user != NULL) {
            $em->remove($single_user);
            $em->flush();
            $_SESSION['delsucc'] = "User with ID=".$id." deleted successfully";
            header('Location: http://test.local');
        // Return to home page with error if user doesn't exist.
        } else {
            $_SESSION['delerr'] = "User with ID=".$id." does not exist";
            header('Location: http://test.local');
        }

    }
    
    
    if(isset($_POST['delete'])){
        $id = htmlentities($_POST['id']);
            delete_entry_orm($id, $em);
    
    // Redirect to home page if 'delete.php' is accessed manually.
    } else {
        header('Location: http://test.local');
    }