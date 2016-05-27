<?php
	class Comment extends Db_object {
		protected static $db_table = "comments";
		protected static $db_table_fields = array('id', 'photo_id', 'author', 'body');
		public $id;
		public $photo_id;
		public $author;
		public $body;
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

//self instantiation comment method

		public static function create_comment($photo_id, $author="John Dow", $body=""){
			global $database;
//			test to see if $photo_id, author and body are present
			if(!empty($photo_id) && !empty($author) && !empty($body)) {

//				create object
				$comment = new Comment();
//				assign values to newly created object
				$comment->photo_id 	= $database->escape_string((int)$photo_id); //make sure it is with (int)
				$comment->author 		= $database->escape_string($author);
				$comment->body 		= $database->escape_string($body);

//				return the comment object
				return $comment;
			} else {
				return false;
			}
		}

		public static function find_the_comments($photo_id=0){
			global $database;
//			find comment by photo id
			$sql = "SELECT * FROM " . self::$db_table;
			$sql .= " WHERE photo_id = " . $database->escape_string($photo_id);
			$sql .= " ORDER BY photo_id ASC";

			return self::find_by_query($sql);
		}

	} //END OF USER CLASS


?>
