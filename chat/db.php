<?php

include '../db_cridential.php';
include_once 'chat_functions.php';
$dbconnect = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
mysqli_set_charset($dbconnect, "utf8");
if(!$dbconnect){
    throw new Exception("Database connection failed");
}
date_default_timezone_set('Asia/Dhaka');

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

