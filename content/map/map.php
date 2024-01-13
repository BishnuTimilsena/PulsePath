<?php
session_start();
$error = "";

// show errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['uid'])) {
  header("Location: user/login.php");
} else {
  $uid = $_SESSION['uid'];
  require_once "../../assets/Database/connection.php";
  $connection = new Connection();
  $user = $connection->get_user($uid);
  $name = $user['name'];
  $phone = $user['phone'];
  $license = $user['license'];
  $ambulance_no = $user['ambulance_no'];
  // $organization = $user['organization'];

  $doctorData = $connection->getDoctorsData();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PulsePath</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin="" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
  <link rel="stylesheet" href="../../assets/CSS/style.css" />
  <link rel="stylesheet" href="css/map.css" />
</head>

<body id="top">
  <!-- 
    - #HEADER
  -->
  <?php include '../navbar/navbar.php'; ?>


  <section class="map-section">
    <div class="details">
      <h3 id="nearestHospital">
        Nearest Hospital : </h3>
      <span id="nearestHospitalName"> </span>
    </div>
    <div class="details">
      <h3 id="shortestPath">
        Shortest Path:</h3> <span id="shortestPathInfo"></span>
    </div>

    <div id="map"></div>
    <h3 id="hospitalsWithinRadius">Hospitals within 10 km radius:</h3>
    <ul id="hospitalList"></ul>
  </section>


  <!-- 
    - #FOOTER
  -->
  <?php
  include '../footer/footer.php';
  ?>


  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" crossorigin=""></script>
  <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js" crossorigin=""></script>

  <script>
    // Initialize the map
    const map = L.map("map");

    // Get the tile layer from OpenStreetMaps
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
      // Specify the zoom of the map
      maxZoom: 19,
      attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(map);

    // Function to handle location retrieval
    const socket = new WebSocket('ws://localhost:8080/');
    socket.addEventListener('open', (event) => {
      console.log('WebSocket connection opened:', event);

    });
    function onLocationFound(e) {
      //websocket creation
      // if (!socket.CONNECTING) {
        socket.send(JSON.stringify(e.latlng));
      // }

      const userMarker = L.marker(e.latlng, {
        icon: blueIcon
      }).addTo(map);
      userMarker.bindPopup("You're Here").openPopup();

      // YESLE OSM routing API use garera najik ko hospital samma ko route calculate garxa
      fetchNearestHospital(e.latlng);
    }

    function onLocationError(e) {
      console.error("Error getting location:", e.message);
      alert(
        "Error getting location. Please check your browser settings and try again."
      );
    }

    // Try to locate the user's position
    map.locate({
      setView: true,
      maxZoom: 16,
      watch: true, // Enable continuous location updates
      enableHighAccuracy: true, // Use high-accuracy mode if available
    });

    // Event listeners for location services
    map.on("locationfound", onLocationFound);
    map.on("locationerror", onLocationError);

    // Code snippet for icon is taken from github
    const blueIcon = new L.Icon({
      iconUrl: "https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png",
      iconSize: [25, 41],
      iconAnchor: [12, 41],
      popupAnchor: [1, -34],
      shadowSize: [41, 41],
    });
    let routingControl = null;

    // THIS IS THE FUNCTION TO FETCH THE NEAREST HOSPITAL ACCORDING TO USER LOCATION AND TO CALCULATE ROUTE
    function fetchNearestHospital(userLocation) {
      fetch("data/hotosm_npl_health_facilities_points_geojson.geojson")
        .then((response) => response.json())
        .then((data) => {
          let nearestHospital = null;
          let minDistance = Infinity;
          const uniqueHospitalNames = new Set();
          let hospitalsDisplayed = 0;

          L.geoJSON(data, {
            filter: function (feature, layer) {
              const excludedAmenities = [
                "clinic",
                "pharmacy",
                "dentist",
                "doctors",
                "bastu",
                "dental clinic",
              ];
              return !excludedAmenities.includes(feature.properties.amenity);
            },
            onEachFeature: function (feature, layer) {
              const hospitalName = feature.properties.name || "No Name";
              layer.bindPopup(`<b>${hospitalName}</b>`);

              const hospitalLatLng = layer.getLatLng();
              const distance = userLocation.distanceTo(hospitalLatLng);

              if (distance <= 10000 && hospitalsDisplayed < 20) {
                if (!uniqueHospitalNames.has(hospitalName)) {
                  uniqueHospitalNames.add(hospitalName);
                  hospitalsDisplayed++;

                  const hospitalList = document.getElementById("hospitalList");
                  const listItem = document.createElement("li");
                  listItem.textContent = hospitalName;
                  listItem.setAttribute("data-lat", hospitalLatLng.lat);
                  listItem.setAttribute("data-lng", hospitalLatLng.lng);
                  hospitalList.appendChild(listItem);

                  listItem.addEventListener("click", function () {
                    const clickedLatLng = {
                      lat: parseFloat(this.getAttribute("data-lat")),
                      lng: parseFloat(this.getAttribute("data-lng")),
                    };
                    calculateRoute(userLocation, clickedLatLng);
                  });
                }
              }

              // Also update the nearest hospital information here
              if (distance < minDistance) {
                minDistance = distance;
                nearestHospital = layer;
                document.getElementById("nearestHospitalName").textContent =
                  hospitalName;
              }
            },
          }).addTo(map);
          if (nearestHospital && minDistance <= 10000) {
            if (routingControl) {
              map.removeControl(routingControl);
            }

            routingControl = L.Routing.control({
              waypoints: [
                L.latLng(userLocation.lat, userLocation.lng),
                nearestHospital.getLatLng(),
              ],
              routeWhileDragging: true,
            });

            map.addControl(routingControl);

            routingControl.on("routesfound", function (e) {
              const route = e.routes[0];
              const shortestPathInfo = `${route.summary.totalDistance / 1000
                } km, ${route.summary.totalTime / 60} min`;
              document.getElementById("shortestPathInfo").textContent =
                shortestPathInfo;
              console.log("Shortest Path:", route);
            });
          } else {
            console.log("No hospital found within 10 km.");
          }
        });
    }

    // REMAINDER : YO TALA KO DUPLICATEFUNCTION HAINA HAI, FERI MATHI RW YO SAME XW JASTO LAGNA SAKXA
    // THIS IS FOR LIKE IF USER CLICKS ON ANY NAME OF THE HOSPITAL THE FOR
    // SHOWING THE PATH TO THAT HOSPITAL

    // Function to calculate route from user location to clicked hospital
    function calculateRoute(userLocation, destinationLatLng) {
      // Remove existing routing control if any
      if (routingControl) {
        map.removeControl(routingControl);
      }

      // Create a new routing control for the clicked hospital
      routingControl = L.Routing.control({
        waypoints: [
          L.latLng(userLocation.lat, userLocation.lng),
          destinationLatLng,
        ],
        routeWhileDragging: true,
      });

      // Add routing control to the map
      map.addControl(routingControl);

      // Listen for the routing event to get the shortest path
      routingControl.on("routesfound", function (e) {
        const route = e.routes[0];
        const shortestPathInfo = `${route.summary.totalDistance / 1000} km, ${route.summary.totalTime / 60
          } min`;
        document.getElementById("shortestPathInfo").textContent =
          shortestPathInfo;
        console.log("Shortest Path:", route);
      });

      // Open the popup for the clicked hospital
      const clickedMarker = L.marker(destinationLatLng, {
        icon: blueIcon,
      }).addTo(map);
      clickedMarker.bindPopup("Destination Hospital").openPopup();
    }
  </script>
  <!-- 
- custom js link
-->
  <script src="../../assets/js/script.js"></script>
  <script src="map.js"></script>

  <!-- 
    - ionicon link
    -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>