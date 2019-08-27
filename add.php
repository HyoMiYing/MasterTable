<?php

    // Show errors if there are any.

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    // Set up a connection with DNS (PDO).

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

    // Function, that adds a row to the MySql table with provided data. 

    function add_a_row($name, $post_number, $pdo) {
        $sql = "INSERT INTO users (name, post_number) VALUES (?, ?)";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$name, $post_number]);
        unset($_POST);
    }
    
    // If the recieved data is valid, the "add" function is run. Otherwise just reload the page.

    if(isset($_POST['add'])){
        $name = htmlentities($_POST['name']);
        $post_number = htmlentities($_POST['post_number']);

        if(strlen($name)>255 OR strlen($post_number)>10){
            header('Location: http://test.local');
        } else {
            add_a_row($name, $post_number, $pdo);
            header("Location: http://test.local");
        }
    } 
?>