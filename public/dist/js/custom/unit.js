$('#unit-form').submit(function(e){
	e.preventDefault();
	tinymce.triggerSave();
	$('#response-unit').hide();
	$('#create-unit').text('Sending...').prop('disabled', true);
	var data = $(this).serializeArray();
	var url = $(this).attr('action');
	$.ajax({
		'url' : url,
		'data':data,
		'type':'POST',
		'dataType':'json',
		success: function(response)
		{
			$('#response-unit').html('<div class="alert alert-success alert-dismissible" role="alert">\
	          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
	          <i class="fa fa-check" aria-hidden="true"></i> '+response.success+'\
	          </div>').slideDown().delay(5000).slideUp();
         	$('#unit-form')[0].reset();
		},
		error: function(response)
		{
			var errors = response.responseJSON;
        	var error = "";
        	$.each(errors, function(key, value){
            	error += '<li>'+value+'</li>';
            });
            $('#response-unit').html('<div class="alert alert-danger alert-dismissible" role="alert">\
	          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
	          <i class="fa fa-ban" aria-hidden="true"></i> Alert \
	          <ul>'+error+'</ul>\
	          </div>').slideDown();
            $('#title').focus();
		},
		complete: function()
		{
			$('#create-unit').text('Create unit').prop('disabled', false);
		}
	});
});

$(function() {
	tinymce.init({
	    selector: '#content',
	    plugins : ' image lists charmap print preview',
	    
	  });
});