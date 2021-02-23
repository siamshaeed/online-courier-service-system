<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Controller.php");

class AdminClass extends Controller{


public function Courier_reg($post){

if(isset($post)){

		$courier_id  				= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['courier_id']));
		
		$confirm_pass  				= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['confirm_pass']));

		$confirm_pass = md5($confirm_pass);

		$courier_admin_email  		= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['courier_admin_email']));

		$chk_email = $this->check_email($courier_admin_email);
		
		$company_name  				= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['company_name']));

		$author_name  				= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['author_name']));

		$address  					= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['address']));

		$mobile  					= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['mobile']));

	if(empty($courier_id) || empty($confirm_pass) || empty($courier_admin_email) || empty($company_name) || empty($author_name) || empty($address) || empty($mobile)){

		echo "<h4 class='alert-danger'>Feild must not be empty</h4>";

	}if ($chk_email == false) {
			echo $msg = "<h4 class='alert-danger'>"."Email already exists"."</h4>";  
		}else{
		$sql = "INSERT INTO courier_info(courier_id, confirm_pass, courier_admin_email, company_name, author_name, address, mobile) VALUES('$courier_id', '$confirm_pass', '$courier_admin_email', '$company_name', '$author_name', '$address', '$mobile')";
		$insert = $this->db->insert($sql);
		if($insert){
			echo "<h5 class='alert alert-success'>Success! Successfully Registered</h5>";
		}

	}

}


}

	public function check_email($email){
		if(!empty($email)){
				$query = "SELECT courier_admin_email FROM courier_info WHERE courier_admin_email='$email'";
				$check_mail = $this->db->select($query);
				//return $check_mail;
				if(isset($check_mail)){
					if(!empty($check_mail)){
						if(mysqli_num_rows($check_mail) > 0){
							return false;
						}						
					}else{
							return true;
						}

				}else{
					return false;
				}			
		}
	}

	public function ListInfoQuery(){

		$sql = "SELECT * FROM courier_info ORDER BY courier_id ASC";
		return $this->db->select($sql);

	}

	public function DataQuaery($edit){

		$sql = "SELECT * FROM courier_info WHERE courier_id = '$edit'";
		return $this->db->select($sql);
	}

	public function UpdateCourierInfo($post, $update){
		if(isset($post)){
		
		$confirm_pass  				= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['confirm_pass']));

		$confirm_pass = md5($confirm_pass);

		$courier_admin_email  		= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['courier_admin_email']));
		
	 	$company_name  				= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['company_name']));

		$author_name  				= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['author_name']));

		$address  					= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['address']));

		$mobile  					= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['mobile']));

		$update = "UPDATE courier_info SET confirm_pass='$confirm_pass', courier_admin_email='$courier_admin_email', company_name='$company_name', author_name='$author_name', address='$address', mobile='$mobile' WHERE courier_id='$update'";
		$query = $this->db->insert($update);
		if(isset($query)){
			$msg = "Data Updated Successfully";
			//header("refresh:1; url=donar_reg_info.php?success=1");
			echo("<script>location.href = 'admin-company-list.php?msg=$msg';</script>");
		}

		}

	}

//contact list view

	public function ContactUsQuery(){

		$sql = "SELECT * FROM contact";
		return $this->db->select($sql);
	}	


//select courier company for admin-orders-view.php

	public function CompanyView(){
		$sql = "SELECT * FROM courier_info";
		return $this->db->select($sql);
		exit();
	}

public function ParcentageAdd($post){

		$date		= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['date']));
		$courier_id	= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['courier_id']));
		$parcentage = mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['parcentage']));

			$sql = "UPDATE parcentage SET parcentage = '$parcentage' WHERE courier_id = '$courier_id' AND date = '$date'";
			$query = $this->db->insert($sql);

}		

//Select from parcentage table

	public function ParcentageDataView($post){

		$date		= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['date']));
		$courier_id	= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['courier_id']));

		if(empty($date) || empty($courier_id)){
			echo "<h5 class='alert alert-danger'>"."Feild must not be empty"."</h5>";			
		}else{
		$sql = "SELECT * FROM parcentage WHERE date = '$date' AND courier_id = '$courier_id'";
		$data = $this->db->select($sql);

		if($data==true){
			echo "<h5 class='alert alert-success'>"."Search is successfully completed"."</h5>";
			return $data;
			exit();			
		}else{
			echo "<h5 class='alert alert-warning'>"."No search in directory"."</h5>";
			return false;			
		}
		}

	}


public function total_profit($post){
$date		= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['date']));
$courier_id	= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['courier_id']));
	if(!empty($courier_id) AND !empty($date)){
			$query = "select sum(cost) FROM parcentage WHERE courier_id='$courier_id' AND date='$date'";

	$inserPro = $this->db->select($query);
	return $inserPro;
	}
}



}

?>