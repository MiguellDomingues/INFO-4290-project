<?php
ob_start();
session_start();

// echo '<pre>';
// print_r($_SESSION);

$email = $_POST['email'];
$password = $_POST['password'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://www.hnh3.xyz/grossary/api/user.php?action=read",
  // CURLOPT_URL => "https://www.hnh3.xyz/grossary/api/user.php?action=read",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "email=$email&password=$password",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/x-www-form-urlencoded"
  ),
));


$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
    
    $user_data=json_decode($response);
        
    if($user_data->status){
        
        $_SESSION['user'] = $user_data->data;
        $_SESSION['flash']['message']="Login Successfully";
        $_SESSION['flash']['message_type']="success";
        $_SESSION['flash']['status']=$user_data->status==true?'1':'0';
        
        if(isset($_SESSION['cart_items']) && !empty($_SESSION['cart_items'])){
          
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
                if($response->status){
                    $_SESSION['cart_id'] = $response->id;
                }
                else{
                    $_SESSION['flash']['status'] == 0;
                    $_SESSION['flash']['message'] == "Cart not created";
                    // header("location: {$_SERVER['HTTP_REFERER']}");
                }
            }
            // echo"<pre>";
            // print_r($_SESSION['cart_id']);
            // die();
            // echo 2;
            foreach($_SESSION['cart_items'] as $key => $value){
              $curl = curl_init();
              // echo "www.hnh3.xyz/grossary/api/cart.php?action=add_item&cart_id=".$_SESSION['cart_id']."&product_id=".$_POST['id']."&qty=".$_POST['quantity'];
              curl_setopt_array($curl, array(
                  CURLOPT_URL => "www.hnh3.xyz/grossary/api/cart.php?action=add_item&cart_id=".$_SESSION['cart_id']."&product_id=".$value['id']."&qty=".$value['qty'],
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
              }
              else{
                  $_SESSION['flash']['status'] == 0;
                  $_SESSION['flash']['message'] == "Cart item not added";
                  // header("location: {$_SERVER['HTTP_REFERER']}");
              }

            }

          }
        }
        
    }else{
        $_SESSION['flash']['message']=$user_data->data;
        $_SESSION['flash']['message_type']="danger";
        $_SESSION['flash']['status']=$user_data->status==true?'1':'0';
    }
    
header('location:'.$_SERVER['HTTP_REFERER']);
// header('location: index.php');
}
ob_flush();