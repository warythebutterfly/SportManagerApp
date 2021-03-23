<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:/xampp/htdocs/sportmanagerapp/PHPMailer-master/src/Exception.php';
require 'C:/xampp/htdocs/sportmanagerapp/PHPMailer-master/src/PHPMailer.php';
require 'C:/xampp/htdocs/sportmanagerapp/PHPMailer-master/src/SMTP.php';

function signup_data($con){
  
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
   		$first_name = $_POST['firstname'];
    	$last_name = $_POST['lastname'];
    	$email = $_POST['email'];
		$password = $_POST['password'];
    	$roleid = $_POST['roleid'];

		$hashed_password = password_hash($password, PASSWORD_DEFAULT);

		if ($first_name == "" || $last_name == "" || $email == "" || $hashed_password == "" || $roleid == "") {
			$msg = "<script>alert('There are no fields to generate a report')</Script>";
			  return $msg;
		  }

		if(empty($email) && empty($password) )
		{
			echo "<script>alert('There are no fields to generate a report');</script>"; 
		}
			$sql = "SELECT * FROM users WHERE Email='$email' ";

			$result = mysqli_query($con, $sql);

			$user_data = mysqli_fetch_assoc($result);

			//check if the email has been used before
			if (mysqli_num_rows($result) > 0 && $user_data['Roleid'] == 1)  {

				header("Location: managersignup.php?error= The email already exists, please try another");
				exit();
				}
	
				elseif (mysqli_num_rows($result) > 0 && $user_data['Roleid'] == 2){
					header("Location: membersignup.php?error=The email is taken try another ");
					exit();
				}
				else {
			//save to database
			
			$query = "insert into users (
				firstname,
				lastname,
				email,
				password,
				roleid) values 
			('$first_name',
			'$last_name',
			'$email',
			'$hashed_password',
			'$roleid')";
			

			mysqli_query($con, $query);

			//header("Location:Login.php");
			
			email_sender($email, $first_name, 'Hi,<br>You have just signed up on the team manager app.','Signup confirmed');
			echo '<script> alert("Registered successfully!");document.location="Login.php"</script>';

			die;
			}
		}
		
}

function login_data($con){
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$email = $_POST['email'];
		$password = $_POST['password'];

		if(empty($email) && empty($password))
		{
			echo "<script>alert('There are no fields to generate a report')</script>"; 
		}

			//read from database
			$query = "select * from users where Email = '$email' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					//if($user_data['Password'] === $password)
					if(password_verify($password, $user_data['Password']))
					{
						if(isset($_POST['remember']))
						{
							setcookie('email',$email, time()+60*60*7);
							setcookie('password',$password, time()+60*60*7);
           				}

						$_SESSION['id'] = $user_data['id'];

            			if($user_data['Roleid'] == 1)
            			{
							email_sender($email, $first_name, 'Hi,<br>You have just logged in to the Team Manager App.','Welcome back mail');
              				header("Location:teammanager/index.php");
              				die;
            			}

						elseif ($user_data['Roleid'] == 2)
            			{
							email_sender($email, $first_name, 'Hi,<br>You have just logged in to the Team Manager App.','Welcome back mail');
              				header("Location:squadmember/index.php");
			   				die;
            			}
						
					}
				}
			}
			
			echo '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Error !</strong> Wrong email or password !</div>'; 
		
	}
}


	 function user_login_check($con)
	{
	
		if(isset($_SESSION['id']))
		{
	
			$id = $_SESSION['id'];
			$query = "select * from users where id = '$id' limit 1";
	
			$result = mysqli_query($con, $query);

			if($result && mysqli_num_rows($result) > 0)
			{
	
				$user_data = mysqli_fetch_assoc($result);
				return $user_data;
			}
		}
	
		//redirect to login
		header("Location: login.php");
		die;
	
	}

	function ischosen_check($con){

		if(isset($_POST['submit_squad']))
		{ 
			$fixture_id = $_POST['fixtureId'];
			$userIds = $_POST['options'];

			for($i=0; $i < count($userIds); $i++){

				$userid = $userIds[$i];

				$query = "update user_fixture_availability set IsChosen = true where User_id = $userid && Fixture_id = $fixture_id";
				mysqli_query($con,$query);

				$query_getUserById = "select * from users where id = '$userid' limit 1";
				$currentUser = mysqli_query($con, $query_getUserById);

				$data = mysqli_fetch_assoc($currentUser);

				email_sender($data['Email'], $data['FirstName'], 'Hi,<br>You have just been selected for a fixture. Kindly login to check.','Fixture Confirmation');
			}

			//print_r($_POST);
			
		}

	}

	function availability_check($con)
	{
		if(isset($_POST['save_changes']))
		{ 		
			$is_active = $_POST['isactive'];
			$reason = $_POST['reason'];
			//$filename = 'get.pdf';
			$fixture_id = $_POST['fixture_data'];

			$filename = uploadFile();
			
			if(isset($_SESSION['id']))
			{
				$user_id = $_SESSION['id'];
				$query = "select * from users where id = '$user_id' limit 1";

				$result = mysqli_query($con,$query);

				if(($result && mysqli_num_rows($result) > 0) )
				{
						$query_checkIfUserHasUpdatedAvailability = "select * from user_fixture_availability where User_id = '$user_id' && Fixture_id = $fixture_id limit 1";
						$userAlreadyExistsInFixture = mysqli_query($con,$query_checkIfUserHasUpdatedAvailability);
						if(mysqli_num_rows($userAlreadyExistsInFixture) > 0){
							$query = "update user_fixture_availability set IsActive = $is_active where User_id = $user_id && Fixture_id = $fixture_id";
							mysqli_query($con,$query);
						}
						else{
							$Fix_query = "insert into user_fixture_availability (Reason,IsActive,Filename,User_id,Fixture_id) values ('$reason','$is_active','$filename','$user_id','$fixture_id')";
						
						if (mysqli_query($con, $Fix_query)) {

								$query_getUserById = "select * from users where id ='$user_id' limit 1";
								$currentUser = mysqli_query($con, $query_getUserById);
								$currentUser_Data = mysqli_fetch_assoc($currentUser);

								$query_getFixtureById = "select * from fixtures where id ='$fixture_id' limit 1";
								$currentFixture = mysqli_query($con, $query_getFixtureById);
								$fixture_Data = mysqli_fetch_assoc($currentFixture);

								$query_getTeamManager = "select * from users where Roleid = 1 limit 1";
								$teamManager = mysqli_query($con, $query_getTeamManager);
								$teamManager_Data = mysqli_fetch_assoc($teamManager);

								$mailBody = "hi, <br> ". $currentUser_Data['FirstName']. " just confirmed that he would ";

								if($is_active == false){
									$mailBody.= "<b>NOT</b> ";
								}
								
								$mailBody .= "be available for a match.";
								$mailBody .= "<br>";
								$mailBody .= "Match Details: <br>";
								$mailBody .=  $fixture_Data['Home'] ." vs ".$fixture_Data['Away'];
								$mailBody .= "reason: ". $reason;

								email_sender($teamManager_Data['Email'], $teamManager_Data['FirstName'], $mailBody,'Player Not Available');
						}
					}
						echo "<script>alert('Availability Set successfully')</script>";

				}
			}		
			
		}		//redirect to login
				//header("Location: index.php");
	}
	//die;
		

	function email_sender($toMailAddress, $toName, $body, $subject)
	{
			//Instantiation and passing `true` enables exceptions
			$mail = new PHPMailer(true);

				try {
						//Server settings
						$mail->SMTPDebug = 0;                      //Enable verbose debug output
						$mail->isSMTP();                                            //Send using SMTP
						$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
						$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
						$mail->Username   = 'courseworkcmm07@gmail.com';                     //SMTP username
						$mail->Password   = 'Awakecmm007';                               //SMTP password
						$mail->SMTPSecure = 'tls';         		//Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
						$mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

						//Recipients
						$mail->setFrom('cervitech.com@gmail.com', 'Team Manager App - Bamidele');
						$mail->addAddress($toMailAddress, $toName);     //Add a recipient

						//Content
						$mail->isHTML(true);                                  //Set email format to HTML
						$mail->Subject = $subject;
						$mail->Body    = $body;
						$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

						$mail->send();
						//echo 'Message has been sent';
						} catch (Exception $e) {
						//echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
				} 	
	}
				
	function Send_Fixture_Mail_To_All_Players($con, $homeTeam, $awayTeam, $fixtureDate, $fixtureTime){

		$mailBody = "Hi guys, <br>";
		$mailBody .= "A new fixture has just been added. You can log in to your portal to set your availability status.<br>";
		$mailBody .= "Fixture Details: ";
		$mailBody .=  $homeTeam ." vs ".$awayTeam ."<br>";
		$mailBody .= "Date: ".$fixtureDate. "<br>";
		$mailBody .= "Time: ".$fixtureTime;

		$query_getRoleId = "select * from users where Roleid = 2";
		$currentUser = mysqli_query($con, $query_getRoleId);


		foreach($currentUser as $player){
			
				email_sender($player["Email"], $player["FirstName"], $mailBody,'New Fixture Update!!');
		}
	
	}
	
	
	function Add_Fixtures($con){
		 
	if(isset($_POST['addFixtures']))
	{
		$opponentTeam = $_POST['opponent'];

		$venue = $_POST['venue'];
		

		if($venue == 'home'){
			$home_team = 'Barcelona';
			$away_team = $_POST['opponent'];
		}
		else{
			$home_team = $_POST['opponent'];
			$away_team = 'Barcelona';
		}


    	$fixture_date = date('Y-m-d', strtotime($_POST['Fixturedate']));
		$time = $_POST['time'];	
			
			//save to database		
			$query = "insert into Fixtures (
				Home,Away,Date,Time) values (
					'$home_team','$away_team','$fixture_date','$time')";	

					 $result = mysqli_query($con, $query);

					if ($result)  {
						Send_Fixture_Mail_To_All_Players($con, $_POST['homeT'], $_POST['awayT'], $fixture_date, $time);
						echo '<script> alert("Fixture added successfully!");document.location.href = "index.php"</script>';
						die;
						}
			
						else
						{
							echo '<script> alert("!!!! Fixture not added");document.location.href = "index.php"</script>';
							die;
						}
			
		}
	}


	function uploadFile(){
				// Check if the form was submitted
			if($_SERVER["REQUEST_METHOD"] == "POST"){
			// Check if file was uploaded without errors
			if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
				$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
				$filename = $_FILES["photo"]["name"];
				$filetype = $_FILES["photo"]["type"];
				$filesize = $_FILES["photo"]["size"];
			
				// Verify file extension
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
			
				// Verify file size - 5MB maximum
				$maxsize = 5 * 1024 * 1024;
				if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
			
				// Verify MYME type of the file
				if(in_array($filetype, $allowed)){
					// Check whether file exists before uploading it
					if(file_exists("C:/xampp/htdocs/SportManagerApp/uploads/" . $filename)){
						echo $filename . " is already exists.";
					} else{
						move_uploaded_file($_FILES["photo"]["tmp_name"], "C:/xampp/htdocs/SportManagerApp/uploads/" . $filename);
						echo "Your file was uploaded successfully.";
						
					} 
				} else{
					echo "Error: There was a problem uploading your file. Please try again."; 
				}
				
			} else{
				echo "Error: " . $_FILES["photo"]["error"];
				return "";
			}
		}
		return $filename;


	}


	function logout(){
		session_start();

		if(isset($_SESSION['id']))
			{
				unset($_SESSION['id']);

			}

		header("Location: login.php");
		die;
	}


	/* Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<strong>Success !</strong> Great news, Password Changed successfully !</div>'); */