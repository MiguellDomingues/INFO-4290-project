<?php
    // ob_start();
    session_start();
    // echo"<pre>";
    // print_r($_REQUEST);
    // die();
    if(isset($_GET['action'])){
        if($_GET['action'] == "create"){
            // echo 1;
            $product_id = $_POST['product_id'];
            $order_id = $_POST['order_id'];
            $user_id = $_POST['user_id'];
            $rating = $_POST['rating'];
            $review = $_POST['review'];
            // echo"<pre>";
            // print_r($_POST);
            // die();
            // print_r($_SESSION['cart_items']); die();
            $curl = curl_init();
            // echo "www.hnh3.xyz/grossary/api/review.php?action=create&product_id={$product_id}&order_id={$order_id}&user_id={$user_id}&review={$review}&rating={$rating}";
            curl_setopt_array($curl, array(
              CURLOPT_URL => "www.hnh3.xyz/grossary/api/review.php?action=create&product_id={$product_id}&order_id={$order_id}&user_id={$user_id}&review={$review}&rating={$rating}",
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
            // echo "<pre>";
            // print_r($response);die();
            // print_r($_SESSION['cart_id']);
            if($response->status){
            //   $cart_items = $response->data;
            }
            header("location: {$_SERVER['HTTP_REFERER']}");die();
        }
        else if($_GET['action'] == "read"){
            if(isset($_REQUEST['product_id']) && !empty($_REQUEST['product_id'])){
                $product_id = $_POST['product_id'];
                $curl = curl_init();
                // echo "www.hnh3.xyz/grossary/api/review.php?action=create&product_id={$product_id}&order_id={$order_id}&user_id={$user_id}&review={$review}&rating={$rating}";
                curl_setopt_array($curl, array(
                  CURLOPT_URL => "www.hnh3.xyz/grossary/api/review.php?action=read&product_id={$product_id}",
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
                // echo "<pre>";
                // print_r($response);die();
                // print_r($_SESSION['cart_id']);
                if($response->status){
                    foreach($response->data as $review){
                        ?>
                            <div class="row">
        						<div class="col-sm-2">
        							<img class="review-avatar" src="<?=("https://www.hnh3.xyz/grossary/uploads/".$review->user_image)?>" class="img-rounded">
        							<div class="review-block-name"><a href="#"><?=($review->user_name)?></a></div>
        							<div class="review-block-date"><?=(date("M d, Y", strtotime($review->date_time)))?></div>
        						</div>
        						<div class="col-sm-10">
        							<div class="review-block-rate">
        								<p class="text-left mr-4">
        								<a href="#" class="mr-2"><?=($review->rating)?>.0</a>
        								<a href="#"><span class="ion-ios-star-outline <?=($review->rating >= 1?'rating-star':'')?>"></span></a>
        								<a href="#"><span class="ion-ios-star-outline <?=($review->rating >= 2?'rating-star':'')?>"></span></a>
        								<a href="#"><span class="ion-ios-star-outline <?=($review->rating >= 3?'rating-star':'')?>"></span></a>
        								<a href="#"><span class="ion-ios-star-outline <?=($review->rating >= 4?'rating-star':'')?>"></span></a>
        								<a href="#"><span class="ion-ios-star-outline <?=($review->rating == 5?'rating-star':'')?>"></span></a>
        							</p>
        							</div>
        							<div class="review-block-title"><?=($review->review)?></div>
        							<!--<div class="review-block-description">this was nice in buy. this was nice in buy. this was nice in buy. this was nice in buy this was nice in buy this was nice in buy this was nice in buy this was nice in buy</div>-->
        						</div>
        					</div>
        					<hr/>
                        <?php
                    }
                //   $cart_items = $response->data;
                }
            }
        }
    }
    
    // ob_flush();
?>