<?php include '../database_connection.php';?>
<?php session_start();?>
<?php
if ( !isset( $_SESSION['id'] ) ) {
    header( "location:../login/login.php" );
    exit;
}

    $get_id=$_GET['id'];
    $delSql = "DELETE FROM `features` WHERE  id=$get_id";
    $delQuery = mysqli_query( $connect, $delSql );
    echo "<script>window.location.href='feature-list.php'</script>";


?>