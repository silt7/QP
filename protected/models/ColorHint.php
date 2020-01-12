<?php


Yii::import( 'application.models.Color' );


/**
 *   Вспомогательный класс конструктора модулей
 */
class ColorHint {

	private $storage;
	private $sessionStorage;

	public function __construct( $sessionStorage ) {
		$this->sessionStorage         = $sessionStorage;
		$this->storage['moduleColor'] = null;
		$this->storage['frontColor']  = null;

		if ( isset( $sessionStorage['color_hint'] ) ) {
			$this->storage = $sessionStorage['color_hint'];
		}

	}

	/**
	 * Установка хранилища
	 *
	 * @param $sessionStorage
	 */
	public function setStorage( $sessionStorage ) {
		$this->sessionStorage = $sessionStorage;
	}


	public function getFrontColorString() {
		$color = $this->getFrontColor();
		if ( $color ) {
			return '<img src="' . $color->getImage() . ' "> ' . $color->title . ' (' . Color::$materials[ $color->material ]['label'] . ') ';
		} elseif ( $this->storage['frontColor'] == 0 ) {
			return 'без фасада';
		} else {
			return 'выберете цвет';
		}
	}

	/**
	 * Цвет фасада
	 * @return mixed
	 */
	public function getFrontColor() {
		$color = null;
		if ( $this->storage['frontColor'] != null ) {
			$color = Color::model()->findByPk( $this->storage['frontColor'] );
		}

		return $color;
	}

	/**
	 * ID Цвет фасада
	 * @return mixed
	 */
	public function getFrontColorId() {
		return $this->storage['frontColor'];
	}

	public function getModuleColorString() {
		$color = $this->getModuleColor();
		if ( $color ) {
			return '<img src="' . $color->getImage() . ' "> ' . $color->title;
		} else {
			return 'выберете цвет';
		}
	}

	/**
	 * Цвет модуля
	 * @return mixed
	 */
	public function getModuleColor() {
		$color = null;
		if ( $this->storage['moduleColor'] != null ) {
			$color = Color::model()->findByPk( $this->storage['moduleColor'] );
		}

		return $color;
	}

	/**
	 * ID Цвет модуля
	 * @return mixed
	 */
	public function getModuleColorId() {
		return $this->storage['moduleColor'];
	}

	public function setFrontColor( $color, $isSave ) {
		if ( $color == "nullval" ) {
			$this->storage['frontColor'] = null;
		} else {
			$this->storage['frontColor'] = $color;
		}
		if ( $isSave ) {
			$this->save();
		}
	}

	/**
	 * Сохранение модели в хранилище
	 */
	public function save() {
		$this->sessionStorage['color_hint'] = $this->storage;
	}

	public function setModuleColor( $color, $isSave ) {
		if ( $color == "nullval" ) {
			$this->storage['moduleColor'] = null;
		} else {
			$this->storage['moduleColor'] = $color;
		}
		if ( $isSave ) {
			$this->save();
		}
	}

} 