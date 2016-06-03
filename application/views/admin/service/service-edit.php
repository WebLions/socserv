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
            <div class="row category-list">
                <div class="col-lg-6 left-cat">
                    <?php
                    $i=1;
                    foreach($categories as $cat):?>
                        <?php
                        if($cat['id']==$i){?>
                            <div class="filter-category-item" id="<?=$cat['id'];?>">
                                <div class="filter-category">
                                    <p><?=$cat['name'];?></p>
                                </div>
                                <br>
                                <select class="btn btn-primary cat-select">
                                    <?php foreach($cat['values'] as $val): ?>
                                        <option><?=$val['name'];?></option>
                                    <?php endforeach;?>
                                </select>

                            </div>
                            <?php $i+=2;} endforeach; ?>
                </div>
                <div class="col-lg-6 right-cat">
                    <?php
                    $i=2;
                    foreach($categories as $cat):?>
                        <?php
                        if($cat['id']==$i){?>
                            <div class="filter-category-item" id="<?=$cat['id'];?>">
                                <div class="filter-category">
                                    <p><?=$cat['name'];?></p>
                                </div>
                                <br>
                                <select class="btn btn-primary cat-select">
                                    <?php foreach($cat['values'] as $val): ?>
                                        <option><?=$val['name'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <?php $i+=2;} endforeach; ?>
                </div>
            </div>
        </form>
    </div>
</div>