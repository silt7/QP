<?php

/**
 * To JSON converter
 *
 * Util class
 *
 * Created by PhpStorm.
 * User: Grigorij
 * Date: 7/9/14
 * Time: 3:21 AM
 */
class ToJSON {

	public static function ModelsToJSON( $models ) {
		$returnJSON = '{';

		foreach ( $models as $model ) {
			$returnJSON .= $model->toJSON() . ',';
		}

		$returnJSON = trim( $returnJSON, "," );
		$returnJSON .= '}';
		return $returnJSON;
	}

	public static function ModelsArrayToJSONById( $modelsArray ) {
		$returnJSON = '{';
		foreach ( $modelsArray as $models ) {

			foreach ( $models as $model ) {
				$returnJSON .= '"' . $model->getPublicId() . '" : ' . $model->toJSON() . ',';
			}
		}
		$returnJSON = trim( $returnJSON, "," );
		$returnJSON .= '}';
		return $returnJSON;
	}

	public static function ModelsToJSONById( $models ) {
		$returnJSON = '{';
		foreach ( $models as $model ) {
			$returnJSON .= '"' . $model->getPublicId() . '" : ' . $model->toJSON() . ',';
		}

		$returnJSON = trim( $returnJSON, "," );
		$returnJSON .= '}';
		return $returnJSON;
	}


	public static function ModelsToJSONByModelName( $modelsArray ) {


		$returnJSON = '{';

		foreach ( $modelsArray as $models ) {
			foreach ( $models as $model ) {
				$returnJSON .= '"' . $model->getModelName() . '" : ' . $model->toJSON() . ',';
			}
		}


		$returnJSON = trim( $returnJSON, "," );
		$returnJSON .= '}';
		return $returnJSON;
	}

} 