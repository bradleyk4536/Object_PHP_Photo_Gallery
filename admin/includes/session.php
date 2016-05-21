<?php

class Session() {

	private $signed_in = false;
	public $user_id;

	function __construct(){
//		Start session automatically when class is created
		session_start();
		$this->check_the_login();
	}

	private function check_the_login() {
		//	Check if session user_id is set
		if(isset($_SESSION['user_id'])) {
//			if set assign the user id to $user_id
			$this->user_id = $_SESSION['user_id'];
			$this->signed_in = true;
		} else {
//		destroy the specified variables
			unset($this->user_id);
			$this->signed_in = false;
		}
	}

//	getter method
	public function is_signed_in() { return $this->signed_in; }

	public function login($user) {
/*		test the parameter is available if so assign the id from user class to session id and then to the class user id
*/
		if($user) {
			$this->user_id = $_SESSION['user_id'] = $user->id;
			$this->signed_in = true;
		}
	}

	public function logout(){
//		destroy the specified variables
		unset($_SESSION['user_id']);
		unset($this->user_id);
		$this->signed_in = false;
	}
}
//Create an instance of Session class
$session = new Session();
?>
