<?php
include '../database_connection.php';
if( sendMail("fahim@venturenxt.com","Fahim Saleh","User registation Mail","Registation Success") != false){
    echo "sent success";
}else{
    echo "sent failed";
}