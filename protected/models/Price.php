<?php
	class Price extends CActiveRecord {
		public static function model( $className = __CLASS__ ) {
			return parent::model( $className );
		}
		public function tableName() {
			return 'price_front';
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