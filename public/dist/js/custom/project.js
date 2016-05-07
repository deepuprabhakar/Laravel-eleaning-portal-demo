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
    $('#batch').val('').trigger("change");
  
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
          $('#batch').val(old).trigger('change');
      },
      complete: function()
      {
          $('.ajaxloader').html('');
      }
    });
  });

  if($('#courses').val() != "")
  {    
    $('#courses, #batch').trigger('change');
  }
  //Datatables
  $('#student-table')
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
            "targets": [ 5 ],
            "sortable": false
        }
    ]
  });

});