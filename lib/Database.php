<?php
//include_once("config/config.php");

$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../config/config.php");

class Database{

	public $DB_HOST = DB_HOST;
	public $DB_USER = DB_USER;
	public $DB_PASS = DB_PASS;
	public $DB_NAME = DB_NAME;

	public $link;
	public $error;

	public function __construct(){
		$this->connectdb();
	}

	public function connectdb(){
		$this->link = new mysqli($this->DB_HOST, $this->DB_USER, $this->DB_PASS, $this->DB_NAME);

		if(!$this->link){
			$error = "connection_error".$this->link->connect_error;
			return false;
		}

	}

	public function select($query){
		$result = $this->link->query($query) or die($this->link->error.__LINE__);
		if($result->num_rows > 0){
			return $result;
		}else{
			return false;
		}
	}

//student table insert data


 public function insert( $query ){
  $insert_row = $this->link->query( $query ) or die( $this->link->error.__LINE__ );
  if( $insert_row ){
   return $insert_row;
  }else{
   return false;
  }
 }

  

}