<?php

    // Display errors if there are any.

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    // Establish a connection to the DSN.

    $host = '127.0.0.1';
    $db   = 'mojabaza';
    $user = 'rok';
    $pass = '123';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }


    // Search database querys. Take post number for input. Find all querys that contain string.

    function find_rows_containing_post_number($find, $pdo) {

            $post_number = htmlentities($_POST['post_number']);
            $search = "%$post_number%";
            $stmt = $pdo->prepare("SELECT * FROM users WHERE post_number LIKE ?");
            $stmt->execute([$search]);

            echo "<table class='table table-dark'>";
            echo "<tr><th scope='col'>Id</th><th scope='col'>Name</th><th scope='col'>Post Number</th></tr>";

            while ($row = $stmt->fetch()) {
                echo '<tr>';
                echo "<td scope='row'>" . $row['id'] . '</td>';
                echo "<td scope='row'>" . $row['name'] . '</td>';
                echo "<td scope='row'>" . $row['post_number'] . '</td>';
                echo '</tr>';
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
                <h1>Application <small>by Rok Klančar</small></h1>
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
                                <input type="submit" class="form-control mb-2" name="find" value="Submit" class="btn btn-primary mb-2">
                            </div>
                        </div>
                        <small id="emailHelp" class="form-text text-muted">To display the whole table, submit with an empty input box.</small>
                    </form>
            </div>

            <!-- ADD FORM -->
            <div class="py-1">
                <h3>Add entry</h3>
                    <!-- Form action executed in the add.php script. -->
                    <form action="add.php" method="POST" class="form-inline">
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
                    </form>
            </div>

            <!-- DELETE FORM -->
            <div class="py-1">
                <h3>Delete entry</h3>
                    <!-- Form action executed in the delete.php script. -->
                    <form action="delete.php" method="POST" class="form-inline">
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <input type="text" class="form-control mb-2" name="id" placeholder="ID" required>
                            </div>
                            <div class="col-auto">
                                <input type="submit" class="form-control mb-2" value="Submit" name="delete" class="btn btn-primary mb-2">
                            </div>
                        </div>
                    </form>
            </div>

        </div>

        <!-- DISPLAY TABLE -->
        <!-- If search query is run, display the results, otherwise display the whole table. -->
        <div class="container">
            <?php
            if( isset($_POST['find'])){

                    $find = htmlentities($_POST['find']);
                    find_rows_containing_post_number($find, $pdo);
                } else {
                    $stmt = $pdo->query('SELECT * FROM users');

                    echo "<table class='table table-dark'>";
                    echo "<tr><th scope='col'>Id</th><th scope='col'>Name</th><th scope='col'>Post Number</th></tr>";
                    while ($row = $stmt->fetch()) {
                        echo '<tr>';
                        echo "<td scope='row'>" . $row['id'] . '</td>';
                        echo "<td scope='row'>" . $row['name'] . '</td>';
                        echo "<td scope='row'>" . $row['post_number'] . '</td>';
                        echo '</tr>';
                    }
                     echo "</table>";
            }
            ?>
        </div>
    </body>
</html>