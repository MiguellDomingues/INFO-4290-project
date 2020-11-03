<?php
ob_start();
  session_start();
//   require_once '../api/config.php';
//   require_once '../api/functions.php';
//   include '../api/mail/send_email.php';
//   include '../api/mail/admin.php';
echo "<pre>"; 
if(isset($_REQUEST["cancelled"])){
    
    $id = $_SESSION['ment_id'];
    
    // unset($_SESSION['fname']);
    // unset($_SESSION['pcode']);
    // unset($_SESSION['email']);
    // unset($_SESSION['ment_id']);
    // unset($_SESSION['phone']);
    
    $_SESSION["alert"]["type"] = "error";
    $_SESSION["alert"]["title"] = "Error";
    $_SESSION["alert"]["message"] = "payment has been cancelled";
    print_r($_SESSION);
    // header("location: ./booking.php?id=".$id);
}
else if(isset($_REQUEST['session_id']) && !empty($_REQUEST['session_id'])){
  // print_r($_REQUEST);
  // print_r($_SESSION);
  $coupon = isset($_SESSION['coupon']['id'])?"&coupon_id={$_SESSION['coupon']['id']}":"";
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => "www.hnh3.xyz/grossary/api/order.php?action=create&charge_id=".$_REQUEST['session_id']."&cart_id=".$_SESSION['cart_id']."&location_id=".$_SESSION['location_id'].$coupon."&user_id=".$_SESSION['user'][0]->id,
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
//   print_r($response); 
  if($response->status){    
      unset($_SESSION['cart_id']);
      unset($_SESSION['location_id']);
      if(isset($_SESSION['coupon'])){
          unset($_SESSION['coupon']);
      }
      if(isset($_SESSION['cart_items'])){
          unset($_SESSION['cart_items']);
      }
  }
  else{

  }
}
//   print_r($_REQUEST);
//   print_r($_SESSION);
// echo "</pre>";
// die();
header("location: ../index.php");
ob_flush();

?>