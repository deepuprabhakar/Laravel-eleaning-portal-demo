$(document).ready(function() {
  $('#publish').datepicker({
      autoclose: true,
      format: 'mm/dd/yyyy'
    });
  if($('#courses').val() != "")
  	{    
    	$('#courses, #batches').trigger('change');
  	}
});

 //Drop down
  $('#courses').select2({
    placeholder: 'Select Course',
  });
  $('#batches').select2({
    placeholder: 'Select Batch'
  });

$('#courses').change(function(){
	var course = $(this).val();
	if(course == '0')
	{
		var option = '<option value="0" >All</option>';
		$('#batches').html(option);
		$('#audience').val('all');
		$('#batches').trigger('change');
	}
	else
	{
		var option = '<option value >Select Batch</option>';
	    $('#batches').val('').trigger("change");
		
		$.ajax({
			'url' : '/fetchBatch',
			'data': {'course': course},
			'type':'POST',
			'dataType':'json',
			success: function(getData)
			{
				$.each(getData, function(key,value){
					option += '<option value="'+key+'">'+value+'</option>';
				});
				$('#batches').html(option);
	          	$('#batches').val(old).trigger('change');
			},
			complete: function(getData)
			{
				$('.ajaxloader').html('');
			}
		});
	}
	
});

//for tinymce

$(function() {
	tinymce.init({
	    selector: '#content',
	    plugins: [
	        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
	        'searchreplace wordcount visualblocks visualchars code fullscreen',
	        'insertdatetime media nonbreaking save table contextmenu directionality',
	        'emoticons template paste textcolor colorpicker textpattern imagetools'
	      ],
	      toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
	      toolbar2: 'print preview media | forecolor backcolor emoticons',
	      image_advtab: true,
	    
	});
});