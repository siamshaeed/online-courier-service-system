<?php
include_once('admin-header.php');
include_once('classes/admin.php');
$AdminClass = new AdminClass(); 
$read_data = $AdminClass->ContactUsQuery();
?>
<section class="main-content">
    <div class="container">
      <div class="row">
        <div class="col-xs-10 col-xs-offset-2">
          <content class="right-content">
            <?php 
            if(isset($_GET['msg'])){
              echo "<h5 class='alert alert-success'>".$_GET['msg']."</h5>";            
            }if (isset($_GET['delete'])) {
              echo "<h5 class='alert alert-danger'>".$_GET['delete']."</h5>"; 
            }
            ?>
            <?php
            	if(isset($_SESSION['msg'])){
            		echo $_SESSION['msg'];
            	}
            ?>
            <h1>Contact Information</h1>
          </content>
          <div class="row registrationForm">
            <div class="col-sm-12">
              <table class="table table-bordered user-cancel-table">
                  <thead>
                    <tr>
                      <th class="text-center">Serial Number</th>
                      <th class="text-center">Name</th>
                      <th class="text-center">Email</th>
                      <th class="text-center">Phone</th>
                      <th class="text-center">Company</th>
                      <th class="text-center">Message</th>
                      <th class="text-center">Action</th>
                      <th class="text-center">Delete</th>
                    </tr>
                  </thead>
<?php
$i=1;
if(!empty($read_data)):
  while ($row = $read_data->fetch_assoc()):
?>                  
                  <tbody>
                    <tr>
                      <td><?php echo $i;?></td>
                      <td><?php echo $row['name'];?></td>
                      <td><?php echo $row['email'];?></td>                    
                      <td><?php echo $row['phone'];?></td>                      
                      <td><?php echo $row['company'];?></td>                      
                      <td><?php echo $row['message'];?></td>
                      <td><?php echo $row['created_at'];?></td>
                      <th class="text-center">
                        <a class="cancel-btn" style='background: #f00;' href="delete-page.php?contact_info_del=<?php echo $row['id'];?>"><i class="fa fa-eraser" aria-hidden="true"></i></a>                       
                      </th>        
                    </tr>
                  </tbody>
<?php $i++;endwhile; endif;?>                  
                </table>              
            </div>     
          </div>
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