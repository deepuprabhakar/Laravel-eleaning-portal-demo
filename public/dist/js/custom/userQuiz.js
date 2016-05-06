$(function(){
	$('#quiz-start').click(function(){
		$('#quiz-questions').fadeIn();
		$('#quiz-content').hide();
		$(this).hide();

		$('#countdown').countdown(
		{
			until: '+5m',
			format: 'MS',
			compact: true,
			onExpiry: function()
			{
				var form = document.querySelector('#quiz-form');
	    		var formdata = new FormData(form);
				$('#quiz-questions').fadeOut();
				$.ajax({
	        		url: '/quiz',
	        		type: 'POST',
	        		data: formdata,
	        		contentType: false,
	        		processData: false,
	        		dataType: 'json',
	        		success: function(response)
	        		{
	        			$('#response').html(response.result).fadeIn();
	        		},
	        	});
			}
		});
	});
	
	// icheck
	$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
	    checkboxClass: 'icheckbox_flat-green',
	    radioClass: 'iradio_flat-green'
  	});

  	$('input[type="radio"].flat-red').on('ifChecked', function(event){
	  $('#quiz-finish').fadeIn();
	});

  	// jQuery Confirm
	  $(document).on('click', '#quiz-finish', function(e){
	    e.preventDefault();
	    var form = document.querySelector('#quiz-form');
	    var formdata = new FormData(form);
	    $.confirm({
	        title: 'Confirm!',
	        content: 'Are you sure? No changes can be made after submission!',
	        theme: 'black',
	        confirmButtonClass: 'btn-danger',
	        cancelButtonClass: 'btn-info',
	        confirm: function(){
	        	$('.timer-holder').hide();
			    $('#quiz-questions').fadeOut();
			    $('#countdown').countdown('destroy');
	        	$.ajax({
	        		url: '/quiz',
	        		type: 'POST',
	        		data: formdata,
	        		contentType: false,
	        		processData: false,
	        		dataType: 'json',
	        		success: function(response)
	        		{
	        			$('#response').html(response.result).fadeIn();
	        		},
	        	});
	        },
	        cancel: function(){
	        }
	    });

	  });
});