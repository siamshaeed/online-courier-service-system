<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Controller.php");


class UpdateClassUser extends Controller{


	public function __construct(){
		parent::__construct();
	}

	public function UpdateUserProfile($update, $user_id){
		if(isset($update)){

			//$user_name	= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($update['user_name']));

			$fname		= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($update['fname']));
			
			$lname		= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($update['lname']));

			$mobile		= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($update['mobile']));

			$address	= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($update['address']));


			$sql = "UPDATE user_registration SET fname = '$fname', lname = '$lname', mobile = '$mobile', address = '$address' WHERE user_id='$user_id'";

			$query = $this->db->insert($sql);


		if(isset($query)){
			$msg = "Updation successfully completed";
			//header("refresh:1; url=donar_reg_info.php?success=1");
			echo("<script>location.href = 'user-personal-information.php?msg=$msg';</script>");
		}

		}

	}

	public function profile_logo($user_id){
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
          $upload_img = "upload_images_Users/".$unique_name;

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
          $query = "UPDATE user_registration SET image= '$upload_img' WHERE user_id = '$user_id'";
          $db_rows = $this->db->insert($query); 
          if ($db_rows){
      	  $up_msg= "image uploaded successfully"; 
      	  return $up_msg;
      //echo $up_msg= NULL;                      
          }     
    }		


	}	

	public function selected_update_data($user_id){
				$sql = "SELECT * FROM user_registration WHERE user_id='$user_id'";
				$query = $this->db->select($sql);
				return $query;	
	}

	public function sel_img($user_id){
		$Query  = "SELECT image FROM user_registration WHERE user_id = '$user_id'";
		$read   = $this->db->select($Query);
		return $read;	
	}

	public function ViewBranch($fromBranchId){
		if(!empty($fromBranchId)){
			$sql = "SELECT * FROM parceldetails WHERE id ='$fromBranchId'";

			return $data = $this->db->select($sql);

		}
	}

	public function ViewToBranch($toBranchId){
		if(!empty($toBranchId)){
			$sql = "SELECT * FROM parceldetails WHERE id ='$toBranchId'";

			return $data = $this->db->select($sql);

		}
	}

/*	public function ViewParcelCost($fromBranchId){
				$sql = "SELECT calculation FROM parceldetails WHERE id = '$fromBranchId'";	  
				 return $select = $this->db->select($sql);		
	}	*/	

}