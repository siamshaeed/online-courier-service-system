<?php
include_once('classes/user_profile_update_class.php');
include_once('header.php');
Session::init();
$loginmsg 		= 	Session::get('loginmsg');
$user_id		=	Session::get('user_id');
$user_name 		= 	Session::get('user_name');
$fname 			= 	Session::get('fname');
$lname 			= 	Session::get('lname');
$mobile 		= 	Session::get('mobile');
$UpdateClass 	= new UpdateClassUser();
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
						<h3 style="text-transform: capitalize; text-align: center;">Personal information page</h3>
<?php
include('user-profile-nav.php');
?>						
					</div>
					</div>																
				</div>
				<div class="row">
					<div class="col-sm-12">
<?php
if(isset($_POST['edit'])){
$UpdateUserProfile = $UpdateClass->UpdateUserProfile($_POST, $user_id);

}

if(isset($user_id)){
$edit_id = $UpdateClass->selected_update_data($user_id);
}
?>
<?php

 	if(isset($edit_id)):
 		$edit_id = $edit_id->fetch_assoc();

 		$edit_fname  = $edit_id['fname'];
 		$edit_lname  = $edit_id['lname'];
 		$edit_fname  = $edit_id['fname'];
 		$edit_mobile = $edit_id['mobile'];
 		$address     = $edit_id['address'];
?>
<?php endif?>

							<h3 style="font-size: 20px;line-height: 1;text-align: center;"><?php echo $fname; ?> Your Information</h3>
						<form class="user-information" action="user-personal-information.php?edit=<?php echo $user_id?>" method="POST">
<?php
if(isset($_GET['msg'])){
    $get_msg = $_GET['msg'];
    echo "<h5 class='alert alert-success'>".$get_msg."</h5>";
}
?>													
							<div class="form-group clearfix">
								<label>First Name</label>
								<input class="form-control" type="text" name="fname" value="<?php
								if(isset($edit_fname)){echo $edit_fname;}?>">
							</div>
							<div class="form-group clearfix">
								<label>Last Name</label>
								<input class="form-control" type="text" name="lname" value="<?php
								if(isset($edit_lname)){echo $edit_lname;}?>">
							</div>
<!-- 							<div class="form-group clearfix">
								<label>Home District</label>
								<input class="form-control" type="text" name="" value="">
							</div> -->
							<div class="form-group clearfix">
								<label>Mobile</label>
								<input class="form-control" type="text" name="mobile" value="<?php if(isset($edit_mobile)){echo $edit_mobile;}?>">
							</div>

							<div class="form-group clearfix">
								<label>Address</label>
								<input class="form-control" type="text" name="address" value="<?php if(isset($address)){echo $address;}?>">
							</div>							
							<input class="btn-danger" type="submit" name="edit" value="Update">
						</form>													
					</div>					
				</div>	
		</div>
</header>
</section>

<?php
include_once('footer.php');
?>