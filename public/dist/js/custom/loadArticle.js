$(document).ready(function() {

    $('.overlay').show();

    $.get(window.location.href, function(data){
        $('.article').append(data.article);
        $('.timeline').data('next-page', data.next_page);
        if(data.next_page == null)
        {
          if(data.article != "")
          {
            $('.article').append('<li>\
                <i class="fa fa-clock-o bg-blue"></i>\
              </li>');
            $('.overlay').html('No more article!');
          }
          else
            $('.overlay').hide();
        }
    });

    $(window).scroll(fetchPosts);

    function fetchPosts() {
        $('.overlay').show();
        var page = $('.timeline').data('next-page');

        if(page !== null) {

            clearTimeout( $.data( this, "scrollCheck" ) );

            $.data( this, "scrollCheck", setTimeout(function() {
                
                var scroll_position_for_posts_load = $(window).height() + $(window).scrollTop() + 100;

                if(scroll_position_for_posts_load >= $(document).height()) {
                    $.get(page, function(data){
                        $('.article').append(data.article);
                        $('.timeline').data('next-page', data.next_page);
                        if(data.next_page == null)
                        {
                          $('.article').append('<li>\
                            <i class="fa fa-clock-o bg-blue"></i>\
                          </li>');
                          $('.overlay').html('No more article!');
                        }
                    });
                }
            }, 350))

        }
    }

});