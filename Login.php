<?php 

  session_start();

	include("connection.php");
	include("functions.php");

  $user_Login = login_data($con);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
  <main>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 login-section-wrapper">
          
          <div class="login-wrapper my-auto">
            <h1 class="login-title">Log in</h1>
            <form method="post">
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="email@example.com">
              </div>
              <div class="form-group mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="enter your passsword">
                
              </div>
              <div class="form-group mb-4">
              <label for="password">Remember Me</label>
                <input type="checkbox" name="remember" value="1" class="checkbox" placeholder="enter your passsword">
              </div>
              <input name="login" id="login" class="btn btn-block login-btn" type="submit" value="Login">
            </form>
            <?php
              if(isset($_COOKIE['email']) and isset($_COOKIE['password'])){
                $email = $_COOKIE['email'];
                $pass = $_COOKIE['password'];
                echo "<script>
                  document.getElementById('email').value = '$email';
                  document.getElementById('password').value = '$pass';
            
                </script>";
              }
            ?>
           <!--  <a href="#!" class="forgot-password-link">Forgot password?</a> -->
            <p class="login-wrapper-footer-text">Don't have an account?<br> <a href="managersignup.php" class="text-reset">Register here as a team manager</a><br><a href="membersignup.php" class="text-reset">Register here as a squad member</a></p>
          </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="assets/images/loginImage.png" alt="login image" class="login-img">
        </div>
      </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
