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
<div id="map" style="width: 70%; height: 700px; float:left;"></div>
<script type="text/javascript">
    var markers_data = JSON.parse('<?=json_encode($services);?>');
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 46.4846, lng: 30.7326},
            zoom: 12
        });
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
            var marker = new google.maps.Marker({
                position: markers_data[i].coordinates,
                map: map
            });
        }
    }

    $('#search_btn').click(function(){
        map.setCenter(lastPlace);
        map.setZoom(18);
    });
</script>
<script async defer src='https://maps.googleapis.com/maps/api/js?key=AIzaSyA4wG__6Tde9l83sGXz4DdT-KwjrKTF-lQ&callback=initMap&libraries=places'>
</script>
</body>
</html>

