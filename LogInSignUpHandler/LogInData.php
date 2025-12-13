<?php

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $UserEmail    = htmlspecialchars($_POST["UserEmail"]);
        $UserPassword = htmlspecialchars($_POST["UserPassword"]);


        require_once "../Session/Session.php";
        require_once "../Database/DatabaseConnect.php";
        require_once "Model.php";
        require_once "View.php";
        require_once "Controller.php";



        $Errors = [];
        $Error_case = false;


        if(Empty_Input_LogIn_Form($UserEmail,$UserPassword))
        {
            header("Location: ../login.php");
        }
        else
        {
            if(Check_User($pdo,$UserEmail))
            {
                $Errors["user_not_found"] = "User with this E-mail does not exist";
                $Error_case = true;
            }
            else
            {
                $UserInfo = Extract_User_Info($pdo,$UserEmail);
                if(password_verify($UserPassword,$UserInfo["Password"]))
                {
                    $Error_case =false;
                }
                else
                {
                    $Errors["wrong_password"] = "Password is incorrect";
                    $Error_case = true;
                };
            };
        };

        if($Error_case == true)
        {
            if(isset($Errors["user_not_found"]))
            {
                $_SESSION["user_not_found"] = $Errors["user_not_found"];
                unset($Errors["user_not_found"]); 
                header("Location: ../login.php");
            }
            else
            {
                if(isset($Errors["wrong_password"]))
                {
                    $_SESSION["wrong_password"] = $Errors["wrong_password"];
                    unset($Errors["wrong_password"]);
                    header("Location: ../login.php");
                };
            };
        };

        if($Error_case == false)
        {
            $UserInfo["Role"] =(string)$UserInfo["Role"]; 

            if($UserInfo["Role"] == "user")
            {          
                $_SESSION["user_name"] = $UserInfo["Name"];
                $_SESSION["user_mail"] = $UserEmail;

                $UserName = $UserInfo["Name"];
                $User_Id  = Get_User_Id($pdo,$UserName);
                $_SESSION["user_id"]  = (int)$User_Id["Id"];

                header("Location: ../index.php");
            };

            if($UserInfo["Role"] == "Admin")
            {
                $_SESSION["admin_name"] = $UserInfo["Name"];
                $_SESSION["admin_mail"] = $UserEmail;

                header("Location: ../AdminDashboard/admin(busline).php");
            };
        };






    }
    else
    {
        echo header("Location:../home.php");
    };
?>