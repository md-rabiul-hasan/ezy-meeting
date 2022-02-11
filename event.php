<?php
include 'database_connection.php';

// $role_id    = $_SESSION['role_id'];
// $member_id  = $_SESSION['id'];
// $company_id = $_SESSION['company_id'];

// $query    = "SELECT *,mt.company_id as company_id,mt.id as id FROM meetings mt 
// left join committees cm on mt.committee_id=cm.id 
// WHERE mt.company_id='$company_id' and mt.is_open!=0 and (find_in_set('$member_id', cast(cm.committee_users as char)) > 0 or (find_in_set('$member_id', cast(cm.chairman_id as char)) > 0)) ";
// $queryRun = mysqli_query($connect, $query);

// while ($row = mysqli_fetch_array($queryRun)) {
//     $time   = date("h:i a", strtotime($row["meeting_time"]));
//     $title  = $time . " " . $row["title"];
//     $data[] = array(
//         'id'    => $row["id"],
//         'title' => $title,
//         'start' => $row["meeting_date"],
//         'end'   => $row["meeting_date"],
//     );
// }

// echo json_encode($data);

?>