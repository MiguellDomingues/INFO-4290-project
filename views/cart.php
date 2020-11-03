<?php
	ob_start();
	session_start();
// 	echo "<pre>";
// 	print_r($_SESSION);
// 	echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include "head.php"; ?>
  </head>
  <body class="goto-here">
	<?php include 'header.php';?>

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Cart</span></p>
            <h1 class="mb-0 bread">My Cart</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-cart">
			<div class="container">
				<div class="row">
    			<div class="col-md-12 ftco-animate">
    				<div class="cart-list">
	    				<table class="table">
						    <thead class="thead-primary">
						      <tr class="text-center">
						        <th>&nbsp;</th>
						        <th>&nbsp;</th>
						        <th>Product name</th>
						        <th>Price</th>
						        <th>Quantity</th>
						        <th>Total</th>
						      </tr>
						    </thead>
						    <?php
								//  echo"<pre>";
								//  print_r($_SESSION); 
						    ?>
						    <tbody>
						        <?php
									if(isset($_SESSION['cart_id'])){
										// print_r($cart_items); die();
										foreach ($cart_items as $key => $row) {
											// print_r($row);
										   ?>
											<tr class="text-center">
												<td class="product-remove" id="<?=($row->id)?>"><a href="process/cart_delete.php?id=<?php echo $row->id; ?>"><span class="ion-ios-close"></span></a></td>
												<!--<div class="img" style="background-image:url(images/product-4.jpg);">-->
												<td class="image-prod"><div class="img" style="background-image:url(<?=($image_path.$row->image)?>);"></div></td>
												
												<td class="product-name">
													<h3><?php echo $row->name ?></h3>
												</td>
												
												<td class="price"><?php echo $row->price ?></td>
												
												<td class="quantity">
													<div class="input-group mb-3">
														<input type="text" name="quantity" class="quantity form-control input-number" value="<?php echo $row->qty ?>" min="1" max="100">
													</div>
												</td>
												
												<td class="total"><?=($row->price*$row->qty)?></td>
											</tr>
										   <?php
										}
									}
									else{
										foreach ($_SESSION['cart_items'] as $key => $row) {
											// print_r($row); 
										   ?>
											<tr class="text-center">
												<td class="product-remove" id="<?=($row["id"])?>"><a href="process/cart_delete.php?id=<?php echo $row["id"]; ?>"><span class="ion-ios-close"></span></a></td>
												<!--<div class="img" style="background-image:url(images/product-4.jpg);">-->
												<td class="image-prod"><div class="img" style="background-image:url(<?=($image_path.$row["image"])?>);"></div></td>
												
												<td class="product-name">
													<h3><?php echo $row["name"] ?></h3>
												</td>
												
												<td class="price"><?php echo $row["price"] ?></td>
												
												<td class="quantity">
													<div class="input-group mb-3">
														<input type="text" name="quantity" class="quantity form-control input-number" value="<?php echo $row["qty"] ?>" min="1" max="100">
													</div>
												</td>
												
												<td class="total"><?=($row["price"]*$row["qty"])?></td>
											</tr>
										   <?php
										}
									}
								?>
						      <!-- END TR-->
						    </tbody>
						  </table>
					  </div>
    			</div>
    		</div>
    		<div class="row justify-content-end">
    			<div class="col-lg-6 mt-5 cart-wrap ftco-animate">
					<form id="coupon_form" role="form" class="info">
						<div class="cart-total mb-3">
							<h3>Coupon Code</h3>
							<p>Enter your coupon code if you have one</p>
							<div class="form-group">
								<label for="">Coupon code</label>
								<input type="text" class="form-control text-left px-3" name="coupon" placeholder="Enter Coupon code">
							</div>
						</div>
						<p><button class="btn btn-primary py-3 px-4 coupon-btn" type="submit" id="coupon_btn">Apply Coupon</button></p>
						<!-- <p><a href="#" onclick="event.preventDefault();click_submit()" class="btn btn-primary py-3 px-4 coupon-btn">Apply Coupon</a></p> -->
					</form>
    			</div>
    			<div class="col-lg-4 mt-5 cart-wrap ftco-animate" style="display:none">
    				<div class="cart-total mb-3">
    					<h3>Estimate shipping and tax</h3>
    					<p>Enter your destination to get a shipping estimate</p>
  						<form action="#" class="info">
							<div class="form-group">
								<label for="">Country</label>
								<input type="text" class="form-control text-left px-3" placeholder="">
							</div>
							<div class="form-group">
								<label for="country">State/Province</label>
								<input type="text" class="form-control text-left px-3" placeholder="">
							</div>
							<div class="form-group">
								<label for="country">Zip/Postal Code</label>
								<input type="text" class="form-control text-left px-3" placeholder="">
							</div>
	            		</form>
    				</div>
    				<p><a href="checkout.php" class="btn btn-primary py-3 px-4">Estimate</a></p>
    			</div>
    			<div class="col-lg-6 mt-5 cart-wrap ftco-animate">
    				<div class="cart-total mb-3">
    					<h3>Cart Totals</h3>
    					<p class="d-flex">
    						<span>Subtotal</span>
    						$<span id="sub_total">20.60</span>
    					</p>
    					<p class="d-flex">
    						<span>Delivery</span>
    						$<span id="delivery">10.00</span>
    					</p>
    					<p class="d-flex">
    						<span>Discount</span>
    						$<span id="discount"><?=($_SESSION['coupon']['discount_value']??0.00)?></span>
    					</p>
    					<hr>
    					<p class="d-flex total-price">
    						<span>Total</span>
    						$<span id="net-total">17.60</span>
    					</p>
    				</div>
					<?php
						if(!isset($_SESSION['user'])){
							if(count($cart_items) > 0){
								?>
    								<p><a href="#" class="btn btn-primary py-3 px-4" data-toggle="modal" data-target="#login">Proceed to Checkout</a></p>
								<?php
							}
							else{
								?>
									<p><a href="#" disabled class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
								<?php
							}
						}
						elseif(isset($_SESSION['cart_items']) && COUNT($_SESSION['cart_items']) <= 0){
							?>
    							<p><a href="#" disabled class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
							<?php
						}
						else{
							?>
    							<p><a href="checkout.php"  class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
							<?php
						}
					?>
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


  <?php require_once "script.php"; ?>
  <script src="admin/assets/plugins/jquery-validation/jquery.validate.min.js"></script>
  <script src="admin/assets/plugins/jquery-validation/additional-methods.min.js"></script>

  	<script>
	  	function click_submit(){
			console.log("clicked");
			$("#coupon_btn").click();
		}
		$(document).ready(function(){
			$.validator.setDefaults({
				//alert( "Form successful submitted!" );
				submitHandler: function () {
					var data = new FormData();
					data.append("code", $("input[name='coupon']").val());
					data.append("amount", $("#net-total").text());
					$.ajax({
    					url: "../grossary/api/coupon.php?action=add_coupon",
    					type: "json",
    					method: "post",
    					data: data,
    					success: function(result){
    						result = JSON.parse(result);
    						// console.log(result);
    						if(result.status){
    						    let coupon = result.data;
    						    $.ajax({
    						        url: "process/set_session.php?action=set_session",
    						        data:{
    						            key: 'coupon',
    						            value: coupon
    						        },
    						        success: function(result){
    						            console.log(result);
    						            console.log(coupon);
    						            $("#discount").text(coupon['discount_value']);
    						            getTotal();
    						        }
    						    })
    						}
    						else{
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
			$('#coupon_form').validate({
				rules: {
					coupon: {
						required: true,
						maxlength: 10
					}
				},
				messages: {
					coupon: {
						required: "coupon code is required",
						maxlength: "code must contain 10 or less characters"
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
		    getTotal()
            $("input[name='quantity']").keyup(function(){
                var qty = $(this).parents(".quantity");
				$.ajax({
					url: "process/cart_update.php",
					method: "post",
					type: "json",
					data: {
						product_id: qty.siblings(".product-remove").attr("id"),
						qty: $(this).val() 
					},
					success: function(result){
						console.log(result);
						JSON.parse(result);
						if(!result.status){
							// window.location.reload();
						}
					},
					error: function(err){
						console.log(err);
					}
				})
                // console.log(qty.siblings("td.price"));
                // console.log(qty.siblings("td.total"));
                qty.siblings(".total").text(qty.siblings(".price").text()*$(this).val())
                getTotal();
            })
			var quantitiy=0;
			function getTotal(){
				//  console.log("");
				let subtotal = 0;
				$("td.total").each(function(i, val){
					//  console.log(i);
					//  console.log(val);
					subtotal += parseInt($(val).text());
				})
				$("#sub_total").text(subtotal);
				$("#net-total").text( subtotal + parseInt($("#delivery").text()) - parseInt($("#discount").text()) );
			}
			/*
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
		  	*/  
		});
	</script>
    
  </body>
</html>
<?php
ob_flush();
?>