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
 * @property string $name
 * @property string $phone
 * @property string $address
 * @property integer $delivery_type
 * @property integer $is_paid
 * @property integer $total_price
 * @property integer $status
 * @property integer $shopping_cart_id
 * @property integer $comment
 */
class Order extends CActiveRecord {
	/**
	 * статусы
	 * @var array
	 */
	public static $statusArray = array(
		'create'           => array( 'name' => 'create', 'label' => 'Создан' ),
		'ordering_success' => array( 'name' => 'ordering_success', 'label' => 'Одобрен' ),
		'ordering_wait' => array( 'name' => 'ordering_wait', 'label' => 'Ожидает завершения оплаты' ),
		'rejected'         => array( 'name' => 'rejected', 'label' => 'Отменен' ),
		'paid'             => array( 'name' => 'paid', 'label' => 'Оплачен' ),
	);

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
		return 'orders_final';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array( 'user_id, is_guest_user, guest_user_id, datetime, email, phone, address, delivery_type, is_paid, total_price, status', 'required' ),
			array( 'user_id, is_guest_user, delivery_type, is_paid, total_price ', 'numerical', 'integerOnly' => true ),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array(
				'id,name,shopping_cart_id, user_id, is_guest_user, guest_user_id, datetime, email, phone, address, delivery_type, is_paid, total_price, status',
				'safe',
				'on' => 'search'
			),
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
			'shopping_cart_id' => 'shopping_cart_id',
			'user_id'          => 'User',
			'is_guest_user'    => 'Is Guest User',
			'guest_user_id'    => 'Guest User',
			'datetime'         => 'Datetime',
			'email'            => 'Email',
			'phone'            => 'Phone',
			'address'          => 'Address',
			'delivery_type'    => 'Delivery Type',
			'is_paid'          => 'Is Paid',
			'total_price'      => 'Total Price',
			'status'           => 'Status',
			'name'             => 'name',
			'comment'          => 'comment',
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
		$criteria->compare( 'shopping_cart_id', $this->shopping_cart_id );
		$criteria->compare( 'name', $this->name );
		$criteria->compare( 'comment', $this->comment );

		return new CActiveDataProvider( $this, array(
			'criteria' => $criteria,
		) );
	}

	/**
	 * Полная стоимость корзины
	 */
	public function getTotalPrice() {

		return $this->getShoppingCart()->getTotalPrice();

	}

	public function getShoppingCart() {
		return ShoppingCart::model()->findByPk( $this->shopping_cart_id );
	}

	public function getLines() {
		return $this->getShoppingCart()->getLines();
	}

	/**
	 * Полная предоплата корзины
	 */
	public function getTotalPrePay() {

		return $this->getShoppingCart()->getTotalPrePay();

	}

	/**
	 * Количество товаров в корзине (шт)
	 */
	public function getTotalCount() {
		return $this->getShoppingCart()->getTotalCount();
	}

	/**
	 * Метод для вывода массива строк заказа
	 *
	 * @return array
	 */
	public function getLinesToView() {
		return $this->getShoppingCart()->getLinesToView();

	}

	public function getTitle() {
		$year = substr($this->datetime, 0, 4);
		$mounth  = substr($this->datetime, 5, 2);
		$day = substr($this->datetime, 8, 2);
		$time = substr($this->datetime, -8);
		$datetime = $day.".".$mounth.".".$year." ".$time;
		return "Заказ № QP-$this->id от $datetime";
	}

	public function getUserLogin() {
		if ( $this->user_id ) {
			return User::model()->findByPk( $this->user_id )->email;
		} else {
			return "Гость";
		}
	}

}