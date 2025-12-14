<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $userMail = $_POST["mail"];
    
    require_once "../Session/Session.php";
    require_once "../Database/DatabaseConnect.php";
    require_once "../LogInSignUpHandler/Model.php";
    
    if(empty($userMail))
    {
        header ("Location: EmailForm.php");
    }
    else
    {
        if(empty(Extract_User_Info($pdo,$userMail)))
        {
            $_SESSION["Mail_Error"] = "User with this mail does not exit";
            header ("Location: EmailForm.php");
        }
        else
        {
            $userInfo = Extract_User_Info($pdo,$userMail);
            $_SESSION["U_name"] = $userInfo["Name"];
            $_SESSION["U_mail"] = $userMail;

            $otp = rand(1000, 9999);

            $_SESSION["otp"] = $otp;

            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com'; // Replace with your SMTP server
                $mail->SMTPAuth   = true;
                $mail->Username   = 'thant2004bhone@gmail.com'; // Replace with your email
                $mail->Password   = 'qyvb oijv vacm yiyi'; // Replace with your email password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;
        
                $mail->setFrom("thant2004bhone@gmail.com", 'Blip(Bus Tracking)');
                $mail->addAddress($userMail);
        
                $mail->isHTML(true);
                $mail->Subject = 'Your OTP Code';
                $mail->Body    = 'Your OTP code is: ' . $otp;
                $mail->AltBody = 'Your OTP code is: ' . $otp;
        
                $mail->SMTPDebug = 2;

                $mail->send();
                $_SESSION["email_sent"] = true;
                header("Location: EmailForm.php");
            }
             catch (Exception $e)
            {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        };
    }
}


?>
