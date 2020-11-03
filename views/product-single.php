<?php 
    ob_start();
    if(!( isset($_REQUEST['id']) && !empty($_REQUEST['id']) )){
        header("location: ./shop.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once "head.php" ?>
	<?php
	    $review_status = false;
		if(isset($_SESSION['user'][0]->id)){
		    $crl = curl_init();
		    $Arr = array('action'=>'read', 'product_id'=>$_REQUEST['id']);
    		curl_setopt_array($crl, array(
    			CURLOPT_URL => str_replace("ecommerce/", "", $path)."grossary/api/review.php?action=check_review&user_id=".$_SESSION['user'][0]->id."&product_id=".$_REQUEST['id'],
    			CURLOPT_RETURNTRANSFER => true,
    			CURLOPT_ENCODING => "",
    			CURLOPT_MAXREDIRS => 10,
    			CURLOPT_TIMEOUT => 0,
    			CURLOPT_FOLLOWLOCATION => true,
    			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    			CURLOPT_CUSTOMREQUEST => "GET",
    			CURLOPT_POSTFIELDS => $Arr,
    			CURLOPT_HTTPHEADER => array(),
    		));
    
    		$product = curl_exec($crl);
    
    		curl_close($crl);
            // echo $product;
    		$review = json_decode($product);
            // echo "<pre>";
            // print_r($review);
            // echo "</pre>";
			
	        $review_status = $review->status;
		}
		
		$crl = curl_init();
		$Arr = array('action'=>'read', 'product_id'=>$_REQUEST['id']);
		curl_setopt_array($crl, array(
			CURLOPT_URL => str_replace("ecommerce/", "", $path)."grossary/api/product.php?action=read&product_id='".$_REQUEST['id']."'",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_POSTFIELDS => $Arr,
			CURLOPT_HTTPHEADER => array(),
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
		foreach($record as $key => $value){
			//echo $value->name;
		};
		// $image_path = "https://mobileappstore.co.uk/raheel/grossary/uploads/";
		// echo $_SESSION['cart_id'];
	?>
	<style>
	    .review-avatar{
            width: 80px;
            border-radius: 50%;
	    }
	</style>
  </head>
  <body class="goto-here">
		<?php include 'header.php';?>

    <div class="hero-wrap hero-bread" style="background-image: url('<?php echo $image_path.$value->image;?>');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span class="mr-2"><a href="index.html">Product</a></span> <span>Product Single</span></p>
            <h1 class="mb-0 bread">Product Single</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
    	<div class="container">
    	    <form method="post" action="process/insertcart.php">
    	        <input type="hidden" name="id" value="<?=($value->id)?>" >
    	        <input type="hidden" name="product_name" value="<?=($value->name)?>" >
                <input type="hidden" name="product_image" value="<?=($value->image)?>" >
                <input type="hidden" name="price" value="<?=($value->price)?>" >
                <!--<input type="hidden" name="total" value="<?=($value->price)?>" >-->
                
    		<div class="row">
    			<div class="col-lg-6 mb-5 ftco-animate">
    				<a href="<?=($image_path.$value->image)?>" class="image-popup"><img src="<?php echo $image_path.$value->image;?>" class="img-fluid" alt="Colorlib Template"></a>
    			</div>
    			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
    				<h3><?php echo $value->name;?></h3>
    				<div class="rating d-flex">
							<p class="text-left mr-4">
								<a href="#" class="mr-2">5.0</a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
							</p>
							<p class="text-left mr-4">
								<a href="#" class="mr-2" style="color: #000;">100 <span style="color: #bbb;">Rating</span></a>
							</p>
							<p class="text-left">
								<a href="#" class="mr-2" style="color: #000;">500 <span style="color: #bbb;">Sold</span></a>
							</p>
						</div>
    				<p class="price"><span>$<?php echo $value->price;?></span></p>
    				<p><?php echo $value->desc;?></p>
						<div class="row mt-4">
							<div class="col-md-6">
								<div class="form-group d-flex">
		              <div class="select-wrap">
	                  <div class="icon"><span class="ion-ios-arrow-down"></span></div>
	                  <!--<select name="" id="" class="form-control">-->
	                  <!--	<option value="">Small</option>-->
	                  <!--  <option value="">Medium</option>-->
	                  <!--  <option value="">Large</option>-->
	                  <!--  <option value="">Extra Large</option>-->
	                  <!--</select>-->
	                </div>
		            </div>
							</div>
							<div class="w-100"></div>
							<div class="input-group col-md-6 d-flex mb-3">
	             	<span class="input-group-btn mr-2">
	                	<button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
	                   <i class="ion-ios-remove"></i>
	                	</button>
	            		</span>
	             	<input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
	             	<span class="input-group-btn ml-2">
	                	<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
	                     <i class="ion-ios-add"></i>
	                 </button>
	             	</span>
	          	</div>
	          	<div class="w-100"></div>
	          	<div class="col-md-12">
	          		<p style="color: #000;"><?=($value->stock)?> <?=($value->um)?> available</p>
	          	</div>
          	</div>
                <button type="submit" class="btn btn-fefault cart">
        			<i class="fa fa-shopping-cart"></i>
        			Add to cart
    			</button>
			</div>
    		</div>
    		</form>
    	</div>
    </section>

    
    
    <!--review-->
    
        <div class="container">
    			
		<!--<div class="row">-->
		<!--	<div class="col-sm-3">-->
		<!--		<div class="rating-block">-->
		<!--			<h4>Average user rating</h4>-->
		<!--			<h2 class="bold padding-bottom-7">4.3 <small>/ 5</small></h2>-->
		<!--			<button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">-->
		<!--			  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>-->
		<!--			</button>-->
		<!--			<button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">-->
		<!--			  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>-->
		<!--			</button>-->
		<!--			<button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">-->
		<!--			  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>-->
		<!--			</button>-->
		<!--			<button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">-->
		<!--			  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>-->
		<!--			</button>-->
		<!--			<button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">-->
		<!--			  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>-->
		<!--			</button>-->
		<!--				<p class="text-left mr-4">-->
		<!--						<a href="#" class="mr-2">5.0</a>-->
		<!--						<a href="#"><span class="ion-ios-star-outline"></span></a>-->
		<!--						<a href="#"><span class="ion-ios-star-outline"></span></a>-->
		<!--						<a href="#"><span class="ion-ios-star-outline"></span></a>-->
		<!--						<a href="#"><span class="ion-ios-star-outline"></span></a>-->
		<!--						<a href="#"><span class="ion-ios-star-outline"></span></a>-->
		<!--					</p>-->
		<!--		</div>-->
		<!--	</div>-->
		<!--	<div class="col-sm-3">-->
		<!--		<h4>Rating breakdown</h4>-->
		<!--		<div class="pull-left">-->
		<!--			<div class="pull-left" style="width:35px; line-height:1;">-->
		<!--				<div style="height:9px; margin:5px 0;">5 <span class="glyphicon glyphicon-star"></span></div>-->
		<!--			</div>-->
		<!--			<div class="pull-left" style="width:180px;">-->
		<!--				<div class="progress" style="height:9px; margin:8px 0;">-->
		<!--				  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: 1000%">-->
		<!--					<span class="sr-only">80% Complete (danger)</span>-->
		<!--				  </div>-->
		<!--				</div>-->
		<!--			</div>-->
		<!--			<div class="pull-right" style="margin-left:10px;">1</div>-->
		<!--		</div>-->
		<!--		<div class="pull-left">-->
		<!--			<div class="pull-left" style="width:35px; line-height:1;">-->
		<!--				<div style="height:9px; margin:5px 0;">4 <span class="glyphicon glyphicon-star"></span></div>-->
		<!--			</div>-->
		<!--			<div class="pull-left" style="width:180px;">-->
		<!--				<div class="progress" style="height:9px; margin:8px 0;">-->
		<!--				  <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5" style="width: 80%">-->
		<!--					<span class="sr-only">80% Complete (danger)</span>-->
		<!--				  </div>-->
		<!--				</div>-->
		<!--			</div>-->
		<!--			<div class="pull-right" style="margin-left:10px;">1</div>-->
		<!--		</div>-->
		<!--		<div class="pull-left">-->
		<!--			<div class="pull-left" style="width:35px; line-height:1;">-->
		<!--				<div style="height:9px; margin:5px 0;">3 <span class="glyphicon glyphicon-star"></span></div>-->
		<!--			</div>-->
		<!--			<div class="pull-left" style="width:180px;">-->
		<!--				<div class="progress" style="height:9px; margin:8px 0;">-->
		<!--				  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5" style="width: 60%">-->
		<!--					<span class="sr-only">80% Complete (danger)</span>-->
		<!--				  </div>-->
		<!--				</div>-->
		<!--			</div>-->
		<!--			<div class="pull-right" style="margin-left:10px;">0</div>-->
		<!--		</div>-->
		<!--		<div class="pull-left">-->
		<!--			<div class="pull-left" style="width:35px; line-height:1;">-->
		<!--				<div style="height:9px; margin:5px 0;">2 <span class="glyphicon glyphicon-star"></span></div>-->
		<!--			</div>-->
		<!--			<div class="pull-left" style="width:180px;">-->
		<!--				<div class="progress" style="height:9px; margin:8px 0;">-->
		<!--				  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5" style="width: 40%">-->
		<!--					<span class="sr-only">80% Complete (danger)</span>-->
		<!--				  </div>-->
		<!--				</div>-->
		<!--			</div>-->
		<!--			<div class="pull-right" style="margin-left:10px;">0</div>-->
		<!--		</div>-->
		<!--		<div class="pull-left">-->
		<!--			<div class="pull-left" style="width:35px; line-height:1;">-->
		<!--				<div style="height:9px; margin:5px 0;">1 <span class="glyphicon glyphicon-star"></span></div>-->
		<!--			</div>-->
		<!--			<div class="pull-left" style="width:180px;">-->
		<!--				<div class="progress" style="height:9px; margin:8px 0;">-->
		<!--				  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5" style="width: 20%">-->
		<!--					<span class="sr-only">80% Complete (danger)</span>-->
		<!--				  </div>-->
		<!--				</div>-->
		<!--			</div>-->
		<!--			<div class="pull-right" style="margin-left:10px;">0</div>-->
		<!--		</div>-->
		<!--	</div>			-->
		<!--</div>			-->
		<div class="row">
		    <?php
		        if($review_status){
		            ?>
            		   <div class="col-md-12">
            		       <form id="review_form" action="process/review.php?action=create" method="POST" role="form">
            		           <div class="form-group">
            		               <label>Review:</label>
            		               <textarea id="review" name="review" class="form-control"></textarea>
            		           </div>
            		            <div>
            		               <p class="text-left mr-4 float-right">
                						<!--	<a href="#" class="mr-2">5.0</a>-->
                						<!--	<a href="#"><span class="ion-ios-star-outline rating-star"></span></a>-->
                						<!--	<a href="#"><span class="ion-ios-star-outline rating-star"></span></a>-->
                						<!--	<a href="#"><span class="ion-ios-star-outline rating-star"></span></a>-->
                						<!--	<a href="#"><span class="ion-ios-star-outline"></span></a>-->
                						<!--	<a href="#"><span class="ion-ios-star-outline"></span></a>-->
                							
                                    	<!--					<div class="rating1">-->
                                        <!-- <input name="stars" id="e5" type="radio"></a><label for="e5">☆</label>-->
                                        <!-- <input name="stars" id="e4" type="radio"></a><label for="e4">☆</label>-->
                                    	<!--	<input name="stars" id="e3" type="radio"></a><label for="e3">☆</label>-->
                                    	<!--<input name="stars" id="e2" type="radio"></a><label for="e2">☆</label>-->
                                    	<!--<input name="stars" id="e1" type="radio"></a><label for="e1">☆</label>-->
                                    	<!--</div>-->
                                    
                                    	<!--<h2>direction:rtl and general siblings selector + &lt;a&gt; element</h2>-->
                	
                                    	<div class="rating1 rating2">
                                    		<a href="#5" data-val="5" title="Give 5 stars">★</a>
                                    		<a href="#4" data-val="4" title="Give 4 stars">★</a>
                                    		<a href="#3" data-val="3" title="Give 3 stars">★</a>
                                    		<a href="#2" data-val="2" title="Give 2 stars">★</a>
                                    		<a href="#1" class="active" data-val="1" title="Give 1 star">★</a>
                                    	    <input type"hidden" name="rating" value="1">
                                    	    <input type"hidden" name="user_id" value="<?=($_SESSION['user'][0]->id)?>">
                                    	    <input type"hidden" name="order_id" value="<?=($review->data->order_id)?>">
                                    	    <input type"hidden" name="product_id" value="<?=($_REQUEST['id'])?>">
                                    	</div>
                                    </p>
            		            </div>
            		            <div class="form-group">
            		               <input type="submit" class="btn btn-md btn-success" value="Leave Review"/>
            		            </div>
            		        </form>
            		    </div>
		            <?php
		        }
		    ?>
        </div>
		<div class="row">
			<div class="col-sm-12">
				<hr/>
				<div class="review-block">
				</div>
			</div>
		</div>
		
    </div>
    
    
    
    <!--review end-->
    <section class="ftco-section">
    	<div class="container">
				<div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
          	<span class="subheading">Products</span>
            <h2 class="mb-4">Related Products</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
          </div>
        </div>   		
    	</div>
    	<div class="container">
    		<div class="row">
    			<div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="product">
    					<a href="<?php echo $image_path.$value->image;?>" class="img-popup"><img class="img-fluid" src="<?php echo $image_path.$value->image;?>" alt="Colorlib Template">
    						<span class="status">30%</span>
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 px-3 text-center">
    						<h3><a href="#">Bell Pepper</a></h3>
    						<div class="d-flex">
    							<div class="pricing">
		    						<p class="price"><span class="mr-2 price-dc">$120.00</span><span class="price-sale">$80.00</span></p>
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
    			<div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="product">
    					<a href="#" class="img-prod"><img class="img-fluid" src="images/product-2.jpg" alt="Colorlib Template">
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 px-3 text-center">
    						<h3><a href="#">Strawberry</a></h3>
    						<div class="d-flex">
    							<div class="pricing">
		    						<p class="price"><span>$120.00</span></p>
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
    			<div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="product">
    					<a href="#" class="img-prod"><img class="img-fluid" src="images/product-3.jpg" alt="Colorlib Template">
	    					<div class="overlay"></div>
	    				</a>
    					<div class="text py-3 pb-4 px-3 text-center">
    						<h3><a href="#">Green Beans</a></h3>
    						<div class="d-flex">
    							<div class="pricing">
		    						<p class="price"><span>$120.00</span></p>
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
    			<div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="product">
    					<a href="#" class="img-prod"><img class="img-fluid" src="images/product-4.jpg" alt="Colorlib Template">
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 px-3 text-center">
    						<h3><a href="#">Purple Cabbage</a></h3>
    						<div class="d-flex">
    							<div class="pricing">
		    						<p class="price"><span>$120.00</span></p>
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

<?php include "script.php"; ?>
<script src="admin/assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="admin/assets/plugins/jquery-validation/additional-methods.min.js"></script>
  
  <script>
		$(document).ready(function(){
		    $.ajax({
		        url: "./process/review.php?action=read",
		        methid:"post",
		        data:{
		            product_id: '<?=($_REQUEST['id'])?>'
		        },
		        success: function(result){
		            console.log(result);
		            $(".review-block").html(result);
		        }
		    })
		    $("div.rating1.rating2 a").click(function(){
		        $(this).siblings("a").removeClass('active');
		        $(this).addClass('active');
		        $("input[name='rating']").val($(this).data('val'));
		        console.log($("input[name='rating']").val());
		        console.log($(this).data('val'))
		    })
            $.validator.setDefaults({
                //alert( "Form successful submitted!" );
              submitHandler: function () {
                // console.log("submitted");
                $("#review_form").submit();
                return;
                var data = new FormData();
                data.append("user_id", $("input[name='user_id']").val());
                data.append("city", $("input[name='city']").val());
                data.append("state", $("input[name='state']").val());
                data.append("zip", $("input[name='zip']").val());
                data.append("address", $("input[name='address']").val());
                $.ajax({
                  url: "process/order_process.php",
                  type: "json",
                  method: "post",
                  data: data,
                  success: function(result){
                    result = JSON.parse(result);
                    console.log(result);
                    if(result.status){
                        // console.log($("button#submit"));
                      $("button#submit").click();
                      // Toast.fire({
                      //   type: 'success',
                      //   title: 'Location has been successfully created'
                      // })
                      // $("input[name='city']").val("");
                      // $("textarea[name='state']").val("");
                      // $("input[name='image']").val("");
                    }
                    else{
                      // Toast.fire({
                      //   type: 'error',
                      //   title: result.data
                      // })
                    }
                  },
                  error:function(error){
                    console.log(error);
                  },
                  cache: false,
                  contentType: false,
                  processData: false
                })
              }
            });
            $('#review_form').validate({
              rules: {
                review: {
                  required: true,
                  maxlength: 255
                }
              },
              messages: {
                review: {
                  required: "Review is required",
                  maxlength: "Review must contain 255 or less characters"
                }
              },
              errorElement: 'span',
              errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
              },
              highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
              },
              unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
              }
            });

		    var quantitiy=0;
		   $('.quantity-right-plus').click(function(e){
		        
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		            
		            $('#quantity').val(quantity + 1);

		          
		            // Increment
		        
		    });

		     $('.quantity-left-minus').click(function(e){
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		      
		            // Increment
		            if(quantity>0){
		            $('#quantity').val(quantity - 1);
		            }
		    });
		    
		});
	</script>
    
  </body>
</html>
<?php 
    ob_flush();