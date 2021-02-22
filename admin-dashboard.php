<?php
include_once('admin-header.php');
?>
  <section class="main-content">
   
    <div class="container">
      <div class="row">
         <div class="col-xs-10 col-xs-offset-2">
          <?php
          if(isset($loginmsg)){
          echo $loginmsg;
          }
          Session::set('loginmsg', Null);
          
          ?> 
            <content class="right-content">
              <h1>Welcome To Dashboard</h1>
            </content> 

         </div> 
      </div>
    </div>

  </section><!-- end of .main-content -->

<script src="https://code.jquery.com/jquery-3.0.0.js"></script>
<script src="https://code.jquery.com/jquery-migrate-3.0.0.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/ie10-viewport-bug-workaround.js"></script>
<script src="owl.carousel/owl.carousel.min.js"></script>
<script src="nivo.slider/nivo.slider.js"></script>
<script src="js/wow.min.js"></script>

<script src="js/main.js"></script>
</body>
</html>