$(document).ready(function() {

    $.get(window.location.href, function(data){
        $('.news').append(data.news);
        $('.timeline').data('next-page', data.next_page);
        if(data.next_page == null)
        {
          $('.news').append('<li>\
            <i class="fa fa-clock-o bg-blue"></i>\
          </li>');
          $('.overlay').html('No more news!');
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
                        $('.news').append(data.news);
                        $('.timeline').data('next-page', data.next_page);
                        if(data.next_page == null)
                        {
                          $('.news').append('<li>\
                            <i class="fa fa-clock-o bg-blue"></i>\
                          </li>');
                          $('.overlay').html('No more news!');
                        }
                    });
                }
            }, 350))

        }
    }

});