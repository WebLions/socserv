<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Социальная служба</title>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>
    <script type="text/javascript" src="/front-end/js/bootstrap.js"></script>
    <script type="text/javascript" src="/front-end/js/custom.js"></script>
    <link rel="stylesheet" href="/front-end/css/main.css">
    <link rel="stylesheet" href="/front-end/css/bootstrap.css">
    <link rel="stylesheet" href="/front-end/css/bootstrap-theme.css">


</head>
<body>
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-3 side-bar">
            <div class=" search-block">
                <div class="input-group">
                    <input type="text" class="form-control" id="search_address" placeholder="Что ищем?">
          <span class="input-group-btn">
            <button class="btn btn-default"  id="search_btn" type="button">Поиск</button>
          </span>
                </div>
            </div>
            <?php
            foreach($categories as $cat):?>
                <div class="filter-category-item ">
                    <div class="filter-category">
                        <a><?=$cat['name'];?></a>
                        <i class="glyphicon glyphicon-chevron-down "></i>
                    </div>
                    <div class="filter-content">
                        <?php $rel = json_decode($relation); ?>
                        <?php foreach($cat['values'] as $val): ?>
                            <div class="btn-group" data-toggle="buttons">
                                <div class="btn btn-success">
                                    <input type="checkbox" id="filter<?=$val['id'];?>" filter_id="<?=$val['id'];?>" cat_id="<?=$cat['id'];?>" class="filter_box"/>
                                    <span class="glyphicon glyphicon-ok"></span>
                                </div>
                                <label for="filter<?=$cat['id'];?>_val<?=$val['id'];?>"><?=$val['name'];?></label>
                                <span class="label label-success"><?=isset($rel->{$val['id']})? count($rel->{$val['id']}):0;?></span>
                            </div>
                            <br>
                        <?php endforeach;?>

                    </div>
                </div>
            <?php endforeach; ?>
            <button class="btn btn-primary" id="clear_filter">Очистити фільтр</button>
        </div>
        <div class="col-lg-9">
            <div id="map" class="map"></div>
        </div>
    </div>


</div>

<script type="text/javascript">
    var markers_data = JSON.parse('<?=$services;?>');
    var filters = JSON.parse('<?=$relation;?>');
    var any = false;
    markers = {};
    $(document).ready(function(){
        $('.filter_box').change(function(){
            console.clear();
            any = false;
            var elements = {};
            $('.filter_box').each(function(i,el){
                if($(el).prop('checked')) {
                    any = true;
                    if( elements[$(el).attr('cat_id')]===undefined)
                        elements[$(el).attr('cat_id')] = new Array();
                    var vals = filters[$(el).attr('filter_id')];
                    if(typeof(vals)!='undefined')
                    elements[$(el).attr('cat_id')] = elements[$(el).attr('cat_id')].concat(vals);
                }
            });

            /* МАГИЯ НЕ ТРОГАТЬ */
            var markers_index = new Array();
            var firstarray = new Array();
            $.each(elements,function(index,val){
                if(firstarray.length==0) {
                    firstarray = val;
                }else{
                    $.each(val,function(i,v){
                        if(firstarray.indexOf(v)>-1){
                            markers_index.splice(1,0,v);
                        }
                    })
                }
            });
            if(markers_index.length==0) markers_index = firstarray;
            $.each(markers,function(index,marker){
                if((markers_index.indexOf(index)>=0)||(any==false)){
                    marker.setVisible(true);
                }else{
                    marker.setVisible(false);
                }
            });
            /* Все, опасносности больше нет, можно дальше исправлять :) */

        });

        $('#clear_filter').click(function(){
            $('.filter_box').each(function(i,el) {
                $(el).prop('checked',false);
            });
            $.each(markers,function(index,marker){
                marker.setVisible(true);
            });
        });
    });
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
        });
        markers[data.id] = marker;
    }
</script>
<script async defer src='https://maps.googleapis.com/maps/api/js?key=AIzaSyA4wG__6Tde9l83sGXz4DdT-KwjrKTF-lQ&callback=initMap&libraries=places'>
</script>


</body>
</html>

