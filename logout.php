<?php 
	include 'database_connection.php';
	session_start();
	$user_id = $_SESSION['id'];
	$compnay_id = $_SESSION['company_id'];
	mysqli_query($connect,"UPDATE users SET is_logged='0'  where company_id='{$compnay_id}' and id='{$user_id}'");
	session_destroy();
	header("location:login/login.php");
 ?>