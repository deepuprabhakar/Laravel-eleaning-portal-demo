var search = "";
$(document).ready(function(){

  $('input[type=checkbox]').iCheck({
    checkboxClass: 'icheckbox_flat-blue',
    radioClass: 'iradio_flat-blue'
  });

  //Enable check and uncheck all functionality
   $(document).on('click', ".checkbox-toggle", function () {
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

$(window).on('hashchange', function() {
    if (window.location.hash) {
        var page = window.location.hash.replace('#', '');
        if (page == Number.NaN || page <= 0) {
            return false;
        } else {
            //getPosts(page, search);
        }
    }
});

$(document).ready(function() {
    $(document).on('click', '.pages a', function (e) {
        $('#mail-table tbody').html('<tr><td colspan="4" class="text-muted text-center">Loading...</td></tr>');
        search = $('#search-mail').val();
        getPosts($(this).attr('href').split('page=')[1], search);
        console.log($(this).attr('href').split('page=')[1]);
        e.preventDefault();
    });
    $(document).on('keyup', '#search-mail', function (e) {
        search = $('#search-mail').val();
        $('#mail-table tbody').html('<tr><td colspan="4" class="text-muted text-center">Loading...</td></tr>');
        getPosts(1, search);
        e.preventDefault();
    });
});

function getPosts(page, search) {
    $.ajax({
        url : '?search=' + search + '&page=' + page,
        dataType: 'json',
    }).done(function (data) {
        $('.div-messages').html(data);
        $('input[type=checkbox]').iCheck({
          checkboxClass: 'icheckbox_flat-blue',
          radioClass: 'iradio_flat-blue'
        });
        location.hash = page;
    }).fail(function () {
        alert('Posts could not be loaded.');
    });
}


/*$(function(){
 
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
        console.log(result);
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

});*/
