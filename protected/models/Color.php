<?php
Yii::import( 'application.models.ColorCategory' );
/**
 * This is the model class for table "colors".
 *
 * The followings are the available columns in table 'colors':
 * @property integer $id
 * @property integer $is_show
 * @property string $title
 * @property integer $type
 * @property integer $material
 * @property string $image
 * @property string $is_front
 * @property string $is_module
 * @property string $is_tabletop
 * @property string $is_wall_panel
 * @property string $is_accessory
 */
class Color extends CActiveRecord {

	/**
	 * Типы цветов
	 * @var array
	 */
	public static $types = array(
		'front'      => array( 'name' => 'front', 'label' => 'Фасад' ),
		'module'     => array( 'name' => 'module', 'label' => 'Модуль' ),
		'tabletop'   => array( 'name' => 'tabletop', 'label' => ' Столешница' ),
		'wall_panel' => array( 'name' => 'wall_panel', 'label' => ' Стеновые панели' ),
		'accessory'  => array( 'name' => 'accessory', 'label' => ' Стеновые панели' ),
	);

	/**
	 * Материалы цветов
	 * @var array
	 */
	 /*
	public static $materials = array(
		'ldsp'        	=> array( 'name' => 'ldsp', 'label' => ' ЛДСП' ),
		'ldsp2'        	=> array( 'name' => 'ldsp2', 'label' => ' ЛДСП2' ),
		'plastic' 		=> array( 'name' => 'plastic', 'label' => 'Пластик 1 категория' ),
		'plastic2' 		=> array( 'name' => 'plastic2', 'label' => 'Пластик 2 категория' ),
		'plastic3' 		=> array( 'name' => 'plastic3', 'label' => 'Пластик 3 категория' ),
		'plastic3D' 	=> array( 'name' => 'plastic3D', 'label' => 'Пластик 3D' ),
		'plastic3D_2' 	=> array( 'name' => 'plastic3D_2', 'label' => 'Пластик 3D 2' ),
		'plastic3D_3' 	=> array( 'name' => 'plastic3D_3', 'label' => 'Пластик 3D 3' ),
		'plasticGer1'	=> array( 'name' => 'plasticGer1', 'label' => 'Пластик Германия 1' ),
		'plasticGer2' 	=> array( 'name' => 'plasticGer2', 'label' => 'Пластик Германия 2' ),
		'plasticGer3' 	=> array( 'name' => 'plasticGer3', 'label' => 'Пластик Германия 3' ),
		'plasticGer3D_1'=> array( 'name' => 'plasticGer3D_1', 'label' => 'Пластик Германия 3D 1' ),
		'plasticGer3D_2'=> array( 'name' => 'plasticGer3D_2', 'label' => 'Пластик Германия 3D 2' ),
		'plasticGer3D_3'=> array( 'name' => 'plasticGer3D_3', 'label' => 'Пластик Германия 3D 3' ),
		'mdf'     		=> array( 'name' => 'mdf', 'label' => 'МДФ 1 категория' ),
		'mdf2'     		=> array( 'name' => 'mdf2', 'label' => 'МДФ 2 категория' ),
		'mdf3'     		=> array( 'name' => 'mdf3', 'label' => 'МДФ 3 категория' ),
		'mdf4'     		=> array( 'name' => 'mdf4', 'label' => 'МДФ 4 категория' ),
		'mdf5'     		=> array( 'name' => 'mdf5', 'label' => 'МДФ 5 категория' ),
		'mdfPatina1'    => array( 'name' => 'mdfPatina1', 'label' => 'МДФ Патина 1' ),
		'mdfPatina2' 	=> array( 'name' => 'mdfPatina2', 'label' => 'МДФ Патина 2'),
		'mdfPatina3' 	=> array( 'name' => 'mdfPatina3', 'label' => 'МДФ Патина 3'),
		'mdfPatina4' 	=> array( 'name' => 'mdfPatina4', 'label' => 'МДФ Патина 4'),
		'mdfColor'     	=> array( 'name' => 'mdfColor', 'label' => 'МДФ-крашенные 1' ),
		'mdfColor2'     => array( 'name' => 'mdfColor2', 'label' => 'МДФ-крашенные 2' ),
		'mdfColor3'     => array( 'name' => 'mdfColor3', 'label' => 'МДФ-крашенные 3' ),
		'mdfColor4'     => array( 'name' => 'mdfColor4', 'label' => 'МДФ-крашенные 4' ),
		'mdfColorPatina'=> array( 'name' => 'mdfColorPatina', 'label' => 'МДФ-крашенные  Патина1' ),
		'mdfColorPatina2'=> array( 'name' => 'mdfColorPatina2', 'label' => 'МДФ-крашенные Патина2' ),
		'mdfColorPatina3'=> array( 'name' => 'mdfColorPatina3', 'label' => 'МДФ-крашенные Патина3' ),
		'mdfColorPatina4'=> array( 'name' => 'mdfColorPatina4', 'label' => 'МДФ-крашенные Патина4' ),
		'shpon1' 		=> array( 'name' => 'shpon1', 'label' => 'Шпон1'),
		'shpon2' 		=> array( 'name' => 'shpon2', 'label' => 'Шпон2'),
		'shpon3' 		=> array( 'name' => 'shpon3', 'label' => 'Шпон3'),
		'shpon4' 		=> array( 'name' => 'shpon4', 'label' => 'Шпон4'),
		'shpon5' 		=> array( 'name' => 'shpon5', 'label' => 'Шпон5'),
		'ecoshpon1' 	=> array( 'name' => 'ecoshpon1', 'label' => 'ECO Шпон 1'),
		'ecoshpon2' 	=> array( 'name' => 'ecoshpon2', 'label' => 'ECO Шпон 2'),
		'EcoshponS1' 	=> array( 'name' => 'EcoshponS1', 'label' => 'ECO Шпон сборный 1'),
		'EcoshponS2' 	=> array( 'name' => 'EcoshponS2', 'label' => 'ECO Шпон сборный 2'),
		'emal'			=> array( 'name' => 'emal', 'label' => 'Эмаль'),
		'emal2'			=> array( 'name' => 'emal2', 'label' => 'Эмаль 2'),
		'emal3'			=> array( 'name' => 'emal3', 'label' => 'Эмаль 3'),
		'acryl'			=> array( 'name' => 'acryl', 'label' => 'Акрил'),
		'acryl2'		=> array( 'name' => 'acryl2', 'label' => 'Акрил 2'),
		'acryl3'		=> array( 'name' => 'acryl3', 'label' => 'Акрил 3'),
		'acryl3D' 		=> array( 'name' => 'acryl3D', 'label' => 'Акрил 3D'),	
		'glass'			=> array( 'name' => 'glass', 'label' => 'Стекло'),
		'glass2'		=> array( 'name' => 'glass2', 'label' => 'Стекло'),
		'glass3'		=> array( 'name' => 'glass3', 'label' => 'Стекло'),
		'alum' 			=> array( 'name' => 'alum', 'label' => ' Алюминий')
	);
	*/
	public static function materials(){
	    $arr= array();
		$ColorCategory = ColorCategory::model()->findAll();
		foreach($ColorCategory as $item){
		    $arr[$item['name']]=array('name'=>$item['name'],'label'=>$item['label']);
		}
		return $arr;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 *
	 * @param string $className active record class name.
	 *
	 * @return Color the static model class
	 */
	public static function model( $className = __CLASS__ ) {
		return parent::model( $className );
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'colors';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array( 'title', 'required' ),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array( 'id, is_show, title, type, material, image', 'safe', 'on' => 'search' ),
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
			'id'       => 'ID',
			'is_show'  => 'Is Show',
			'title'    => 'Title',
			'type'     => 'Type',
			'material' => 'Material',
			'image'    => 'Image',
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
		$criteria->compare( 'is_show', $this->is_show, true );
		$criteria->compare( 'title', $this->title, true );
		$criteria->compare( 'type', $this->type );
		$criteria->compare( 'material', $this->material );
		$criteria->compare( 'image', $this->image, true );
		$criteria->compare( 'is_front', $this->is_front, true );
		$criteria->compare( 'is_module', $this->is_module, true );
		$criteria->compare( 'is_tabletop', $this->is_tabletop, true );
		$criteria->compare( 'is_wall_panel', $this->is_wall_panel, true );
		$criteria->compare( 'is_accessory', $this->is_accessory, true );

		return new CActiveDataProvider( $this, array(
			'criteria' => $criteria,
		) );
	}

	/**
	 * Путь до изображения
	 * @return string
	 */
	public function getImage() {
		return '/images/colors/' . $this->image;
	}


	/**
	 * Название типа
	 * @return mixed
	 */
	public function getTypeLabel() {
		return isset( Color::$types[ $this->type ] ) ? Color::$types[ $this->type ]['label'] : "";
	}

	/**
	 * Название материала
	 * @return mixed
	 */
	public function getMaterialLabel() {
		$colorcategoryCriteria            = new CDbCriteria;
		$colorcategoryCriteria->condition = 'name=:name';
		$colorcategoryCriteria->params    = array( ':name' => $this->material );
		$ColorCategory = ColorCategory::model()->findAll($colorcategoryCriteria );
		if(isset($ColorCategory[0]['label'])){
			$material = $ColorCategory[0]['label'];
		}
		else{
			$material = "???";
		}
		return $material;
	}

	/**
	 * МДФ или нет
	 * @return bool
	 */
	public function isMdf() {
		if ( $this->material == Color::$materials['mdf']['name'] ) {
			return true;
		} else {
			return false;
		}
	}

}