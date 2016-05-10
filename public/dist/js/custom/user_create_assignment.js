 function fetchAssignment(sub)
{
	$('#assignment-table')
	  .on( 'init.dt', function () {
	      $('.overlay').fadeOut();
	  })
	  .dataTable({
	  	"ajax": {
            "url": "/fetchAssignments",
            "data": {subject: sub},
            "type": 'POST',
        },
        "columns": [
            { "data": "no" },
            { "data": "title" },
            { "data": "score" },
            { "data": "remarks" },
            { "data": "action" }
        ],
	    "paging": true,
	    "searching": true,
	    "sortable": true,
	    "info": true,
	    "autoWidth": true,
	    "responsive" : true,
	    "columnDefs": [
	        {
	            "targets": [ 4 ],
	            "sortable": false
	        }
	    ]
	});
}



$('#assignment-form').submit(function(e){
	e.preventDefault();
	$('#response-assignment').hide();
	var form = document.querySelector('#assignment-form');
	$('#assignment').text('Saving...').prop('disabled', true);
	var formdata = new FormData(form);
	//console.log(formdata);
	var url = $(this).attr('action');
	$.ajax({
		'url' : url,
		'data': formdata,
		'type': 'POST',
		'dataType': 'json',
		'contentType': false,
    	'processData': false,
		success: function(response)
		{
			$('#response-assignment').html('<div class="alert alert-success alert-dismissible" role="alert">\
	          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
	          <i class="fa fa-check" aria-hidden="true"></i> '+response.data.success+'\
	          </div>').slideDown().delay(5000).slideUp();
         	$('#assignment-form')[0].reset();

         	$('#assignment-table').DataTable().ajax.reload();		
		},			
		error: function(response)
		{
			var errors = response.responseJSON;
        	var error = "";
        	$.each(errors, function(key, value){
            	error += '<li>'+value+'</li>';
            });
            $('#response-assignment').html('<div class="alert alert-danger alert-dismissible" role="alert">\
	          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
	          <i class="fa fa-ban" aria-hidden="true"></i> Alert \
	          <ul>'+error+'</ul>\
	          </div>').slideDown();
            $('#title').focus();	
		},
		complete: function()
		{
			$('#assignment').text('Save').prop('disabled', false);
		}
	});
});

$(function () {
  //Datatables
  fetchAssignment(subject);
});


//Jquery conform
$(function(){
	$(document).on('click', '.btn-delete', function(e){
    e.preventDefault();
    var form = $(this).parent('form');
    var formData = form.serializeArray();
    var url = form.attr('action');
    
    $.confirm({
        title: 'Confirm!',
        content: 'Are you sure?',
        theme: 'black',
        confirmButtonClass: 'btn-danger',
        cancelButtonClass: 'btn-info',
        confirm: function(){
        	$.ajax({
            	url: url,
            	data: formData,
            	type: 'POST',
            	dataType: 'json',
            	success: function(response)
            	{
            		$('#assignment-table').DataTable().ajax.reload();
            	}
            });
        },
        cancel: function(){

        }
    });

  });

});

