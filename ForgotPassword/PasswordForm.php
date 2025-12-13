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
            <h2>Setting up new Password</h2>
          </div>
          <div class="form">
            <svg class="dash__border-container">
              <rect stroke-linecap="round" class="dash__border"></rect>
            </svg>
            <form action="UpdatePassword.php" method="POST">
              <div class="form__field">
                <label for="">New password</label>
                <div class="form__input-container">
                  <div class="overlay form__shadow"></div>
                  <input
                    type="password"
                    name="new_password"
                    id=""
                    class="form__input"
                    placeholder="Enter new password.."
                  />
                </div>
              
              </div>
              <div class="form__field">
                <label for="">confirm password</label>
                <div class="form__input-container">
                  <div class="overlay form__shadow"></div>
                  <input
                    type="password"
                    name="confirm_password"
                    id=""
                    class="form__input"
                    placeholder="Enter password again.."
                  />
                </div>
                <?php  
                    if(isset($_SESSION["Password_Error"]))
                    {
                ?>
                   <p class="error-message body-font">Passwords do not match</p>
                <?php
                        unset($_SESSION["Password_Error"]);
                    };
                ?>
              </div>
              <button type="submit" class="btn">
                <div class="overlay btn-shadow"></div>
                <div class="flex-center btn-content btn-primary">
                  <div class="flex-center btn-text">
                    <span>confirm</span>
                    <span class="duplicate">confirm</span>
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
