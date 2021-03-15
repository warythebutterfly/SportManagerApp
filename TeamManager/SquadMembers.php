<?php 
session_start();

include("C:/xampp/htdocs/sportmanagerapp/connection.php");
include("C:/xampp/htdocs/sportmanagerapp/functions.php");

  $result = mysqli_query($con,"SELECT * FROM users WHERE Roleid = 2"  );
  $add_fixtures = Add_Fixtures($con);

  $resultTeam = mysqli_query($con,"SELECT * FROM Teams"  );
  $resultTeam2 = mysqli_query($con,"SELECT * FROM Teams");
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
  <a type="button" data-toggle="modal" data-target="#exampleModalCenter" href="#">Add Fixture</a>
   <a href="../logout.php">Sign Out</a>
   </div>

<!-- Modal -->
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
       <select type="name" class="form-control" name="homeT" required>
       <?php while ($rows = mysqli_fetch_assoc($resultTeam)){
         $home_team = $rows['Name'];
         echo "<option value='$home_team'>$home_team</option>";
       }?>
       </select>
       </div>
      <div class="form-group">
       <label>Away Team</label>
       <select type="name" class="form-control" name="awayT" required>
        <?php while ($rowss = mysqli_fetch_assoc($resultTeam2)){

         $away_team = $rowss['Name'];
         
         echo "<option value='$away_team'>$away_team</option>";
       } ?> 
       </select>  
       </div>
      <div class="form-group">
       <label>Date</label>
       <input type="date" class="form-control" name="Fixturedate" required></input>
      </div>
      <div class="form-group">
       <label>Time</label>
       <input type="time" class="form-control" name="time"  required>
      </div> 
     </div>
     <div class="modal-footer">
      <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
      <input type="submit" class="btn btn-success"  value="addFixture">
     </div>
      </form>
      
    </div>
  </div>
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
