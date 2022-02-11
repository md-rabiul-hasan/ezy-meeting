<?php
session_start();
include('db.php');

if ( !isset( $_SESSION['id'] ) ) {
    header( "location:../login/login.php" );
    exit;
}

$company_id = $_SESSION['company_id'];
$user_id    = $_SESSION['id'];

if(isset($_POST['search_text'])){
    $search_text = filter_input(INPUT_POST,'search_text',FILTER_SANITIZE_STRING);
    $sql = "SELECT name,id as user_id,avatar FROM users where id !='{$user_id}' and company_id='{$company_id}' and name like '%{$search_text}%' ";
}else{
    $sql = "SELECT name,id as user_id,avatar FROM users where id !='{$user_id}' and company_id='{$company_id}'";
}


$query = mysqli_query($dbconnect,$sql);
$output = '<li class="clearfix active user-list singleuser" data-username="group chat" data-userid="group-chat">
<img src="assets/img/avatar.png" alt="avatar" class="chat_avatar" />
<div class="about">
    <div class="name">Group Chat Window</div>
    <div class="status">
        <i class="fa fa-circle online"></i> online
    </div>
</div>
</li>';
while($data = mysqli_fetch_assoc($query)){
    $avatar = $data['avatar'];
    if($avatar != '' or $avatar != NULL){
        $avatar = $addDot.$avatar;
    }else{
        $avatar = "assets/img/avatar.png"; 
    }
    $status = '';
    $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
    $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
    $user_last_activity = fetch_user_last_activity($data['user_id']);

    if($user_last_activity > $current_timestamp)
    {
     $status = 'Online';
     $statusColor = 'online';
    }
    else
    {
     $status = 'Offline';
     $statusColor = 'offline';
    }

    $output .= '<li class="clearfix active user-list singleuser" data-username="'.$data['name'].'"  data-userid="'.$data['user_id'].'">
                    <img src="'.$avatar.'" alt="avatar" class="chat_avatar" />
                    <div class="about">
                        <div class="name">'.$data['name'].'</div>
                        <div class="status">
                            <i class="fa fa-circle '.$statusColor.'"></i> '.$status.'<span class="badge badge-pill bg-danger lhr-12 ml-2">'.countSeenMessage($data['user_id'],$user_id).'</span>
                        </div>
                    </div>
                 </li>';
}

echo $output;




?>