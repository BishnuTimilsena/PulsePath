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
    <?php include 'navbar/navbar.php'; ?>

    <!-- Doctor Section -->
    <section class="doctors-section">
        <h3>Doctors</h3>
        <div class="doctors-container">
            <div class="doctor-card" onclick="showDoctorInfo('Dr. Goddata Rai', 'Cardiologist', 'City Hospital', '123-456-7890', 'godatta@email.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id ultricies ligula. Fusce vel facilisis arcu. Sed finibus ipsum eu augue bibendum, ut tincidunt turpis malesuada. Sed et tristique libero. Etiam laoreet sem sit amet neque tincidunt, a eleifend enim cursus.')">
                <img src="../assets/images/doc1.jpeg" alt="Dr. Godatta Image" />
                <h2>Dr. Godatta Rai</h2>
                <p>Cardiologist</p>
            </div>

            <div class="doctor-card" onclick="showDoctorInfo('Dr. Sarmila Yadav', 'Orthopedic Surgeon', 'General Hospital', '987-654-3210', 'sarmila@email.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id ultricies ligula. Fusce vel facilisis arcu. Sed finibus ipsum eu augue bibendum, ut tincidunt turpis malesuada. Sed et tristique libero. Etiam laoreet sem sit amet neque tincidunt, a eleifend enim cursus.')">
                <img src="../assets/images/doc2.jpg" alt="Dr. Jane Smith Image" />
                <h2>Dr. Sarmila Yadav</h2>
                <p>Orthopedic Surgeon</p>
            </div>

            <div class="doctor-card" onclick="showDoctorInfo('Dr. Dipak Dahal', 'Pediatrician', 'Children\'s Hospital', '987-654-3210', 'dipak@email.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id ultricies ligula. Fusce vel facilisis arcu. Sed finibus ipsum eu augue bibendum, ut tincidunt turpis malesuada. Sed et tristique libero. Etiam laoreet sem sit amet neque tincidunt, a eleifend enim cursus.')">
                <img src="../assets/images/doc1.jpeg" alt="Dr. Alice Johnson Image" />
                <h2>Dr. Dipak Dahal</h2>
                <p>Pediatrician</p>
            </div>

            <div class="doctor-card" onclick="showDoctorInfo('Dr. Bhawana Regmi', 'Dermatologist', 'Skin Care Clinic', '123-456-7890', 'bhawana@email.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id ultricies ligula. Fusce vel facilisis arcu. Sed finibus ipsum eu augue bibendum, ut tincidunt turpis malesuada. Sed et tristique libero. Etiam laoreet sem sit amet neque tincidunt, a eleifend enim cursus.')">
                <img src="../assets/images/doc2.jpg" alt="Dr. Brian Miller Image" />
                <h2>Dr. Bhawana Regmi</h2>
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
</body>

</html>