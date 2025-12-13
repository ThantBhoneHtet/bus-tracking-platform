<?php

require_once('DatabaseConnect.php');

function fetch_busStop_info() {
    global $pdo;
    $select = "SELECT * FROM bus_stop";
    $stmt = $pdo->query($select);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}


function fetch_busLine_info() {
    global $pdo;
    $select = "SELECT * FROM bus_line";
    $stmt = $pdo->query($select);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function fetch_feedback_info(){
    global $pdo;
    $select = "SELECT * FROM feedback";
    $stmt = $pdo->query($select);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}


function delete_busLine_info($id) {
    global $pdo;
    $delete = "DELETE FROM bus_line WHERE id=$id ";
    $pdo->query($delete);
}

function delete_busStop_info($id) {
    global $pdo;
    $delete = "DELETE FROM bus_stop WHERE id=$id ";
    $pdo->query($delete);
}


function update_busStop_info($id,$name_en, $road_en, $township_en, $latitude, $longitude) {
    global $pdo;
    $update = "UPDATE bus_stop SET name_en = :name_en,road_en = :road_en, township_en= :township_en, latitude= :latitude, longitude= :longitude WHERE id=$id ";
    $stmt = $pdo->prepare($update);
    $stmt->execute([
        ':name_en' => $name_en,
        ':road_en' => $road_en,
        ':township_en' => $township_en,
        ':latitude' => $latitude,
        ':longitude' => $longitude
    ]);

}

function update_busLine_info($id,$type, $color, $station, $start, $end, $named_route) {
    global $pdo;
    $update = "UPDATE bus_line SET type = :type,color = :color, station= :station, start= :start, end = :end, named_route=:named_route WHERE id=$id ";
    $stmt = $pdo->prepare($update);
    $stmt->execute([
        ':type' => $type,
        ':color' => $color,
        ':station' => $station,
        ':start' => $start,
        ':end' => $end,
        ':named_route' => $named_route
    ]);
}


function insert_busLine_data($id,$type, $color, $station, $start, $end, $named_route) {
    global $pdo;
    $insert= "INSERT INTO bus_line  (id,type, color, station, start, end, named_route) VALUES (:id,:type,:color,:station,:start,:end,:named_route)";
    $stmt = $pdo->prepare($insert);
    $stmt->execute([
        ':id' => $id,
        ':type' => $type,
        ':color' => $color,
        ':station' => $station,
        ':start' => $start,
        ':end' => $end,
        ':named_route' => $named_route
    ]);
}

function insert_busStop_data($name_en, $name_mm, $road_en, $road_mm, $township_en, $township_mm, $latitude, $longitude) {
    global $pdo;
    
    $insert = "INSERT INTO bus_stop (name_en, name_mm, road_en, road_mm, township_en, township_mm, latitude, longitude) 
               VALUES (:name_en, :name_mm, :road_en, :road_mm, :township_en, :township_mm, :latitude, :longitude)";
    
    // Prepare the SQL statement
    $stmt = $pdo->prepare($insert);
    
    // Execute the statement with bound parameters
    $stmt->execute([
        ':name_en' => $name_en,
        ':name_mm' => $name_mm,
        ':road_en' => $road_en,
        ':road_mm' => $road_mm,
        ':township_en' => $township_en,
        ':township_mm' => $township_mm,
        ':latitude' => $latitude,
        ':longitude' => $longitude
    ]);

}

function delete_feedback_info($id) { 
    global $pdo;
    $delete = "DELETE FROM feedback WHERE id=$id ";
    $pdo->query($delete);
}