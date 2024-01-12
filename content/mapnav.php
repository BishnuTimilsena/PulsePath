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
    require_once "../assets/Database/connection.php";
    $connection = new Connection();
    $user = $connection->get_user($uid);
    $name = $user['name'];

    $hospitalData = $connection->getHospitalData();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PulsePath</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
  <link rel="stylesheet" href="../assets/CSS/style.css" />
</head>
<body id="top">
   <!-- 
    - #HEADER
  -->
  <?php include 'navbar/navbar.php'; ?>

  <section class="map-section">
    <h1>Search Map</h1>
    <div class="form-group">
       <label for="startLocation">Start Location :</label>
       <input type="text" id="startLocation" placeholder="Enter start location">
    </div>
   
    <div class="form-group">
       <label for="endLocation">End Location :</label>
       <input type="text" id="endLocation" placeholder="Enter end location">
    </div>
  
    <button id="submitButton">
    <span>Get Directions</span>
    <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
  </button>
  <div id="map"></div>
</section>

    <!-- 
    - #FOOTER
  -->
  <?php
    include 'footer/footer.php';
    ?>
<!-- 
- custom js link
-->
<script src="../assets/js/script.js"></script>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
<script src="mapnav.js"></script>
</body>
</html>