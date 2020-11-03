<?php

    require_once "../config/functions.php";

    if(check('action')){

        if($_GET['action'] == "create"){
            if(check('user_id')){
                $date = date("Y-m-d" , time());
                $query = "INSERT INTO `carts` SET
                    `user_id` = '{$_REQUEST['user_id']}',
                    `date_time` = '$date'";

                echo execute($query,"return_id");
            }
            else{
                echo return_data("user_id is required");
            }
        }

        if($_GET['action'] == "add_item"){
            if(check('cart_id') && check('product_id') && check('qty')){
                $query = "SELECT * FROM `cart_items` WHERE `cart_id` = '{$_REQUEST['cart_id']}' AND `product_id` = '{$_REQUEST['product_id']}'";
                $cart_item = json_decode(execute($query, "select"));
                if($cart_item->status){
                    $cart_item->data[0]->qty += $_REQUEST['qty'];
                    $query = "UPDATE `cart_items` SET 
                        `qty` = '{$cart_item->data[0]->qty}'
                        WHERE `id` = '{$cart_item->data[0]->id}'";
                    echo execute($query);
                
                }
                else{
                    $query = "INSERT INTO `cart_items` SET 
                        `cart_id` = '{$_REQUEST['cart_id']}',
                        `product_id` = '{$_REQUEST['product_id']}',
                        `qty` = '{$_REQUEST['qty']}'";
                    echo execute($query,"return_id");
                }
            }
            else{
                echo return_data("cart_id, product_id and qty are required");
            }
        }

        if($_GET['action'] == "update_item"){
            if(check('cart_item_id') && check('qty')){
                $query = "UPDATE `cart_items` SET 
                    `qty` = '{$_REQUEST["qty"]}'
                    WHERE `id` = '{$_REQUEST["cart_item_id"]}'";
                echo execute($query);
            }
            else if(check('product_id') && check('cart_id') && check('qty')){
                $query = "UPDATE `cart_items` SET 
                    `qty` = '{$_REQUEST["qty"]}'
                    WHERE `cart_id` = '{$_REQUEST['cart_id']}' AND `product_id` = '{$_REQUEST['product_id']}'";
                echo execute($query);
            }
            else{
                echo return_data("product_id, cart_id and qty are required");
            }
        }

        if($_GET['action'] == "delete_item"){
            if(check('cart_item_id')){
                $query = "DELETE FROM `cart_items` WHERE `id` = '{$_REQUEST["cart_item_id"]}'";
                echo execute($query);
            }
            else if(check('product_id') && check('cart_id')){
                $query = "DELETE FROM `cart_items` WHERE `cart_id` = '{$_REQUEST['cart_id']}' AND `product_id` = '{$_REQUEST["product_id"]}'";
                echo execute($query);
            }
            else{
                echo return_data("product_id and cart_id are required");
            }
        }

        if($_GET['action'] == "read"){
            if(check('cart_id')){
                $query = "SELECT
                    p.*, ci.`qty`
                    FROM `carts` c
                    INNER JOIN `cart_items` ci ON ci.`cart_id` = c.`id`
                    INNER JOIN `products` p ON p.`id` = ci.`product_id` WHERE c.`id` = {$_REQUEST['cart_id']}";
                echo execute($query, "select");
            }
            else{
                echo return_data("cart_id is required");
            }
        }

        if($_GET['action'] == "delete"){
            if(check("cart_id")){
                $query = "DELETE FROM `carts` WHERE `id` = {$_REQUEST['cart_id']}";
                echo execute($query);
            }
            else{
                echo return_data("cart_id is required");
            }
        }
    }