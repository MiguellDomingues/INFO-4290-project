<?php

    require_once "../config/functions.php";

    if(check('action')){

        if($_GET['action'] == ""){
            
        }
        
        if($_GET['action'] == "create"){
            if(check('user_id') && check('order_id') && check('product_id') && check('review') && check('rating')){
                $query = "SELECT
                    o.id AS `order_id`,o.`user_id`,ci.*,
                    (SELECT COUNT(*) AS `total` FROM `reviews` r WHERE r.`order_id` = o.`id` AND r.`product_id` = ci.`product_id`) AS `reviews`
                    FROM `orders` o
                    INNER JOIN `cart_items` ci ON ci.`cart_id` = o.`cart_id`
                    WHERE o.`user_id` = '{$_REQUEST['user_id']}' AND ci.`product_id` = '{$_REQUEST['product_id']}'";
                $review = json_decode(execute($query, "select"));
                if($review->status){
                    $review = $review->data[0];
                    if(!($review->reviews > 0)){
                        $today = date("Y-m-d H:i:s", time());
                        $query = "INSERT INTO `reviews` SET
                            `user_id` = '{$_REQUEST['user_id']}',
                            `product_id` = '{$_REQUEST['product_id']}',
                            `order_id` = '{$_REQUEST['order_id']}',
                            `rating` = '{$_REQUEST['rating']}',
                            `review` = '{$_REQUEST['review']}',
                            `date_time` = '{$today}'";
        
                        echo execute($query, "return_id");
                    }
                    else{
                        echo return_data("already reviewed");
                    }
                }
                else{
                    echo return_data($review->data);
                }
            }
            else{
                echo return_data("order_id, product_id, user_id, review and rating are required");
            }
        }


        if($_GET['action'] == "check_review"){
            if(check('product_id') && check('user_id')){
                $query = "SELECT
                    o.id AS `order_id`,o.`user_id`,ci.*,
                    (SELECT COUNT(*) AS `total` FROM `reviews` r WHERE r.`order_id` = o.`id` AND r.`product_id` = ci.`product_id`) AS `reviews`
                    FROM `orders` o
                    INNER JOIN `cart_items` ci ON ci.`cart_id` = o.`cart_id`
                    WHERE o.`user_id` = '{$_REQUEST['user_id']}' AND ci.`product_id` = '{$_REQUEST['product_id']}'";
                $review = json_decode(execute($query, "select"));
                if($review->status){
                    $review = $review->data[0];
                    if(!($review->reviews > 0)){
                        echo return_data($review, true);
                    }
                    else{
                        echo return_data("already reviewed");
                    }
                }
                else{
                    echo return_data($review->data);
                }
            }
            else{
                echo return_data("product_id and user_id are required");
            }
        }
        
        if($_GET['action'] == "read"){
            $ex_query = check("review_id")?" WHERE `id` = {$_REQUEST['review_id']}":check('product_id')?" WHERE p.`id` = '{$_REQUEST['product_id']}'":"";
            $query = "SELECT 
                r.*,
                CONCAT(u.`first_name`, ' ', u.`last_name`) AS `user_name`, u.`email` AS `user_email`, u.`image` AS `user_image`,
                p.`name` AS `product_name`, p.`image` AS `product_image`
                FROM `reviews` r 
                INNER JOIN `orders` o ON o.`id` = r.`order_id`
                INNER JOIN `products` p ON p.`id` = r.`product_id`
                INNER JOIN `users` u ON u.`id` = r.`user_id`".$ex_query;
            echo execute($query, "select");
        }

        if($_GET['action'] == "update_reply"){
            if(check('reply', "post") && check('review_id', "post")){
                $query = "UPDATE `reviews` SET
                    `reply` = '{$_POST['reply']}'
                    WHERE `id` = '{$_POST['review_id']}'";

                echo execute($query);
            }
            else{
                echo return_data("review_id and reply are required");
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