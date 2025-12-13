<?php

  require_once "Session/Session.php";
  require_once "GoogleAuthentication/gClient.php";

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up</title>

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
            <h2>create an account</h2>
          </div>
          <div class="form">
            <svg class="dash__border-container">
              <rect stroke-linecap="round" class="dash__border"></rect>
            </svg>
            <form action="LogInSignUpHandler/SignUpData.php" method="POST">
              <div class="form__field">
                <div class="form__input-container">
                  <div class="overlay form__shadow"></div>
                  <input
                    type="text"
                    name="UserName"
                    id=""
                    class="form__input"
                    placeholder="Name"
                  />
                </div>

                <?php 
                  if(isset($_SESSION["used_name"]))
                {  ?>
                  <p class="error-message body-font">Name is already used by a user</p>
                 <?php
                  unset($_SESSION["used_name"]);
                }; ?> 
              </div>
              <div class="form__field">
                <div class="form__input-container">
                  <div class="overlay form__shadow"></div>
                  <input
                    type="email"
                    name="UserEmail"
                    id=""
                    class="form__input"
                    placeholder="E-mail"
                  />
                </div>

                <?php
                 if(isset($_SESSION["invalid_mail"]))
                 {  ?>
                   <p class="error-message body-font">E-mail is invalid</p>
                <?php 
                   unset($_SESSION["invalid_mail"]);
                 }; ?> 
                <?php
                 if(isset($_SESSION["used_mail"]))
                 {  ?>
                   <p class="error-message body-font">E-mail is already used</p>
                <?php 
                   unset($_SESSION["used_mail"]);
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
                    placeholder="Password"
                  />
                </div>
               <!-- <p class="error-message body-font">Error</p> -->
              </div>
              <button type="submit" class="btn">
                <div class="overlay btn-shadow"></div>
                <div class="flex-center btn-content btn-primary">
                  <div class="flex-center btn-text">
                    <span>sign up</span>
                    <span class="duplicate">sign up</span>
                  </div>
                </div>
              </button>
              <div class="signUp-container">
                <p>already have an account?</p>
                <a href="login.php" class="text-link">
                  <div class="flex-center link-content">
                    <div class="flex-center link-text">
                      <span class="theme-100">sign in</span>
                      <span class="duplicate theme-100">sign in</span>
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
                  <span>sign up with google</span>
                  <span class="duplicate">sign up with google</span>
                </div>
              </div>
            </button> -->
          </div>
        </div>
      </section>
    </main>
  </body>
</html>
