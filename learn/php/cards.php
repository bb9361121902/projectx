<?php
session_start();
include '../php/db_conn.php';

if (!$conn) {
    die("Database connection error: " . mysqli_connect_error());
}

if (isset($_POST["from"], $_POST["to"])) {
    $from = trim($_POST["from"]);
    $to = trim($_POST["to"]);
    $route = $from . " to " . $to;

    // Debugging Output
    echo "Searching for route: " . htmlspecialchars($route) . "<br>";

    $stmt = $conn->prepare("SELECT id, busName, route, time FROM BusSchedule WHERE LOWER(TRIM(route)) = LOWER(TRIM(?))");

    if (!$stmt) {
        die("SQL prepare error: " . $conn->error);
    }

    $stmt->bind_param("s", $route);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "Rows Found: " . $result->num_rows . "<br>"; // Debugging

    $buses = [];
    while ($row = $result->fetch_assoc()) {
        $buses[] = $row;
    }

    if (!empty($buses)) {
        $_SESSION["buses"] = $buses;
        header("Location: ../html/bus_details.php");
        exit();
    } else {
        $_SESSION["buses"] = []; // Set an empty session to avoid previous data showing
        header("Location: ../html/bus_details.php");
        exit();
    }

    $stmt->close();
} else {
    echo "<p style='color:red;'>Please enter both From and To locations.</p>";
}

$conn->close();
?>
