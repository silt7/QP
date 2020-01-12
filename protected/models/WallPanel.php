<?php

/**
 * This is the model class for table "wall_panels".
 *
 * The followings are the available columns in table 'wall_panels':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $image
 * @property integer $price
 * @property integer $pre_pay
 * @property string $colors
 * @property string $options
 * @property integer $is_show
 * @property integer $folder_id
 */
class WallPanel extends CActiveRecord {
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 *
	 * @param string $className active record class name.
	 *
	 * @return WallPanel the static model class
	 */
	public static function model( $className = __CLASS__ ) {
		return parent::model( $className );
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'wall_panels';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array( 'title, description, image, price, pre_pay, colors, options, is_show, folder_id', 'required' ),
			array( 'price, pre_pay, is_show, folder_id', 'numerical', 'integerOnly' => true ),
			array( 'title, image', 'length', 'max' => 200 ),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array( 'id, title, description, image, price, pre_pay, colors, options, is_show, folder_id', 'safe', 'on' => 'search' ),
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
			'pre_pay'     => 'Pre Pay',
			'colors'      => 'Colors',
			'options'     => 'Options',
			'is_show'     => 'Is Show',
			'folder_id'   => 'Folder',
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
		$criteria->compare( 'price', $this->price );
		$criteria->compare( 'pre_pay', $this->pre_pay );
		$criteria->compare( 'colors', $this->colors, true );
		$criteria->compare( 'options', $this->options, true );
		$criteria->compare( 'is_show', $this->is_show );
		$criteria->compare( 'folder_id', $this->folder_id );

		return new CActiveDataProvider( $this, array(
			'criteria' => $criteria,
		) );
	}


	/**
	 * Путь до изображения
	 * @return string
	 */
	public function getImage() {
		return '/images/item_wallpanels/' . $this->image;
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

}
