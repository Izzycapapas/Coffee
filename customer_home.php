<?php
include 'auth_check.php';
checkLogin(); 
restrictTo('customer'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop - Welcome</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            background-color: #fdfaf6;
        }

        /* Navigation Bar */
        .navbar {
            background-color: #3e2723;
            color: white;
            padding: 15px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: #d7ccc8;
            text-decoration: none;
            margin-left: 20px;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), 
                        url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }

        /* Product Grid */
        .container {
            padding: 40px 50px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }

        .product-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-info {
            padding: 15px;
        }

        .price {
            color: #5d4037;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .order-btn {
            background-color: #795548;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .order-btn:hover {
            background-color: #3e2723;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <h2>☕ Izzy's Coffee</h2>
    <div>
        <span>Welcome, <?php echo $_SESSION['name']; ?>!</span>
        <a href="customer_orders.php">My Orders</a>
        <a href="logout.php" style="color: #ff8a80;">Logout</a>
    </div>
</nav>

<div class="hero">
    <h1>Presko nga Kape, Para sa Imong Adlaw</h1>
    <p>Pili lang sa among mga premium coffee blends.</p>
</div>

<div class="container">
    <h3>Available Coffee</h3>
    
    <div class="product-grid">
        <div class="product-card">
            <img src="https://images.unsplash.com/photo-1541167760496-162955ed8a9f?auto=format&fit=crop&w=300&q=80" alt="Coffee" style="width:100%">
            <div class="product-info">
                <h4>Caramel Macchiato</h4>
                <p style="font-size: 0.9rem; color: #666;">Rich espresso with caramel syrup and steamed milk.</p>
                <div class="price">₱120.00</div>
                <button class="order-btn">Order Now</button>
            </div>
        </div>

        <div class="product-card">
            <img src="https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=300&q=80" alt="Coffee" style="width:100%">
            <div class="product-info">
                <h4>Classic Brewed</h4>
                <p style="font-size: 0.9rem; color: #666;">Pure Arabica beans brewed to perfection.</p>
                <div class="price">₱85.00</div>
                <button class="order-btn">Order Now</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>