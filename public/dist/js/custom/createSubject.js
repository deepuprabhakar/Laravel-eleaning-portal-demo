$(function(){
  $('#courses').select2({
    placeholder: 'Select Course'
  });
  $('#semester').select2({
    placeholder: 'Select Semester'
  });


//Fetch Semester
$('#courses').change(function(){
  var data = $(this).val();
  var option = '<option value >Select Semester</option>';
  $('#semester').val('').trigger("change");
  
  $.ajax({
      dataType: "json",
      type: 'POST',
      url: '/fetchSem',
      data: {'course':data},
      success: function(getData){
          $.each( getData, function( key, val ){
              for(i=1; i<=val; i++)
                option += '<option value="'+i+'">'+i+'</option>';
          });
          $('#semester').html(option);
          $('#semester').val(old).trigger('change');
      },
      complete: function()
      {
          $('.ajaxloader').html('');
      }
  });
});

if($('#courses').val() != "")
{    
    $('#courses, #semester').trigger('change');
}

});
