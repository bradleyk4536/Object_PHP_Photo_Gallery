<?php include("includes/header.php"); ?>

<?php
//	For pagination first set page variable
	$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
//	Set total photos per page
	$items_per_page = 4;
//	Get total photo count
	$items_total_count = Photo::count_all();
//	instantiate class
	$paginate = new Paginate($page, $items_per_page, $items_total_count);

	$sql = "SELECT * FROM photos ";
	$sql .= " LIMIT {$items_per_page} ";
	$sql .= "OFFSET {$paginate->offset()}";

	$photos = Photo::find_by_query($sql);
?>

<div class="row">
	<!-- Blog Entries Column -->
	<div class="col-md-12">
	<div class="thumbnails row">
<?php foreach($photos as $photo) : ?>
		<div class="col-xs-6 col-md-3">
			<a class="thumbnail" href="photo.php?id=<?php echo $photo->id ?>">
				<img class="img-responsive home_page_photo" src="admin/<?php echo $photo->picture_path(); ?>" alt="">
			</a>
		</div>
<?php endforeach; ?>
	</div>
	</div>
	<!-- Blog Sidebar Widgets Column -->
<!-- /.row -->

<?php include("includes/footer.php"); ?>
