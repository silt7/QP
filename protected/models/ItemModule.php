<?php

/**
 * This is the model class for table "item_modules".
 *
 * The followings are the available columns in table 'item_modules':
 * @property integer $id
 * @property integer $is_show
 * @property string $title
 * @property integer $price
 * @property string $price_with_front
 * @property string $image
 * @property string description
 * @property string $options
 * @property string $colors
 * @property string $fronts
 * @property string $pre_pay
 * @property string $folder_id
 */
class ItemModule extends CActiveRecord {
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 *
	 * @param string $className active record class name.
	 *
	 * @return ItemModule the static model class
	 */
	public static function model( $className = __CLASS__ ) {
		return parent::model( $className );
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'item_modules';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array( 'title', 'required' ),
			array( 'price', 'numerical', 'integerOnly' => true ),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array( 'id, folder_id, is_show, title, price, price_with_front, image, description, options', 'safe', 'on' => 'search' ),
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
			'id'               => 'ID',
			'is_show'          => 'is show',
			'title'            => 'Title',
			'price'            => 'Price',
			'price_with_front' => 'Price With Front',
			'image'            => 'Image',
			'description'      => 'Description',
			'options'          => 'Options',
			'colors'           => 'Colors',
			'fronts'           => 'Fronts',
			'pre_pay'          => 'Pre Pay',
			'folder_id'        => 'folder_id',
			'filtr'            => 'filtr',
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
		$criteria->compare( 'is_show', $this->title, true );
		$criteria->compare( 'title', $this->title, true );
		$criteria->compare( 'price', $this->price );
		$criteria->compare( 'price_with_front', $this->price_with_front, true );
		$criteria->compare( 'image', $this->image, true );
		$criteria->compare( 'description', $this->description, true );
		$criteria->compare( 'options', $this->options, true );
		$criteria->compare( 'colors', $this->colors, true );
		$criteria->compare( 'fronts', $this->fronts, true );
		$criteria->compare( 'pre_pay', $this->pre_pay, true );
		$criteria->compare( 'folder_id', $this->folder_id, true );
		$criteria->compare( 'filtr', $this->filtr, true );

		return new CActiveDataProvider( $this, array(
			'criteria' => $criteria,
		) );
	}

	/**
	 * Установка сериализованного атрибута
	 *
	 * @param $fronts
	 * @param bool $isNeedsToSave
	 */
	public function setFronts( $fronts, $isNeedsToSave = false ) {

		$this->fronts = serialize( $fronts );
		if ( $isNeedsToSave ) {
			return $this->update();
		}

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

	
	
	public function getModuleColors() {
		return unserialize( $this->colors );
	}

	public function getFrontColors() {

		$fronts            = $this->getFronts();
		$moduleFrontColors = array();
		foreach ( $fronts as $front ) {
			if ( $front ) {
				$frontModel  = ItemFront::model()->findByPk( $front["id"] );
				$frontColors = $frontModel->getColors();
				if ( empty( $moduleFrontColors ) ) {
					$moduleFrontColors = $frontColors;
				} else {
					foreach ( $moduleFrontColors as $id => $color ) {
						//print_r( $frontColors[ $id ] );
						if ( isset( $frontColors[ $id ] ) && $frontColors[ $id ]["is_enabled"] ) {
							$moduleFrontColors[ $id ]["price"] += $frontColors[ $id ]["price"] * $front["count"];
						} else {
							unset( $moduleFrontColors[ $id ] );
						}
					}
				}


				//return $front->getColors();

			}
		}

//		print_r( $moduleFrontColors );

		return $moduleFrontColors;

	}

		public function getFrontColorsABC() {

		$fronts            = $this->getFronts();
		$moduleFrontColors = array();
		foreach ( $fronts as $front ) {
			if ( $front ) {
				$frontModel  = ItemFront::model()->findByPk( $front["id"] );
				$frontColors = $frontModel->getColors();
				if ( empty( $moduleFrontColors ) ) {
					$moduleFrontColors = $frontColors;
				} else {
					foreach ( $moduleFrontColors as $id => $color ) {
						//print_r( $frontColors[ $id ] );
						if ( isset( $frontColors[ $id ] ) && $frontColors[ $id ]["is_enabled"] ) {
							$moduleFrontColors[ $id ]["price"] += $frontColors[ $id ]["price"] * $front["count"];
						} else {
							unset( $moduleFrontColors[ $id ] );
						}
					}
				}
			}
		}
		$colors = $moduleFrontColors;
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
	
	public
	function getFronts() {
		return unserialize( $this->fronts );
	}

	/**
	 * Путь до изображения
	 * @return string
	 */
	public
	function getImage() {
		return '/images/item_modules/' . $this->image;
	}


	public
	function getFolderModel() {
		$folderModel = null;
		if ( $this->folder_id ) {
			$folderModel = Folder::model()->findByPk( $this->folder_id );
		}

		return $folderModel;
	}


}
