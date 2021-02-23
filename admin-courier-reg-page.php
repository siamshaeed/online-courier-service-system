<?php
include_once('admin-header.php');
include_once('classes/admin.php');
$AdminClass = new AdminClass();
?>


  <section class="main-content">
    <div class="container">
      <div class="row">
        <div class="col-xs-9 col-xs-offset-3">
<?php
if(isset($_POST['c_reg'])){
  $AdminClass->Courier_reg($_POST);

}
?>
          <content class="right-content">
            <h1>Courier Registration Form</h1>
          </content>
          <div class="row registrationForm">
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">

              <div class="form-group col-sm-6">
                <label class="text-left" style="display: block;">Courier Id</label>
                <div class="col-10">
                  <input class="form-control" type="text" name="courier_id" id="example-text-input" placeholder="Enter Courier Id" required>
                </div>
              </div>

              <div class="form-group col-sm-6">
                <label class="text-left" style="display: block;">Email</label>
                <div class="col-10">
                  <input class="form-control" type="email" name="courier_admin_email" placeholder="Enter Courier Email" id="example-email-input" required>
                </div>
              </div>

              <div class="form-group col-sm-6">
                <label class="text-left" style="display: block;">Password</label>
                <div class="col-10">
                  <input class="form-control" type="password" name="confirm_pass" placeholder="Password" id="example-password-input" required>
                </div>
              </div>

              <div class="form-group col-sm-6">
                <label class="text-left" style="display: block;">Company Name</label>
                <div class="col-10">
                  <input class="form-control" type="text" name="company_name" id="example-text-input" placeholder="Enter Courier Name" required>
                </div>
              </div>           

              <div class="form-group col-sm-6">
                <label class="text-left" style="display: block;">Author</label>
                <div class="col-10">
                  <input class="form-control" type="text" name="author_name" id="example-text-input" placeholder="Enter Autor Name" required>
                </div>
              </div>               

              <div class="form-group col-sm-6">
                <label class="text-left" style="display: block;">Contact Number</label>
                <div class="col-10">
                  <input class="form-control" type="text" name="mobile" placeholder="Enter Author Name" id="example-text-input" required>
                </div>
              </div> 

              <div class="form-group col-sm-12">
                <label class="text-left" style="display: block;">Adddress</label>
                <textarea class="form-control" id="exampleTextarea" placeholder="Enter Address" name="address" rows="3" required ></textarea>
              </div>             
               <button type="submit" name="c_reg" class="btn btn-primary">Submit</button>
            </form>      
          </div>
        </div>
      </div>

    </div>
  </section><!-- end of .main-content -->
  <footer></footer><!-- end of footer -->

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