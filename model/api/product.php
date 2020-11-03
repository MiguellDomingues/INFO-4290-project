<?php

    require_once "../config/functions.php";

    if(check('action')){

        if($_GET['action'] == "create"){
            if(check('name', 'post') && check('sub_category_id', 'post') && isset($_REQUEST['desc']) && isset($_REQUEST['um']) && check('stock', 'post') && check('price', 'post') && check('delivery_charges', 'post')){
                $image_name = "";
                if(check("image", "file")){
                    $image = json_decode(upload_image($_FILES['image']));
                    if($image->status){
                        $status = isset($_POST['status'])?", `status` = ".$_POST['status']:"";
                        $image_name = $image->data;
                        $query = "SELECT (`sku`+1) as `sku` FROM `products` ORDER BY `id` DESC limit 1";
                        $sku = json_decode(execute($query, "select"));
                        if($sku->status){
                            $sku = $sku->data[0]->sku;
                        }
                        else{
                            $sku = 1;
                        }
                        $query = "INSERT INTO `products` SET
                            `sub_category_id` = '{$_POST['sub_category_id']}',
                            `sku` = '{$sku}',
                            `name` = '{$_REQUEST['name']}',
                            `desc` = '{$_REQUEST['desc']}',
                            `image` = '{$image_name}',
                            `stock` = '{$_REQUEST['stock']}',
                            `um` = '{$_REQUEST['um']}',
                            `price` = '{$_REQUEST['price']}',
                            `delivery_charges` = '{$_REQUEST['delivery_charges']}'
                            {$status}";
        
                        $product = json_decode(execute($query, "return_id"));
                        $image_query = [];
                        if($product->status){
                            if(isset($_FILES['additional_images']['tmp_name'])){
                                foreach($_FILES['additional_images']['tmp_name'] as $key => $value){
                                    $image = [
                                        "name" => $_FILES['additional_images']['name'][$key],
                                        "type" => $_FILES['additional_images']['size'][$key],
                                        "tmp_name" => $_FILES['additional_images']['tmp_name'][$key],
                                        "error" => $_FILES['additional_images']['error'][$key],
                                        "size" => $_FILES['additional_images']['size'][$key]
                                    ];
                                    $image = json_decode(upload_image($image));
                                    if($image->status){
                                        $image_name = $image->data;
                                        $query = "INSERT INTO `product_additional_images` SET
                                            `product_id` = '{$product->id}',
                                            `image` = '{$image_name}'";
    
                                        $image_query[] = execute($query, "return_id");
                                    }
                                }
                            }
                            
                            echo return_data($product->data, true);
                        }
                        else{
                            echo return_data($product->data);
                        }
                    }
                    else{
                        echo return_data($image->data);
                    }
                }
                else{
                    echo return_data("Image is required");
                }
            }
            else{
                echo return_data("all fields are required");
            }
        }

        if($_GET['action'] == "read"){
            $ex_query = check("sub_category_id")?" WHERE `sub_category_id` = {$_REQUEST['sub_category_id']}":"";
            $ex_query = check("category_id")?" WHERE (SELECT c.`id` FROM `sub_categories` sub INNER JOIN categories c ON c.`id` = sub.`category_id` WHERE sub.`id` = `sub_category_id`) = {$_REQUEST['category_id']}":$ex_query;
            $ex_query = check("product_id")?" WHERE `id` = {$_REQUEST['product_id']}":$ex_query;
            $start = $_GET['pagination_start']??1;
            $ex_query .= check("pagination", "get")?" ORDER BY p.`id` LIMIT $start, '{$_GET['pagination']}'":"";
            $query = "SELECT *,
                (SELECT GROUP_CONCAT(`product_additional_images`.`image`) FROM `product_additional_images` WHERE `product_id` = `products`.id) AS `images`,
                (SELECT `name` FROM `sub_categories` WHERE `id` = `products`.`sub_category_id`) AS `subcategory`,
                (SELECT (SELECT `name` FROM `categories` WHERE `id` = `sub_categories`.`category_id`) FROM `sub_categories` WHERE `id` = `products`.`sub_category_id`) AS `category`,
                (SELECT (SELECT `id` FROM `categories` WHERE `id` = `sub_categories`.`category_id`) FROM `sub_categories` WHERE `id` = `products`.`sub_category_id`) AS `category_id`,
                (SELECT COUNT(o.id) FROM `orders` o INNER JOIN cart_items ci ON ci.cart_id = o.cart_id WHERE ci.`product_id` = `products`.`sub_category_id`) AS `orders`
                FROM `products`".$ex_query;
            echo execute($query, "select");
        }

        if($_GET['action'] == "update"){
            if(check('name') && check('sub_category_id') && isset($_REQUEST['desc']) && isset($_REQUEST['um']) && check('stock') && check('price') && check('delivery_charges')){
                $image_query = "";
                if(check("image", "file")){
                    $image = json_decode(upload_image($_FILES['image']));
                    if($image->status){
                        $image_query = " `image` = '{$image->data}',";
                    }
                    else{
                        echo return_data($image["data"]);
                    }
                }
                $status = isset($_POST['status'])?", `status` = ".$_POST['status']:"";
                $query = "UPDATE `products` SET
                    `sub_category_id` = '{$_POST['sub_category_id']}',
                    `name` = '{$_REQUEST['name']}',
                    `desc` = '{$_REQUEST['desc']}',
                    {$image_query}
                    `stock` = '{$_REQUEST['stock']}',
                    `um` = '{$_REQUEST['um']}',
                    `price` = '{$_REQUEST['price']}',
                    `delivery_charges` = '{$_REQUEST['delivery_charges']}'
                    {$status}
                    WHERE `id` = '{$_REQUEST['product_id']}'";

                $product = json_decode(execute($query, "return_id"));
                if($product->status){

                    $images = [];
                    if(check("additional_images", "file")){
                        foreach($_FILES['additional_images']['tmp_name'] as $key => $value){
                            $image = [
                                "name" => $_FILES['additional_images']['name'][$key],
                                "type" => $_FILES['additional_images']['size'][$key],
                                "tmp_name" => $_FILES['additional_images']['tmp_name'][$key],
                                "error" => $_FILES['additional_images']['error'][$key],
                                "size" => $_FILES['additional_images']['size'][$key]
                            ];
                            $image = json_decode(upload_image($image));
                            if($image->status){
                                $image_name = $image->data;
                                $query = "INSERT INTO `product_additional_images` SET
                                    `product_id` = '{$_REQUEST['product_id']}',
                                    `image` = '{$image_name}'";

                                $images[] = execute($query, "return_id");
                            }
                        }
                    }
                    echo return_data([$product->data, $images], true);
                }
                else{
                    echo return_data($product->data);
                }
            }
            else{
                echo return_data("sub_category_id and name are required");
            }
        }

        if($_GET['action'] == "update_status"){
            if(isset($_POST['status']) && check('product_id', "post")){
                $status = check('status')?", `status` = ".$_POST['status']:"";
                $query = "UPDATE `products` SET
                    `status` = '{$_POST['status']}'
                    WHERE `id` = '{$_POST['product_id']}'";

                echo execute($query);
            }
            else{
                echo return_data("category_id and status are required");
            }
        }
        
        if($_GET['action'] == "remove_additional_image"){
            if(check('image_id', "post")){
                $query = "DELETE FROM `product_additional_images` WHERE `id` = '{$_POST['image_id']}'";

                echo execute($query);
            }
            else{
                echo return_data("category_id and status are required");
            }
        }

        if($_GET['action'] == "delete"){
            if(check("product_id")){
                $query = "DELETE FROM `products` WHERE `id` = {$_REQUEST['product_id']}";
                echo execute($query);
            }
            else{
                echo return_data("product_id is required");
            }
        }
    }