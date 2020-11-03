<?php
ob_start();
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://www.hnh3.xyz/grossary/api/category.php?action=read",
  // CURLOPT_URL => "www.hnh3.xyz/grossary/api/category.php?action=read",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/x-www-form-urlencoded"
  ),
));


$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

// echo $response;die();

if ($err) {
  echo "cURL Error #:" . $err;
} else {
    
    $categories_data=json_decode($response);
        
    if($categories_data->status){
        
        $categories = $categories_data->data;
        
    }else{
        
        // $categories = "Categories Are NOt Found";
        $_SESSION['flash']['message']=$user_data->data;
        $_SESSION['flash']['status']=$user_data->status==true?'1':'0';
    }
    
// header('location:'.$_SERVER['HTTP_REFERER']);die();
}
ob_flush();
?>