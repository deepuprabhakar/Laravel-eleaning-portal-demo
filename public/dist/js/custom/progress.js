$(function(){
 
//Drop down
  $('#courses').select2({
    placeholder: 'Select Course'
  });
  $('#batch').select2({
    placeholder: 'Select Batch'
  });
  $('#subject').select2({
    placeholder: 'Select Subject'
  });

  //Fetch Batch
  $('#courses').change(function(){
    var data = $(this).val();
    var option = '<option value >Select Batch</option>';
    $('#batch').val('').trigger('change').prop('disabled', true);
    $('#subject').val('').trigger('change').prop('disabled', true);

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


//fetch Subject
  $('#batch').change(function(){
    var data = $(this).val();
    var course = $('#courses').val();
    var option = '<option value >Select Subject</option>';
    if(data !="")
      $('#subject').val('').trigger('change').prop('disabled', true);

    $.ajax({
      dataType: "json",
      type: 'POST',
      url: '/fetchSubjects',
      data: {'batch':data, 'course':course},
      success: function(getData){
          $.each( getData, function( key, val ){
              option += '<option value="'+key+'">'+val+'</option>'
          });
          $('#subject').html(option);
          if(data !="")
            $('#subject').prop('disabled', false);
      },
      complete: function()
      {
          $('.ajaxloader').html('');
      }
    });
  });

//Display Progress table

  $('#subject').change(function(){
  var course = $('#courses').val();
  var batch = $('#batch').val();
  var subject = $(this).val();
  if(subject != "")
  {
    //Datatables
      $('#progress-table').dataTable().fnDestroy();
      $('#progress-table')
      .on( 'init.dt', function () {
          $('.overlay').fadeOut();
      }).dataTable({
        "ajax": {
              "url": "/fetchProgress",
              "data": {'course':course, 'batch': batch, 'subject':subject},
              "type": 'POST',
          },
          "columns": [
              { "data": "no" },
              { "data": "name" },
              { "data": "discussion" },
              { "data": "quiz" },
              { "data": "assignment" },
              
          ],
        "paging": true,
        "searching": true,
        "sortable": true,
        "info": true,
        "autoWidth": true,
        "responsive" : true,
        "columnDefs": [
            {
                "targets": [ 2,3,4 ],
                "sortable": false
            }
        ]
    });
  }
});




});