<?php
require_once('../Database/TableQuery.php');


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    update_busStop_info(
        $_POST['id'],
        $_POST['name_en'],
        $_POST['road_en'],
        $_POST['township_en'],
        $_POST['latitude'],
        $_POST['longitude']
    );
}

header("location: ../AdminDashboard/admin(busStop).php");

