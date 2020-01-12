<?php

/**
 * Created by PhpStorm.
 * User: brushknight
 * Date: 08/02/15
 * Time: 21:30
 */
class Utils {


	public static function priceFormat( $price ) {


		$intPrise = $price;
		$string   = "";

		if ( $price >= 0 ) {
			do {
				$thousandString = $intPrise % 1000;


				if ( intval( $intPrise / 1000 ) % 1000 != 0 ) {
					if ( $thousandString == 0 ) {
						$thousandString = '000';
					} else if ( $thousandString < 10 ) {
						$thousandString = '00' . $thousandString;
					} else if ( $thousandString < 100 ) {
						$thousandString = '0' . $thousandString;
					}
				}

				$intPrise = intval( $intPrise / 1000 );
				$string   = $thousandString . " " . $string;
			} while ( $intPrise % 1000 != 0 );
		}

		return $string;

	}

} 