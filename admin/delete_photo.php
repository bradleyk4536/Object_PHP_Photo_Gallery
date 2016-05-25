<?php include("includes/init.php"); ?>

<?php if(!$session->is_signed_in()) { redirect("login.php"); } ?>

<?php
//check to see if photo is there
if(empty($_GET['photo_id'])) {

	redirect("photos.php");
}
//call photo class find_by_id method
$photo = Photo::find_by_id($_GET['photo_id']);

//test to see if photo id was gotten, if so delete if not redirect back to photos.php
if($photo) {

	$photo->delete_photo();
} else {

	redirect("photos.php");
}

?>
