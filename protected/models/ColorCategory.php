<?php
	class ColorCategory extends CActiveRecord {
		public static function model( $className = __CLASS__ ) {
			return parent::model( $className );
		}
		public function tableName() {
			return 'colorCategory';
		}
		
    	/** Группировка категорий **/
    	public function  groupCategory(){
    		$arraySort  =   array(
    		    array('ЛДСП','ldsp'),
    		    array('ЭКО шпон','ecoshpon'),
    		    array('ЭКО шпон сборный','EcoshponS'),
    		    array('Пластик','plastic'),
    		    array('Пластик 3Д','plastic3D'),
    		    array('Пластик Арпа','plasticArpa'),
    		    array('МДФ-пленка','mdfPlenca'),
    		    array('МДФ-эмаль','mdfEmal'),
    		    array('Фрезеровки','frez'),
    		    array('Шпон натуральный','shponNat'),
    		    array('Акрил','acryl'),
    		    array('Акрил Сидак','acrylS'),
    		    array('Алюминий','alum'),
    		);
    		return $arraySort;
    	}

	}
?>