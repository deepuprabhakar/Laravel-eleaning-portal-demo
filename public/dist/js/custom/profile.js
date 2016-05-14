$(function() {

	var jcrop_api;
	
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
				$('#preview-image-container').html('<img src="'+url+'/'+response.image+'" id="preview-image" class="img-responsive">').fadeIn();
				//$('.profile-user-img, .side-profile-pic, .header-profile-image').prop('src', response.path);
				$('#save-image').fadeIn();
				$('.overlay').fadeOut();
				form.reset();
				initJcrop();
			},
			error: function(response)
			{
				var error = response.responseJSON;
				$('#preview-image-container').html('<div class="alert alert-danger">\
					    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>\
					    <h4>	<i class="icon fa fa-check"></i> Alert!</h4>\
					    '+ error.profilePic +'\
					  </div>').fadeIn();
				$('.overlay').fadeOut();
				
			}
		});
	
	});

	$('#save-image').click(function(){
		
		var formdata = $('#profile-pic-save').serializeArray();
    	
    	$('.overlay').fadeIn();

    	$.ajax({
    		'url'	: '/cropImage',
    		'data' 	: formdata,
    		'type'	: 'POST',
    		'dataType': 'json',
    		success: function(res)
    		{
    			$('#save-image').fadeOut();
    			$('#preview-image-container').html(res.image+res.link).fadeIn();
    			$('.profile-user-img, .side-profile-pic, .header-profile-image').prop('src', res.path);
    			$('.overlay').fadeOut();
    		} 
    	});

    });

    $(document).on('click', '#remove-profile-photo', function(){
    	var image = $(this).val();
    	var token = $('input[name="_token"]').val();
    	$('.overlay').fadeIn();

    	$.ajax({
    		url : '/deleteProfilePhoto',
    		data: {image: image, _token: token},
    		type: 'POST',
    		dataType: 'json',
    		success: function(res)
    		{
    			//$(this).fadeOut();
    			$('#preview-image-container').html('').fadeOut();
    			$('.profile-user-img, .side-profile-pic, .header-profile-image').prop('src', res.path);
    			$('.overlay').fadeOut();
    		}
    	});
    });

	function initJcrop()
    {
    	$('#preview-image').Jcrop({
    	  aspectRatio: 1,
    	  minSize: [100, 100],
    	  maxSize: [240, 240],
    	  onSelect: updateCoords,
    	  onChange: updateCoords,
    	},function(){

        jcrop_api = this;
        jcrop_api.animateTo([0,0,200,200]);

      });
    }

    function updateCoords(c)
    {
      $('#x').val(c.x);
      $('#y').val(c.y);
      $('#w').val(c.w);
      $('#h').val(c.h);
    };

});