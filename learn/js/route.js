function fetchLiveLocation() {
    fetch('../php/get_live_location.php?bus_id=<?php echo $bus_id; ?>')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                highlightNextStop(data.latitude, data.longitude);
                console.log(data);
                
            }
        })
        .catch(error => console.error('Error fetching location:', error));
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

// Function to Calculate Distance Between Two Coordinates (Haversine formula)
function getDistance(lat1, lon1, lat2, lon2) {
    const R = 6371e3; // Earth radius in meters
    const φ1 = lat1 * Math.PI / 180;
    const φ2 = lat2 * Math.PI / 180;
    const Δφ = (lat2 - lat1) * Math.PI / 180;
    const Δλ = (lon2 - lon1) * Math.PI / 180;

    const a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
              Math.cos(φ1) * Math.cos(φ2) *
              Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

    return R * c; // Distance in meters
}

// Fetch live location every 5 seconds
setInterval(fetchLiveLocation, 5000);

// Initial call
fetchLiveLocation();