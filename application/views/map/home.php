<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>
    <style type="text/css">
        html, body, div{
            margin: 0px;
            padding: 0px;
        }
    </style>
</head>
<body>
<div style="width: 30%; height: 700px; float:left;">
    <input type="text" id="search_address" placeholder="Search address.."><button id="search_btn">Search</button>
    <?php
//        foreach ($this->data['filters'] as $value){
//            print_r($value);
//        }
    ?>
</div>
<div id="marker_desc" style="display:none; width: 300px; margin-left:-150px; height: 200px; margin-top: -300px; margin-bottom: 20px; background:#fff;">
    <div><span class="close_description" style="padding:20px; float: right; cursor:pointer;">X</span></div>
    <div id="marker_desc_text"></div>
</div>
<div id="map" style="width: 70%; height: 700px; float:left;"></div>
<script type="text/javascript">
    var markers_data = JSON.parse('<?=json_encode($services);?>');
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 46.4846, lng: 30.7326},
            zoom: 12
        });
        map.controls[google.maps.ControlPosition.BOTTOM_CENTER].push(document.getElementById('marker_desc'));
        var input = (document.getElementById('search_address'));
        var autocomplete = new google.maps.places.Autocomplete(input);


        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();

            if (!place.geometry) {
                return;
            }
            console.log(JSON.stringify(place.geometry.location));
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                lastPlace = place.geometry.location;
                map.setCenter(place.geometry.location);
                map.setZoom(18);
            }
        });

        for (var i=0; i<markers_data.length; i++){
            add_marker(markers_data[i]);
        }
    }
    function add_marker(data){
        var marker = new google.maps.Marker({
            position: data.coordinates,
            map: map
        });
        var infowindow = new google.maps.InfoWindow({
            content: data.adres
        });
        marker.addListener('mouseover',function(){
            infowindow.open(map,marker);
        })
        marker.addListener('mouseout',function(){
            infowindow.close(map,marker);
        })
        marker.addListener('click',function(){
            var code = '<h3><b>Название:</b><span>'+data.name+'</span></h3><br><p><b>Адрес:</b>'+data.adres+'</p>';
            $('#marker_desc_text').html(code);
            $('#marker_desc').fadeIn();
        })
    }
    $('#search_btn').click(function(){
        map.setCenter(lastPlace);
        map.setZoom(18);
    });
    $(document).ready(function(){
        $('.close_description').click(function(){
            $('#marker_desc').fadeOut();
        });
    })
</script>
<script async defer src='https://maps.googleapis.com/maps/api/js?key=AIzaSyA4wG__6Tde9l83sGXz4DdT-KwjrKTF-lQ&callback=initMap&libraries=places'>
</script>
</body>
</html>

