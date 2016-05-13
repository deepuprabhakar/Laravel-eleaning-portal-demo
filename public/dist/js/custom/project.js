$(function(){
 
//Drop down
  $('#courses').select2({
    placeholder: 'Select Course'
  });
  $('#batch').select2({
    placeholder: 'Select Batch'
  });

  //Fetch Batch
  $('#courses').change(function(){
    var data = $(this).val();
    var option = '<option value >Select Batch</option>';
    $('#batch').val('').trigger('change').prop('disabled', true);
    
    $.ajax({
      dataType: "json",
      type: 'POST',
      url: '/fetchBatch',
      data: {'course':data},
      success: function(getData){
          $.each( getData, function( key, val ){
              option += '<option value="'+key+'">'+val+'</option>'
          });
          $('#batch').html(option);
          $('#batch').prop('disabled', false);
      },
      complete: function()
      {
          $('.ajaxloader').html('');
      }
    });
  });



$('#batch').change(function(){
  var course = $('#courses').val();
  var batch = $(this).val();
  //Datatables
    $('#project-table').dataTable().fnDestroy();
    $('#project-table')
    .on( 'init.dt', function () {
        $('.overlay').fadeOut();
    }).dataTable({
      "ajax": {
            "url": "/fetchProjects",
            "data": {'course':course, 'batch': batch},
            "type": 'POST',
        },
        "columns": [
            { "data": "no" },
            { "data": "name" },
            { "data": "topic" },
            { "data": "project" },
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
              "targets": [ 6 ],
              "sortable": false
          }
      ]
  });
});

$(document).on('click', '.save-button', function(e){
  var score = $(this).closest('td').siblings('td').children('div').children('input.score').val();
  var remarks = $(this).closest('td').siblings('td').children('input.remarks').val();
  var project = $(this).closest('td').siblings('td').children('input[type="hidden"]').val();
  $.ajax({
    'url' : 'projects',
    'data': {'score': score, 'remarks': remarks, 'project': project},
    'type': 'POST',
    'dataType': 'json',
    success: function(response)
    {
      $('#response-project').html('<div class="alert alert-success alert-dismissible" role="alert">\
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
            <i class="fa fa-check" aria-hidden="true"></i> '+response.data.success+'\
            </div>').slideDown().delay(5000).slideUp();
          
    },      
    error: function(response)
    {
      var errors = response.responseJSON;
          var error = "";
          $.each(errors, function(key, value){
              error += '<li>'+value+'</li>';
            });
            $('#response-project').html('<div class="alert alert-danger alert-dismissible" role="alert">\
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
            <i class="fa fa-ban" aria-hidden="true"></i> Alert \
            <ul>'+error+'</ul>\
            </div>').slideDown();
            $('#title').focus();  
    },
    complete: function()
    {
      $('#project').text('Save').prop('disabled', false);
    }
  });

});


});