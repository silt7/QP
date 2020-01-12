<?php
class Frez extends CActiveRecord {
    public static function model( $className = __CLASS__ ) {
        return parent::model( $className );
    }
    public function tableName() {
        return 'frez';
    }
    public function getImage() {
        return '/images/frez/' . $this->image;
    }
    public static $categ = array(
        array('id'=>'1','title'=>'Фрезеровка1'),
        array('id'=>'2','title'=>'Фрезеровка2'),
        array('id'=>'3','title'=>'Фрезеровка3'),
        array('id'=>'4','title'=>'Фрезеровка4'),
        array('id'=>'5','title'=>'Фрезеровка5'),
        array('id'=>'6','title'=>'Фрезеровка6'),
    );
}
?>