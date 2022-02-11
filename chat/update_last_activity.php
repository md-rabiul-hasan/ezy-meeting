<?php
session_start();
include('db.php');

if ( !isset( $_SESSION['id'] ) ) {
    header( "location:../login/login.php" );
    exit;
}

$company_id = $_SESSION['company_id'];
$user_id    = $_SESSION['id'];


$sql = "UPDATE login_details SET last_activity = now() WHERE login_details_id = '".$_SESSION["login_details_id"]."'";
$query = mysqli_query($dbconnect,$sql);




?>

