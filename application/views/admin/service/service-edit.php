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
                        <section>
                            <?php foreach($cat['values'] as $val): ?>
                                <option><?=$val['name'];?></option>
                            <?php endforeach;?>
                        </section>
                    </div>
                </div>
            <?php endforeach; ?>

        </form>
    </div>
</div>