<?php
include "../php/db_conn.php";

$bus_id = $_POST["bus_id"];
$latitude = $_POST["latitude"];
$longitude = $_POST["longitude"];

$sql = "INSERT INTO LiveBusLocation (bus_id, latitude, longitude) 
        VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE latitude = VALUES(latitude), longitude = VALUES(longitude), updated_at = NOW()";

$stmt = $conn->prepare($sql);
$stmt->bind_param("idd", $bus_id, $latitude, $longitude);
$stmt->execute();

$response = ["success" => true];
echo json_encode($response);

$stmt->close();
$conn->close();
?>
