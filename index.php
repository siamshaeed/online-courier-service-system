<?php
include_once('hdr-not-check-session.php');
include_once('classes/selection_class.php');

$Selection = new Selection();
$div = $Selection->division();
$ToDivision 		= $Selection->ToDivision();
$SelCoName 			= $Selection->SelectCourierName();

//$Selection->AllSelection();


$SelweightPercel 	= $Selection->SelectweightPercel();

if(isset($_POST['submitSend'])){
	$calculated = $Selection->QueryCalculationData($_POST);
}

?>



<!--=======================      Main wellcome section    =====================-->
	<div class="wellcome-section">
	  <div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="wellcome-slogan">
					<div class="slogan">
						<h1>বাংলাদেশের এই প্রথম সকল কুরিয়ার সার্ভিস কোম্পানি <br/><span>একই প্লাটফর্মে</span> </h1>
					</div>
				</div>
			</div>
		</div>
	

		<div class="well">
			<form id="calculationForm" class="form-horizontal location-parsel" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
					<div class="row">
		   				<div class="col-md-12">
		   				<h2>আপনি কি কিছু পাঠানোর কথা ভাবছেন?</h2>

		   				<div class="row">
		   					<div class="col-sm-12">
		   					<label class="control-label" style="text-align: center; display: block; margin-bottom: 10px;">আপনার পছন্দের কুরিয়ার নির্বাচন করুন </label>
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
							<legend>আপনি কোথা থেকে পাঠাতে চান</legend>
							<div class="form-group form-group-sm">
								<label class="control-label col-md-3">বিভাগ নির্বাচন</label>
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
								<label class="control-label col-md-3">জেলা নির্বাচন</label>
								<div class="col-md-6">
									<div>
										<select onChange="FromgetUpazila(this.value);" id="from-district-list" name="fromDisId" class="form-control">
											<option>Select District</option>
										</select>
									</div>
								</div>
							</div>

							<div class="form-group form-group-sm">
								<label class="control-label col-md-3">থানা নির্বাচন </label>
								<div class="col-md-6">
									<select name="fromUzlaId" onChange="CourierServiceBranch();" id="from-thana-list" class="form-control">
									<option>Select Upazila</option>
								</select>
								</div>
							</div>

							<div class="form-group form-group-sm">
								<label class="control-label col-md-3">শাখার নাম</label>
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
							<legend>আপনি কোথায় পাঠাতে চান</legend>
							<div class="form-group form-group-sm">
								<label class="control-label col-md-3 form-group-sm">বিভাগ নির্বাচন</label>
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
								<label class="control-label col-md-3">জেলা নির্বাচন</label>
								<div class="col-md-6">
									<select name="toDisId" class="form-control" id="toGetDistrict" onChange="ToDistrict(this.value);">
									<option>Select District</option>
								</select>
								</div>
							</div>

							<div class="form-group form-group-sm">
								<label class="control-label col-md-3">থানা নির্বাচন </label>
								<div class="col-md-6">
									<select name="toupailaID" id="toUpazila" onChange="ToCourierServiceBranch();" class="form-control">
									<option>Select Upazila</option>
								</select>
								</div>
							</div>

							<div class="form-group form-group-sm">
								<label class="control-label col-md-3">শাখার নাম </label>
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
							<div class="courier-parts-info clearfix">
			<!-- =================== service type  ======================= -->
						<div class="form-group form-group-sm">
							<label class="control-label col-md-4 col-md-offset-1">সেবার ধরণ
							</label>
							<div class="col-md-6">
								<input type="radio" name="serviceType" value="1" checked> স্বাভাবিক 3 দিন
								<input type="radio" name="serviceType" value="2"> জরুরী 1 দিন

							</div>
						</div>
			<!-- =================== parcel type  ======================= -->
						<div class="form-group form-group-sm">
							<label class="control-label col-md-4 col-md-offset-1">পার্সেল টাইপ
							</label>
							<div class="col-md-6">
								<input type="radio" name="parcelType" value="1" checked> নথি / কাগজ
								<input type="radio" name="parcelType" value="2"> ভারযুক্ত পার্সেল
							</div>
						</div>

			<!-- =================== Weight  ======================= -->
						<div class="form-group form-group-sm"  id="parcelTypeID">
							<label class="control-label col-md-4 col-md-offset-1">ওজন নির্বাচন করুন
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
							<label class="control-label col-md-4 col-md-offset-1">বহন খরচ</label>
							<div class="col-md-3">
								<input type="text" id="shippingCharge" placeholder="মোট খরচ" class="form-control">
							</div>
						</div>

						<div class="form-group form-group-sm col-md-12">
							<div style="margin-left: 47%;">
								<input type="submit" name="submitSend" value="এখানে ক্লিক করে খরচ দেখুন" class="btn btn-warning">
								<a style="border: 1px solid #d58512" class="btn btn-warning" href="user-registration-page.php">রেজিষ্টেশন করে এখনি আপনার পার্সেল  পাঠান</a>
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
$("#calculationForm").on("submit",function(e){
	e.preventDefault();
	var data = $(this).serialize();
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