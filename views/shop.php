<?php 
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once "head.php"; ?>
	<?php
		
		// echo "<pre>";
		// print_r($_SESSION['cart_items']);
		// echo "</pre>";
		$curl = curl_init();
		$category = isset($_REQUEST['category_id']) && !empty($_REQUEST['category_id'])?"&category_id=".$_REQUEST['category_id']:"";

		curl_setopt_array($curl, array(
			CURLOPT_URL => str_replace("ecommerce/", "", $path)."grossary/api/category.php?action=read",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_POSTFIELDS => array('action' => 'read'),
			CURLOPT_HTTPHEADER => array(
				"Content-Type: multipart/form-data; boundary=--------------------------690624064334621688990267"
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		//echo $response;
		$result = json_decode($response);
		// echo"<pre>";
		// print_r($result);
		if($result->status){
			$row = $result->data;
			// echo"<pre>";
			// print_r($row);
		}

		$crl = curl_init();
		curl_setopt_array($crl, array(
			CURLOPT_URL => str_replace("ecommerce/", "", $path)."grossary/api/product.php?action=read".$category,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_POSTFIELDS => array('action' => 'read'),
			CURLOPT_HTTPHEADER => array(
				"Content-Type: multipart/form-data; boundary=--------------------------526585344539876503629713"
			),
		));

		$product = curl_exec($crl);

		curl_close($crl);
		//echo $product;
		$item = json_decode($product);
		if($item->status){
			
		$record = $item->data;
		
		//   echo"<pre>";
		//   print_r($record);		
			
		}

		// $image_path = "https://mobileappstore.co.uk/raheel/grossary/uploads/";

	?>

  </head>
  <body class="goto-here">
	<?php include 'header.php';?>

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Products</span></p>
            <h1 class="mb-0 bread">Products</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center">
    			<div class="col-md-10 mb-5 text-center">
    				<ul class="product-category">
    					<li><a href="#" class="active">All</a></li>
    					<?php foreach ($row as $key => $value){?>
    					<li><a href="<?=($path)?>shop.php?category_id=<?php echo $value->id; ?>"><?php echo $value->name; ?></a></li>
    					<?php }?>
    					<!--<li><a href="#">Fruits</a></li>-->
    					<!--<li><a href="#">Juice</a></li>-->
    					<!--<li><a href="#">Dried</a></li>-->
    				</ul>
    			</div>
    		</div>
    		<div class="row">
    		    <?php foreach($record as $key => $value){?>
    			<div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="product">
    					<a href="<?=($path)?>product-single.php?id=<?php echo $value->id;?>" class="img-prod">
    					    
    					    <img class="img-fluid" src="<?php echo $image_path.$value->image; ?>" alt="Colorlib Template">
    					    
    						<!--<span class="status">30%</span>-->
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 px-3 text-center">
    						<h3><a href="#"><?php echo $value->name;?></a></h3>
    						<div class="d-flex">
    							<div class="pricing">
		    						<p class="price"><span class="mr-2 price-dc"> </span><span class="price-sale">$<?php echo $value->price;?></span></p>
		    					</div>
	    					</div>
	    					
	    					<div class="bottom-area d-flex px-3">
	    						<div class="m-auto d-flex">
	    							<a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
	    								<span><i class="ion-ios-menu"></i></span>
	    							</a>
	    							<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
	    								<span><i class="ion-ios-cart"></i></span>
	    							</a>
	    							<a href="#" class="heart d-flex justify-content-center align-items-center ">
	    								<span><i class="ion-ios-heart"></i></span>
	    							</a>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
    			<?php } ?>
    			<!--<div class="col-md-6 col-lg-3 ftco-animate">-->
    			<!--	<div class="product">-->
    			<!--		<a href="#" class="img-prod"><img class="img-fluid" src="images/product-2.jpg" alt="Colorlib Template">-->
    			<!--			<div class="overlay"></div>-->
    			<!--		</a>-->
    			<!--		<div class="text py-3 pb-4 px-3 text-center">-->
    			<!--			<h3><a href="#">Strawberry</a></h3>-->
    			<!--			<div class="d-flex">-->
    			<!--				<div class="pricing">-->
		    	<!--					<p class="price"><span>$120.00</span></p>-->
		    	<!--				</div>-->
	    		<!--			</div>-->
    			<!--			<div class="bottom-area d-flex px-3">-->
	    		<!--				<div class="m-auto d-flex">-->
	    		<!--					<a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">-->
	    		<!--						<span><i class="ion-ios-menu"></i></span>-->
	    		<!--					</a>-->
	    		<!--					<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">-->
	    		<!--						<span><i class="ion-ios-cart"></i></span>-->
	    		<!--					</a>-->
	    		<!--					<a href="#" class="heart d-flex justify-content-center align-items-center ">-->
	    		<!--						<span><i class="ion-ios-heart"></i></span>-->
	    		<!--					</a>-->
    			<!--				</div>-->
    			<!--			</div>-->
    			<!--		</div>-->
    			<!--	</div>-->
    			<!--</div>-->
    			<!--<div class="col-md-6 col-lg-3 ftco-animate">-->
    			<!--	<div class="product">-->
    			<!--		<a href="#" class="img-prod"><img class="img-fluid" src="images/product-3.jpg" alt="Colorlib Template">-->
	    		<!--			<div class="overlay"></div>-->
	    		<!--		</a>-->
    			<!--		<div class="text py-3 pb-4 px-3 text-center">-->
    			<!--			<h3><a href="#">Green Beans</a></h3>-->
    			<!--			<div class="d-flex">-->
    			<!--				<div class="pricing">-->
		    	<!--					<p class="price"><span>$120.00</span></p>-->
		    	<!--				</div>-->
	    		<!--			</div>-->
    			<!--			<div class="bottom-area d-flex px-3">-->
	    		<!--				<div class="m-auto d-flex">-->
	    		<!--					<a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">-->
	    		<!--						<span><i class="ion-ios-menu"></i></span>-->
	    		<!--					</a>-->
	    		<!--					<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">-->
	    		<!--						<span><i class="ion-ios-cart"></i></span>-->
	    		<!--					</a>-->
	    		<!--					<a href="#" class="heart d-flex justify-content-center align-items-center ">-->
	    		<!--						<span><i class="ion-ios-heart"></i></span>-->
	    		<!--					</a>-->
    			<!--				</div>-->
    			<!--			</div>-->
    			<!--		</div>-->
    			<!--	</div>-->
    			<!--</div>-->
    			<!--<div class="col-md-6 col-lg-3 ftco-animate">-->
    			<!--	<div class="product">-->
    			<!--		<a href="#" class="img-prod"><img class="img-fluid" src="images/product-4.jpg" alt="Colorlib Template">-->
    			<!--			<div class="overlay"></div>-->
    			<!--		</a>-->
    			<!--		<div class="text py-3 pb-4 px-3 text-center">-->
    			<!--			<h3><a href="#">Purple Cabbage</a></h3>-->
    			<!--			<div class="d-flex">-->
    			<!--				<div class="pricing">-->
		    	<!--					<p class="price"><span>$120.00</span></p>-->
		    	<!--				</div>-->
	    		<!--			</div>-->
    			<!--			<div class="bottom-area d-flex px-3">-->
	    		<!--				<div class="m-auto d-flex">-->
	    		<!--					<a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">-->
	    		<!--						<span><i class="ion-ios-menu"></i></span>-->
	    		<!--					</a>-->
	    		<!--					<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">-->
	    		<!--						<span><i class="ion-ios-cart"></i></span>-->
	    		<!--					</a>-->
	    		<!--					<a href="#" class="heart d-flex justify-content-center align-items-center ">-->
	    		<!--						<span><i class="ion-ios-heart"></i></span>-->
	    		<!--					</a>-->
    			<!--				</div>-->
    			<!--			</div>-->
    			<!--		</div>-->
    			<!--	</div>-->
    			<!--</div>-->


    			<!--<div class="col-md-6 col-lg-3 ftco-animate">-->
    			<!--	<div class="product">-->
    			<!--		<a href="#" class="img-prod"><img class="img-fluid" src="images/product-5.jpg" alt="Colorlib Template">-->
    			<!--			<span class="status">30%</span>-->
    			<!--			<div class="overlay"></div>-->
    			<!--		</a>-->
    			<!--		<div class="text py-3 pb-4 px-3 text-center">-->
    			<!--			<h3><a href="#">Tomatoe</a></h3>-->
    			<!--			<div class="d-flex">-->
    			<!--				<div class="pricing">-->
		    	<!--					<p class="price"><span class="mr-2 price-dc">$120.00</span><span class="price-sale">$80.00</span></p>-->
		    	<!--				</div>-->
	    		<!--			</div>-->
	    		<!--			<div class="bottom-area d-flex px-3">-->
	    		<!--				<div class="m-auto d-flex">-->
	    		<!--					<a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">-->
	    		<!--						<span><i class="ion-ios-menu"></i></span>-->
	    		<!--					</a>-->
	    		<!--					<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">-->
	    		<!--						<span><i class="ion-ios-cart"></i></span>-->
	    		<!--					</a>-->
	    		<!--					<a href="#" class="heart d-flex justify-content-center align-items-center ">-->
	    		<!--						<span><i class="ion-ios-heart"></i></span>-->
	    		<!--					</a>-->
    			<!--				</div>-->
    			<!--			</div>-->
    			<!--		</div>-->
    			<!--	</div>-->
    			<!--</div>-->
    			<!--<div class="col-md-6 col-lg-3 ftco-animate">-->
    			<!--	<div class="product">-->
    			<!--		<a href="#" class="img-prod"><img class="img-fluid" src="images/product-6.jpg" alt="Colorlib Template">-->
    			<!--			<div class="overlay"></div>-->
    			<!--		</a>-->
    			<!--		<div class="text py-3 pb-4 px-3 text-center">-->
    			<!--			<h3><a href="#">Brocolli</a></h3>-->
    			<!--			<div class="d-flex">-->
    			<!--				<div class="pricing">-->
		    	<!--					<p class="price"><span>$120.00</span></p>-->
		    	<!--				</div>-->
	    		<!--			</div>-->
    			<!--			<div class="bottom-area d-flex px-3">-->
	    		<!--				<div class="m-auto d-flex">-->
	    		<!--					<a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">-->
	    		<!--						<span><i class="ion-ios-menu"></i></span>-->
	    		<!--					</a>-->
	    		<!--					<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">-->
	    		<!--						<span><i class="ion-ios-cart"></i></span>-->
	    		<!--					</a>-->
	    		<!--					<a href="#" class="heart d-flex justify-content-center align-items-center ">-->
	    		<!--						<span><i class="ion-ios-heart"></i></span>-->
	    		<!--					</a>-->
    			<!--				</div>-->
    			<!--			</div>-->
    			<!--		</div>-->
    			<!--	</div>-->
    			<!--</div>-->
    			<!--<div class="col-md-6 col-lg-3 ftco-animate">-->
    			<!--	<div class="product">-->
    			<!--		<a href="#" class="img-prod"><img class="img-fluid" src="images/product-7.jpg" alt="Colorlib Template">-->
	    		<!--			<div class="overlay"></div>-->
	    		<!--		</a>-->
    			<!--		<div class="text py-3 pb-4 px-3 text-center">-->
    			<!--			<h3><a href="#">Carrots</a></h3>-->
    			<!--			<div class="d-flex">-->
    			<!--				<div class="pricing">-->
		    	<!--					<p class="price"><span>$120.00</span></p>-->
		    	<!--				</div>-->
	    		<!--			</div>-->
    			<!--			<div class="bottom-area d-flex px-3">-->
	    		<!--				<div class="m-auto d-flex">-->
	    		<!--					<a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">-->
	    		<!--						<span><i class="ion-ios-menu"></i></span>-->
	    		<!--					</a>-->
	    		<!--					<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">-->
	    		<!--						<span><i class="ion-ios-cart"></i></span>-->
	    		<!--					</a>-->
	    		<!--					<a href="#" class="heart d-flex justify-content-center align-items-center ">-->
	    		<!--						<span><i class="ion-ios-heart"></i></span>-->
	    		<!--					</a>-->
    			<!--				</div>-->
    			<!--			</div>-->
    			<!--		</div>-->
    			<!--	</div>-->
    			<!--</div>-->
    			<!--<div class="col-md-6 col-lg-3 ftco-animate">-->
    			<!--	<div class="product">-->
    			<!--		<a href="#" class="img-prod"><img class="img-fluid" src="images/product-8.jpg" alt="Colorlib Template">-->
    			<!--			<div class="overlay"></div>-->
    			<!--		</a>-->
    			<!--		<div class="text py-3 pb-4 px-3 text-center">-->
    			<!--			<h3><a href="#">Fruit Juice</a></h3>-->
    			<!--			<div class="d-flex">-->
    			<!--				<div class="pricing">-->
		    	<!--					<p class="price"><span>$120.00</span></p>-->
		    	<!--				</div>-->
	    		<!--			</div>-->
    			<!--			<div class="bottom-area d-flex px-3">-->
	    		<!--				<div class="m-auto d-flex">-->
	    		<!--					<a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">-->
	    		<!--						<span><i class="ion-ios-menu"></i></span>-->
	    		<!--					</a>-->
	    		<!--					<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">-->
	    		<!--						<span><i class="ion-ios-cart"></i></span>-->
	    		<!--					</a>-->
	    		<!--					<a href="#" class="heart d-flex justify-content-center align-items-center ">-->
	    		<!--						<span><i class="ion-ios-heart"></i></span>-->
	    		<!--					</a>-->
    			<!--				</div>-->
    			<!--			</div>-->
    			<!--		</div>-->
    			<!--	</div>-->
    			<!--</div>-->

    			<!--<div class="col-md-6 col-lg-3 ftco-animate">-->
    			<!--	<div class="product">-->
    			<!--		<a href="#" class="img-prod"><img class="img-fluid" src="images/product-9.jpg" alt="Colorlib Template">-->
    			<!--			<span class="status">30%</span>-->
    			<!--			<div class="overlay"></div>-->
    			<!--		</a>-->
    			<!--		<div class="text py-3 pb-4 px-3 text-center">-->
    			<!--			<h3><a href="#">Onion</a></h3>-->
    			<!--			<div class="d-flex">-->
    			<!--				<div class="pricing">-->
		    	<!--					<p class="price"><span class="mr-2 price-dc">$120.00</span><span class="price-sale">$80.00</span></p>-->
		    	<!--				</div>-->
	    		<!--			</div>-->
	    		<!--			<div class="bottom-area d-flex px-3">-->
	    		<!--				<div class="m-auto d-flex">-->
	    		<!--					<a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">-->
	    		<!--						<span><i class="ion-ios-menu"></i></span>-->
	    		<!--					</a>-->
	    		<!--					<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">-->
	    		<!--						<span><i class="ion-ios-cart"></i></span>-->
	    		<!--					</a>-->
	    		<!--					<a href="#" class="heart d-flex justify-content-center align-items-center ">-->
	    		<!--						<span><i class="ion-ios-heart"></i></span>-->
	    		<!--					</a>-->
    			<!--				</div>-->
    			<!--			</div>-->
    			<!--		</div>-->
    			<!--	</div>-->
    			<!--</div>-->
    			<!--<div class="col-md-6 col-lg-3 ftco-animate">-->
    			<!--	<div class="product">-->
    			<!--		<a href="#" class="img-prod"><img class="img-fluid" src="images/product-10.jpg" alt="Colorlib Template">-->
    			<!--			<div class="overlay"></div>-->
    			<!--		</a>-->
    			<!--		<div class="text py-3 pb-4 px-3 text-center">-->
    			<!--			<h3><a href="#">Apple</a></h3>-->
    			<!--			<div class="d-flex">-->
    			<!--				<div class="pricing">-->
		    	<!--					<p class="price"><span>$120.00</span></p>-->
		    	<!--				</div>-->
	    		<!--			</div>-->
    			<!--			<div class="bottom-area d-flex px-3">-->
	    		<!--				<div class="m-auto d-flex">-->
	    		<!--					<a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">-->
	    		<!--						<span><i class="ion-ios-menu"></i></span>-->
	    		<!--					</a>-->
	    		<!--					<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">-->
	    		<!--						<span><i class="ion-ios-cart"></i></span>-->
	    		<!--					</a>-->
	    		<!--					<a href="#" class="heart d-flex justify-content-center align-items-center ">-->
	    		<!--						<span><i class="ion-ios-heart"></i></span>-->
	    		<!--					</a>-->
    			<!--				</div>-->
    			<!--			</div>-->
    			<!--		</div>-->
    			<!--	</div>-->
    			<!--</div>-->
    			<!--<div class="col-md-6 col-lg-3 ftco-animate">-->
    			<!--	<div class="product">-->
    			<!--		<a href="#" class="img-prod"><img class="img-fluid" src="images/product-11.jpg" alt="Colorlib Template">-->
	    		<!--			<div class="overlay"></div>-->
	    		<!--		</a>-->
    			<!--		<div class="text py-3 pb-4 px-3 text-center">-->
    			<!--			<h3><a href="#">Garlic</a></h3>-->
    			<!--			<div class="d-flex">-->
    			<!--				<div class="pricing">-->
		    	<!--					<p class="price"><span>$120.00</span></p>-->
		    	<!--				</div>-->
	    		<!--			</div>-->
    			<!--			<div class="bottom-area d-flex px-3">-->
	    		<!--				<div class="m-auto d-flex">-->
	    		<!--					<a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">-->
	    		<!--						<span><i class="ion-ios-menu"></i></span>-->
	    		<!--					</a>-->
	    		<!--					<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">-->
	    		<!--						<span><i class="ion-ios-cart"></i></span>-->
	    		<!--					</a>-->
	    		<!--					<a href="#" class="heart d-flex justify-content-center align-items-center ">-->
	    		<!--						<span><i class="ion-ios-heart"></i></span>-->
	    		<!--					</a>-->
    			<!--				</div>-->
    			<!--			</div>-->
    			<!--		</div>-->
    			<!--	</div>-->
    			<!--</div>-->
    			<!--<div class="col-md-6 col-lg-3 ftco-animate">-->
    			<!--	<div class="product">-->
    			<!--		<a href="#" class="img-prod"><img class="img-fluid" src="images/product-12.jpg" alt="Colorlib Template">-->
    			<!--			<div class="overlay"></div>-->
    			<!--		</a>-->
    			<!--		<div class="text py-3 pb-4 px-3 text-center">-->
    			<!--			<h3><a href="#">Chilli</a></h3>-->
    			<!--			<div class="d-flex">-->
    			<!--				<div class="pricing">-->
		    	<!--					<p class="price"><span>$120.00</span></p>-->
		    	<!--				</div>-->
	    		<!--			</div>-->
    			<!--			<div class="bottom-area d-flex px-3">-->
	    		<!--				<div class="m-auto d-flex">-->
	    		<!--					<a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">-->
	    		<!--						<span><i class="ion-ios-menu"></i></span>-->
	    		<!--					</a>-->
	    		<!--					<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">-->
	    		<!--						<span><i class="ion-ios-cart"></i></span>-->
	    		<!--					</a>-->
	    		<!--					<a href="#" class="heart d-flex justify-content-center align-items-center ">-->
	    		<!--						<span><i class="ion-ios-heart"></i></span>-->
	    		<!--					</a>-->
    			<!--				</div>-->
    			<!--			</div>-->
    			<!--		</div>-->
    			<!--	</div>-->
    			<!--</div>-->
    		</div>
    		<div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">
              <ul>
                <li><a href="#">&lt;</a></li>
                <li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&gt;</a></li>
              </ul>
            </div>
          </div>
        </div>
    	</div>
    </section>

		<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
      <div class="container py-4">
        <div class="row d-flex justify-content-center py-5">
          <div class="col-md-6">
          	<h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
          	<span>Get e-mail updates about our latest shops and special offers</span>
          </div>
          <div class="col-md-6 d-flex align-items-center">
            <form action="#" class="subscribe-form">
              <div class="form-group d-flex">
                <input type="text" class="form-control" placeholder="Enter email address">
                <input type="submit" value="Subscribe" class="submit px-3">
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <?php include 'footer.php';?>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>
<?php 
    ob_flush();
?>