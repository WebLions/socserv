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
             $('.filter-category-item').each(function(i,el) {
                    $(el).removeClass('open')
                });
            $(this).parent().toggleClass('open');
        })
    })
})



