<?php
include_once('header.php');
include_once('classes/update_company_profile_class.php');
include_once('classes/user_profile_update_class.php');


$UpdateClassUser 	= new UpdateClassUser();
$UpdateClass 		= new UpdateClass;
$loginmsg 			= Session::get('loginmsg');
$company_id 	= Session::get('userID');
$company_name 		= Session::get('company_name');
$uploaded_image 	= Session::get('uploaded_image');

if(isset($_POST['upload'])){
  $up_msg=$UpdateClass->profile_logo($company_id);
}

?>

<section class="company-pfle-wrp">

			<div class="container">
				<div class="row">
					<div class="col-sm-12">
					<div class="parent-image">	
						<div class="left-profile-image">
							<h1 class="logo">
	<?php
	$read=$UpdateClass->sel_img($company_id);
	if(isset($read)):
	while ($row = $read->fetch_assoc()):
	?>							
								<a href="company-profile.php">
									<img src="<?php echo $row['image']?>" alt="missing">
								</a>
							</h1>	
	<?php endwhile; endif; ?>
						</div>
<?php
if(isset($loginmsg)){
	echo "<h4 class='text-success' style='margin-top: 0px;text-align: center;'>" .$loginmsg."</h4>";

}
	Session::set('loginmsg', Null);
?>												
						<h2 class="text-center" style="text-transform: capitalize;"><?php echo $company_name;?> Courier Service profile</h2>
					</div>
						<ul class="company-profile-nav clearfix">
							<li><a href="company_profile_insert.php">Add branch</a></li>
							<li><a href="Company_branch.php">shipping Cost</a></li>
							<li><a href="Company_request.php">Orders Request</a></li>
							<li><a href="profile.php">Profile</a></li>
						</ul>											
					</div>
					<div class="col-sm-12">	
<!-- 
						<form class="company-search-options" action="<?php //echo $_SERVER['PHP_SELF'];?>" method="POST">
							<div class="col-sm-6" style="margin-bottom: 10px;">
								<label>Order Date<sup>*</sup></label>	
								<div class="input-group date" data-provide="datepicker">
							    <input type="text" name="date" class="form-control" placeholder="Enter Date">
							    <div class="input-group-addon">
							        <i class="fa fa-calendar" aria-hidden="true"></i>
							    </div>
							</div>															
							</div>
							<div class="col-sm-6">
								<div class="search-button">
									<input type="submit" name="senddate" value="Search">
								</div>								
							</div>							
						</form> -->	

					</div>

<?php
if(isset($_SESSION['delete_msg'])){

	echo $_SESSION['delete_msg'];
}
?>

					<div class="col-sm-12">
						<h2>Details Personal Information who Send Parcels/Documents</h2>
						<table class="table table-bordered user-cancel-table">
							<tr>
								<th>Serial</th>
						        <th>Date</th>
						        <th>Name who send message</th>
						        <th>Address</th>
						        <th>Mobile</th>
						        <th>Accept</th>
						        <th>Delete</th>
						        <th>Done</th>						        
							</tr>
<?php
$i = 1;
$data_3 			= $UpdateClass->ViewCompanyRequest($company_id);
if(!empty($data_3)):
	while ($userorder = $data_3->fetch_assoc()):
?>

							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $userorder['date'];?></td>
<?php
	$user_id      = $userorder['user_id'];
	$read = $UpdateClass->QueryFromReg($user_id);

	if(!empty($read)):
		while ($row = $read->fetch_assoc()):
?>			      	
			        <td><?php echo $row['fname'].' '.$row['lname'];?></td>
			        <td><?php echo $row['address']?></td>
			        <td><?php echo $row['mobile']?></td>
<?php endwhile; endif; ?>
						        <td>
						        	<a class="<?php echo $userorder['accept_bg_class'];?>" style="color: <?php echo $userorder['color_combination'];?>" href="update.php?msg=<?php echo $userorder['id']?>"><?php echo $userorder['request'];?></a>
						        	
						        </td>
						 			<td>
						              <a href="delete-page.php?user_req_del=<?php echo $userorder['id']?>" class="btn btn-default deleteWaitlist">X</a>
						          </td>	
						          <td>
						          	<a style="padding: 5px;" class="<?php echo $userorder['done_clr']?>" href="update.php?user_req_del=<?php echo $userorder['id']?>">Done</a>
						          </td>	
							</tr>
<?php $i++;endwhile;endif; ?>	

						</table>	


<h4>Where a client want to send from</h4>
<table class="table table-bordered user-cancel-table">
	<tr>
		<th>id</th>
		<th>Date</th>
        <th>Division</th>
        <th>District</th>
        <th>Upozila</th>
        <th>Branch</th>			
	</tr>
<?php
$data_1 				= $UpdateClass->ViewCompanyRequest($company_id);
$i = 1;
if(!empty($data_1)):
	while ($userorder = $data_1->fetch_assoc()):
?>		
	<tr>
		<td><?php echo $i;?></td>
		<td><?php echo $userorder['date'];?></td>

<?php
	$fromDivId      = $userorder['fromDivId'];
	$read = $UpdateClass->QueryFromDivision($fromDivId);

	if(!empty($read)):
		while ($row = $read->fetch_assoc()):
?>			      	
			        <td><?php echo $row['division_name'];?></td>
<?php endwhile; endif;

	$fromDisId 	    = $userorder['fromDisId'];
	$read = $UpdateClass->QueryFromDistrict($fromDisId);

	if(!empty($read)):
		while ($row = $read->fetch_assoc()):
?>			      	
			        <td><?php echo $row['district_name']?></td>

<?php endwhile; endif;?>

<?php
$fromUzlaId 	= $userorder['fromUzlaId'];
$read = $UpdateClass->QueryFromUpzila($fromUzlaId);
	if(!empty($read)):
		while ($row = $read->fetch_assoc()):
?>			      	
			       <td><?php echo $row['upazila_name']?></td>

<?php endwhile; endif;?>

<?php
$fromBranchId 	= $userorder['fromBranchId'];
$read = $UpdateClassUser->ViewBranch($fromBranchId);
	if(!empty($read)):
		while ($row = $read->fetch_assoc()):
?>			      	
			       <td><?php echo $row['fromBranchName']?></td>

<?php endwhile; endif;?>			
	</tr>
<?php $i++;endwhile;endif;?>	
</table>

						<h2>Details Information who receive Parcels/Documents</h2>
						<table class="table table-bordered user-cancel-table">
						    <thead>
						      <tr>
						      	<th>Serial</th>
						        <th>Date</th>
						         <th>Recipient's Name</th>
						        <th>Email</th>
						        <th>Phone</th>
						        <th>Address</th>				        
						      </tr>
						    </thead>
						    <tbody>

<?php
$data 				= $UpdateClass->ViewCompanyRequest($company_id);
$i = 1;
if(!empty($data)):
	while ($userorder = $data->fetch_assoc()):
?>
						      <tr>
						      	<td><?php echo $i;?></td>
						        <td><?php echo $userorder['date'];?></td>
						        <td><?php echo $userorder['fname'].' '.$row['lname'];?></td>
						        <td><?php echo $userorder['email']; ?></td>
						        <td><?php echo $userorder['phone']; ?></td>
						        <td><?php echo $userorder['address']; ?></td>

						      </tr>
<?php $i++;endwhile;endif;?>						      
						    </tbody>
						  </table>						  

<!-- Where a client receive -->

<h4>Where a client want to send</h4>
<table class="table table-bordered user-cancel-table">
	
	<tr>
		<th>Serial Number</th>
		<th>date</th>
		<th>Division</th>
		<th>District</th>
		<th>Upazila</th>
		<th>Branch</th>
		<th>Service Type</th>
		<th>Parcel Type</th>
		<th>weight</th>
		<th>Cost</th>
		<th>Payment Type</th>
	</tr>
<?php
$data_3 			= $UpdateClass->ViewCompanyRequest($company_id);
$i = 1;
if(!empty($data_3)):
	while ($userorder = $data_3->fetch_assoc()):
?>

	<tr>
		<td><?php echo $i;?></td>
		<td><?php echo $userorder['date'];?></td>
<?php
//start work to 
	$toDivId		= $userorder['toDivId'];
	$read = $UpdateClass->QueryToDivision($toDivId);

	if(!empty($read)):
		while ($row = $read->fetch_assoc()):
?>			      	
			        <td><?php echo $row['division_name'];?></td>

<?php endwhile; endif;?>

<?php
$toDisId		= $userorder['toDisId'];
$read 		= $UpdateClass->QueryToDistrict($toDisId);
	if(!empty($read)):
		while ($row = $read->fetch_assoc()):
?>
		<td><?php echo $row['district_name'];?></td>
<?php endwhile;endif;?>	

<?php
$toUzlaId 		= $userorder['toUzlaId'];
$read 		= $UpdateClass->QueryToUpzila($toUzlaId);
	if(!empty($read)):
		while ($row = $read->fetch_assoc()):
?>
		<td><?php echo $row['upazila_name'];?></td>
<?php endwhile;endif;?>	

<?php
$toBranchId		= $userorder['toBranchId'];
$read 		= $UpdateClassUser->ViewToBranch($toBranchId);
	if(!empty($read)):
		while ($row = $read->fetch_assoc()):
?>
		<td><?php echo $row['toBranchName'];?></td>
<?php endwhile;endif;?>	

			        <td>
		        	<?php 
$serviceType 	= $userorder['serviceType'];		        	
		        	if($serviceType==1){
		        		echo "Normal";
		        	}else{
		        		echo "Urgent";
		        	}
			        ?>
			        </td>
			        <td>
		        	<?php 
		$parcelType 	= $userorder['parcelType'];		        	
		        	if($parcelType==1){
		        		echo "Document";
		        	}else{
		        		echo "Ponderable";
		        	}
			        ?>
			        </td>

				<td>				
<?php
	$parcelsWeight 	= $userorder['parcel_weight'];	
	$read 			= $UpdateClass->Queryweight($parcelsWeight);

	if(!empty($read)):
		while ($row = $read->fetch_assoc()):
		$weightforuserorder = $row['weight'];
?>
				<?php 
				if($parcelsWeight=='0'){
					echo '0 gm';
				}else{
					echo $weightforuserorder;
				}
				?>
<?php endwhile; endif;?>			        					
			</td>


			<td>		
			<?php
				echo $userorder['cost'].' TK';
			?>
			</td>



		<td>
<?php
$payment_type = $userorder['payment_type'];
if($payment_type == 1){
	echo 'Cash On Hand';
}elseif($payment_type == 2){
	echo "bKash";
} 
?>			
		</td>

	</tr>
<?php $i++;endwhile;endif;?>		
</table>

						
					</div>

<?php //$i++;endwhile;endif;?>					

				</div>
			</div>

</section>

		<div class="footer">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6">
						<p>&copy;All Right Reserved 2017</p>
					</div>
					<div class="col-md-6">
						<p>Deloped by <a href="#">DIU</a></p>
					</div>
				</div>				
			</div>
		</div>	  
	   </div><!-- end container -->

<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script> 
<!-- Include Date Range Picker -->
<script type="text/javascript" src="http://cdn.jsdelivr.net/semantic-ui/1.2.0/semantic.min.js"></script>
<script type="text/javascript" src="js/formValidation.js"></script>
<script type="text/javascript" src="js/semantic.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>

<!-- <script src="js/plugins.js"></script> -->
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.slicknav.min.js"></script>
<script type="text/javascript" src="js/jquery.fitvids.js" ></script>
<script src="js/main.js"></script>
<script type="text/javascript">
		function accept(){
		var id = $("#id").val();
		alert(id);
	}

$(".deleteWaitlist").click(function(){
        console.log("click on .deleteWaitlist");
        // Get the varible name, to send to your php
         var i = $(this).attr('name');
            $.post({
                url: 'delete-page.php', 
                data: { user_req_del : i}, 
                success: function(result){
                    console.log("success" + result);
                }
            });
    });	
</script>
</body>
</html>
