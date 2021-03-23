<?php 
session_start();

    include("C:/xampp/htdocs/sportmanagerapp/connection.php");
    include("C:/xampp/htdocs/sportmanagerapp/functions.php");

    

	$check_login = user_login_check($con);
  $add_fixtures = Add_Fixtures($con);

  ischosen_check($con);

  $resultFix = mysqli_query($con,"SELECT * FROM Fixtures");

  $resultTeam = mysqli_query($con,"SELECT * FROM Teams");
  $resultTeam2 = mysqli_query($con,"SELECT * FROM Teams");

  $playerList = mysqli_query($con,'SELECT * FROM users WHERE Roleid = 2');


  // mysqli_fetch_assoc($resultTeam);
  // $resultTeamArray = (array)$resultTeam;
  // echo count($resultTeamArray);
  
  // foreach($resultTeamArray as $value) {
  //   print $value['Name'];
  // }

  //echo serialize($playerList);
  //$user_data = mysqli_fetch_assoc($result);

  //$selectteam_post = selectTeam_check($con);

?>
<!DOCTYPE html>
<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="assets/css/login.css"> -->
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

.modal-backdrop {
    z-index: 1040 !important;
}
.modal-content {
    margin: 2px auto;
    z-index: 1100 !important;
}
</style>
</head>
<body style="padding: 30px">
<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>welcome <?php echo $check_login['FirstName'];?>  <?php echo $check_login['LastName'];?></div>
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="index.php">Home</a>
  <a type="button" data-toggle="modal" data-target="#exampleModalCenter" href="#">Add Fixture</a>
   <a href="../logout.php">Sign Out</a>
</div>


<!-- Add Fixture Modal -->

<div class="modal fade" id="exampleModalCenter" tabindex="-2" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
     <div class="row">   
      
     <div class="col-md-8" value="Barcelona">My Team: Barcelona</div>
        </div>

                <div class="col-md-4">
                  <div class="form-check">
                <input class="form-check-input" name ="venue" type="radio" value="home" ><p style="padding-left:20px">Home</p>
                    </div>
                    </div>
                
                <div class="col-md-4">
                <div class="form-check">
            
                <input class="form-check-input" name ="venue" type="radio" value="away"><p style="padding-left:20px">Away</p>
                </div>
                </div>

          <div class="form-group">
          <select type="name" class="form-control" name="opponent" required>
            <?php while ($rowss = mysqli_fetch_assoc($resultTeam2)){

            $opponent = $rowss['Name'];
            
            echo "<option value='$opponent'>$opponent</option>";
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
      <input type="submit" class="btn btn-success"  name="addFixtures" value="addFixture">
     </div>
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

      <div class="row rowFixtures">
        <table>
        <thead>
          <tr>
            <th class="col-md-3" type="hidden"></th>
            <th class="col-md-6"><p>Home Vs Away</p></th>
            <th class="col-md-6">Date/Time</th>
            <th class="col-md-3"></th>
            <th class="col-md-3 "></th>
          
          </tr>
          </thead>
          <tbody>
          <br>
          <br>
          <?php while($row = mysqli_fetch_array($resultFix) )
                {
                ?>
          <tr>
            <td class="col-md-3" id="fixtureId"><p><?php echo $row["id"]; ?></td>
            <td class="col-md-6"><p><?php echo $row["Home"]; ?> vs <?php echo $row["Away"]; ?></p></td>
            <td class="col-md-6"><?php echo $row["Date"]; ?>/<?php echo $row["Time"]; ?></td>
            <td class="col-md-3"><button type="button" class="btn btn-primary selectTeambtn">Select Team</button></td>
            <td class="col-md-3 ml-auto"><button type="button" class="btn btn-primary teamSelectedbtn">View Selected Squad Members</button></td>
            
          </tr>
          <?php }  ?>

          </tbody>
          <br><br>
         
    
        </table>   
        </div> 

  </div>
</div>



<!-- Select team Modal -->
<div class="modal fade" id="selectTeamModal" tabindex="0" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Select Team</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post">
      <div class="modal-body">
        <div class="row">
      </div>
      <div class="col-sm-10">
      <table>
            <thead>
              <tr>
                <th></th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>Email</th>
              </tr>
          </thead>
        
              <tbody id="availableMembers">
                        
              <tbody>
      
      </table>
  <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="submit_squad" class="btn btn-primary">Save Fixture squad</button>
        </div>
        </form>
  </div>
      </div>
    </div>
</div>


  <!-- select working progress Modal -->
<!-- team selected Modal -->
<div class="modal fade" id="teamSelectedModal" tabindex="1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Team Selected</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                    </div>
                    <div class="col-sm-10">
                      <table>
                        <thead>
                          <tr>
                            <th>FirstName</th>
                            <th>LastName</th>
                            <th>Email</th>
                          </tr>
                        </thead>
                        <tbody id="selectedMembers">
                                    
                        <tbody>
                     </table>
                </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




<script>

  $(document).ready(function () {

    $('.selectTeambtn').on('click', function (){   
    
     $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function (){
          return $(this).text();
      }).get();

      console.log(data);

      $.ajax({
      type: 'post', 
      url: 'api.php?fixtureid='+data[0], 
      data: {
     
      },
      success: function(data) {
          $('#selectTeamModal').modal('show');
          document.getElementById('availableMembers').innerHTML = data; 
          // in case of success get the output, i named data
        
      }
    });

    }); 

    $('.teamSelectedbtn').on('click', function (){   
    
    $tr = $(this).closest('tr');

     var data = $tr.children("td").map(function (){
         return $(this).text();
     }).get();

     console.log(data);

     $.ajax({
     type: 'post', // the method (could be GET btw)
     url: 'teamselectedapi.php?fixtureid='+data[0], // The file where my php code is
     data: {
     // all variables i want to pass. In this case, only one.
     },
       success: function(data) {
         console.log('got to select team');
         $('#teamSelectedModal').modal('show');
         $("#teamSelectedModal").appendTo("body");
         console.log('after selected team modal');
         document.getElementById('selectedMembers').innerHTML = data; 
         // in case of success get the output, i named data
       
     }
   });
     
   });  
  }); 


</script>
   

</body>
</html> 
