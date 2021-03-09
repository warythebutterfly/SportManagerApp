<?php 
session_start();

	include("connection.php");
	include("functions.php");

  $user_Registeration = signup_data($con);
  

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login Template</title>
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
            <h1 class="login-title">Sign Up As A Team Manager</h1>
            <form  method="post">
              <div class="form-group">
                <label for="firstname">Firstname</label>
                <input type="name" name="firstname" id="firstname" class="form-control" placeholder="enter your firstname">
              </div>
              <div class="form-group">
                <label for="lastname">Lastname</label>
                <input type="name" name="lastname" id="lastname" class="form-control" placeholder="enter your lastname">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="email@example.com">
              </div>
              
              <div class="form-group mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="enter your passsword">
                <input type="hidden" name="roleid" value="1" class="form-control">
              </div>

              <input  id="signup" class="btn btn-block login-btn" type="submit" value="Signup">
            </form>
            <a href="login.php" class="text-reset">Already have an account? Login here</a>
           <!--  <a href="#!" class="forgot-password-link">Forgot password?</a> -->
            <!-- <p class="login-wrapper-footer-text">Dont have an account?<br> <a href="#!" class="text-reset">Register here as a team manager</a><br><a href="#!" class="text-reset">Register here as a squad member</a></p> -->
          </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="assets/images/loginImage.png" alt="login image" class="login-img">
        </div>
      </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
      $("signup").click(function(){
        $("#flash-msg").fadeOut(3000);
    });
  });
</script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
