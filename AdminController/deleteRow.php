<?php

require_once('../Database/TableQuery.php');


if (isset($_GET['BusLineid'])) {
    $id = $_GET['BusLineid'];
    delete_busLine_info($id);

    header("location: ../AdminDashboard/admin(busLine).php");

}
if (isset($_GET['BusStopid'])) {
    $id = $_GET['BusStopid'];
    delete_busStop_info($id);

    header("location: ../AdminDashboard/admin(busStop).php");
}

if (isset($_GET['Userid'])) {
    $id = $_GET['Userid'];
    delete_feedback_info($id);

    header("location: ../AdminDashboard/admin(feedback).php");
}