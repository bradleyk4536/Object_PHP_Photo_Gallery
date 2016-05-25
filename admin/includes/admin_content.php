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
//				  		My way of doing it for section 77 challenge
//				  		$new_user = new User();
//
//				  		$new_user->username = "hiphopster10";
//				  		$new_user->password = "password";
//				  		$new_user->first_name = "MarshaMarshaMarsha";
//				  		$new_user->last_name = "Brady";
//				  		$new_user->save();
//
//				  		$new_user->create();
//				  static method no need to instantiate
//				  		$new_user = User::find_by_id(4);
//
//				  		$new_user->username = "JONES";
//
//				  		$new_user->update();
//



//						$new_user->find_by_id(2);
//
//				  		$new_user->last_name = "WILLIAMS";
//
//				  		$new_user->update();

//				  		$user = User::find_user_by_id(11);
//
//
//				  		$user->password = "bigMike";
//
//				  		$user->save();

//				  		$updateuser = User::find_user_by_id(5);
//
//				  		$updateuser->delete();

				  		$photos = Photo::find_by_id(9);

							echo $photos->filename . "<br>";


//				  		$photos = Photo::find_all();
//				  		foreach($photos as $photo) {
//							echo $photo->title;
//						}

//				  		$new_photo = new Photo();
//
//				  		$new_photo->title = "Camp ground Boy";
//				  		$new_photo->description = "This is my third photo";
//				  		$new_photo->filename = "photo3.jpg";
//				  		$new_photo->type = ".jpg";
//				  		$new_photo->save();



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
