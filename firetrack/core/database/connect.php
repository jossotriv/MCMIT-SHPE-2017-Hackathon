<?php
$connect_error = 'Experience Connection Issues';
$conn = mysqli_connect('localhost','root','','firetrack') or die($connect_error);
mysqli_select_db($conn,'firetrack') or die($connect_error);

?>