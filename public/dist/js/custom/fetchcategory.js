$(function () {
  //Datatables
  $('#category-table')
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

$('.cat-form').submit(function(e){
  e.preventDefault();
  var data = $(this).serializeArray();
  console.log(data);
  var url = $(this).attr('action'); 
  $.ajax({
    'url' : url,
    'data': data,
    'type': 'POST',
    'dataType': 'json',
    success: function(response)
    {
      
         
    },      
    error: function(response)
    {
       
    },
    complete: function()
    {
      
    }
  });
});