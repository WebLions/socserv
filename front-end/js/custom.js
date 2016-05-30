$(document).ready(function(){


    $('#search_btn').click(function(){
        map.setCenter(lastPlace);
        map.setZoom(18);
    });


        $('.close_description').click(function(){
            $('#marker_desc').fadeOut();
        });
    $(function() {
        $('.filter-category').click(function(){
            $(this).parent().toggleClass("open");
        })
    })
})



