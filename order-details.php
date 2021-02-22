<?php
include_once('header.php');
Session::init();
$user_id	=	Session::get('user_id');
$user_name 	= 	Session::get('user_name');
$fname 		= 	Session::get('fname');
$lname 		= 	Session::get('lname');
$mobile 	= 	Session::get('mobile');
$fname 		= 	Session::get('fname');

include_once('classes/selection_class.php');
include_once('classes/user_registration_class.php');

$Selection 			= new Selection();
$All_User_reg		= new All_User_reg();
$div 				= $Selection->division();
$ToDivision 		= $Selection->ToDivision();
$SelCoName 			= $Selection->SelectCourierName();

//$Selection->AllSelection();


$SelweightPercel 	= $Selection->SelectweightPercel();

if(isset($_POST['send'])){
	$calculated = $All_User_reg->InsertUserOrder($_POST, $user_id);
}
?>

<!--=======================      Main wellcome section    =====================-->
	<div class="wellcome-section">
	  <div class="container"><!-- 
		<div class="row">
			<div class="col-md-12">
				<div class="wellcome-slogan">
					<div class="slogan">
						<h1>?????????? ?? ????? ??? ???????? ??????? ???????? <br/><span>??? ??????????</span> </h1>
					</div>
				</div>
			</div>
		</div> -->

<!--=======================      Main wellcome section    =====================-->
	<div class="wellcome-section">
	  <div class="container">	

		<div class="well">
			<form id="calculationForm" class="form-horizontal location-parsel" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
					<div class="row">				

					<div class="col-md-12">
						<div class="shipping">
<?php 
if(isset($_SESSION['msg'])){
	echo $_SESSION['msg'];
	unset($_SESSION['msg']);
}
 ?>

							<h4 style="text-align: center; text-transform: capitalize;"><?php echo $fname.' '.$lname;?> place order now</h4>
							<h2>Shipping</h2> <hr>
							<h3 class="text-uppercase">Enter Recipients shipping Infromation</h3>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>First Name <sup>*</sup></label>
										<input type="text" name="fname" class="form-control" required>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Last Name <sup>*</sup></label>
										<input type="text" name="lname" class="form-control" required>
									</div>									
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Email <sup>*</sup></label>
										<input type="email" name="email" class="form-control" required>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Mobile <sup>*</sup></label>
										<input type="number" min="0" name="phone" class="form-control" required>
									</div>									
								</div>

								<div class="col-sm-6" style="margin-bottom: 10px;">
									<label>Order Date<sup>*</sup></label>	
									<div class="input-group date" data-provide="datepicker">
								    <input type="text" name="date" class="form-control">
								    <div class="input-group-addon">
								        <i class="fa fa-calendar" aria-hidden="true"></i>
								    </div>
								</div>																
								</div>

							</div>

							
							<div class="form-group">
								<label>Address Details<sup>*</sup> </label>
								<textarea rows="3" name="address" class="form-control" required></textarea>
							</div>
					</div><!--end com-md-6-->
				</div>

<!--                     <div class="form-group clearfix">
                    	<div class="col-md-4 col-md-offset-8">
                    		<a href="index.html" class="cancel_address">Cancel</a>
                    		<input type="submit" name="submit" class="submit" value="Send Request">
                    	</div>
                    </div> -->                        					
		   				<div class="col-md-12">
		   				<div class="row">
		   					<div class="col-sm-12">
		   						<h5 style="color: #f00;text-align: center;">All information must be selected sequentially</h5>
		   					<label class="control-label" style="text-align: center; display: block; margin-bottom: 10px;">Select your preferred Courier<sup>*</sup></label>
		   					</div>
		   					<div class="col-sm-12">
								<select name="courier_id" id="CourieriD" class="form-control" style="margin: 0 auto 20px; width: 50%; ">
									<option>Select Courier Company</option>
									<?php
										if(!empty($SelCoName)):
											while ($row = $SelCoName->fetch_assoc()):
									?>
									<option value="<?php echo $row['courier_id']?>"><?php echo $row['company_name'];?></option>
									<?php endwhile; endif; ?>
								</select>
		   					</div>
		   				</div>

			<!--========== where you want to send =========== ===-->
						<div class="col-md-6">
							<fieldset>
							<legend>Where do you want to send from</legend>
							<div class="form-group form-group-sm">
								<label class="control-label col-md-3">Division<sup>*</sup></label>
								<div class="col-md-6">
									<select name="fromDivId" id="from-division-list" class="form-control" onChange="FromgetDistrict(this.value);">
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
								<label class="control-label col-md-3">District<sup>*</sup></label>
								<div class="col-md-6">
									<div>
										<select onChange="FromgetUpazila(this.value);" id="from-district-list" name="fromDisId" class="form-control">
											<option>Select District</option>
										</select>
									</div>
								</div>
							</div>

							<div class="form-group form-group-sm">
								<label class="control-label col-md-3">Thana <sup>*</sup></label>
								<div class="col-md-6">
									<select name="fromUzlaId" onChange="CourierServiceBranch();" id="from-thana-list" class="form-control">
									<option>Select Upazila</option>
								</select>
								</div>
							</div>

							<div class="form-group form-group-sm">
								<label class="control-label col-md-3">Branches<sup>*</sup></label>
								<div class="col-md-6">
									<select name="fromBranchName" id="from-branch-list" class="form-control">
									<option>Select Branch</option>
								</select>
								</div>
							</div>							

						</fieldset>
						</div>

			<!--==================== Where we want to send =================-->
						<div class="col-md-6">
							<fieldset>
							<legend>Where do you want to send</legend>
							<div class="form-group form-group-sm">
								<label class="control-label col-md-3 form-group-sm">Division<sup>*</sup></label>
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
								<label class="control-label col-md-3">District<sup>*</sup></label>
								<div class="col-md-6">
									<select name="toDisId" class="form-control" id="toGetDistrict" onChange="ToDistrict(this.value);">
									<option>Select District</option>
								</select>
								</div>
							</div>

							<div class="form-group form-group-sm">
								<label class="control-label col-md-3">Thana<sup>*</sup></label>
								<div class="col-md-6">
									<select name="toupailaID" id="toUpazila" onChange="ToCourierServiceBranch();" class="form-control">
									<option>Select Upazila</option>
								</select>
								</div>
							</div>

							<div class="form-group form-group-sm">
								<label class="control-label col-md-3">Branches<sup>*</sup></label>
								<div class="col-md-6">
									<select name="toBranchName" id="to-branch-list" class="form-control">
									<option>Select Branch</option>
								</select>
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
							<sup>*</sup></label>
							<div class="col-md-6">
								<input type="radio" name="serviceType" value="1" checked> Normal 3 days
								<input type="radio" name="serviceType" value="2"> Urgent 1 days

							</div>
						</div>
			<!-- =================== parcel type ======================= -->
						<div class="form-group form-group-sm">
							<label class="control-label col-md-4 col-md-offset-1">Parcel Type
							<sup>*</sup></label>
							<div class="col-md-6">
								<input type="radio" name="parcelType" value="1" checked> Document / Paper
								<input type="radio" name="parcelType" value="2"> Ponderable Parcel
							</div>
						</div>

			<!-- =================== Weight  ======================= -->
						<div class="form-group form-group-sm"  id="parcelTypeID">
							<label class="control-label col-md-4 col-md-offset-1">weight<sup>*</sup>
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

 						<div class="form-group form-group-sm">
							<label class="control-label col-md-4 col-md-offset-1">Shipping Cost</label>
							<div class="col-md-3">
								<input type="text" id="shippingCharge" placeholder="Auto Calculate" class="form-control" name="cost">
							</div>
						</div>

			<!-- =================== Weight  ======================= -->
						<div class="form-group form-group-sm">						
								<label  class="control-label col-md-4 col-md-offset-1">Payment<sup>*</sup></label>							
							<div class="col-sm-3">
								<select class="form-control" name="paymentType">
									<option value="1">Cash on hand</option>
								</select>
							</div>									
						</div><!--end shipping-->

						<div class="form-group form-group-sm">
							<label class="control-label col-md-4 col-md-offset-2"></label>
							<div class="col-md-3">
								<input id="s1" type="submit" name="submitSend" value="Calculation" class="btn btn-warning">

								<input id="s2" type="submit" name="send" value="Send" class="btn btn-warning">
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
	$('.datepicker').datepicker();
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

function CourierServiceBranch(){

	var CourieriD = $("#CourieriD").val();
	var from_thana_list = $("#from-thana-list").val();

$.ajax({
	url: 'ajax.php',
	type:'POST',
	async: false,
	data:{
		"done":1,
		"CourieriD":CourieriD,
		"from_thana_list":from_thana_list,
	},						
	success:function(data){
		$('#from-branch-list').html(data);			
	}
})

}

function ToCourierServiceBranch(){

	var CourieriD 			= $("#CourieriD").val();
	var toUpazila 			= $("#toUpazila").val();
	var from_branch 		= $("#from-branch-list").val();

$.ajax({
	url: 'ajax.php',
	type:'POST',
	async: false,
	data:{
		"done_2":1,
		"CourieriD":CourieriD,
		"toUpazila":toUpazila,
		"from_branch":from_branch,
	},						
	success:function(data){
		$('#to-branch-list').html(data);			
	}
})

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

//uses form calculation
$("#calculationForm #s1").on("click",function(e){
	e.preventDefault();
	var data = $('#calculationForm').serialize();
	//console.log(data);
	$.ajax({
	type: "POST",
	//dataType: "json",
	url: "ajax.php",
	data: data,
	success: function(data){
		//console.log(data);
		$("#shippingCharge").val(data);
	}
	});	
});

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