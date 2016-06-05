</div>
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="soc-footer-title">
                    © Розроблено студентами ОНПУ , 2016
                </div>
            </div>
            <div class="col-lg-2">
                <div class="soc-footer-login">
                    <a href="admin">Вхід для співробітників</a>
                    <i class="glyphicon glyphicon-log-in"></i>
                </div>
            </div>
        </div>
    </div>
</footer>


<div id="marker_desc" class="marker-desc">
    <div><span class="close" ><i class="glyphicon glyphicon-remove"></i></span></div>
    <div id="marker_desc_text"></div>
</div>
<script type="text/javascript">
    var markers_data = JSON.parse('<?=$services;?>');
    var filters = JSON.parse('<?=$relation;?>');
    var any = false;
    var filterhtml = '';
    markers = {};
    $(document).ready(function(){
        $('.filter_box').change(function(){
            console.clear();
            any = false;
            var elements = {};
            filterhtml = '';
            $('.filter_box').each(function(i,el){
                if($(el).prop('checked')) {
                    filterhtml += '<span class="label label-primary">'+$(el).attr('label_text')+'</span> ';
                    any = true;
                    if( elements[$(el).attr('cat_id')]===undefined)
                        elements[$(el).attr('cat_id')] = new Array();
                    var vals = filters[$(el).attr('filter_id')];
                    if(typeof(vals)!='undefined')
                        elements[$(el).attr('cat_id')] = elements[$(el).attr('cat_id')].concat(vals);
                }
            });
            if(filterhtml.length>0){
                $('#selected_filters').html('<span>Выбраные фильтры:<br></span>'+filterhtml);
            }
            /* МАГИЯ НЕ ТРОГАТЬ */
            var markers_index = new Array();
            var firstarray = new Array();
            var elements_count = 0;
            $.each(elements,function(index,val){
                elements_count++;
                if(firstarray.length==0) {
                    firstarray = val;
                }else {
                    $.each(val, function (i, v) {
                        if (firstarray.indexOf(v) > -1) {
                            markers_index.splice(1, 0, v);
                        }
                    })
                }
            });
            if(elements_count==1) markers_index = firstarray;
            console.log(markers_index);
            $.each(markers,function(index,marker){
                if((markers_index.indexOf(index)>=0)||(any==false)){
                    marker.setVisible(true);
                }else{
                    marker.setVisible(false);
                }
            });
            if(any==false)
                $('#selected_filters').html('');
            /* Все, опасносности больше нет, можно дальше исправлять :) */

        });

        $('#clear_filter').click(function(){
            $('.filter_box').each(function(i,el) {
                $(el).prop('checked',false);
            });
            $('.btn-primary').each(function(i,el){
                $(el).removeClass('active');
            });
            $.each(markers,function(index,marker){
                marker.setVisible(true);
            });
            $('#selected_filters').html('');

        });
    });
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 46.4846, lng: 30.7326},
            zoom: 12,
            scrollwheel: false,
            navigationControl: false,
            mapTypeControl: false,
            scaleControl: false,
            draggable: true
        });

        map.controls[google.maps.ControlPosition.BOTTOM_RIGHT].push(document.getElementById('marker_desc'));
        var input = (document.getElementById('search_address'));
        var defaultBounds = new google.maps.LatLngBounds(
            new google.maps.LatLng(46.60042199999999, 30.61168491),
            new google.maps.LatLng(46.319522, 30.811890));
        var options = {
            bounds : defaultBounds,
            componentRestrictions: {country: 'ua'}
        };
        var autocomplete = new google.maps.places.Autocomplete(input,options);
        autocomplete.bindTo('bounds', map);
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
            content: data.name
        });
        marker.addListener('mouseover',function(){
            infowindow.open(map,marker);
        })
        marker.addListener('mouseout',function(){
            infowindow.close(map,marker);
        })
        marker.addListener('click',function(){
            var code = '<div class="org-content"><div class="org-name-block"><span class="org-name">'+data.name+'</span></div><p class="org-adress"><b>Адрес:</b>'+data.adres+'</p></div>';
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

