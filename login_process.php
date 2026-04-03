<?php
session_start();

// Database connection
$host = 'localhost';
$db   = 'user_registration';
$user = 'root';
$pass = ''; 
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_input = trim($_POST['user_input']);
    $password = $_POST['password'];

    // Pangitaon ang user sa database (check username or email)
    $stmt = $conn->prepare("SELECT id, firstname, password, role, status FROM users WHERE username=? OR email=?");
    $stmt->bind_param("ss", $user_input, $user_input);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // I-verify ang hashed password
        if (password_verify($password, $user['password'])) {
            
        if ($user['is_verified'] == 0) {
        header("Location: login.php?error=Palihug i-verify una ang imong email sa dili pa mo-login.");
        exit();
    }
            // CHECK STATUS: Kung pending pa, dili pasudlon
            if ($user['status'] === 'pending') {
                header("Location: login.php?error=Your account is still pending for admin approval.");
                exit();
            } elseif ($user['status'] === 'rejected') {
                header("Location: login.php?error=Sorry, your application was rejected.");
                exit();
            }

            // KUNG APPROVED: Maghimo og Session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['firstname'];
            $_SESSION['role'] = $user['role'];

            // Redirect base sa role
            if ($user['role'] === 'seller') {
                header("Location: seller_dashboard.php");
            } else {
                header("Location: customer_home.php");
            }
            exit();

        } else {
            header("Location: login.php?error=Incorret password.");
            exit();
        }
    } else {
        header("Location: login.php?error=User not found.");
        exit();
    }
}
?>