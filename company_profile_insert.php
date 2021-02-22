<?php
/*include_once('lib/Session.php');
Session::init();
Session::check_session();
if (isset($_GET['action']) && $_GET['action'] == "logout"){
  Session::destroy();
}*/
?>

<?php
include_once('header.php');
include_once('classes/selection_class.php');
include_once('classes/update_company_profile_class.php');
$UpdateClass 	= new UpdateClass;
$company_id 	= Session::get('userID');
$company_name  	= Session::get('company_name');
$Selection = new Selection();
$div = $Selection->division();
$ToDivision 		= $Selection->ToDivision();
$SelweightPercel 	= $Selection->SelectweightPercel();
if(isset($_POST['submitSend'])){
	$calculated = $UpdateClass->QueryCalculationDataSend($_POST, $company_id);
}
if(isset($_SESSION['msg'])){
	echo "<div class='alert alert-success'><h3>".$_SESSION['msg']."</h3> </div>";
	unset($_SESSION['msg']);
}
?>
<!--=======================      Main wellcome section    =====================-->
	<div class="wellcome-section">
	  <div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php
					if(isset($calculated)){
						echo $calculated;
				?>
				<?php }?>				
				<div class="branch-title">
					<h2 style="text-align: center;"><?php echo $company_name;?> Courier Service view page</h2>
					<h4 class="text-center">Insert Data From This Feild</h4>
						<ul class="company-profile-nav clearfix">
							<li><a href="company_profile_insert.php">Add branch</a></li>
							<li><a href="Company_branch.php">shipping Cost</a></li>
							<li><a href="Company_request.php">Orders Request</a></li>
						</ul>

				</div>

			</div>
		</div>
	

		<div class="well">
			<form id="calculationForm" class="form-horizontal location-parsel" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
					<div class="row">
		   				<div class="col-md-12">
			<!--========== where you want to send =========== ===-->
						<div class="col-md-6">
							<fieldset>
							<legend>From Select (Division, District, Thana)</legend>
							<div class="form-group form-group-sm">
								<label class="control-label col-md-3">Division</label>
								<div class="col-md-6">
									<select required name="fromDivId" id="from-division-list" class="form-control" onChange="FromgetDistrict(this.value);">
									<option>Select Division</option>	
									<?php
										if(!empty($div)):
											while ($row = $div->fetch_assoc()):
									?>
									<option value="<?php echo $row['division_id'];?>"><?php echo $row['division_name'];?></option>
									<?php endwhile; endif; ?>
								</select>
								</div>
							</div>

							<div class="form-group form-group-sm">
								<label class="control-label col-md-3">District</label>
								<div class="col-md-6">
									<div>
										<select onChange="FromgetUpazila(this.value);" id="from-district-list" name="fromDisId" class="form-control">
											<option>Select District</option>
										</select>
									</div>
								</div>
							</div>

							<div class="form-group form-group-sm">
								<label class="control-label col-md-3">Thana</label>
								<div class="col-md-6">
									<select name="fromUzlaId" id="from-thana-list" class="form-control">
									<option>Select Upazila</option>
								</select>
								</div>
							</div>

							<div class="form-group form-group-sm">
								<label class="control-label col-md-3">Branch Name</label>
								<div class="col-md-6">
									<input style="width: 100%;border:1px solid #000; height: 30px; padding-left: 10px;" type="text" name="from_branch_name" placeholder="Enter Branch Name">	
								</div>
							</div>							

						</fieldset>
						</div>

			<!--==================== Where we want to send =================-->
						<div class="col-md-6">
							<fieldset>
							<legend>To Select (Division, District, Thana)</legend>
							<div class="form-group form-group-sm">
								<label class="control-label col-md-3 form-group-sm">Division</label>
								<div class="col-md-6">
									<select name="toDivId" id="To-division-list" class="form-control" onChange="TogetDivision(this.value);">
									<option>Select Division</option>	
									<?php
										if(!empty($ToDivision)):
											while ($row = $ToDivision->fetch_assoc()):
									?>
									<option value="<?php echo $row['division_id'];?>"><?php echo $row['division_name'];?></option>
									<?php endwhile; endif; ?>
								</select>
								</div>
							</div>

							<div class="form-group form-group-sm">
								<label class="control-label col-md-3">District</label>
								<div class="col-md-6">
									<select name="toDisId" class="form-control" id="toGetDistrict" onChange="ToDistrict(this.value);">
									<option>Select District</option>
								</select>
								</div>
							</div>

							<div class="form-group form-group-sm">
								<label class="control-label col-md-3">Thana</label>
								<div class="col-md-6">
									<select name="toupailaID" id="toUpazila" class="form-control">
									<option>Select Upazila</option>
								</select>
								</div>
							</div>

							<div class="form-group form-group-sm">
								<label class="control-label col-md-3">Branch Name</label>
								<div class="col-md-6">
									<input style="width: 100%;border:1px solid #000; height: 30px; padding-left: 10px;" type="text" name="to_branch_name"  placeholder="Enter Branch Name">	
								</div>
							</div>								
						</fieldset><br><br>
						</div><br><br>
				  </div>
				</div>		
			<!-- =================== select courier  ======================= -->
					<div class="row">
					   <div class="col-md-12">
							<div class="courier-parts-info">
			<!-- =================== service type  ======================= -->
						<div class="form-group form-group-sm">
							<label class="control-label col-md-4 col-md-offset-1">Service Type
							</label>
							<div class="col-md-6">
								<input type="radio" name="serviceType" value="1" checked> Normal for 3 Days
								<input type="radio" name="serviceType" value="2"> Urgent

							</div>
						</div>
			<!-- =================== parcel type  ======================= -->
						<div class="form-group form-group-sm">
							<label class="control-label col-md-4 col-md-offset-1">Parcel Type
							</label>
							<div class="col-md-6">
								<input type="radio" name="parcelType" value="1" checked> Document / Paper
								<input type="radio" name="parcelType" value="2"> ponderable Parcel
							</div>
						</div>

			<!-- =================== Weight  ======================= -->
						<div class="form-group form-group-sm"  id="parcelTypeID">
							<label class="control-label col-md-4 col-md-offset-1"> Weight
							</label>
							<div class="col-md-3">
								<select class="form-control" name="weight">
									<?php
										if(!empty($SelweightPercel)):
											while ($row = $SelweightPercel->fetch_assoc()):
									?>
									<option value="<?php echo $row['id'];?>"><?php echo $row['weight'];?></option>
									<?php endwhile; endif; ?>
								</select>
							</div>
						</div>

			<!-- =================== Weight  ======================= -->
						<div class="form-group form-group-sm">
							<label class="control-label col-md-4 col-md-offset-1">Cost</label>
							<div class="col-md-3">
								<input type="text" id="shippingCharge" placeholder="Insert Cost" class="form-control" name="calculation" required>
							</div>
						</div>

						<div class="form-group form-group-sm">
							<label class="control-label col-md-4 col-md-offset-2"></label>
							<div class="col-md-3">
								<input type="submit" conclick="return mess();" name="submitSend" value="Insert" class="btn btn-warning">
							</div>
						</div>
							</div>
					</div> <!-- end col-md12 -->
				</div><!-- end row -->  
			  </form>			
		</div>
	</div> <!-- end wellcome-section -->
<?php include_once('footer.php'); ?>

<script>
function FromgetDistrict(val) {

	//alert('hello');
	$.ajax({
	type: "POST",
	url: "ajax.php",
	data:'division_id='+val,
	success: function(data){
		$("#from-district-list").html(data);
	}
	});
}

function FromgetUpazila(val2){

	$.ajax({
	type: "POST",
	url: "ajax.php",
	data:'from_upazila='+val2,
	success: function(data){
		$("#from-thana-list").html(data);
	}
	});
}

//To division ajax
function TogetDivision(val) {

	//alert('hello');
	$.ajax({
	type: "POST",
	url: "ajax.php",
	data:'ToDivId='+val,
	success: function(data){
		$("#toGetDistrict").html(data);
	}
	});
}


function ToDistrict(val){
	$.ajax({
	type: "POST",
	url: "ajax.php",
	data:'TopUpId='+val,
	success: function(data){
		$("#toUpazila").html(data);
	}
	});
}


function mess(){
	alert('Your Record is successfully saved');
	return true;
}

var parcelType = $("input[name='parcelType']:checked").val();
if(parcelType == 1){
	$("#parcelTypeID").fadeOut();
}else{
	$("#parcelTypeID").fadeIn();
}

$("input[name='parcelType']").change(function() {
    parcelType = this.value;
    console.log(parcelType);

	if(parcelType == 1){
		$("#parcelTypeID").fadeOut();
	}else{
		$("#parcelTypeID").fadeIn();
	}    
});
</script>