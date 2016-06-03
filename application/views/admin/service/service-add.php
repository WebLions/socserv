<div class="col-lg-10">
    <div class="admin-content">
    <form role="form" method="post" action="/service/add_post">
    <div class="form-group">
        <label for="name">Назва</label>
        <input required name="name" type="text" class="form-control" id="name">
    </div>
    <div class="form-group">
        <label for="contact">Опис</label>
        <input required name="description" class="form-control" id="title">
    </div>
    <div class="form-group">
        <label for="other">Телефон</label>
        <input required name="phone" class="form-control" id="phone">
    </div>
    <div class="form-group">
        <label for="other">Адреса</label>
        <input required name="adres" class="form-control" id="adres">
    </div>
        <input type="text" hidden name="coordinates" id="search_coords">
        <input type="text" hidden name="disctrict" id="search_region">
        <input type="text" hidden name="adres" id="search_addr">
    <button type="submit" class="btn btn-default addcontragent">Добавить</button>
        <div class="row category-list">
                <?php foreach($categories as $cat):?>
                    <div class="col-lg-6 left-cat">
                    <div class="filter-category-item" id="<?=$cat['id'];?>">
                        <div class="filter-category">
                            <p><?=$cat['name'];?></p>
                        </div>
                        <br>
                        <select name="id_filter[]" class="btn btn-primary cat-select">
                            <option>Оберіть категорію служби</option>
                            <?php foreach($cat['values'] as $val): ?>
                                <option value="<?=$val['id'];?>"><?=$val['name'];?></option>
                            <?php endforeach;?>
                        </select>

                    </div>
            </div>
                <?php endforeach; ?>

        </div>
</form>
    </div>
</div>

    <script type="text/javascript">
        function initMap() {
            var input = (document.getElementById('adres'));
            var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    return;
                }
                $('#search_coords').val(JSON.stringify(place.geometry.location));
                var addr1 = '';
                var addr2 = '';
                $.each(place.address_components,function(index,item){
                    type = false;
                    $.each(item.types,function(i,e){
                        if(e=="sublocality") type=true;
                        if(e=="route") addr1 = item.long_name;
                        if(e=="street_number") addr2 = item.long_name;
                    });
                    if(type){
                        $('#search_region').val(item.long_name);
                    }
                    $('#search_addr').val(addr1+' '+addr2);
                })
                console.log(place);
            });
        }
    </script>
    <script async defer src='https://maps.googleapis.com/maps/api/js?key=AIzaSyA4wG__6Tde9l83sGXz4DdT-KwjrKTF-lQ&callback=initMap&libraries=places'></script>
