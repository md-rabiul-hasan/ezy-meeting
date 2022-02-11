
<?php include '../../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];

    if (isset($_POST['chairman_id'])) {
        $chairman_id = mysqli_real_escape_string($connect, trim($_POST['chairman_id']));

        $committeeMemberQuery = mysqli_query($connect, "SELECT id,name FROM users where id != '$chairman_id' and company_id='$company_id' and (role_id != 1 and role_id !=2)");
        $selectedUserlist     = "<option value=''>Select Member</option>";
        while ($committeeMemberData = mysqli_fetch_array($committeeMemberQuery)) {
            $selectedUserlist .= "<option value=" . $committeeMemberData['id'] . ">" . $committeeMemberData['name'] . "</option>";
        }
        echo $selectedUserlist;

    }

?>