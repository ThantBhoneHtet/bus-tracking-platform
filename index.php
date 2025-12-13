<?php
require_once "./Database/TableQuery.php";
require_once "Session/Session.php";
require_once "LogInSignUpHandler/View.php";

$busLine_info = fetch_busLine_info();
$busStop_info = fetch_busStop_info();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BAP - bus tracking website</title>
  <!-- Mapbox CSS CDN -->
  <link href="https://api.mapbox.com/mapbox-gl-js/v3.5.1/mapbox-gl.css" rel="stylesheet">
  <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" type="text/css">

  <!-- CSS links -->
  <link rel="stylesheet" href="./Ui kits/css/app.css" />



  <style>
    #walking_Popup {
      width: 70px;
      height: 40px;
    }

    .mapboxgl-popup {
      padding: 10px;
      max-width: 300px !important;
      z-index: 1000;
    }


    /* Hide the default buffer circle */
    .mapboxgl-user-location-accuracy-circle {
      display: none !important;
    }

    .mapboxgl-ctrl-geolocate {
      display: none !important;
    }

    .mapboxgl-ctrl-geocoder--icon {
      display: none !important;
    }

    .mapboxgl-popup-close-button {
      display: none;
    }

    .mapboxgl-ctrl-geocoder {
      background-color: #F2EDE9;
    }

    /* Container for the route search */

    #Route,
    #search-btn {
      position: relative;
      margin-top: 25px;
    }

    /* Search box styling */
    .route-search {
      display: flex;
      flex-direction: column;
      gap: 15px;
      overflow: visible;
    }

    #start-point .mapboxgl-ctrl-geocoder,
    #end-point .mapboxgl-ctrl-geocoder {
      border: none;
      box-shadow: none;
      width: 100%;
      height: 40px;
      position: relative;
    }

    .mapboxgl-ctrl-geocoder--powered-by {
      display: none !important;
    }



    #start-point .mapboxgl-ctrl-geocoder .suggestions-wrapper {
      width: 100%;
      position: absolute;
      top: 450%;
      z-index: 14;
    }

    #end-point .mapboxgl-ctrl-geocoder .suggestions-wrapper {
      width: 100%;
      position: absolute;
      top: 300%;
      z-index: 14;
    }





    <?php if (empty($_SESSION["user_id"])) : ?>.save__routes-open-btn,
    .history-open-btn,
    .save-route,
    .feedback-btn,
    .bus-reminder {
      display: none
    }

    <?php endif ?>
  </style>




</head>

<body>
  <button class="btn btn-primary current_location"></button>

  <main class="hero">
    <div id="map" style="width: 100%; height: 100vh; position: absolute"></div>
    <nav class="nav__lists-container">
      <div class="nav__lists-wrapper">
        <div class="user__actions-container">
          <button href="" class="btn nearest-bus__stops-open-btn">
            <div class="flex-center link-content">
              <div class="flex-center link-text">
                <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="icon"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM288 176c0-44.2-35.8-80-80-80s-80 35.8-80 80c0 48.8 46.5 111.6 68.6 138.6c6 7.3 16.8 7.3 22.7 0c22.1-27 68.6-89.8 68.6-138.6zm-112 0a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z" />
                  </svg></span>
                <span class="duplicate"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="icon"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                  <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM288 176c0-44.2-35.8-80-80-80s-80 35.8-80 80c0 48.8 46.5 111.6 68.6 138.6c6 7.3 16.8 7.3 22.7 0c22.1-27 68.6-89.8 68.6-138.6zm-112 0a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z" />
                </svg></span>
              </div>
            </div>
          </button>

          <button href="" class="btn routes-open-btn">
            <div class="flex-center link-content">
              <div class="flex-center link-text">
                <span><svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512"
                    class="icon">
                    <path
                      d="M227.7 11.7c15.6-15.6 40.9-15.6 56.6 0l216 216c15.6 15.6 15.6 40.9 0 56.6l-216 216c-15.6 15.6-40.9 15.6-56.6 0l-216-216c-15.6-15.6-15.6-40.9 0-56.6l216-216zm87.6 137c-4.6-4.6-11.5-5.9-17.4-3.5s-9.9 8.3-9.9 14.8l0 56-64 0c-35.3 0-64 28.7-64 64l0 48c0 13.3 10.7 24 24 24s24-10.7 24-24l0-48c0-8.8 7.2-16 16-16l64 0 0 56c0 6.5 3.9 12.3 9.9 14.8s12.9 1.1 17.4-3.5l80-80c6.2-6.2 6.2-16.4 0-22.6l-80-80z" />
                  </svg></span>
                <span class="duplicate"><svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512"
                    class="icon">
                    <path
                      d="M227.7 11.7c15.6-15.6 40.9-15.6 56.6 0l216 216c15.6 15.6 15.6 40.9 0 56.6l-216 216c-15.6 15.6-40.9 15.6-56.6 0l-216-216c-15.6-15.6-15.6-40.9 0-56.6l216-216zm87.6 137c-4.6-4.6-11.5-5.9-17.4-3.5s-9.9 8.3-9.9 14.8l0 56-64 0c-35.3 0-64 28.7-64 64l0 48c0 13.3 10.7 24 24 24s24-10.7 24-24l0-48c0-8.8 7.2-16 16-16l64 0 0 56c0 6.5 3.9 12.3 9.9 14.8s12.9 1.1 17.4-3.5l80-80c6.2-6.2 6.2-16.4 0-22.6l-80-80z" />
                  </svg></span>
              </div>
            </div>
          </button>
          <button href="" class="btn bus__lines-open-btn">
            <div class="flex-center link-content">
              <div class="flex-center link-text">
                <span><svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 576 512"
                    class="icon">
                    <path
                      d="M288 0C422.4 0 512 35.2 512 80l0 16 0 32c17.7 0 32 14.3 32 32l0 64c0 17.7-14.3 32-32 32l0 160c0 17.7-14.3 32-32 32l0 32c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-32-192 0 0 32c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-32c-17.7 0-32-14.3-32-32l0-160c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32c0 0 0 0 0 0l0-32s0 0 0 0l0-16C64 35.2 153.6 0 288 0zM128 160l0 96c0 17.7 14.3 32 32 32l112 0 0-160-112 0c-17.7 0-32 14.3-32 32zM304 288l112 0c17.7 0 32-14.3 32-32l0-96c0-17.7-14.3-32-32-32l-112 0 0 160zM144 400a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm288 0a32 32 0 1 0 0-64 32 32 0 1 0 0 64zM384 80c0-8.8-7.2-16-16-16L208 64c-8.8 0-16 7.2-16 16s7.2 16 16 16l160 0c8.8 0 16-7.2 16-16z" />
                  </svg></span>
                <span class="duplicate"><svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 576 512"
                    class="icon">
                    <path
                      d="M288 0C422.4 0 512 35.2 512 80l0 16 0 32c17.7 0 32 14.3 32 32l0 64c0 17.7-14.3 32-32 32l0 160c0 17.7-14.3 32-32 32l0 32c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-32-192 0 0 32c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-32c-17.7 0-32-14.3-32-32l0-160c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32c0 0 0 0 0 0l0-32s0 0 0 0l0-16C64 35.2 153.6 0 288 0zM128 160l0 96c0 17.7 14.3 32 32 32l112 0 0-160-112 0c-17.7 0-32 14.3-32 32zM304 288l112 0c17.7 0 32-14.3 32-32l0-96c0-17.7-14.3-32-32-32l-112 0 0 160zM144 400a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm288 0a32 32 0 1 0 0-64 32 32 0 1 0 0 64zM384 80c0-8.8-7.2-16-16-16L208 64c-8.8 0-16 7.2-16 16s7.2 16 16 16l160 0c8.8 0 16-7.2 16-16z" />
                  </svg></span>
              </div>
            </div>
          </button>
          <button href="" class="btn bus__stops-open-btn">
            <div class="flex-center link-content">
              <div class="flex-center link-text">
                <span><svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 384 512"
                    class="icon location-icon">
                    <path
                      d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                  </svg></span>
                <span class="duplicate"><svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 384 512"
                    class="icon location-icon">
                    <path
                      d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                  </svg></span>
              </div>
            </div>
          </button>
        </div>

        <div class="loginUser__actions-container">
          <button href="" class="btn save__routes-open-btn">
            <div class="flex-center link-content">
              <div class="flex-center link-text">
                <span><svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 384 512"
                    class="icon save-icon">
                    <path
                      d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                  </svg></span>
                <span class="duplicate"><svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 384 512"
                    class="icon save-icon">
                    <path
                      d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                  </svg></span>
              </div>
            </div>
          </button>
          <button href="" class="btn history-open-btn">
            <div class="flex-center link-content">
              <div class="flex-center link-text">
                <span><svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512"
                    class="icon">
                    <path
                      d="M75 75L41 41C25.9 25.9 0 36.6 0 57.9L0 168c0 13.3 10.7 24 24 24l110.1 0c21.4 0 32.1-25.9 17-41l-30.8-30.8C155 85.5 203 64 256 64c106 0 192 86 192 192s-86 192-192 192c-40.8 0-78.6-12.7-109.7-34.4c-14.5-10.1-34.4-6.6-44.6 7.9s-6.6 34.4 7.9 44.6C151.2 495 201.7 512 256 512c141.4 0 256-114.6 256-256S397.4 0 256 0C185.3 0 121.3 28.7 75 75zm181 53c-13.3 0-24 10.7-24 24l0 104c0 6.4 2.5 12.5 7 17l72 72c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-65-65 0-94.1c0-13.3-10.7-24-24-24z" />
                  </svg></span>
                <span class="duplicate"><svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512"
                    class="icon">
                    <path
                      d="M75 75L41 41C25.9 25.9 0 36.6 0 57.9L0 168c0 13.3 10.7 24 24 24l110.1 0c21.4 0 32.1-25.9 17-41l-30.8-30.8C155 85.5 203 64 256 64c106 0 192 86 192 192s-86 192-192 192c-40.8 0-78.6-12.7-109.7-34.4c-14.5-10.1-34.4-6.6-44.6 7.9s-6.6 34.4 7.9 44.6C151.2 495 201.7 512 256 512c141.4 0 256-114.6 256-256S397.4 0 256 0C185.3 0 121.3 28.7 75 75zm181 53c-13.3 0-24 10.7-24 24l0 104c0 6.4 2.5 12.5 7 17l72 72c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-65-65 0-94.1c0-13.3-10.7-24-24-24z" />
                  </svg></span>
              </div>
            </div>
          </button>
        </div>
      </div>
 
      <div class="user__login-container">
        <?php
        if (empty($_SESSION["user_id"])) {
        ?>
          <button type="button" onclick="window.location.href='./signup.php'" class="btn">
            <div class="overlay btn-shadow"></div>
            <div class="flex-center btn-icon btn-secondary">
              <div class="flex-center btn-text">
                <span><svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512"
                    class="icon">
                    <path
                      d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z" />
                  </svg></span>
                <span class="duplicate"><svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512"
                    class="icon">
                    <path
                      d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z" />
                  </svg></span>
              </div>
            </div>
          </button>
        <?php
        } else {
        ?>
          <div class="profile user__profile">
            <div class="overlay btn-shadow"></div>
            <img src="<?php echo Print_Profile_Picture() ?>" alt="Profile image" />
          </div>
        <?php
        };
        ?>
      </div>

    </nav>
  </main>

  <!-- profile box -->
  <div class="user__profile-box profile-container">
    <button href="" class="btn user__profile-close-btn">
      <div class="overlay btn-shadow"></div>
      <div class="flex-center btn-icon btn-secondary">
        <div class="flex-center btn-text">
          <span><svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 384 512"
              class="delete-icon">
              <path
                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
            </svg></span>
          <span class="duplicate"><svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 384 512"
              class="delete-icon">
              <path
                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
            </svg></span>
        </div>
      </div>
    </button>
    <div class="profile__content">
      <img
        src="<?php echo Print_Profile_Picture() ?>"
        alt=""
        class="profile__img" />
      <h4> <?php Print_Name(); ?> </h4>
      <p> <?php Print_Mail(); ?> </p>
      <button type="button" onclick="window.location.href='LogOut/LogoutPerform.php'" class="btn">
        <div class="overlay btn-shadow"></div>
        <div class="flex-center btn-content btn-primary">
          <div class="flex-center btn-text">
            <span><svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 512 512"
                class="icon">
                <path
                  d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
              </svg>
              logout</span>
            <span class="duplicate"><svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 512 512"
                class="icon">
                <path
                  d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
              </svg>
              logout</span>
          </div>
        </div>
      </button>
    </div>
  </div>

  <!-- nearest bus stops display box for tracking -->
  <div class="nearest-bus__stops-container popup-container">
    <button href="" class="btn nearest-bus__stops-close-btn">
      <div class="overlay btn-shadow"></div>
      <div class="flex-center btn-icon btn-secondary">
        <div class="flex-center btn-text">
          <span><svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 384 512"
              class="delete-icon">
              <path
                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
            </svg></span>
          <span class="duplicate"><svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 384 512"
              class="delete-icon">
              <path
                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
            </svg></span>
        </div>
      </div>
    </button>
    <div class="bus__stops-wrapper">
      <p>Current Location - <span class="theme-100 current-location"></span></p><br>
      <p class="nearest_busStop-text">nearest Bus stops</p>
      <div class="track-bus__stops-lists">
        <!-- <a href="" class="bus__content nearest-bus__stop">
            <div>
              <button href="" class="btn">
                <div class="overlay btn-shadow"></div>
                <div class="flex-center btn-content btn-icon btn-secondary">
                  <div class="flex-center btn-text">
                    <span
                      ><svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 384 512"
                        class="icon"
                      >
                        <path
                          d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"
                        /></svg
                    ></span>
                    <span class="duplicate"
                      ><svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 384 512"
                        class="icon"
                      >
                        <path
                          d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"
                        /></svg
                    ></span>
                  </div>
                </div>
              </button>
            </div>
            <div class="bus__line-info">
              <p class="name__en"></p>
              <p class="name__mm myanmar-text"></p>
            </div>
          </a> -->
      </div>
      <!-- <p class="info-text body-font">scroll to see more</p> -->
    </div>
  </div>

  <!-- bus line detail display box for tracking -->
  <div class="track-bus__line-container popup-container">
    <button class="btn track-bus__line-close-btn">
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
    <div class="bus__lines-wrapper">
      <p>Details about <span class="theme-100 busStop_name">Bus stop</span></p>
      <div class="bus__lines-lists bus__line-track-lists">
        <!-- <a href="" class="bus__content track-bus__line">
            <div>
              <button class="btn">
                <div class="overlay btn-shadow"></div>
                <div class="flex-center btn-content btn-number btn-secondary">
                  <div class="flex-center btn-text">
                    <span>99</span>
                    <span class="duplicate">99</span>
                  </div>
                </div>
              </button>
            </div>
            <div class="bus__line-info">
              <p class="from">
                from <span class="myanmar-text">လှည်းကူးဈေးရှေ့</span>
              </p>
              <p class="to">to <span class="myanmar-text">စံပြဈေး</span></p>
            </div>
          </a> -->
      </div>
      <p class="info-text body-font">scroll to see more</p>
    </div>
  </div>

  <!-- bus line detail display box for tracking -->
  <div class="track-bus__line-info-container popup-container">
    <button class="btn track-bus__line-info-close-btn">
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
    <div class="bus__lines-wrapper">
      <p>Now you're tracing bus line <span class="theme-100" id="bustrack-No">no</span></p>
      <p>bus stop you choosed - <span class="theme-100" id="bustrack-busStop">bus stop</span></p>
      <div class="bus__lines-lists chosen_bustracking-lists">
        <!-- <a href="" class="bus__content track-bus__line-info">
            <div>
              <button class="btn">
                <div class="overlay btn-shadow"></div>
                <div class="flex-center btn-content btn-number btn-secondary">
                  <div class="flex-center btn-text">
                    <span>35</span>
                    <span class="duplicate">35</span>
                  </div>
                </div>
              </button>
            </div>
            <div class="route-info">
              <p class="estimated-time">
                <span class="theme-100" id="estimate-time"></span> mins
              </p>
            </div>
          </a> -->
        <div class="no__content-box">
          <p class="no__route-text">There is no incoming bus.</p>
        </div>
      </div>
      <!-- <p class="info-text body-font">scroll to see more</p> -->
      <div class="bus-reminder">
        <p>Do you want to set reminder?</p>
        <form action="#">
          <div class="form__field">
            <div class="form__input-container">
              <div class="overlay form__shadow"></div>
              <input
                type="search"
                placeholder="Set reminder..."
                class="search__input reminder-input"
                required />
            </div>
          </div>
          <button href="" class="btn set-btn">
            <div class="overlay btn-shadow"></div>
            <div class="flex-center btn-content btn-primary">
              <div class="flex-center btn-text">
                <span>set</span>
                <span class="duplicate">set</span>
              </div>
            </div>
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- tracking reminder notification box -->
  <div class="overlay reminder-noti-overlay"></div>
  <div class="reminder-noti-container">
    <button href="" class="btn reminder-noti-close-btn">
      <div class="overlay btn-shadow"></div>
      <div class="flex-center btn-icon btn-secondary">
        <div class="flex-center btn-text">
          <span><svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 384 512"
              class="delete-icon">
              <path
                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
            </svg></span>
          <span class="duplicate"><svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 384 512"
              class="delete-icon">
              <path
                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
            </svg></span>
        </div>
      </div>
    </button>
    <br>
    <p class="text-timeup">Time's up! The bus is on the way.</p>
  </div>



  <!-- routes display box -->
  <div class="routes-container popup-container">
    <button href="" class="btn routes-close-btn">
      <div class="overlay btn-shadow"></div>
      <div class="flex-center btn-icon btn-secondary">
        <div class="flex-center btn-text">
          <span><svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 384 512"
              class="delete-icon">
              <path
                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
            </svg></span>
          <span class="duplicate"><svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 384 512"
              class="delete-icon">
              <path
                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
            </svg></span>
        </div>
      </div>
    </button>
    <div id="Route">
      <div class="route-search">
        <div id="start-point" class="geocoder"></div>
        <div id="end-point" class="geocoder"></div>
      </div>
      <button href="" class="btn" id="search-btn">
        <div class="overlay btn-shadow"></div>
        <div class="flex-center btn-content btn-primary">
          <div class="flex-center btn-text">
            <span>Search</span>
            <span class="duplicate">Search</span>
          </div>
        </div>
    </div>
    <div class="routes-wrapper choose_busLine_to_route">
      <p class="chooseText">Choose one bus line to make route</p>
      <p class="not-available"><span>No Available</span> <span class="theme-100">Buslines</span></p>
      <div class="routes-lists">
        <!-- <a href="" class="bus__content route">
            <div>
              <button class="btn">
                <div class="overlay btn-shadow"></div>
                <div class="flex-center btn-content btn-number btn-secondary">
                  <div class="flex-center btn-text">
                    <span>99</span>
                    <span class="duplicate">99</span>
                  </div>
                </div>
              </button>
            </div>
            <div class="bus__line-info">
              <p class="from">
                from <span class="myanmar-text">လှည်းကူးဈေးရှေ့</span>
              </p>
              <p class="to">to <span class="myanmar-text">စံပြဈေး</span></p>
            </div>
          </a> -->
      </div>
      <!-- <p class="info-text body-font">scroll to see more</p> -->
    </div>
  </div>


  </div>

  <!-- chosen bus lines and its route -->
  <div class="chosen_busline-container popup-container">
    <button class="btn track-bus__line_route-info-close-btn">
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
    <div class="routes-wrapper">
      <p>Busline <span class="theme-100 chosen_busline">No</span></p>
      <div class="chosen_busline-routes-lists">
        <!-- <a href="" class="bus__content busStop">
            <div>
              <button class="btn">
                <div class="overlay btn-shadow"></div>
                <div class="flex-center btn-content btn-number btn-secondary">
                  <div class="flex-center btn-text">
                    <span>99</span>
                    <span class="duplicate">99</span>
                  </div>
                </div>
              </button>
            </div>
            <div class="bus__line-info">
              <p class="from">
                from <span class="myanmar-text">လှည်းကူးဈေးရှေ့</span>
              </p>
              <p class="to">to <span class="myanmar-text">စံပြဈေး</span></p>
            </div>
          </a> -->
      </div>
      <div class="btn-container">
        <button class="btn save-route">
          <p id="to_save-route" hidden></p>
          <div class="overlay btn-shadow"></div>
          <div class="flex-center btn-content btn-primary">
            <div class="flex-center btn-text">
              <span> save </span>
              <span class="duplicate"> save </span>
            </div>
          </div>
        </button>
        <button class="btn feedback-btn">
          <div class="overlay btn-shadow"></div>
          <div class="flex-center btn-content btn-secondary">
            <div class="flex-center btn-text">
              <span>feedback</span>
              <span class="duplicate">feedback</span>
            </div>
          </div>
        </button>
      </div>
      <p class="info-text body-font">scroll to see more</p>
    </div>
  </div>


  <!-- bus lines display box -->
  <div class="bus__lines-container popup-container">
    <button href="" class="btn bus__lines-close-btn">
      <div class="overlay btn-shadow"></div>
      <div class="flex-center btn-icon btn-secondary">
        <div class="flex-center btn-text">
          <span><svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 384 512"
              class="delete-icon">
              <path
                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
            </svg></span>
          <span class="duplicate"><svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 384 512"
              class="delete-icon">
              <path
                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
            </svg></span>
        </div>
      </div>
    </button>
    <div class="bus__lines-wrapper">
      <form action="#">
        <div class="form__field">
          <div class="form__input-container">
            <div class="overlay form__shadow"></div>
            <input
              type="search"
              placeholder="Search bus line..."
              class="search__input  busLine_search" />
          </div>
        </div>
      </form>
      <div class="bus__lines-lists">
        <?php foreach ($busLine_info as $data) : ?>
          <a href="#" class="bus__content bus__line" busLine-row="<?= $data['id'] ?>">
            <div>
              <button class="btn">
                <div class="overlay btn-shadow"></div>
                <div class="flex-center btn-content btn-number btn-secondary">
                  <div class="flex-center btn-text">
                    <span class="bus_number"><?= $data['id'] ?></span>
                    <span class="duplicate"><?= $data['id'] ?></span>
                  </div>
                </div>
              </button>
            </div>
            <div class="bus__line-info">
              <p class="from">
                from <span class="myanmar-text"><?= $data['start'] ?></span>
              </p>
              <p class="to">to <span class="myanmar-text"><?= $data['end'] ?></span></p>
            </div>
          </a>
        <?php endforeach ?>
      </div>
      <p class="info-text scroll-busLine">scroll to see more</p>
    </div>
  </div>

  <!-- bus line detail display box -->
  <div class="bus__line-detail-container popup-container">
    <button class="btn bus__line-detail-close-btn">
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
    <div class="bus__stops-wrapper">
      <p>Details about Bus <span class="theme-100 busNo">No</span></p>
      <div class="bus__stops-lists">
        <!-- <a href="" class="bus__content bus__stop">
          <div>
            <button href="" class="btn">
              <div class="overlay btn-shadow"></div>
              <div class="flex-center btn-content btn-icon btn-secondary">
                <div class="flex-center btn-text">
                  <span><svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 384 512"
                      class="icon">
                      <path
                        d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                    </svg></span>
                  <span class="duplicate"><svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 384 512"
                      class="icon">
                      <path
                        d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                    </svg></span>
                </div>
              </div>
            </button>
          </div>
          <div class="bus__line-info">
            <p class="name__en">A.d</p>
            <p class="name__mm myanmar-text">အေဒီ</p>
          </div>
        </a> -->
      </div>
      <p class="info-text">scroll to see more</p>
    </div>
  </div>

  <!-- bus stops display box -->
  <div class="bus__stops-container popup-container">
    <button href="" class="btn bus__stops-close-btn">
      <div class="overlay btn-shadow"></div>
      <div class="flex-center btn-icon btn-secondary">
        <div class="flex-center btn-text">
          <span><svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 384 512"
              class="delete-icon">
              <path
                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
            </svg></span>
          <span class="duplicate"><svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 384 512"
              class="delete-icon">
              <path
                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
            </svg></span>
        </div>
      </div>
    </button>
    <div class="bus__stops-wrapper">
      <form action="#">
        <div class="form__field">
          <div class="form__input-container">
            <div class="overlay form__shadow"></div>
            <input
              type="search"
              placeholder="Search bus Stop..."
              class="search__input busStop_search" />
          </div>
        </div>
      </form>
      <div class="bus__stops-lists">
        <?php foreach ($busStop_info as $data) : ?>
          <a href="#" class="bus__content bus__stop" busStop-name="<?= $data['name_en'] ?>" busStop-row="<?= $data['id'] ?>" busStop-lng="<?= $data['longitude'] ?>" busStop-lat="<?= $data['latitude'] ?>">
            <div>
              <button href="" class="btn">
                <div class="overlay btn-shadow"></div>
                <div class="flex-center btn-content btn-icon btn-secondary">
                  <div class="flex-center btn-text">
                    <span><svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 384 512"
                        class="icon">
                        <path
                          d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                      </svg></span>
                    <span class="duplicate"><svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 384 512"
                        class="icon">
                        <path
                          d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                      </svg></span>
                  </div>
                </div>
              </button>
            </div>
            <div class="bus__line-info">
              <p class="name__en"><?= $data['name_en'] ?></p>
              <p class="name__mm myanmar-text"><?= $data['name_mm'] ?></p>
            </div>
          </a>
        <?php endforeach ?>
      </div>
      <p class="info-text scroll-busStop">scroll to see more</p>
    </div>
  </div>

  <!-- bus stop detail display box -->
  <div class="bus__stop-detail-container popup-container">
    <button class="btn bus__stop-detail-close-btn">
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
    <div class="bus__stops-wrapper">
      <p>Details about <span class="theme-100 busStop_name_detail">Bus stop</span></p>
      <div class="bus__lines-lists" id="bus__lines-lists">
        <!-- <a href="" class="bus__content bus__line">
            <div>
              <button class="btn">
                <div class="overlay btn-shadow"></div>
                <div class="flex-center btn-content btn-number btn-secondary">
                  <div class="flex-center btn-text">
                    <span>99</span>
                    <span class="duplicate">99</span>
                  </div>
                </div>
              </button>
            </div>
            <div class="bus__line-info">
              <p class="from">
                from <span class="myanmar-text">လှည်းကူးဈေးရှေ့</span>
              </p>
              <p class="to">to <span class="myanmar-text">စံပြဈေး</span></p>
            </div>
          </a> -->
      </div>
      <p class="info-text">scroll to see more</p>
    </div>
  </div>

  <!-- history display box -->
  <div class="history-container popup-container">
    <button href="#" class="btn history-close-btn">
      <div class="overlay btn-shadow"></div>
      <div class="flex-center btn-icon btn-secondary">
        <div class="flex-center btn-text">
          <span><svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 384 512"
              class="delete-icon">
              <path
                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
            </svg></span>
          <span class="duplicate"><svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 384 512"
              class="delete-icon">
              <path
                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
            </svg></span>
        </div>
      </div>
    </button>
    <div class="history-wrapper">
      <p>Recent History</p>
      <div class="history-lists">
        <?php if (isset($_SESSION['routes'])) : ?>
          <?php foreach ($_SESSION['routes'] as $route) : ?>
            <a href="#" class="bus__content history">
              <div>
                <button href="" class="btn">
                  <p class="saved_route" hidden><?= $route['route'] ?></p>
                  <div class="overlay btn-shadow"></div>
                  <div class="flex-center btn-content btn-icon btn-secondary">
                    <div class="flex-center btn-text">
                      <span><svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 512 512"
                          class="icon">
                          <path
                            d="M227.7 11.7c15.6-15.6 40.9-15.6 56.6 0l216 216c15.6 15.6 15.6 40.9 0 56.6l-216 216c-15.6 15.6-40.9 15.6-56.6 0l-216-216c-15.6-15.6-15.6-40.9 0-56.6l216-216zm87.6 137c-4.6-4.6-11.5-5.9-17.4-3.5s-9.9 8.3-9.9 14.8l0 56-64 0c-35.3 0-64 28.7-64 64l0 48c0 13.3 10.7 24 24 24s24-10.7 24-24l0-48c0-8.8 7.2-16 16-16l64 0 0 56c0 6.5 3.9 12.3 9.9 14.8s12.9 1.1 17.4-3.5l80-80c6.2-6.2 6.2-16.4 0-22.6l-80-80z" />
                        </svg></span>
                      <span class="duplicate"><svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 512 512"
                          class="icon">
                          <path
                            d="M227.7 11.7c15.6-15.6 40.9-15.6 56.6 0l216 216c15.6 15.6 15.6 40.9 0 56.6l-216 216c-15.6 15.6-40.9 15.6-56.6 0l-216-216c-15.6-15.6-15.6-40.9 0-56.6l216-216zm87.6 137c-4.6-4.6-11.5-5.9-17.4-3.5s-9.9 8.3-9.9 14.8l0 56-64 0c-35.3 0-64 28.7-64 64l0 48c0 13.3 10.7 24 24 24s24-10.7 24-24l0-48c0-8.8 7.2-16 16-16l64 0 0 56c0 6.5 3.9 12.3 9.9 14.8s12.9 1.1 17.4-3.5l80-80c6.2-6.2 6.2-16.4 0-22.6l-80-80z" />
                        </svg></span>
                    </div>
                  </div>
                </button>
              </div>
              <div class="bus__line-info">
                <p class="from">
                  from <span class="myanmar-text body-font"><?= $route['from'] ?></span>
                </p>
                <p class="to">to <span class="myanmar-text body-font"><?= $route['to'] ?></span></p>
              </div>
            </a>
          <?php endforeach ?>
        <?php endif ?>
      </div>
      <p class="info-text scroll-history">scroll to see more</p>
    </div>
  </div>

  <!-- save route option box -->
  <div class="overlay saveRoute__opt-overlay"></div>
  <div class="saveRoute__opt-container">
    <button href="" class="btn saveRoute__opt-close-btn">
      <div class="overlay btn-shadow"></div>
      <div class="flex-center btn-icon btn-secondary">
        <div class="flex-center btn-text">
          <span><svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 384 512"
              class="delete-icon">
              <path
                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
            </svg></span>
          <span class="duplicate"><svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 384 512"
              class="delete-icon">
              <path
                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
            </svg></span>
        </div>
      </div>
    </button>
    <p>save this route as</p>
    <div class="delete__actions-container">
      <button class="btn home_saved">
        <p class="route_saved_home" hidden></p>
        <div class="overlay btn-shadow"></div>
        <div class="flex-center btn-opt btn-secondary">
          <div class="flex-center btn-text">
            <span>home</span>
          </div>
        </div>
      </button>
      <button class="btn work_saved">
        <p class="route_saved_work" hidden></p>
        <div class="overlay btn-shadow"></div>
        <div class="flex-center btn-opt btn-secondary">
          <div class="flex-center btn-text">
            <span>work</span>
          </div>
        </div>
      </button>
      <button class="btn school_saved">
        <p class="route_saved_school" hidden></p>
        <div class="overlay btn-shadow"></div>
        <div class="flex-center btn-opt btn-secondary">
          <div class="flex-center btn-text">
            <span>school</span>
          </div>
        </div>
      </button>
    </div>
  </div>

  <!-- save route display box -->
  <div class="save__routes-container popup-container">
    <button href="" class="btn save__routes-close-btn">
      <div class="overlay btn-shadow"></div>
      <div class="flex-center btn-icon btn-secondary">
        <div class="flex-center btn-text">
          <span><svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 384 512"
              class="delete-icon">
              <path
                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
            </svg></span>
          <span class="duplicate"><svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 384 512"
              class="delete-icon">
              <path
                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
            </svg></span>
        </div>
      </div>
    </button>
    <div class="save__routes-wrapper">
      <a href="" class="save home_directory">
        <svg class="dash__border-container">
          <rect stroke-linecap="round" class="dash__border"></rect>
        </svg>
        <button href="" class="btn">
          <div class="flex-center link-content">
            <div class="flex-center link-text">
              <span><svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 576 512"
                  class="save-icon">
                  <path
                    d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" />
                </svg></span>
              <span class="duplicate"><svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 576 512"
                  class="save-icon">
                  <path
                    d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" />
                </svg></span>
            </div>
          </div>
        </button>
      </a>
      <a href="" class="save work_directory">
        <svg class="dash__border-container">
          <rect stroke-linecap="round" class="dash__border"></rect>
        </svg>
        <button href="" class="btn">
          <div class="flex-center link-content">
            <div class="flex-center link-text">
              <span><svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="save-icon">
                  <path
                    d="M184 48l144 0c4.4 0 8 3.6 8 8l0 40L176 96l0-40c0-4.4 3.6-8 8-8zm-56 8l0 40L64 96C28.7 96 0 124.7 0 160l0 96 192 0 128 0 192 0 0-96c0-35.3-28.7-64-64-64l-64 0 0-40c0-30.9-25.1-56-56-56L184 0c-30.9 0-56 25.1-56 56zM512 288l-192 0 0 32c0 17.7-14.3 32-32 32l-64 0c-17.7 0-32-14.3-32-32l0-32L0 288 0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-128z" />
                </svg></span>
              <span class="duplicate"><svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="save-icon">
                  <path
                    d="M184 48l144 0c4.4 0 8 3.6 8 8l0 40L176 96l0-40c0-4.4 3.6-8 8-8zm-56 8l0 40L64 96C28.7 96 0 124.7 0 160l0 96 192 0 128 0 192 0 0-96c0-35.3-28.7-64-64-64l-64 0 0-40c0-30.9-25.1-56-56-56L184 0c-30.9 0-56 25.1-56 56zM512 288l-192 0 0 32c0 17.7-14.3 32-32 32l-64 0c-17.7 0-32-14.3-32-32l0-32L0 288 0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-128z" />
                </svg></span>
            </div>
          </div>
        </button>
      </a>
      <a href="" class="save school_directory">
        <svg class="dash__border-container">
          <rect stroke-linecap="round" class="dash__border"></rect>
        </svg>
        <button href="" class="btn">
          <div class="flex-center link-content">
            <div class="flex-center link-text">
              <span><svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 640 512"
                  class="save-icon">
                  <path
                    d="M337.8 5.4C327-1.8 313-1.8 302.2 5.4L166.3 96 48 96C21.5 96 0 117.5 0 144L0 464c0 26.5 21.5 48 48 48l208 0 0-96c0-35.3 28.7-64 64-64s64 28.7 64 64l0 96 208 0c26.5 0 48-21.5 48-48l0-320c0-26.5-21.5-48-48-48L473.7 96 337.8 5.4zM96 192l32 0c8.8 0 16 7.2 16 16l0 64c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-64c0-8.8 7.2-16 16-16zm400 16c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16l0 64c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-64zM96 320l32 0c8.8 0 16 7.2 16 16l0 64c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-64c0-8.8 7.2-16 16-16zm400 16c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16l0 64c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-64zM232 176a88 88 0 1 1 176 0 88 88 0 1 1 -176 0zm88-48c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-16 0 0-16c0-8.8-7.2-16-16-16z" />
                </svg></span>
              <span class="duplicate"><svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 640 512"
                  class="save-icon">
                  <path
                    d="M337.8 5.4C327-1.8 313-1.8 302.2 5.4L166.3 96 48 96C21.5 96 0 117.5 0 144L0 464c0 26.5 21.5 48 48 48l208 0 0-96c0-35.3 28.7-64 64-64s64 28.7 64 64l0 96 208 0c26.5 0 48-21.5 48-48l0-320c0-26.5-21.5-48-48-48L473.7 96 337.8 5.4zM96 192l32 0c8.8 0 16 7.2 16 16l0 64c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-64c0-8.8 7.2-16 16-16zm400 16c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16l0 64c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-64zM96 320l32 0c8.8 0 16 7.2 16 16l0 64c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-64c0-8.8 7.2-16 16-16zm400 16c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16l0 64c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-64zM232 176a88 88 0 1 1 176 0 88 88 0 1 1 -176 0zm88-48c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-16 0 0-16c0-8.8-7.2-16-16-16z" />
                </svg></span>
            </div>
          </div>
        </button>
      </a>
      <a href="#" class="new__save">
        <svg class="dash__border-container">
          <rect stroke-linecap="round" class="dash__border"></rect>
        </svg>
        <button href="" class="btn">
          <div class="flex-center link-content">
            <div class="flex-center link-text">
              <span><svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 448 512"
                  class="save-icon">
                  <path
                    d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                </svg></span>
              <span class="duplicate"><svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 448 512"
                  class="save-icon">
                  <path
                    d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                </svg></span>
            </div>
          </div>
        </button>
      </a>
    </div>
  </div>











  <!-- save routes detail box -->
  <div class="save__route-detail-container popup-container home-directory-detail-container">
    <button class="btn save__routes-detail-close-btn">
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
    <div class="save__routes-content">
      <h4 class="dir-title">Home</h4>
      <p class="body-font"><span class="theme-100 save_routes-no">No</span> <span class="save_routes-count">routes</span></p>
    </div>
    <div class="save__routes-lists">
      <!-- <a href="" class="bus__content save__route">
          <div>
            <button href="" class="btn">
              <div class="overlay btn-shadow"></div>
              <div class="flex-center btn-content btn-icon btn-secondary">
                <div class="flex-center btn-text">
                  <span
                    ><svgw
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 512 512"
                      class="icon"
                    >
                      <path
                        d="M227.7 11.7c15.6-15.6 40.9-15.6 56.6 0l216 216c15.6 15.6 15.6 40.9 0 56.6l-216 216c-15.6 15.6-40.9 15.6-56.6 0l-216-216c-15.6-15.6-15.6-40.9 0-56.6l216-216zm87.6 137c-4.6-4.6-11.5-5.9-17.4-3.5s-9.9 8.3-9.9 14.8l0 56-64 0c-35.3 0-64 28.7-64 64l0 48c0 13.3 10.7 24 24 24s24-10.7 24-24l0-48c0-8.8 7.2-16 16-16l64 0 0 56c0 6.5 3.9 12.3 9.9 14.8s12.9 1.1 17.4-3.5l80-80c6.2-6.2 6.2-16.4 0-22.6l-80-80z"
                      /></svgw
                  ></span>
                  <span class="duplicate"
                    ><svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 512 512"
                      class="icon"
                    >
                      <path
                        d="M227.7 11.7c15.6-15.6 40.9-15.6 56.6 0l216 216c15.6 15.6 15.6 40.9 0 56.6l-216 216c-15.6 15.6-40.9 15.6-56.6 0l-216-216c-15.6-15.6-15.6-40.9 0-56.6l216-216zm87.6 137c-4.6-4.6-11.5-5.9-17.4-3.5s-9.9 8.3-9.9 14.8l0 56-64 0c-35.3 0-64 28.7-64 64l0 48c0 13.3 10.7 24 24 24s24-10.7 24-24l0-48c0-8.8 7.2-16 16-16l64 0 0 56c0 6.5 3.9 12.3 9.9 14.8s12.9 1.1 17.4-3.5l80-80c6.2-6.2 6.2-16.4 0-22.6l-80-80z"
                      /></svg
                  ></span>
                </div>
              </div>
            </button>
          </div>
          <div class="bus__line-info">
            <p class="from">
              from <span class="myanmar-text">လှည်းကူးဈေးရှေ့</span>
            </p>
            <p class="to">to <span class="myanmar-text">စံပြဈေး</span></p>
          </div>
        </a> -->
    </div>
    <div class="no__content-box">
      <p class="no__route-text">The list is empty</p>
      <button href="" class="btn">
        <div class="overlay btn-shadow"></div>
        <div class="flex-center btn-content btn-primary">
          <div class="flex-center btn-text">
            <span>add route</span>
            <span class="duplicate">add route</span>
          </div>
        </div>
      </button>
    </div>
    <p class="info-text body-font">Scroll to see more</p>
  </div>

  <!-- bus line hover container for tracking -->
  <div class="track-bus__line-hover-container">
    <marquee direction="left">click to track this bus</marquee>
  </div>

  <!-- nearest bus stop hover container -->
  <div class="routes-hover-container">
    <marquee direction="left">click to make route</marquee>
  </div>

  <!-- bus line hover container -->
  <div class="bus__line-hover-container">
    <marquee direction="left">click to see bus line details</marquee>
  </div>

  <!-- bus stop hover container -->
  <div class="bus__stop-hover-container">
    <marquee direction="left" class="track-text">click to see bus stop details</marquee>
  </div>

  <!-- history hover container -->
  <div class="history-hover-container">
    <marquee direction="left">click to save</marquee>
  </div>

  <!-- history hover container -->
  <div class="save__route-hover-container">
    <marquee direction="left" class="route-text">click to make route again</marquee>
  </div>

  <!-- feedback box -->
  <div class="overlay feedback-overlay"></div>
  <div class="feedback-container">
    <svg class="dash__border-container">
      <rect stroke-linecap="round" class="dash__border"></rect>
    </svg>
    <button href="" class="btn feedback-close-btn">
      <div class="overlay btn-shadow"></div>
      <div class="flex-center btn-icon btn-secondary">
        <div class="flex-center btn-text">
          <span><svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 384 512"
              class="delete-icon">
              <path
                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
            </svg></span>
          <span class="duplicate"><svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 384 512"
              class="delete-icon">
              <path
                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
            </svg></span>
        </div>
      </div>
    </button>
    <p>Your feedback</p>
    <div class="form">
      <form action="#">
        <div class="form__field">
          <label for="">Message</label>
          <div class="textarea-container">
            <div class="overlay form__shadow"></div>
            <textarea
              class="form__input"
              name="feedback"
              id="feedbackText"
              placeholder="Drop your feelings..."></textarea>
          </div>
        </div>
        <button type="button" class="feedback-submit-btn btn">
          <div class="overlay btn-shadow"></div>
          <div class="flex-center btn-content btn-primary">
            <div class="flex-center btn-text">
              <span>submit</span>
              <span class="duplicate">submit</span>
            </div>
          </div>
        </button>
      </form>
    </div>
  </div>

  <!-- JS links -->
  <script src="./Ui kits/js/_home.js"></script>
  <script src="./Ui kits/js/_account.js"></script>

  <!-- Mapbox js CDN -->
  <script src='https://unpkg.com/@turf/turf/turf.min.js'></script>
  <script src="https://api.mapbox.com/mapbox-gl-js/v3.5.1/mapbox-gl.js"></script>
  <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
  <script src="./Ui kits/js/_mapbox.js"></script>

</body>

</html>