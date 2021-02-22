<?php
include_once('classes/delete.php');
$AllDelete = new AllDelete();	


if(isset($_GET['Courier_list_delete'])){
	$Courier_list_delete = $_GET['Courier_list_delete'];
	$AllDelete->DeleteCourierList($Courier_list_delete);
}

if(isset($_GET['parcelDelete'])){
$parcelDelete = $_GET['parcelDelete'];
$AllDelete->ParcelDetailsDelete($parcelDelete);

}

if(isset($_GET['contact_info_del'])){
$contact_info_del = $_GET['contact_info_del'];
$AllDelete->ContactViewDelete($contact_info_del);
}

if(isset($_GET['user_req_del'])){
$user_req_del = $_GET['user_req_del'];
$AllDelete->UserRequestDelete($user_req_del);

}

if(isset($_GET['req_del_from_user'])){
$req_del_from_user = $_GET['req_del_from_user'];
$AllDelete->UserRequestDeleteUserPage($req_del_from_user);	
}