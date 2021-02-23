<?php
include_once('hdr-not-check-session.php');
include_once('classes/user_registration_class.php');
$All_User_reg = new All_User_reg();



if(isset($_POST['send'])){
$user_register = $All_User_reg->User_reg($_POST);


}
?>

<section class="user-reg-wrp">
  <div class="container">
    <div class="user-reg-content">
      <div class="row">
        <div class="col-sm-3">
          <header class="user-reg-hdr">
            <h2>Register</h2>
          </header>
        </div>
        <div class="col-sm-9">
        <form id="stackedForm" class="ui form user-reg-frm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method='POST'>

           <div class="row">
            <div class="col-sm-12">
              <div class="field">
                  <label>Email address</label>
                  <div class="ui input icon">
                      <input name="user_email" type="email" placeholder="Email address" />
                  </div>
              </div>              
            </div>

            <div class="col-sm-4">
             <div class="field">
                  <label>First Name</label>
                  <div class="ui input icon">
                      <input name="fname" placeholder="First name" type="text">
                  </div>
              </div>              
            </div>

            <div class="col-sm-4">
             <div class="field">
                  <label>Last Name</label>
                  <div class="ui input icon">
                      <input name="lname" placeholder="Last name" type="text">
                  </div>
              </div>              
            </div>

            <div class="col-sm-4">
              <div class="field">
                  <label>Username</label>
                  <div class="ui input icon">
                      <input name="username" type="text" placeholder="Username" />
                  </div>
              </div>              
            </div>

               <div class="col-sm-12">
                <div class="title textarea field">
                  <label>Address( Village, Post, Thana, District )<span>*</span></label>
                  <div class="ui input icon">
                    <textarea name="address" placeholder="Enter Your Address"></textarea>
                  </div>
                </div>
              </div> 

            <div class="col-sm-6">
              <div class="field">
                  <label>Password</label>
                  <div class="ui input icon">
                      <input name="password" type="password" placeholder="Password" />
                  </div>
              </div>              
            </div>

            <div class="col-sm-6">
              <div class="field">
                  <label>Confirm password</label>
                  <div class="ui input icon">
                      <input name="confirmPassword" type="password" placeholder="Password" />
                  </div>
              </div>              
            </div>

              <div class="col-sm-6">
                <div class="title">
                  <div class='input-group date' id='datetimepicker2'>
                    <label>Date of Birth<span>*</span></label>
                       <div class="input-group">
                          <input class="form-control" id="date" name="date" placeholder="MM/DD/YYYY" type="text"/>                    
                        <div class="input-group-addon">
                         <i class="fa fa-calendar"></i>
                        </div>                        
                       </div>
                  </div>                  
                </div>
              </div>

              <div class="col-sm-6">
                <div class="title">
                  <label>Mobile <span>*</span></label>
                 <div class="ui input icon">
                    <input type="text" name="mobile" placeholder="Enter Mobile Number">
                 </div>
                </div>
              </div>

          <div class="col-sm-12">
            <div class="field">
                <label>Gender</label>
                <div class="ui radio">
                    <input name="gender" type="radio" value="male" /> <label>Male</label>
                </div>
                <div class="ui radio">
                    <input name="gender" type="radio" value="female" /> <label>Female</label>
                </div>
                <div class="ui radio">
                    <input name="gender" type="radio" value="other" /> <label>Other</label>
                </div>
            </div>
          <div class="col-sm-12">
            <div class="inline field">
                <div class="ui checkbox">
                    <input name="agree" type="checkbox" /> <label>Agree with the terms and conditions</label>
                </div>
            </div>            
          </div> 
          </div>          
          </div>
          <input type="submit" name="send" value="create new account">
          <a class="go-back-btn" href="index.php">Back to Home page</a>          
        </form>
        </div>
      </div>
  </div>
  </div>

</section>      
<?php
  include_once("footer.php");
?>
