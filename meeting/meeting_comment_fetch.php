<?php 
    
    include '../database_connection.php';

    if (!isset($_SESSION['id'])) {
        header("location:../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];

    if (isset($_POST['meeting_id'])) {
        $meeting_id = filter_input(INPUT_POST,'meeting_id',FILTER_SANITIZE_STRING);
        $sql = "SELECT meeting_comments.*,users.name,users.avatar FROM meeting_comments
        inner join users on meeting_comments.user_id = users.id 
        where meeting_id='{$meeting_id}' and meeting_comments.company_id='{$company_id}'";
        $query = mysqli_query($connect,$sql);
        $output = '<ul class="list-unstyled widget-user-list card-body">';
        while($data = mysqli_fetch_assoc($query)){
            $dateTime = date('jS F,Y h:i a', strtotime($data['created_at']));
            if($data['avatar'] == '' || $data['avatar'] == NULL){
                $avatar = "assets/demo/users/6.jpg";
            }else{
                $avatar = $data['avatar'];
            }
            $output .= '
            <li class="media">
            <div class="d-flex mr-3 mr-0-rtl ml-3-rtl">
                <a href="#" class="thumb-xs">
                    <img src="'.$addDot.$avatar.'" class="rounded-circle" alt="">
                </a>
            </div>
            <div class="media-body">
                <h5 class="media-heading"><a href="#">'.$data['name'].' ( '. $dateTime.' ) </a> <small>'.$data['comment'].'</small></h5>
            </div>
        </li>';
        }
        $output .= ' </ul>';
        echo $output;
    }

?>
