<?php

session_start();
error_reporting(0);
ini_set('display_errors', 'On'); error_reporting(E_ALL); mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require 'database/connect.php';
require 'functions/users.php';
require 'functions/generic.php';


if(logged_in() === true){
	$session_userid = $_SESSION['user_id'];
	$user_data = user_data($conn, $session_userid, 'user_id', 'username', 'password','first_name', 'last_name','email','profile');
	
	$username = $user_data['username'];
	$password = $user_data['password'];
	$first_name = $user_data['first_name'];
	$last_name = $user_data['last_name'];
	$email = $user_data['email'];
	$profile_image = $user_data['profile'];
	
}
$errors = array();
?>