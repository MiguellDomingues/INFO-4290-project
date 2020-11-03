<?php

    require_once "database.php";

    // HOST
    function host_dir(){
        // return "http://www.hnh3.xyz/grossary/";
        return "http://www.hnh3.xyz/grossary/";
    }

    // Return Data To JSON
    function return_data($data, $status = false, $return_id = "NaN"){
        $array = [
            "status" => $status,
            "data" => $data
        ];
        if($return_id != "NaN"){
            $array["id"] = $return_id;
        }
        return json_encode($array);
    }

    // Check variables for validation
    function check($str, $condition = "request"){
        if($condition == "request"){
            if(isset($_REQUEST[$str]) && !empty($_REQUEST[$str])){
                return true;
            }
        }
        else if($condition == "post"){
            if(isset($_POST[$str]) && !empty($_POST[$str])){
                return true;
            }
        }
        else if($condition == "get"){
            if(isset($_GET[$str]) && !empty($_GET[$str])){
                return true;
            }
        }
        else if($condition == "file"){
            if(isset($_FILES[$str]["tmp_name"]) && !empty($_FILES[$str]["tmp_name"])){
                return true;
            }
        }
        return false;
    }

    // Execute any type of query and get suitable response
    function execute($query, $condition = ""){
        global $conn;
        $result = $conn->query($query);

        if($condition == "select"){
            if(is_object($result)){
                if($result->num_rows){
                    $data = [];
                    while($row = $result->fetch_assoc()){
                        $data[] = $row;
                    }
                    return return_data($data, true);
                }
                return return_data("Data Not Found");
            }
            return return_data(str_replace("\n", " ", $conn->error));
        }
        else{
            if($result){
                if($condition == "return_id"){
                    $last_insert_id = $conn->insert_id;
                    return return_data("Query has been executed", true, $last_insert_id);
                }
                return return_data("Query has been executed", true);
            }
            return return_data(str_replace("\n", " ", $conn->error));
        }
    }

    // Check Password 
    function check_password($user_id, $password){
        global $conn;
        $query = "SELECT * FROM `users` WHERE `id` = {$user_id}";
        $user = json_decode(execute($query, "select"));
        if($user->status){
            if($user->data[0]->password == md5($password)){
                return return_data("Password Matched", true);
            }
            return return_data("Password Not Matched");
        }
        return return_data("User not found");
    }
    
    // Check Location 
    function check_location($country, $region, $city){
        global $conn;
        $query = "SELECT * FROM `regions` WHERE `country_id` = '{$country}' AND `name` = LOWER('{$region}')";
        $region_data = json_decode(execute($query, "select"));
        if($region_data['status']){
            $region_id = $region_data['data'][0]['id'];
        }
        else{
            $query = "INSERT INTO `regions` SET
                `country_id` = '{$country}',
                `name` = '{$region}'";
            $region_data = json_decode(execute($query, "return_id"));
            if($region_data['status']){
                $region_id = $region_data["data"];
            }
            else{
                return return_data(str_replace("\n", " ", $conn->error));
            }
        }

        $query = "SELECT * FROM `cities` WHERE `region_id` = '{$region_id}' AND `name` = LOWER('{$region}')";
        $city_data = json_decode(execute($query, "select"));
        if($city_data['status']){
            $city_id = $city_data['data'][0]['id'];
        }
        else{
            $query = "INSERT INTO `cities` SET
                `region_id` = '{$region_id}',
                `name` = '{$region}'";
            $city_data = json_decode(execute($query, "return_id"));
            if($city_data['status']){
                $city_id = $city_data["data"];
            }
            else{
                return return_data(str_replace("\n", " ", $conn->error));
            }
        }
        return return_data($city_id, true);
    }

    // Upload Image 
    function upload_image($file){
        if(is_array($file) && isset($file['tmp_name']) && !empty($file['tmp_name'])){
            if($file["error"] == UPLOAD_ERR_OK){
                $ext = explode(".", $file['name']);
                $name = "image-".rand(100,999).time().".".$ext[COUNT($ext) - 1];
                $dir = "../uploads/";
                if(move_uploaded_file($file['tmp_name'], $dir.$name)){
                    return return_data($name, true);
                }
                return return_data("File not uploaded");
            }
            return return_data("File not found");
        }
    }



