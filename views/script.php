 <style>.ftco-navbar-light.scrolled .mt-3{margin-top:0.4rem !important;margin-left:10px;}.dropdown-submenu {
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
}</style>
  <script src="<?=($path)?>js/jquery.min.js"></script>
  <script src="<?=($path)?>js/jquery-migrate-3.0.1.min.js"></script>
  <script src="<?=($path)?>js/popper.min.js"></script>
  <script src="<?=($path)?>js/bootstrap.min.js"></script>
  <script src="<?=($path)?>js/jquery.easing.1.3.js"></script>
  <script src="<?=($path)?>js/jquery.waypoints.min.js"></script>
  <script src="<?=($path)?>js/jquery.stellar.min.js"></script>
  <script src="<?=($path)?>js/owl.carousel.min.js"></script>
  <script src="<?=($path)?>js/jquery.magnific-popup.min.js"></script>
  <script src="<?=($path)?>js/aos.js"></script>
  <script src="<?=($path)?>js/jquery.animateNumber.min.js"></script>
  <script src="<?=($path)?>js/bootstrap-datepicker.js"></script>
  <script src="<?=($path)?>js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="<?=($path)?>js/google-map.js"></script>
  <script src="<?=($path)?>js/main.js"></script>
    
    <script>
        $("li.has-submenu").hover(function(){
            // console.log("");
            // $(this).find(".dropdown-menu").show();
            $(this).find(".dropdown-menu").css("display", "block");
        }, function(){
            $(this).find(".dropdown-menu").css("display", "none");
            // $(this).find(".dropdown-menu").hide();
        });
    </script>