<?php
include_once('lib/Session.php');
Session::init();
Session::check_session();
?>  
    <aside class="left-content">
      <div class="top-admin-logo">
        <a href="#">Administrator</a>
      </div>
      <ul class="widget">
        <li>
          <h5>administrator</h5>
          <span><i class="fa fa-circle" aria-hidden="true"></i>online</span>
        </li>
        <li class="nav-txt">navigation</li>
        <li class="dash-txt"><a href="admin-dashboard.php">Dashboard</a></li>
        <li><a href="index.php">Home</a></li>        
        <li><a href="admin-courier-reg-page.php">Courier Registration</a></li>        
        <li><a href="admin-company-list.php">Company List</a></li>
        <li><a href="admin_contact_us_view.php">View Admin</a></li>
        <li><a href="admin-orders-view.php">Complete Orders info</a></li>
      </ul>      
    </aside>