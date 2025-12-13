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
      <section class="edit-container">
        <div class="edit-wrapper">
          <div class="back_btn-container">
            <button onclick="window.location.href='./admin(busStop).php'"  class="btn back-btn">
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
          <div class="edit_form-container">
            <form action="../AdminController/updateBusStop.php" method="post">
            <input type="hidden" value="<?=$_POST['id']?>" name="id">
              <div class="form__field">
                <label for="">Name_en</label>
                <div class="form__input-container">
                  <div class="overlay form__shadow"></div>
                  <input
                    type="text"
                    name="name_en"
                    id=""
                    class="form__input"
                    value="<?=$_POST['name_en']?>"
                    required
                  />
                </div>
              </div>
              <div class="form__field">
                <label for="">Road_en</label>
                <div class="form__input-container">
                  <div class="overlay form__shadow"></div>
                  <input
                    type="text"
                    name="road_en"
                    id=""
                    class="form__input"
                    value="<?=$_POST['road_en']?>"
                    required
                  />
                </div>
              </div>
              <div class="form__field">
                <label for="">TownShip_en</label>
                <div class="form__input-container">
                  <div class="overlay form__shadow"></div>
                  <input
                    type="text"
                    name="township_en"
                    id=""
                    class="form__input"
                    value="<?=$_POST['township_en']?>"
                    required
                  />
                </div>
              </div>
              <div class="form__field">
                <label for="">Latitude</label>
                <div class="form__input-container">
                  <div class="overlay form__shadow"></div>
                  <input
                    type="number"
                    name="latitude"
                    id=""
                    class="form__input"
                    value="<?=$_POST['latitude']?>"
                    required
                  />
                </div>
              </div>
              <div class="form__field">
                <label for="">Longitude</label>
                <div class="form__input-container">
                  <div class="overlay form__shadow"></div>
                  <input
                    type="number"
                    name="longitude"
                    id=""
                    class="form__input"
                    value="<?=$_POST['longitude']?>"
                    required
                  />
                </div>
              </div>
              <button href="" class="btn">
                <div class="overlay btn-shadow"></div>
                <div class="flex-center btn-content btn-primary">
                  <div class="flex-center btn-text">
                    <span>update</span>
                    <span class="duplicate">update</span>
                  </div>
                </div>
              </button>
            </form>
          </div>
        </div>
      </section>
    </main>
  </body>
</html>
