<?php

    require_once "../Session/Session.php";

    // Step 2: Handle the data in PHP
    if (isset($_GET['route'])) {
        // Get the route data from the query string
        $RouteData = $_GET['route'];
        $directory = $_GET['directory'];
        file_put_contents('saved_routes.txt', $RouteData . PHP_EOL, FILE_APPEND);

        unset($_GET['route']);

       
    
        require_once "../Classes/RegisteredUser.php";
        require_once "../Database/DatabaseConnect.php";
       
        $registered_user -> Save_route($RouteData, $directory);
           
    }
    ?>


