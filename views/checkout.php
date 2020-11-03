<?php
  ob_start();
  session_start();
//   echo "<pre>";
  $value = $_SESSION['user'][0];
  // print_r($value);
//   echo "</pre>";
  // foreach ($_SESSION['user'] as $key => $value) {
  // //  print_r($value);
  // }
            
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once "head.php"; ?>
  </head>
  <body class="goto-here">
	<?php include 'header.php';?>
  <?php
    $sub_total = 0;
    foreach($cart_items as $key => $val){
      $sub_total += $val->price*$val->qty;
    }
  ?>
    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Checkout</span></p>
            <h1 class="mb-0 bread">Checkout</h1>
          </div>
        </div>
      </div>
    </div>
    
    <section class="ftco-section">
      <div class="container">
        <form id="location_form" role="form">
          <div class="row justify-content-center">
            <div class="col-xl-7 ftco-animate">
              <input type="hidden" name="user_id" value="<?php echo $value->id; ?>">
              <h3 class="mb-4 billing-heading">Billing Details</h3>
              <div class="row align-items-end">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="firstname">Firt Name</label>
                    <input type="text" class="form-control" value="<?php echo $value->first_name; ?>" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" class="form-control" value="<?php echo $value->last_name; ?>" readonly>
                  </div>
                </div>
                <div class="w-100"></div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="state">State</label>
                    <input type="text" class="form-control" name="state" placeholder="State">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="streetaddress">Street Address</label>
                    <input type="text" class="form-control" name="address" placeholder="House number and street name">
                  </div>
                </div>
                <div class="w-100"></div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="towncity">Town / City</label>
                    <input type="text" class="form-control" name="city" placeholder="Town / City">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="postcodezip">Postcode / ZIP *</label>
                    <input type="text" class="form-control" name="zip" placeholder="Postcode / ZIP">
                  </div>
                </div>
                <div class="w-100"></div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" value="<?php echo $value->phone; ?>" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="emailaddress">Email Address</label>
                    <input type="text" class="form-control" value="<?php echo $value->email; ?>" readonly>
                  </div>
                </div>
                <div class="w-100"></div>
              </div>
              <!-- END -->
            </div>
            <div class="col-xl-5">
              <div class="row mt-5 pt-3">
                <div class="col-md-12 d-flex mb-5">
                  <div class="cart-detail cart-total p-3 p-md-4">
                    <h3 class="billing-heading mb-4">Cart Total</h3>
                    <p class="d-flex">
                      <span>Subtotal</span>
                      $
                      <span id="quantity-input"><?=($sub_total)?></span>
                    </p>
                    <p class="d-flex">
                      <span>Delivery</span>
                      <span>$
                          <?php
                              echo $delivery = 10.00;
                          ?>
                      </span>
                    </p>
                    <p class="d-flex">
                      <span>Discount</span>
                      <span>$
                          <?php
                              echo $discount = $_SESSION['coupon']['discount_value']??0.00;
                          ?>
                      </span>
                    </p>
                    <hr>
                    <p class="d-flex total-price">
                      <span>Total</span>
                      $
                      <span id="grandTotal">
                          <?php
                              echo ($sub_total+$delivery)-$discount;
                          ?>
                        </span>
                    </p>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="cart-detail p-3 p-md-4">
                    <p><button type="submit" class="btn btn-primary py-3 px-4">Place an order</button></p>
                  </div>
                </div>
              </div>
            </div> <!-- .col-md-8 -->
          </div>
        </form>
        
            			
        <div class="sr-root" style="display:none">
          <div class="sr-main">
            <header class="sr-header">
            <div class="sr-header__logo"></div>
            </header>
            <section class="container">
            <div>
              <h1 data-i18n="headline"></h1>
              <h4 data-i18n="subline"></h4>
              <div class="pasha-image">
              <img src="https://picsum.photos/280/320?random=4" width="140" height="160"/>
              </div>
            </div>
            <div class="quantity-setter">
              <button class="increment-btn" id="subtract" disabled>
              -
              </button>
              <button class="increment-btn" id="add">+</button>
            </div>
            <p class="sr-legal-text" data-i18n="sr-legal-text"></p>
  
            <button id="submit" data-i18n="button.submit" i18n-options='{ "total": "0" }'></button>
            </section>
            <div id="error-message"></div>
          </div>
        </div>
      </div>
    </section> <!-- .section -->

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

  <!-- Load Stripe.js on your website. -->
  <script src="https://js.stripe.com/v3/"></script>
  <!-- <script src="../stripe/public/script.js" defer></script> -->
  <!-- Load translation files and libraries. -->
  <script src="https://unpkg.com/i18next/i18next.js"></script>
  <script src="https://unpkg.com/i18next-xhr-backend/i18nextXHRBackend.js"></script>
  <script src="https://unpkg.com/i18next-browser-languagedetector/i18nextBrowserLanguageDetector.js"></script>
  <script src="./stripe/public/translation.js" defer></script>
  
  <script>
		$(document).ready(function(){
        $.validator.setDefaults({
            //alert( "Form successful submitted!" );
          submitHandler: function () {
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
        $('#location_form').validate({
          rules: {
            city: {
              required: true
            },
            state: {
              required: true
            },
            address: {
              required: true
            },
            zip: {
              required: true
            }
          },
          messages: {
            city: {
              required: "city is required"
            },
            state: {
              required: "state is required"
            },
            address: {
              required: "address is required"
            },
            zip: {
              required: "zip is required"
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
        
			// Create a Checkout Session with the selected quantity
			var createCheckoutSession = function(stripe) {
    			var inputEl = document.getElementById("grandTotal");
    			var price = parseInt(inputEl.innerText);
                console.log(inputEl);
                console.log(price);
                // return
				return fetch("./stripe/public/create-checkout-session.php", {
					method: "POST",
					headers: {
						"Content-Type": "application/json"
					},
					body: JSON.stringify({
						price: price
					})
				}).then(function(result) {
					return result.json();
				});
			};
						
			// Handle any errors returned from Checkout
			var handleResult = function(result) {
				if (result.error) {
					var displayError = document.getElementById("error-message");
					displayError.textContent = result.error.message;
				}
			};

						
			/* Get your Stripe publishable key to initialize Stripe.js */
			fetch("./stripe/public/config.php")
			.then(function(result) {
				return result.json();
			})
			.then(function(json) {
				// console.log(json);
				window.config = json;
				stripe = Stripe(config.publicKey);
				// updateQuantity();
				// Setup event handler to create a Checkout Session on submit
				// document.querySelector("#submit").addEventListener("click", function(evt) {
				$("button#submit").click(function(){
					// console.log("asda");
					createCheckoutSession().then(function(data) {
						stripe
						.redirectToCheckout({
							sessionId: data.sessionId
						})
						.then(handleResult);
					});
				});
			});
		});
	</script>
    
  </body>
</html>
<?php
ob_flush();
?>