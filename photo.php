<?php include("includes/header.php"); ?>


<?php
require_once("admin/includes/init.php");
//check to see if id is available. If redirect back to index
if(empty($_GET['id'])){ redirect('index.php'); }

$photo = Photo::find_by_id($_GET['id']);

if(isset($_POST['submit'])) {
//remove spaces with trim
$author = trim($_POST['author']);
$body = trim($_POST['body']);

	$new_comment = Comment::create_comment($photo->id, $author, $body);
//	check for new comment and save
	if($new_comment && $new_comment->save()) {
		redirect("photo.php?id={$photo->id}");
	} else {

		$messages = "Comment not saved";
	}
} else {

	$author = "";
	$body = "";
}
$found_comments = Comment::find_the_comments($photo->id);

?>


<div class="row">
<div class="col-lg-8 col-lg-offset-2">

	 <!-- Blog Post -->
	<?php foreach($found_comments as $comment) : ?>
	 <!-- Title -->
	 <h1><?php echo $photo->title ?></h1>

	 <!-- Author -->
	 <p class="lead">
		  by <a href="#"><?php echo $comment->author; ?></a>
	 </p>
	 <hr>
	 <!-- Date/Time -->
	 <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p>
	 <hr>
	 <!-- Preview Image -->
	 <img class="img-responsive" src="admin/<?php echo $photo->picture_path(); ?>" alt="">
	 <hr>
	 <!-- Post Content -->
	 <p class="lead"><?php echo $comment->body; ?></p>

	 <hr>
	<?php endforeach; ?>
	 <!-- Blog Comments -->

	 <!-- Comments Form -->
	 <div class="well">
		  <h4>Leave a Comment:</h4>
		  <form action="" method="post" role="form">
			  <div class="form-group">
			  <label for="author">Author</label>
			  <input type="text" name="author" class="form-control">
			  </div>
				<div class="form-group">
					<label for="body">Comment</label>
					 <textarea class="form-control" name="body" rows="3"></textarea>
				</div>
				<button type="submit" name="submit" class="btn btn-primary">Submit</button>
		  </form>
	 </div>
	 <hr>
	 <!-- Posted Comments -->
	 <!-- Comment -->
	 <div class="media">
		  <a class="pull-left" href="#">
				<img class="media-object" src="http://placehold.it/64x64" alt="">
		  </a>
		  <div class="media-body">
				<h4 class="media-heading">Start Bootstrap
					 <small>August 25, 2014 at 9:30 PM</small>
				</h4>
				Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
		  </div>
	 </div>
</div>
</div>
	<!-- Blog Sidebar Widgets Column -->
<!--
	<div class="col-md-4">

		  <?php //include("includes/sidebar.php"); ?>

	</div>
-->
<!-- /.row -->

<?php include("includes/footer.php"); ?>


