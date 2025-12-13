<?php

    if($_SERVER["REQUEST_METHOD"] === "POST")
    {

        require_once "../Session/Session.php";

        $Entered_OTP = htmlspecialchars($_POST["OTP"]);

        if(empty($Entered_OTP))
        {
            header("Location: OtpForm.php");
        }
        else
        {
            if($_SESSION["otp"] == $Entered_OTP)
            {
                header("Location: PasswordForm.php");
            }
            else
            {
                $_SESSION["Code_Error"] ="Incorrect Code";
                header("Location: OtpForm.php");
            };
        };
    };

?>