<?php
include_once("classes/Login.php");
$login = new Login();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>BD Courier</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

<!--formden.js communicates with FormDen server to validate fields and submit via AJAX -->
<script type="text/javascript" src="https://formden.com/static/cdn/formden.js"></script>

<!-- Special version of Bootstrap that is isolated to content wrapped in .bootstrap-iso -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

<!--Font Awesome (added because you use icons in your prepend/append)-->
<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

        <link rel="stylesheet" type="text/css" href="fonts/font-awesom/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/_bootstrap-datetimepicker.css"> 
        <link rel="stylesheet" type="text/css" href="fonts/customfonts.css">
        <link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
        <link rel="stylesheet" type="text/css" href="css/owl.theme.default.min.css">
        <link rel="stylesheet" type="text/css" href="css/slicknav.css">

        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="css/responsive.css">
    </head>
<body>

	
	<div class="container" style="margin-top: 3%;">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
<?php
if(isset($_GET['msg'])){
    $get_msg = $_GET['msg'];
    echo "<h4>".$get_msg."</h4>";
}
?>                
                <div class="well login">
                <h3 class="text-danger" style="text-align: center;">
<?php
    if(isset($_POST['Login'])){
        $msg = $login->user_login($_POST);

    }
?>                    

                </h3>               
                    <form class="form-hirizantal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <input type="hidden" name="user" value="user">
                        <h2 class="text-center text-info login-title">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            User login
                        </h2>
                    <div class="form-group">
                        <label>Usrname</label>
                        <div>
                            <input type="text" name="user_name" placeholder="Enter user name" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <a href="#" class="pull-right">Forgot Password <span class="text-danger">?</span> </a>
                        <div>
                            <input type="password" name="confirm_pass" class="form-control" placeholder="password">
                        </div>
                    </div>


                    <div class="form-group form-group-sm">
                        <div>
                            <input type="submit" name="Login" value="LOGIN" required class="form-control btn btn-warning">
                        </div>
                    </div>
                      
                    </form>
                    <hr>

                    <div class="login-notes clearfix">
	            		<a target="blank" href="user-registration-page.php" class="pull-right btn btn-success" role="button"> Create an Account</a>
                    </div>
                    <br/>
                </div>
            </div>
        </div>
    </div>

<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script> 
<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<!-- <script src="js/plugins.js"></script> -->
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.slicknav.min.js"></script>
<script type="text/javascript" src="js/jquery.fitvids.js" ></script>
<script src="js/main.js"></script>
</body>
</html>      