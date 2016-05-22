<?php
	class User {
		public $id;
		public $username;
		public $password;
		public $first_name;
		public $last_name;
//		find and display all users in users table
		public static function find_all_users(){
//
			return self::find_this_query("SELECT * FROM users");
		}
//		find a user from database using the id
		public static function find_user_by_id($id) {
//			make database global so we can use the query_db method in Database class
			global $database;
			$user_id = $database->escape_string($id);
			$result_array = self::find_this_query("SELECT * FROM users WHERE id = $user_id LIMIT 1 ");
//			check to see if array is populated if so return just the first item
			return !empty($result_array) ? array_shift($result_array) : false;
		}
//			query table to get results
		public static function find_this_query($sql){
//			make database global so we can use the query_db method in Database class
			global $database;

			$result_set = $database->query_db($sql);
//			empty array for objects
			$the_object_array = array();
//			get table info for each row in table
			while($row = mysqli_fetch_array($result_set)) {
				$the_object_array[] = self::instantation($row);
			}
			return $the_object_array;
		}
//for the login.php
		public static function verify_user($username, $password) {
			global $database;

			$username = $database->escape_string($username);
			$password = $database->escape_string($password);

			$sql = "SELECT * FROM users WHERE ";
			$sql .= "username = '{$username}' ";
			$sql .= "AND password = '{$password}' ";
			$sql .= "LIMIT 1";

			$result_array = self::find_this_query($sql);
//			check to see if array is populated if so return just the first item
			return !empty($result_array) ? array_shift($result_array) : false;

		}

//		auto instantiation of user object
		public static function instantation($the_record) {
//			create object User
			$the_object = new self;
			foreach($the_record as $the_attribute => $value) {
				if($the_object ->has_the_attribute($the_attribute)) {
					$the_object->$the_attribute = $value;
				}
			}
			return $the_object;
		}
		private function has_the_attribute($the_attribute) {
//			get all the properties of a object/class
			$object_properties = get_object_vars($this);
//			checks to see if a given key exists in array returns true if so
			return array_key_exists($the_attribute, $object_properties);
		}

		public function create(){
			global $database;
			$sql = "INSERT INTO users (username, password, first_name, last_name) ";
			$sql .= "VALUES ('";
			$sql .= $database->escape_string($this->username) . "', '";
			$sql .= $database->escape_string($this->password) . "', '";
			$sql .= $database->escape_string($this->first_name) . "', '";
			$sql .= $database->escape_string($this->last_name) . "')";
//test for success
			if($database->query_db($sql)) {
				$this->id = $database->the_insert_id();
				return true;
		} else {
				return false;
			}
		}

		public function update() {
			global $database;

			$sql = "UPDATE users SET ";
			$sql .= "username = '" . $database->escape_string($this->username) . "', ";
			$sql .= "password = '" . $database->escape_string($this->password) . "', ";
			$sql .= "first_name = '" . $database->escape_string($this->first_name) . "', ";
			$sql .= "last_name = '" . $database->escape_string($this->last_name) . "' ";
			$sql .= " WHERE id = " . $database->escape_string($this->id);

			$database->query_db($sql);


//			test for modification
		return (mysqli_affected_rows($database->connection) == 1) ? true : false;
			//return ($database->connection->affected_rows($database->connection) == 1) ? true : false;
		}
	} //END OF USER CLASS


?>
