<?php

    require_once "vendor/autoload.php";

    
    use Doctrine\ORM\Tools\Setup;
    use Doctrine\ORM\EntityManager;

    // Load files for our application
    require_once("./entities/Users.php");
    require_once("./entities/Authentication.php");

    $paths = array("entities");
    $isDevMode = true;

    // the connection configuration
    $dbParams = array(
        'driver'   => 'pdo_mysql',
        'user'     => 'rok',
        'password' => '123',
        'dbname'   => 'mojabaza',
    );

    $config = Setup::createXMLMetadataConfiguration($paths, $isDevMode);
    $em = EntityManager::create($dbParams, $config); 

    // echo "I am bootstrap.php";

?>