<div class="col-lg-10">
    <div class="admin-content">
    <form role="form" method="post">
    <div class="form-group">
        <label for="name">Назва</label>
        <input name="name" type="text" class="form-control" id="name">
    </div>
    <div class="form-group">
        <label for="contact">Опис</label>
        <input name="title" class="form-control" id="title">
    </div>
    <div class="form-group">
        <label for="other">Телефон</label>
        <input name="phone" class="form-control" id="phone">
    </div>
    <div class="form-group">
        <label for="other">Адреса</label>
        <input name="adres" class="form-control" id="adres">
    </div>
    <button type="submit" class="btn btn-default addcontragent">Добавить</button>
    <?php
    foreach($categories as $cat):?>
        <div class="filter-category-item" id="<?=$cat['id'];?>">
            <div class="filter-category">
                <a><?=$cat['name'];?></a>
                <i class="glyphicon glyphicon-chevron-down "></i>
            </div>
            <div class="filter-content">
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
</form>
    </div>