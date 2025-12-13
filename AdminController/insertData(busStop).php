<?php

require_once('../Database/TableQuery.php');

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['name_en'])) {
    $name_en = $_POST['name_en'];
    $name_mm = $_POST['name_mm'];
    $road_en = $_POST['road_en'];
    $road_mm = $_POST['road_mm'];
    $township_en = $_POST['township_en'];
    $township_mm = $_POST['township_mm'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    insert_busStop_data($name_en, $name_mm, $road_en, $road_mm, $township_en, $township_mm, $latitude, $longitude);

    header("location: ../AdminDashboard/admin(busStop).php");


}
