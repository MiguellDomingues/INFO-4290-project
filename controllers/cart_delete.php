<?php
    ob_start();
    session_start();
    
    $id = $_GET['id'];
    //  echo"<pre>";
    // print_r($_SESSION['cart_items']); die();
    if(isset($_SESSION['cart_id']) && !empty($_SESSION['cart_id'])){
        $curl = curl_init();
        // echo "www.hnh3.xyz/grossary/api/cart.php?action=add_item&cart_id=".$_SESSION['cart_id']."&product_id=".$_POST['id']."&qty=".$_POST['quantity'];
        curl_setopt_array($curl, array(
          CURLOPT_URL => "www.hnh3.xyz/grossary/api/cart.php?action=delete_item&product_id={$id}&cart_id=".$_SESSION['cart_id'],
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
        // print_r($_SESSION['cart_id']);
        if($response->status){
        //   $cart_items = $response->data;
        }
    }
    else{
        unset($_SESSION['cart_items'][$id]);
    }
    
    header("location:../cart.php");
    ob_flush();
?>