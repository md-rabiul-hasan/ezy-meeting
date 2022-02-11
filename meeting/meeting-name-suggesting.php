
<?php include '../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];

    if (isset($_POST['committee_id'])) {
        $committee_id = mysqli_real_escape_string($connect, trim($_POST['committee_id']));

        $committeeNameDatta = mysqli_fetch_array(mysqli_query($connect,"SELECT name from committees where id='$committee_id'"));


        $meetingNameSuggestingQuery = mysqli_query($connect, "SELECT COUNT(*) as total_meeting from meetings WHERE company_id='$company_id' and committee_id='$committee_id'");
        $meetingNameSuggestingData = mysqli_fetch_array($meetingNameSuggestingQuery);
        $thisCommitteeTotalMeeting = $meetingNameSuggestingData['total_meeting'];
        $currentMeetingNumber = $thisCommitteeTotalMeeting + 1;


        $ends = array('th','st','nd','rd','th','th','th','th','th','th');
        if (($currentMeetingNumber %100) >= 11 && ($currentMeetingNumber%100) <= 13){
            $abbreviation = $currentMeetingNumber. 'th';
        }else{
            $abbreviation = $currentMeetingNumber. $ends[$currentMeetingNumber % 10];
        }

        $suggestingMeetingName = sprintf("%s %s Meeting",$committeeNameDatta['name'],$abbreviation);
        echo $suggestingMeetingName;
        

    }

?>