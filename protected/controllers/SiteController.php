<?php

Yii::import( 'application.components.Controller' );
Yii::import( 'application.components.CImageHandler' );
Yii::import( 'application.models.Page' );
Yii::import( 'application.models.Action' );
Yii::import( 'application.models.Slider' );
Yii::import( 'application.models.RunningMeter' );
Yii::import( 'application.models.Kitchen' );
Yii::import( 'application.models.KitchenModule' );
Yii::import( 'application.models.KitchenFront' );
Yii::import( 'application.models.KitchenCover' );
Yii::import( 'application.models.KitchenAccess' );
Yii::import( 'application.models.KitchenLikeIt' );
Yii::import( 'application.models.PriceModuleColor' );
Yii::import( 'application.models.PriceFrontColor' );
Yii::import( 'application.models.Color' );
Yii::import( 'application.models.Mail' );
Yii::import( 'application.models.Order' );
Yii::import( 'application.models.OrderLine' );
Yii::import( 'application.models.SessionUser' );
Yii::import( 'application.models.Advantages' );
Yii::import( 'application.models.Review' );
Yii::import( 'application.models.News' );
Yii::import( 'application.models.Cheaper' );
Yii::import( 'application.models.HowOrder' );
Yii::import( 'application.models.WhyOrder' );
Yii::import( 'application.models.OurColors' );
Yii::import( 'application.models.ModuleOption' );
Yii::import( 'application.models.PoleznoZnat' );
Yii::import( 'application.models.NashiRaboty' );
Yii::import( 'application.models.ColorCategory' );
Yii::import( 'application.models.RateArticle' );
Yii::import( 'application.models.Accessory' );
Yii::import( 'application.models.Tabletop' );
Yii::import( 'application.models.Equipment' );

class SiteController extends Controller {
	public $ActionPrice_gl = 0.66;
	public $pageDescription;
	/**
	 * Главная
	 */
	public function actionIndex() {
		//$this->updateSessionData();


		$session = new CHttpSession;
		$session->open();
		//print_r( $session );
		//print_r( Yii::app()->user->role );
		//$session['color_hint'] = "color_hint_1";
		//$session->close();

		//print_r( $session['shopping_cart'] );
        $url = $_SERVER['REQUEST_URI'];
        if (preg_match('|index.php|',$url)){
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: /');
            exit();
        }

		$pageCriteria            = new CDbCriteria;
		$pageCriteria->condition = 'url=:url';
		$pageCriteria->params    = array( ':url' => "main" );

		$page = Page::model()->find( $pageCriteria );

		$actionsCriteria            = new CDbCriteria;
		$actionsCriteria->condition = 'is_show=:is_show';
		$actionsCriteria->params    = array( ':is_show' => "1" );

		$actions = Action::model()->findAll( $actionsCriteria );

		$sliderCriteria            = new CDbCriteria;
		$sliderCriteria->condition = 'is_show=:is_show';
		$sliderCriteria->params    = array( ':is_show' => "1" );
		$sliderCriteria->order = 'orderIMG ASC';
		$slider = Slider::model()->findAll( $sliderCriteria );


		$runningMeterCriteria            = new CDbCriteria;
		$runningMeterCriteria->condition = 'is_show=:is_show';
		$runningMeterCriteria->params    = array( ':is_show' => "1" );

		$runningMeters = RunningMeter::model()->findAll( $runningMeterCriteria );
		
		$reviewCriteria            = new CDbCriteria;
		$reviewCriteria->condition = ('is_show=:is_show');
		$reviewCriteria->limit = 3;
		$reviewCriteria->params    = array( ':is_show' => "1");
		$reviewCriteria->order = 'id desc';	
		$reviews = Review::model()->findAll( $reviewCriteria );
		
		$newCriteria            = new CDbCriteria;
		$newCriteria->condition = ('is_show=:is_show');
		$newCriteria->limit = 3;
		$newCriteria->params    = array( ':is_show' => "1");
		$newCriteria->order = 'id desc';	
		$news = News::model()->findAll( $newCriteria );

		$PoleznoZnatCriteria            = new CDbCriteria;
		$PoleznoZnatCriteria->condition = ('is_show=:is_show');
		$PoleznoZnatCriteria->limit = 3;
		$PoleznoZnatCriteria->params    = array( ':is_show' => "1");
		$PoleznoZnatCriteria->order = 'id desc';
		$PoleznoZnat = PoleznoZnat::model()->findAll( $newCriteria );

		$frontColorCriteria            = new CDbCriteria;
		$frontColorCriteria->condition = 'is_show=:is_show and type=:type';
		$frontColorCriteria->params    = array( ':is_show' => "1", ':type' => 'front' );
		$frontColorCriteria->order     = "material asc";
        
        
        $advantagesCriteria            = new CDbCriteria;
		$advantagesCriteria->condition = 'is_show=:is_show';
		$advantagesCriteria->params    = array( ':is_show' => "1" );

		$advantages = Advantages::model()->findAll( $advantagesCriteria );

		$frontColors = Color::model()->findAll( $frontColorCriteria );

        $designer = Page::model()->findByPk( 14 );
        
		$rating = [];
		$rating['name'] = 'index';
		$RateArticle = new RateArticle;
		$result = $RateArticle->selRating($rating['name']);
		$rating['point'] = $result['average'];
		$rating['count'] = $result['count'];
        
		$this->pageTitle = $page->title;

		$this->render( 'index', array(
			"page"          => $page,
			"actions"       => $actions,
			"slider"        => $slider,
			"runningMeters" => $runningMeters,
			"frontColors"   => $frontColors,
			"advantages"    => $advantages,
			"designer"     => $designer,
			"reviews"      => $reviews,
			"news"      => $news,
			"PoleznoZnat"   => $PoleznoZnat,
			"IndentNo"      => "y",
			"ratingPage"	=> $rating
		) );
	}

	public function actionSendCallback() {
		$mail_to = "info@qp-kuhni.ru";//info@qp-kuhni.ru
		$subject = "Обратный звонок";
		$message = $mailText;


		$mail = new Mail( "utf-8" );
		$mail->From( "QP;info@qp-kuhni.ru" );
		$mail->To( $mail_to );
		$mail->Subject( $subject );
		$mail->Body( $message );
		$mail->Priority( 3 );
		$mail->smtp_on( "ssl://smtp.yandex.ru", "info@qp-kuhni.ru", "ltkfq500kuhni", 465 );
		$mail->Send();
	}
	public function actionSendDesigner() {

		// параметры
		$name    = Yii::app()->request->getPost( 'calculate_price_popup_name' );
		$phone   = Yii::app()->request->getPost( 'calculate_price_popup_phone' );
		$address = Yii::app()->request->getPost( 'calculate_price_popup_address' );
		$time    = Yii::app()->request->getPost( 'calculate_price_popup_time' );
		$comment = Yii::app()->request->getPost( 'designer_popup_comment' );

		$mailText = "";

		$mailText .= "Имя : " . $name;
		$mailText .= "\nТелефон : " . $phone;
		$mailText .= "\nАдрес : " . $address;
		$mailText .= "\nУдобное время : " . $time;
		$mailText .= "\nКомментарий : " . $comment;


		$mail_to = "info@qp-kuhni.ru";//info@qp-kuhni.ru
		$subject = "Заявка на вызов дизайнера";
		$message = $mailText;


		$mail = new Mail( "utf-8" );
		$mail->From( "QP;info@qp-kuhni.ru" );
		$mail->To( $mail_to );
		$mail->Subject( $subject );
		$mail->Body( $message );
		$mail->Priority( 3 );
		$mail->smtp_on( "ssl://smtp.yandex.ru", "info@qp-kuhni.ru", "ltkfq500kuhni", 465 );
		$mail->Send();


		//print_r( $mailText );

		$this->redirect( "/", true );
	}

	/**
	 * Отправка заявки на рассчет стоимости кухни
	 */
	public function actionSendCalculatePrice() {

		// параметры
		$name    = Yii::app()->request->getPost( 'calculate_price_popup_name' );
		$phone   = Yii::app()->request->getPost( 'calculate_price_popup_phone' );
		$email   = Yii::app()->request->getPost( 'calculate_price_popup_email' );
		$address = Yii::app()->request->getPost( 'calculate_price_popup_address' );
		$time    = Yii::app()->request->getPost( 'calculate_price_popup_time' );
		$url     = Yii::app()->request->getPost( 'pageURL' );

		// параметры кухни
		$topColor           = Yii::app()->request->getPost( 'front_top_color' );
		$bottomColor        = Yii::app()->request->getPost( 'front_bottom_color' );
		$configuration      = Yii::app()->request->getPost( 'calculate_price_popup_configuration_type' );
		$configurationSizeA = Yii::app()->request->getPost( 'calculate_price_popup_size_a' );
		$configurationSizeB = Yii::app()->request->getPost( 'calculate_price_popup_size_b' );
		$configurationSizeC = Yii::app()->request->getPost( 'calculate_price_popup_size_c' );
		$configurationSizeH = Yii::app()->request->getPost( 'calculate_price_popup_size_h' );


		// допы
		$doors     = Yii::app()->request->getPost( 'calculate_price_popup_doors' );
		$glass     = Yii::app()->request->getPost( 'calculate_price_popup_glass' );
		$bottle    = Yii::app()->request->getPost( 'calculate_price_popup_bottle' );
		$tray      = Yii::app()->request->getPost( 'calculate_price_popup_tray' );
		$tabletop  = Yii::app()->request->getPost( 'calculate_price_popup_tabletop' );
		$wallboard = Yii::app()->request->getPost( 'calculate_price_popup_wallboard' );
		$washer    = Yii::app()->request->getPost( 'calculate_price_popup_washer' );


		// техника
		$cooker        = Yii::app()->request->getPost( 'calculate_price_popup_cooker' );
		$hood          = Yii::app()->request->getPost( 'calculate_price_popup_hood' );
		$cooler        = Yii::app()->request->getPost( 'calculate_price_popup_cooler' );
		$dishwasger    = Yii::app()->request->getPost( 'calculate_price_popup_dishwasher' );
		$washermachine = Yii::app()->request->getPost( 'calculate_price_popup_washermachine' );
		$comment = Yii::app()->request->getPost( 'calculate_popup_comment' );

		$mailText = "";

		$mailText .= "Имя : " . $name;
		$mailText .= "\nТелефон : " . $phone;
		$mailText .= "\nEmail : " . $email;
		$mailText .= "\nАдрес : " . $address;
		$mailText .= "\nУдобное время : " . $time;
		$mailText .= "\nURL: " . $url;

		// конфигурация
		$mailText .= "\nКонфигурация кухни : " . $configuration;
		$mailText .= "\nРазмер a : " . $configurationSizeA;
		$mailText .= "\nРазмер b : " . $configurationSizeB;
		$mailText .= "\nРазмер c : " . $configurationSizeC;

		// допы
		//$mailText .= "\nВерхние фасады : " . $topColor;
		$mailText .= "\nМатериал фасадов : " . $bottomColor;
		$mailText .= "\nФурнитура : " . $configurationSizeH;
		/*$mailText .= "\nЯщики и двери : " . $doors;
		$mailText .= "\nВитрины : " . $glass;
		$mailText .= "\nБутылочница : " . $bottle;
		$mailText .= "\nХранение посуды : " . $tray;
		$mailText .= "\nСтолешница : " . $tabletop;
		$mailText .= "\nСтеновая панель : " . $wallboard;
		$mailText .= "\nМойка : " . $washer;

		// техника
		$mailText .= "\nПлита : " . $cooker;
		$mailText .= "\nВытяжка : " . $hood;
		$mailText .= "\nХолодильник : " . $cooler;
		$mailText .= "\nПосудомоечная машина : " . $dishwasger;
		$mailText .= "\nСтиральная машина : " . $washermachine;*/
		$mailText .= "\nКоментарий : " . $comment;

		$mail_to = "info@qp-kuhni.ru";//info@qp-kuhni.ru
		$subject = "Заявка на рассчет кухни";
		$message = $mailText;


		$mail = new Mail( "utf-8" );
		$mail->From( "QP;info@qp-kuhni.ru" );
		$mail->To( $mail_to );
		$mail->Subject( $subject );
		$mail->Body( $message );
		$mail->Priority( 3 );
		/*
		if($_FILES["img1"]["tmp_name"] != ''){
			$mail->Attach($_FILES["img1"]["tmp_name"],"1.jpg", "image/jpeg" ) ;
		}
		if($_FILES["img2"]["tmp_name"] != ''){
			$mail->Attach($_FILES["img2"]["tmp_name"],"2.jpg", "image/jpeg" ) ;
		}
		if($_FILES["img3"]["tmp_name"] != ''){
			$mail->Attach($_FILES["img3"]["tmp_name"],"3.jpg", "image/jpeg" ) ;
		}
		*/
		$i = 1;
		if(isset($_FILES['img'])){
            foreach($_FILES['img']['tmp_name'] as $key => $tmp_name){
				if($_FILES['img']['tmp_name'][0] != ""){
					$mail->Attach($tmp_name,$i.".jpg", "image/jpeg" ) ;
					$i++;
				}
            }
		}
		if(isset($_FILES['img2'])){
            foreach($_FILES['img2']['tmp_name'] as $key => $tmp_name){
				if($_FILES['img2']['tmp_name'][0] != ""){
					$mail->Attach($tmp_name,$i.".jpg", "image/jpeg" ) ;
					$i++;
				}
            }
		}
		if(isset($_FILES['img3'])){
            foreach($_FILES['img3']['tmp_name'] as $key => $tmp_name){
				if($_FILES['img3']['tmp_name'][0] != ""){
					$mail->Attach($tmp_name,$i.".jpg", "image/jpeg" ) ;
					$i++;
				}
            }
		}

		$mail->smtp_on( "ssl://smtp.yandex.ru", "info@qp-kuhni.ru", "ltkfq500kuhni", 465 );
		
		if(!empty($name)){
	        $mail->Send();	    
		}

		
		$this->redirect( "/", true );

	}


	/**
	 * Каталог - конструктор
	 */
	public function actionCatalog() {

		$this->pageTitle = "Каталог";
		$this->render( 'catalog' );
	}

	/**
	 * Кухонные гарнитуры
	 */
	public function actionKitchens() {
		$kitchenContent = Page::model()->findByPk( 15 );
		$arr = array(array('categ' => 'classic', 'cont_id' => 20),array('categ' => 'modern', 'cont_id' => 21),array('categ' => 'ugol', 'cont_id' => 25),
			array('categ' => 'direct', 'cont_id' => 22),array('categ' => 'premium', 'cont_id' => 23),array('categ' => 'low', 'cont_id' => 24),
			array('categ' => 'little', 'cont_id' => 26),array('categ' => 'big', 'cont_id' => 27),array('categ' => 'p-obraz', 'cont_id' => 34),
			array('categ' => 'ostrov', 'cont_id' => 35),array('categ' => 'bar', 'cont_id' => 36),array('categ' => 'vstraivaemye', 'cont_id' => 51),array('categ' => 'provans', 'cont_id' => 53));
		$arr2 = array('klassicheskie-kuhni' => 'classic','sovremennye-kuhni' => 'modern','uglovye-kuhni' => 'ugol', 'pryamye-kuhni' => 'direct',
			'premium-kuhni' => 'premium', 'nedorogie-kuhni' => 'low', 'malenkie-kuhni' => 'little', 'bolshie-kuhni' => 'big',
			'p-obraznaya-kuhnya' => 'p-obraz','kuhnya-s-ostrovkom'=>'ostrov','kuhnya-s-barnoy-stoykoy'=>'bar','vstraivaemye-kuhni'=>'vstraivaemye','kuhnya-provans'=>'provans');
		if(isset($_GET['categ'])){
			$p = $_GET['categ'];
			if(isset($arr2[$p])){
				foreach($arr as $item){
					if($arr2[$p] == $item['categ']){
						$kitchenContent = Page::model()->findByPk( $item['cont_id'] );
					}
				}
				$KitchensCriteria            = new CDbCriteria;
				$KitchensCriteria->condition = 'filtr LIKE "%'.$arr2[$p].'%" and is_show=1';
				$KitchensCriteria->order = 'sorts';
			}
			else{
				throw new CHttpException(404);
			}
		}
		else{
			$kitchenContent = Page::model()->findByPk( 15 );
			$KitchensCriteria            = new CDbCriteria;
			$KitchensCriteria->condition = 'is_show=:is_show';
			$KitchensCriteria->params    = array( ':is_show' => "1" );
			$KitchensCriteria->order = 'sorts';
		}

		$kitchens = Kitchen::model()->findAll( $KitchensCriteria );

		$this->pageTitle = "Кухонные гарнитуры";

		if(!empty($SEO)){
			//print_r($SEO[0]['desription']);

		}

		$this->render( 'gotovye-kuhni', array( 'kitchens' => $kitchens, 'kitchenContent' => $kitchenContent ) );
	}

	/**
	 * Кухонный гарнитур
	 */
	public function actionKitchen() {

		$this->pageTitle = "";
		if(isset($_GET['url'])){
			$p = $_GET['url'];
			$criteria            = new CDbCriteria;
			$criteria->condition = 'urlT=:url';
			$criteria->params    = array( ':url' => $p );
			$kitchen = Kitchen::model()->find( $criteria );
			//$kitchen = Kitchen::model()->findByPk( $id );
			if(!$kitchen){
				$criteria->condition = 'id=:url';
				$criteria->params    = array( ':url' => $p );
				$kitchen = Kitchen::model()->find( $criteria );
			}
			if($kitchen){
			    $id = $kitchen->id;
				$kitchenDeconstruct = array();
				$kitchenLikeIt = array();
				$kitchenDeconstructAdd = array();
				if($kitchen->deconstruct == 1){
					$kitchenmoduleCriteria = new CDbCriteria;
					$kitchenmoduleCriteria -> condition = 'id_kitchen = :id_kitchen and addition = :addition';
					$kitchenmoduleCriteria->params = array(':id_kitchen' => $id, ':addition' => '0');
					$kitchenDeconstruct['module'] = KitchenModule::model()->findAll($kitchenmoduleCriteria);
					$kitchenDeconstruct['front']  = KitchenFront::model()->findAll($kitchenmoduleCriteria);
					$kitchenDeconstruct['cover']  = KitchenCover::model()->findAll($kitchenmoduleCriteria);
					$kitchenDeconstruct['access']  = KitchenAccess::model()->findAll($kitchenmoduleCriteria);

					$kitchenmoduleCriteriaAdd = new CDbCriteria;
					$kitchenmoduleCriteriaAdd -> condition = 'id_kitchen = :id_kitchen and addition = :addition';
					$kitchenmoduleCriteriaAdd->params = array(':id_kitchen' => $id, ':addition' => '1');
					$kitchenDeconstructAdd['module'] = KitchenModule::model()->findAll($kitchenmoduleCriteriaAdd);
					$kitchenDeconstructAdd['front']  = KitchenFront::model()->findAll($kitchenmoduleCriteriaAdd);
					$kitchenDeconstructAdd['cover']  = KitchenCover::model()->findAll($kitchenmoduleCriteriaAdd);
					$kitchenDeconstructAdd['access']  = KitchenAccess::model()->findAll($kitchenmoduleCriteriaAdd);
				}
				/*
				$kitchenLikeItCriteria = new CDbCriteria;
				$kitchenLikeItCriteria -> condition = 'id_kitchen = :id_kitchen';
				$kitchenLikeItCriteria->params = array(':id_kitchen' => $id);
				$kitchenLikeIt = KitchenLikeIt::model()->findAll($kitchenLikeItCriteria);
				*/
				$filtr = $kitchen -> filtr;
				$filtr = unserialize($filtr);
				foreach($filtr as $item){
					$itemCriteria = new CDbCriteria;
					$itemCriteria -> condition = "filtr like :filtr and is_show=1 and id<>:id and is_show = 1";
					$itemCriteria->params = array(':filtr' => "%$item%",':id'=>$kitchen->id);
					$itemCriteria->order = 'rand() limit 3';					
					$kitchenLikeIt = Kitchen::model()->findAll($itemCriteria);
				}
				
				$withBuy = [];				
				$criteria            = new CDbCriteria;
				$criteria->condition = "is_show = 1";
				$criteria->order = 'RAND()';
				$criteria2            = new CDbCriteria;
				$criteria2->condition = "(is_show = 1) and (folder_id in (51,60,61))";
				$criteria2->order = 'RAND()';
				//$tabletopRand  = ItemCover::model()->find($criteria);
				$accessoryRand = Accessory::model()->find($criteria2);
				$equipmentRand = Equipment::model()->find($criteria);

				array_push($withBuy, array(
										'path' => 'equipment/'.$equipmentRand['id'],
										'title'=> $equipmentRand['title'],
										'price'=> $equipmentRand['price'],
										'img'  => '/item_equipment/'.$equipmentRand['image']
									),
									array(
										'path' => 'accessory/'.$accessoryRand['id'],
										'title'=> $accessoryRand['title'],
										'price'=> $accessoryRand['price'],
										'img'  => '/item_accessories/'.$accessoryRand['image']
									));
			
				
							
				$this->render( 'kitchen', array( 'kitchen' => $kitchen,
												 'kitchenDeconstruct' =>  $kitchenDeconstruct, 
												 'kitchenDeconstructAdd' =>  $kitchenDeconstructAdd,
												 'kitchenLikeIt'	=> $kitchenLikeIt,
												 'withBuy'		=> $withBuy
												 ) );
			}
			else{
				throw new CHttpException(404);	
			}
			//return $this->render('polezno-znat', ['poleznoZnat' => $news]);
		}
		else {
			throw new CHttpException(404);
		}
	}

	/**
	 * Методы конструктора кухонь
	 */
	public function actionSelmodulebutton(){
		$id_kitchen = $_POST['id_kitchen']?$_POST['id_kitchen']:"";
		$id_module = $_POST['id_module']?$_POST['id_module']:"";
		$kitchenModule = new KitchenModule();
		$result = $kitchenModule->selectDataModule($id_kitchen,$id_module,"");
		echo $this->messageJsonOk(json_encode($result));
	}
	public function actionEditmodule(){
		$id_kitchen 		 = isset($_POST['id_kitchen'])?$_POST['id_kitchen']:"";
		$id_module			 = isset($_POST['id_module'])?$_POST['id_module']:"";
		$color_select_module = isset($_POST['color_select_module'])?$_POST['color_select_module']:"";
		$color_select_front  = isset($_POST['color_select_front'])?$_POST['color_select_front']:"";
		$count_select_module = isset($_POST['count_select_module'])?$_POST['count_select_module']:"";
		$options_select_module = Yii::app()->getRequest()->getPost( 'options' );

		$userKitchen = isset($_POST['viewKitchen'])?$_POST['viewKitchen']:"";//параметр для передачи цены без сохранения в базу

		$updatePriceModule = new KitchenModule();
		$result = $updatePriceModule->updatePriceModule($id_kitchen,$id_module,$color_select_module,
			$color_select_front,$count_select_module,$options_select_module,$userKitchen,0,0);
		echo $this->messageJsonOk($result);
	}

	public function actionSelfrontbutton(){
		$id_kitchen = $_POST['id_kitchen']?$_POST['id_kitchen']:"";
		$id_front = $_POST['id_front']?$_POST['id_front']:"";
		$kitchenfront = new KitchenFront();
		$result = $kitchenfront->selectDataFront($id_kitchen,$id_front);
		echo $this->messageJsonOk(json_encode($result));
	}
	public function actionEditfront(){
		$id_kitchen 		 = isset($_POST['id_kitchen'])?$_POST['id_kitchen']:"";
		$id_front			 = isset($_POST['id_front'])?$_POST['id_front']:"";
		$color_select_front  = isset($_POST['color_select_front'])?$_POST['color_select_front']:"";
		$count_select_front = isset($_POST['count_select_front'])?$_POST['count_select_front']:"";
		$options_select_front = Yii::app()->getRequest()->getPost( 'options' );

		$userKitchen = isset($_POST['viewKitchen'])?$_POST['viewKitchen']:"";//параметр для передачи цены без сохранения в базу


		$updatePriceFront = new KitchenFront();
		$result = $updatePriceFront->updatePriceFront($id_kitchen,$id_front,
			$color_select_front,$count_select_front,$options_select_front,$userKitchen,0);
		echo $this->messageJsonOk($result);
	}

	public function actionSelcoverbutton(){
		$id_kitchen = $_POST['id_kitchen']?$_POST['id_kitchen']:"";
		$id_cover = $_POST['id_cover']?$_POST['id_cover']:"";
		$kitchenCover = new KitchenCover();
		$result = $kitchenCover->selectDataCover($id_kitchen,$id_cover);
		echo $this->messageJsonOk(json_encode($result));
	}
	public function actionCoverextrasize(){
		$id_cover   = isset($_POST['id_cover'])?$_POST['id_cover']:"";
		$sizeH 		= isset($_POST['sizeH'])?$_POST['sizeH']:"";
		$sizeW 		= isset($_POST['sizeW'])?$_POST['sizeW']:"";
		$kitchenCover = new KitchenCover();
		$result = $kitchenCover ->coverExtraSize($id_cover,$sizeH,$sizeW);

		echo $this->messageJsonOk(json_encode($result));
	}

	
	public function actionBuycomplect(){
		$this->updateSessionData();
		$orderId       = $this->getShoppingCartId();

		$orderLineId   = Yii::app()->getRequest()->getPost( 'order_line_id' );
		$id_kitchen    = Yii::app()->getRequest()->getPost( 'id_kitchen' );
		
		$kitchen = Kitchen::model()->findByPk($id_kitchen);
		$price = 0;
		$quantity = 0;
		if(isset($kitchen)){
			if($kitchen->deconstruct == 1){
				$kitchenModulsCriteria = new CDbCriteria;
				$kitchenModulsCriteria -> condition = 'id_kitchen = :id_kitchen and addition = 0';
				$kitchenModulsCriteria->params = array(':id_kitchen' => $id_kitchen);
				$kitchenModuls = KitchenModule::model()->findAll($kitchenModulsCriteria);

				foreach($kitchenModuls as $kitchenModule){
					if($kitchenModule -> price > 0){
						$itemType    = OrderLine::$itemTypes["module"]["name"];
						$options['module_color_id'] = $kitchenModule->selColorModule;
						$options['mod_front_color_id'] = $kitchenModule->selColorFront;
						$options['options_checked'] = array();
						$orderLine = new OrderLine();
						if ( $orderLineId ) {
							$orderLine = OrderLine::model()->findByPk( $orderLineId );
						}
						$orderLine->item_id    = intval( $kitchenModule->id_module );
						$orderLine->item_type  = $itemType;
						$itemModel     = ItemModule::model()->findByPk( $kitchenModule->id_module );
						$orderLine->item_title = $itemModel["title"];
						$orderLine->order_id   = intval( $orderId );
						$orderLine->price      = intval( $kitchenModule -> price ) / intval( $kitchenModule -> count );
						$orderLine->quantity   = intval( $kitchenModule -> count );
						$orderLine->pre_pay    = intval( $kitchenModule -> price ) * 35 / 100;
						$orderLine->setOptions( $options );
						if ( $orderLine->save() ) {
							$price += $kitchenModule -> price;
							$quantity += $kitchenModule -> count;
						}
					}
				}

				$kitchenFrontsCriteria = new CDbCriteria;
				$kitchenFrontsCriteria -> condition = 'id_kitchen = :id_kitchen and addition = 0';
				$kitchenFrontsCriteria->params = array(':id_kitchen' => $id_kitchen);
				$kitchenFronts = KitchenFront::model()->findAll($kitchenFrontsCriteria);

				foreach($kitchenFronts as $kitchenFront){
					if($kitchenFront -> price > 0){
						$itemType    = OrderLine::$itemTypes["front"]["name"];
						$options['front_color_id'] = $kitchenFront->selColor;
						$options['options_checked'] = array();
						$orderLine = new OrderLine();
						if ( $orderLineId ) {
							$orderLine = OrderLine::model()->findByPk( $orderLineId );
						}
						$orderLine->item_id    = intval( $kitchenFront->id_front );
						$orderLine->item_type  = $itemType;
						$itemModel     = ItemFront::model()->findByPk( $kitchenFront->id_front );
						$orderLine->item_title = $itemModel["title"];
						$orderLine->order_id   = intval( $orderId );
						$orderLine->price      = intval( $kitchenFront -> price ) / intval( $kitchenFront -> count );
						$orderLine->quantity   = intval( $kitchenFront -> count );
						$orderLine->pre_pay    = intval( $kitchenFront -> price ) * 35 / 100;
						$orderLine->setOptions( $options );
						if ( $orderLine->save() ) {
							$price += $kitchenFront -> price;
							$quantity += $kitchenFront -> count;
						}
					}
				}

				$kitchenCoversCriteria = new CDbCriteria;
				$kitchenCoversCriteria -> condition = 'id_kitchen = :id_kitchen and addition = 0';
				$kitchenCoversCriteria->params = array(':id_kitchen' => $id_kitchen);
				$kitchenCovers = KitchenCover::model()->findAll($kitchenCoversCriteria);

				foreach($kitchenCovers as $kitchenCover){
					if($kitchenCover -> price > 0){
						$itemType    = OrderLine::$itemTypes["cover"]["name"];
						$options["factor"] = 0;
						$options["cover_width"] = 0;
						$options["cover_length"] =0;
						if(unserialize($kitchenCover->selSize)!==False) {
							$selSize = unserialize($kitchenCover->selSize);
							if(isset($selSize['koffCost'])){
								$options["factor"] = $selSize['koffCost'];
								$options["cover_width"] = $selSize['size_width'];
								$options["cover_length"] = $selSize['size_height'];
							}
						}

						$options["cover_color_id"]  = $kitchenCover->selColor;

						$options["factor_2"]        = 1;
						$options["options_checked"] = array();
						$orderLine = new OrderLine();
						if ( $orderLineId ) {
							$orderLine = OrderLine::model()->findByPk( $orderLineId );
						}
						$orderLine->item_id    = intval( $kitchenCover->id_cover );
						$orderLine->item_type  = $itemType;
						$itemModel     = ItemCover::model()->findByPk( $kitchenCover->id_cover );
						$orderLine->item_title = $itemModel["title"];
						$orderLine->order_id   = intval( $orderId );
						$orderLine->price      = intval( $kitchenCover -> price ) / intval( $kitchenCover -> count );
						$orderLine->quantity   = intval( $kitchenCover -> count );
						$orderLine->pre_pay    = intval( $kitchenCover -> price ) * 35 / 100;
						$orderLine->setOptions( $options );
						if ( $orderLine->save() ) {
							$price += $kitchenCover -> price;
							$quantity += $kitchenCover -> count;
						}
					}
				}
				$kitchenAccessCriteria = new CDbCriteria;
				$kitchenAccessCriteria -> condition = 'id_kitchen = :id_kitchen and addition = 0';
				$kitchenAccessCriteria->params = array(':id_kitchen' => $id_kitchen);
				$kitchenAccess = KitchenAccess::model()->findAll($kitchenAccessCriteria);
				foreach($kitchenAccess as $item){
					if($item -> price > 0){
						$itemType    = OrderLine::$itemTypes["accessory"]["name"];
						$orderLine = new OrderLine();
						if ( $orderLineId ) {
							$orderLine = OrderLine::model()->findByPk( $orderLineId );
						}
						$orderLine->item_id    = intval( $item->id_access );
						$orderLine->item_type  = $itemType;
						$itemModel     = Accessory::model()->findByPk( $item->id_access );
						$orderLine->item_title = $itemModel["title"];
						$orderLine->order_id   = intval( $orderId );
						$orderLine->price      = intval( $item -> price ) / intval( $item -> count );
						$orderLine->quantity   = intval( $item -> count );
						$orderLine->pre_pay    = intval( $item -> price ) * 35 / 100;
						$orderLine->setOptions( $options );
						if ( $orderLine->save() ) {
							$price += $item -> price;
							$quantity += $item -> count;
						}
					}
				}
			}
			else{
				//$itemType    = OrderLine::$itemTypes["accessory"]["name"];
				$quantity = 1;
				$price = $kitchen-> price;
				$orderLine = new OrderLine();
				if ( $orderLineId ) {
					$orderLine = OrderLine::model()->findByPk( $orderLineId );
				}
				$orderLine->item_id    = intval( $kitchen->id );
				//$orderLine->item_type  = $itemType;
				$orderLine->item_title = $kitchen->title;
				$orderLine->order_id   = intval( $orderId );
				$orderLine->price      = intval( $price);
				$orderLine->quantity   = $quantity;
				$orderLine->pre_pay    = intval( $price ) * 35 / 100;
				$orderLine->save();
			}
		}
		echo $this->messageJsonOk( '{"quantity": "'.$quantity.'", "price":"'.$price.'"}');
	}


	/**
	 * Как заказать
	 */
	public function actionHowToOrder() {

		$criteria            = new CDbCriteria;
		$criteria->condition = 'url=:url';
		$criteria->params    = array( ':url' => "how-to" );

		$page = Page::model()->find( $criteria );

		$this->pageTitle = $page->title;
		$this->render( 'how-to', array( "page" => $page ) );
	}

	/**
	 * Доставка и сборка
	 */
	public function actionDeliveryAndAssembly() {

		$criteria            = new CDbCriteria;
		$criteria->condition = 'url=:url';
		$criteria->params    = array( ':url' => "delivery" );

		$page = Page::model()->find( $criteria );

		$this->pageTitle = $page->title;
		$this->render( 'delivery', array( "page" => $page ) );
	}

	/**
	 * О производстве
	 */
	public function actionAboutManufacture() {

		$criteria            = new CDbCriteria;
		$criteria->condition = 'url=:url';
		$criteria->params    = array( ':url' => "about" );

		$page = Page::model()->find( $criteria );

		$this->pageTitle = $page->title;
		$this->render( 'about', array( "page" => $page ) );
	}
	/**
	 * Акции
	 */
	public function actionAction() {

		$criteria            = new CDbCriteria;
		$criteria->condition = 'url=:url';
		$criteria->params    = array( ':url' => "action" );

		$page = Page::model()->find( $criteria );

		$this->pageTitle = $page->title;
		$this->render( 'action', array( "page" => $page ) );
	}
	/**
	 * Фасады ЛДСП
	 */
	public function actionFasadyldsp() {
		$criteria            = new CDbCriteria;
		$criteria->condition = 'url=:url';
		$criteria->params    = array( ':url' => "fasady-ldsp" );


		$page = Page::model()->find( $criteria );

		$this->pageTitle = $page->title;
		$this->render( 'fasady_ldsp', array( "page" => $page ) );
	}
	/**
	 * Фасад МФД
	 */
	public function actionFasadmfd() {

		$criteria            = new CDbCriteria;
		$criteria->condition = 'url=:url';
		$criteria->params    = array( ':url' => "fasad-mdf" );


		$page = Page::model()->find( $criteria );

		$this->pageTitle = $page->title;
		$this->render( 'fasad_mdf', array( "page" => $page ) );
	}
	/**
	 * Фасады ПЛАСТИК
	 */
	public function actionFasadyplastik() {

		$criteria            = new CDbCriteria;
		$criteria->condition = 'url=:url';
		$criteria->params    = array( ':url' => "fasady-plastik" );


		$page = Page::model()->find( $criteria );

		$this->pageTitle = $page->title;
		$this->render( 'fasady_plastik', array( "page" => $page ) );
	}

	/**
	 * Контакты
	 */
	public function actionContacts() {

		$session = new CHttpSession;
		$session->open();
		$sessionUser = new SessionUser( $session );


		$criteria            = new CDbCriteria;
		$criteria->condition = 'url=:url';
		$criteria->params    = array( ':url' => "contacts" );

		$page = Page::model()->find( $criteria );

		$this->pageTitle = $page->title;
		$this->render( 'contacts', array( "page" => $page ) );
	}
	/**
	 * Кухни на заказ
	 */
	public function actionKuhniZakaz() {

		$criteria            = new CDbCriteria;
		$criteria->condition = 'url=:url';
		$criteria->params    = array( ':url' => "kuhni-na-zakaz" );
        
        /*
		$reviewCriteria            = new CDbCriteria;
		$reviewCriteria->condition = ('is_show=:is_show');
		$reviewCriteria->limit = 3;
		$reviewCriteria->params    = array( ':is_show' => "1");
		$reviewCriteria->order = 'id desc';	
		$reviews = Review::model()->findAll( $reviewCriteria );
		*/
		$review1 = Review::model()->findByPk( 33 );
		$review2 = Review::model()->findByPk( 20);
		$review3 = Review::model()->findByPk( 30 );
		$reviews[] = $review1;	
		$reviews[] = $review2;	
		$reviews[] = $review3;
		
		$kitchens[] = Kitchen::model()->findByPk( 30 );
		$kitchens[] = Kitchen::model()->findByPk( 45 );
		$kitchens[] = Kitchen::model()->findByPk( 25 );
		$kitchens[] = Kitchen::model()->findByPk( 15 );
		$kitchens[] = Kitchen::model()->findByPk( 41 );
		$kitchens[] = Kitchen::model()->findByPk( 56 );
		$kitchens[] = Kitchen::model()->findByPk( 55 );
		$kitchens[] = Kitchen::model()->findByPk( 35 );
		$kitchens[] = Kitchen::model()->findByPk( 27 );
		
		$NashiRaboty[] = NashiRaboty::model()->findByPk( 247 );
		$NashiRaboty[] = NashiRaboty::model()->findByPk( 256 );
		$NashiRaboty[] = NashiRaboty::model()->findByPk( 268 );
		$NashiRaboty[] = NashiRaboty::model()->findByPk( 281 );
		$NashiRaboty[] = NashiRaboty::model()->findByPk( 285 );
		$NashiRaboty[] = NashiRaboty::model()->findByPk( 240 );
		$NashiRaboty[] = NashiRaboty::model()->findByPk( 114 );
		$NashiRaboty[] = NashiRaboty::model()->findByPk( 75 );
		$NashiRaboty[] = NashiRaboty::model()->findByPk( 101 );
		
		$page = Page::model()->find( $criteria );

		$this->pageTitle = $page->title;
		$this->render( 'kuhni-na-zakaz', array( 
											"reviews"=>$reviews,
											"page" => $page,
											"kitchens" => $kitchens,
											"NashiRaboty" => $NashiRaboty 											
											) );
	}
	/**
	 * отзывы
	 */
	public function actionReview() {

		$session = new CHttpSession;
		$session->open();
		$sessionUser = new SessionUser( $session );


		$frontsCriteria            = new CDbCriteria;
		$frontsCriteria->condition = 'is_show=:is_show';
		$frontsCriteria->params    = array( ':is_show' => "1" );
		$frontsCriteria->order = 'id desc';

		$review = Review::model()->findAll( $frontsCriteria );
		
		$criteria            = new CDbCriteria;
		$criteria->condition = 'url=:url';
		$criteria->params    = array( ':url' => "review" );

		$page = Page::model()->find( $criteria );
		
		$this->pageTitle = "Отзывы";
		$this->render( 'review', array( "reviews" => $review, "page" => $page ) );
	}
	public function actionAddReview() {
		$name     = Yii::app()->request->getPost( 'name' );
		$text     = Yii::app()->request->getPost( 'review' );
		$img1     = $_FILES["image1"]["tmp_name"];
		$img2     = $_FILES["image2"]["tmp_name"];
		$img3     = $_FILES["image3"]["tmp_name"];
		$img4     = $_FILES["image4"]["tmp_name"];
		$img5     = $_FILES["image5"]["tmp_name"];
		$review = new Review;
		$review->fio = $name;
		$review->text = $text;
		$review->is_show = 0;
		$review->new_ch = 0;
		$review->new_ch = "";
		$imageName_arr = array();
		$images = array();
		if($img1 != ""){array_push($images, $img1);}
		if($img2 != ""){array_push($images, $img2);}
		if($img3 != ""){array_push($images, $img3);}
		if($img4 != ""){array_push($images, $img4);}
		if($img5 != ""){array_push($images, $img5);}
		if ($images[0] != "") {
			foreach($images as $image){
				$imageName = date("YmdHis").rand(100,999).".png";
				echo $imageName."<br>";
				$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/review/' . $imageName;
				$pathPrev  = Yii::getPathOfAlias( 'webroot' ) . '/images/review/preview/' . $imageName;
				if(file_exists($path)){
					unlink($path);
				}
				move_uploaded_file( $image, $path );
				Yii::app()->ih->load($path)->thumb('75', '75')->save($pathPrev);
				array_push($imageName_arr, $imageName);
			}
			$review->img = serialize($imageName_arr);
		}else{
			$review->img = serialize($images);
		}

		$review->save();
		$url = $this->createAbsoluteUrl( 'review' );
		$this->redirect( $url, true );
	}
	public function actionAdvantage() {
		$criteria            = new CDbCriteria;
		$criteria->condition = 'url=:url';
		$criteria->params    = array( ':url' => "advantage" );

		$page = Page::model()->find( $criteria );

		$frontsCriteria            = new CDbCriteria;
		$frontsCriteria->condition = 'is_show=:is_show';
		$frontsCriteria->params    = array( ':is_show' => "1" );

		$whyorder = WhyOrder::model()->findAll( $frontsCriteria );

		$this->render( 'advantage',array("page" => $page, "whyorder" => $whyorder));
	}
	public function actionNashiraboty(){
		$criteria            = new CDbCriteria;
		$criteria->condition = 'url=:url';
		$criteria->params    = array( ':url' => "nashi-raboty" );
		$page = Page::model()->find( $criteria );
		
		$criteria = new CDbCriteria();
		$criteria->condition = 'parent_id="" and is_show=1';
		$criteria->order = 'id desc';
		$count = NashiRaboty::model()->count($criteria);
		$pages=new CPagination($count);
		$pages->pageSize = 15;//Yii::app()->params['per_page'];
		$pages->applyLimit($criteria);
		$nashiraboty = NashiRaboty::model()->findAll($criteria);
		
		$reviewCriteria            = new CDbCriteria;
		$reviewCriteria->condition = ('is_show=:is_show');
		$reviewCriteria->limit = 5;
		$reviewCriteria->params    = array( ':is_show' => "1");
		$reviewCriteria->order = 'id desc';	
		$reviews = Review::model()->findAll( $reviewCriteria );
		$this->render('nashiraboty',
			 array(
				 'nashiraboty'   => $nashiraboty,
				 'paginator'     => $pages,
				 'page'          => $page,
				 'reviews'		 => $reviews
				));
	}
	public function actionWhyorder($id) {

		$session = new CHttpSession;
		$session->open();
		$sessionUser = new SessionUser( $session );

		$whyorder = WhyOrder::model()->findByPk( $id );

		//$this->pageTitle = $page->title;
		$this->render( 'whyorder', array( "whyorder" => $whyorder ) );
	}
	public function actionPoleznoznat() {
		if(isset($_GET['url'])){
			$p = $_GET['url'];
			$criteria            = new CDbCriteria;
			$criteria->condition = 'url=:url';
			$criteria->params    = array( ':url' => $p );
			$news = PoleznoZnat::model()->findAll( $criteria );
		}
		else{
			$news = PoleznoZnat::model()->findAll();
		}
		if($news){
			return $this->render('polezno-znat', ['poleznoZnat' => $news]);
		}
		else {
			throw new CHttpException(404);
		}
	}
	public function actionNews() {

		$session = new CHttpSession;
		$session->open();
		$sessionUser = new SessionUser( $session );


		$frontsCriteria            = new CDbCriteria;
		$frontsCriteria->condition = 'is_show=:is_show';
		$frontsCriteria->params    = array( ':is_show' => "1" );
		$frontsCriteria->order = 'id desc';
		//$frontsCriteria->order = 'title';

		$news = News::model()->findAll( $frontsCriteria );
		$criteria            = new CDbCriteria;
		$criteria->condition = 'url=:url';
		$criteria->params    = array( ':url' => "news" );

		$page = Page::model()->find( $criteria );
		//$this->pageTitle = "Новости";
		$this->render( 'news', array( "news" => $news, "page" => $page ) );
	}
	public function actionNewsItem($id) {

		$session = new CHttpSession;
		$session->open();
		$sessionUser = new SessionUser( $session );

		$new_item = News::model()->findByPk( $id );

		//$this->pageTitle = $page->title;
		$this->render( 'newsItem', array( "new_item" => $new_item ) );
	}
	public function actionCheaper() {

		$session = new CHttpSession;
		$session->open();
		$sessionUser = new SessionUser( $session );


		$frontsCriteria            = new CDbCriteria;
		$frontsCriteria->condition = 'is_show=:is_show';
		$frontsCriteria->params    = array( ':is_show' => "1" );
		$frontsCriteria->order = 'id desc';
		//$frontsCriteria->order = 'title';

		$cheaper = Cheaper::model()->findAll( $frontsCriteria );
		$criteria            = new CDbCriteria;
		$criteria->condition = 'url=:url';
		$criteria->params    = array( ':url' => "cheaper" );

		$page = Page::model()->find( $criteria );
		//$this->pageTitle = "Новости";
		$this->render( 'cheaper', array( "cheaper" => $cheaper, "page" => $page ) );
	}
	public function actionCheaperItem($id) {

		$session = new CHttpSession;
		$session->open();
		$sessionUser = new SessionUser( $session );

		$cheaper_item = Cheaper::model()->findByPk( $id );

		//$this->pageTitle = $page->title;
		$this->render( 'cheaperItem', array( "cheaper_item" => $cheaper_item ) );
	}
	public function actionHoworder() {

		$session = new CHttpSession;
		$session->open();
		$sessionUser = new SessionUser( $session );


		$frontsCriteria            = new CDbCriteria;
		$frontsCriteria->condition = 'is_show=:is_show';
		$frontsCriteria->params    = array(':is_show' => 1 );
		//$frontsCriteria->order = 'title';

		$howorder = HowOrder::model()->findAll( $frontsCriteria );

		$criteria            = new CDbCriteria;
		$criteria->condition = 'url=:url';
		$criteria->params    = array( ':url' => "howorder" );

		$page = Page::model()->find( $criteria );
		$this->pageTitle = $page->title;
		$this->render( 'howorder', array( "howorder" => $howorder, "page" => $page ) );
	}
	public function actionHoworderLink($id) {

		$session = new CHttpSession;
		$session->open();
		$sessionUser = new SessionUser( $session );

		$howorder = HowOrder::model()->findByPk( $id );

		//$this->pageTitle = $page->title;
		$this->render( 'howorderLink', array( "howorder" => $howorder ) );
	}

	public function actionNashidekory() {
		$categColorGroup = new ColorCategory;
        $categColor = $categColorGroup -> groupCategory();
	
		$criteria            = new CDbCriteria;
		$criteria->condition = 'url=:url';
		$criteria->params    = array( ':url' => "nashi-dekory" );
		$page = Page::model()->find( $criteria );

        $this->pageTitle = $page->title;
		$this->render( 'nashidekory', array('categColor' => $categColor, 'page'=> $page));
	}

	public function actionNashidekoryid() {
		if(isset($_GET['url'])){
			$p = $_GET['url'];
			
			$criteria            = new CDbCriteria;
			$criteria->condition = 'groupC=:url';
			$criteria->params    = array( ':url' => $p );
			$categColor = ColorCategory::model()->findAll( $criteria );
			
			$criteria            = new CDbCriteria;
    		$criteria->condition = 'url=:url';
    		$criteria->params    = array( ':url' => $p );
    		$page = Page::model()->find( $criteria );

			/*----- module reviews------*/
			$reviewsHTML = '<div class="nahi-raboti"><div style="display: inline-block;">';
			$review1 = Review::model()->findByPk( 33 );
			$review2 = Review::model()->findByPk( 20);
			$review3 = Review::model()->findByPk( 30 );
			$reviews[] = $review1;	
			$reviews[] = $review2;	
			$reviews[] = $review3;
			foreach($reviews as $review){
				$reviewIMG = unserialize($review->img);
				$reviewsHTML .= '<div class="col-md-4"><div class="reviewINDEX">';
				if (!file_exists("/images/review/".array_shift($reviewIMG))){
					$reviewsHTML .= '<div class="fotorama" data-loop="true" data-width="100%">';
					foreach($reviewIMG as $item){
						$reviewsHTML .= "<img class='review_img' src='/images/review/$item' style='display: block;max-width: 100%;height: 100%;object-fit: cover;'/>";
					}
					$reviewsHTML .= '</div>';
				}
				else{
					$reviewsHTML .= '<img class="review_img" src="/images/without.jpg"/>';
				}
				$reviewsHTML .= '<div class="descrINDEX" style="height: 140px;">';
				preg_match('~^(?>(?><[^>]*>\s*)*[^<]){0,140}(?=\s)~s', $review->text, $m);
				$reviewsHTML .= "<p style='margin-top: -5px;'><span style='font-size: 18px;'>$review->fio</span><br>$m[0] ...
					<a href='/review' style='font-size: 16px; font-weight: bold;'>Посмотреть еще наши работы</a></p></div></div></div>";
			}
			$reviewsHTML .= "</div></div>";
			/*----- END module reviews------*/

			/*----- module callDesign------*/
			$callDesign = '<a href="#" data-toggle="modal" data-target="#designer-modal">
				<div style="background: url(/images/new/banner1.png);" class="banner_div">
					<span class="bannerOrder_b">Заказать</span></div></a>';
			/*-----END module callDesign------*/

			/*----- module freeCosting_b------*/
			$freeCosting_b = '<a href="#" data-toggle="modal" onclick="initPopupSliders()" data-target="#calculate-price-modal">
				<div style="background: url(/images/new/banner2.png)" class="banner_div">
					<span class="bannerOrder_b">Заказать</span></div></a>';
			/*-----END module freeCosting_b------*/

			$freeCosting   = file_get_contents( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/include/costing.php" );
			$freeCosting_b = $freeCosting_b.file_get_contents( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/include/calcCost.php" );
			$advantage     = file_get_contents( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/include/advantage.php" );

			$page->content = str_replace('[module freeCosting]',$freeCosting,$page->content);
			$page->content = str_replace('[module reviews]',$reviewsHTML,$page->content);
			$page->content = str_replace('[module callDesign]',$callDesign,$page->content);
			$page->content = str_replace('[module freeCosting_b]',$freeCosting_b,$page->content);
			$page->content = str_replace('[module advantage]',$advantage,$page->content);

			$this->render( 'nashidekoryid', array('categColor' => $categColor, 'page' => $page));
		}
		else{
			throw new CHttpException(404);
		}
	}

	public function actionKakvybratkuhnyu() {
		$this->actionHoworder();
	}
	public function actionKakkupitkuhnyunedorogo() {
	    $this->pageTitle = "Как купить кухню недорого?";
		$this->actionCheaperItem(3);
	}
	public function actionGotovyekuhni() {
		$this->actionKitchens();
	}
	public function actionRateArticle() {
		isset($_POST['page'])?$page = $_POST['page']:$page = 'none';
		isset($_POST['point'])?$point = $_POST['point']:$point = 'point';
		$customer = new RateArticle();
		$customer->page  = $page;
		$customer->point = $point;
		$customer->save();
		echo $this->messageJsonOk('{"success": "ok"}');
	}
		/**
	 * Кухонные гарнитуры
	 */
	public function actionKatalogKuhon() {
		$katalogKuhon = Page::model()->findByPk( 52 );
		/*$arr = array(array('categ' => 'classic', 'cont_id' => 20),array('categ' => 'modern', 'cont_id' => 21),array('categ' => 'ugol', 'cont_id' => 25),
			array('categ' => 'direct', 'cont_id' => 22),array('categ' => 'premium', 'cont_id' => 23),array('categ' => 'low', 'cont_id' => 24),
			array('categ' => 'little', 'cont_id' => 26),array('categ' => 'big', 'cont_id' => 27),array('categ' => 'p-obraz', 'cont_id' => 34),
			array('categ' => 'ostrov', 'cont_id' => 35),array('categ' => 'bar', 'cont_id' => 36),array('categ' => 'vstraivaemye', 'cont_id' => 51));
		$arr2 = array('klassicheskie-kuhni' => 'classic','sovremennye-kuhni' => 'modern','uglovye-kuhni' => 'ugol', 'pryamye-kuhni' => 'direct',
			'premium-kuhni' => 'premium', 'nedorogie-kuhni' => 'low', 'malenkie-kuhni' => 'little', 'bolshie-kuhni' => 'big',
			'p-obraznaya-kuhnya' => 'p-obraz','kuhnya-s-ostrovkom'=>'ostrov','kuhnya-s-barnoy-stoykoy'=>'bar','vstraivaemye-kuhni'=>'vstraivaemye');
		if(isset($_GET['categ'])){
			$p = $_GET['categ'];
			if(isset($arr2[$p])){
				foreach($arr as $item){
					if($arr2[$p] == $item['categ']){
						$kitchenContent = Page::model()->findByPk( $item['cont_id'] );
					}
				}
				$KitchensCriteria            = new CDbCriteria;
				$KitchensCriteria->condition = 'filtr LIKE "%'.$arr2[$p].'%" and is_show=1';
				$KitchensCriteria->order = 'sorts';
			}
			else{
				throw new CHttpException(404);
			}
		}
		else{
			$kitchenContent = Page::model()->findByPk( 15 );
			$KitchensCriteria            = new CDbCriteria;
			$KitchensCriteria->condition = 'is_show=:is_show';
			$KitchensCriteria->params    = array( ':is_show' => "1" );
			$KitchensCriteria->order = 'sorts';
		}

		$kitchens = Kitchen::model()->findAll( $KitchensCriteria );

		$this->pageTitle = "Кухонные гарнитуры";

		if(!empty($SEO)){
			//print_r($SEO[0]['desription']);

		}*/

		//$this->render( 'gotovye-kuhni', array( 'kitchens' => $kitchens, 'kitchenContent' => $kitchenContent ) );
		$kitchens[] = Kitchen::model()->findByPk( 15 );
		$kitchens[] = Kitchen::model()->findByPk( 16 );
		$kitchens[] = Kitchen::model()->findByPk( 17 );
		$kitchens[] = Kitchen::model()->findByPk( 25 );
		$kitchens[] = Kitchen::model()->findByPk( 45 );
		$kitchens[] = Kitchen::model()->findByPk( 37 );
		
		$kitchens[] = Kitchen::model()->findByPk( 47 );
		$kitchens[] = Kitchen::model()->findByPk( 27 );
		$kitchens[] = Kitchen::model()->findByPk( 21 );
		$kitchens[] = Kitchen::model()->findByPk( 22 );
		$kitchens[] = Kitchen::model()->findByPk( 23 );
		$kitchens[] = Kitchen::model()->findByPk( 24 );
		
		$this->render( 'katalog-kuhon', array('katalogKuhon' => $katalogKuhon, 'kitchens' => $kitchens));
	}
}