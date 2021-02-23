<?php
//ob_start();
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Controller.php");

class All_User_reg extends Controller{

	public function __construct(){
		parent::__construct();
	}
	

	public function User_reg($post){
		if(isset($post)){

		$user_email			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['user_email']));

		$chk_email = $this->check_email($user_email);		

		$fname				= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['fname']));	

		$lname				= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['lname']));	

		$user_name			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['username']));	

		$chk_user_name = $this->check_user_name($user_name);		

		$address			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['address']));	

		$gender				= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['gender']));	

		$date_of_birth		= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['date']));	

		$mobile				= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['mobile']));	

		$password		= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['password']));
		$password = md5($password);
		//$passwrod = passwrod_hash($password, PASSWORD_DEFAULT, ['cost' => 11]);
		//password_hash($password, PASSWORD_DEFAULT);


		if(empty($fname) || empty($lname) || empty($user_name) || empty($address) || empty($gender) || empty($date_of_birth) || empty($mobile) || empty($password)){
			echo "<h3>"."Feild must not be empty"."</h3>";
		}if ($chk_email == false) {
			echo $msg = "<h3>"."Email already exists"."</h3>";  
		}if ($chk_user_name == false){
			echo $msg = "<h3>"."UserName already exists"."</h3>";  
		}

		else{
			$sql = "INSERT INTO user_registration(email, fname, lname, user_name, address, gender, date, mobile, confirm_pass) VALUES('$user_email', '$fname', '$lname', '$user_name', '$address', '$gender', '$date_of_birth', '$mobile', '$password')";

			$insert = $this->db->insert($sql);
			if(isset($insert)){
				 $msg="you are successfully registered";
				//header('Location: user-login.php');
				echo("<script>location.href = 'user-login.php?msg=$msg';</script>");
				/*else{
					echo "<script language='javascript' type='text/javascript'>";
					echo "alert('you are successfully registered');";
					echo "</script>";

					$URL="user-login.php";
					echo "<script>location.href='$URL'</script>";
				 }						*/
			}			
		}

		}
	}

	public function check_email($email){
		if(!empty($email)){
				$query = "SELECT email FROM user_registration WHERE email='$email'";
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


	public function check_user_name($user_name){
		if(!empty($user_name)){
				$query = "SELECT * FROM user_registration WHERE user_name='$user_name'";
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

    public function InsertUserOrder($post, $user_id){

		if(isset($post)){

			$user_id 			= $user_id;
			$fname 				= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['fname']));
			
			$lname 				= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['lname']));
			
			$email 				= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['email']));
			
			$phone 				= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['phone']));

			$date       		= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['date']));
			
			$address 			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['address']));

			$courier_id			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['courier_id']));			

			$fromDivId			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['fromDivId']));

			$fromDisId			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['fromDisId']));

			$fromUzlaId			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['fromUzlaId']));

			$fromBranchName			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['fromBranchName']));			

			$toDivId			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['toDivId']));

			$toDisId			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['toDisId']));

			$toUzlaId			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['toupailaID']));

			$toBranchName			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['toBranchName']));			
			
			$serviceType		= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['serviceType']));

			$parcelType			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['parcelType']));
			
			if($parcelType==2){

				$weight			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['weight']));

			}else{

				$weight = 0;
			}

			$paymentType       = mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['paymentType']));

			$cost       = mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['cost']));

			$request 			= "Send Request";
			$color_combination	= "#f00";
			$accept_bg_class 	= "btn-warning";
			$done_clr 			= "btn-warning";

			if(empty($fname) || empty($lname) || empty($email) || empty($phone) || empty($date) || empty($address) || empty($fromDivId) || empty($fromDisId) || empty($fromUzlaId) || empty($toDivId) || empty($toDisId) || empty($toUzlaId) || empty($courier_id) || empty($serviceType) || empty($parcelType) || empty($fromBranchName) || empty($toBranchName) || empty($paymentType) || empty($cost)){

				$_SESSION['msg'] ="<h5 class='alert alert-danger'>"."Feild must not be empty"."</h5>";;
				header("Location: order-details.php");
				exit();	

			}else{

				$sql = "INSERT INTO userorder(user_id, fname, lname, email, phone, date, address, 	courier_id, fromDivId, fromDisId, fromUzlaId, fromBranchId, toDivId, toDisId, toUzlaId, toBranchId, serviceType, parcelType, parcel_weight, payment_type, cost, request, color_combination, accept_bg_class, done_clr) 

					VALUES('$user_id', '$fname', '$lname', '$email', '$phone', '$date', '$address', '$courier_id', '$fromDivId', '$fromDisId', '$fromUzlaId', '$fromBranchName', '$toDivId', '$toDisId', '$toUzlaId', '$toBranchName', '$serviceType', '$parcelType', '$weight', '$paymentType', '$cost', '$request', '$color_combination', '$accept_bg_class', '$done_clr')";				  
				 $select = $this->db->insert($sql);
				 if(!empty($select)){
				 	$_SESSION['msg'] ="<h5 class='alert alert-success'>"."Data inserted successfully"."</h5>";
				 	header("Location: user-profile.php");
				 	exit();
				 }
				//var_dump($select);
			}

		}
}

public function ViewUserRequest($user_id){

	if(!empty($user_id)){
		$query = "SELECT * FROM userorder WHERE user_id='$user_id'";
		return $check_mail = $this->db->select($query);
	}
}

public function ViewCourierName($courier_id){

	if(!empty($courier_id)){
		$query = "SELECT * FROM courier_info WHERE courier_id = '$courier_id'";
		return $data = $this->db->select($query);
	}

}

}
