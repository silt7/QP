<?php
/**
 * Фабрика моделей
 * В стадии разработки
 */

Yii::import( "application.models.User" );
Yii::import( "application.models.SessionUser" );
Yii::import( "application.models.ColorHint" );
Yii::import( "application.models.Utils" );

Yii::import( "application.models.Color" );
Yii::import( "application.models.Folder" );
Yii::import( "application.models.ItemModule" );
Yii::import( "application.models.ItemFront" );
Yii::import( "application.models.ItemCover" );
Yii::import( "application.models.Accessory" );
Yii::import( "application.models.Equipment" );
Yii::import( "application.models.Order" );
Yii::import( "application.models.OrderLine" );

class ModelFactory {

	public static function getUser() {
		return ModelFactory::getClassInstance( "User" );
	}

	public static function getClassInstance( $className ) {
		return new $className();
	}

	public static function getUserModel() {
		return ModelFactory::getClassModel( "User" );

	}

	public static function getClassModel( $className ) {
		return $className::model();
	}

	public static function getColor() {
		return ModelFactory::getClassInstance( "Color" );

	}

	public static function getColorModel() {
		return ModelFactory::getClassModel( "Color" );
	}


} 