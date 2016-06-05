<div class="col-lg-10">
    <div class="admin-content">
        <div class="add-block">
            <h3 style="float: left;margin-top: 10px;">Категорії фільтрів</h3>
            <div class="btn btn-primary" style="float: right">
                <a href="category/add">Додати категорію </a><i class="glyphicon glyphicon-plus"></i>
            </div>
        </div>
        <table class="table table-bordered table-hover" style="width:100%;vertical-align: middle">
            <tr>
                <th style="width:2%;text-align:center;">#</th>
                <th style="width:80%;text-align:center;">Найменування категорій</th>
                <th style="width:2%;text-align:center;">Функції</th>
            </tr>
            <?php $i = $page; foreach($categories as $key => $val) { $i++?>
                <tr>
                    <td><?php echo $i?></td>
                    <td><?php echo $val['name']?></td>
                    <td style="text-align: center">
                        <div class="btn-group">
                            <a class="btn btn-xs btn-success" href="category/edit/<?php echo $val['id']?>"><i class="glyphicon glyphicon-pencil"></i></a>
                            <a class="btn btn-xs btn-danger" onclick="return confirm('Удалить категорию и ее дочерние фильтры?')" href="category/delete/<?php echo $val['id']?>"><i class="glyphicon glyphicon-trash"></i></a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <nav>
        <ul class="pagination">
            <?php for ($i = 1; $i <= $page_count; $i++) {?>
            <li><a href="/admin/category?page=<?php echo $i;?>" <?php echo ($i == $page + 1? 'disabled' : '')?>><?php echo $i;?></a></li>
            <?php } ?>
        </ul>
    </nav>
</div>