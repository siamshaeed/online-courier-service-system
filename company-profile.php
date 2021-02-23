<?php
include_once('header.php');
include_once('classes/update_company_profile_class.php');
$UpdateClass 	= new UpdateClass;
$loginmsg 		= Session::get('loginmsg');
$company_id 	= Session::get('userID');
$company_name 	= Session::get('company_name');
$uploaded_image = Session::get('uploaded_image');

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
						</ul>											
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
				</div>
				<div class="row">
					<div class="col-sm-12">
					<div class="courier_info">	
						<h4>Your Courier id is <?php echo $company_id;?></h4>
<?php
if(isset($_GET['msg'])){
    $get_msg = $_GET['msg'];
    echo "<h5 class='alert alert-success'>".$get_msg."</h5>";
}

	if(isset($_POST['edit'])){
		$edit = $_GET['edit'];
	$UpdateCmpnyProfile = $UpdateClass->UpdateCmpnyProfile($_POST, $edit);

	}

if(isset($company_id)){
$edit_id = $UpdateClass->selected_update_data($company_id);
}

 	if(!empty($edit_id)):
 		$edit_id = $edit_id->fetch_assoc();

 		$company_name   	= $edit_id['company_name'];
 		$edit_author_name  	= $edit_id['author_name'];
 		$edit_address  		= $edit_id['address'];
 	endif;

?>


						<form action="company-profile.php?edit=<?php echo $company_id?>" method="POST" class="company-info">
							<div class="company-info-inner clearfix">
								<label>Company Name</label>
								<input type="text" name="company_name" value="<?php if(isset($company_name)){ echo $company_name;}?>">
							</div>
							<div class="company-info-inner clearfix">
								<label>Author Name</label>
								<input type="text" name="author_name" value="<?php if(isset($edit_author_name)){ echo $edit_author_name;}?>">
							</div>	
							<div class="company-info-inner clearfix">
								<label>Address</label>
								<input type="text" name="address" value="<?php if(isset($edit_address)){ echo $edit_address;}?>">
							</div>
							<div class="company-info-inner">
								<input type="submit" name="edit" value="Edit">
							</div>				
						</form>
					</div>	
					</div>
				</div>
			</div>

</section>

<?php
include_once('footer.php');
?>