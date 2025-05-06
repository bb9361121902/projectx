// const busDetails = [
//   {
//     busName: "Papanasam Express",
//     route: "Cheran Mahadevi to Tirunelveli",
//     time: "6:00 AM - 8:00 AM",
//     stops: [
//       "Scad",
//       "Cheran Mahadevi",
//       "Kooniyur",
//       "karukurichi",
//       "melaputhukudi",
//       "Veravanallur",
//       "Vellanguli",
//       "kallidaikurichi",
//       "Ambasamudram",
//       "Agasthiyarpatti",
//       "Adayakarunkulam",
//       "Sivanthipuram",
//       "Vickramasingapuram",
//       "Dana",
//       "Papanasam",
//     ],
//   },
//   {
//     busName: "Thirunelveli Express",
//     route: "Papanasam to Tirunelveli",
//     time: "8:30 AM - 10:30 AM",
//     stops: ["Papanasam", "Ambasamudram", "Tirunelveli"],
//   },
//   {
//     busName: "Kalakadu Express",
//     route: "Kalakadu to Tirunelveli",
//     time: "10:45 AM - 12:45 PM",
//     stops: ["Kalakadu", "Nanguneri", "Tirunelveli"],
//   },
//   {
//     busName: "Nagarkovil Express",
//     route: "Kalakadu to Tirunelveli",
//     time: "10:45 AM - 12:45 PM",
//     stops: ["Kalakadu", "Nanguneri", "Tirunelveli"],
//   },
//   {
//     busName: "alangulam Express",
//     route: "Kalakadu to Tirunelveli",
//     time: "10:45 AM - 12:45 PM",
//     stops: ["Kalakadu", "Nanguneri", "Tirunelveli"],
//   },
//   {
//     busName: "pettai Express",
//     route: "Kalakadu to Tirunelveli",
//     time: "10:45 AM - 12:45 PM",
//     stops: ["Kalakadu", "Nanguneri", "Tirunelveli"],
//   },
//   {
//     busName: "ktc nagar Express",
//     route: "Kalakadu to Tirunelveli",
//     time: "10:45 AM - 12:45 PM",
//     stops: ["Kalakadu", "Nanguneri", "Tirunelveli"],
//   },
//   {
//     busName: "nagarkovil Express",
//     route: "Kalakadu to Tirunelveli",
//     time: "10:45 AM - 12:45 PM",
//     stops: ["Kalakadu", "Nanguneri", "Tirunelveli"],
//   },
//   {
//     busName: "nagarkovil Express",
//     route: "Kalakadu to Tirunelveli",
//     time: "10:45 AM - 12:45 PM",
//     stops: ["Kalakadu", "Nanguneri", "Tirunelveli"],
//   },
// ];

// function getBusDetailsByRoute(route) {
//   const filteredBuses = busDetails.filter((bus) => bus.route === route);
//   return filteredBuses;
// }


function getDistance(lat1, lon1, lat2, lon2) {
  const R = 6371; // Earth's radius in km
  const dLat = toRad(lat2 - lat1);
  const dLon = toRad(lon2 - lon1);
  const a = 
    Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) * 
    Math.sin(dLon/2) * Math.sin(dLon/2);
  const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
  return R * c; // Distance in km
}

function toRad(degrees) {
  return degrees * Math.PI / 180;
}

// Example usage:
const userLat = 8.67474, userLon =77.56584; // New York
const busLat = 8.70360, busLon = 77.44854; // Los Angeles
const distance = getDistance(userLat, userLon, busLat, busLon);
console.log(distance + " km");


const userLocation = new google.maps.LatLng(userLat, userLon);
const busLocation = new google.maps.LatLng(busLat, busLon);
const distances = google.maps.geometry.spherical.computeDistanceBetween(
  userLocation, busLocation); // in meters



  // https://www.google.com/maps/dir/Ambasamudram,+Tamil+Nadu/Cheranmahadevi,+Tamil+Nadu/@8.7036169,77.4485374,50m/am=t/data=!3m1!1e3!4m14!4m13!1m5!1m1!1s0x3b04395f1baf33f9:0x85c499464a1eaecf!2m2!1d77.4485388!2d8.7035955!1m5!1m1!1s0x3b0415868994ab3f:0x9e696c44e0a93e94!2m2!1d77.5658381!2d8.6747285!3e0?entry=ttu&g_ep=EgoyMDI1MDMyNS4xIKXMDSoJLDEwMjExNDUzSAFQAw%3D%3D