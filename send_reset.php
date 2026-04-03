<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

$conn = new mysqli('localhost', 'root', '', 'user_registration');

if (isset($_POST['reset_request'])) {
    $email = trim($_POST['email']);
    $token = bin2hex(random_bytes(16)); // Random secret token
    $expire = date("Y-m-d H:i:s", strtotime("+1 hour")); // Expire human sa 1 hour

    // Check kung ang email nag-exist sa database
    $stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // I-save ang token ug expiry sa database
        $update = $conn->prepare("UPDATE users SET reset_token=?, reset_token_expire=? WHERE email=?");
        $update->bind_param("sss", $token, $expire, $email);
        $update->execute();

        // I-send ang Reset Link pinaagi sa Email
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'capapasizzy@gmail.com'; 
            $mail->Password = 'aztc mhxx logw canh'; 
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('capapasizzy@gmail.com', "Izzy's Coffee Support");
            $mail->addAddress($email);
            $mail->isHTML(true);

            $reset_link = "http://localhost/CPHPMAILER/phpmailer/reset_password.php?email=$email&token=$token";

            $mail->Subject = "Password Reset Request";
            $mail->Body = "
                <h2>Reset Password</h2>
                <p>Click the link to create new password.</p>
                <br>
                <a href='$reset_link' style='padding:10px 20px; background:#3e2723; color:white; text-decoration:none; border-radius:5px;'>RESET PASSWORD</a>
            ";

            $mail->send();
            echo "<script>alert('Reset link sent to your email!'); window.location.href='login.php';</script>";
        } catch (Exception $e) {
            echo "Failed to send email. Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "<script>alert('Email not found in our system.'); window.location.href='forgot_password.php';</script>";
    }
}
?>