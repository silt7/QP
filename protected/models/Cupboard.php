<?php
class Cupboard extends CActiveRecord {
	public static function model( $className = __CLASS__ ) {
		return parent::model( $className );
	}
	public function tableName() {
		return 'cupboard';
	}
	public function getFolderModel() {
		$folderModel = null;
		if ( $this->folder_id ) {
			$folderModel = Folder::model()->findByPk( $this->folder_id );
		}
		return $folderModel;
	}
	public function getImage() {
		return '/images/cupboard/' . $this->image;
	}
}
?>