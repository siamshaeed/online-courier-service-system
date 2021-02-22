<?php
include_once('header.php');
include_once('classes/update_company_profile_class.php');
$UpdateClass 	= new UpdateClass;
$loginmsg 		= Session::get('loginmsg');
$company_id 	= Session::get('userID');
$company_name 	= Session::get('company_name');
$uploaded_image = Session::get('uploaded_image');

$data = $UpdateClass->CompanyBranchView($company_id);
?>

<section class="companyBranch-wrp">
<?php
if(isset($_GET['delete'])){
	$parceldelete = $_GET['delete'];
		echo "<h5 class='alert alert-danger' style='text-align: center'>".$parceldelete."</h5>";
}
?>

			<div class="branch-title">
				<h2 style="text-align: center;"><?php echo $company_name;?> courier service view page</h2>
						<ul class="company-profile-nav clearfix" style="margin-bottom: 50px;">
							<li><a href="company_profile_insert.php">Add branch</a></li>
							<li><a href="Company_branch.php">shipping cost</a></li>
							<li><a href="profile.php">Profile</a></li>
							<li><a href="Company_request.php">Orders Request</a></li>
						</ul>

			</div>
			<table class="table table-striped">
			    <thead>
			      <tr>
			      	<th>SL</th>
			        <th>From Division</th>
			        <th>From District</th>
			        <th>From Thana</th>
			        <th>From Branch</th>

			        <th>To Division</th>
			        <th>To District</th>
			        <th>To Thana</th>
			        <th>To Branch</th>
			        
			        <th>Service Type</th>
			        <th>Parcel Type</th>
			        <th>Weight</th>			        
			        <th>Price</th>			        
			        <th>Delete</th>
			      </tr>
			    </thead>
<?php
if(!empty($data)):
	$i=1;
	while ($parcelSelect = $data->fetch_assoc()):
		$fromDivId = $parcelSelect['fromDivId'];
?>			    
			    <tbody>
			      <tr>
			      	<td><?php echo $i; ?></td>
<?php
	$read = $UpdateClass->QueryFromDivision($fromDivId);

	if(!empty($read)):
		while ($row = $read->fetch_assoc()):
?>			      	
			        <td><?php echo $row['division_name'];?></td>
<?php endwhile; endif;

	$fromDisId = $parcelSelect['fromDisId'];
	$read = $UpdateClass->QueryFromDistrict($fromDisId);

	if(!empty($read)):
		while ($row = $read->fetch_assoc()):
?>			      	
			        <td><?php echo $row['district_name']?></td>

<?php endwhile; endif;
//end of district name


	$fromUzlaId = $parcelSelect['fromUzlaId'];
	$read = $UpdateClass->QueryFromUpzila($fromUzlaId);

	if(!empty($read)):
		while ($row = $read->fetch_assoc()):
?>			      	
			        <td><?php echo $row['upazila_name'];?></td>

<?php endwhile; endif;?>
			        <td><?php echo $parcelSelect['fromBranchName'];?></td>



<?php
//start work to 
	$toDivId = $parcelSelect['toDivId'];
	$read = $UpdateClass->QueryToDivision($toDivId);

	if(!empty($read)):
		while ($row = $read->fetch_assoc()):
?>			      	
			        <td><?php echo $row['division_name'];?></td>

<?php endwhile; endif;


	$toDisId = $parcelSelect['toDisId'];
	$read = $UpdateClass->QueryToDistrict($toDisId);

	if(!empty($read)):
		while ($row = $read->fetch_assoc()):
?>			      	
			        <td><?php echo $row['district_name'];?></td>

<?php endwhile; endif;

//to upzild id
	$toUzlaId = $parcelSelect['toUzlaId'];
	$read = $UpdateClass->QueryToUpzila($toUzlaId);

	if(!empty($read)):
		while ($row = $read->fetch_assoc()):
?>			      	
			        <td><?php echo $row['upazila_name'];?></td>

<?php endwhile; endif;?>
			        <td><?php echo $parcelSelect['toBranchName'];?></td>

			        <td>
		        	<?php 
					$serviceType = $parcelSelect['serviceType'];
		        	if($serviceType==1){
		        		echo "Normal";
		        	}else{
		        		echo "Urgent";
		        	}
			        ?>
			        </td>
			        <td>
		        	<?php 
					$parcelType = $parcelSelect['parcelType'];
		        	if($parcelType==1){
		        		echo "Document";
		        	}else{
		        		echo "Ponderable";
		        	}
			        ?>
			        </td>


<?php
	$weight = $parcelSelect['weight'];
	$read = $UpdateClass->Queryweight($weight);

	if(!empty($read)):
		while ($row = $read->fetch_assoc()):
		$weight = $row['weight'];	
?>
<?php endwhile; endif;?>

			        <td><?php
			        	if($parcelSelect['weight']==0){
			        		echo $parcelSelect['weight'].'gm';
			        	}else{
			        		echo $weight;
			        	}
			        ?></td>


			        
			        <td><?php echo $parcelSelect['calculation'];?> TK.</td>			        
                      <td class="text-center">
                        <a class="cancel-btn" href="delete-page.php?parcelDelete=<?php echo $parcelSelect['id'];?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>                       
                      </td>
			      </tr>
			    </tbody>
			    
			    
<?php $i++; endwhile; endif;?>			    
		  </table>			
</section>
<?php
include_once('footer.php');
?>