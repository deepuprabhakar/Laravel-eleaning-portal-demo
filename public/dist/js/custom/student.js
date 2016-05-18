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
    $('#student-table').dataTable().fnDestroy();
    $('#student-table')
    .on( 'init.dt', function () {
        $('.overlay').fadeOut();
    }).dataTable({
      "ajax": {
            "url": "/fetchStudents",
            "data": {'course':course, 'batch': batch},
            "type": 'POST',
        },
        "columns": [
            { "data": "no" },
            { "data": "name" },
            { "data": "course" },
            { "data": "batch" },
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
              "targets": [ 2,3,4 ],
              "sortable": false
          }
      ]
  });
});

});

//jQuery Confirm
  $(document).on('click', '.btn-delete', function(e){
    e.preventDefault();
    var form = $(this).parent('form');
    var data = form.serializeArray();
    var url = form.attr('action');
    console.log(url);
    $.confirm({
        title: 'Confirm!',
        content: 'Are you sure?',
        theme: 'black',
        confirmButtonClass: 'btn-danger',
        cancelButtonClass: 'btn-info',
        confirm: function(){
            $.ajax({
              dataType: "json",
              type: 'POST',
              url: url ,
              data: {'data':data, _method: 'DELETE'},
              
            });
            $('#student-table').DataTable().ajax.reload(); 
        },
        cancel: function(){
        }
    });
  });