<?php
session_start();
error_reporting(0);
include 'db_cridential.php';
include 'functions.php';
include 'mail/mail_cridential.php';
$connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
mysqli_set_charset($connect,"utf8");
if (!$connect) {
    die("database connection failed.");
}

date_default_timezone_set("Asia/Dhaka");

$slashCount = explode('/', $_SERVER['REQUEST_URI']);
$extra      = count($slashCount) - 3;
if ($extra == 1) {
    $addDot = '../';
} else if ($extra == 2) {
    $addDot = '../../';
} else if ($extra == 3) {
    $addDot = '../../../';
} else if ($extra == 4) {
    $addDot = '../../../../';
} else if ($extra == 5) {
    $addDot = '../../../../../';
} else {
    $addDot = '';
}

// user activaty log
if(isset($_SESSION['id']) && isset($_SESSION['company_id'])){
    $user_id    = $_SESSION['id'];
    $compnay_id = $_SESSION['company_id'];
    $page_name =  basename($_SERVER['PHP_SELF']);
    userActivity($compnay_id,$user_id,$page_name);
}




?>