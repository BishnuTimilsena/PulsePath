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

<body id="top" class="blob-page">
    <!-- 
    - #HEADER
  -->
    <?php include 'content/navbar/navbar.php'; ?>

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
    <?php
    include 'content/footer/footer.php';
    ?>
</body>

</html>