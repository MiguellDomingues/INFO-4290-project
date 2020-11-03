<?php

    require_once "../config/functions.php";

    if(check('action')){

        if($_GET['action'] == "add_location"){
            // echo return_data($_REQUEST);die();
            if(check('user_id') && check('state') && check('city') && check('address') && check('post_code')){
                $query = "SELECT * FROM `regions` WHERE `name` = '{$_REQUEST['state']}'";
                $state = json_decode(execute($query, "select"));
                if($state->status){
                    $state_id = $state->data[0]->id;
                }
                else{
                    $query = "INSERT INTO `regions` SET
                        `country_id` = 1,
                        `name` = '{$_REQUEST['state']}'";
                    $result = execute($query, "return_id");
                    if($result->status){
                        $state_id = $result->id;
                    }
                    else{
                        echo return_data($result->data);
                    }
                }
                
                $query = "SELECT * FROM `cities` WHERE `name` = '{$_REQUEST['city']}'";
                $city = json_decode(execute($query, "select"));
                if($city->status){
                    $city_id = $city->data[0]->id;
                }
                else{
                    $query = "INSERT INTO `cities` SET
                        `region_id` = '{$region_id}',
                        `name` = '{$_REQUEST['city']}'";
                    $result = execute($query, "return_id");
                    if($result->status){
                        $city_id = $result->id;
                    }
                    else{
                        echo return_data($result->data);
                    }
                }
                
                $query = "INSERT INTO `locations` SET
                    `user_id` = '{$_REQUEST['user_id']}',
                    `city_id` = '{$city_id}',
                    `address` = '{$_REQUEST['address']}',
                    `post_code` = '{$_REQUEST['post_code']}'";

                echo execute($query, "return_id");
            }
            else{
                echo return_data("All fields are required");
            }
        }


        if($_GET['action'] == "create"){
            if(check('cart_id') && check('user_id') && check('location_id')){
                $query = "SELECT * FROM `orders` WHERE cart_id=".$_REQUEST['cart_id'];
                $cart = json_decode(execute($query,"select"));
                if($cart->status){
                    echo return_data("already order with this cart");
                }
                else{
                    $coupon = check('coupon_id')?", `coupon_id` = '{$_REQUEST['coupon_id']}'":"";
                    $date = date("Y-m-d" , time());
                    $query = "INSERT INTO `orders` SET
                        `user_id` = '{$_REQUEST['user_id']}',
                        `cart_id` = '{$_REQUEST['cart_id']}',
                        `charge_id` = '{$_REQUEST['charge_id']}',
                        `location_id` = '{$_REQUEST['location_id']}',
                        `date_time` = '$date'
                        {$coupon}";
    
                    echo execute($query, "return_id");
                }
            }
            else{
                echo return_data("cart_id, charge_id, user_id and location_id are required");
            }
        }

        if($_GET['action'] == "read"){
            $ex_query = check('order_id')? " WHERE `id` = '{$_REQUEST['order_id']}'" : "";
            if(isset($_REQUEST['all'])){
                $query = "SELECT
                    u.id AS `user_id`, CONCAT(u.first_name,' ',u.last_name) AS `user_name`, u.email, 
                    p.*, ci.`qty`,
                    l.address, city.name AS `city`,
                    o.id AS `order_id`, o.charge_id, o.status
                    FROM `orders` o
                    INNER JOIN `users` u ON u.`id` = o.`user_id`
                    INNER JOIN `locations` l ON l.`id` = o.`location_id`
                    INNER JOIN `cities` city ON city.`id` = l.`city_id`
                    INNER JOIN `carts` c ON c.`id` = o.`cart_id`
                    INNER JOIN `cart_items` ci ON ci.`cart_id` = c.`id`
                    INNER JOIN `products` p ON p.`id` = ci.`product_id`".$ex_query;
            }
            else{
                $query = "SELECT
                    u.id AS `user_id`, CONCAT(u.first_name,' ',u.last_name) AS `user_name`, u.email, 
                    (SELECT SUM(p.price*ci.qty) FROM `products` p INNER JOIN cart_items ci ON ci.product_id = p.id WHERE ci.cart_id = c.`id`) AS `amount`,
                    l.address, city.name AS `city`,
                    o.id AS `order_id`, o.charge_id, o.status
                    FROM `orders` o
                    INNER JOIN `users` u ON u.`id` = o.`user_id`
                    INNER JOIN `locations` l ON l.`id` = o.`location_id`
                    INNER JOIN `cities` city ON city.`id` = l.`city_id`
                    INNER JOIN `carts` c ON c.`id` = o.`cart_id`".$ex_query;
            }
            
            echo execute($query, "select");
        }

        if($_GET['action'] == "update_status"){
            if(check("order_id", "post") && isset($_POST['status'])){
                $query = "UPDATE `orders` SET
                    `status` = '{$_POST['status']}'
                    WHERE `id` = {$_REQUEST['order_id']}";
                echo execute($query);
            }
            else{
                echo return_data("order_id is required");
            }
        }

        if($_GET['action'] == "delete"){
            if(check("order_id")){
                $query = "DELETE FROM `orders` WHERE `id` = {$_REQUEST['order_id']}";
                echo execute($query);
            }
            else{
                echo return_data("order_id is required");
            }
        }
    }