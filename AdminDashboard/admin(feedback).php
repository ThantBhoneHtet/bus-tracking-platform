<?php
require_once "../Database/TableQuery.php";
require_once "../Session/Session.php";
require_once "../LogInSignUpHandler/View.php";

$feedback_info = fetch_feedback_info();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
      .busStop-section{
        display: none;
      }
    </style>
    <!-- CSS links -->
    <link rel="stylesheet" href="../Ui kits/css/app.css" />
  </head>
  <body>
    <main>
    <nav class="nav_lists-container">
        <div class="nav_lists-wrapper">
          <ul class="nav_lists">
            <li>
              <button onclick="window.location.href='./admin(busLine).php'" class="btn" id="busLine_btn">
                <div class="flex-center link-content">
                  <div class="flex-center link-text">
                    <span>bus line</span>
                    <span class="duplicate">bus line</span>
                  </div>
                </div>
              </button>
            </li>
            <li>
              <button onclick="window.location.href='./admin(busStop).php'" class="btn" id="busStop_btn">
                <div class="flex-center link-content">
                  <div class="flex-center link-text">
                    <span>bus stop</span>
                    <span class="duplicate">bus stop</span>
                  </div>
                </div>
              </button>
            </li>
            <li>
              <button onclick="window.location.href='admin(feedback).php'" class="btn">
                <div class="flex-center link-content">
                  <div class="flex-center link-text">
                    <span>feedback</span>
                    <span class="duplicate">feedback</span>
                  </div>
                </div>
              </button>
            </li>
          </ul>
          <div id="pagination-t3">
          <div class="pagination-container container-t3">
            <div>
              <button class="btn" id="previous-page-t3">
                <div class="overlay btn-shadow"></div>
                <div class="flex-center btn-icon btn-arrow-left btn-secondary">
                  <div class="flex-center btn-text">
                    <span
                      ><svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512"
                        class="arrow"
                      >
                        <path
                          d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"
                        /></svg
                    ></span>
                    <span class="duplicate"
                      ><svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512"
                        class="arrow"
                      >
                        <path
                          d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"
                        /></svg
                    ></span>
                  </div>
                </div>
              </button>
            </div>
            <div class="pagination_pages-container pages-container-t3">
              <!-- <button class="btn page-link">
                <div class="overlay btn-shadow"></div>
                <div class="flex-center btn-content btn-number btn-secondary">
                  <div class="flex-center btn-text">
                    <span class="page-num b">1</span>
                    <span class="duplicate duplicate_page-num">1</span>
                  </div>
                </div>
              </button> -->
            </div>
            <div>
              <button class="btn" id="next-page-t3">
                <div class="overlay btn-shadow"></div>
                <div class="flex-center btn-icon btn-arrow-right btn-secondary">
                  <div class="flex-center btn-text">
                    <span
                      ><svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512"
                        class="arrow"
                      >
                        <path
                          d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"
                        /></svg
                    ></span>
                    <span class="duplicate"
                      ><svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512"
                        class="arrow"
                      >
                        <path
                          d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"
                        /></svg
                    ></span>
                  </div>
                </div>
              </button>
            </div>
          </div>
        </div>
        </section>
        <div class="overlay"></div>
          <div class="delete__confirm-container delete-container-t3">
            <p>Do you want to delete bus stop name?</p>
            <div class="delete__actions-container">
              <button href="" class="btn confirm-btn-t3">
                <div class="overlay btn-shadow"></div>
                <div class="flex-center btn-content btn-primary">
                  <div class="flex-center btn-text">
                    <span>confirm</span>
                    <span class="duplicate">confirm</span>
                  </div>
                </div>
              </button>
              <button href="" class="btn cancel-btn-t3">
                <div class="flex-center btn-content">
                  <div class="flex-center btn-text">
                    <span>cancel</span>
                    <span class="duplicate">cancel</span>
                  </div>
                </div>
              </button>
            </div>
          </div>
          <div class="profile admin__profile">
            <div class="overlay btn-shadow"></div>
            <img src="../<?php echo Print_Profile_Picture() ?>" alt="Profile image" />
          </div>
        </div>
      </nav>

      <!----------------------------- Feedback Section -------------------------------->

      <section class="data-container feedback-section">
        <section class="data-wrapper">
          <table id="busStop_table">
          <tr >
            <th>user_id</th>
            <th>description</th>
            <th>date</th>
            <th>actions</th>
     
          <?php foreach ($feedback_info as $data) : ?>
              <tr data-row="<?= $data['description'] ?>" data-id="<?= $data['id'] ?>" id="row-t3">
                <td data-cell="user_id"><?= $data['user_id'] ?></td>
                <td data-cell="description"><?= $data['description'] ?></td>
                <td data-cell="date"><?= $data['date'] ?></td>
                <td>
                  <!-- <form action="./edit(busStop).php" method="post">
                    <input type="hidden" value="<?= $data['id'] ?>" name="id">
                    <input type="hidden" value="<?= $data['name_en'] ?>" name="name_en">
                    <input type="hidden" value="<?= $data['road_en'] ?>" name="road_en">
                    <input type="hidden" value="<?= $data['township_en'] ?>" name="township_en">
                    <input type="hidden" value="<?= $data['latitude'] ?>" name="latitude">
                    <input type="hidden" value="<?= $data['longitude'] ?>" name="longitude">
                  <button class="btn edit-btn">
                    <div class="overlay btn-shadow"></div>
                    <div class="flex-center btn-content btn-secondary">
                      <div class="flex-center btn-text">
                        <span><svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512"
                            class="icon">
                            <path
                              d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z" />
                          </svg>
                          Edit</span>
                        <span class="duplicate"><svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512"
                            class="icon">
                            <path
                              d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z" />
                          </svg>
                          Edit</span>
                      </div>
                    </div>
                  </button>
                  </form> -->
                  <button href="" class="btn delete-btn-t3">
                    <div class="flex-center btn-content">
                      <div class="flex-center btn-text">
                        <span><svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512"
                            class="icon">
                            <path
                              d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
                          </svg>
                          Delete</span>
                        <span class="duplicate"><svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512"
                            class="icon">
                            <path
                              d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
                          </svg>
                          Delete</span>
                      </div>
                    </div>
                  </button>
                </td>
              </tr>             
          <?php endforeach ?>
        </table>

        
      </section>
    </main>
<!-- profile box -->
<div class="admin__profile-box profile-container">
      <button href="" class="btn admin__profile-close-btn">
        <div class="overlay btn-shadow"></div>
        <div class="flex-center btn-icon btn-secondary">
          <div class="flex-center btn-text">
            <span
              ><svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 384 512"
                class="delete-icon"
              >
                <path
                  d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"
                /></svg
            ></span>
            <span class="duplicate"
              ><svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 384 512"
                class="delete-icon"
              >
                <path
                  d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"
                /></svg
            ></span>
          </div>
        </div>
      </button>
      <div class="profile__content">
        <img
          src="../<?php echo Print_Profile_Picture() ?>"
          alt=""
          class="profile__img"
        />
        <h4> <?php Print_Name(); ?> </h4>
        <p>  <?php Print_Mail(); ?>  </p>
        <button type="button" onclick="window.location.href='../LogOut/LogoutPerform.php'"  class="btn">
          <div class="overlay btn-shadow"></div>
          <div class="flex-center btn-content btn-primary">
            <div class="flex-center btn-text">
              <span
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="icon"
                >
                  <path
                    d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"
                  />
                </svg>
                logout</span
              >
              <span class="duplicate"
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"
                  class="icon"
                >
                  <path
                    d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"
                  />
                </svg>
                logout</span
              >
            </div>
          </div>
        </button>
      </div>
    </div>
   

    <!-- JS links -->
    <script src="../Ui kits/js/_admin.js"></script>
    <script src="../Ui kits/js/_feedbackTable.js"></script>
    
  </body>
</html>
