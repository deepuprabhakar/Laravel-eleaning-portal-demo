$(function(){
	
	
	$('#add-images').click(function(e){
		e.preventDefault();
		$('#images').trigger('click');
	});

	var form = document.querySelector('#gallery-form');
	var form2 = document.querySelector('#search-image-form');
	var searchButton = document.querySelector('#search-image');
	var request = new XMLHttpRequest();

	request.upload.addEventListener('progress', function(e)
	{
		$('.overlay').show();    
	}, false);

	request.addEventListener('load',function(e)
	{
	    var result = (JSON.parse(e.target.responseText));
	    $('.overlay').hide();
	    
	    if(result.file)
	    {
	    	$('#response').html('<div class="alert alert-danger" style="margin-bottom: 0">'+result.file+'</div>').slideDown().delay(5000).slideUp();
	    }
	    else
	    {
		    var block = "";
		    $.each(result, function(key, value){
		    	block += ('<div class="item"><div class="well">\
		    				<img src="'+url+'/thumbs/'+value.image+'" class="img-responsive">\
		    				<div class="img-path">'+url+'/thumbs/'+value.image+'</div>\
		    				</div></div>');
		    });
		    if(block == "")
		    	$('#response').html('<div class="alert alert-warning" style="margin-bottom: 0">Sorry, no matches found!</div>').slideDown().delay(5000).slideUp();

		    $('.masonry .row').html(block);
		}

	}, false);

	form.addEventListener('submit', function(e){
	    e.preventDefault();
	    var formdata = new FormData(form);
	    request.open('post', base_url+'/uploadImages');
	    request.send(formdata);
	},false);

	form2.addEventListener('submit', function(e){
	    e.preventDefault();
	    var formdata = new FormData(form2);
	    request.open('post', base_url+'/searchImages');
	    request.send(formdata);
	},false);

	$(searchButton).keyup(function(){
		$('#search-button').trigger('click');
	});

	$('#images').change(function(e){
		e.preventDefault();
		$('.upload').trigger('click');
	});
	 
});