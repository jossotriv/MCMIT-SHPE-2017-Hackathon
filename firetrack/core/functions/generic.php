<?php


function isProtected(){
	if (logged_in() === false){
		header('Location: protect.php');
		exit();
	}
}

function array_sanitize(&$item){
	$conn = mysqli_connect('localhost','root','','phplogin') or die($connect_error);
	$item = mysqli_real_escape_string($conn, $item);
	
}
function error_logs($errors){
	$output = array();
	foreach($errors as $error){
		echo $error, nl2br("\n");
	}
}

function logged_in(){
	return isset($_SESSION['user_id']);
}

?>