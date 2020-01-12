<?php

/**
 * This is the model class for table "equipment".
 *
 * The followings are the available columns in table 'equipment':
 * @property integer $id
 * @property integer $folder_id
 * @property integer $is_show
 * @property string $title
 * @property integer $price
 * @property integer $pre_pay
 * @property string $image
 * @property string $description
 * @property string $options
 */
class Equipment extends CActiveRecord {
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 *
	 * @param string $className active record class name.
	 *
	 * @return Equipment the static model class
	 */
	public static function model( $className = __CLASS__ ) {
		return parent::model( $className );
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'equipment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array( 'folder_id, is_show, title, price, pre_pay, image, description, colors', 'required' ),
			array( 'folder_id, is_show, price, pre_pay', 'numerical', 'integerOnly' => true ),
			array( 'title, image', 'length', 'max' => 200 ),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array( 'id, folder_id, is_show, title, price, pre_pay, image, description, options', 'safe', 'on' => 'search' ),
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
			'folder_id'   => 'Folder',
			'is_show'     => 'Is Show',
			'title'       => 'Title',
			'price'       => 'Price',
			'pre_pay'     => 'Pre Pay',
			'image'       => 'Image',
			'description' => 'Description',
			'options'     => 'options',
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
		$criteria->compare( 'folder_id', $this->folder_id );
		$criteria->compare( 'is_show', $this->is_show );
		$criteria->compare( 'title', $this->title, true );
		$criteria->compare( 'price', $this->price );
		$criteria->compare( 'pre_pay', $this->pre_pay );
		$criteria->compare( 'image', $this->image, true );
		$criteria->compare( 'description', $this->description, true );
		$criteria->compare( 'options', $this->options, true );

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
	 * Путь до изображения
	 * @return string
	 */
	public function getImage() {
		return '/images/item_equipment/' . $this->image;
	}

	public function getFolderModel() {
		$folderModel = null;
		if ( $this->folder_id ) {
			$folderModel = Folder::model()->findByPk( $this->folder_id );
		}

		return $folderModel;
	}


}
