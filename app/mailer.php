<?php 

use PHPMailer\PHPMailer\PHPMailer;

//Create a new PHPMailer instance

function sendMail($receiverMal, $receiverName, $content){

    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = 'smtp.gmail.com';

    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = "";
    $mail->Password = "";
    $mail->setFrom('', 'CMS');
    $mail->addReplyTo('', 'CMS');
    $mail->addAddress($receiverMal, $receiverName);
    $mail->Subject = 'Curier Management System';
    $mail->msgHTML($content);
    $mail->AltBody = $content;
    return $mail->send();

}

