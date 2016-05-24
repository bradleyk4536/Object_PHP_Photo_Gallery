<?php
	class Photo extends Db_object {

		protected static $db_table = "photos";
		protected static $db_table_fields = array('photo_id', 'title', 'description', 'filename', 'type', 'size');
		public $photo_id;
		public $title;
		public $description;
		public $filename;
		public $type;
		public $size;
//		file properties
		public $tmp_path;
		public $upload_directory = "images";
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
				$this->filename = basename($file['name']);
				$this->tmp_path = $file['tmp_name'];
				$this->type = $file['type'];
				$this->size = $file['size'];
			}
		}
//		dynamic image dirctory
		public function picture_path() {
			return $this->upload_directory.DS.$this->filename;
		}

		public function save() {

//			do some error checking to see if photo exists if so just update
			if($this->photo_id) {

				$this->update();

			} else {
//				check errors array to see if it is empty
				if(!empty($this->errors)) {
					return false;
				}

				if(empty($this->filename) || empty($this->tmp_path)) {
					$this->errors[] = "The file is not available";
					return false;
				}
//				target path permanent location of images

				$target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;

//				check to see if file exists in images folder

				if(file_exists($target_path)) {
					$this->errors[] = "The file {$this->filename} already exists";
					return false;
				}

//				move file from super global temp location to target path location
				if(move_uploaded_file($this->tmp_path, $target_path)) {

					if($this->create()) {
						unset($this->tmp_path);
						return true;
					}
				} else {

					$this->errors[] = "You do not have permission to save file";
					return false;
				}

			}


		}

	} //end class
?>
