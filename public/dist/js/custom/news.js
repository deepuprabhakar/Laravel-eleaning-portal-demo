$(function () {
  //Datatables
  $('#news-table')
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
            "targets": [ 3 ],
            "sortable": false
        }
    ]
  });

  //jQuery Confirm
  $(document).on('click', '.btn-delete', function(e){
    e.preventDefault();
    var form = $(this).parent('form');
    $.confirm({
        title: 'Confirm!',
        content: 'Are you sure?',
        theme: 'black',
        confirmButtonClass: 'btn-danger',
        cancelButtonClass: 'btn-info',
        confirm: function(){
            form.submit();
        },
        cancel: function(){

        }
    });
  });

    
});