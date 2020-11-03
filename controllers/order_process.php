<?php
// ob_start();
session_start();    
// print_r($_POST);
$curl = curl_init();
$data = array("user_id"=>$_POST["user_id"], "state"=>$_POST["state"],"address"=>$_POST["address"], "post_code"=>$_POST["zip"], "city"=>$_POST["city"]);
// print_r($data);
curl_setopt_array($curl, array(
  // CURLOPT_URL => "http://www.hnh3.xyz/grossary/api/order.php?action=add_location",
  CURLOPT_URL => "http://www.hnh3.xyz/grossary/api/order.php?action=add_location",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => http_build_query($data),
  CURLOPT_HTTPHEADER => array(
  ),
));
// print_r($curl);
$response = curl_exec($curl);
$err = curl_error($curl);
// print_r($err); 
// print_r($response);  
curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $re = json_decode($response);
  
  if($re->status){
    $row = $re->id;
    $_SESSION['location_id'] = $row;
  }
  echo json_encode($re);
}
// ob_flush();
?>