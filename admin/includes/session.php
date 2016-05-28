<?php
	class Session {

		private $signed_in = false;
		public $user_id;
		public $message;
		public $session_count;

		function __construct() {
			session_start();
			$this->check_the_login();
			$this->check_message();
			$this->vistor_count();
		}
//		Display amount of view in gallery

		public function vistor_count(){
			if(isset($_SESSION['session_count'])) {
				return $this->session_count = $_SESSION['session_count']++;
			} else {
				return $_SESSION['session_count'] = 1;
			}
		}

//message display method
		public function message($msg="") {

			if(!empty($msg)) {
				$_SESSION['message'] = $msg;
			} else {
				return $this->message;
			}
		}

//method to check if message is set

		private function check_message(){

			if(isset($_SESSION['message'])) {

				$this->message = $_SESSION['message'];
				unset($_SESSION['message']);
			} else {

				$this->message = "";
			}
		}

//		getter method
		public function is_signed_in() {

			return $this->signed_in; //he has a dollar sign on signed_in
		}

		public function login($user) {

			if($user) {

				$this->user_id = $_SESSION['user_id'] = $user->id;
				$this->signed_in = true;
			}
		}

		public function logout(){

			unset($_SESSION['user_id']);
			unset($this->user_id);
			$this->signed_in = false;
		}

		private function check_the_login() {

			if(isset($_SESSION['user_id'])) {

				$this->user_id = $_SESSION['user_id'];
				$this->signed_in = true;
			} else {

				unset($this->user_id);
				$this->signed_in = false;
			}
		}
	}

$session = new Session();
?>
