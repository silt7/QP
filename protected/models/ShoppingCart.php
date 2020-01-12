<?php

/**
 * This is the model class for table "orders".
 *
 * The followings are the available columns in table 'orders':
 * @property integer $id
 * @property integer $user_id
 * @property integer $is_guest_user
 * @property string $guest_user_id
 * @property string $datetime
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property integer $delivery_type
 * @property integer $is_paid
 * @property integer $total_price
 * @property integer $status
 * @property integer $title
 * @property integer $is_saved
 */
class ShoppingCart extends CActiveRecord {
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 *
	 * @param string $className active record class name.
	 *
	 * @return ShoppingCart the static model class
	 */
	public static function model( $className = __CLASS__ ) {
		return parent::model( $className );
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'shopping_carts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array( 'user_id, is_guest_user, guest_user_id, datetime, email, phone, address, delivery_type, is_paid, total_price, status', 'required' ),
			array( 'user_id, is_guest_user, delivery_type, is_paid, total_price, status', 'numerical', 'integerOnly' => true ),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array( 'id,title, user_id, is_guest_user, guest_user_id, datetime, email, phone, address, delivery_type, is_paid, total_price, status', 'safe', 'on' => 'search' ),
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
			'id'            => 'ID',
			'user_id'       => 'User',
			'is_guest_user' => 'Is Guest User',
			'guest_user_id' => 'Guest User',
			'datetime'      => 'Datetime',
			'email'         => 'Email',
			'phone'         => 'Phone',
			'address'       => 'Address',
			'delivery_type' => 'Delivery Type',
			'is_paid'       => 'Is Paid',
			'total_price'   => 'Total Price',
			'status'        => 'Status',
			'title'         => 'title',
			'is_saved'      => 'is_saved',
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
		$criteria->compare( 'user_id', $this->user_id );
		$criteria->compare( 'is_guest_user', $this->is_guest_user );
		$criteria->compare( 'guest_user_id', $this->guest_user_id, true );
		$criteria->compare( 'datetime', $this->datetime, true );
		$criteria->compare( 'email', $this->email, true );
		$criteria->compare( 'phone', $this->phone, true );
		$criteria->compare( 'address', $this->address, true );
		$criteria->compare( 'delivery_type', $this->delivery_type );
		$criteria->compare( 'is_paid', $this->is_paid );
		$criteria->compare( 'total_price', $this->total_price );
		$criteria->compare( 'status', $this->status );
		$criteria->compare( 'title', $this->title );
		$criteria->compare( 'is_saved', $this->is_saved );

		return new CActiveDataProvider( $this, array(
			'criteria' => $criteria,
		) );
	}

	/**
	 * Полная стоимость корзины
	 */
	public function getTotalPrice() {

		$orderLines = $this->getLines();

		$price = 0;

		foreach ( $orderLines as $orderLine ) {
			$price += $orderLine->quantity * $orderLine->price;
		}

		return $price;

	}

	public function getLines() {
		$criteria            = new CDbCriteria;
		$criteria->condition = 'order_id=:order_id';
		$criteria->params    = array( ':order_id' => $this->id );

		return OrderLine::model()->findAll( $criteria );
	}

	/**
	 * Полная предоплата корзины
	 */
	public function getTotalPrePay() {

		$orderLines = $this->getLines();

		$prePay = 0;

		foreach ( $orderLines as $orderLine ) {
			$prePay += $orderLine->quantity * $orderLine->pre_pay;
		}

		return $prePay;

	}

	/**
	 * Количество товаров в корзине (шт)
	 */
	public function getTotalCount() {

		$orderLines = $this->getLines();

		$count = 0;

		foreach ( $orderLines as $orderLine ) {
			$count += $orderLine->quantity;
		}

		return $count;
	}

	/**
	 * Метод для вывода массива строк заказа
	 *
	 * @return array
	 */
	public function getLinesToView() {

		$items = array();

		$orderLines = $this->getLines();


		foreach ( $orderLines as $orderLine ) {
			$options     = $orderLine->getOptions();
			$itemOptions = "";//$options["options_checked"];

			if ( isset( $options["options_checked"] ) ) {
				$itemOptions = $options["options_checked"];
			}

			if ( $orderLine->item_type == OrderLine::$itemTypes["module"]["name"] ) {
				$moduleColorId = isset( $options["module_color_id"] ) ? $options["module_color_id"] : null;
				$frontColorId  = isset( $options["front_color_id"] ) ? $options["front_color_id"] : null;

				if ( ! isset( $items[ $moduleColorId . "-" . $frontColorId ] ) ) {
					$items[ $moduleColorId . "-" . $frontColorId ] = array();
				}
				$items[ $moduleColorId . "-" . $frontColorId ]["module_color_id"]                   = $moduleColorId;
				$items[ $moduleColorId . "-" . $frontColorId ]["front_color_id"]                    = $frontColorId;
				$items[ $moduleColorId . "-" . $frontColorId ][ $orderLine->id ]                    = array();
				$items[ $moduleColorId . "-" . $frontColorId ][ $orderLine->id ]["options_checked"] = $itemOptions;

				if ( ! isset( $items[ $moduleColorId . "-" . $frontColorId ]["items"] ) ) {
					$items[ $moduleColorId . "-" . $frontColorId ]["items"] = array();
				}

//				print_r( $modules[ $moduleColorId . "-" . $frontColorId ]["options_checked"] );
//				print_r( '<br>' );

				array_push( $items[ $moduleColorId . "-" . $frontColorId ]["items"], $orderLine );

			} elseif ( $orderLine->item_type == OrderLine::$itemTypes["front"]["name"] ) {
				$frontColorId = $options["front_color_id"];

				if ( ! isset( $items[ "0-" . $frontColorId ] ) ) {
					$items[ "0-" . $frontColorId ] = array();
				}
				$items[ "0-" . $frontColorId ]["module_color_id"]                   = null;
				$items[ "0-" . $frontColorId ]["front_color_id"]                    = $frontColorId;
				if(isset($options["cover_width"])and isset($options["cover_length"])){
					$items[ "0-" . $frontColorId ]["cover_width"]                       = $options["cover_width"];
					$items[ "0-" . $frontColorId ]["cover_length"]                      = $options["cover_length"];
				}
				$items[ "0-" . $frontColorId ][ $orderLine->id ]                    = array();
				$items[ "0-" . $frontColorId ][ $orderLine->id ]["options_checked"] = $itemOptions;
				if ( ! isset( $items[ "0-" . $frontColorId ]["items"] ) ) {
					$items[ "0-" . $frontColorId ]["items"] = array();
				}

				array_push( $items[ "0-" . $frontColorId ]["items"], $orderLine );

			} elseif ( $orderLine->item_type == OrderLine::$itemTypes["cover"]["name"] ) {

				$coverColorId = $options["cover_color_id"];

				if ( ! isset( $items[ "cover-" . $orderLine->id ] ) ) {
					$items[ "cover-" . $orderLine->id ] = array();
				}
				$items[ "cover-" . $orderLine->id ]["cover_color_id"]                    = $coverColorId;
				$items[ "cover-" . $orderLine->id ]["factor"]                            = $options["factor"];
				$items[ "cover-" . $orderLine->id ]["cover_width"]                       = $options["cover_width"];
				$items[ "cover-" . $orderLine->id ]["cover_length"]                      = $options["cover_length"];
				$items[ "cover-" . $orderLine->id ][ $orderLine->id ]                    = array();
				$items[ "cover-" . $orderLine->id ][ $orderLine->id ]["options_checked"] = $itemOptions;
				if ( ! isset( $items[ "cover-" . $orderLine->id ]["items"] ) ) {
					$items[ "cover-" . $orderLine->id ]["items"] = array();
				}

				array_push( $items[ "cover-" . $orderLine->id ]["items"], $orderLine );

			} elseif ( $orderLine->item_type == OrderLine::$itemTypes["accessory"]["name"] ) {


				if ( ! isset( $items[ "accessory-" . $orderLine->id ] ) ) {
					$items[ "accessory-" . $orderLine->id ] = array();
				}
				$items[ "accessory-" . $orderLine->id ][ $orderLine->id ]                    = array();
				$items[ "accessory-" . $orderLine->id ][ $orderLine->id ]["options_checked"] = $itemOptions;
				if ( ! isset( $items[ "accessory-" . $orderLine->id ]["items"] ) ) {
					$items[ "accessory-" . $orderLine->id ]["items"] = array();
				}

				array_push( $items[ "accessory-" . $orderLine->id ]["items"], $orderLine );

			} elseif ( $orderLine->item_type == OrderLine::$itemTypes["equipment"]["name"] ) {


				if ( ! isset( $items[ "equipment-" . $orderLine->id ] ) ) {
					$items[ "equipment-" . $orderLine->id ] = array();
				}
				$items[ "equipment-" . $orderLine->id ][ $orderLine->id ]                    = array();
				$items[ "equipment-" . $orderLine->id ][ $orderLine->id ]["options_checked"] = $itemOptions;
				if ( ! isset( $items[ "equipment-" . $orderLine->id ]["items"] ) ) {
					$items[ "equipment-" . $orderLine->id ]["items"] = array();
				}

				array_push( $items[ "equipment-" . $orderLine->id ]["items"], $orderLine );

			}
		}

		return $items;
	}

}
