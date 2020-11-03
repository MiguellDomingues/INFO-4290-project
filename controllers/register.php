<?php
ob_start();
session_start();

// print_r($_POST);die();

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$password = $_POST['password'];

$curl = curl_init();

curl_setopt_array($curl, array(
  // CURLOPT_URL => "http://www.hnh3.xyz/grossary/api/user.php?action=create",
  CURLOPT_URL => "http://www.hnh3.xyz/grossary/api/user.php?action=create",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "first_name=$first_name&last_name=$last_name&phone=$phone&gender=$gender&email=$email&password=$password",
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
    $user_data=json_decode($response);
    // print_r($user_data);
    // die();
    if($user_data->status){
        // echo $response;die();
        // echo "yes";die();
        $_SESSION['user'] = $user_data->data;
        $_SESSION['flash']['message']="Your Account Created Successfully";
        $_SESSION['flash']['status']=$user_data->status==true?'1':'0';
    }else{
        // echo "no";die();
        $_SESSION['flash']['message']=$user_data->data;
        $_SESSION['flash']['status']=$user_data->status==true?'1':'0';
    }
    
header('location:'.$_SERVER['HTTP_REFERER']);die();
}
ob_flush();