<?php

    session_start();

    // Display errors if there are any.
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    // Use Doctrine ORM.
    require_once "bootstrap.php";

    // Redirect if not logged in
    if (isset($_SESSION['username'])) {
        // $_SESSION['username'] is logged in
    } else {
        header("Location: http://test.local/login.php");
    }

    if(isset($_POST['logout'])) {
        unset($_SESSION['username']);
        header("Location: http://test.local/login.php");
    }

    // Search database querys with post number. Use Doctrine ORM.
    function find_rows_containing_post_number_orm($em, $post_number) {

        $search_variable = "%$post_number%";

        $result = $em->getRepository("Users")->createQueryBuilder('users_query_builder')
        ->andWhere('users_query_builder.post_number LIKE :pn')
        ->setParameter('pn', $search_variable)
        ->getQuery()
        ->getResult();

        // Print array of results as rows in table.
        echo "<table class='table table-dark'>";
        echo "<tr><th scope='col'>Id</th><th scope='col'>Name</th><th scope='col'>Post Number</th></tr>";

        if ($result !== null) {
            foreach($result as $user) {
                echo '<tr>';
                echo "<td scope='row'>" . $user->getId() . '</td>';
                echo "<td scope='row'>" . $user->getName() . '</td>';
                echo "<td scope='row'>" . $user->getPostNumber() . '</td>';
                echo '</tr>';
            }
        }
        echo '</table>';
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>PHP App</title>
    </head>
        <nav class="navbar navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="/img/php.png" width="50" height="50" class="d-inline-block align-top" alt="">
                </a>
                <div class="float-right">
                    <h1>Application <small>by Rok Klančar</small></h1>
                    <form action="" method="post">
                        <input type="submit" class="form-control mb-2" name="logout" value="Log out" class="btn btn-primary mb-2">
                    </form>
                </div>
            </div>
        </nav>
    <body>
        <div class="container py-3">

            <!-- SEARCH FORM -->
            <div class="py-1">
                <h3>Search table</h3>
                    <!-- Form action executed in this script. -->
                    <form action="" method="POST">
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <input type="text" class="form-control mb-2" name="post_number" placeholder="Post Number">
                            </div>
                            <div class="col-auto">
                                <input type="submit" class="form-control mb-2" name="search" value="Submit" class="btn btn-primary mb-2">
                            </div>
                        </div>
                        <small class="form-text text-muted">To display the whole table, submit with an empty input box.</small>
                    </form>
            </div>

            <!-- ADD FORM -->
            <div class="py-1">
                <h3>Add entry</h3>
                    <!-- Form action executed in the add.php script. -->
                    <form action="add.php" method="POST">
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <input type="text" class="form-control mb-2" name="name" placeholder="Name" required>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control mb-2" name="post_number" placeholder="Post Number" required>
                            </div>
                            <div class="col-auto">
                                <input type="submit" class="form-control mb-2" value="Submit" name="add" class="btn btn-primary mb-2">
                            </div>
                        </div>
                        <!-- If sesstion variable is set, error appears. -->
                        <small class="form-text text-danger"><?php if(isset($_SESSION['adderr_longname'])) {echo $_SESSION['adderr_longname'];}?></small>
                        <small class="form-text text-danger"><?php if(isset($_SESSION['adderr_longpost'])) {echo $_SESSION['adderr_longpost'];}?></small>
                        <small class="form-text text-danger"><?php if(isset($_SESSION['adderr_userexists'])) {echo $_SESSION['adderr_userexists'];}?></small>
                        <small class="form-text text-success"><?php if(isset($_SESSION['addsucc'])) {echo $_SESSION['addsucc'];}?></small>
                    </form>
            </div>

            <!-- DELETE FORM -->
            <div class="py-1">
                <h3>Delete entry</h3>
                    <!-- Form action executed in the delete.php script. -->
                    <form action="delete.php" method="POST">
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <input type="text" class="form-control mb-2" name="id" placeholder="ID" required>
                            </div>
                            <div class="col-auto">
                                <input type="submit" class="form-control mb-2" name="delete" value="Submit" class="btn btn-primary mb-2">
                            </div>
                        </div>
                        <!-- If sesstion variable is set, error appears. -->
                        <small class="form-text text-danger"><?php if(isset($_SESSION['delerr'])) {echo $_SESSION['delerr'];}?></small>
                        <small class="form-text text-success"><?php if(isset($_SESSION['delsucc'])) {echo $_SESSION['delsucc'];}?></small>
                    </form>
            </div>


        </div>

        <!-- DISPLAY TABLE -->
        <!-- If search query is run, display the results, otherwise display the whole table. -->
        <div class="container">
            <?php
            if( isset($_POST['search'])){
                    // Reset all errors.
                    unset($_SESSION['adderr_longname']);
                    unset($_SESSION['adderr_longpost']);
                    unset($_SESSION['adderr_userexists']);
                    unset($_SESSION['addsucc']);
                    unset($_SESSION['delerr']);
                    unset($_SESSION['delsucc']);

                    // Get 'post_number' variable from the search form.
                    $post_number = htmlentities($_POST['post_number']);

                    find_rows_containing_post_number_orm($em, $post_number);
                } else {
                    // Show the whole table when the website is visited.
                    find_rows_containing_post_number_orm($em, '');
                    }
            ?>
        </div>
    </body>
</html>