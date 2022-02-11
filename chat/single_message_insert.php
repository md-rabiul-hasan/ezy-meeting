<?php
session_start();
include 'db.php';

if (!isset($_SESSION['id'])) {
    header("location:../login/login.php");
    exit;
}

$current_company_id = $_SESSION['company_id'];
$from_user_id       = $_SESSION['id'];

if (isset($_POST['send_to_user_id']) && isset($_POST['send_single_message'])) {
    $send_to_user_id     = filter_input(INPUT_POST, 'send_to_user_id', FILTER_SANITIZE_STRING);
    $send_single_message = filter_input(INPUT_POST, 'send_single_message', FILTER_SANITIZE_STRING);
    $messgeInsertSql     = "INSERT INTO `chat_message`( `company_id`, `to_user_id`, `from_user_id`, `chat_message`)  VALUES ('{$current_company_id}','{$send_to_user_id}','{$from_user_id}','{$send_single_message}')";
    $messgeInsertQuery   = mysqli_query($dbconnect,$messgeInsertSql);
    if($messgeInsertQuery){
        $chatHistory = userChatHistory($from_user_id,$send_to_user_id,$current_company_id);
        if($chatHistory != false){
            echo  $chatHistory;
        }else{
            return false;
        }
    }else{
        return false;
    }
}