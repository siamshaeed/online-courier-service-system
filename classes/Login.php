<?php

$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/Controller.php');
include_once($filepath.'/../lib/Session.php');
Session::check_login();

class Login extends Controller{
	public function __construct(){
		parent::__construct();
	}

	public function user_login($post){
		if(isset($post)){

		$user_name = mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['user_name'])); 

		$password = mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['confirm_pass']));

		$password = md5($password);
	
		if($user_name=='' || $password==''){
					echo "Feild Must not be empty";
				}		
		if(@$post['user'] == 'user'){
			$query = "SELECT * FROM user_registration WHERE user_name = '$user_name' and confirm_pass ='$password' LIMIT 1";
			$get_th = $this->db->select($query);
			if($get_th != false){
						$value = $get_th->fetch_assoc();
						Session::set('login_status', true);
						//Session::set('userID', $value['id']);
						Session::set('user_id', $value['user_id']);
						Session::set('user_name', $value['user_name']);
						Session::set('fname', $value['fname']);
						Session::set('lname', $value['lname']);
						Session::set('mobile', $value['mobile']);
						//Session::set('designation', $value['designation']);
						//Session::set('mobile', $value['mobile']);
						//Session::set('email', $value['email']);
						//Session::set('dept', $value['dept']);
						//Session::set('gender', $value['gender']);
						//Session::set('address', $value['address']);
						//Session::set('password', $value['password']);
						Session::set('userRole', 'user');
						Session::set('loginmsg', 'You have successfully loggedIn');
						echo '<script type="text/javascript">';
			            echo 'window.location.href="profile.php"';
			            echo '</script>';
			            //$msg = "you have successfully login " ;
			            //return $msg;
	            exit;				
			}
		}




	}
	}

	public function courier_login($post){

		if(isset($post)){
		$courier_id = mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['courier_id']));	

		 $password = mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['confirm_pass']));

		$password = md5($password);
		if (empty($courier_id) || empty($password)) {
			echo "Feild Must not be empty";
		}

		if(@$post['courier'] == 'courier'){
			$query = "SELECT * FROM courier_info WHERE courier_id = '$courier_id' and confirm_pass ='$password' LIMIT 1";
			$get_th = $this->db->select($query);
			if($get_th != false){
						$value = $get_th->fetch_assoc();
						Session::set('login_status', true);
						Session::set('userID', $value['courier_id']);
						Session::set('company_name', $value['company_name']);
						Session::set('uploaded_image', $value['image']);
						Session::set('userRole', 'courier');
						Session::set('loginmsg', 'You have successfully loggedIn');
						echo '<script type="text/javascript">';
			            echo 'window.location.href="profile.php"';
			            echo '</script>';
			            //$msg = "you have successfully login " ;
			            //return $msg;

	            exit;				
			}
		}
		}
	}

	public function AdminLogin($post){

		if(isset($post)){
		$email = mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['email']));	

		 $password = mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['confirm_pass']));

		$password = md5($password);
		if (empty($email) || empty($password)) {
			echo "Feild Must not be empty";
		}

		if(@$post['admin'] == 'admin'){
			$query = "SELECT * FROM admin WHERE admin_email = '$email' and confirm_pass ='$password' LIMIT 1";
			$get_th = $this->db->select($query);
			if($get_th != false){
						$value = $get_th->fetch_assoc();
						Session::set('login_status', true);
						Session::set('adminEmail', $value['admin_email']);
		/*				Session::set('teacher_id', $value['t_id']);
						Session::set('first_name', $value['first_name']);
						Session::set('last_name', $value['last_name']);
						Session::set('join_date', $value['join_date']);*/
						//Session::set('designation', $value['designation']);
						//Session::set('mobile', $value['mobile']);
						//Session::set('email', $value['email']);
						//Session::set('dept', $value['dept']);
						//Session::set('gender', $value['gender']);
						//Session::set('address', $value['address']);
						//Session::set('password', $value['password']);
						Session::set('userRole', 'Admin');
						Session::set('loginmsg', "<h5 class='alert alert-success'>You are successfully loggedIn</h5>");
						echo '<script type="text/javascript">';
			            echo 'window.location.href="profile.php"';
			            echo '</script>';
			            //$msg = "you have successfully login " ;
			            //return $msg;

	            exit;				
			}
		}
		}

	}	

}