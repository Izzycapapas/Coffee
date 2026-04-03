<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

// Database connection
$host = 'localhost';
$db   = 'user_registration';
$user = 'root';
$pass = ''; 
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect data gikan sa form
$role = isset($_POST['role']) ? $_POST['role'] : 'customer'; 
$firstname = trim($_POST['firstname']);
$lastname = trim($_POST['lastname']);
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Set status: Customer is approved, Seller is pending
$status = ($role == 'customer') ? 'approved' : 'pending';

if ($password !== $confirm_password) {
    die("Passwords do not match.");
}

// Hash password ug generate verification code
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$v_code = bin2hex(random_bytes(16)); 

// Check if exists na ang user
$stmt = $conn->prepare("SELECT id FROM users WHERE username=? OR email=?");
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    die("Username or Email already exists.");
}
$stmt->close();

// INSERT sa database (Gi-apil na ang role, status, ug v_code)
$stmt = $conn->prepare("INSERT INTO users (firstname, lastname, username, email, password, role, status, v_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $firstname, $lastname, $username, $email, $hashedPassword, $role, $status, $v_code);

if($stmt->execute()) {
    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'capapasizzy@gmail.com'; 
        $mail->Password = 'aztc mhxx logw canh'; 
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('capapasizzy@gmail.com','Izzy Coffee Shop');
        $mail->addAddress($email);
        $mail->isHTML(true);

        // Ang link (Gisunod ang imong folder structure: CPHPMAILER/phpmailer/)
        $verify_link = "http://localhost/CPHPMAILER/phpmailer/verify.php?email=$email&v_code=$v_code";

        if ($role === 'customer') {
            $mail->Subject = "Verify Your Account - Izzy's Coffee";
            $mail->Body = "
                <h2>Welcome to Izzy's Coffee, $firstname!</h2>
                <p>Salamat sa pag-register. Please verify your email address.</p>
                <br>
                <a href='$verify_link' style='padding:10px 20px; background:#3e2723; color:white; text-decoration:none; border-radius:5px;'>VERIFY YOUR EMAIL</a>";
        } else {
            $mail->Subject = "Seller Application - Verification Required";
            $mail->Body = "
                <h2>Hello, $firstname!</h2>
                <p>Application received. Wait for  the approval from Admin.</p>
                <br>
                <a href='$verify_link' style='padding:10px 20px; background:#3e2723; color:white; text-decoration:none; border-radius:5px;'>I-VERIFY IMONG EMAIL</a>";
        }

        $mail->send();
        header("Location: verify_notice.php?message=Registration successful! Please check your email to verify your account.");
        exit();

    } catch (Exception $e) {
        echo "Registered successfully, but email failed: {$mail->ErrorInfo}";
    }
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>