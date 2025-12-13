<?php
    require_once "./Session/Session.php";


if (isset($_GET['dir'])) {

    $dir = $_GET['dir'];
    require_once "./Database/DatabaseConnect.php";

    require_once "./Classes/RegisteredUser.php";
    $u_id=$_SESSION["user_id"];
    $registered_user =  new Registered_User($u_id,$pdo);
        
    $result = $registered_user -> Fetch_Save($dir);
          
        
    header('Content-Type: application/json');
    echo json_encode($result, JSON_UNESCAPED_UNICODE);

}

