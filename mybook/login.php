<html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fire Station Management</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color:whitesmoke;
    }

    .container {
      margin-top: 50px;
    }

    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      background-color: #fff;
    }

    .card-header {
      background-color:RED; /* Facebook blue color */
      color: #fff;
      border-bottom: none;
    }

    .card-body {
      padding: 20px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    button {
      background-color:#913831; /* Facebook blue color */
      color:#913831;
      border: none;
      border-radius: 5px;
      padding: 10px 15px;
      cursor: pointer;
    }

    .forgot-password-link {
      color: #1877f2; /* Facebook blue color */
      text-decoration: none;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="text-center">Fire Station Management</h3>
          </div>
          <div class="card-body">
            <form id="loginForm">
              <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
              </div>
              <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <button type="button" class="btn btn-block" onclick="authenticate()">Login</button>
              <p class="text-center mt-3">
                <a href="#" class="forgot-password-link" onclick="showForgotPassword()">Forgot Password?</a>
              </p>
            </form>

            <form id="forgotPasswordForm" style="display: none;">
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <button type="button" class="btn btn-block" onclick="sendResetLink()">Send Reset Link</button>
              <p class="text-center mt-3">
                <a href="#" class="forgot-password-link" onclick="showLoginForm()">Back to Login</a>
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function authenticate() {
      // Add authentication logic here
    }

    function showForgotPassword() {
      document.getElementById('loginForm').style.display = 'none';
      document.getElementById('forgotPasswordForm').style.display = 'block';
    }

    function showLoginForm() {
      document.getElementById('forgotPasswordForm').style.display = 'none';
      document.getElementById('loginForm').style.display = 'block';
    }

    function sendResetLink() {
      // Add logic to send password reset link (e.g., via email)
      alert('Reset link sent to the provided email address.');
    }
  </script>

</body>
</html>































