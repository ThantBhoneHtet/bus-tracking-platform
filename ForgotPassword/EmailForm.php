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
            <form action="./SendingMail.php" method="POST">
              <div class="form__field">
                <label for="">Email</label>
                <div class="form__input-container">
                  <div class="overlay form__shadow"></div>
                  <input
                    type="email"
                    name="mail"
                    id=""
                    class="form__input"
                    placeholder="Enter Your Email address*"
                  />
                </div>
                <?php   
                    if (isset($_SESSION["Mail_Error"]))
                    {
                ?>     
                   <p class="error-message body-font">User with this mail does not exist</p>
                <?php
                        unset($_SESSION["Mail_Error"]);
                    };
                ?>
              </div>
              <button type="submit" class="btn send-btn">
                <div class="overlay btn-shadow"></div>
                <div class="flex-center btn-content btn-primary">
                  <div class="flex-center btn-text">
                    <span>Send code</span>
                    <span class="duplicate">send code</span>
                  </div>
                </div>
              </button>
            </form>
          </div>
        </div>
      </div>
    </main>

    <!-- confirm message box -->
    <?php 
        if(isset($_SESSION["U_mail"]) && isset($_SESSION["U_name"]))
        {
    ?>
    <div class="overlay resetAcc__data-overlay"></div>
    <div class="resetAcc__data-container">
      <div class="resetAcc__content">
        <p class="email-sent-confirm-msg">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 512 512"
            class="icon check-icon"
          >
            <path
              d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z"
            />
          </svg>
          Verification code is sent to <?php echo $_SESSION["U_mail"]; ?>
        </p>
        <p>Your user name - <span class="theme-100"><?php echo $_SESSION["U_name"]; ?></span></p>
      </div>
      <button onclick="window.location = 'OtpForm.php'"  class="btn">
        <div class="overlay btn-shadow"></div>
        <div class="flex-center btn-content btn-secondary">
          <div class="flex-center btn-text">
            <span>next</span>
            <span class="duplicate">next</span>
          </div>
        </div>
      </button>
    </div>
    <?php 
    };
    ?>

    <!-- JS links -->
    <script src="../Ui kits/js/_home.js"></script>
    <script src="../Ui kits/js/_account.js"></script>
    <script src="../Ui kits/js/_reset.js"></script>
  </body>
</html>

<?php

if ($_SESSION["email_sent"] ) 
{
  echo "<script>
          document.addEventListener('DOMContentLoaded', function() {
            const resetAccDataBox = document.querySelector('.resetAcc__data-container');
            const resetAccDataOverlay = document.querySelector('.resetAcc__data-overlay');
            resetAccDataBox.classList.add('resetAcc__data-box-show');
            resetAccDataOverlay.classList.add('resetAcc__data-overlay-show');
          });
        </script>";

  unset($_SESSION['email_sent']);
}
?>