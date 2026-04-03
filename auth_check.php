<?php
session_start();

// Function para i-check kung naka-login ba ang user
function checkLogin() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php?error=Palihug login una.");
        exit();
    }
}

// Function para i-restrict ang access base sa Role (Admin, Seller, o Customer)
function restrictTo($role) {
    if ($_SESSION['role'] !== $role) {
        echo "<h1 style='color:red;'>Access Denied!</h1>";
        echo "<p>Kini nga page para ra sa mga <strong>$role</strong>.</p>";
        echo "<a href='login.php'>Balik sa Login</a>";
        exit();
    }
}
?>