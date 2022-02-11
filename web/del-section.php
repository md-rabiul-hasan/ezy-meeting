<?php include '../database_connection.php';?>
<?php session_start();?>
<?php
if ( !isset( $_SESSION['id'] ) ) {
    header( "location:../login/login.php" );
    exit;
}

    $get_id=$_GET['id'];
    $delSql = "DELETE FROM `web_sections` WHERE  id=$get_id";
    $delQuery = mysqli_query( $connect, $delSql );
    echo "<script>window.location.href='section-list.php'</script>";


?>