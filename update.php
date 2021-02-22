<?php
include_once('classes/update_company_profile_class.php');
$UpdateClass = new UpdateClass();

if(isset($_GET['msg'])){
	$id 						= $_GET['msg'];
	$accept 					= "accept";
	$color 						= "#145120";
	$accept_bg_class			= "btn-success";	
	$UpdateClass->UpdateDecision($id, $accept, $color, $accept_bg_class);

}

if(isset($_GET['user_req_del'])){
$user_req_del = $_GET['user_req_del'];	
$UpdateClass->DoneQuery($user_req_del);
}

?>