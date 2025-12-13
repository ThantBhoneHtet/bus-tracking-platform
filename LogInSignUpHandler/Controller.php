<?php

    function Empty_Input_LogIn_Form(string $UserEmail, string $UserPassword)
    {
        if(empty($UserEmail) || empty($UserPassword))
        {
            return true;
        }
        else
        {
            return false;
        };
    };


    function Empty_Input_SignIn_Form(string $UserName, string $UserEmail, string $UserPassword)
    {
        if(empty($UserName) || empty($UserEmail) || empty($UserPassword))
        {
            return true;
        };
    };


    function Invalid_Email(string $UserEmail)
    {
        if(!empty($UserEmail))
        {   
            if(!filter_var($UserEmail,FILTER_VALIDATE_EMAIL))
            {
                return true;
            }
            else
            {
                return false;
            };
        };
    };


    function Find_Used_Name(object $pdo, string $UserName)
    {
        if(Find_Same_Name($pdo,$UserName))
        {
            return true;
        }
        else
        {
            return false;
        };
    };


    function Find_Used_Mail(object $pdo, string $UserEmail)
    {
        if(Find_Same_Mail($pdo,$UserEmail))
        {
            return true;
        }
        else
        {
            return false;
        };
    };


    function Check_User(object $pdo, string $UserEmail)
    {
        if(empty(Extract_User_Info($pdo,$UserEmail)))
        {
            return true;
        }
        else
        {
            return false;
        };
    };

?>