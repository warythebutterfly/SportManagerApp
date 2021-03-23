<?php
   include("C:/xampp/htdocs/sportmanagerapp/connection.php");
   include("C:/xampp/htdocs/sportmanagerapp/functions.php");

    $fixture_id = $_GET['fixtureid'];

    $query = "select * from user_fixture_availability where Fixture_id = $fixture_id  &&  isActive = true";

    $response = mysqli_query($con,$query);

    while($row = mysqli_fetch_assoc($response)){
            $userId = $row['User_id'];

            $userquery = "select * from users where id = $userId";

            $userresponse = mysqli_query($con,$userquery);
            $user = mysqli_fetch_assoc($userresponse);
        ?>
        <tr>
            <td>
            <span class="custom-checkbox">
              <input type="checkbox" id="checkbox1" name="options[]" value="<?php echo $userId ?>">
              <label for="checkbox1"></label>
            </span>
            </td>
            <td class="col-md-6" id="firstName"><?php echo $user["FirstName"]; ?></td>
            <td class="col-md-6" id="lastName"><?php echo $user["LastName"]; ?></td>
            <td class="col-md-6" id="email"><?php echo $user["Email"]; ?></td>
    </tr>   <?php 
    }?>
    <input type="hidden" name="fixtureId" value="<?php echo $fixture_id ?>">

     