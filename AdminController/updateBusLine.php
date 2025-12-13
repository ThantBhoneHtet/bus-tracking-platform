<?php
require_once('../Database/TableQuery.php');



if ($_SERVER['REQUEST_METHOD'] == "POST") {
    update_busLine_info(
        $_POST['id'],
        $_POST['type'],
        $_POST['color'],
        $_POST['station'],
        $_POST['start'],
        $_POST['end'],
        $_POST['named_route'],
    );
}

header("location: ../AdminDashboard/admin(busLine).php");

