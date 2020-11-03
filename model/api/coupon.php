<?php

    require_once "../config/functions.php";

    if(check('action')){

        if($_GET['action'] == "create"){
            $query = "SELECT * FROM `coupons` WHERE `name` = '{$_REQUEST['name']}'";
            $result = json_decode(execute($query, "select"));
            if($result->status){
                echo return_data("coupon name already exists");
            }
            else{   
                if(check('name', "post") && check('code', "post") && check('no_of_usage', "post") && check('minimum_amount', "post") && check('expiry_time', "post") && check('discount_type', "post") && check('discount_value', "post")){
                    $_POST['expiry_time'] = str_replace("T", " ", $_POST['expiry_time']);
                    $status =  $_POST['status']??0;
                    $query = "INSERT INTO `coupons` SET
                        `name` = '{$_POST['name']}',
                        `code` = '{$_POST['code']}',
                        `no_of_usage` = '{$_POST['no_of_usage']}',
                        `discount_type` = '{$_POST['discount_type']}',
                        `discount_value` = '{$_POST['discount_value']}',
                        `minimum_amount` = '{$_POST['minimum_amount']}',
                        `expiry_time` = '{$_POST['expiry_time']}',
                        `status` = '{$_POST['status']}'";
    
                    echo execute($query, "return_id");
                }
                else{
                    echo return_data("all fields are required");
                }
            }
        }

        if($_GET['action'] == "read"){
            $ex_query = check("coupon_id")?" WHERE `id` = {$_REQUEST['coupon_id']}":"";
            $query = "SELECT * FROM `coupons`".$ex_query;
            echo execute($query, "select");
        }

        if($_GET['action'] == "update"){
            if(check('name', "post") && check('code', "post") && check('no_of_usage', "post") && check('minimum_amount', "post") && check('expiry_time', "post") && check('discount_type', "post") && check('discount_value', "post") && check('coupon_id', "post")){
                $query = "SELECT * FROM `coupons` WHERE `id` != '{$_POST['coupon_id']}' AND `name` = '{$_REQUEST['name']}'";
                $result = json_decode(execute($query, "select"));
                if($result->status){
                    echo return_data("Coupon already exists");
                }
                else{
                    $query = "SELECT * FROM `coupons` WHERE `id` != '{$_POST['coupon_id']}' AND `code` = '{$_REQUEST['code']}'";
                    $result = json_decode(execute($query, "select"));
                    if($result->status){
                        echo return_data("Code already exists");
                    }
                    else{
                        $_POST['expiry_time'] = str_replace("T", " ", $_POST['expiry_time']);
                        $status =  $_POST['status']??0;
                        $query = "UPDATE `coupons` SET
                            `name` = '{$_POST['name']}',
                            `code` = '{$_POST['code']}',
                            `no_of_usage` = '{$_POST['no_of_usage']}',
                            `discount_type` = '{$_POST['discount_type']}',
                            `discount_value` = '{$_POST['discount_value']}',
                            `minimum_amount` = '{$_POST['minimum_amount']}',
                            `expiry_time` = '{$_POST['expiry_time']}',
                            `status` = '{$_POST['status']}'
                            WHERE `id` = '{$_POST['coupon_id']}'";
        
                        echo execute($query,"return_id");
                    }
                }
            }
            else{
                echo return_data("All fields are required are required");
            }
        }

        if($_GET['action'] == "add_coupon"){
            if(check('code') && check('amount')){
                $query = "SELECT * FROM `coupons` WHERE `code` = '{$_REQUEST['code']}'";
                $coupon = json_decode(execute($query,"select"));
                if($coupon->status){
                    $today = date("Y-m-d h:i:s", time());
                    $coupon = $coupon->data[0];
                    if($today < $coupon->expiry_time){
                        $query = "SELECT COUNT(*) AS `usage` FROM `orders` WHERE `coupon_id` = '{$coupon->id}'";
                        $total_usage = json_decode(execute($query, "select"));
                        if($total_usage->data[0]->usage < $coupon->no_of_usage){
                            if($_REQUEST['amount'] >= $coupon->minimum_amount){
                                echo return_data($coupon, true);
                            }
                            else{
                                echo return_data("Coupon minimum amount is {$coupon->minimum_amount}");
                            }
                        }
                        else{
                            echo return_data("Coupon reached its limit");
                        }
                    }
                    else{
                        echo return_data("Coupon Expire {$today} {$coupon->expiry_time}");
                    }
                }
                else{
                    echo return_data($coupon->data);
                }
            }
            else{
                echo return_data("code is required");
            }
        }

        if($_GET['action'] == "update_status"){
            if(isset($_POST['status']) && check('coupon_id', "post")){
                $status = check('status')?", `status` = ".$_POST['status']:"";
                $query = "UPDATE `coupons` SET
                    `status` = '{$_POST['status']}'
                    WHERE `id` = '{$_POST['coupon_id']}'";

                echo execute($query);
            }
            else{
                echo return_data("coupon_id and status are required");
            }
        }

        if($_GET['action'] == "delete"){
            if(check("coupon_id")){
                $query = "DELETE FROM `coupons` WHERE `id` = {$_REQUEST['coupon_id']}";
                echo execute($query);
            }
            else{
                echo return_data("coupon_id is required");
            }
        }
    }