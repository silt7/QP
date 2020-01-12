<?php

/**
 * This is the model class for table "module_options".
 *
 * The followings are the available columns in table 'module_options':
 * @property integer $id
 * @property string $title
 * @property string $is_show
 * @property string $group
 * @property integer $pre_pay
 * @property integer $image
 */
class ModuleOption extends CActiveRecord {
	/**
	 * Группы опций
	 * @var array
	 */
	public static $groups = array(
		'loop'                    => array( 'name' => 'loop', 'label' => 'Петли' ),
		'guides'                  => array( 'name' => 'guides', 'label' => 'Направляющие' ),
		'milling'                 => array( 'name' => 'milling', 'label' => 'Фрезеровка' ),
		'aluminum_frame'          => array( 'name' => 'aluminum_frame', 'label' => 'Алюминиевая рамка' ),
		'glass_color'             => array( 'name' => 'glass_color', 'label' => 'Цвет стекла' ),
		'left_part'               => array( 'name' => 'left_part', 'label' => 'Левый край' ),
		'right_part'              => array( 'name' => 'right_part', 'label' => 'Правый край' ),
		'bevel'                   => array( 'name' => 'bevel', 'label' => 'Скос' ),
		'curve'                   => array( 'name' => 'curve', 'label' => 'Закругление' ),
		'2_border_radius'         => array( 'name' => '2_border_radius', 'label' => 'Двухстороннее закругление' ),
		'washing_color'           => array( 'name' => 'washing_color', 'label' => 'Цвет мойки' ),
		'height'                  => array( 'name' => 'height', 'label' => 'Высота' ),
		'3d_color'                => array( 'name' => '3d_color', 'label' => 'Цвет 3D канта' ),
		'double_sided_lamination' => array( 'name' => 'double_sided_lamination', 'label' => 'Двухсторонняя ламинация' ),
		'no_standard' 			  => array( 'name' => 'no_standard', 'label' => 'Нестандарт' ),
		'color_option' 			  => array( 'name' => 'color_option', 'label' => 'Цвет' ),
		'edge'  			      => array( 'name' => 'edge', 'label' => 'Кант' ),
	);

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 *
	 * @param string $className active record class name.
	 *
	 * @return ModuleOption the static model class
	 */
	public static function model( $className = __CLASS__ ) {
		return parent::model( $className );
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'module_options';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array( 'title', 'required' ),
			array( 'price', 'numerical', 'integerOnly' => true ),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array( 'id,image, is_show, title, group, price', 'safe', 'on' => 'search' ),
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
			'is_show' => 'is show',
			'group'   => 'Group',
			'pre_pay' => 'pre_pay',
			'image'   => 'image',
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
		$criteria->compare( 'group', $this->group, true );
		$criteria->compare( 'pre_pay', $this->pre_pay );
		$criteria->compare( 'is_show', $this->is_show, true );
		$criteria->compare( 'image', $this->image, true );

		return new CActiveDataProvider( $this, array(
			'criteria' => $criteria,
		) );
	}

	/**
	 * Название группы опций
	 * @return mixed
	 */
	public function getGroupLabel() {
		return isset( ModuleOption::$groups[ $this->group ] ) ? ModuleOption::$groups[ $this->group ]['label'] : "";
	}


	/**
	 * Путь до изображения
	 * @return string
	 */
	public function getImage() {
		return '/images/options/' . $this->image;
	}


}