<?php
/**
 * Created by PhpStorm.
 * User: Silt7
 * Date: 07.03.2017
 * Time: 12:42
 */
$frez = $this->processOutput( $frez ); ?>
<div class="container">
    <ol class="breadcrumb">
        <li><a href="/admin" class="link">Панель управления сайтом</a></li>
        <li><a href="/admin/frez" class="link">Редактирование фрезеровок</a></li>
        <li class="active"><?= $frez->title ?></li>
    </ol>
</div>

<div class="container">
    <h1 class="head"><?= $frez->title ?></h1>

    <form action="/admin/frez/save" method="post" enctype="multipart/form-data">
        <input hidden="hidden" name="id" value="<?= $frez->id ?>">

        <div class="row">


            <div class="col-md-5">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="form-group">
                            <span class="text-danger">*</span>
                            <label>Заголовок</label>
                            <input type="text" name="title" class="form-control" placeholder="Название"
                                   value="<?= $frez->title ?>">
                        </div>

                        <div class="form-group">

                            <div class="btn-group">
                                <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
                                    <i class="fa fa-eye"></i> <?= $frez->is_show ? 'Отображать' : 'Не отображать' ?>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <input type="radio" id="ex2_2_1" name="is_show"
                                               value="0" <?= ! $frez->is_show ? 'checked' : '' ?>>
                                        <label for="ex2_2_1"><i class="fa fa-close"></i> Не отображать</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="ex2_2_2" name="is_show"
                                               value="1" <?= $frez->is_show ? 'checked' : '' ?>>
                                        <label for="ex2_2_2"><i class="fa fa-check"></i> Отображать</label>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <div class="form-group">

                            <div class="btn-group">
                                <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
                                    <?= $frez->categ_frez != 0 ? Frez::$categ[$frez->categ_frez - 1]['title'] : "Категория" ?>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <? // $currentColorMaterial = $color->material;
                                    foreach ( Frez::$categ as $item ):
                                        ?>
                                        <li>
                                            <input type="radio" id="type_<?= $item['id']?>" name="category"
                                                   value="<?= $item['id'] ?>" <?= $item['id'] == $frez->categ_frez ? 'checked' : '' ?>>
                                            <label for="type_<?= $item['id'] ?>"><?= $item['title'] ?></label>
                                        </li>
                                    <? endforeach ?>
                                </ul>
                            </div>

                        </div>
                        <div class="form-group">
                            <span class="text-danger">*</span>
                            <label>Картинка</label>
                            <input type="file" name="image" class="filestyle" data-buttonName="btn-primary" data-buttonText="image"
                                   data-buttonBefore="true">
                            <input type="checkbox" name="del_img" value="y"/> Пометить на удаление
                        </div>
                        <p>Поля отмеченные знаком <span class="text-danger">*</span> обязательны для заполнения</p>

                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <? $selCategColor = unserialize($frez->categ_color)?>
                <?foreach($colorCategory as $category_item):?>
                    <?
                        $isChecked = false;
                        if($selCategColor != ""){
                            if (in_array($category_item->id,$selCategColor)) {
                                $isChecked = true;
                            }
                        }
                    ?>
                    <a class="btn btn-default <?= $isChecked ? "btn-success" : "" ?> adm-module-extra-options"> <?= $category_item->label ?>

                    <input type="checkbox" name="colorCategory[]" value="<?= $category_item->id ?>"
                        <?= $isChecked ? "checked" : "" ?> >
                    </a>
                <?endforeach?>
            </div>
            <div class="col-md-3">
                <?php if ( $frez->image ): ?>
                    <img src="<?= $frez->getImage() ?>.png?p=<?= rand()?>" width="100%">
                <?php endif; ?>
            </div>
        </div>
        <div class="panel-footer">
            <a href="/admin/frez" class="btn btn-default"><i class="fa fa-arrow-left"></i> Назад</a>
            <button type="submit" class="btn btn-primary pull-right" data-loading-text="Сохранение ..."><i
                    class="fa fa-check"></i> Сохранить
            </button>
        </div>
    </form>

</div>
<script type="text/javascript">

    $(".adm-module-extra-options input[type='text']").click(function () {
        var thisInput = $(this);
        var thisInputGroup = thisInput.parent();
        var thisBtn = thisInputGroup.parent();
        setTimeout(function () {
            thisBtn.removeClass("btn-success").addClass("btn-success");
            thisBtn.find("input[type='checkbox']").prop('checked', true);
        }, 1);
        var textInput = thisBtn.find("input[type='text']");
        if (textInput.val() == "") {
            textInput.val(0);
        }
    })

    $(".adm-module-extra-options").click(function () {
        var thisButton = $(this);

        if (thisButton.hasClass("btn-success")) {
            thisButton.removeClass("btn-success");
            thisButton.find("input[type='checkbox']").prop('checked', false);
        } else {
            thisButton.addClass("btn-success");
            thisButton.find("input[type='checkbox']").prop('checked', true);
            var textInput = thisButton.find("input[type='text']");
            if (textInput.val() == "") {
                textInput.val(0);
            }
        }
    });


</script>