<div class="col-lg-10">
<div class="admin-content">


    <table class="table table-bordered table-hover" style="width:100%;text-align:center">
        <tr>
            <th style="width:40%;text-align:center;">Назва служби</th>
            <th style="width:15%;text-align:center;">Опис</th>
            <th style="width:15%;text-align:center;">Адреса</th>
            <th style="width:20%;text-align:center;">Телефон</th>
            <th style="width:10%;text-align:center;">Функції</th>
        </tr>
        <?php
    foreach($services as $serv):?>
            <tr>
                <td><?=$serv['name']?></td>
                <td><?=$serv['description']?></td>
                <td><?=$serv['adres']?></td>
                <td><?=$serv['phone']?></td>
                <td>
                    <div class="btn-group">
                        <a class="btn btn-xs btn-success editClient" href="/admin/service/edit/<?=$serv['id']?>"><i class="glyphicon glyphicon-pencil"></i></a>
                        <a class="btn btn-xs btn-danger deleteClient" href="/admin/service/delete/<?=$serv['id']?>"><i class="glyphicon glyphicon-trash"></i></a>
                    </div>
                </td>
            </tr>
    <?php endforeach; ?>
    </table>
</div>
<div class="add-block">
    <div class="btn btn-primary">
        <a href="/admin/service/add">Додати службу </a><i class="glyphicon glyphicon-plus"></i>
    </div>
</div>
</div>


