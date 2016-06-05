<div class="col-lg-10">
    <div class="admin-content">
        <form role="form" action="/filters/insertFilters" method="post" style="max-width: 400px;">
            <div class="form-group">
                <label for="name">Назва</label>
                <input name="name" type="text" class="form-control" placeholder="Назва категорії">
            </div>
            <div class="form-group">
                <select name="id_category" class="btn btn-primary">
                    <option></option>
                    <option value="" selected>Оберіть категорію служби</option>

                    <?php foreach($categories as $val): ?>
                        <option value="<?=$val['id'];?>"><?=$val['name'];?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Зберегти</button>
            </div>
        </form>
    </div>
</div>