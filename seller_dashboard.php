<?php
include 'auth_check.php'; // Siguroha nga naa kini nga file
checkLogin();             // I-check kung naka-login
restrictTo('seller');     // Siguroha nga seller ra ang makasulod
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard - Coffee Shop</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            display: flex;
        }

        /* Sidebar Style */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #3e2723; /* Coffee brown */
            color: white;
            padding: 20px;
            position: fixed;
        }

        .sidebar h2 {
            text-align: center;
            border-bottom: 1px solid #5d4037;
            padding-bottom: 15px;
        }

        .sidebar a {
            display: block;
            color: #d7ccc8;
            padding: 12px;
            text-decoration: none;
            margin-bottom: 5px;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background-color: #5d4037;
            color: white;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 40px;
            width: 100%;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .welcome-msg {
            font-size: 24px;
            color: #333;
        }

        /* Dashboard Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            text-align: center;
        }

        .card h3 {
            margin: 0;
            color: #777;
            font-size: 16px;
        }

        .card p {
            font-size: 32px;
            font-weight: bold;
            margin: 10px 0 0;
            color: #3e2723;
        }

        .btn-logout {
            background-color: #e53935;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-logout:hover {
            background-color: #c62828;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>☕ Brew Master</h2>
    <a href="seller_dashboard.php">Dashboard</a>
    <a href="manage_products.php">Manage Coffee Menu</a>
    <a href="view_orders.php">Customer Orders</a>
    <a href="profile.php">My Profile</a>
    <br><br>
    <a href="logout.php" style="color: #ff8a80;">Logout</a>
</div>

<div class="main-content">
    <div class="header">
        <div class="welcome-msg">
            Maayong Adlaw, <strong><?php echo $_SESSION['name']; ?></strong>!
        </div>
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>

    <div class="stats-container">
        <div class="card">
            <h3>Total Products</h3>
            <p>0</p> </div>
        <div class="card">
            <h3>New Orders</h3>
            <p>0</p>
        </div>
        <div class="card">
            <h3>Total Sales</h3>
            <p>₱0.00</p>
        </div>
    </div>

    <hr style="margin: 40px 0; border: 0; border-top: 1px solid #ccc;">

    <h3>Karon nga Adlaw</h3>
    <p>Wala pa'y aktibidad sa imong shop. Sugdi og butang imong mga kape sa "Manage Coffee Menu".</p>
</div>

</body>
</html>