<?php
include "../php/db_conn.php"; // Database connection

$bus_id = isset($_GET["bus_id"]) ? intval($_GET["bus_id"]) : 0;

$sql = "SELECT latitude, longitude FROM LiveBusLocation WHERE bus_id = ? ORDER BY updated_at DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $bus_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

$response = [
    "success" => $data ? true : false,
    "latitude" => $data["latitude"] ?? null,
    "longitude" => $data["longitude"] ?? null
];

echo json_encode($response);

$stmt->close();
$conn->close();
?>
