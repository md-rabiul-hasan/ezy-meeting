<?php
include 'database_connection.php';

if (!isset($_SESSION['id'])) {
    header("location:../login/login.php");
    exit;
}
$company_id = $_SESSION['company_id'];
$user_id    = $_SESSION['id'];

date_default_timezone_set("Asia/Dhaka");

if (isset($_POST['meeting_date'])) {
    $meeting_date      = date('Y-m-d', strtotime(filter_input(INPUT_POST, 'meeting_date', FILTER_SANITIZE_STRING)));
    $selectedYear      = date('Y', strtotime($meeting_date));
    $selectedDayNumber = date('d', strtotime($meeting_date));
    $selectedDayName   = date("l", strtotime($meeting_date));

    if ($meeting_date == date('Y-m-d')) {
        $meetingDay = "Today";
    } else {
        $meetingDay = date('dS F, Y', strtotime($meeting_date));
    }

    $output = <<<HOD
    <div class="datas">
        <h2>%s</h2>
        <h3>%s</h3>
        <span class="dayname">%s</span>
    </div>
    <div class="meetinginfo">
        <div class="todaymeeting">%s Meeting</div>
        %s
    </div>
    <div class="meetinginfo recent">
        <div class="todaymeeting">Recent Meeting</div>
        %s
    </div>
HOD;
    $output = sprintf($output, $selectedYear, $selectedDayNumber, $selectedDayName, $meetingDay, calanderDateMeetingList($company_id, $user_id, $meeting_date), recentMeetingList($company_id, $user_id, $meeting_date));
    echo $output;

}

function calanderDateMeetingList($company_id, $user_id, $meeting_date) {
    global $connect;
    if(userRoleId($user_id) == 3){ // 3 means member
        $sql  = "SELECT ui.role_id, 
                m.id, 
                title, 
                meeting_time 
            FROM   meetings m 
                LEFT JOIN committee_users cu 
                    ON m.committee_id = cu.committee_id 
                LEFT JOIN users ui 
                    ON cu.user_id = ui.id 
            WHERE  m.company_id = '{$company_id}' 
                AND m.meeting_date = '{$meeting_date}'
                AND m.is_open IN ( 1, 2, 3 ) 
                AND ( cu.user_id = '{$user_id}' ) ";
    }else{
        $sql ="SELECT id, 
                    title, 
                    meeting_time 
            FROM   meetings 
            WHERE  company_id = '{$company_id}' 
                    AND meeting_date = '{$meeting_date}'
                    AND is_open IN ( 1, 2 , 3) ";
    }

    $query                  = mysqli_query($connect, $sql);
    $rowCount               = mysqli_num_rows($query);
    $selectedDayMeetingList = '';
    if ($rowCount > 0) {
        while ($data = mysqli_fetch_assoc($query)) {
            $selectedDayMeetingList .= '<p class="meetingtitle"><a href="meeting/meeting.php?id='.$data['id'].'"> <i class="fa fa-circle"></i>&nbsp;' . $data['title'] . '</a>
            <br><small class="timeshow"><i class="fa fa-clock-o"></i> '.date('h:i a',strtotime($data['meeting_time'])).'</small></p>';
        }
    } else {
        $selectedDayMeetingList .= '<p class="meetingtitle"><a href="#"> <i class="fa fa-circle"></i>&nbsp; No Meeting Found </a></p>';
    }

    return $selectedDayMeetingList;
}

function recentMeetingList($company_id, $user_id, $meeting_date) {
    global $connect;
    $sql              = "SELECT id,title,meeting_time,meeting_date FROM meetings WHERE company_id='{$company_id}' and meeting_date<'{$meeting_date}' and is_open=2  order by meeting_date DESC limit 2";
    $query            = mysqli_query($connect, $sql);
    $rowCount         = mysqli_num_rows($query);
    $recentMeetinList = '';
    if ($rowCount > 0) {
        while ($data = mysqli_fetch_assoc($query)) {
            $recentMeetinList .= '<p class="meetingtitle"><span>' . date('d F', strtotime($data['meeting_date'])) . '</span> <a href="meeting/meeting.php?id=' . $data['id']. '"> ' . $data['title'] . '</a></p>';
        }
    } else {
        $recentMeetinList .= '<p class="meetingtitle"><span></span> <a href="#"> No Recent Meeting</a></p>';
    }

    return $recentMeetinList;
}
