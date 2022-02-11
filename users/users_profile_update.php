<?php
// include database
include '../database_connection.php';

// authentication check
if (!isset($_SESSION['id'])) {
    header("location:../login/login.php");
    exit;
}

// session data fetch
$company_id      = $_SESSION['company_id'];
$current_user_id = $_SESSION['id'];

if (isset($_GET['id'])) { // check get id
    $user_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

    // avaatar upload section start
    if (!empty($_FILES['avatar']['name'])) {
        avatarChange($user_id, $company_id);
    }

    // avatar upload section end
    if (isset($_POST['user_profile_update'])) {
        updateUsersInfo($company_id, $user_id);

    }

}

// update users table
function updateUsersInfo(int $company_id, int $user_id) {
    global $connect;
    // user profile table update start
    $name      = strip_tags(mysqli_real_escape_string($connect, trim($_POST['name'])));
    $email     = strip_tags(mysqli_real_escape_string($connect, trim($_POST['email'])));
    $phone     = strip_tags(mysqli_real_escape_string($connect, trim($_POST['phone'])));
    $role_id   = strip_tags(mysqli_real_escape_string($connect, trim($_POST['role_id'])));
    $is_active = strip_tags(mysqli_real_escape_string($connect, trim($_POST['is_active'])));

    $updateUsesInformationSql   = "UPDATE `users` SET `name`='$name',`email`='$email',`phone`='$phone',`role_id`='$role_id',`is_active`='$is_active' WHERE id='$user_id'  and company_id='{$company_id}'";
    $updateUsesInformationQuery = mysqli_query($connect, $updateUsesInformationSql);
    if ($updateUsesInformationQuery) {
        uupdateUserProfiles($company_id, $user_id);
    } else {
        $_SESSION['user_profile_update_massage'] = false;
        echo "<script>window.location='edit_user.php?id=".encryptData($user_id)."'</script>"; //success
    }
}
// update users profile table
function uupdateUserProfiles(int $company_id, int $user_id) {
    global $connect;
    $current_user_id = $_SESSION['id'];
    // update profile table data start
    $designation                            = strip_tags(mysqli_real_escape_string($connect, trim($_POST['designation'])));
    $father_name                            = strip_tags(mysqli_real_escape_string($connect, trim($_POST['father_name'])));
    $mother_name                            = strip_tags(mysqli_real_escape_string($connect, trim($_POST['mother_name'])));
    $nid                                    = strip_tags(mysqli_real_escape_string($connect, trim($_POST['nid'])));
    $tin                                    = strip_tags(mysqli_real_escape_string($connect, trim($_POST['tin'])));
    $hierarchy                              = strip_tags(mysqli_real_escape_string($connect, trim($_POST['hierarchy'])));
    $is_voter                               = strip_tags(mysqli_real_escape_string($connect, trim($_POST['is_voter'])));
    $date_of_birth                          = strip_tags(mysqli_real_escape_string($connect, trim($_POST['date_of_birth'])));
    $maritial_status                        = strip_tags(mysqli_real_escape_string($connect, trim($_POST['maritial_status'])));
    $present_working_institute_name         = strip_tags(mysqli_real_escape_string($connect, trim($_POST['present_working_institute_name'])));
    $present_working_institue_business      = strip_tags(mysqli_real_escape_string($connect, trim($_POST['present_working_institue_business'])));
    $present_working_institute_desingnation = strip_tags(mysqli_real_escape_string($connect, trim($_POST['present_working_institute_desingnation'])));
    $work_phone                             = strip_tags(mysqli_real_escape_string($connect, trim($_POST['work_phone'])));
    $spouse_name                            = strip_tags(mysqli_real_escape_string($connect, trim($_POST['spouse_name'])));
    $spouse_profession                      = strip_tags(mysqli_real_escape_string($connect, trim($_POST['spouse_profession'])));
    $spouse_nationality                     = strip_tags(mysqli_real_escape_string($connect, trim($_POST['spouse_nationality'])));
    $nationality                            = strip_tags(mysqli_real_escape_string($connect, trim($_POST['nationality'])));
    $emergency_contact_name                 = strip_tags(mysqli_real_escape_string($connect, trim($_POST['emergency_contact_name'])));
    $emergency_contact_phone                = strip_tags(mysqli_real_escape_string($connect, trim($_POST['emergency_contact_phone'])));
    $emergency_contact_fax                  = strip_tags(mysqli_real_escape_string($connect, trim($_POST['emergency_contact_fax'])));
    $emergency_contact_email                = strip_tags(mysqli_real_escape_string($connect, trim($_POST['emergency_contact_email'])));
    $present_address                        = strip_tags(mysqli_real_escape_string($connect, trim($_POST['present_address'])));
    $permanent_addess                       = strip_tags(mysqli_real_escape_string($connect, trim($_POST['permanent_addess'])));
    $joining_date                           = strip_tags(mysqli_real_escape_string($connect, trim($_POST['joining_date'])));

    if (userDataCheckInProfiTable($company_id, $user_id)) { // data already found in profile table
        $userProfileUpdateSql = "UPDATE `user_profiles` set `company_id`='$company_id',`father_name`='$father_name',`mother_name`='$mother_name',`maritial_status`='$maritial_status',`designation`='$designation',`parmanent_address`='$permanent_addess',`spouse_name`='$spouse_name', `spouse_profession`='$spouse_profession',`spouse_nationality`='$spouse_nationality',`hierarchy`='$hierarchy',`is_voter`='$is_voter',`nationality`='$nationality',`emergency_contact_name`='$emergency_contact_name',`emergency_contact_phone`='$emergency_contact_phone',`emergency_contact_fax`='$emergency_contact_fax',`emergency_contact_email`='$emergency_contact_email',`date_of_birth`='$date_of_birth',`nid`='$nid',`tin`='$tin',`present_working_institute_name`='$present_working_institute_name',`present_working_institue_business`='$present_working_institue_business',`present_working_institute_desingnation`='$present_working_institute_desingnation',`present_address`='$present_address', `work_phone`='$work_phone',`joining_date`='$joining_date' where user_id='$user_id' ";

    } else { //data not found in profile table
        $userProfileUpdateSql = "INSERT INTO `user_profiles`(`company_id`, `user_id`, `father_name`,`mother_name`, `maritial_status`, `designation`, `parmanent_address`,`spouse_name`, `spouse_profession`, `spouse_nationality`, `hierarchy`, `is_voter`, `nationality`, `emergency_contact_name`, `emergency_contact_phone`, `emergency_contact_fax`, `emergency_contact_email`, `date_of_birth`, `nid`, `tin`, `present_working_institute_name`, `present_working_institue_business`, `present_working_institute_desingnation`, `present_address`, `work_phone`,`entry_user_id`,`joining_date`) VALUES ('$company_id','$user_id','$father_name','$mother_name','$maritial_status','$designation','$permanent_addess','$spouse_name','$spouse_profession','$spouse_nationality','$hierarchy','$is_voter','$nationality','$emergency_contact_name','$emergency_contact_phone','$emergency_contact_fax','$emergency_contact_email' ,'$date_of_birth','$nid','$tin','$present_working_institute_name','$present_working_institue_business','$present_working_institute_desingnation','$present_address','$work_phone','$current_user_id','$joining_date')";
    }
    $userProfileUpdateQuery = mysqli_query($connect, $userProfileUpdateSql);
    if ($userProfileUpdateQuery) {
        $_SESSION['user_profile_update_massage'] = true;
        echo "<script>window.location='edit_user.php?id=".encryptData($user_id)."'</script>"; //success
    } else {
        $_SESSION['user_profile_update_massage'] = false;
        echo "<script>window.location='edit_user.php?id=".encryptData($user_id)."'</script>"; //success
    }
}

function avatarChange(int $user_id, int $company_id) {
    global $connect;
    // find out use old image
    $oldImageQuery = mysqli_query($connect, "SELECT avatar from users where id='$user_id'");
    $oldImageData  = mysqli_fetch_array($oldImageQuery);
    $oldImage      = $oldImageData['avatar'];

    // new image info
    $file_name     = $_FILES['avatar']['name'];
    $file_tmp      = $_FILES['avatar']['tmp_name'];
    $file_ext      = pathinfo($file_name, PATHINFO_EXTENSION);
    $imageName     = $user_id . time() . uniqid() . '.' . $file_ext;
    $imageFullPath = "storage/company/{$company_id}/users/{$imageName}";

    // check directory exist
    if (!file_exists("../storage/company/" . $company_id . "/users/")) {
        mkdir("../storage/company/" . $company_id . "/users", 0777, true);
    }
    $fileMoved = move_uploaded_file($file_tmp, "../storage/company/" . $company_id . "/users/" . $imageName);

    if ($fileMoved) {
        if ($oldImage != NULL) {
            if (file_exists("../{$oldImage}")) {
                unlink("../" . $oldImage);
            }
        }
        $imageUpdateSql   = "UPDATE users set avatar='$imageFullPath' where id='$user_id'";
        $imageUpdateQuery = mysqli_query($connect, $imageUpdateSql);
        if ($imageUpdateQuery) {
            return true;
        } else {
            echo "<script>alert('User Profile Image Updated Failed.')</script>";
            echo "<script>window.location='edit_user.php?id=".encryptData($user_id)."'</script>"; //success
        }
    } else {
        echo "<script>alert('Image Cannot Stored.')</script>";
        echo "<script>window.location='edit_user.php?id=".encryptData($user_id)."'</script>"; //success
    }
}
