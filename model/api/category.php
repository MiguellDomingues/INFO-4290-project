<?php

    require_once "../config/functions.php";

    if(check('action')){

        if($_GET['action'] == "create"){
            $query = "SELECT * FROM `categories` WHERE `name` = '{$_REQUEST['name']}'";
            $result = json_decode(execute($query, "select"));
            if($result->status){
                echo return_data("Category already exists");
            }
            else{
                if(check('name', "post") && isset($_POST['desc'])){
                    $image_query = "";
                    if(check("image", "file")){
                        $image = json_decode(upload_image($_FILES['image']));
                        if($image->status){
                            $image_query = ", `image` = '{$image->data}'";
                        }
                    } 
                    $status = check('status')?", `status` = ".$_POST['status']:"";
                    $query = "INSERT INTO `categories` SET
                        `name` = '{$_POST['name']}',
                        `desc` = '{$_POST['desc']}'
                        {$image_query}
                        {$status}";
    
                    echo execute($query, "return_id");
                }
                else{
                    echo return_data("name is required");
                }
            }
        }

        if($_GET['action'] == "read"){
            $ex_query = check("category_id")?" WHERE `id` = {$_REQUEST['category_id']}":"";
            $query = "SELECT *,(SELECT COUNT(*) FROM `sub_categories` WHERE `category_id` = `categories`.id) AS `subcategories` FROM `categories`".$ex_query;
            echo execute($query, "select");
        }

        if($_GET['action'] == "update"){
            if(check('name', "post") && isset($_REQUEST['desc']) && check('category_id', "post")){
                $query = "SELECT * FROM `categories` WHERE `id` != '{$_POST['category_id']}' AND `name` = '{$_REQUEST['name']}'";
                $result = json_decode(execute($query, "select"));
                if($result->status){
                    echo return_data("Category already exists");
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
                    $query = "UPDATE `categories` SET
                        `name` = '{$_POST['name']}',
                        `desc` = '{$_POST['desc']}'
                        {$image_query}
                        {$status}
                        WHERE `id` = '{$_POST['category_id']}'";
    
                    echo execute($query);
                }
            }
            else{
                echo return_data("category_id and name are required");
            }
        }

        if($_GET['action'] == "update_status"){
            if(isset($_POST['status']) && check('category_id', "post")){
                $status = check('status')?", `status` = ".$_POST['status']:"";
                $query = "UPDATE `categories` SET
                    `status` = '{$_POST['status']}'
                    WHERE `id` = '{$_POST['category_id']}'";

                echo execute($query);
            }
            else{
                echo return_data("category_id and status are required");
            }
        }

        if($_GET['action'] == "delete"){
            if(check("category_id")){
                $query = "DELETE FROM `categories` WHERE `id` = {$_REQUEST['category_id']}";
                echo execute($query);
            }
            else{
                echo return_data("category_id is required");
            }
        }
    }