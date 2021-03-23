<?php 
  session_start();
  
    include("C:/xampp/htdocs/sportmanagerapp/connection.php");
    include("C:/xampp/htdocs/sportmanagerapp/functions.php");

	  $check_login = user_login_check($con);

    availability_check($con);

    $resultFixs = mysqli_query($con,"SELECT * FROM Fixtures");
    $result = mysqli_query($con,"SELECT * FROM users WHERE Roleid = 2");

    $user_data = mysqli_fetch_assoc($result);


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
 <div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>welcome <?php echo $check_login['FirstName'];?>  <?php echo $check_login['LastName'];?></div>
      
      

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="index.php">Home</a>
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
          <th class="col-md-3" type="hidden"></th>
            <th class="col-md-6"><p>Home Vs Away</p></th>
            <th class="col-md-6">Date/Time</th>
            <th class="col-md-3"></th>
          <th class="col-md-3"></th>

          </tr>
          <br>
          <br>
          <?php /* while($row = mysqli_fetch_array($resultFixs) )
                { */if($resultFixs)
                  {
                    foreach($resultFixs as $row)
                    {
                  
                ?>
          <tr>
          
            <td class="col-md-6" type="hidden" id="fixtureId"><p><?php echo $row["id"]; ?>  </p></td>
            <td class="col-md-6"><p><?php echo $row["Home"]; ?> vs <?php echo $row["Away"]; ?></p></td>
            <td class="col-md-6"><?php echo $row["Date"]; ?>/<?php echo $row["Time"]; ?></td>
            <td class="col-md-3">
            <button type="button" class="btn btn-primary availablebtn">Set Availability</button>
            </td>
            <td class="col-md-3">
            <button id="btnViewTeam" type="button" class="btn btn-primary teamSelectedbtn">View Selected Squad Members</button>
            </td>
            
          </tr>
          <?php } 
                  } ?>
          <br><br>
          
    
        </table>  
                

  <!-- set availability Modal -->
  <div class="modal fade" id="availabilityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  <form method="post" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Set Availability</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            
      <div class="col-md-8">Available?</div>
        </div>
         <div class="row">
            <div id="awayM" class="col-md-4"></div> 
      <div class="col-md-4">
        <div class="form-check">
      <input class="form-check-input" name ="isactive" type="radio" value="1" ><p style="padding-left:20px">Yes</p>
                  
      </div>
      </div>
      <div class="col-md-4">
      <div class="form-check">
  
  
      <input class="form-check-input" name ="isactive" type="radio" value="0"><p style="padding-left:20px">No</p>
      <!-- <label class="form-check-label" for="flexRadioDefault1">
      No
      </label> -->
  
      <input type="hidden" name="fixture_data" id="fixture_id" class="form-control"></p>
      <input type="hidden" id="HomeM" class="form-control"></p>
      <input type="hidden" id="AwayM" class="form-control"></p>
      <input type="hidden" id="date" class="form-control"></p>
      <input type="hidden" id="time" class="form-control"></p>
      </div>
      </div>
      </div>

       
       <div class="row">
            
      <div class="col-md-4 ml-auto"></div>
        </div><br>
   
      <div class="row">
        <div class="col-md-6">
          If NO <input type="text" name="reason" placeholder="Kindly state why?">
        </div>
        
        <div class="col-md-6">
          or <label>Upload a document:</label> <input type="file" name="photo" id="fileSelect">
        </div>
      </div>
      </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="save_changes" class="btn btn-primary">Save Changes</button>
      </div>

      </div>
    </form>
    </div>
</div> 

                                  <!-- Selected team Modal -->
          <div class="modal fade" id="teamSelectedModal" tabindex="1" role="dialog" aria-labelledby="CenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="CenterTitle">Team Selected</h5>
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
                  <tr>
                  </thead>
                  
                        <tbody id="selectedMembers">
                                  
                      <tbody>
                      
                      
                </table>
                    <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
      </div>

<script>
  $(document).ready(function () {

    $('.availablebtn').on('click', function (){

      $('#availabilityModal').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function (){
          return $(this).text();
      }).get();

      console.log(data);

      $('#fixture_id').val(data[0]);
      $('#HomeM').val(data[1]);
      $('#AwayM').val(data[2]);
      $('#date').val(data[3]);
      $('#time').val(data[4]);

    });


      //selected team
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
         $('#teamSelectedModal').modal('show');
          $("#teamSelectedModal").appendTo("body");
         document.getElementById('selectedMembers').innerHTML = data; 
         // in case of success get the output, i named data
       
     }
   });
     
   }); 

  });
 

</script>
   
</body>
<!-- id="btnSetUpFixture -->
</html> 
