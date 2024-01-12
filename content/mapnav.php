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
<header class="header" data-header>
  <div class="container">
      <div class="overlay" data-overlay></div>

      <a href="../index.php" class="logo">
          <img src="../assets/images/logo.svg" width="250px" alt="PulsePath logo" />
      </a>

      <button class="nav-open-btn" data-nav-open-btn aria-label="Open Menu">
          <ion-icon name="menu-outline"></ion-icon>
      </button>

      <nav class="navbar" data-navbar>
          <button class="nav-close-btn" data-nav-close-btn aria-label="Close Menu">
              <ion-icon name="close-outline"></ion-icon>
          </button>

          <a href="../index.php" class="logo">
              <img src="../assets/images/logo.svg" alt="PulsePath logo" />
          </a>

          <ul class="navbar-list">
              <li class="navbar-item">
                  <a href="doctor.php" class="navbar-link"><strong>Doctors</strong></a>
              </li>

              <li class="navbar-item">
                  <a href="traffic.php" class="navbar-link"><strong>Traffic Control</strong></a>
              </li>

              <li class="navbar-item">
                  <a href="hospital.php" class="navbar-link"><strong>Hospitals</strong></a>
              </li>
              <li class="navbar-item">
                <a href="mapnav.html" class="navbar-link"><strong>Map</strong></a>
            </li>
          </ul>

          <!-- Dropdown Menu -->
          <ul class="nav-action-list">
              <li id="profile-dropdown">
                  <div class="nav-action-btn">
                      <ion-icon name="person-outline" aria-hidden="true"></ion-icon>
                      <span class="nav-action-text">Login / Register</span>
                  </div>
                  <div class="dropdown-content">
                      <div class="user-info">
                          <img src="../assets/images/doc1.jpeg" alt="User Avatar" class="user-avatar" />
                          <div class="user-details">
                              <p class="user-name"><?php echo $name; ?></p>
                          </div>
                      </div>
                      <hr />
                      <a href="#">Information Page</a>
                      <hr />
                      <a href="#">Vehicle Information Page</a>
                      <hr />
                      <a href="#">Trips Page</a>
                      <hr />
                      <a href="user/logout.php">Logout</a>
                  </div>
              </li>
          </ul>
      </nav>
  </div>
</header>



 <!-- 
    - #FOOTER
  -->
  <section class="footer">
    <footer>
        <div class="footer-bottom">
            <div class="container">
                <p class="copyright">&copy; 2024 cat.gif. All Rights Reserved</p>
            </div>
        </div>
    </footer>
</section>
<!-- 
- custom js link
-->
<script src="../assets/js/script.js"></script>

    <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
<script src="mapnav.js"></script>
</body>
</html>
