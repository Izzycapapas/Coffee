<?php
// Database connection
$host = 'localhost';
$db   = 'user_registration';
$user = 'root';
$pass = ''; 
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['email']) && isset($_GET['v_code'])) {
    $email = $_GET['email'];
    $v_code = $_GET['v_code'];

    // I-check kung tinuod ba ang email ug verification code
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND v_code=?");
    $stmt->bind_param("ss", $email, $v_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // I-update ang is_verified status ngadto sa 1
        $update = $conn->prepare("UPDATE users SET is_verified = 1 WHERE email=?");
        $update->bind_param("s", $email);
        
        if ($update->execute()) {
            // Mao ni ang imong gusto: naay klaro nga link padulong sa login page
            echo "<div style='text-align:center; margin-top:50px; font-family:Arial;'>";
            echo "<h1>Verified</h1>";
            echo "<p>Verification Successful</p>";
            echo "<br>";
            echo "<a href='login.php' style='padding:12px 25px; background-color:#3e2723; color:white; text-decoration:none; border-radius:5px; font-weight:bold;'>Proceed to Login</a>";
            echo "</div>";
        }
    } else {
        echo "<div style='text-align:center; margin-top:50px; font-family:Arial;'>";
        echo "<h1 style='color:red;'>Invalid Link!</h1>";
        echo "<p>Kini nga verification link dili na pwede o sayop ang impormasyon.</p>";
        echo "<a href='register.php'>Balik sa Register</a>";
        echo "</div>";
    }
} else {
    header("Location: login.php"); // I-redirect sa login kung walay data nadawat
    exit();
}
?>