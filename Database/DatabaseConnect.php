<?php

    $dsn     = "mysql:host=localhost; dbname=bus_stops_db; port=3306";
    $db_user = "root";
    $db_pass = "2004820";

    try
    {
        $pdo  = new PDO($dsn,$db_user,$db_pass);
        $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch( PDOException $e)
    {
        die("Something is wrong". $e->getMessage());
    };
?>