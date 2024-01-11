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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PulsePath</title>
    <!-- 
    - custom css link
  -->
    <link rel="stylesheet" href="../assets/CSS/style.css" />

    <!-- 
  - google font link
-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
</head>

<body>
  <?php include 'navbar/navbar.php'; ?>

    <!-- Hospital Table Section -->
    <section class="hospital-section">
        <div>

            <h2>Hospital Information</h2>
            <table class="hospital-table">

                <tbody>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                    </tr>
                    <?php
                    foreach ($hospitalData as $hospital) {
                        echo "<tr>";
                        echo "<td>{$hospital['name']}</td>";
                        echo "<td>{$hospital['phone']}</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- 
    - #FOOTER
  -->
    <?php
    include 'footer/footer.php';
    ?>
</body>

</html>