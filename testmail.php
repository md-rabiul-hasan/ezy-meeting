<?php
include 'functions.php';
$msg = "Lorem ipsum, dolor sit amet consectetur adipisicing elit.
 Laudantium magnam sint libero nostrum temporibus animi, eaque blanditiis possimus enim assumenda inventore 
consectetur ipsum dolore aperiam veritatis ea? Placeat, officiis quidem.";
$to = "rabiul.fci@gmail.com";
$header = "Ezy-meeting mail";
$name = "Rabiul Hasan";
sendEmail($msg, $to, $header, $name);