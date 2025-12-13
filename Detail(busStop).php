<?php

require_once "./Session/Session.php";
require_once "./Database/DatabaseConnect.php";

// Get the bus stop name from the query string
$busStopName = isset($_GET['busStop']) ? $_GET['busStop'] : '';


// Prepare the SQL query to fetch unique busLineId and sequence
$select = "
SELECT DISTINCT 
    ba.bus_line_id, 
    bl.start, 
    bl.end, 
    bs.road_mm,
    ba.sequence  
FROM 
    bus_arrival ba
JOIN 
    bus_stop bs ON ba.bus_stop_id = bs.id
JOIN 
    bus_line bl ON ba.bus_line_id = bl.id
WHERE 
    bs.name_en = :busStopName OR bs.name_mm = :busStopName
ORDER BY 
    ba.bus_line_id, ba.sequence;
";

// Prepare and execute the query securely
try {
    $stmt = $pdo->prepare($select);
    $stmt->bindValue(':busStopName', $busStopName, PDO::PARAM_STR);
    $stmt->execute();
    $busStops = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle query error
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}

// Return the result as JSON
header('Content-Type: application/json');
echo json_encode($busStops, JSON_UNESCAPED_UNICODE);

?>
