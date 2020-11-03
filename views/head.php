<?php 
if(!isset($_SESSION)) {
    session_start();
}
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
$path = "http://www.hnh3.xyz/ecommerce/";
?>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?=($path)?>css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="<?=($path)?>css/animate.css">
    
    <link rel="stylesheet" href="<?=($path)?>css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?=($path)?>css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?=($path)?>css/magnific-popup.css">

    <link rel="stylesheet" href="<?=($path)?>css/aos.css">

    <link rel="stylesheet" href="<?=($path)?>css/ionicons.min.css">

    <link rel="stylesheet" href="<?=($path)?>css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="<?=($path)?>css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="<?=($path)?>css/flaticon.css">
    <link rel="stylesheet" href="<?=($path)?>css/icomoon.css">
    <link rel="stylesheet" href="<?=($path)?>css/style.css">
    
    <link rel="stylesheet" href="<?=($path)?>admin/assets/plugins/sweetalert2/sweetalert2.min.css">
    <!--head_order-->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.0/css/boxicons.min.css"/>
  <!--end-head_order-->
  <style>
    .ftco-navbar-light.scrolled .mt-3{margin-top:0.4rem !important;margin-left:10px;}.dropdown-submenu {
      position: relative;
    }

    .dropdown-submenu a::after {
      transform: rotate(-90deg);
      position: absolute;
      right: 6px;
      top: .8em;
    }

    .dropdown-submenu .dropdown-menu {
      top: 0;
      left: 100%;
      margin-left: .1rem;
      margin-right: .1rem;
    }
  </style>
<?php include 'login-modal.php';?>
<?php include 'register-modal.php';?>
<?php include 'process/categories.php';?>
<?php
  $image_path = "http://www.hnh3.xyz/grossary/uploads/";
?>