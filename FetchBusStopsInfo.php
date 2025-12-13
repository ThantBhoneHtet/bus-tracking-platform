<?php

require_once("./Database/DatabaseConnect.php");


$select = "SELECT * From bus_stop";
$result= $pdo->query($select);

$busStops = $result->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($busStops, JSON_UNESCAPED_UNICODE);

