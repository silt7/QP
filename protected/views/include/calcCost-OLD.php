<div class="modal" id="calculate-price-modal" tabindex="-1" role="dialog" aria-labelledby="Заявка на рассчет стоимости" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Закрыть</span></button>
                <p class="modal-title h4" id="myModalLabel2">Заявка на БЕСПЛАТНЫЙ рассчет стоимости</p>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-sm-12">
                        <form role="form" action="/site/sendCalculatePrice" method="post" id="calculatePrice" enctype="multipart/form-data">
                            <div class="panel" style="margin-bottom: 1px;">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="calculate-price-popup-name"><span class="text-danger">*</span> Имя</label>
                                        <input type="text" name="calculate_price_popup_name" class="form-control"
                                               id="calculate-price-popup-name"
                                               placeholder="Ваше имя">
                                    </div>
                                    <div class="form-group">
                                        <label for="calculate-price-popup-phone"><span class="text-danger">*</span> Телефон:</label>
                                        <input type="text" class="form-control" id="calculate-price-popup-phone"
                                               name="calculate_price_popup_phone" placeholder="Ваш контактный телефон">
                                    </div>

                                    <div class="form-group">
                                        <label for="calculate-price-popup-email"><span class="text-danger">*</span> Email:</label>
                                        <input type="email" class="form-control" id="calculate-price-popup-email"
                                               name="calculate_price_popup_email" placeholder="Ваш контактный email">
                                    </div>
                                </div>
                            </div>

                            <div class="panel" style="margin-bottom: 1px;">
                                <div class="panel-body">

                                    <label style="font-size:18px;">Основные параметры кухни:</label>

                                    <div class="form-group">
                                        <label for="calculate-price-popup-configuration">
                                            <span class="text-danger"></span> Конфигурация кухни</label>

                                        <div class="row" style="margin-right: 0px;margin-left: 0px;">
                                            <div class="col-md-4 col-xs-6 configuration-type">
                                                <input type="radio" name="calculate_price_popup_configuration_type" value="Прямая">
					<span><!--<div class="c-check"><i class="fa fa-check"></i></div>-->
					Прямая</span>
                                            </div>
                                            <div class="col-md-4 col-xs-6 configuration-type">
                                                <input type="radio" name="calculate_price_popup_configuration_type" value="Г-образная (правая)">
                                                <span>Г-образная</span>
                                            </div>
                                            <div class="col-md-4 col-xs-6 configuration-type">
                                                <input type="radio" name="calculate_price_popup_configuration_type" value="П-образная">
                                                <span>П-образная</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <table class="table-group-calc">
                                            <tr>
                                                <td>
                                                    <label for="calculate-price-popup-size-a"><span class="text-danger"></span> Размер a:</label>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="calculate-price-popup-size-a"
                                                           name="calculate_price_popup_size_a" placeholder="Размер a">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="calculate-price-popup-size-b"><span class="text-danger"></span> Размер b:</label>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="calculate-price-popup-size-b"
                                                           name="calculate_price_popup_size_b" placeholder="Размер b">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="calculate-price-popup-size-c"><span class="text-danger"></span> Размер c:</label>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="calculate-price-popup-size-c"
                                                           name="calculate_price_popup_size_c" placeholder="Размер c">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="calculate-price-popup-size-h"><span class="text-danger"></span> Высота верхних шкафов:</label>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
                                                            <i class="fa fa-sliders" ></i> Высота верхних шкафов<span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <input type="radio" id="ex2_2_1" name="calculate_price_popup_size_h" value="720мм">
                                                                <label for="ex2_2_1">720 мм</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="ex2_2_2" name="calculate_price_popup_size_h" value="960мм">
                                                                <label for="ex2_2_2"> 960 мм</label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="calculate-price-popup-size-h"><span class="text-danger"></span>Фасады верхние:</label>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" >
                                                            <i class="fa fa-sliders" ></i>Фасады верхние<span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="без фасада" id="front_top_color_1" name="front_top_color">
                                                                <label for="front_top_color_1">без фасада</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="ЛДСП" id="front_top_color_2"  name="front_top_color">
                                                                <label for="front_top_color_2">ЛДСП</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="Пластик" id="front_top_color_3"  name="front_top_color">
                                                                <label for="front_top_color_3">Пластик</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="Пластик 3D" id="front_top_color_4"  name="front_top_color">
                                                                <label for="front_top_color_4">Пластик 3D</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="ECO-Шпон" id="front_top_color_5"  name="front_top_color">
                                                                <label for="front_top_color_5">ECO-Шпон</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="ECO-Шпон сборный" id="front_top_color_6"  name="front_top_color">
                                                                <label for="front_top_color_6">ECO-Шпон сборный</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="МДФ-пленка" id="front_top_color_7"  name="front_top_color">
                                                                <label for="front_top_color_7">МДФ-пленка</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="МДФ-патина" id="front_top_color_8"  name="front_top_color">
                                                                <label for="front_top_color_8">МДФ-патина</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="Крашеные(Эмаль)" id="front_top_color_9"  name="front_top_color">
                                                                <label for="front_top_color_9">Крашеные(Эмаль)</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="Крашеные(Эмаль) с патиной" id="front_top_color_10"  name="front_top_color">
                                                                <label for="front_top_color_10">Крашеные(Эмаль) с патиной</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="Натуральный Шпон" id="front_top_color_11"  name="front_top_color">
                                                                <label for="front_top_color_11">Натуральный Шпон</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="Акрил" id="front_top_color_12" name="front_top_color">
                                                                <label for="front_top_color_12">Акрил</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="фасад-Стекло" id="front_top_color_13"  name="front_top_color">
                                                                <label for="front_top_color_13">фасад-Стекло</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="Массив" id="front_top_color_14"  name="front_top_color">
                                                                <label for="front_top_color_14">Массив</label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="calculate-price-popup-size-h"><span class="text-danger"></span>Фасады нижние:</label>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
                                                            <i class="fa fa-sliders" ></i>Фасады нижние<span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="без фасада" id="front_bottom_color_1" name="front_bottom_color">
                                                                <label for="front_bottom_color_1">без фасада</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="ЛДСП" id="front_bottom_color_2"  name="front_bottom_color">
                                                                <label for="front_bottom_color_2">ЛДСП</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="Пластик" id="front_bottom_color_3"  name="front_bottom_color">
                                                                <label for="front_bottom_color_3">Пластик</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="Пластик 3D" id="front_bottom_color_4"  name="front_bottom_color">
                                                                <label for="front_bottom_color_4">Пластик 3D</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="ECO-Шпон" id="front_bottom_color_5"  name="front_bottom_color">
                                                                <label for="front_bottom_color_5">ECO-Шпон</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="ECO-Шпон сборный" id="front_bottom_color_6"  name="front_bottom_color">
                                                                <label for="front_bottom_color_6">ECO-Шпон сборный</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="МДФ-пленка" id="front_bottom_color_7"  name="front_bottom_color">
                                                                <label for="front_bottom_color_7">МДФ-пленка</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="МДФ-патина" id="front_bottom_color_8"  name="front_bottom_color">
                                                                <label for="front_bottom_color_8">МДФ-патина</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="Крашеные(Эмаль)" id="front_bottom_color_9"  name="front_bottom_color">
                                                                <label for="front_bottom_color_9">Крашеные(Эмаль)</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="Крашеные(Эмаль) с патиной" id="front_bottom_color_10"  name="front_bottom_color">
                                                                <label for="front_bottom_color_10">Крашеные(Эмаль) с патиной</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="Натуральный Шпон" id="front_bottom_color_11"  name="front_bottom_color">
                                                                <label for="front_bottom_color_11">Натуральный Шпон</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="Акрил" id="front_bottom_color_12" name="front_bottom_color">
                                                                <label for="front_bottom_color_12">Акрил</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="фасад-Стекло" id="front_bottom_color_13"  name="front_bottom_color">
                                                                <label for="front_bottom_color_13">фасад-Стекло</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="Массив" id="front_bottom_color_14"  name="front_bottom_color">
                                                                <label for="front_bottom_color_14">Массив</label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="panel" style="margin-bottom: 1px;">
                                <div class="panel-body">

                                    <label style="font-size:18px;">Выбор комплектации</label>

                                    <div class="form-group">
                                        <table class="table-group-calc">
                                            <tr>
                                                <td>
                                                    <label for="calculate-price-popup-size-h"><span class="text-danger"></span> Ящики и двери:</label>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
                                                            <i class="fa fa-sliders"></i> Ящики и двери<span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <input type="radio" id="doors_1" name="calculate_price_popup_doors" value="Без доводчиков">
                                                                <label for="doors_1">Без доводчиков</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="doors_2" name="calculate_price_popup_doors" value="С доводчиками">
                                                                <label for="doors_2">С доводчиками</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="doors_3" name="calculate_price_popup_doors" value="С доводчиками только ящики">
                                                                <label for="doors_3">С доводчиками только ящики</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="doors_4" name="calculate_price_popup_doors" value="С доводчиками только двери">
                                                                <label for="doors_4">С доводчиками только двери</label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="calculate-price-popup-size-h"><span class="text-danger"></span> Витрины:</label>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
                                                            <i class="fa fa-sliders"></i> Витрины<span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <input type="radio" id="glass_1" name="calculate_price_popup_glass" value="Да">
                                                                <label for="glass_1">Да, нужны</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="glass_2" name="calculate_price_popup_glass" value="Нет">
                                                                <label for="glass_2">Нет, не нужны</label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="calculate-price-popup-size-h"><span class="text-danger"></span> Бутылочница:</label>
                                                </td>
                                                <td>
                                                    <div class="btn-group" >
                                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
                                                            <i class="fa fa-sliders"></i> Бутылочница<span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <input type="radio" id="bottle_1" name="calculate_price_popup_bottle" value="Да">
                                                                <label for="bottle_1">Да, нужна</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="bottle_2" name="calculate_price_popup_bottle" value="Нет" checked>
                                                                <label for="bottle_2">Нет, не нужна</label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="calculate-price-popup-size-h"><span class="text-danger"></span>Хранение посуды:</label>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
                                                            <i class="fa fa-sliders"></i>Хранение посуды<span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <input type="radio" id="tray_1" name="calculate_price_popup_tray" value="Нет" checked>
                                                                <label for="tray_1">Нет, не нужно</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="tray_2" name="calculate_price_popup_tray" value="Сушилка и лоток для приборов" >
                                                                <label for="tray_2">Сушилка и лоток для приборов</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="tray_3" name="calculate_price_popup_tray" value="только лоток для приборов" >
                                                                <label for="tray_3">только лоток для приборов</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="tray_4" name="calculate_price_popup_tray" value="только сушилка" >
                                                                <label for="tray_4">только сушилка</label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="calculate-price-popup-size-h"><span class="text-danger"></span> Столешница:</label>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
                                                            <i class="fa fa-sliders"></i> Столешница<span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <input type="radio" id="tabletop_1" name="calculate_price_popup_tabletop" value="Постформинг 26 мм">
                                                                <label for="tabletop_1">Постформинг 26 мм</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="tabletop_2" name="calculate_price_popup_tabletop" value="Постформинг 38 мм">
                                                                <label for="tabletop_2">Постформинг 38 мм</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="tabletop_3" name="calculate_price_popup_tabletop" value="Столешница 3D(Премиум">
                                                                <label for="tabletop_3">Столешница 3D(Премиум)</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="tabletop_4" name="calculate_price_popup_tabletop" value="Искусственный камень">
                                                                <label for="tabletop_4">Искусственный камень</label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="calculate-price-popup-size-h"><span class="text-danger"></span>&nbsp;Стеновая панель:</label>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
                                                            <i class="fa fa-sliders"></i>Стеновая панель<span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <input type="radio" id="wallboard_1" name="calculate_price_popup_wallboard" value="В цвет столешницы">
                                                                <label for="wallboard_1">В цвет столешницы</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="wallboard_2" name="calculate_price_popup_wallboard" value="Стеновая панель с фотопечатью">
                                                                <label for="wallboard_2">Фотопечать</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="wallboard_3" name="calculate_price_popup_wallboard" value="Без стеновой панели">
                                                                <label for="wallboard_3">Без стеновой панели</label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="calculate-price-popup-size-h"><span class="text-danger"></span> Мойка:</label>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
                                                            <i class="fa fa-sliders"></i> Мойка<span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <input type="radio" id="washer_1" name="calculate_price_popup_washer" value="Нержавейка">
                                                                <label for="washer_1">Нержавейка</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="washer_2" name="calculate_price_popup_washer" value="Искусственный камень">
                                                                <label for="washer_2">Искусственный камень</label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="panel" style="margin-bottom: 1px;">
                                <div class="panel-body">

                                    <label style="font-size:18px;">Бытовая техника</label>

                                    <div class="form-group">
                                        <table class="table-group-calc">
                                            <tr>
                                                <td>
                                                    <label for="calculate-price-popup-size-h"><span class="text-danger"></span> Плита:</label>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
                                                            <i class="fa fa-sliders"></i> Плита<span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <input type="radio" id="cooker_1" name="calculate_price_popup_cooker"
                                                                       value="встроенная (духовка под варочной поверхностью)">
                                                                <label for="cooker_1">встроенная (духовка под варочной поверхностью)</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="cooker_2" name="calculate_price_popup_cooker"
                                                                       value="встроенная (духовка отдельно в колонне)">
                                                                <label for="cooker_2">встроенная (духовка отдельно в колонне)</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="cooker_3" name="calculate_price_popup_cooker" value="отдельностоящая 50 см">
                                                                <label for="cooker_3">отдельностоящая 50 см</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="cooker_4" name="calculate_price_popup_cooker" value="отдельностоящая 60 см">
                                                                <label for="cooker_4">отдельностоящая 60 см</label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="calculate-price-popup-size-h"><span class="text-danger"></span> Вытяжка:</label>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
                                                            <i class="fa fa-sliders"></i> Вытяжка<span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <input type="radio" id="hood_0" name="calculate_price_popup_hood" value="купольная (50 см)">
                                                                <label for="hood_0">купольная (50 см)</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="hood_1" name="calculate_price_popup_hood" value="купольная (60 см)">
                                                                <label for="hood_1">купольная (60 см)</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="hood_2" name="calculate_price_popup_hood" value="купольная (90 см)">
                                                                <label for="hood_2">купольная (90 см)</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="hood_3" name="calculate_price_popup_hood" value="встраиваемая (50 см)">
                                                                <label for="hood_3">встраиваемая (50 см)</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="hood_4" name="calculate_price_popup_hood" value="встраиваемая (60 см)">
                                                                <label for="hood_4">встраиваемая (60 см)</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="hood_5" name="calculate_price_popup_hood" value="отсутствует">
                                                                <label for="hood_5">отсутствует</label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="calculate-price-popup-size-h"><span class="text-danger"></span> Холодильник:</label>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
                                                            <i class="fa fa-sliders"></i> Холодильник<span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <input type="radio" id="cooler_1" name="calculate_price_popup_cooler" value="встраиваемый">
                                                                <label for="cooler_1">встраиваемый</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="cooler_2" name="calculate_price_popup_cooler" value="отдельностоящий 60 см">
                                                                <label for="cooler_2">отдельностоящий 60 см</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="cooler_3" name="calculate_price_popup_cooler" value="отдельностоящий 90 см">
                                                                <label for="cooler_3">отдельностоящий 90 см</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="cooler_4" name="calculate_price_popup_cooler" value="отсутствует">
                                                                <label for="cooler_4">отсутствует</label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="calculate-price-popup-size-h"><span class="text-danger"></span> Посудомоечная машина:</label>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
                                                            <i class="fa fa-sliders"></i> Посудомоечная машина<span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <input type="radio" id="dishwasher_1" name="calculate_price_popup_dishwasher" value="встраиваемая 45 см">
                                                                <label for="dishwasher_1">встраиваемая 45 см</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="dishwasher_2" name="calculate_price_popup_dishwasher" value="встраиваемая 60 см">
                                                                <label for="dishwasher_2">встраиваемая 60 см</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="dishwasher_4" name="calculate_price_popup_dishwasher" value="встраиваемая 45 см">
                                                                <label for="dishwasher_4">отдельностоящая 45 см</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="dishwasher_5" name="calculate_price_popup_dishwasher" value="встраиваемая 60 см">
                                                                <label for="dishwasher_5">отдельностоящая 60 см</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="dishwasher_3" name="calculate_price_popup_dishwasher" value="отсутствует">
                                                                <label for="dishwasher_3">отсутствует</label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="calculate-price-popup-size-h"><span class="text-danger"></span> Стиральная машина:</label>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
                                                            <i class="fa fa-sliders"></i> Стиральная машина<span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <input type="radio" id="washermachine_1" name="calculate_price_popup_washermachine" value="встраиваемая">
                                                                <label for="washermachine_1">встраиваемая</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="washermachine_2" name="calculate_price_popup_washermachine" value="отдельностоящая">
                                                                <label for="washermachine_2">отдельностоящая</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="washermachine_3" name="calculate_price_popup_washermachine"
                                                                       value="отдельностоящая, закрытая фасадами">
                                                                <label for="washermachine_3">отдельностоящая, закрытая фасадами</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="washermachine_4" name="calculate_price_popup_washermachine" value="отсутствует">
                                                                <label for="washermachine_4">отсутствует</label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="img1" class="filestyle" data-buttonText="&nbsp Добавить изображение" accept="image/png,image/jpeg"><br>
                                        <input type="file" name="img2" class="filestyle" data-buttonText="&nbsp Добавить изображение" accept="image/png,image/jpeg"><br>
                                        <input type="file" name="img3" class="filestyle" data-buttonText="&nbsp Добавить изображение" accept="image/png,image/jpeg">
                                    </div>
                                    <div class="form-group">
                                        <label for="calculate-popup-comment">Комментарий:</label>
                                        <textarea class="form-control" id="calculate-popup-comment"   name="calculate_popup_comment" placeholder="Ваш комментарий к заказу"></textarea>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn promo-button">Заказать рассчет стоимости</button>
                            <p style="font-size:10px;">Нажимая «Заказать рассчет стоимости», вы даёте согласие на обработку своих персональных данных в соответствии
                            с Федеральным законом №152-ФЗ «О персональных данных» и принимаете <a href="/soglasie.html">условия</a></p>
                        </form>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <p class="pull-left">Поля отмеченные знаком <span class="text-danger">*</span> обязательны для
                    заполнения</p>
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="review-modal" tabindex="-1" role="dialog" aria-labelledby="заказать звонок" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Закрыть</span></button>
                <h4 class="modal-title" id="myModalLabel">ОСТАВИТЬ ОТЗЫВ</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div style="width:90%; margin: 0 auto;">
                        <form role="form" action="add/review" method="POST" id="call-form" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><span class="text-danger">*</span> Имя</label>
                                <input type="text" class="form-control" name="name" placeholder="Ваше имя">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Отзыв:</label>
                                <textarea class="form-control" name="review" placeholder="Отзыв"></textarea>
                            </div>
                            <label for="exampleInputPassword1">Картинки:</label>
                            <p id = "p1" ><input id = "img1" type="file" name="image1" class="filestyle" data-buttonText="&nbsp Добавить изображение" accept="image/png,image/jpeg"></p>
                            <p id = "p2" style="display:none;"><input id = "img2" type="file" name="image2" class="filestyle" data-buttonText="&nbsp Добавить изображение" accept="image/png,image/jpeg" ></p>
                            <p id = "p3" style="display:none;"><input id = "img3"  type="file" name="image3" class="filestyle" data-buttonText="&nbsp Добавить изображение" accept="image/png,image/jpeg" ></p>
                            <p id = "p4" style="display:none;"><input id = "img4" type="file" name="image4" class="filestyle" data-buttonText="&nbsp Добавить изображение" accept="image/png,image/jpeg" ></p>
                            <p id = "p5" style="display:none;"><input  id = "img5" type="file" name="image5" class="filestyle" data-buttonText="&nbsp Добавить изображение" accept="image/png,image/jpeg" ></p>
                            <div style="width: 100%; height: 30px;"><span id="label_sch" style="display: none;">1</span><span id="label_img"></span><a style="float: right; cursor:pointer;" id="linkImg">Добавить ещё изображения</a></div>
                            <button class="btn promo-button"  id="btn_rev">ОСТАВИТЬ ОТЗЫВ</button>
                        </form>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <p class="pull-left">Поля отмеченные знаком <span class="text-danger">*</span> обязательны для
                    заполнения</p>
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="designer-modal" tabindex="-1" role="dialog" aria-labelledby="Вызов дизайнера" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
						class="sr-only">Закрыть</span></button>
				<p class="modal-title h4" id="myModalLabel1">Бесплатнай Вызов Дизайнера</p>
			</div>
			<div class="modal-body">
				<div class="row">
                    <div class="col-sm-6">
						<blockquote>
						<p><u><strong><span style="font-size:18px">Информация</span></strong></u></p>

						<p><span style="font-size:14px">Менеджер свяжется с Вами&nbsp;с 10:00 до 21:00</span></p>

						<p><span style="font-size:14px">В услуги дизайнера входит:</span></p>

						<ul>
							<li><span style="font-size:14px">замер помещения;</span></li>
							<li><span style="font-size:14px">компьютерное проектирование&nbsp;3D-дизайн макета;</span></li>
							<li><span style="font-size:14px">профессиональная консультация;</span></li>
							<li><span style="font-size:14px">предоставление образцов материалов и подбор цветовых решений;</span></li>
							<li><span style="font-size:14px">расчет стоимости;</span></li>
							<li><span style="font-size:14px">оформеление договора.</span></li>
						</ul>

						<p><span style="font-size:14px">Выезд дизайнера <strong>БЕСПЛАТНЫЙ</strong> (в пределах КАД)&nbsp;при заказе кухни. Цена останется такой же, как и при самостоятельном оформлении в интернет-магазине.</span></p>

						<p><span style="font-size:14px">Без оформления заказа&nbsp;выезд дизайнера (в пределах КАД) стоит 500 руб.<br>
						Выезд за пределы КАДа оплачивается отдельно: каждые 50&nbsp;км - 500 руб.</span></p>
						</blockquote>
					</div>
					<div class="col-sm-6">
						<form role="form" action="/site/sendDesigner" method="post" id="designer">
							<div class="form-group">
								<label for="designer-popup-name"><span class="text-danger">*</span> Имя</label>
								<input type="text" name="designer_popup_name" class="form-control" id="designer-popup-name"
								       placeholder="Ваше имя">
							</div>

							<div class="form-group">
								<label for="designer-popup-phone"><span class="text-danger">*</span> Телефон:</label>
								<input type="text" class="form-control" id="designer-popup-phone"
								       name="designer_popup_phone" placeholder="Ваш контактный телефон">
							</div>
							<div class="form-group">
								<label for="designer-popup-address">Ваш адрес:</label>
								<input type="text" class="form-control" id="designer-popup-address"
								       name="designer_popup_address" placeholder="Ваш адрес">
							</div>
							<div class="form-group">
								<label for="designer-popup-time"> Удобное время:</label>
								<input type="text" class="form-control" id="designer-popup-time"
								       name="designer_popup_time" placeholder="Удобное время">
							</div>
							<div class="form-group">
								<label for="designer-popup-comment">Комментарий:</label>
								<textarea class="form-control" id="designer-popup-comment"
								          name="designer_popup_comment" placeholder="Ваш комментарий к звонку"></textarea>
							</div>
							<button type="submit" class="btn promo-button">Заказать вызов дизайнера</button>
						</form>
						<p style="font-size:10px;">Нажимая «Заказать вызов дизайнера», вы даёте согласие на обработку своих персональных данных в соответствии
                        с Федеральным законом №152-ФЗ «О персональных данных» и принимаете <a href="/soglasie.html">условия</a></p>
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<p class="pull-left">Поля отмеченные знаком <span class="text-danger">*</span> обязательны для
					заполнения</p>
				<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>