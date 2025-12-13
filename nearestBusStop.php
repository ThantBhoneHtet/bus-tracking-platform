<?php

require_once "./Session/Session.php";

if (isset($_GET['name__en'])) {
    if (!isset($_SESSION['nearest_busStop'])) {
        $_SESSION['nearest_busStop'] = [];
    }
    $_SESSION['nearest_busStop'][] = [
        "name_en" => $_GET['name__en'],
        "name_mm" => $_GET['name__mn']
    ];
}
?>




