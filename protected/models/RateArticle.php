<?php
	class RateArticle extends CActiveRecord {
		public static function model( $className = __CLASS__ ) {
			return parent::model( $className );
		}
		public function tableName() {
			return 'rate_article';
		}
		public function selRating($page){
		    $ratePage            = new CDbCriteria;
		    $ratePage->condition = 'page=:page';
		    $ratePage->params    = array( ':page' => $page );
	    	$selRating = $this::model()->findAll($ratePage);
	    	
	    	$sum = 0;
	    	$count = 0;
	    	foreach($selRating as $item){
	    	    $sum += $item['point'];
	    	    $count++;
	    	}
	    	$point['average'] = round($sum/$count * 2, 0)/2;
	    	$point['count'] = $count;
			return $point;
		}
	}
?>