<?php


if (isset($_GET['dir'])) {

    $dir = $_GET['dir'];
    require_once "../Classes/RegisteredUser.php";
    require_once "../Database/DatabaseConnect.php";
       

    $result = $registered_user -> Fetch_Save($dir);
          
        
    header('Content-Type: application/json');
    echo json_encode($result, JSON_UNESCAPED_UNICODE);

}

// $select = "SELECT * FROM Saved_Route WHERE directory = 'home'";
// $saved_data = $pdo->query($select);
// $saved_data = $saved_data->fetchAll(PDO::FETCH_ASSOC); // Fetch the data
// print_r($saved_data); // Print the result

