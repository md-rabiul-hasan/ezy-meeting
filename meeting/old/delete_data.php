
<?php include '../../database_connection.php';?>
<?php
 session_start();
$company_id = $_SESSION['company_id'];
if(isset($_POST['meeting_id']))
{
	$meeting_id=$_POST['meeting_id'];
	 $allUserSql = "DELETE FROM meetings  WHERE meeting_id='$meeting_id'";
     $allUserQuery = mysqli_query($connect,$allUserSql);
     print "Meeting Deleted";;
}
?>