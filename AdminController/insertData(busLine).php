<?php

require_once('../Database/TableQuery.php');

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['type'])) {
    $id = $_POST['busLine'];
    $type = $_POST['type'];
    $color = $_POST['color'];
    $station = $_POST['station'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $named_route = $_POST['named_route'];

    insert_busLine_data($id,$type, $color, $station, $start, $end, $named_route);

    header("location: ../AdminDashboard/admin(busLine).php");


}