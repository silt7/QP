<?php
Yii::import( 'application.models.PriceFrontFrez' );

class KitchenModule  extends CActiveRecord {
    public static function model( $className = __CLASS__ ) {
        return parent::model( $className );
    }
    public function tableName() {
        return 'kitchen_module';
    }

    public function updatePriceModule($id_kitchen,$id_module,$selColorModule,$selColorFront,$count,$selOption,$userKitchen,$addition_select_module,$id_kitchenModule){
        $id_kitchen 		 = $id_kitchen;
        $id_module			 = $id_module;
        $color_select_module = $selColorModule;
        $color_select_front  = $selColorFront;
        $count_select_module = $count;
        $options_select_module = $selOption;
        if(($color_select_module != 0) and ($color_select_module != "")){
            $priceCriteria            = new CDbCriteria;
            $priceCriteria->select    = 'price_color';
            $priceCriteria->condition = 'id_module=:id_module and id_color =:id_color';
            $priceCriteria->params    = array( ':id_module' => $id_module, ':id_color' => $color_select_module);
            $priceModule =  PriceModuleColor::model()->find($priceCriteria);

            $priceFront = 0;
            if(($color_select_front != 0) and ($color_select_front != "")){
                if($color_select_front == -1){
                    $priceFront = 0;
                }
                else{
                    $moduleItem = ItemModule::model()->findByPk($id_module);
                    foreach(unserialize($moduleItem->fronts) as $front) {
                        $color = Color::model()->findByPk($color_select_front);

                        $categColorCriteria = new CDbCriteria;
                        $categColorCriteria->condition = 'name=:material';
                        $categColorCriteria->params = array(':material' => $color->material);
                        $categColor = ColorCategory::model()->find($categColorCriteria);

                        $frontCriteria = new CDbCriteria;
                        $frontCriteria->condition = 'id_front=:id_front and id_category=:id_category';
                        $frontCriteria->params = array(':id_front' => $front["id"], ':id_category' => $categColor->id);
                        $PriceFrontColor = PriceFrontColor::model()->find($frontCriteria);
                        $priceFront += $PriceFrontColor->price_category * $front["count"];
                    }
                }
                $price = ($priceModule -> price_color + $priceFront);

                $options = array();
                if ($options_select_module ) {
                    foreach ($options_select_module as $optionItem) {
                        if(isset($optionItem["id"])){    //условия необходимо так как разные массивы из таблицы и из аякс запроса
                            $id = $optionItem["id"];
                        }
                        else{
                            $id = $optionItem;
                        }
                        $optionModel = ModuleOption::model()->findByPk($id);
                        if (!empty($optionModel)) {
                            $module_count = ItemModule::model()->findByPk($id_module);
                            if(!empty($module_count)){
                                $module_options = unserialize($module_count -> options);
                                if(isset($module_options[$id])){
                                    $countOption = $module_options[$id];
                                    $countOption = $countOption["price"];
                                }
                                else
                                {
                                    $moduleItem = ItemModule::model()->findByPk($id_module);
                                    $fronts = unserialize($moduleItem->fronts);
                                    if (!empty($fronts)){
                                        foreach ($fronts as $item2) {
                                            if ($item2["is_enabled"] == 1) {
                                                $color = Color::model()->findByPk($color_select_front);

                                                $categColorCriteria = new CDbCriteria;
                                                $categColorCriteria->condition = 'name=:material';
                                                $categColorCriteria->params = array(':material' => $color->material);
                                                $categColor = ColorCategory::model()->find($categColorCriteria);

                                                $frontCriteria = new CDbCriteria;
                                                $frontCriteria->condition = 'id_front=:id_front and id_category=:id_category';
                                                $frontCriteria->params = array(':id_front' => $front["id"], ':id_category' => $categColor->id);
                                                $PriceFrontColor = PriceFrontColor::model()->find($frontCriteria);

                                                $frontCriteria = new CDbCriteria;
                                                $frontCriteria->condition = 'id_front=:id_front and id_category=:id_category';
                                                $frontCriteria->params = array(':id_front' => $item2["id"], ':id_category' => $categColor->id);
                                                $PriceFrontFrez = PriceFrontFrez::model()->find($frontCriteria);

                                                $optionMilling = new CDbCriteria;
                                                $optionMilling->condition = '`group` LIKE "milling"';
                                                $optionMilling = ModuleOption::model()->findAll($optionMilling);

                                                $arr = array();
                                                $i = 1;
                                                foreach($optionMilling as $item3){
                                                    $Fr = 'price_fr'.$i;
                                                    $arr[$item3['id']] = $Fr;
                                                    $i++;
                                                }
                                                if((isset($PriceFrontFrez))and(isset($arr[$id]))){
                                                    $p = $arr[$id];
                                                    if($PriceFrontFrez[$p] >= $PriceFrontColor->price_category){
                                                        $countOption = $PriceFrontFrez[$p] - $PriceFrontColor->price_category;
                                                    }
                                                    else{
                                                        $countOption = $PriceFrontColor->price_category - $PriceFrontFrez[$p];
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            else{
                                $countOption = 0;
                            }
                            $option["id"] 	 = $optionModel['id'];
                            $option["price"] = $optionModel['price'];
                            $option["count"] = $countOption;
                            $options[$id] = $option;
                            $price += $option["price"] * $option["count"];
                        }
                    }
                }

                if($userKitchen!="yes") {
                    $kitchenmoduleCriteria = new CDbCriteria;
					if($id_kitchenModule==""){
						$kitchenmoduleCriteria->condition = 'id_kitchen = :id_kitchen and id_module = :id_module';
						$kitchenmoduleCriteria->params = array(':id_kitchen' => $id_kitchen, ':id_module' => $id_module);
					}
					else{
						$kitchenmoduleCriteria->condition = 'id = :id';
						$kitchenmoduleCriteria->params = array(':id' => $id_kitchenModule);
					}
                    $kitchenmodule = KitchenModule::model()->findAll($kitchenmoduleCriteria);

                    foreach ($kitchenmodule as $item) {
                        $item->selColorModule = $color_select_module;
                        $item->selColorFront = $color_select_front;
                        $item->price = $price  *  $count_select_module;
                        $item->selOption = serialize($options);
                        $item->count = $count_select_module;
                        $item->addition = $addition_select_module;
                        $item->update();
                    }
                    return $price  *  $count_select_module;
                }
                else{
                    return $price;
                }
            }
            else{
                return -1;
            }
        }
        else{
            //echo $this->messageJsonOk("Не верно заданы параметры!");
            return -1;
        }

    }
    public function selectDataModule($id_kitchen,$id_module,$id_kitchenModule){
        if(($id_kitchen=="")or($id_module =="")){
            //echo $this->messageJsonOk("error!");
            return -1;
        }
        else {
            $module = ItemModule::model()->findByPk($id_module);
            $kitchenmoduleCriteria = new CDbCriteria;
			if($id_kitchenModule==""){
				$kitchenmoduleCriteria->condition = 'id_kitchen = :id_kitchen and id_module = :id_module';
				$kitchenmoduleCriteria->params = array(':id_kitchen' => $id_kitchen, ':id_module' => $id_module);
			}
			else{
				$kitchenmoduleCriteria->condition = 'id = :id';
				$kitchenmoduleCriteria->params = array(':id' => $id_kitchenModule);
			}
            $KitchenModule = KitchenModule::model()->find($kitchenmoduleCriteria);

            /*--------------Опции модуля-------------------------------------------*/
            $options = $module->getOptions();
            if ($options) {
                foreach ($options as $option) {
                    $optionModel = ModuleOption::model()->findByPk($option["id"]);
                    if (($optionModel) and ($optionModel->is_show == 1)) {
                        $option["price"] = $option["price"] * $optionModel["price"];
                        $option["title"] = $optionModel->title;
                        $option["pre_pay"] = $option["price"] * $module["pre_pay"] / 100;

                        $selOption_arr = unserialize($KitchenModule->selOption);
                        if (isset($selOption_arr[$option["id"]])) {
                            $option["sel_option"] = 'y';
                        } else {
                            $option["sel_option"] = 'n';
                        }


                        if (!isset($modulesToView["options"][$option["group"]])) {
                            $modulesToView["options"][$option["group"]] = array();
                        }
                        $modulesToView["options"][$option["group"]][$optionModel["id"]] = $option;
                    }
                }
            }
            /*--------------END Опции модуля-------------------------------------------*/


            /*----------------------Фасады:(добавление опций: фрезеровок)---------------------------------------*/
            if($KitchenModule->selColorFront > 0){
                $fronts = unserialize($module->fronts);
                if (!empty($fronts)) {
                    foreach ($fronts as $item) {
                        if ($item["is_enabled"] == 1) {
                            $color = Color::model()->findByPk($KitchenModule->selColorFront);

                            $categColorCriteria = new CDbCriteria;
                            $categColorCriteria->condition = 'name=:material';
                            $categColorCriteria->params = array(':material' => $color->material);
                            $categColor = ColorCategory::model()->find($categColorCriteria);

                            $frontCriteria = new CDbCriteria;
                            $frontCriteria->condition = 'id_front=:id_front and id_category=:id_category';
                            $frontCriteria->params = array(':id_front' => $item["id"], ':id_category' => $categColor->id);
                            $PriceFrontOption = PriceFrontFrez::model()->find($frontCriteria);

                            $optionMilling = new CDbCriteria;
                            $optionMilling->condition = '`group` LIKE "milling"';
                            $optionMilling = ModuleOption::model()->findAll($optionMilling);

                            // сформировать правильный список фрезеровок $optionMilling
                            // исключающий дубликаты или нулевые значения если фасадов более одного

                            $i = 1;
                            $optionFront = array('id' => 1, 'group' => 'milling', 'is_enabled' => 1, 'price' => 0);
                            foreach ($optionMilling as $item) {
                                $title = 'price_fr' . $i;
                                if (($item->is_show == 1) and ($PriceFrontOption[$title] > 0)) {
                                    $optionFront["id"] = $item["id"];
                                    $optionFront["price"] = $PriceFrontOption[$title];
                                    $optionFront["title"] = $item['title'];

                                    //$option["pre_pay"] = $option["price"] * $module["pre_pay"] / 100;

                                    $selOption_arr = unserialize($KitchenModule->selOption);
                                    if (isset($selOption_arr[$item["id"]])) {
                                        $optionFront["sel_option"] = 'y';
                                    } else {
                                        $optionFront["sel_option"] = 'n';
                                    }


                                    if (!isset($modulesToView["options"][$item ["group"]])) {
                                        $modulesToView["options"][$item["group"]] = array();
                                    }
                                    $modulesToView["options"][$item["group"]][$item["id"]] = $optionFront;
                                }
                            }
                        }
                    }
                }
            }

            /*---------------------END Фасады:(добавление опций: фрезеровок)--------------------------*/

            return array("selColorModule" => $KitchenModule -> selColorModule, "selColorFront" =>$KitchenModule -> selColorFront,
                "count" => $KitchenModule -> count, "options" => $modulesToView["options"], "addition" => $KitchenModule -> addition );
//            echo $this->messageJsonOk('{"selColorModule":'.$KitchenModule -> selColorModule.',
//										"selColorFront":'.$KitchenModule -> selColorFront.',
//										"count":'.$KitchenModule -> count.',
//										"options":'.json_encode( $modulesToView["options"] ).'}');
        }
    }
}
?>