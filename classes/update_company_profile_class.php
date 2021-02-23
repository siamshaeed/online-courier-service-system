<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Controller.php");


class UpdateClass extends Controller{

	public function __construct(){
		parent::__construct();
	}


	public function UpdateCmpnyProfile($update, $company_id){
		if(isset($update)){

			$company_name		= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($update['company_name']));

			$author_name		= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($update['author_name']));

			$address		= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($update['address']));

			$sql = "UPDATE courier_info SET company_name = '$company_name', author_name = '$author_name', address = '$address' WHERE courier_id='$company_id'";

			$query = $this->db->insert($sql);

			if(isset($query)){
				$msg = "Updation successfully completed";
				//header("refresh:1; url=donar_reg_info.php?success=1");
				echo("<script>location.href = 'company-profile.php?msg=$msg';</script>");
			}			

		}


	}


	public function selected_update_data($company_id){
				$sql = "SELECT * FROM courier_info WHERE courier_id='$company_id'";
				$query = $this->db->select($sql);
				return $query;	
	}	

//upload image method
	public function profile_logo($s_id){
          $permited = array('jpeg', 'jpg', 'png', 'gif');
          $filename = $_FILES['image']['name'];          
          $filesize = $_FILES['image']['size'];
          $filetmp = $_FILES['image']['tmp_name'];
          $div_name = explode('.', $filename);
          
          //lowercase extension 
          $name_ext = strtolower(end($div_name));

          //substring generated
          $unique_name = substr(md5(time()), 0, 10). '.'.$name_ext;
          //add image name
          $upload_img = "upload_images_company/".$unique_name;

    if(empty($filename)){
      $up_msg="Please upload image";
      return $up_msg;
    }
    elseif ($filesize < 1024){
      $up_msg="image must be greater then 1KB";  
	return $up_msg;        
    }elseif(in_array($name_ext, $permited) === false){
      $up_msg="please select image type ".implode(', ', $permited);
	return $up_msg;     
    }else{
      move_uploaded_file($filetmp, $upload_img);
          $query = "UPDATE courier_info SET image= '$upload_img' WHERE courier_id = '$s_id'";
          $db_rows = $this->db->insert($query); 
          if ($db_rows){
      	  $up_msg= "image uploaded successfully"; 
      	  return $up_msg;
      //echo $up_msg= NULL;                      
          }     
    }		


	}

	public function sel_img($s_id){
		$Query  = "SELECT image FROM courier_info WHERE courier_id = '$s_id'";
		$read   = $this->db->select($Query);
		return $read;	
	}

//uses for where your branches have

	public function QueryCalculationDataSend($post, $company_id){

		if(isset($post)){

			$company_id 		= $company_id;

			$fromDivId			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['fromDivId']));

/*			if($post['fromDivId']!=0){

				$fromDivId			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['fromDivId']));
			}else{
				echo "<div class='alert alert-warning'><h3> Please fillup division feild</h3> </div>";
			}*/			

			$fromDisId			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['fromDisId']));

			$fromUzlaId			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['fromUzlaId']));

			$from_branch_name	= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['from_branch_name']));

			$toDivId			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['toDivId']));

			$toDisId			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['toDisId']));

			$toUzlaId			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['toupailaID']));

			$to_branch_name		= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['to_branch_name']));


			//$courier_id			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['courier_id']));
			
			$serviceType		= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['serviceType']));

			$parcelType			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['parcelType']));
			
			if($parcelType==2){

				$weight			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['weight']));

			}else{

				$weight = 0;
			}

			$calculation			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['calculation']));

			//$rowVarify = $this->CheckCompanyInertData($company_id, $fromDivId, $fromUzlaId, $toDivId, $toDisId, $toUzlaId, $serviceType, $parcelType, $weight, $calculation);

			if($fromDivId == 0 || $fromDisId==0 || $fromUzlaId==0 || $toDivId==0 || $toDisId==0 || $toUzlaId==0 || empty($from_branch_name) || empty($to_branch_name)){
				 	$_SESSION['msg'] = "Feild must not be empty";
				 	header('Location: company_profile_insert.php');				

			}/*if($rowVarify == false){
				echo "Row Already Exists";
			}*/

			else{

			$sql = "INSERT INTO parceldetails(courier_id, fromDivId, fromDisId, fromUzlaId, fromBranchName, toDivId, toDisId, toUzlaId, toBranchName, serviceType, parcelType, weight, calculation) VALUES('$company_id', '$fromDivId', '$fromDisId', '$fromUzlaId', '$from_branch_name', '$toDivId', '$toDisId', '$toUzlaId', '$to_branch_name', '$serviceType', '$parcelType', '$weight', '$calculation')";

				$select = $this->db->insert($sql);

				 if(!empty($select)){
				 	$_SESSION['msg'] = "Data Insert Successfully";
				 	header('Location: company_profile_insert.php');
				 }

				//var_dump($select);
			}

		}
	}


public function CompanyBranchView($company_id){

	if(!empty($company_id)){
		$sql = "SELECT * FROM parceldetails WHERE courier_id = $company_id";
		return $data = $this->db->select($sql);

	}
}

public function QueryFromDivision($fromDivId){

	if(!empty($fromDivId)){
		$sql = "SELECT * FROM division WHERE division_id ='$fromDivId'";
		return $data = $this->db->select($sql);
	}
}

public function QueryToDivision($toDivId){

	if(!empty($toDivId)){
		$sql = "SELECT * FROM division WHERE division_id ='$toDivId'";
		return $data = $this->db->select($sql);
	}
}	


public function QueryFromDistrict($fromDisId){

	if(!empty($fromDisId)){
		$sql = "SELECT * FROM district WHERE district_id ='$fromDisId'";
		return $data = $this->db->select($sql);
	}	
}

public function QueryToDistrict($toDisId){

	if(!empty($toDisId)){
		$sql = "SELECT * FROM district WHERE district_id ='$toDisId'";
		return $data = $this->db->select($sql);
	}	

}

public function QueryFromUpzila($fromUzlaId){

	if(!empty($fromUzlaId)){
		$sql = "SELECT * FROM upazila WHERE upazila_id ='$fromUzlaId'";
		return $data = $this->db->select($sql);
	}	

}

public function QueryToUpzila($toUzlaId){

	if(!empty($toUzlaId)){
		$sql = "SELECT * FROM upazila WHERE upazila_id ='$toUzlaId'";
		return $data = $this->db->select($sql);
	}	

}

public function Queryweight($weight){
	if(!empty($weight)){
		$sql = "SELECT * FROM parcelweight WHERE id ='$weight'";
		return $data = $this->db->select($sql);
	}

}

public function ViewCompanyRequest($courier_id){
	
	if(!empty($courier_id)){
		$query = "SELECT * FROM userorder WHERE courier_id = '$courier_id' ORDER BY id DESC";
		return $data = $this->db->select($query);		

	}
}

public function UpdateDecision($id, $accept, $color, $accept_bg_class){

if(!empty($id)){
	    $query = "UPDATE userorder SET request= '$accept', color_combination = '$color', accept_bg_class = '$accept_bg_class'  WHERE id = '$id'";
        $db_rows = $this->db->insert($query);

        if(!empty($db_rows)){
        	header("Location: Company_request.php");
        } 
}

}

public function QueryFromReg($user_id){
	if(!empty($user_id)){
		$query = "SELECT * FROM user_registration WHERE user_id = '$user_id'";
		return $data = $this->db->select($query);

	}

}

public function DoneQuery($user_req_del){

if(!empty($user_req_del)){
$done_pacel   = "Your Parcel have been successfully done";
$user_req_del = $user_req_del;	
$done_clr 	  = 'btn-success';

	
$query = "UPDATE userorder SET done = '$done_pacel', done_clr = '$done_clr' WHERE id ='$user_req_del'";
$db_rows = $this->db->insert($query);

        if(!empty($db_rows)){
        	header("Location: Company_request.php");
        }
$this->SelectForParcel($user_req_del); 
}

}

public function SelectForParcel($user_req_del){
	if(!empty($user_req_del)){
		$sql = "SELECT * FROM userorder WHERE id ='$user_req_del'";
		$data = $this->db->select($sql);
		//echo $data;
		if(isset($data)){
			while ($row = $data->fetch_assoc()){
				$id 	= $row['id'];
				$date 	= $row['date'];
				$cost 	= $row['cost'];

				$courier_id = $row['courier_id'];
				$sql 	= "INSERT INTO parcentage(id, date, cost, courier_id) VALUES('$id', '$date', '$cost', '$courier_id')";		
				return $data 	= $this->db->insert($sql);				
		}
	}

	}

	}


}