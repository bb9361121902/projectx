<?php
session_start();
include "../php/db_conn.php"; // Ensure this file connects to your database

// Get bus ID from query parameters
$bus_id = isset($_GET["bus_id"]) ? intval($_GET["bus_id"]) : 0;

// Fetch bus stops for the selected bus
$sql = "SELECT stop_name, stop_order, time, latitude, longitude 
        FROM BusStops 
        WHERE bus_id = ? 
        ORDER BY 
        CASE 
            WHEN time = '4' THEN -stop_order  -- Reverse order when time is 4
            ELSE stop_order  
        END ASC";


$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $bus_id);
$stmt->execute();
$result = $stmt->get_result();

$stops = [];
while ($row = $result->fetch_assoc()) {
    $stops[] = $row;
}

// Get the current time in 24-hour format
$currentTime = date("08:00");

// If the time is 16:00 (4 PM), reverse the order of stops
if ($currentTime == "16:00") {
    $stops = array_reverse($stops);
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Route Details</title>
    <link rel="icon" type="image/x-icon" href="../img/website_logo.jpg" />
    <link rel="stylesheet" href="../css/route.css">
    <script>
        function fetchLiveLocation() {
            fetch('../php/get_live_location.php?bus_id=<?php echo $bus_id; ?>')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        highlightNextStop(data.latitude, data.longitude);
                    }
                });
        }

        function highlightNextStop(lat, lng) {
            let stops = document.querySelectorAll('.station');
            let closestStop = null;
            let minDistance = Infinity;

            stops.forEach(stop => {
                let stopLat = parseFloat(stop.dataset.latitude);
                let stopLng = parseFloat(stop.dataset.longitude);
                let distance = getDistance(lat, lng, stopLat, stopLng);

                if (distance < minDistance) {
                    minDistance = distance;
                    closestStop = stop;
                }
            });

            // Remove `current-stop` from all
            stops.forEach(stop => stop.classList.remove('current-stop'));

            // Apply blinking effect only to the nearest stop
            if (closestStop) {
                closestStop.classList.add('current-stop');
            }
        }

        // **Fix: Function to Calculate Distance Between Two Coordinates**
        function getDistance(lat1, lon1, lat2, lon2) {
            let R = 6371e3; // Earth radius in meters
            let φ1 = lat1 * (Math.PI / 180);
            let φ2 = lat2 * (Math.PI / 180);
            let Δφ = (lat2 - lat1) * (Math.PI / 180);
            let Δλ = (lon2 - lon1) * (Math.PI / 180);

            let a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
                Math.cos(φ1) * Math.cos(φ2) *
                Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
            let c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

            return R * c; // Distance in meters
        }

        // Fetch live location every 5 seconds
        // setInterval(fetchLiveLocation, 5000);
        fetchLiveLocation();
    </script>
</head>

<body>
    <h1 class="route-header">🚌Bus Route Details</h1>
    <div class="container">
        <h4 style="margin-left: -21rem; color: white;">📍Start</h4>
        <div class="route-container" id="routeContainer">
            <div class="vertical-line" id="verticalLine"></div>
            <?php if (!empty($stops)) : ?>
                <?php foreach ($stops as $index => $stop) : ?>
                    <div class="station <?php echo $index === 0 ? 'current-stop' : ''; ?>"
                        id="stop-<?php echo $index; ?>"
                        data-latitude="<?= htmlspecialchars($stop["latitude"]) ?>"
                        data-longitude="<?= htmlspecialchars($stop["longitude"]) ?>">
                        <div class="dot"></div>
                        <div class="details">
                            <span><strong><?= htmlspecialchars($stop["stop_name"]) ?> </strong></span>
                            <!-- <span>Stop Order: <?= htmlspecialchars($stop["stop_order"]) ?></span> -->
                            <span class="time">ETA: <?= htmlspecialchars($stop["time"]) ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p style="color:red; text-align:center;">No stops available for this bus.</p>
            <?php endif; ?>

        </div>
        <h4 style="margin-left: -21rem; color: white;">🚩End</h4>
        <a href="../html/bus_details.php" class="back-button">Back to Results</a>
    </div>
</body>

</html>