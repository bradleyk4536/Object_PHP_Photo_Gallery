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

//self instantiation comment methd

		public static function create_comment($photo_id, $author="John Dow", $body=""){
//			test to see if $photo_id, author and body are present
			if(!empty($photo_id) && !empty($author) && !empty($body)) {

//				create object
				$comment = new Comment();
//				assign values to newly created object
				$comment->photo_id 	= (int)$photo_id; //make sure it is with (int)
				$comment->author 		= $author;
				$comment->body 		= $body;

//				return the comment object
				return $comment;
			} else {
				return false;
			}
		}

	} //END OF USER CLASS


?>
