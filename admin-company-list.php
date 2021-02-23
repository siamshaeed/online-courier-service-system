
<?php
include_once('admin-header.php');
include_once('classes/admin.php');
$AdminClass = new AdminClass(); 
$read_data = $AdminClass->ListInfoQuery();
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
            <h1>List of Courier Services</h1>
          </content>
          <div class="row registrationForm">
            <div class="col-sm-12">
              <table class="table table-bordered user-cancel-table">
                  <thead>
                    <tr>
                      <th class="text-center">Courier Id</th>
                      <th class="text-center">Courier Email</th>
                      <th class="text-center">Company Name</th>
                      <th class="text-center">Author Name</th>
                      <th class="text-center">Address</th>
                      <th class="text-center">Mobile</th>
                      <th class="text-center">Edit</th>
                      <th class="text-center">Delete</th>
                    </tr>
                  </thead>
<?php
if(isset($read_data)):
  while ($row = $read_data->fetch_assoc()):
?>                  
                  <tbody>
                    <tr>
                      <td><?php echo $row['courier_id']?></td>
                      <td><?php echo $row['courier_admin_email'];?></td>
                      <td><?php echo $row['company_name'];?></td>                    
                      <td><?php echo $row['author_name'];?></td>                      
                      <td><?php echo $row['address'];?></td>                      
                      <td><?php echo $row['mobile'];?></td>
                      <th class="text-center">
                        <a class="cancel-btn" href="admin-courier-edit-page.php?edit=<?php echo $row['courier_id'];?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>                       
                      </th>
                      <th class="text-center">
                        <a class="cancel-btn" style='background: #f00;' href="delete-page.php?Courier_list_delete=<?php echo $row['courier_id'];?>"><i class="fa fa-eraser" aria-hidden="true"></i></a>                       
                      </th>        
                    </tr>
                  </tbody>
<?php endwhile; endif;?>                  
                </table>              
            </div>     
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