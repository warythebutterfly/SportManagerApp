<?php
session_start();

if(isset($_SESSION['id']))
{
	unset($_SESSION['id']);

}
if(isset($_COOKIE['email']) and isset($_COOKIE['password'])){
	$email = $_COOKIE['email'];
	$pass = $_COOKIE['password'];
	setcookie('email',$email, time()-1);
    setcookie('password',$password, time()-1);
}

header("Location: login.php");
die;