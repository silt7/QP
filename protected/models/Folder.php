<?php

/**
 * This is the model class for table "folders".
 *
 * The followings are the available columns in table 'folders':
 * @property integer $id
 * @property integer $parent_id
 * @property string $title
 * @property string $image
 * @property integer $position
 * @property integer $is_show
 * @property integer $model
 */
class Folder extends CActiveRecord {
	public static $models = array(
		"itemFront"    => array( "model" => "ItemFront", "label" => "Фасады", "viewList" => "fronts", "viewItem" => "front-item", "viewItemEdit" => "front-edit" ),
		"itemModule"   => array(
			"model"        => "ItemModule",
			"label"        => "Модули",
			"viewList"     => "modules",
			"viewItem"     => "module-item",
			"viewItemEdit" => "module-edit"
		),
		"accessory"    => array( "model" => "Accessory", "label" => "Кухонные аксессуары", "viewList" => "accessories", "viewItem" => "accessory-item", "viewItemEdit" => "accessory-edit" ),
		"equipment"    => array( "model" => "Equipment", "label" => "Кухонная техника", "viewList" => "equipment-list", "viewItem" => "equipment-item", "viewItemEdit" => "equipment-edit" ),
		"wallPanel"    => array(
			"model"        => "ItemCover",
			"label"        => "Стеновые панели",
			"viewList"     => "wall-panels",
			"viewItem"     => "wall-panel-item",
			"viewItemEdit" => "wall-panel-edit"
		),
		"itemTabletop" => array(
			"model"        => "ItemCover",
			"label"        => "Столешницы",
			"viewList"     => "tabletops",
			"viewItem"     => "tabletop-item",
			"viewItemEdit" => "tabletop-edit"
		),
		"itemCornice"  => array(
			"model"        => "ItemCover",
			"label"        => "Корнизы",
			"viewList"     => "cornices",
			"viewItem"     => "cornice-item",
			"viewItemEdit" => "cornice-edit"
		),
		"itemBar"      => array(
			"model"        => "ItemCover",
			"label"        => "Барная стойка",
			"viewList"     => "bars",
			"viewItem"     => "bar-item",
			"viewItemEdit" => "bar-edit"
		),
		"cupboard"      => array(
			"model"        => "Cupboard",
			"label"        => "Шкафы",
		),

	);

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'folders';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array( 'parent_id, title, position', 'required' ),
			array( 'parent_id, is_show, position', 'numerical', 'integerOnly' => true ),
			array( 'title', 'length', 'max' => 200 ),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array( 'id, image, model, is_show, parent_id, title, position', 'safe', 'on' => 'search' ),
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
			'id'        => 'ID',
			'parent_id' => 'Parent',
			'title'     => 'Title',
			'position'  => 'Position',
			'is_show'   => 'is_show',
			'model'     => 'model',
			'image'     => 'image',
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
		$criteria->compare( 'parent_id', $this->parent_id );
		$criteria->compare( 'title', $this->title, true );
		$criteria->compare( 'position', $this->position );
		$criteria->compare( 'is_show', $this->is_show );
		$criteria->compare( 'model', $this->model );
		$criteria->compare( 'image', $this->image );

		return new CActiveDataProvider( $this, array(
			'criteria' => $criteria,
		) );
	}

	public function getChildModels() {
		$childCriteria            = new CDbCriteria;
		$childCriteria->condition = 'parent_id=' . $this->id;
		//$pageCriteria->params    = array( ':url' => "main" );
		$childCriteria->order = 'id ASC';
		$childModels          = Folder::model()->findAll( $childCriteria );

		return $childModels;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 *
	 * @param string $className active record class name.
	 *
	 * @return Folder the static model class
	 */
	public static function model( $className = __CLASS__ ) {
		return parent::model( $className );
	}

	public function getPosition() {
	}

	public function upPosition() {
	}

	public function downPosition() {
	}

	public function getPathString() {

		$returnString = "";

		foreach ( array_reverse( $this->getPath() ) as $folder ) {
			$returnString .= " / " . $folder;
		}

		return $returnString;

	}

	public function getPath() {
		$pathArray         = array();
		$pathArrayToReturn = array();

		$pathArray = $this->reqFolderPath( $this, $pathArray );

		$index = 0;
		foreach ( $pathArray as $folder ) {
			$pathArrayToReturn[ $index ] = $folder->title;
			$index ++;
		}

		return $pathArrayToReturn;
	}

	public function reqFolderPath( $folder, $pathArray ) {

//		print_r( "folder " . $folder->id . " / " );
		array_push( $pathArray, $folder );
//		print_r( "<br>" );
//
//		print_r( $pathArray );
//		print_r( "<br>" );
		$parentFolder = $folder->getParentModel();
		if ( $parentFolder ) {

			return $this->reqFolderPath( $parentFolder, $pathArray );

		}

		return $pathArray;

	}

	public function getParentModel() {
		$parentModel = null;
		if ( $this->parent_id ) {
			$parentModel = Folder::model()->findByPk( $this->parent_id );
		}

		return $parentModel;
	}

	public function getAbsParentModel() {
		$folder = $this->getReqParentModel( $this );

		if ( ! $folder ) {
			$folder = $this;
		}

		return $folder;
	}


	public function getReqParentModel( $folder ) {
		$parentModel = $folder->getParentModel();
		if ( $parentModel ) {
			$parentModel->getReqParentModel( $parentModel );
		}

		return $parentModel;
	}

	public function delete() {

		// some staff


		parent::delete();
	}

	public function getModel() {
		return Folder::$models[ $this->model ];
	}

	/**
	 * Путь до изображения
	 * @return string
	 */
	public function getImage() {
		return '/images/folders/' . $this->image;
	}


}
