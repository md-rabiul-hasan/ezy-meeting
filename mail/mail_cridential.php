<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include 'vendor/autoload.php';
  
function sendTestMail($toUserMailAddress,$toUserFullName,$subject,$message,$attachMent=null){
    $mail = new PHPMailer(true);
                          
    //Set PHPMailer to use SMTP.
    $mail->isSMTP();            
    //Set SMTP host name                          
    $mail->Host = "smtp.gmail.com";
    //$mail->Host = "smtp.mailtrap.io";
    //Set this to true if SMTP host requires authentication to send email
    $mail->SMTPAuth = true;                          
    //Provide username and password     
    //$mail->Username = "e3a1ec8d51c036";                 
    //$mail->Password = "60ed30e9ab359a"; 
    $mail->Username = "ezymeeting1@gmail.com";  
    $mail->Password = "Venture123";                             
    //If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = "tls";                           
    //Set TCP port to connect to
    $mail->Port = 587;                                   

    $mail->From = "ezymeeting@gmail.com";
    $mail->FromName = "Ezy-Meeting";

    $mail->addAddress("{$toUserMailAddress}", "{$toUserFullName}");

    $mail->isHTML(true);

    $mail->Subject = "{$subject}";
    // body create
    $body = mailBody($toUserFullName,$subject,$message);
    $mail->Body = "{$body}";

    // attachement 
    if($attachMent != null){
        $mail->addAttachment($attachMent);
    }

    try {
        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        die();
    }
}
    
 