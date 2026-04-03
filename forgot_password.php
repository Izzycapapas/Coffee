<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password - Izzy's Coffee</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .container { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 100%; max-width: 400px; text-align: center; }
        input[type="email"] { width: 90%; padding: 10px; margin: 15px 0; border: 1px solid #ccc; border-radius: 5px; }
        button { background-color: #3e2723; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; width: 100%; font-weight: bold; }
        button:hover { background-color: #5d4037; }
    </style>
</head>
<body>

<div class="container">
    <h2>Forgot Password?</h2>
    <p>Enter your registered email address to receive a password reset link.</p>
    
    <form action="send_reset.php" method="POST">
        <input type="email" name="email" placeholder="Your Email Address" required>
        <button type="submit" name="reset_request">Send Reset Link</button>
    </form>
    
    <br>
    <a href="login.php" style="color: #777; text-decoration: none; font-size: 14px;">Back to Login</a>
</div>

</body>
</html>