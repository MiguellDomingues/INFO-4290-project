<?php

    require_once "../config/functions.php";
    require_once "../config/email_template.php";

    if(check('action', 'get')){
        if($_GET['action'] == "create"){
            if(check('first_name') && check('last_name') && check('email') && check('phone') &&
            check('password') && check('gender')){
                $query = "SELECT * FROM `users` WHERE `email` = '{$_REQUEST['email']}'";
                $result = json_decode(execute($query, "select"));
                $query = "SELECT * FROM `users` WHERE `phone` = '{$_REQUEST['phone']}'";
                $result2 = json_decode(execute($query, "select"));
                if($result->status){
                    echo return_data("Email already exists");
                }
                else if($result2->status){
                    echo return_data("Phone Number already exists");
                }
                else{
                    // echo "working";die();
                    $image_query = "";
                    if(check("image", "file")){
                        $image = json_decode(upload_image($_FILES['image']));
                        if($image->status){
                            $image_query = ", `image` = '{$image->data}'";
                        }
                    }
                    // $token = rand(100000, 999999);
                    $date = date("Y-m-d H:i:s", time());
                    $query = "INSERT INTO `users` SET
                        `first_name` = LOWER('{$_REQUEST['first_name']}'),
                        `last_name` = LOWER('{$_REQUEST['last_name']}'),
                        `email` = LOWER('{$_REQUEST['email']}'),
                        `phone` = '{$_REQUEST['phone']}',
                        `gender` = LOWER('{$_REQUEST['gender']}'),
                        `password` = md5('{$_REQUEST['password']}'),
                        `date` = '{$date}',
                        `status` = 1
                        {$image_query}";
                        
                    echo execute($query, "return_id");
                    // if($user->status){
                    //     // send_email(["email" => $_REQUEST['email'], "token" => $token],"signup");
                    //     // die();
                    //     echo return_data("User has been registered and verfication email has been sent", true);
                    // }
                    // else{
                    //     echo return_data($user->data);
                    // }
                }
            }
            else{
                echo return_data("All field are required");
            }
        }

        if($_GET['action'] == "read"){
            // print_r($_REQUEST);die();
            $ex_query = "";
            if(check("email") && check('password')){
                $ex_query = " WHERE `email` = '{$_REQUEST['email']}'";
            }
            else if(check("user_id")){
                $ex_query = " WHERE u.`id` = '{$_REQUEST['user_id']}'";
            }
            $query = "SELECT u.*,
                (SELECT COUNT(o.id) FROM `orders` o WHERE (SELECT `user_id` FROM `carts` c WHERE c.id = o.cart_id) = u.`id`) AS `orders`
                FROM `users` u".$ex_query;
            
            if(check('email') && check('password')){
                $user = json_decode(execute($query, "select"));
                if($user->status){
                    if($user->data[0]->password == md5($_REQUEST['password'])){
                        
                        echo return_data($user->data, true);
                    }
                    else{
                        echo return_data("Invalid Password");
                    }
                }
                else{
                    echo return_data("User not found");
                }
            }
            else{
                echo execute($query,"select");
            }
            
            
        }

        if($_GET['action'] == "update"){
            if(check('first_name') && check('last_name') && check('phone') && check('gender') && check('user_id')){
                // $check_password = json_decode(check_password($_REQUEST['user_id'], $_REQUEST['password']));
                // if($check_password->status){
                
                    $image_query = "";
                    if(check("image", "file")){
                        $image = json_decode(upload_image($_FILES['image']));
                        if($image->status){
                            $image_query = ", `image` = '{$image->data}'";
                        }
                    }

                    $query = "UPDATE `users` SET
                        `first_name` = LOWER('{$_REQUEST['first_name']}'),
                        `last_name` = LOWER('{$_REQUEST['last_name']}'),
                        `phone` = '{$_REQUEST['phone']}',
                        `gender` = LOWER('{$_REQUEST['gender']}')
                        {$image_query}
                        WHERE `id` = '{$_REQUEST['user_id']}'";
                        
                    echo execute($query);
                // }
                // else{
                //     echo return_data($check_password->data);
                // }
            }
            else{
                echo return_data("All field are required");
            }
        }

        if($_GET['action'] == "update_email"){
            if(check('email') && check('password') && check('user_id')){
                $check_password = json_decode(check_password($_REQUEST['user_id'], $_REQUEST['password']));
                if($check_password->status){
                    $query = "UPDATE `users` SET
                        `email` = LOWER('{$_REQUEST['email']}'),
                        `status` = '0'
                        WHERE `id` = '{$_REQUEST['user_id']}'";
                        
                    echo execute($query);
                }
                else{
                    echo return_data($check_password->data);
                }
            }
            else{
                echo return_data("All field are required");
            }
        }

        if($_GET['action'] == "update_status"){
            if(check('user_id') && isset($_REQUEST['status'])){
                $query = "UPDATE `users` SET
                    `status` = '{$_REQUEST['status']}'
                    WHERE `id` = '{$_REQUEST['user_id']}'";
                    
                echo execute($query);
            }
            else{
                echo return_data("All field are required");
            }
        }

        if($_GET['action'] == "update_image"){
            if(check('user_id')){
                $image_query = "";
                if(check("image", "file")){
                    $image = json_decode(upload_image($_FILES['image']));
                    if($image->status){
                        $query = "UPDATE `users` 
                        `image` = '{$image->data}'
                        WHERE `id` = '{$_REQUEST['user_id']}'";
    
                        echo execute($query);
                    }
                    else{
                        echo return_data($image->data);
                    }
                }
                else{
                    echo return_data("Image Not Found");
                }
            }
            else{
                echo return_data("user_id is required");
            }
        }

        if($_GET['action'] == "update_password"){
            if(check('new_password') && check('confirm_password') && check('password') && check('user_id')){
                $check_password = json_decode(check_password($_REQUEST['admin_id']??$_REQUEST['user_id'], $_REQUEST['password']));
                if($check_password->status){
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
                    echo return_data($check_password->data);
                }
            }
            else{
                echo return_data("All field are required");
            }
        }

        if($_GET['action'] == "delete"){
            if(check("user_id")){
                $query = "DELETE FROM `users` WHERE `id` = {$_REQUEST['user_id']}";
                echo execute($query);
            }
            else{
                echo return_data("user_id is required");
            }
        }
    }
