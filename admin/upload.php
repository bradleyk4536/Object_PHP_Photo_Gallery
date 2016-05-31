<?php include("includes/header.php"); ?>

<?php if(!$session->is_signed_in()) { redirect("login.php"); } ?>

<?php
	$message="";
	if(isset($_FILES['file'])) {

		$photo = new Photo();
//		grab title from form
		$photo->title = $_POST['title'];
//		grab the file from the super global
		$photo->set_file($_FILES['file']);
//		test to see if photo is saved method returns true if saved false if not
		if($photo->save()){

			$message = "Photo Uploaded Successfully";
		} else {

			$message = join("<br>", $photo->errors);
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
<?php
	echo $message;
?>
			  <div class="col-lg-12">
					<h1 class="page-header">
						 Photo Upload
					</h1>
					<div class="row">
					<div class="col-md-6">

						<form action="upload.php" method="post" enctype="multipart/form-data">

						<div class="form-group">
							<input class="form-control" type="text" name="title">
						</div>
						<div class="form-group">
							<input type="file" name="file">

						</div>
						<input class="btn btn-success" type="submit" name="submit" value="submit">
					</form>

					</div>
					</div> <!--end of row-->
					<div class="row">
						<div class="col-lg-12">
							<form action="upload.php" class="dropzone">

							</form>
						</div>
					</div>

			  </div>
		 </div>
		 <!-- /.row -->

	</div>
	<!-- /.container-fluid -->

</div>

<!-- /#page-wrapper -->

  	<?php include("includes/footer.php"); ?>
