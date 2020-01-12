<?php

/**
 * This is the model class for table "actions".
 *
 * The followings are the available columns in table 'actions':
 * @property integer $id
 * @property integer $is_show
 * @property string $title
 * @property string $text
 * @property string $short_text
 */
class Action extends CActiveRecord {
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 *
	 * @param string $className active record class name.
	 *
	 * @return Action the static model class
	 */
	public static function model( $className = __CLASS__ ) {
		return parent::model( $className );
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'actions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array( 'title', 'required' ),
			array( 'is_show', 'numerical', 'integerOnly' => true ),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array( 'id, is_show, title, text, short_text', 'safe', 'on' => 'search' ),
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
			'is_show'    => 'Is Show',
			'title'      => 'Title',
			'text'       => 'Text',
			'short_text' => 'Short Text',
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
		$criteria->compare( 'is_show', $this->is_show );
		$criteria->compare( 'title', $this->title, true );
		$criteria->compare( 'text', $this->text, true );
		$criteria->compare( 'short_text', $this->short_text, true );

		return new CActiveDataProvider( $this, array(
			'criteria' => $criteria,
		) );
	}
}
