<?php

    function Empty_Input_LogIn()
    {
        if(isset($_SESSION["empty_input"]))
        {
            echo "<p style='color:red;'>".$_SESSION["empty_input"]."</p>";
            unset($_SESSION["empty_input"]); 
        }; 
    };


    function Empty_Input_SignUp()
    {
        if(isset($_SESSION["Empty_input"]))
        {
            echo "<p style='color:red;'>".$_SESSION["Empty_input"]."</p>";
            unset($_SESSION["Empty_input"]); 
        }; 
    };


    function Print_Name()
    {
        if(isset($_SESSION["user_name"]))
        {
            echo $_SESSION["user_name"];
        };

        if(isset($_SESSION["admin_name"] ))
        {
            echo $_SESSION["admin_name"]; 
        };
    };


    function Print_Mail()
    {
        if(isset($_SESSION["user_mail"]))
        {
            echo $_SESSION["user_mail"];
        };

        if(isset($_SESSION["admin_mail"] ))
        {
            echo $_SESSION["admin_mail"]; 
        };
    };

    
    function Print_Profile_Picture()
    {
        if(isset($_SESSION["user_pic"]))
        {
            return $_SESSION["user_pic"];
        }
        elseif(isset($_SESSION["admin_pic"]))
        {
            return $_SESSION["admin_pic"];
        }
        else
        {
            return "profile_pics/Default_Photo.jpg";
        };
    };
    
    


    





?>