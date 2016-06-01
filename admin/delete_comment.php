<?php include("includes/init.php"); ?>
<?php if(!$session->is_signed_in()) { redirect("login.php"); } ?>
<?php
//check to see if photo is there
if(empty($_GET['id'])) {

	redirect("comments.php");
}
//call photo class find_by_id method
$comment = Comment::find_by_id($_GET['id']);

//test to see if photo id was gotten, if so delete if not redirect back to photos.php
if($comment) {
	$comment->delete();
	redirect("comments.php");
	$session->message("Comment has been deleted");
} else {
	redirect("comments.php");
}
?>
