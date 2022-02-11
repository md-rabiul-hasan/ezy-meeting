<?php
include 'database_connection.php';
if ( !isset( $_SESSION['id'] ) ) {
    header( "location:../login/login.php" );
    exit;
}
$company_id = $_SESSION['company_id'];
$user_id    = $_SESSION['id'];
$user_role  = $_SESSION['role_id'];

if(isset($_POST['monthYear'])){
    $monthYear = filter_input(INPUT_POST,'monthYear',FILTER_SANITIZE_STRING);
    $month     = date('m',strtotime("01-".$monthYear));
    $year      = date('Y',strtotime("01-".$monthYear));
    
    $sql = "SELECT meeting_date FROM meetings  
    inner join committees on meetings.committee_id = committees.id
    WHERE meetings.company_id='{$company_id}' 
    and  YEAR(meeting_date) = '$year' AND MONTH(meeting_date) = '{$month}' 
    and ( committees.chairman_id='{$user_id}' or find_in_set({$user_id},committees.committee_users) or '{$user_role}'='1'  or '{$user_role}'='2') 
    GROUP BY meeting_date";
  
    $query = mysqli_query($connect,$sql);
    $metingDateArray = [];
    while($data = mysqli_fetch_assoc($query)){
        array_push($metingDateArray,$data['meeting_date']);
    }
    echo json_encode($metingDateArray);
}