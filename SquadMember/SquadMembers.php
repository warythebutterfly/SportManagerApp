<?php 
session_start();

include("C:/xampp/htdocs/sportmanagerapp/connection.php");
include("C:/xampp/htdocs/sportmanagerapp/functions.php");

  $result = mysqli_query($con,"SELECT * FROM users WHERE Roleid = 2"  );

	$check_login = user_login_check($con);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

/*tr:nth-child(even) {
  background-color: #dddddd;
}
tr:nth-child(odd) {
  background-color: #dddddd;
}*/

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

    <div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="index.php">Home</a>
  <a href="squadmembers.php">Squad Members</a>
 
   <a href="../logout.php">Sign Out</a>
   </div>

<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>


    <div class="row">
    <div class="col-sm-2"></div>
    
<div class="col-sm-10">
<h2>List of All Squad Members</h2>

<table>
  <tr>
    <th>FirstName</th>
    <th>LastName</th>
    <th>Email</th>
    <!-- <th>IsAvailable</th> -->
  </tr>
  <tr>
  <?php while($row = mysqli_fetch_array($result) )
                {
                ?>
    <td><?php echo $row["FirstName"]; ?></td>
    <td><?php echo $row["LastName"]; ?></td>
    <td><?php echo $row["Email"]; ?></td>
    <!-- <td><?php //echo $row["isActive"]; ?></td> -->
  </tr>
  <?php }  ?>
    <?php
     // close connection database
     mysqli_close($con);
                ?>
</table>
</div>
    </div>
</body>
</html>
