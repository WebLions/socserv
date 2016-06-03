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
                <div class="filter-category-item" id="<?=$cat['id'];?>">
                    <div class="filter-category">
                        <a><?=$cat['name'];?></a>
                        <i class="glyphicon glyphicon-chevron-down "></i>
                    </div>
                    <div class="filter-content">
                        <?php $rel = json_decode($relation); ?>
                        <?php foreach($cat['values'] as $val): ?>
                            <div class="btn-group" data-toggle="buttons">
                                <div class="btn btn-primary">
                                    <input type="checkbox" id="filter<?=$val['id'];?>" label_text="<?=$val['name'];?>" filter_id="<?=$val['id'];?>" cat_id="<?=$cat['id'];?>" class="filter_box"/>
                                    <span class="glyphicon glyphicon-ok"></span>
                                </div>
                                <label for="filter<?=$cat['id'];?>_val<?=$val['id'];?>"><?=$val['name'];?></label>
                                <span class="label">( <?=isset($rel->{$val['id']})? count($rel->{$val['id']}):0;?> )</span>
                            </div>
                            <br>
                        <?php endforeach;?>

                    </div>
                </div>
            <?php endforeach; ?>
            <div class="selected-filter" id="selected_filters"></div>
            <button class="btn btn-primary" id="clear_filter">Очистити фільтр</button>
        </div>
        <div class="col-lg-9">
            <div id="map" class="map"></div>
        </div>
    </div>

