<?php

class Connection
{
    public $pdo = null;

    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=pulsepath001;charset=utf8mb4", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
        } catch (PDOException $e) {
            die("ERROR: Could not connect. " . $e->getMessage());
        }
    }

    public function __destruct()
    {
        $this->pdo = null;
    }

    public function users()
    {
        $statement = $this->pdo->prepare("CREATE TABLE IF NOT EXISTS users (
            uid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            password varchar(255) NOT NULL,
            phone varchar(50) NOT NULL,
            gender varchar(50) NOT NULL,
            dob DATE NOT NULL,
            paddress varchar(255) NOT NULL,
            taddress varchar(1255) NOT NULL,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )");

        return $statement->execute();
    }

    public function signup($name, $dob, $gender, $paddress, $taddress, $phone, $license, $ambulance_no, $issue_date, $organization, $password)
    {
        $connection = new Connection();
        $connection->signup_users($name, $password, $phone, $gender, $dob, $paddress, $taddress);
        $connection->add_license($license, $issue_date);
        $connection->add_ambulance($ambulance_no, $organization);
    }

    public function signup_users($name, $password, $phone, $gender, $dob, $paddress, $taddress)
    {
        $statement = $this->pdo->prepare("INSERT INTO users(name,password,phone, gender, dob, paddress, taddress) 
        VALUES(:name,:password, :phone,:gender,:dob,:paddress,:taddress)");

        return $statement->execute([
            ':name' => $name,
            ':password' => $password,
            ':phone' => $phone,
            ':gender' => $gender,
            ':dob' => $dob,
            ':paddress' => $paddress,
            ':taddress' => $taddress

        ]);
    }

    public function license()
    {
        $statement = $this->pdo->prepare("CREATE TABLE IF NOT EXISTS license (
            uid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            lisence VARCHAR(100) NOT NULL,
            issue_date DATE NOT NULL,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )");

        return $statement->execute();
    }

    public function add_license($lisence, $issue_date)
    {
        $statement = $this->pdo->prepare("INSERT INTO license(lisence,issue_date) 
        VALUES(:lisence,:issue_date)");

        return $statement->execute([
            ':lisence' => $lisence,
            ':issue_date' => $issue_date
        ]);
    }

    public function ambulance()
    {
        $statement = $this->pdo->prepare("CREATE TABLE IF NOT EXISTS ambulance (
            uid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            ambulance_no VARCHAR(255) NOT NULL,
            organization VARCHAR(255) NOT NULL,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )");

        return $statement->execute();
    }

    public function add_ambulance($ambulance_no, $organization)
    {
        $statement = $this->pdo->prepare("INSERT INTO ambulance(ambulance_no,organization) 
        VALUES(:ambulance_no,:organization)");

        return $statement->execute([
            ':ambulance_no' => $ambulance_no,
            ':organization' => $organization
        ]);
    }

    public function hospital()
    {
        $statement = $this->pdo->prepare("CREATE TABLE IF NOT EXISTS hospital (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        phone VARCHAR(50) NOT NULL,
        date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        return $statement->execute();
    }

    public function getHospitalData()
    {
        $statement = $this->pdo->prepare("SELECT * FROM hospital order by name asc");
        $statement->execute();
        $hospitalData = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $hospitalData;
    }

    public function traffic_police()
    {
        $statement = $this->pdo->prepare("CREATE TABLE IF NOT EXISTS traffic_police (
        id INT AUTO_INCREMENT PRIMARY KEY,
        office VARCHAR(255) NOT NULL,
        phone VARCHAR(50) NOT NULL,
        date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        return $statement->execute();
    }

    public function getTrafficPoliceData()
    {
        $statement = $this->pdo->prepare("SELECT * FROM traffic_police order by office asc");
        $statement->execute();
        $trafficPoliceData = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $trafficPoliceData;
    }

    public function doctors()
    {
        $statement = $this->pdo->prepare("CREATE TABLE IF NOT EXISTS doctors (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        specialization VARCHAR(255) NOT NULL,
        hospital VARCHAR(255) NOT NULL,
        phone VARCHAR(15) NOT NULL,
        email VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        return $statement->execute();
    }

    public function getDoctorsData()
    {
        $statement = $this->pdo->prepare("SELECT * FROM doctors order by name asc");
        $statement->execute();
        $doctorsData = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $doctorsData;
    }

    public function login($phone, $password)
    {
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE phone = :phone");
        $statement->execute([
            ':phone' => $phone
        ]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['uid'] = $user['uid'];
                header("Location: ../../index.php");
                exit();
            } else {
                $error = "Password does not match";
                return $error;
            }
        } else {
            $error = "User does not exist";
            return $error;
        }
    }

    public function get_user($uid)
    {
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE uid = :uid");
        $statement->execute([
            ':uid' => $uid
        ]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
}

$connection = new Connection();
$connection->users();
$connection->license();
$connection->ambulance();
$connection->hospital();
$connection->traffic_police();
$connection->doctors();
