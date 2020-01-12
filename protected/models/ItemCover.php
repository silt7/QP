<?php

/**
 * This is the model class for table "tabletops".
 *
 * The followings are the available columns in table 'tabletops':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $image
 * @property string $price
 * @property string $pre_pay
 * @property string $is_show
 * @property string $colors
 * @property string $options
 * @property string $folder_id
 * @property string $extra_size
 */
class ItemCover extends CActiveRecord {
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 *
	 * @param string $className active record class name.
	 *
	 * @return Tabletops the static model class
	 */
	public static function model( $className = __CLASS__ ) {
		return parent::model( $className );
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'item_covers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('title, description, image, price, colors, options', 'required'),
			array( 'title, image', 'length', 'max' => 200 ),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array( 'id,folder_id, title,pre_pay,is_show, description, image, price, colors, options', 'safe', 'on' => 'search' ),
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
			'id'          => 'ID',
			'title'       => 'Title',
			'description' => 'Description',
			'image'       => 'Image',
			'price'       => 'Price',
			'colors'      => 'Colors',
			'options'     => 'Options',
			'pre_pay'     => 'pre_pay',
			'is_show'     => 'is_show',
			'folder_id'   => 'folder_id',
			'extra_size'  => 'extra_size',
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
		$criteria->compare( 'description', $this->description, true );
		$criteria->compare( 'image', $this->image, true );
		$criteria->compare( 'price', $this->price, true );
		$criteria->compare( 'colors', $this->colors, true );
		$criteria->compare( 'options', $this->options, true );
		$criteria->compare( 'pre_pay', $this->pre_pay, true );
		$criteria->compare( 'is_show', $this->is_show, true );
		$criteria->compare( 'folder_id', $this->folder_id, true );
		$criteria->compare( 'extra_size', $this->extra_size, true );

		return new CActiveDataProvider( $this, array(
			'criteria' => $criteria,
		) );
	}

	/**
	 * Путь до изображения
	 * @return string
	 */
	public function getImage() {
		return '/images/item_tabletops/' . $this->image;
	}


	public function getFolderModel() {
		$folderModel = null;
		if ( $this->folder_id ) {
			$folderModel = Folder::model()->findByPk( $this->folder_id );
		}

		return $folderModel;
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

	public function stdSizeCover() {
		/*-------------Стандартные размеры------------*/
		if($this->id == 16){$std_w = 600; $std_h = 1500;}
		else if($this->id == 25){$std_w = 500; $std_h = 2950;}
		else if($this->id == 26){$std_w = 500; $std_h = 2400;}
		else{$std_w = 600;$std_h = 3000;}
		return array('std_w' => $std_w, 'std_h' => $std_h);
	}


}
