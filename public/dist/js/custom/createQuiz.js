$('#quiz-form').submit(function(e){
	e.preventDefault();
	$('#response-quiz').hide();
	var data = $(this).serializeArray();
	$button = $('#quiz').text();
	$('#quiz').text('Adding...').prop('disabled', false);
	var url = $(this).attr('action');
	$.ajax({
		'url' : url,
		'data':data,
		'type':'POST',
		'dataType':'json',
		success: function(response)
		{
			$('#response-quiz').html('<div class="alert alert-success alert-dismissible" role="alert">\
	          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
	          <i class="fa fa-check" aria-hidden="true"></i> '+response.success+'\
	          </div>').slideDown().delay(5000).slideUp();
         	$('#quiz-form')[0].reset();
		},
		error: function(response)
		{
			var errors = response.responseJSON;
        	var error = "";
        	$.each(errors, function(key, value){
            	error += '<li>'+value+'</li>';
            });
            $('#response-quiz').html('<div class="alert alert-danger alert-dismissible" role="alert">\
	          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
	          <i class="fa fa-ban" aria-hidden="true"></i> Alert \
	          <ul>'+error+'</ul>\
	          </div>').slideDown();
            $('#question').focus();
		},
		complete: function()
		{
			$('#quiz').text($button).prop('disabled', false);
		}
	});
	
});

//for radio button

$(function(){
	$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
     checkboxClass: 'icheckbox_flat-green',
     radioClass: 'iradio_flat-green'
  });

});

