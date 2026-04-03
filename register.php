<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <style>
    /* Basic reset */
    * {
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      background: #d7b99c;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    form {
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      width: 350px;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #b99898;
    }

    label {
      display: block;
      margin-bottom: 5px;
      color: #555;
      font-weight: bold;
    }

    input {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 14px;
    }

    input:focus {
      border-color: #007BFF;
      outline: none;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #a06012;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background-color: #837263;
    }

    .error {
      color: red;
      font-size: 13px;
      margin-top: -10px;
      margin-bottom: 10px;
      display: none;
    }
  </style>
</head>
<body>

<form id="registerForm" action="send.php" method="POST">
  <h2>Izzy's Coffee</h2>

  <label for="firstname">Firstname</label>
  <input type="text" id="firstname" name="firstname" required>

  <label for="lastname">Lastname</label>
  <input type="text" id="lastname" name="lastname" required>

  <label for="username">Username</label>
  <input type="text" id="username" name="username" required>

  <label for="email">Email</label>
  <input type="email" id="email" name="email" required>

  <label for="password">Password</label>
  <input type="password" id="password" name="password" required>

  <label for="confirm_password">Confirm Password</label>
  <input type="password" id="confirm_password" name="confirm_password" required>
  <div class="error" id="passwordError">Passwords do not match</div>
  
  <label for="role">Register as:</label>
<select name="role" id="role" style="width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
  <option value="customer">Customer</option>
  <option value="seller">Seller</option>
</select>
  <button type="submit">Register</button>
</form>

<script>
  const form = document.getElementById('registerForm');
  const password = document.getElementById('password');
  const confirmPassword = document.getElementById('confirm_password');
  const passwordError = document.getElementById('passwordError');

  form.addEventListener('submit', function(e) {
    if(password.value !== confirmPassword.value) {
      e.preventDefault();
      passwordError.style.display = 'block';
    } else {
      passwordError.style.display = 'none';
    }
  });
</script>

</body>
</html>