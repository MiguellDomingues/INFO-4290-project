<?php
    require_once "mail/admin.php";
    require_once "mail/send_email.php";

    function send_email($array = [],$condition = "signup"){
        
        // SIGN UP (Email Verification) 
        if($condition == "signup" && isset($array["email"]) && isset($array["token"]) && !(empty($array["email"]) && empty($array["token"]))){
            $subject = "Verify Your Email Address";
            $to = $array["email"];
            $message = "Your Verfication code is: ".$array["token"];
            $mail = sendmail($to, $subject, $message);
            return json_encode($mail);
        }
        
        // RESET PASSWORD
        else if($condition == "reset_password" && isset($array["email"]) && isset($array["token"]) && !(empty($array["email"]) && empty($array["token"]))){
            $subject = "Reset Your Password";
            $to = $array["email"];
            $message = "Your Password Reset Code is: ".$array["token"];
            $mail = sendmail($to, $subject, $message);
            return json_encode($mail);
        }

    }
            
    