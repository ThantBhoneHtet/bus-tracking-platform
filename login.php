<?php

  require_once "Session/Session.php";
  require_once "GoogleAuthentication/gClient.php";

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Log In</title>

    <!-- CSS links -->
    <link rel="stylesheet" href="./Ui kits/css/app.css" />
  </head>
  <body>
    <div class="back-home-btn-container">
      <button onclick="window.location.href='./index.php'" class="btn back-home-btn">
        <div class="overlay btn-shadow"></div>
        <div class="flex-center btn-icon btn-arrow-left btn-secondary">
          <div class="flex-center btn-text">
            <span><svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 448 512"
                class="arrow">
                <path
                  d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
              </svg></span>
            <span class="duplicate"><svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 448 512"
                class="arrow">
                <path
                  d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
              </svg></span>
          </div>
        </div>
      </button>
    </div>

    <main class="hero">
      <section class="login-section">
        <div class="login-container">
          <div class="welcomeMsg-container">
            <h2>welcome back</h2>
          </div>
          <div class="form">
            <svg class="dash__border-container">
              <rect stroke-linecap="round" class="dash__border"></rect>
            </svg>
            <form action="LogInSignUpHandler/LogInData.php" method="POST">
              <div class="form__field">
                <div class="form__input-container">
                  <div class="overlay form__shadow"></div>
                  <input
                    type="email"
                    name="UserEmail"
                    id=""
                    class="form__input"
                    placeholder="Email address*"
                  />
                </div>

                <?php 
                  if(isset($_SESSION["user_not_found"]))
                { ?>
                <p class="error-message body-font">User not found</p>
                <?php
                  unset($_SESSION["user_not_found"]);
                }; ?>

              </div>
              <div class="form__field">
                <div class="form__input-container">
                  <div class="overlay form__shadow"></div>
                  <input
                    type="password"
                    name="UserPassword"
                    id=""
                    class="form__input"
                    placeholder="Password*"
                  />
                </div>

                <?php
                 if(isset($_SESSION["wrong_password"]))
                 {
                ?>
                  <p class="error-message body-font">Password incorrect</p>
                <?php
                  unset($_SESSION["wrong_password"]);
                 };
                ?>
                
              </div>
              <a href="./ForgotPassword/EmailForm.php" class="CTA-btn text-link">
                <div class="flex-center link-content">
                  <div class="flex-center link-text">
                    <span>Forgot password?</span>
                    <span class="duplicate">Forgot password?</span>
                  </div>
                </div>
              </a>
              <button type="submit" class="btn">
                <div class="overlay btn-shadow"></div>
                <div class="flex-center btn-content btn-primary">
                  <div class="flex-center btn-text">
                    <span>sign in</span>
                    <span class="duplicate">sign in</span>
                  </div>
                </div>
              </button>
              <div class="signUp-container">
                <p>Don't have an account?</p>
                <a href="signup.php" class="text-link">
                  <div class="flex-center link-content">
                    <div class="flex-center link-text">
                      <span class="theme-100">sign up</span>
                      <span class="duplicate theme-100">sign up</span>
                    </div>
                  </div>
                </a>
              </div>
            </form>
            <!-- <p class="separate__line-container">
              <span>or</span>
            </p>
            <button type="button" onclick="window.location = '<?php echo $GoogleUrl; ?>' " class="btn">
              <div class="flex-center btn-content">
                <div class="flex-center btn-text">
                  <span>sign in with google</span>
                  <span class="duplicate">sign in with google</span>
                </div>
              </div>
            </button> -->
          </div>
        </div>
      </section>
    </main>

    <!-- JS links -->
    <script src="./Ui kits/js/cursor.js"></script>
  </body>
</html>
