<?php
session_start();
$error = "";

// show errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_SESSION['uid'])) {
    header("Location: /index.php");
} else {


    if (isset($_POST['submit'])) {

        $name = $_POST['name'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $paddress = $_POST['paddress'];
        $taddress = $_POST['taddress'];
        $phone = $_POST['phone'];
        $license = $_POST['license'];
        $ambulance_no = $_POST['ambulance_no'];
        $issue_date = $_POST['issue_date'];
        $organization = $_POST['organization'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];


        if (empty($name) || empty($dob) || empty($gender) || empty($paddress) || empty($taddress) || empty($phone) || empty($license) || empty($ambulance_no) || empty($issue_date) || empty($organization) || empty($password) || empty($confirmpassword)) {
            $error = "Please fill all the fields";
        }

        //form validation

        //name validation (Format: First Middle Last)
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $error = "Only letters and white space allowed";
        }

        //phone validation (Format: 98|97XXXXXXXX)
        if (!preg_match("/^[9][7-8][0-9]{8}$/", $phone)) {
            $error = "Invalid Phone Number";
        }

        //license validation (Format: 01-01-01-00000000)
        // if (!preg_match("/^[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{8}$/", $license)) {
        //     $error = "Invalid License Number";
        // }

        //organization validation (Format: alphabets only)
        if (!preg_match("/^[a-zA-Z ]*$/", $organization)) {
            $error = "Only letters and white space allowed";
        }





        if ($password != $confirmpassword) {
            $error = "Password does not match";
        }
        if (empty($error)) {
            include "verify-license.php";
        }

        if (empty($error)) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            require_once "../../assets/Database/connection.php";
            $connection = new Connection();
            $connection->signup($name, $dob, $gender, $paddress, $taddress, $phone, $license, $ambulance_no, $issue_date, $organization, $password);
            echo '<script type="text/javascript">
                    alert("Successfully Signed up");
                    document.querySelector("form").reset()
                </script>';
            header("Location:./login.php");
            die();
        }
    }
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
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <!-- 
  - google font link
-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <!-- Nepali Datepicker -->
    <link href="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/css/nepali.datepicker.v4.0.1.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container">
        <header>Signup Form</header>
        <div class="progress-bar">
            <div class="step">
                <p>Name</p>
                <div class="bullet">
                    <span>1</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
            <div class="step">
                <p>Contact</p>
                <div class="bullet">
                    <span>2</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
            <div class="step">
                <p>License</p>
                <div class="bullet">
                    <span>3</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
            <div class="step">
                <p>Submit</p>
                <div class="bullet">
                    <span>4</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
        </div>
        <div class="form-outer">
            <form action="" method="POST">
                <div class="page slide-page">
                    <div class="title">Basic Info :</div>
                    <div class="field">
                        <div class="label">Full Name</div>
                        <input type="text" name="name" />
                    </div>
                    <div class="field">
                        <div class="label">Date of Birth</div>
                        <input type="text" id="nepali-datepicker" name="dob" />
                    </div>
                    <div class="field">
                        <div class="label">Gender</div>
                        <select name="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div>
                        <p style="color: red;">
                            <?php echo $error; ?>
                        </p>
                    </div>
                    <div class="field">
                        <button class="firstNext next">Next</button>
                    </div>
                </div>
                <div class="page">
                    <div class="title">Contact Info :</div>
                    <div class="field">
                        <div class="label">Permanent Address</div>
                        <input type="text" name="paddress" />
                    </div>
                    <div class="field">
                        <div class="label">Temporary Address</div>
                        <input type="text" name="taddress" />
                    </div>
                    <div class="field">
                        <div class="label">Phone Number</div>
                        <input type="number" name="phone" />
                    </div>
                    <div>
                        <p style="color: red;">
                            <?php echo $error; ?>
                        </p>
                    </div>
                    <div class="field btns">
                        <button class="prev-1 prev">Previous</button>
                        <button class="next-1 next">Next</button>
                    </div>
                </div>
                <div class="page">
                    <div class="title">License Info :</div>
                    <div class="field">
                        <div class="label" id="licno">License No</div>
                        <input type="text" name="license" />
                    </div>
                    <div class="field">
                        <div class="label" id="ambulance">Ambulance No</div>
                        <input type="text" name="ambulance_no" />
                    </div>
                    <div class="field">
                        <div class="label" id="isd">Issued Date</div>
                        <input type="date" name="issue_date" />
                    </div>
                    <div>
                        <p style="color: red;">
                            <?php echo $error; ?>
                        </p>
                    </div>
                    <div class="field btns">
                        <button class="prev-2 prev">Previous</button>
                        <button class="next-2 next">Next</button>
                    </div>
                </div>
                <div class="page">
                    <div class="title">Login Details:</div>
                    <div class="field">
                        <div class="label" id="org">Organization Name</div>
                        <input type="text" name="organization" />
                    </div>
                    <div class="field">
                        <div class="label">Create Password :</div>
                        <input type="password" name="password" />
                    </div>
                    <div class="field">
                        <div class="label">Confirm Password :</div>
                        <input type="password" name="confirmpassword" />
                    </div>
                    <div>
                        <p style="color: red;">
                            <?php echo $error; ?>
                        </p>
                    </div>
                    <div class="field btns">
                        <button class="prev-3 prev">Previous</button>
                        <button class="submit" name="submit">Submit</button>
                    </div>
                </div>
            </form>
            <p>
                Already have an account ?
                <a href="login.php">Login Here</a>
            </p>
        </div>
    </div>
    <script src="script.js"></script>
    <script src="https://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v4.0.1.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        window.onload = function() {
            var mainInput = document.getElementById("nepali-datepicker");
            mainInput.nepaliDatePicker();
        };
    </script>
</body>

</html>