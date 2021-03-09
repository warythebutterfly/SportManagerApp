<?php 
session_start();

    include("C:/xampp/htdocs/sportmanagerapp/connection.php");
    include("C:/xampp/htdocs/sportmanagerapp/functions.php");

	$check_login = user_login_check($con);

?>
<!DOCTYPE html>
<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>
<style>
body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
</head>
<body style="padding: 30px">
<div class="alert">
</div>
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="index.php">Home</a>
  <a href="squadmembers.php">Squad Members</a>
  <a type="button" data-toggle="modal" data-target="#exampleModalCenter" href="#">Add Fixture</a>
   <a href="../logout.php">Sign Out</a>
</div>

<!-- Modal -->
<!-- <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Add Fixture</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <Form method="post">     
      <div class="modal-body" >
        <div class="row">
            <div class="col-md-4">Home Team</div>
      <div class="col-md-4 ml-auto"><input type="text" name="hTeam"></div>
        </div>
        <div class="row">
            <div class="col-md-4">Away Team</div>
      <div class="col-md-4 ml-auto"><input type="text" name="aTeam"></div>
        </div>
        <div class="row">
            <div class="col-md-4">Date/Time</div>
      <div class="col-md-4 ml-auto"><input type="date" name="datetime"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="btnSetUpFixture" class="btn btn-primary">Set Up Fixture</button>
      </div>
      </Form>
      
    </div>
  </div>
</div>

 -->

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalCenterTitle">Add Fixture</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post">
     <div class="modal-body">     
      <div class="form-group">
       <label>Home Team</label>
       <input type="name" class="form-control" name="homeT" required>
      </div>
      <div class="form-group">
       <label>Away Team</label>
       <input type="name" class="form-control" name="awayT" required>
      </div>
      <div class="form-group">
       <label>Date</label>
       <input type="date" class="form-control" name="date" required></input>
      </div>
      <div class="form-group">
       <label>Time</label>
       <input type="time" class="form-control" name="time"  required>
      </div>     
     </div>
     <div class="modal-footer">
      <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
      <input type="submit" class="btn btn-success" name="add" value="Submit Fixture">
     </div>
    </form>
      
    </div>
  </div>
</div>




<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>

<div class="row">
  
    <div class="col-sm-2"></div>
    
<div class="col-sm-10">
<h2>Fixtures</h2>
<br>



           
                 <div class="row">

            <div class="col-md-3"><p>Home Vs Away</p></div>
            <div class="col-md-3">Date/Time</div>
            <div class="col-md-3"><button type="button" class="btn btn-primary">Select Team</button></div>
      <div class="col-md-3 ml-auto"><button type="button" class="btn btn-primary">Team Selected </button></div>

        </div>
                

</div>
</div>

   
</body>
</html> 