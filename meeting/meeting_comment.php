<?php 
    
    include '../database_connection.php';

    if (!isset($_SESSION['id'])) {
        header("location:../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];

    if (isset($_POST['meeting_comment']) && isset($_POST['meeting_id'])) {
        $meeting_comment = filter_input(INPUT_POST,'meeting_comment',FILTER_SANITIZE_STRING);
        $meeting_id = filter_input(INPUT_POST,'meeting_id',FILTER_SANITIZE_STRING);
        $sql = "INSERT INTO `meeting_comments`(`company_id`, `meeting_id`, `user_id`, `comment`) VALUES ('{$company_id}','{$meeting_id}','{$user_id}','{$meeting_comment}')";
        $query = mysqli_query($connect,$sql);
        if($query){
            echo true;
        }else{
            echo "Comment stroed failed";
        }
    }

?>