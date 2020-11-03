<?php

date_default_timezone_set('Asia/Karachi');
include "send_email/PHPMailer/PHPMailerAutoload.php";

Function sendmail($from1,$pwd,$to1,$subject,$body){
  $from=$from1;
  $password=$pwd;
  $to=$to1;

 $mail=new PHPMailer;
 $mail->isSMTP();
 $mail->SMTPDebug=0;
 $mail->Host='smtp.gmail.com';
 $mail->Port=587;
 $mail->SMTPSecure='tls';
//  $mail->Port=465;
//  $mail->SMTPSecure='ssl';
 $mail->SMTPAuth=true;
 $mail->Username=$from;
 $mail->Password=$password;
 $mail->setFrom($from,"Admin");
 $mail->addAddress($to,"client");
 $mail->Subject=$subject;
 $mail->msgHTML($body);
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

 if(!$mail->send()){
     return "Mailer Error:".$mail->ErrorInfo;
 }else{
   return "send";
 }

}

?>