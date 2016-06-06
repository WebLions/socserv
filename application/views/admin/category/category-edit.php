<div class="col-lg-10">
    <div class="admin-content">
        <form action="/admin/category/edit/<?php echo $id?>" method="post" style="max-width: 400px;">
            <div class="form-group">
                <label for="name">Назва</label>
                <input value="<?php echo $name?>" name="name" type="text" class="form-control" placeholder="Назва категорії">
            </div>
            <button type="submit" class="btn btn-default addcontragent">Зберегти</button>
        </form>
    </div>
</div>