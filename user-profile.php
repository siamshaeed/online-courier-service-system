<?php
include_once('header.php');
Session::init();

include_once('classes/user_profile_update_class.php');
include_once('classes/user_registration_class.php');
include_once('classes/update_company_profile_class.php');

$loginmsg 		= 	Session::get('loginmsg');
$user_id		=	Session::get('user_id');
$user_name 		= 	Session::get('user_name');
$fname 			= 	Session::get('fname');
$lname 			= 	Session::get('lname');
$mobile 		= 	Session::get('mobile');

$UpdateClass 			= new UpdateClassUser();
$UpdateClassCompany 	= new UpdateClass();

//upload images
if(isset($_POST['upload'])){
  $up_msg=$UpdateClass->profile_logo($user_id);
}

//$data = $UpdateClass->CompanyBranchView($company_id);
//var_dump($user_name);
$All_User_reg		= new All_User_reg();
$data 				= $All_User_reg->ViewUserRequest($user_id);
?>	

<section class="company-pfle-wrp">
		<div class="container">
				<div class="row">
					<div class="col-sm-12">
					<div class="parent-image">	
						<div class="left-profile-image">
							<?php
							$read=$UpdateClass->sel_img($user_id);
							if(isset($read)):
							while ($row = $read->fetch_assoc()):
							?>						
							<h1 class="logo">
								<a href="profile.php">
									<img src="<?php echo $row['image']?>" alt="missing">
								</a>
							</h1>	
						</div>
<?php endwhile; endif; ?>						
						
							<?php
if(isset($loginmsg)){
	echo "<h4 class='text-success' style='margin-top: 0px;text-align: center;'>" .$loginmsg."</h4>";
	Session::set('loginmsg', Null);
}
							?>												
						<h3 style="text-transform: capitalize; text-align: center;"><?php echo $fname.' '.$lname ?> profile page</h3>
					</div>
<?php
include('user-profile-nav.php');
?>
<?php 
if(isset($_SESSION['msg'])){
	echo $_SESSION['msg'];
	unset($_SESSION['msg']);
}
 ?>												
					</div>																	
					<div class="col-sm-12">											
				      <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data" class="img-upload-options">
				      	<h4>Image Upload Options</h4>
				      	<p>You can upload and change your profile image.</p>	
				        <div class="uploaded-div">
				          <input type="file" name="image" placeholder="search your item">
				        </div>
				        <input type="submit" value="save" name="upload">
				      </form>	
					</div>
					
<div class="col-sm-12">
						<h4>Recipient's Information</h4>
						<table class="table table-bordered user-cancel-table">
						    <thead>
						      <tr>
						      	<th>Serial</th>
						        <th>Date</th>
						         <th>Recipient's Name</th>
						        <th>Email</th>
						        <th>Phone</th>
						        <th>Address</th>
						        <th>Courier Name</th>				        
						        <th>Info</th>
						        <th>Action</th>
						      </tr>
						    </thead>
						    <tbody>
<?php
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
<?php
$courier_id     = $userorder['courier_id'];
$read = $All_User_reg->ViewCourierName($courier_id);
	if(!empty($read)):
		while ($row = $read->fetch_assoc()):
?>			      	
			        <td><?php echo $row['company_name'];?></td>
<?php endwhile; endif;?>							
						        <td style="color: <?php echo $userorder['color_combination'];?>">
						        	<?php 
if(empty($userorder['done'])){
	echo $userorder['request'];
}else{
	echo $userorder['done'];
}
						        	?>
						        </td>
						      	<td>
						      		<a class="btn btn-danger" href="delete-page.php?req_del_from_user=<?php echo $userorder['id'];?>">X</a>
						      	</td>  
						      </tr>
<?php $i++;endwhile;endif;?>						      
						    </tbody>
						  </table>
<h4>Where do you want to send from</h4>
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
$data_2 				= $All_User_reg->ViewUserRequest($user_id);
$i = 1;
if(!empty($data)):
	while ($userorder = $data_2->fetch_assoc()):		
?>	
	<tr>
		<td><?php echo $i;?></td>
		<td><?php echo $userorder['date'];?></td>

<?php
	$fromDivId      = $userorder['fromDivId'];
	$read = $UpdateClassCompany->QueryFromDivision($fromDivId);

	if(!empty($read)):
		while ($row = $read->fetch_assoc()):
?>			      	
			        <td><?php echo $row['division_name'];?></td>
<?php endwhile; endif;

	$fromDisId 	    = $userorder['fromDisId'];
	$read = $UpdateClassCompany->QueryFromDistrict($fromDisId);

	if(!empty($read)):
		while ($row = $read->fetch_assoc()):
?>			      	
			        <td><?php echo $row['district_name']?></td>

<?php endwhile; endif;?>

<?php
$fromUzlaId 	= $userorder['fromUzlaId'];
$read = $UpdateClassCompany->QueryFromUpzila($fromUzlaId);
	if(!empty($read)):
		while ($row = $read->fetch_assoc()):
?>			      	
			       <td><?php echo $row['upazila_name']?></td>

<?php endwhile; endif;?>

<?php
$fromBranchId 	= $userorder['fromBranchId'];
$read = $UpdateClass->ViewBranch($fromBranchId);
	if(!empty($read)):
		while ($row = $read->fetch_assoc()):
?>			      	
			       <td><?php echo $row['fromBranchName']?></td>

<?php endwhile; endif;?>			
	</tr>
<?php $i++;endwhile;endif;?>
</table>

<!-- table number 3 -->

<h4>Where do you want to send</h4>
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
$data_3 				= $All_User_reg->ViewUserRequest($user_id);
$i = 1;
if(!empty($data)):
	while ($userorder = $data_3->fetch_assoc()):		
?>	
	<tr>
		<td><?php echo $i;?></td>
		<td><?php echo $userorder['date'];?></td>
<?php
//start work to 
	$toDivId		= $userorder['toDivId'];
	$read = $UpdateClassCompany->QueryToDivision($toDivId);

	if(!empty($read)):
		while ($row = $read->fetch_assoc()):
?>			      	
			        <td><?php echo $row['division_name'];?></td>

<?php endwhile; endif;?>

<?php
$toDisId		= $userorder['toDisId'];
$read 		= $UpdateClassCompany->QueryToDistrict($toDisId);
	if(!empty($read)):
		while ($row = $read->fetch_assoc()):
?>
		<td><?php echo $row['district_name'];?></td>
<?php endwhile;endif;?>	

<?php
$toUzlaId 		= $userorder['toUzlaId'];
$read 		= $UpdateClassCompany->QueryToUpzila($toUzlaId);
	if(!empty($read)):
		while ($row = $read->fetch_assoc()):
?>
		<td><?php echo $row['upazila_name'];?></td>
<?php endwhile;endif;?>	

<?php
$toBranchId		= $userorder['toBranchId'];
$read 		= $UpdateClass->ViewToBranch($toBranchId);
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
	$read 			= $UpdateClassCompany->Queryweight($parcelsWeight);

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

				</div>
		</div>
</header>
</section>

<?php
include_once('footer.php');
?>