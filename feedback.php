<?php

    if (isset($_GET['feedback'])) 
    {

        $feedback = htmlspecialchars($_GET["feedback"]);

        require_once "Session/Session.php";
        require_once "Database/DatabaseConnect.php";
        require_once "Classes/RegisteredUser.php";
        
        if(!empty($feedback))
        {
            $u_id=$_SESSION["user_id"];
            $registered_user =  new Registered_User($u_id,$pdo);
            $registered_user -> save_feedback($feedback);
        }

    }
?>


