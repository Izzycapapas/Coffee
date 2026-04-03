<!DOCTYPE html>
<html>
<head>
  <title>Login - Coffee Shop</title>
  <style>
    /* Gigamit nako imong original CSS style gikan sa register.php */
    * { box-sizing: border-box; font-family: Arial, sans-serif; }
    body { background: #a19a90; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
    form { background: #b7897b; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); width: 350px; }
    h2 { text-align: center; margin-bottom: 20px; color: #333; }
    label { display: block; margin-bottom: 5px; color: #555; font-weight: bold; }
    input { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px; }
    button { width: 100%; padding: 12px; background-color: #94865d; color: white; border: none; border-radius: 5px; cursor: pointer; }
    .error-msg { color: white; background: #ff4d4d; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center; font-size: 14px; }
    
    /* Bag-ong style para sa forgot password link */
    .forgot-link { display: block; text-align: right; font-size: 13px; color: #333; text-decoration: none; margin-top: -10px; margin-bottom: 15px; }
    .forgot-link:hover { text-decoration: underline; }
  </style>
</head>
<body>

<form action="login_process.php" method="POST">
  <h2>Login</h2>
  
  <?php if(isset($_GET['message'])): ?>
    <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center; border: 1px solid #c3e6cb;">
        <?php echo htmlspecialchars($_GET['message']); ?>
    </div>
  <?php endif; ?>

  <label>Username or Email</label>
  <input type="text" name="user_input" required>

  <label>Password</label>
  <input type="password" name="password" required>
  
  <a href="forgot_password.php" class="forgot-link">Forgot Password?</a>

  <button type="submit">Login</button>
  <p style="text-align:center; font-size: 13px;"> Create account? <a href="register.php" style="color: #333;">Register here</a></p>
</form>

</body>
</html>