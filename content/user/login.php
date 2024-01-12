<?php

session_start();
$error = "";

// show errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_SESSION['uid'])) {
   header("Location: ../../index.php");
} else {
   if (isset($_POST['submit'])) {
      $phone = $_POST['phone'];
      $password = $_POST['password'];

      if (empty($phone) || empty($password)) {
         $error = "Please fill all the fields";
      }

      if (empty($error)) {
         require_once "../../assets/Database/connection.php";
         $connection = new Connection();
         $error = $connection->login($phone, $password);
      }
   }
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
   <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

   <!-- 
  - google font link
-->
   <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
   <script src="https://kit.fontawesome.com/a81368914c.js"></script>
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
   <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
</head>

<body>
   <div class="container">
      <header>Login Form</header>
      <div class="form-outer">
         <form action="" method="POST">
            <div class="page slide-page">
               <div class="field">
                  <div class="label" id="org">
                     Phone Number
                  </div>
                  <input type="text" name="phone">
               </div>
               <div class="field">
                  <div class="label">
                     Password
                  </div>
                  <input type="password" name="password">
               </div>
               <div>
                  <p style="color: red;"><?php echo $error; ?></p>
               </div>
               <div class="field btns">
                  <button class="submit" name="submit">Submit</button>
               </div>
            </div>
         </form>
         <p>Don't have an account ? <a href="signup.php">SignUp Here</a></p>
      </div>
   </div>
   <script src="script.js"></script>
</body>

</html>