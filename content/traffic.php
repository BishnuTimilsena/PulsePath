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
    require_once "../assets/Database/connection.php";
    $connection = new Connection();
    $user = $connection->get_user($uid);
    $name = $user['name'];

    $trafficPoliceData = $connection->getTrafficPoliceData();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
</head>

<body>
    <!-- 
    - #HEADER
  -->
  <?php include 'navbar/navbar.php'; ?>
    <!-- Traffic Office Table Section -->
    <section class="traffic-section">

        <h2>Traffic control offices</h2>
        <span>
            <p>For Emergency, Dial : 103</p>
        </span>
        <div class="traffic-table">
            <table>
                <tbody>
                    <tr>
                        <th>Office</th>
                        <th>Phone</th>
                    </tr>
                    <?php foreach ($trafficPoliceData as $trafficPolice) : ?>
                        <tr>
                            <td>
                                <?php echo $trafficPolice['office']; ?>
                            </td>
                            <td>
                                <?php echo $trafficPolice['phone']; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

    </section>

    <!-- 
    - #FOOTER
  -->
    <?php
    include 'footer/footer.php';
    ?>
</body>

</html>