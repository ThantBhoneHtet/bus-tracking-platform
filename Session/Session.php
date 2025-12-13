<?php

    ini_set('session.use_only_cookies',1);
    ini_set('session.use_strict_mode',1);

    session_set_cookie_params
    ([
        'lifetime' => 604800,
        'domain'   => 'localhost',
        'path'     => '/',
        'secure'   => true,
        'httponly' => true
    ]);

    session_start();

    $session_interval = 1800;  

    if (isset($_SESSION["user_name"]))
    {
        if (!isset($_SESSION["Last_Regeneration"]) || (time() - $_SESSION["Last_Regeneration"]) >= $session_interval)
        {
            Create_Session_Id();
        }
    } 
    else
    {
        if (!isset($_SESSION["Last_Regeneration"]) || (time() - $_SESSION["Last_Regeneration"]) >= $session_interval) 
        {
            Create_Session_Id();
        }
    }


    function Create_Session_Id()
    {
        session_regenerate_id(true);
        $_SESSION["Last_Regeneration"] = time();
    };



?>