<?php include '../database_connection.php';?>
<?php session_start();?>
<?php
if ( !isset( $_SESSION['id'] ) ) {
    header( "location:../login/login.php" );
    exit;
}


    $title = mysqli_real_escape_string( $connect, $_POST['title'] );
    $description = mysqli_real_escape_string( $connect, $_POST['description'] );
    $bannerupdateSql = "UPDATE `banner_info` SET `title`='$title',`description`='$description' WHERE id=1";
    $bannerQuery = mysqli_query( $connect, $bannerupdateSql );
    if ( $bannerQuery ) {
        echo true;
    } else {
        echo "Banner info  updated successfully.";
    }


?>