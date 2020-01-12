<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string $phone
 * @property string $address
 * @property string $role
 * @property integer $current_order_id
 * @property integer $is_sign_in
 */
class User extends CActiveRecord {

	/**
	 * Проверка роли
	 *
	 * @param $roleRequired
	 * @param $role
	 *
	 * @return bool
	 */
	static public function checkRole( $roleRequired, $role ) {


		return $roleRequired == $role;
	}

	/**
	 * Проверка залогинился ли пользователь
	 *
	 * @param $email
	 *
	 * @return mixed
	 */
	public static function isSignIn( $email ) {

		$criteria = new CDbCriteria;
		//$criteria->select    = 'email'; // only select the 'title' column
		$criteria->condition = 'email=:email';
		$criteria->params    = array( ':email' => $email );

		$userModel = User::model()->find( $criteria );

		//print_r( $userModel );

		if ( ! is_null( $userModel ) ) {
			return $userModel->is_sign_in;

		} else {
			return false;
		}

	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 *
	 * @param string $className active record class name.
	 *
	 * @return Users the static model class
	 */
	public static function model( $className = __CLASS__ ) {
		return parent::model( $className );
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
//			array( 'first_name, last_name, email, password, phone, address, role', 'required' ),
			array( 'is_sign_in', 'numerical', 'integerOnly' => true ),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array( 'id,current_order_id, first_name, last_name, email, password, phone, address, role, is_sign_in', 'safe', 'on' => 'search' ),
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
			'first_name'       => 'First Name',
			'last_name'        => 'Last Name',
			'email'            => 'Email',
			'password'         => 'Password',
			'phone'            => 'Phone',
			'address'          => 'Address',
			'role'             => 'Role',
			'current_order_id' => 'current_order_id',
			'is_sign_in'       => 'Is Sign In',
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
		$criteria->compare( 'first_name', $this->first_name, true );
		$criteria->compare( 'last_name', $this->last_name, true );
		$criteria->compare( 'email', $this->email, true );
		$criteria->compare( 'password', $this->password, true );
		$criteria->compare( 'phone', $this->phone, true );
		$criteria->compare( 'address', $this->address, true );
		$criteria->compare( 'role', $this->role, true );
		$criteria->compare( 'current_order_id', $this->current_order_id );
		$criteria->compare( 'is_sign_in', $this->is_sign_in );

		return new CActiveDataProvider( $this, array(
			'criteria' => $criteria,
		) );
	}

	/**
	 * Проверка пароля
	 *
	 * @param $password
	 *
	 * @return bool
	 */
	public function checkPassword( $password ) {
		return $this->password == md5( $password );
	}

	/**
	 * Установка пароля + шифрование
	 *
	 * @param $password
	 */
	public function setPassword( $password ) {
		$this->password = md5( $password );
	}

	/**
	 * Пользователь залогинился
	 */
	public function setSignIn() {
		$this->is_sign_in = 1;
		$this->update();
	}

	/**
	 * Пользователь разлогинился
	 */
	public function setSignOut() {
		$this->is_sign_in = 0;
		$this->update();
	}

	public function getCurrentOrderModel() {
		if ( $this->current_order_id ) {
			return ShoppingCart::model()->findByPk( $this->current_order_id );
		}
	}

	public function getOrders() {

		$criteria            = new CDbCriteria();
		$criteria->condition = "user_id = " . $this->id;
		$criteria->order     = " id DESC ";

		return Order::model()->findAll( $criteria );

	}

}
