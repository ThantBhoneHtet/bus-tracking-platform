<?php

require_once "./Session/Session.php";
require_once "./Database/DatabaseConnect.php";

// Get the parameters from the query string
$startStop = isset($_GET['start']) ? $_GET['start'] : '';
$endStop = isset($_GET['end']) ? $_GET['end'] : '';

// Prepare the SQL query with placeholders
$select = "
-- First, identify all valid start and end stop pairs
WITH StartEndPairs AS (
    SELECT 
        start_seq.bus_line_id,
        start_seq.sequence AS start_sequence,
        end_seq.sequence AS end_sequence,
        end_seq.sequence - start_seq.sequence AS sequence_diff,
        ROW_NUMBER() OVER (PARTITION BY start_seq.bus_line_id ORDER BY start_seq.sequence) AS start_rank,
        ROW_NUMBER() OVER (PARTITION BY end_seq.bus_line_id ORDER BY end_seq.sequence) AS end_rank
    FROM 
        bus_arrival start_seq
    JOIN 
        bus_stop start_stop ON start_seq.bus_stop_id = start_stop.id
    JOIN 
        bus_arrival end_seq ON start_seq.bus_line_id = end_seq.bus_line_id
    JOIN 
        bus_stop end_stop ON end_seq.bus_stop_id = end_stop.id
    WHERE 
        start_stop.name_en = :startStop
        AND end_stop.name_en = :endStop
        AND end_seq.sequence > start_seq.sequence
)

-- Select only the shortest difference sequence
, ShortestRoutes AS (
    SELECT 
        sp1.bus_line_id,
        sp1.start_sequence,
        sp1.end_sequence,
        sp1.sequence_diff
    FROM 
        StartEndPairs sp1
    JOIN (
        SELECT 
            bus_line_id,
            MIN(sequence_diff) AS min_sequence_diff
        FROM 
            StartEndPairs
        GROUP BY 
            bus_line_id
    ) sp2 ON sp1.bus_line_id = sp2.bus_line_id 
        AND sp1.sequence_diff = sp2.min_sequence_diff
)

-- Fetch the route based on the valid start and end sequences with the shortest difference
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
JOIN 
    ShortestRoutes sr ON ba.bus_line_id = sr.bus_line_id
    AND ba.sequence BETWEEN sr.start_sequence AND sr.end_sequence
ORDER BY 
    ba.bus_line_id, ba.sequence;
";

// Prepare and execute the query securely
try {
    $stmt = $pdo->prepare($select);
    $stmt->bindValue(':startStop', $startStop, PDO::PARAM_STR);
    $stmt->bindValue(':endStop', $endStop, PDO::PARAM_STR);
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