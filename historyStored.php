<?php
require_once('./Session/Session.php');

if (isset($_GET['from']) && isset($_GET['to'])) {

    if (!isset($_SESSION['routes'])) {
        $_SESSION['routes'] = [];
    }

    $_SESSION['routes'][] = [
        'from' => $_GET['from'],
        'to' => $_GET['to'],
        'route' => $_GET['routes']
    ];


}
print_r($_SESSION['routes']);