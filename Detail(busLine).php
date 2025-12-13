<?php

require_once "./Session/Session.php";
require_once "./Database/DatabaseConnect.php";

// Get the bus line ID from the query string
$busLineId = isset($_GET['busNo']) ? $_GET['busNo'] : '';

// Prepare the SQL query with a placeholder for bus line ID
$select = "
SELECT 
    ba.bus_line_id, 
    ba.sequence, 
    bs.name_mm, 
    bs.name_en, 
    bs.road_mm, 
    bs.longitude, 
    bs.latitude
FROM 
    bus_arrival ba
JOIN 
    bus_stop bs ON ba.bus_stop_id = bs.id
WHERE 
    ba.bus_line_id = :busLineId
ORDER BY 
    ba.sequence;
";

// Prepare and execute the query securely
try {
    $stmt = $pdo->prepare($select);
    $stmt->bindValue(':busLineId', $busLineId, PDO::PARAM_STR);
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
