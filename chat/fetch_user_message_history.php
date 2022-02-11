<?php
include_once 'db.php';
if(isset($_POST['current_company_id']) &&  isset($_POST['to_user_id']) && isset($_POST['from_user_id'])){
    $from_user_id = filter_input(INPUT_POST,'from_user_id',FILTER_SANITIZE_STRING);
    $to_user_id = filter_input(INPUT_POST,'to_user_id',FILTER_SANITIZE_STRING);
    $current_company_id = filter_input(INPUT_POST,'current_company_id',FILTER_SANITIZE_STRING);
    
    $chatHistory = userChatHistory($from_user_id,$to_user_id,$current_company_id);
    if($chatHistory != false){
        echo  $chatHistory;
    }

}