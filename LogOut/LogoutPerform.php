<?php

    require_once "../Session/Session.php";
    
    session_unset();
    session_destroy();

    header("Location: ../index.php");

?>