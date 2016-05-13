$(function() {
	
	$('#dob').datepicker({
      autoclose: true
    });

	/**
	 * Profile Pic Upload
	 */
	$('#profile-input').change(function(){
		var form = document.querySelector('#profile-pic-form');
		var formdata = new FormData(form);
		$('.overlay').fadeIn();
		$.ajax({
			'url'	: '/uploadProfilePic',
			'data'	: formdata,
			'type'	: 'POST',
			'dataType': 'json',
			'contentType': false,
    		'processData': false,
			success: function(response)
			{
				$('#preview').html(response.image).fadeIn();
				$('#save-image').fadeIn();
				$('.overlay').fadeOut();
				form.reset();

				var image = $(document).find("#preview > img");
				originalData = {};
				image.cropper({
				  aspectRatio: 1/1,
				  viewMode: 1,
				  minCanvasWidth: 240,
				  minCanvasHeight: 240,
		          resizable: false,
		          zoomable: false,
		          rotatable: false,
		          movable: true,
		          cropBoxResizable: false
		        }); 

		        $('#save-image').click(function(){
		        	var imageData = image.cropper('getData');
		        	$('.overlay').fadeIn();
		        	$.ajax({
		        		'url'	: '/cropImage',
		        		'data' 	: {image: imageData, '_token': $('meta[name=_token]').attr('content')},
		        		'type'	: 'POST',
		        		'dataType': 'json',
		        		success: function(res)
		        		{
		        			$('#save-image').fadeOut();
		        			$('#preview').html(res.image).fadeIn();
		        			$('.profile-user-img, .side-profile-pic, .header-profile-image').prop('src', res.path);
		        			$('.overlay').fadeOut();
		        		} 
		        	});
		        }); 
		        
			}
		});
	});

});