$(document).ready(function(){

    $('#search_btn').click(function(){
        map.setCenter(lastPlace);
        map.setZoom(18);
    });
        $('.close').click(function(){
            $('#marker_desc').fadeOut();
        });
    $(function() {
        $('.filter-category').click(function(){
            var open = $(this).parent().hasClass('open');
            $('.filter-category-item').each(function(i,el) {
                    $(el).removeClass('open')
                });
            if(!open)
            $(this).parent().toggleClass('open');
            var height = document.body.clientHeight - 81;
            console.log(height);
            $('#map').css('min-height',height+'px');
            $('#map').css('height',height+'px');
        })
    })
})



