<?php
session_start();
include 'db.php';

if (!isset($_SESSION['id'])) {
    header("location:../login/login.php");
    exit;
}

$current_company_id = $_SESSION['company_id'];
$from_user_id    = $_SESSION['id'];

if ( isset($_POST['send_group_message'])) {
    $send_group_message = filter_input(INPUT_POST, 'send_group_message', FILTER_SANITIZE_STRING);
    $groupMessageInsertSql = "INSERT INTO `chat_message`( `company_id`, `to_user_id`, `from_user_id`, `chat_message`,`is_group_message`,`status`)
      VALUES ('{$current_company_id}','0','{$from_user_id}','{$send_group_message}','1','1')";
    $groupMessgeInsertQuery = mysqli_query($dbconnect,$groupMessageInsertSql);
    if($groupMessgeInsertQuery){
        $groupChatHistory = companyGroupChatHistory($from_user_id,$current_company_id);
        if($groupChatHistory != false){
            echo  $groupChatHistory;
        }else{
            return false;
        }
    }else{
        return false;
    }
}