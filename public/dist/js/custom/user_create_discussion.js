$('#discussion-form').submit(function(e){
	e.preventDefault();
	$('#response-discussion').hide();
	$('#discussionprompt').text('Saving...').prop('disabled', true);
	var data = $(this).serializeArray();
	var url = $(this).attr('action');
	$.ajax({
		'url' : url,
		'data':data,
		'type':'POST',
		'dataType':'json',
		success: function(response)
		{
			// Display success message
			$('#response-discussion').html('<div class="alert alert-success alert-dismissible" role="alert">\
	          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
	          <i class="fa fa-check" aria-hidden="true"></i> '+response.data.success+'\
	          </div>').slideDown().delay(5000).slideUp();

			// Replace answer list on page
			var replies = "";
			$.each(response.data.replies, function(key, value){
				replies += '<div class="post"><div class="user-block">\
                          	<img class="img-circle img-bordered-sm" src="'+url_img+'/default-160x160.jpg'+'" alt="user image">\
                              	<span class="username">\
                                <a href="#">'+value.student.name+'</a>\
                               	</span>\
                          		<span class="description">'+value.time+'</span>\
                       		 </div>\
                       		 <p>'+value.answer+'</p></div>';
			});

			$('#post-list').html(replies);

         	$('#discussion-form')[0].reset();
		},
		error: function(response)
		{
			var errors = response.responseJSON;
        	var error = "";
        	$.each(errors, function(key, value){
            	error += value;
            });
            $('#response-discussion').html('<div class="alert alert-danger alert-dismissible" role="alert">\
	          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
	          <i class="fa fa-ban" aria-hidden="true"></i> '+error+'\
	          </div>').slideDown();
            $('#answer').focus();
		},
		complete: function()
		{
			$('#discussionprompt').text('Save').prop('disabled', false);
		}
	});
});