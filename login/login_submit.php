<?php
include '../database_connection.php';


if (isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password'])) {
    $email    = $_POST['email'];
    $password = $_POST['password'];


    
    if(empty($_POST['Usertype_val'])){
        $userType=1;
        $userQ=" and (role_id='1' or role_id='2')";
    }
    else{
        $userType=$_POST['Usertype_val'];
         $userQ=" and role_id='$userType'";
    }
    $userAuthenticationSql      = "SELECT * FROM users WHERE (email='$email' or phone='{$email}') $userQ ";
    $userAuthenticationQuery    = mysqli_query($connect, $userAuthenticationSql);
    $userAuthenticationRowCount = mysqli_num_rows($userAuthenticationQuery);
    if ($userAuthenticationRowCount > 0) {
        $userAuthenticationData = mysqli_fetch_array($userAuthenticationQuery);
        if(password_verify($password, $userAuthenticationData['password'])){
            if ($userAuthenticationData['is_active'] == 1) {
                // session data stored start
                $_SESSION['id']         = $userAuthenticationData['id'];
                $_SESSION['user_id']    = $userAuthenticationData['id'];
                $_SESSION['company_id'] = $userAuthenticationData['company_id'];
                $_SESSION['name']       = $userAuthenticationData['name'];
                $_SESSION['username']   = $userAuthenticationData['username'];
                $_SESSION['email']      = $userAuthenticationData['email'];
                $_SESSION['phone']      = $userAuthenticationData['phone'];
                $_SESSION['role_id']    = $userAuthenticationData['role_id'];
                $_SESSION['avatar']     = $userAuthenticationData['avatar'];

                // data insert into login details table
                if (loginDetails($_SESSION['id']) == true) {
                    $getLoginDetailsIdQury        = mysqli_query($connect, "SELECT login_details_id from login_details WHERE `user_id`='{$userAuthenticationData[id]}' ORDER BY login_details_id DESC");
                    $getLoginDetailsIdData        = mysqli_fetch_assoc($getLoginDetailsIdQury);
                    $loginDetailsId               = $getLoginDetailsIdData['login_details_id'];
                    mysqli_query($connect,"UPDATE users SET is_logged=1  where company_id='{$userAuthenticationData[company_id]}' and id='{$userAuthenticationData[id]}'");
                    $_SESSION['login_details_id'] = $loginDetailsId;
                    //session data stored end 
                    $_SESSION['login_message'] = "Login Successfully.";
                    header('location:../dashboard.php');
                } else {
                    die("User login details generate failed");
                }

            } else {
                $_SESSION['login_message'] = "Your account is blocked. Please contact with authority";
                echo "<script>window.location='login.php'</script>"; //failed
            }
        }else{
            $_SESSION['login_message'] = "Incorrect Password";
            echo "<script>window.location='login.php'</script>"; //failed
            exit;
        }
        
    } else {
        $_SESSION['login_message'] = "Unknown Email or Phone";
        echo "<script>window.location='login.php'</script>"; //failed
        exit;
    }

}