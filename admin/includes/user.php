<?php
	class User extends Db_object {
		protected static $db_table = "users";
		protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name', 'user_image');
		public $id;
		public $username;
		public $password;
		public $first_name;
		public $last_name;
		public $user_image;
		public $upload_directory = "images";
		public $image_placeholder = "http://placehold.it/400x300&text=image";


		public function image_placeholder(){

			return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory . DS . $this->user_image;
		}
//for the login.php
		public static function verify_user($username, $password) {
			global $database;

			$username = $database->escape_string($username);
			$password = $database->escape_string($password);

			$sql = "SELECT * FROM " . self::$db_table . " WHERE ";
			$sql .= "username = '{$username}' ";
			$sql .= "AND password = '{$password}' ";
			$sql .= "LIMIT 1";

			$result_array = self::find_by_query($sql);
//			check to see if array is populated if so return just the first item
			return !empty($result_array) ? array_shift($result_array) : false;
		}

	} //END OF USER CLASS


?>
