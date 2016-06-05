<div class="col-lg-10">
<div class="admin-content">
    <div class="add-block">
        <h3 style="float: left;margin-top: 10px;">Соціальні служби</h3>
        <div class="btn btn-primary" style="float: right">
            <a href="/admin/service/add">Додати службу </a><i class="glyphicon glyphicon-plus"></i>
        </div>
    </div>

    <table class="table table-bordered table-hover" style="width:100%;">
        <tr>
            <th style="width:2%;text-align:center;">#</th>
            <th style="width:40%;text-align:center;">Назва служби</th>
            <th style="width:15%;text-align:center;">Опис</th>
            <th style="width:15%;text-align:center;">Адреса</th>
            <th style="width:20%;text-align:center;">Телефон</th>
            <th style="width:2%;text-align:center; ">Функції</th>
        </tr>
        <?php
    foreach($services as $serv):?>
            <tr>
                <td><?=$serv['id']?></td>
                <td><?=$serv['name']?></td>
                <td><?=$serv['description']?></td>
                <td><?=$serv['adres']?></td>
                <td><?=$serv['phone']?></td>
                <td style="vertical-align: middle">
                    <div class="btn-group">
                        <a class="btn btn-xs btn-success editClient" href="/admin/service/edit/<?=$serv['id']?>"><i class="glyphicon glyphicon-pencil"></i></a>
                        <a class="btn btn-xs btn-danger deleteClient" href="/admin/service/delete/<?=$serv['id']?>"><i class="glyphicon glyphicon-trash"></i></a>
                    </div>
                </td>
            </tr>
    <?php endforeach; ?>
    </table>
</div>
</div>


