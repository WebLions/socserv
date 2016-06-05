<div class="col-lg-10">
    <div class="admin-content">


        <table class="table table-bordered table-hover" style="width:100%;text-align:center">
            <tr>
                <th style="width:40%;text-align:center;">Назва фільтру</th>
                <th style="width:15%;text-align:center;">Категорія фільтру</th>
            </tr>
            <?php
            foreach($filters as $filt):?>
                <tr>
                    <td><?=$filt['name']?></td>
                    <td><?=$filt['category']?></td>
                    <td>
                        <div class="btn-group">
                            <a class="btn btn-xs btn-success editClient" href="admin/filter/edit&id<?=$serv['id']?>"><i class="glyphicon glyphicon-pencil"></i></a>
                            <a class="btn btn-xs btn-danger deleteClient" href="admin/filter/delete&id<?=$serv['id']?>"><i class="glyphicon glyphicon-trash"></i></a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <div class="add-block">
        <div class="btn btn-primary">
            <a href="/admin/filter/add">Додати фільтр </a><i class="glyphicon glyphicon-plus"></i>
        </div>
    </div>
</div>