<?php include("includes/header.php"); ?>


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

	  }
} else {
//			neutralize variables so you dont get undeclared variables error if empty
			$username = "";
			$password = "";
		 }
?>

<div class="col-md-4 col-md-offset-3">
<h4 class="bg-danger"></h4>
	<form id="login-id" action="" method="post">

		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" class="form-control" name="username" value="" >

		</div>

		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" class="form-control" name="password" value="">

		</div>


		<div class="form-group">
		<input type="submit" name="submit" value="Submit" class="btn btn-primary">

		</div>
	</form>
</div>
