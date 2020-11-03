<?php
    ob_start();
    session_start();
    
    $id = $_REQUEST['product_id'];
    $qty = $_REQUEST['qty'];
    // echo"<pre>";
    // print_r($_REQUEST);
    // print_r($_SESSION['cart_items']);
    // die();
    if(isset($_SESSION['cart_id']) && !empty($_SESSION['cart_id'])){
        $curl = curl_init();
        // echo "www.hnh3.xyz/grossary/api/cart.php?action=add_item&cart_id=".$_SESSION['cart_id']."&product_id=".$_POST['id']."&qty=".$_POST['quantity'];
        curl_setopt_array($curl, array(
          CURLOPT_URL => "www.hnh3.xyz/grossary/api/cart.php?action=update_item&qty={$qty}&product_id={$id}&cart_id=".$_SESSION['cart_id'],
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
        echo $response;
        // $response = json_decode($response);
        // print_r($response);
        // print_r($_SESSION['cart_id']);
        // if($response->status){
        //   $cart_items = $response->data;
        // }
    }
    else{
        $_SESSION['cart_items'][$id]['qty'] = $qty;
        echo json_encode([
                "status" => true,
                "data" => "quantity successfully updated"
            ]);
    }
    
    // header("location:../cart.php");
    ob_flush();
?>