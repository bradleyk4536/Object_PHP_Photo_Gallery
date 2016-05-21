<?php include("includes/header.php"); ?>
<!--check to see if user is logged in. If not use redirect function.php back to login page-->
<?php if(!$session->is_signed_in) { redirect("login.php"); } ?>
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

	<?php include("includes/admin_content.php"); ?>

<!-- /#page-wrapper -->

  	<?php include("includes/footer.php"); ?>
