<?php

    require_once "../config/functions.php";
    // require_once "../config/email_template.php";
    require_once 'send_email.php'

    if(check('action')){
        
        if($_GET['action'] == "forgot_password"){
            if(check("email")){
                $query = "SELECT * FROM `users` WHERE `email` = LOWER('{$_REQUEST['email']}')";
                $user = json_decode(execute($query, 'select'));
                // print_r($user);die();
                if($user->status){
                    $token = rand(100000, 999999);
                    $date = date("Y-m-d H:i:s", time());
                    $query = "INSERT INTO `forgot_password` SET 
                        `user_id` = '{$user->data[0]->id}',
                        `token` = '$token',
                        `date_time` = '$date'";
                    $fp = json_decode(execute($query));
                    // print_r($fp);die();
                    if($fp->status){
                        $array = [
                            "email" => $_REQUEST['email'],
                            "token" => $token
                        ];
                        // $mail = json_decode(send_email("reset_password", $array));
                        // print_r($mail);die();
                        
                        // if($mail->status){
                            echo return_data(["email" => $_REQUEST['email'], "token" => $token, "user_id" => $user->data[0]->id], true);
                        // }
                        // else{
                        //     echo return_data($mail->data);
                        // }
                    }
                    else{
                        echo return_data($fp->data);
                    }
                }
                else{
                    echo return_data("User not found");
                }
            }
            else{
                echo return_data("email is required");
            }
        }

        if($_GET['action'] == "check_code"){
            $query = "SELECT * FROM `forgot_password` WHERE `email` = '{$_REQUEST['email']}' AND `token` = '{$_REQUEST['token']}' ORDER BY `id` DESC";
            $fp = json_decode($query);
            if($fp['status']){
                if($fp["data"][0]['status'] == 1){
                    echo return_data("Token found", true);
                }
                else{
                    echo return_data("Token expired");
                }
            }
            else{
                echo return_data("Invalid Code given");
            }
        }

        if($_GET['action'] == "reset_password"){
            if(check('new_password') && check('confirm_password') && check('user_id')){
                if($_REQUEST['new_password'] == $_REQUEST['confirm_password']){
                    $query = "UPDATE `users` SET
                        `password` = md5('{$_REQUEST['new_password']}'),
                        WHERE `id` = '{$_REQUEST['user_id']}'";
                        
                    echo execute($query);
                }
                else{
                    echo return_data("Confirm Password is not Matched");
                }
            }
            else{
                echo return_data("All field are required");
            }
        }

    }

