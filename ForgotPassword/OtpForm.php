<?php

    require_once "../Session/Session.php";

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    <!-- CSS links -->
    <link rel="stylesheet" href="../Ui kits/css/app.css" />
  </head>
  <body>
    <main>
      <div class="reset-section">
        <div class="reset-container">
          <div class="welcomeMsg-container">
            <h2>Reset Password</h2>
          </div>
          <div class="form">
            <svg class="dash__border-container">
              <rect stroke-linecap="round" class="dash__border"></rect>
            </svg>
            <form action="CheckOTP.php" method="POST">
              <div class="form__field">
                <label for="">Verification code</label>
                <div class="form__input-container">
                  <div class="overlay form__shadow"></div>
                  <input
                    type="number"
                    name="OTP"
                    id=""
                    class="form__input"
                    placeholder="Enter verification code.."
                  />
                </div>
                <?php
                    if(isset($_SESSION["Code_Error"] ))
                    {
                ?>
                   <p class="error-message body-font">Wrong verification number</p>
                <?php         
                        unset($_SESSION["Code_Error"]);   
                    };
                ?>
              </div>
              
              <button type="submit" class="btn">
                <div class="overlay btn-shadow"></div>
                <div class="flex-center btn-content btn-primary">
                  <div class="flex-center btn-text">
                    <span>Submit</span>
                    <span class="duplicate">Submit</span>
                  </div>
                </div>
              </button>
            </form>
            <form action="SendingMail.php" method="POST">
              <input type="hidden" name="mail" value="<?php echo $_SESSION['U_mail']; ?>" >
              <button type="submit" class="CTA-btn text-link">
                  <div class="flex-center link-content">
                    <div class="flex-center link-text">
                      <span>Resend code</span>
                      <span class="duplicate">resend code</span>
                    </div>
                  </div>
              </button>
             </form>
          </div>
        </div>
      </div>
    </main>
    <!-- JS links -->
    <script src="../Ui kits/js/_home.js"></script>
    <script src="../Ui kits/js/_account.js"></script>
  </body>
</html>
