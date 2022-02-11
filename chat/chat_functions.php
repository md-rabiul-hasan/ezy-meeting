<?php

// find out user chat history
function userChatHistory(int $from_user_id, int $to_user_id,int $current_company_id) {
    global $dbconnect;
    global $addDot;
    $userSql    = "SELECT name as to_user_name,avatar FROM users WHERE id='{$to_user_id}' AND company_id='{$current_company_id}' ";
    $userQuery  = mysqli_query($dbconnect, $userSql);
    $userData   = mysqli_fetch_assoc($userQuery);
    $toUserName = $userData['to_user_name'];
    $avatar = $userData['avatar'];
    if($avatar != '' or $avatar != NULL){
        $avatar = $addDot.$avatar;
    }else{
        $avatar = "assets/img/avatar.png"; 
    }
    echo '<div class="chat-header clearfix">
    <img src="'.$avatar.'" class="active_chat" alt="avatar" />

    <div class="chat-about">
      <div class="chat-with" style="text-transform:capitalize">Chat with ' . $toUserName . '</div>
      <div class="chat-num-messages ">already '.totalMessageCount($from_user_id,$to_user_id,$current_company_id).' messages</div>
      <p class="chat-people"></p>
    </div>
    <i class="fa fa-star"></i>
  </div> <!-- end chat-header -->';

    $fetchMessageData = fetchChatHisotry($from_user_id, $to_user_id,$current_company_id);


    echo '<div class="chat-history" id="chat_history" data-currentactivechatuserid="'.$to_user_id.'">
    <ul id="update-chat-history-'.$to_user_id.'">
    '.$fetchMessageData.'




    </ul>

  </div> <!-- end chat-history -->
  <div class="chat-message clearfix">  
    <form action="">
      <textarea name="send_single_message" id="send_single_message" required placeholder ="Type your message" rows="1"></textarea>
      <input type="hidden" name="send_to_user_id" id="send_to_user_id" value="'.$to_user_id.'">

    <!--   <i class="fa fa-file-o"></i> &nbsp;&nbsp;&nbsp;
      <i class="fa fa-file-image-o"></i> -->

      <button id="send-single-message" type="button">Send</button>
    </form>
   

  </div> <!-- end chat-message -->';

 

}

// find out user chat history
function fetchChatHisotry(int $from_user_id, int $to_user_id, int $current_company_id) {

    global $dbconnect;
    $sql   = "SELECT chat_message.*,fusers.name as from_user_name FROM chat_message 
    inner join users fusers on chat_message.from_user_id=fusers.id
    WHERE (from_user_id = '$from_user_id' AND to_user_id='$to_user_id' ) or (from_user_id = '$to_user_id' AND to_user_id='$from_user_id' ) AND chat_message.company_id='{$current_company_id}' ORDER BY timestamp ASC";
    $query = mysqli_query($dbconnect, $sql);
    $output = '';
    while($data = mysqli_fetch_assoc($query)){
        if($data['from_user_id'] == $from_user_id){
          $output .= '<li>
          <div class="message-data">
            <span class="message-data-name"><i class="fa fa-circle online"></i> '.$data['from_user_name'].'</span>
            <span class="message-data-time">'.time_elapsed_string($data['timestamp']).'</span>
          </div>
          <div class="message my-message">
            '.$data['chat_message'].'
          </div>
        </li>';
        }else{
          $output .= '<li class="clearfix">
          <div class="message-data align-right">
            <span class="message-data-time" >'.time_elapsed_string($data['timestamp']).'</span> &nbsp; &nbsp;
            <span class="message-data-name" > '.$data['from_user_name'].'</span> <i class="fa fa-circle me"></i>
  
          </div>
          <div class="message other-message float-right">
          '.$data['chat_message'].'
          </div>
        </li>';
        }     
        
      
    }

    messageSeen($to_user_id,$from_user_id,$current_company_id);

    return $output;
}

// find out time covertion
function time_elapsed_string($datetime, $full = false) {
  $now = new DateTime;
  $ago = new DateTime($datetime);
  $diff = $now->diff($ago);

  $diff->w = floor($diff->d / 7);
  $diff->d -= $diff->w * 7;

  $string = array(
      'y' => 'year',
      'm' => 'month',
      'w' => 'week',
      'd' => 'day',
      'h' => 'hour',
      'i' => 'minute',
      's' => 'second',
  );
  foreach ($string as $k => &$v) {
      if ($diff->$k) {
          $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
      } else {
          unset($string[$k]);
      }
  }

  if (!$full) $string = array_slice($string, 0, 1);
  return $string ? implode(', ', $string) . ' ago' : 'just now';
}


// find out total message count by user
function totalMessageCount(int $from_user_id, int $to_user_id, int $current_company_id){
  global $dbconnect;
  $sql   = "SELECT count(*) as totalMessage FROM chat_message 
  WHERE (from_user_id = '$from_user_id' AND to_user_id='$to_user_id' ) or (from_user_id = '$to_user_id' AND to_user_id='$from_user_id' ) AND company_id='{$current_company_id}' ORDER BY timestamp DESC";
  $query = mysqli_query($dbconnect, $sql);
  $data = mysqli_fetch_assoc($query);
  return $data['totalMessage'] ?? 0;
}


// compnay group chat history
function companyGroupChatHistory(int $from_user_id,int $current_company_id){
  global $dbconnect;
  global $addDot;
 
  echo '<div class="chat-header clearfix">
  <img src="assets/img/avatar.png" class="active_chat" alt="avatar" />

  <div class="chat-about">
    <div class="chat-with" style="text-transform:capitalize">Group Chat Window</div>
    <div class="chat-num-messages ">already '.totalGroupMessageCount($current_company_id).' messages</div>
    <p class="chat-people"></p>
  </div>
  <i class="fa fa-star"></i>
</div> <!-- end chat-header -->';

  $fetchGroupMessageData = fetchGroupChatHisotry($from_user_id, $current_company_id);


  echo '<div class="chat-history" id="chat_history" data-currentactivechatuserid="group-chat">
  <ul id="update-chat-history-group-chat">
  '.$fetchGroupMessageData.'




  </ul>

</div> <!-- end chat-history -->
<div class="chat-message clearfix">  
  <form action="">
  <textarea name="send_group_message" id="send_group_message" required placeholder ="Type your message" rows="1"></textarea>


  <!--   <i class="fa fa-file-o"></i> &nbsp;&nbsp;&nbsp;
  <i class="fa fa-file-image-o"></i> -->

  <button id="send-group-message-submit" type="button">Send <i class="fa fa-send"></i></button>
  </form>

 

</div> <!-- end chat-message -->';
}


function fetchGroupChatHisotry($from_user_id,$current_company_id){
  global $dbconnect;
  $sql = "SELECT chat_message.*,fusers.name as from_user_name FROM chat_message
  inner join users fusers on chat_message.from_user_id=fusers.id
   where chat_message.company_id='{$current_company_id}' and is_group_message=1 ORDER BY timestamp ASC";
  
  $query = mysqli_query($dbconnect,$sql);
  $output = '';
  while($data = mysqli_fetch_assoc($query)){
    if($data['from_user_id'] == $from_user_id){
      $output .= '<li>
      <div class="message-data">
        <span class="message-data-name"><i class="fa fa-circle online"></i> '.$data['from_user_name'].'</span>
        <span class="message-data-time">'.time_elapsed_string($data['timestamp']).'</span>
      </div>
      <div class="message my-message">
        '.$data['chat_message'].'
      </div>
    </li>';
    }else{
      $output .= '<li class="clearfix">
      <div class="message-data align-right">
        <span class="message-data-time" >'.time_elapsed_string($data['timestamp']).'</span> &nbsp; &nbsp;
        <span class="message-data-name" > '.$data['from_user_name'].'</span> <i class="fa fa-circle me"></i>

      </div>
      <div class="message other-message float-right">
      '.$data['chat_message'].'
      </div>
    </li>';
    }  
  }

  return $output;
}


// coutn total group message
function totalGroupMessageCount($current_company_id){
  global $dbconnect;
  $sql = "SELECT count(*) as total_group_message from chat_message where company_id='$current_company_id' and is_group_message=1";
  $query = mysqli_query($dbconnect,$sql);
  $data = mysqli_fetch_assoc($query);
  return $data['total_group_message'];
}



function fetch_user_last_activity($user_id){
  global $dbconnect;
  $sql = " SELECT * FROM login_details   WHERE user_id = '$user_id'   ORDER BY last_activity DESC   LIMIT 1  ";
  $query = mysqli_query($dbconnect,$sql);
  $data = mysqli_fetch_assoc($query);
  return $data['last_activity'] ?? '';
}

function messageSeen($to_user_id,$from_user_id,$current_company_id){
  global $dbconnect;
  $messageSeenStatusSql = "UPDATE chat_message  SET status = '1'  WHERE from_user_id = '{$to_user_id}' AND to_user_id = '{$from_user_id}' AND company_id='{$current_company_id}' AND is_group_message='0' AND status = '0'";
  $messageSeenStatusQuery = mysqli_query($dbconnect,$messageSeenStatusSql);
  if($messageSeenStatusQuery){
    return true;
  }else{
    return false;
  }
}


function countSeenMessage(int $from_user_id,int $my_user_id){
  global $dbconnect;
  $sql = "SELECT count(*) as total_unseen_message FROM chat_message WHERE from_user_id='{$from_user_id}' and to_user_id='$my_user_id'  and is_group_message='0'  and  status='0'";

  $query = mysqli_query($dbconnect,$sql);
  $data = mysqli_fetch_assoc($query);
  
  if($data['total_unseen_message'] == 0){
    return '';
  }else{
    return $data['total_unseen_message'];
  }
}
