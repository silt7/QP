<?php
	class PriceFrontColor extends CActiveRecord {
		public static function model( $className = __CLASS__ ) {
			return parent::model( $className );
		}
		public function tableName() {
			return 'PriceFrontColor';
		}

		
/* 		public $files;
		// другие свойства	 
		public function rules(){
			return array(
				//устанавливаем правила для файла, позволяющие загружать
				// только картинки!
				array('files', 'file', 'types'=>'xls,xlsx'),
			);
		} */
	}
?>