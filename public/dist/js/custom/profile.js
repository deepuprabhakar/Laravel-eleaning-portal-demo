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
		//$('.overlay').fadeIn();
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

				var image = $(document).find("#preview > img");
				originalData = {};
				image.cropper({
				  aspectRatio: 200/200,
		          resizable: true,
		          zoomable: true,
		          rotatable: false,
		          movable: true
		        }); 

		        $('#save-image').click(function(){
		        	var imageData = image.cropper('getData');
		        	$.ajax({
		        		'url'	: '/cropImage',
		        		'data' 	: {image: imageData, path: path, '_token': $('meta[name=_token]').attr('content')},
		        		'type'	: 'POST',
		        		'dataType': 'json',
		        		success: function(res)
		        		{
		        			console.log(response);
		        		} 
		        	});
		        }); 
		        
			}
		});
	});

});