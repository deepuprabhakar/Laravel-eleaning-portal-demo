$('#cat-form').submit(function(e){
	e.preventDefault();
	var data = $(this).serializeArray();
	var nameValue = document.getElementById("number").value;
	console.log(nameValue);
	var url = $(this).attr('action');
	$.ajax({
		'url' : url,
		'data':data,
		'type':'POST',
		'dataType':'json',
		success: function(response)
		{
			
		},
		error: function(response)
		{
			
		},
		complete: function()
		{
			$('#quiz').text($button).prop('disabled', false);
		}
	});
	
});

