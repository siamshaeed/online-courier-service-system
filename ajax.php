<?php
include_once('classes/selection_class.php');

$Selection = new Selection();

//uses from classes
if(isset($_POST['division_id'])){
	$division_id = $_POST["division_id"];
	$div = $Selection->district($division_id);
}

if(isset($_POST['from_upazila'])){
	$upazila_id = $_POST["from_upazila"];
	$div = $Selection->from_upazila($upazila_id);	
}


//Uses To classes

if(isset($_POST['ToDivId'])){
	$division_id = $_POST["ToDivId"];
	$div = $Selection->district($division_id);
}

if(isset($_POST['TopUpId'])){
	$upazila_id = $_POST["TopUpId"];
	$div = $Selection->from_upazila($upazila_id);	
}


if(isset($_POST['weight'])){
	//print_r($_POST['calValue']);
	$calData = $_POST;
	//parse_str($calData, $calData);
	//print_r($calData);
	echo $Selection->QueryCalculationData($calData);
}
/*$conn = mysqli_connect("localhost","root","","courierdb");

if(isset($_POST["division_id"])){
	$division_id = $_POST["division_id"];

	$sql = "SELECT * FROM district WHERE division_id = '$division_id'";
	$run = mysqli_query($conn, $sql);
	if(!empty($run)){
	while ($row = $run->fetch_assoc()) {
		echo "<option value=".$row['district_id'].">".$row['district_name']."</option>";
	}
}
	
}*/

if(isset($_POST['done'])){
	$CourieriD 			= $_POST['CourieriD'];
	$from_thana_list	= $_POST['from_thana_list'];
	$Selection->SelectBranch($CourieriD, $from_thana_list);
}

if(isset($_POST['done_2'])){
	$CourieriD 			= $_POST['CourieriD'];
	$toUpazila			= $_POST['toUpazila'];
	$from_branch 		= $_POST['from_branch'];
	$Selection->ToSelectBranch($CourieriD, $toUpazila, $from_branch);
}

?>