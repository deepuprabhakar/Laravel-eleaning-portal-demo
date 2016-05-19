$(document).ready(function(){

  $('input[type=checkbox]').iCheck({
    checkboxClass: 'icheckbox_flat-blue',
    radioClass: 'iradio_flat-blue'
  });

  //Enable check and uncheck all functionality
   $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

});


$(function(){
 
  var form = document.querySelector('#search-mail-form');

  var searchButton = document.querySelector('#search-mail');
  var request = new XMLHttpRequest();

  request.upload.addEventListener('progress', function(e)
  {
    $('.overlay').show();    
  }, false);

  request.addEventListener('load',function(e)
    {
        var result = (JSON.parse(e.target.responseText));
        $('.overlay').hide();
        
        $('#mail-table tbody').html(result.data);
        $('input[type=checkbox]').iCheck({
          checkboxClass: 'icheckbox_flat-blue',
          radioClass: 'iradio_flat-blue'
        });


    }, false);

  form.addEventListener('submit', function(e){
      e.preventDefault();
      var formdata = new FormData(form);
      request.open('post','searchMails');
      request.send(formdata);


  },false);

  $('#search-button').trigger('click');

  $(searchButton).keyup(function(){
    $('#search-button').trigger('click');
  });

});
