$('#discussion-prompt-form').submit(function(e){
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
			$('#response-discussion').html('<div class="alert alert-success alert-dismissible" role="alert">\
	          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
	          <i class="fa fa-check" aria-hidden="true"></i> '+response.success+'\
	          </div>').slideDown().delay(5000).slideUp();
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
            $('#discussion').focus();
		},
		complete: function()
		{
			$('#discussionprompt').text('Save').prop('disabled', false);
		}
	});
});