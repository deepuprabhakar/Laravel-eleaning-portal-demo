$(function() {
	tinymce.init({
	    selector: '#content',
	    plugins : ' image lists charmap print preview',
	    
	  });
	$('#publish').datepicker({
      autoclose: true
    });
});
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