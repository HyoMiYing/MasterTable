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

    // Function that deletes a MySql row, identified by ID.

    function delete_entry($id, $pdo) {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt= $pdo->prepare($sql);
        $execution = $stmt->execute([$id]);
    }

    // If the recieved data is valid, the "delete" function is run. Otherwise just reload the page.
    
    if(isset($_POST['delete'])){
        $id = htmlentities($_POST['id']);
        
        if(empty($id)){
            header("Location: http://test.local");
            exit;
        } else {
            delete_entry($id, $pdo);
            header("Location: http://test.local");
            exit;
        }
    }