$(function () {
  //Datatables
  $('#assignment-table')
  .on( 'init.dt', function () {
      $('.overlay').fadeOut();
  })
  .dataTable({
    "paging": true,
    "searching": true,
    "sortable": true,
    "info": true,
    "autoWidth": true,
    "responsive" : true,
    "columnDefs": [
        {
            "targets": [ 6 ],
            "sortable": false
        }
    ]
  });
});

$('.assignment-form').submit(function(e){
  e.preventDefault();
  $('#response-assignment').hide();
  $(this).closest('input[type="submit"]').val('Saving...').prop('disabled', true);
  var data = $(this).serializeArray();
  var url = $(this).attr('action');
  console.log(url);
  $.ajax({
    'url' : url,
    'data': data,
    'type': 'POST',
    'dataType': 'json',
    success: function(response)
    {
      $('#response-assignment').html('<div class="alert alert-success alert-dismissible" role="alert">\
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
            <i class="fa fa-check" aria-hidden="true"></i> '+response.success+'\
            </div>').slideDown().delay(5000).slideUp();
         
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