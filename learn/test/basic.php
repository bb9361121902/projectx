<?php
session_start();

// Database connection
$host = 'localhost';
$user = 'root';
$pass = 'balaji7418$S';
$db = 'bustrackingsystem';

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate and sanitize input
if (isset($_POST["from"], $_POST["to"])) {
    $from = trim($_POST["from"]);
    $to = trim($_POST["to"]);
    $route = $from . " to " . $to;

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT busName, route, time FROM BusSchedule WHERE route = ?");
    $stmt->bind_param("s", $route);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display results
    if ($result->num_rows > 0) {
        echo "<h3>Available Buses</h3>";
        while ($row = $result->fetch_assoc()) {
            echo "🚍 <b>Bus Name:</b> " . htmlspecialchars($row["busName"]) . "<br>";
            echo "📍 <b>Route:</b> " . htmlspecialchars($row["route"]) . "<br>";
            echo "⏰ <b>Time:</b> " . htmlspecialchars($row["time"]) . "<br><br>";
        }
    } else {
        echo "<p style='color:red;'>No buses available for this route.</p>";
    }

    // Close statement
    $stmt->close();
} else {
    echo "<p style='color:red;'>Please provide both 'From' and 'To' locations.</p>";
    echo "<p style='color:red;'>Please provide both 'From' and 'To' locations.</p>";
}

// Close connection
$conn->close();
?>
