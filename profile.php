<?php
  include_once('lib/Session.php');
  include_once('lib/Database.php');
  Session::init();
  Session::check_session();

if(Session::get('userRole') == 'user'){
 		        echo '<script type="text/javascript">';
            echo 'window.location.href="user-profile.php"';
            echo '</script>';
            exit();

}

if(Session::get('userRole') == 'courier'){
 		        echo '<script type="text/javascript">';
            echo 'window.location.href="company-profile.php"';
            echo '</script>';
            exit();

}

if(Session::get('userRole') == 'Admin'){
            echo '<script type="text/javascript">';
            echo 'window.location.href="admin-dashboard.php"';
            echo '</script>';
            exit();

}
?>