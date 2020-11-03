<?php
    ob_start();    
    session_start();
    // echo "<pre>";
    if(isset($_SESSION['user']) && isset($_SESSION['user'][0]->id) && !empty($_SESSION['user'][0]->id)){
        if(!(isset($_SESSION['cart_id']) && !empty($_SESSION['cart_id']))){
            // echo 1;
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "www.hnh3.xyz/grossary/api/cart.php?action=create&user_id=".$_SESSION['user'][0]->id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response = json_decode($response);
            print_r($response);
            if($response->status){
                $_SESSION['cart_id'] = $response->id;
            }
            else{
                $_SESSION['flash']['status'] == 0;
                $_SESSION['flash']['message'] == "Cart not created";
                // header("location: {$_SERVER['HTTP_REFERER']}");
            }
        }
        // echo 2;

        $curl = curl_init();
        // echo "www.hnh3.xyz/grossary/api/cart.php?action=add_item&cart_id=".$_SESSION['cart_id']."&product_id=".$_POST['id']."&qty=".$_POST['quantity'];
        curl_setopt_array($curl, array(
            CURLOPT_URL => "www.hnh3.xyz/grossary/api/cart.php?action=add_item&cart_id=".$_SESSION['cart_id']."&product_id=".$_POST['id']."&qty=".$_POST['quantity'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo 3;
        
        $response = json_decode($response);
        // print_r($response);
        if($response->status){
            // $_SESSION['cart_id'] = $response->id;
        }
        else{
            $_SESSION['flash']['status'] == 0;
            $_SESSION['flash']['message'] == "Cart item not added";
            // header("location: {$_SERVER['HTTP_REFERER']}");
        }

    }
    else{
        $id = $_POST["id"];
        $name = $_POST["product_name"];
        $image = $_POST["product_image"];
        $price = $_POST['price'];
        $qty = $_POST['quantity'];
        // $total = $_POST['total'];    
        if(isset($_SESSION['cart_items'][$id])){
            $_SESSION['cart_items'][$id]['qty'] += $qty;
        }
        else{
            $_SESSION['cart_items'][$id] = [
                                            "id" => $id,
                                            "name" => $name,
                                            "image" => $image,
                                            "price" => $price,
                                            "qty" => $qty
                                           ];
        }
    }
    // echo"<pre>";
    // print_r($_SESSION);
    // die();
    header("location: {$_SERVER['HTTP_REFERER']}");
    ob_flush();    
?>