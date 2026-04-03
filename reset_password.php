<?php
$conn = new mysqli('localhost', 'root', '', 'user_registration');

if (isset($_GET['email']) && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];
    $current_time = date("Y-m-d H:i:s");

    // I-check kung valid ba ang token ug wala pa ba na-expire
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND reset_token=? AND reset_token_expire > ?");
    $stmt->bind_param("sss", $email, $token, $current_time);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die("Invalid o expired na ang reset link. Palihug pag-request og bag-o.");
    }
}

if (isset($_POST['update_password'])) {
    $new_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    // I-update ang password ug papason ang token para dili na magamit pag-usab
    $update = $conn->prepare("UPDATE users SET password=?, reset_token=NULL, reset_token_expire=NULL WHERE email=?");
    $update->bind_param("ss", $new_pass, $email);
    
    if ($update->execute()) {
        echo "<script>alert('Password updated successfully!'); window.location.href='login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password - Izzy's Coffee</title>
    <style>
        body { font-family: Arial; background: #a19a90; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        form { background: #b7897b; padding: 30px; border-radius: 10px; width: 350px; text-align: center; }
        input { width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 5px; border: 1px solid #ccc; }
        button { width: 100%; padding: 12px; background: #3e2723; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; }
    </style>
</head>
<body>

<form method="POST">
    <h2> New Password</h2>
    <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email']); ?>">
    <label style="display:block; text-align:left; margin-bottom:5px;">Type your new password:</label>
    <input type="password" name="password" placeholder="New Password" required minlength="6">
    <button type="submit" name="update_password">Update Password</button>
</form>

</body>
</html>