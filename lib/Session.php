<?php
	class Session{
		
	public static function init(){

		if(version_compare(phpversion(), '5.3.7', '<')){
			if(session_id() == ''){
				session_start();
			}
		}else{
			if(session_status() == PHP_SESSION_NONE){
				session_start();
			}
		}

	}

/*function init()() {
  if(version_compare(phpversion(), "5.4.0") != -1){
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
  } else {
    if(session_id() == '') {
      session_start();
    }
  }
}*/	

		public static function get($key){
			if(isset($_SESSION[$key])){
				return $_SESSION[$key];
			}else{
				return false;
			}
		}


		public static function set($key, $value){
			$_SESSION[$key] = $value;
		}


		public static function check_login(){
			self::init();
			if(self::get('login_status') == true){
				header('Location: profile.php');
			}
		}

		public static function destroy(){
			session_destroy();
			header('Location: index.php');
			exit();
			//$msg = "You have successfully logout";
			//return $msg;
		}

		public static function check_session(){
			self::init();
			if(self::get("login_status") == false){
				self::destroy();
	 			header("Location: index.php");
			}
		}		

	}