<?php
session_start();
$error = "";

// show errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['uid'])) {
    header("Location: content/user/login.php");
} else {
    $uid = $_SESSION['uid'];
    require_once "assets/Database/connection.php";
    $connection = new Connection();
    $user = $connection->get_user($uid);
    $name = $user['name'];
}
if (isset($_POST['submit'])) {
    require "SMS/sendsms.php";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PulsePath</title>
    <!-- 
    - custom css link
  -->
    <link rel="stylesheet" href="./assets/CSS/style.css" />

    <!-- 
    - google font link
  -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
</head>

<body id="top">
    <!-- 
    - #HEADER
  -->

    <header class="header" data-header>
        <div class="container">
            <div class="overlay" data-overlay></div>

            <a href="index.php" class="logo">
                <img src="./assets/images/logo.svg" width="250px" alt="PulsePath logo" />
            </a>

            <button class="nav-open-btn" data-nav-open-btn aria-label="Open Menu">
                <ion-icon name="menu-outline"></ion-icon>
            </button>

            <nav class="navbar" data-navbar>
                <button class="nav-close-btn" data-nav-close-btn aria-label="Close Menu">
                    <ion-icon name="close-outline"></ion-icon>
                </button>

                <a href="#" class="logo">
                    <img src="./assets/images/logo.svg" alt="PulsePath logo" />
                </a>

                <ul class="navbar-list">
                    <li class="navbar-item">
                        <a href="content/doctor.php" class="navbar-link"><strong>Doctors</strong></a>
                    </li>

                    <li class="navbar-item">
                        <a href="content/traffic.php" class="navbar-link"><strong>Traffic Control</strong></a>
                    </li>

                    <li class="navbar-item">
                        <a href="content/hospital.php" class="navbar-link"><strong>Hospitals</strong></a>
                    </li>
                    <li class="navbar-item">
                        <a href="content/mapnav.php" class="navbar-link"><strong>Map</strong></a>
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
                                <img src="assets/images/doc1.jpeg" alt="User Avatar" class="user-avatar" />
                                <div class="user-details">
                                    <p class="user-name">
                                        <?php echo $name; ?>
                                    </p>
                                </div>
                            </div>
                            <hr />
                            <a href="#">Information Page</a>
                            <hr />
                            <a href="#">Vehicle Information Page</a>
                            <hr />
                            <a href="#">Trips Page</a>
                            <hr />
                            <a href="content/user/logout.php">Logout</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- 
        - #HERO
      -->

    <section class="section hero">
        <div class="container">
            <h2 class="h1 hero-title">
                <strong>Emergency ?</strong>
            </h2>
            <form action="" method="POST">
                <button class="btn btn-primary" type="submit" name="submit" value="submit">
                    <span>CLICK HERE</span>
                    <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
                </button>
            </form>
        </div>
        <div class="ambulance-png">
            <img src="./assets/images/ambulance.png" alt="Ambulance Image" />
        </div>
    </section>

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
    <script src="./assets/js/script.js"></script>

    <!-- 
    - ionicon link
  -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>