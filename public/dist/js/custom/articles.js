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
  
	$('#publish').datepicker({
      autoclose: true,
      todayHighlight: true,
      todayBtn: 'linked',
      keyboardNavigation:true,
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