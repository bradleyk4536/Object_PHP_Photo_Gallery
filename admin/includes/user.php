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
		public $errors = array();
		public $upload_errors_array = array(
			UPLOAD_ERR_OK => "There is no error",
			UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize directive",
			UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive",
			UPLOAD_ERR_PARTIAL => "The uploaded file was only partial uploaded",
			UPLOAD_ERR_NO_FILE => "No file was uploaded",
			UPLOAD_ERR_NO_TMP_DIR => "Missing a temporay folder",
			UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk",
			UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload."
		);

		//		Pass $_FILES['uploaded_file'] as an argument
		public function set_file($file){
//			test to see if file exists if not echo and return false
			if(empty($file) || !$file || !is_array($file)) {
				$this->errors[] = "There is no file uploaded here";
				return false;
			} elseif($file['error'] != 0 ) {

				$this->errors[] = $this->upload_errors_array[$file['error']];
				return false;
			} else {
//				if no errors are present then set values
//				assign key from super global returns just the name of file
				$this->user_image = basename($file['name']);
				$this->tmp_path = $file['tmp_name'];
				$this->type = $file['type'];
				$this->size = $file['size'];
			}
		}
		public function upload_photo() {
//			do some error checking to see if photo exists if so just update
//				check errors array to see if it is empty
				if(!empty($this->errors)) {
					return false;
				}
				if(empty($this->user_image) || empty($this->tmp_path)) {
					$this->errors[] = "The file is not available";
					return false;
				}
//				target path permanent location of images
				$target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->user_image;
//				check to see if file exists in images folder
				if(file_exists($target_path)) {
					$this->errors[] = "The file {$this->user_image} already exists";
					return false;
				}
//				move file from super global temp location to target path location
				if(move_uploaded_file($this->tmp_path, $target_path)) {
						unset($this->tmp_path);
						return true;
				} else {
					$this->errors[] = "You do not have permission to save file";
					return false;
				}

			}

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
