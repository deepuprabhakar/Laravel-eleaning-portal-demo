$(function(){
	$('#exam-start').click(function(){
		$('#exam-questions').fadeIn();
		$('#exam-content').hide();
		$(this).hide();

		$('#countdown').countdown(
		{
			until: '+10m',
			format: 'MS',
			compact: true,
			onExpiry: function()
			{
				var form = document.querySelector('#exam-form');
	    		var formdata = new FormData(form);
				$('#exam-questions').fadeOut();
				$.ajax({
	        		url: '/exam',
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
	  $('#exam-finish').fadeIn();
	});

  	// jQuery Confirm
	  $(document).on('click', '#exam-finish', function(e){
	    e.preventDefault();
	    var form = document.querySelector('#exam-form');
	    var formdata = new FormData(form);
	    $.confirm({
	        title: 'Confirm!',
	        content: 'Are you sure? No changes can be made after submission!',
	        theme: 'black',
	        confirmButtonClass: 'btn-danger',
	        cancelButtonClass: 'btn-info',
	        confirm: function(){
	        	$('.timer-holder').hide();
			    $('#exam-questions').fadeOut();
			    $('#countdown').countdown('destroy');
	        	$.ajax({
	        		url: '/exam',
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