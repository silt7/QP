<?php
	$fronts= ItemFront::model()-> findAll();
	foreach ( $fronts as $front ): 
		
		$frontPriceCriteria            = new CDbCriteria;
		$frontPriceCriteria->condition = 'id_front='.$front["id"];
		
		$price = Price::model()->findAll($frontPriceCriteria);
		$arr_price= array();
		$arr_price_front = array();
		//array_push($arr_price[31], $arr_price_front);
		foreach ( $price as $priceItem ): 
			$id_color = $priceItem["id_color"];
			$price_color = $priceItem["price_color"];
			if($price_color == 0){
				$is_enable = 0;
			}
			else{
				$is_enable = 1;
			}
			$price_fr1 = $priceItem["price_fr1"];
			$price_fr2 = $priceItem["price_fr2"];
			$price_fr3 = $priceItem["price_fr3"];
			$price_fr4 = $priceItem["price_fr4"];
			
			$arr_price[$id_color] = array("id" => $id_color, "is_enabled"=>$is_enable, "price"=>$price_color);
			for($i = 1; $i <=20; $i++){
				$p = "price_fr".$i;
				$arr_price[$id_color][$p] =  $priceItem[$p];
			}
		endforeach;
		$fronts= ItemFront::model()->findByPk($front["id"]); 
		$fronts->colors = serialize($arr_price);
		$fronts->update();
	endforeach;
	$modules= ItemModule::model()-> findAll();
	foreach ( $modules as $module ): 
		
		$modulePriceCriteria            = new CDbCriteria;
		$modulePriceCriteria->condition = 'id_module='.$module["id"];
		
		$price = Price_module::model()->findAll($modulePriceCriteria);
		$arr_price= array();
		$arr_price_modules = array();
		//array_push($arr_price[31], $arr_price_front);
		foreach ( $price as $priceItem ): 
			$id_color = $priceItem["id_color"];
			$price_color = $priceItem["price_color"];
			if($price_color == 0){
				$is_enable = 0;
			}
			else{
				$is_enable = 1;
			}
			$arr_price[$id_color] = array("id" => $id_color, "is_enabled"=>$is_enable, "price"=>$price_color);
		endforeach;
		$modules= ItemModule::model()->findByPk($module["id"]); 
		$modules->colors = serialize($arr_price);
		$modules->update();
	endforeach;
	echo "Обновление завершено!";
?>