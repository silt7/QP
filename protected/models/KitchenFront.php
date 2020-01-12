<?php
Yii::import( 'application.models.PriceFrontFrez' );
class KitchenFront extends CActiveRecord {
    public static function model( $className = __CLASS__ ) {
        return parent::model( $className );
    }
    public function tableName() {
        return 'kitchen_front';
    }


    public function updatePriceFront($id_kitchen,$id_front,$selColorFront,$count,$selOption,$userKitchen,$addition_select_front,$id_kitchenFront) {
        $id_kitchen 		 = $id_kitchen;
        $id_front			 = $id_front;
        $color_select_front  = $selColorFront;
        $count_select_front = $count;
        $options_select_front = $selOption;
        $userKitchen = $userKitchen;

        if(($color_select_front != 0) and ($color_select_front != "")){
            $priceFront = 0;
            if($color_select_front != -1){
                $front = ItemFront::model()->findByPk($id_front);
                $color = Color::model()->findByPk($color_select_front);

                $categColorCriteria = new CDbCriteria;
                $categColorCriteria->condition = 'name=:material';
                $categColorCriteria->params = array(':material' => $color->material);
                $categColor = ColorCategory::model()->find($categColorCriteria);

                $frontCriteria = new CDbCriteria;
                $frontCriteria->condition = 'id_front=:id_front and id_category=:id_category';
                $frontCriteria->params = array(':id_front' => $front["id"], ':id_category' => $categColor->id);
                $PriceFrontColor = PriceFrontColor::model()->find($frontCriteria);
                if(!empty($PriceFrontColor)){
                    $priceFront = $PriceFrontColor->price_category;
                }
            }

            $price = $priceFront;

            $options = array();
            if ( $options_select_front ) {
                foreach ($options_select_front as $optionItem) {

                    if(isset($optionItem["id"])){    //условия необходимо так как разные массивы из таблицы и из аякс запроса
                        $id = $optionItem["id"];
                    }
                    else{
                        $id = $optionItem;
                    }

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
                    $frontCriteria->params = array(':id_front' => $id_front, ':id_category' => $categColor->id);
                    $PriceFrontFrez = PriceFrontFrez::model()->find($frontCriteria);

                    $optionModel = ModuleOption::model()->findByPk($id);
                    if (!empty($optionModel)) {
                        $front_count = ItemFront::model()->findByPk($id_front);
                        if(!empty($front_count)) {
                            $front_options = unserialize($front_count->options);
                            if (isset($front_options[$id])) {
                                $countOption = $front_options[$id];
                                $countOption = $countOption["price"];
                            }
                            else if(!empty($PriceFrontFrez)) {

                                $optionMilling = new CDbCriteria;
                                $optionMilling->condition = '`group` LIKE "milling"';
                                $optionMilling = ModuleOption::model()->findAll($optionMilling);

                                $arr = array();
                                $i = 1;
                                foreach ($optionMilling as $item) {
                                    $Fr = 'price_fr' . $i;
                                    $arr[$item['id']] = $Fr;
                                    $i++;
                                }

                                if ((isset($PriceFrontFrez)) and (isset($arr[$id]))) {
                                    $id = $arr[$id];
                                    if ($PriceFrontFrez[$id] >= $PriceFrontColor->price_category) {
                                        $countOption = $PriceFrontFrez[$id] - $PriceFrontColor->price_category;
                                    } else {
                                        $countOption = $PriceFrontColor->price_category - $PriceFrontFrez[$id];
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
                $kitchenfrontCriteria = new CDbCriteria;
				if($id_kitchenFront==""){
					$kitchenfrontCriteria->condition = 'id_kitchen = :id_kitchen and id_front = :id_front';
					$kitchenfrontCriteria->params = array(':id_kitchen' => $id_kitchen, ':id_front' => $id_front);
				}
				else{
					$kitchenfrontCriteria->condition = 'id = :id';
					$kitchenfrontCriteria->params = array(':id' => $id_kitchenFront);
				}
                $kitchenfront = KitchenFront::model()->findAll($kitchenfrontCriteria);

                foreach ($kitchenfront as $item) {
                    $item->selColor = $color_select_front;
                    $item->price = $price  *  $count_select_front;
                    $item->selOption = serialize($options);
                    $item->count = $count_select_front;
                    $item->addition = $addition_select_front;
                    $item->update();
                }
                return $price  *  $count_select_front;
            }
            else{
                return $price;
            }
        }
        else{
            return -1;
        }
    }


    public function selectDataFront($id_kitchen,$id_front,$id_kitchenFront){
        if(($id_kitchen=="")or($id_front =="")){
            return -1;
            ///echo $this->messageJsonOk("error!");
        }
        else {
            $front = ItemFront::model()->findByPk($id_front);
            $kitchenfrontCriteria = new CDbCriteria;
            //$kitchenfrontCriteria->condition = 'id_kitchen = :id_kitchen and id_front = :id_front';
            //$kitchenfrontCriteria->params = array(':id_kitchen' => $id_kitchen, ':id_front' => $id_front);
			$kitchenfrontCriteria->condition = 'id = :id';
            $kitchenfrontCriteria->params = array(':id' => $id_kitchenFront); 
            $KitchenFront = KitchenFront::model()->find($kitchenfrontCriteria);

            /*--------------Опции-------------------------------------------*/
            $options = $front->getOptions();
            if ($options) {
                foreach ($options as $option) {
                    $optionModel = ModuleOption::model()->findByPk($option["id"]);
                    if (($optionModel) and ($optionModel->is_show == 1)) {
                        $option["price"] = $option["price"] * $optionModel["price"];
                        $option["title"] = $optionModel->title;
                        $option["pre_pay"] = $option["price"] * $front["pre_pay"] / 100;

                        $selOption_arr = unserialize($KitchenFront->selOption);
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
            else{
                $modulesToView["options"] = array();
            }

            /*--------------Добавление фрезеровок в опции-------------------------------------------*/

            if($KitchenFront->selColor > 0){
                $optionMilling = new CDbCriteria;
                $optionMilling->condition = '`group` LIKE "milling"';
                $optionMilling = ModuleOption::model()->findAll($optionMilling);
               
               //isset($KitchenFront->selColor) ? $selColor = $KitchenFront->selColor : 29
                $color = Color::model()->findByPk($KitchenFront->selColor);
    
    			//file_put_contents('log.txt', print_r($p, 1), FILE_APPEND);
                $categColorCriteria = new CDbCriteria;
                $categColorCriteria->condition = 'name=:material';
                $categColorCriteria->params = array(':material' => $color->material);
                $categColor = ColorCategory::model()->find($categColorCriteria);
    
                $frontCriteria = new CDbCriteria;
                $frontCriteria->condition = 'id_front=:id_front and id_category=:id_category';
                $frontCriteria->params = array(':id_front' => $id_front, ':id_category' => $categColor->id);
                $PriceFrontFrez = PriceFrontFrez::model()->find($frontCriteria);
                $i = 1;
                foreach ($optionMilling as $item) {
                    $title = 'price_fr' . $i;
                    if (($item->is_show == 1)and($PriceFrontFrez[$title] > 0)) {
                        $optionFront["id"]	  = $item["id"];
                        $optionFront["is_enabled"]	  = 1;
                        $optionFront["price"] = $PriceFrontFrez[$title];
                        $optionFront["title"] = $item['title'];
    
                        //$option["pre_pay"] = $option["price"] * $module["pre_pay"] / 100;
    
                        $selOption_arr = unserialize($KitchenFront->selOption);
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
                    $i++;
                }
            }
            return array("selColor"=>$KitchenFront -> selColor,"count" =>$KitchenFront -> count,
                "options"=>$modulesToView["options"],"addition"=>$KitchenFront -> addition );
//                echo $this->messageJsonOk('{"selColor":'.$KitchenFront -> selColor.',
//										"count":'.$KitchenFront -> count.',
//										"options":'.json_encode( $modulesToView["options"] ).'}');
        }
    }
}
?>