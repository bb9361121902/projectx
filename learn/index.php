<?php
if (isset($_POST['lat']) && isset($_POST['lon'])) {
    $lat = $_POST['lat'];
    $lon = $_POST['lon'];

    // Save to file or database
    file_put_contents("gps_log.txt", "Lat: $lat, Lon: $lon\n", FILE_APPEND);

    echo "Location received: $lat, $lon";
} else {
    echo "Missing parameters.";
}
?>
