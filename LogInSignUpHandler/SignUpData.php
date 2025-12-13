<?php

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
       $UserName     = htmlspecialchars($_POST["UserName"]);
       $UserEmail    = htmlspecialchars($_POST["UserEmail"]);
       $UserPassword = htmlspecialchars($_POST["UserPassword"]);


       require_once "../Session/Session.php";
       require_once "../Database/DatabaseConnect.php";
       require_once "Model.php";
       require_once "View.php";
       require_once "Controller.php";
 


       $Errors = [];
       $Error_case = false;
    

       if(Empty_Input_SignIn_Form($UserName,$UserEmail,$UserPassword))
       {
            $Error_case = true;
            header("Location: ../signup.php");
       }
       else
       {
            if(Find_Used_Name($pdo,$UserName))
            {
                 $Errors["used_name"] = "Name is already used by other user";
                 $Error_case = true;
            };
            if(Invalid_Email($UserEmail))
            {
                 $Errors["invalid_mail"] = "Your mail is invalid";
                 $Error_case = true;
            };
            if(Find_Used_Mail($pdo,$UserEmail))
            {
                 $Errors["used_mail"] = "Mail is already used by a user";
                 $Error_case = true;
            };
       };
       

       if($Error_case == true)
       {
          if(isset($Errors["used_name"]))
          {
               $_SESSION["used_name"] = $Errors["used_name"];
               header("Location: ../signup.php");
               unset($Errors["used_name"]);
          };
          if(isset($Errors["invalid_mail"]))
          {
               $_SESSION["invalid_mail"] = $Errors["invalid_mail"];
               header("Location: ../signup.php");
               unset($Errors["invalid_mail"]);
          };
          if(isset($Errors["used_mail"]))
          {
               $_SESSION["used_mail"] =$Errors["used_mail"] ;
               header("Location: ../signup.php");
               unset($Errors["used_mail"]);
          };
       };

       if($Error_case == false)
       {
          Insert_User($pdo,$UserName,$UserEmail,$UserPassword);
          $_SESSION["user_name"] = $UserName;
          $_SESSION["user_mail"] = $UserEmail;

          $User_Id  = Get_User_Id($pdo,$UserName);
          $_SESSION["user_id"]  = (int)$User_Id["Id"];

          header("Location: ../index.php");
       };

    }
    else
    {
        header("Location: ../signup.php");
    };
?>