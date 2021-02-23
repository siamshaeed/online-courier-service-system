<?php
include_once('lib/Session.php');
Session::init();
if (isset($_GET['action']) && $_GET['action'] == "logout"){
Session::destroy();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home page</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <link rel="stylesheet" href="http://cdn.jsdelivr.net/semantic-ui/1.2.0/semantic.min.css"/>
  <link rel="stylesheet" type="text/css" href="css/_bootstrap-datetimepicker.css"> 
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="css/formValidation.css">
  <link rel="stylesheet" type="text/css" href="css/animate.css">
  <link rel="stylesheet" type="text/css" href="owl.carousel/owl.carousel.css">
  <link rel="stylesheet" type="text/css" href="owl.carousel/owl.theme.default.min.css">
  <link rel="stylesheet" type="text/css" href="nivo.slider/nivo.slider.css">
  <link rel="stylesheet" type="text/css" href="nivo.slider/themes/default/default.css">

  <link rel="stylesheet" type="text/css" href="fonts/custom-fonts.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">

  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->  

</head>
<body>
	
<!-- ====================== Top nav bar ==========================  -->
<nav class="navbar navbar-default header-nav">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainNavBody" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><img src="images/logo.png" class="img-responsive "> </a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="mainNavBody">
            <ul class="nav navbar-nav right-nav">
              	<li><a href="index.php">Home</a></li>            	                  	
              	<li><a href="user-registration-page.php">User Registration</a></li>
              <li><a href="contact-us.php"><i class="fa fa-phone" aria-hidden="true"></i>Contact us</a></li>
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Setting <span class="caret"></span> </a>
              	<ul class="dropdown-menu custom-dropdown">
<?php 
$login_status=Session::get('login_status');  
if($login_status != false){?>                                         
                  <li><a href="profile.php">profile</a></li>
                  <li><a href="?action=logout">Logout</a></li>                  
<?php } else{?> 
                  <li><a href="user-login.php">User login</a></li>
                  <li><a href="cuirer-login.php">Cuirer Login</a></li>
                  <li><a href="admin-login.php">Admin-login</a></li> 
<?php }?>                                  
              	</ul>
              </li>
         	 </ul>
      	</div><!-- /.navbar-collapse -->
  	</div><!-- /.container-fluid -->
</nav>