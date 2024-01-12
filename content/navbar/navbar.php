<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PulsePath</title>
     <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="/PulsePath/assets/CSS/style.css" />

<!-- 
- google font link
-->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@300;400;500;600;700&display=swap"
    rel="stylesheet" />
</head>
<body>
        <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
        <div class="container">
            <div class="overlay" data-overlay></div>

            <a href="/PulsePath/index.php" class="logo">
                <img src="/PulsePath/assets/images/logo.svg" width="250px" alt="PulsePath logo" />
            </a>

            <button class="nav-open-btn" data-nav-open-btn aria-label="Open Menu">
                <ion-icon name="menu-outline"></ion-icon>
            </button>

            <nav class="navbar" data-navbar>
                <button class="nav-close-btn" data-nav-close-btn aria-label="Close Menu">
                    <ion-icon name="close-outline"></ion-icon>
                </button>

                <a href="/PulsePath/index.php" class="logo">
                    <img src="/PulsePath/assets/images/logo.svg" alt="PulsePath logo" />
                </a>

                <ul class="navbar-list">
                    <li class="navbar-item">
                        <a href="/PulsePath/content/doctor.php" class="navbar-link"><strong>Doctors</strong></a>
                    </li>

                    <li class="navbar-item">
                        <a href="/PulsePath/content/traffic.php" class="navbar-link"><strong>Traffic Control</strong></a>
                    </li>

                    <li class="navbar-item">
                        <a href="/PulsePath/content/hospital.php" class="navbar-link"><strong>Hospitals</strong></a>
                    </li>
                    <li class="navbar-item">
                        <a href="/PulsePath/content/mapnav.php" class="navbar-link"><strong>Map</strong></a>
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
                                <img src="/PulsePath/assets/images/doc1.jpeg" alt="User Avatar" class="user-avatar" />
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
                            <a href="/PulsePath/content/user/logout.php">Logout</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </header>  <!-- 
    - custom js link
  -->
    <script src="/PulsePath/assets/js/script.js"></script>

    <!-- 
    - ionicon link
  -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<!-- 
- ionicon link
-->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>