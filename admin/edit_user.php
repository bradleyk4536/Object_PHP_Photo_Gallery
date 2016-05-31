<?php include("includes/header.php"); ?>

<?php if(!$session->is_signed_in()) { redirect("login.php"); } ?>
<?php
$messages="";
if(empty($_GET['id'])) {

	redirect("users.php");
}

$user = User::find_by_id($_GET['id']);
if(isset($_POST['submit'])) {
	if($user) {

		$user->username = $_POST['username'];
		$user->first_name = $_POST['first_name'];
		$user->last_name = $_POST['last_name'];
		$user->password = $_POST['password'];

		//$user->password = password_hash($user->password, PASSWORD_BCRYPT, array('cost => 12'));
		if(empty($_FILES['user_image'])) {

			$user->save();
			$session->message("The user has been updated");
			redirect("users.php");
		} else {

			$user->set_file($_FILES['user_image']);
			$user->upload_photo();
			$user->save();
			//redirect("edit_user.php?id={$user->id}");
			$session->message("The user has been updated");
			redirect("users.php");

		}
	}
}
?>
<?php include("includes/photo_modal.php"); ?>
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
					<div class="col-md-6 user_image_box">
						<?php include("includes/success_message"); ?>
<!--						MODAL SETUP -->
						<a href="#"data-toggle="modal" data-target="#photo-modal"><img class="img-responsive" src="<?php echo $user->image_placeholder(); ?>" alt=""></a>
					</div>

					<form action="" method="post" enctype="multipart/form-data">
						<div class="col-md-6">
							<div class="form-group">
								<input type="file" name="user_image">
							</div>
							<div class="form-group">
								<label for="username">Username</label>
								<input type="text" name="username" class="form-control" value="<?php echo $user->username; ?>">
							</div>
							<div class="form-group">
								<label for="first-name">First Name</label>
								<input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>">
							</div>
							<div class="form-group">
								<label for="last_name">Last Name</label>
								<input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name; ?>">
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" name="password" class="form-control" value="<?php echo $user->password; ?>">
							</div>
							<div class="form-group pull-right">
							<a href="delete_user.php?id=<?php echo $user->id; ?>" id="user-id" class="btn btn-danger">Delete</a>
							<input type="submit" class="btn btn-success" name="submit" value="Update User" >

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
