<?php
// committee log
function committeeHistory($committee_id, $company_id, $name, $description, $prefix, $quorum, $current_index, $committee_users, $chairman_id, $entry_user_id, $operation_text, $operation_user_id) {
    global $connect;
    $sql = "INSERT INTO `committees_history`(`committee_id`, `company_id`, `name`, `description`, `prefix`, `quorum`, `current_index`, `committee_users`, `chairman_id`, `entry_user_id`, `operation_text`, `operation_user_id`)
        VALUES  ($committee_id,$company_id,'$name','$description','$prefix','$quorum','$current_index','$committee_users','$chairman_id','$entry_user_id','$operation_text','$operation_user_id')";
    $query = mysqli_query($connect, $sql);
    if (!$query) {
        die("Committee Log Generate Failed");
    }
}

// meeting log
function meetingHistory($meeting_id, $meeting_unique_id, $company_id, $committee_id, $chairman_id, $title, $meeting_date, $meeting_time, $location, $is_open, $entry_user_id, $operation_text, $operation_user_id) {
    global $connect;
    $sql = "INSERT INTO `meetings_history`(`meeting_id`, `meeting_unique_id`, `company_id`, `committee_id`, `chairman_id`, `title`, `meeting_date`, `meeting_time`, `location`, `is_open`, `entry_user_id`, `operation_text`, `operation_user_id`)
         VALUES
         ('$meeting_id','$meeting_unique_id','$company_id','$committee_id','$chairman_id','$title','$meeting_date','$meeting_time','$location','$is_open','$entry_user_id','$operation_text','$operation_user_id')";
    $query = mysqli_query($connect, $sql);
    if (!$query) {
        die("Meeting Log Generate Failed");
    }

}

// meeting Activaty History
function meetingActivatyHistory($meeting_id, $company_id, $operation_text, $operation_user_id) {
    global $connect;
    $sql   = "INSERT INTO `meeting_activaty_history`(`meeting_id`, `company_id`, `operation_text`, `operation_user_id`) VALUES ('$meeting_id','$company_id','$operation_text','$operation_user_id')";
    $query = mysqli_query($connect, $sql);
    if (!$query) {
        die("Meeting Acticaty Log Generate Failed");
    }
}

// meeting_attendance_activity_history
function meetingAttendanceActivityHistory($attendance_id, $company_id, $meeting_id, $operations_text, $operation_user_id) {
    global $connect;
    $sql = "INSERT INTO `meeting_attendance_activity_history`(`attendance_id`, `company_id`, `meeting_id`, `operations_text`, `operation_user_id`)
     VALUES ('$attendance_id','$company_id','$meeting_id','$operations_text','$operation_user_id')";
    $query = mysqli_query($connect, $sql);
    if (!$query) {
        die("Meeting Attendance Activaty Log Generate Failed");
    }
}

// agenda history
function agendaHistory($agenda_id, $company_id, $meeting_id, $title, $memo_id, $division_id, $client, $amount, $explanatory_template_id, $explanatory_description, $memo_file, $resolved_template_id, $resolved_description, $minute_file, $agenda_sl, $agenda_prefix, $entry_user_id, $operation_text, $operation_user_id) {
    global $connect;
    $explanatory_description = str_replace("'", "", $explanatory_description);
    $explanatory_description = str_replace('"', "", $explanatory_description);
    $resolved_description    = str_replace("'", "", $resolved_description);
    $resolved_description    = str_replace('"', "", $resolved_description);
    $sql                     = "INSERT INTO `agendas_history`( `agenda_id`, `company_id`, `meeting_id`, `title`, `memo_id`, `division_id`, `client`, `amount`, `explanatory_template_id`, `explanatory_description`, `memo_file`, `resolved_template_id`, `resolved_description`, `minute_file`, `agenda_sl`, `agenda_prefix`, `entry_user_id`, `operation_text`, `operation_user_id`)
     VALUES ('$agenda_id','$company_id','$meeting_id','$title','$memo_id','$division_id','$client','$amount','$explanatory_template_id','$explanatory_description','$memo_file','$resolved_template_id','$resolved_description','$minute_file','$agenda_sl','$agenda_prefix','$entry_user_id','$operation_text','$operation_user_id')";

    $query = mysqli_query($connect, $sql);
    if (!$query) {
        die("Agendas Log Generate Failed");
    }
}

// settings history
function settingHistory($setting_id, $company_id, $agenda_pefix, $meeting_signatory_name, $meeting_signatory_designation, $entry_user_id, $operation_text, $operation_user_id) {
    global $connect;
    $sql = "INSERT INTO `setting_history`(`setting_id`, `company_id`, `agenda_pefix`, `meeting_signatory_name`, `meeting_signatory_designation`, `entry_user_id`, `operation_text`, `operation_user_id`)
    VALUES ('$setting_id','$company_id','$agenda_pefix','$meeting_signatory_name','$meeting_signatory_designation','$entry_user_id','$operation_text','$operation_user_id')";
    $query = mysqli_query($connect, $sql);
    if (!$query) {
        die("Setting Log Generate Failed");
    }
}

// find out meeting id from meeting unique id
function meetingId($meeting_unique_id) {
    global $connect;
    $sql   = "SELECT id FROM meetings WHERE meeting_unique_id='$meeting_unique_id'";
    $query = mysqli_query($connect, $sql);
    $data  = mysqli_fetch_array($query);
    return $data['id'];
}

// user activaty
function userActivity($company_id, $user_id, $page_name) {
    global $addDot;
    $dateTime      = new DateTime('now', new DateTimezone('Asia/Dhaka'));
    $visiting_date = $dateTime->format('jS F, Y');
    $visiting_time = $dateTime->format('h:i:s a');
    $folderPath    = sprintf("%sstorage/company/%d/user-activity/", $addDot, $company_id);

    $createFolder = sprintf("%sstorage/company/%d/user-activity", $addDot, $company_id);

    if (!file_exists($folderPath)) {
        mkdir($createFolder, 0777, true);
    }

    $filename = date('Y-m-d') . '.txt';
    $fileurl  = $folderPath . $filename;

    if (!file_exists($fileurl)) {
        file_put_contents($fileurl, 'company-id|user-id|page-name|visiting-date|visiting-time');
    }

    $myfile  = fopen($fileurl, "a") or die("Unable to open file!");
    $content = sprintf("%d|%d|%s|%s|%s", $company_id, $user_id, $page_name, $visiting_date, $visiting_time);
    fwrite($myfile, PHP_EOL . $content);
    fclose($myfile);

}

ini_set('SMTP', "http://ezy-meeting.com/ezy-meeting/");
ini_set('smtp_port', "25");
ini_set('sendmail_from', "rabiul.fci@gmail.com");

// Send Mail Function
function sendMail($to,$name,$header,$msg,$attachment=null) {
    return true;
    global $addDot;
    define("DEMO", false);
    $template_file = $addDot."template_email_activation.php";
    $email_from    = "EZYMEETING";
    $swap_var      = array(
        "{SITE_ADDR}"   => "http://ezy-meeting.com/ezy-meeting/",
        "{EMAIL_LOGO}"  => "http://ezy-meeting.com/ezy-meeting/landing-assets/logo.png",
        "{EMAIL_TITLE}" => $header,
        "{CUSTOM_URL}"  => "http://ezy-meeting.com/ezy-meeting/",
        "{CUSTOM_IMG}"  => "http://ezy-meeting.com/ezy-meeting/landing-assets/logo.png",
        "{TO_NAME}"     => $name,
        "{TO_EMAIL}"    => $to,
        "{EMAIL_BODY}"  => $msg,
    );
    $email_headers = "From: " . $email_from . "\r\nReply-To: " . $email_from . "\r\n";
    $email_headers .= "MIME-Version: 1.0\r\n";
    $email_headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $email_to      = $swap_var['{TO_EMAIL}'];
    $email_subject = $swap_var['{EMAIL_TITLE}'];
    if (file_exists($template_file)) {
        $email_message = file_get_contents($template_file);
    } else {
        die("Unable to locate your template file");
    }

    foreach (array_keys($swap_var) as $key) {
        if (strlen($key) > 2 && trim($swap_var[$key]) != '') {
            $email_message = str_replace($key, $swap_var[$key], $email_message);
        }

    }
    if (mail($email_to, $email_subject, $email_message, $email_headers)) {
        return 1;
    } else {
        return 0;
    }

}

// company total user count
function companyTotalUser($company_id) {
    if (isset($company_id)) {
        global $connect;
        $sql   = "SELECT count(*) as total_user from users where company_id='$company_id' ";
        $query = mysqli_query($connect, $sql);
        $data  = mysqli_fetch_array($query);
        return $data['total_user'];
    } else {
        return false;
    }
}

// compnay user count
function companyPackageUser(int $company_id) {
    if (isset($company_id)) {
        global $connect;
        $sql = "SELECT pi.committee_member FROM package_info pi
        inner join companies com on pi.sl=com.package_id WHERE com.id='$company_id' ";
        $query          = mysqli_query($connect, $sql);
        $data           = mysqli_fetch_array($query);
        $companyMaxUser = $data['committee_member'];

        if ($companyMaxUser > companyTotalUser($company_id)) {
            return true;
        } else {
            return false;
        }

    }
}

// company total super admin count
function companyTotalSuperAdmin(int $company_id) {
    if (isset($company_id)) {
        global $connect;
        $sql   = "SELECT count(*) as total_super_admin from users where company_id='$company_id' and role_id='1' "; // role_id 1 means super admin
        $query = mysqli_query($connect, $sql);
        $data  = mysqli_fetch_array($query);
        return $data['total_super_admin'];
    } else {
        return false;
    }
}

// check super admin creation enable or not
function maxCreateSuperAdmin(int $company_id) {
    if (isset($company_id)) {
        global $connect;
        $sql = "SELECT pi.super_admin FROM package_info pi
        inner join companies com on pi.sl=com.package_id WHERE com.id='$company_id' ";
        $query                = mysqli_query($connect, $sql);
        $data                 = mysqli_fetch_array($query);
        $companyMaxSuperAdmin = $data['super_admin'];
        return $companyMaxSuperAdmin;

    }
}

// check user role
function isSuperAdmin($company_id, $user_id) {
    if (isset($company_id) && isset($user_id)) {
        global $connect;
        $sql      = "SELECT * from users where company_id='$company_id' and id='$user_id' and role_id='1' "; // role_id 1 means super admin
        $query    = mysqli_query($connect, $sql);
        $rowCount = mysqli_num_rows($query);
        if ($rowCount > 0) {
            return true;
        } else {
            return false;
        }
    }
}

// company total committee
function companyTotalCommittee(int $company_id) {
    if (isset($company_id)) {
        global $connect;
        $sql   = "SELECT count(id) as total_committees from committees where company_id='$company_id'"; // role_id 1 means super admin
        $query = mysqli_query($connect, $sql);
        $data  = mysqli_fetch_array($query);
        return $data['total_committees'];
    } else {
        return false;
    }
}

// check committee create or not
function isEanableComitteCreate(int $company_id): bool {
    if (isset($company_id)) {
        global $connect;
        $sql = "SELECT pi.number_of_committee FROM package_info pi
        inner join companies com on pi.sl=com.package_id WHERE com.id='$company_id' ";
        $query               = mysqli_query($connect, $sql);
        $data                = mysqli_fetch_array($query);
        $companyMaxCommittee = $data['number_of_committee'];

        if ($companyMaxCommittee > companyTotalCommittee($company_id)) {
            return true;
        } else {
            return false;
        }
    }
}

// is video call enable check
function isEnableVideoCall(int $company_id): bool {
    if (isset($company_id)) {
        global $connect;
        $sql = "SELECT pi.video_calling FROM package_info pi
        inner join companies com on pi.sl=com.package_id WHERE com.id='$company_id' ";
        $query            = mysqli_query($connect, $sql);
        $data             = mysqli_fetch_array($query);
        $companyVideoCall = $data['video_calling'];

        if ($companyVideoCall > 0) {
            return true;
        } else {
            return false;
        }
    }
}

// package disk space
function packageDisk(int $company_id) {
    if (isset($company_id)) {
        global $connect;
        $sql = "SELECT pi.storage FROM package_info pi
        inner join companies com on pi.sl=com.package_id WHERE com.id='$company_id' ";
        $query          = mysqli_query($connect, $sql);
        $data           = mysqli_fetch_array($query);
        $companyStorage = $data['storage'];
        return $companyStorage;
    }
}

function usesDisk(int $company_id) {
    $path       = getcwd() . DIRECTORY_SEPARATOR . "storage" . DIRECTORY_SEPARATOR . "company" . DIRECTORY_SEPARATOR . "{$company_id}";
    $bytestotal = 0;
    $path       = realpath($path);
    if ($path !== false && $path != '' && file_exists($path)) {
        foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object) {
            $bytestotal += $object->getSize();
        }
    }

    if ($bytestotal >= 1073741824) {
        $bytestotal = number_format($bytestotal / 1073741824, 2) . ' GB';
    } elseif ($bytestotal >= 1048576) {
        $bytestotal = number_format($bytestotal / 1048576, 2) . ' MB';
    } elseif ($bytestotal >= 1024) {
        $bytestotal = number_format($bytestotal / 1024, 2) . ' KB';
    } elseif ($bytestotal > 1) {
        $bytestotal = $bytestotal . ' bytes';
    } elseif ($bytestotal == 1) {
        $bytestotal = $bytestotal . ' byte';
    } else {
        $bytestotal = '0 bytes';
    }

    return $bytestotal;

}

// find out role name from role id
function roleName(int $role_id) {
    if ($role_id == 1) {
        return "super-admin";
    } else if ($role_id == 2) {
        return "admin";
    } else if ($role_id == 3) {
        return "member";
    } else {
        return '';
    }
}

// insert login details
function loginDetails(int $userId) {
    global $connect;
    $sql   = "INSERT INTO login_details (`user_id`) VALUES ('$userId')";
    $query = mysqli_query($connect, $sql);
    if ($query) {
        return true;
    } else {
        return false;
    }

}

function is_superAdminEnable(int $company_id) {
    if (maxCreateSuperAdmin($company_id) > companyTotalSuperAdmin($company_id)) {
        return true;
    } else {
        return false;
    }
}

function findOutLastInsetUserId($email, $company_id) {
    global $connect;
    $sql   = "SELECT id FROM users WHERE email='{$email}' and company_id='{$company_id}' LIMIT 1";
    $query = mysqli_query($connect, $sql);
    $data  = mysqli_fetch_assoc($query);
    return $data['id'];
}

function get_percentage($total, $number) {
    if ($total > 0) {
        return round($number / ($total / 100), 2);
    } else {
        return 0;
    }
}

function committeUsers($company_id, $commitee_id) {
    global $connect;
    $sql             = "SELECT chairman_id,committee_users FROM committees WHERE id='{$commitee_id}' and company_id='{$company_id}'";
    $query           = mysqli_query($connect, $sql);
    $data            = mysqli_fetch_assoc($query);
    $chairman_id     = $data['chairman_id'];
    $committee_users = $data['committee_users'];
    $notice_users    = $chairman_id . "," . $committee_users;
    return $notice_users;
}

function noticeToUsers($company_id, $to_users) {
    global $connect;
    $sql       = "SELECT name FROM users WHERE company_id='{$company_id}' and id in ({$to_users})";
    $query     = mysqli_query($connect, $sql);
    $nameArray = [];
    while ($data = mysqli_fetch_assoc($query)) {
        $nameArray[] = $data['name'];
    }
    $noticeToUserList = join(', ', $nameArray);
    return $noticeToUserList;
}

// add commitedd membe when new user create with selected comitte
function addCommitteeMember($company_id, $committee_id, $new_user_id) {
    global $connect;
    $sql                 = "SELECT name,committee_users FROM committees  where company_id='{$company_id}' and id='{$committee_id}' ";
    $query               = mysqli_query($connect, $sql);
    $data                = mysqli_fetch_assoc($query);
    $committee_name      = $data['name'];
    $old_committee_users = $data['committee_users'];
    if ($old_committee_users != '') {
        $new_committee_users = $old_committee_users . "," . $new_user_id;
    } else {
        $new_committee_users = $new_user_id;
    }

    $updateSql   = "UPDATE committees SET committee_users='{$new_committee_users}' where company_id='{$company_id}' and id='{$committee_id}'";
    $updateQuery = mysqli_query($connect, $updateSql);
    if ($updateQuery) {
        $insertCommitteeUsers = mysqli_query($connect, "INSERT INTO committee_users (`company_id`, `committee_id`, `user_id`) VALUES ('{$company_id}','{$committee_id}','{$new_user_id}')");
        if ($insertCommitteeUsers) {
            updateMeetingChaimanAndUsers($company_id, $committee_id);
            // mail send funciton
            userAddedCommitteeMail($company_id, $committee_id, $new_user_id);
            // mail send function  edn
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

// check user data has been stored in profile table or not
function userDataCheckInProfiTable(int $company_id, int $user_id) {
    global $connect;
    $sql      = "SELECT id FROM `user_profiles` WHERE company_id='{$company_id}' and user_id={$user_id}";
    $query    = mysqli_query($connect, $sql);
    $rowCount = mysqli_num_rows($query);
    if ($rowCount > 0) {
        return true;
    } else {
        return false;
    }
}

// url id encrpted
function encryptData($data) {
    $encryptedData = base64_encode($data);
    return $encryptedData;
}

// url id decrypted
function decryptData($encryptedData) {
    $decryptedData = base64_decode($encryptedData);
    return $decryptedData;
}

// check meeting is publish or not
function isMeetingPublish(int $company_id, int $meeting_id) {
    global $connect;
    $sql   = "SELECT is_open FROM meetings WHERE id='{$meeting_id}' and company_id='{$company_id}'";
    $query = mysqli_query($connect, $sql);
    $data  = mysqli_fetch_assoc($query);
    if ($data['is_open'] == 1) {
        return true;
    } else {
        return false;
    }
}

// check meeitng is not publish or not
function isMeetingNotPublish(int $company_id, int $meeting_id) {
    global $connect;
    $sql   = "SELECT is_open FROM meetings WHERE id='{$meeting_id}' and company_id='{$company_id}'";
    $query = mysqli_query($connect, $sql);
    $data  = mysqli_fetch_assoc($query);
    if ($data['is_open'] == 0) {
        return true;
    } else {
        return false;
    }
}

// check is meeting close
function isMeetingClose(int $company_id, int $meeting_id) {
    global $connect;
    $sql   = "SELECT is_open FROM meetings WHERE id='{$meeting_id}' and company_id='{$company_id}'";
    $query = mysqli_query($connect, $sql);
    $data  = mysqli_fetch_assoc($query);
    if ($data['is_open'] == 2) {
        return true;
    } else {
        return false;
    }
}

// check is meeting end
function isMeetingEnd(int $company_id, int $meeting_id) {
    global $connect;
    $sql   = "SELECT is_open FROM meetings WHERE id='{$meeting_id}' and company_id='{$company_id}'";
    $query = mysqli_query($connect, $sql);
    $data  = mysqli_fetch_assoc($query);
    if ($data['is_open'] == 3) {
        return true;
    } else {
        return false;
    }
}

// find out committe member and update meeting member table for future hisotry
function addMeetingMemberList(int $company_id, int $meeting_id, int $committee_id) {
    global $connect;
    $sql                   = "SELECT chairman_id,committee_users FROM committees WHERE id='{$committee_id}' and company_id='{$company_id}'";
    $query                 = mysqli_query($connect, $sql);
    $data                  = mysqli_fetch_assoc($query);
    $chairman_id           = $data['chairman_id'];
    $committee_users       = $data['committee_users'];
    $updateMeetingTableSql = "UPDATE meetings SET chairman_id='{$chairman_id}',member_list='{$committee_users}' where company_id='{$company_id}' and id='{$meeting_id}' LIMIT 1";
    $updateMeetingQuery    = mysqli_query($connect, $updateMeetingTableSql);
    if ($updateMeetingQuery) {
        return true;
    } else {
        return false;
    }
}

// check meeting agenda create or not
function isAgendaFound($company_id, $meeting_id) {
    global $connect;
    $sql      = "SELECT id FROM agendas WHERE company_id='{$company_id}' and meeting_id='{$meeting_id}'";
    $query    = mysqli_query($connect, $sql);
    $rowCount = mysqli_num_rows($query);
    if ($rowCount > 0) {
        return true;
    } else {
        return false;
    }
}

// findout compnay id with email after companee regisation
function getCompanyId($email) {
    global $connect;
    $sql      = "SELECT id FROM companies WHERE email='{$email}' order by id DESC limit 1";
    $query    = mysqli_query($connect, $sql);
    $data     = mysqli_fetch_assoc($query);
    $rowCount = mysqli_num_rows($query);
    if ($rowCount > 0) {
        return $data['id'];
    } else {
        return false;
    }
}

// check meeting notice already uploaded or not
function alreadyNoticeUploaded($company_id, $meeting_id) {
    global $connect;
    $sql      = "SELECT * FROM   meeting_notices where company_id='{$company_id}' and meeting_id='{$meeting_id}'";
    $query    = mysqli_query($connect, $sql);
    $rowCount = mysqli_num_rows($query);
    if ($rowCount > 0) {
        return true;
    } else {
        return false;
    }
}

// check meeting signed minute upload or not
function alreadyMeetingSignedMinuteUpload($company_id, $meeting_id) {
    global $connect;
    $sql      = "SELECT * FROM   signed_minute_uploads where company_id='{$company_id}' and meeting_id='{$meeting_id}'";
    $query    = mysqli_query($connect, $sql);
    $rowCount = mysqli_num_rows($query);
    if ($rowCount > 0) {
        return true;
    } else {
        return false;
    }
}

// compnay committee users list
function createCommitteeUsers(int $company_id, int $committee_id, $committee_users): bool {
    global $connect;
    foreach ($committee_users as $committee_single_user) {
        $sql   = "INSERT INTO `committee_users`(`company_id`, `committee_id`, `user_id`) VALUES ('{$company_id}','{$committee_id}','{$committee_single_user}')";
        $query = mysqli_query($connect, $sql);
        if (!$query) {            
            return false;
        }
        $userInfo = userNameEmail($company_id, $committee_single_user);
        $userName = $userInfo['name'];
        $userEmail = $userInfo['email'];
        $committeeName = committeName($company_id,$committee_id);
        $message = "You are added in {$committeeName} committee as a membee";
        if( sendMail($userEmail, $userName, "Ezy-Meeting committee", $message) == false){
           die("Mail Sent Failed");
        }
    }
    return true;
}

// creat committe chairman
function createCommitteeChairman(int $company_id, int $committee_id, int $chairman_id) {
    global $connect;
    $sql   = "INSERT INTO `committee_users`(`company_id`, `committee_id`, `user_id`,`is_chairman`) VALUES ('{$company_id}','{$committee_id}','{$chairman_id}','1')";
    $query = mysqli_query($connect, $sql);
    if (!$query) {
        return false;
    } else {
        $userInfo = userNameEmail($company_id, $chairman_id);
        $userName = $userInfo['name'];
        $userEmail = $userInfo['email'];
        $committeeName = committeName($company_id,$committee_id);
        $message = "You are added in {$committeeName} committee and you are the chairman of {$committeeName}";
        if( sendMail($userEmail, $userName, "Ezy-Meeting committee", $message) == false){
            die("Mail Sent Failed");
         }
        return true;
    }
}

// committee chairman id
function getCommitteChairmanId(int $company_id, int $committee_id) {
    global $connect;
    $sql   = "SELECT user_id FROM committee_users WHERE company_id='{$company_id}' and committee_id='{$committee_id}' and is_chairman=1 limit 1";
    $query = mysqli_query($connect, $sql);
    $data  = mysqli_fetch_array($query);
    return $data['user_id'];
}

// committee users
function getCommitteeUsers(int $company_id, int $committee_id) {
    global $connect;
    $sql   = "SELECT committee_users FROM committees WHERE company_id='{$company_id}' and id='{$committee_id}' limit 1";
    $query = mysqli_query($connect, $sql);
    $data  = mysqli_fetch_array($query);
    return $data['committee_users'];
}

// when committe update if meeting does not close then work
function updateMeetingChaimanAndUsers(int $company_id, int $committee_id) {
    global $connect;
    $sql                = "SELECT chairman_id,committee_users FROM committees WHERE company_id='{$company_id}' and id='{$committee_id}' limit 1";
    $query              = mysqli_query($connect, $sql);
    $data               = mysqli_fetch_array($query);
    $committee_chairman = $data['chairman_id'];
    $committee_users    = $data['committee_users'];
    $updateMeetingInfo  = mysqli_query($connect, "UPDATE meetings SET chairman_id='{$committee_chairman}',member_list='{$committee_users}' WHERE company_id='{$company_id}' and committee_id='{$committee_id}' and (is_open=1 or is_open=0)");
    if ($updateMeetingInfo) {
        return true;
    } else {
        return false;
    }
}

// findout committee user list
function committeUsersList($company_id, $type_id, $attachment = null,$title=null) {
    global $connect;
    $committee_id = implode(",", $type_id);
    $sql          = "SELECT user_id FROM committee_users WHERE company_id='{$company_id}' and  committee_id in ($committee_id) GROUP BY user_id";
    $query        = mysqli_query($connect, $sql);
    $user_list    = [];
    while ($data = mysqli_fetch_assoc($query)) {
        array_push($user_list, $data['user_id']);
        // sent mail whent notice published
        if($attachment != null){
            $userInfo = userNameEmail($company_id,$data['user_id']);
            $email = $userInfo['email'];
            $name = $userInfo['name'];
            if( sendMail($email,$name,"Ezy-Meeting Notice",$title,$attachment) == false){
                die("Mail sent fail");
            }
            
        }else{
            $userInfo = userNameEmail($company_id,$data['user_id']);
            $email = $userInfo['email'];
            $name = $userInfo['name'];
            if( sendMail($email,$name,"Ezy-Meeting Notice",$title) == false){
                die("Mail sent fail");
            }
        }

        // sent mail end
    }
    $user_list = join(",", $user_list);
    return $user_list;
}

// function user meeting attendance check
function isUserMeetingAttendence(int $company_id, int $meeting_id, int $user_id) {
    global $connect;
    $sql      = "SELECT attendance_members.is_attend FROM meetings INNER JOIN attendances ON meetings.id=attendances.meeting_id  INNER JOIN attendance_members ON attendances.id=attendance_members.attendance_id   WHERE meetings.id='{$meeting_id}' AND attendance_members.user_id='{$user_id}' AND attendance_members.company_id='{$company_id}' LIMIT 1";
    $query    = mysqli_query($connect, $sql);
    $rowCount = mysqli_num_rows($query);
    if ($rowCount > 0) {
        $data = mysqli_fetch_assoc($query);
        if ($data['is_attend'] == 1) {
            return true;
        } else {
            return false;
        }
    } else {
        return 2; // means attendance does not create
    }
}

// check meeting attendance open or not
function isMeetingAttendanceActive(int $company_id, int $meeting_id) {
    global $connect;
    $sql   = "SELECT attendances.is_open AS meeting_attendance_status FROM meetings INNER JOIN attendances ON meetings.id=attendances.meeting_id   WHERE meetings.id='{$meeting_id}' AND meetings.company_id='{$company_id}' ";
    $query = mysqli_query($connect, $sql);
    $data  = mysqli_fetch_assoc($query);
    if ($data['meeting_attendance_status'] == 1) {
        return true;
    } else {
        return false;
    }
}

// finding attendance id with meeting idcommitteUsersList
function getAttendanceId(int $company_id, int $meeting_id) {
    global $connect;
    $sql      = "SELECT id FROM attendances WHERE company_id='{$company_id}' and meeting_id='{$meeting_id}' ORDER BY id DESC LIMIT 1";
    $query    = mysqli_query($connect, $sql);
    $rowCount = mysqli_num_rows($query);
    if ($rowCount > 0) {
        $data = mysqli_fetch_assoc($query);
        return $data['id'];
    } else {
        return false;
    }
}

// Mail Template Create
function mailBody($toUserFullname, $subject, $message) {
    $mailTemplateDesign = <<<MAILTEMPLATE
    <!DOCTYPE HTML>
<html>
   <head>
      <meta http-equiv="content-type" content="text/html" />
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <style>
      body{

      }
      .logo img {
            width: 188px;
            height: auto;
        }
        .subject {
            margin-top: 13px;
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 10px;
        }
        .greeting_section span {
            font-weight: 700;
        }
        .message_section {
            margin: 20px 0px;
            color: #777;
        }
        .project_name {
            font-weight: bold;
            padding-bottom: 5px;
        }

        .powered_by_section {
            font-size: 13px;
            color: #777;
        }
      </style>
   </head>
   <body>
      <div style="max-width: 400px;margin:50px  auto;">
         <div style="border: 1px solid #eaeaea;border-top: 3px solid #2d52e8;border-radius: 3px;padding: 30px 15px;box-shadow: 0px 0px 4px #d5d5d5;">
            <div style="text-align:center" class="logo">
               <a target="_blank" href="http://ezy-meeting.com/ezy-meeting/">
                    <img src="http://ezy-meeting.com/demo/assets/img/logo-dark.png" width="120px" alt="EzyMeeting Logo" style="display: inline-block" />
               </a>
            </div>
            <div class="subject">Subject :
                {$subject}
            </div>
            <div class="greeting_section">
                <span>Dear </span> {$toUserFullname},
            </div>
            <div class="message_section">
               {$message}
            </div>
            <div class="project_name">
                Ezy-Meeting
            </div>
            <div class="powered_by_section">
                Powered by Venture Solution Limited
            </div>
         </div>
      </div>
   </body>
</html>
MAILTEMPLATE;
    return $mailTemplateDesign;
}

// single user added committee and send mail
function userAddedCommitteeMail($company_id, $committee_id, $user_id) {

    global $connect;
    $sql   = "SELECT name,email FROM users WHERE company_id='{$company_id}' and id='{$user_id}'";
    $query = mysqli_query($connect, $sql);
    $userinfo  = mysqli_fetch_assoc($query);

    $userName  = $userinfo['name'];
    $userEmail = $userinfo['email'];

    $committeeName = committeName($company_id, $committee_id);

    $massage = "You are added in {$committeeName} committee.";
    sendMail($userEmail, $userName, "Ezy-Meeting committee", $massage);
}

// find out committee name by committe id
function committeName(int $company_id, int $committee_id) {
    global $connect;
    $committeeNameData = mysqli_fetch_assoc(mysqli_query($connect, "SELECT name FROM committees WHERE company_id='{$company_id}' and id='{$committee_id}' "));
    return $committeeNameData['name'];
}

// find out user name end email
function userNameEmail(int $company_id, int $user_id) {
    global $connect;
    $sql   = "SELECT name,email FROM users WHERE company_id='{$company_id}' and id='{$user_id}'";
    $query = mysqli_query($connect, $sql);
    $data  = mysqli_fetch_assoc($query);
    return $data;
}

// function meeting unique id
function meetingUniqueId($meeting_id){
    global $connect;
    $sql = "SELECT meeting_unique_id from meetings WHERE id='{$meeting_id}'";
    $query = mysqli_query($connect,$sql);
    $data = mysqli_fetch_array($query);
    return $data['meeting_unique_id'];
}


// zoom meetign call information
function zoomMeetingInfo($company_id, $meeting_id, $title, $date, $time, $duration, $zoom_meeting_id, $meeting_link, $password, $entry_user_id){
    global $connect;
    $sql = "INSERT INTO `zoom_meeting_call`(`company_id`, `meeting_id`, `title`, `date`, `time`, `duration`, `zoom_meeting_id`, `meeting_link`, `password`, `entry_user_id`)   VALUES ('{$company_id}','{$meeting_id}','{$title}','{$date}','{$time}','{$duration}','{$zoom_meeting_id}','{$meeting_link}','{$password}','{$entry_user_id}')";
    $query = mysqli_query($connect,$sql);
    if($query){
        if(sendCommitteMemberZoomMeetingCridential($company_id,$meeting_id,$title,$meeting_link,$zoom_meeting_id,$password,$time,$date) != true){
            echo "Mail sent failed";
            die();
        }
        return true;
    }else{
        return false;
    }
}


// send mail by committtee member for attending zoom meeting
function sendCommitteMemberZoomMeetingCridential($company_id, $meeting_id, $zoom_meeting_title, $meeting_link, $zoom_meeting_id, $password, $time, $date){
    global $connect;
    $sql = "SELECT user_id FROM committee_users where committee_id=(SELECT committee_id FROM meetings WHERE id='{$meeting_id}' and company_id='{$company_id}')";
    $query = mysqli_query($connect,$sql);
    while($data = mysqli_fetch_array($query)){
        $userInfo = userNameEmail($company_id, $data['user_id']);
        $userName = $userInfo['name'];
        $userEmail = $userInfo['email'];
        $message = <<<MESSAGE
        CALL A ZOOM VIDEO MEETING FOR $zoom_meeting_title on $date $time. please join this meeting
       <a href="$meeting_link">Join Meeting Url<a>
       <p>ZOOM Meeting ID : $zoom_meeting_id</p>
       <p>ZOOM Meeting ID : $password</p>
MESSAGE;
        if(sendMail($userEmail,$userName,$zoom_meeting_title,$message) == false){
            echo "Massage sent failed";
            die();
        }
    }
    
    return true;
    
}



// find out total committe member 
function totalCommitteemembers(int $committee_id){
    global $connect;
    $sql   = "SELECT COUNT(id) as total_committee_member FROM committee_users WHERE committee_id='{$committee_id}' and is_chairman=0";
    $query = mysqli_query($connect,$sql);
    $data  = mysqli_fetch_array($query);
    return $data['total_committee_member'];
}


// check user stay in meeting committe or not
function checkMeetingCommitteeUser(int $meeting_id, int $user_id):bool{
    global $connect;
    $sql      = "SELECT * FROM committee_users WHERE committee_id = (SELECT committee_id FROM meetings WHERE id='$meeting_id') and user_id='$user_id'";
    $query    = mysqli_query($connect, $sql);
    $rowCount = mysqli_num_rows($query);
    if($rowCount > 0){
        return true;
    }else{
        return false;
    }
}

// return user role id
function userRoleId(int $user_id){
    global $connect;
    $sql   = "SELECT role_id FROM users WHERE id='$user_id'";
    $query = mysqli_query($connect, $sql);
    $data  = mysqli_fetch_assoc($query);
    return $data['role_id'];
}

function meetingAttendanceActive($meeting_id){
    global $connect;
    $sql   = "SELECT * FROM attendances WHERE meeting_id='$meeting_id'";
    $query = mysqli_query($connect, $sql);
    $data  = mysqli_fetch_assoc($query);
    if($data['is_open'] == 1){
        return true;
    }else{
        return false;
    }
}


function meetingSingedUpload($meeting_id){
    global $connect;
    $sql   = "SELECT * FROM signed_minute_uploads WHERE meeting_id='$meeting_id'";
    $query = mysqli_query($connect, $sql);
    $data =  mysqli_fetch_assoc($query);
    if(!empty($data['signed_minute_file'])){
        return $data['signed_minute_file'];
    }else{
        return false;
    }
}