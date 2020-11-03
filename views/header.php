	<?php
    if(!isset($_SESSION)){
      session_start();
    }
    $cart_items = [];
    if(isset($_SESSION['cart_id']) && !empty($_SESSION['cart_id'])){
      $curl = curl_init();
      // echo "www.hnh3.xyz/grossary/api/cart.php?action=add_item&cart_id=".$_SESSION['cart_id']."&product_id=".$_POST['id']."&qty=".$_POST['quantity'];
      curl_setopt_array($curl, array(
        CURLOPT_URL => "www.hnh3.xyz/grossary/api/cart.php?action=read&cart_id=".$_SESSION['cart_id'],
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
        $cart_items = $response->data;
      }
    }
    else if(isset($_SESSION['cart_items'])){
      $cart_items = $_SESSION['cart_items'];
    }

  ?>
  
  <div class="py-1 bg-primary">
    	<div class="container">
    		<div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
	    		<div class="col-lg-12 d-block">
		    		<div class="row d-flex">
		    			<div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
						    <span class="text">+1 778-893-1596</span>
					    </div>
					    <div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
						    <span class="text">harshpreet.saini@email.kpu.ca</span>
					    </div>
					    <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
						    <span class="text">3-5 Business days delivery &amp; Free Returns</span>
					    </div>
				    </div>
			    </div>
		    </div>
		  </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.php">Logo</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Shop
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="shop.php">Shop</a></li>
                    <li><a class="dropdown-item" href="#">Wishlist</a></li>
                    <li class="dropdown-submenu has-submenu"><a class="dropdown-item dropdown-toggle" href="#">Single Product</a>
                      <ul class="dropdown-menu" style="display:none">
                        <li><a class="dropdown-item" href="#">Dropdown 1</a></li>
                        <li><a class="dropdown-item" href="#">Dropdown 2</a></li>
                        <li><a class="dropdown-item" href="#">Dropdown 3</a></li>
                      </ul>
                    </li>
                    <li><a class="dropdown-item" href="#">Wishlist</a></li>
                    <li><a class="dropdown-item" href="#">Wishlist</a></li>
                
                  </ul>
                </li>
                <!-- Haris -->
	          <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
	          <!-- <li class="nav-item"><a href="blog.php" class="nav-link">Blog</a></li> -->
	          <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
	          <li class="nav-item cta cta-colored"><a href="cart.php" class="nav-link"><span class="icon-shopping_cart"></span>[<?=(COUNT($cart_items))?>]</a></li>
                <?php if(!empty($_SESSION['user'][0]->role_id)){ ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="images/person_1.jpg" style="border-radius: 100%;" width="30" height="30" alt="logo">
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-cyan" aria-labelledby="navbarDropdownMenuLink-4">
                    <a class="dropdown-item" href="#">My account</a>
                    <a class="dropdown-item" href="#">My orders</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
                </li>
                <?php }else{ ?>
                    <li class="nav-item"><a href="#" class="mt-3 btn btn-success" data-toggle="modal" data-target="#login">Login</a></li>
	                <li class="nav-item" style="margin-left: 20px"><a href="#" class="mt-3 btn border-success" data-toggle="modal" data-target="#register">Create Account</a></li>
                <?php } ?>
              </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
