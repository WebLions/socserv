<div class="col-lg-10">
    <div class="admin-content">
        <div class="add-block">
            <h3 style="float: left;margin-top: 10px;">Фільтри</h3>
            <div class="btn btn-primary" style="float: right">
                <a href="/admin/filter/add">Додати фільтр </a><i class="glyphicon glyphicon-plus"></i>
            </div>
        </div>
        <table class="table table-bordered table-hover" style="width:100%;text-align:center">
            <tr>
                <th style="width:2%;text-align:center;">#</th>
                <th style="width:40%;text-align:center;">Назва фільтру</th>
                <th style="width:15%;text-align:center;">Категорія фільтру</th>
                <th style="width:2%;text-align:center;">Функції</th>
            </tr>
            <?php
            $i = 1;
            foreach($filters as $filt):?>
                <tr>
                    <td><?echo $i++?></td>
                    <td><?=$filt['name']?></td>
                    <td><?=$filt['category']?></td>
                    <td>
                        <div class="btn-group">
                            <a class="btn btn-xs btn-success editClient" href="/admin/filter/edit/<?=$filt['id']?>"><i class="glyphicon glyphicon-pencil"></i></a>
                            <a class="btn btn-xs btn-danger" onclick="return confirm('Удалить фильтр?')" href="/admin/filter/delete/<?=$filt['id']?>"><i class="glyphicon glyphicon-trash"></i></a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

</div>