<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Details</title>
    <link rel="stylesheet" href="../css/bus_details.css">
    <link rel="icon" type="image/x-icon" href="../img/website_logo.jpg" />
</head>

<body>
    <h1 style="text-align: center; margin-top: 20px">Bus Details</h1>
    <a class="bcbtn1" href="../html/index.php">Back to Home</a>

    <div id="resultsContainer" class="results-container">
        <?php
        if (!isset($_SESSION["buses"]) || empty($_SESSION["buses"])) {
            // Show the "No buses" message inside the results container
            echo "<div class='card'>";
            echo "<p style='color:red; text-align:center;'>No buses found for the selected route.</p>";
            echo "</div>";
        } else {
            foreach ($_SESSION["buses"] as $bus) {
                if (!isset($bus["id"])) continue;

                $busName = isset($bus["busName"]) ? htmlspecialchars($bus["busName"]) : "Unknown";
                $route = isset($bus["route"]) ? htmlspecialchars($bus["route"]) : "Unknown";
                $time = isset($bus["time"]) ? htmlspecialchars($bus["time"]) : "Unknown";

                echo "<div class='card'>";
                echo "<h2>🚍 " . $busName . "</h2>";
                echo "<p>📍 <b>Route:</b> " . $route . "</p>";
                echo "<p>⏰ <b>Time:</b> <span class='time'>" . $time . "</span></p>";
                echo "<a href='../php/route.php?bus_id=" . urlencode($bus["id"]) . "' class='btn'>View Details</a>";
                echo "</div>";
            }
        }
        ?>
    </div>
</body>

</html>