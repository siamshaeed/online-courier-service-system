<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Controller.php");

class Selection extends Controller{

	public function division(){

		$sql = "SELECT * FROM division";
		return $select = $this->db->select($sql);
	}

	public function ToDivision(){

		$sql = "SELECT * FROM division";
		return $select = $this->db->select($sql);
	}

	public function district($division){
		if(!empty($division)){
			$sql = "SELECT * FROM district WHERE division_id = '$division'";
			$select = $this->db->select($sql);

			if(!empty($select)){
			echo "<option>"."Select District"."</option>";
			while ($row = $select->fetch_assoc()) {
				echo "<option value=".$row['district_id'].">".$row['district_name']."</option>";
				}
			}
		
		}
	}

	public function from_upazila($upazila_id){
		if(!empty($upazila_id)){
			$sql = "SELECT * FROM upazila WHERE district_id = '$upazila_id'";
			$select = $this->db->select($sql);
			if(!empty($select)){
			echo "<option>"."Select Upazila"."</option>";
			while ($row = $select->fetch_assoc()) {
				echo "<option value=".$row['upazila_id'].">".$row['upazila_name']."</option>";
				}
			}
		
		}
	}

//Select Courier info method 		

	public function SelectCourierName(){

		$sql = "SELECT * FROM courier_info";
		return $select = $this->db->select($sql);
	}

	public function SelectweightPercel(){

		$sql = "SELECT * FROM parcelweight";
		return $select = $this->db->select($sql);
	}

//uses for branch
	public function SelectBranch($CourieriD, $from_thana_list){
		$sql = "SELECT `id` AS `id`, `fromBranchName` FROM parceldetails WHERE courier_id = '	  $CourieriD' AND fromUzlaId = '$from_thana_list'
				GROUP BY `fromBranchName`";

		$select = $this->db->select($sql);

			if(!empty($select)){
			//echo "<option>"."Select Branch"."</option>";
			while ($row = $select->fetch_assoc()) {
				echo "<option value=".$row['id'].">".$row['fromBranchName']."</option>";
				}			}		
	}
//uses to branch
	public function ToSelectBranch($CourieriD, $from_thana_list, $from_branch){
		$sql = "SELECT `id` AS `id`, `toBranchName`
FROM parceldetails
WHERE courier_id = '$CourieriD' AND toUzlaId = '$from_thana_list' AND id = '$from_branch' GROUP BY `toBranchName`";
var_dump($sql);

		$select = $this->db->select($sql);

			if(!empty($select)){
			//echo "<option>"."Select District"."</option>";
			while ($row = $select->fetch_assoc()) {
				echo "<option value=".$row['id'].">".$row['toBranchName']."</option>";
				}
			}		
	}

	public function QueryCalculationData($post){

		if(isset($post)){

			$fromDivId			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['fromDivId']));

			$fromDisId			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['fromDisId']));

			$fromUzlaId			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['fromUzlaId']));

			$fromBranchName			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['fromBranchName']));			

			$toDivId			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['toDivId']));

			$toDisId			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['toDisId']));

			$toUzlaId			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['toupailaID']));

			$toBranchName			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['toBranchName']));			

			$courier_id			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['courier_id']));
			
			$serviceType		= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['serviceType']));

			$parcelType			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['parcelType']));
			
			if($parcelType==2){

				$weight			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['weight']));

			}else{

				$weight = 0;
			}


			if(empty($fromDivId) || empty($fromDisId) || empty($fromUzlaId) || empty($toDivId) || empty($toDisId) || empty($toUzlaId) || empty($courier_id) || empty($serviceType) || empty($parcelType) || empty($fromBranchName) || empty($toBranchName)){
				echo "Feild must not be empty";
			}else{

/*				$sql = "SELECT calculation FROM parceldetails WHERE 
				fromDivId='$fromDivId' AND
				 fromDisId='$fromDisId' AND
				 fromUzlaId='$fromUzlaId' AND 
				 toDivId='$toDivId' AND
				  toDisId='$toDisId' AND 
				  toUzlaId = '$toUzlaId' AND
				  courier_id='$courier_id' AND 
				  serviceType='$serviceType' AND
				  parcelType='$parcelType' AND 
				  weight='$weight'";*/

				$sql = "SELECT calculation FROM parceldetails WHERE 
				fromDivId='$fromDivId' AND
				 fromDisId='$fromDisId' AND
				 fromUzlaId='$fromUzlaId' AND 
				 id='$fromBranchName' AND 				 
				 toDivId='$toDivId' AND
				  toDisId='$toDisId' AND 
				  toUzlaId = '$toUzlaId' AND
				  id = '$toBranchName' AND				  
				  courier_id='$courier_id' AND 
				  serviceType='$serviceType' AND
				  parcelType='$parcelType' AND 
				  weight = '$weight'";				  
				 $select = $this->db->select($sql);
				 if(!empty($select)){
				 	while ($row = $select->fetch_assoc()) {
				 		if(isset($row['calculation'])){
				 			return $row['calculation'];
				 		}else{
				 			return $msg="Please Select all of this";
				 		}	
				 	}
				 }
				//var_dump($select);
			}

		}
	}	

}

