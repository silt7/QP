<div class="container">
    <ol class="breadcrumb">
        <li><a href="/admin" class="link">Панель управления сайтом</a></li>
        <li class="active">Редактирование фрезеровок</li>
    </ol>
</div>

<div class="container">

    <div class="row">
        <div class="col-sm-4">
            <h4 class="promo">Быстрые ссылки</h4>

            <?php require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/admin/admin/admin-menu.php" ); ?>
        </div>
        <div class="col-sm-8">
            <h1 class="head">Редактирование фрезеровок</h1>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="col-md-1">id</th>
                        <th class="col-md-1"></th>
                        <th class="col-md-6">Заголовок</th>
                        <th class="col-md-1">Отображать</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ( $this->processOutput( $frez ) as $item ): ?>
                        <tr>
                            <td><?= $item->id ?></td>
                            <td><img src="<?= $item->getImage() ?>.png" width="30px"></td>
                            <td><a href="/admin/frez/edit/?id=<?= $item->id ?>" class="link"><?= $item->title ?></a>
                            </td>

                            <td class="text-center">
                                <? if ( $item->is_show == 0 ): ?><i class="fa fa-close"></i>
                                <? else: ?>
                                    <i class="fa fa-check"></i>
                                <?endif ?>
                            </td>
                            <td class="text-right">
                                <a href="/admin/frez/edit/?id=<?= $item->id ?>" class="tool-link"
                                   data-toggle="tooltip" data-placement="top" title="Редактировать"><i
                                        class="fa fa-edit"></i></a>
                                <a href="/admin/frez/delete/?id=<?= $item->id ?>" class="tool-link"
                                   data-toggle="tooltip" data-placement="top" title="Удалить"><i
                                        class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <hr/>
            <i class="fa fa-plus-circle"></i> <a class="link" href="/admin/frez/create">Добавить фрезеровку</a>
        </div>
    </div>


</div>


<script type="text/javascript">

    $(function () {
        $("#a_m_frez").addClass("select");
    })

</script>