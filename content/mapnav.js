

let map = L.map('map').setView([27.7172, 85.3240], 10);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

// Converting a location name into geographical coordinates
function geocodeLocation(locationName, callback) {

  // base URL for the Nominatim geocoding service
 let apiUrl = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(locationName)}`;

  fetch(apiUrl)
    .then(response => response.json())
    .then(data => {
      if (data && data.length > 0) {
        let coordinates = [parseFloat(data[0].lat), parseFloat(data[0].lon)];
        callback(null, coordinates);
      } else {
        callback("Location not found", null);
      }
    })
    .catch(error => {
      callback(error, null);
    });
}

// Showing the route to start and end nodes in map
function showRoute(startLocation, endLocation) {
  L.marker(startLocation, { icon: redIcon }).addTo(map);
  
  L.marker(endLocation, { icon: blueIcon }).addTo(map);

  L.Routing.control({
    waypoints: [
      L.latLng(startLocation),
      L.latLng(endLocation)
    ],
  }).addTo(map);
}

let startInput = document.getElementById('startLocation');
let endInput = document.getElementById('endLocation');
let submitButton = document.getElementById('submitButton');

let redIcon = new L.Icon({
  iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
  iconSize: [25, 41],
  iconAnchor: [12, 41],
  popupAnchor: [1, -34],
  tooltipAnchor: [16, -28],
  shadowSize: [41, 41]
});

let blueIcon = new L.Icon({
  iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png',
  iconSize: [25, 41],
  iconAnchor: [12, 41],
  popupAnchor: [1, -34],
  tooltipAnchor: [16, -28],
  shadowSize: [41, 41]
});

submitButton.addEventListener('click', function () {
  let startLocation = startInput.value;
  let endLocation = endInput.value;

  geocodeLocation(startLocation, function (error, startCoordinates) {
    if (!error) {
      geocodeLocation(endLocation, function (error, endCoordinates) {
        if (!error) {
          showRoute(startCoordinates, endCoordinates);
        } else {
          alert("Error geocoding end location: " + error);
        }
      });
    } else {
      alert("Error geocoding start location: " + error);
    }
  });
});