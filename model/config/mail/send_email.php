<?php

date_default_timezone_set('Asia/Karachi');
include "PHPMailer/PHPMailerAutoload.php";
include 'admin.php';

function sendmail($to,$subject,$message){
    global $admin_email, $admin_password;
    $mail=new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug=0;
    // $mail->Host='tls://smtp.gmail.com:587';
    $mail->Port=465;
    $mail->SMTPSecure='ssl';
    $mail->Host='smtp.gmail.com';
    // $mail->Port=587;
    // $mail->SMTPSecure='tls';
    $mail->SMTPAuth=true;
    $mail->Username=$admin_email;
    $mail->Password=$admin_password;
    $mail->setFrom($admin_email,"Admin");
    $mail->addAddress($to,"client");
    $mail->Subject=$subject;
    $mail->msgHTML($message);
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    if(!$mail->send()){
        return ["data" => "Mailer Error:".$mail->ErrorInfo, "status" => false];
    }else{
        return ["data" => "Email has been send", "status" => true];
    }

}


?>