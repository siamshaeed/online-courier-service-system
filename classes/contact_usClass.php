<?php $filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Controller.php");
class Contact extends Controller{
	public function __construct(){
		parent::__construct();
	}

public function ContactUs($post){

if(!empty($post)){

	echo $name			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['name']));

	echo $email 			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['email']));

	echo $phone 			= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['phone']));

	echo $company 		= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['company']));

	echo $message   		= mysqli_real_escape_string($this->db->link, $this->fm->sanitize($post['message']));

		if(empty($name) || empty($email) || empty($phone) || empty($company) || empty($message)){

			$_SESSION['msg'] ="<h5 class='alert alert-danger'>"."Feild must not be empty"."</h5>";;
			header("Location: contact-us.php");
			exit();	

		}else{
		$sql = "INSERT INTO contact(name,email,phone,company,message) VALUES('$name', '$email', '$phone', '$company', '$message')";
		var_dump($sql);
		$insert = $this->db->insert($sql);
		var_dump($insert);

			if($insert){
			$_SESSION['msg'] ="<h5 class='alert alert-success'>"."Data inserted successfully"."</h5>";
			header("Location: contact-us.php");	
			exit();		
			}
		}
	}
}
}