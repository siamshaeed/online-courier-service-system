<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Controller.php");

class AllDelete extends Controller{

	public function __construct(){
		parent::__construct();
	}

	public function DeleteCourierList($courier_id){
		if(isset($courier_id)){
			$sql="DELETE FROM courier_info WHERE courier_id='$courier_id'";
			$query = $this->db->insert($sql);

			if($query){
				$msg = "Data Deleted Successfully";
				//header("refresh:1; url=donar_reg_info.php?success=1");
				echo("<script>location.href = 'admin-company-list.php?delete=$msg';</script>");
			}

		}
	}

//parceldetails table deletes
	public function ParcelDetailsDelete($parcelDelete){

			$sql="DELETE FROM parceldetails WHERE id='$parcelDelete'";
			$query = $this->db->insert($sql);	
			
			if($query){
				$msg = "Data Deleted Successfully";
				//header("refresh:1; url=donar_reg_info.php?success=1");
				echo("<script>location.href = 'Company_branch.php?delete=$msg';</script>");
			}
	}

//Contact view delete
	public function ContactViewDelete($contact_info_del){

			$sql="DELETE FROM contact WHERE id='$contact_info_del'";
			$query = $this->db->insert($sql);	
			
			if($query){
				$_SESSION['msg'] = "<h5 class='alert alert-success'>You are successfully Delete</h5>";
				header("Location: admin_contact_us_view.php");
				exit();
			}
	}

//delete user request for parcelorder table
	public function UserRequestDelete($user_req_del){

		if(!empty($user_req_del)){
			$sql="DELETE FROM userorder WHERE id='$user_req_del'";
			$query = $this->db->insert($sql);	
			
			if($query){
				$_SESSION['delete_msg'] = "<h5 class='alert alert-success'>Data is successfully delete</h5>";
				header("Location: Company_request.php");
				exit();
			}			
		}

	}

//delete user request for user profile page

public function UserRequestDeleteUserPage($req_del_from_user){

		if(!empty($req_del_from_user)){
			$sql="DELETE FROM userorder WHERE id='$req_del_from_user'";
			$query = $this->db->insert($sql);	
			
			if($query){
				$_SESSION['msg'] = "<h5 class='alert alert-success'>Parcel Request is successfully delete</h5>";
				header("Location: user-profile.php");
				exit();
			}			
		}

}

}

