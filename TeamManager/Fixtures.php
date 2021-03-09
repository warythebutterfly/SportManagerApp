<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>
</head>
<body style="padding: 30px">
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="index.html">Home</a>
  <a href="squadmembers.html">Squad Members</a>
  <a href="addfixture.html">Add Fixture</a>
   <a href="../logout.php">Sign Out</a>
</div>
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>

<div class="row">
    <div class="col-sm-2"></div>
    
<div class="col-sm-10">
<h2>Fixtures</h2>
<div>
  <form action="#!">
              <div class="form-group">
                
                <label for="email">Home vs Away </label> <button type="button" name="sTeam" id="sTeam" class="form-control" >Select Team</button>
              </div>
              <div class="form-control">
              <label for="email">Date/ Time </label> <button type="button" name="vTeam" id="vTeam" class="form-control" >View Team</button>
              </div>
              <input name="login" id="login" class="btn btn-block login-btn" type="button" value="Login">
            </form>
</div>
   
</body>
</html> 
