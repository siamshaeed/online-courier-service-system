<?php
include_once("Database.php");
include_once("helpers/Format.php");

class Controller{
	public $db;
	public $fm;
	public $msg;
	public $error;

	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}

}