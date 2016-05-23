<?php
	class User {
		protected static $db_table = "users";
		protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name');
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

		protected function properties() {
//			get all properties of an object
			//return get_object_vars($this);
			$properties = array();
			foreach (self::$db_table_fields as $db_field) {
//				check to see if properties exists
				if(property_exists($this, $db_field)) {
//					property exists so add the value to the field
					$properties[$db_field] = $this->$db_field;
				}
			}
			return $properties;
		}
		protected function clean_properties(){
			global $database;
//			loop through properties method and pull keys and values
			$clean_properties = array();
			foreach($this->properties() as $key => $value) {
				$clean_properties[$key] = $database->escape_string($value);
			}
			return $clean_properties;
		}
//   check to see if user exists before adding if exists just update.
		public function save() {
			return isset($this->id) ? $this->update() : $this->create();
		}

		public function create(){
			global $database;
//			has all the objects properties from get_object_vars();
			$properties = $this->clean_properties();
/*abstraction pull all the keys and values from $properties associative array with implode and separate with comma */
			$sql = "INSERT INTO " . self::$db_table . "(" . implode(",", array_keys($properties)) . ")";
			$sql .= "VALUES ('" . implode("','", array_values($properties)) . "')";
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
//			has all the objects properties from get_object_vars();
			$properties = $this->clean_properties();

			$properties_pairs = array();
//			loop through properties array and pull out the keys and valuse
			foreach($properties as $key => $value) {
				$properties_pairs[] = "{$key}='{$value}'";
			}

			$sql = "UPDATE " .self::$db_table. " SET ";
			$sql .= implode(", ", $properties_pairs);
			$sql .= " WHERE id = " . $database->escape_string($this->id);

			$database->query_db($sql);
//			test for modification
			return (mysqli_affected_rows($database->connection) == 1) ? true : false;
			//return ($database->connection->affected_rows($database->connection) == 1) ? true : false;
		}

		public function delete() {
			global $database;

			$sql = "DELETE FROM " .self::$db_table. " WHERE id = " . $database->escape_string($this->id);
			$sql .= " LIMIT 1";
			$database->query_db($sql);
//			test for modification
			return(mysqli_affected_rows($database->connection) == 1) ? true : false;

		}
	} //END OF USER CLASS


?>
