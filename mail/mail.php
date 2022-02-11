<?php
include '../database_connection.php';
$toUserMail     = "fahim@venturenxt.com";
$toUserFullName = "Md.Rabiul Hasan";
$subject        = "Test Mail";
$message = "Thanks for ezy-meeting registation";
sendMail($toUserMail, $toUserFullName, $subject, $message);