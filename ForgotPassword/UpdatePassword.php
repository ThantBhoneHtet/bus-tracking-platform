<?php

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $new_password     = $_POST["new_password"];
        $confirm_password = $_POST["confirm_password"];


        require_once "../Session/Session.php";
        require_once "../Database/DatabaseConnect.php";
        require_once "../LogInSignUpHandler/Model.php";


        if(empty($new_password) || empty($confirm_password))
        {
            header("Location: PasswordForm.php");
        }
        else
        {
            if($new_password === $confirm_password)
            {
                $mail = $_SESSION["U_mail"];
                Update_Password($pdo,$mail,$confirm_password);
                header("Location: ../login.php");
            }
            else
            {
                $_SESSION["Password_Error"] = "Two passwords do not same";
                header("Location: PasswordForm.php");
            };

        };

    };
?>