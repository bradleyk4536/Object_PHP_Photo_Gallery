<?php
	class Db_object {

//		find all records in table
		public static function find_all(){
//
			return self::find_this_query("SELECT * FROM " . self::$db_table . " ");
		}
//		find record from table using the id
		public static function find_by_id($id) {
//			make database global so we can use the query_db method in Database class
			global $database;
			$user_id = $database->escape_string($id);
			$result_array = self::find_this_query("SELECT * FROM " . self::$db_table . " WHERE id = $user_id LIMIT 1 ");
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
	}
?>
