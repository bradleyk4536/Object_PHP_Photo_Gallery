<?php include("init.php"); ?>


<?php
//	check to see if user is signed in. If so redirect to index.php
	if($session->is_signed_in){ redirect("index.php"); }

if(isset($_POST['submit'])) {

	$username = trim($_POST['username']); //from form username input
	$password = trim($_POST['password']); //from form password input

	//static method in user class to get user from database.
	$user_found = User::verify_user($username, $password);

	if($user_found) {
		$session->login($user_found);
		redirect("index.php");

	} else {
		$the_message = "Your password or username are incorrect";

	  } else {
//			neutralize variables so you dont get undeclared variables error if empty
			$username = "";
			$password = "";
		 }
}
?>
