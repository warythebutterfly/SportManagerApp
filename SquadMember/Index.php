<?php 
session_start();
  
    include("C:/xampp/htdocs/sportmanagerapp/connection.php");
    include("C:/xampp/htdocs/sportmanagerapp/functions.php");

	$check_login = user_login_check($con);
  
  $resultFixs = mysqli_query($con,"SELECT * FROM Fixtures");
	//$fixture_data = mysqli_fetch_assoc($resultFixs);
  $check_fixture = fixture_check($con);
			

?>
<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

function viewTeam(){
  document.getElementById("viewSelectedTeam").style.display="none";
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

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="index.html">Home</a>
  <a href="squadmembers.php">Squad Members</a>
  <a type="button" href="#">Swap</a>
   <a href="../logout.php">Sign Out</a>
</div>



<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>

<div class="row">
  
    <div class="col-sm-2"></div>
    
<div class="col-sm-10">
<h2>Fixtures</h2>
<br>

<div class="row">
        <table>
          <tr>
            <th class="col-md-6"><p>Home Vs Away</p></th>
            <th class="col-md-6">Date/Time</th>
            <th class="col-md-3"></th>
          <th class="col-md-3"></th>

          </tr>
          <br>
          <br>
          <?php while($row = mysqli_fetch_array($resultFixs) )
                {
                ?>
          <tr>
            <td class="col-md-6"><p><?php echo $row["Home"]; ?> vs <?php echo $row["Away"]; ?></p></td>
            <td class="col-md-6"><?php echo $row["Date"]; ?>/<?php echo $row["Time"]; ?></td>
            <td class="col-md-3"><button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary">Set Availability</button></td>
            <td class="col-md-3 ml-auto"><button type="button" id="btnViewTeam" onclick="viewTeam()" class="btn btn-primary">Team Selected</button></td>

          </tr>
          <br><br>
          <?php }  ?>
    <?php
     // close connection database
     mysqli_close($con);
                ?>
        </table>  

           
                <!--  <div class="row">

            <div class="col-md-3"><p>Home Vs Away</p></div>
            <div class="col-md-3">Date/Time</div>
            <div class="col-md-3"><button type="button"  data-toggle="modal" data-target="#exampleModal" class="btn btn-primary">Set Availability</button></div>
      <div class="col-md-3 ml-auto"><button type="button" id="btnViewTeam" onclick="viewTeam()" class="btn btn-primary">View Team</button></div>

        </div> -->
          <div id="response_message" id="viewSelectedTeam" hidden="true" class="col">
                    <form>

                        <div class="form-group">
                            <label for="username" class="sr-only">UserName</label>
                            <input required id="username" type="text" placeholder="UserName" class="mr-5 form-control">
                        </div>

                        <div class="form-group">
                            <label for="firstname" class="sr-only">FirstName</label>
                            <input required id="firstname" type="text" placeholder="FirstName" class="mr-5 form-control">
                        </div>

                        <div class="form-group">
                            <label for="lastname" class="sr-only">LastName</label>
                            <input required id="lastname" type="text" placeholder="LastName" class="mr-5 form-control">
                        </div>

                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input required id="email" type="text" placeholder="Email" style="width:300px" class="mr-5 form-control">
                        </div>
                        
                    </form>
</div>
                </div>
                
                <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Set Availability</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-4"><?php echo $check_fixture() ?><br>Vs</div>
      <div class="col-md-8">Available?</div>
        </div>
        <div class="row">
            <div class="col-md-4"><?php echo $resultFixs["Away"]; ?></div>
      <div class="col-md-4">
        <div class="form-check">
  <input class="form-check-input" type="radio" checked><p style="padding-left:20px">Yes</p>
  
</div>
</div>
 <div class="col-md-4">
  <div class="form-check">
  <input class="form-check-input" type="radio"><p style="padding-left:20px">No</p>
  <!-- <label class="form-check-label" for="flexRadioDefault1">
    No
  </label> -->
</div>
</div>
</div>

       
        <div class="row">
            <div class="col-md-4"><?php echo $resultFixs["Date"]; ?>/<?php echo $resultFixs["Time"]; ?></div>
      <div class="col-md-4 ml-auto"></div>
        </div><br>
   
      <div class="row">
           
      <div class="col-md-6">
        If no <input type="text" name="" placeholder="Kindly state why?">
      </div>
       <div class="col-md-6">
        or <label for="myfile">Upload a document:</label> <input type="file" id="myFile" name="myFile">
      </div>
        </div>

      </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="btnSetUpFixture" class="btn btn-primary">Save Changes</button>
      </div>

    </div>
  </div>
</div>

</div>
</div>

   
</body>

</html> 
