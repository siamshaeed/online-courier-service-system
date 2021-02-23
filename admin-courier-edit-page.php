<?php
include_once('admin-header.php');
include_once('classes/admin.php');
$AdminClass = new AdminClass(); 
if(isset($_GET['edit'])){
  $edited_id = $_GET['edit'];

 $edit_id = $AdminClass->DataQuaery($edited_id); 
 $edit = $edit_id->fetch_assoc();
}
?>

  <section class="main-content">
    <div class="container">
      <div class="row">
        <div class="col-xs-9 col-xs-offset-3">
          <content class="right-content">
            <h1>Courier Registration Form</h1>
          </content>
<?php
if(isset($_POST['c_reg'])){
  $updation = $_GET['updation'];
  $AdminClass->UpdateCourierInfo($_POST, $updation);

}
?>          
          <div class="row registrationForm">
            <form action="admin-courier-edit-page.php?updation=<?php echo $edited_id?>" method="POST">

              <div class="form-group col-sm-6">
                <label class="text-left" style="display: block;">Email</label>
                <div class="col-10">
                  <input class="form-control" type="email" name="courier_admin_email" placeholder="Enter Courier Email" id="example-email-input" value="<?php echo $edit['courier_admin_email']?>" required>
                </div>
              </div>

              <div class="form-group col-sm-6">
                <label class="text-left" style="display: block;">Password</label>
                <div class="col-10">
                  <input class="form-control" type="password" name="confirm_pass" placeholder="Enter Confirm Password" id="example-password-input" required>
                </div>
              </div>

              <div class="form-group col-sm-6">
                <label class="text-left" style="display: block;">Company Name</label>
                <div class="col-10">
                  <input class="form-control" type="text" name="company_name" id="example-text-input" placeholder="Enter Courier Name" required value="<?php echo $edit['company_name'];?>">
                </div>
              </div>           

              <div class="form-group col-sm-6">
                <label class="text-left" style="display: block;">Author</label>
                <div class="col-10">
                  <input class="form-control" type="text" name="author_name" id="example-text-input" placeholder="Enter Autor Name" required value="<?php echo $edit['author_name'] ?>">
                </div>
              </div>               

              <div class="form-group col-sm-6">
                <label class="text-left" style="display: block;">Contact Number</label>
                <div class="col-10">
                  <input class="form-control" type="text" name="mobile" placeholder="Enter Author Name" id="example-text-input" required value="<?php echo $edit['mobile']?>">
                </div>
              </div> 
              <div class="form-group col-sm-12">
                <label class="text-left" style="display: block;">Adddress</label>
                
                <textarea class="form-control" placeholder="Enter Address" name="address" rows="3" required><?php echo $edit['address'];?></textarea>
              </div>             
               <div class="form-group col-sm-12">
                 <button type="submit" name="c_reg" class="btn btn-primary">Submit</button>
               </div>
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