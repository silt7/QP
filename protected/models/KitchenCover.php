<?php
class KitchenCover extends CActiveRecord {
    public static function model( $className = __CLASS__ ) {
        return parent::model( $className );
    }
    public function tableName() {
        return 'kitchen_cover';
    }
    public function updatePriceCover($id_kitchen,$id_cover,$color_select_cover,$count_select_cover,$options_select_cover,
                                     $extra_size_width,$extra_size_height,$koffCost,$userKitchen,$addition_select_cover) {
        $priceColor = 0; $price = 0; $priceOption = 0;

        if(($color_select_cover != 0) and ($color_select_cover != "")){

            $cover = ItemCover::model()->findByPK($id_cover);
            $colorsCover = $cover->getColors();
            $colorCover = $colorsCover[$color_select_cover];
            $priceColor = $colorCover["price"];

            $options = array();
            $optionsCover = $cover->getOptions();
            if ( $options_select_cover ) {
                foreach ($options_select_cover as $optionItem) {
                    if(isset($optionItem["id"])){    //условия необходимо так как разные массивы из таблицы и из аякс запроса
                        $id = $optionItem["id"];
                    }
                    else{
                        $id = $optionItem;
                    }
                    $optionCover = $optionsCover[$id];
                    $option["id"] 	 = $id;
                    $option["price"] = $optionCover['price'];
                    $option["count"] = 1;
                    $options[$id] = $option;
                    $priceOption += $option["price"] * $option["count"];
                }
            }

            if(($koffCost > 0)and($extra_size_width > 0) and ($extra_size_height > 0)){
                $arrSize = array('koffCost' => $koffCost, 'size_width' => $extra_size_width, 'size_height' => $extra_size_height);
                $priceColor = $priceColor * $koffCost;
            }
            else{
                $arrSize = array();
            }

            $price = $priceColor + $priceOption;

            if($userKitchen!="yes") {
                $kitchencoverCriteria = new CDbCriteria;
                $kitchencoverCriteria->condition = 'id_kitchen = :id_kitchen and id_cover = :id_cover';
                $kitchencoverCriteria->params = array(':id_kitchen' => $id_kitchen, ':id_cover' => $id_cover);
                $kitchencover = KitchenCover::model()->findAll($kitchencoverCriteria);

                foreach ($kitchencover as $item) {
                    $item->selColor = $color_select_cover;
                    $item->price = $price  *  $count_select_cover;
                    $item->selOption = serialize($options);
                    $item->selSize   = serialize($arrSize);
                    $item->count = $count_select_cover;
                    $item->addition = $addition_select_cover;
                    $item->save();
                }
                return $price * $count_select_cover;
            }
            else{
                return $price;
            }
        }
        else{
            return -1;
        }
    }


    public function selectDataCover($id_kitchen,$id_cover){
        if(($id_kitchen=="")or($id_cover =="")){
            return -1;
        }
        else {
            $cover = ItemCover::model()->findByPk($id_cover);
            $kitchencoverCriteria = new CDbCriteria;
            $kitchencoverCriteria->condition = 'id_kitchen = :id_kitchen and id_cover = :id_cover';
            $kitchencoverCriteria->params = array(':id_kitchen' => $id_kitchen, ':id_cover' => $id_cover);
            $KitchenCover = KitchenCover::model()->find($kitchencoverCriteria);

            /*--------------Цвета-------------------------------------------*/
            $colors = $cover->getColors();
            if($colors){
                foreach ($colors as $color) {
                    if ( $color["is_enabled"] ){
                        $colorModel = Color::model()->findByPk( $color["id"] );
                        if (($colorModel) and ($colorModel->is_show == 1)) {
                            $color["price"] = $color["price"];
                            $color["title"] = $colorModel->title;

                            if (!isset($coverToView["colors"])) {
                                $coverToView["colors"] = array();
                            }
                            $coverToView["colors"][$color["id"]] = $color;
                        }
                    }
                }
            }
            else{
                $coverToView["colors"] = array();
            }

            /*--------------Опции-------------------------------------------*/
            $options = $cover->getOptions();
            if ($options) {
                foreach ($options as $option) {
                    if($option["is_enabled"] == 1){
                        $optionModel = ModuleOption::model()->findByPk($option["id"]);
                        if (($optionModel) and ($optionModel->is_show == 1)) {
                            $option["price"] = $option["price"] * $optionModel["price"];
                            $option["title"] = $optionModel->title;
                            $selOption_arr = unserialize($KitchenCover->selOption);
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
                    else{
                        $modulesToView["options"] = array();
                    }
                }
            }
            else{
                $modulesToView["options"] = array();
            }


            $selSize = unserialize($KitchenCover->selSize);

            if(!empty($selSize)){
                $std_h = $selSize["size_height"];
                $std_w = $selSize["size_width"];
                $koffCost  = $selSize["koffCost"];
            }
            else{
                $stdSize = $cover->stdSizeCover();
                $std_h = $stdSize["std_h"];
                $std_w = $stdSize["std_w"];
                $koffCost  = 1;
            }

            return array("selColor"=>$KitchenCover -> selColor,
                "count"=>$KitchenCover -> count,
                "colors"=>$coverToView["colors"],
                "options"=>$modulesToView["options"],
                "extraSize"=>$cover->extra_size,"koffCost"=>$koffCost,
                "stdH"=>$std_h,"stdW"=>$std_w,
                "addition"=>$KitchenCover-> addition);
        }
    }

    public function coverExtraSize($id_cover,$sizeH,$sizeW){
        $koff		= 0;		//коэфициент, который умножается на цену(зависит от заданных размеров покрытия)
        $cover = ItemCover::model()->findBypk($id_cover);
        $options = $cover->getOptions();
        if(isset($options)){
            foreach($options as $option){
                if(isset($option['group'])){
                    if($option['group'] == "no_standard"){
                        if ( $option["id"] == 126 ){
                            $min_w = $option["price"];
                        }
                        if ( $option["id"] == 127 ){
                            $max_w = $option["price"];
                        }
                        if ( $option["id"] == 128 ){
                            $min_h = $option["price"];
                        }
                        if ( $option["id"] == 129 ){
                            $max_h = $option["price"];
                        }
                    }
                }
            }
        }

        if((($sizeH > $max_h) or ($sizeH < $min_h))or(($sizeW > $max_w) or ($sizeW < $min_w))){
            $mess = "Неверно задан размер: Длина от ".$min_h." до ".$max_h.", Ширина от ".$min_w." до ".$max_w;
        }
        else{
            if($id_cover == 16){
                if((($sizeW >600)and($sizeH<=1500))or(($sizeH>1500)and($sizeW<=600))){
                    $koff = 2;
                }
                else if(($sizeH>1500)and($sizeW>600)){
                    $koff = 4;
                }
                else{
                    $koff = 1;
                }
            }
            else if($id_cover == 25){
                if ($sizeW <= 500){
                    $koff = 1;
                } else if($sizeW > 500 and $sizeW <= 1000){
                    $koff = 2;
                } else if ($sizeW > 1000){
                    $koff = 3;
                }
            }
            else if($id_cover == 26){
                if ($sizeW <= 500){
                    $koff = 1;
                } else if($sizeW > 500 and $sizeW <= 1000){
                    $koff = 2;
                } else if ($sizeW > 1000 and $sizeW <= 1500){
                    $koff = 3;
                } else if ($sizeW > 1500){
                    $koff = 4;
                }
            }
            else{
                if ($sizeW > 600 && $sizeW <= $max_w) {
                    $koff = 2;
                } else if ($sizeW >= $min_w and $sizeW <= 600) {
                    $koff = 1;
                }
            }
            $mess = "Размеры установлены!";
        };
        return array('koff' => $koff, 'mess' => $mess);

    }
}
?>