<?php

Yii::import( 'application.components.Controller' );
Yii::import( 'application.controllers.admin.AdminController' );

Yii::import( 'application.models.Order' );
Yii::import( 'application.models.Color' );


class OrderController extends AdminController {


	/**
	 * Список заказов
	 */
	public function actionView() {

		$ordersCriteria        = new CDbCriteria;
		$ordersCriteria->order = 'id DESC';

		$orders = Order::model()->findAll( $ordersCriteria );

		$this->pageTitle = "Редактирование заказов";
		$this->layout    = 'auth';
		$this->render( 'view', array( 'orders' => $orders ) );
	}


	/**
	 * Редактирование заказа
	 */
	public function actionEdit( $id ) {

		$order = Order::model()->findByPk( $id );

		$this->pageTitle = "Редактирование заказа";
		$this->layout    = 'auth';
		$this->render( 'edit', array( 'order' => $order ) );
	}


	/**
	 * Сохранение заказа
	 */
	public function actionSave() {

		// todo обработка строк заказа

		$id     = Yii::app()->request->getPost( "id" );
		$status = Yii::app()->request->getPost( "status" );

		print_r( $status );

		$order         = Order::model()->findByPk( $id );
		$order->status = $status;
		$order->update();


		$url = $this->createAbsoluteUrl( 'admin/order/view' );
		$this->redirect( $url, true );
	}

	/**
	 * Удаление заказа
	 */
	public function actionDelete( $id ) {

		$order = Order::model()->findByPk( $id );
		if ( $order ) {
			$order->delete();
		}

		$url = $this->createAbsoluteUrl( 'admin/order/view' );
		$this->redirect( $url, true );

	}
	public function actionDownload($id) {
	    $order = Order::model()->findByPk( $id );
	    $items = $order->getLinesToView();
	    spl_autoload_unregister(array('YiiBase','autoload'));
        Yii::import("ext.phpexcel.PHPExcel", true);
        // Подключаем класс для вывода данных в формате excel
        require_once PHPEXCEL_ROOT . 'PHPExcel/Writer/Excel5.php';
        spl_autoload_register(array('YiiBase','autoload'));
        // Создаем объект класса PHPExcel
        $xls = new PHPExcel();
        // Устанавливаем индекс активного листа
        $xls->setActiveSheetIndex(0);
        // Получаем активный лист
        $sheet = $xls->getActiveSheet();
        // Подписываем лист
        $sheet->setTitle('Заказ');
        
        $sheet->setCellValue("A1", '№');
        $sheet->setCellValue("B1", 'Товар');
        $sheet->setCellValue("C1", 'Опции');
        $sheet->setCellValue("D1", 'Количество');
        $sheet->setCellValue("E1", 'Цена');
        //$sheet->setCellValue("F1", 'Сумма без аванса');
        //$sheet->setCellValue("G1", 'Аванс');
        //$sheet->setCellValue("H1", 'Сумма');
        $sheet->setCellValue("F1", 'Аванс %');
        //$sheet->setCellValue("J1", 'Сумма %');
        $sheet->setCellValue("G1", 'НДС');
        $xls->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        /*$sheet->getStyle('A1')->getFill()->setFillType(
            PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('A1:H1')->getFill()->getStartColor()->setRGB('EEEEEE');*/
        
        // Объединяем ячейки
        //$sheet->mergeCells('A1:H1');
        
        /* Выравнивание текста
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(
            PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        */
        $row=2;
        foreach($items as $itemCollection){
            foreach ( $itemCollection["items"] as $orderLine ){
                $optionsOrder = "";
                foreach ( $itemCollection[ $orderLine->id ]["options_checked"] as $option ){
							$optionsOrder .= $option["title"]." \n\t";
				}
				$optionsOrder .= isset( $itemCollection["cover_width"] ) ? "Ширина : " . $itemCollection["cover_width"] . " мм" : "";
				$optionsOrder .= isset( $itemCollection["cover_length"] ) ? "Длина : " . $itemCollection["cover_length"] . " мм" : "";						
				if ( isset( $itemCollection["module_color_id"] ) && ! is_null( $itemCollection["module_color_id"] ) ){
					$title_color = Color::model()->findByPk($itemCollection["module_color_id"]); 
					$optionsOrder .= "Корпус: ".$title_color->getMaterialLabel()." - ".$title_color['title'];
					$options = unserialize($orderLine["options"]);
					if ($options["mod_front_color_id"] > 0 ){
						$title_color_f = Color::model()->findByPk($options["mod_front_color_id"]);
						$optionsOrder .=  "<br>Фасад: ".$title_color_f->getMaterialLabel()." - ".$title_color_f['title'];
					} else{
						$optionsOrder .=  "Фасад: Без фасада.";
					}
				}
				
				if ( isset( $itemCollection["front_color_id"] ) && ! is_null( $itemCollection["front_color_id"] ) ){
					$title_color = Color::model()->findByPk($itemCollection["front_color_id"]); 
					$option += $title_color->getMaterialLabel()." - ".$title_color['title'];
                }
				if ( isset( $itemCollection["cover_color_id"] ) && ! is_null( $itemCollection["cover_color_id"] ) ){
					/*<img src="/images/colors/<?//= $itemCollection["cover_color_id"]; ?>.png" style="width:15px; height:15px;">*/
					$title_color = Color::model()->findByPk($itemCollection["cover_color_id"]); 
					$option += $title_color['title']." (".$title_color['material'].")";
				}
                $sheet->setCellValue("A".$row, $row-1);
                $sheet->setCellValue("B".$row, $orderLine->item_title);
                $sheet->setCellValue("C".$row, $optionsOrder);
                $sheet->setCellValue("D".$row, $orderLine->quantity);
                $sheet->setCellValue("E".$row, $orderLine->price);
                //$sheet->setCellValue("F".$row, $orderLine->price*$orderLine->quantity-$orderLine->pre_pay*$orderLine->quantity);
                //$sheet->setCellValue("G".$row, $orderLine->quantity * $orderLine->pre_pay);
                //$sheet->setCellValue("H".$row, $orderLine->price*$orderLine->quantity);
                $sheet->setCellValue("F".$row, '35');
                //$sheet->setCellValue("J".$row, '');
                $sheet->setCellValue("G".$row, 'без НДС');
                $row++;
                
            }
            //for($j=1; $j < col($arrCol; $j++){
               // $sheet->setCellValueByColumnAndRow($i,$j,2);
           // }
        }
        /*
       
        	    // Применяем выравнивание
        	    $sheet->getStyleByColumnAndRow($i - 2, $j)->getAlignment()->
                        setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        */
                // Выводим HTTP-заголовки
        
         header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
         header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
         header ( "Cache-Control: no-cache, must-revalidate" );
         header ( "Pragma: no-cache" );
         header ( "Content-type: application/vnd.ms-excel" );
         header ( "Content-Disposition: attachment; filename=order.xls" );
        
        // Выводим содержимое файла
         $objWriter = new PHPExcel_Writer_Excel5($xls);
         $objWriter->save('php://output');
	}
}
?>