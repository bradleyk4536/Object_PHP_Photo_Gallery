$(document).ready(function(){
	var user_href;
	var user_href_splitted;
	var user_id;
	var image_src;
	var image_src_splitted;
	var image_name;
	var photo_id;
//	click picture and enable button on modal
	$(".modal_thumbnails").click(function(){
		$("#set_user_image").prop('disabled', false);

//		GET USER ID FROM GET REQUEST
//		get href from delete button
		user_href = $("#user-id").prop('href');
		user_href_splitted = user_href.split("=");
//		pull value from end of array right of equal sign
		user_id = user_href_splitted[user_href_splitted.length - 1];

//		Pull image name
		image_src = $(this).prop("src");
		image_src_splitted = image_src.split("/");
		image_name = image_src_splitted[image_src_splitted.length - 1];

//		populate modal side bar
		photo_id = $(this).attr("data");
		$.ajax({
			url: "includes/ajax_code.php",
			data: {photo_id:photo_id},
			type: "POST",
			success:function(data) {
				if(!data.error){
					$("#modal_sidebar").html(data);
				}
			}
		});


	});

//	CLICK APPLY BUTTON
//	Change image using ajax
	$("#set_user_image").click(function(){
		$.ajax({
			url: "includes/ajax_code.php",
			data:{image_name: image_name, user_id:user_id},
			type: "POST",
			success:function(data){
				if(!data.error) {

					$(".user_image_box a img").prop('src', data);
				}
			}
		});

	});



//Editor
tinymce.init({ selector:'textarea' });
});


