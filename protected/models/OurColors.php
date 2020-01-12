<?php
	class OurColors extends CActiveRecord {
		public static function model( $className = __CLASS__ ) {
			return parent::model( $className );
		}
		public function tableName() {
			return 'our_color';
		}

	}
?>