<?php
require_once "./Session/Session.php";
require_once "./Classes/RegisteredUser.php";
require_once "./Database/DatabaseConnect.php";

if (isset($_GET['routeid'])) {
    $u_id=$_SESSION["user_id"];
    $registered_user =  new Registered_User($u_id,$pdo);
    $registered_user -> delete_Save_route($_GET['routeid']);
}