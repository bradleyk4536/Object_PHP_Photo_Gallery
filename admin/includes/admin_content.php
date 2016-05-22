<div id="page-wrapper">

	<div class="container-fluid">

		 <!-- Page Heading -->
		 <div class="row">
			  <div class="col-lg-12">
					<h1 class="page-header">
						 Blank Page
						 <small>Subheading</small>
					</h1>
					<?php
//				  		My way of doing it for section 77 challenge
				  		$new_user = new User();

				  		$new_user->username = "mikej";
				  		$new_user->password = "password";
				  		$new_user->first_name = "Mike";
				  		$new_user->last_name = "Jones";

				  		$new_user->create();





				  	?>
					<ol class="breadcrumb">
						 <li>
							  <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
						 </li>
						 <li class="active">
							  <i class="fa fa-file"></i> Blank Page
						 </li>
					</ol>
			  </div>
		 </div>
		 <!-- /.row -->

	</div>
	<!-- /.container-fluid -->

</div>
