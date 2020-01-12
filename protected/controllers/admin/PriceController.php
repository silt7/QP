<?php
Yii::import( 'application.components.Controller' );
Yii::import( 'application.controllers.admin.AdminController' );
Yii::import( 'application.models.ItemModule' );
Yii::import( 'application.models.ItemFront' );
Yii::import( 'application.models.Equipment' );
Yii::import( 'application.models.PriceFrontColor' );
Yii::import( 'application.models.PriceFrontFrez' );
Yii::import( 'application.models.PriceModuleColor' );
Yii::import( 'application.models.PriceEquiment' );

class PriceController extends AdminController {
	public function actionView() {		
/* 		$model=new Price;
        if(isset($_POST['Item'])){
            $model->attributes=$_POST['Item'];
            $model->image=CUploadedFile::getInstance($model,'image');
            if($model->save()){
                $path=Yii::getPathOfAlias('webroot').'/upload/'.$model->image->getName();
                $model->image->saveAs($path);
                // перенаправляем на страницу, где выводим сообщение об
                // успешной загрузке
            }
        } */
		$this->render( 'view' );
	}
	public function actionFrontPrice() {
/*   	$frontPriceCriteria            = new CDbCriteria;
		$frontPriceCriteria->condition = 'id_front=14'; */

		$this->render( 'frontPrice', array());
	}
	public function actionSaveFrontPrice() {
		$excel = $_FILES["Excel"]["name"];
		if($excel == "FrontPrice.xlsx"){
			$path  = Yii::getPathOfAlias( 'webroot' ) . '/excel/' . $excel;
			if(file_exists($path)){
				unlink($path);
			}
			if($_FILES["Excel"]["size"] > 1024*3*1024){
				 $this->render( 'frontPrice', array(
				'msg' => "Размер файла превышает три мегабайта"));
				 exit;
			}
			   // Проверяем загружен ли файл
			if(is_uploaded_file($_FILES["Excel"]["tmp_name"])){
				 // Если файл загружен успешно, перемещаем его
				 // из временной директории в конечную
				 move_uploaded_file($_FILES["Excel"]["tmp_name"], $path);
				if(file_exists($path)){
					try{
						Yii::app()->db->createCommand()->dropTable('PriceFrontColor');
						Yii::app()->db->createCommand()->createTable('PriceFrontColor', array(
								'id' => 'pk',
								'id_front' => 'int',
								'id_category' => 'int',
								'price_category' => 'float',
						));	
					}
					catch(Exception $e){
						Yii::app()->db->createCommand()->createTable('PriceFrontColor', array(
								'id' => 'pk',
								'id_front' => 'int',
								'id_category' => 'int',
								'price_category' => 'float',
						));	
					}
					spl_autoload_unregister(array('YiiBase','autoload'));
					Yii::import("ext.phpexcel.PHPExcel", true);
					$objPHPExcel = new PHPExcel();
					spl_autoload_register(array('YiiBase','autoload'));
					$objPHPExcel = PHPExcel_IOFactory::load($path);				
					$worksheet = $objPHPExcel->getSheetByName('Color');
					$worksheetTitle     = $worksheet->getTitle();
					$highestRow         = $worksheet->getHighestRow(); // например, 10
					$highestColumn      = $worksheet->getHighestColumn(); // например, 'F'
					$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
					$nrColumns = ord($highestColumn) - 64;
					//echo "<br>В таблице ".$worksheetTitle." ";
					//echo $nrColumns . ' колонок (A-' . $highestColumn . ') ';
					//echo ' и ' . $highestRow . ' строк.';
					
					for ($row = 1; $row <= $highestRow; ++ $row)
					{
						
						$arr_row = array();
						for ($col = 0; $col < $highestColumnIndex; ++ $col) 
						{
							$cell = $worksheet->getCellByColumnAndRow($col, $row);
							$val = $cell->getValue();			
							$dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
							/* echo '<td>' . $val . '<br>(Тип ' . $dataType . ')</td>'; */
							$arr_row[] = $val."<br>";
							

						}
						
						//echo $arr_row[3];
						//print_r($arr_row); echo "||||";
						//echo $row." yyy ".$arr_row[0]." | ".$arr_row[1]." | ".$arr_row[2]; echo "<br>";
						$command = Yii::app()->db->createCommand()
								->insert('PriceFrontColor', array(
											'id_front' => $arr_row[0],
											'id_category' => $arr_row[1],
											'price_category' => $arr_row[2],
						));

					}

					
					try{
						Yii::app()->db->createCommand()->dropTable('PriceFrontFrez');
						Yii::app()->db->createCommand()->createTable('PriceFrontFrez', array(
								'id' => 'pk',
								'id_front' => 'int',
								'id_category' => 'int',
								'price_fr1' => 'int', 'price_fr2' => 'int', 'price_fr3' => 'int', 'price_fr4' => 'int',
								'price_fr5' => 'int', 'price_fr6' => 'int', 'price_fr7' => 'int', 'price_fr8' => 'int',
								'price_fr9' => 'int', 'price_fr10' => 'int', 'price_fr11' => 'int', 'price_fr12' => 'int',
								'price_fr13' => 'int', 'price_fr14' => 'int', 'price_fr15' => 'int', 'price_fr16' => 'int',
								'price_fr17' => 'int', 'price_fr18' => 'int', 'price_fr19' => 'int', 'price_fr20' => 'int'
						));	
					}
					catch(Exception $e2){
						Yii::app()->db->createCommand()->createTable('PriceFrontFrez', array(
								'id' => 'pk',
								'id_front' => 'int',
								'id_category' => 'int',
								'price_fr1' => 'int', 'price_fr2' => 'int', 'price_fr3' => 'int', 'price_fr4' => 'int',
								'price_fr5' => 'int', 'price_fr6' => 'int', 'price_fr7' => 'int', 'price_fr8' => 'int',
								'price_fr9' => 'int', 'price_fr10' => 'int', 'price_fr11' => 'int', 'price_fr12' => 'int',
								'price_fr13' => 'int', 'price_fr14' => 'int', 'price_fr15' => 'int', 'price_fr16' => 'int',
								'price_fr17' => 'int', 'price_fr18' => 'int', 'price_fr19' => 'int', 'price_fr20' => 'int'
						));	
					}
										spl_autoload_unregister(array('YiiBase','autoload'));
					Yii::import("ext.phpexcel.PHPExcel", true);
					$objPHPExcel = new PHPExcel();
					spl_autoload_register(array('YiiBase','autoload'));
					$objPHPExcel = PHPExcel_IOFactory::load($path);				
					$worksheet = $objPHPExcel->getSheetByName('Frez');
					$worksheetTitle     = $worksheet->getTitle();
					$highestRow         = $worksheet->getHighestRow(); // например, 10
					$highestColumn      = $worksheet->getHighestColumn(); // например, 'F'
					$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
					$nrColumns = ord($highestColumn) - 64;
					//echo "<br>В таблице ".$worksheetTitle." ";
					//echo $nrColumns . ' колонок (A-' . $highestColumn . ') ';
					//echo ' и ' . $highestRow . ' строк.';	
					for ($row = 1; $row <= $highestRow; ++ $row)
					{
						
						$arr_row = array();
						for ($col = 0; $col < 22; ++ $col) 
						{
							$cell = $worksheet->getCellByColumnAndRow($col, $row);
							$val = $cell->getValue();			
							$dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
							/* echo '<td>' . $val . '<br>(Тип ' . $dataType . ')</td>'; */
							$arr_row[] = $val."<br>";
							

						}
				
						
						//echo $arr_row[3];
						//print_r($arr_row); echo "||||";
						$command = Yii::app()->db->createCommand()
								->insert('PriceFrontFrez', array(
											'id_front' => $arr_row[0],
											'id_category' => $arr_row[1],
											'price_fr1' => $arr_row[2], 'price_fr2' => $arr_row[3], 'price_fr3' => $arr_row[4], 'price_fr4' => $arr_row[5],
											'price_fr5' => $arr_row[6], 'price_fr6' => $arr_row[7], 'price_fr7' => $arr_row[8], 'price_fr8' => $arr_row[9],
											'price_fr9' => $arr_row[10], 'price_fr10' => $arr_row[11], 'price_fr11' => $arr_row[12], 'price_fr12' => $arr_row[13],
											'price_fr13' => $arr_row[14], 'price_fr14' => $arr_row[15], 'price_fr15' => $arr_row[16], 'price_fr16' => $arr_row[17],
											'price_fr17' => $arr_row[18], 'price_fr18' => $arr_row[19], 'price_fr19' => $arr_row[20],
											'price_fr20' => $arr_row[21]
						));

					}
					$url = $this->createAbsoluteUrl( 'admin/price/view' );
					$this->redirect( $url, true );
				}
			}
			else{
				$this->render( 'frontPrice', array(
				'msg' => "Ошибка загрузки файла"));
				exit;
			}
		}
		else{
			$this->render( 'frontPrice', array(
			'msg' => "* Файл не выбран или не верное имя файла!"));
		}
	}
	public function actionModulePrice() {

		$this->render( 'modulePrice', array());
	}
	public function actionSaveModulePrice() {
		$excel = $_FILES["Excel"]["name"];
		if($excel == "ModulePrice.xlsx"){
			$path  = Yii::getPathOfAlias( 'webroot' ) . '/excel/' . $excel;
			if(file_exists($path)){
				unlink($path);
			}
			if($_FILES["Excel"]["size"] > 1024*3*1024){
				 $this->render( 'modulePrice', array(
				'msg' => "Размер файла превышает три мегабайта"));
				 exit;
			}
			   // Проверяем загружен ли файл
			if(is_uploaded_file($_FILES["Excel"]["tmp_name"])){
				 // Если файл загружен успешно, перемещаем его
				 // из временной директории в конечную
				 move_uploaded_file($_FILES["Excel"]["tmp_name"], $path);
				if(file_exists($path)){
					try{
						Yii::app()->db->createCommand()->dropTable('PriceModuleColor');
						Yii::app()->db->createCommand()->createTable('PriceModuleColor', array(
							'id' => 'pk',
							'id_module' => 'int',
							'id_color' => 'int',
							'price_color' => 'float',
						));	
					}
					catch(Exception $e){
						Yii::app()->db->createCommand()->createTable('PriceModuleColor', array(
							'id' => 'pk',
							'id_module' => 'int',
							'id_color' => 'int',
							'price_color' => 'float',
						));	
					}
					spl_autoload_unregister(array('YiiBase','autoload'));
					Yii::import("ext.phpexcel.PHPExcel", true);
					$objPHPExcel = new PHPExcel();
					spl_autoload_register(array('YiiBase','autoload'));
					$objPHPExcel = PHPExcel_IOFactory::load($path);				
					$worksheet = $objPHPExcel->getSheetByName('Лист1');
					$worksheetTitle     = $worksheet->getTitle();
					$highestRow         = $worksheet->getHighestRow(); // например, 10
					$highestColumn      = $worksheet->getHighestColumn(); // например, 'F'
					$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
					$nrColumns = ord($highestColumn) - 64;
					//echo "<br>В таблице ".$worksheetTitle." ";
					//echo $nrColumns . ' колонок (A-' . $highestColumn . ') ';
					//echo ' и ' . $highestRow . ' строк.';
					
					for ($row = 1; $row <= $highestRow; ++ $row)
					{
						
						$arr_row = array();
						for ($col = 0; $col < $highestColumnIndex; ++ $col) 
						{
							$cell = $worksheet->getCellByColumnAndRow($col, $row);
							$val = $cell->getValue();			
							$dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
							/* echo '<td>' . $val . '<br>(Тип ' . $dataType . ')</td>'; */
							$arr_row[] = $val."<br>";
							

						}
						
						//echo $arr_row[3];
						//print_r($arr_row); echo "||||";
						$command = Yii::app()->db->createCommand()
								->insert('PriceModuleColor', array(
											'id_module' => $arr_row[0],
											'id_color' => $arr_row[1],
											'price_color' => $arr_row[2],
						));

					}
					
					$modules= ItemModule::model()-> findAll();
					foreach ( $modules as $module ): 
						
						$modulePriceCriteria            = new CDbCriteria;
						$modulePriceCriteria->condition = 'id_module='.$module["id"];
						
						$price = PriceModuleColor::model()->findAll($modulePriceCriteria);
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
					
					$url = $this->createAbsoluteUrl( 'admin/price/view' );
					$this->redirect( $url, true );
				}
			}
			else{
				$this->render( 'modulePrice', array(
				'msg' => "Ошибка загрузки файла"));
				exit;
			}
		}
		else{
			$this->render( 'modulePrice', array(
			'msg' => "* Файл не выбран или не верное имя файла!"));
		}
	}
	
	public function actionEquipmentPrice() {

		$this->render( 'equipmentPrice', array());
	}
	public function actionSaveEquipmentPrice() {
		$excel = $_FILES["Excel"]["name"];
		if($excel == "EquipmentPrice.xlsx"){
			$path  = Yii::getPathOfAlias( 'webroot' ) . '/excel/' . $excel;
			if(file_exists($path)){
				unlink($path);
			}
			if($_FILES["Excel"]["size"] > 1024*3*1024){
				 $this->render( 'equipmentPrice', array(
				'msg' => "Размер файла превышает три мегабайта"));
				 exit;
			}
			   // Проверяем загружен ли файл
			if(is_uploaded_file($_FILES["Excel"]["tmp_name"])){
				 // Если файл загружен успешно, перемещаем его
				 // из временной директории в конечную
				 move_uploaded_file($_FILES["Excel"]["tmp_name"], $path);
				if(file_exists($path)){
					try{
						Yii::app()->db->createCommand()->dropTable('PriceEquipment');
						Yii::app()->db->createCommand()->createTable('PriceEquipment', array(
							'id' => 'pk',
							'articulus' => 'text',
							'price' => 'float',
							//'price2' => 'float',
						));	
					}
					catch(Exception $e){
						Yii::app()->db->createCommand()->createTable('PriceEquipment', array(
							'id' => 'pk',
							'articulus' => 'text',
							'price' => 'float',
							//'price2' => 'float',
						));	
					}
					spl_autoload_unregister(array('YiiBase','autoload'));
					Yii::import("ext.phpexcel.PHPExcel", true);
					$objPHPExcel = new PHPExcel();
					spl_autoload_register(array('YiiBase','autoload'));
					$objPHPExcel = PHPExcel_IOFactory::load($path);				
					$worksheet = $objPHPExcel->getSheetByName('Лист1');
					$worksheetTitle     = $worksheet->getTitle();
					$highestRow         = $worksheet->getHighestRow(); // например, 10
					$highestColumn      = $worksheet->getHighestColumn(); // например, 'F'
					$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
					$nrColumns = ord($highestColumn) - 64;
					//echo "<br>В таблице ".$worksheetTitle." ";
					//echo $nrColumns . ' колонок (A-' . $highestColumn . ') ';
					//echo ' и ' . $highestRow . ' строк.';


					Equipment::model()->updateAll(array('price'=>0,'is_show'=>0));

					for ($row = 1; $row <= $highestRow; ++ $row)
					{
						
						$arr_row = array();
						for ($col = 0; $col < $highestColumnIndex; ++ $col) 
						{
							$cell = $worksheet->getCellByColumnAndRow($col, $row);
							$val = $cell->getValue();			
							$dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
							/* echo '<td>' . $val . '<br>(Тип ' . $dataType . ')</td>'; */
							$arr_row[] = $val;
							

						}
						
						//echo $arr_row[3];
						//print_r($arr_row); echo "||||";
						$command = Yii::app()->db->createCommand()
								->insert('PriceEquipment', array(
											'articulus' => $arr_row[1],
											'price' => $arr_row[2],
						));
						if($arr_row[1] != ""){
							$articulus = addcslashes(trim($arr_row[1]), '%_');
							$equipmentCriteria = new CDbCriteria;
							$equipmentCriteria->condition = 'title LIKE :articul';
							$equipmentCriteria->params    = array( ':articul' =>  "%$articulus%");
							$itemEquipment = Equipment::model()->find( $equipmentCriteria );
							if(!empty($itemEquipment)){
								//$itemEquipment -> articulus = 0;
								$itemEquipment -> price = $arr_row[2];
								$itemEquipment -> is_show = 1;
								$itemEquipment->update();
							}

						}

					}

//					$equipmentCriteria = new CDbCriteria;
//					$equipmentCriteria->condition = 'articulus = 0';
//					Equipment::model()->updateAll(array('price'=>0,'is_show'=>0), $equipmentCriteria );
			
/* 					$modules= Equipment::model()-> findAll();
					foreach ( $modules as $module ): 
						
						$modulePriceCriteria            = new CDbCriteria;
						$modulePriceCriteria->condition = 'id_module='.$module["id"];
						
						$price = PriceEquipment::model()->findAll($modulePriceCriteria);
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
					endforeach; */
					
					$url = $this->createAbsoluteUrl( 'admin/price/view' );
					$this->redirect( $url, true );
				}
			}
			else{
				$this->render( 'equipmentPrice', array(
				'msg' => "Ошибка загрузки файла"));
				exit;
			}
		}
		else{
			$this->render( 'equipmentPrice', array(
			'msg' => "* Файл не выбран или не верное имя файла!"));
		}
	}
}
?>