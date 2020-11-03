<?php

    require_once "../config/functions.php";

    if(check('action')){

        if($_GET['action'] == "create"){
            $query = "SELECT * FROM `deals` WHERE `name` = '{$_REQUEST['name']}'";
            $result = json_decode(execute($query, "select"));
            if($result->status){
                echo return_data("coupon name already exists");
            }
            else{
                if(check('name', "post") && check('orders', "post") && check('discount_type', "post") && check('discount_value', "post") && check('status', "post")){
                    $duration = $_POST['duration']??"month";
                    $query = "INSERT INTO `deals` SET
                        `name` = '{$_POST['name']}',
                        `orders` = '{$_POST['orders']}',
                        `duration` = '{$duration}',
                        `discount_type` = '{$_POST['discount_type']}',
                        `discount_value` = '{$_POST['discount_value']}',
                        `status` = '{$_POST['status']}'";
    
                    echo execute($query, "return_id");
                }
                else{
                    echo return_data("all fields are required");
                }
            }
        }

        if($_GET['action'] == "read"){
            $ex_query = check("deal_id")?" WHERE `id` = {$_REQUEST['deal_id']}":"";
            $query = "SELECT * FROM `deals`".$ex_query;
            echo execute($query, "select");
        }

        if($_GET['action'] == "update"){
            if(check('name', "post") && check('orders', "post") && check('discount_type', "post") && check('discount_value', "post") && check('status', "post") && check('deal_id', "post")){
                $query = "SELECT * FROM `deals` WHERE `id` != '{$_POST['deal_id']}' AND `name` = '{$_REQUEST['name']}'";
                $result = json_decode(execute($query, "select"));
                if($result->status){
                    echo return_data("Deal already exists");
                }
                else{
                    $duration = $_POST['duration']??"month";
                    $query = "UPDATE `deals` SET
                        `name` = '{$_POST['name']}',
                        `orders` = '{$_POST['orders']}',
                        `duration` = 'month',
                        `discount_type` = '{$_POST['discount_type']}',
                        `discount_value` = '{$_POST['discount_value']}',
                        `status` = '{$_POST['status']}'
                        WHERE `id` = '{$_POST['deal_id']}'";
    
                    echo execute($query);
                }
            }
            else{
                echo return_data("All fields are required are required");
            }
        }

        if($_GET['action'] == "update_status"){
            if(isset($_POST['status']) && check('deal_id', "post")){
                $status = check('status')?", `status` = ".$_POST['status']:"";
                $query = "UPDATE `deals` SET
                    `status` = '{$_POST['status']}'
                    WHERE `id` = '{$_POST['deal_id']}'";

                echo execute($query);
            }
            else{
                echo return_data("deal_id and status are required");
            }
        }

        if($_GET['action'] == "delete"){
            if(check("deal_id")){
                $query = "DELETE FROM `deals` WHERE `id` = {$_REQUEST['deal_id']}";
                echo execute($query);
            }
            else{
                echo return_data("deal_id is required");
            }
        }
    }