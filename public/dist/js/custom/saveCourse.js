$('#course-form').submit(function(e){
  e.preventDefault();
  $('.course-button').text('Sending...').prop('disabled', true);
  $('#response').hide();
  var data = $(this).serializeArray();
  var url = $(this).attr('action');
  $.ajax({
    'url' : url,
    'data': data,
    'type': 'POST',
    dataType: 'json',
    success: function(response)
    {
         $('#response').html('<div class="alert alert-success alert-dismissible" role="alert">\
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
          <i class="fa fa-check" aria-hidden="true"></i> '+response.success+'\
          </div>').slideDown().delay(5000).slideUp();
         $('#course-form')[0].reset();
    },
    error: function(response)
    {
        var errors = response.responseJSON;
        var error = "";
        $.each(errors, function(key, value){
            error += '<li>'+value+'</li>';
        });
        $('#response').html('<div class="alert alert-danger alert-dismissible" role="alert">\
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
          Warning! You have some errors.\
          <ul>'+error+'</ul>\
          </div>').slideDown();
    },
    complete: function()
    {
        $('.course-button').text('Create Course').prop('disabled', false);
    }
  });
});