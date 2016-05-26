<?php include("includes/header.php"); ?>

<?php if(!$session->is_signed_in()) { redirect("login.php"); } ?>
<?php
$messages="";
if(isset($_POST['submit'])) {
	$user = new User();
	if($user) {

		$user->username = $_POST['username'];
		$user->first_name = $_POST['first_name'];
		$user->last_name = $_POST['last_name'];
		$user->password = $_POST['password'];

		//$user->password = password_hash($user->password, PASSWORD_BCRYPT, array('cost => 12'));

		$user->set_file($_FILES['user_image']);

		if($user->save_user_and_image()) {

			$messages="New user added";
		} else {

			$messages=join("<br>", $user->errors);
		}
	}
}
?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

	<!-- Brand and toggle get grouped for better mobile display -->

	<?php include("includes/top_nav.php"); ?>

	<!--	End top navigation-->

	<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->

	<?php include("includes/side_nav.php"); ?>

	<!--	End sidebar-->

	<!-- /.navbar-collapse -->
</nav>
	<div id="page-wrapper">

	<div class="container-fluid">

		 <!-- Page Heading -->
		 <div class="row">
			  <div class="col-lg-12">
					<h1 class="page-header">
						 Photo Gallery
						 <small>Subheading</small>
					</h1>
					<?php echo $messages; ?>
					<form action="add_user.php" method="post" enctype="multipart/form-data">
						<div class="col-md-6 col-md-offset-3">
							<div class="form-group">
								<input type="file" name="user_image">
							</div>
							<div class="form-group">
								<label for="username">Username</label>
								<input type="text" name="username" class="form-control">
							</div>
							<div class="form-group">
								<label for="first-name">First Name</label>
								<input type="text" name="first_name" class="form-control">
							</div>
							<div class="form-group">
								<label for="last_name">Last Name</label>
								<input type="text" name="last_name" class="form-control">
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" name="password" class="form-control">
							</div>
							<div class="form-group pull-right">
							<input type="submit" class="btn btn-success" name="submit" value="Save User">
							</div>
						</div>


					</form>

			  </div>

		 </div>
		 <!-- /.row -->

	</div>
	<!-- /.container-fluid -->

</div>

<!-- /#page-wrapper -->

  	<?php include("includes/footer.php"); ?>
