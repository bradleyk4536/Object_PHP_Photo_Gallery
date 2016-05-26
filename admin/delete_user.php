<?php include("includes/init.php"); ?>

<?php if(!$session->is_signed_in()) { redirect("login.php"); } ?>

<?php
//check to see if photo is there
if(empty($_GET['id'])) {

	redirect("users.php");
}
//call photo class find_by_id method
$user = User::find_by_id($_GET['id']);

//test to see if photo id was gotten, if so delete if not redirect back to photos.php
if($user) {
	$user->delete();
	redirect("users.php");
} else {
	redirect("users.php");
}
?>
