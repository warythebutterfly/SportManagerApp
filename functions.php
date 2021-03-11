<?php


function signup_data($con){
  
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
   		$first_name = $_POST['firstname'];
    	$last_name = $_POST['lastname'];
    	$email = $_POST['email'];
		$password = $_POST['password'];
    	$roleid = $_POST['roleid'];

		if ($first_name == "" || $last_name == "" || $email == "" || $password == "" || $roleid == "") {
			$msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
	  				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  				<strong>Error !</strong> Please, User Registration field must not be Empty !</div>';
			  return $msg;
		  }
		if(!empty($email) && !empty($password) )
		{
			$sql = "SELECT * FROM users WHERE Email='$email' ";

			$result = mysqli_query($con, $sql);

			$user_data = mysqli_fetch_assoc($result);

			//check if the email has been used before
			if (mysqli_num_rows($result) > 0 && $user_data['Roleid'] == 1)  {

				header("Location: managersignup.php?error=The email is taken try another ");
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
			'$password',
			'$roleid')";
			

			mysqli_query($con, $query);

			header("Location:Login.php");
			
			echo '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Success !</strong> Wow, you have Registered Successfully !</div>';
			
			
			die;
			}
		}else
		{
				  
			 echo '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Error !</strong> Something went Wrong !</div>'; 
		}
	}
}
	 function user_login_check($con)
	{
	
		if(isset($_SESSION['id']))
		{
	
			$id = $_SESSION['id'];
			$query = "select * from users where id = '$id' limit 1";
	
			$result = mysqli_query($con,$query);
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
	function logout(){
		session_start();

		if(isset($_SESSION['id']))
			{
				unset($_SESSION['id']);

			}

		header("Location: login.php");
		die;
	}

	function Add_Fixtures($con){
		 
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
   		$home_team = $_POST['homeT'];
    	$away_team = $_POST['awayT'];
    	$fixture_date = date('Y-m-d', strtotime($_POST['Fixturedate']));
		$time = $_POST['time'];
    	

		if ($home_team == "" || $away_team == "" || $fixture_date == "" /* $time == ""  */) {
			$msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
	  				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  				<strong>Error !</strong> Please, User Registration field must not be Empty !</div>';
			  return $msg;
		  }else{
			
			//save to database
			
			$query = "insert into Fixtures (
				Home,Away,Date,Time) values 
			('$home_team','$away_team','$fixture_date','$time'
			)";	

			mysqli_query($con, $query);

			header("Location:index.php");
			
			echo '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Success !</strong> Wow, you have Successfully added a fixture!</div>';

			die;
			}
		}
	}


/* 	public function checkExistEmail($email){
		$sql = "SELECT email from  tbl_users WHERE email = :email";
		$result = mysqli_query($con, $sql);
		$result->bindValue(':email', $email);
		 $result->execute();
		if ($result->rowCount()> 0) {
		  return true;
		}else{
		  return false;
		}
	  } */





	/* function random_num($length)
	{

	$text = "";
	if($length < 5)
	{
		$length = 5;
	}

	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) { 
		# code...

		$text .= rand(0,9);
	}

	return $text; }*/

	/* Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<strong>Success !</strong> Great news, Password Changed successfully !</div>'); */