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

    $doctorData = $connection->getDoctorsData();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PulsePath</title>
    <!-- 
    - custom css link
  -->
    <link rel="stylesheet" href="../assets/CSS/style.css" />
    <!-- Favicon -->
    <link rel="icon" href="../img/core-img/favicon.png" />
    <!-- 
  - google font link
-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
</head>

<body>
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
                        <a href="mapnav.php" class="navbar-link"><strong>Map</strong></a>
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

    <!-- Doctor Section -->
    <section class="doctors-section">
        <h3>Doctors</h3>
        <div class="doctors-container">
            <div class="doctor-card" onclick="showDoctorInfo('Dr. John Doe', 'Cardiologist', 'City Hospital', '123-456-7890', 'john.doe@email.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id ultricies ligula. Fusce vel facilisis arcu. Sed finibus ipsum eu augue bibendum, ut tincidunt turpis malesuada. Sed et tristique libero. Etiam laoreet sem sit amet neque tincidunt, a eleifend enim cursus.')">
                <img src="../assets/images/doc1.jpeg" alt="Dr. John Doe Image" />
                <h2>Dr. John Doe</h2>
                <p>Cardiologist</p>
            </div>

            <div class="doctor-card" onclick="showDoctorInfo('Dr. Jane Smith', 'Orthopedic Surgeon', 'General Hospital', '987-654-3210', 'jane.smith@email.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id ultricies ligula. Fusce vel facilisis arcu. Sed finibus ipsum eu augue bibendum, ut tincidunt turpis malesuada. Sed et tristique libero. Etiam laoreet sem sit amet neque tincidunt, a eleifend enim cursus.')">
                <img src="../assets/images/doc2.jpg" alt="Dr. Jane Smith Image" />
                <h2>Dr. Jane Smith</h2>
                <p>Orthopedic Surgeon</p>
            </div>

            <div class="doctor-card" onclick="showDoctorInfo('Dr. Alice Johnson', 'Pediatrician', 'Children\'s Hospital', '987-654-3210', 'alice.johnson@email.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id ultricies ligula. Fusce vel facilisis arcu. Sed finibus ipsum eu augue bibendum, ut tincidunt turpis malesuada. Sed et tristique libero. Etiam laoreet sem sit amet neque tincidunt, a eleifend enim cursus.')">
                <img src="../assets/images/doc1.jpeg" alt="Dr. Alice Johnson Image" />
                <h2>Dr. Alice Johnson</h2>
                <p>Pediatrician</p>
            </div>

            <div class="doctor-card" onclick="showDoctorInfo('Dr. Brian Miller', 'Dermatologist', 'Skin Care Clinic', '123-456-7890', 'brian.miller@email.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id ultricies ligula. Fusce vel facilisis arcu. Sed finibus ipsum eu augue bibendum, ut tincidunt turpis malesuada. Sed et tristique libero. Etiam laoreet sem sit amet neque tincidunt, a eleifend enim cursus.')">
                <img src="../assets/images/doc2.jpg" alt="Dr. Brian Miller Image" />
                <h2>Dr. Brian Miller</h2>
                <p>Dermatologist</p>
            </div>
            <?php

            //foreach ($doctorData as $doctor) {
            //    echo "<div class='doctor-card' onclick=\"showDoctorInfo('{$doctor['name']}', '{$doctor['specialization']}', '{$doctor['hospital']}', '{$doctor['phone']}', '{$doctor['email']}', '{$doctor['description']}')\">";
            //    echo "<img src='../assets/images/doc1.jpeg' alt='{$doctor['name']} Image' />";
            //    echo "<h2>{$doctor['name']}</h2>";
            //    echo "<p>{$doctor['specialization']}</p>";
            //    echo "</div>";
            //}

            ?>
            <div class="doctor-info-box" id="doctorInfoBox">
                <span class="close-btn" onclick="hideDoctorInfo()">&times;</span>
                <h2 id="doctorName"></h2>
                <p id="doctorDesignation"></p>
                <p id="doctorHospital"></p>
                <p id="doctorPhoneNumber"></p>
                <p id="doctorEmail"></p>
                <p id="doctorDescription"></p>
            </div>
        </div>
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

    <!-- 
  - ionicon link
-->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>