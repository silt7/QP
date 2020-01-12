<?php


Yii::import( 'application.models.ItemModule' );


/**
 * This is the model class for table "order_lines".
 *
 * The followings are the available columns in table 'order_lines':
 * @property integer $id
 * @property integer $order_id
 * @property integer $item_id
 * @property string $item_type
 * @property string $item_title
 * @property string $options
 * @property integer $quantity
 * @property integer $price
 * @property integer $pre_pay
 */
class OrderLine extends CActiveRecord {
	public static $itemTypes = array(
		"module"     => array( "name" => "module", "model" => "ItemModule", "viewItem" => "module-item", "label" => "Кухонный модуль" ),
		"front"      => array( "name" => "front", "model" => "ItemFront", "viewItem" => "front-item", "label" => "Фасад" ),
		"cover"      => array( "name" => "cover", "model" => "ItemCover", "viewItem" => "cover-item", "label" => "Покрытие" ),
		"tabletop"   => array( "name" => "tabletop", "model" => "ItemCover", "viewItem" => "front-item", "label" => "Столешинца" ),
		"wall_panel" => array( "name" => "wall_panel", "model" => "ItemCover", "viewItem" => "front-item", "label" => "Стеновая панель" ),
		"accessory"  => array( "name" => "accessory", "model" => "Accessory", "viewItem" => "accessory-item", "label" => "Аксессур" ),
		"equipment"  => array( "name" => "equipment", "model" => "Equipment", "viewItem" => "equipment-item", "label" => "Техника" ),
	);

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 *
	 * @param string $className active record class name.
	 *
	 * @return OrderLine the static model class
	 */
	public static function model( $className = __CLASS__ ) {
		return parent::model( $className );
	}

	public function getModel() {
		return OrderLine::$itemTypes[ $this->item_type ];
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'order_lines';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array( 'order_id, item_id, item_type, item_title, options, quantity, price', 'required' ),
			array( 'order_id, item_id, quantity, price', 'numerical', 'integerOnly' => true ),
			array( 'item_type', 'length', 'max' => 20 ),
			array( 'item_title', 'length', 'max' => 100 ),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array( 'id, order_id, item_id, item_type, item_title, options, quantity, price', 'safe', 'on' => 'search' ),
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
			'id'         => 'ID',
			'order_id'   => 'Order',
			'item_id'    => 'Item',
			'item_type'  => 'Item Type',
			'item_title' => 'Item Title',
			'options'    => 'Options',
			'quantity'   => 'Quantity',
			'price'      => 'Price',
			'pre_pay'    => 'pre_pay',
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
		$criteria->compare( 'order_id', $this->order_id );
		$criteria->compare( 'item_id', $this->item_id );
		$criteria->compare( 'item_type', $this->item_type, true );
		$criteria->compare( 'item_title', $this->item_title, true );
		$criteria->compare( 'options', $this->options, true );
		$criteria->compare( 'quantity', $this->quantity );
		$criteria->compare( 'price', $this->price );
		$criteria->compare( 'pre_pay', $this->pre_pay );

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
	 * Возвращает модель товара
	 * @return mixed
	 */
	public function getItemModel() {
		switch ( $this->item_type ) {
			case OrderLine::$itemTypes["module"]["name"]: {
				return ItemModule::model()->findByPk( $this->item_id );
			}
		}
	}

}
