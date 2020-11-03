<?php

    require_once "../config/functions.php";

    if(check('action')){

        if($_GET['action'] == "create"){
            if(check('country') && check('region') && check('city') && check('address') && check('post_code') && check('user_id')){
                $city = json_decode(check_location($_REQUEST['country'], $_REQUEST['region'], $_REQUEST['city']));
                if($city['status']){
                    $query = "INSERT INTO `locations` SET
                        `user_id` = '{$_REQUEST['user_id']}'
                        `city_id` = '{$_REQUEST['city_id']}',
                        `address` = '{$_REQUEST['address']}',
                        `post_code` = '{$_REQUEST['post_code']}'";
                    echo execute($query,"return_id");
                }
                else{
                    echo return_data($city["data"]);
                }
            }
            else{
                echo return_data("All field are required");
            }
        }

        if($_GET['action'] == "read"){
            $ex_query = check("location_id")?" WHERE `id` = {$_REQUEST['location_id']}":"";
            $query = "SELECT
                l.*,
                c.`id` AS city_id, c.`name` AS city_name,
                r.`id` AS region_id, r.`name` AS region_name,
                con.`id` AS country_id, con.`name` AS country_name, con.`phone_code` AS country_phone_code, con.`iso_code` AS country_iso_code
                FROM `locations` l
                INNER JOIN `cities` c ON c.`id` = l.`city_id`
                INNER JOIN `regions` r ON r.`id` = c.`region_id`
                INNER JOIN `countries` con ON con.`id` = r.`country_id`".$ex_query;
            echo execute($query);
        }

        if($_GET['action'] == "update"){
            if(check('country') && check('region') && check('city') && check('address') && check('location_id')){
                $city = json_decode(check_location($_REQUEST['country'], $_REQUEST['region'], $_REQUEST['city']));
                if($city['status']){
                    $query = "UPDATE `locations` 
                        `city_id` = '{$_REQUEST['city_id']}',
                        `address` = '{$_REQUEST['address']}',
                        `post_code` = '{$_REQUEST['post_code']}'
                        WHERE `id` = '{$_REQUEST['location_id']}'";
    
                    echo execute($query);
                }
                else{
                    echo return_data($city["data"]);
                }
            }
            else{
                echo return_data("All field are required");
            }
        }

        if($_GET['action'] == "delete"){
            if(check("location_id")){
                $query = "DELETE FROM `locations` WHERE `id` = {$_REQUEST['location_id']}";
                echo execute($query);
            }
            else{
                echo return_data("location_id is required");
            }
        }
    }