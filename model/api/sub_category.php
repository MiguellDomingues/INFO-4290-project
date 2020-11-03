<?php

    require_once "../config/functions.php";

    if(check('action')){

        if($_GET['action'] == "create"){
            if(check('name') && isset($_POST['desc']) && check('category_id')){
                $query = "SELECT * FROM `sub_categories` WHERE `name` = '{$_REQUEST['name']}'";
                $result = json_decode(execute($query, "select"));
                if($result->status){
                    echo return_data("SubCategory already exists");
                }
                else{
                    $image_query = "";
                    if(check("image", "file")){
                        $image = json_decode(upload_image($_FILES['image']));
                        if($image->status){
                            $image_query = ", `image` = '{$image->data}'";
                        }
                    }
                    $status = isset($_POST['status'])?", `status` = ".$_POST['status']:"";
                    $query = "INSERT INTO `sub_categories` SET
                        `category_id` = '{$_POST['category_id']}',
                        `name` = '{$_POST['name']}',
                        `desc` = '{$_POST['desc']}'
                        {$image_query}
                        {$status}";
    
                    echo execute($query);
                }
            }
            else{
                echo return_data("category_id and name is required");
            }
        }

        if($_GET['action'] == "read"){
            $ex_query = check("sub_category_id")?" WHERE `id` = {$_REQUEST['sub_category_id']}":"";
            $ex_query .= check("category_id")?($ex_query!=""?" AND":" WHERE")." `category_id` = {$_REQUEST['category_id']}":"";
            $query = "SELECT *,
                (SELECT `name` FROM `categories` WHERE `id` = `sub_categories`.category_id) AS `category`,
                (SELECT COUNT(*) FROM `products` WHERE `sub_category_id` = `sub_categories`.id) AS `products` FROM `sub_categories`".$ex_query;
            echo execute($query, "select");
        }

        if($_GET['action'] == "update"){
            if(check('name') && isset($_REQUEST['desc']) && check('category_id') && check('sub_category_id')){
                $query = "SELECT * FROM `sub_categories` WHERE `id` != '{$_POST['sub_category_id']}' AND `name` = '{$_REQUEST['name']}'";
                $result = json_decode(execute($query, "select"));
                if($result->status){
                    echo return_data("SubCategory already exists");
                }
                else{
                    $image_query = "";
                    if(check("image", "file")){
                        $image = json_decode(upload_image($_FILES['image']));
                        if($image->status){
                            $image_query = ", `image` = '{$image->data}'";
                        }
                    }
                    $status = isset($_POST['status'])?", `status` = ".$_POST['status']:"";
                    $query = "UPDATE `sub_categories` SET
                        `category_id` = '{$_REQUEST['category_id']}',
                        `name` = '{$_REQUEST['name']}',
                        `desc` = '{$_REQUEST['desc']}'
                        {$image_query}
                        {$status}
                        WHERE `id` = '{$_REQUEST['sub_category_id']}'";

                    echo execute($query);
                }
            }
            else{
                echo return_data("category_id, sub_category_id and name are required");
            }
        }
        
        if($_GET['action'] == "update_status"){
            if(isset($_POST['status']) && check('sub_category_id', "post")){
                $status = check('status')?", `status` = ".$_POST['status']:"";
                $query = "UPDATE `sub_categories` SET
                    `status` = '{$_POST['status']}'
                    WHERE `id` = '{$_POST['sub_category_id']}'";

                echo execute($query);
            }
            else{
                echo return_data("category_id and status are required");
            }
        }

        if($_GET['action'] == "delete"){
            if(check("sub_category_id")){
                $query = "DELETE FROM `sub_categories` WHERE `id` = {$_REQUEST['sub_category_id']}";
                echo execute($query);
            }
            else{
                echo return_data("sub_category_id is required");
            }
        }
    }