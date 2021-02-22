<?php
include_once('lib/Session.php');
Session::check_session();

$loginmsg   =   Session::get('loginmsg');

$user_id  = Session::get('user_id');
$user_name  =   Session::get('user_name');
$fname    =   Session::get('fname');
$lname    =   Session::get('lname');
$mobile   =   Session::get('mobile');
$fname    =   Session::get('fname');


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
  
  <header class="header">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 clearfix">
          <div class="hdr-adm clearfix">
            <div class="hdr-adm-lft">
                <div class="click-div">
                  <i class="fa fa-certificate" aria-hidden="true"></i>
                  <span>Administrator</span>
                </div>
                <ul class="hide-div">
                  <li>
                    <i class="fa fa-certificate" aria-hidden="true"></i>
                    <span>Administrator</span>
                  </li>
                  <li class="clearfix">
                    <div class="change-userName">
                      <a href="#">change username</a>
                    </div>
                    <div class="change-pass text-right">
                      <a href="#">change password</a>
                    </div>
                  </li>
                </ul>
            </div>
            <div class="hdr-adm-rgt">
              <a href="?action=logout"><i class="fa fa-sign-out" aria-hidden="true"></i></a>     
            </div>
          </div>
        </div>
      </div>      
    </div>
  </header><!-- end of header -->
  <?php
    include_once('admin-dashboard-aside.php');
  ?>