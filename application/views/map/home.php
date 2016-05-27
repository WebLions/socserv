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
<div style="width: 30%; height: 700px; float:left;"></div>
<div id="map" style="width: 70%; height: 700px; float:left;"></div>
<script type="text/javascript">
    function initMap() {
        // Create a map object and specify the DOM element for display.
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 46.4846, lng: 30.7326},
            scrollwheel: false,
            zoom: 12
        });
    }
</script>
<script async defer src='https://maps.googleapis.com/maps/api/js?key=AIzaSyDfTcnPQVygKuNQ7uFVLhDxd_zFpN-23sg&callback=initMap'>
</script>
</body>
</html>

