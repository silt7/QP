<?php

/**
 * This is the model class for table "item_fronts".
 *
 * The followings are the available columns in table 'item_fronts':
 * @property integer $id
 * @property string $title
 * @property string $image
 * @property string $colors
 * @property string $options
 * @property integer $is_show
 * @property integer $pre_pay
 */
Yii::import( 'application.models.Frez' );
class ItemFront extends CActiveRecord {
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 *
	 * @param string $className active record class name.
	 *
	 * @return ItemFront the static model class
	 */
	public static function model( $className = __CLASS__ ) {
		return parent::model( $className );
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'item_fronts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array( 'title, image, colors, is_show', 'required' ),
			array( 'is_show', 'numerical', 'integerOnly' => true ),
			array( 'image', 'length', 'max' => 60 ),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array( 'id, title, image, colors, is_show', 'safe', 'on' => 'search' ),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id'      => 'ID',
			'title'   => 'Title',
			'image'   => 'Image',
			'options' => 'Options',
			'colors'  => 'Colors',
			'is_show' => 'Is Show',
			'pre_pay' => 'pre_pay',
			'filtr'   => 'filtr',
			//'count_milling' => 20
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search() {
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare( 'id', $this->id );
		$criteria->compare( 'title', $this->title, true );
		$criteria->compare( 'image', $this->image, true );
		$criteria->compare( 'colors', $this->colors, true );
		$criteria->compare( 'options', $this->options, true );
		$criteria->compare( 'is_show', $this->is_show );
		$criteria->compare( 'pre_pay', $this->pre_pay );
		$criteria->compare( 'filtr', $this->filtr, true );

		return new CActiveDataProvider( $this, array(
			'criteria' => $criteria,
		) );
	}

	/**
	 * Установка сериализованного атрибута
	 *
	 * @param $options
	 * @param bool $isNeedsToSave
	 */
	public function setOptions( $options, $isNeedsToSave = false ) {

		$this->options = serialize( $options );
		if ( $isNeedsToSave ) {
			return $this->update();
		}

	}


	public function getOptions() {
		return unserialize( $this->options );
	}

	/**
	 * Установка сериализованного атрибута
	 *
	 * @param $colors
	 * @param bool $isNeedsToSave
	 */
	public function setColors( $colors, $isNeedsToSave = false ) {

		$this->colors = serialize( $colors );
		if ( $isNeedsToSave ) {
			return $this->update();
		}

	}


	public function getColors() {
		return unserialize( $this->colors );
	}

	public function getColorsABC() {
		$colors = unserialize( $this->colors );
		$colorMaterials = Color::$materials;
		$arrColors = array();
		foreach($colorMaterials as $colorMaterial){
			$material = $colorMaterial['name'];
			$label = $colorMaterial['label'];
			$arr = array();
			foreach($colors as $color){
				$colorModel = Color::model()->findByPk( $color["id"] );
				if($colorModel['material'] == $colorMaterial['name']){
					array_push($arr,$color);
					 
				}
			}
			$arrColors[$material] = array("arr_color" => $arr, "label" => $label);
		}
		return $arrColors;
	}
	/**
	 * Путь до изображения
	 * @return string
	 */
	public function getImage() {
		return '/images/item_fronts/' . $this->image;
	}
/* 	public function updPrice() {
	} */
			/**
	 * Функция вывода всех категорий и цветов фасадов
	 */
	public function getColorsCategory() {
		$Select_all_categ = new CDbCriteria;
		$Select_all_categ -> select	   = array('material');
		$Select_all_categ -> condition = "is_show = 1 and is_front = 1";
		$Select_all_categ -> group     = 'material';
		$all_categ = Color::model() -> findAll($Select_all_categ);

		$arrCategColor = array();
		foreach ($all_categ as $categItem) {
			$Select_all_color = new CDbCriteria;
			$Select_all_color -> condition = "is_show = 1 and is_front = 1 and material = '".$categItem->material."'";
			$all_color = Color::model() -> findAll($Select_all_color);
			$arrCategColor[$categItem->material] = $all_color;
		}
		return $arrCategColor;
	}


	/**
	 * Функция группировки и порядка вывода категорий
	 */
	public function  sortCategoryColors(){
		$arraySort  =   array(0 => array('ЛДСП',array(1=>'ldsp')),
			1 => array('ЭКО Шпон',array(1 => 'ecoshpon1', 2 => 'ecoshpon2')),
			2 => array('ЭКО Шпон сборный',array(1 => 'EcoshponS1', 2 => 'EcoshponS2')),
			3 => array('Пластик',array(1=>'plastic')),
			4 => array('Пластик 3D',array(1=>'plastic3D')),
			5 => array('МДФ-пленка',array(1 => 'mdf', 2 => 'mdf2', 3 => 'mdf3', 4 => 'mdf4', 5 => 'mdf5')),
			6 => array('МДФ-патина',array(1 => 'mdfPatina2', 2 => 'mdfPatina3')),
			7 => array('Крашеные(Эмаль)',array(1=>'emal',2=>'emal2',3=>'emal3')),
			8 => array('Акрил',array(1=>'acryl')),
			9 => array('Шпон натуральный',array(1 => 'shpon1', 2 => 'shpon2', 3 => 'shpon3', 4 => 'shpon4')),
			10 => array('Стекло',array(1=>'glass')),
			11 => array('Алюминий',array(1=>'alum')),
			12 => array('Алюминий',array(1=>'acryl3D'))
		);
		return $arraySort;
	}
	
    public function allMilling(){
		return array(
			'price_fr1'  => '101',
			'price_fr2'  => '102',
			'price_fr3'  => '103',
			'price_fr4'  => '104',
			'price_fr5'  => '105',
			'price_fr6'  => '106',
			'price_fr7'  => '107',
			'price_fr8'  => '108',
			'price_fr9'  => '109',
			'price_fr10' => '110',
			'price_fr11' => '111',
			'price_fr12' => '112',
			'price_fr13' => '113',
			'price_fr14' => '114',
			'price_fr15' => '115',
			'price_fr16' => '116'
		);
	}
	public function getMilling(){
		$selectMilling = new CDbCriteria;
		$selectMilling -> condition = "id_front=:id_front";
		$selectMilling -> params = array(':id_front' => $this->id);
		$millingFront = PriceFrontFrez::model()->findAll($selectMilling);
		$arrMilling = array();
		if(!empty($millingFront)){
			foreach($millingFront as $item){
				$arr = array();
				$allMillingKeys = array_keys($this::allMilling());
				for($i = 0; $i < count($allMillingKeys); $i++){
					$k = $allMillingKeys[$i];
					$price = $item->$k;
					$id = $this::allMilling()[$k];
					$milling = Frez::model()->findByPk($id);
					if($price > 0) {
						array_push($arr, array('id' => $id,'price' => $price, 'title' => $milling['title']));
					}
				}
				$arrMilling[$item->id_category] = $arr;
			}
		}
		return $arrMilling;
		//$this->id;
	}
	public function getPriceColorMilling($color){
		$front = $this;
		$price = 0;
		$millingsFront = array();
		if ( isset($color) and isset($front) ) {
			$colorcategoryCriteria            = new CDbCriteria;
			$colorcategoryCriteria->condition = 'name=:name';
			$colorcategoryCriteria->params    = array( ':name' => $color->material );

			$idCategory = ColorCategory::model()->findAll( $colorcategoryCriteria );
			$idCategory = array_shift($idCategory);
			if(isset($idCategory->id)) {
				$coloritemCriteria = new CDbCriteria;
				$coloritemCriteria->condition = 'id_category=:id_category and id_front = :id_front';
				$coloritemCriteria->params = array(':id_category' => $idCategory->id, ':id_front' => $front->id);

				$PriceFrontColor = PriceFrontColor::model()->findAll($coloritemCriteria);

				if (isset($PriceFrontColor[0]->price_category)) {
					$price = $PriceFrontColor[0]->price_category;
				}
				
				$millings = $front->getMilling();
				if(isset($millings[$idCategory->id])) {
					$millingsFront = $millings[$idCategory->id];
				}			
			}
		}
		return array('price'=>$price, 'millingsFront'=>$millingsFront);
	}

}