<?php
session_start();
include('db.php');

if ( !isset( $_SESSION['id'] ) ) {
    header( "location:../login/login.php" );
    exit;
}

$company_id = $_SESSION['company_id'];
$user_id    = $_SESSION['id'];


if(isset($_POST['current_chat_active_user'])){
    $current_chat_active_user = filter_input(INPUT_POST,'current_chat_active_user',FILTER_SANITIZE_STRING);
    $updateGroupConversionMessage =  fetchGroupChatHisotry($user_id,$company_id);
    echo $updateGroupConversionMessage;
}



?>