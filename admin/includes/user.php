<?php
	class User {

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
			$result_set = self::find_this_query("SELECT * FROM users WHERE id = $user_id LIMIT 1 ");
			$found_user = mysqli_fetch_array($result_set);
			return $found_user;
		}
//			query table to get results
		private static function find_this_query($sql){
//			make database global so we can use the query_db method in Database class
			global $database;

			$result_set = $database->query_db($sql);
			return $result_set;
		}
	}
?>
