$(function(){

	//select2 plugin
	$('#to').select2({
		placeholder: "To:",
  		allowClear: true,
  		
	});

	$('#body').wysihtml5();

	$('#message-reset').click(function(){
		$('#to').val('').trigger('change');
	});

});